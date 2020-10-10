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
            <h4>Overview</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <!-- <div class="col-md-12">
           <?php include('project_menu.php'); ?>
        </div> -->
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">  Overview</h3>
                <div class="card-tools">
                </div>
              </div>
              <!--  -->
              <div class="card-body p-0" >
                <form class="input_form m-0" id="form_action" role="form" action="" method="post">
                  <div class="row p-4">
                    <?php
                    $client_info = $this->Master_Model->get_info_arr_fields3('reseller_name', '', 'reseller_id', $project_info['client_id'], '', '', '', '', 'smm_reseller');
                    ?>
                    <div class="col-md-8">
                      <div class="card p-4">
                        <span>
                          <?php echo $project_info['project_descr']; ?>
                        </span>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card p-4">
                        <div class="row">
                         <div class="col-md-12">
                           <h6>Project Details</h6>
                           <hr>
                         </div>
                         <div class="col-6">
                           <p>Client</p>
                         </div>
                         <div class="col-6">
                           <p class="text-primary"><?php if($client_info){ echo $client_info[0]['reseller_name']; } ?></p>
                         </div>

                         <div class="col-6">
                           <p>Start Date</p>
                         </div>
                         <div class="col-6">
                           <p ><?php echo $project_info['project_start_date']; ?></p>
                         </div>

                         <div class="col-6">
                           <p>End Date</p>
                         </div>
                         <div class="col-6">
                           <p ><?php echo $project_info['project_end_date']; ?></p>
                         </div>

                         <div class="col-6">
                           <p>Priority</p>
                         </div>
                         <div class="col-6">
                           <p ><?php echo $project_info['project_piority']; ?></p>
                         </div>

                         <div class="col-6">
                           <p>Project No.</p>
                         </div>
                         <div class="col-6">
                           <p ><?php echo $project_info['project_no']; ?></p>
                         </div>

                         <div class="col-6">
                           <p>Budget Hours</p>
                         </div>
                         <div class="col-6">
                           <p ><?php echo $project_info['project_budget_hours']; ?> Hr.</p>
                         </div>

                         <!-- <div class="col-6">
                           <p>Actual Hours</p>
                         </div>
                         <div class="col-6">
                           <p >10 hours</p>
                         </div> -->

                         <div class="col-6">
                           <p>Project Progress </p>
                         </div>
                         <div class="col-6">
                          <span class="f-12">Complete: <?php echo $project_info['project_progress']; ?>%</span>
                           <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $project_info['project_progress']; ?>%;" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100"><?php echo $project_info['project_progress']; ?>%</div>
                           </div>
                         </div>
                     </div>
                    </div>
                  </div>


                  </div>

                </form>
              </div>
            </div>


          </div>

      </div>
    </section>
  </div>

</body>
</html>
