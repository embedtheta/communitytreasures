
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<title>Index</title>-->
<title>CT Revenue Share Queue</title>
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/headerlogo.png" type="image/x-icon"/>
<link href="<?php echo base_url(); ?>css/event_calendar.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/ravestyle.css" rel="stylesheet" type="text/css">


<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

<!--28/09/2015 ujjwal sana start-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,300,500,600,700,900,200' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Muli:400,400italic,300italic,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>


<?php if($show_header != "show") {?>
		
		<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>-->
		<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jqueryy-1.7.1.min.js"></script>-->
		<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.10.1.min.js"></script>-->
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>

		<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-timepicker-addon.js"></script>

		<script src="<?php echo base_url(); ?>js/organictabs.jquery.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>-->
		<!--<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>-->
		<!--for msg ujjwal sana 8/9/2015 -->
		<!--<script type='text/javascript' src='<?php echo base_url(); ?>js/custom_common.js'></script>-->
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery-ui-1.8.16.custom.css" />
		<link href="<?php echo base_url(); ?>css/new17-05-2013.css" rel="stylesheet" type="text/css">
<?php } ?>

<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<!--Step2 c blog -->

<link href="<?php echo base_url(); ?>css/p_color.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/mass.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/carosel.css" rel="stylesheet" type="text/css">
<!--Step2 C blog-->
<!--fancy box css-->
        <!--<script src="js/fancybox/jquery.fancybox.js"></script>
		<script src="js/fancybox/jquery.fancybox-buttons.js"></script>-->
<!--fancy box css end-->
<script src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>
<script type="application/javascript"></script>
<script type="text/javascript">


//var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";
</script> 


<!--[if lt IE 8]>
<script src="js/CreateHTML5Elements.js"></script>
<![endif]-->
<script>document.createElement('section');</script>
<script>document.createElement('header');</script>
<script>document.createElement('nav');</script>
<script>document.createElement('footer');</script>
 
</head>

<body>
<!-- wrapper start -->
<div class="wrapper">
	<!-- header start -->
	<header>
    	<!-- top start -->
		<div id="header" class="most_top">
        <div class="top"> 
            <!-- logo start -->
            <div class="logo fltleft">
                <?php if(isset($this->session->userdata['userId'])){ ?>
                 <a href="<?php echo base_url().'dashboard/';?>"><img src="<?php echo base_url(); ?>images/logo-login2.png" alt="CommunityTreasures"></a>
                 <?php } else{?>
                 <a href="<?php echo base_url().'dashboard';?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="CommunityTreasures"></a>
                 <?php } ?>
            </div>
            <!-- logo end -->
           <?php 
			 //21/08/2015 done by sana
			 $_SESSION['userId']=$this->session->userdata('userId');
			
            ?>
            <!-- log form start -->
			<?php if(isset($this->session->userdata['userId'])){ ?>
			 <div class="log_form fltright" style="margin-top:10px;">
             <!--9/9/2015 close by ujjwal sana-->
             	<!--<span><a href="<?php echo base_url(); ?>gateway/userdata" style="color:#FFFFFF;"><?php echo $this->session->userdata('userName'); ?></a></span>-->
				<?php //if($userType == "ADMIN"):?>
				<!--<span><a href="<?php echo base_url(); ?>viplogin/logout" style="color:#1b75bc;">Log Out</a></span>-->
				 <?php //else:?>
<span><a href="<?php echo base_url(); ?>myaccount" style="background:#2761cd; border: 0 none; border-radius: 5px;    color: #fff;
    font-size: 14px; margin-top: 10px; padding: 8px 10px;">Back to Home </a></span>
			 <?php //endif;?>
			 </div>
			<?php }?>
            <!-- log form end -->
            <div class="clear"></div>
			<div id="message_box"></div>
        </div>
	  <!-- top end -->