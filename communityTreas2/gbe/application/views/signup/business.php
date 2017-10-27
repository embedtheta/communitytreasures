<!doctype html>
<html lang="en">
<head>
<title>GBE | BUSINESS</title>
<meta charset="utf-8">
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $ogUrl; ?>" />
<meta property="og:title" content="GBE | BUSINESS" />
<meta property="og:image" content="<?php echo base_url();?>css/signup/images/logo.png" />
<link href="<?php echo base_url();?>css/signup/style.css" rel="stylesheet" type="text/css">
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
<body class="gambi_bze">
  <div class="bdy_sec">
  <div id="wrap">
  	<div class="bdy_lft">
    	<div id="bssns"><h2>Global Black Business<br>Association</h2>
        <p>Watch Viseo Sign Up<br> Get More Customers & <br>Benefit From The Support</p></div>
        <div class="lggol"><img src="<?php echo base_url(); ?>css/signup/images/img_bzz.png" alt="" ></div><!--vdi2-->
        <div class="bdy_right">
            <div class="vdos_o" id="videoBoxId">
                        <div class="vdo_sec">
                        <div class="vid_dmo">
                            <h3>Watch This Video</h3>
                            <span id="video_on_id" name="<?php if($videoPath != ""){ echo $videoPath;}?>"><img src="<?php echo base_url(); ?>css/signup/images/vdo_wtaro.png" alt="" ></span></div></div>
        </div>
        
        <div class="signup">
                        <form id="signupfrm" method="post">
                            <strong>Register Here</strong>
                            <div class="frm_in">
                                <?php if ($msg && $msgType == 2) { ?>
                                    <span class="<?php if ($msgType == 2) { ?>error<?php } elseif ($msgType == 1) { ?>success<?php } ?>">
                                        <?php echo $msg; ?>
                                    </span>
                                <?php } ?>
                                <input type="text" name="name" id="name" value="<?php if (isset($name)) {
                                    echo $name;
                                } ?>" placeholder="Name">
<?php echo form_error('name', '<span class="error">', '</span>'); ?>
                                <input type="text" name="surname" id="Surname" value="<?php if (isset($surname)) {
    echo $surname;
} ?>" placeholder="Surname">
                                <input type="text" name="cellno" id="cellno" value="<?php if (isset($cellno)) {
    echo $cellno;
} ?>"  placeholder="Contact Number">
                                <input type="email" name="emailAddr" id="emailAddr"  value="<?php if (isset($emailAddr)) {
                                        echo $emailAddr;
                                    } ?>" placeholder="Email Address">
                                    <?php echo form_error('emailAddr', '<span class="error">', '</span>'); ?>
                                <input type="text" name="skypeID" id="skypeID"  value="<?php if (isset($skypeID)) {
                                        echo $skypeID;
                                    } ?>" placeholder="Skype ID">
<?php echo form_error('skypeID', '<span class="error">', '</span><br>'); ?>
                                <p class="slc_sub"><select name="city">
<?php if (count($cityArray) > 0) {
    foreach ($cityArray as $cVal) { ?>
                                            <option value="<?php echo $cVal->id; ?>" <?php if (isset($city) && $city == $cVal->id) { ?> selected="selected" <?php } ?>><?php echo $cVal->city; ?></option>    
    <?php }
} else { ?>
                                        <option value="">Select City</option>    
<?php } ?>
                                </select>
                                    <?php echo form_error('city', '<span class="error">', '</span>'); ?>
                                    <input type="submit" name="submit" value="Submit"></p></div>
                            <!--<a href="<?php //echo base_url(); ?>" class="sfg">Cancel</a>--><div class="clear"></div>
                        </form>
                        <div class="clear"></div>
                    </div></div>
    </div>
    <div class="clear"></div>
  </div>
  </div>

<!--footer section-->
<footer id="foot">
<div id="wrap"><p>Join GBE - Raise Your Income Develop, Your Community & Connect The African Diaspora</p></div>
</footer>
<!--footer section end-->
</body>
</html>