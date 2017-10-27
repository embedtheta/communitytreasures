<!--?php

if(isset($_REQUEST["free_trial"])){

	

	/*$fname=trim($_REQUEST["fname"]);

	$email=trim($_REQUEST["email"]);

	$refId=base64_encode($_REQUEST["RefID"]);

	$encode_email=base64_encode($email);

	$to = $email;

	$subject = 'Free Trial from RAVE STORY';

	$message = '

	<html>

	<head>

	  <title>Free Trial from RAVE STORY</title>

	</head>

	<body>

	  <table width="100%" border="0" cellspacing="0" cellpadding="0">

		<tr><td colspan="2">You are getting one free Trial from Rave Story society</td></tr>

		<tr><td width="25%">Your Name:</td><td width="75%">'.$fname.'</td></tr>

		<tr><td>Your Email:</td><td>'.$email.'</td></tr>

		<tr><td colspan="2">If you want more chapters or Ebook,Music,Tickets.</td></tr>

		<tr><td colspan="2">Register yourself as member in RAVE STORY.</td></tr>

		<tr><td colspan="2"><a href="http://ravestory.com/member/registration_trial/?email='.$encode_email.'&refId='.$refId.'">Join Now</a></td></tr>

	</table>

	</body>

	</html>

	';

	

	// To send HTML mail, the Content-type header must be set

	$headers  = 'MIME-Version: 1.0' . "\r\n";

	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	

	// Additional headers

	//$headers .= 'To:'.$email. "\r\n";

	$headers .= 'From: Rave Story <info@ravestory.com>' . "\r\n";

	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";

	//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

	

	// Mail it

	//echo $message;

	$msg="";

	if(mail($to, $subject, $message, $headers)){

		 $msg="success";	

	}*/

//	header('Location: http://220.225.90.154/angelMailFunction/index.php?fname='.trim($_REQUEST["fname"]).'&email='.trim($_REQUEST["email"]).'&refId='.trim($_REQUEST["RefID"]));

//header('Location:http://www.topcarslondon.com/contact/drive/?fname='.trim($_REQUEST["fname"]).'&email='.trim($_REQUEST["email"]).'&refId='.trim($_REQUEST["RefID"]));

header('Location:http://www.ravebusiness.com/emailsend/mailsend.php?fname='.trim($_REQUEST["fname"]).'&email='.trim($_REQUEST["email"]).'&refId='.trim($_REQUEST["RefID"]));

/*$fname=trim($_REQUEST["fname"]);

$email=trim($_REQUEST["email"]);

$refId=base64_encode($_REQUEST["RefID"]);

$encode_email=base64_encode($email);



$to=$email;

$subject="Confirmation Mail";

$message='<html>

	<head>

	  <title>Free Trial from RAVE STORY</title>

	</head>

	<body>

	  <table width="100%" border="0" cellspacing="0" cellpadding="0">

		<tr><td colspan="2">You are getting one free Trial from Rave Story society</td></tr>

		<tr><td width="25%">Your Name:</td><td width="75%">'.$fname.'</td></tr>

		<tr><td>Your Email:</td><td>'.$email.'</td></tr>

		<tr><td colspan="2">If you want more chapters or Ebook,Music,Tickets.</td></tr>

		<tr><td colspan="2">Register yourself as member in RAVE STORY.</td></tr>

		<tr><td colspan="2"><a href="http://ravestory.com/member/registration_trial/?email='.$encode_email.'&refId='.$refId.'">Join Now</a></td></tr>

	</table>

	</body>

	</html>';

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From:info@ravestory.com'. "\r\n";

$sent=mail($to,$subject,$message,$headers);

    $msg="";

	if($sent){

		 $msg="success";	

	}*/



}

//phpinfo();

//$email = 'ravestory@gmail.com';

//$con = dbCon();

//$data = checkUserFGT($con,$email);

$sucMsg = "";

/* if(isset($_REQUEST['fgt_submit']) && $_REQUEST['fgt_submit'] == 'SUBMIT'){

	$email = trim($_REQUEST['forgt_email']);

	if($email != ''){

		$con = dbCon();

		$data = checkUserFGT($con,$email);

		if(!empty($data)){

			sendEmailFGT($data);

			$sucMsg = "Please check your Email.";

		}else{

			$sucMsg = "Sorry, Try again with another email.";

		}

	}

} */









function sendEmailFGT($data = array()){

	$to_email = $data['EmailId'];

	$subject = 'Forgot Password';

	$message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">

							<tr><td colspan="2">Hello '.$data['FirstName'].' '.$data['LastName'].',</td></tr>

							<tr><td colspan="2"> 

								Here are your Login Credentials as below.

								</td></tr>

							<tr><td width="25%">Email:</td><td width="75%">'.$data['EmailId'].'</td></tr>

							<tr><td width="25%">Password:</td><td width="75%">'.base64_decode(trim($data['Password'])).'</td></tr>

							<tr><td colspan="2">Thank you very much.</td></tr>

							<tr><td colspan="2">ravebusiness.com</td></tr>

					   </table>';

		

	send_mail_raw($to_email,$subject,$message);

	return true;

}





?>-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<html lang="en">
<head>
<meta charset="utf-8">
<title>GBE makes you money & builds our Community</title>
<link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>


<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<!--[if lt IE 8]>
<script src="js/CreateHTML5Elements.js"></script>
<![endif]-->
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="ie/ie-fix.css" />
<![endif]-->
<!--[if IE]>
	<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,900,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">
    $(document).ready(function() {
    <?php if(isset($msg)){?>
        $.fancybox.open('<?php echo $msg;?>');
    <?php } ?>
    });
</script>
</head>
<!--new added ujjwal sana-->
 

 

 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

 <script type="text/javascript" src="http://www.ravestorysociety.com/Application/content/member/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
 <!--fancy box -->

 <script src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>
<script type="application/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />

<link rel="stylesheet" type="text/css" href="http://www.ravestorysociety.com/Application/content/member/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />



 <script language="javascript">
 	
 	$( document ).ready(function() {

		 $("#tutorial-video1").click(function() {

			// $.fancybox.open('<iframe width="560" height="315" src="//www.youtube.com/embed/z42mKPjkOVk?autoplay=1" frameborder="0" allowfullscreen></iframe>');

			$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/n37p0PKRGHM" frameborder="0" allowfullscreen></iframe>');      

		 });

	});

	

 


 

 function chkValid(){

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

 </script>

</head>



<body>

 <header>
   	    <div class="hed_inr">
            <h1><a href="<?php echo base_url();?>gateway"><div class="logo-img">  </div></a></h1>
            <h2><a href="#" class="login-manu" >Login</a></h2>
			<h2 href="#" class="forget-manu" >Forgotten your password?</h2>
          
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

       
	
    
	
<!--
 <form action="http://www.ravestorysociety.com/ravestorysociety/freetrial" method="post" id="ravebusinessLogin" style="display:none"  >

                    <p> 
                        <input name="txtemail" id="txtemail"  value="email" type="text">
                        <input name="txtpassword" id="txtpassword" type="password" value="******">
                        <input name="btnLogin" type="submit" value="">

                    </p>

                </form>  
-->




<div class="tem_email" >

<div class="packet">

	

    <div class="new_slide">

	

    	<div class="new_slideleft">

		<div class="logos">

    	<img src="http://ravebusiness.com/ravebusinessImages/logos_reg1.png" alt="" />

    </div>

    	<!--<iframe width="560" height="315" src="//www.youtube.com/embed/8d_qD5rLC5s" frameborder="0" allowfullscreen></iframe>-->

		<a href="javascript:void(0)" id="tutorial-video1">

        <img src="http://ravebusiness.com/ravebusinessImages/video section.jpg" alt="" /></a>

		</div>

		<div class="new_slideleftright"><h2>Sign Up<br />



Start For<br />



Free</h2>

<form id="signupForm" action="" method="post" style="margin-top:28px;">

<!--<input name="userid" type="text" value="User Id..."  onblur="if(this.value=='') this.value='User Id...';" onfocus="if(this.value == 'User Id...') this.value = '';" id="user_email_formAcymailing1" class="userid"/>

<input name="pwd" type="text" value="Password"  onblur="if(this.value=='') this.value='Password';" onfocus="if(this.value == 'Password') this.value = '';" id="user_email_formAcymailing1" class="pwd"/>

<input name="login" type="submit" value="LOG IN" class="login" />-->

<?php /*if($_REQUEST["msg"]=="success"){

	   echo "Go to your email account - We have sent you an access link";

      }*/



?>

<input name="fname" type="text" value="Name Here..."  onblur="if(this.value=='') this.value='Name Here...';" onfocus="if(this.value == 'Name Here...') this.value = '';" id="user_name_formAcymailing1"/>

<input name="email" type="text" value="Enter VALID Email Here..." onblur="if(this.value=='') this.value='Enter VALID Email Here...';" onfocus="if(this.value == 'Enter VALID Email Here...') this.value = '';" id="user_email_formAcymailing1" />

<input type="hidden" name="RefID" value="<?php echo ($_REQUEST['uid']!="") ? $_REQUEST['uid'] : 1000?>" >


<input name="free_trial" type="submit" value="Get Access Now!" class="button" onclick="return chkValid()" />
</form></div>
   <br class="clear" />

	

</div>

</div>

</body>

</html>

<?php 

     if($_REQUEST["msg"]=="success"){

?>

<script language="javascript">

$( document ).ready(function() {

 $.fancybox.open('<div style="background:#ccc; color:#000; font-size:15px; border-redius:10px; border:#999 solid 5px; padding:20px; "><strong>Go to your email account - We have sent you an access link</strong></div>');

});

</script>

<?php } ?>



<script language="javascript">

$( document ).ready(function() {
	//forget password old
	$("#forgot").click(function(){
		$.fancybox.open('<div style="background:#ccc; color:#000; font-size:15px; border-redius:10px; border:#999 solid 5px; padding:20px;"><strong>Forgot Password</strong><form id="fgt_form" action="<?php echo base_url();?>gateway/forgetPass" method="post" style="margin-top:28px;"><input name="forgt_email" type="text" value="Email" id="forgt_email" /><input name="fgt_submit" id="fgt_submit" type="submit" value="SUBMIT" class="button" onclick="return fgtBlankCheck()" /></form></div>');
	
	});

});



function fgtBlankCheck(){

	var eml = $("#forgt_email").val();

	if(!eml){

		alert('Please enter the value.');

		return false;

	}else{

		return true;	

	}

}


<?php 

     if($sucMsg !=""){

?>

$( document ).ready(function() {

 $.fancybox.open('<div style="background:#ccc; color:#000; font-size:15px; border-redius:10px; border:#999 solid 5px; padding:20px; "><strong><?php echo $sucMsg;?></strong></div>');

});



<?php } ?>

</script>




