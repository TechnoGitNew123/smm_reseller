<?php
  $smm_reseller_id = $this->session->userdata('smm_reseller_id');
  $smm_res_company_id = $this->session->userdata('smm_res_company_id');
  $cust_reseller_info = $this->Master_Model->get_info_arr_fields('reseller_name','reseller_id', $smm_reseller_id, 'smm_reseller');

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/web_setting/<?php echo $web_setting_info[0]['web_setting_favicon']; ?>"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php if($web_template_id == 1){ ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/home1.css">
    <?php } elseif ($web_template_id == 2) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/home2.css">
    <?php } elseif ($web_template_id == 3) { ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/home3.css">
    <?php } ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/website.css">


    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css//owl.theme.default.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">

    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <title>SMM</title>
  </head>
  <body>


      <nav class="navbar navbar-expand-lg navbar-light top_navbar w-100">
        <a class="navbar-brand" href="#"> <img src="<?php echo base_url(); ?>assets/images/web_setting/<?php echo $web_setting_info[0]['web_setting_logo']; ?>"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-100" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto ">
            <a class="nav-item nav-link active" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">What We Offer!</a>
            <a class="nav-item nav-link" href="#">Services</a>
            <a class="nav-item nav-link" href="#">Blog</a>
            <?php if($smm_reseller_id && $smm_res_company_id){ ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $cust_reseller_info[0]['reseller_name']; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="<?php echo base_url(); ?>Logout">Logout</a>
                </div>
              </li>
              <!-- <a class="nav-item nav-link" href="<?php echo base_url(); ?>"><?php echo $cust_reseller_info[0]['reseller_name']; ?></a> -->
            <?php } else{ ?>
              <a class="nav-item nav-link" href="<?php echo base_url(); ?>Login">Login</a>
              <a class="nav-item nav-link" href="<?php echo base_url(); ?>Signup"> <button type="button" class="btn btn-outline-light btn-sign f-12">Sign Up</button> </a>
            <?php } ?>
            <!-- <a href="#" class="nav-item nav-link" data-toggle="modal" data-target=".myCart"><i class="fa m-f10 fa-shopping-cart "> Cart <span class="my-cart-badge"> 0</span></i></a> -->
          </div>
        </div>
      </nav>
      <?php if(isset($page) && ($page != 'Cart' && $page != 'Payment-Details')){ ?>
      <!-- Cart Modal -->
      <!-- <div class="modal fade myCart" id="myCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-shopping-cart"></i> My Cart <span class="text_color1">(<span class="my-cart-badge">0</span> Items)</span></h5>

            </div>
            <div class="modal-body m-autoscroll">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <?php if($smm_reseller_id && $smm_res_company_id){ ?>
                <a href="<?php echo base_url(); ?>Cart" type="button" class="btn btn-primary bg_color1">Proceed to Checkout</a>
              <?php } else{ ?>
                <a href="<?php echo base_url(); ?>Login" type="button" class="btn btn-primary bg_color1">Proceed to Checkout</a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div> -->
    <?php } ?>
