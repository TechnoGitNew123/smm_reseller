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
    header('location:'.base_url().'Reseller');
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
          header('location:'.base_url().'Reseller');
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
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller'); }

    // $data['reseller_cnt'] = $this->Master_Model->get_sum($smm_res_company_id,'reseller_id','reseller_added_type','2','reseller_addedby',$smm_reseller_id,'','','smm_reseller');
    //
    $data['reseller_cnt'] = $this->Master_Model->get_count('reseller_id',$smm_res_company_id,'reseller_added_type','2','reseller_addedby',$smm_reseller_id,'','','smm_reseller');
    $data['package_cnt'] = $this->Master_Model->get_count('reseller_id',$smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','smm_reseller_package');
    $data['coupon_cnt'] = $this->Master_Model->get_count('reseller_coupon_id',$smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','smm_reseller_coupon');
    $data['order_cnt'] = $this->Master_Model->get_count('order_id',$smm_res_company_id,'client_id',$smm_reseller_id,'','','','','smm_order');
    $data['admin_invoice_cnt'] = $this->Master_Model->get_count('invoice_id',$smm_res_company_id,'client_id',$smm_reseller_id,'','','','','smm_invoice');
    $data['customer_invoice_cnt'] = $this->Master_Model->get_count('invoice_id',$smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','smm_invoice');
    $data['project_cnt'] = $this->Master_Model->get_count('project_id',$smm_res_company_id,'client_id',$smm_reseller_id,'','','','','smm_project');
    // $data['task_cnt'] = $this->Master_Model->get_count('project_id',$smm_res_company_id,'client_id',$smm_reseller_id,'','','','','smm_project');
    $task_list = $this->Reseller_Model->reseller_task_list($smm_reseller_id);
    $data['task_cnt'] = count($task_list);
    $ticket_list = $this->Reseller_Model->reseller_ticket_list($smm_reseller_id);
    $data['ticket_cnt'] = count($ticket_list);

    $data['announcement_cnt'] = $this->Master_Model->get_count('announcement_id',$smm_res_company_id,'announcement_addedby_type','2','announcement_addedby',$smm_reseller_id,'','','smm_announcement');
    $data['testimonial_cnt'] = $this->Master_Model->get_count('testimonial_id',$smm_res_company_id,'testimonial_addedby_type','2','testimonial_addedby',$smm_reseller_id,'','','smm_testimonial');
    $data['blog_cnt'] = $this->Master_Model->get_count('blog_id',$smm_res_company_id,'blog_addedby_type','2','blog_addedby',$smm_reseller_id,'','','smm_blog');

    $data['order_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','order_id','DESC','smm_order');
    $data['invoice_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','reseller_id',$smm_reseller_id,'','','invoice_id','DESC','smm_invoice');

    // $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','project_id','ASC','smm_project');
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
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller'); }

    $this->form_validation->set_rules('reseller_name', 'reseller title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      unset($update_data['old_reseller_logo']);
      // $update_data['reseller_status'] = $reseller_status;
      // $update_data['reseller_addedby'] = '0';
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
      header('location:'.base_url().'Reseller/Res_User/dashboard');
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

/************************************* Become Our Reseller **************************************/
  public function become_reseller(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller'); }
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','city_name','ASC','city');
    // $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['banner_image'] = $this->Master_Model->get_info_arr_fields3('*', $smm_res_company_id, 'become_reseller_possition', '1', '', '', '', '', 'smm_become_reseller');
    $data['step1_image'] = $this->Master_Model->get_info_arr_fields3('*', $smm_res_company_id, 'become_reseller_possition', '2', '', '', '', '', 'smm_become_reseller');
    $data['step2_image'] = $this->Master_Model->get_info_arr_fields3('*', $smm_res_company_id, 'become_reseller_possition', '3', '', '', '', '', 'smm_become_reseller');
    $data['step3_image'] = $this->Master_Model->get_info_arr_fields3('*', $smm_res_company_id, 'become_reseller_possition', '4', '', '', '', '', 'smm_become_reseller');
    $data['page'] = 'Become Our Reseller';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_User/become_reseller', $data);
    $this->load->view('Reseller/Include/footer', $data);
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
