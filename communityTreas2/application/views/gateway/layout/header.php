<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Communitytreasures</title>
<link href="<?php echo $base_url; ?>css/style3.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="<?php echo $base_url; ?>images/headerlogo.png" type="image/x-icon"/>

<!--<link href="<?php echo $base_url; ?>css/main.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $base_url; ?>css/style_new.css" rel="stylesheet" type="text/css"/>-->
<link href="<?php echo $base_url; ?>css/style_community_login.css" rel="stylesheet" type="text/css"/>

<!--new added ujjwal sana-->
<script type="text/javascript" src="<?php echo $base_url; ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>js/main.js"></script>

<!--new added ujjwal sana-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<!--fancy box-->
<script type="text/javascript" src="<?php echo $base_url; ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript" src="<?php echo $base_url; ?>js/jquery.sticky.js"></script>
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
  <style>
  #header {
    box-shadow: 0 0 5px #000;
    z-index: 99;
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
</head>
<body>
<div class="login-container">
<div class="top-login_top" id="header">
  <div class="wrapper-login">
    <h1><a href="#"><img src="<?php echo $base_url; ?>images/logo-login.png" alt=""  style="margin-top: 10px; width: 475px;" /></a></h1>
    <p class="login-righttop"> <span><a href="javascript:void(0)" class="login-manu">Member Login</a></span> <a href="javascript:void(0)" class="forget-manu">Forgotten your password?</a></p>
    <br class="clr" />
    <div class="login-manu-sub" style="display:<?php echo $styleStatus;?>;">
      <div class="login-drop">
        <?php if(isset($errorMsg)){?>
        <div class="error-msg"><?php echo $errorMsg;?></div>
        <?php }?>
        <form action="<?php echo $base_url;?>gateway/login" method="post" id="frnd" class="login-form">
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
        <form action="<?php echo $base_url;?>gateway/forgetPass" method="post" id="frnd" class="login-form">
          <input name="emailIDforFrogetPass" type="text" placeholder="Email" class="input1" required>
          <input type="submit" name="forgetPassBtn" id="forgetPassBtn" value="Submit" class="login-submit"/>
          <a href="#"></a>
        </form>
      </div>
    </div>
  </div>
  <div class="wrapper-login"><div class="top-log-menu">
<ul>
  <li><a href="<?php echo $base_url; ?>">Home</a></li>
  <li><a href="<?php echo $base_url; ?>gateway/contentDetails/1">About Us</a></li>
  <li><a href="<?php echo $base_url; ?>gateway/contentDetails/2">Qspace</a></li>
   <li><a href="<?php echo $base_url; ?>gateway/contentDetails/3">Brand</a></li>
  <li><a href="<?php echo $base_url; ?>gateway/contentDetails/4">Opportunity</a></li>
  <li><a href="<?php echo $base_url; ?>">Sign Up</a></li>
  <li><a href="<?php echo $base_url; ?>gateway/contentDetails/5">Contact Us</a></li>
</ul>
  </div>
  <br class="clr" />
</div>
  </div>
<div class="top-login">