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
            <h4>Commission</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 card p-3">
            <div class="row">
              <div class="col-md-4">
                <b>Total Commission : <span class="text-primary">Rs.<?php echo $commission_total; ?><span></b>
              </div>
              <div class="col-md-4">
                <b>Redeem : </b>
              </div>
              <div class="col-md-4">
                <b>Balance : </b>
              </div>
            </div>
          </div>


          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List All Commission</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="">Package</th>
                    <th class="wt_75">Amount</th>
                    <th class="wt_75">Date</th>
                    <th class="wt_50">Type</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($commission_list)){
                    $i=0; foreach ($commission_list as $list) { $i++;
                      $invoice_info = $this->Master_Model->get_info_arr_fields3('package_name', '', 'invoice_id', $list->invoice_id, '', '', '', '', 'smm_invoice');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td><?php if($invoice_info){ echo $invoice_info[0]['package_name']; } ?></td>
                        <td><?php echo $list->commission_amount; ?></td>
                        <td><?php echo $list->commission_date; ?></td>
                        <td class="wt_50">
                          <?php if($list->commission_type == 1){ echo '<span class="text-success"><b>Direct Commission</b></span>'; }
                            elseif($list->commission_type == 2){ echo '<span class="text-primary"><b>Level Commission</b></span>'; } ?>
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
