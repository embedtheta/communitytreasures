<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Communitytreasures</title>
<link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/headerlogo.png" type="image/x-icon"/>


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


 </script>

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
	
    <?php if(isset($msg)){ ?> 
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
    </style>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="login-container">
<div class="top-login_top" id="header">
  <div class="wrapper-login">
    <h1><a href="#"><img src="<?php echo base_url(); ?>images/logo-login.png" alt="" /></a></h1>
    <p class="login-righttop"> <span><a href="javascript:void(0)" class="login-manu">VIP Login</a></span></p>
    <br class="clr" />
    <div class="login-manu-sub" style="display:<?php echo $styleStatus;?>;">
      <div class="login-drop">
	    <?php if($succMsg!=""){?>
        <div class="succ-msg"><?php echo $succMsg;?></div>
        <?php }?>
        <?php if(isset($errorMsg)){?>
        <div class="error-msg"><?php echo $errorMsg;?></div>
        <?php }?>
        <form action="<?php echo base_url();?>viplogin/login" method="post" id="frnd" class="login-form">
          <input name="emailID" type="text" placeholder="Email" class="input1" required>
          <input name="password" type="password" placeholder="Password" class="input2" required>
          <input type="submit" name="logIN" id="logIN" value="Login" class="login-submit"/>
        </form>
      </div>
    </div>   
  </div>
  </div>
<div class="top-login">
  
  <div class="header-login">
    <div class="wrapper-login">
      <div class="com-logn-bannerleft"><img src="<?php echo base_url(); ?>images/left-image-header.png" width="432" height="432" alt="" /></div>
      <div class="com-logn-bannerright">
        
      </div>
    </div>
  </div>
  
  <div class="footer-login">
    <div class="wrapper-login">
    <p class="foot_log"><img src="<?php echo base_url();?>images/footer_logo.png" alt=""></p>
      <p> <a href="#">Personal Development</a> - <a href="#">Life & Wealth Mastery</a> - <a href="#">Financial Freedom</a> - <a href="#">Good Health</a> - <a href="#">Success</a> - <a href="#">Awakenings</a> - <a href="#">Wholeness</a> - <a href="#">Harmony</a> <a href="#">Prosperity</a> - <a href="#">Humanity</a> - <a href="#">Consciousness</a> - <a href="#">Rejuvenation</a> - <a href="#">Lifestyle</a> - <a href="#">Conscious Capitalism</a> - <a href="#">Ethical</a> - <a href="#">Social Entrepreneurism</a> - <a href="#">Joy
        Happiness</a> - <a href="#">Security</a> - <a href="#">Friendship</a> - <a href="#">Wellness</a> - <a href="#">Support</a> - <a href="#">Nutrition</a> </p>
    </div>
  </div>
</div>
</body>
</html>
