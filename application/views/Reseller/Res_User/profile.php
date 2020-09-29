<!DOCTYPE html>
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
            <h4>Profile</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?> card-default">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Profile</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Reseller/Res_User/dashboard" class="btn btn-sm btn-outline-info">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <!-- <div class="form-group col-md-6 select_sm">
                      <label>Branch</label>
                      <select class="form-control select2" name="branch_id" id="branch_id" data-placeholder="Select Branch" required disabled>
                        <option value="">Select Branch</option>
                        <?php if(isset($branch_list)){ foreach ($branch_list as $list) { ?>
                        <option value="<?php echo $list->branch_id; ?>" <?php if(isset($reseller_info) && $reseller_info['branch_id'] == $list->branch_id){ echo 'selected'; } if($list->branch_status == 0){ echo 'disabled'; } ?>><?php echo $list->branch_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div> -->
                    <div class="form-group col-md-12">
                      <label>Name of Reseller/Company</label>
                      <input type="text" class="form-control form-control-sm" name="reseller_name" id="reseller_name" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_name']; } ?>"  placeholder="Enter Name of Reseller/Company" required >
                    </div>
                    <div class="form-group col-md-12">
                      <label>Address</label>
                      <textarea class="form-control form-control-sm" rows="3" name="reseller_address" id="reseller_address" placeholder="Enter Company Address" required><?php if(isset($reseller_info)){ echo $reseller_info['reseller_address']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select Country</label>
                      <select class="form-control select2" name="country_id" id="country_id" data-placeholder="Select Country" required>
                        <option value="">Select Country</option>
                        <?php if(isset($country_list)){ foreach ($country_list as $list) { ?>
                        <option value="<?php echo $list->country_id; ?>" <?php if(isset($reseller_info) && $reseller_info['country_id'] == $list->country_id){ echo 'selected'; } ?>><?php echo $list->country_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select State</label>
                      <select class="form-control select2" name="state_id" id="state_id" data-placeholder="Select State" required>
                        <option value="">Select State</option>
                        <?php if(isset($state_list)){ foreach ($state_list as $list) { ?>
                        <option value="<?php echo $list->state_id; ?>" <?php if(isset($reseller_info) && $reseller_info['state_id'] == $list->state_id){ echo 'selected'; } ?>><?php echo $list->state_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select City</label>
                      <select class="form-control select2" name="city_id" id="city_id" data-placeholder="Select City" required>
                        <option value="">Select City</option>
                        <?php if(isset($city_list)){ foreach ($city_list as $list) { ?>
                        <option value="<?php echo $list->city_id; ?>" <?php if(isset($reseller_info) && $reseller_info['city_id'] == $list->city_id){ echo 'selected'; } ?>><?php echo $list->city_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Pincode/Zipcode</label>
                      <input type="number" min="111111" max="999999" step="1" class="form-control form-control-sm" name="reseller_pincode" id="reseller_pincode" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_pincode']; } ?>" placeholder="Enter Pincode/Zipcode" required>
                    </div>

                    <div class="form-group col-md-4">
                      <label>Mobile No. 1</label>
                      <input type="number" min="5000000000" max="9999999999" step="1" class="form-control form-control-sm" name="reseller_mobile" id="reseller_mobile" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_mobile']; } ?>" placeholder="Enter Mobile No. 1" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Mobile No. 2 / Landline No.</label>
                      <input type="number" min="5000000000" step="1" class="form-control form-control-sm" name="reseller_mobile2" id="reseller_mobile2" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_mobile2']; } ?>" placeholder="Enter Mobile No. 2">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email Id</label>
                      <input type="email" class="form-control form-control-sm" name="reseller_email" id="reseller_email" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_email']; } ?>" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Website</label>
                      <input type="text" class="form-control form-control-sm" name="reseller_website" id="reseller_website" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_website']; } ?>" placeholder="Website" disabled>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Reseller Password</label>
                      <input type="password" class="form-control form-control-sm" name="reseller_password" id="reseller_password" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_password']; } ?>" placeholder="Enter Reseller Password" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Reseller Confirm Password</label>
                      <input type="password" class="form-control form-control-sm" id="reseller_c_password" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_password']; } ?>" placeholder="Enter Reseller Password" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>GST No.</label>
                      <input type="text" class="form-control form-control-sm" name="reseller_gst_no" id="reseller_gst_no" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_gst_no']; } ?>" placeholder="GST No.">
                    </div>
                    <div class="form-group col-md-4">
                      <label>PAN No.</label>
                      <input type="text" class="form-control form-control-sm" name="reseller_pan_no" id="reseller_pan_no" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_pan_no']; } ?>" placeholder="Pan No.">
                    </div>
                    <div class="form-group col-md-4">
                      <label>Opening Balance</label>
                      <input type="number" class="form-control form-control-sm" name="reseller_op_crd_balance" id="reseller_op_crd_balance" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_op_crd_balance']; } ?>" placeholder="Enter Opening Balance" disabled>
                    </div>
                    <div class="form-group col-md-12">
                      <hr>
                      <label>Bank Account Details</label>
                    </div>


                    <div class="form-group col-md-6">
                      <label>Bank Name</label>
                      <input type="text" class="form-control form-control-sm" name="reseller_bank" id="reseller_bank" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_bank']; } ?>" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Bank Branch</label>
                      <input type="text" class="form-control form-control-sm" name="reseller_bank_branch" id="reseller_bank_branch" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_bank_branch']; } ?>" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Bank Account Number</label>
                      <input type="text" class="form-control form-control-sm" name="reseller_bank_acc_no" id="reseller_bank_acc_no" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_bank_acc_no']; } ?>" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Bank IFSC Number</label>
                      <input type="text" class="form-control form-control-sm" name="reseller_bank_ifsc" id="reseller_bank_ifsc" value="<?php if(isset($reseller_info)){ echo $reseller_info['reseller_bank_ifsc']; } ?>" placeholder="">
                    </div>


                    <div class="form-group col-md-4">
                      <label>Reseller Image</label>
                      <input type="file" class="form-control form-control-sm" name="reseller_logo" id="reseller_logo">
                      <label>Select .jpg/.png/.jpeg file. size is less than 500kb</label>
                    </div>
                    <div class="form-group col-md-4">
                      <?php if(isset($reseller_info) && $reseller_info['reseller_logo']){ ?>
                        <input type="hidden" name="old_reseller_logo" value="<?php echo $reseller_info['reseller_logo']; ?>">
                        <img width="150px" src="<?php echo $reseller_info['reseller_logo']; ?>" alt="">
                      <?php } ?>
                    </div>

                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <!-- <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="reseller_status" id="reseller_status" value="0" <?php if(isset($reseller_info) && $reseller_info['reseller_status'] == 0){ echo 'checked'; } ?>  disabled>
                          <label for="reseller_status" class="custom-control-label">Disable This Reseller</label>
                        </div> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Finance/reseller" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                        <?php if(isset($update)){
                          echo '<button class="btn btn-sm btn-primary float-right px-4">Update Profile</button>';
                        } else{
                          echo '<button class="btn btn-sm btn-success float-right px-4">Save</button>';
                        } ?>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>


        </div>
      </div>
    </section>
  </div>

</body>
</html>

<script type="text/javascript">
  // Check Mobile Duplication..
  var reseller_mobile1 = $('#reseller_mobile').val();
  $('#reseller_mobile').on('change',function(){
    var reseller_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"reseller_mobile",
             "column_val":reseller_mobile,
             "table_name":"smm_reseller"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#reseller_mobile').val(reseller_mobile1);
          toastr.error(reseller_mobile+' Mobile No Exist.');
        }
      }
    });
  });

  // Check Email Duplication..
  var reseller_email1 = $('#reseller_email').val();
  $('#reseller_email').on('change',function(){
    var reseller_email = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
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
      url:'<?php echo base_url(); ?>Master/get_state_by_country',
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
      url:'<?php echo base_url(); ?>Master/get_city_by_state',
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
