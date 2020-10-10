<?php include('include/head1.php') ?>
  <div class="top_strip"></div>

  <section class="blog mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Blog</h1>
          <img class="border-svg w-100" src="<?php echo base_url(); ?>assets/images/website/home1/underline.svg" alt="package image">
          <p class=" space text-center">Lorem ipsum is placeholder text commonly used in the graphic,</p>
        </div>


          <div class="col-md-9">
           <div class="card p-0">
            <div class="blog-date">
              <p class="ml-3 f-22"> <?php echo date('d',strtotime($blog_info['blog_date'])); ?> </p>
              <p class="ml-3"><?php echo date('M',strtotime($blog_info['blog_date'])); ?></p>
            </div>
              <img class="card-img-top" src="<?php echo $blog_info['blog_image']; ?> " alt="Card image cap">
              <div class="card-body">
                   <!-- <div class="blog-name">
                  <h4 class="f-22"> Blog Details </h4>
                </div> -->
              <p class="inline bg-info p-2 text-white">
                <span class="text-left">Posted By : <?php echo $blog_info['blog_author']; ?> </span>
                <span class="float-right">Date : <?php echo $blog_info['blog_date']; ?> </span>
              </p>
              <h5 class="card-title text-center"><?php echo $blog_info['blog_name']; ?></h5>

                <span>
                  <?php echo $blog_info['blog_descr']; ?>
                </span>
                <!-- <p class="text-center color-home1 font-weight-bold"> Continue Reading ...</p> -->
              </div>
            </div>
          </div>

          <div class="col-md-3 p-0">
            <!-- <div class="card p-1"> -->
              <div class="row">
                <?php $i=0; foreach ($blog_list as $list) {
                  if($i < 3){
                ?>
                  <div class="col-md-12 mb-2">
                   <div class="card p-0">
                    <div class="blog-date">
                      <p class="ml-3 f-22"> <?php echo date('d',strtotime($list->blog_date)); ?> </p>
                      <p class="ml-3"><?php echo date('M',strtotime($list->blog_date)); ?></p>
                    </div>
                      <img class="card-img-top" src="<?php echo $list->blog_image; ?> " alt="Card image cap">
                      <div class="card-body">
                           <!-- <div class="blog-name">
                          <h4 class="f-22"> Blog <?php echo $i+1; ?> </h4>
                        </div> -->
                      <p class="f-16"><?php echo $list->blog_name; ?></p>
                        <p class="text-center color-home1 font-weight-bold">
                          <a class="color-home1 font-weight-bold" href="<?php echo base_url(); ?>Blog-Details/<?php echo $list->blog_id; ?>">Continue Reading ...</a>
                        </p>
                      </div>
                    </div>
                  </div>
                <?php $i++; } } ?>
              <!-- </div> -->
            </div>
          </div>



      </div>
    </div>
  </section>

  <?php include('include/footer1.php') ?>
</body>
</html>
