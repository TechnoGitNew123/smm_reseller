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
            <h4>Task</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Task</h3>
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
                    <div class="col-md-6 row pl-0">
                      <div class="form-group col-md-6 select_sm">
                        <label>Select Company</label>
                        <select class="form-control select2 form-control-sm" name="task_company" id="task_company" data-placeholder="Select Company" required>
                          <option value="">Select Company</option>
                          <option value="1" <?php if(isset($task_info) && $task_info['task_company'] == '1'){ echo 'selected'; } ?>>Company 1</option>
                          <option value="2" <?php if(isset($task_info) && $task_info['task_company'] == '2'){ echo 'selected'; } ?>>Company 2</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Title</label>
                        <select class="form-control select2 form-control-sm" name="task_title" id="task_title" data-placeholder="Select Title" required>
                          <option value="">Select Title</option>
                          <option value="1" <?php if(isset($task_info) && $task_info['task_title'] == '1'){ echo 'selected'; } ?>>Title 1</option>
                          <option value="2" <?php if(isset($task_info) && $task_info['task_title'] == '2'){ echo 'selected'; } ?>>Title 2</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Start Date</label>
                        <input type="text" class="form-control form-control-sm" name="task_start_date" value="<?php if(isset($task_info)){ echo $task_info['task_start_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" placeholder="Start Date" required >
                      </div>
                      <div class="form-group col-md-6">
                        <label>End Date</label>
                        <input type="text" class="form-control form-control-sm" name="task_end_date" value="<?php if(isset($task_info)){ echo $task_info['task_end_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker" placeholder="End Date" required >
                      </div>
                      <div class="form-group col-md-6">
                        <label>Estimated Hour</label>
                        <input type="text" min="0" class="form-control form-control-sm" name="task_est_hour" id="task_est_hour" value="<?php if(isset($task_info)){ echo $task_info['task_est_hour']; } ?>" placeholder="Estimated Hour" required >
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Project</label>
                        <select class="form-control select2 form-control-sm" name="project_id" id="project_id" data-placeholder="Select Project" required>
                          <option value="">Select Project</option>
                          <?php if(isset($project_list)){ foreach ($project_list as $list) { ?>
                          <option value="<?php echo $list->project_id; ?>" <?php if(isset($task_info) && $task_info['project_id'] == $list->project_id){ echo 'selected'; } ?>><?php echo $list->project_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-12">
                        <label>Assign to</label>
                        <input type="text" min="0" class="form-control form-control-sm" name="task_assign_to" id="task_assign_to" value="<?php if(isset($task_info)){ echo $task_info['task_assign_to']; } ?>" placeholder="Assign to" required >
                      </div>
                    </div>
                    <div class="col-md-6 w-100 row pr-0">
                      <div class="form-group col-md-12 pr-0">
                        <label>Description</label>
                        <textarea class="textarea form-control form-control-sm" name="task_descr" id="task_descr" ><?php if(isset($task_info)){ echo $task_info['task_descr']; } ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer clearfix" style="display: block;">
                    <div class="row">
                      <div class="col-md-6 text-left">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="task_status" id="task_status" value="0" <?php if(isset($task_info) && $task_info['task_status'] == 0){ echo 'checked'; } ?>>
                          <label for="task_status" class="custom-control-label">Disable This Task</label>
                        </div>
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php base_url(); ?>Project/task" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Task</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Task Title</th>
                    <th class="wt_75">Project</th>
                    <th class="wt_75">Assign to</th>
                    <th class="wt_75">Start Date</th>
                    <th class="wt_75">End Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($task_list)){
                      $i=0; foreach ($task_list as $list) { $i++;
                        // $city_info = $this->Master_Model->get_info_arr_fields3('city_name', '', 'city_id', $list->city_id, '', '', '', '', 'city');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Project/edit_task/<?php echo $list->task_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <a href="<?php echo base_url() ?>Project/delete_task/<?php echo $list->task_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Task');"><i class="fa fa-trash text-danger"></i></a>
                          </div>
                        </td>
                        <td><?php echo $list->task_title; ?></td>
                        <!-- <td><?php if($city_info){ echo $city_info[0]['city_name']; } ?></td> -->
                        <td>
                          <?php if($list->task_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
  $("#task_category_type").on("change", function(){
    var task_category_type =  $('#task_category_type').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Project/category_by_type',
      type: 'POST',
      data: {"task_category_type":task_category_type},
      context: this,
      success: function(result){
        $('#task_category_id').html(result);
      }
    });
  });
</script>
