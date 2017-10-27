<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Index</title>
<link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>
<link href="<?php echo base_url();?>css/signup/responsive.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<script type="application/javascript">
$( document ).ready(function() {
	
	 $( "#productType" ).change(function() {
		if( $(this).val() == "4" || $(this).val() == "1" ){
			$("#contentUpload").show();
			$("#clothesColour").hide();
			$("#clothesSize").hide();
		}else if( $(this).val() == "6" ){
			$("#clothesColour").show();
			$("#clothesSize").show();
			$("#contentUpload").hide();
		}else{
			$("#contentUpload").hide();
			$("#clothesColour").hide();
			$("#clothesSize").hide();
		}
	 });
});
</script>
</head>
<body>
	<!--Header section-->
    	<header class="sq">
   	    <div class="hed_inr">
            <h1><a href="index.html"><img class="logon" src="../images/logo_sq.jpg"></a></h1>
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
               		<form action="" method="post" id="frnd" enctype="multipart/form-data" class="cnt_vndr">
                      <div class="input_section">
                         <label>Sellers Name</label>
                         <input type="text" name="vendorName" id="vendorName"  value="<?php if(isset($listingName)){ echo $listingName;}?>" />
                         <?php echo form_error('listingName', '<span class="form_error">', '</span>'); ?>
                         
                      </div>
                      <div class="input_section">
                         <label>Sellers Contact Number</label>
                         <input type="text" name="vendorNo" id="vendorNo"  value="<?php if(isset($listingNo)){ echo $listingNo;}?>" />
                         <?php echo form_error('listingNo', '<span class="form_error">', '</span>'); ?>
                         
                      </div>
                      <div class="input_section">
                         <label>Sellers Address</label>
                         <textarea name="vendorAddr" id="vendorAddr" ><?php if(isset($listingAddr)){ echo $listingAddr;}?></textarea>
                         <?php echo form_error('listingAddr', '<span class="form_error">', '</span>'); ?>
                         
                       </div>
                       <div class="input_section">
                         <label>City</label>
                         <input type="text" name="vendorCity" id="vendorCity"  value="<?php if(isset($listingNo)){ echo $listingNo;}?>" />
                         <?php echo form_error('listingNo', '<span class="form_error">', '</span>'); ?>
                         
                      </div>
					  <div class="input_section">
                         <label>Postcodes / Zipcodes</label>
                         <input type="text" name="vendorZip" id="vendorZip"  value="<?php if(isset($listingNo)){ echo $listingNo;}?>" />
                         <?php echo form_error('listingNo', '<span class="form_error">', '</span>'); ?>
                         
                      </div>
                      <div class="input_section">
                         <label>Country</label>
                         <input type="text" name="vendorCountry" id="vendorCountry"  value="<?php if(isset($listingNo)){ echo $listingNo;}?>" />
                         <?php echo form_error('listingNo', '<span class="form_error">', '</span>'); ?>
                         
                      </div>                      
                      <div class="input_section">
                         <label>Sellers Email</label>
                         <input type="text" name="vendorEmail" id="vendorEmail"  value="<?php if(isset($listingNo)){ echo $listingNo;}?>" />
                         <?php echo form_error('listingNo', '<span class="form_error">', '</span>'); ?>
                         
                      </div>
                      <div class="input_section">
                         <label>Sellers Website</label>
                         <input type="text" name="vendorWebsite" id="vendorWebsite"  value="<?php if(isset($listingName)){ echo $listingName;}?>" />
                         <?php echo form_error('listingName', '<span class="form_error">', '</span>'); ?>
                      </div>
                      <div class="input_section">
                         <input type="submit" name="submit" id="submit" value="save"  />
                      </div>
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