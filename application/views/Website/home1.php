<?php include('include/head1.php') ?>

<section class="home-nav">
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
        <img src="<?php echo base_url(); ?>assets/images/website/home1/home1laptop.png" width="100%">
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

          <div class="col-md-12" id="m-scroll">
            <?php foreach ($package_category_list as $list) {
              $package_category_id = $list->package_category_id;
            ?>
              <h3 class="text-center pb-2"> <i class="fas fa-box-open mr-2"></i> <?php echo $list->package_category_name; ?></h3>
              <table class="table table-striped">
                <thead class="thead-dark bg-green">
                  <tr>
                    <th class="bg-green" scope="col"> <i class="fas fa-tasks mr-2"></i> ID</th>
                    <th class="bg-green" scope="col"><i class="fas fa-tasks mr-2"></i>  SERVICE</th>
                    <th class="bg-green" scope="col"><i class="far fa-chart-bar mr-2"></i>RATE</th>
                    <th class="bg-green" scope="col" style="max-width:70px;"><i class="fas fa-grip-lines mr-2"></i> DESCRIPTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0;
                    foreach ($package_list as $package_list1) {
                    $package_details = $this->Master_Model->get_info_arr_fields3('*', '', 'package_id', $package_list1->package_id, '', '', '', '', 'smm_package');
                    if($package_details){
                      if($package_details[0]['package_category_id'] == $package_category_id){
                        $i++;
                  ?>
                  <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $package_details[0]['package_name']; ?></td>
                    <td><?php echo $package_list1->reseller_package_new_price; ?></td>
                    <td style="max-width:140px;">
                      <input type="hidden" class="package_name" value="<?php echo $package_details[0]['package_name']; ?>">
                      <input type="hidden" class="package_price" value="<?php echo $package_list1->reseller_package_new_price; ?>">
                      <input type="hidden" class="package_duration" value="<?php echo $package_details[0]['package_per_duration']; ?>">
                      <input type="hidden" class="package_image" value="<?php echo $package_details[0]['package_image']; ?>">
                      <input type="hidden" class="package_descr" value="<?php echo $package_details[0]['package_descr']; ?>">

                      <button type="button" class="btn btn-primary bg-green btn-sm btn_package_details" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-grip-lines "></i></button>
                      <a href="<?php echo base_url(); ?>WebsiteController/buy_now/<?php echo $package_list1->reseller_package_id; ?>" type="button" class="btn btn-sm btn-primary">Buy Now</a>
                    </td>
                  </tr>
                <?php } } } ?>
                </tbody>
              </table>
            <?php } ?>


          </div>

      </div>
    </div>
  </section>

    <section class="testomonial">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
            <h1 class="text-center">Testimonials</h1>
            <img class="border-svg w-100" src="<?php echo base_url(); ?>assets/images/website/home1/underline.svg" alt="package image">
            <p class="text-center">Lorem ipsum is placeholder text commonly used in the graphic,</p>
          </div>


            <div class="owl-carousel owl-theme">
              <?php if($testimonial_list){
               foreach ($testimonial_list as $testimonial_list1) { ?>
                 <div class="item">
                     <div class="card">
                     <img class="card-img-top p-30" src="<?php echo $testimonial_list1->testimonial_image; ?>" alt="Card image cap">
                     <div class="card-body">
                       <p class="card-text text-center"> <?php echo $testimonial_list1->testimonial_desc; ?> </p>
                       <h5 class="card-title text-center"><?php echo $testimonial_list1->testimonial_person; ?></h5>
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
              <img class="border-svg w-100" src="<?php echo base_url(); ?>assets/images/website/home1/underline.svg" alt="package image">
              <p class=" space text-center">Lorem ipsum is placeholder text commonly used in the graphic,</p>
            </div>

            <?php $i=0; foreach ($blog_list as $list) {
              if($i < 3){
            ?>
              <div class="col-md-4">
               <div class="card p-0">
                <div class="blog-date">
                  <p class="ml-3 f-22"> <?php echo date('d',strtotime($list->blog_date)); ?> </p>
                  <p class="ml-3"><?php echo date('M',strtotime($list->blog_date)); ?></p>
                </div>
                  <img class="card-img-top" src="<?php echo $list->blog_image; ?> " alt="Card image cap">
                  <div class="card-body">
                       <div class="blog-name">
                      <h4 class="f-22"> Blog <?php echo $i+1; ?> </h4>
                    </div>
                  <h5 class="card-title text-center"><?php echo $list->blog_name; ?></h5>
                   <p class="inline text-center">
                     <span>Posted By <?php echo $list->blog_author; ?> </span>
                     <!-- <span><i class="far fa-comment"></i> <i class="fas fa-share-alt ml-2"></i> </span>   -->
                   </p>
                    <!-- <p class="card-text text-center">  enim eiusmod high life accusamus terry richardson ad squid.  raw denim aesthetic synth nesciunt </p> -->
                    <p class="text-center color-home1 font-weight-bold">
                      <a class="color-home1 font-weight-bold" href="<?php echo base_url(); ?>Blog-Details/<?php echo $list->blog_id; ?>">Continue Reading ...</a>
                    </p>
                  </div>
                </div>
              </div>
            <?php $i++; } } ?>
          </div>
        </div>
      </section>



      <section class="news">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center text-white">
              <h1> Newsletter</h1>
               <img class="border-svg w-100" src="<?php echo base_url(); ?>assets/images/website/home1/underline2.svg" alt="package image">
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


      <!-- package description Modal -->

              <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Package One</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="description">
                  <p>Package : <span id="package_name"></span></p>
                  <p>Price : <span id="package_price"></span></p>
                  <p>Duration : <span id="package_duration"></span></p>
                  <p>Description :</p>
                  <span id="package_descr"></span>

                </div>
              </div>
            </div>
          </div>
        </div>

      <?php include('include/footer1.php') ?>
  </body>
</html>

<script type="text/javascript">
  $(document).on('click', '.btn_package_details', function(){
    var package_name = $(this).closest('td').find('.package_name').val();
    var package_price = $(this).closest('td').find('.package_price').val();
    var package_duration = $(this).closest('td').find('.package_duration').val();
    var package_descr = $(this).closest('td').find('.package_descr').val();

    $('#package_name').html(package_name);
    $('#package_price').html(package_price);
    $('#package_duration').html(package_duration);
    $('#package_descr').html(package_descr);
  });
</script>
