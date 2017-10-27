<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Ads | Community
    </title>
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>css/event.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>css/carosel.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js">
    </script>
    <link href="<?php echo base_url(); ?>js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>js/datetimepicker/jquery.datetimepicker.js">
    </script>
    <script>
      var rlink='<?php echo base_url()."ads";?>';
      //alert(rlink);
      $(document).ready(function(){
        $(".ulLevel1").unbind().bind("click", function(){
          var id = $(this).attr("id");
          var hasChild = $(this).attr("name");
          if(hasChild > 0){
            $("#ul1_"+id).slideToggle('slow');
            if($(this).text() == '-'){
              $(this).text('+');
            }
            else{
              $(this).text('-');
            }
          }
        }
                                    );
        $(".ulLevel2").unbind().bind("click", function(){
          var id = $(this).attr("id");
          var hasChild = $(this).attr("name");
          if(hasChild > 0){
            $("#ul2_"+id).slideToggle('slow');
            if($(this).text() == '-'){
              $(this).text('+');
            }
            else{
              $(this).text('-');
            }
          }
        }
                                    );
        $(".ulLevel3").unbind().bind("click", function(){
          var id = $(this).attr("id");
          var hasChild = $(this).attr("name");
          if(hasChild > 0){
            $("#ul3_"+id).slideToggle('slow');
            if($(this).text() == '-'){
              $(this).text('+');
            }
            else{
              $(this).text('-');
            }
          }
        }
                                    );
        $(".expbutton").click( function(e){
          var aid=$(this).attr("name");
          //var url1='http://192.168.2.160/communityTreas2/ads/explore_taks';	
          // var url1='https://www.communitytreasures.co/ads/explore_taks';
          var baseurllink = "<?php echo base_url(); ?>";
          var url1=baseurllink+'ads/explore_taks';
          $.post( url1, {
            adid: aid }
                )
            .done(function( data ) {
            // alert( "Data Loaded: " + data );
          }
                 );
          /*$.ajax({
	  url: url1,
	  method: "POST",
	  data: { adid : id },
	  dataType: "html"
	});*/
          e.preventDefault();
          var adurl = $(this).attr("href");
          var bxhgt = $(".boxwrap").height();
          $(".main_container").hide();
          $(".boxwrapdiv").append('<iframe id="adfrem" src="'+ adurl +'?autoplay=1"  style="width:100%;" height="550" scrolling="auto" title="adfreme"></iframe> ');
          //$(".boxwrap").append('<iframe width="100%" height="'+ bxhgt +'" src="'+ adurl +'"></iframe>');
          //$(".boxwrap").append('<iframe width="420" height="345" src="https://www.youtube.com/embed/FIRT7lf8byw"></iframe>');
          $('a.crosclose').html('<span class="back12">Loading....</span>');
          $("a.crosclose").removeAttr("href");
          /*########### START #########*/
          var count=12;
          var counter=setInterval(timer, 1000);
          //1000 will  run it every 1 second
          function timer()
          {
            count=count-1;
            if (count <= -1)
            {
              clearInterval(counter);
              return;
            }
            document.getElementById("timer").innerHTML=count;
            // watch for spelling
          }
          /*########### END ##########*/
          setTimeout(myBackFunction, 12000);
          $(".crosclose").click( function(e){
            e.preventDefault();
            $("#adfrem").remove();
            $('span.crosclose').remove();
            $('a.crosclose').html('<span>Watch Ad</span>');
            $(".crosclose a").attr("href", rlink);
          }
                               );
        }
                             )
      }
                       );
      function refres1() {
        location.replace(rlink)
      }
      function myBackFunction() {
        $('a.crosclose').html('<a href="#" onclick="refres1()"><span class="back">Back</span></a>');
      }
      function showDiv()
      {
        alert("This functionality will start from 1st of February.");
      }
    </script>
    <script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4">
    </script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
    <script>
      $(document).ready(function(){
        $("#videoLinkId").click(function() {
          var path = $(this).attr("name");
          $.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
        }
                               );
      }
                       );
      //watch Event Video 
      function openVideoDivToPlay(path){
        $.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
      }
    </script>
    <script>
      $(document).ready(function(){
        $("#ad_video").click(function() {
          $.fancybox.open('<iframe width="660" height="415" src="<?php echo $youtubeurl;?>" frameborder="0" allowfullscreen></iframe>');
        }
                            );
      }
                       );
    </script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
    <style type="text/css">
      .adsnewtab{
      }
      .adsnewtab .left-logo{
        width:202px;
        float:left;
        text-align:center;
      }
      .adsnewtab .right-exp {
        border-left: 1px solid #bcbcbc;
        float: right;
        padding-left: 25px;
        width: 202px;
        text-align:center;
        position: relative;
        height: 221px;
      }
      .adsnewtab .right-exp h3 {
        color: #a80fa8;
        font-family: Arial,Helvetica,sans-serif;
        font-size: 18px;
        margin-top: 20px;
        text-transform: uppercase;
      }
      .adsnewtab .right-exp p {
        color: #5c5c5c;
        font-family: Arial,Helvetica,sans-serif;
        font-size: 14px;
        line-height: 22px;
        /*min-height:119px;*/
      }
      .adsnewtab .right-exp a.expbuttonlink {
        background: #a80fa8;
color: #fff;
display: block;
font-family: Arial,Helvetica,sans-serif;
font-size: 17px;
line-height: 30px;
margin-left: -24px;
margin-right: 0;
position: absolute;
bottom: 33px;
width: 100%;

      }
      .adsnewtab .right-exp a.expbutton {
        background: #a80fa8;
        color: #fff;
        display: block;
        font-family: Arial,Helvetica,sans-serif;
        font-size: 17px;
        line-height: 30px;
        margin-left: -24px;
        margin-right: -3px;
        text-align: center;
        text-transform: uppercase;
        position: absolute;
        border: ;
        bottom: 0;
        width: 100%;
      }
      .left-logo a.expbutton img{height:151px;}
      .adsnewtab .right-exp a.visitedbutton {
        background: #b7b7b7 none repeat scroll 0 0;
        bottom: 1px;
        color: #fff;
        display: block;
        font-family: Arial,Helvetica,sans-serif;
        font-size: 17px;
        line-height: 30px;
        margin-left: -24px;
        margin-right: -3px;
        position: absolute;
        text-align: center;
        text-transform: uppercase;
        width: 100%;
      }
      /*.adsnewtab .right-exp a.visitedbutton {
      background: #B7B7B7;
      color: #fff;
      display: block;
      font-family: Arial,Helvetica,sans-serif;
      font-size: 17px;
      line-height: 30px;
      margin-left: -24px;
      margin-right: -3px;
      text-align: center;
      text-transform: uppercase;
      }*/
      .adsnewtab ul li {
        background: #fff none repeat scroll 0 0;
        border: 1px solid #b3b3b3;
        float: left;
        height: 219px;
        margin-bottom: 10px;
        margin-left: 10px;
        padding: 4px;
        width: 434px;
      }
      .adsnewtab ul li p.icon-brands {
        background: #dedede none repeat scroll 0 0;
        margin-left: -3px;
        margin-right: -3px;
        padding-left: 10px;
        text-align:left;
      }
      .adsnewtab a img {
        height: 20px;
        margin-top: 6px;
        margin-right: 9px;
      }
      .add-videoban {
        background: #fefefe none repeat scroll 0 0;
        border: 1px solid #e8e5e5;
        margin-bottom: 20px;
        margin-left: 10px;
        margin-right: 10px;
        padding: 15px;
      }
      .add-videoban h4{
        float: left;
        display:inline !important;
      }
      .add-videoban h4 span {
        color: #4e4e4e;
        display: block;
        float: left;
        font-family: arial;
        font-size: 20px;
        font-weight: normal;
        line-height: 24px;
        margin-top:10px;
      }
      .add-videoban p {
        float: right;
        font-family: arial;
        font-size: 17px;
        font-weight: normal;
        line-height: 20px;
        width: 50%;
        padding-top:5px;
      }
      .add-videoban img {
        margin-left: 110px;
      }
      .add-bannerbott {
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 20px;
        text-align: center;
      }
      .add-bannerbott a img{
        width:auto !important;
        height:auto !important;
      }
      .add-videoban a img{
        width:auto !important;
        height:auto !important;
      }
      .add-bannerbott h3 {
        color: #fff;
        font-family: arial;
        font-size: 26px;
        font-weight: normal;
        line-height: 26px;
      }
      .watchvideo-popuptab{
        display:none;
      }
      .slider, #slider1{
        margin: 0 auto;
        width: 902px !important;
        height: 139px !important;
        border: 0;
        border-radius:0;
        box-shadow: 0;
      }
      .slider li, #slider1 li{
        border: 0 none;
        height: 139px !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 902px !important;
      }
      .slider img{
        width: 902px !important;
        height: 139px !important;
      }
      .left-logo img{
        height:157px;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <?php $this->load->view('header',$result);?>
      <?php $this->load->view('nav_header',$result);?>
      <!--header end-->
      <div class="boxwrap" style="min-height:800px;"> 
        <div class="boxwrapdiv">
        </div>
        <div class="main_container">
          <div class="adsnewtab">
            <div class="add-videoban">
              <a href="javascript:void(0)" id="ad_video">
                <h4>
                  <span>Click Explore & 
                    <br>
                    Watch ALL 12 Ads
                  </span>
                  <img src="<?php echo base_url(); ?>images/video-playicon.png" alt=""  >
                </h4>
              </a>
              <p>if you find an offer you want, or if you wish to enter
                your business into one of our partnership associations
                <br>
                Please mail us or call CT Switchboard on
              </p>
              <br class="clear">
            </div>
            <ul>
              <?php
				if(count($list_music) > 0){
				foreach($list_music as $key=>$valList_music){ 
				$className = "table-gray";
				if ($key % 2 == 0) {
				$className = "";
				}
				?>
				 <li>
                <div class="left-logo">
                   <?php if($valList_music->visited_status_music == 0) { ?>

                    <a  name="<?php echo $valList_music->id;?>" href="<?php echo $valList_music->url;?>" class="expbutton">
                 
                  <?php if($valList_music->ad_image!="") {?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/<?php echo $valList_music->ad_image;?>">
                  <?php } else { ?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/1.png">
                  <?php } ?> </a>

                   <?php } else { ?>

                    <?php if($valList_music->ad_image!="") {?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/<?php echo $valList_music->ad_image;?>">
                  <?php } else { ?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/1.png">
                  <?php } ?>

                    <?php } ?>
                  
                  <p class="icon-brands">
                    <?php if($valList_music->facebook_url!="") {?>
                    <a href="<?php echo $valList_music->facebook_url;?>" target="_blank">
                      <img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/brand-facebook-inactive.png">
                    <?php } ?>
                    <?php if($valList_music->youtube_url!="") {?>
                    <a href="<?php echo $valList_music->youtube_url;?>" target="_blank">
                      <img src="http://www.communitytreasures.co/images/brand-youtube.png" alt="" />
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/brand-youtube-inactive.png" width="20px;" height="20px;">
                    <?php } ?>
                    <?php if($valList_music->twitter_url!="") {?>
                    <a href="<?php echo $valList_music->twitter_url;?>" target="_blank">
                      <img alt="" src="http://www.communitytreasures.co/images/twitter_new.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/twitter_new-inactive.png">
                    <?php } ?>
                    <?php if($valList_music->inst_url!="") {?>
                    <a href="<?php echo $valList_music->inst_url;?>" target="_blank">
                      <img alt="" src="http://www.communitytreasures.co/images/inst-icon.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/inst-icon-inactive.png">
                    <?php } ?>
                    <?php if($valList_music->skype_id!="") {?>
                    <a href="skype:<?php echo $valList_music->skype_id;?>?call">
                      <img alt="" src="http://www.communitytreasures.co/images/skype.png">
                    </a>
                    <?php }else {  ?>
                    <img alt="" src="http://www.communitytreasures.co/images/skype-inactive.png">
                    <?php } ?>
                    <?php if($valList_music->gplus_url!="") {?>
                    <a href="<?php echo $valList_music->gplus_url;?>" target="_blank">  
                      <img alt="" src="http://www.communitytreasures.co/images/gplus1.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/gplus1-inactive.png" width="20px;" height="20px;">
                    <?php } ?>
                    
                    <?php if($valList_music->pdf_upload!="") {?>
                    <a href="http://globalblackenterprises.com/adminuploads/pdf_upload/download.php?file=<?php echo $valList_music->pdf_upload; ?>">  
                      <img alt="" src="http://www.communitytreasures.co/images/download.png" width="42px;">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/download-inactive.png" width="42px;" height="20px;">
                    <?php } ?>
                    <?php if($valList_music->pinterest_url!="") {?>
                    <a href="<?php echo $valList_music->pinterest_url;?>" target="_blank">  
                      <img alt="" src="http://www.communitytreasures.co/images/pin.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/pin-inactive.png" width="20px;" height="20px;">
                    <?php } ?>
                    <?php if($valList_music->another_url!="") {?>
                    <a href="<?php echo $valList_music->another_url;?>" target="_blank">
                      <img alt="" src="http://www.communitytreasures.co/images/mag-small.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/mag-small-inactive.png">
                    <?php } ?>
					
						<?php if($valList_music->linked_in_url!="") {?>
					<a href="<?php echo $valList_music->linked_in_url;?>" target="_blank">
					  <img alt="" src="http://www.communitytreasures.co/images/linkedin.png">
					</a>
					<?php } else { ?>
					<img alt="" src="http://www.communitytreasures.co/images/linkedin-inactive.png" width="20px;" height="20px;">
					<?php } ?>
				
					<?php if($valList_music->gmail_link!="") {?>
					<a href="mailto:<?php echo $valList_music->gmail_link;?>">
					  <img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png">
					</a>
					<?php } else { ?>
					<img alt="" src="http://www.communitytreasures.co/images/gmail-icon-inactive.png" width="20px;" height="20px;">
					<?php } ?>
					  </p>
                </div>
                <div class="right-exp">
                  <h3>
                    <?php echo $valList_music->title;?>
                  </h3>
                  <p>
                    <?php echo $valList_music->description; ?>
                  </p>
                  <p>
                     <a  name="<?php echo $valList_music->id;?>" href="<?php echo base_url(); ?>dashboard/category_detail/<?php echo $valList_music->categoryId;?>" class="expbuttonlink" target="_blank">EXPLORE
                  </a>
                  </p>
                  <?php if($valList_music->visited_status_music == 0) { ?>
                  <a  name="<?php echo $valList_music->id;?>" href="<?php echo $valList_music->url;?>" class="expbutton">Watch Ad
                  </a>
                  <?php } else { ?> 
                  <a href="#" class="visitedbutton">Visited
                  </a> 
                  <?php } ?>
                </div>
                <br class="clear">
              </li>
              <?php } 
}else{
?>     
              <?php } ?>
              <?php
			// print_r($list_events);
			if(count($list_events) > 0){
			foreach($list_events as $key=>$valList_events){ 
			$className = "table-gray";
			if ($key % 2 == 0) {
			$className = "";
			}
			?>	  
              <li>
                <div class="left-logo">
                  <?php if($valList_events->visited_status_events == 0) { ?>
                 <a  name="<?php echo $valList_events->id;?>" href="<?php echo $valList_events->url;?>" class="expbutton">
                  <?php if($valList_events->ad_image!="") {?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/<?php echo $valList_events->ad_image;?>">
                  <?php } else { ?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/1.png">
                  <?php } ?></a>
                  <?php } else { ?>
                     <?php if($valList_events->ad_image!="") {?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/<?php echo $valList_events->ad_image;?>">
                  <?php } else { ?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/1.png">
                  <?php } ?>
                    <?php } ?>
                  <p class="icon-brands">
                    <?php if($valList_events->facebook_url!="") {?>
                    <a href="<?php echo $valList_events->facebook_url;?>" target="_blank">
                      <img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/brand-facebook-inactive.png">
                    <?php } ?>
                    <?php if($valList_events->youtube_url!="") {?>
                    <a href="<?php echo $valList_events->youtube_url;?>" target="_blank">
                      <img src="http://www.communitytreasures.co/images/brand-youtube.png" alt="" />
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/brand-youtube-inactive.png" width="20px;" height="20px;">
                    <?php } ?>
                    <?php if($valList_events->twitter_url!="") {?>
                    <a href="<?php echo $valList_events->twitter_url;?>" target="_blank">
                      <img alt="" src="http://www.communitytreasures.co/images/twitter_new.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/twitter_new-inactive.png">
                    <?php } ?>
                    <?php if($valList_events->inst_url!="") {?>
                    <a href="<?php echo $valList_events->inst_url;?>" target="_blank">
                      <img alt="" src="http://www.communitytreasures.co/images/inst-icon.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/inst-icon-inactive.png">
                    <?php } ?>
                    <?php if($valList_events->skype_id!="") {?>
                    <a href="skype:<?php echo $valList_events->skype_id;?>?call">
                      <img alt="" src="http://www.communitytreasures.co/images/skype.png">
                    </a>
                    <?php } else {  ?>
                    <img alt="" src="http://www.communitytreasures.co/images/skype-inactive.png">
                    <?php } ?>
                    <?php if($valList_events->gplus_url!="") {?>
                    <a href="<?php echo $valList_events->gplus_url;?>" target="_blank">  
                      <img alt="" src="http://www.communitytreasures.co/images/gplus1.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/gplus1-inactive.png" width="20px;" height="20px;">
                    <?php } ?>
                    <?php if($valList_events->pdf_upload!="") {?>
                    <a href="http://globalblackenterprises.com/adminuploads/pdf_upload/download.php?file=<?php echo $valList_events->pdf_upload; ?>">  
                      <img alt="" src="http://www.communitytreasures.co/images/download.png" width="42px;">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/download-inactive.png" width="42px;" height="20px;">
                    <?php } ?>
                    <?php if($valList_events->pinterest_url!="") {?>
                    <a href="<?php echo $valList_events->pinterest_url;?>" target="_blank">  
                      <img alt="" src="http://www.communitytreasures.co/images/pin.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/pin-inactive.png" width="20px;" height="20px;">
                    <?php } ?>
                    <?php if($valList_events->another_url!="") {?>
                    <a href="<?php echo $valList_events->another_url;?>" target="_blank">
                      <img alt="" src="http://www.communitytreasures.co/images/mag-small.png">
                    </a>
                    <?php } else { ?>
                    <img alt="" src="http://www.communitytreasures.co/images/mag-small-inactive.png">
                    <?php } ?>
					
				<?php if($valList_events->linked_in_url!="") {?>
				<a href="<?php echo $valList_events->linked_in_url;?>" target="_blank">
				  <img alt="" src="http://www.communitytreasures.co/images/linkedin.png">
				</a>
				<?php } else { ?>
				<img alt="" src="http://www.communitytreasures.co/images/linkedin-inactive.png" width="20px;" height="20px;">
				<?php } ?>
				
				<?php if($valList_events->gmail_link!="") {?>
				<a href="mailto:<?php echo $valList_events->gmail_link;?>">
				  <img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png">
				</a>
				<?php } else { ?>
				<img alt="" src="http://www.communitytreasures.co/images/gmail-icon-inactive.png" width="20px;" height="20px;">
				<?php } ?>
                  </p>
                </div>
                <div class="right-exp">
                  <h3>
                    <?php echo $valList_events->title;?>
                  </h3>
                  <p>
                    <?php echo $valList_events->description; ?>
                  </p>
                  <p>
                    <a  name="<?php echo $valList_events->id;?>" href="<?php echo base_url(); ?>dashboard/category_detail/<?php echo $valList_events->categoryId;?>" class="expbuttonlink" target="_blank">EXPLORE
                  </a>
                  </p>
                  <?php if($valList_events->visited_status_events == 0) { ?>
                  <a  name="<?php echo $valList_events->id;?>" href="<?php echo $valList_events->url;?>" class="expbutton">Watch Ad
                  </a>
                  <?php } else { ?> 
                  <a href="#" class="visitedbutton">Visited
                  </a> 
                  <?php } ?>
                </div>
                <br class="clear">
              </li>
              <?php } 
}else{
?>     
              <?php } ?> 
              <?php
				if(count($list) > 0){
				foreach($list as $key=>$valList){ 
				$className = "table-gray";
				if ($key % 2 == 0) {
				$className = "";
				}
				?>
							  <li>
                <div class="left-logo">
                 <?php if($valList->visited_status == 0) { ?>
                 <a  name="<?php echo $valList->id;?>" href="<?php echo $valList->url;?>" class="expbutton">
                  <?php if($valList->ad_image!="") {?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/<?php echo $valList->ad_image;?>">
                  <?php } else { ?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/1.png>
                   <?php } ?></a>
                   <?php } else { ?>
                       <?php if($valList->ad_image!="") {?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/<?php echo $valList->ad_image;?>">
                  <?php } else { ?>
                  <img alt="" src="http://globalblackenterprises.com/adminuploads/adpost/1.png>
                   <?php } ?>
                    <?php } ?>
                  <p class="icon-brands">
                  <?php if($valList->facebook_url!="") {?>
                 <a href="<?php echo $valList->facebook_url;?>" target="_blank">
                  <img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png">
                 </a>
                <?php } else {?>
                <img alt="" src="http://www.communitytreasures.co/images/brand-facebook-inactive.png">
                <?php } ?>
                <?php if($valList->youtube_url!="") {?>
                <a href="<?php echo $valList->youtube_url;?>" target="_blank">
                  <img src="http://www.communitytreasures.co/images/brand-youtube.png" alt="" />
                </a>
                <?php } else { ?>
                <img alt="" src="http://www.communitytreasures.co/images/brand-youtube-inactive.png" width="20px;" height="20px;">
                <?php } ?>
                <?php if($valList->twitter_url!="") {?>
                <a href="<?php echo $valList->twitter_url;?>" target="_blank">
                  <img alt="" src="http://www.communitytreasures.co/images/twitter_new.png">
                </a>
                <?php } else { ?>
                <img alt="" src="http://www.communitytreasures.co/images/twitter_new-inactive.png">
                <?php } ?>
                <?php if($valList->inst_url!="") {?>
                <a href="<?php echo $valList->inst_url;?>" target="_blank">
                  <img alt="" src="http://www.communitytreasures.co/images/inst-icon.png">
                </a>
                <?php } else { ?>
                <img alt="" src="http://www.communitytreasures.co/images/inst-icon-inactive.png">
                <?php } ?>
                <?php if($valList->skype_id!="") {?>
                <a href="skype:<?php echo $valList->skype_id;?>?call">
                  <img alt="" src="http://www.communitytreasures.co/images/skype.png">
                </a>
                <?php } else {  ?>
                <img alt="" src="http://www.communitytreasures.co/images/skype-inactive.png">
                <?php } ?>
                <?php if($valList->gplus_url!="") {?>
                <a href="<?php echo $valList->gplus_url;?>" target="_blank">  
                  <img alt="" src="http://www.communitytreasures.co/images/gplus1.png">
                </a>
                <?php } else { ?>
                <img alt="" src="http://www.communitytreasures.co/images/gplus1-inactive.png" width="20px;" height="20px;">
                <?php } ?>
                <?php if($valList->pdf_upload!="") {?>
                <a href="http://globalblackenterprises.com/adminuploads/pdf_upload/download.php?file=<?php echo $valList->pdf_upload; ?>">  
                  <img alt="" src="http://www.communitytreasures.co/images/download.png" width="42px;">
                </a>
                <?php } else { ?>
                <img alt="" src="http://www.communitytreasures.co/images/download-inactive.png" width="42px;" height="20px;">
                <?php } ?>
               
                <?php if($valList->pinterest_url!="") {?>
                <a href="<?php echo $valList->pinterest_url;?>" target="_blank">  
                  <img alt="" src="http://www.communitytreasures.co/images/pin.png">
                </a>
                <?php } else { ?>
                <img alt="" src="http://www.communitytreasures.co/images/pin-inactive.png" width="20px;" height="20px;">
                <?php } ?>
                <?php if($valList->another_url!="") {?>
                <a href="<?php echo $valList->another_url;?>" target="_blank">
                  <img alt="" src="http://www.communitytreasures.co/images/mag-small.png">
                </a>
                <?php } else { ?>
                <img alt="" src="http://www.communitytreasures.co/images/mag-small-inactive.png">
                <?php } ?>
				
				<?php if($valList->linked_in_url!="") {?>
				<a href="<?php echo $valList->linked_in_url;?>" target="_blank">
				  <img alt="" src="http://www.communitytreasures.co/images/linkedin.png">
				</a>
				<?php } else { ?>
				<img alt="" src="http://www.communitytreasures.co/images/linkedin-inactive.png" width="20px;" height="20px;">
				<?php } ?>
				
				<?php if($valList->gmail_link!="") {?>
				<a href="mailto:<?php echo $valList->gmail_link;?>">
				  <img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png">
				</a>
				<?php } else { ?>
				<img alt="" src="http://www.communitytreasures.co/images/gmail-icon-inactive.png" width="20px;" height="20px;">
				<?php } ?>
              </p>
          </div>
          <div class="right-exp">
            <h3>
              <?php echo $valList->title;?>
            </h3>
            <p>
              <?php echo $valList->description;?>
            </p>
            <p>
             <a  name="<?php echo $valList->id;?>" href="<?php echo base_url(); ?>dashboard/category_detail/<?php echo $valList->categoryId;?>" class="expbuttonlink" target="_blank">EXPLORE
            </a>
            </p>
            <?php if($valList->visited_status == 0) { ?>
            <a  name="<?php echo $valList->id;?>" href="<?php echo $valList->url;?>" class="expbutton">Watch Ad
            </a>
            <?php } else { ?> 
            <a href="#" class="visitedbutton">Visited
            </a> 
            <?php } ?>
          </div>
          <br class="clear">
          </li>
        <?php } 
}else{
?>
        No Records Found In this Category! 
        <?php } ?>
        </ul>
      <br class="clear">
      <div class="add-bannerbott">
        <div class="slider">
          <ul id="slider1">
            <?php
if(count($banner_list) > 0){
foreach($banner_list as $key=>$BannerList){ 
?>
            <li>
              <a hrerf="<?php echo $BannerList->banner_url; ?>">
                <img alt="<?php echo $BannerList->banner_title; ?>" src="http://globalblackenterprises.com/adminuploads/adpost/banner/<?php echo $BannerList->banner_image; ?>">
              </a>
            </li>
            <?php } 
}else{
?>
            <?php } ?>
          </ul>
        </div>
      </div>
      <br class="clear">
    </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.cycle.all.js">
</script> 
<script language="javascript">
  $(document).ready(function(){
    $('#slider1') .cycle({
      fx: 'fade', //'scrollLeft,scrollDown,scrollRight,scrollUp',blindX, blindY, blindZ, cover, curtainX, curtainY, fade, fadeZoom, growX, growY, none, scrollUp,scrollDown,scrollLeft,scrollRight,scrollHorz,scrollVert,shuffle,slideX,slideY,toss,turnUp,turnDown,turnLeft,turnRight,uncover,ipe ,zoom
      speed:  'slow', 
      timeout: 2000 
    }
                        );
  }
                   );
</script>
</body>
</html>
