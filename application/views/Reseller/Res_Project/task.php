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
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Reseller/Res_Project/task" class="btn btn-xs btn-outline-info">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <div class="card-body px-0 py-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="col-md-6 row pl-0">
                      <div class="form-group col-md-6 select_sm">
                        <label>Task Category</label>
                        <select class="form-control select2 form-control-sm" name="task_category_id" id="task_category_id" data-placeholder="Select Task Category" required>
                          <option value="">Select Task Category</option>
                          <option value="1" <?php if(isset($task_info) && $task_info['task_category_id'] == '1'){ echo 'selected'; } ?>>Demo 1</option>
                          <option value="2" <?php if(isset($task_info) && $task_info['task_category_id'] == '2'){ echo 'selected'; } ?>>Demo 2</option>
                        </select>
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

                      <div class="form-group col-md-12 select_sm">
                        <label>Title</label>
                        <input type="text" class="form-control form-control-sm" name="task_title" id="task_title" value="<?php if(isset($task_info)){ echo $task_info['task_title']; } ?>" placeholder="Enter Title" required >
                      </div>
                      <div class="form-group col-md-6">
                        <label>Start Date</label>
                        <input type="text" class="form-control form-control-sm" name="task_start_date" value="<?php if(isset($task_info)){ echo $task_info['task_start_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Start Date" required >
                      </div>
                      <div class="form-group col-md-6">
                        <label>End Date</label>
                        <input type="text" class="form-control form-control-sm" name="task_end_date" value="<?php if(isset($task_info)){ echo $task_info['task_end_date']; } ?>" id="date2" data-target="#date2" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="End Date" required >
                      </div>
                      <div class="form-group col-md-6">
                        <label>Estimated Hour</label>
                        <input type="text" min="0" class="form-control form-control-sm" name="task_est_hour" id="task_est_hour" value="<?php if(isset($task_info)){ echo $task_info['task_est_hour']; } ?>" placeholder="Estimated Hour" required >
                      </div>
                      <div class="form-group col-md-6 select_sm">
                        <label>Priority</label>
                        <select class="form-control select2" name="task_piority" id="task_piority" data-placeholder="Priority">
                          <option value="">Priority</option>
                          <option value="Low" <?php if(isset($task_info) && $task_info['task_piority'] == 'Low'){ echo 'selected'; } ?>>Low</option>
                          <option value="Medium" <?php if(isset($task_info) && $task_info['task_piority'] == 'Medium'){ echo 'selected'; } ?>>Medium</option>
                          <option value="High" <?php if(isset($task_info) && $task_info['task_piority'] == 'High'){ echo 'selected'; } ?>>High</option>
                        </select>
                      </div>
                      <!-- <div class="form-group col-md-6 select_sm">
                        <label>Task Status</label>
                        <select class="form-control select2 form-control-sm" name="task_status_id" id="task_status_id" data-placeholder="Select Task Status" required>
                          <option value="">Select Task Status</option>
                          <?php if(isset($task_status_list)){ foreach ($task_status_list as $list) { ?>
                          <option value="<?php echo $list->task_status_id; ?>" <?php if(isset($task_info) && $task_info['task_status_id'] == $list->task_status_id){ echo 'selected'; } ?>><?php echo $list->task_status_name; ?></option>
                          <?php } } ?>
                        </select>
                      </div> -->

                    </div>
                    <div class="col-md-6 w-100 row pr-0">
                      <style media="screen">
                        .note-editing-area {
                          height: 200px !important;
                        }
                      </style>
                      <div class="form-group col-md-12 pr-0">
                        <label>Description</label>
                        <textarea class="textarea form-control form-control-sm" name="task_descr" id="task_descr" ><?php if(isset($task_info)){ echo $task_info['task_descr']; } ?></textarea>
                      </div>
                    </div>


                    <div class="form-group col-md-12">
                      <hr>
                      <div class="row">
                        <div class="col-md-6">
                          <label>Task File</label>
                        </div>
                        <div class="col-md-6 text-right">
                          <button type="button" id="add_row" class="btn btn-sm btn-info mb-3 mr-1" width="150px">Add Row</button>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="" style="overflow-x:auto;">
                        <table id="myTable" class="table table-bordered tbl_list">
                          <thead>
                          <tr>
                            <th>Name</th>
                            <th class="wt_250">File</th>
                            <th class="wt_50"></th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php if(isset($task_file_list)){ $i = 0; foreach ($task_file_list as $list) { ?>
                              <input type="hidden" name="input[<?php echo $i; ?>][task_file_id]" value="<?php echo $list->task_file_id; ?>">
                              <tr>
                                <td>
                                  <input type="text" class="form-control form-control-sm" name="task_file_name[]" value="<?php echo $list->task_file_name; ?>" disabled>
                                </td>
                                <td class="wt_250">
                                  <a target="_blank" href="<?php echo $list->task_file_image; ?>"><?php echo $list->task_file_image; ?></a>
                                </td>
                                <td class="wt_50">
                                  <input type="hidden" class="task_file_id" value="<?php echo $list->task_file_id; ?>">
                                  <a class="rem_row"><i class="fa fa-trash text-danger"></i></a>
                                </td>
                              </tr>
                            <?php $i++;  } } else{ ?>
                              <tr>
                                <td>
                                  <input type="text" class="form-control form-control-sm" name="task_file_name[]" required>
                                </td>
                                <td class="wt_250">
                                  <input type="file"  class="form-control form-control-sm" name="task_file_image[]" required>
                                </td>
                                <td class="wt_50"></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
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
                        <a href="<?php echo base_url(); ?>Reseller/Res_Project/task" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
              <div class="card-header ">
                <h3 class="card-title">List All Task</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Task Title</th>
                    <th>Project</th>
                    <th class="wt_50">Start Date</th>
                    <th class="wt_50">End Date</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($task_list)){
                      $i=0; foreach ($task_list as $list) { $i++;
                        $project_info = $this->Master_Model->get_info_arr_fields3('project_name', '', 'project_id', $list->project_id, '', '', '', '', 'smm_project');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Reseller/Res_Project/edit_task/<?php echo $list->task_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <!-- <a href="<?php echo base_url() ?>Reseller/Res_Project/delete_task/<?php echo $list->task_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Task');"><i class="fa fa-trash text-danger"></i></a> -->
                          </div>
                        </td>
                        <td><?php echo $list->task_title; ?></td>
                        <td><?php if($project_info){ echo $project_info[0]['project_name']; } ?></td>
                        <td><?php echo $list->task_start_date; ?></td>
                        <td><?php echo $list->task_end_date; ?></td>

                        <td>
                          <?php if($list->task_status == 0){ echo '<span class="text-danger">Open</span>'; }
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

<script type="text/javascript">
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
        '<input type="text" class="form-control form-control-sm" name="task_file_name[]" required>'+
      '</td>'+
      '<td class="wt_250">'+
        '<input type="file"  class="form-control form-control-sm" name="task_file_image[]" required>'+
      '</td>'+
      '<td class="wt_50"><a class="rem_row"><i class="fa fa-trash text-danger"></i></a></td>'+
    '</tr>';
    $('#myTable').append(row);
  });

  $('#myTable').on('click', '.rem_row', function () {
    $(this).closest('tr').remove();
    var task_file_id = $(this).closest('tr').find('.task_file_id').val();
    $.ajax({
      url:'<?php echo base_url(); ?>Reseller/Res_Project/delete_task_file',
      type: 'POST',
      data: {"task_file_id":task_file_id},
      context: this,
      success: function(result){
        toastr.error('File Deleted successfully');
      }
    });
  });
</script>
