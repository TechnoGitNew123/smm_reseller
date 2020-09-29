<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var url = window.location.href;

    $.ajax({
      url:'<?php echo base_url(); ?>WebsiteController/check_url',
      type: 'POST',
      data: {"url":url},
      context: this,
      success: function(result){
        if(result == 'success'){
          // alert('success');
          window.location.href = url+'Home';
        } else{
          window.location.href = url+'Home';
        }
      }
    });


  });
</script>
