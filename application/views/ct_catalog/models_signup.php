<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Models Monetizer</title>
<link href="<?php echo base_url();?>css/style_signup.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	
$(".video_on_id").click(function() { 
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});

});
</script>
</head>
<body class="monzi_page models_page">
<div class="hdrs monzi">
  <div class="wrp">
    <h1>Create Your Account, Market Your Images, Grow Your Fanbase & Monetize Your Followers</h1>
 </div>
</div>
<div class="hdr_btm">
  <div class="wrp">
    <div class="models_in">
    	<ul>
        	<li> <img class="brds" src="<?php echo base_url();?>CT_images/img_1.jpg" alt=""></li>
        	<li> <img class="brds" src="<?php echo base_url();?>CT_images/img_2.jpg" alt=""></li>
        	<li> <img class="brds" src="<?php echo base_url();?>CT_images/img_3.jpg" alt=""></li>
        	<li> <img class="brds" src="<?php echo base_url();?>CT_images/img_4.jpg" alt=""></li>
        	<li> <img class="brds" src="<?php echo base_url();?>CT_images/img_5.jpg" alt=""></li>
        	<li> <img class="brds" src="<?php echo base_url();?>CT_images/img_6.jpg" alt=""></li>
        	<li> <img class="brds" src="<?php echo base_url();?>CT_images/img_7.jpg" alt=""></li>
        	<li> <img class="brds" src="<?php echo base_url();?>CT_images/img_8.jpg" alt=""></li>
        </ul>
        <div class="mod_vdos">
        	<div id="mod_in">
            <div class="mod_vdo_inr sdcc">
            	
                <img class="brds" src="<?php echo base_url();?>CT_images/mod_vd.png" alt="">
                <span name="<?php echo $signupVideoImg[0]['path'];?>" class="video_on_id" style="float:right;"> 
                <img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $signupVideoImg[0]['content_image'];?>" style="width:80px;"  alt="">
                </span>
            </div>
        	<form class="modssel" id="mod_vdos_frm" action="<?php echo base_url();?>signup/Models/<?php echo $ct_userID; ?>" method="post" enctype="multipart/form-data">
            <label>signup</label>
            <input name="emailAddr" id="emailAddr" placeholder="Email Address" type="email">
			<select class="signup-selectt" size="1" name="city">
			<?php foreach($City as $city){?>
			<option  value="<?php echo $city['country_id'];?>"><?php echo $city['name'];?></option>
			<?php }?>
			</select>
			<input name="submit" value="Start" type="submit">
            </form>
			<a href="<?php echo base_url();?>dashboard/ctadminmodel">for amdin</a>
        </div>
    </div>
  </div>
</div>


<div class="hmerk">
  <div class="wrp">
    <div class="lrne">
      <h3>Browse Other Career Monetizers</h3>
      <ul>
	  <?php foreach($CT_Monetizer as $cm){
			if($Page_name!=$cm['title']){?>
			
				<!--<a href="<?php echo base_url();?>dashboard/<?php echo $cm['title'];?>"><li><img src="<?php echo base_url();?>images/CT_Monetizer/<?php echo $cm['img'];?>" width="111" height="145" alt=""><span></span></li></a>-->
			<a href="<?php echo base_url();?>signup/<?php echo $cm['title'];?>/<?php echo $ct_userID; ?>"><li><img src="<?php echo base_url();?>images/CT_Monetizer/<?php echo $cm['img'];?>" width="111" height="145" alt=""><span></span></li></a>
			<?php } ?>
	  <?php } ?>
        <!--li><img src="<?php echo base_url();?>CT_images/CT_Real_estate_img1.png" alt=""></li>
        <li><img src="<?php echo base_url();?>CT_images/CT_Real_estate_img3.png" alt=""></li>
        <li><img src="<?php echo base_url();?>CT_images/CT_Real_estate_img2.png" alt=""></li>
        <li><img src="<?php echo base_url();?>CT_images/CT_Real_estate_img2.png" alt=""></li>
        <li><img src="<?php echo base_url();?>CT_images/CT_Real_estate_img2.png" alt=""></li-->
      </ul>
    </div>
  </div>
</div>
</div>
<footer id="foot">
  <div class="wrp">
    <p>Create Your Account, Market Your Business, Raise Your Income</p>
  </div>
</footer>
</body>
</html>
