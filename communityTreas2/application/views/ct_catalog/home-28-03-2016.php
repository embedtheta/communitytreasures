<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CT</title>
<link rel="shortcut icon" href="<?php echo base_url();?>images/headerlogo.png" type="image/x-icon"/>
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css" />
 <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
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
 </style>
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
<?php $this->load->view("ct_catalog/career-monetizer", $result);?>

<div class="middle-panal">
<div class="right-video">
      <div class="video-section">
      <h2>Partner With Me On CT</h2>
      <img src="<?php echo base_url();?>images/video-pic.png" width="445" height="203" alt="" />
      </div>
      <div class="join-nowsec">
      <h2>Join Now To Raise Your Income</h2>
      <form action="<?php echo base_url();?>dashboard/ct_signup" method="post" enctype="multipart/form-data">
		  <input name="email" type="text" value="EnterYour Email" />
		  <input name="submit" type="submit" value="start" />
		   <br class="clr" />
	  </form>
     
      </div>
      </div>
       <h2 class="event-title">Co-Creators Week <span>19 - 23 April 2016</span></h2>
      <div class="event-sec">
     
<div class="newstape">
   <div class="newstape-content">
    <?php if($monetizer_event){
                                foreach($monetizer_event as $me){
                            ?>
       <div class="exclusive-sev">
      <img src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/'.$me['image']; ?>" width="202" height="171" alt="" />
      <h2><?php echo $me['title']; ?></h2>
      <p><?php echo  substr($me['description'], 0, 100); ?>...</p>
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
	  <?php if($category_details){
		  foreach($category_details as $cd){
	   ?>
		  <div class="exclusive-sev">
		  <a href="<?php echo base_url();?>dashboard/category_detail/<?php echo $cd['id'];?>" ><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/productPagesImg/<?php echo $cd['image'];?>" width="202" height="171" alt="" /></a>
		  <h2><a href="<?php echo base_url();?>dashboard/category_detail/<?php echo $cd['id'];?>"><?php echo $cd['title'];?></a></h2>
		  <p><?php echo  substr($cd['description'], 0, 155);?>...</p>
		  </div>
	  <?php } }?>
  
  <br class="clr" />
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
</body>
</html>
