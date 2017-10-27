<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Communitytreasures</title>
<link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/headerlogo.png" type="image/x-icon"/>


<link href="<?php echo base_url(); ?>css/payment_style.css" type="text/css" rel="stylesheet"  />
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> 
<script src="https://code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>
<script src="https://www.google.com/recaptcha/api.js" async="" defer="defer"></script>

<script src="<?php echo base_url(); ?>js/jquery.validate.js"></script>

<link href="<?php echo base_url(); ?>css/style_community_login.css" rel="stylesheet" type="text/css"/>
  <style>
  #header {
    box-shadow: 0 0 5px #000;
    z-index: 99;
	border-bottom: 1px solid #dfdfdf;
}
.strtnw{
    background: #e91c7d none repeat scroll 0 0;
    border: 0 none;
    border-radius: 5px;
    color: #fcff1d;
    cursor: pointer;
    display: block;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 27px;
    font-weight: bold;
    line-height: 46px;
    margin-top: 13px;
    position: relative;
    width: 100%;
    z-index: 0;
	text-align:center;
}
    </style>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
<script>

	$.validator.setDefaults({
    	submitHandler: function() {
      		//window.location="submit.php";
      		$("#frncngpwd").submit();
    	}
  	});
	/*$(document).ready(function() {
		$("#btnsubmit").unbind().bind("click", function (event) {
		alert("hi");
					event.preventDefault();

					var testItem	= $("#sel_title").val()+"||"+$("#first_name").val()+"||"+$("#last_name").val()+"||"+$("#midname").val()+"||"+$("#email").val()+"||"+$("#phoneno").val()+"||"+$("#cat_name").val()+"||"+$("#country_name").val()+"||"+$("#industry").val();
                    alert(testItem);
					$("#item_number").val(testItem);

					$("#signupForm").submit();

				})
	})*/
	

	$(document).ready(function() {
	  //Form Validation
	    $("#frncngpwd").validate({
	        //by default the error elements is a <label>
	        errorElement: "div",
	        //place all errors in a <div id="errors"> element
	        errorPlacement: function(error, element) {
	            error.appendTo("div#errors");
	        },
	         
            rules: {             
              txtpassword: {
                required: true,
                minlength: 6,
              },            
              txtrepassword: {
                required: true,
                minlength: 6,
				equalTo: "#txtpassword",
              }
            },
	             
          highlight: function (element) {
          $(element).addClass('reds').removeClass('vlte')
          	.closest('.payment_frm_dv').addClass('invlte').removeClass('vlte');
          },
          unhighlight: function (element) {
          	$(element).addClass('vlte').removeClass('invlte')
            .closest('.payment_frm_dv').addClass('vlte').removeClass('invlte');
          }
	   });

	});

        </script>
</head>
<body>
<div class="login-container">
<div class="top-login_top" id="header">
  <div class="wrapper-login">
    <h1><img src="<?php echo base_url(); ?>images/logo-login.png" alt=""  style="margin-top: 10px; width: 370px;" /></h1>
    <!--<p class="login-righttop"> <a href="javascript:void(0)" class="forget-manu" style="float: left;">Forgotten your password?</a><span style=" float: left; margin-left: 20px;"><a href="javascript:void(0)" class="login-manu">Member Login</a></span> </p>-->
    <br class="clr" />
    
  </div>
  <div class="wrapper-login"><div class="top-log-menu">
<ul>
   <li><a href="<?php echo base_url(); ?>">Home</a></li>
  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/about-us">About Us</a></li>
  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/qspace">Qspace</a></li>
   <li><a href="<?php echo base_url(); ?>gateway/contentDetails/brand">Brands</a></li>
  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/opportunity">Opportunity</a></li>
  <li><a href="<?php echo base_url(); ?>">Sign Up</a></li>
  <li><a href="<?php echo base_url(); ?>gateway/contentDetails/contact-us">Contact Us</a></li>
</ul>
  </div>
  <br class="clr" />
</div> 
  </div>
<div class="top-login">
  
  <div style="min-height:350px; background:#fff;">
    <div class="middle-contentsec">

        <center>  
		<div class="signupsec">
    	<h1>Congratulation <?php echo $firstName; ?>! <br />
You have successfully registered to BB account</h1>     
             <p>Please login after 2min</p> 
             <a href="https://www.communitytreasures.co/ctdemo/" style="background: #0456c2;font-size: 20px;color: #fff;padding: 12px 10px;width: 179px;display: block;margin-top: 20px;border-radius: 5px;">Go To Login</a>
		</div>
		</center>
    <br class="cl">
    </div>
          
           <br class="cl">
</div>
  </div>

    
    
    
  <div class="footer-login">
    <div class="wrapper-login">
    
    <p class="foot_log"><img src="<?php echo base_url();?>images/footer_logo.png" alt=""></p>
    
      <p class="footer-topplink"> <a href="#">Personal Development</a> - <a href="#">Life & Wealth Mastery</a> - <a href="#">Financial Freedom</a> - <a href="#">Good Health</a> - <a href="#">Success</a> - <a href="#">Awakenings</a> - <a href="#">Wholeness</a> - <a href="#">Harmony</a> <a href="#">Prosperity</a> - <a href="#">Humanity</a> - <a href="#">Consciousness</a> - <a href="#">Rejuvenation</a> - <a href="#">Lifestyle</a> - <a href="#">Conscious Capitalism</a> - <a href="#">Ethical</a> - <a href="#">Social Entrepreneurism</a> - <a href="#">Joy
        Happiness</a> - <a href="#">Security</a> - <a href="#">Friendship</a> - <a href="#">Wellness</a> - <a href="#">Support</a> - <a href="#">Nutrition</a> </p>
        
        <p class="footer-newlink"><a href="<?php echo base_url(); ?>gateway/contentDetails/earnings-disclaimer">Earnings Disclaimer</a> | <a href="<?php echo base_url(); ?>gateway/contentDetails/privacy-policy">Privacy Policy</a> |
<a href="<?php echo base_url(); ?>gateway/contentDetails/terms-and-conditions">Terms & Conditions</a> |
<a href="<?php echo base_url(); ?>gateway/contentDetails/compliance">Compliance</a></p>
<p class="footer-copyright">? communitytreasures.co. All rights reserved.</p>
    </div>
  </div>
</div>
</body>
</html>
