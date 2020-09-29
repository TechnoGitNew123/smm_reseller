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
            <h4>Project Revision</h4>
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
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Project Revision</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-xs btn-info" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Reseller/Res_Project/project_revision" class="btn btn-xs btn-outline-info">Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <div class="card-body px-0 py-0" <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                <form class="input_form m-0" id="form_action" role="form" action="" method="post" enctype="multipart/form-data">
                  <div class="row p-4">
                    <div class="form-group col-md-6 select_sm">
                      <label>Project Revision Category</label>
                      <select class="form-control select2 form-control-sm" name="project_revision_category_id" id="project_revision_category_id" data-placeholder="Select Project Revision Category" required>
                        <option value="">Select Project Revision Category</option>
                        <?php if(isset($project_revision_category_list)){ foreach ($project_revision_category_list as $list) { ?>
                        <option value="<?php echo $list->project_revision_category_id; ?>" <?php if(isset($project_revision_info) && $project_revision_info['project_revision_category_id'] == $list->project_revision_category_id){ echo 'selected'; } ?>><?php echo $list->project_revision_category_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6 select_sm">
                      <label>Project</label>
                      <select class="form-control select2 form-control-sm" name="project_id" id="project_id" data-placeholder="Select Project" required>
                        <option value="">Select Project</option>
                        <?php if(isset($project_list)){ foreach ($project_list as $list) { ?>
                        <option value="<?php echo $list->project_id; ?>" <?php if(isset($project_revision_info) && $project_revision_info['project_id'] == $list->project_id){ echo 'selected'; } ?>><?php echo $list->project_name; ?></option>
                        <?php } } ?>
                      </select>
                    </div>

                    <div class="form-group col-md-12 select_sm">
                      <label>Title</label>
                      <input type="text" class="form-control form-control-sm" name="project_revision_title" id="project_revision_title" value="<?php if(isset($project_revision_info)){ echo $project_revision_info['project_revision_title']; } ?>" placeholder="Enter Title" required >
                    </div>

                    <style media="screen">
                      .note-editing-area {
                        height: 200px !important;
                      }
                    </style>
                    <div class="form-group col-md-12 pr-0">
                      <label>Description</label>
                      <textarea class="textarea form-control form-control-sm" name="project_revision_descr" id="project_revision_descr" ><?php if(isset($project_revision_info)){ echo $project_revision_info['project_revision_descr']; } ?></textarea>
                    </div>

                    <div class="form-group col-md-12">
                      <hr>
                      <div class="row">
                        <div class="col-md-6">
                          <label>Project Revision File</label>
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
                            <?php if(isset($project_revision_file_list)){ $i = 0; foreach ($project_revision_file_list as $list) { ?>
                              <input type="hidden" name="input[<?php echo $i; ?>][project_revision_file_id]" value="<?php echo $list->project_revision_file_id; ?>">
                              <tr>
                                <td>
                                  <input type="text" class="form-control form-control-sm" name="project_revision_file_name[]" value="<?php echo $list->project_revision_file_name; ?>" disabled>
                                </td>
                                <td class="wt_250">
                                  <a target="_blank" href="<?php echo $list->project_revision_file_image; ?>"><?php echo $list->project_revision_file_image; ?></a>
                                </td>
                                <td class="wt_50">
                                  <input type="hidden" class="project_revision_file_id" value="<?php echo $list->project_revision_file_id; ?>">
                                  <a class="rem_row"><i class="fa fa-trash text-danger"></i></a>
                                </td>
                              </tr>
                            <?php $i++;  } } else{ ?>
                              <tr>
                                <td>
                                  <input type="text" class="form-control form-control-sm" name="project_revision_file_name[]" required>
                                </td>
                                <td class="wt_250">
                                  <input type="file"  class="form-control form-control-sm" name="project_revision_file_image[]" required>
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
                        <!-- <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="project_revision_status" id="project_revision_status" value="0" <?php if(isset($project_revision_info) && $project_revision_info['project_revision_status'] == 0){ echo 'checked'; } ?>>
                          <label for="project_revision_status" class="custom-control-label">Disable This Project Revision</label>
                        </div> -->
                      </div>
                      <div class="col-md-6 text-right">
                        <a href="<?php echo base_url(); ?>Reseller/Res_Project/project_revision" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
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
                <h3 class="card-title">List All Project Revision</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Project Revision Title</th>
                    <th>Category</th>
                    <th>Project</th>
                    <th>Date</th>
                    <!-- <th class="wt_50">Status</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($project_revision_list)){
                      $i=0; foreach ($project_revision_list as $list) { $i++;
                        $project_info = $this->Master_Model->get_info_arr_fields3('project_name', '', 'project_id', $list->project_id, '', '', '', '', 'smm_project');
                        $project_revision_category_info = $this->Master_Model->get_info_arr_fields3('project_revision_category_name', '', 'project_revision_category_id', $list->project_revision_category_id, '', '', '', '', 'smm_project_revision_category');
                    ?>
                      <tr>
                        <td class="d-none"><?php echo $i; ?></td>
                        <td class="text-center">
                          <div class="btn-group">
                            <a href="<?php echo base_url() ?>Reseller/Res_Project/edit_project_revision/<?php echo $list->project_revision_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                            <!-- <a href="<?php echo base_url() ?>Reseller/Res_Project/delete_project_revision/<?php echo $list->project_revision_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Project Revision');"><i class="fa fa-trash text-danger"></i></a> -->
                          </div>
                        </td>
                        <td><?php echo $list->project_revision_title; ?></td>
                        <td><?php if($project_info){ echo $project_info[0]['project_name']; } ?></td>
                        <td><?php if($project_revision_category_info){ echo $project_revision_category_info[0]['project_revision_category_name']; } ?></td>
                        <td><?php echo $list->project_revision_date; ?></td>

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
  $("#project_revision_category_type").on("change", function(){
    var project_revision_category_type =  $('#project_revision_category_type').find("option:selected").val();
    $.ajax({
      url:'<?php echo base_url(); ?>Project/category_by_type',
      type: 'POST',
      data: {"project_revision_category_type":project_revision_category_type},
      context: this,
      success: function(result){
        $('#project_revision_category_id').html(result);
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
        '<input type="text" class="form-control form-control-sm" name="project_revision_file_name[]" required>'+
      '</td>'+
      '<td class="wt_250">'+
        '<input type="file"  class="form-control form-control-sm" name="project_revision_file_image[]" required>'+
      '</td>'+
      '<td class="wt_50"><a class="rem_row"><i class="fa fa-trash text-danger"></i></a></td>'+
    '</tr>';
    $('#myTable').append(row);
  });

  $('#myTable').on('click', '.rem_row', function () {
    $(this).closest('tr').remove();
    var project_revision_file_id = $(this).closest('tr').find('.project_revision_file_id').val();
    $.ajax({
      url:'<?php echo base_url(); ?>Reseller/Res_Project/delete_project_revision_file',
      type: 'POST',
      data: {"project_revision_file_id":project_revision_file_id},
      context: this,
      success: function(result){
        toastr.error('File Deleted successfully');
      }
    });
  });
</script>
