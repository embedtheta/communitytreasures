<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Example</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
</head>
<body class="categoryDetailPopUp">
<div class="container" id="successmsg" style="display:none;">
  <div class="row" style="background: #fcff00;margin-top: 10px;">
    <div class="span12">
      <div class="thumbnail center well well-small text-center">
        <h2>THANK YOU <br/> Here is your voucher code.</h2>
        <!-- <p>Please check your mail for Voucher code.</p> -->
		
        <p id="voucher">Your Voucher code is <span id="voucherCode"></span></p>
		<p> <button onclick="myFunction()" id="myprint">Print</button> </p>
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
<script>
function myFunction() {
    window.print();
}
</script>
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