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

        <div class="col-md-12">
          <!-- <div class="card"> -->
            <!-- <div class="card-header">
              <h3 class="card-title">List All Package</h3>
            </div> -->
            <!-- <div class="card-body p-2"> -->

              <?php if($package_category_list){
                foreach ($package_category_list as $package_category_list1) { ?>
                  <div class="card p-2">
                  <h4 class="text-center pb-2 mt-3"> <i class="fas fa-box-open mr-2"></i> <?php echo $package_category_list1->package_category_name; ?></h4>


                  <table class="table table-striped">
                    <thead class="thead-dark bg-green">
                      <tr>
                        <th class="bg-green" scope="col"> <i class="fas fa-tasks mr-2"></i> ID</th>
                        <th class="bg-green" scope="col"><i class="fas fa-tasks mr-2"></i>  SERVICE</th>
                        <th class="bg-green" scope="col"><i class="far fa-chart-bar mr-2"></i>RATE</th>
                        <th class="bg-green" scope="col" style="max-width:150px;"><i class="fas fa-grip-lines mr-2"></i> DESCRIPTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $smm_res_company_id = $this->session->userdata('smm_res_company_id');
                      if($this->session->userdata('smm_addedby_type') == 1){
                        $package_list = $this->Master_Model->get_list_by_id3($smm_res_company_id,'package_category_id',$package_category_list1->package_category_id,'','','','','package_id','DESC','smm_package');
                      } else{
                        $smm_addedby = $this->session->userdata('smm_addedby');
                        $package_list = $this->Reseller_Model->reseller_package_list_by_category($smm_res_company_id,$smm_addedby,$package_category_list1->package_category_id);
                      }

                      if(isset($package_list)){
                        $i=0; foreach ($package_list as $list) { $i++;
                      ?>
                        <tr>
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $list->package_name; ?></td>
                          <td><?php if($smm_addedby_type == 1){ echo $list->package_cost; } else{ echo $list->reseller_package_new_price; } ?></td>
                          <td style="max-width:70px;">
                            <a href="<?php echo base_url(); ?>Reseller/Res_Package/package_details/<?php echo $list->package_id; ?>" type="button" class="btn btn-primary bg-green btn-sm"><i class="fas fa-grip-lines "></i></a>
                            <span class="div_add_to_list">
                              <?php $check_pack = $this->Master_Model->get_info_arr_fields3('reseller_package_id', $smm_res_company_id, 'package_id', $list->package_id, 'reseller_id', $smm_reseller_id, '', '', 'smm_reseller_package');
                              ?>
                              <input type="hidden" class="package_id" name="package_id" value="<?php echo $list->package_id; ?>">
                              <input type="hidden" class="package_cost" name="package_cost" value="<?php if($smm_addedby_type == 1){ echo $list->package_cost; } else{ echo $list->reseller_package_new_price; } ?>">
                              <?php if($check_pack){ ?>
                                <button type="button" class="btn btn-sm btn-info btn_add_to_list" name="button" disabled>Added</button>
                              <?php } else{ ?>
                                <button type="button" class="btn btn-sm btn-info btn_add_to_list" name="button">Add To List</button>
                              <?php } ?>
                            </span>
                            <a href="<?php echo base_url(); ?>Reseller/Res_Payment/package_payment/<?php echo $list->package_id; ?>" type="button" class="btn btn-primary bg-green btn-xs">Buy Now</a>
                          </td>
                        </tr>
                      <?php } } ?>
                    </tbody>
                  </table>
                  </div>

              <?php } } ?>



            <!-- </div>
          </div> -->
        </div>



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
