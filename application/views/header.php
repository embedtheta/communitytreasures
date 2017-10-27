<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<title>Index</title>-->
<title>CommunityTreasures</title>
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/headerlogo.png" type="image/x-icon"/>
<link href="<?php echo base_url(); ?>css/event_calendar.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">



<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> 

<!--28/09/2015 ujjwal sana start-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,300,500,600,700,900,200' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Muli:400,400italic,300italic,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>

<!--end-->

<!--
for full user
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/level2.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/p_color.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/carosel.css" rel="stylesheet" type="text/css">
<!-- end-->
<!--for calender
<script type='text/javascript' src='<?php echo base_url();?>js/custom_calendar.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.simplemodal.js'></script>
-->
<?php if($show_header != "show") {?>
		<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>-->
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jqueryy-1.7.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-timepicker-addon.js"></script>

		<script src="<?php echo base_url(); ?>js/organictabs.jquery.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>
		<!--<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>-->
		<!--for msg ujjwal sana 8/9/2015 -->
		<script type='text/javascript' src='<?php echo base_url(); ?>js/custom_common.js'></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery-ui-timepicker-addon.css" /> 
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery-ui-1.8.16.custom.css" />
		<link href="<?php echo base_url(); ?>css/new17-05-2013.css" rel="stylesheet" type="text/css">
<?php } ?>
<link href="<?php echo base_url(); ?>js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>js/datetimepicker/jquery.datetimepicker.js"></script>
<!--8/201/2015 us calender
<link type='text/css' href='<?php echo base_url(); ?>css/basic.css' rel='stylesheet' media='screen' />
-->
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
$(document).ready(function(){
	if(formSubmitMsg !=""){
	$.fancybox.open(formSubmitMsg);
	if(formSubmitType == "customer"){
	$('#serviceList_1').click();
	}
	else if(formSubmitType == "tech_support")
	{
		$('#serviceList_2').click();
	}
	else if(formSubmitType == "advertise")
	{
		$('#serviceList_3').click();
	}
	}

});

var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";
</script> 
<script type="text/javascript">
function auotologWP(){

          
}

$(document).ready(function(){    
	//  alert("ok");
	$("#paiddmemberr").click(function () {
	//	alert('ok gfh');
		$('#loginform').submit();
		return false;
	});
	//$(".accordion li > .sub-menu").hide{};
});
</script>
<script type="text/javascript">

		$(document).ready(function() {

			// Store variables
			
			var accordion_head = $('.accordion > li > a'),
				accordion_body = $('.accordion li > .sub-menu');
			accordion_head.on('click', function(event) {

				// Disable header links
				
				event.preventDefault();

				// Show and hide the tabs on click

				if ($(this).attr('class') != 'active'){
					accordion_body.slideUp('normal');
					$(this).next().stop(true,true).slideToggle('normal');
					accordion_head.removeClass('active');
					$(this).addClass('active');
				}

			});

		});
		
	</script>
<script type="text/javascript">
$(document).ready(function(){    
	$(".close-pop").click(function () {
		alert('gfh');
	});
	//$(".accordion li > .sub-menu").hide{};
});

	
	
	function autoSubmitToRaversDirect(){
	 //  alert(111);
	    document.getElementById("directForm").submit();
	//	alert(222);
	}

</script>

<!--[if lt IE 8]>
<script src="js/CreateHTML5Elements.js"></script>
<![endif]-->
<script>document.createElement('section');</script>
<script>document.createElement('header');</script>
<script>document.createElement('nav');</script>
<script>document.createElement('footer');</script>


<script type="text/javascript">
function auotologWP(){
}

$(document).ready(function(){    
	//  alert("ok");
	$("#paiddmember").click(function () {
	//	alert('ok gfh');
		$('#loginform').submit();
		return false;
	});
});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.sticky.js"></script><script>
    $(window).load(function(){
      $("#header").sticky({ topSpacing: 0 });
    });
  </script> 
<style>
#header-sticky-wrapper.sticky-wrapper {
    background: #fff !important;
    position: relative;
	/*height:206px !important;*/
	z-index:99;
}
.is-sticky .most_top{    background: #fff !important;}

</style></head>

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
                <!--<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>/Application/content/member/images/logo.png" alt="Ravers Story Society"></a>-->
                 <!--<a href="<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 10 || ($_SESSION['UID'] == 1000) || ($result['paymentStatus'] == 1)) { echo base_url(); } else { echo base_url().'/ravestorysociety/freetrial'; }?>"><img src="<?php echo base_url(); ?>/Application/content/member/images/logo2.png" alt="Ravers Story Society"></a>-->
                <?php if(isset($this->session->userdata['userId'])){ ?>
                <!-- <a href="<?php echo base_url().'dashboard/';?>">--><img src="<?php echo base_url(); ?>images/logo-login2.png" alt="CommunityTreasures"><!--</a>-->
                 <?php } else{?>
                <!-- <a href="<?php echo base_url().'dashboard';?>">--><img src="<?php echo base_url(); ?>images/logo.png" alt="CommunityTreasures"><!--</a>-->
                 <?php } ?>
            </div>
            <!-- logo end -->
             <?php 
			 //21/08/2015 done by sana
			 $_SESSION['userId']=$this->session->userdata('userId');
			
            ?>
			
			
            <!-- log form start -->
			<?php if(isset($this->session->userdata['userId'])){ ?>
			 <div class="log_form fltright">
             <!--9/9/2015 close by ujjwal sana-->
             	<!--<span><a href="<?php echo base_url(); ?>gateway/userdata" style="color:#FFFFFF;"><?php echo $this->session->userdata('userName'); ?></a></span>-->
				<span style="display: block; text-align: right;"><a href="<?php echo base_url(); ?>gateway/logout" style="color:#1b75bc; margin-left: 18px;">Log Out</a>
                <p class="ap-bbacount">
				<?php if($userInfo[0]['account_type_ap'] && $userInfo[0]['account_type_bb'] == '1')
				{
				?> 
				<a href="<?php echo base_url(); ?>myaccount"> <  Switch To B.B</a>
				<?php
				}
				?>
				<?php if($userdata[0]['account_type_ap'] && $userdata[0]['account_type_bb'] == '1')
				{
				?>
                <a href="<?php echo base_url(); ?>dashboard/apdashboard/"> < Switch To A.P</a>
				<?php
				}
				?>
				</p>
                </span>
                
			 </div>
			<?php } else {?>
            <div class="log_form fltright">
            
                <form action="<?php echo base_url(); ?>ravestorysociety/freetrial" method="post">
                    <p> 
                   
                      <!--<input name="txtemail" placeholder="email" type="text">
                        <input name="txtpassword" placeholder="password" type="password">-->
                        <input name="txtemail" onFocus="if($(this).val()=='email')$(this).val('');" onBlur="if($(this).val()=='')$(this).val('email');" value="email" type="text">
                        <input name="txtpassword" type="password" onFocus="if($(this).val()=='******')$(this).val('');" onBlur="if($(this).val()=='')$(this).val('******');" value="******">
                        
                        <input name="btnLogin" type="submit" value="">
                    </p>
                </form>
            </div>
			<?php } ?>
            <!-- log form end -->
            
            <div class="clear"></div>
			<div id="message_box"></div>
        </div>
	  <!-- top end -->