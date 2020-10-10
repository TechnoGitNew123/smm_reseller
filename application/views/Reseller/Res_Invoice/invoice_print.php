<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SMM | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
  <div class="wrapper">
    <!-- Main content -->
    <div class="row">
      <p style="text-align:center; font-size:17px; margin-top: 3px; margin-bottom: 5px;text-transform: uppercase; width:100%;"> <b>Tax Invoice</b>  </p>
    </div>
    <table class="table table-bordered mb-0 invoice-table" Width="100%">
      <style media="print">
      .invoice-table{
        border-collapse: collapse;

      }
      .invoice-table, .invoice-table td, .invoice-table th{
      border :1px solid #000;
      padding-left: 10px;

    }

        /* .invoice-table tr, td, th{
            border: 1px solid #000!important;
        } */
        .invoice-table{
          margin-bottom:0px!important;
          border: 1px solid #000!important;
          padding-bottom:0px!important;
        }
        .invoice-table p{
          line-height: 15px;
        }
        .pull-right{
          float: right!important;
        }
        hr{
            border-top: 1px solid #000!important;
        }
        p{
          margin-top: 3px;
          margin-bottom: 5px;
        }
      </style>
      <style media="screen">
      .invoice-table{
        border-collapse: collapse;
      }

        .invoice-table tr, .invoice-table td, .invoice-table th{
            border: 1px solid #000!important;
              padding-left: 10px;
        }
        .invoice-table{
          margin-bottom:0px!important;
          border: 1px solid #000!important;
          padding-bottom:0px!important;
        }
        .invoice-table p{
          line-height: 15px;
        }
        .pull-right{
          float: right!important;
        }
        hr{
            border-top: 1px solid #000!important;
        }
        p{
          margin-top: 3px;
          margin-bottom: 5px;
        }
      </style>

      <style media="print">
        .com_info{
          width: 100%;
        }
        .com_info, .com_info tr, .com_info td{
          border: none !important;
        }
        .com_info_txt{
          margin-left: -100px !important;
        }
        .com_info2, .com_info2 tr, .com_info2 td{
          border: none !important;
        }
      </style>
      <style media="screen">
        .com_info{
          width: 100%;
        }
        .com_info, .com_info tr, .com_info td{
          border: none !important;
        }
        .com_info_txt{
          margin-left: -100px !important;
        }

        .com_info2, .com_info2 tr, .com_info2 td{
          border: none !important;
        }
      </style>
      <tr >
        <td   colspan="6" >
          <table class="com_info">
            <tr>
              <td>
                <img width="100px" src="<?php echo $com_logo; ?>" alt="">
              </td>
              <td>
                <!-- <table class="com_info2">
                  <tr>
                    <td>
                      <img width="100px" src="<?php echo $com_logo; ?>" alt="">
                    </td>
                  </tr>
                </table> -->
                <div  style="text-align:center;">
                  <h3 class="com_info_txt" style="font-family: 'Arial Black', 'Arial Bold', Gadget, sans-serif; font-size:28px; font-weight:bold; text-transform:uppercase; margin-top:5px; margin-bottom:3px;" > <?php echo $com_name; ?></h3>
                  <p class="com_info_txt" style="margin-bottom:5px; line-height:20px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px; margin-top:5px;" > <b> <?php echo $com_address; ?></p>
                  <p class="com_info_txt"  style="margin-bottom:5px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px;">Mobile No: <?php echo $com_mobile; ?> &nbsp; | &nbsp; Email : <?php echo $com_email; ?></p>
                  <p class="com_info_txt"  style="margin-bottom:5px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px;"> GST No: <?php echo $com_gst; ?> &nbsp; | &nbsp; Website : <?php echo $com_website; ?> </p>
                </div>
              </td>
            </tr>
          </table>

            <!-- <div class="" style="text-align:center;">
              <h3 style="font-family: 'Arial Black', 'Arial Bold', Gadget, sans-serif; font-size:28px; font-weight:bold; text-transform:uppercase; margin-top:5px; margin-bottom:3px;" > <?php echo $com_name; ?></h3>
              <p style="margin-bottom:5px; line-height:20px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px; margin-top:5px;" > <b> <?php echo $com_address; ?></p>
              <p  style="margin-bottom:5px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px;">Mobile No: <?php echo $com_mobile; ?> &nbsp; | &nbsp; Email : <?php echo $com_email; ?></p>
              <p  style="margin-bottom:5px; font-family: Calibri, Candara, Segoe, 'Segoe UI'; font-size: 16px;"> GST No: <?php echo $com_gst; ?> &nbsp; | &nbsp; Website : <?php echo $com_website; ?> </p>
            </div> -->
        </td>
      </tr>
      <tr>
        <td colspan="4" Width="60%" >
          <p>To</p>
          <p> <b><?php echo $invoice_details['invoice_client_name']; ?></b>  </p>
          <p> <b>Address</b> : <?php echo $invoice_details['invoice_client_address']; ?></p>
        </td>
        <td colspan="2" Width="40%" valign="top">
          <p> <b>Invoice No</b> : <?php echo $invoice_details['invoice_no_prefix'].''.$invoice_details['invoice_no']; ?></p>
          <p> <b>Dated </b> : <?php echo $invoice_details['invoice_date']; ?></p>
          <p> <b>GSTIN</b> : <?php echo $invoice_details['invoice_client_gstin']; ?> </p>
          <p><b>State Code</b> : <?php echo $invoice_details['invoice_client_statecode']; ?> </p>
        </td>
      </tr>

    </table>

    <table class="table table-bordered invoice-tbl-2"  width="100%">
      <style media="print">
      /* @media print {
          table{
            margin: 0px;
          }
       } */
        .invoice-tbl-2{
        margin-top:0px;
        padding-top:0px;
        border-top:0px;
        border: 1px solid #000!important;
        border-top: 0px!important;
        margin-top: 0px!important;
        padding-top: 0px!important;
        vertical-align: top;
        }
        hr{
            border-top: 1px solid #000!important;
        }
          .invoice-tbl-2 tr, th, td{
            border: 1px solid #000!important;
            border-top: 0px!important;
          }
          .pull-right{
            float: right!important;
          }
      </style>
      <style media="screen">
      /* @media print {
          table{
            margin: 0px;
          }
       } */
        .invoice-tbl-2{
        margin-top:0px;
        padding-top:0px;
        border-top:0px;
        border: 1px solid #000!important;
        border-top: 0px!important;
        margin-top: 0px!important;
        padding-top: 0px!important;
        vertical-align: top;
        }
        hr{
            border-top: 1px solid #000!important;
        }
          .invoice-tbl-2 tr, th, td{
            border: 1px solid #000!important;
            border-top: 0px!important;
          }
          .pull-right{
            float: right!important;
          }
      </style>
      <tr>
        <th style="width: 10px; text-align:center;">Sr.No.</th>
        <th style="text-align:center;"> DESCRIPTION</th>
        <th style="text-align:center;">TAX RATE</th>
        <th style="text-align:center;" Width="9%" >QTY </th>
        <th style="text-align:center;" >RATE</th>
        <th style="text-align:center;" >TOTAL</th>
      </tr>
      <tr>
        <td style="text-align:center;">1</td>
        <td style="text-align:center;"><?php echo $invoice_details['package_name']; ?></td>
        <td style="text-align:center;" ><?php echo $invoice_details['gst_slab_per']; ?>%</td>
        <td style="text-align:center;">1</td>
        <td style="text-align:center;">₹<?php echo $invoice_details['invoice_net_amt']; ?></td>
        <td style="text-align:center;">₹<?php echo $invoice_details['invoice_net_amt']; ?></td>
      </tr>
      <tr>
        <td colspan="4" rowspan=""></td>
        <td colspan="2" Width="40%" valign="top">
          <p><b>Basic Amount</b> : ₹<?php echo $invoice_details['invoice_basic_amt']; ?></p> <hr style="margin-left:-10px;">
          <?php if($com_statecode == $invoice_details['invoice_client_statecode']){ ?>
            <p><b>IGST <?php echo $invoice_details['gst_slab_per']; ?>% </b> : ₹<?php echo $invoice_details['invoice_gst_amt']; ?></p>  <hr style="margin-left:-10px;">
          <?php } else{ ?>
            <p><b>CGST <?php echo $invoice_details['gst_slab_per']/2; ?>% </b> : ₹<?php echo $invoice_details['invoice_gst_amt']/2; ?></p>  <hr style="margin-left:-10px;">
            <p><b>SGST <?php echo $invoice_details['gst_slab_per']/2; ?>%</b> : ₹<?php echo $invoice_details['invoice_gst_amt']/2; ?></p>  <hr style="margin-left:-10px;">
          <?php } ?>

          <!-- <p><b>Rounding</b> : 000 </p>  <hr style="margin-left:-10px;"> -->
          <p><b>Total Amount</b> : ₹<?php echo $invoice_details['invoice_net_amt']; ?> </p>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <br>
          <p>
            Customer Sign
            <span style="float:right;">For <b><?php echo $com_name; ?></b> </span>
          </p>
        </td>
        <!-- <td colspan="5">
            <p> <b>Bank Name</b> : &nbsp;ICICI Bank</p>
            <p> <b>Account No</b> : 645005002303 </p>
            <p> <b>IFSC Code </b>&nbsp; : ICIC0006450 </p>
            <p> <b>Declaration </b> : We declare that the invoice shows the actual price of the goods described and that all particulars are true and correct. </p>
        </td>
        <td colspan="1">
          <img src="<?php echo base_url() ?>assets/img/stamp.png" alt="">
        </td> -->
      </tr>



    </table>



    <!-- /.content -->
  </div>
<!-- ./wrapper -->

<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>
</body>
</html>
