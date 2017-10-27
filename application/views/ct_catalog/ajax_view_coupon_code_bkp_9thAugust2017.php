<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script language="javascript">
function PrintMe(DivID) {
var disp_setting="toolbar=yes,location=no,";
disp_setting+="directories=yes,menubar=yes,";
disp_setting+="scrollbars=yes,width=650, height=600, left=100, top=25";
   var content_vlue = document.getElementById(DivID).innerHTML;
   var docprint=window.open("","",disp_setting);
   docprint.document.open();
   docprint.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"');
   docprint.document.write('"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">');
   docprint.document.write('<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">');
   docprint.document.write('<head><title>My Title</title>');
   docprint.document.write('<style type="text/css">body{ margin:0px;');
   docprint.document.write('font-family:verdana,Arial;color:#000;');
   docprint.document.write('font-family:Verdana, Geneva, sans-serif; font-size:12px;}');
   docprint.document.write('a{color:#000;text-decoration:none;} </style>');
   docprint.document.write('</head><body onLoad="self.print()"><center>');
   docprint.document.write(content_vlue);
   docprint.document.write('</center></body></html>');
   docprint.document.close();
   docprint.focus();
}
</script>

<style>
.fancybox-skin {
	background:#00b0df !important;
	border:1px solid #000 !important;
}
body.categoryDetailPopUp {
	background: #00b0df;
	height: 228px;
}
#successmsg.container .row {
    margin-top: 0 !important;
}
body.categoryDetailPopUp .thumbnail.center.well.well-small.text-center {
	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
	border: 0 none;
	border-radius: 0;
	box-shadow: 0 0;
	margin: 0;
	padding: 0;
	min-height: inherit;
	height: 100%;
}
body.categoryDetailPopUp .thumbnail.center.well h2 {
	border-bottom: 1px solid #40c5e8;
	color: #fff;
	margin-bottom: 20px;
	padding-bottom: 8px;
}
body.categoryDetailPopUp .thumbnail.center.well p {
	color:#fff;
}
body.categoryDetailPopUp .sub_mit .input-prepend > input[type="text"] {
	background: #0090b5 none repeat scroll 0 0;
	border: 0 none;
	padding: 5px;
	color:#a3cddd;
}
.sub_mit {
	padding-bottom:20px;
}
.sub_mit .input-prepend {
	display: inline-block;
}
body.categoryDetailPopUp .sub_mit input[type="button"] {
	background: #d4d201 none repeat scroll 0 0;
	border: 0 none;
	border-radius: 0;
	color: #353304;
	display: inline-block;
	margin: 0 0 0 -4px;
	padding: 5px;
	vertical-align: top;
}
#voucher > span {
    display: block;
    font-size: 30px;
}
#successmsg {
    
    color: #000;
}
body.categoryDetailPopUp #successmsg .thumbnail.center.well h2 {
    border-bottom: 1px solid #d6d91b;
color: #000;

}
body.categoryDetailPopUp #successmsg #voucher{color:#000;}


#myprint {background: #000;
    border: 0;
    padding: 5px 30px;
    border-radius: 3px;
    font-size: 16px !importan}
</style>

<style type="text/css">
*{padding:0; margin:0; font-family:Arial, Helvetica, sans-serif;}
.vtemp{width:650px; margin:0 auto; background:#e31836; color:#fff; padding:15px;}
.take-extra {
    border-bottom: 1px solid #fff;
	margin: 25px 0 30px 0;
}
.take-extra span{margin-bottom: -8px;
display: block;
background: #e31836;
width: 142px;
font-size: 18px;
}
.pricetab {
    padding: 15px 0;
	font-size: 22px;
	background:#f0e803;
	color:#000;
}
.pricetab span{display: block;
font-size: 24px;
color: #000;
}
.voucher-code {
    text-align: center;
    font-size: 22px;
	
}
.voucher-code span{display: block;
width: 200px;
margin: 0 auto;
    margin-top: 0px;
padding: 10px;
margin-top: 7px;
border: 1px solid #f42e4c; color:#f0e803;
font-size: 18px;
}
.for-product {
    text-align: center;
    padding-top: 10px;
    font-size: 17px;
}
.for-product strong{font-size:14px;}
#divid{display: none;}
</style>
</head>
<body class="categoryDetailPopUp">
<div class="container" id="successmsg" style="display:none;">
  <div class="row" style="background: #fcff00;margin-top: 10px;">
    <div class="span12">
      <div class="thumbnail center well well-small text-center">
        <h2>THANK YOU <br/> Here is your voucher code.</h2>
        <!-- <p>Please check your mail for Voucher code.</p> -->
		
        <p id="voucher">Your Voucher code is <span id="voucherCode"></span></p>
		<p> <input type="button" name="btnprint" id="myprint" value="Print" onclick="PrintMe('divid')"/><!-- <button onclick="myFunction()" id="myprint">Print</button> --> </p>
      </div>
    </div>
  </div>
</div>
<div class="container" id="errorsmsg" style="display:none;">
  <div class="row">
    <div class="span12">
      <div class="thumbnail center well well-small text-center">
        <h2>CT VOUCHER CODE VERIFICATION FAILED</h2>
        <p>You have Failed verify your email Id.</p>
        <p>Please reenter it again.</p>
      </div>
    </div>
  </div>
</div>
<div class="totalForm" >
  <form method="post" id="fromDetails" action="" autocomplete="off">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="thumbnail center well well-small text-center">
            <h2>GET VOUCHER</h2>
            <p>To Get this Voucher code in your email ID</p>
            <div class="sub_mit">
              <div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span>
                <input type="text" id="emailid" name="emailid" placeholder="your@email.com" value="">
                <input type="hidden" id="productID" name="productID" value="<?php echo $prodId; ?>">
              </div>
              <input type="button" value="SUBMIT" class="btn btn-large" id="btn2" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div id="divid">
<div style="width:650px; margin:0 auto; background:#e31836; color:#fff; padding:15px;">
	
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #fff; padding:15px;">
				  <tr>
				    <td align="center" valign="top" style="padding:15px 0; background: #fff;"><img src="https://www.communitytreasures.co/ctdemo/images/CT_LOGONEW.png" alt=""  /></td>
				  </tr>
				  <tr>
				    <td align="center" valign="top">
				    <div style=" border-bottom: 1px solid #fff;
	margin: 25px 0 30px 0;"><span style="margin-bottom: -8px;
display: block;
background: #e31836;
width: 142px;
font-size: 18px;">Take an extra</span></div>
				    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:0;">
				  <tr>
				    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
				    <td align="center" valign="top" style=" padding: 15px 0; font-size: 22px; background:#f0e803; color:#000;">Usual Price : <span style="text-decoration:line-through; display: block; font-size: 24px; color: #000;">$10.00</span>  </td>
				    <td align="center" valign="top" width="10%">&nbsp;</td>
				    <td align="center" valign="top" style=" padding: 15px 0; font-size: 22px; background:#f0e803; color:#000;">Offer Price : <span style="display: block; font-size:32px; color: #000; font-weight: bold;">$50.00</span></td>
				  </tr>
				</table>
				</td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				  </tr>
				  <tr>
				    <td style=" text-align: center; font-size: 22px;">Voucher code : <span style="display: block; width: 200px; margin: 0 auto; margin-top: 0px; padding: 10px; margin-top: 7px; border: 1px solid #f42e4c; color:#f0e803; font-size: 18px;">CFXCV11</span></td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				  </tr>
				  <tr>
				    <td><p style=" text-align: center;
    padding-top: 10px;
    font-size: 17px;">For Product FlipFlopBinaray on <br />
				<strong>communitytreasures.co</strong></p></td>

				  </tr>
				  <tr>
				  <td>Copyright @ communitytreasures.co 2017</td>
				  </tr>
				</table>

				    </td>
				  </tr>
				  <tr>
				    <td align="left" valign="top">&nbsp;</td>
				  </tr>
				</table>
	</div>
</div>



<script>
    $(document).on("click",".btn-large", function(){
            //var type = $('#type').val();
           var base_url='<?php echo base_url();?>';
		   var EmailId = $("#emailid").val();
		   if(EmailId==""){
			   alert("Please enter your email ID");
			   return false;
			}else if(!validateEmail(EmailId)){
				alert("Please enter valid email ID");
				return false;
			}else{
			   $.ajax({
					type: "POST",
					url: base_url+'dashboard/ajax_coupon_code_submission',
					dataType: 'json',
					data: $('#fromDetails').serialize(),
					success: function(result){ 
						var retData = result.process.trim();
						var vouchercode = result.voucherCode;
					   if(result.process=="success"){
							$('.totalForm').hide();
							if(vouchercode!=null){
								$('#voucherCode').html(result.voucherCode);
							}else{
								$('#voucher').hide();
							}
							$('#successmsg').show();
					   }
					   else{
							$('.totalForm').hide();
							$('#errorsmsg').show();
					   }
					   // $("#colltionamountdiv").html('');
					}
				});
		}
    });
   function validateEmail($email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		return emailReg.test( $email );
	}
</script>
</body>
</html>