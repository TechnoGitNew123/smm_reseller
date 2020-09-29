// Add To Cart...
  $('.package_div .add-card').on('click',function(){
    var package_id = $(this).closest('.package_info').find('.package_id').val();
    var reseller_package_id = $(this).closest('.package_info').find('.reseller_package_id').val();
    var package_name = $(this).closest('.package_info').find('.package_name').val();
    var package_price = $(this).closest('.package_info').find('.package_price').val();
    var package_qty = $(this).closest('.package_info').find('.package_qty').val();
    var gst_slab_id = $(this).closest('.package_info').find('.gst_slab_id').val();
    var package_qty = parseInt(package_qty);
    if(package_qty > 0){
      $.ajax({
        url:base_url+'Cart/add_to_cart',
        type: 'POST',
        data: {
               "package_id":package_id,
               "reseller_package_id":reseller_package_id,
               "package_name":package_name,
               "package_price":package_price,
               "package_qty":package_qty,
               "gst_slab_id":gst_slab_id,
               // "package_qty":package_qty,
              },
        context: this,
        success: function(result){
          var data = JSON.parse(result);
          // alert(data);
          $('#myCart .modal-body').html(data['cart']);
          $('.my-cart-badge').html(data['row_count']);
          toastr.success('Product Added To Cart');
        }
      });
    }
  });






















// Show Price of Attribute on Page Load..
  $(document).ready(function(){
    $('.product_item .select_product_attr').each(function(){
      var product_price =  $(this).find("option:selected").attr('product_price');
      var product_mrp =  $(this).find("option:selected").attr('product_mrp');
      var product_attr =  $(this).find("option:selected").attr('product_attr');
      var product_dis_per = $(this).find("option:selected").attr('product_dis_amt');
      var product_price_det = ''+product_price+'';
      var product_mrp_det = 'Rs. '+product_mrp+'';

      $(this).closest('.card-body').find('.prod_pri').text(product_price_det);
      $(this).closest('.card-body').find('.prod_mrp').html('<span class="line-throw">'+product_mrp_det+'</span>&nbsp;&nbsp;&nbsp;&nbsp;');
      if(product_dis_per > 0){
        if(product_dis_per < 10){ product_dis_per = '0'+product_dis_per; }
        $(this).closest('.card').find('.discount').css('display','block');
        $(this).closest('.card').find('.product_discount_per').text(product_dis_per);
      } else{
        // $(this).closest('.card').find('.discount').css('display','none');
        $(this).closest('.card').find('.product_discount_per').text(product_dis_per);
      }
    });
  });

  // Show Price on Select Attribute..
  $('.product_item .select_product_attr').on('change',function(){
    var product_price =  $(this).find("option:selected").attr('product_price');
    var product_mrp =  $(this).find("option:selected").attr('product_mrp');
    var product_attr =  $(this).find("option:selected").attr('product_attr');
    var product_dis_per = $(this).find("option:selected").attr('product_dis_amt');
    var product_price_det = ''+product_price+'';
    var product_mrp_det = 'Rs. '+product_mrp+'';

    $(this).closest('.card-body').find('.prod_pri').text(product_price_det);
    $(this).closest('.card-body').find('.prod_mrp').html('<span class="line-throw">'+product_mrp_det+'</span>&nbsp;&nbsp;&nbsp;&nbsp;');
    if(product_dis_per > 0){
      $(this).closest('.card').find('.discount').css('display','block');
      $(this).closest('.card').find('.product_discount_per').text(product_dis_per);
    } else{
      // $(this).closest('.card').find('.discount').css('display','none');
      $(this).closest('.card').find('.product_discount_per').text(product_dis_per);
    }
  });

  // // Quantity Add...
  // $('.btn_qty_plus').on('click',function(){
  //   var old_qty =  $(this).closest('.card-body').find('.product_qty').val();
  //   if(old_qty == ''){ old_qty = 0; }
  //   var old_qty = parseInt(old_qty);
  //   var product_qty = old_qty + 1;
  //   $(this).closest('.card-body').find('.product_qty').val(product_qty);
  // });
  //
  // // Quantity Minus...
  // $('.btn_qty_minus').on('click',function(){
  //   var old_qty =  $(this).closest('.card-body').find('.product_qty').val();
  //   if(old_qty == ''){ old_qty = 0; }
  //   var old_qty = parseInt(old_qty);
  //   if(old_qty > 1){
  //     var product_qty = old_qty - 1;
  //   } else{
  //       var product_qty = 1;
  //   }
  //   $(this).closest('.card-body').find('.product_qty').val(product_qty);
  // });

  // Show Cart on Page Load.




  // Add To Wishlist...
  $('.product_item .add_to_wishlist').on('click',function(){
    var product_id = $(this).closest('.card-body').find('.select_product_attr').find("option:selected").attr("product_id");
    $.ajax({
      url:base_url+'Cart/add_to_wishlist',
      type: 'POST',
      data: {
             "product_id":product_id,
            },
      context: this,
      success: function(result){
        var data = JSON.parse(result);
        if(data['code'] == 2){
          toastr.success(data['msg']);
        } else{
          toastr.error(data['msg']);
        }
      }
    });
  });

  // Add To Wishlist...
  $('.product_item .remove_from_wishlist').on('click',function(){
    var wishlist_id = $(this).closest('.card-body').find('.select_product_attr').find("option:selected").attr("wishlist_id");
    $.ajax({
      url:base_url+'Cart/remove_from_wishlist',
      type: 'POST',
      data: {
             "wishlist_id":wishlist_id,
            },
      context: this,
      success: function(result){
        toastr.error(result);
        $(this).closest('.block_pro').addClass('d-none');
      }
    });
  });
