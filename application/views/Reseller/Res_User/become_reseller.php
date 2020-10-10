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
          <div class="col-sm-8 text-left mt-2">
            <h4>Become Our Reseller</h4>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-8  offset-md-2">
            <div class="card p-3">
              <?php if($banner_image){ ?>
                <img width="100%" src="<?php echo $banner_image[0]['become_reseller_image']; ?>" alt="">
              <?php } ?>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card p-3">
              <?php if($step1_image){ ?>
                <img width="100%" src="<?php echo $step1_image[0]['become_reseller_image']; ?>" alt="">
              <?php } ?>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card p-3">
              <?php if($step2_image){ ?>
                <img width="100%" src="<?php echo $step2_image[0]['become_reseller_image']; ?>" alt="">
              <?php } ?>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card p-3">
              <?php if($step3_image){ ?>
                <img width="100%" src="<?php echo $step3_image[0]['become_reseller_image']; ?>" alt="">
              <?php } ?>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>

</body>
</html>
