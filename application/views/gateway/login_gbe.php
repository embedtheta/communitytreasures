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
                    	<input name="emailID" type="text" placeholder="Email" class="input1" required="">
                        <input name="password" type="password" placeholder="Password" class="input2" required="">
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
                    	<input name="emailIDforFrogetPass" type="text" placeholder="Email" class="input1" required="">                       
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
                        <input type="text" name="signUpEmail"  placeholder="Enter VALID Email Here..." required="">
                        <input type="hidden" name="parentID" value="<?php echo $parentID;?>">
                        <input type="submit" name="submit" value="Get Access Now!">
                    </form>
                </div><div class="clear"></div>
            </div>
        </div>
	<!--body section end-->

	<!--footer section-->
        <footer>
        		<p>© <?php echo date("Y");?> Morpheus Society | Website by Celestial Technologies. All Rights Reserved</p>
        </footer>
	<!--footer section end-->
    </div>
    
    
                
    
    
</body>
</html>