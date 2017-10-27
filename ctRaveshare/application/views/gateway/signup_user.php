<!doctype html>



<html lang="en"><head>



<title>Join CT to Make Money Online</title>



<meta charset="utf-8">



<meta property="og:type" content="website" />



<meta property="og:url" content="<?php echo $ogUrl; ?>" />



<meta property="og:title" content="Join CT to Make Money Online" />



<meta property="og:image" content="<?php echo base_url();?>images/logofb.jpg" />


<link href="<?php echo base_url();?>css/signup/style.css" rel="stylesheet" type="text/css">



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>



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



        //$.fancybox.open('<iframe width="660" height="415" src="' + path + '?autoplay=1" frameborder="0" allowfullscreen></iframe>');



		$.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/i08rzRNIfQs?autoplay=1" frameborder="0" allowfullscreen></iframe>');



    });



    



     <?php if ($msg!="" && $msgType == 1) { ?>



        $.fancybox.open('<div class="success-msgg"><b>Success!</b><?php echo $msg; ?></div>');



    <?php } ?>



});    



</script>







</head>



<body class="gambi_gr" style="background:none;">



  <div class="bdy_sec">



  <div id="wrap">



  	<div class="bdy_lft">



        <div class="logo_sec"><img src="<?php echo base_url();?>images/logo-big.png" alt=""></div>



        <h2 style="color: #1c76ba;font-family: Arial,Helvetica,sans-serif; font-size: 20px; font-weight: bold; left: auto !important; right: 0 !important;"><span style="color:#ed2984;">NOW LIVE:</span> START WITH BITCOIN - MARKET OUR BRANDS - EARN IN BITCOIN<!--<strong>Africa's Premier Internet Marketing Course</strong>VIP Guest Entrance - Get Ready For The Launch--></h2>



    </div>







  </div>



    	<div style="background:#e0fafa; margin-top: 20px; overflow: hidden;">



        <div id="wrap">



        <div class="bdy_right">



    <!--<div class="std_img"><img src="<?php echo base_url();?>css/signup/images/20150304_185311.png" alt=""></div>-->



            <div class="vdos_o" id="videoBoxId" style="margin:0; height: 283px; width: 585px; border-radius: 0; border:none;">

<img src="<?php echo base_url(); ?>images/ctdemopagevideopic.png" alt="" style=" height: 282px; padding: 0; width: 100% !important;" >



                        <div class="vdo_sec">



                          <!--  <div class="vid_dmo"><h3>Watch This Video</h3>



                                <span id="video_on_id" name="<?php if($videoPath != ""){ echo $videoPath;}?>" ><img src="<?php echo base_url(); ?>images/vdo_wtaro.png" alt="" ></span>-->



                            </div>



                        </div>



                    </div>



        <div class="signup">



                        <form id="signupfrm" method="post">



                            <strong>Register Here</strong>



                            <div class="frm_in">



                                 <?php if ($msg!="" && $msgType == 2) { ?>



                                    <span class="error">



                                        <?php echo $msg; ?>



                                    </span>



                                <?php } ?>



                                <input type="text" name="name" id="name" value="" placeholder="Name">



                                <?php echo form_error('name', '<span class="error">', '</span>'); ?>



                                <input type="text" name="surname" id="Surname" value="" placeholder="Surname"><?php echo form_error('surname', '<span class="error">', '</span>'); ?>



                                <input type="text" name="cellno" id="cellno" value="<?php



                                       if (isset($cellno)) {



                                           echo $cellno;



                                       }



                                       ?>"  placeholder="Contact Number"><?php echo form_error('cellno', '<span class="error">', '</span>'); ?>



                                <input type="email" name="emailAddr" id="emailAddr"  value="" placeholder="Email Address" >



                                        <?php echo form_error('emailAddr', '<span class="error">', '</span>'); ?>

								<select name="country" id="country" style="width:100%; margin-bottom:6px;">

							  <option value="Select Country">Select Country </option>

							   <?php 
									
									if(count($country_list) > 0): 
	
										foreach($country_list as $countryDetail): 

											

								?>

							  <option value="<?php echo $countryDetail['country_id']; ?>" <?php if (isset($country) && $country == $countryDetail['country_id']) { ?> selected="selected" <?php } ?>><?php echo $countryDetail['name']; ?></option>

							   <?php endforeach;endif;?>

							  </select><br>

                                



                                <p class="slc_sub">



                                <input style="width:69%; float:left;" type="text" name="skypeID" id="skypeID"  value="" placeholder="Skype ID">



<?php echo form_error('skypeID', '<span class="error">', '</span><br>'); ?>



                                    



                                    <?php echo form_error('city', '<span class="error">', '</span>'); ?>



									<input type="submit" name="submit" value="Submit"> 

<!--  <input type="button" name="submit" value="Submit" onclick="alert('Sorry for inconvenience.Please try after 2 days.')" style="background: #0e77bb none repeat scroll 0 0;

    border: 0 none;

    border-radius: 5px;

    color: #fff;

    cursor: pointer;

    display: block;

    float: right;

    font-size: 18px;

    height: 41px;

    line-height: 39px;

    width: 27%;">

-->

    </p></div>



                               <div class="clear"></div>



                        </form>



                        <div class="clear"></div>



                    </div>



    </div>



    	</div>



    </div>



    <div class="clear"></div>



  </div>











</body>



</html>