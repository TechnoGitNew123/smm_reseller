<section class="footer">
  <div class="container">
    <div class="row">
       <div class="col-md-3">
         <img class="bg-grey footer-menu" src="<?php echo $web_setting_info[0]['web_setting_logo']; ?>" >
         <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid</p>
         <p>Call : <?php echo $web_setting_info[0]['web_setting_mobile']; ?></p>
         <p>email : <?php echo $web_setting_info[0]['web_setting_email']; ?></p>
         <p>Working Hours: 9 Am - 6 Pm </p>
       </div>
      <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <h4>Recent Post</h4>
                <div class="row">
                    <div  class="col-4 p-0">
                      <img class="small-img" src="<?php echo base_url(); ?>assets/images/website/bg-last.png">
                    </div>
                    <div class="col-6 p-0">
                      <p class="f-12"> enim eiusmod high life accusamus terry</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div  class="col-4 p-0">
                      <img class="small-img" src="<?php echo base_url(); ?>assets/images/website/bg-last.png">
                    </div>
                    <div class="col-6 p-0">
                      <p class="f-12"> enim eiusmod high life accusamus terry</p>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <h4>Our Store</h4>
               <ul>
                 <li>Mumbai</li>
                <li>Delhi</li>
                <li>Chennai</li>
                <li>Kolkatta</li>
               </ul>

            </div>

            <div class="col-md-3">
                <h4>Useful Links</h4>
                <ul>
                 <li>Privacy policy</li>
                <li>Return</li>
                <li>Terms & Condition</li>
                <li>Contact us</li>
               </ul>
            </div>

            <div class="col-md-3">
                 <h4>Footer Menu</h4>
                <ul>
                 <li>Instagram Profile</li>
                <li>New Collection </li>
                <li>Women Dress</li>
                <li>Contact us</li>
               </ul>
            </div>
        </div>
      </div>
    </div>

    <div class="bottom ">
        <div class="row">
          <div class="col-md-6">
            <p>Copyright @ 2020 - <?php echo $web_setting_info[0]['web_setting_name']; ?> </p>
          </div>

           <div class="col-md-6 text-right m-center">
               <img  src="<?php echo base_url(); ?>assets/images/website/visa.png">
          </div>
        </div>
    </div>

  </div>
</section>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">var base_url = "<?php echo base_url(); ?>";</script>
<script src="<?php echo base_url(); ?>assets/js/add_to_cart.js"></script>
<script type="text/javascript">
$('.owl-carousel').owlCarousel({
loop:true,
margin:10,
nav:true,
autoplay:true,
autoplayTimeout:3000,
autoplayHoverPause:true,
responsive:{
  0:{
      items:1
  },
  600:{
      items:2
  },
  1000:{
      items:3
  }
}
})
</script>

<script type="text/javascript">
// Load Cart on Page Load...
  $(document).ready(function(){
    $.ajax({
      url:'<?php echo base_url(); ?>Cart/load_cart',
      context: this,
      success: function(result){
        var data = JSON.parse(result);
        $('#myCart .modal-body').html(data['cart']);
        $('.my-cart-badge').html(data['row_count']);

        $('#total_basic').html(data['total_basic']);
        $('#total_gst').html(data['total_gst']);
        $('#cart_total').html(data['cart_total']);

      }
    });
  });

  // if Quanity value less than 1 entered...
    $(document).on('change','.cart_product_qty', function(){
      var product_qty = parseInt($(this).val());
      if(product_qty < 1){
        $(this).val('1');
          toastr.error('Invalid Quanity');
      }
    });

    // Quantity Add...
    $(document).on('click', '#myCart .btn_qty_plus', function(){
      var old_qty =  $(this).closest('tr').find('.cart_product_qty').val();
      if(old_qty == ''){ old_qty = 0; }
      var old_qty = parseInt(old_qty);
      var package_qty = old_qty + 1;
      // $(this).closest('tr').find('.cart_product_qty').val(product_qty);
      var rowid = $(this).closest('tr').find('.rowid').val();
      $.ajax({
        url:'<?php echo base_url(); ?>Cart/update_qty',
        type: 'POST',
        data: {
               "rowid":rowid,
               "package_qty":package_qty,
              },
        context: this,
        success: function(result){
          var data = JSON.parse(result);
          $('#myCart .modal-body').html(data['cart']);
          $('.my-cart-badge').html(data['row_count']);
          // var data = JSON.parse(result);
          // $(this).closest('tr').find('.cart_product_qty').val(data['qty']);
          // $(this).closest('tr').find('.cart_product_subtotal').html('&#8377;'+data['subtotal']);
          // $('#myCart').find('.cart_total').html('&#8377;'+data['cart_total']);
        }
      });
    });

    // Quantity Minus...
    $(document).on('click', '#myCart .btn_qty_minus', function(){
      var old_qty =  $(this).closest('tr').find('.cart_product_qty').val();
      if(old_qty == ''){ old_qty = 0; }
      var old_qty = parseInt(old_qty);
      if(old_qty > 1){
        var package_qty = old_qty - 1;
      } else{
          var package_qty = 1;
      }
      var rowid = $(this).closest('tr').find('.rowid').val();
      $.ajax({
        url:'<?php echo base_url(); ?>Cart/update_qty',
        type: 'POST',
        data: {
               "rowid":rowid,
               "package_qty":package_qty,
              },
        context: this,
        success: function(result){
          var data = JSON.parse(result);
          $('#myCart .modal-body').html(data['cart']);
          $('.my-cart-badge').html(data['row_count']);
        }
      });
    });

    $(document).on('change', '#myCart .cart_product_qty', function(){
      var package_qty =  $(this).closest('tr').find('.cart_product_qty').val();
      var rowid = $(this).closest('tr').find('.rowid').val();
      // alert(product_qty);
      $.ajax({
        url:'<?php echo base_url(); ?>Cart/update_qty',
        type: 'POST',
        data: {
               "rowid":rowid,
               "package_qty":package_qty,
              },
        context: this,
        success: function(result){
          var data = JSON.parse(result);
          $('#myCart .modal-body').html(data['cart']);
          $('.my-cart-badge').html(data['row_count']);
        }
      });
    });

    // Remove Item from Cart...
    $(document).on('click', '#myCart .rem_cart_row', function(){
      var rowid = $(this).closest('tr').find('.rowid').val();
      if(confirm('Do you want to remove this?')){
        $(this).closest('tr').remove();
        $.ajax({
          url:'<?php echo base_url(); ?>Cart/delete_cart_item',
          type: 'POST',
          data: {
                 "rowid":rowid,
                },
          context: this,
          success: function(result){
            // var data = JSON.parse(result);
            // $('.my-cart-badge').html(data['row_count']);
            // $('#myCart').find('.cart_total').html('&#8377;'+data['cart_total']);
            var data = JSON.parse(result);
            $('#myCart .modal-body').html(data['cart']);
            $('.my-cart-badge').html(data['row_count']);
            toastr.error('Deleted successfully');
          }
        });
      } else{
        return false;
      }
    });
</script>
