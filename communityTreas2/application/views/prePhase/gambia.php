<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>GBE | GAMBIA</title>
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
</head>
<body>
<!--Header section-->
<header class="sq">
  <div class="hed_inr">
    <h1><a href="<?php echo base_url(); ?>"><img class="logon" src="<?php echo base_url(); ?>images/logo_sq.jpg"></a></h1>
    <h2><!--<a href="#" class="login-manu" >Login</a>--></h2>
    
    <!--<div class="login-manu-sub" style="display:<?php echo $styleStatus;?>;">  

            <div class="login-drop">
               <?php if(isset($errorMsg)){?>
               <div class="error-msg"><?php echo $errorMsg;?></div>
               <?php }?>
                	<form action="<?php echo base_url();?>gateway/login" method="post" id="frnd" class="login-form">
                    	<input name="emailID" type="text" placeholder="Email" class="input1" required="">
                        <input name="password" type="password" placeholder="Password" class="input2" required="">
                        <input type="submit" name="logIN" id="logIN" value="Login" class="login-submit"/>
                    </form>
                </div> 
            </div>--> 
  </div>
</header>
<!--Header section end--> 

<!--body section-->
<div class="subbmitq">
  <div class="signup_body_inr">
    <div class="signup_bdylft"><!--<iframe width="626" height="316" src="//www.youtube.com/embed/Iiqw2Ob1khc" frameborder="0" allowfullscreen></iframe>--></div>
    <div >
      <h5>SIGN UP</h5>
      <!--<h4>Sign Up & Gain Your Financial Freedom</h4>-->
      <form action="" method="post" id="frnd">
       <?php if($msg){?>
      <div class="input_section">
      	<span class="<?php if($msgType == 2){?>error<?php }elseif($msgType == 1){?>success<?php }?>">
        	<?php echo $msg;?>
        </span>
      </div>
      <?php }?>
        <div class="input_section">
          <label>Name</label>
          <input type="text" name="name" id="name" value="<?php if(isset($name)){echo $name;}?>">
          <?php echo form_error('name', '<span class="error">', '</span>'); ?> </div>
        <div class="input_section">
          <label>Surname</label>
          <input type="text" name="surname" id="Surname" value="<?php if(isset($surname)){echo $surname;}?>">
        </div>
        <!--<div class="input_section">
          <label>Who Invited You</label>
          <input type="text" name="invited" id="invited" value="">
          <?php echo form_error('invited', '<span class="error">', '</span>'); ?> </div>-->
        <div class="input_section">
          <label>Tel,Mob,Cell</label>
          <input type="text" name="cellno" id="cellno" value="<?php if(isset($cellno)){echo $cellno;}?>" >
        </div>
        <div class="input_section">
          <label>Email Address</label>
          <input type="text" name="emailAddr" id="emailAddr"  value="<?php if(isset($emailAddr)){echo $emailAddr;}?>">
          <?php echo form_error('emailAddr', '<span class="error">', '</span>'); ?> </div>
        <div class="input_section">
          <label>Skype Username</label>
          <input type="text" name="skypeID" id="skypeID"  value="<?php if(isset($skypeID)){echo $skypeID;}?>">
          <?php echo form_error('skypeID', '<span class="error">', '</span>'); ?> </div>
        <div class="input_section">
          <label>This is for Gambia Account.</label>
        </div>
        <div class="input_section">
          <input name="submit" id="submit" type="submit" >
        </div>
      </form>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!--body section end--> 

<!--footer section-->
<footer>
  <p>© 2014 Morpheus Society | Website by Celestial Technologies. All Rights Reserved</p>
</footer>
<!--footer section end-->
</div>
</body>
</html>