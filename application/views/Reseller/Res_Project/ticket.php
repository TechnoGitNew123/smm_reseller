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
            <h4>Ticket</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Ticket</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } ?>
                </div>
              </div>
              <!--  -->
              <div class="card-body px-0 py-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                        <div class="form-group col-md-6">
                          <label>Ticket No.</label>
                          <input type="number" class="form-control form-control-sm" name="ticket_no" id="ticket_no" value="<?php if(isset($ticket_info)){ echo $ticket_info['ticket_no']; } elseif(isset($ticket_no)){ echo $ticket_no; } ?>" placeholder="Enter Ticket No." required readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Ticket Date</label>
                          <input type="text" class="form-control form-control-sm " name="ticket_date" value="<?php if(isset($ticket_info)){ echo $ticket_info['ticket_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Ticket Date" required >
                        </div>
                        <div class="form-group col-md-12 select_sm">
                          <label>Project</label>
                          <select class="form-control select2 form-control-sm" name="project_id" id="project_id" data-placeholder="Select Project" required>
                            <option value="">Select Project</option>
                            <?php if(isset($project_list)){ foreach ($project_list as $list) { ?>
                            <option value="<?php echo $list->project_id; ?>" <?php if(isset($ticket_info) && $ticket_info['project_id'] == $list->project_id){ echo 'selected'; } if($list->project_status == '0'){ echo 'disabled'; } ?>><?php echo $list->project_name; ?></option>
                            <?php } } ?>
                          </select>
                        </div>
                        <!-- <div class="form-group col-md-6 select_sm">
                          <label>Department</label>
                          <select class="form-control select2 form-control-sm" name="department_id" id="department_id" data-placeholder="Select Department" required>
                            <option value="">Select Department</option>
                            <?php if(isset($department_list)){ foreach ($department_list as $list) { ?>
                            <option value="<?php echo $list->department_id; ?>" <?php if(isset($ticket_info) && $ticket_info['department_id'] == $list->department_id){ echo 'selected'; } ?>><?php echo $list->department_name; ?></option>
                            <?php } } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-6 select_sm">
                          <label>Ticket for Employee</label>
                          <select class="form-control select2 form-control-sm" name="employee_id" id="employee_id" data-placeholder="Select Employee" required>
                            <option value="">Select Employee</option>
                            <?php if(isset($user_list)){ foreach ($user_list as $list) { ?>
                            <option value="<?php echo $list->user_id; ?>" <?php if(isset($ticket_info) && $ticket_info['employee_id'] == $list->user_id){ echo 'selected'; } ?>><?php echo $list->user_name; ?></option>
                            <?php } } ?>
                          </select>
                        </div> -->

                        <div class="form-group col-md-12">
                          <label>Ticket Title</label>
                          <input type="text" class="form-control form-control-sm" name="ticket_title" id="ticket_title" value="<?php if(isset($ticket_info)){ echo $ticket_info['ticket_title']; } ?>"  placeholder="Enter Ticket Title" required >
                        </div>
                        <div class="form-group col-md-12">
                          <label>Discription</label>
                          <textarea class="textarea form-control form-control-sm" rows="12" name="ticket_descr" id="ticket_descr" placeholder="Enter Discription" required><?php if(isset($ticket_info)){ echo $ticket_info['ticket_descr']; } ?></textarea>
                        </div>

                        <!-- <div class="form-group col-md-6 select_sm">
                          <label>Priority</label>
                          <select class="form-control select2 form-control-sm" name="ticket_priority" id="ticket_priority" data-placeholder="Select Priority" required>
                            <option value="">Priority</option>
                            <option value="Low" <?php if(isset($ticket_info) && $ticket_info['ticket_priority'] == 'Low'){ echo 'selected'; } ?>>Low</option>
                            <option value="Medium" <?php if(isset($ticket_info) && $ticket_info['ticket_priority'] == 'Medium'){ echo 'selected'; } ?>>Medium</option>
                            <option value="High" <?php if(isset($ticket_info) && $ticket_info['ticket_priority'] == 'High'){ echo 'selected'; } ?>>High</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label>End Date</label>
                          <input type="text" min="0" class="form-control form-control-sm" name="ticket_end_date" value="<?php if(isset($ticket_info)){ echo $ticket_info['ticket_end_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="End Date" required >
                        </div> -->
                        <div class="form-group col-md-4">
                          <label>Attachment</label>
                          <input type="file" class="form-control form-control-sm" name="ticket_image" id="ticket_image">
                          <label>.jpg/.png/.jpeg Image & size less than 500kb.</label>
                        </div>
                        <div class="form-group col-md-4">
                        <?php if(isset($ticket_info) && $ticket_info['ticket_image']){ ?>
                            <input type="hidden" name="old_ticket_image" value="<?php echo $ticket_info['ticket_image']; ?>">
                            <img width="150px" src="<?php echo $ticket_info['ticket_image']; ?>" alt="">
                        <?php } ?>
                        </div>






                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <!-- <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="ticket_status" id="ticket_status" value="0" <?php if(isset($ticket_info) && $ticket_info['ticket_status'] == 0){ echo 'checked'; } ?>>
                          <label for="ticket_status" class="custom-control-label">Disable This Ticket</label>
                        </div> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Reseller/Res_Project/ticket" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
              <div class="card-header border-transparent">
                <h3 class="card-title">List All Ticket</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Ticket Title</th>
                    <th>Project</th>
                    <th class="wt_75">Date</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($ticket_list)){
                      $i=0; foreach ($ticket_list as $list) { $i++;
                        $employee_info = $this->Master_Model->get_info_arr_fields3('user_name', '', 'user_id', $list->employee_id, '', '', '', '', 'user');
                        $project_info = $this->Master_Model->get_info_arr_fields3('project_name', '', 'project_id', $list->project_id, '', '', '', '', 'smm_project');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Reseller/Res_Project/edit_ticket/<?php echo $list->ticket_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <!-- <a href="<?php echo base_url() ?>Reseller/Res_Project/delete_ticket/<?php echo $list->ticket_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Ticket');"><i class="fa fa-trash text-danger"></i></a> -->
                          </div>
                        </td>
                        <td><?php echo $list->ticket_title; ?></td>
                        <td><?php if($project_info){ echo $project_info[0]['project_name']; } ?></td>
                        <!-- <td><?php echo $list->ticket_priority; ?></td> -->
                        <td><?php echo $list->ticket_date; ?></td>
                        <td>
                          <?php if($list->ticket_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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

  $("#ticket_category_type").on("change", function(){
    var ticket_category_type =  $('#ticket_category_type').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Project/category_by_type',
      type: 'POST',
      data: {"ticket_category_type":ticket_category_type},
      context: this,
      success: function(result){
        $('#ticket_category_id').html(result);
      }
    });
  });
</script>
