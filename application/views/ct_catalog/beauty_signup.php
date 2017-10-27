<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Beauty Monetizer</title>
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
<body class="monzi_page buty">
<div class="hdrs monzi">
  <div class="wrp">
    <h1>Web-Tools For Sellers of Cosmetics & Beauty Products</h1>
    </div>
</div>
<div class="hdr_btm">
  <div class="wrp">
    <div class="imr_tp"> <img src="<?php echo base_url();?>CT_images/banner_beauty.jpg" alt=""> </div>
  </div>
</div>
<div class="hdr_mid">
  <div class="wrp"><!--wrp_o-->
    <div class="vws_tp">
      <div id="est_hdn">
      <img src="<?php echo base_url();?>CT_images/blu-tw4.png" alt="">
      <div class="content-asa">
      <h2>Get More Leads<br>
Increase Your Sales<br>
Market Your Products</h2>
<p>An 'Easy To Use' web-tool for Sellers of
Cosmetics, Rejuvenation Products
& MLM Beauty Products.</p></div>
      </div>
      <div id="videoBoxId" class="vws_tp_vdos_o">
        <div class="vws_tp_vdo_sec">
          <div class="vws_tp_vid_dmo">
            <h3 style="color:#000; text-align:right;">Watch Video</h3>
            <span name="<?php echo $signupVideoImg[0]['path'];?>" class="video_on_id"> <img alt="" src="<?php echo base_url();?>CT_images/vdo_wtaro.png"></span></div>
          <img class="brds" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $signupVideoImg[0]['content_image'];?>" alt=""> </div>
      </div>
      <br class="clear">
    </div>
    <br class="clear">
  </div>
</div>
<div class="pkse">
  <div class="wrp">
    <h2>Get This Web Tool <br>
      To Boost Your Earnings</h2>
    <!--form id="frms_signup" action="<?php echo base_url();?>signup/beautyMonetizerSignup" method="post" enctype="multipart/form-data"-->
	<form id="frms_signup" action="<?php echo base_url();?>signup/beauty/<?php echo $ct_userID; ?>" method="post" enctype="multipart/form-data">
      <h3>Sign Up To Start Now</h3>
	  <?php if($msg != ""){?>
	<div id="mess">
		<h3><?php echo $msg;?></h3>
	</div>
	<?php }?>
      <div class="sing">
	 ` <!--input name="uname" id="uname" placeholder="User Name" type="text"-->
        <input name="emailAddr" id="emailAddr" placeholder="Email Address" type="email">
        <select size="1" name="city">
			<?php foreach($City as $city){?>
			<option value="<?php echo $city['country_id'];?>"><?php echo $city['name'];?></option>
			<?php }?>
			</select>
        <input name="submit" value="Submit" type="submit">
      </div>
      <div class="clear"></div>
    </form>
	
    <br class="clear">
	<a class="foradmin" href="<?php echo base_url();?>dashboard/ctadminbeauty">for amdin</a>
  </div>
</div>
<div class="hmerk">
  <div class="wrp">
    <div class="lrne">
      <h3>Browse Other Career Monetizers</h3>
      <ul>
	  <?php foreach($CT_Monetizer as $cm){
			if($Page_name!=$cm['title']){?>
			
				<!--<a href="<?php echo base_url();?>dashboard/<?php echo $cm['title'];?>/<?php echo $ct_userID; ?>"><li><img src="<?php echo base_url();?>images/CT_Monetizer/<?php echo $cm['img'];?>" width="111" height="145" alt=""><span></span></li></a>-->
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
<footer id="foot">
  <div class="wrp">
    <p>Create Your Account, Market Your Business, Raise Your Income</p>
  </div>
</footer>
</body>
</html>
