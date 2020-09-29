<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_Invoice extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

/********************************* Invoice By Admin ***********************************/
  // Add Invoice...
  public function invoice_list(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    // $data['invoice_no'] = $this->Master_Model->get_count_no($smm_res_company_id, 'invoice_no', 'smm_invoice');
    // $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','reseller_name','ASC','smm_reseller');
    // $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','project_name','ASC','smm_project');

    $data['invoice_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','client_id',$smm_reseller_id,'','','invoice_id','DESC','smm_invoice');
    $data['page'] = 'Invoice';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Invoice/invoice_list', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }


/***************************************** Order *****************************/
  // Order List....
  public function order_list(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }


    // $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');
    // $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','department_name','ASC','smm_department');
    //
    $data['order_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','order_id','DESC','smm_order');
    $data['page'] = 'Order List';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Invoice/order_list', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

/***************************************** Commission *****************************/
  // Order List....
  public function commission_list(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }


    // $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');
    // $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','department_name','ASC','smm_department');
    //
    $commission_total = $this->Master_Model->get_sum($smm_res_company_id,'commission_amount','reseller_id',$smm_reseller_id,'','','','','smm_commission');
    if($commission_total == ''){ $data['commission_total'] = 0; }
    else{ $data['commission_total'] = $commission_total; }
    $data['commission_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_id',$smm_reseller_id,'','','','','commission_id','DESC','smm_commission');
    $data['page'] = 'Order List';
    // echo $commission_total;
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Invoice/commission_list', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

/********************************* Invoice to Customer ***********************************/
  // Add Invoice...
  public function invoice(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('invoice_no', 'Invoice Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = $_POST;
      unset($save_data['input']);
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['invoice_addedby_type'] = '2';
      $save_data['invoice_addedby'] = $smm_reseller_id;
      $invoice_id = $this->Master_Model->save_data('smm_invoice', $save_data);

      if(isset($_POST['input'])){
        foreach($_POST['input'] as $multi_data){
          $multi_data['invoice_id'] = $invoice_id;
          $multi_data['company_id'] = $smm_res_company_id;
          $multi_data['invoice_item_addedby'] = $smm_user_id;
          $this->db->insert('smm_invoice_item', $multi_data);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Reseller/Res_Invoice/invoice');
    }
    $data['invoice_no'] = $this->Master_Model->get_count_no($smm_res_company_id, 'invoice_no', 'smm_invoice');
    $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_added_type','2','reseller_addedby',$smm_reseller_id,'','','reseller_name','ASC','smm_reseller');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','project_name','ASC','smm_project');

    $data['invoice_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'invoice_addedby_type','2','invoice_addedby',$smm_reseller_id,'','','invoice_id','ASC','smm_invoice');
    $data['page'] = 'Invoice';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Invoice/invoice', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Invoice...
  public function edit_invoice($invoice_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('invoice_no', 'Invoice Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      unset($update_data['input']);
      $this->Master_Model->update_info('invoice_id', $invoice_id, 'smm_invoice', $update_data);

      if(isset($_POST['input'])){
        foreach($_POST['input'] as $multi_data){
          if(isset($multi_data['invoice_item_id'])){
            $invoice_item_id = $multi_data['invoice_item_id'];
            if(!isset($multi_data['invoice_item_qty'])){
              $this->Master_Model->delete_info('invoice_item_id', $invoice_item_id, 'smm_invoice_item');
            }else{
              $multi_data['invoice_item_addedby'] = $smm_user_id;
              $this->Master_Model->update_info('invoice_item_id', $invoice_item_id, 'smm_invoice_item', $multi_data);
            }
          }
          else{
            $multi_data['invoice_id'] = $invoice_id;
            $multi_data['company_id'] = $smm_res_company_id;
            $multi_data['invoice_item_addedby'] = $smm_user_id;
            $this->db->insert('smm_invoice_item', $multi_data);
          }
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Invoice/invoice');
    }

    $invoice_info = $this->Master_Model->get_info_arr('invoice_id',$invoice_id,'smm_invoice');
    if(!$invoice_info){ header('location:'.base_url().'Reseller/Res_Invoice/invoice'); }
    $data['update'] = 'update';
    $data['update_invoice'] = 'update';
    $data['invoice_info'] = $invoice_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Invoice/edit_invoice/'.$invoice_id;
    $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_added_type','2','reseller_addedby',$smm_reseller_id,'','','reseller_name','ASC','smm_reseller');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','project_name','ASC','smm_project');
    $data['invoice_item_list'] = $this->Master_Model->get_list_by_id3('','invoice_id',$invoice_id,'','','','','invoice_item_id','ASC','smm_invoice_item');

    $data['invoice_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'invoice_addedby_type','2','invoice_addedby',$smm_reseller_id,'','','invoice_id','ASC','smm_invoice');
    $data['page'] = 'Edit Invoice';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Invoice/invoice', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Delete Invoice...
  // public function delete_invoice_file(){
  //   $invoice_file_id = $this->input->post('invoice_file_id');
  //   $invoice_file_info = $this->Master_Model->get_info_arr_fields('invoice_file_image, invoice_file_id', 'invoice_file_id', $invoice_file_id, 'smm_invoice_file');
  //   if($invoice_file_info){
  //     $invoice_file_image = $invoice_file_info[0]['invoice_file_image'];
  //     if($invoice_file_image){ unlink("assets/images/invoice/".$invoice_file_image); }
  //   }
  //   $this->Master_Model->delete_info('invoice_file_id', $invoice_file_id, 'smm_invoice_file');
  // }

  // Delete Invoice...
  public function delete_invoice($invoice_id){
    $smm_user_id = $this->session->userdata('smm_user_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $smm_role_id = $this->session->userdata('smm_role_id');
    if($smm_user_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'User'); }
    $invoice_file_list = $this->Master_Model->get_list_by_id3($smm_res_company_id,'invoice_id',$invoice_id,'','','','','invoice_file_id','ASC','smm_invoice_file');
    foreach ($invoice_file_list as $invoice_file_list1) {
      $invoice_file_image = $invoice_file_list1->invoice_file_image;
      if($invoice_file_image){ unlink("assets/images/invoice/".$invoice_file_image); }
    }
    $this->Master_Model->delete_info('invoice_id', $invoice_id, 'smm_invoice');
    $this->Master_Model->delete_info('invoice_id', $invoice_id, 'smm_invoice_file');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Reseller/Res_Invoice/invoice');
  }



}
?>
