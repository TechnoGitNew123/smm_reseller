<!DOCTYPE html>
<html>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center mt-2">
            <h1> Dashboard Information</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <hr>
        <h4 class="mb-3">Master Summary</h4>
        <div class="row">
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Master/reseller">
              <div class="info-box">
                <span class="info-box-icon text-info"><i class="far fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Reseller</span>
                  <span class="info-box-number text-primary f-18"><?php echo $reseller_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Package/my_package_list">
              <div class="info-box">
                <span class="info-box-icon text-success"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">My Packages</span>
                  <span class="info-box-number text-primary f-18"><?php echo $package_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Package/reseller_coupon">
              <div class="info-box">
                <span class="info-box-icon text-primary"><i class="fas fa-tags"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Coupon</span>
                  <span class="info-box-number text-primary f-18"><?php echo $coupon_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Invoice/order_list">
              <div class="info-box">
                <span class="info-box-icon text-danger"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Order</span>
                  <span class="info-box-number text-primary f-18"><?php echo $order_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Invoice/invoice_list">
              <div class="info-box">
                <span class="info-box-icon text-info"><i class="far fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Invoice (By Admin)</span>
                  <span class="info-box-number text-primary f-18"><?php echo $admin_invoice_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Invoice/invoice_to_cust_list">
              <div class="info-box">
                <span class="info-box-icon text-success"><i class="far fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Invoice (To Customer)</span>
                  <span class="info-box-number text-primary f-18"><?php echo $customer_invoice_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Project/project">
              <div class="info-box">
                <span class="info-box-icon text-primary"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Project</span>
                  <span class="info-box-number text-primary f-18"><?php echo $project_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Project/task">
              <div class="info-box">
                <span class="info-box-icon text-danger"><i class="fas fa-tasks"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Task</span>
                  <span class="info-box-number text-primary f-18"><?php echo $task_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Project/ticket">
              <div class="info-box">
                <span class="info-box-icon text-info"><i class="fas fa-ticket-alt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Ticket</span>
                  <span class="info-box-number text-primary f-18"><?php echo $ticket_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Master/announcement">
              <div class="info-box">
                <span class="info-box-icon text-warning"><i class="fas fa-bullhorn"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Announcement</span>
                  <span class="info-box-number text-primary f-18"><?php echo $announcement_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Master/testimonial">
              <div class="info-box">
                <span class="info-box-icon text-danger"><i class="fas fa-comment-dots"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Testimonial</span>
                  <span class="info-box-number text-primary f-18"><?php echo $testimonial_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-6">
            <a href="<?php echo base_url(); ?>Reseller/Res_Master/blog">
              <div class="info-box">
                <span class="info-box-icon text-danger"><i class="fas fa-blog"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">Blog</span>
                  <span class="info-box-number text-primary f-18"><?php echo $blog_cnt; ?></span>
                </div>
              </div>
            </a>
          </div>

        </div>

        <hr>

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Projects</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Order No</th>
                    <th>Client</th>
                    <!-- <th >Date</th> -->
                    <th>Package Name</th>
                    <th >Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($order_list)){
                    $i=0; foreach ($order_list as $list) { $i++;
                      $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->client_id, '', '', '', '', 'smm_reseller');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <!-- <td class="text-center">
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Reseller/Res_Order/view_order/<?php echo $list->order_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-eye text-success"></i></a>
                          </div>
                        </td> -->
                        <td>ORD-00<?php echo $list->order_no; ?></td>
                        <td><?php if($reseller_info){ echo $reseller_info[0]['reseller_name']; } ?></td>
                        <!-- <td><?php echo $list->order_date; ?></td> -->
                        <td><?php echo $list->package_name; ?></td>
                        <td><?php echo $list->order_net_amount; ?></td>
                      </tr>
                    <?php } } ?>
                  </tbody>
                </table>
                <!-- <button type="button" class="btn btn-block btn-primary btn-xs w-25 my-3 ml-2">My Projects</button> -->
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer Invoices</h3>
              </div>
              <div class="card-body p-2">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Invoice No</th>
                    <th class="">Package</th>
                    <th >Date</th>
                    <!-- <th >Basic Amt</th> -->
                    <!-- <th >GST Amt</th> -->
                    <th >Total</th>
                    <!-- <th class="wt_50">Type</th> -->
                    <!-- <th class="wt_50">Status</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($invoice_list)){
                    $i=0; foreach ($invoice_list as $list) { $i++;
                      // $reseller_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $list->reseller_id, '', '', '', '', 'smm_reseller');
                      // $project_info = $this->Master_Model->get_info_arr_fields3('project_name', '', 'project_id', $list->project_id, '', '', '', '', 'smm_project');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td><?php echo $list->invoice_no_prefix.''.$list->invoice_no; ?></td>
                        <!-- <td><?php if($reseller_info){ echo $reseller_info[0]['reseller_name']; } ?></td> -->
                        <!-- <td><?php if($project_info){ echo $project_info[0]['project_name']; } ?></td> -->
                        <td><?php echo $list->package_name; ?></td>
                        <td><?php echo $list->invoice_date; ?></td>
                        <!-- <td><?php echo $list->invoice_basic_amt; ?></td> -->
                        <!-- <td><?php echo $list->invoice_gst_amt; ?></td> -->
                        <td><?php echo $list->invoice_net_amt; ?></td>
                        <!-- <td class="wt_50">
                          <?php if($list->invoice_addedby_type == 3){ echo '<span class="text-success"><b>Own Order</b></span>'; }
                            elseif($list->invoice_addedby_type == 4){ echo '<span class="text-danger"><b>Level Invoice</b></span>'; } ?>
                        </td> -->
                      </tr>
                    <?php } } ?>
                  </tbody>
                </table>
                <!-- <button type="button" class="btn btn-block btn-primary btn-xs w-25 my-3 ml-2">All Invoices</button> -->
              </div>
            </div>
          </div>

        </div>


      </div>
    </section>
  </div>

</body>
</html>
