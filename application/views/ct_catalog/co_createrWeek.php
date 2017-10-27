<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CT Category Detail</title>
<link rel="shortcut icon" href="<?php echo base_url();?>images/headerlogo.png" type="image/x-icon"/>
<link href="<?php echo base_url();?>css/stylesheet_CT_Affro.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.slides.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/responsiveCarousel.min.js"></script>
<script>

$(document).ready(function(){ 

	

	$("#adVideoLinkId01").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#adVideoLinkId02").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#adVideoLinkId03").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	

});

</script>
<style type="text/css">
.fancybox-lock .fancybox-overlay {
	overflow: auto;
	overflow-y: scroll;
	z-index: 9999999;
}
</style>
</head>
<body class="ct_afro_pro">
<div class="header">
  <?php $this->load->view("ct_catalog/CT_header", $result); ?>
</div>
<div id="maincontainers" style="margin-top: 235px;">
  <div class="bdysec">
    <div class="bdysec_left">
      <div class="my-left-cont">
        <div id="cssmenu"> </div>
      </div>
      <div class="my-right-cont">
        <?php if($event_description){
				
			   ?>
        <div class="list-detail newlisting">
          <h1><?php echo $event_description[0]['title'];?></h1>
          <!-- Image --> 
          <img width="180" height="200" class="article-left-img" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/productPagesImg/<?php echo $event_description[0]['image'];?>"> 
          
          <!-- body -->
          
          <p><?php echo $event_description[0]['description'];?></p>
        </div>
        <?php }?>
        <!--Product Show -->
        <div class="listwrap newbottomvideopan">
          <div class="bdysec_right newpan">
            <div class="right-pannewadd">
              <p>Start your<br>
                Marketing Campaign</p>
              <a href="<?php echo base_url();?>dashboard/category_detail/297">
              <h2>Promote<br>
                Your Brand<br>
                Or Business</h2>
              </a>
              <div class="rightnew-vidsec"> <a id="adVideoLinkId01" name="https://www.youtube.com/embed/Btt-bpmmKiA" style="cursor:pointer;"><img src="<?php echo base_url();?>images/right-vid.jpg" width="" height="" alt="" /></a> 
                <!--<iframe width="222" height="230" src="https://www.youtube.com/embed/Btt-bpmmKiA" frameborder="0" allowfullscreen></iframe>--> 
              </div>
              <h3>Get Your A.P Package Today</h3>
              <a href="<?php echo base_url();?>dashboard/category_detail/297" class="start-button">Start Now</a></div>
            <div class="right-pannewadd">
              <p style="height:38px;">Get Paid For Watching</p>
              <a href="<?php echo base_url();?>myaccount">
              <h2>Watching<br>
                & Sharing<br>
                Videos</h2>
              </a>
              <div class="rightnew-vidsec"><a id="adVideoLinkId03" name="https://www.youtube.com/embed/eOqo-sWtF9U" style="cursor:pointer;"><img src="<?php echo base_url();?>images/right-vid.jpg" width="" height="" alt="" /></a> 
                <!--<iframe width="222" height="230" src="https://www.youtube.com/embed/eOqo-sWtF9U" frameborder="0" allowfullscreen></iframe>--> 
              </div>
              <h3>Start Earning Today!</h3>
              <a href="<?php echo base_url();?>myaccount" class="start-button">Start Now</a></div>
          </div>
        </div>
        <!--Product Show --> 
        
      </div>
      <br class="clear">
    </div>
    <div class="bdysec_right">
      <div style="display:none" id="loadiddiv"></div>
      <div class="fashn_rit event">
        <h2>Other CT Festival Attractions</h2>
        <?php if($monetizer_event){
                                foreach($monetizer_event as $me){
                            ?>
        <a href="<?php echo base_url();?>dashboard/coCreatorWeek/<?php echo $me['id'];?>">
        <h3><?php echo $me['title'];?></h3>
        <p><img width="105" height="105" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/'.$me['image'];?>"> <?php echo $me['description'];?></p>
        </a>
        <hr class="hrr">
        <? }}?>
      </div>
      <br class="clear">
    </div>
  </div>
  <br class="clear">
  <div class="bottnew_offerbanner"> <img src="<?php echo base_url();?>images/bottom-offer.png" width="" height="" alt="" /> </div>
</div>
</div>
<!--footer section-->
<div class="footer">
  <?php $this->load->view("ct_catalog/CT_add", $result); ?>
  <?php $this->load->view("ct_catalog/CT_footer", $result);?>
</div>
<!--footer section end-->
 <script type="text/javascript">
$(function(){
  $('.crsl-items').carousel({
    visible: 5,
    itemMinWidth: 170,
    itemEqualHeight: 166,
    itemMargin: 9,
  });
  
  $("a[href=#]").on('click', function(e) {
    e.preventDefault();
  });
});
</script>
</body>
</html>
