// Valid Email...
$(document).on('change','.email',function(){
  var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
  var email = $(this).val();
  if (testEmail.test(email)){

  } else{
    toastr.error('Invalid Email Format');
    $(this).val('');
  }
});

// Valid Website URL...
$(document).on('change','.website',function(){
  var format = /^[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
  var website = $(this).val();
  if (format.test(website)){

  } else{
    toastr.error('Invalid Website Format');
    $(this).val('');
  }
});

// Valid PAN Number...
$(document).on('change','.pan_no',function(){
  var format = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
  var pan_no = $(this).val();
  if (format.test(pan_no)){

  } else{
    toastr.error('Invalid PAN Number Format');
    $(this).val('');
  }
});

// Valid GST Number...
$(document).on('change','.gst_no',function(){
  var format = /[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[0-9A-Z]{1}[0-9A-Z]{1}$/;
  var gst_no = $(this).val();
  if (format.test(gst_no)){

  } else{
    toastr.error('Invalid GST Number Format');
    $(this).val('');
  }
});

// Valid PinCode Number...
$(document).on('change','.pincode_no',function(){
  var format = /[0-9]{3}$/;
  var pincode_no = $(this).val();
  // alert(pincode_no);
  if (format.test(pincode_no)){
  //
  } else{
    toastr.error('Invalid Pincode Format');
    $(this).val('');
  }
});

// Valid PinCode Number...
$(document).on('change','.mobile_no',function(){
  var format = /[5-9]{1}[0-9]{9}$/;
  var mobile_no = $(this).val();
  // alert(pincode_no);
  if (format.test(mobile_no)){
  //
  } else{
    toastr.error('Invalid Mobile Number Format');
    $(this).val('');
  }
});

$('.password, .con_password').on('change',function(){
  var password = $('.password').val();
  var con_password = $('.con_password').val();
  if(password != con_password){
    toastr.error('Password and Confirm Password must be same');
    $('.con_password').val('');
  }
});

// image

$('.valid_image').bind('change', function() {
  var size = this.files[0].size;
  var type = this.files[0].type;
  if(size > 561276){
    toastr.error('File size is must be less than 500kb');
    $(this).val('');
  }
  if(type != "image/jpeg" && type != "image/jpg" && type != "image/png"){
    toastr.error('Invalid File Type');
    $(this).val('');
  }
});
