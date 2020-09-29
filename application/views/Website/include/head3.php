<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/web_setting/<?php echo $web_setting_info[0]['web_setting_favicon']; ?>"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/home3.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css//owl.theme.default.min.css">
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <title>SMM</title>
  </head>
  <body>
    <section class="home-nav">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="#"> <img src="<?php echo base_url(); ?>assets/images/web_setting/<?php echo $web_setting_info[0]['web_setting_logo']; ?>"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link active" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">What We Offer!</a>
            <a class="nav-item nav-link" href="#">Services</a>
            <a class="nav-item nav-link" href="#">Blog</a>
            <a class="nav-item nav-link" href="<?php echo base_url(); ?>Login">Login</a>
            <a class="nav-item nav-link" href="<?php echo base_url(); ?>Signup"><button type="button" class="btn btn-outline-light btn-sign f-12">Sign Up</button> </a>
            <a href="#" class="nav-item nav-link" data-toggle="modal" data-target="#myCart"><i class="fa m-f10 fa-shopping-cart "> Cart <span class="my-cart-badge"> 0</span></i></a>
          </div>
        </div>
      </nav>

      <!-- Cart Modal -->
      <div class="modal fade" id="myCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-shopping-cart"></i> My Cart <span class="text_color1">(<span class="my-cart-badge">0</span> Items)</span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body m-autoscroll">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <?php //$row_count = count($this->cart->contents());
              //if($row_count > 0){ ?>
                <a href="<?php echo base_url(); ?>Cart" type="button" class="btn btn-primary bg_color1">Proceed to Checkout</a>
              <?php //} ?>
            </div>
          </div>
        </div>
      </div>
