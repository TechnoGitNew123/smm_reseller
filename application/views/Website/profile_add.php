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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<?php if($web_template_id == 1){ ?>
  <body class="hold-transition  " style="background-color: #2db5eb!important;" >
<?php } elseif ($web_template_id == 2) { ?>
  <body class="hold-transition  " style="background-image: linear-gradient(to right, #044c9d, #00aff4);" >
<?php } elseif ($web_template_id == 3) { ?>
  <body class="hold-transition  " style="background-image: linear-gradient(to right, #9c0483, #730bbe);" >
<?php } ?>



<div class="login-new mx-auto" style="width:600px;">
  <div class="login-logo ">
    <span class="login-box-msg"> <img width="150px;" src="<?php echo base_url(); ?>assets/images/web_setting/<?php echo $web_setting_info[0]['web_setting_logo']; ?>"> </span>
    <!-- <br><i class="fas fa-hospital-alt"></i> -->
  </div>
  <!-- /.login-logo -->
  <div class="card">

    <div class="card-body login-card-body pt-5">
      <h4 class="text-center mb-3">Profile</h4>
      <!-- <p class="login-box-msg">Login </p> -->
      <form class="input_form" method="post" action="" enctype="multipart/form-data">

        <div class="row p-2">
          <div class="form-group col-md-12">
            <label>Name of Reseller/Company</label>
            <input type="text" class="form-control form-control-sm" name="reseller_name" id="reseller_name" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_name']; } ?>"  placeholder="Enter Name of Reseller/Company" required readonly >
          </div>
          <div class="form-group col-md-12">
            <label>Address</label>
            <textarea class="form-control form-control-sm" rows="3" name="reseller_address" id="reseller_address" placeholder="Enter Company Address" required><?php if(isset($reseller_info)){ echo $reseller_info['reseller_address']; } ?></textarea>
          </div>
          <div class="form-group col-md-4 select_sm">
            <label>Select Country</label>
            <select class="form-control select2 form-control-sm" name="country_id" id="country_id" data-placeholder="Select Country" required>
              <option value="">Select Country</option>
              <?php if(isset($country_list)){ foreach ($country_list as $list) { ?>
              <option value="<?php echo $list->country_id; ?>" <?php if(isset($reseller_info) && $reseller_info['country_id'] == $list->country_id){ echo 'selected'; } ?>><?php echo $list->country_name; ?></option>
              <?php } } ?>
            </select>
          </div>
          <div class="form-group col-md-4 select_sm">
            <label>Select State</label>
            <select class="form-control select2 form-control-sm" name="state_id" id="state_id" data-placeholder="Select State" required>
              <option value="">Select State</option>
              <?php if(isset($state_list)){ foreach ($state_list as $list) { ?>
              <option value="<?php echo $list->state_id; ?>" <?php if(isset($reseller_info) && $reseller_info['state_id'] == $list->state_id){ echo 'selected'; } ?>><?php echo $list->state_name; ?></option>
              <?php } } ?>
            </select>
          </div>
          <div class="form-group col-md-4 select_sm">
            <label>Select City</label>
            <select class="form-control select2 form-control-sm" name="city_id" id="city_id" data-placeholder="Select City" required>
              <option value="">Select City</option>
              <?php if(isset($city_list)){ foreach ($city_list as $list) { ?>
              <option value="<?php echo $list->city_id; ?>" <?php if(isset($reseller_info) && $reseller_info['city_id'] == $list->city_id){ echo 'selected'; } ?>><?php echo $list->city_name; ?></option>
              <?php } } ?>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label>Pincode/Zipcode</label>
            <input type="number" min="111111" max="999999" step="1" class="form-control form-control-sm" name="reseller_pincode" id="reseller_pincode" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_pincode']; } ?>" placeholder="Enter Pincode/Zipcode">
          </div>

          <div class="form-group col-md-4">
            <label>Mobile No. 1</label>
            <input type="number" min="5000000000" max="9999999999" step="1" class="form-control form-control-sm" name="reseller_mobile" id="reseller_mobile" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_mobile']; } ?>" placeholder="Enter Mobile No. 1" required disabled>
          </div>
          <div class="form-group col-md-4">
            <label>Mobile No. 2 / Landline No.</label>
            <input type="number" min="5000000000" step="1" class="form-control form-control-sm" name="reseller_mobile2" id="reseller_mobile2" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_mobile2']; } ?>" placeholder="Enter Mobile No. 2">
          </div>

          <div class="form-group col-md-6">
            <label>GST No.</label>
            <input type="text" class="form-control form-control-sm" name="reseller_gst_no" id="reseller_gst_no" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_gst_no']; } ?>" placeholder="GST No.">
          </div>
          <div class="form-group col-md-6">
            <label>PAN No.</label>
            <input type="text" class="form-control form-control-sm" name="reseller_pan_no" id="reseller_pan_no" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_pan_no']; } ?>" placeholder="Pan No.">
          </div>

          <div class="form-group col-md-6">
            <label>Reseller Image</label>
            <input type="file" class="form-control form-control-sm" name="reseller_logo" id="reseller_logo">
            <label>.jpg/.png/.jpeg file. size is less than 500kb</label>
          </div>

        </div>

        <!-- <span class="text-red"> <?php echo form_error('password'); ?> </span> -->
        <div class="row">
          <div class="col-md-12 text-center">
            <div >
              <button type="submit" class="btn btn-primary btn-flat px-4">Save</button>
            </div>
          </div>
        </div>
      </form>
      <!-- /.social-auth-links -->
      <!-- <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6 text-right">
          <p class="mb-1">
            <a href="<?php echo base_url(); ?>Login">Login</a>
          </p>
        </div>
      </div> -->

      <div class="alert alert-danger p-2 msg_invalid" style="display:none" role="alert">
        Invalid Information
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>




</div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<script type="text/javascript">
<?php if($this->session->flashdata('msg')){ ?>
  $(document).ready(function(){
    // alert();
    $('.msg_invalid').show().delay(5000).fadeOut();
  });
<?php } ?>
</script>

<script type="text/javascript">
  // Check Mobile Duplication..
  var reseller_mobile1 = $('#reseller_mobile').val();
  $('#reseller_mobile').on('change',function(){
    var reseller_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Reseller/Res_Master/check_duplication',
      type: 'POST',
      data: {"column_name":"reseller_mobile",
             "column_val":reseller_mobile,
             "table_name":"smm_reseller"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#reseller_mobile').val(reseller_mobile1);
          toastr.error(reseller_mobile+' Mobile Number Exist.');
        }
      }
    });
  });

  // Check Email Duplication..
  var reseller_email1 = $('#reseller_email').val();
  $('#reseller_email').on('change',function(){
    var reseller_email = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Reseller/Res_Master/check_duplication',
      type: 'POST',
      data: {"column_name":"reseller_email",
             "column_val":reseller_email,
             "table_name":"smm_reseller"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#reseller_email').val(reseller_email1);
          toastr.error(reseller_email+' Email No Exist.');
        }
      }
    });
  });

  $("#country_id").on("change", function(){
    var country_id =  $('#country_id').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Reseller/Res_Master/get_state_by_country',
      type: 'POST',
      data: {"country_id":country_id},
      context: this,
      success: function(result){
        $('#state_id').html(result);
      }
    });
  });

  $("#state_id").on("change", function(){
    var state_id =  $('#state_id').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Reseller/Res_Master/get_city_by_state',
      type: 'POST',
      data: {"state_id":state_id},
      context: this,
      success: function(result){
        $('#city_id').html(result);
      }
    });
  });

  $('#reseller_password, #reseller_c_password').on('change',function(){
    var reseller_password = $('#reseller_password').val();
    var reseller_c_password = $('#reseller_c_password').val();
    if(reseller_password != reseller_c_password){
      toastr.error('Password and Confirm Password must be same');
      $('#reseller_c_password').val('');
    }
  });

</script>
</body>
</html>
