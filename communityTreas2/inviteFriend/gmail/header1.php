<!--?php 
	session_start();  
	include('config.php');
?-->


<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<title>Index</title>-->
<title>Rave Business</title>
<link rel="shortcut icon" href="http://ravebusiness.com/ravebusinessImages/logo.jpg" type="image/x-icon"/>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/fancybox/jquery.fancybox-buttons.css">
        <link rel="stylesheet" href="css/fancybox/jquery.fancybox-thumbs.css">
         <link rel="stylesheet" href="css/fancybox/jquery.fancybox.css">       
        <link rel="stylesheet" href="demo/demo.css">


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jqueryy-1.7.1.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-timepicker-addon.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery-ui-timepicker-addon.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery-ui-1.8.16.custom.css" />
<link href="<?php echo base_url(); ?>css/new17-05-2013.css" rel="stylesheet" type="text/css">


<?php /*?><script type="text/javascript" src="<?php echo base_url(); ?>/Application/content/member/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/Application/content/member/fancybox/jquery.fancybox-1.3.4.css" media="screen" /><?php */?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<!--fancy box css-->
		
        <script src="js/fancybox/jquery.fancybox.js"></script>
		<script src="js/fancybox/jquery.fancybox-buttons.js"></script>
<!--fancy box css end-->
<script src="<?php echo base_url(); ?>/ckeditor/ckeditor.js"></script>
<script type="application/javascript">

/*function sendToCopy(articleID,articleTLE){
	 document.getElementById("txtATitle").value	= document.getElementById(articleTLE).value;
	 var val = document.getElementById(articleID).value;
	 CKEDITOR.instances.spintext.setData(val);
	
}*/

</script>

 
</head>

<body>
<!-- wrapper start -->
<div class="wrapper">
	<!-- header start -->
	<header>
    	<!-- top start -->
		<div class="top">
            <!-- logo start -->
            <div class="logo fltleft">
                <!--<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>/Application/content/member/images/logo.png" alt="Ravers Story Society"></a>-->
                 <!--<a href="<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 10 || ($_SESSION['UID'] == 1000) || ($result['paymentStatus'] == 1)) { echo base_url(); } else { echo base_url().'/ravestorysociety/freetrial'; }?>"><img src="<?php echo base_url(); ?>/Application/content/member/images/logo2.png" alt="Ravers Story Society"></a>-->
                <?php if(isset($_SESSION['userId'])){ ?>
                 <a href="<?php echo base_url().'/ravestorysociety/freetrial';?>"><img src="<?php echo base_url(); ?>images/logo2.png" alt="Ravers Story Society"></a>
                 <?php } else{?>
                 <a href="<?php echo base_url().'/ravestorysociety/freetrial';?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="Ravers Story Society"></a>
                 <?php } ?>
            </div>
            <!-- logo end -->
             <?php 
			 //21/08/2015 done by sana
			 $_SESSION['userId']=$this->session->userdata('userId');
			
            ?>
            <!-- log form start -->
			<?php if(isset($_SESSION['userId'])){ ?>
			 <div class="log_form fltright">
             	<span><a href="<?php echo base_url(); ?>/gateway/userdata" style="color:#FFFFFF;"><?php echo $this->session->userdata('userName'); ?></a></span>
				<span><a href="<?php echo base_url(); ?>/gateway/logout" style="color:#FFFFFF;">Log Out</a></span>
			 </div>
			<?php } else {?>
            <div class="log_form fltright">
            
                <form action="<?php echo base_url(); ?>/ravestorysociety/freetrial" method="post">
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