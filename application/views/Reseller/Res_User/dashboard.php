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
                <span class="info-box-icon text-success"><i class="far fa-user"></i></span>
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
                <span class="info-box-icon text-info"><i class="far fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text text-secondary">My Packages</span>
                  <span class="info-box-number text-primary f-18"><?php echo $package_cnt; ?></span>
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
            <a href="<?php echo base_url(); ?>Reseller/Res_Master/announcement">
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
            <div class="info-box">
              <span class="info-box-icon text-success"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Completed Project</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-warning"><i class="fas fa-calculator"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">In Progress Project</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-danger"><i class="far fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Not Started Project</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="fas fa-calculator"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Deferred Project</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-success"><i class="far fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Paid Amount</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon text-info"><i class="far fa-money-bill-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-secondary">Due Amount</span>
                <span class="info-box-number text-primary f-18">10</span>
              </div>
            </div>
          </div>

        </div>

        <hr>

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Projects</h3>
              </div>
              <div class="card-body p-0">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>Project Summary</th>
                      <th>Priority</th>
                      <th>End Date</th>
                      <th>Progress</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($project_list as $list) { ?>
                      <tr>
                        <td><?php echo $list->project_name; ?></td>
                        <td>
                          <span class="badge bg-success"><?php echo $list->project_piority; ?></span>
                        </td>
                        <td><?php echo $list->project_end_date; ?></td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-danger" style="width: <?php echo $list->project_progress; ?>%"></div>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                    <!--  -->
                  </tbody>
                </table>
                <!-- <button type="button" class="btn btn-block btn-primary btn-xs w-25 my-3 ml-2">My Projects</button> -->
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List All Invoices</h3>
              </div>
              <div class="card-body p-0">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>Invoice#</th>
                      <th>Project</th>
                      <th>Total</th>
                      <th>Invoice Date</th>
                      <th>Due Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Update software</td>
                      <td>25000</td>
                      <td>10-09-2020</td>
                      <td>19-10-2020</td>
                      <td><span class="badge bg-success">High</span></td>
                    </tr>
                  </tbody>
                </table>
                <button type="button" class="btn btn-block btn-primary btn-xs w-25 my-3 ml-2">All Invoices</button>
              </div>
            </div>
          </div>

        </div>


      </div>
    </section>
  </div>

</body>
</html>
