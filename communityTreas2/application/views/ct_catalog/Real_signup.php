<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Real Estate</title>
<meta charset="utf-8">
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $ogUrl; ?>" />
<meta property="og:title" content="COMMUNITY | BUSINESS" />
<meta property="og:image" content="<?php echo base_url();?>css/signup/images/logo.png" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/style_signup.css" />
<link href="<?php echo base_url();?>css/style_signup.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<link href="<?php echo base_url();?>css/signup/responsive.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,900,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />

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
<body>
<div class="hdrs">
<div class="wrp">
	<img src="<?php echo base_url(); ?>images/rel_hdr.jpg" alt=""  />
    
</div>
</div>
<div class="hdr_btm">
<div class="wrp">
    <div class="imr_tp">
    <img src="<?php echo base_url(); ?>images/rel_inm01.jpg" alt=""  />
</div>

</div>
</div>
<div class="hdr_mid estates_rel">
<div class="wrp"><!--wrp_o-->
    <div class="vws_tp">
    <div id="est_hdn">
    <img src="<?php echo base_url(); ?>CT_images/blu-tw.png" alt=""  />
    <div class="content-asa">
      <h2>Get More Leads<br />
Increase Your Sales<br />
Market Your Business</h2>
<p>An 'Easy To Use' web-tool for Realtors,
Estate Agents, Property Managers
& Agents in MLM Profit Share.</p></div>
    </div>
    
    	<div id="videoBoxId" class="vws_tp_vdos_o">
                        <div class="vws_tp_vdo_sec">
                        <div class="vws_tp_vid_dmo">
                            <h3 style="color:#000; text-align:right;">Watch Video</h3>
                            <span name="<?php echo $signupVideoImg[0]['path'];?>" class="video_on_id"><img alt="" src="http://www.communitytreasures.co/css/signup/images/vdo_wtaro.png"></span></div>
                           <!--<img class="brds" src="<?php echo base_url(); ?>images/CTRealetate1.png" alt=""  />-->
						             <img class="brds" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $signupVideoImg[0]['content_image'];?>" alt="">
                            </div>
        </div>
        <br class="clear" />
        </div>
        
        <br class="clear" />

</div>
</div>
<div class="pkse">
	<div class="wrp">
    	<h2><strong>Earn</strong> Money<br />While You Learn</h2>
      <form id="frms_signup" action="<?php echo base_url();?>signup/RealEstate/<?php echo $ct_userID; ?>" method="post" enctype="multipart/form-data">
      <h3>Sign Up To Start Now</h3>
	  <?php if($msg != ""){?>
	<div id="mess">
		<h3><?php echo $msg;?></h3>
	</div>
	<?php }?>
      <div class="sing">
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
	
       <br class="clear" />
	   <a class="foradmin" href="<?php echo base_url();?>dashboard/ctadminreal">for amdin</a>
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
				<a href="<?php echo base_url();?>signup/<?php echo $cm['title'];?>/<?php echo $ct_userID; ?>"><li><img src="<?php echo base_url();?>images/CT_Monetizer/<?php echo $cm['img'];?>" width="111" height="145" alt=""><span><!--?php echo $cm['title'];?--></span></li></a>
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
<div class="wrp"><p>Join Community Treasures - Raise Your Income Develop, Your Community & Connect The American</p></div>
</footer>
</body>
</html>















