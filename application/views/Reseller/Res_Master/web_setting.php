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
            <h4>Website Setting</h4>
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
                        <option value="<?php echo $list->branch_id; ?>" <?php if(isset($web_setting_info) && $web_setting_info['branch_id'] == $list->branch_id){ echo 'selected'; } if($list->branch_status == 0){ echo 'disabled'; } ?>><?php echo $list->branch_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div> -->
                    <div class="form-group col-md-12">
                      <label>Name of Reseller/Company</label>
                      <input type="text" class="form-control form-control-sm" name="web_setting_name" id="web_setting_name" value="<?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_name']; } ?>"  placeholder="Enter Name of Reseller/Company" required >
                    </div>
                    <div class="form-group col-md-12">
                      <label>Address</label>
                      <textarea class="form-control form-control-sm" rows="3" name="web_setting_address" id="web_setting_address" placeholder="Enter Company Address" required><?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_address']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select Country</label>
                      <select class="form-control select2" name="country_id" id="country_id" data-placeholder="Select Country" required>
                        <option value="">Select Country</option>
                        <?php if(isset($country_list)){ foreach ($country_list as $list) { ?>
                        <option value="<?php echo $list->country_id; ?>" <?php if(isset($web_setting_info) && $web_setting_info['country_id'] == $list->country_id){ echo 'selected'; } ?>><?php echo $list->country_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select State</label>
                      <select class="form-control select2" name="state_id" id="state_id" data-placeholder="Select State" required>
                        <option value="">Select State</option>
                        <?php if(isset($state_list)){ foreach ($state_list as $list) { ?>
                        <option value="<?php echo $list->state_id; ?>" <?php if(isset($web_setting_info) && $web_setting_info['state_id'] == $list->state_id){ echo 'selected'; } ?>><?php echo $list->state_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4 select_sm">
                      <label>Select City</label>
                      <select class="form-control select2" name="city_id" id="city_id" data-placeholder="Select City" required>
                        <option value="">Select City</option>
                        <?php if(isset($city_list)){ foreach ($city_list as $list) { ?>
                        <option value="<?php echo $list->city_id; ?>" <?php if(isset($web_setting_info) && $web_setting_info['city_id'] == $list->city_id){ echo 'selected'; } ?>><?php echo $list->city_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Pincode/Zipcode</label>
                      <input type="number" min="111111" max="999999" step="1" class="form-control form-control-sm" name="web_setting_pincode" id="web_setting_pincode" value="<?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_pincode']; } ?>" placeholder="Enter Pincode/Zipcode" required>
                    </div>

                    <div class="form-group col-md-4">
                      <label>Mobile No. 1</label>
                      <input type="number" min="5000000000" max="9999999999" step="1" class="form-control form-control-sm" name="web_setting_mobile" id="web_setting_mobile" value="<?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_mobile']; } ?>" placeholder="Enter Mobile No. 1" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Mobile No. 2 / Landline No.</label>
                      <input type="number" min="5000000000" step="1" class="form-control form-control-sm" name="web_setting_mobile2" id="web_setting_mobile2" value="<?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_mobile2']; } ?>" placeholder="Enter Mobile No. 2">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email Id</label>
                      <input type="email" class="form-control form-control-sm" name="web_setting_email" id="web_setting_email" value="<?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_email']; } ?>" placeholder="Email" required>
                    </div>
                    <div class="form-group col-md-6">
                      <!-- <label>Website</label>
                      <input type="text" class="form-control form-control-sm" name="web_setting_website" id="web_setting_website" value="<?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_website']; } ?>" placeholder="Website"> -->
                    </div>

                    <div class="form-group col-md-12">
                      <label>Meta Title</label>
                      <input type="text" class="form-control form-control-sm" name="web_setting_meta_title" id="web_setting_meta_title" value="<?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_meta_title']; } ?>" >
                    </div>
                    <div class="form-group col-md-12">
                      <label>Meta Keywords</label>
                      <input type="text" class="form-control form-control-sm" name="web_setting_meta_keyword" id="web_setting_meta_keyword" value="<?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_meta_keyword']; } ?>" >
                    </div>
                    <div class="form-group col-md-12">
                      <label>Meta Description</label>
                      <input type="text" class="form-control form-control-sm" name="web_setting_meta_descr" id="web_setting_meta_descr" value="<?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_meta_descr']; } ?>" >
                    </div>

                    <div class="form-group col-md-3">
                      <label>Website Logo</label>
                      <input type="file" class="form-control form-control-sm" name="web_setting_logo" id="web_setting_logo">
                      <label>Select .jpg/.png/.jpeg file. size is less than 500kb</label>
                    </div>
                    <div class="form-group col-md-3">
                      <?php if(isset($web_setting_info) && $web_setting_info['web_setting_logo']){ ?>
                        <input type="hidden" name="old_web_setting_logo" value="<?php echo $web_setting_info['web_setting_logo']; ?>">
                        <img width="150px" src="<?php echo $web_setting_info['web_setting_logo']; ?>" alt="">
                      <?php } ?>
                    </div>

                    <div class="form-group col-md-3">
                      <label>Website Fevicon</label>
                      <input type="file" class="form-control form-control-sm" name="web_setting_favicon" id="web_setting_favicon">
                      <label>Select .jpg/.png/.jpeg file. size is less than 500kb</label>
                    </div>
                    <div class="form-group col-md-3">
                      <?php if(isset($web_setting_info) && $web_setting_info['web_setting_favicon']){ ?>
                        <input type="hidden" name="old_web_setting_favicon" value="<?php echo $web_setting_info['web_setting_favicon']; ?>">
                        <img width="150px" src="<?php echo $web_setting_info['web_setting_favicon']; ?>" alt="">
                      <?php } ?>
                    </div>

                    <div class="form-group col-md-12">
                      <label>About Us information</label>
                      <textarea class="textarea form-control form-control-sm" rows="3" name="web_setting_about_info" id="web_setting_about_info" placeholder="" required><?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_about_info']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Contact Us information</label>
                      <textarea class="textarea form-control form-control-sm" rows="3" name="web_setting_contact_info" id="web_setting_contact_info" placeholder="" required><?php if(isset($web_setting_info)){ echo $web_setting_info['web_setting_contact_info']; } ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <hr>
                      <label>Select Website Template</label>
                    </div>
                    <div class="form-group col-md-4">
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="template_1" name="template_id" value="1" <?php if(isset($web_setting_info) && $web_setting_info['template_id'] == '1'){ echo 'checked' ; } elseif(!isset($web_setting_info)){ echo 'checked' ; } ?> >
                        <label for="template_1" class="custom-control-label">Template #1</label>
                      </div><br>
                      <div class="card">
                        <img width="100%" src="<?php echo base_url(); ?>assets/images/web_setting/template_1.png" alt="">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="template_2" name="template_id" value="2" <?php if(isset($web_setting_info) && $web_setting_info['template_id'] == '2'){ echo 'checked' ; } ?> >
                        <label for="template_2" class="custom-control-label">Template #2</label>
                      </div><br>
                      <div class="card">
                        <img width="100%" src="<?php echo base_url(); ?>assets/images/web_setting/template_2.png" alt="">
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="template_3" name="template_id" value="3"  <?php if(isset($web_setting_info) && $web_setting_info['template_id'] == '3'){ echo 'checked' ; } ?> >
                        <label for="template_3" class="custom-control-label">Template #3</label>
                      </div><br>
                      <div class="card">
                        <img width="100%" src="<?php echo base_url(); ?>assets/images/web_setting/template_3.png" alt="">
                      </div>
                    </div>



                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <!-- <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="web_setting_status" id="web_setting_status" value="0" <?php if(isset($web_setting_info) && $web_setting_info['web_setting_status'] == 0){ echo 'checked'; } ?>  disabled>
                          <label for="web_setting_status" class="custom-control-label">Disable This Reseller</label>
                        </div> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Finance/web_setting" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
  var web_setting_mobile1 = $('#web_setting_mobile').val();
  $('#web_setting_mobile').on('change',function(){
    var web_setting_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"web_setting_mobile",
             "column_val":web_setting_mobile,
             "table_name":"smm_web_setting"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#web_setting_mobile').val(web_setting_mobile1);
          toastr.error(web_setting_mobile+' Mobile No Exist.');
        }
      }
    });
  });

  // Check Email Duplication..
  var web_setting_email1 = $('#web_setting_email').val();
  $('#web_setting_email').on('change',function(){
    var web_setting_email = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Master/check_duplication',
      type: 'POST',
      data: {"column_name":"web_setting_email",
             "column_val":web_setting_email,
             "table_name":"smm_web_setting"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#web_setting_email').val(web_setting_email1);
          toastr.error(web_setting_email+' Email No Exist.');
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

  $('#web_setting_password, #web_setting_c_password').on('change',function(){
    var web_setting_password = $('#web_setting_password').val();
    var web_setting_c_password = $('#web_setting_c_password').val();
    if(web_setting_password != web_setting_c_password){
      toastr.error('Password and Confirm Password must be same');
      $('#web_setting_c_password').val('');
    }
  });
</script>
