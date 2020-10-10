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
            <h4>Blog</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card <?php if(!isset($update)){ echo 'collapsed-card'; } ?>">
              <div class="card-header">
                <h3 class="card-title"> <?php if(isset($update)){ echo 'Update'; } else{ echo 'Add New'; } ?> Blog</h3>
                <div class="card-tools">
                  <?php if(!isset($update)){
                    echo '<button type="button" class="btn btn-sm btn-primary" data-card-widget="collapse">Add New</button>';
                  } else{
                    echo '<a href="'.base_url().'Reseller/Res_Master/blog" type="button" class="btn btn-sm btn-outline-info" >Cancel Edit</a>';
                  } ?>
                </div>
              </div>
              <!--  -->
                <div class="card-body px-0 py-0 " <?php if(isset($update)){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"'; } ?>>
                  <form class="input_form m-0 needs-validation" novalidate id="form_action" role="form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="row p-4">
                      <div class="form-group col-md-6 ">
                        <label>Blog Date</label>
                        <input type="text" class="form-control form-control-sm" name="blog_date" value="<?php if(isset($blog_info)){ echo $blog_info['blog_date']; } ?>" id="date1" data-target="#date1" data-toggle="datetimepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask placeholder="Enter Blog Date" required>
                      </div>
                      <div class="form-group col-md-6 ">
                        <label>Blog Author</label>
                        <input type="text" class="form-control form-control-sm" name="blog_author" id="blog_author" value="<?php if(isset($blog_info)){ echo $blog_info['blog_author']; } ?>" placeholder="Enter Blog Author" required>
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Blog Title</label>
                        <input type="text" class="form-control form-control-sm" name="blog_name" id="blog_name" value="<?php if(isset($blog_info)){ echo $blog_info['blog_name']; } ?>" placeholder="Enter Blog Title" required>
                      </div>
                      <div class="form-group col-md-12 ">
                        <label>Blog Description</label>
                        <textarea class="textarea form-control form-control-sm" name="blog_descr" id="blog_descr" rows="3" placeholder="Enter Blog Description" required ><?php if(isset($blog_info)){ echo $blog_info['blog_descr']; } ?></textarea>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Blog Image</label>
                        <input type="file" class="form-control form-control-sm valid_image" name="blog_image" id="blog_image" <?php if(!isset($blog_info)){ echo 'required'; } ?>>
                          <label>.jpg/.jpeg/.png file. Size less than 500kb.</label>
                      </div>
                      <div class="form-group col-md-4">
                        <?php if(isset($blog_info) && $blog_info['blog_image']){ ?>
                          <img width="150px" src="<?php echo $blog_info['blog_image'];  ?>" alt="Blog Image">
                          <input type="hidden" name="old_blog_img" value="<?php echo $blog_info['blog_image']; ?>">
                        <?php } ?>
                      </div>
                    </div>
                    <div class="card-footer clearfix" style="display: block;">
                      <div class="row">
                        <div class="col-md-6 text-left">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="blog_status" id="blog_status" value="0" <?php if(isset($blog_info) && $blog_info['blog_status'] == 0){ echo 'checked'; } ?>>
                            <label for="blog_status" class="custom-control-label">Disable This Blog</label>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="<?php echo base_url(); ?>Reseller/Res_Master/blog" class="btn btn-sm btn-default px-4 mx-4">Cancel</a>
                          <?php if(isset($update)){
                            echo '<button type="submit" class="btn btn-sm btn-primary float-right px-4">Update</button>';
                          } else{
                            echo '<button type="submit" class="btn btn-sm btn-success float-right px-4">Save</button>';
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
              <div class="card-header">
                <h3 class="card-title">List All Blog Information</h3>
              </div>
              <div class="card-body p-2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="d-none">#</th>
                    <th class="wt_50">Action</th>
                    <th>Blog Title</th>
                    <th class="wt_50">Image</th>
                    <th class="wt_50">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($blog_list)){
                      $i=0; foreach ($blog_list as $list) { $i++;
                    ?>
                    <tr>
                      <td class="d-none"><?php echo $i; ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?php echo base_url() ?>Reseller/Res_Master/edit_blog/<?php echo $list->blog_id; ?>" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-primary"></i></a>
                          <a href="<?php echo base_url() ?>Reseller/Res_Master/delete_blog/<?php echo $list->blog_id; ?>" type="button" class="btn btn-sm btn-default" onclick="return confirm('Delete this Blog Information');"><i class="fa fa-trash text-danger"></i></a>
                        </div>
                      </td>
                      <td><?php echo $list->blog_name; ?></td>
                      <td class="text-center"><img width="50px" width="50px" src="<?php echo $list->blog_image;  ?>" alt="Blog Image">
                      <td>
                        <?php if($list->blog_status == 0){ echo '<span class="text-danger">Inactive</span>'; }
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
