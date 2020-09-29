<?php include('include/head3.php') ?>


<div class="row">
  <div class="col-md-6">
    <div class="text-white text-div">
      <h1>We Will Skyrocket Your  </h1>
      <h1>Business in no Time</h1>
      <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups. Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups. and visual mockups. Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>
    </div>
  </div>

    <div class="col-md-6">
      <div class="images-div">
        <img src="<?php echo base_url(); ?>assets/images/website/home3/home1laptop.png" width="100%">
      </div>
    </div>
</div>
</section>


    <section class="feature">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center">Featured Package</h1>
            <img class="border-svg w-100" src="<?php echo base_url(); ?>assets/images/website/home3/underline.svg" alt="package image">
            <p class="text-center">Lorem ipsum is placeholder text commonly used in the graphic,</p>
          </div>

            <?php if($package_list){
              // print_r($package_list);
              foreach ($package_list as $package_list1) {
                $package_details = $this->Master_Model->get_info_arr_fields3('*', '', 'package_id', $package_list1->package_id, '', '', '', '', 'smm_package');
                if($package_details){
            ?>
              <div class="col-md-3">
                <div class="card package_div">
                  <!-- <img class="discount" src="<?php echo base_url(); ?>assets/images/website/home2/discount.svg" alt="package image"> -->
                  <img class="card-img-top p-30" src="<?php echo admin_url ?>assets/images/package/<?php echo $package_details[0]['package_image']; ?>" alt="package image">

                  <div class="card-body">
                    <h5 class="card-title text-center"><?php echo $package_details[0]['package_name']; ?></h5>
                    <p class="text-center">
                      <!-- <span class="line-through"><i class="fas fa-rupee-sign"></i> 220 </span> -->
                      <span class="ml-3 color-home1"> <i class="fas fa-rupee-sign"></i> <?php echo $package_list1->reseller_package_new_price; ?> </span>
                    </p>
                      <!-- <p class="text-center f-12"><?php echo $package_details[0]['package_descr']; ?></p> -->
                    <div class="row package_info">
                      <div class="col-2">
                         <span class="color-home1"><i class="far fa-heart"></i></span>
                      </div>
                      <div class="col-8 w-100 text-center">
                        <input type="hidden" class="package_id" value="<?php echo $package_details[0]['package_id']; ?>">
                        <input type="hidden" class="reseller_package_id" value="<?php echo $package_list1->reseller_package_id; ?>">
                        <input type="hidden" class="package_name" value="<?php echo $package_details[0]['package_name']; ?>">
                        <input type="hidden" class="package_price" value="<?php echo $package_list1->reseller_package_new_price; ?>">
                        <input type="hidden" class="gst_slab_id" value="<?php echo $package_details[0]['gst_slab_id']; ?>">
                        <input type="hidden" class="package_qty" value="1">
                        <button type="button" class="btn btn-sm btn-primary add-card"> Add to cart <i class="fas fa-cart-plus"></i> </button>
                      </div>
                      <div class="col-2">
                       <span class="color-home1"> <i class="fas fa-search"></i> </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } } } ?>
          </div>
        </div>
      </div>
    </section>

    <section class="testomonial">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
            <h1 class="text-center">Testimonials</h1>
            <img class="border-svg w-100" src="<?php echo base_url(); ?>assets/images/website/home3/underline.svg" alt="package image">
            <p class="text-center">Lorem ipsum is placeholder text commonly used in the graphic,</p>
          </div>

             <div class="owl-carousel owl-theme">
               <?php if($testomonial_list){
                foreach ($testomonial_list as $testomonial_list1) { ?>
                  <div class="item">
                      <div class="card">
                      <img class="card-img-top p-30" src="<?php echo base_url(); ?>assets/images/testimonial/<?php echo $testomonial_list1->testimonial_image; ?>" alt="Card image cap">
                      <div class="card-body">
                        <p class="card-text text-center"> <?php echo $testomonial_list1->testimonial_desc; ?> </p>
                        <h5 class="card-title text-center"><?php echo $testomonial_list1->testimonial_person; ?></h5>
                      </div>
                    </div>
                  </div>
               <?php } } ?>
            </div>

              <div class="col-md-12 text-center">
                <button type="button" class="btn bg-home1 btn-border btn-primary">Leave A Review</button>
              </div>

        </div>
      </section>


      <section class="blog">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
            <h1 class="text-center">Our Blog</h1>
            <img class="border-svg w-100" src="<?php echo base_url(); ?>assets/images/website/home3/underline.svg" alt="package image">
            <p class=" space text-center">Lorem ipsum is placeholder text commonly used in the graphic,</p>
          </div>
            <div class="col-md-4">
               <div class="card p-0">
                  <div class="blog-date">
                    <p class="ml-3 f-22"> 22 </p>
                    <p class="ml-3">Jun</p>
                  </div>
                    <img class="card-img-top" src="<?php echo base_url(); ?>assets/images/website/home3/blog1.png " alt="Card image cap">
                    <div class="card-body">
                         <div class="blog-name">
                        <h4 class="f-22"> Blog 1 </h4>
                      </div>
                    <h5 class="card-title text-center">Anim pariatur cliche reprehenderit enim eiusmod</h5>
                     <p class="inline text-center"> <span>Posted By Admin </span>  <span><i class="far fa-comment"></i> <i class="fas fa-share-alt ml-2"></i> </span>  </p>
                      <p class="card-text text-center">  enim eiusmod high life accusamus terry richardson ad squid.  raw denim aesthetic synth nesciunt </p>
                      <p class="text-center color-home1 font-weight-bold"> Continue Reading ...</p>
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
               <div class="card p-0">
                  <div class="blog-date">
                    <p class="ml-3 f-22"> 22 </p>
                    <p class="ml-3">Jun</p>
                  </div>
                    <img class="card-img-top" src="<?php echo base_url(); ?>assets/images/website/home3/blog2.png " alt="Card image cap">
                    <div class="card-body">
                         <div class="blog-name">
                        <h4 class="f-22"> Blog 2 </h4>
                      </div>
                    <h5 class="card-title text-center">Anim pariatur cliche reprehenderit enim eiusmod</h5>
                     <p class="inline text-center"> <span>Posted By Admin </span>  <span><i class="far fa-comment"></i> <i class="fas fa-share-alt ml-2"></i> </span>  </p>
                      <p class="card-text text-center">  enim eiusmod high life accusamus terry richardson ad squid.  raw denim aesthetic synth nesciunt </p>
                      <p class="text-center color-home1 font-weight-bold"> Continue Reading ...</p>
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
               <div class="card p-0">
                  <div class="blog-date">
                    <p class="ml-3 f-22"> 22 </p>
                    <p class="ml-3">Jun</p>
                  </div>
                    <img class="card-img-top" src="<?php echo base_url(); ?>assets/images/website/home3/blog3.png " alt="Card image cap">
                    <div class="card-body">
                         <div class="blog-name">
                        <h4 class="f-22"> Blog 3 </h4>
                      </div>
                    <h5 class="card-title text-center">Anim pariatur cliche reprehenderit enim eiusmod</h5>
                     <p class="inline text-center"> <span>Posted By Admin </span>  <span><i class="far fa-comment"></i> <i class="fas fa-share-alt ml-2"></i> </span>  </p>
                      <p class="card-text text-center">  enim eiusmod high life accusamus terry richardson ad squid.  raw denim aesthetic synth nesciunt </p>
                      <p class="text-center color-home1 font-weight-bold"> Continue Reading ...</p>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </section>



      <section class="news">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center text-white">
              <h1> Newsletter</h1>
               <img class="border-svg w-100" src="<?php echo base_url(); ?>assets/images/website/home3/underline2.svg" alt="package image">
             <p class=" space text-center">Lorem ipsum is placeholder text commonly used in the graphic,</p>
                </div>
                <div class="col-md-6 offset-md-3">
                   <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter Email" aria-label="Username" aria-describedby="basic-addon1">
                <div class="input-group-append">
                    <button type="button" class="btn btn-secondary round ml-minus btn-sm">Subcribe Now !</button>
                  </div>
              </div>
                </div>
          </div>
        </div>
      </section>

      <?php include('include/footer3.php') ?>
  </body>
</html>
