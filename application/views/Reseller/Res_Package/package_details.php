<?php
  $smm_addedby_type = $this->session->userdata('smm_addedby_type');
  $smm_reseller_id = $this->session->userdata('smm_reseller_id');
  $smm_res_company_id = $this->session->userdata('smm_res_company_id');
?>
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
            <h4>Package Details</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
              <div class="col-12">
                <img src="<?php echo admin_url ?>assets/images/package/<?php echo $package_details['package_image'];  ?>" class="product-image" alt="Product Image">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?php echo $package_details['package_name']; ?></h3>
              <span>
                <?php echo $package_details['package_descr']; ?>
              </span>
              <hr>

              <div class="row">
                <div class="col-4 border-right">
                  <div class="description-block ">
                    <h5 class="description-header"><b><?php echo $package_details['package_per_duration']; ?> Days</b></h5>
                    <span class="f-16">Validity</span>
                  </div>
                </div>
                <!-- <div class="col-4 border-right">
                  <div class="description-block ">
                    <h5 class="description-header"><b>Rs. <?php if($smm_addedby_type == 1){ echo $package_details['package_cost']; } else{ echo $package_details['reseller_package_new_price']; } ?></b></h5>
                    <span class="f-16">Price</span>
                  </div>
                </div> -->
                <div class="col-4">
                  <div class="description-block ">
                    <h5 class="description-header"><b><?php echo $package_details['package_revisions']; ?></b></h5>
                    <span class="f-16">Revisions</span>
                  </div>
                </div>
              </div>

              <hr>
              <h4 class="mb-3">Package Features</h4>
              <?php foreach ($package_feature_list as $package_feature_list2) { ?>
                <!-- <div class="col-md-4"> -->
                  <!-- <div class="card p-2"> -->
                    <!-- <img src="<?php echo admin_url ?>assets/images/package/<?php echo $package_feature_list2->package_feature_image;  ?>" class="product-image" alt="Product Image"> -->
                    <p class="mb-2"> <i class="fa fa-check"></i> <?php echo $package_feature_list2->package_feature_name;  ?></p>
                  <!-- </div> -->
                <!-- </div> -->
              <?php } ?>


            </div>
          </div>
          <div class="row mt-4">
            <!-- <h4>Package Features</h4>
            <?php foreach ($package_feature_list as $package_feature_list2) { ?>
              <div class="col-md-4">
                <div class="card p-2">
                  <img src="<?php echo admin_url ?>assets/images/package/<?php echo $package_feature_list2->package_feature_image;  ?>" class="product-image" alt="Product Image">
                  <p><?php echo $package_feature_list2->package_feature_name;  ?></p>
                </div>
              </div>
            <?php } ?> -->


          </div>
        </div>
        <!-- /.card-body -->
      </div>
      </div>
    </section>
  </div>
</body>
</html>

<!-- <script type="text/javascript">
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
</script> -->
