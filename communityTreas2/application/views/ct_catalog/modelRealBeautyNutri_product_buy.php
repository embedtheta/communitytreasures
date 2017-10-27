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
// email validation 
function emailValid(email){
	var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	var error = "";
	if(email == ""){
		error = "Email field is required.";
	}else if(!emailReg.test(email) && email != ""){
		error = "Please enter the valid Email.";
	}
	return error;
 }
 
// Added by SB on 05/02/2016
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
  // show payment div ADDED by SB on 
  function showPaymentDiv(){
//$('#paymentDivId').css('display','block');
	  $.fancybox.open($('#paymentDivId').html());
  }
  
  function showTicketDiv(){
	  	  $.fancybox.open($('#ticketDivId').html());
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
    	<h2 class="rele"><?php  if($moneType==3){ ?>Models Section<?php } else if($moneType==1){ ?>Beauty & Cosmetic Products<?php } else if($moneType==5){ ?>Nutritional Products<?php } else if($moneType==6){ ?>Real Estate<?php } ?></h2>
        <div class="my_top_sec">
        	<div class="left-top">
            <div class="my_top_sec_left">
            <img alt="" src="<?php echo $this->config->item('gbe_base_url');?>/useruploads/<?php echo $monetizerDetail[0]['profile'];?>">
            	<div class="kachemnt">
                <h2><?php echo $monetizerDetail[0]['firstName']." ".$monetizerDetail[0]['lastName']; ?></h2>
                	<!--<strong>Keller Williams Reality</strong>-->
                    <!--<p><?php //echo $monetizerDetail[0]['profileDesc'];?></p>-->
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
			<?php if($moneType==3){ ?>
            <div class="my_top_sec_rit modlse">
            <h3>My Nine Modelling Pictures For Sale</h3>
            <ul>
			<?php if(count($CT_product) > 0){ 
                            foreach($CT_product as $cp){
                                ?>
				<li>
				<?php if($cp !=""){ ?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'topsixproduct/'.$cp['productSpecificFile'];?>">
				<?php } //else {?>
					<!--<img alt="" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/no_image.png';?>">-->
				<?php //}?>
				
				<div class="buys"><p>£<?php echo $cp['productPrice']; ?></p><a href="#" onClick="showPaymentDiv()" ></a></div>
				</li>
				<?php }} else {?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/no_image.png';?>">
				<?php }?>


</ul>
</div> 
			<?php } elseif($moneType==1){ ?>
			<div class="my_top_sec_rit">
            <h3>My Six Favourite Beauty Products - This Week </h3>
            <ul>
			<?php if(count($CT_product) > 0){ 
                            foreach($CT_product as $cp){
                                ?>
				<li>
				<?php if($cp['productFile'] !=""){ ?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'topsixproduct/'.$cp['productFile'];?>">
				<?php } else {?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/no_image.png';?>">
				<?php }?>
				<div class="li_dv">
				<div class="hus_dtl">
				<div class="hus_dtl_lf">
					<h3><?php echo $cp['productName']; ?></h3> 
					<p><?php echo $cp['productDesc']; ?></p>
				</div>
				<br class="clear">
				<div class="tle_prc">
					<p><span>Price:</span><strong>$<?php echo $cp['productPrice']; ?></strong></p>
				</div>
				</div>
				<a class="cont_agn" href="#" onClick="showPaymentDiv()">Book Now</a></div>
				</li>
				<?php }} else {?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/no_image.png';?>">
				<?php }?>
				

</ul>
</div>
			<?php } elseif($moneType==5){ ?>
			<div class="my_top_sec_rit">
            <h3>My Six Favourite Products - This Week </h3>
		<ul>
			<?php if(count($CT_product) > 0){ 
                            foreach($CT_product as $cp){
                                ?>
				<li>
				<?php if($cp['productFile'] !=""){ ?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'topsixproduct/'.$cp['productFile'];?>">
				<?php } else {?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/no_image.png';?>">
				<?php }?>
			<div class="li_dv">
			<div class="hus_dtl">
			<div class="hus_dtl_lf">
				<h3><?php echo $cp['productName']; ?></h3> 
				<p><?php echo $cp['productDesc']; ?></p>
			</div>
			<br class="clear">
			<div class="tle_prc">
				<p><span>Price:</span><strong>$<?php echo $cp['productPrice']; ?></strong></p>
			</div>
			</div>
			<a class="cont_agn" href="#" onClick="showPaymentDiv()" >Buy Now</a></div>
			</li>
			<?php }} else {?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/no_image.png';?>">
				<?php }?>


</ul>
</div>
			<?php } elseif($moneType==6){ ?>
			 <div class="my_top_sec_rit">
            <h3>My Six Favourite Products - This Week </h3>
            <ul>
			<?php if(count($CT_product) > 0){ 
                            foreach($CT_product as $cp){
                                ?>
				<li>
				<?php if($cp['p_img'] !=""){ ?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'topsixproduct/'.$cp['p_img'];?>">
				<?php } else {?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/no_image.png';?>">
				<?php }?>
				<div class="li_dv">
				<div class="hus_dtl">
				<div class="hus_dtl_lf">
					<h3><?php echo $cp['productName']; ?></h3> 
					<p><?php echo $cp['productDesc']; ?></p>
				</div>
				<br class="clear">
				<div class="tle_prc">
					<p><span>Price:</span><strong>$<?php echo $cp['productPrice']; ?></strong></p>
				</div>
				</div>
				<a class="cont_agn" href="#" onClick="showPaymentDiv()" >Book Now</a></div>
				</li>
				<?php }} else {?>
					<img alt="" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/no_image.png';?>">
				<?php }?>
			

</ul>
</div>
			<?php } ?>
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
						 // $url     = urlencode("https://www.youtube.com/watch?v=".$arr[1]);
						//  $summary = urlencode(base_url());
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
        <div class="conq_in">
        <?php if(count($allSponcer) > 0){ 
		
                            foreach($allSponcer as $allSponcers){
                                ?> 
        <img alt="" width="140" height="140" src="<?php echo $this->config->item('gbe_base_url');?>/CT_sponcer_img/<?php echo $allSponcers['images'];?>">
        
		<?php 
			
			} 
		} 
		else{
			?><img alt=""  src="<?php echo base_url();?>/CT_images/coq2.png">
			<?php
		}
		?></div>
        <br class="clear">
        </div>
    </div>  
    <div class="wrapper"><?php $this->load->view("ct_catalog/career-monetizer", $result);?>
    <br class="clear"> 
</div>

<!--footer section-->
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
<div class="footer">
<?php $this->load->view("ct_catalog/CT_add", $result); ?>
<?php $this->load->view("ct_catalog/CT_footer", $result);?>
</div>
<!--footer section end-->

</body>
</html>
