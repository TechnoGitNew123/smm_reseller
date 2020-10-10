<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_Payment extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }


  /************************************* Package Details ************************************/
    public function package_payment($package_id){
      unset($_SESSION['coupon_code']);
      $smm_reseller_id = $this->session->userdata('smm_reseller_id');
      $smm_res_company_id = $this->session->userdata('smm_res_company_id');
      if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

      $this->session->set_userdata('buy_package_id', $package_id);

      if($this->session->userdata('smm_addedby_type') == 1){
        $package_details = $this->Master_Model->get_info_arr_fields3('*', $smm_res_company_id, 'package_id', $package_id, '', '', '', '', 'smm_package');
        if(!$package_details){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }

        $data['package_name'] = $package_details[0]['package_name'];
        $package_cost = $package_details[0]['package_cost'];
        $data['package_per_duration'] = $package_details[0]['package_per_duration'];

      } else{
        $smm_addedby = $this->session->userdata('smm_addedby');
        $package_details = $this->Reseller_Model->reseller_package_details($smm_res_company_id,$smm_addedby,$package_id);
        if(!$package_details){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }
        $package_cost = $package_details[0]['reseller_package_new_price'];
      }

      $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$smm_reseller_id,'smm_reseller');
      if(!$reseller_info){ header('location:'.base_url().''); }

      $payment_gateway_info = $this->Master_Model->get_info_arr_fields3('payment_gateway_key_id, payment_gateway_secret_key', $smm_res_company_id, 'payment_gateway_is_default', '1', '', '', '', '', 'smm_payment_gateway');
      if(!$payment_gateway_info){ header('location:'.base_url().''); }

      $gst_slab_id = $package_details[0]['gst_slab_id'];
      $gst_slab_info = $this->Master_Model->get_info_arr_fields3('gst_slab_per', '', 'gst_slab_id', $gst_slab_id, '', '', '', '', 'smm_gst_slab');
      if($gst_slab_info){
       $gst_slab_per = $gst_slab_info[0]['gst_slab_per'];
      } else{
       $gst_slab_per = 0;
      }
      $subtotal = $package_cost;
      $package_gst_amt = $subtotal * $gst_slab_per/(100 + $gst_slab_per);
      $package_gst_amt = round($package_gst_amt, 2);
      $package_basic_amt = $subtotal - $package_gst_amt;
      $package_basic_amt = round($package_basic_amt, 2);

      $package_feature_list = $this->Master_Model->get_list_by_id3('','package_id',$package_id,'','','','','package_feature_id','ASC','smm_package_feature');


      $this->form_validation->set_rules('coupon_code', 'Coupon Code', 'trim|required');
      if ($this->form_validation->run() != FALSE) {
        if(isset($smm_addedby)){
          $coupon_code = $_POST['coupon_code'];
          $coupon_details = $this->Master_Model->get_info_arr_fields3('*', $smm_res_company_id, 'reseller_id', $smm_addedby, 'package_id', $package_id, 'reseller_coupon_code', $coupon_code, 'smm_reseller_coupon');
          if($coupon_details){
            $data['coupon_applied'] = 'Yes';
            $coupon_amount = $coupon_details[0]['reseller_coupon_amt'];
            $data['coupon_discount_amount'] = $coupon_amount;
            unset($_SESSION['invalid_coupon']);
            $this->session->set_flashdata('valid_coupon','success');
            $this->session->set_userdata('coupon_code',$coupon_code);
          } else{
            unset($_SESSION['valid_coupon']);
            unset($_SESSION['coupon_code']);
            $this->session->set_flashdata('invalid_coupon','error');
          }
        }
      }

      $data['package_name'] = $package_details[0]['package_name'];
      $data['package_per_duration'] = $package_details[0]['package_per_duration'];
      $data['package_cost'] = $subtotal;
      $data['package_gst_amt'] = $package_gst_amt;
      $data['package_basic_amt'] = $package_basic_amt;
      $data['reseller_info'] = $reseller_info[0];

      $data['payment_gateway_info'] = $payment_gateway_info[0];
      $data['package_feature_list'] = $package_feature_list;

      $data['page'] = 'Packages Payment';
      $data['title'] = 'Buy Package';
      $data['payment_for'] = 'buy';
      $this->load->view('Reseller/Include/head', $data);
      $this->load->view('Reseller/Include/navbar', $data);
      $this->load->view('Reseller/Res_Package/package_payment', $data);
      $this->load->view('Reseller/Include/footer', $data);
    }

// Payment Success...
  public function payment_success(){
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_order_id = $_POST['razorpay_order_id'];
    $package_id = $this->session->userdata('buy_package_id');
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $order_client_id = $smm_reseller_id;
    $order_company_id = $smm_res_company_id;

    if(!$razorpay_payment_id){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }

    $package_info = $this->Master_Model->get_info_arr('package_id',$package_id,'smm_package');

    $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$order_client_id,'smm_reseller');
    $order_reseller_id = $reseller_info[0]['reseller_addedby'];
    if($reseller_info[0]['reseller_added_type'] == 1){
      $order_reseller_id = '0';
      $reseller_invoice_prefix = "INV-";
      $package_cost = $package_info[0]['package_cost'];
      $reseller_package_id = '0';
    } else{
      $reseller_info_seller = $this->Master_Model->get_info_arr_fields3('reseller_invoice_prefix', $order_company_id, 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_reseller');
      $reseller_invoice_prefix = $reseller_info_seller[0]['reseller_invoice_prefix'];
      $reseller_package_info = $this->Master_Model->get_info_arr_fields3('*', '', 'package_id', $package_id, 'reseller_id', $order_reseller_id, '', '', 'smm_reseller_package');
      $package_cost = $reseller_package_info[0]['reseller_package_new_price'];
      $reseller_package_id = $reseller_package_info[0]['reseller_package_id'];;
    }

    if(!$order_reseller_id || !$order_company_id || !$order_client_id){ header('location:'.base_url().''); }
    if(!$razorpay_payment_id){ header('location:'.base_url().''); }

    $gst_slab_id = $package_info[0]['gst_slab_id'];
    $gst_slab_info = $this->Master_Model->get_info_arr_fields3('gst_slab_per', '', 'gst_slab_id', $gst_slab_id, '', '', '', '', 'smm_gst_slab');
    if($gst_slab_info){
     $gst_slab_per = $gst_slab_info[0]['gst_slab_per'];
    } else{
     $gst_slab_per = 0;
    }

    $subtotal = $package_cost;
    $package_gst_amt = $subtotal * $gst_slab_per/(100 + $gst_slab_per);
    $package_gst_amt = round($package_gst_amt, 2);
    $package_basic_amt = $subtotal - $package_gst_amt;
    $package_basic_amt = round($package_basic_amt, 2);

    $start_date = date('d-m-Y');

    $new_start_date = strtotime($start_date);
    $end_date = strtotime("+".$package_info[0]['package_per_duration']." day", $new_start_date);
    $end_date = date('d-m-Y', $end_date);

    // Check Coupon... If Used...
    $coupon_code = $this->session->userdata('coupon_code');
    if($coupon_code){
      $coupon_details = $this->Master_Model->get_info_arr_fields3('*', $smm_res_company_id, 'reseller_id', $order_reseller_id, 'package_id', $package_id, 'reseller_coupon_code', $coupon_code, 'smm_reseller_coupon');
      if($coupon_details){
        $coupon_applied = 'Yes';
        $coupon_amount = $coupon_details[0]['reseller_coupon_amt'];
        $subtotal = $package_cost - $coupon_amount;
      } else{
        $coupon_applied = 'No';
        $coupon_amount = 0;
      }
    } else{
      $coupon_applied = 'No';
      $coupon_amount = 0;
    }


    $order_no = $this->Master_Model->get_count_no3($order_company_id, 'order_no', 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_order');
    $order_data = array(
      'razorpay_payment_id' => $razorpay_payment_id,
      'razorpay_order_id' => $razorpay_order_id,
      'order_date' => date('d-m-Y'),
      'order_start_date' => $start_date,
      'order_end_date' => $end_date,
      'order_no' => $order_no,
      'client_id' => $order_client_id,
      'reseller_id' => $order_reseller_id,
      'company_id' => $order_company_id,
      'order_client_name' => $reseller_info[0]['reseller_name'],
      'order_client_address' => $reseller_info[0]['reseller_address'],
      'order_client_pincode' => $reseller_info[0]['reseller_pincode'],
      'country_id' => $reseller_info[0]['country_id'],
      'state_id' => $reseller_info[0]['state_id'],
      'city_id' => $reseller_info[0]['city_id'],
      'order_client_mobile' => $reseller_info[0]['reseller_mobile'],
      'order_client_email' => $reseller_info[0]['reseller_email'],
      'order_basic_amount' => $package_basic_amt,
      'order_gst_amount' => $package_gst_amt,
      'order_net_amount' => $subtotal,
      'coupon_discount_amount' => $coupon_amount,
      'order_status' => '1',
      'payment_status' => '1',
      'order_addedby' => $order_client_id,
      'package_id' => $package_id,
      'reseller_package_id' => $reseller_package_id,
      'package_name' => $package_info[0]['package_name'],
      'gst_slab_per' => $gst_slab_per,
    );
    $order_id = $this->Master_Model->save_data('smm_order', $order_data);

    $invoice_no = $this->Master_Model->get_count_no3($order_company_id, 'invoice_no', 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_invoice');
    $invoice_data = array(
      'razorpay_payment_id' => $razorpay_payment_id,
      'razorpay_order_id' => $razorpay_order_id,
      'invoice_date' => date('d-m-Y'),
      'invoice_start_date' => $start_date,
      'invoice_end_date' => $end_date,
      'invoice_no' => $invoice_no,
      'invoice_no_prefix' => $reseller_invoice_prefix,
      'client_id' => $order_client_id,
      'reseller_id' => $order_reseller_id,
      'company_id' => $order_company_id,
      'order_id' => $order_id,
      'package_id' => $package_id,
      'reseller_package_id' => $reseller_package_id,
      'package_name' => $package_info[0]['package_name'],
      'invoice_client_name' => $reseller_info[0]['reseller_name'],
      'invoice_client_address' => $reseller_info[0]['reseller_address'],
      'invoice_client_pincode' => $reseller_info[0]['reseller_pincode'],
      'country_id' => $reseller_info[0]['country_id'],
      'state_id' => $reseller_info[0]['state_id'],
      'city_id' => $reseller_info[0]['city_id'],
      'invoice_client_mobile' => $reseller_info[0]['reseller_mobile'],
      'invoice_client_email' => $reseller_info[0]['reseller_email'],
      'invoice_client_gstin' => $reseller_info[0]['reseller_gst_no'],
      'invoice_client_statecode' => $reseller_info[0]['reseller_statecode'],
      'gst_slab_per' => $gst_slab_per,
      'invoice_basic_amt' => $package_basic_amt,
      'invoice_gst_amt' => $package_gst_amt,
      'invoice_net_amt' => $subtotal,
      'coupon_discount_amount' => $coupon_amount,
      'invoice_addedby_type' => '3',
      'invoice_type' => '1',
      'ref_order_id' => $order_id,
    );
    $invoice_id = $this->Master_Model->save_data('smm_invoice', $invoice_data);

    // Save Coupon.... If Used.......
    if($coupon_applied == 'Yes'){
      $reseller_coupon_id = '0';
      if($coupon_details){ $reseller_coupon_id = $coupon_details[0]['reseller_coupon_id']; }
      $coupon_save_data = array(
        'company_id' => $order_company_id,
        'order_id' => $order_id,
        'package_id' => $package_id,
        'client_id' => $order_client_id,
        'reseller_id' => $order_reseller_id,
        'net_amount' => $package_cost,
        'discount_amount' => $coupon_amount,
        'coupon_code' => $coupon_code,
        'reseller_coupon_id' => $reseller_coupon_id,
        'invoice_id' => $invoice_id,
      );
      $res_coupon_used_id = $this->Master_Model->save_data('smm_res_coupon_used', $coupon_save_data);
    }

    $reseller_added_type = $reseller_info[0]['reseller_added_type'];
    $order_reseller_id = $order_reseller_id;
    $order_company_id = $order_company_id;
    $package_id = $reseller_package_info[0]['package_id'];
    $cnt = 0;

    while($reseller_added_type == '2'){
      $client_reseller_id = $order_reseller_id;
      $reseller_info = $this->Master_Model->get_info_arr_fields3('*', $order_company_id, 'reseller_id', $client_reseller_id, '', '', '', '', 'smm_reseller');

      $order_reseller_id = $reseller_info[0]['reseller_addedby'];
      if($reseller_info[0]['reseller_added_type'] == 1){
        $order_reseller_id = '0';
        $reseller_invoice_prefix = "INV-";
      } else{
        $reseller_info_seller = $this->Master_Model->get_info_arr_fields3('reseller_invoice_prefix', $order_company_id, 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_reseller');
        $reseller_invoice_prefix = $reseller_info_seller[0]['reseller_invoice_prefix'];
      }

      $reseller_package_info = $this->Master_Model->get_info_arr_fields3('reseller_package_prev_price, reseller_package_new_price, package_id, reseller_package_id', '', 'package_id', $package_id, 'reseller_id', $client_reseller_id, '', '', 'smm_reseller_package');
      $subtotal = $reseller_package_info[0]['reseller_package_prev_price'];
      $package_gst_amt = $subtotal * $gst_slab_per/(100 + $gst_slab_per);
      $package_gst_amt = round($package_gst_amt, 2);
      $package_basic_amt = $subtotal - $package_gst_amt;
      $package_basic_amt = round($package_basic_amt, 2);

      $commission = $reseller_package_info[0]['reseller_package_new_price'] - $reseller_package_info[0]['reseller_package_prev_price'];
      if($cnt == 0){
        $commission_type = '1';
        $commission = $commission - $coupon_amount;
      }
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
        'invoice_start_date' => $start_date,
        'invoice_end_date' => $end_date,
        'invoice_no' => $invoice_no,
        'invoice_no_prefix' => $reseller_invoice_prefix,
        'client_id' => $client_reseller_id,
        'reseller_id' => $order_reseller_id,
        'company_id' => $order_company_id,
        'order_id' => '0',
        'package_id' => $reseller_package_info[0]['package_id'],
        'reseller_package_id' => $reseller_package_info[0]['reseller_package_id'],
        'package_name' => $package_info[0]['package_name'],
        'invoice_client_name' => $reseller_info[0]['reseller_name'],
        'invoice_client_address' => $reseller_info[0]['reseller_address'],
        'invoice_client_pincode' => $reseller_info[0]['reseller_pincode'],
        'country_id' => $reseller_info[0]['country_id'],
        'state_id' => $reseller_info[0]['state_id'],
        'city_id' => $reseller_info[0]['city_id'],
        'invoice_client_mobile' => $reseller_info[0]['reseller_mobile'],
        'invoice_client_email' => $reseller_info[0]['reseller_email'],
        'invoice_client_gstin' => $reseller_info[0]['reseller_gst_no'],
        'invoice_client_statecode' => $reseller_info[0]['reseller_statecode'],
        'gst_slab_per' => $gst_slab_per,
        'invoice_basic_amt' => $package_basic_amt,
        'invoice_gst_amt' => $package_gst_amt,
        'invoice_net_amt' => $subtotal,
        'invoice_addedby_type' => '4',
        'invoice_type' => '1',
        'ref_order_id' => $order_id,
      );
      $invoice_id = $this->Master_Model->save_data('smm_invoice', $invoice_data);

      $reseller_added_type = $reseller_info[0]['reseller_added_type'];
      $order_reseller_id = $reseller_info[0]['reseller_addedby'];
      $cnt++;
    }

    $this->session->set_flashdata('save_success','success');
    header('location:'.base_url().'Reseller/Res_Payment/payment_success_msg');
  }

/************************************ Renew Package *******************************/

  // Renew Package Details
  public function renew_package_payment($order_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $order_info = $this->Master_Model->get_info_arr_fields3('package_id', $smm_res_company_id, 'order_id', $order_id, 'client_id', $smm_reseller_id, '', '', 'smm_order');
    if(!$order_info){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }

    $package_id = $order_info[0]['package_id'];
    $this->session->set_userdata('renew_order_id', $order_id);
    $this->session->set_userdata('buy_package_id', $package_id);

    if($this->session->userdata('smm_addedby_type') == 1){
      $package_details = $this->Master_Model->get_info_arr_fields3('*', $smm_res_company_id, 'package_id', $package_id, '', '', '', '', 'smm_package');
      if(!$package_details){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }

      $data['package_name'] = $package_details[0]['package_name'];
      $package_cost = $package_details[0]['package_cost'];
      $data['package_per_duration'] = $package_details[0]['package_per_duration'];

    } else{
      $smm_addedby = $this->session->userdata('smm_addedby');
      $package_details = $this->Reseller_Model->reseller_package_details($smm_res_company_id,$smm_addedby,$package_id);
      if(!$package_details){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }
      $package_cost = $package_details[0]['reseller_package_new_price'];
    }

    $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$smm_reseller_id,'smm_reseller');
    if(!$reseller_info){ header('location:'.base_url().''); }

    $payment_gateway_info = $this->Master_Model->get_info_arr_fields3('payment_gateway_key_id, payment_gateway_secret_key', $smm_res_company_id, 'payment_gateway_is_default', '1', '', '', '', '', 'smm_payment_gateway');
    if(!$payment_gateway_info){ header('location:'.base_url().''); }

    $gst_slab_id = $package_details[0]['gst_slab_id'];
    $gst_slab_info = $this->Master_Model->get_info_arr_fields3('gst_slab_per', '', 'gst_slab_id', $gst_slab_id, '', '', '', '', 'smm_gst_slab');
    if($gst_slab_info){
     $gst_slab_per = $gst_slab_info[0]['gst_slab_per'];
    } else{
     $gst_slab_per = 0;
    }
    $subtotal = $package_cost;
    $package_gst_amt = $subtotal * $gst_slab_per/(100 + $gst_slab_per);
    $package_gst_amt = round($package_gst_amt, 2);
    $package_basic_amt = $subtotal - $package_gst_amt;
    $package_basic_amt = round($package_basic_amt, 2);

    $package_feature_list = $this->Master_Model->get_list_by_id3('','package_id',$package_id,'','','','','package_feature_id','ASC','smm_package_feature');

    $data['package_name'] = $package_details[0]['package_name'];
    $data['package_per_duration'] = $package_details[0]['package_per_duration'];
    $data['package_cost'] = $subtotal;
    $data['package_gst_amt'] = $package_gst_amt;
    $data['package_basic_amt'] = $package_basic_amt;
    $data['reseller_info'] = $reseller_info[0];

    $data['payment_gateway_info'] = $payment_gateway_info[0];
    $data['package_feature_list'] = $package_feature_list;

    $data['page'] = 'Packages Payment';
    $data['title'] = 'Renew Package';
    $data['payment_for'] = 'renew';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Package/package_payment', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }


// Payment Renew Success...
  public function payment_renew_success(){
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_order_id = $_POST['razorpay_order_id'];
    $order_id = $this->session->userdata('renew_order_id');
    $package_id = $this->session->userdata('buy_package_id');
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    $order_client_id = $smm_reseller_id;
    $order_company_id = $smm_res_company_id;

    if(!$razorpay_payment_id){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }

    $package_info = $this->Master_Model->get_info_arr('package_id',$package_id,'smm_package');

    $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$order_client_id,'smm_reseller');
    $order_reseller_id = $reseller_info[0]['reseller_addedby'];
    if($reseller_info[0]['reseller_added_type'] == 1){
      $order_reseller_id = '0';
      $reseller_invoice_prefix = "INV-";
      $package_cost = $package_info[0]['package_cost'];
      $reseller_package_id = '0';
    } else{
      $reseller_info_seller = $this->Master_Model->get_info_arr_fields3('reseller_invoice_prefix', $order_company_id, 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_reseller');
      $reseller_invoice_prefix = $reseller_info_seller[0]['reseller_invoice_prefix'];
      $reseller_package_info = $this->Master_Model->get_info_arr_fields3('*', '', 'package_id', $package_id, 'reseller_id', $order_reseller_id, '', '', 'smm_reseller_package');
      $package_cost = $reseller_package_info[0]['reseller_package_new_price'];
      $reseller_package_id = $reseller_package_info[0]['reseller_package_id'];;
    }

    if(!$order_reseller_id || !$order_company_id || !$order_client_id){ header('location:'.base_url().''); }
    if(!$razorpay_payment_id){ header('location:'.base_url().''); }

    $gst_slab_id = $package_info[0]['gst_slab_id'];
    $gst_slab_info = $this->Master_Model->get_info_arr_fields3('gst_slab_per', '', 'gst_slab_id', $gst_slab_id, '', '', '', '', 'smm_gst_slab');
    if($gst_slab_info){
     $gst_slab_per = $gst_slab_info[0]['gst_slab_per'];
    } else{
     $gst_slab_per = 0;
    }

    $subtotal = $package_cost;
    $package_gst_amt = $subtotal * $gst_slab_per/(100 + $gst_slab_per);
    $package_gst_amt = round($package_gst_amt, 2);
    $package_basic_amt = $subtotal - $package_gst_amt;
    $package_basic_amt = round($package_basic_amt, 2);

    $order_info = $this->Master_Model->get_info_arr_fields3('package_id, order_end_date', $smm_res_company_id, 'order_id', $order_id, '', '', '', '', 'smm_order');

    $start_date = $order_info[0]['order_end_date'];
    $start_date = strtotime($start_date);
    $start_date = strtotime("+1 day", $start_date);
    $start_date = date('d-m-Y', $start_date);

    $new_start_date = strtotime($start_date);
    $end_date = strtotime("+".$package_info[0]['package_per_duration']." day", $new_start_date);
    $end_date = date('d-m-Y', $end_date);

    // $order_no = $this->Master_Model->get_count_no3($order_company_id, 'order_no', 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_order');
    $order_update_data = array(
      'razorpay_payment_id' => $razorpay_payment_id,
      'razorpay_order_id' => $razorpay_order_id,
      // 'order_date' => date('d-m-Y'),
      'order_start_date' => $start_date,
      'order_end_date' => $end_date,
      // 'order_no' => $order_no,
      // 'client_id' => $order_client_id,
      // 'reseller_id' => $order_reseller_id,
      // 'company_id' => $order_company_id,
      'order_client_name' => $reseller_info[0]['reseller_name'],
      'order_client_address' => $reseller_info[0]['reseller_address'],
      'order_client_pincode' => $reseller_info[0]['reseller_pincode'],
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
      // 'order_addedby' => $order_client_id,
      // 'package_id' => $package_id,
      // 'reseller_package_id' => $reseller_package_id,
      'package_name' => $package_info[0]['package_name'],
      'gst_slab_per' => $gst_slab_per,
    );
    $this->Master_Model->update_info('order_id', $order_id, 'smm_order', $order_update_data);
    // $order_id = $this->Master_Model->save_data('smm_order', $order_data);


    $invoice_no = $this->Master_Model->get_count_no3($order_company_id, 'invoice_no', 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_invoice');
    $invoice_data = array(
      'razorpay_payment_id' => $razorpay_payment_id,
      'razorpay_order_id' => $razorpay_order_id,
      'invoice_date' => date('d-m-Y'),
      'invoice_start_date' => $start_date,
      'invoice_end_date' => $end_date,
      'invoice_no' => $invoice_no,
      'invoice_no_prefix' => $reseller_invoice_prefix,
      'client_id' => $order_client_id,
      'reseller_id' => $order_reseller_id,
      'company_id' => $order_company_id,
      'order_id' => $order_id,
      'package_id' => $package_id,
      'reseller_package_id' => $reseller_package_id,
      'package_name' => $package_info[0]['package_name'],
      'invoice_client_name' => $reseller_info[0]['reseller_name'],
      'invoice_client_address' => $reseller_info[0]['reseller_address'],
      'invoice_client_pincode' => $reseller_info[0]['reseller_pincode'],
      'country_id' => $reseller_info[0]['country_id'],
      'state_id' => $reseller_info[0]['state_id'],
      'city_id' => $reseller_info[0]['city_id'],
      'invoice_client_mobile' => $reseller_info[0]['reseller_mobile'],
      'invoice_client_email' => $reseller_info[0]['reseller_email'],
      'invoice_client_gstin' => $reseller_info[0]['reseller_gst_no'],
      'invoice_client_statecode' => $reseller_info[0]['reseller_statecode'],
      'gst_slab_per' => $gst_slab_per,
      'invoice_basic_amt' => $package_basic_amt,
      'invoice_gst_amt' => $package_gst_amt,
      'invoice_net_amt' => $subtotal,
      'invoice_addedby_type' => '3',
      'invoice_type' => '2',
      'ref_order_id' => $order_id,
    );
    $invoice_id = $this->Master_Model->save_data('smm_invoice', $invoice_data);

    $reseller_added_type = $reseller_info[0]['reseller_added_type'];
    $order_reseller_id = $order_reseller_id;
    $order_company_id = $order_company_id;
    $package_id = $reseller_package_info[0]['package_id'];
    $cnt = 0;

    while($reseller_added_type == '2'){
      $client_reseller_id = $order_reseller_id;
      $reseller_info = $this->Master_Model->get_info_arr_fields3('*', $order_company_id, 'reseller_id', $client_reseller_id, '', '', '', '', 'smm_reseller');

      $order_reseller_id = $reseller_info[0]['reseller_addedby'];
      if($reseller_info[0]['reseller_added_type'] == 1){
        $order_reseller_id = '0';
        $reseller_invoice_prefix = "INV-";
      } else{
        $reseller_info_seller = $this->Master_Model->get_info_arr_fields3('reseller_invoice_prefix', $order_company_id, 'reseller_id', $order_reseller_id, '', '', '', '', 'smm_reseller');
        $reseller_invoice_prefix = $reseller_info_seller[0]['reseller_invoice_prefix'];
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
        'invoice_start_date' => $start_date,
        'invoice_end_date' => $end_date,
        'invoice_no' => $invoice_no,
        'invoice_no_prefix' => $reseller_invoice_prefix,
        'client_id' => $client_reseller_id,
        'reseller_id' => $order_reseller_id,
        'company_id' => $order_company_id,
        'order_id' => '0',
        'package_id' => $reseller_package_info[0]['package_id'],
        'reseller_package_id' => $reseller_package_info[0]['reseller_package_id'],
        'package_name' => $package_info[0]['package_name'],
        'invoice_client_name' => $reseller_info[0]['reseller_name'],
        'invoice_client_address' => $reseller_info[0]['reseller_address'],
        'invoice_client_pincode' => $reseller_info[0]['reseller_pincode'],
        'country_id' => $reseller_info[0]['country_id'],
        'state_id' => $reseller_info[0]['state_id'],
        'city_id' => $reseller_info[0]['city_id'],
        'invoice_client_mobile' => $reseller_info[0]['reseller_mobile'],
        'invoice_client_email' => $reseller_info[0]['reseller_email'],
        'invoice_client_gstin' => $reseller_info[0]['reseller_gst_no'],
        'invoice_client_statecode' => $reseller_info[0]['reseller_statecode'],
        'gst_slab_per' => $gst_slab_per,
        'invoice_basic_amt' => $package_basic_amt,
        'invoice_gst_amt' => $package_gst_amt,
        'invoice_net_amt' => $subtotal,
        'invoice_addedby_type' => '4',
        'invoice_type' => '2',
        'ref_order_id' => $order_id,
      );
      $invoice_id = $this->Master_Model->save_data('smm_invoice', $invoice_data);

      $reseller_added_type = $reseller_info[0]['reseller_added_type'];
      $order_reseller_id = $reseller_info[0]['reseller_addedby'];
      $cnt++;
    }

    $this->session->set_flashdata('save_success','success');
    header('location:'.base_url().'Reseller/Res_Payment/payment_success_msg');
  }




  // Payment Success Msg...
  public function payment_success_msg(){
    $this->session->unset_userdata('order_client_id');
    $this->session->unset_userdata('order_reseller_id');
    $this->session->unset_userdata('order_company_id');
    $this->session->unset_userdata('buy_package_id');
    $this->session->unset_userdata('renew_order_id');

    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $data['page'] = 'Payment-Success';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Package/payment_success', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

}
