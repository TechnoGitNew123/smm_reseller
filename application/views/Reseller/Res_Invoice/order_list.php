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
            <h4>Order List</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Order</h3>
              </div>
              <div class="card-body p-2" style="overflow-x: auto;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="wt_30">#</th>
                    <th class="wt_50">Order No</th>
                    <th class="wt_75">Date</th>
                    <th>Package Name</th>
                    <th class="wt_75">Amount</th>
                    <th class="wt_50">Status</th>
                    <th class="wt_50">View Invoice</th>
                    <th class="wt_50">Cancel Order</th>
                    <th class="wt_50">Renew</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($order_list)){
                    $i=0; foreach ($order_list as $list) { $i++;
                      $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->client_id, '', '', '', '', 'smm_reseller');
                      $invoice_info = $this->Master_Model->get_info_arr_fields3('invoice_id', '', 'order_id', $list->order_id, '', '', '', '', 'smm_invoice');
                      $package_info = $this->Master_Model->get_info_arr_fields3('package_id, package_is_refundable, package_is_renewable', '', 'package_id', $list->package_id, '', '', '', '', 'smm_package');

                      $order_date = strtotime($list->order_date);
                      $cancel_exp_date = strtotime("+2 day", $order_date);
                      $cancel_exp_date = date('d-m-Y', $cancel_exp_date);

                      $order_end_date = strtotime($list->order_end_date);
                      $notf_start_date = strtotime("-7 day", $order_end_date);
                      $notf_start_date = date('d-m-Y', $notf_start_date);

                      $today = date('d-m-Y');
                    ?>
                      <tr>
                        <td class="wt_30"><?php echo $i; ?></td>
                        <td>ORD-00<?php echo $list->order_no; ?></td>
                        <td><?php echo $list->order_date; ?></td>
                        <td><?php echo $list->package_name; ?></td>
                        <td><?php echo $list->order_net_amount; ?></td>
                        <!-- <td><?php if($reseller_info){ echo $reseller_info[0]['reseller_name']; } ?></td> -->
                        <td>
                          <?php if($list->payment_status == 0){ echo '<span class="text-danger">UnPaid</span>'; }
                            else{ echo '<span class="text-success">Paid</span>'; } ?>
                        </td>
                        <td> <?php if($invoice_info){ ?>
                          <a  target="_blank" href="<?php echo base_url() ?>Reseller/Res_Invoice/admin_invoice_print/<?php echo $invoice_info[0]['invoice_id']; ?>" type="button" class="btn btn-outline-primary btn-xs">Invoice</a>
                        <?php } ?> </td>
                        <td>
                          <?php if((strtotime($today) < strtotime($cancel_exp_date)) && $list->order_status == '1' && $package_info[0]['package_is_refundable'] == '1'){  ?>
                            <input type="hidden" class="order_id" value="<?php echo $list->order_id; ?>">
                            <input type="hidden" class="order_no" value="<?php echo $list->order_no; ?>">
                            <button type="button" class="btn btn-outline-danger btn-xs cancel_order" data-toggle="modal" data-target="#modal_cancel_order">
                              Cancel Order
                            </button>
                          <?php } elseif ($list->order_status == '2') {
                            echo '<span class="text-danger">Canceled</span>';
                            if($list->order_cancel_approve == '0'){
                              echo '<br><span class="text-warning"> - Pending</span>';
                            } else if($list->order_cancel_approve == '1'){
                              echo '<br><span class="text-success"> - Approved</span>';
                            } else if($list->order_cancel_approve == '2'){
                              echo '<br><span class="text-danger"> - Rejected</span>';
                            }
                          } ?>
                        </td>
                        <td>
                          <?php if((strtotime($today) > strtotime($notf_start_date)) && (strtotime($today) <= strtotime($list->order_end_date)) && $list->order_status == '1'){
                            echo '<a href="'.base_url().'Reseller/Res_Payment/renew_package_payment/'.$list->order_id.'" type="button" class="btn btn-primary bg-green btn-xs">Renew</a>';
                          } elseif((strtotime($today) > strtotime($list->order_end_date))){
                            echo 'Expired';
                          } ?>
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

  <!-- Modal -->
  <div class="modal fade" id="modal_cancel_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="<?php echo base_url(); ?>Reseller/Res_Invoice/order_cancel" method="post">
          <label class="pl-4">Do you want to camcel this order.</label>
          <div class="modal-body">
            <div class="form-input">
              <input type="hidden" id="order_id" name="order_id" value="">
              <label for="">Order No. <span id="order_no"></span> </label>
              <!-- <input class="form-control form-control-sm" type="text" id="order_no" name="order_no" value=""> -->

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).on('click','.cancel_order', function(){

      var order_id = $(this).closest('td').find('.order_id').val();
      var order_no = $(this).closest('td').find('.order_no').val();
      $('#order_id').val(order_id);
      $('#order_no').text(order_no);
    });
  </script>
</body>
</html>
