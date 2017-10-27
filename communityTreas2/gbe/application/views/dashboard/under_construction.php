
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>GBE Under Construction</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>

<script src="<?php echo base_url(); ?>js/organictabs.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>

<script>
 $(document).ready(function(){
	 $('.pull').click(function(){
		 $('.misc_new').slideToggle();
	 });
 })
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="top">
  <div class="top-inn">
    <div class="logo fltleft hed_inr">
      <h1><a href="<?php echo base_url();?>dashboard">
        <div class="logo-img"> </div>
        </a></h1>
    </div>
    <div class="log_form fltright"> <span><a href="<?php echo base_url();?>gateway/logout/" style="color:#FFFFFF;">Log Out</a></span> </div>
    <div class="clear"></div>
    <div id="message_box"></div>
  </div>
</div>
<div class="wrapper">
  <header>
    <div class="pulldiv"><a href="javascript:void(0)" class="pull">NAVIGATION</a></div>
    <div class="nav">
      <nav class="secondary">
        <ul class="misc_new">
          
          <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="#" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>
          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="#" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>
          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="#" id="gbeLevel3"><span class="level">Level - 3</span> The Source<span> Open </span></a></li>
          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="#" id="gbeLevel4"><span class="level">Level - 4</span>Regeneration<span> Open </span> </a></li>
          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="#" id="gbeLevel5"><span class="level">Level - 5</span> Franchise <span> Open </span> </a></li>
          
<!--          <li class="levelClass" id="1"><a href="javascript:void(0)" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>
          <li class="levelClass" id="2"><a href="javascript:void(0)" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>
          <li class="levelClass" id="3"><a href="javascript:void(0)" id="gbeLevel3"><span class="level">Level - 3</span> The Source<span> Open </span></a></li>
          <li class="levelClass" id="4"><a href="javascript:void(0)" id="gbeLevel4"><span class="level">Level - 4</span>Regeneration<span> Open </span> </a></li>
          <li class="levelClass" id="5" style="padding-right:0;"><a href="javascript:void(0)" id="gbeLevel5"><span class="level">Level - 5</span> Franchise <span> Open </span> </a></li>-->
          
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
    
   
    
  </header>
  <!--header end-->
  
  <div class="main_container">
    <div class="lefts_side" style="width: 100%;">
      <div class="tabsectionstep" style="width: 100%;">
          <div class="containertab" style="width: 100%;">
            
          <div class="tab_container" style="width: 100%;">
            <div id="tab1" class="tab_content" style="width: 100%;">
              <div class="white-bg">
                  <h3 style="text-align:center; width:auto; float:none;" class="headign-left"> Your page will be display soon... </h3>
                <br class="clear">
              </div>
             
              
            </div>
            <!--1tab end......... -->
          </div>
          
          
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
