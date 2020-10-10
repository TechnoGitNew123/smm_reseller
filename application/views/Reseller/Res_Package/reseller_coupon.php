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
            <h4>Reseller Coupon</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?>">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Reseller Coupon</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Reseller/Res_Package/reseller_coupon" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0 needs-validation" novalidate id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-6 offset-md-3">
                        <label>Coupon Date</label>
                        <input type="text" class="form-control form-control-sm" name="reseller_coupon_date" value="<?php if(isset($reseller_coupon_info)){ echo $reseller_coupon_info['reseller_coupon_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Coupon Date" required>
                      </div>
                      <div class="form-group col-md-6 offset-md-3 ">
                        <label>Coupon Code</label>
                        <input type="text" class="form-control form-control-sm" name="reseller_coupon_code" id="reseller_coupon_code" value="<?php if(isset($reseller_coupon_info)){ echo $reseller_coupon_info['reseller_coupon_code']; } ?>" placeholder="Enter Coupon Code" required>
                      </div>
                      <div class="form-group col-md-6 offset-md-3 select_sm">
                        <label>Package</label>
                        <select class="form-control select2" name="package_id" id="package_id" data-placeholder="Select Package" required >
                          <option value="">Select Package</option>
                          <?php if(isset($my_package_list)){ foreach ($my_package_list as $list) {
                            $package_details = $this->Master_Model->get_info_arr_fields3('*', '', 'package_id', $list->package_id, '', '', '', '', 'smm_package');
                            if($package_details){
                          ?>
                          <option value="<?php echo $list->package_id; ?>" <?php if(isset($reseller_coupon_info) && $reseller_coupon_info['package_id'] == $list->package_id){ echo 'selected'; } ?> commission_amt="<?php echo $list->reseller_package_new_price - $list->reseller_package_prev_price; ?>" ><?php echo $package_details[0]['package_name']; ?></option>
                        <?php } } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 offset-md-3 ">
                        <label>Discount Amount</label>
                        <input type="number" min="1" step="1" class="form-control form-control-sm" name="reseller_coupon_amt" id="reseller_coupon_amt" value="<?php if(isset($reseller_coupon_info)){ echo $reseller_coupon_info['reseller_coupon_amt']; } ?>" placeholder="Enter Discount Amount" required>
                      </div>
                      <div class="form-group col-md-6 offset-md-3 ">
                        <label>Description</label>
                        <textarea class="form-control form-control-sm" name="reseller_coupon_descr" id="reseller_coupon_descr" rows="4"><?php if(isset($reseller_coupon_info)){ echo $reseller_coupon_info['reseller_coupon_descr']; } ?></textarea>
                        <!-- <input type="number" min="1" step="1" class="form-control form-control-sm" name="reseller_coupon_amt" id="reseller_coupon_amt" value="<?php if(isset($reseller_coupon_info)){ echo $reseller_coupon_info['reseller_coupon_amt']; } ?>" placeholder="Enter Discount Amount" required> -->
                      </div>

                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="reseller_coupon_status" id="reseller_coupon_status" value="0" <?php if(isset($reseller_coupon_info) && $reseller_coupon_info['reseller_coupon_status'] == 0){ echo 'checked'; } ?>>
                            <label for="reseller_coupon_status" class="custom-control-label">Disable This Reseller Coupon</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Reseller/Res_Package/reseller_coupon" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                          <?php if(isset($update)){
                            echo '<button type="submit" class="btn btn-sm btn-primary float-right px-4">Update</button>';
                          } else{
                            echo '<button type="submit" class="btn btn-sm btn-success float-right px-4">Save</button>';
                          } ?>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>


          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List All Reseller Coupon Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Coupon Code</th>
                    <th>Package</th>
                    <th class="wt_50">Discount</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($reseller_coupon_list)){
                      $i=0; foreach ($reseller_coupon_list as $list) { $i++;
                        $package_info = $this->Master_Model->get_info_arr_fields3('package_name', '', 'package_id', $list->package_id, '', '', '', '', 'smm_package');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Reseller/Res_Package/edit_reseller_coupon/<?php echo $list->reseller_coupon_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Reseller/Res_Package/delete_reseller_coupon/<?php echo $list->reseller_coupon_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Reseller Coupon Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php echo $list->reseller_coupon_code; ?></td>
                      <td><?php if($package_info){ echo $package_info[0]['package_name'];} ?></td>
                      <td><?php echo $list->reseller_coupon_amt; ?></td>
                      <td>
                        <?php if($list->reseller_coupon_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
                          else{ echo '<span class="text-success">Active</span>'; } ?>
                      </td>
                    </tr>
                  <?php } } ?>
                  </tbody>
                </table>
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

  $("#package_id, #reseller_coupon_amt").on("change", function(){
    var commission_amount =  $('#package_id').find("option:selected").attr('commission_amt');
    var reseller_coupon_amt = $('#reseller_coupon_amt').val();

    var commission_amount = parseFloat(commission_amount);
    if(reseller_coupon_amt == ''){ var reseller_coupon_amt = 0; }
    var reseller_coupon_amt = parseFloat(reseller_coupon_amt);

    if(commission_amount < reseller_coupon_amt){
      $('#reseller_coupon_amt').val('');
      toastr.error('Discount must be less than '+commission_amount);
    }
  });

</script>
