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
            <h4>Web Setup Request</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Web Setup Request</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
                    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
                    $pending_web_setup_request = $this->Master_Model->get_info_arr_fields3('web_setup_request_id', $smm_res_company_id, 'reseller_id', $smm_reseller_id, 'web_setup_request_status', '0', '', '', 'smm_web_setup_request');
                    if($pending_web_setup_request){
                      echo '<b class="text-danger">Previous Request Pending</b>';
                    } else{
                      echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                    }
                  } else{
                    echo '<a href="'.base_url().'Reseller/Res_Master/web_setup_request" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0 needs-validation" novalidate id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-6 ">
                        <label>Request No</label>
                        <input type="number" min="1" step="1" class="form-control form-control-sm" name="web_setup_request_no" id="web_setup_request_no" value="<?php if(isset($web_setup_request_info)){ echo $web_setup_request_info['web_setup_request_no']; } ?>" placeholder="Enter Request No" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Request Date</label>
                        <input type="text" class="form-control form-control-sm" name="web_setup_request_date" value="<?php if(isset($web_setup_request_info)){ echo $web_setup_request_info['web_setup_request_date']; } else{ echo date('d-m-Y'); } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Coupon Date" required>
                      </div>
                      <div class="form-group col-md-12 select_sm">
                        <label>Type</label>
                        <select class="form-control select2" name="web_setup_request_type" id="web_setup_request_type" data-placeholder="Select Type" required >
                          <option value="">Select Type</option>
                          <option value="1" <?php if(isset($web_setup_request_info) && $web_setup_request_info['web_setup_request_type'] == '1'){ echo 'selected'; } ?>>Setting up my website</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Description</label>
                        <textarea class="textarea form-control form-control-sm" name="web_setup_request_descr" id="web_setup_request_descr" rows="8"><?php if(isset($web_setup_request_info)){ echo $web_setup_request_info['web_setup_request_descr']; } ?></textarea>
                      </div>

                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="web_setup_request_status" id="web_setup_request_status" value="0" <?php if(isset($web_setup_request_info) && $web_setup_request_info['web_setup_request_status'] == 0){ echo 'checked'; } ?>>
                            <label for="web_setup_request_status" class="custom-control-label">Disable This Web Setup Request</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Reseller/Res_Master/web_setup_request" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Web Setup Request Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th class="wt_50">Number</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($web_setup_request_list)){
                      $i=0; foreach ($web_setup_request_list as $list) { $i++;
                        // $package_info = $this->Master_Model->get_info_arr_fields3('package_name', '', 'package_id', $list->package_id, '', '', '', '', 'smm_package');
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Reseller/Res_Master/edit_web_setup_request/<?php echo $list->web_setup_request_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Reseller/Res_Master/delete_web_setup_request/<?php echo $list->web_setup_request_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Web Setup Request Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php echo $list->web_setup_request_no; ?></td>
                      <td><?php echo $list->web_setup_request_date; ?></td>
                      <td>
                        <?php if($list->web_setup_request_type == 1){ echo 'Setting up my website'; } ?>
                      </td>
                      <td>
                        <?php if($list->web_setup_request_status == 0){ echo '<span class="text-danger">Pending</span>'; }
                          else{ echo '<span class="text-success">Complete</span>'; } ?>
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
