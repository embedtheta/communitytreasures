<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hair & Beauty</title>
<meta charset="utf-8">
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $ogUrl; ?>" />
<meta property="og:title" content="COMMUNITY | BUSINESS" />
<meta property="og:image" content="<?php echo base_url();?>css/signup/images/logo.png" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/style_signup.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!--<script type="text/javascript">
    var youtube_url = 'https://www.youtube.com/embed/VSlWVtgAsq4?autoplay=1';
</script>
<script src="<?php //echo base_url(); ?>css/signup/pop-up-player.js"></script>-->
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
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,900,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
    $("#cellno").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
     $("#videoBoxId").click(function () {
        var path = $("#video_on_id").attr("name");
        $.fancybox.open('<iframe width="660" height="415" src="' + path + '?autoplay=1" frameborder="0" allowfullscreen></iframe>');
    });
    <?php if ($msg && $msgType == 1) { ?>
        $.fancybox.open("<?php echo $msg; ?>");
    <?php } ?>
});    
</script>
</head>
</head>
<body>
<div class="hdrs heire">
  <div class="wrp">
    <div class="hdr_top"><img src="<?php echo base_url(); ?>images/pnk_top_log.jpg" alt=""  /></div>
    <div class="hdr_btm">
      <h2>Learn Hair 7 Beauty Online > Start Now</h2>
    </div>
  </div>
</div>
<div class="hdr_btm hair_buty">
  <div class="wrp">
    <div class="pnk"></div>
    <div class="imr_tp"> 
    <img src="<?php echo base_url(); ?>images/hair_img01.jpg" alt=""  /> 
    <img src="<?php echo base_url(); ?>images/hair_img02.jpg" alt=""  /> 
    <img src="<?php echo base_url(); ?>images/hair_img03.jpg" alt=""  /> </div>
  </div>
</div>
<div class="hdr_mid">
<div class="wrp_o">
  <div class="vws_tp">
    <h2>Twelve Teachers<br />
      12 Monthly Courses<br />
      Video Instructions<br />
      Live Teacher Support</h2>
    <div id="videoBoxId" class="vws_tp_vdos_o">
      <div class="vws_tp_vdo_sec">
        <div class="vws_tp_vid_dmo">
          <h3 style="color:#fff;">Watch This Video</h3>
          <span name="https://www.youtube.com/embed/pDOdKCbaS5M" id="video_on_id"><img alt="" src="http://www.communitytreasures.co/css/signup/images/vdo_wtaro.png"></span></div>
        <img class="brds" src="<?php echo base_url(); ?>images/CTHairBeauty4.jpg" alt=""  /> </div>
    </div>
    <br class="clear" />
    <p>&nbsp;</p>
  </div>
</div>
<div class="pkse">
  <div class="wrp">
    <h2><strong>Earn</strong> Money<br />
      While You Learn</h2>
    <!-- <form action="" method="post" id="frms_signup">
       <h3>Sign Up To Start Now</h3>
       <input name="" type="text" />
       <select name="">
       	<option>Program of Interest *</option>
       	<option>Program of Interest *</option>
       	<option>Program of Interest *</option>
       	<option>Program of Interest *</option>
       	<option>Program of Interest *</option>
       </select>
       <input name="" type="submit" value="submit" />
       </form>-->
    <form id="frms_signup" method="post">
      <h3>Sign Up To Start Now</h3>
      <div>
        <?php if ($msg && $msgType == 2) { ?>
        <span class="<?php if ($msgType == 2) { ?>error<?php } elseif ($msgType == 1) { ?>success<?php } ?>"> <?php echo $msg; ?> </span>
        <?php } ?>
        <input type="text" name="name" id="name" value="<?php if (isset($name)) {
                                    echo $name;
                                } ?>" placeholder="Name">
        <?php echo form_error('name', '<span class="error">', '</span>'); ?>
        <input type="email" name="emailAddr" id="emailAddr"  value="<?php if (isset($emailAddr)) {
                                        echo $emailAddr;
                                    } ?>" placeholder="Email Address">
        <?php echo form_error('emailAddr', '<span class="error">', '</span>'); ?>
        <select name="city" size="1">
          <option value="" selected>Select one</option>
          <option value = "193">South Africa</option>
          <option value = "223">United states</option>
          <option value = "222">United KIndom</option>
          <option value = "38">Canada</option>
          <option value = "252">Asia</option>
        </select>
        <?php echo form_error('city', '<span class="error">', '</span>'); ?>
        <input type="submit" name="submit" value="Submit">
        </p>
      </div>
      <!--<a href="<?php //echo base_url(); ?>" class="sfg">Cancel</a>-->
      <div class="clear"></div>
    </form>
    <br class="clear" />
  </div>
</div>
<div class="hmerk">
  <div class="wrp">
    <h3>Learn Courses in Hairderessing, Nail Technology, Esthetics, Cusmetology & Make Up - Form The Comfort of Home</h3>
    <img src="<?php echo base_url(); ?>images/hair_img04.jpg" alt=""  /> </div>
</div>
<footer id="foot">
  <div class="wrp">
    <p>Join Community Treasures - Raise Your Income Develop, Your Community & Connect The American</p>
  </div>
</footer>
</body>
</html>
