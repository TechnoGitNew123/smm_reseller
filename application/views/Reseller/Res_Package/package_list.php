<!DOCTYPE html>
<?php
  $smm_addedby_type = $this->session->userdata('smm_addedby_type');
  $smm_reseller_id = $this->session->userdata('smm_reseller_id');
  $smm_res_company_id = $this->session->userdata('smm_res_company_id');
?>
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
            <h4>Package List</h4>
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
          <?php if(isset($package_list)){
            $i=0; foreach ($package_list as $list) { $i++;
          ?>


          <div class="col-md-4">
            <div class="card card-widget widget-user">
            <div class="card-body text-center bg-info">
              <span class="text-white">
                <?php if($list->package_type == 1) { echo 'Product'; }
                  elseif ($list->package_type == 2) { echo 'Service'; }
                ?>
              </span>
              <h5 class=""><?php echo $list->package_name; ?></h5>
            </div>
              <div class="widget-user-header" style="background: url('<?php echo admin_url ?>assets/images/package/<?php echo $list->package_image;  ?>'); background-size: cover;">
              </div>
              <!-- <div class="widget-user-image">
                <img style="height:90px !important;" class="img-circle elevation-2" src="<?php echo admin_url ?>assets/images/package/<?php echo $list->package_image;  ?>" alt="User Avatar">
              </div> -->
              <div class="card-footer pt-2">
                <div class="row">
                  <div class="col-4 border-right">
                    <div class="description-block text-success">
                      <h5 class="description-header"><?php echo $list->package_per_duration; ?> Days</h5>
                      <span class="f-14">Validity</span>
                    </div>
                  </div>
                  <div class="col-4 border-right">
                    <div class="description-block text-danger">
                      <h5 class="description-header">Rs. <?php if($smm_addedby_type == 1){ echo $list->package_cost; } else{ echo $list->reseller_package_new_price; } ?></h5>
                      <span class="f-14">Price</span>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="description-block text-primary">
                      <h5 class="description-header"><?php echo $list->package_revisions; ?></h5>
                      <span class="f-14">Revisions</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <hr>
                  </div>
                  <div class="col-6">
                    <a href="<?php echo base_url(); ?>Reseller/Res_Package/package_details/<?php echo $list->package_id; ?>" type="button" class="btn btn-sm btn-success" name="button">Details</a>
                  </div>
                  <div class="col-6 text-right div_add_to_list">
                    <?php $check_pack = $this->Master_Model->get_info_arr_fields3('reseller_package_id', $smm_res_company_id, 'package_id', $list->package_id, 'reseller_id', $smm_reseller_id, '', '', 'smm_reseller_package');
                    // get_info_arr_fields('reseller_package_id','package_id', $list->package_id, 'smm_reseller_package'); ?>
                    <input type="hidden" class="package_id" name="package_id" value="<?php echo $list->package_id; ?>">
                    <input type="hidden" class="package_cost" name="package_cost" value="<?php if($smm_addedby_type == 1){ echo $list->package_cost; } else{ echo $list->reseller_package_new_price; } ?>">
                    <?php if($check_pack){ ?>
                      <button type="button" class="btn btn-sm btn-info btn_add_to_list" name="button" disabled>Added</button>
                    <?php } else{ ?>
                      <button type="button" class="btn btn-sm btn-info btn_add_to_list" name="button">Add To List</button>
                    <?php } ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } } ?>

        </div>
      </div>
    </section>
  </div>
</body>
</html>

<script type="text/javascript">
  $(document).on('click', '.btn_add_to_list', function(){
    var package_id = $(this).closest('.div_add_to_list').find('.package_id').val();
    var package_cost = $(this).closest('.div_add_to_list').find('.package_cost').val();
    $.ajax({
      url:'<?php echo base_url(); ?>Reseller/Res_Package/add_package_to_reseller',
      type: 'POST',
      data: {"package_id":package_id, "package_cost":package_cost},
      context: this,
      success: function(result){
        if(result == 'success'){
          $(this).closest('.div_add_to_list').find('.btn_add_to_list').attr('disabled',true);
          $(this).closest('.div_add_to_list').find('.btn_add_to_list').text('Added');
          toastr.success('Package Addedc Successfully');
        } else{
          toastr.error('Package Not Added');
        }
      }
    });
  });
</script>
