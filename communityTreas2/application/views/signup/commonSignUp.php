<!doctype html>



<html lang="en">



<head>



<title>Join CT to Make Money Online</title>



<meta charset="utf-8">



<meta property="og:type" content="website" />



<meta property="og:url" content="<?php echo $ogUrl; ?>" />



<meta property="og:title" content="Join CT to Make Money Online" />



<meta property="og:image" content="<?php echo base_url();?>images/logo-fb.png" />







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



        $.fancybox.open('<iframe width="660" height="415" src="' + path + '?autoplay=1" frameborder="0" allowfullscreen></iframe>');



    });



    



     <?php if ($msg && $msgType == 1) { ?>



        $.fancybox.open("<?php echo $msg; ?>");



    <?php } ?>



});    



</script>



<style type="text/css">



.signup {



    float: none;



    margin: 0 auto;



    width: 600px;



}



.footer-login {

    background: #bb1761 none repeat scroll 0 0;

    padding: 20px 0;

}



.wrapper-login {

    margin: 0 auto;

    position: relative;

    width: 960px;

}

p.foot_log {

    display: block;

    padding-bottom: 15px;

}



.footer-login p {

    color: #fefefe;

    font-family: "Roboto",sans-serif;

    font-size: 16px;

    font-weight: 400;

    text-align: center;

}

.footer-login p a {

    color: #fefefe;

}

.footer-topplink a {

    color: #d992cd !important;

}

.footer-copyright {

    color: #d992cd !important;

    font-size: 14px !important;

    margin-top: 10px;

}

.bitcoinmsgcls {
    color: #dc2209;
    font-family: arial;
    font-size: 17px;
    text-align: center;
}
.frm_in input[type="email"], #signupfrm input[type="text"], #signupfrm input[type="password"]{color: #0099ff !important;  height: 30px !important;} 
.frm_in p {
    background: #61bffd !important;
    border-radius: 5px;
    color: #fff !important;
    display: block;
    margin-top: 5px;
    padding-left: 10px !important;
}
</style>



</head>



<body class="gambi_gr" style="background:none;">



  <div class="bdy_sec">



  <div id="wrap">



  	<div class="bdy_lft">



        <div class="logo_sec"><img src="<?php echo base_url();?>images/logo-big.png" alt=""></div>



        <h2>Founding Members<!--<strong>Africa's Premier Internet Marketing Course</strong>--></h2>



    </div>

<br class="clear">

  	<div class="bdy_right" style="padding-top:0 !important;">



    <!--<div class="std_img"><img src="<?php echo base_url();?>css/signup/images/20150304_185311.png" alt=""></div>-->



            <!--<div class="vdos_o" id="videoBoxId">



                        <div class="vdo_sec">



                            <div class="vid_dmo"><h3>Watch This Video</h3>



                                <span id="video_on_id" name="<?php if($videoPath != ""){ echo $videoPath;}?>" ><img src="<?php echo base_url(); ?>css/signup/images/vdo_wtaro.png" alt="" ></span>



                            </div>



                        </div>



                    </div>-->



        <div class="signup" style="width:960px !important; min-height: 460px;">



        <?php if($activationStatus){ ?>



                        <form id="signupfrm" method="post" style="float: left; width: 33%;">



                            <div class="frm_in" style=" background: #fff none repeat scroll 0 0; border-radius: 15px; box-shadow: 0 0 12px #aaa;  margin-top: 20px;">

<strong style=" color: #5c5c5c; display: block; font-family: 'Roboto',sans-serif; font-size: 20px; font-weight: 600;  margin: 0;  padding: 9px 0;  text-align: center;    text-transform: uppercase;  width: 100%;">Your Profile Details</strong>

                                <?php if ($msg && $msgType == 2) { ?>



                                    <span class="<?php if ($msgType == 2) { ?>error<?php } elseif ($msgType == 1) { ?>success<?php } ?>">



                                        <?php echo $msg; ?>



                                    </span>



                                <?php } ?>



                                <input  style="background:none; padding:0; text-align:center;" readonly type="text" name="name" id="name" value="<?php



                                if (isset($name)) {



                                    echo $name;



                                }



                                ?>" placeholder="Name">



                                <?php echo form_error('name', '<span class="error">', '</span>'); ?>



                                <input  style="background:none; padding:0; text-align:center;" readonly type="text" name="surname" id="Surname" value="<?php



                                if (isset($surname)) {



                                    echo $surname;



                                }



                                ?>" placeholder="Surname"><?php echo form_error('surname', '<span class="error">', '</span>'); ?>



                                <input style="background:none; padding:0; text-align:center;" type="text" name="cellno" id="cellno" readonly value="<?php



                                       if (isset($cellno)) {



                                           echo $cellno;



                                       }



                                       ?>"  placeholder="Contact Number"><?php echo form_error('cellno', '<span class="error">', '</span>'); ?>



                                <input style="display:none;" type="email" name="emailAddr" id="emailAddr"  value="<?php



                                       if (isset($emailAddr)) {



                                           echo $emailAddr;



                                       }



                                       ?>" placeholder="Email Address">



                                        <?php echo form_error('emailAddr', '<span class="error">', '</span>'); ?>











<p style="  color: #25369c;  font-size: 16px; font-family:Arial, Helvetica, sans-serif; font-weight: normal; padding: 0;"><?php



                                       if (isset($emailAddr)) {



                                           echo $emailAddr;



                                       }



                                       ?></p>



                      <p style="  color: #25369c;  font-size: 16px;  font-family:Arial, Helvetica, sans-serif; font-weight: normal; padding: 0;"><?php



                                       if (isset($password)) {



                                           echo $password;



                                       }



                                       ?></p>                 



                                       



                                <input style="display:none;" type="password" name="password" id="password"  value="<?php



                                       if (isset($password)) {



                                           echo $password;



                                       }



                                       ?>" placeholder="Password">



                                        <?php echo form_error('password', '<span class="error">', '</span>'); ?>



                                



                                <p class="slc_sub">



                                <input style="float:left; display:none;" type="text" name="skypeID" id="skypeID"  value="<?php



                                        if (isset($skypeID)) {



                                            echo $skypeID;



                                        }



                                        ?>" placeholder="Skype ID">



<?php echo form_error('skypeID', '<span class="error">', '</span><br>'); ?>



                              



                                    <!--<input type="submit" name="submit" value="Submit">--></p>



                                     <p class="slc_sub">



<!--<input type="submit" name="submit" value="Click here to Pay $40 for Registration" style="font-size: 20px;  height: 50px; width: 580px">-->

<!--<script

    src="https://checkout.stripe.com/checkout.js"

    class="stripe-button"

    data-key="pk_test_IJ3WZawvhuVbc9h7F78QdFL8"

    data-image="/square-image.png"

    data-name="Demo communityTreas2 Site"

    data-description="Click here to Pay ($40.00) for Registration"

    data-amount="4000">

  </script>



  -->





                                    </p>



                                    </div>



                                <div class="clear"></div>



                        </form>

<iframe src="<?php echo base_url();?>bitcoinapi_php/Examples/example_basic.php?tempIframeParentID=<?php echo $tempIframeParentID; ?>&emailId=<?php echo $emailAddr; ?>" width="63%" height="460" style="float: right;

    margin-top: 0px;"></iframe> 

                        <?php 



                        }



                        else{



                        echo "<h2 style=\"color: #80007b;font-size: 28px;font-weight: bold;line-height: 64px;font-family: 'Roboto', sans-serif; text-align: center;\">Link has been Successfully activated.</h2> <a style=\" background: #1b75bc none repeat scroll 0 0; border-radius: 5px;



color: #fff; display: block; font-size: 20px;line-height: 50px; margin: 0 auto; text-align: center; text-decoration: none; width: 380px;\ href=\"".base_url()."\">Click here to Login</a>";



                        }







                         ?>

 

                        <div class="clear"></div>



                    </div>



    </div>



    <div class="clear"></div>



  </div>



  </div>







<!--footer section-->

<div class="footer-login">

    <div class="wrapper-login">

    

    <p class="foot_log"><img src="http://www.communitytreasures.co/images/footer_logo.png" alt=""></p>

    

      <p class="footer-topplink"> <a href="#">Personal Development</a> - <a href="#">Life &amp; Wealth Mastery</a> - <a href="#">Financial Freedom</a> - <a href="#">Good Health</a> - <a href="#">Success</a> - <a href="#">Awakenings</a> - <a href="#">Wholeness</a> - <a href="#">Harmony</a> <a href="#">Prosperity</a> - <a href="#">Humanity</a> - <a href="#">Consciousness</a> - <a href="#">Rejuvenation</a> - <a href="#">Lifestyle</a> - <a href="#">Conscious Capitalism</a> - <a href="#">Ethical</a> - <a href="#">Social Entrepreneurism</a> - <a href="#">Joy

        Happiness</a> - <a href="#">Security</a> - <a href="#">Friendship</a> - <a href="#">Wellness</a> - <a href="#">Support</a> - <a href="#">Nutrition</a> </p>

        

        <p class="footer-newlink"><a href="http://www.communitytreasures.co/gateway/contentDetails/earnings-disclaimer">Earnings Disclaimer</a> | <a href="http://www.communitytreasures.co/gateway/contentDetails/privacy-policy">Privacy Policy</a> |

<a href="http://www.communitytreasures.co/gateway/contentDetails/terms-and-conditions">Terms &amp; Conditions</a> |

<a href="http://www.communitytreasures.co/gateway/contentDetails/compliance">Compliance</a></p>

<p class="footer-copyright">&copy; communitytreasures.co. All rights reserved.</p>

    </div>

  </div>



<!--<footer id="foot">



<div id="wrap"><p>Join GBE - Raise Your Income Develop, Your Community & Connect The African Diaspora</p></div>



</footer>-->



<!--footer section end-->



</body>



</html>