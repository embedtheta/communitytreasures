<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>GBE makes you money & builds our Community</title>
<link href="<?php echo base_url(); ?>css/style3.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>


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
    <?php if(isset($msg)){?>
        $.fancybox.open('<?php echo $msg;?>');
    <?php } ?>
    });
</script>
</head>
<body>
	<!--Header section-->
    	<header>
   	    <div class="hed_inr">
            <h1><a href="<?php echo base_url();?>gateway"><div class="logo-img">  </div></a></h1>
            <h2><a href="#" class="login-manu" >Login</a></h2>
			<h2 href="#" class="forget-manu" >Forgotten your password?</h2>
          
          <div class="login-manu-sub" style="display:<?php echo $styleStatus;?>;">  

            <div class="login-drop">
               <?php if(isset($errorMsg)){?>
               <div class="error-msg"><?php echo $errorMsg;?></div>
               <?php }?>
                	<form action="<?php echo base_url();?>gateway/login" method="post" id="frnd" class="login-form">
                    	<input name="emailID" type="text" placeholder="Email" class="input1" required>
                        <input name="password" type="password" placeholder="Password" class="input2" required>
                        <input type="submit" name="logIN" id="logIN" value="Login" class="login-submit"/>
                    </form>
                </div> 
            </div>
			
			
			
			
			<div class="forget-manu-sub" style="display:<?php echo $styleStatus1;?>;">  

            <div class="login-drop">
			 <?php if($succMsg!=""){?>
               <div class="succ-msg"><?php echo $succMsg;?></div>
               <?php }?>
               <?php if($errorMsg1!=""){?>
               <div class="error-msg"><?php echo $errorMsg1;?></div>
               <?php }?>
			   
                	<form action="<?php echo base_url();?>gateway/forgetPass" method="post" id="frnd" class="login-form">
                    	<input name="emailIDforFrogetPass" type="text" placeholder="Email" class="input1" required>                       
                        <input type="submit" name="forgetPassBtn" id="forgetPassBtn" value="Submit" class="login-submit"/>
                    </form>
                </div> 
            </div>
			
			
			
        </div>
        
        
               

        </header>
	<!--Header section end-->


	<!--body section-->
        <div class="main-bdy hm_lggn">
        	<div class="body_inr">
            	<div class="bdylft">
                <iframe id="playvid" width="626" height="316" src="<?php if($pageDetails->video_path != ""){ echo $pageDetails->video_path;}else{?>www.youtube.com/embed/U5k8fTHoAgk<?php }?>" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="bodyritt hmm_lg">
                <?php if(isset($accessResponse)){?>
                <h5 style="color:#3FC"><?php echo $accessResponse;?></h5>
                <?php }?>
                <?php if(isset($msg)){?>
<!--                <h5 style="color:#3FC"><?php echo $msg;?></h5>-->
                <?php }?>
                <!-- <h4>Make Friends, Make Money, Make a Difference </h4>-->
				<h4 style="font-size:16px;">Support Black-owned Businesses<br/>
				Develop Our Communities<br/>
				Raise Your Income Fast!</h4>
                	<form  id="frnd" method="post"  action="<?php echo base_url();?>gateway/signUpRequest">
                    	<!--<input type="text"  name="signUpName"  placeholder="Name Here..." required="">-->
                        <input type="text" name="signUpEmail"  placeholder="Enter VALID Email Here..." required>
                        <input type="hidden" name="parentID" value="<?php echo $parentID;?>">
                        <input type="submit" name="submit" value="Get Access Now!">
                    </form>
                </div><div class="clear"></div>
            </div>
        </div>
	<!--body section end-->

	<!--New section added-->
    <div class="fontent_bottom">
    	<div class="fontent_bottom_inner">
        <div class="prod_logo"><img src="<?php echo base_url();?>/images/prod_logo.jpg" alt=""><p>Global Black Enterprises offers five online business packages plus marketing software and tools that are ideal for 
people wanting to generate a home-based income. GBE members can earn large commissions from the sales of GBE Products. Our affiliate programs, training and essential coaching can benefit all, from the un-employed to start-ups, small, medium and large businesses. Join GBE Today!</p></div>
		<div class="prod_cont">
        	<div class="prod_cont_div1">
            	<div class="prod_cont_left"><img src="<?php echo base_url();?>/images/GBEfront1.jpg" alt=""></div>
                <div class="prod_cont_rit"><h2>Afrowebb Catalogue</h2>
<h3>Earn While You Boost The Black Economy.</h3>
<p>Afrowebb Catalogue is designed to raise your income while it provides vital marketing for black-owned businesses and service providers. People with artistic, creative talent use this program as a source of  mass distribution from an ever growing network of marketers.</p>
<p> An Afrowebb Catalogue is an awsome way to start making money online. Buy your Afrowebb Catalogue Today!</p>
                
</div>
				<div class="clear"></div>
            </div>
            <div class="prod_cont_div2">
            	<div class="prod_cont_left"><img src="<?php echo base_url();?>/images/GBEfront2.jpg" alt=""></div>
                <div class="prod_cont_rit"><h2>Full Members</h2>
<h3>Benefit From Our City Wide Stratergy – Building Healthier, Safer & Wealthier Local Black Communities</h3>
<p><strong>GBE Full Members</strong> package enables you to raise your income by helping to establish positive initiatives that actively develop and galvanise the Black communities in your city. This product features a collection of tools and instruction videos taking you from just 'Me' to a progressive and like minded 'We'. The Full Members package also gives you access to successful GBE entrepreneurs who wish to invest in budding black-owned businesses.</p>
				
                
</div><div class="clear"></div>
            </div>
        	<div class="prod_cont_div1">
            	<div class="prod_cont_left"><img src="<?php echo base_url();?>/images/GBEfront3.jpg" alt=""></div>
                <div class="prod_cont_rit"><h2>Diversity</h2>
<h3>Profit From Our Multi-cultural Market Place Technology</h3>
<p>This package expands your GBE business into two portions. By adding V.I.P access to 'Community Treasures' you gain a separate business giving you the ability to sell varied products to people of all demographics. There is also a step-by-step application plan showing you how you can become a top producer in this online business.</p>
                
</div>
				<div class="clear"></div>
            </div>
            <div class="prod_cont_div2">
            	<div class="prod_cont_left"><img src="<?php echo base_url();?>/images/GBEfront4.jpg" alt=""></div>
                <div class="prod_cont_rit"><h2>Corparation Formula</h2>
<h3>Think Big, Become Bigger</h3>
<p>Guided by top professionals in their industry, this program features professional monthly courses that show you how to secure your personal wealth and take care of your life essentials. There are tools enabling you to join or start a black-owned corporation in your city. Within this package you learn the laws of team building, and how you can apply those fundamental laws to dramatically build your corporation business. </p>
				
                
</div><div class="clear"></div>
            </div>
        	<div class="prod_cont_div1">
            	<div class="prod_cont_left"><img src="<?php echo base_url();?>/images/GBEfamily5.jpg" alt=""></div>
                <div class="prod_cont_rit"><h2>Summit</h2>
<h3>Enjoy The Masters Retreats in Africa</h3>
<p>With an unlimited advertising facility, concrete strategies from experts in finance, business. fulfilment, health and relationships, this final package shows you how to turn your wealth into a legacy. The Summit package includes a Masters retreat that delivers a powerful restorative schedule of physical and emotional conditioning, daily practices that will enhance your state of being and teachings of scientific influence principles. You will be focused and invigorated as every year the Masters retreat will make you re-committed to your maximum productivity, health, relationships and prosperity. </p>
                
</div>
				<div class="clear"></div>
            </div>
        </div>
        </div><div class="lst_bmts"><p>Sell Life Changing Packages & Earn Life Changeing Commissions.</p></div>
    </div>
	<!--New section end-->


	<!--footer section-->
        <footer style="position:inherit;">
        <p class="foot_lgs"><img src="<?php echo base_url();?>/images/global-logo.png" alt=""></p>
        		<p>© <?php echo date("Y");?> Morpheus Society | Website by Celestial Technologies. All Rights Reserved</p>
        </footer>
	<!--footer section end-->
    </div>
    
    
                
    
    
</body>
</html>