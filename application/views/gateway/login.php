
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Communitytreasures</title>
<link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/headerlogo.png" type="image/x-icon"/>

<!--<link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>css/style_new.css" rel="stylesheet" type="text/css"/>-->
<link href="<?php echo base_url(); ?>css/style_community_login.css" rel="stylesheet" type="text/css"/>

<!--new added ujjwal sana-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>

<!--new added ujjwal sana-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<!--fancy box-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.sticky.js"></script>
<script language="javascript">
 	$( document ).ready(function() {
		 $("#tutorial-video1").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php if($pageDetails->video_path != ""){ echo $pageDetails->video_path;}else{?>www.youtube.com/embed/2-4aZwXuu7M<?php }?>?autoplay=1" frameborder="0" allowfullscreen></iframe>');      

		 });

	});

/* function chkValid(){

	 var flagNew = true; 

	 if(document.getElementById("user_name_formAcymailing1").value == "" || document.getElementById("user_name_formAcymailing1").value == "Name Here..."){

		 alert("Please Enter Your Name");

		 flagNew = false;

	 }

	 if(document.getElementById("user_email_formAcymailing1").value == "" || document.getElementById("user_email_formAcymailing1").value == "Enter VALID Email Here..."){

		 alert("Please Enter Your Email");

		 flagNew = false;

	 }

	 if(flagNew == true){

		document.getElementById("signupForm").submit();

	 }else{

		 return false;

	 }

 }
*/
 </script>
<!--3/9/2015 done by ujjwal sana-->
<script type="text/javascript">
 function emailValid(email){
	var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	var error = "";
	if(email == ""){
		error = "Email field is required.";
	}else if(!emailReg.test(email) && email != ""){
		error = "Please enter the valid Email.";
	}
	return error;
 }
    $(document).ready(function() {
	$("#submitId").click(function(e) {
		var email = $("#signUpEmailId").val();
		var error = emailValid(email);
		if(error != ""){
			$.fancybox.open(error);
			$("#signUpEmailId").focus();
        	return false;
		}else{
			return true;
		}
    });
    <?php if(isset($msg)){?>
        $.fancybox.open('<?php echo $msg;?>');
    <?php } ?>
    });
</script>
<script>
    $(window).load(function(){
      $("#header").sticky({ topSpacing: 0 });
    });
  </script>
 <script type="text/javascript">
$(document).ready(function() {
$("#tutorial-videoAb").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/Um63OQz3bjo" frameborder="0" allowfullscreen></iframe>');
		 });
		 });
</script>
  <script type="text/javascript">
$(document).ready(function() {
$("#tutorial-videoAbc").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/yeKUU3c2SmU" frameborder="0" allowfullscreen></iframe>');
		 });
		 });
</script>
 <script type="text/javascript">
$(document).ready(function() {
$("#tutorial-videoAbcd").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/T_hBhymFfm8" frameborder="0" allowfullscreen></iframe>');
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
    background: #1b75bc;
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
</head>
<body>
<div class="login-container">
<div class="top-login_top" id="header">
  <div class="wrapper-login">
    <h1><img src="<?php echo base_url(); ?>images/logo-login.png" alt=""  style="margin-top: 10px; width: 370px;" /></h1>
    <p class="login-righttop"> <a href="javascript:void(0)" class="forget-manu" style="float: left;">Forgotten your password?</a><span style=" float: left; margin-left: 20px;"><a href="javascript:void(0)" class="login-manu">Member Login</a></span> </p>
    <br class="clr" />
    <div class="login-manu-sub" style="display:<?php echo $styleStatus;?>;">
      <div class="login-drop">
        <?php if(isset($errorMsg)){?>
        <div class="error-msg"><?php echo $errorMsg;?></div>
        <?php }?>
        <form action="<?php echo base_url();?>gateway/login" method="post" id="frnd" class="login-form">
          <input name="emailID" type="text" placeholder="Email" class="input1" required>
          <input name="password" type="password" placeholder="Password" class="input2" required>
          <input type="submit" name="logIN" id="logIN" value="Login" class="login-submit"/>
        </form>
      </div>
    </div>
    <div class="forget-manu-sub" style="display:<?php echo $styleStatus1;?>;">
      <div class="login-drop">
        <?php if($succMsg!=""){?>
        <div class="succ-msg"><?php echo $succMsg;?></div>
        <?php }?>
        <?php if($errorMsg1!=""){?>
        <div class="error-msg"><?php echo $errorMsg1;?></div>
        <?php }?>
        <form action="<?php echo base_url();?>gateway/forgetPass" method="post" id="frnd" class="login-form">
          <input name="emailIDforFrogetPass" type="text" placeholder="Email" class="input1" required>
          <input type="submit" name="forgetPassBtn" id="forgetPassBtn" value="Submit" class="login-submit"/>
          <a href="#"></a>
        </form>
      </div>
    </div>
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
  
  <div class="header-login">
    <div class="wrapper-login">
      <div class="com-logn-bannerleft" style="text-align:center;">
      <img src="<?php echo base_url(); ?>images/left-image-header.png" width="" height="305" alt="" /><br />

      <img src="<?php echo base_url(); ?>images/home-bitcoin-button1.png" width="" height="" alt="" style="margin-top:20px;" />
      </div>
      <div class="com-logn-bannerright">
        <div class="video-comm"> <a href="http://www.communitytreasures.co/ctRaveshare/signupuser_signupGuest/Otizf.Angel.2410" target="_blank" id="tutorial-video1111"><img src="<?php echo base_url(); ?>images/financial-banervider.png" alt="" /></a>  </div><!--<img src="<?php //echo base_url(); ?>images/com-down-arrow.png" width="29" height="24" alt="" class="down-arrow"/>-->
        <form id="signupForm" action="<?php echo base_url();?>gateway/signUpRequest" method="post">
          <input name="signUpEmail" type="text" id="signUpEmailId" value="" placeholder="Enter VALID Email Here..." />
          <!--<input name="" type="button" value="Get Access Now!" />-->
          <input name="submit" id="submitId" type="hidden" value="Start Now!" style="color:#fcff1d !important;" />
           <a class="strtnw" href="http://www.communitytreasures.co/ctRaveshare/signupuser_signupGuest/Otizf.Angel.2410" target="_blank">Start Now!</a>
        </form>
      </div>
    </div>
  </div>
  
  
  <!--New section added-->
    <div class="fontent_bottom" style="text-align:center;">
    <div class="prod_logo"><img src="<?php echo base_url();?>images/logo-login.png" alt="">
<p>Community Treasures uses bitcoin to fuse aspects of 'Brand building & Social partnering'.<br />
Using our unique software called 'Q-space', Community Treasures harnesses the efforts of social entrepreneurs, professionals, experts, amateurs, local businesses, entertainers and talented artists to build CT brands in over 50 industries.</p>
<p>'Q-space' also works like a personal resource centre inside our digital queuing system. 
As your position rises up the queue your potential for success increases as you benefit from a community of thousands who work as one global organism.</p>

<p>By Watching 12 Ads and completing a few simple actions per day, you can create wealth, assist in <br />
positive change & enjoy limitless possibilities.<br />
Most of all, your actions help to build our in-house CT brands which are co-run by members, providing discounts, career and partnership opportunities in multiple sectors.
<br />
Sign up now and Start earning bitcoin while enjoying the advantages of our brand building system, Today!</p>
    </div>
<div class="bitcoin-videopart">
<!--<p>Sign up and Start enjoying the advantages of our brand building system, Today!</p>-->
<ul>
<li><h3>‘What is Bitcoin<br />
and how does it work?’</h3>
<a id="tutorial-videoAb" name="https://www.youtube.com/embed/Um63OQz3bjo" href="javascript:void(0)"><img src="<?php echo base_url();?>images/bit1.jpg" alt=""></a>
</li>
<li><h3>Where<br />
can I get Bitcoin?</h3>
<a id="tutorial-videoAbc" name="https://www.youtube.com/embed/yeKUU3c2SmU" href="javascript:void(0)"><img src="<?php echo base_url();?>images/bit2.jpg" alt=""></a>
</li>
<li><h3>Top Ten Facts About<br />
Bitcoin</h3>
<a id="tutorial-videoAbcd" name="https://www.youtube.com/embed/T_hBhymFfm8" href="javascript:void(0)"><img src="<?php echo base_url();?>images/bit3.jpg" alt=""></a>
</li>
</ul>
</div>
<div class="inside-qspacetitle">Featured Inside Your Qspace</div>
    	<!--<img src="<?php echo base_url();?>images/ct_screen_full.jpg" alt="">-->
<img src="https://www.communitytreasures.co/images/ct_screen_full.jpg" alt="" border="0" usemap="#Map">
<map name="Map" id="Map">
  <area shape="rect" coords="336,152,586,289" id="tutorial-videoAb" name="https://www.youtube.com/embed/Um63OQz3bjo" href="javascript:void(0)" />
  <area shape="rect" coords="623,152,874,289" id="tutorial-videoAbc" name="https://www.youtube.com/embed/yeKUU3c2SmU" href="javascript:void(0)" />
  <area shape="rect" coords="920,153,1168,289" id="tutorial-videoAbcd" name="https://www.youtube.com/embed/T_hBhymFfm8" href="javascript:void(0)" />
  
</map>
    </div>
	<!--New section end-->
    
    
    
  <div class="footer-login">
    <div class="wrapper-login">
    
    <p class="foot_log"><img src="<?php echo base_url();?>images/footer_logo.png" alt=""></p>
    
      <p class="footer-topplink"> <a href="#">Personal Development</a> - <a href="#">Life & Wealth Mastery</a> - <a href="#">Financial Freedom</a> - <a href="#">Good Health</a> - <a href="#">Success</a> - <a href="#">Awakenings</a> - <a href="#">Wholeness</a> - <a href="#">Harmony</a> <a href="#">Prosperity</a> - <a href="#">Humanity</a> - <a href="#">Consciousness</a> - <a href="#">Rejuvenation</a> - <a href="#">Lifestyle</a> - <a href="#">Conscious Capitalism</a> - <a href="#">Ethical</a> - <a href="#">Social Entrepreneurism</a> - <a href="#">Joy
        Happiness</a> - <a href="#">Security</a> - <a href="#">Friendship</a> - <a href="#">Wellness</a> - <a href="#">Support</a> - <a href="#">Nutrition</a> </p>
        
        <p class="footer-newlink"><a href="<?php echo base_url(); ?>gateway/contentDetails/earnings-disclaimer">Earnings Disclaimer</a> | <a href="<?php echo base_url(); ?>gateway/contentDetails/privacy-policy">Privacy Policy</a> |
<a href="<?php echo base_url(); ?>gateway/contentDetails/terms-and-conditions">Terms & Conditions</a> |
<a href="<?php echo base_url(); ?>gateway/contentDetails/compliance">Compliance</a></p>
<p class="footer-copyright">© communitytreasures.co. All rights reserved.</p>
    </div>
  </div>
</div>
</div>
</body>
</html>
