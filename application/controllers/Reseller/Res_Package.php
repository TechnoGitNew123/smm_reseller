<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_Package extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

/*************************************** Admin Package List *********************************/
  // List..
  public function package_list(){

    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    // echo $this->session->userdata('smm_addedby_type');
    $data['package_category_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','package_category_id','DESC','smm_package_category');

    // if($this->session->userdata('smm_addedby_type') == 1){
    //   $data['package_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','package_id','DESC','smm_package');
    // } else{
    //   $smm_addedby = $this->session->userdata('smm_addedby');
    //   $data['package_list'] = $this->Reseller_Model->reseller_package_list($smm_res_company_id,$smm_addedby);
    // }
    // print_r($data['package_list']);
    $data['page'] = 'Admin Packages';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Package/package_list', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Add Package to Reseller...
  public function add_package_to_reseller(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $package_id = $_POST['package_id'];
    $package_cost = $_POST['package_cost'];

    $save_data = array(
      'company_id' => $smm_res_company_id,
      'package_id' => $package_id,
      'reseller_package_prev_price' => $package_cost,
      'reseller_package_new_price' => $package_cost,
      'reseller_id' => $smm_reseller_id,
      // 'package_sale_by' => '1',
    );
    if($this->session->userdata('smm_addedby_type') == 1){
      $save_data['package_sale_by'] = '1';
    } else{
      $save_data['package_sale_by'] = '2';
    }
    $reseller_package_id = $this->Master_Model->save_data('smm_reseller_package', $save_data);
    if($reseller_package_id){
      echo 'success';
    } else{
      echo 'error';
    }
  }


/*************************************** My Package List *******************************/
  public function my_package_list(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $data['my_package_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','reseller_package_id','DESC','smm_reseller_package');
    $data['page'] = 'My Packages';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Package/my_package_list', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Update Reseller Price...
  public function update_package_price(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $reseller_package_id = $_POST['reseller_package_id'];
    $update_data = $_POST;
    $this->Master_Model->update_info('reseller_package_id', $reseller_package_id, 'smm_reseller_package', $update_data);
    $this->session->set_flashdata('update_success','success');
    header('location:'.base_url().'Reseller/Res_Package/my_package_list');
  }

/************************************* Package Details ************************************/
  public function package_details($package_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    if($this->session->userdata('smm_addedby_type') == 1){
      $package_details = $this->Master_Model->get_info_arr_fields3('*', $smm_res_company_id, 'package_id', $package_id, '', '', '', '', 'smm_package');
      if(!$package_details){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }
    } else{
      $smm_addedby = $this->session->userdata('smm_addedby');
      // $data['package_list'] = $this->Reseller_Model->reseller_package_list($smm_res_company_id,$smm_addedby);

      $package_details = $this->Reseller_Model->reseller_package_details($smm_res_company_id,$smm_addedby,$package_id);
      if(!$package_details){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }
    }
    // print_r($package_details);
    $data['package_details'] = $package_details[0];
    $data['package_feature_list'] = $this->Master_Model->get_list_by_id3('','package_id',$package_id,'','','','','package_feature_id','ASC','smm_package_feature');

    $data['page'] = 'My Packages';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Package/package_details', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }


/*********************************** Coupon *********************************/

  // Add Coupon....
  public function reseller_coupon(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('reseller_coupon_date', 'Coupon Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $reseller_coupon_status = $this->input->post('reseller_coupon_status');
      if(!isset($reseller_coupon_status)){ $reseller_coupon_status = '1'; }
      $save_data = $_POST;
      $save_data['reseller_coupon_status'] = $reseller_coupon_status;
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['reseller_id'] = $smm_reseller_id;
      // $save_data['reseller_coupon_addedby'] = $smm_reseller_id;
      $coupon_exist = $this->Master_Model->get_info_arr_fields3('reseller_coupon_id', $smm_res_company_id, 'reseller_id', $smm_reseller_id, 'package_id', $_POST['package_id'], '', '', 'smm_reseller_coupon');
      if($coupon_exist){
        $this->session->set_flashdata('save_error','success');
      } else{
        $reseller_coupon_id = $this->Master_Model->save_data('smm_reseller_coupon', $save_data);
        $this->session->set_flashdata('save_success','success');
      }




      header('location:'.base_url().'Reseller/Res_Package/reseller_coupon');
    }
    $data['my_package_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','reseller_package_id','DESC','smm_reseller_package');
    // $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_name','ASC','smm_project');

    $data['reseller_coupon_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','reseller_coupon_id','DESC','smm_reseller_coupon');
    $data['page'] = 'Coupon';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Package/reseller_coupon', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Coupon...
  public function edit_reseller_coupon($reseller_coupon_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }
    $reseller_coupon_info = $this->Master_Model->get_info_arr('reseller_coupon_id',$reseller_coupon_id,'smm_reseller_coupon');
    if(!$reseller_coupon_info){ header('location:'.base_url().'Reseller/Res_Package/reseller_coupon'); }

    $this->form_validation->set_rules('reseller_coupon_date', 'Coupon Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $reseller_coupon_status = $this->input->post('reseller_coupon_status');
      if(!isset($reseller_coupon_status)){ $reseller_coupon_status = '1'; }
      $update_data = $_POST;
      $coupon_exist = $this->Master_Model->get_info_arr_fields3('reseller_coupon_id', $smm_res_company_id, 'reseller_id', $smm_reseller_id, 'package_id', $_POST['package_id'], '', '', 'smm_reseller_coupon');
      if($reseller_coupon_info[0]['package_id'] != $_POST['package_id'] && $coupon_exist){
        $this->session->set_flashdata('save_error','success');
      } else{
        $this->Master_Model->update_info('reseller_coupon_id', $reseller_coupon_id, 'smm_reseller_coupon', $update_data);
        $this->session->set_flashdata('update_success','success');
      }


      // $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Package/reseller_coupon');
    }

    $data['update'] = 'update';
    $data['update_reseller_coupon'] = 'update';
    $data['reseller_coupon_info'] = $reseller_coupon_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Package/edit_reseller_coupon/'.$reseller_coupon_id;
    $data['my_package_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','reseller_package_id','DESC','smm_reseller_package');
    // $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_name','ASC','smm_project');

    $data['reseller_coupon_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','reseller_coupon_id','DESC','smm_reseller_coupon');
    $data['page'] = 'Edit Coupon';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Package/reseller_coupon', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  //Delete Coupon...
  public function delete_reseller_coupon($reseller_coupon_id){
    $smm_reseller_id = $this->session->userdata('smm_user_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' && $smm_res_company_id == ''){ header('location:'.base_url().'User'); }

    $this->Master_Model->delete_info('reseller_coupon_id', $reseller_coupon_id, 'smm_reseller_coupon');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Reseller/Res_Package/reseller_coupon');
  }


}
?>
