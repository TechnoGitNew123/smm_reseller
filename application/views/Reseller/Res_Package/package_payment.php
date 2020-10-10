<!DOCTYPE html>
<?php
  $smm_addedby_type = $this->session->userdata('smm_addedby_type');
  $smm_reseller_id = $this->session->userdata('smm_reseller_id');
  $smm_res_company_id = $this->session->userdata('smm_res_company_id');
  $valid_coupon = $this->session->flashdata('valid_coupon');
?>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-0 pb-2">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-left mt-2">
            <h4>Package Payment</h4>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card p-2">
              <?php
                $smm_reseller_id = $this->session->userdata('smm_reseller_id');
                require('razorpay-php/Razorpay.php');
                use Razorpay\Api\Api;

                if($smm_reseller_id){
                  if(isset($valid_coupon) && $valid_coupon){
                    if(isset($coupon_applied) && isset($coupon_discount_amount)){
                      $payment_amount = $package_cost - $coupon_discount_amount;
                    } else{
                      $payment_amount = $package_cost;
                    }
                  } else{
                    $payment_amount = $package_cost;
                  }

                    $final_payment_amt = $payment_amount;

                    if ($final_payment_amt == 0) {
                      $final_payment_amt = 1;
                    }
                    $productinfo = 'SMM Package';
                    // $surl = base_url().'Reseller/Res_Payment/payment_success';
                    $key_id = $payment_gateway_info['payment_gateway_key_id'];
                    $key_Secret = $payment_gateway_info['payment_gateway_secret_key'];;
                    $currency = 'INR';
                    $total = ($final_payment_amt*100);
                    $customer_name = $reseller_info['reseller_name'];
                    $customer_email = $reseller_info['reseller_email'];
                    $customer_mobile = $reseller_info['reseller_mobile'];
                    $org_name = 'SMM';


                    $api = new Api($key_id, $key_Secret);
                    $orderData = [
                        'receipt'         => 3456,
                        'amount'          => $total,
                        'currency'        => $currency,
                        'payment_capture' => 1
                    ];
                    $razorpayOrder = $api->order->create($orderData);
                    $razorpayOrderId = $razorpayOrder['id'];
                  }
                  ?>

                  <div class="top_strip text-center">
                    <h5><?php echo $title; ?></h5>
                    <hr>
                    <?php $coupon_code = $this->session->userdata('coupon_code');
                    echo $coupon_code;
                    ?>

                  </div>

                  <section class="default-page mt-2 mb-5">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <h4 class="page-heading"> <i class="fas fa-cart-arrow-down mr-2"></i> ORDER SUMMARY</h4>
                        </div>
                      </div>
                    </div>
                  </section>


                <section class="checkout-middle">
                  <div class="container">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="card border-shadow p-3">
                        <div class="d-none d-sm-block">
                        <div class="row bb-1 ">
                          <div class="col-5">
                            <h6>PRODUCT</h6>
                          </div>
                           <div class="col-4">
                            <h6>DURATION</h6>
                          </div>
                           <div class="col-3">
                            <h6>PRICE</h6>
                          </div>
                        </div>
                        </div>
                        <div class="product-row">
                       <div class="row ">
                       <div class="col-md-5 col-12 mt-3">
                        <h4 class="text-green"><?php echo $package_name; ?></h4>
                        <p class="f-14">
                          <?php foreach ($package_feature_list as $list) {
                            echo $list->package_feature_name.', ';
                          } ?>
                        </p>

                       </div>

                       <div class="col-md-4  col-12 mt-3">
                         <h5>Duration <?php echo $package_per_duration; ?> Days  </h5>
                       </div>
                       <div class="col-md-3 col-12 mt-3">

                         <h6 class="f-22"> <span class="badge badge-secondary bg-green"><span><i class="fas fa-rupee-sign"></i></span> <?php echo $package_cost; ?></span> </h6>
                       </div>

                       </div>
                       </div>

                         <div class="row">
                           <div class="col-8 d-none d-sm-block">
                             <hr>
                             <?php if($smm_reseller_id){ ?>
                               <form class="" action="" method="post">
                                 <div class="row">
                                   <div class="form-group col-md-3 ">
                                     <label for="">Coupon Code</label>
                                   </div>
                                   <div class="form-group col-md-6 ">
                                     <input type="text" class="form-control form-control-sm" name="coupon_code" required>
                                   </div>
                                   <div class="form-group col-md-2">
                                     <button type="submit" class="btn btn-sm btn-info" >Apply</button>
                                   </div>
                                 </div>
                               </form>
                             <?php } ?>
                           </div>
                           <div class="col-md-4 col-12">
                            <div class="row">
                              <div class="col-md-6 col-6 p-0 mt-3">
                                <h6>Basic Amount:</h6>
                              </div>
                               <div class="col-6 p-0 mt-3">
                                <h6><i class="fas fa-rupee-sign"></i><?php echo $package_basic_amt; ?></h6>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6 col-6 p-0 mt-3">
                                <h6>GST :</h6>
                              </div>
                               <div class="col-6 p-0 mt-3">
                                <h6><i class="fas fa-rupee-sign"></i><?php echo $package_gst_amt; ?></h6>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6 p-0 mt-3">
                                <h6>Total :</h6>
                              </div>
                               <div class="col-6 p-0 mt-3">
                                <h4 class="text-green f-22"><i class="fas fa-rupee-sign"></i><?php echo $package_cost; ?></h4>
                              </div>
                            </div>

                            <?php if($valid_coupon){
                              if(isset($coupon_applied) && isset($coupon_discount_amount)){
                            ?>
                            <div class="row">
                              <div class="col-6 p-0 mt-3">
                                <h6>Coupon Discount :</h6>
                              </div>
                               <div class="col-6 p-0 mt-3">
                                <h6 class="text-info"><i class="fas fa-rupee-sign"></i><?php echo $coupon_discount_amount; ?></h6>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6 p-0 mt-3">
                                <h6>Payment Amount :</h6>
                              </div>
                               <div class="col-6 p-0 mt-3">
                                <h4 class="text-green f-22"><i class="fas fa-rupee-sign"></i><?php echo $package_cost - $coupon_discount_amount ; ?></h4>
                              </div>
                            </div>

                            <?php } } ?>


                            <!-- <div class="row">
                              <div class="col-6 p-0 mt-3">
                                <h6>Total :</h6>
                              </div>
                               <div class="col-6 p-0 mt-3">
                                <h4 class="text-green f-22"><i class="fas fa-rupee-sign"></i><?php echo $package_cost; ?></h4>
                              </div>
                            </div> -->

                             <div class="row text-center">
                              <div class="col-12 p-0 mt-3 mb-5">
                                <?php if($smm_reseller_id){ ?>
                                  <button type="button" onclick="$('.razorpay-payment-button').click()" class="btn btn-outline-success"><b>Make Payment</b></button>
                                <?php } else{ ?>
                                  <a href="<?php echo base_url(); ?>Login" type="button" class="btn btn-outline-success"><b>Make Payment</b></a>
                                <?php } ?>
                              </div>
                            </div>
                           </div>
                         </div>

                       </div>
                      </div>
                    </div>
                  </div>

                </div>
                </section>
                  <?php if($smm_reseller_id){ ?>
                    <?php if($payment_for == 'buy'){ ?>
                    <form class="d-none" action="<?php echo base_url(); ?>Reseller/Res_Payment/payment_success" method="POST">
                    <?php } elseif ($payment_for == 'renew') { ?>
                      <form class="d-none" action="<?php echo base_url(); ?>Reseller/Res_Payment/payment_renew_success" method="POST">
                    <?php } ?>
                      <script
                      src="https://checkout.razorpay.com/v1/checkout.js"
                      data-key="<?php echo $key_id; ?>"
                      data-amount="<?php echo $total; ?>"
                      data-currency="<?php echo $currency; ?>"
                      data-order_id="<?php echo $razorpayOrderId; ?>"
                      data-buttontext="Make Payment"
                      data-name="<?php echo $org_name; ?>"
                      data-description="<?php echo $org_name; ?>"
                      data-image=""
                      data-prefill.name="<?php echo $customer_name; ?>"
                      data-prefill.email="<?php echo $customer_email; ?>"
                      data-prefill.contact="<?php echo $customer_mobile; ?>"
                      data-theme.color="#F37254" >
                      </script>
                      <input type="hidden" custom="Hidden Element" name="hidden">
                    </form>
                  <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>
</html>

<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
<?php if($this->session->flashdata('valid_coupon')){ ?>
  $(document).ready(function(){
    toastr.success('Coupon Applied Successfully');
  });
<?php } ?>
<?php if($this->session->flashdata('invalid_coupon')){ ?>
  $(document).ready(function(){
    toastr.error('Invalid Coupon Code');
  });
<?php } ?>
</script>
