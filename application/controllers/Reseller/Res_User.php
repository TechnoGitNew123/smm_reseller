<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_User extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

  public function logout(){
    // $this->session->sess_destroy();
    $this->session->unset_userdata('smm_reseller_id');
    $this->session->unset_userdata('smm_res_company_id');
    header('location:'.base_url().'Reseller/Res_User');
  }

/**************************      Login      ********************************/

  public function index(){
    $web_reseller_id = $this->session->userdata('web_reseller_id');
    if(!$web_reseller_id){ header('location:'.base_url().''); }


    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');

    if($smm_reseller_id == '' || $smm_res_company_id == ''){
      $this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');
      if ($this->form_validation->run() == FALSE) {
      	$this->load->view('Reseller/Res_User/login');
      } else{
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('password');

        $login = $this->Reseller_Model->check_login($mobile, $password, $web_reseller_id);
        if($login == null){
          $this->session->set_flashdata('msg','login_error');
          header('location:'.base_url().'Reseller/Res_User');
        } else{
          $this->session->set_userdata('smm_reseller_id', $login[0]['reseller_id']);
          $this->session->set_userdata('smm_res_company_id', $login[0]['company_id']);
          $this->session->set_userdata('smm_addedby_type', $login[0]['reseller_added_type']);
          $this->session->set_userdata('smm_addedby', $login[0]['reseller_addedby']);
          // $this->session->set_userdata('branch_id', $login[0]['branch_id']);
          header('location:'.base_url().'Reseller/Res_User/dashboard');
        }
      }
    }
    else{
      header('location:'.base_url().'Reseller/Res_User/dashboard');
    }
  }

  public function forgot_password(){
    $this->load->view('Reseller/Res_User/forgot_password');
  }

/**************************      Dashboard      ********************************/
  public function dashboard(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    // $data['reseller_cnt'] = $this->Master_Model->get_sum($smm_res_company_id,'reseller_id','reseller_added_type','2','reseller_addedby',$smm_reseller_id,'','','smm_reseller');
    //
    $data['reseller_cnt'] = $this->Master_Model->get_count('reseller_id',$smm_res_company_id,'reseller_added_type','2','reseller_addedby',$smm_reseller_id,'','','smm_reseller');
    $data['package_cnt'] = $this->Master_Model->get_count('reseller_id',$smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','smm_reseller_package');
    $data['announcement_cnt'] = $this->Master_Model->get_count('announcement_id',$smm_res_company_id,'announcement_addedby_type','2','announcement_addedby',$smm_reseller_id,'','','smm_announcement');
    $data['testimonial_cnt'] = $this->Master_Model->get_count('testimonial_id',$smm_res_company_id,'testimonial_addedby_type','2','testimonial_addedby',$smm_reseller_id,'','','smm_testimonial');

    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','project_id','ASC','smm_project');
    $data['page'] = 'Reseller Dashboard';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_User/dashboard', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

/************************************* Profile **************************************/
  public function profile(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('reseller_name', 'reseller title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      unset($update_data['old_reseller_logo']);
      // $update_data['reseller_status'] = $reseller_status;
      $update_data['reseller_addedby'] = '0';
      $this->Master_Model->update_info('reseller_id', $smm_reseller_id, 'smm_reseller', $update_data);

      if($_FILES['reseller_logo']['name']){
        $time = time();
        $image_name = 'reseller_'.$smm_reseller_id.'_'.$time;
        $config['upload_path'] = 'assets/images/reseller/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['reseller_logo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('reseller_logo') && $smm_reseller_id && $image_name && $ext && $filename){
          $reseller_logo_up['reseller_logo'] =  base_url().'assets/images/reseller/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('reseller_id', $smm_reseller_id, 'smm_reseller', $reseller_logo_up);
          if($_POST['old_reseller_logo']){
            $unlink_image = str_replace(base_url(), "",$_POST['old_reseller_logo']);
            unlink($unlink_image);
          }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_User/profile');
    }

    $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$smm_reseller_id,'smm_reseller');
    if(!$reseller_info){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }
    $data['update'] = 'update';
    $data['update_reseller'] = 'update';
    $data['reseller_info'] = $reseller_info[0];
    // $data['act_link'] = base_url().'Res_User/edit_reseller/'.$smm_reseller_id;
    $state_id = $reseller_info[0]['state_id'];
    $country_id = $reseller_info[0]['country_id'];
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    // $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');

    $data['page'] = 'Reseller Profile';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_User/profile', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }









/*******************************    User Information      ****************************/

  // Add User...
  public function user_information(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    $smm_role_permission = $this->session->userdata('smm_role_permission');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'User'); }
    if(!in_array("user1", $smm_role_permission)){ header('location:'.base_url().'User/dashboard'); }

    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $user_status = $this->input->post('user_status');
      if(!isset($user_status)){ $user_status = '1'; }
      $leave_type_id = $_POST['leave_type_id'];
      $leave_type_id = implode(',',$leave_type_id);

      $save_data = $_POST;
      $save_data['leave_type_id'] = $leave_type_id;
      $save_data['user_status'] = $user_status;
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['user_addedby'] = $smm_reseller_id;
      $user_id = $this->Master_Model->save_data('user', $save_data);

      if($_FILES['user_image']['name']){
        $time = time();
        $image_name = 'user_'.$user_id.'_'.$time;
        $config['upload_path'] = 'assets/images/user/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['user_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('user_image') && $user_id && $image_name && $ext && $filename){
          $user_image_up['user_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('user_id', $user_id, 'user', $user_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/user_information');
    }
    $data['country_list'] = $this->Master_Model->get_list('','country_name','ASC','country');
    // $data['state_list'] = $this->Master_Model->get_list('','state_name','ASC','state');
    // $data['district_list'] = $this->Master_Model->get_list('','district_name','ASC','district');
    // $data['city_list'] = $this->Master_Model->get_list('','city_name','ASC','city');
    $data['role_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','role_id','ASC','role');
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['designation_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','designation_name','ASC','smm_designation');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','department_name','ASC','smm_department');
    $data['office_shift_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','office_shift_name','ASC','smm_office_shift');
    $data['user_report_to_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','user_name','ASC','user');
    $data['leave_type_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','leave_type_name','ASC','smm_leave_type');

    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'is_admin','0','','','','','user_id','ASC','user');
    $data['page'] = 'User';
    $data['smm_role_permission'] = $smm_role_permission;
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/user_information', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Education Level...
  public function edit_user($user_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    $smm_role_permission = $this->session->userdata('smm_role_permission');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'User'); }
    if(!in_array("user3", $smm_role_permission)){ header('location:'.base_url().'User/dashboard'); }

    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $user_status = $this->input->post('user_status');
      if(!isset($user_status)){ $user_status = '1'; }
      $leave_type_id = $_POST['leave_type_id'];
      $leave_type_id = implode(',',$leave_type_id);
      $update_data = $_POST;
      unset($update_data['old_user_image']);
      $update_data['leave_type_id'] = $leave_type_id;
      $update_data['user_status'] = $user_status;
      $update_data['user_addedby'] = $smm_reseller_id;
      $this->Master_Model->update_info('user_id', $user_id, 'user', $update_data);

      if($_FILES['user_image']['name']){
        $time = time();
        $image_name = 'user_'.$user_id.'_'.$time;
        $config['upload_path'] = 'assets/images/user/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['user_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('user_image') && $user_id && $image_name && $ext && $filename){
          $user_image_up['user_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('user_id', $user_id, 'user', $user_image_up);
          if($_POST['old_user_img']){ unlink("assets/images/user/".$_POST['old_user_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/user_information');
    }

    $user_info = $this->Master_Model->get_info_arr('user_id',$user_id,'user');
    if(!$user_info){ header('location:'.base_url().'User/user_information'); }
    $data['update'] = 'update';
    $data['update_user'] = 'update';
    $data['user_info'] = $user_info[0];
    $data['act_link'] = base_url().'User/edit_user/'.$user_id;
    $country_id = $user_info[0]['country_id'];
    $state_id = $user_info[0]['state_id'];
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    // $data['district_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','district_name','ASC','district');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    $data['role_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','role_id','ASC','role');
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['designation_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','designation_name','ASC','smm_designation');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','department_name','ASC','smm_department');
    $data['office_shift_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','office_shift_name','ASC','smm_office_shift');
    $data['user_report_to_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','user_name','ASC','user');
    $data['leave_type_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','leave_type_name','ASC','smm_leave_type');

    $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'is_admin','0','','','','','user_id','ASC','user');
    $data['page'] = 'Edit User';
    $data['smm_role_permission'] = $smm_role_permission;
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/user_information', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Education Level...
  public function delete_user($user_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    $smm_role_permission = $this->session->userdata('smm_role_permission');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'User'); }
    if(!in_array("user4", $smm_role_permission)){ header('location:'.base_url().'User/dashboard'); }
    else{
      $this->Master_Model->delete_info('user_id', $user_id, 'user');
      $this->session->set_flashdata('delete_success','success');
      header('location:'.base_url().'User/user_information');
    }
  }


/*******************************    Role Information      ****************************/

  // Add Role...
  public function role(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('role_name', 'Role Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $role_status = $this->input->post('role_status');
      if(!isset($role_status)){ $role_status = '1'; }
      $save_data = $_POST;
      unset($save_data['role_permission']);
      $role_permission=implode(',', $_POST['role_permission']);
      $save_data['role_permission'] = $role_permission;
      $save_data['role_status'] = $role_status;
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['role_addedby'] = $smm_reseller_id;
      $user_id = $this->Master_Model->save_data('role', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/role');
    }

    $data['role_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','role_id','ASC','role');
    $data['page'] = 'Role';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/role', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  // Edit/Update Role...
  public function edit_role($role_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('role_name', 'Role Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $role_status = $this->input->post('role_status');
      if(!isset($role_status)){ $role_status = '1'; }
      $update_data = $_POST;
      unset($update_data['role_permission']);
      $role_permission=implode(',', $_POST['role_permission']);
      $update_data['role_permission'] = $role_permission;
      $update_data['role_status'] = $role_status;
      $update_data['role_addedby'] = $smm_reseller_id;
      $this->Master_Model->update_info('role_id', $role_id, 'role', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/role');
    }

    $role_info = $this->Master_Model->get_info_arr('role_id',$role_id,'role');
    if(!$role_info){ header('location:'.base_url().'User/role'); }
    $data['update'] = 'update';
    $data['update_role'] = 'update';
    $data['role_info'] = $role_info[0];
    $data['act_link'] = base_url().'User/edit_role/'.$role_id;

    $data['role_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','role_id','ASC','role');
    $data['page'] = 'Edit Role';
    $this->load->view('Admin/Include/head', $data);
    $this->load->view('Admin/Include/navbar', $data);
    $this->load->view('Admin/User/role', $data);
    $this->load->view('Admin/Include/footer', $data);
  }

  //Delete Role...
  public function delete_role($role_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'User'); }
    $this->Master_Model->delete_info('role_id', $role_id, 'role');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/role');
  }







/*******************************  Check Duplication  ****************************/
  public function check_duplication(){
    $column_name = $this->input->post('column_name');
    $column_val = $this->input->post('column_val');
    $table_name = $this->input->post('table_name');
    $company_id = '';
    $cnt = $this->Master_Model->check_duplication($company_id,$column_val,$column_name,$table_name);
    echo $cnt;
  }





}
?>
