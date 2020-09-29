<?php include('include/head1.php') ?>

<div class="top_strip"></div>

<section class="default-page mt-5 mb-5">
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-heading">Checkout</h1>
    </div>
  </div>
</div>
</section>


<section class="checkout-middle">
<div class="container">
<div class="row">
  <div class="col-md-9">
    <div class="billing mb-3">
      <div class="col-md-12">
        <h4>Cart Details</h4>
        <hr class="grey-hr">
        <div class="m-autoscroll" id="myCart">
          <div class="modal-body">

          </div>
        </div>
      </div>
    </div>
    <hr>
  </div>

  <div class="col-md-3">
    <div class="order_summary">
      <h4 class="text-left">Order Summary</h4>
      <hr class="grey-hr">
      <div class="card py-3">
        <div class="row">
          <div class="col-7">
            <p>Basic Amount:</p>
            <p>GST(Inclusive):</p>
          </div>
          <div class="col-5 text-right">
            <p id="total_basic">&#8377;0</p>
            <p id="total_gst">&#8377;0</p>
          </div>
          <div class="col-12">
            <hr class="grey-hr">
          </div>
          <div class="col-7">
            <p>Total:</p>
          </div>
          <div class="col-5 text-right">
            <p id="cart_total">&#8377;0</p>
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
    <a href="<?php echo base_url(); ?>Payment-Details" type="button" class="btn btn-outline-success">Checkout</a>
  </div>
</div>
</section>

      <?php include('include/footer1.php') ?>
  </body>
</html>
