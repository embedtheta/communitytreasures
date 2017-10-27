<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Index</title>
<link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>
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
               		<form action="" method="post" id="frnd" enctype="multipart/form-data">
                      <div class="input_section">
                         <label>Vendors Name</label>
                         <select name="vendorID" id="vendorID" >
                        		<option value=0>Please Select</option>
                        		<?php foreach($vendorsList as $vendorList){?>
                        		<option value=<?php echo $vendorList["vendorsID"]?>><?php echo $vendorList["vendorName"]?></option>
                                <?php } ?>
                          </select>
                          <?php echo form_error('vendorID', '<span class="form_error">', '</span>'); ?>
                      </div>
                      <div class="input_section">
                         <label>Product Type</label>
                         <select name="productType" id="productType" >
                        		<option value=0>Please Select</option>
                        		<?php foreach($productTypes as $productType){?>
                        		<option value=<?php echo $productType["productTypeID"]?>><?php echo $productType["productTypeName"]?></option>
                                <?php } ?>
                          </select>
                          <?php echo form_error('productType', '<span class="form_error">', '</span>'); ?>
                      </div>
                      <div class="input_section">
                         <label>Product Title</label>
                         <input type="text" name="productName" id="productName"  value="<?php if(isset($productName)){ echo $productName;}?>" />
                         <?php echo form_error('productName', '<span class="form_error">', '</span>'); ?>
                         <!--<input type="text" name="surname" id="Surname" value="">-->
                      </div>
                       <div class="input_section">
                         <label>Description</label>
                         <textarea name="productDesc" id="productDesc" ><?php if(isset($productDesc)){ echo $productDesc;}?></textarea>
                         <?php echo form_error('productDesc', '<span class="form_error">', '</span>'); ?>
                         <!--<input type="text" name="invited" id="invited" value="">-->
                       </div>
                       <div class="input_section">
                         <label>Currency Type</label>
                        <select name="productCurrencyType" id="productCurrencyType" >
                        		<option value="Dollars">Dollars</option>
                                <option value="Pounds">Pounds</option>
                                <option value="Euro">Euro</option>
                                <option value="Free">Free</option>
                                <option value="Make a Donation">Make a Donation</option>
                          </select>
                           
                         <!--<input type="text" name="cellno" id="cellno" value="" >-->
                         </div>
                       <div class="input_section">
                         <label>Product Cost</label>
                         <input type="text" name="productPrice" id="productPrice"  value="<?php if(isset($productPrice)){ echo $productPrice;}?>" />
                         <?php echo form_error('productPrice', '<span class="form_error">', '</span>'); ?>
                         <!--<input type="text" name="cellno" id="cellno" value="" >-->
                         </div>
                        <div class="input_section">
                         <label>Product Commission </label>
                         <input type="text" name="productCommission" id="productCommission"  value="<?php if(isset($productCommission)){ echo $productCommission;}?>" />
                         <?php echo form_error('productCommission', '<span class="form_error">', '</span>'); ?>
                         <!--<input type="text" name="cellno" id="cellno" value="" >-->
                         </div> 
                         <div class="input_section">
                         <label>Free Offer</label>
                         <select name="productOffer" id="productOffer" >
                        		<option value=0>Please Select</option>
                        		<option value="Yes">Yes</option>
                                <option value="No">No</option>
                          </select>
                          <?php echo form_error('productOffer', '<span class="form_error">', '</span>'); ?>
                        </div>
                        <div class="input_section">
                         <label>Give Youtube Video Link </label>
                         <input type="text" name="productYoutube" id="productYoutube"  value="<?php if(isset($productYoutube)){ echo $productYoutube;}?>" />
                         </div>
                       <div class="input_section">
                         <label>Main Image</label>
                         <input type="file" name="image" id="image"  />(jpg|gif|png only supported)
                         <?php echo form_error('image', '<span class="form_error">', '</span>'); ?>
                         <!--<input type="text" name="emailAddr" id="emailAddr"  value="">-->
                         </div>
                       <div class="input_section">
                         <label>Upload MP3/Videos</label>
                         <input type="file" name="image1" id="image1"  />
                         <?php echo form_error('image1', '<span class="form_error">', '</span>'); ?>
                         <!--<input name="city" id="city" type="text" >-->
                       </div>
                       <div class="input_section" style="display:none" id="clothesColour">
                         <label>Clothes Colour</label>
                            <input type="checkbox" name="colour[]" value="Red"/><span style="color:#FFFFFF">Red</span> 
                            <input type="checkbox" name="colour[]" value="Black"/><span style="color:#FFFFFF">Black</span>
                            <input type="checkbox" name="colour[]" value="Green"/><span style="color:#FFFFFF">Green</span>
                            <input type="checkbox" name="colour[]" value="Yellow"/><span style="color:#FFFFFF">Yellow</span>
                         <!--<input name="city" id="city" type="text" >-->
                       </div>
                       <div class="input_section" style="display:none" id="clothesSize">
                         <label>Clothes Size</label>
                            <input type="checkbox" name="size[]" value="36"/><span style="color:#FFFFFF">36 </span>
                            <input type="checkbox" name="size[]" value="38"/><span style="color:#FFFFFF">38</span>
                            <input type="checkbox" name="size[]" value="40"/><span style="color:#FFFFFF">40</span>
                            <input type="checkbox" name="size[]" value="42"/><span style="color:#FFFFFF">42</span>
                         <!--<input name="city" id="city" type="text" >-->
                       </div>
                       <div class="input_section" >
                         <label>Secondary Image</label>
                            <input type="file" name="SecondaryImg[]" id="image"  /></br>
      						<input type="file" name="SecondaryImg[]" id="image"  /></br>
                            <input type="file" name="SecondaryImg[]" id="image" /></br>
                         <!--<input name="city" id="city" type="text" >-->
                       </div>
                       <div class="input_section" >
                         <label>Status</label>
                           <input type="radio" name="productStatus" checked="checked" value="1" class="input-status"/>Active
        					<input type="radio" name="productStatus" value="0" class="input-status" />Inactive
                         <!--<input name="city" id="city" type="text" >-->
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