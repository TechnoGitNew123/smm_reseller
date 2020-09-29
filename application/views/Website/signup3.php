<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/web_setting/<?php echo $web_setting_info[0]['web_setting_favicon']; ?>"/>
  <title>Sign Up</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin_css.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page " style="background-image: linear-gradient(to right, #9c0483, #730bbe);" >
<div class="login-box login-new">
  <div class="login-logo ">
    <span class="login-box-msg"> <img width="150px;" src="<?php echo base_url(); ?>assets/images/web_setting/<?php echo $web_setting_info[0]['web_setting_logo']; ?>"> </span>
    <!-- <br><i class="fas fa-hospital-alt"></i> -->
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body pt-5">
      <!-- <p class="login-box-msg">Login </p> -->
      <form method="post" action="">
        <div class="form-group col-md-12">
            <label>Name of Reseller/Company</label>
            <input type="text" class="form-control form-control-sm" name="reseller_name" id="reseller_name" value="" placeholder="Enter Name of Reseller/Company" required="">
          </div>

          <div class="row">
          <div class="form-group col-md-6">
            <label>Name Mobile</label>
            <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" value="" placeholder="Enter Mobile No." required="">
          </div>

          <div class="form-group col-md-6">
            <label>Name Email</label>
            <input type="email" class="form-control form-control-sm" name="email" id="email" value="" placeholder="Enter Email Id" required="">
          </div>
          </div>

          <div class="row">
          <div class="form-group col-md-4">
                  <label>Country</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option selected="selected" data-select2-id="3">Alabama</option>
                    <option data-select2-id="40">Alaska</option>
                    <option data-select2-id="41">California</option>
                    <option data-select2-id="42">Delaware</option>
                    <option data-select2-id="43">Tennessee</option>
                    <option data-select2-id="44">Texas</option>
                    <option data-select2-id="45">Washington</option>
                  </select>
                </div>

            <div class="form-group col-md-4">
                  <label>State</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option selected="selected" data-select2-id="3">Alabama</option>
                    <option data-select2-id="40">Alaska</option>
                    <option data-select2-id="41">California</option>
                    <option data-select2-id="42">Delaware</option>
                    <option data-select2-id="43">Tennessee</option>
                    <option data-select2-id="44">Texas</option>
                    <option data-select2-id="45">Washington</option>
                  </select>
                </div>



            <div class="form-group col-md-4">
                  <label>City</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option selected="selected" data-select2-id="3">Alabama</option>
                    <option data-select2-id="40">Alaska</option>
                    <option data-select2-id="41">California</option>
                    <option data-select2-id="42">Delaware</option>
                    <option data-select2-id="43">Tennessee</option>
                    <option data-select2-id="44">Texas</option>
                    <option data-select2-id="45">Washington</option>
                  </select>
                </div>
          </div>

        <span class="text-red"> <?php echo form_error('password'); ?> </span>
        <div class="row">
          <div class="col-md-12 text-center">
            <div >
               <button type="submit" class="btn btn-primary btn-flat">Sign Up</button>
            </div>

          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
      <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">
          <p class="mb-1">
            <a href="<?php echo base_url(); ?>Login">Login</a>
          </p>
        </div>
      </div>
      <div class="alert alert-danger p-2 msg_invalid" style="display:none" role="alert">
        Invalid Information
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>




</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script type="text/javascript">
<?php if($this->session->flashdata('msg')){ ?>
  $(document).ready(function(){
    $('.msg_invalid').show().delay(5000).fadeOut();
  });
<?php } ?>
</script>
</body>
</html>
