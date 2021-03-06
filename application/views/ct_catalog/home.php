<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CT</title>
<link rel="shortcut icon" href="<?php echo base_url();?>images/headerlogo.png" type="image/x-icon"/>
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css" />
<!-- <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
 <script src="<?php echo base_url();?>js/jquery.slides.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>js/responsiveCarousel.min.js"></script>
 <script src="<?php echo base_url();?>js/jquery.newstape.js"></script>
  <script>
    $(function() {
      $('#slides').slidesjs({
        width: 1000,
        height: 385,
		 play: {
          active: true,
          auto: true,
          interval: 4000,
          swap: true
        }
      });
    });
  </script>
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
<script>
    $(function() {
        $('.newstape').newstape();
    });
	
// show popup div for CT partner video 
function showCT_PartnerVideo(path){
	$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
}
	
</script>
  <style>
    /* Prevent the slideshow from flashing on load */
    #slides {
     position:relative;
    }

    /* Center the slideshow */
    .container {
      margin: 0 auto
    }

    /* Show active item in the pagination */
    .slidesjs-pagination .active {
      color:red;
    }

    /* Media quires for a responsive layout */
    .slidesjs-previous.slidesjs-navigation, .slidesjs-next.slidesjs-navigation,   .slidesjs-stop.slidesjs-navigation, .slidesjs-play.slidesjs-navigation{display:none !important;}
   .slidesjs-pagination{position:absolute; bottom:9px; left:21px;}
   .slidesjs-pagination-item {
    float: left;
    position: relative;
    z-index: 99999;
    width:12px; height:12px; background:#fff; border:1px solid #5b626c;
    margin-right:12px; font-size:12px; line-height:12px !important; color:#fff !important;
}
.slidesjs-pagination a{color:#fff !important;}
.slidesjs-pagination a.active{background:#e5082e; display:block; width:12px; height:12px; padding:0; cursor:pointer; color:red !important;}


.newstape {
  height: 270px;
  overflow: hidden;
}

.newstape-content {
  position: relative;
}
.fancybox-overlay{z-index: 999999 !important;}
 </style>
}
</head>

<body>
<div class="container">
<div class="wrapper">
<!--header section-->
<div class="header">
<?php $this->load->view("ct_catalog/CT_header", $result); ?>
<?php $this->load->view("ct_catalog/CT_banner", $result);?>
</div>
<!--header section end-->

<!--middle body section-->
<div class="mid-body">
<?php //$this->load->view("ct_catalog/career-monetizer", $result);?>

<div class="middle-panal">
<div class="right-video newstartnowvid">
      <!--<div class="video-section">
      <h2>Partner With Me On CT</h2>
	  <?php if($CT_partnerVideo[0]['content_image']!=""){ 
	  ?> <img onClick="showCT_PartnerVideo('<?php //echo $CT_partnerVideo[0]['path']; ?>');" src="<?php //echo $this->config->item('gbe_base_url').'adminuploads/level_wise_images/'.$CT_partnerVideo[0]['content_image']; ?>" width="445" height="203" alt="" /> 
	  <?php  }else{?>
      <img onClick="showCT_PartnerVideo('<?php //echo $CT_partnerVideo[0]['path']; ?>');" src="<?php //echo base_url();?>images/video-pic.png" width="445" height="203" alt="" />
	  <?php } ?>
      </div>
      <div class="join-nowsec">
      <h2>Join Now To Raise Your Income</h2>
      <form action="<?php //echo base_url();?>dashboard/ct_signup" method="post" enctype="multipart/form-data">
		  <input name="email" type="text" value="EnterYour Email" />
		  <input type="hidden" name="parentID" value="<?php //echo $ct_userID; ?>">
		  <input name="submit" type="submit" value="start" />
		   <br class="clr" />
	  </form>
     
      </div>-->
      <?php 
/*echo "<pre>";
print_r($admin_catalog_configArray);
echo "</pre>";*/
      ?>
      <div class="ap-bbstart">
      <div class="catlog_vidleft">
      <h3>Get Promotion For Your<br />
Brand, Business or Service</h3>
<h4>Create An  ‘A.P’<br />
Marketing Campaign</h4>
<a href="<?php echo base_url(); ?>dashboard/apdashboard/" target="_blank">Start Now</a>
      </div>
      <a id="adVideoLinkId01" name="<?php echo $admin_catalog_configArray[0]['youtubeurl_ap']; ?>">
      <div class="step-vidpicnew">
      <img src="<?php echo base_url(); ?>images/vid-thuum.png" alt="" class="big" >
      <img src="<?php echo base_url(); ?>images/video-playicon.png" alt="" class="play-icon"  >
      </div>
      </a>
    </div>
<div class="ap-bbstart">

      <div class="catlog_vidleft">
      <h3>Earn Money For:<br />
Watching & Sharing Our  ‘Ads’</h3>
<h4 style="padding: 20px 0;">Create A  ‘ B.B’ Account Today</h4>
<a href="<?php echo base_url(); ?>myaccount" target="_blank">Start Now</a>
      </div>
      <a id="adVideoLinkId02" name="<?php echo $admin_catalog_configArray[0]['youtubeurl_bb']; ?>">
      <div class="step-vidpicnew">
      <img src="<?php echo base_url(); ?>images/vid-thuum.png" alt="" class="big" >
      <img src="<?php echo base_url(); ?>images/video-playicon.png" alt="" class="play-icon"  >
      </div>
      </a>
</div>      
</div>
       <h2 class="event-title">CT Festival Attractions</h2>
      <div class="event-sec">
     
<div class="newstape">
   <div class="newstape-content">
    <?php if($monetizer_event){
                                foreach($monetizer_event as $me){
                            ?>
       <div class="exclusive-sev">
      <a href="<?php echo base_url();?>dashboard/coCreatorWeek/<?php echo $me['id'];?>" style="display:block; overflow:hidden;"><img src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/'.$me['image']; ?>" width="202" height="171" alt="" />
      <h2><?php echo $me['title']; ?></h2>
      <p><?php echo  substr($me['description'], 0, 100); ?>...</p></a>
       <br class="clr" /></div><br class="clr" />
		  <? }
		  }
		  ?>
		 
      <!-- <div class="exclusive-sev">
      <img src="<?php echo base_url();?>images/thum1.png" width="202" height="171" alt="" />
      <h2>Exclusive Arts</h2>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</p>
      </div>
       <div class="exclusive-sev">
      <img src="<?php echo base_url();?>images/thum1.png" width="202" height="171" alt="" />
      <h2>Exclusive Arts</h2>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</p>
      </div>
       <div class="exclusive-sev">
      <img src="<?php echo base_url();?>images/thum1.png" width="202" height="171" alt="" />
      <h2>Exclusive Arts</h2>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</p>
      </div>-->
	  
	  </div>
      </div>
      </div>
	  <?php 
	  //PRINT_R($category_details);EXIT;
	  if($category_details){
		  foreach($category_details as $cd){
	   ?>
		  <div class="exclusive-sev">
		  <a href="<?php echo base_url();?>dashboard/category_detail/<?php echo $cd['id'];?>" ><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/productPagesImg/<?php echo $cd['image'];?>" width="202" height="171" alt="" /></a>
		  <h2><a href="<?php echo base_url();?>dashboard/category_detail/<?php echo $cd['id'];?>"><?php echo $cd['title'];?></a></h2>
		  <p><?php echo  substr($cd['description'], 0, 155);?>...</p>
		  </div>
	  <?php } }?>
  
  <br class="clr" /><br />

</div>
</div>
<!-- middle body section end-->
</div>
<!--footer section-->
<div class="footer">
<?php $this->load->view("ct_catalog/CT_add", $result); ?>
<?php $this->load->view("ct_catalog/CT_footer", $result);?>
</div>
<!--footer section end-->

</div>
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

});

</script>
</body>
</html>
