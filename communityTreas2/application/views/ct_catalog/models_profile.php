<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_signup.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	
$(".img_scn").click(function() { 
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});

});
</script>
</head>
<body>
<div class="real_ppup">
  <div class="top-profilesecc">
  <h2>Monetise Your Modelling</h2>
  <p>Your Modelling & Your Followers Could Equal</p>
  <h3><span>$10,000</span> Per Month From Home</h3><br>
  </div>
 
  <div name="<?php echo $paymentVideoImg[0]['path'];?>" class="img_scn"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $paymentVideoImg[0]['content_image'];?>" alt="" ></div>
  <div class="prchzz">
	<form enctype="multipart/form-data" action="<?php echo base_url();?>dashboard/CT_ModelInfo/<?php echo $ct_pageId;?>" method="post" id="frm_new">
                  
				   <h3>Apply for Membership</h3>
				   <div class="step1"><h4>Step 1: Register Your Details Here</h4>
                  	<input type="hidden" name="emailType" value="2">
                    <label><span> *First Name </span>
                    <input type="text" value="" name="fname" id="fname">
                    </label>
                    <label> <span>*Last Name </span>
                      <input type="text" value="" name="lname" id="lname">
                    </label>
                   <p>
                    <label> <span>*City </span>
                      <!--input type="text" value="" name="city" id="city"-->
                    <select id="city" name="city">
                      <option value="">Select City </option>
                      <?php if(count($cityList) > 0){ 
                            foreach($cityList as $cl){
                                ?>
                      <option value="<?php echo $cl->id;?>"><?php echo $cl->city;?></option>
                      <?php }}?>
                    </select>
                    </label>
					
					</p>
					<p>
                     <label> <span>*Country </span>
                      <!--input type="text" value="" name="country" id="country"-->
                    <select id="country" name="country">
                      <option value="">Select Country </option>
                      <?php if(count($countryList) > 0){ 
                            foreach($countryList as $cl){
                                ?>
                      <option value="<?php echo $cl->country_id;?>"><?php echo $cl->name;?></option>
                      <?php }}?>
                    </select>
                    </label>
					
					</p>
                    <label> <span>*Phone </span>
                      <input type="text" value="" name="phno" id="phno">
                    </label><br>
                    <label> <span>*Email </span>
                      <input type="text" value="" name="emailID" id="emailID">
                    </label></div>
                    
                    <!--<label><span>Upload Your Picture</span>
                      <input type="file" onChange="ct_readURL(this);" value="Add photo" name="profile" class="brws">
                      <input type="hidden" name="tempImage" value="">
                     </label>
                    <label>-->
                    <div class="full-step">
                    <div class="step2"><label><span>Step 2</span>
                      <img src="<?php echo base_url();?>CT_images/step2pic.png" alt="" >
                      <input type="file" onChange="ct_readURL(this);" value="Add photo" name="profile" class="brws">
                      <input type="hidden" name="tempImage" value="">
                     </label></div>
					<div class="step3"><label><span>Upload 3 Photos</span>
                                        <p><span>1. Face </span><input name="faceImage" type="file"></p>
                                        <p><span>2. Entire Body</span><input name="bodyImage" type="file"></p>
                                        <p><span>3. Your Choice</span><input name="choiceImage" type="file"></p>
                                        </label>
</div></div>
                    <div id="contact-image"><img alt="" src="<?php echo $this->config->item('gbe_base_url').'useruploads/'.$userInfo[0]['profile'];?>" id="ct_empPic"></div>
                    </label>
                    <label>
                  
                    <input type="submit" value="Submit" name="update" id="updateID" class="extra-blue-btn">
                    <div class="clear"></div>
                    </label>
                  </form>
  </div>
  
</div>
<br>
<footer id="foot">
  <div class="wrp">
    <p>Create Your Account, Market Your Business, Raise Your Income</p>
  </div>
</footer>
</body>
</html>

