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
            <h4>Invoice</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Invoice</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Reseller/Res_Invoice/invoice" class="btn btn-sm btn-outline-info">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">

                    <div class="form-group col-md-4 offset-md-2">
                      <label>Invoice No.</label>
                      <input type="number" class="form-control form-control-sm" name="invoice_no" id="invoice_no" value="<?php if(isset($invoice_info)){ echo $invoice_info['invoice_no']; } elseif(isset($invoice_no)){ echo $invoice_no; } ?>"  placeholder="Enter Invoice No." required readonly>
                    </div>
                    <div class="form-group col-md-4 ">
                      <label>Invoice Date</label>
                      <input type="text" class="form-control form-control-sm" name="invoice_date" value="<?php if(isset($invoice_info)){ echo $invoice_info['invoice_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Invoice Date" required  data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask >
                    </div>
                    <div class="form-group col-md-8 offset-md-2 select_sm">
                      <label>Reseller</label>
                      <select class="form-control select2" name="reseller_id" id="reseller_id" data-placeholder="Select Reseller">
                        <option value="">Select Reseller</option>
                        <?php if(isset($reseller_list)){ foreach ($reseller_list as $list) { ?>
                        <option value="<?php echo $list->reseller_id; ?>" <?php if(isset($invoice_info) && $invoice_info['reseller_id'] == $list->reseller_id){ echo 'selected'; } if($list->reseller_status == 0){ echo 'disabled'; } ?>><?php echo $list->reseller_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-8 offset-md-2 select_sm">
                      <label>Project</label>
                      <select class="form-control select2" name="project_id" id="project_id" data-placeholder="Select Project">
                        <option value="">Select Project</option>
                        <?php if(isset($project_list)){ foreach ($project_list as $list) { ?>
                        <option value="<?php echo $list->project_id; ?>" <?php if(isset($invoice_info) && $invoice_info['project_id'] == $list->project_id){ echo 'selected'; } if($list->project_status == 0){ echo 'disabled'; } ?>><?php echo $list->project_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>



                    <div class="form-group col-md-12">
                      <hr>
                      <div class="row">
                        <div class="col-md-6">
                          <h5>Invoice Item</h5>
                        </div>
                        <div class="col-md-6 text-right">
                          <button type="button" id="add_row2" class="btn btn-sm btn-info mb-3 mr-1" width="150px">Add Row</button>
                        </div>
                      </div>
                    </div>


                  <div class="col-md-12">
                    <div class="" style="overflow-x:auto;">
                      <table id="myTable2" class="table table-bordered tbl_list">
                        <thead>
                        <tr>
                          <th>Item</th>
                          <th class="wt_125">Qty</th>
                          <th class="wt_125">Rate</th>
                          <th class="wt_125">Amount</th>
                          <th class="wt_50"></th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($invoice_item_list)){ $k = 0; foreach ($invoice_item_list as $list) { ?>
                            <input type="hidden" name="input[<?php echo $k; ?>][invoice_item_id]" value="<?php echo $list->invoice_item_id; ?>">
                            <tr>
                              <td>
                                <input type="text" class="form-control form-control-sm" name="input[<?php echo $k; ?>][invoice_item_name]" value="<?php echo $list->invoice_item_name; ?>" >
                              </td>
                              <td class="wt_125">
                                <input type="number" class="form-control form-control-sm" name="input[<?php echo $k; ?>][invoice_item_qty]" value="<?php echo $list->invoice_item_qty; ?>" >
                              </td>
                              <td class="wt_125">
                                <input type="number" min="0" class="form-control form-control-sm" name="input[<?php echo $k; ?>][invoice_item_rate]" value="<?php echo $list->invoice_item_rate; ?>" >
                              </td>
                              <td class="wt_125">
                                <input type="number" min="0" class="form-control form-control-sm" name="input[<?php echo $k; ?>][invoice_item_amount]" value="<?php echo $list->invoice_item_amount; ?>" >
                              </td>
                              <td class="wt_50">
                                <?php if($k > 0){ ?><a class="rem_row"><i class="fa fa-trash text-danger"></i></a><?php } ?>
                              </td>
                            </tr>
                          <?php $k++;  } } else{ ?>
                            <tr>
                              <td>
                                <input type="text" class="form-control form-control-sm" name="input[0][invoice_item_name]" value="" >
                              </td>
                              <td class="wt_125">
                                <input type="number" class="form-control form-control-sm" name="input[0][invoice_item_qty]" value="" >
                              </td>
                              <td class="wt_125">
                                <input type="number" min="0" class="form-control form-control-sm" name="input[0][invoice_item_rate]" value="" >
                              </td>
                              <td class="wt_125">
                                <input type="number" min="0" class="form-control form-control-sm" name="input[0][invoice_item_amount]" value="" >
                              </td>
                              <td class="wt_50"></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <hr>
                  </div>

                  <div class="form-group col-md-7 select_sm">

                    <label>Enter Notes If Any</label>
                    <textarea class="form-control form-control-sm" name="invoice_note" id="invoice_note" rows="6"><?php if(isset($invoice_info)){ echo $invoice_info['invoice_note']; } ?></textarea>

                    <label class="mt-2">Status</label>
                    <select class="form-control select2 form-control-sm" name="invoice_status" id="invoice_status">
                      <option value="0" <?php if(isset($invoice_info) && $invoice_info['invoice_status'] == '0'){ echo 'selected'; } ?>>UnPaid</option>
                      <option value="1" <?php if(isset($invoice_info) && $invoice_info['invoice_status'] == '1'){ echo 'selected'; } ?>>Paid</option>
                    </select>
                  </div>
                  <div class="form-group col-md-5">
                    <div class="row">
                      <div class="col-6 mb-3 mt-4 text-right">
                        <label>Basic Amount</label>
                      </div>
                      <div class="col-6 mb-3 mt-4">
                        <input type="number" min="0" class="form-control form-control-sm" name="invoice_basic_amt" id="invoice_basic_amt" value="<?php if(isset($invoice_info)){ echo $invoice_info['invoice_basic_amt']; } ?>" required>
                      </div>
                      <div class="col-6 mb-3 text-right">
                        <label>GST Amount</label>
                      </div>
                      <div class="col-6 mb-3">
                        <input type="number" min="0" class="form-control form-control-sm" name="invoice_gst_amt" id="invoice_gst_amt" value="<?php if(isset($invoice_info)){ echo $invoice_info['invoice_gst_amt']; } ?>" required>
                      </div>
                      <div class="col-6 mb-3 text-right">
                        <label>Net Amount</label>
                      </div>
                      <div class="col-6 mb-3">
                        <input type="number" min="0" class="form-control form-control-sm" name="invoice_net_amt" id="invoice_net_amt" value="<?php if(isset($invoice_info)){ echo $invoice_info['invoice_net_amt']; } ?>" required>
                      </div>
                    </div>
                  </div>
                </div>

                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <!-- <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="invoice_status" id="invoice_status" value="0" <?php if(isset($invoice_info) && $invoice_info['invoice_status'] == 0){ echo 'checked'; } ?>>
                          <label for="invoice_status" class="custom-control-label">Disable This Invoice</label>
                        </div> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Reseller/Res_Invoice/invoice" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                        <?php if(isset($update)){
                          echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
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

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List All Invoice</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th class="wt_50">Invoice No</th>
                    <th class="">Reseller</th>
                    <th class="">Project</th>
                    <th class="wt_75">Date</th>
                    <!-- <th class="wt_75">Basic Amt</th> -->
                    <!-- <th class="wt_75">GST Amt</th> -->
                    <th class="wt_75">Total Amt</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($invoice_list)){
                    $i=0; foreach ($invoice_list as $list) { $i++;
                      $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->reseller_id, '', '', '', '', 'smm_reseller');
                      $project_info = $this->Master_Model->get_info_arr_fields3('project_name', '', 'project_id', $list->project_id, '', '', '', '', 'smm_project');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Reseller/Res_Invoice/edit_invoice/<?php echo $list->invoice_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Reseller/Res_Invoice/delete_invoice/<?php echo $list->invoice_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Invoice');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->invoice_no; ?></td>
                        <td><?php if($reseller_info){ echo $reseller_info[0]['reseller_name']; } ?></td>
                        <td><?php if($project_info){ echo $project_info[0]['project_name']; } ?></td>
                        <td><?php echo $list->invoice_date; ?></td>
                        <!-- <td><?php echo $list->invoice_basic_amt; ?></td> -->
                        <!-- <td><?php echo $list->invoice_gst_amt; ?></td> -->
                        <td><?php echo $list->invoice_net_amt; ?></td>
                        <td>
                          <?php if($list->invoice_status == 0){ echo '<span class="text-danger">UnPaid</span>'; }
                            else{ echo '<span class="text-success">Paid</span>'; } ?>
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

<!-- <script type="text/javascript">
  // Add Row...
  <?php if(isset($update)){ ?>
  var i = <?php echo $i-1; ?>
  <?php } else { ?>
  var i = 0;
  <?php } ?>

  $('#add_row').click(function(){
    i++;
    var row = ''+
    '<tr>'+
      '<td>'+
        '<input type="text" class="form-control form-control-sm" name="invoice_file_name[]" required>'+
      '</td>'+
      '<td class="wt_250">'+
        '<input type="file"  class="form-control form-control-sm" name="invoice_file_image[]" required>'+
      '</td>'+
      '<td class="wt_50"><a class="rem_row"><i class="fa fa-trash text-danger"></i></a></td>'+
    '</tr>';
    $('#myTable').append(row);
  });

  $('#myTable').on('click', '.rem_row', function () {
    $(this).closest('tr').remove();
    var invoice_file_id = $(this).closest('tr').find('.invoice_file_id').val();
    $.ajax({
      url:'<?php echo base_url(); ?>Reseller/Res_Invoice/delete_invoice_file',
      type: 'POST',
      data: {"invoice_file_id":invoice_file_id},
      context: this,
      success: function(result){
        toastr.error('File Deleted successfully');
      }
    });
  });
</script> -->

<script type="text/javascript">
  // Add Row...
  <?php if(isset($update)){ ?>
  var k = <?php echo $k-1; ?>
  <?php } else { ?>
  var k = 0;
  <?php } ?>

  $('#add_row2').click(function(){
    k++;
    var row = ''+
    '<tr>'+
      '<td>'+
        '<input type="text" class="form-control form-control-sm" name="input['+k+'][invoice_item_name]" value="" required>'+
      '</td>'+
      '<td class="wt_125">'+
        '<input type="number" min="0" class="form-control form-control-sm" name="input['+k+'][invoice_item_qty]" value="" required>'+
      '</td>'+
      '<td class="wt_125">'+
        '<input type="number" min="0" class="form-control form-control-sm" name="input['+k+'][invoice_item_rate]" value="" required>'+
      '</td>'+
      '<td class="wt_125">'+
        '<input type="number" min="0" class="form-control form-control-sm" name="input['+k+'][invoice_item_amount]" value="" required>'+
      '</td>'+
      '<td class="wt_50"><a class="rem_row"><i class="fa fa-trash text-danger"></i></a></td>'+
    '</tr>';
    $('#myTable2').append(row);
  });

  $('#myTable2').on('click', '.rem_row', function () {
    $(this).closest('tr').remove();
  });
</script>
