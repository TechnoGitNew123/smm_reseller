<?php include('include/head1.php') ?>

<?php

    $final_payment_amt = $package_cost;
    if ($final_payment_amt == 0) {
      $final_payment_amt = 1;
    }
    $productinfo = 'SMM Package';
    $surl = base_url().'WebsiteController/payment_success';
    $key_id = $payment_gateway_info['payment_gateway_key_id'];
    $key_Secret = $payment_gateway_info['payment_gateway_secret_key'];;
    $currency = 'INR';
    $total = ($final_payment_amt*100);
    $customer_name = $reseller_info['reseller_name'];
    $customer_email = $reseller_info['reseller_email'];
    $customer_mobile = $reseller_info['reseller_mobile'];
    $org_name = 'SMM';
    //
    require('razorpay-php/Razorpay.php');
    use Razorpay\Api\Api;
    $api = new Api($key_id, $key_Secret);
    $orderData = [
        'receipt'         => 3456,
        'amount'          => $total,
        'currency'        => $currency,
        'payment_capture' => 1
    ];
    $razorpayOrder = $api->order->create($orderData);
    $razorpayOrderId = $razorpayOrder['id'];
  ?>

  <div class="top_strip"></div>

  <section class="default-page mt-5 mb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-heading">Payment</h1>
        </div>
      </div>
    </div>
  </section>


<section class="checkout-middle">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="billing mb-3">
          <div class="col-md-12">
            <h4>Reseller Details</h4>
            <hr class="grey-hr">
            <div class="card p-4">
              <p class="mb-1"><b>Name :</b> <?php echo $reseller_info['reseller_name']; ?></p>
              <p class="mb-1"><b>Address :</b> <?php echo $reseller_info['reseller_address']; ?></p>
              <p class="mb-1"><b>Mobile :</b> <?php echo $reseller_info['reseller_mobile']; ?></p>
              <p class="mb-1"><b>Email :</b> <?php echo $reseller_info['reseller_email']; ?></p>
            </div>
          </div>
        </div>
        <hr>
      </div>

      <div class="col-md-4">
        <div class="billing mb-3">
          <div class="col-md-12">
            <h4>Order Summary</h4>
            <hr class="grey-hr">
            <div class="card p-4">
              <p class="mb-1"><b>Package :</b> <?php echo $package_info['package_name']; ?></p>
              <p class="mb-1"><b>Price :</b> <?php echo $reseller_package_info['reseller_package_new_price']; ?></p>

            </div>
          </div>
        </div>
        <hr>
      </div>

      <div class="col-md-4">
        <div class="order_summary">
          <h4 class="text-left">Payment Details</h4>
          <hr class="grey-hr">
          <div class="card py-3">
            <div class="row">
              <div class="col-7">
                <p><b>Basic Amount:</b></p>
                <p><b>GST(Inclusive):</b></p>
              </div>
              <div class="col-5 text-right">
                <p id=""><?php echo $package_basic_amt; ?></p>
                <p id=""><?php echo $package_gst_amt; ?></p>
              </div>
              <div class="col-12">
                <hr class="grey-hr">
              </div>
              <div class="col-7">
                <p><b>Total:</b></p>
              </div>
              <div class="col-5 text-right">
                <p id=""><?php echo $package_cost; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
  <div class="col-md-12 text-center" >
    <div class="alert alert-success d-none" id="amt_alert" role="alert">
    </div>
  </div>
  <div class="col-md-12 text-center">
    <button type="button" onclick="$('.razorpay-payment-button').click()" class="btn btn-outline-success"><b>Make Payment</b></button>
  </div>
</div>
</section>

    <form class="d-none" action="<?php echo base_url(); ?>WebsiteController/payment_success" method="POST">
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

      <?php include('include/footer1.php') ?>
  </body>
</html>
