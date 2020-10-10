<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/web_setting/<?php echo $web_setting_info[0]['web_setting_favicon']; ?>"/>
  <title>Log in</title>
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

<?php if($web_template_id == 1){ ?>
  <body class="hold-transition login-page " style="background-color: #2db5eb!important;" >
<?php } elseif ($web_template_id == 2) { ?>
  <body class="hold-transition login-page " style="background-image: linear-gradient(to right, #044c9d, #00aff4);" >
<?php } elseif ($web_template_id == 3) { ?>
  <body class="hold-transition login-page " style="background-image: linear-gradient(to right, #9c0483, #730bbe);" >
<?php } ?>



<div class="login-box">
  <div class="login-logo ">
    <span class="login-box-msg"> <img width="150px;" src="<?php echo $web_setting_info[0]['web_setting_logo']; ?>"> </span>
    <!-- <br><i class="fas fa-hospital-alt"></i> -->
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body pt-5">
      <!-- <p class="login-box-msg">Login </p> -->
      <form method="post" action="">
        <div class="input-group mb-3">
          <input type="number" min="5000000000" max="9999999999" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-mobile"></span>
            </div>
          </div>
        </div>
        <span class="text-red"> <?php echo form_error('mobile'); ?> </span>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <span class="text-red"> <?php echo form_error('password'); ?> </span>
        <div class="row">
          <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
      <div class="row">
        <div class="col-md-6">
          <p class="mb-1">
            <!-- <a href="<?php echo base_url(); ?>User/forgot_password">I forgot my password</a> -->
          </p>
        </div>
        <div class="col-md-6 text-right">
          <p class="mb-1">
            <a href="<?php echo base_url(); ?>Signup">Sign Up </a>
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
    // alert();
    $('.msg_invalid').show().delay(5000).fadeOut();
  });
<?php } ?>
</script>
</body>
</html>
