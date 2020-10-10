<?php include('include/head1.php') ?>
  <div class="top_strip"></div>

  <section class="blog mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Our Blog</h1>
          <img class="border-svg w-100" src="<?php echo base_url(); ?>assets/images/website/home1/underline.svg" alt="package image">
          <p class=" space text-center">Lorem ipsum is placeholder text commonly used in the graphic,</p>
        </div>

        <?php $i=0; foreach ($blog_list as $list) {
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
        <?php $i++; } ?>
      </div>
    </div>
  </section>

  <?php include('include/footer1.php') ?>
</body>
</html>
