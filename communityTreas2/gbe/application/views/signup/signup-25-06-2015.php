<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>signup</title>
<link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>

<link href="<?php echo base_url();?>css/signup/responsive.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
    	<header>
   	    <div class="hed_inr sigu">
            <h1><a href="index.html"><img src="<?php echo base_url(); ?>css/signup/images/global-logo.png" alt="" ><!--Global Black Enterprise--></a></h1>
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
        <div class="signup_main-bdy">
        
        
        	<div class="signup_body_inr">
            	<div class="signup_bdylft"><iframe width="626" height="316" src="//www.youtube.com/embed/Iiqw2Ob1khc" frameborder="0" allowfullscreen></iframe></div>
                <div class="signup_bodyritt">
                <h5>SIGN UP</h5>
                <h4>Sign Up & Gain Your Financial Freedom</h4>
                <?php if(isset($loginUrl)){?>
                <h4><a href="<?php echo $loginUrl;?>">Click Here to Login</a></h4>
                <?php }?>
                	<form action="" method="post" id="frnd">
                      <div class="input_section">
                         <label>First Name</label>
                         <input type="text" name="firstName" id="firstName" value="<?php if(isset($firstName)){ echo $firstName;}?>">
                         <?php echo form_error('firstName', '<span class="form_error">', '</span>'); ?>
                      </div>
                      <div class="input_section">
                         <label>Last Name</label>
                         <input type="text" name="lastName" id="lastName" value="<?php if(isset($lastName)){ echo $lastName;}?>">
                         <?php echo form_error('lastName', '<span class="form_error">', '</span>'); ?>
                       </div>
                       <div class="input_section">
                         <label>User Name</label>
                         <input type="text" name="userName" id="userName" value="<?php if(isset($userName)){ echo $userName;}?>">
                         <?php echo form_error('userName', '<span class="form_error">', '</span>'); ?>
                       </div>
                       <div class="input_section">
                         <label>Contact Number</label>
                         <input type="text" name="phone" id="phone"  value="<?php if(isset($phone)){ echo $phone;}?>">
                         <?php echo form_error('phone', '<span class="form_error">', '</span>'); ?>
                       </div>
                       <div class="input_section">
                         <label>Email</label>
                         <input type="text" name="emailID" id="emailID" value="<?php if(isset($emailID)){ echo $emailID;}?>" >
                         <?php echo form_error('emailID', '<span class="form_error">', '</span>'); ?>
                       </div>
                       <div class="psswd">
                       <div class="input_section">
                         <label>Password</label>
                         <input type="password" name="password" id="password"  value="">
                         <?php echo form_error('password', '<span class="form_error">', '</span>'); ?>
                       </div>
                       <div class="input_section">
                         <label>Confirm Password</label>
                         <input name="ConfPassword" id="ConfPassword" type="password" >
                       </div><div class="clear"></div></div>
                       
                       <h4>Complete Additional Info</h4>
                       
                        <div class="input_section">
                         <label>Gender</label>
                         <select name="gender" id="gender" >
                         <option value="Male" <?php if(isset($gender) && ($gender=="Male")){?>selected="selected" <?php }?>>Male</option>
                         <option value="Female" <?php if(isset($gender) && ($gender=="Female")){?>selected="selected"<?php }?>>Female</option>
                         </select>
                       </div>
                       <div class="input_section">
                         <label>Country</label>
                         <select name="country" id="country" >
                         <option value="UK" <?php if(isset($country) && ($country=="UK")){?>selected="selected" <?php }?>>United Kingdom</option>
                         <option value="India" <?php if(isset($country) && ($country=="India")){?>selected="selected"<?php }?>>India</option>
                         </select>
                       </div>
                       <div class="input_section">
                         <label>City</label>
<!--                         <input type="text" name="city" id="city" value="<?php if(isset($city)){ echo $city;}?>">-->
                         <select name="city">
<?php if (count($cityArray) > 0) {
    foreach ($cityArray as $cVal) {
        ?>
                    <option value="<?php echo $cVal->id; ?>" <?php if (isset($city) && $city == $cVal->id) { ?> selected="selected" <?php } ?>><?php echo $cVal->city; ?></option>
    <?php }
} else {
    ?>
                                            <option value="">Select City</option>    
<?php } ?>
                                    </select>
                         <?php echo form_error('city', '<span class="form_error">', '</span>'); ?>
                       </div>
                       
                       <input type="hidden" name="parentID" value="<?php if(isset($parentID)){ echo $parentID;}else{ echo "1000";}?>">
                       <input type="submit" class="input_submit" value="Start Your Business" id="signUp" name="signUp">

                    </form>
                </div><div class="clear"></div>
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