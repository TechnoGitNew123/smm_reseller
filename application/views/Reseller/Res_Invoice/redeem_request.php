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
            <h4>Redeem Request</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Redeem Request</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
                    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
                    $redeem_request_list = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_id',$smm_reseller_id,'redeem_request_status','0','','','redeem_request_id','DESC','smm_redeem_request');
                    if($redeem_request_list){
                      echo '<span class="text-danger"><b>Previous Request Pending</b></span>';
                    } else{
                      echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                    }
                  } else{
                    echo '<a href="'.base_url().'Reseller/Res_Master/redeem_request" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0 needs-validation" novalidate id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-6 offset-md-3">
                        <label>Redeem Request Date</label>
                        <input type="text" class="form-control form-control-sm" name="redeem_request_date" value="<?php if(isset($redeem_request_info)){ echo $redeem_request_info['redeem_request_date']; } else{ echo date('d-m-Y'); } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask readonly required>
                      </div>
                      <div class="form-group col-md-6 offset-md-3">
                        <label>Outstanding Balance Amount</label>
                        <input type="number" min="1" step="1" class="form-control form-control-sm" name="redeem_request_outstanding_amt" id="redeem_request_outstanding_amt" value="<?php if(isset($redeem_request_info)){ echo $redeem_request_info['redeem_request_outstanding_amt']; } elseif(isset($wallet_balance)){ echo $wallet_balance; } ?>" placeholder="" readonly required>
                      </div>
                      <div class="form-group col-md-6 offset-md-3">
                        <label>Redeem Amount</label>
                        <input type="number" min="1" step="1" class="form-control form-control-sm" name="redeem_request_amount" id="redeem_request_amount" value="<?php if(isset($redeem_request_info)){ echo $redeem_request_info['redeem_request_amount']; } ?>" placeholder="" required>
                      </div>
                      <div class="form-group col-md-6 offset-md-3">
                        <label>Balance Amount</label>
                        <input type="number" min="0" class="form-control form-control-sm" name="redeem_request_balance" id="redeem_request_balance" value="<?php if(isset($redeem_request_info)){ echo $redeem_request_info['redeem_request_balance']; }?> " placeholder="" readonly required>
                      </div>
                      <!-- <div class="form-group col-md-6 offset-md-3">
                        <label>Remaining Balance Amount</label>
                        <input type="text" class="form-control form-control-sm" name="redeem_request_rem_amt" id="redeem_request_rem_amt" value="<?php if(isset($redeem_request_info)){ echo $redeem_request_info['redeem_request_rem_amt']; } ?>" placeholder="" required>
                      </div> -->

                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <!-- <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="redeem_request_status" id="redeem_request_status" value="0" <?php if(isset($redeem_request_info) && $redeem_request_info['redeem_request_status'] == 0){ echo 'checked'; } ?>>
                            <label for="redeem_request_status" class="custom-control-label">Disable This Redeem Request</label>
                          </div> -->
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Reseller/Res_Master/redeem_request" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Redeem Request Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="wt_30">#</th>
                    <!-- <th class="wt_50">Action</th> -->
                    <th>Outstanding</th>
                    <th>Request Amount</th>
                    <th>Balance</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($redeem_request_list)){
                      $i=0; foreach ($redeem_request_list as $list) { $i++;
                    ?>
                    <tr>
                      <td class=""><?php echo $i; ?></td>
                      <!-- <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Reseller/Res_Master/edit_redeem_request/<?php echo $list->redeem_request_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Reseller/Res_Master/delete_redeem_request/<?php echo $list->redeem_request_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Redeem Request Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td> -->
                      <td>₹<?php echo $list->redeem_request_outstanding_amt; ?></td>
                      <td>₹<?php echo $list->redeem_request_amount; ?></td>
                      <td>₹<?php echo $list->redeem_request_balance; ?></td>
                      <td>
                        <?php if($list->redeem_request_status == 0){ echo '<span class="text-primary">Pending</span>'; }
                              elseif($list->redeem_request_status == 1){ echo '<span class="text-success">Accepted</span>'; }
                              elseif($list->redeem_request_status == 2){ echo '<span class="text-danger">Rejected</span>'; }  ?>
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
  $(document).on('change', '#redeem_request_amount', function(){
    var redeem_request_outstanding_amt = $('#redeem_request_outstanding_amt').val();
    if(redeem_request_outstanding_amt == ''){ var redeem_request_outstanding_amt = 0; }
    var redeem_request_outstanding_amt = parseFloat(redeem_request_outstanding_amt);

    var redeem_request_amount = $('#redeem_request_amount').val();
    if(redeem_request_amount == ''){ var redeem_request_amount = 0; }
    var redeem_request_amount = parseFloat(redeem_request_amount);

    if(redeem_request_amount > redeem_request_outstanding_amt){
      toastr.error('Invalid Amount');
      $('#redeem_request_amount').val('');
      $('#redeem_request_balance').val('');
    } else{
      var redeem_request_balance = redeem_request_outstanding_amt-redeem_request_amount;
      $('#redeem_request_balance').val(redeem_request_balance);
    }


  });
</script>
