
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Rave Business</title>


 <link rel="shortcut icon" href="<?php echo base_url(); ?>images/headerlogo.png" type="image/x-icon"/>

 <!--<link href="http://www.ravestory.com/Application/content/member/css/main.css" rel="stylesheet" type="text/css"/>
 <link href="http://www.ravestory.com/Application/content/member/css/style_new.css" rel="stylesheet" type="text/css"/>
 <link href="http://www.ravestory.com/Application/content/member/css/style.css" rel="stylesheet" type="text/css"/>-->
 <!-- 24/09/2015 ujjwal sana open
 <link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/style_community_login.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/stylenew.css" rel="stylesheet" type="text/css">-->
<!-- 24/09/2015 ujjwal sana close-->
<link href="<?php echo base_url(); ?>css/style_community_login.css" rel="stylesheet" type="text/css">
 <!--new added ujjwal sana-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>

  <!--new added ujjwal sana-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<!--<script type="text/javascript" src="http://www.ravestorysociety.com/Application/content/member/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>24/09/2015 ujjwal sana-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox11.css?v=2.1.4v=2.1.4"></script><!--24/09/2015 ujjwal-->
<!--fancy box-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />

 <script language="javascript">
 	$( document ).ready(function() {
		 $("#tutorial-video1").click(function() {
			// $.fancybox.open('<iframe width="560" height="315" src="//www.youtube.com/embed/z42mKPjkOVk?autoplay=1" frameborder="0" allowfullscreen></iframe>');
			$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/n37p0PKRGHM" frameborder="0" allowfullscreen></iframe>');      

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
    $(document).ready(function() {
	
    <?php if(isset($msg)){?>
        $.fancybox.open('<?php echo $msg;?>');
    <?php } ?>
    });
</script>

</head>
<body>
<!--3/9/2015 done by ujjwal sana-->
<header>
   	    <div class="hed_inr">
            <h1><a href="<?php echo base_url();?>gateway"><div>  </div></a></h1>
            <h2><a href="#" class="login-manu" >Login</a></h2>
			<h2 href="#" class = "forget-manu" >Forgotten your password?</h2>
          
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
                    </form>
                </div> 
            </div>
        </div>
        </header>

<div class="tem_email" >

<div class="packet">
    <div class="new_slide">
    	<div class="new_slideleft">

		<div class="logos">

    	<img src="http://ravebusiness.com/ravebusinessImages/logos_reg1.png" alt="" />

    </div>

    	<!--<iframe width="560" height="315" src="//www.youtube.com/embed/8d_qD5rLC5s" frameborder="0" allowfullscreen></iframe>-->

		<a href="javascript:void(0)" id="tutorial-video1"><img src="http://ravebusiness.com/ravebusinessImages/video section.jpg" alt="" /></a>

		</div>

		<div class="new_slideleftright"><h2>Sign Up<br />



Start For<br />



Free</h2>

<form id="signupForm" action="<?php echo base_url();?>gateway/signUpRequest" method="post" style="margin-top:28px;">
   
              
						<input type="text" name="signUpEmail"  placeholder="Enter VALID Email Here..." required>
                        <input type="hidden" name="parentID" value="<?php echo $parentID;?>">
                        <input type="submit" name="submit" value="Get Access Now!">


</form></div>
   <br class="clear" />
</div>

</div>
<!--25/09/2015 ujjwal sana -->
<div class="clear"></div>
<!--New section added-->

    <div class="fontent_bottom" style="text-align:center;">
    <div class="prod_logo"><img src="<?php echo base_url();?>/images/logo3.png" alt=""><p>Global Black Enterprises offers five online business packages plus marketing software and tools that are ideal for 
people wanting to generate a home-based income. GBE members can earn large commissions from the sales of GBE Products. Our affiliate programs, training and essential coaching can benefit all, from the un-employed to start-ups, small, medium and large businesses. Join GBE Today!</p></div>
    	<!--<img src="<?php echo base_url();?>/images/GBE_screen.jpg" alt="">-->
        <div class="bdy_imgs">&nbsp;</div>
    </div>
	<!--New section end-->
	<!--footer section-->
        <footer style="position:inherit;">
        <p class="foot_lgs"><img src="<?php echo base_url();?>/images/logo2.png" alt=""></p>
        		<p>© <?php echo date("Y");?> Morpheus Society | Website by Celestial Technologies. All Rights Reserved</p>
        </footer>
        
</body>

</html>
