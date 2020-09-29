<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebsiteController extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

 // public function index(){
 //  $this->load->view('Website/index1');
 // }
 public function logout(){
   // $this->session->sess_destroy();
   $this->session->unset_userdata('smm_reseller_id');
   $this->session->unset_userdata('smm_res_company_id');
   $this->session->unset_userdata('reseller_added_type');
   $this->session->unset_userdata('reseller_addedby');
   header('location:'.base_url().'');
 }

 public function index(){
  $this->load->view('Website/index');
 }

 public function check_url(){
   $url = $_POST['url'];
   $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_id, company_id', '', 'reseller_website', $url, '', '', '', '', 'smm_reseller');
   if($reseller_info){
     $web_company_id = $reseller_info[0]['company_id'];
     $web_reseller_id = $reseller_info[0]['reseller_id'];
     $web_setting_info = $this->Master_Model->get_info_arr_fields3('web_setting_id, company_id, template_id', $web_company_id, 'reseller_id', $web_reseller_id, 'web_setting_addedby_type', '2', '', '', 'smm_web_setting');
     $web_template_id = $web_setting_info[0]['template_id'];
     $this->session->set_userdata('web_reseller_id',$web_reseller_id);
     $this->session->set_userdata('web_company_id',$web_company_id);
     $this->session->set_userdata('web_template_id',$web_template_id);
     echo 'success';
   } else{
     echo 'error';
   }
 }

 public function home(){
   $web_reseller_id = $this->session->userdata('web_reseller_id');
   $web_company_id = $this->session->userdata('web_company_id');
   $web_template_id = $this->session->userdata('web_template_id');
   if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }
   $data['web_template_id'] = $web_template_id;
   $data['web_setting_info'] = $this->Master_Model->get_info_arr_fields3('*', $web_company_id, 'reseller_id', $web_reseller_id, 'web_setting_addedby_type', '2', '', '', 'smm_web_setting');
   $data['testomonial_list'] = $data['project_list'] = $this->Master_Model->get_list_by_id3($web_company_id,'testimonial_addedby_type','2','testimonial_addedby',$web_reseller_id,'','','testimonial_id','DESC','smm_testimonial');
   $data['package_list'] = $this->Master_Model->get_list_by_id3($web_company_id,'reseller_id',$web_reseller_id,'','','','','reseller_package_id','DESC','smm_reseller_package');
   $data['page'] = 'Home';
   $this->load->view('Website/home1', $data);

   // if($web_template_id == 1){
   //   $this->load->view('Website/home1', $data);
   // } elseif ($web_template_id == 2) {
   //   $this->load->view('Website/home2', $data);
   // } elseif($web_template_id == 3){
   //   $this->load->view('Website/home3', $data);
   // }

 }

 public function login(){
   $this->session->unset_userdata('signup_reseller_id');

   $web_reseller_id = $this->session->userdata('web_reseller_id');
   $web_company_id = $this->session->userdata('web_company_id');
   $web_template_id = $this->session->userdata('web_template_id');
   if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }
   $data['web_template_id'] = $web_template_id;
   $data['web_setting_info'] = $this->Master_Model->get_info_arr_fields3('*', $web_company_id, 'reseller_id', $web_reseller_id, 'web_setting_addedby_type', '2', '', '', 'smm_web_setting');
   $data['page'] = 'Login';

   // echo $web_reseller_id;

   $smm_reseller_id = $this->session->userdata('smm_reseller_id');
   $smm_res_company_id = $this->session->userdata('smm_res_company_id');

   if($smm_reseller_id == '' || $smm_res_company_id == ''){
     $this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
     $this->form_validation->set_rules('password', 'Password', 'trim|required');
     if ($this->form_validation->run() == FALSE) {
       $this->load->view('Website/login1', $data);
     } else{

       $mobile = $this->input->post('mobile');
       $password = $this->input->post('password');
       $login = $this->Reseller_Model->check_login($mobile, $password, $web_reseller_id);

       if($login == null){
         $this->session->set_flashdata('msg','login_error');
         header('location:'.base_url().'Login');
       } else{
         $this->session->set_userdata('smm_reseller_id', $login[0]['reseller_id']);
         $this->session->set_userdata('smm_res_company_id', $login[0]['company_id']);
         $this->session->set_userdata('smm_addedby_type', $login[0]['reseller_added_type']);
         $this->session->set_userdata('smm_addedby', $login[0]['reseller_addedby']);
         // $this->session->set_userdata('branch_id', $login[0]['branch_id']);
         header('location:'.base_url().'Home');
       }
     }
   }
   else{
     header('location:'.base_url().'Reseller/Res_User/dashboard');
   }



   // if($web_template_id == 1){
   //   $this->load->view('Website/login1', $data);
   // } elseif ($web_template_id == 2) {
   //   $this->load->view('Website/login2', $data);
   // } elseif($web_template_id == 3){
   //   $this->load->view('Website/login3', $data);
   // }
 }

 public function signup(){
   $web_reseller_id = $this->session->userdata('web_reseller_id');
   $web_company_id = $this->session->userdata('web_company_id');
   $web_template_id = $this->session->userdata('web_template_id');
   if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }

   $this->form_validation->set_rules('reseller_name', 'Reseller Name', 'trim|required');
   if ($this->form_validation->run() != FALSE) {
     $save_data = $_POST;
     // $save_data['ticket_status'] = $ticket_status;
     $save_data['company_id'] = $web_company_id;
     $save_data['reseller_added_type'] = '2';
     $save_data['reseller_addedby'] = $web_reseller_id;
     $save_data['reseller_is_online_request'] = '1';
     $save_data['reseller_status'] = '1';
     $reseller_id = $this->Master_Model->save_data('smm_reseller', $save_data);

     $save_web_setting = array(
       'company_id' => $web_company_id,
       'reseller_id' => $reseller_id,
       'web_setting_name' => $_POST['reseller_name'],
       // 'web_setting_address' => $_POST['reseller_address'],
       'country_id' => $_POST['country_id'],
       'state_id' => $_POST['state_id'],
       'city_id' => $_POST['city_id'],
       'web_setting_addedby_type' => 2,
     );
     $web_setting_id = $this->Master_Model->save_data('smm_web_setting', $save_web_setting);

     $this->session->set_userdata('signup_reseller_id', $reseller_id);
     $this->session->set_flashdata('signup_success','success');
     header('location:'.base_url().'Profile-Add');
   }

   $data['web_setting_info'] = $this->Master_Model->get_info_arr_fields3('*', $web_company_id, 'reseller_id', $web_reseller_id, 'web_setting_addedby_type', '2', '', '', 'smm_web_setting');
   $data['web_template_id'] = $web_template_id;
   $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');

   $data['page'] = 'Signup';
   $this->load->view('Website/signup1', $data);
 }

 // Add Profile...
 public function profile_add(){
   $web_reseller_id = $this->session->userdata('web_reseller_id');
   $web_company_id = $this->session->userdata('web_company_id');
   $web_template_id = $this->session->userdata('web_template_id');
   if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }

   $signup_reseller_id = $this->session->userdata('signup_reseller_id');
   if(!$signup_reseller_id){ header('location:'.base_url().''); }
   $reseller_id = $signup_reseller_id;
   $this->form_validation->set_rules('reseller_name', 'Reseller Name', 'trim|required');
   if ($this->form_validation->run() != FALSE) {
     $update_data = $_POST;
     $this->Master_Model->update_info('reseller_id', $reseller_id, 'smm_reseller', $update_data);

     if($_FILES['reseller_logo']['name']){
       $time = time();
       $image_name = 'reseller_'.$reseller_id.'_'.$time;
       $config['upload_path'] = 'assets/images/reseller/';
       $config['allowed_types'] = 'jpg|jpeg|png|gif';
       $config['file_name'] = $image_name;
       $filename = $_FILES['reseller_logo']['name'];
       $ext = pathinfo($filename, PATHINFO_EXTENSION);
       $this->upload->initialize($config); // if upload library autoloaded
       if ($this->upload->do_upload('reseller_logo') && $reseller_id && $image_name && $ext && $filename){
         $reseller_logo_up['reseller_logo'] =  base_url().'assets/images/reseller/'.$image_name.'.'.$ext;
         $this->Master_Model->update_info('reseller_id', $reseller_id, 'smm_reseller', $reseller_logo_up);
         // if($_POST['old_reseller_logo']){ unlink("assets/images/reseller/".$_POST['old_reseller_logo']); }
         $this->session->set_flashdata('upload_success','File Uploaded Successfully');
       }
       else{
         $error = $this->upload->display_errors();
         $this->session->set_flashdata('upload_error',$error);
       }
     }
     $this->session->set_flashdata('signup_success','success');
     header('location:'.base_url().'Login');
   }

   $data['web_setting_info'] = $this->Master_Model->get_info_arr_fields3('*', $web_company_id, 'reseller_id', $web_reseller_id, 'web_setting_addedby_type', '2', '', '', 'smm_web_setting');
   $data['web_template_id'] = $web_template_id;

   $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$signup_reseller_id,'smm_reseller');
   if(!$reseller_info){ header('location:'.base_url().''); }
   $data['reseller_info'] = $reseller_info[0];
   $country_id = $reseller_info[0]['country_id'];
   $state_id = $reseller_info[0]['state_id'];
   $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
   $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
   $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');

   $data['page'] = 'Profile-Add';
   $this->load->view('Website/profile_add', $data);
 }

/**************************************************************************************/
/*                                        Buy Package                                 */
/**************************************************************************************/

  public function buy_now($reseller_package_id){
    $web_reseller_id = $this->session->userdata('web_reseller_id');
    $web_company_id = $this->session->userdata('web_company_id');
    $web_template_id = $this->session->userdata('web_template_id');
    if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }

    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if(!$smm_reseller_id || !$smm_res_company_id){ header('location:'.base_url().''); }

    $this->session->set_userdata('buy_reseller_package_id', $reseller_package_id);
    header('location:'.base_url().'Payment');

  }

  // Payment...
  public function payment(){
    $web_reseller_id = $this->session->userdata('web_reseller_id');
    $web_company_id = $this->session->userdata('web_company_id');
    $web_template_id = $this->session->userdata('web_template_id');
    if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }
    $data['web_setting_info'] = $this->Master_Model->get_info_arr_fields3('*', $web_company_id, 'reseller_id', $web_reseller_id, 'web_setting_addedby_type', '2', '', '', 'smm_web_setting');
    $data['web_template_id'] = $web_template_id;

    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if(!$smm_reseller_id || !$smm_res_company_id){ header('location:'.base_url().''); }

    $reseller_package_id = $this->session->userdata('buy_reseller_package_id');
    if($reseller_package_id == ''){ header('location:'.base_url().''); }
    // echo $reseller_package_id;
    $reseller_package_info = $this->Master_Model->get_info_arr('reseller_package_id',$reseller_package_id,'smm_reseller_package');
    if(!$reseller_package_info){ header('location:'.base_url().''); }

    $package_info = $this->Master_Model->get_info_arr('package_id',$reseller_package_info[0]['package_id'],'smm_package');
    if(!$package_info){ header('location:'.base_url().''); }

    $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$smm_reseller_id,'smm_reseller');
    if(!$reseller_info){ header('location:'.base_url().''); }

    $payment_gateway_info = $this->Master_Model->get_info_arr_fields3('payment_gateway_key_id, payment_gateway_secret_key', $smm_res_company_id, 'payment_gateway_is_default', '1', '', '', '', '', 'smm_payment_gateway');
    if(!$payment_gateway_info){ header('location:'.base_url().''); }

    $this->session->set_userdata('order_client_id', $smm_reseller_id);
    $this->session->set_userdata('order_reseller_id', $web_reseller_id);
    $this->session->set_userdata('order_company_id', $smm_res_company_id);

    $gst_slab_id = $package_info[0]['gst_slab_id'];
    $gst_slab_info = $this->Master_Model->get_info_arr_fields3('gst_slab_per', '', 'gst_slab_id', $gst_slab_id, '', '', '', '', 'smm_gst_slab');
    if($gst_slab_info){
     $gst_slab_per = $gst_slab_info[0]['gst_slab_per'];
    } else{
     $gst_slab_per = 0;
    }

    $subtotal = $reseller_package_info[0]['reseller_package_new_price'];
    $package_gst_amt = $subtotal * $gst_slab_per/(100 + $gst_slab_per);
    $package_gst_amt = round($package_gst_amt, 2);
    $package_basic_amt = $subtotal - $package_gst_amt;
    $package_basic_amt = round($package_basic_amt, 2);

    $data['payment_gateway_info'] = $payment_gateway_info[0];
    $data['reseller_info'] = $reseller_info[0];
    $data['reseller_package_info'] = $reseller_package_info[0];
    $data['package_info'] = $package_info[0];
    $data['package_gst_amt'] = $package_gst_amt;
    $data['package_basic_amt'] = $package_basic_amt;
    $data['package_cost'] = $subtotal;

    $data['page'] = 'Payment';
    $this->load->view('Website/payment_details', $data);
  }

  // Payment Success...
  public function payment_success(){
    $order_client_id = $this->session->userdata('order_client_id');
    $order_reseller_id = $this->session->userdata('order_reseller_id');
    $order_company_id = $this->session->userdata('order_company_id');

    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_order_id = $_POST['razorpay_order_id'];

    if(!$order_reseller_id || !$order_company_id || !$order_client_id){ header('location:'.base_url().''); }

    $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$order_client_id,'smm_reseller');

    $reseller_package_id = $this->session->userdata('buy_reseller_package_id');
    $reseller_package_info = $this->Master_Model->get_info_arr('reseller_package_id',$reseller_package_id,'smm_reseller_package');

    $package_info = $this->Master_Model->get_info_arr('package_id',$reseller_package_info[0]['package_id'],'smm_package');

    $gst_slab_id = $package_info[0]['gst_slab_id'];
    $gst_slab_info = $this->Master_Model->get_info_arr_fields3('gst_slab_per', '', 'gst_slab_id', $gst_slab_id, '', '', '', '', 'smm_gst_slab');
    if($gst_slab_info){
     $gst_slab_per = $gst_slab_info[0]['gst_slab_per'];
    } else{
     $gst_slab_per = 0;
    }

    $subtotal = $reseller_package_info[0]['reseller_package_new_price'];
    $package_gst_amt = $subtotal * $gst_slab_per/(100 + $gst_slab_per);
    $package_gst_amt = round($package_gst_amt, 2);
    $package_basic_amt = $subtotal - $package_gst_amt;
    $package_basic_amt = round($package_basic_amt, 2);

    $order_no = $this->Master_Model->get_count_no3($order_company_id, 'order_no', 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_order');

    $order_data = array(
      'razorpay_payment_id' => $razorpay_payment_id,
      'razorpay_order_id' => $razorpay_order_id,
      'order_date' => date('d-m-Y'),
      'order_no' => $order_no,
      'client_id' => $order_client_id,
      'reseller_id' => $order_reseller_id,
      'company_id' => $order_company_id,
      'order_client_name' => $reseller_info[0]['reseller_name'],
      'order_client_address' => $reseller_info[0]['reseller_address'],
      'country_id' => $reseller_info[0]['country_id'],
      'state_id' => $reseller_info[0]['state_id'],
      'city_id' => $reseller_info[0]['city_id'],
      'order_client_mobile' => $reseller_info[0]['reseller_mobile'],
      'order_client_email' => $reseller_info[0]['reseller_email'],
      'order_basic_amount' => $package_basic_amt,
      'order_gst_amount' => $package_gst_amt,
      'order_net_amount' => $subtotal,
      'order_status' => '1',
      'payment_status' => '1',
      'order_addedby' => $order_client_id,
      'package_id' => $reseller_package_info[0]['package_id'],
      'reseller_package_id' => $reseller_package_info[0]['reseller_package_id'],
      'package_name' => $package_info[0]['package_name'],
      'gst_slab_per' => $gst_slab_per,
    );
    $order_id = $this->Master_Model->save_data('smm_order', $order_data);

    $invoice_no = $this->Master_Model->get_count_no3($order_company_id, 'invoice_no', 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_invoice');
    $invoice_data = array(
      'invoice_date' => date('d-m-Y'),
      'invoice_no' => $invoice_no,
      'client_id' => $order_client_id,
      'reseller_id' => $order_reseller_id,
      'company_id' => $order_company_id,
      'order_id' => $order_id,
      'package_id' => $reseller_package_info[0]['package_id'],
      'reseller_package_id' => $reseller_package_info[0]['reseller_package_id'],
      'package_name' => $package_info[0]['package_name'],
      'invoice_client_name' => $reseller_info[0]['reseller_name'],
      'invoice_client_address' => $reseller_info[0]['reseller_address'],
      'country_id' => $reseller_info[0]['country_id'],
      'state_id' => $reseller_info[0]['state_id'],
      'city_id' => $reseller_info[0]['city_id'],
      'invoice_client_mobile' => $reseller_info[0]['reseller_mobile'],
      'invoice_client_email' => $reseller_info[0]['reseller_email'],
      'gst_slab_per' => $gst_slab_per,
      'invoice_basic_amt' => $package_basic_amt,
      'invoice_gst_amt' => $package_gst_amt,
      'invoice_net_amt' => $subtotal,
      'invoice_addedby_type' => '3',
    );
    $invoice_id = $this->Master_Model->save_data('smm_invoice', $invoice_data);

    $reseller_added_type = $reseller_info[0]['reseller_added_type'];
    $order_reseller_id = $order_reseller_id;
    $order_company_id = $order_company_id;
    $package_id = $reseller_package_info[0]['package_id'];
    $cnt = 0;
    while($reseller_added_type == '2'){
      $client_reseller_id = $order_reseller_id;
      $reseller_info = $this->Master_Model->get_info_arr_fields3('*', $order_company_id, 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_reseller');

      $order_reseller_id = $reseller_info[0]['reseller_addedby'];
      if($reseller_info[0]['reseller_added_type'] == 1){
        $order_reseller_id = '0';
      }

      $reseller_package_info = $this->Master_Model->get_info_arr_fields3('reseller_package_prev_price, reseller_package_new_price, package_id, reseller_package_id', '', 'package_id', $package_id, 'reseller_id', $client_reseller_id, '', '', 'smm_reseller_package');
      $subtotal = $reseller_package_info[0]['reseller_package_prev_price'];
      $package_gst_amt = $subtotal * $gst_slab_per/(100 + $gst_slab_per);
      $package_gst_amt = round($package_gst_amt, 2);
      $package_basic_amt = $subtotal - $package_gst_amt;
      $package_basic_amt = round($package_basic_amt, 2);

      $commission = $reseller_package_info[0]['reseller_package_new_price'] - $reseller_package_info[0]['reseller_package_prev_price'];
      if($cnt == 0){ $commission_type = '1'; }
      else{ $commission_type = '2'; }
      $commission_data = array(
        'company_id' => $order_company_id,
        'commission_date' => date('d-m-Y'),
        'invoice_id' => $invoice_id,
        'reseller_id' => $client_reseller_id,
        'commission_amount' => $commission,
        'commission_type' => $commission_type,
      );
      $commission_id = $this->Master_Model->save_data('smm_commission', $commission_data);

      $invoice_no = $this->Master_Model->get_count_no3($order_company_id, 'invoice_no', 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_invoice');
      $invoice_data = array(
        'invoice_date' => date('d-m-Y'),
        'invoice_no' => $invoice_no,
        'client_id' => $client_reseller_id,
        'reseller_id' => $order_reseller_id,
        'company_id' => $order_company_id,
        'order_id' => '0',
        'package_id' => $reseller_package_info[0]['package_id'],
        'reseller_package_id' => $reseller_package_info[0]['reseller_package_id'],
        'package_name' => $package_info[0]['package_name'],
        'invoice_client_name' => $reseller_info[0]['reseller_name'],
        'invoice_client_address' => $reseller_info[0]['reseller_address'],
        'country_id' => $reseller_info[0]['country_id'],
        'state_id' => $reseller_info[0]['state_id'],
        'city_id' => $reseller_info[0]['city_id'],
        'invoice_client_mobile' => $reseller_info[0]['reseller_mobile'],
        'invoice_client_email' => $reseller_info[0]['reseller_email'],
        'gst_slab_per' => $gst_slab_per,
        'invoice_basic_amt' => $package_basic_amt,
        'invoice_gst_amt' => $package_gst_amt,
        'invoice_net_amt' => $subtotal,
        'invoice_addedby_type' => '4',
      );
      $invoice_id = $this->Master_Model->save_data('smm_invoice', $invoice_data);

      $reseller_added_type = $reseller_info[0]['reseller_added_type'];
      $order_reseller_id = $reseller_info[0]['reseller_addedby'];
      $cnt++;
    }

    $this->session->set_flashdata('save_success','success');
    header('location:'.base_url().'Payment-Success');
  }

  public function payment_success_msg(){
    $this->session->unset_userdata('order_client_id');
    $this->session->unset_userdata('order_reseller_id');
    $this->session->unset_userdata('order_company_id');
    $this->session->unset_userdata('buy_reseller_package_id');
    // $this->cart->destroy();

    $web_reseller_id = $this->session->userdata('web_reseller_id');
    $web_company_id = $this->session->userdata('web_company_id');
    $web_template_id = $this->session->userdata('web_template_id');
    if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }
    $data['web_setting_info'] = $this->Master_Model->get_info_arr_fields3('*', $web_company_id, 'reseller_id', $web_reseller_id, 'web_setting_addedby_type', '2', '', '', 'smm_web_setting');
    $data['web_template_id'] = $web_template_id;

    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if(!$smm_reseller_id || !$smm_res_company_id){ header('location:'.base_url().''); }

    $data['page'] = 'Payment-Success';
    $this->load->view('Website/payment_success', $data);
  }

/******************************************************************************/
  // public function cart(){
  //   $web_reseller_id = $this->session->userdata('web_reseller_id');
  //   $web_company_id = $this->session->userdata('web_company_id');
  //   $web_template_id = $this->session->userdata('web_template_id');
  //   if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }
  //   $data['web_setting_info'] = $this->Master_Model->get_info_arr_fields3('*', $web_company_id, 'reseller_id', $web_reseller_id, 'web_setting_addedby_type', '2', '', '', 'smm_web_setting');
  //   $data['web_template_id'] = $web_template_id;
  //
  //   $smm_reseller_id = $this->session->userdata('smm_reseller_id');
  //   $smm_res_company_id = $this->session->userdata('smm_res_company_id');
  //   if(!$smm_reseller_id || !$smm_res_company_id){ header('location:'.base_url().''); }
  //
  //   $row_count = count($this->cart->contents());
  //   if($row_count <= 0){ header('location:'.base_url().''); }
  //   $data['page'] = 'Cart';
  //   $this->load->view('Website/cart', $data);
  // }







/****************************************** Payment ***********************************/
// Payment details & Make Payment...
  // public function payment_details(){
  //   $web_reseller_id = $this->session->userdata('web_reseller_id');
  //   $web_company_id = $this->session->userdata('web_company_id');
  //   $web_template_id = $this->session->userdata('web_template_id');
  //   if(!$web_reseller_id || !$web_company_id || !$web_template_id){ header('location:'.base_url().''); }
  //   $data['web_setting_info'] = $this->Master_Model->get_info_arr_fields3('*', $web_company_id, 'reseller_id', $web_reseller_id, 'web_setting_addedby_type', '2', '', '', 'smm_web_setting');
  //   $data['web_template_id'] = $web_template_id;
  //
  //   $smm_reseller_id = $this->session->userdata('smm_reseller_id');
  //   $smm_res_company_id = $this->session->userdata('smm_res_company_id');
  //   if(!$smm_reseller_id || !$smm_res_company_id){ header('location:'.base_url().''); }
  //
  //   $row_count = count($this->cart->contents());
  //   if($row_count <= 0){ header('location:'.base_url().''); }
  //
  //   $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$smm_reseller_id,'smm_reseller');
  //   if(!$reseller_info){ header('location:'.base_url().''); }
  //   $data['reseller_info'] = $reseller_info[0];
  //
  //   $payment_gateway_info = $this->Master_Model->get_info_arr_fields3('payment_gateway_key_id, payment_gateway_secret_key', $smm_res_company_id, 'payment_gateway_is_default', '1', '', '', '', '', 'smm_payment_gateway');
  //   if(!$payment_gateway_info){ header('location:'.base_url().''); }
  //   $data['payment_gateway_info'] = $payment_gateway_info[0];
  //
  //   $this->session->set_userdata('order_client_id', $smm_reseller_id);
  //   $this->session->set_userdata('order_reseller_id', $web_reseller_id);
  //   $this->session->set_userdata('order_company_id', $smm_res_company_id);
  //
  //   $final_payment_amt = $this->cart->total();
  //   if(!$final_payment_amt){ header('location:'.base_url().''); }
  //
  //   $data['page'] = 'Payment-Details';
  //   $this->load->view('Website/payment_details', $data);
  // }

  // // Payment Success...
  // public function payment_success(){
  //   $order_client_id = $this->session->userdata('order_client_id');
  //
  //   $order_reseller_id = $this->session->userdata('order_reseller_id');
  //   $order_company_id = $this->session->userdata('order_company_id');
  //   if(!$order_reseller_id || !$order_company_id || !$order_client_id){ header('location:'.base_url().''); }
  //
  //   $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$order_client_id,'smm_reseller');
  //
  //   $total_gst = 0;
  //   $total_basic = 0;
  //   foreach ($this->cart->contents() as $items) {
  //     $total_basic = $total_basic + $items['package_basic_amt'];
  //     $total_gst = $total_gst + $items['package_gst_amt'];
  //   }
  //   $final_payment_amt = $this->cart->total();
  //
  //   $order_data = array(
  //     'order_date' => date('d-m-Y'),
  //     'client_id' => $order_client_id,
  //     'reseller_id' => $order_reseller_id,
  //     'company_id' => $order_company_id,
  //     'order_client_name' => $reseller_info[0]['reseller_name'],
  //     'order_client_address' => $reseller_info[0]['reseller_address'],
  //     'country_id' => $reseller_info[0]['country_id'],
  //     'state_id' => $reseller_info[0]['state_id'],
  //     'city_id' => $reseller_info[0]['city_id'],
  //     'order_client_mobile' => $reseller_info[0]['reseller_mobile'],
  //     'order_client_email' => $reseller_info[0]['reseller_email'],
  //     'order_basic_amount' => $total_basic,
  //     'order_gst_amount' => $total_gst,
  //     'order_net_amount' => $final_payment_amt,
  //     'order_status' => '1',
  //     'payment_status' => '1',
  //     'oredr_addedby' => $order_client_id,
  //   );
  //   $order_id = $this->Master_Model->save_data('smm_order', $order_data);
  //
  //   foreach ($this->cart->contents() as $items) {
  //     $save_pro_data['order_id'] = $order_id;
  //     $save_pro_data['client_id'] = $order_client_id;
  //     $save_pro_data['package_id'] = $items['package_id'];
  //     $save_pro_data['reseller_package_id'] = $items['id'];
  //     $save_pro_data['package_name'] = $items['name'];
  //     $save_pro_data['package_qty'] = $items['qty'];
  //     $save_pro_data['package_price'] = $items['price'];
  //     $save_pro_data['gst_slab_per'] = $items['gst_slab_per'];
  //     $save_pro_data['item_basic_amount'] = $items['package_basic_amt'];
  //     $save_pro_data['item_gst_amount'] = $items['package_gst_amt'];
  //     $save_pro_data['item_net_amount'] = $items['subtotal'];
  //
  //     $this->Master_Model->save_data('smm_order_item', $save_pro_data);
  //   }
  //
  //   $reseller_added_type = $reseller_info[0]['reseller_added_type'];
  //   $order_reseller_id = $this->session->userdata('order_reseller_id');
  //   while($reseller_added_type == 2){
  //     $client_reseller_id = $order_reseller_id;
  //     echo $client_reseller_id.' ';
  //
  //     // Main Code Here......
  //
  //
  //
  //     $reseller_info = $this->Master_Model->get_info_arr_fields3('*', $order_company_id, 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_reseller');
  //     $reseller_added_type = $reseller_info[0]['reseller_added_type'];
  //     $order_reseller_id = $reseller_info[0]['reseller_addedby'];
  //
  //
  //     // get_info_arr('reseller_id',$order_client_id,'smm_reseller');
  //   }
  //
  //   $this->session->set_flashdata('save_success','success');
  //   header('location:'.base_url().'Payment-Success');
  // }

  public function check_loop(){
    $reseller_added_type = '2';
    $order_reseller_id = '3';
    $order_company_id = '1';
    while($reseller_added_type == '2'){

      $client_reseller_id = $order_reseller_id;
      echo $client_reseller_id.' <br>';

      // Main Code Here......
      $reseller_info = $this->Master_Model->get_info_arr_fields3('*', $order_company_id, 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_reseller');
      $reseller_added_type = $reseller_info[0]['reseller_added_type'];
      $order_reseller_id = $reseller_info[0]['reseller_addedby'];
      // get_info_arr('reseller_id',$order_client_id,'smm_reseller');
    }
  }





 // public function login1(){
 //  $this->load->view('Website/login1');
 // }
 //
 // public function signup1(){
 //  $this->load->view('Website/signup1');
 // }
 // public function home1(){
 //  $this->load->view('Website/home1');
 // }
 // public function home2(){
 //  $this->load->view('Website/home2');
 // }
 //
 // public function login2(){
 //  $this->load->view('Website/login2');
 // }
 //
 // public function signup2(){
 //  $this->load->view('Website/signup2');
 // }
 //
 // public function home3(){
 //  $this->load->view('Website/home3');
 // }
 //
 // public function login3(){
 //  $this->load->view('Website/login3');
 // }
 //
 // public function signup3(){
 //  $this->load->view('Website/signup3');
 // }


}
?>
