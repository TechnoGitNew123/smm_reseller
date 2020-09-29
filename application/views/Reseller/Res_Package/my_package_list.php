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
            <h4>My Package List</h4>
          </div>
        </div>
      </div>
    </section>
    <style media="screen">
    .widget-user .widget-user-image {
        left: 50%;
        margin-left: -45px;
        position: absolute;
        /* bottom: 80px !important; */
        top: 115px !important;
      }
      .widget-user .widget-user-header {
          border-top-left-radius: .25rem;
          border-top-right-radius: .25rem;
          height: 160px !important;
          padding: 1rem;
          text-align: center;
      }
    </style>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php if(isset($my_package_list)){
            $i=0; foreach ($my_package_list as $list) { $i++;
              $package_details = $this->Master_Model->get_info_arr_fields3('*', '', 'package_id', $list->package_id, '', '', '', '', 'smm_package');
              if($package_details){
          ?>

          <div class="col-md-4">
            <div class="card card-widget widget-user">
            <div class="card-body text-center bg-success">
              <span class="text-white">
                <?php if($package_details[0]['package_type'] == 1) { echo 'Product'; }
                  elseif ($package_details[0]['package_type'] == 2) { echo 'Service'; }
                ?>
              </span>
              <h5 class=""><?php echo $package_details[0]['package_name']; ?></h5>
            </div>
              <div class="widget-user-header" style="background: url('<?php echo admin_url ?>assets/images/package/<?php echo $package_details[0]['package_image'];  ?>'); background-size: cover;">
              </div>
              <!-- <div class="widget-user-image">
                <img style="height:90px !important;" class="img-circle elevation-2" src="<?php echo admin_url ?>assets/images/package/<?php echo $package_details[0]['package_image'];  ?>" alt="User Avatar">
              </div> -->
              <div class="card-footer pt-2">
                <div class="row">
                  <div class="col-6 border-right">
                    <div class="description-block text-success">
                      <h5 class="description-header"><?php echo $package_details[0]['package_per_duration']; ?> Days</h5>
                      <span class="f-14">Validity</span>
                    </div>
                    <hr>
                  </div>
                  <div class="col-6 ">
                    <div class="description-block text-info">
                      <h5 class="description-header">Rs. <?php echo $list->reseller_package_prev_price; ?></h5>
                      <span class="f-14">Old Price</span>
                    </div>
                    <hr>
                  </div>
                  <div class="col-6 border-right">
                    <div class="description-block text-danger">
                      <h5 class="description-header">Rs. <?php echo $list->reseller_package_new_price; ?></h5>
                      <span class="f-14">New Price</span>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="description-block text-primary">
                      <h5 class="description-header"><?php echo $package_details[0]['package_revisions']; ?></h5>
                      <span class="f-14">Revisions</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <hr>
                  </div>
                  <!-- <div class="col-3 text-left">
                    <button type="button" class="btn btn-sm btn-info" name="button">Details</button>
                  </div> -->
                  <div class="col-12 text-right div_change_price">
                    <input type="hidden" class="reseller_package_id" name="reseller_package_id" value="<?php echo $list->reseller_package_id; ?>">
                    <input type="hidden" class="reseller_package_new_price" name="reseller_package_new_price" value="<?php echo $list->reseller_package_new_price; ?>">
                    <button type="button" class="btn btn-sm btn-success btn_change_price" data-toggle="modal" data-target="#exampleModal">Change Price</button>
                  </div>
                  <!-- <div class="col-3 text-right div_add_to_list">

                  </div> -->
                </div>
              </div>
            </div>
          </div>
        <?php } } } ?>

        </div>
      </div>
    </section>
  </div>

  <!-- Modal Update Price -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Price</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="<?php echo base_url(); ?>Reseller/Res_Package/update_package_price" method="post">
          <div class="modal-body">
            <input type="hidden" name="reseller_package_id" id="reseller_package_id" value="">
            <label>Enter New Price</label>
            <input type="text" class="form-control form-control-sm" name="reseller_package_new_price" id="reseller_package_new_price" required>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>




</body>
</html>

<script type="text/javascript">
  $(document).on('click', '.btn_change_price', function(){
    var reseller_package_id = $(this).closest('.div_change_price').find('.reseller_package_id').val();
    var reseller_package_new_price = $(this).closest('.div_change_price').find('.reseller_package_new_price').val();
    $('#reseller_package_id').val(reseller_package_id);
    $('#reseller_package_new_price').val(reseller_package_new_price);
  });
</script>
