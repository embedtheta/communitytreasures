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
	
	
<!--<link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>css/style_new.css" rel="stylesheet" type="text/css"/>-->
<link href="<?php echo base_url(); ?>css/style_community_login.css" rel="stylesheet" type="text/css"/>

<!--new added ujjwal sana
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>-->

<!--new added ujjwal sana
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->

<!--fancy box
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.sticky.js"></script>-->
<script>
var functionUrl		= "<?=base_url()?>payment/chkUser/";

	/*$.validator.setDefaults({
    	submitHandler: function() {
      		//window.location="submit.php";
      		$("#signupForm").submit();
    	}
  	});*/
	$(document).ready(function() {
		var pr = $("#price").val();
		if (pr == "")
		{
			$("#signupForm").hide();
			var testItem	= $("#sel_title").val()+"||"+$("#first_name").val()+"||"+$("#last_name").val()+"||"+$("#midname").val()+"||"+$("#email").val()+"||"+$("#phoneno").val()+"||"+$("#cat_name").val()+"||"+$("#country_name").val()+"||"+$("#industry").val()+"||"+$("#amount").val()+"||"+$("#user_id").val()+"||"+"AP";
            //alert(testItem);
			$("#item_number").val(testItem);			
			$(".loaderr").show();
			$("#signupForm").submit();
			
		}
		else{
			
			$(".loaderr").hide();
		}
		$("#signupForm").validate({
	        //by default the error elements is a <label>
	        errorElement: "div",
	        //place all errors in a <div id="errors"> element
	        errorPlacement: function(error, element) {
	            error.appendTo("div#errors");
	        },
	         
            rules: {             
              first_name: {
                required: true,
                minlength: 3,
              },            
              last_name: {
                required: true,
                minlength: 3,
              },
			  phoneno: {
                required: true,
                //minlength: 3,
              },
              email: {
                required: true,
                email: true,
              },
              cat_name: {
              	required: true,
			  },
			  country_name: {
			  	required: true,
			  },
			  industry: {
			  	required: true,
			  },
              item_name: {
                required: true,
                minlength: 5,
              },
            amount: {required: true,
              	digits: true 
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
		
		$("#btnsubmit").unbind().bind("click", function (event) {
		
			event.preventDefault();

			var testItem	= $("#sel_title").val()+"||"+$("#first_name").val()+"||"+$("#last_name").val()+"||"+$("#midname").val()+"||"+$("#email").val()+"||"+$("#phoneno").val()+"||"+$("#cat_name").val()+"||"+$("#country_name").val()+"||"+$("#industry").val()+"||"+$("#amount").val()+"||"+$("#user_id").val()+"||"+"AP";
            //alert(testItem);
			$("#item_number").val(testItem);
			var user_id = $("#user_id").val();
			if(user_id == "")
			{
				$.ajax({
					url: functionUrl,
					type: 'post',
					data: {user_email: $("#email").val()},				
					async: false,
					dataType: "JSON",
					success: function(responce) {
						if(responce['process'] == 'success') {
							alert("Email already exists");
							$("#email").val('');
						} else {
							//alert("Not exists");
						}
					}
				});			
			}
			$("#signupForm").submit();

		});
		$("#amount").mouseover(function(){
			
			var dis_code 	= 	$("#dis_code").val();
			var price 		=	dis_code.split("_")[0];
			var discount 	=	dis_code.split("_")[1];
			// Create Base64 Object
			var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

			var tmp_price 	= Base64.decode(price);
			var tmp_dis 	= Base64.decode(discount); 
			var net_price	= tmp_price-tmp_dis;
			$("#amount").val(net_price);
			$("#amount").prop('readonly',true);
		});	
	});
	
    </script>

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
.loaderr {
    display: block;
    left: 43%;
    position: absolute;
    text-align: center;
    top: 43%;
}
.usd_fom{position:relative;}
    </style>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

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
  
  <div style="min-height:350px;">
    <div class="middle-contentsec">
           
           <div class="usd_fom" style="min-height:350px;">
		   <input id="price" type="hidden" value="<?php if(isset($price)){ echo $price; } ?>">
           <!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="signupForm"> -->
           <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="signupForm">
           <div class="payment_frm personal-details"> 
           		<h2>Personal Detail</h2>              
                <div class="payment_frm_dv titles">
                  <label>Title</label>
                <div class="titless">
                	<select name="sel_title" id="sel_title">
						<option value="mr" <?php if(isset($user_details->gender) && ($user_details->gender == 'male')){?> selected <?php } ?>>Mr.</option>
					  	<option value="mrs" <?php if(isset($user_details->gender) && ($user_details->gender == 'female')){?> selected <?php } ?>>Mrs.</option>
					</select>
				</div>
                </div>
				<input type="hidden" id="user_id" name="user_id" value="<?php if(isset($user_details->uID)){ echo $user_details->uID; }?>" />
                <div class="payment_frm_dv ">
                  <label>First Name <span>*</span></label>
                 <input type="text" id="first_name" name="first_name" value="<?php if(isset($user_details->firstName)){ echo $user_details->firstName; } ?>" <?php if(isset($user_details->firstName)){ echo "readonly"; }?>/> 
                  <!-- <div class="grne">&nbsp;</div> -->
                </div>
                <div class="payment_frm_dv">
                  <label>Middle Initial </label>
                  <input type="text" id="midname" name="midname" />
                </div>
                <div class="payment_frm_dv">
                  <label>Last Name <span>*</span></label>
                  <input type="text" id="last_name" name="last_name" value="<?php if(isset($user_details->lastName)){ echo $user_details->lastName; }?>" <?php if(isset($user_details->lastName)){ echo "readonly"; }?>/> 
                </div>
                <div class="payment_frm_dv">
                  <label>Phone Number  <span>*</span></label>
                  <input type="text" id="phoneno" name="phoneno" value="<?php if(isset($user_details->phone)){ echo $user_details->phone; }?>" <?php if(isset($user_details->phone)){ echo "readonly"; }?>/> 
                </div>
                <div class="payment_frm_dv">
                  <label>Email <span>*</span></label>
                  <input type="text" id="email" name="email" value="<?php if(isset($user_details->emailID)){ echo $user_details->emailID; } ?>" <?php if(isset($user_details->emailID)){ echo "readonly"; }?>/> 
                </div>
                <!--<div class="roobt"> <img src="<?=base_url()?>images/payment/robot.png" alt=""  /> </div>
                <div class="btnse">
                <div class="cancle"><input id="cancel" class="form-cancel" name="" value="Cancel" type="button"></div>
                <div class="submt"><input id="submit" class="form-submit" name="" value="Submit" type="submit"></div>
                </div>-->
              
            </div>
           <div class="payment_frm payment-details">
            <h2>Payment Detail</h2>              
                <div class="payment_frm_dv titles">
                  <label>Select Category<span>*</span></label>
                  <div class="titless">
                  <select name="cat_name" id="cat_name">
                  <option value="">Select Category</option>
                 <?php foreach($cat_list as $key => $val) {?>
                 	<option value="<?=$val['id']?>" <?php if(isset($user_details->category_id) && ($user_details->category_id == $val['id'])){?> selected <?php } ?>><?=$val['title']?></option>
                 <?php }?>
                  </select>
                  </div>
                </div>
				<div class="payment_frm_dv">
                  <label>Industry </label>
                  <div class="titless">
                  <select name="industry" id="industry">
                  <option value="">Select Industry</option>
                 <?php foreach($industry_list as $key => $val) {?>
                 	<option value="<?=$val['id']?>" <?php if(isset($user_details->industry_id) && ($user_details->industry_id == $val['id'])){?> selected <?php } ?> ><?=$val['title']?></option>
                 <?php }?>
                  </select>
                  </div>
                </div>
                <div class="payment_frm_dv ">
                  <label>Country <span>*</span></label>
                <div class="titless">
                  <select name="country_name" id="country_name">
                  <option value="">Select Country</option>
                 <?php foreach($country_list as $key => $val) {?>
                 	<option value="<?=$val['country_id']?>" <?php if(isset($user_details->country) && ($user_details->country == $val['country_id'])){?> selected <?php } ?> ><?=$val['name']?></option>
                 <?php }?>
                  </select>
                  </div>
                  <!-- <div class="grne">&nbsp;</div> -->
                </div>
                
				<?php if(empty($user_details->payment_ref)){
					
				?>
                <div class="payment_frm_dv">
                  <label>Payment Referance</label>
                  <input type="text" id="dis_code" name="dis_code" value= ""  /> 
                </div>
				
				<?php
				}
				?>
                <div class="payment_frm_dv ">
                  <label>Account Price <span>*</span></label><span style=" position: absolute; top: 11px; font-size: 15px;">$</span>
                  <input type="text" id="amount" name="amount" value= "<?php if(isset($acc_price)){ echo $acc_price; } ?>" style="padding-left: 12px; width: 336px;" /> 
                  
                </div>
				<!-- <input type="hidden" name="business" value="cogito.sunav@gmail.com" /> -->
        <input type="hidden" name="business" value="otizfangel@gmail.com" />
				<input type="hidden" name="notify_url" value="<?=base_url()?>ipn.php" />

				<input type="hidden" name="cancel_return" value="<?=base_url()?>payment/cancel" />
 
				<input type="hidden" name="return" value="<?=base_url()?>payment/success" />

				<input type="hidden" name="rm" value="2" />

				<input type="hidden" name="lc" value="" />

				<input type="hidden" name="no_shipping" value="1" />

				<input type="hidden" name="no_note" value="1" />

				<input type="hidden" name="currency_code" value="USD" />

				<input type="hidden" name="page_style" value="paypal" />

				<input type="hidden" name="charset" value="utf-8" />

				<input type="hidden" name="cbt" value="Back to FormGet" />

				<input type="hidden" value="_xclick" name="cmd"/>

				<input type="hidden" value="" name="item_number" id="item_number"/>
				
                 <div class="pay_secure"><img src="<?=base_url()?>images/payment/pay_secure.png" alt="" /></div>
                <div class="btnse">
                <div class="cancle">
					<input id="cancel" class="form-cancel" name="" onclick='window.location="<?=base_url()?>"' value="Cancel" type="button">
				</div>
                <div class="submt"><input id="btnsubmit" class="form-submit" name="" value="Submit" type="submit"></div>
                </div>
                </div>
              </form>
            <div class="loaderr"><h2>Processing....</h2><img src="<?php echo base_url();?>images/ajax-bar-loader.gif" alt="Wait" /></div>
            </div>   


			
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
<p class="footer-copyright">� communitytreasures.co. All rights reserved.</p>
    </div>
  </div>
</div>
</body>
</html>
