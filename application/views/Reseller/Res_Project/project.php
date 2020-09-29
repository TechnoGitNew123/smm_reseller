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
            <h4>Project</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 <?php if(!isset($update)){ echo 'd-none'; } ?>">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?> card-default">
              <div class="card-header">
                <h3 class="card-title"> <?php //if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Project</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    //echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Reseller/Res_Project/project" class="btn btn-sm btn-outline-info">Project List</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="col-md-12 row px-0 py-0">

                      <div class="form-group col-md-6 select_sm">
                        <label>Project No.</label>
                        <input type="number" class="form-control form-control-sm" name="project_no" id="project_no" value="<?php if(isset($project_info)){ echo $project_info['project_no']; } ?>"  placeholder="Enter Project No." required disabled>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Project Date</label>
                        <input type="text" class="form-control form-control-sm" name="project_date" value="<?php if(isset($project_info)){ echo $project_info['project_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Project Date" required  disabled>
                      </div>
                      <div class="form-group col-md-12 select_sm">
                        <label>Project Name</label>
                        <input type="text" class="form-control form-control-sm" name="project_name" id="project_name" value="<?php if(isset($project_info)){ echo $project_info['project_name']; } ?>"  placeholder="Enter Name of Project" required  disabled>
                      </div>
                      <!-- <div class="form-group col-md-6 select_sm">
                        <label>P. O. No.</label>
                        <input type="number" class="form-control form-control-sm" name="project_po_no" id="project_po_no" value="<?php if(isset($project_info)){ echo $project_info['project_po_no']; } ?>"  placeholder="Enter P. O. No." required >
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Phase No. </label>
                        <input type="number" class="form-control form-control-sm" name="project_phase_no" id="project_phase_no" value="<?php if(isset($project_info)){ echo $project_info['project_phase_no']; } ?>"  placeholder="Phase No." required>
                      </div> -->
                      <!-- <div class="form-group col-md-6 select_sm">
                        <label>Client(Customer)</label>
                        <select class="form-control select2" name="client_id" id="client_id" data-placeholder="Client(Customer)" disabled>
                          <option value="">Select Client(Customer)</option>
                          <?php if(isset($client_list)){ foreach ($client_list as $list) { ?>
                          <option value="<?php echo $list->client_id; ?>" <?php if(isset($project_info) && $project_info['client_id'] == $list->client_id){ echo 'selected'; } ?>><?php echo $list->client_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div> -->
                      <div class="form-group col-md-3 select_sm">
                        <label>Start Date</label>
                        <input type="text" class="form-control form-control-sm" name="project_start_date" value="<?php if(isset($project_info)){ echo $project_info['project_start_date']; } ?>" id="date3" data-target="#date3" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Start Date" required disabled>
                      </div>
                      <div class="form-group col-md-3 select_sm">
                        <label>End Date</label>
                        <input type="text" class="form-control form-control-sm" name="project_end_date" value="<?php if(isset($project_info)){ echo $project_info['project_end_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="End Date" required disabled>
                      </div>
                      <div class="form-group col-md-3 select_sm">
                        <label>Budget Hours</label>
                        <input type="number" class="form-control form-control-sm" name="project_budget_hours" id="project_budget_hours" value="<?php if(isset($project_info)){ echo $project_info['project_budget_hours']; } ?>"  placeholder="Budget Hours" required disabled>
                      </div>
                      <div class="form-group col-md-3 select_sm">
                        <label>Priority</label>
                        <select class="form-control select2" name="project_piority" id="project_piority" data-placeholder="Priority" disabled>
                          <option value="">Priority</option>
                          <option value="Low" <?php if(isset($project_info) && $project_info['project_piority'] == 'Low'){ echo 'selected'; } ?>>Low</option>
                          <option value="Medium" <?php if(isset($project_info) && $project_info['project_piority'] == 'Medium'){ echo 'selected'; } ?>>Medium</option>
                          <option value="High" <?php if(isset($project_info) && $project_info['project_piority'] == 'High'){ echo 'selected'; } ?>>High</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12 select_sm">
                        <label>Project Members</label>
                        <select class="form-control select2" multiple name="project_member[]" id="project_member[]" data-placeholder="Select Project Members" disabled>
                          <option value="">Select Project Members</option>
                          <?php if(isset($user_list)){ foreach ($user_list as $list) { ?>
                          <option value="<?php echo $list->user_id; ?>" <?php if(isset($project_info)){
                            $project_member_arr =  $project_info['project_member'];
                            $project_member_arr = explode(',',$project_member_arr);
                            foreach ($project_member_arr as $project_member) {
                              if($project_member == $list->user_id){
                                echo 'selected';
                              }
                            }
                          } if($list->user_status == 0){ echo ' disabled'; } ?>><?php echo $list->user_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Revisions</label>
                        <!-- <p><?php if(isset($project_info)){ echo $project_info['project_revisions']; } ?></p> -->
                        <input type="text" class="form-control form-control-sm" name="project_revisions" id="project_revisions" value="<?php if(isset($project_info)){ echo $project_info['project_revisions']; } ?>"  placeholder="Enter Revisions" required disabled>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Status</label>
                        <select class="form-control select2" name="project_status" id="project_status" data-placeholder="Select Status" disabled>
                          <option value="">Select Status</option>
                          <option value="0" <?php if(isset($project_info) && $project_info['project_status'] == '0'){ echo 'selected'; } ?>>Not Started</option>
                          <option value="1" <?php if(isset($project_info) && $project_info['project_status'] == '1'){ echo 'selected'; } ?>>In Progress</option>
                          <option value="2" <?php if(isset($project_info) && $project_info['project_status'] == '2'){ echo 'selected'; } ?>>Completed</option>
                          <option value="3" <?php if(isset($project_info) && $project_info['project_status'] == '3'){ echo 'selected'; } ?>>Cancelled</option>
                          <option value="4" <?php if(isset($project_info) && $project_info['project_status'] == '4'){ echo 'selected'; } ?>>Hold</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Progress</label>
                        <div class="progress">
                          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php if(isset($project_info)){ echo $project_info['project_progress']; } ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php if(isset($project_info)){ echo $project_info['project_progress']; } ?>%">
                            <?php if(isset($project_info)){ echo $project_info['project_progress']; } ?> %
                          </div>
                        </div>
                      </div>



                    </div>
                    <div class="col-md-12 px-0 py-0">
                      <div class="form-group col-md-12 select_sm">
                        <style media="screen">
                        .note-editing-area {
                          height: 351px !important;
                        }
                        </style>
                        <label>Description</label>
                        <span>
                          <?php if(isset($project_info)){ echo $project_info['project_descr']; } ?>
                        </span>
                        <!-- <textarea class="textarea form-control form-control-sm" name="project_descr" id="project_descr" placeholder="Place some text here" rows="12" disabled><?php if(isset($project_info)){ echo $project_info['project_descr']; } ?></textarea> -->
                      </div>
                      <!-- <div class="form-group col-md-12 select_sm">
                        <label>Summary</label>
                        <textarea class="form-control form-control-sm" name="project_summery" id="project_summery" rows="2"><?php if(isset($project_info)){ echo $project_info['project_summery']; } ?></textarea>
                      </div> -->
                    </div>

                  </div>

                  <div class="form-group col-md-12">
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <h5>Project File</h5>
                      </div>
                      <!-- <div class="col-md-6 text-right">
                        <button type="button" id="add_row" class="btn btn-sm btn-info mb-3 mr-1" width="150px">Add Row</button>
                      </div> -->
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="" style="overflow-x:auto;">
                      <table id="myTable" class="table table-bordered tbl_list">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th class="wt_250">File</th>
                          <!-- <th class="wt_50"></th> -->
                        </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($project_file_list)){ $i = 0; foreach ($project_file_list as $list) { ?>
                            <!-- <input type="hidden" name="input[<?php echo $i; ?>][project_file_id]" value="<?php echo $list->project_file_id; ?>"> -->
                            <tr>
                              <td>
                                <input type="text" class="form-control form-control-sm" name="project_file_name[]" value="<?php echo $list->project_file_name; ?>" disabled>
                              </td>
                              <td class="wt_250">
                                <a target="_blank" href="<?php echo base_url() ?>assets/images/project/<?php echo $list->project_file_image; ?>"><?php echo $list->project_file_image; ?></a>
                              </td>
                              <!-- <td class="wt_50">
                                <input type="hidden" class="project_file_id" value="<?php echo $list->project_file_id; ?>">
                                <a class="rem_row"><i class="fa fa-trash text-danger"></i></a>
                              </td> -->
                            </tr>
                          <?php $i++;  } } else{ ?>

                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <h5>Delivery Phase</h5>
                      </div>
                      <!-- <div class="col-md-6 text-right">
                        <button type="button" id="add_row2" class="btn btn-sm btn-info mb-3 mr-1" width="150px">Add Row</button>
                      </div> -->
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="" style="overflow-x:auto;">
                      <table id="myTable2" class="table table-bordered tbl_list">
                        <thead>
                        <tr>
                          <th>Delivery Phase Details</th>
                          <th class="">Delivery Date</th>
                          <th class="">Payment Amount</th>
                          <!-- <th class="wt_50"></th> -->
                        </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($project_del_phase_list)){ $k = 0; foreach ($project_del_phase_list as $list) { ?>
                            <input type="hidden" name="input[<?php echo $k; ?>][project_del_phase_id]" value="<?php echo $list->project_del_phase_id; ?>">
                            <tr>
                              <td>
                                <input type="text" class="form-control form-control-sm" name="input[<?php echo $k; ?>][project_del_phase_descr]" value="<?php echo $list->project_del_phase_descr; ?>" disabled>
                              </td>
                              <td>
                                <input type="date" class="form-control form-control-sm" name="input[<?php echo $k; ?>][project_del_phase_date]" value="<?php echo $list->project_del_phase_date; ?>" disabled >
                              </td>
                              <td>
                                <input type="number" min="0" class="form-control form-control-sm" name="input[<?php echo $k; ?>][project_del_phase_amount]" value="<?php echo $list->project_del_phase_amount; ?>" disabled>
                              </td>

                            </tr>
                          <?php $k++;  } } else{ ?>

                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <!-- <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="project_status" id="project_status" value="0" <?php if(isset($project_info) && $project_info['project_status'] == 0){ echo 'checked'; } ?>>
                          <label for="project_status" class="custom-control-label">Disable This Project</label>
                        </div> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Reseller/Res_Project/project" class="btn btn-sm btn-outline-info px-4 mx-4">Project List</a>
                        <?php if(isset($update)){
                          //echo '<button class="btn btn-sm btn-primary float-right px-4">Update</button>';
                        } else{
                          //echo '<button class="btn btn-sm btn-success float-right px-4">Save</button>';
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
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Project</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Project Name</th>
                    <th class="wt_75">Client</th>
                    <th class="wt_75">Priority</th>
                    <th class="wt_75">Start Date</th>
                    <th class="wt_75">End Date</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($project_list)){
                    $i=0; foreach ($project_list as $list) { $i++;
                      $client_info = $this->Master_Model->get_info_arr_fields3('client_name', '', 'client_id', $list->client_id, '', '', '', '', 'smm_client');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Reseller/Res_Project/view_project/<?php echo $list->project_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-eye text-success"></i></a>
                            <!-- <a href="<?php echo base_url() ?>Reseller/Res_Project/delete_project/<?php echo $list->project_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Project');"><i class="fa fa-trash text-danger"></i></a> -->
                          </div>
                        </td>
                        <td><?php echo $list->project_name; ?></td>
                        <td><?php if($client_info){ echo $client_info[0]['client_name']; } ?></td>
                        <td><?php echo $list->project_piority; ?></td>
                        <td><?php echo $list->project_start_date; ?></td>
                        <td><?php echo $list->project_end_date; ?></td>
                        <td>
                          <?php if($list->project_status == 0){ echo '<span class="text-warning"><b>Not Started</b></span>'; }
                            elseif($list->project_status == 1){ echo '<span class="text-primary"><b>In Progress</b></span>'; }
                            elseif($list->project_status == 2){ echo '<span class="text-success"><b>Completed</b></span>'; }
                            elseif($list->project_status == 3){ echo '<span class="text-danger"><b>Cancelled</b></span>'; }
                            elseif($list->project_status == 4){ echo '<span class="text-info"><b>Hold</b></span>'; } ?>
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
