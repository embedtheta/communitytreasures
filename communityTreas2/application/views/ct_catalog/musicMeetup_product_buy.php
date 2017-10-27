<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CT Product</title>
<link rel="shortcut icon" href="<?php echo base_url();?>images/headerlogo.png" type="image/x-icon"/>
<link href="<?php echo base_url();?>css/stylesheet_CT_Affro.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css" />
 <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
 <script src="<?php echo base_url();?>js/jquery.slides.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>js/responsiveCarousel.min.js"></script>
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

//play music file
function play() {
    var audio = document.getElementById('audio1');
    if (audio.paused) {
        audio.play();
    }else{
        audio.pause();
        audio.currentTime = 0
    }
}

$(document).ready(function() {
$(".watchOfferVideo").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});

// signup check 
	$("#submitId").click(function(e) {
		var email = $("#signUpEmailId").val();
		var error = emailValid(email);
		if(error != ""){
			$.fancybox.open(error);
			$("#signUpEmailId").focus();
        	return false;
		}else{
			return true;
		}
    });
    <?php if(isset($msg)){?>
        $.fancybox.open('<?php echo $msg;?>');
    <?php } ?>
	
	
});
//watchMoneVideo 
function openVideoDivToPlay(path){
	$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		
}
// show popup div for CT partner video 
function showCT_PartnerVideo(path){
	$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
}


// show popup form added by SB on 10-03-2016
function showPopUpForm(){
	//alert('show form ');
	if($('#contactDivId').html()!=""){
		$.fancybox.open($('#contactDivId').html());
		
	}else{
		$.fancybox.open('You have already send a mail');
	}
	
}
function checkNSendMail(){
	
	$('#contactDivId').html('');
	// check the values not blank
	senderEmail = $("#senderEmail").val();
	mailContent = $("#mailContent").val();
	moneMailId  = $("#moneMailId").val();
	moneTypeId  = $("#moneTypeId").val();
	//alert($("#senderEmail").val()+'============='+senderEmail);
	if(senderEmail == ""){
		
		alert('Please enter your email');
	}
	if(mailContent==""){
		
		alert('Please enter your Message');
	}
	if(senderEmail != "" && mailContent != ""){
		
		//then send mail
		$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/mailToMonetizer", 
			 data: "senderEmail="+senderEmail+"&mailContent="+mailContent+"&moneMailId="+moneMailId+"&moneTypeId="+moneTypeId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	
						
						$("#msgDivId").html('mail Send successfully');
						$('#senderEmail').val('');						
						$('#mailContent').val('');					
					}
					else{
						alert('some error ');
					}
				  }
			  });
	}
	 
}
function clearFormValue(){
	// clear the value & close teh fancy box
	$('#senderEmail').val('');
	$('#mailContent').val('');
	$("#msgDivId").html('');
	 $.fancybox.close();
	
}
</script>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "7f24bd6e-6070-492a-887f-9e11c2c66f1a", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
</head>
<body>
<div class="ct_buty">
	<div class="ct_buty_hdr">
    <div class="wraper">
    	<!--header section-->
<div class="header">
<?php $this->load->view("ct_catalog/CT_header", $result); ?>
</div>
<!--header section end-->
        <br class="clear">
    </div>
    </div>    
	<div class="ct_buty_bdy">
    <div class="wraper">
    	<h2 class="rele"><?php  if($moneType==4){ ?>Musicians <?php } else if($moneType==2){ ?>Meet Ups Classes Facebook Groups ETC <?php } ?></h2>
        <div class="my_top_sec">
        	<div class="left-top">
            <div class="my_top_sec_left">
            <img alt="" src="<?php echo $this->config->item('gbe_base_url');?>/useruploads/<?php echo $monetizerDetail[0]['profile'];?>">
            	<div class="kachemnt">
                <h2><?php echo $monetizerDetail[0]['firstName']." ".$monetizerDetail[0]['lastName']; ?></h2>
                	
                    <div class="cntct_dtl">
					<!--<a href="<?php echo $monetizerDetail[0]['webUrl'];?>" target="_blank"><?php echo $monetizerDetail[0]['webUrl'];?></a>
                    <a href="<?php echo $monetizerDetail[0]['emailID'];?>"><?php echo $monetizerDetail[0]['emailID'];?></a>
                    <span class="cle"><?php echo $monetizerDetail[0]['phone'];?></span>-->
					<input type="button" name="mailPopUp" onClick="showPopUpForm()" value="Send Mail" >
					</div>
					
                    <div class="shres">
                    	<!--<a href="#">Share</a>-->
						
						<span class='st_sharethis_hcount' displayText='ShareThis'></span>
<!--<span class='st_facebook_hcount' displayText='Facebook'></span>
<span class='st_twitter_hcount' displayText='Tweet'></span>
<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
<span class='st_pinterest_hcount' displayText='Pinterest'></span>-->

                    </div>
                </div>
            </div>
            <br class="clear">
            <div class="left-download-banner">
           <h2> <span>My Special Offer</span>
           Exclusively<br>
           on CT</h2>
           <br class="clear"/>
             <div style="text-align:center;"><a class="watchOfferVideo" name="<?php echo $ctBrochure[0]['brochureVideo'];?>"  href="javascript:void(0)"><img alt="" src="<?php echo base_url();?>/images/video-button.png"></a></div>
        <p><?php echo $ctBrochure[0]['brochureMsg']; ?><p>
          <a target="_blank" href="<?php echo base_url();?>dashboard/downloadBrochure/?brochureFile=<?php echo $ctBrochure[0]['brochureImage']; ?>" class="download-button">Download</a>
            </div>
            </div>
            <div class="my_top_sec_rit">
        <div class="name_banner">
		<?php if($bannerDetail[0]['bannerImage']!=""){?>
  
        
		<img src="<?php echo $this->config->item('gbe_base_url');?>CT_sponcer_img/<?php echo $bannerDetail[0]['bannerImage']; ?>" alt="">
		<?php }else{
			?>
                  <h2 class="nomgname"><?php echo $bannerDetail[0]['bannerTitle']; ?></h2>
			<img src="<?php echo base_url();?>/images/nam_bnr.jpg" alt="">
			<?php
		}?>
          <!--<h2>NAME or BANNER</h2>-->
        </div>
        <div class="meet_left">
          <div class="wel_se"><h3>Welcome, <?php echo $monetizerProfile[0]['artistName'];?> !</h3>
          <p><?php echo $monetizerProfile[0]['aboutMe'];?></p></div>
		 <?php if($moneType==4){?>
          <div class="my_musics">
            <h3>My Music</h3>
			 <?php if(count($CT_product) > 0){
						$fileName = '';				 
                            foreach($CT_product as $cp){
								$fileName = $this->config->item('gbe_base_url')."topsixproduct/".$cp['productSpecificFile'];
						  ?>          
            <div class="my_musics_inr">
            	<!--<div class="add_btn"><audio id="audio1" src="<?php echo $this->config->item('gbe_base_url');?>CT_sponcer_img/Steam_Engine-John-1826274710.mp3"></audio><img src="<?php echo base_url();?>/images/play.png" onClick="play()" alt=""><img src="<?php echo base_url();?>/images/add.png" alt=""></div>-->
                <div class="add_btn"><img src="<?php echo base_url();?>images/play.png" onClick="OpenPlayer('<?php echo $fileName;?>');" alt=""><!--<img src="<?php //echo base_url();?>images/add.png" alt="">--></div><div class="trce"><p class="ct_music_productname"><?php echo $cp['productName']; ?></p><p class="ct_music_price">$<?php echo $cp['productPrice']; ?></p></div>
                <div class="shop"><img onClick="showTicketDiv()" src="<?php echo base_url();?>images/shoping_cart.png" alt=""></div>
                <br class="clear">
            </div>
			
			
			<?php }} else {?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'topsixproduct/no-music.png';?>">
				<?php }?>
          <div id="productPlayer" style="display:none;" >
			<div id="playerzpumcZwzBZKD" > 
			</div><button type="button" class="close" onClick="stopPlayer()";><span class="sr-only" id="popCloseeee">Close</span></button>
          
          </div> 
		  
		  
		  
          </div>
          <div class="meet_nxt gt_by gig">
            <h3>Next Gig / Live Show</h3>
            <div class="get_buy">
              <div class="dates"><span>JUL</span> <b>9</b> <strong>SAT</strong> </div>
              <div class="milst"><strong>Milton Keynes Bowl</strong>
                <p>Milton Keynes, GB <span>12:00</span></p>
                <b>$10</b></div>
                          </div>
            <a href="#">Buy Now</a><br class="clear">
			<a href="<?php echo base_url();?>/dashboard/Music_buy_demo">Click</a><br class="clear">
          </div>
		  <?php }  else if($moneType==2){ ?>
		  
		   <?php if(count($CT_product) > 0){
						$fileName = '';				 
                            foreach($CT_product as $cp){
								$newStDt ='';
								if($cp['eventDate']!=""){
									$date = date_create($cp['eventDate']);
									$newDtFormat = date_format($date,"M-j-D");
									$newDtArr = explode('-' ,$newDtFormat);
									$newStDt = '<span>'.$newDtArr[0].'</span> <b>'.$newDtArr[1].'</b> <strong>'.$newDtArr[2].'</strong>';
								}
								$fileName = $this->config->item('gbe_base_url')."topsixproduct/".$cp['productFile'];
						  ?>
		  <div class="meet_nxt">          
            
            <div class="meet_nxt gt_by">
            <div class="nxt_img">
			<?php if($cp['productFile']!=''){?>
			<img src="<?php echo $fileName;?>" alt="" height="100px" width="130px">
			<?php } else { ?>
			<img alt="" src="<?php echo $this->config->item('gbe_base_url').'topsixproduct/no-music.png';?>">
			<?php } ?>
			
             <!-- <p>Image Uploaded By The User</p>-->
            </div>
            <h3>Get Tickets</h3>
            <div class="get_buy">
              <div class="dates"><?php echo $newStDt; ?></div>
              <div class="milst"><strong><?php echo $cp['productName']; ?></strong>
                <!--<p></p>-->
<b>$<?php echo $cp['productPrice']; ?></b></div>
<a href="javascript:void(0)" onClick="showPaymentDiv()">Buy Now</a>
              <br class="clear">
            </div>
            
          </div>
          </div>		 
			          <br class="clear">
			
			
		  <?php }} else {?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'topsixproduct/no-music.png';?>">
				<?php }?>
				<div id="chkDivId"><input type="checkbox" name="bannerchk" id="bannerchk" onClick="showBanner()"> Tick the box to view the banner</div>
        <div class="evnt_mbr" id="bannerDivId" style="display:none;">
            <div class="evnt_mbr_con_lft">
              <p>This Event Would Like Volunteers Who Are Members Of Community Treasures</p>
              <strong>Help Us Build & Co-Creat A Brighter World</strong> <span>Get in contact with us </span> <a href="#">Here</a> </div>
            <div class="evnt_mbr_con_rit"><img src="<?php echo base_url();?>/images/hnd_img.png" alt=""></div>
            <br class="clear">
          </div>
		  
		  <?php } ?>
        </div>
        <div class="meet_right">
		<?php if(count($monetizerGallery)>0){
			foreach($monetizerGallery as $galleryImages){
			?>
			 <img src="<?php echo $this->config->item('gbe_base_url');?>CT_sponcer_img/<?php echo $galleryImages['galleryImage']; ?>" alt="" >
			<?php 
			}
		}else{
			?>
			<img src="<?php echo base_url();?>/images/met_img1.jpg" alt="" >
			<?php 
		}
		?>
        	
           
           
        </div>
        <br class="clear">
      </div>
	  
<br class="clear">
        </div>
    </div>
  <div class="wraper"><div class="vde123 vdnew">
        <h3>My Videos</h3>
		<ul id="mycarousel" class="jcarousel-skin-tango">
		<?php if(count($allVideo) > 0){ 
		$i=1; //print_r($allVideo);
                            foreach($allVideo as $key=>$allVideos){
							//	 foreach ( $userYoutube as $key=>$val){
						  $arr     = explode("embed/",$allVideo[$key]["videoFile"]);
						  $title   = urlencode($allVideo[$key]["videoFile"]);
						  //$url     = urlencode("https://www.youtube.com/watch?v=".$arr[1]);
						 // $summary = urlencode(base_url());
						  $image   = urlencode("http://img.youtube.com/vi/$video_id/0.jpg");
					   ?>
				<li><a href="javascript:void(0)" onClick="openVideoDivToPlay('<?php echo $allVideos['videoFile'];?>')"  >
						<img src="http://i4.ytimg.com/vi/<?php echo $arr[1];?>/default.jpg"  >
							</a> </li>
		
		<?php 
			$i++;
			} 
			?>	</ul>
		<?php 	
		} 
		else{
			?><li>
			<img alt="" src="<?php echo base_url();?>/CT_images/no-video.png"></li>
			<?php
		}
		?>
        <br class="clear"></div></div>
    <div class="my_vedios">
    	<div class="wraper">
        <div class="my_vedios_lefts">
        <div class="vde_pro">
        <h3>Home Parties & Events</h3>
        <ul>
		<?php if(count($CT_ticket)>0){
				 foreach($CT_ticket as $CT_tickets){
		?>
<li> <img alt="" src="<?php echo $this->config->item('gbe_base_url');?>/CT_ticketFiles/<?php echo $CT_tickets['image_path']; ?>"><p onClick="showTicketDiv()">$ <?php echo $CT_tickets['ticketPrice']; ?></p></li>


		<?php } }
		else {
			?>
			<li> <img alt="" src="<?php echo base_url();?>/CT_images/prod1.png"></li>
			<?php
		}
	
		?>
</ul>
        </div>
        <div class="flwe">
        <h3>Follow Me On:</h3>
        <ul>
<?php if($monetizerDetail[0]['twitterLink']!=""){ ?><li><a href="<?php echo $monetizerDetail[0]['twitterLink'];?>"><img alt="" src="<?php echo base_url();?>/images/twitter1.png"></a></li> <?php } ?>
<?php if($monetizerDetail[0]['facebookLink']!=""){ ?><li><a href="<?php echo $monetizerDetail[0]['facebookLink'];?>"><img src="<?php echo base_url();?>images/facebook1.png" alt="" /></a></li><?php } ?>
<?php if($monetizerDetail[0]['myBlogger']!=""){ ?><li><a href="<?php echo $monetizerDetail[0]['myBlogger'];?>"><img src="<?php echo base_url();?>images/blogger.png" alt="" /></a></li><?php } ?>
<?php if($monetizerDetail[0]['youTubeUrl']!=""){ ?><li><a href="<?php echo $monetizerDetail[0]['youTubeUrl'];?>"><img src="<?php echo base_url();?>images/youtube.png" alt="" /></a></li><?php } ?>
</ul>
        <br class="clear"></div>
        </div>
        <div class="my_vedios_rit">
        	<div class="prntrs">
<div class="part_iner"><p>Partner
                With Me On
                <strong>CT</strong></p>
				<?php if($CT_partnerVideo!=""){
					$CT_patVdoArr  = explode("embed/",$CT_partnerVideo);
				}?>
<img alt="" onClick="showCT_PartnerVideo('<?php echo $CT_partnerVideo; ?>');" src="http://i4.ytimg.com/vi/<?php echo $CT_patVdoArr[1];?>/default.jpg">
<br class="clear"></div>
<div class="join_frme">
<h3>Join Now To Rise Your Income</h3>
<form id="signupForm" action="<?php echo base_url();?>dashboard/signUpRequest/<?php echo $ct_userID.'/'.$moneType; ?>" method="post" >
<input name="signUpEmail" id="signUpEmailId" placeholder="Enter Your Email" type="email">
<input type="hidden" name="parentID" value="<?php echo $ct_userID; ?>">
<input type="submit" name="submit" id="submitId" value="Start">
</form></div>
            </div>
            </div>
			<br class="clear">
        </div>
    </div>
    </div> 
    
    
    <div class="conq">
    	<div class="wraper">
        <h3>My Sponcers & Associates</h3>
		<?php if(count($allSponcer) > 0){ 
		$i=1;
                            foreach($allSponcer as $allSponcers){
                                ?> 
        <img alt="" width="140" height="140" src="<?php echo $this->config->item('gbe_base_url');?>/CT_sponcer_img/<?php echo $allSponcers['images'];?>">
        
		<?php 
			$i++;
			} 
		} 
		else{
			?><img alt=""  src="<?php echo base_url();?>/CT_images/coq2.png">
			<?php
		}
		?>
        <br class="clear">
        </div>
    </div>   
    <div class="wrapper">
	<?php $this->load->view("ct_catalog/career-monetizer", $result);?>
    <br class="clear">
</div>
<div id="paymentDivId">
<div class="ticket-popup">
<p class="pic"><img alt=""  src="<?php echo base_url();?>/CT_images/gallery-1656-1455800862.jpg"></span></p>
<p class="name">Name</p>
<div class="left-infoo">
<p>Contact Number : <span>9876543210</span></p>
<p>Start Date : <span>24/02/2016</span></p>
<p>End Date : <span>26/02/2016</span></p>
</div>
<div class="right-infoo"><p>City : <span>Test</span></p>
<p>Zip Code : <span>1234567</span></p>
<p>Location : <span>Test</span></p></div>
<br class="clear"/>
<p class="price">Price : <span>$100</span></p>
<p  class="decriptonn">Description : <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>
<!--<p class="pdf"><a href="#">Download Tickets</a></span></p>-->
<div class="button-sec"><a href="#" class="but-buttn">Buy</a>
<a href="#" class="chk-buttn">Checkout</a></div>
</div>
</div>
<div id="ticketDivId">
<div class="ticket-popup">
<p class="pic"><img alt=""  src="<?php echo base_url();?>/CT_images/gallery-1656-1455800862.jpg"></span></p>
<p class="name">Name</p>
<div class="left-infoo">
<p>Contact Number : <span>9876543210</span></p>
<p>Start Date : <span>24/02/2016</span></p>
<p>End Date : <span>26/02/2016</span></p>
</div>
<div class="right-infoo"><p>City : <span>Test</span></p>
<p>Zip Code : <span>1234567</span></p>
<p>Location : <span>Test</span></p></div>
<br class="clear"/>
<p class="price">Price : <span>$100</span></p>
<p  class="decriptonn">Description : <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>
<!--<p class="pdf"><a href="#">Download Tickets</a></span></p>-->
<div class="button-sec"><a href="#" class="but-buttn">Buy</a>
<a href="#" class="chk-buttn">Checkout</a></div> 
</div></div>

<div id="contactDivId" style="display:none;">
<div class="ticket-popup cont-popup">
<p class="name">Contact <?php echo $monetizerDetail[0]['firstName']." ".$monetizerDetail[0]['lastName']; ?></p>
<p id="msgDivId"></p>
<div>
<p><label>Email :</label> <span><input type="text" name="senderEmail" id="senderEmail" value="" /></span></p>
<p  class="decriptonn"><label>Message :</label> <span><textarea name="mailContent" id="mailContent"> </textarea></span></p>
<div class="button-sec contBtn">
<input type="hidden" name="moneMailId" id="moneMailId" value="<?php echo $monetizerDetail[0]['emailID']; ?>" >
<input type="hidden" name="moneTypeId" id="moneTypeId" value="<?php echo $moneType; ?>" >
<input type="button" name="sendMail"  class="but-buttn" value="Send" onClick="checkNSendMail()">
<input type="button" name="cancelMail" class="chk-buttn" value="Cancel" onClick="clearFormValue()"></div>
</div>
</div>
</div>
<!--footer section-->
<div class="footer">
<?php $this->load->view("ct_catalog/CT_add", $result); ?>
<?php $this->load->view("ct_catalog/CT_footer", $result);?>
</div>
<!--footer section end-->
<script type='text/javascript'>

function OpenPlayer(musicFile){
	//alert(musicFile);
	//$('#productPlayer').modal('show');
	$('#productPlayer').css('display','block');
	//alert('============'+$('#playerzpumcZwzBZKD').html());
	 jwplayer('playerzpumcZwzBZKD').setup({
        file: musicFile,
        image: '',
        width: 450,
      height: 40,
      autostart: true
    });
}
  function stopPlayer(){
	  //alert('Close');
	  //vent.stopPropagation();
     jwplayer('playerzpumcZwzBZKD').play(false);
	// $('#productPlayer').modal('hide');
	$('#productPlayer').css('display','none');
  }
  
  // show payment div ADDED by SB on 
  function showPaymentDiv(){
//$('#paymentDivId').css('display','block');
	  $.fancybox.open($('#paymentDivId').html());
  }
  
  function showTicketDiv(){
	  	  $.fancybox.open($('#ticketDivId').html());
  }
  
  function showBanner(){
	  if($('#bannerchk').is(':checked')){
		  $('#bannerDivId').css('display','block');
		   
		   $('#chkDivId').html('<input type="checkbox" name="bannerchk" id="bannerchk" onClick="showBanner()" checked > Untick the box to hide the banner');
		   //alert('+++++++++++++++'+$('#bannerchk').html());
	  }
	  else{
		  $('#bannerDivId').css('display','none');
		  
		   $('#chkDivId').html('<input type="checkbox" name="bannerchk" id="bannerchk" onClick="showBanner()"> Tick the box to view the banner');
	  }
  }
</script>
<script src="http://jwpsrv.com/library/A7o4ns39EeS3agp+lcGdIw.js"></script>	<!-- added by SB on 15-02-2016 -->
</body>
</html>
