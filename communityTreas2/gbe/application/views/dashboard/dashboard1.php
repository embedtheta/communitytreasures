<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Rave Business</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script src="<?php echo base_url(); ?>js/jquery-1.10.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/organictabs.jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$( ".social_media li" ).click(function() {
	$( ".list_service",this ).slideToggle ('');
});
$(function() {
    
            $(".containertab").organicTabs({
                "speed": 200
            });
    
        });
});

</script>

</head>
<body>
<div class="wrapper">
  <header>
    <div class="top">
      <div class="logo fltleft hed_inr"> <h1><a href="#">Black entrepenuers Network</a></h1> </div>
      <div class="log_form fltright"> <span><a href="<?php echo base_url();?>gateway/logout/?actionLog=logout" style="color:#FFFFFF;">Log Out</a></span> </div>
      <div class="clear"></div>
      <div id="message_box"></div>
    </div>
    <div class="nav"> 
      <nav class="secondary">
        <ul class="misc_new">
          <li><a href="#">Free Trial<span>Open</span><span class="level">Level - 1</span></a></li>
          <li><a href="#"> Full Member<span> Open </span><span class="level">Level - 2</span> </a> </li>
          <li><a href="#"> The Source<span> Open </span><span class="level">Level - 3</span> </a></li>
          <li><a href="#"> Society Owner<span> Open </span><span class="level">Level - 4</span> </a></li>
          <li style="padding-right:0;"><a href="#"> Create Your Lodge <span> Open </span><span class="level">Level - 5</span> </a></li>
        </ul>
      </nav>
     
      <div class="clear"></div>
      <div class="nitify-menu">
        <ul>
          <li><a href="#"><i class="fa fa-laptop"></i><span class="notify-ribon">15</span></a></li>
          <li><a href="#"><i class="fa fa-heart"></i><span class="notify-ribon">7</span></a></li>
          <li><a href="#"><i class="fa fa-globe"></i><span class="notify-ribon">2</span></a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i><span class="notify-ribon">5</span></a></li>
        </ul>
      </div>
    </div>
   
   <!-- <form action="http://www.raversdirect.com/raversdirect/login" method="post" id="directForm" style="display:none">
      <p>
        <input name="txtemail" onfocus="if($(this).val()=='email')$(this).val('');" onblur="if($(this).val()=='')$(this).val('email');" value="ravestory@gmail.com" type="text">
        <input name="txtpassword" placeholder="password" onfocus="if($(this).val()=='******')$(this).val('');" onblur="if($(this).val()=='')$(this).val('******');" value="123456" type="password">
        <input name="" value="" type="submit">
      </p>
    </form>-->
    
  </header>
  <!--header end-->
  
  <div class="main_container">
  <div class="lefts_side">
  	<div class="tabsectionstep">
    	<div class="containertab">
        	<ul class="tabs">
                <li><a href="#tab1"  class="current">Step1</a></li>
                <li><a href="#tab2">Step2</a></li>
                <li><a href="#tab3">Step3</a></li>
            </ul>
            
            <div class="tab_container">
            	<div id="tab1" class="tab_content">
                	<div class="yvideo extra-pad">
         <span class="watch-thisvideo">Watch This Video</span>       
          <iframe width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>
        </div>
               <h3 class="headign-left">Make $100<br>per day with</h3>
               <h3 class="heading-right">PRODUCT  TRIALS</h3>
               <br class="clear">
               <div class="ab_inner"><strong>A</strong><h3 class="d_hdr">How To Make Money On Level 1</h3>
				 	<span><a class="watch-video-tut" href="javascript:void(0)">Watch Video</a></span>
              </div>
               	  <p class="stt2">Watch All The Videos - One By One. Then follow and complete the actions, exactly.</p>
               <div class="ab_inner "><strong>B</strong><h3>Add Your Picture</h3><span><a class="watch-video-tut" id="tutorial-video1" href="javascript:void(0)">Watch Video</a></span></div>
               <div class="your-pic">
               <img src="<?php echo base_url(); ?>images/tmb211862845520131224-20-06-25.jpeg" width="70" height="70" alt="">
               <p>Add your profile picture to your Rave Story Website</p>
               <form enctype="" action="#" method="post" class="rday">
           		<label>
           		 <input type="file" onchange="readURL(this);" name="user_file" id="file">
                 <input type="submit" class="extra-blue-btn"  name="user_file_submit" value="" style="margin-left:54px">
                 <div class="clear"></div>
                </label>
            </form>
            </div>
               <div class="ab_inner"><strong>C</strong><h3>Pay $10</h3>
				 <span><a class="watch-video-tut" id="tutorial-video1A" href="javascript:void(0)">Watch Video</a></span></div>
               <div class="your-pic"><img class="nobor" src="<?php echo base_url(); ?>images/TenPaypal.png" width="93" height="89" alt=""><p>-Click On Paypal button to pay $10</p> </div>
               <br class="clear">

               <div class="ab_inner"><strong>D</strong><h3>Where To Collect Your Money</h3>
            <span><a class="watch-video-tut" id="tutorial-video2" href="javascript:void(0)">Watch Video</a></span></div>
            <p>Enter Your Paypal ID,This is where we will pay your money.</p>
            <form action="http://www.ravestorysociety.com/ravestorysociety/freetrial" method="post" name="form1" id="form1">
              
                <label><a target="_blank" href="https://www.paypal.com/"><img class="nobor" src="images/paypal.png" width="116" height="30" alt=""></a></label>
                
              <label>
              <input type="text" name="user_paypal_name" value="paytestevika-facilitator@gmail.com" style="margin-left:54px;">
 				<input type="submit" value="" class="extra-blue-btn"  name="user_paypal_submit"></label>
                <div class="clear"></div>
                
            </form>
 <br class="clear">
              <div class="ab_inner"><strong>E</strong><h3 class="d_hdr">If You Live Outside<br>USA, Canada or UK</h3>
                <span><a class="watch-video-tut" id="tutorial-video16" href="javascript:void(0)">Watch Video</a></span></div> 
               
               <div class="pink-area">
                            <p>If you do NOT Live in the: </p><p> U.S.A,United Kingdom,Canada</p><p>Select your country &amp; click Submit</p><p>for $5 bonuses.</p>
								<form onsubmit="return valFormCountryCode()" action="http://www.ravestorysociety.com/ravestorysociety/treasureChestCountryCode" method="post" name="formCountryCode" id="formCountryCode">
								<select id="country" name="country"> 
<option selected="selected" value="0">Select Country</option>
								<option value="Afghanistan">Afghanistan</option> 
								<option value="Albania">Albania</option> 
								</select>
								<input type="submit" value="Submit" class="freebies-submitbtn02 extra-freebies" name="freebies_submit"></form>
                        </div>
                <br class="clear">
               <div class="ab_inner"><strong>F</strong><h3 class="d_hdr">Terms of Product <br>Trial Offers</h3>
				 <span><a class="watch-video-tut" id="tutorial-video141" href="javascript:void(0)">Watch Video</a></span></div>
               <span class="stt2">For partnership details click there here button.
										<u class="here" id="tutorial-video142">Here</u>
									 </span>
               
               <div class="ab_inner"><strong>G</strong><h3 class="d_hdr">Watch Me Complete <br>A Trial Offer</h3>
				 <span><a class="watch-video-tut" id="tutorial-video14" href="javascript:void(0)">Watch Video</a></span></div>
                 <span class="stt2">Here is an example of a real trial <br>being completed. Its simple.
										<a  href="http://double.mycashfreebies.com/index.php"><u class="here">Here</u></a>
									 </span>
               <div class="ab_inner"><strong>H</strong><h3 class="d_hdr">TREASURE CHEST (TC)<br><span class="whitee">PEARL</span></h3>
				 <span><a class="watch-video-tut" id="tutorial-video150" href="javascript:void(0)">Watch Video</a></span></div>
                 <span class="stt2">Click the 'Here' button a page will appear. <br>Register and complete a few trial offers. 
										<a target="_blank" href="http://pearl.freetreasurechest.com/index.php"><u class="here">Here</u></a>
                    </span>
               
               <div class="ab_inner"><strong>I</strong><h3 class="d_hdr">Connect TC <span class="whitee">PEARL</span><br>To Your Rave Business</h3>
                <span><a class="watch-video-tut" id="tutorial-video151" href="javascript:void(0)">Watch Video</a></span></div>
                <strong class="fleft">Add Your TC Pearl numbers here</strong>
				  		<input type="text" class="input-extra extra-text" id="pearlCode" name="code" style="width:171px;">
						<input type="submit" class="extra-blue-btn" value="" name="freebies_submit">
                        <span class="stt3">When people you invite complete this section, You get paid $20</span>
                        <p class="linktex">Your Freebies Url is Activated:<br>
						<a target="_blank" class="redlink" href="#">
						http://pearl.freetreasurechest.com/index.php?ref=100284</a> 
						</p>
                        <p>Click to view List of person not belongs to US,Canada,UK</p>
               <div class="ab_inner"><strong>J</strong><h3>TREASURE CHEST (TC) <span class="whitee">Silver</span></h3>
				 <span><a class="watch-video-tut" id="tutorial-video152" href="javascript:void(0)">Watch Video</a></span></div>
               
               <span class="stt2">Click the 'Here' button a page will appear.<br> Register and complete a few trial offers. 
										<a target="_blank" href="http://silver.freetreasurechest.com/index.php"><u class="here">Here</u></a>
									 </span>
               <div class="ab_inner"><strong>K</strong><h3 class="d_hdr">Connect TC <span class="whitee">Silver</span><br>To Your Rave Business</h3>
                <span><a class="watch-video-tut" id="tutorial-video153" href="javascript:void(0)">Watch Video</a></span></div>
                <strong class="fleft">Add Your TC Silver numbers here</strong>
                <input type="text" class="input-extra extra-text" id="silverCode" name="tccode" style="width:167px;">
                <input type="submit" class="extra-blue-btn" value="" name="freebies_submit">
                <span class="stt3">When people you invite complete this section, You get paid $60</span>
                <p class="linktex">Your Freebies Url is Activated:<br>
						<a target="_blank" class="redlink" href="http://silver.freetreasurechest.com/index.php?ref=100288">
						http://silver.freetreasurechest.com/index.php?ref=100288						</a> 
						</p>
                        <p>Click to view List of person not belongs to US,Canada,UK</p>
               
               <div class="ab_inner"><strong>L</strong><h3>Step 1 Completed</h3>
                <span><a class="watch-video-tut" id="tutorial-video154" href="javascript:void(0)">Watch Video</a></span></div>
               
<!--1tab end......... -->
                </div>
                <div id="tab2" class="tab_content hide">
                <div class="yvideo extra-pad">
         <span class="watch-thisvideo">Watch This Video</span>       
          <iframe width="573" height="320" frameborder="0" allowfullscreen="" src="http://www.youtube.com/embed/qa0hwg0_DxU"></iframe>
        </div>
        <h3 class="headign-left">Start Making Money <br>Get People To Sign Up</h3>
        <h3 class="heading-right">PROMOTE</h3>
        <br class="clear">
        <div class="ab_inner clearfix"><strong>A</strong><h3>Invite Friends</h3><a class="watch-video-tut1" id="tutorial-video5" href="javascript:void(0)">Watch Video</a></div>
        <h3 class="new_head">This tool is for Gmail and Yahoo email accounts.</h3>
        <p>Click the logo of your email provider. Login and automatically send invite emails that take your contacts to your Rave Business sign up page.</p>
        <img class="nobor" src="<?php echo base_url(); ?>images/gmail.png" width="95" height="70" alt=""> OR <img class="nobor" src="<?php echo base_url(); ?>images/yahoo.png" width="114" height="70" alt="">
        <br class="clear">
        <div class="ab_inner"><strong>B</strong><h3>Videos You Can Use</h3><a href="javascript:void(0)" id="tutorial-video6" class="watch-video-tut1">Watch Video</a></div>
        <h3 class="new_head">You can use these videos on any video sharing sites.</h3>
        <p>When you upload these videos remember to add the url of your sign up page in the description box and on the video if you can.</p>
        <div class="ved">
            <ul>
                <li><img src="<?php echo base_url(); ?>images/vtham.jpg" width="138" height="103" alt="">
                <h5>test3</h5>
                <div class="cbz"><a href="">Copy URL</a></div>
                <a class="share-btn" href="javascript:void(0)">Share</a>
                <a class="download-btn" href="javascript:void(0)">Download</a>
                </li>
                <li><img src="<?php echo base_url(); ?>images/vtham.jpg" width="138" height="103" alt="">
                <h5>test3</h5>
                <div class="cbz"><a href="">Copy URL</a></div>
                <a class="share-btn" href="javascript:void(0)">Share</a>
                <a class="download-btn" href="javascript:void(0)">Download</a>
                </li>
                <li><img src="<?php echo base_url(); ?>images/vtham.jpg" width="138" height="103" alt="">
                <h5>test3</h5>
                <div class="cbz"><a href="">Copy URL</a></div>
                <a class="share-btn" href="javascript:void(0)">Share</a>
                <a class="download-btn" href="javascript:void(0)">Download</a>
                </li>
            </ul>
		</div>
        <br class="clear">
        
        <div class="ab_inner sing"><strong>C</strong><h3>Facebook</h3><a class="watch-video-tut1" id="tutorial-video7" href="javascript:void(0)">Watch Video</a></div>
        <div class="extra-share">
                
              <div class="share-text">
              	<h3 class="new_head">Share Your Video &amp; Links on Facebook</h3>
                <p><strong>Remember to ask your friends</strong> on facebook to repost your Video &amp; url link to your sign up page. Then later do the same the url to your Rave Story products site. </p>
              </div>
              <div class="share-pic">
              <img class="share-none" src="<?php echo base_url(); ?>images/s1.png">
              </div>
              <div class="clear"></div>
            </div>
            <div class="ab_inner sing"><strong>D</strong><h3>Twitter</h3><a class="watch-video-tut1" id="tutorial-video8" href="javascript:void(0)">Watch Video</a></div>
            <div class="extra-share">
                
              <div class="share-text">
              	<h3 class="new_head">Share Your Video &amp; Links on Twitter.</h3>
                <p><strong>Remember to ask your friends</strong> on Twitter to repost your Video &amp; url link to your sign up page. Then later do the same the url to your Rave Story products site. </p>
              </div>
              <div class="share-pic"><img class="share-none" src="<?php echo base_url(); ?>images/s3.png"></div>
              <div class="clear"></div>
            </div>
            <br class="clear">
            <div class="ab_inner"><strong>E</strong><h3>Party Pictures Attract People</h3><a class="watch-video-tut1" id="tutorial-video20" href="javascript:void(0)">Watch Video</a></div>
            <div class="extra-share">
                
              <div class="share-text">
              	<h3 class="new_head">Use Photos of Your Weekend To Boost Your Rave Business</h3>
                <p><strong>When</strong> you Upload fun pictures to facebook, Instagram, Twitter and other social networks, add a message and link to your sign up page. Do the same thing again but the time use the url link to your Rave Story website.</p>
              </div>
              <div class="share-pic"><img src="<?php echo base_url(); ?>images/E3.jpg"></div>
              <div class="clear"></div>
            </div>
            <br class="clear">
            <div class="ab_inner sing"><strong>F</strong><h3>Go Viral</h3><a class="watch-video-tut1" id="tutorial-video18" href="javascript:void(0)">Watch Video</a></div>
           <div class="extra-share">
                
              <div class="share-text">
                              
              	<h3 class="new_head">Post a free chapter of Rave Story to get sign ups</h3>
                <p>Use the power of this popular book the get sign ups. Download the Free chapter and upload in everywhere. Remember both of your sign up link are on the page so get it out there. </p>
                <h3 id="dwn-pdf"><a target="_blank" href="#">Click to Download PDF</a></h3>
              </div>
              <div class="share-pic">
            
              <a target="_blank" href="#"><img class="share-none" src="<?php echo base_url(); ?>images/eng.jpg"></a>
              </div>
              <div class="clear"></div>
            </div>
            <br class="clear">
            <div class="ab_inner sing"><strong>G</strong><h3>SKYPE</h3><a class="watch-video-tut1" id="tutorial-video10" href="javascript:void(0)">Watch Video</a></div>
            <div class="extra-share">
                
              <div class="share-text">
              	<h3 class="new_head">Skype call and message your Friends to sign up.</h3>
                <p>Send  the Url to your Sign up page on Skype. Then make a different message and send the URL link to your Rave Story website.</p>
              </div>
              <div class="share-pic">
			  <img class="share-none" src="<?php echo base_url(); ?>images/s4.png">
			  </div>
              <div class="clear"></div>
            </div>
            <br class="clear">
            <div class="ab_inner sing"><strong>H</strong><h3>Text Messages Work</h3><a class="watch-video-tut1" id="tutorial-video11" href="javascript:void(0)">Watch Video</a></div>
            <div class="extra-share">
                
              <div class="share-text">
              	<h3 class="new_head">Send Text messages to get Sign ups.</h3>
                <p><strong>If</strong> you are on a contract phone with free texts, send a text message and your web address (url) telling everyone you know to visit your sign up page. Then another time send a message with the Url of your Rave Story website If you have a blackberry phone then BB your friends and message on Whatsapp, Tango or Viber etc.</p>
              </div>
              <div class="share-pic"><img class="share-none" src="<?php echo base_url(); ?>images/s5.png"></div>
              <div class="clear"></div>
            </div>
            <br class="clear">
            <div class="ab_inner dub"><strong>I</strong><h3>Use Our Adverts To Gain Interest</h3><a class="watch-video-tut1" id="tutorial-video12" href="javascript:void(0)">Watch Video</a></div>
            <h3 class="new_head">Use Photos of Your Weekend To Boost Your Rave Business</h3>
            <p>If you have Instagram then collect one of our funny adverts below and post it with your message and website address (url) . Laughter always brings traffic. You can also use these pictures on your facebook &amp; other sites too.</p>
            <ul class="twitter_user">
            	<li>
                    <img width="103" height="76" src="<?php echo base_url(); ?>images/tmb169501418420140101-23-55-43.jpg">
                    <div class="tpbb"><a href="#" class="">Copy</a></div>
                    <div class="tptt"><a href="#">Download</a></div>
                </li>
                <li>
                    <img width="103" height="76" src="<?php echo base_url(); ?>images/tmb169501418420140101-23-55-43.jpg">
                    <div class="tpbb"><a href="#" class="">Copy</a></div>
                    <div class="tptt"><a href="#">Download</a></div>
                </li>
            </ul>
            <div class="ab_inner sing"><strong>J</strong><h3>Imbed HTML Banners</h3><span><a class="watch-video-tut1" id="tutorial-video13" href="javascript:void(0)">Watch Video</a></span></div>
            <h3 class="new_head">These Banners that are coded with your links</h3>
            <p>If you have your another website or blog,  you can embed any of the Banners below to create a link to your Rave story site.</p>
            <ul class="presta_shop">
                 <li>
                    <div><a href="#"><img src="<?php echo base_url(); ?>images/2626920130402-15-36-06.gif"></a></div>
                    <div class="mbr"><a href="#">Copy</a></div>
                 </li>
                 <li>
                    <div><a href="#"><img src="<?php echo base_url(); ?>images/2626920130402-15-36-06.gif"></a></div>
                    <div class="mbr"><a href="#">Copy</a></div>
                 </li>
                 <li>
                    <div><a href="#"><img src="<?php echo base_url(); ?>images/2626920130402-15-36-06.gif"></a></div>
                    <div class="mbr"><a href="#">Copy</a></div>
                 </li>
                 </ul>
                 <br class="clear">
                 <div class="ab_inner sing"><strong>k</strong><h3>Step 2 Complete</h3><span><a class="watch-video-tut1" id="tutorial-video19" href="javascript:void(0)">Watch Video</a></span></div>
                 <br class="clear">
                 <p align="right"><a onclick="showThirdTab()"  href="tab3" id="step3">Move To Step 3 &amp; 'Switch On'&gt;</a></p>
<!--2tab end......... -->
                </div>
                <div id="tab3" class="tab_content hide">
                <div class="yvideo extra-pad">
         <span class="watch-thisvideo">Watch This Video</span>       
           <iframe width="573" height="320" frameborder="0" allowfullscreen="" src="http://www.youtube.com/embed/yrS-kiwZK8s"></iframe>
        </div>
        <h3 class="headign-left">You Are Welcome<br> To Now Enter</h3>
        <h3 class="heading-right">FULL MEMBERS AREA</h3>
        <div class="clear"></div>
        <div class="extrapara">
            <h3>Inside You Can Enjoy</h3>
        	 <ul class="list_extra">
             	<li>Powerful Marketing Tools To explode your Rave Business</li>
                <li>Gifts, VIP &amp; Discounts to events</li>
                <li>Personal Marketing suite.</li>
            </ul>
              </div>
              <a href="#"><img src="<?php echo base_url(); ?>images/submit-paypal.png" width="424" height="81" alt=""></a>
              <br class="clear">
<p>&nbsp;</p><p>&nbsp;</p>
<!--3tab end......... -->
                </div>
            </div>
            
           <!--all cont -->
           <br class="clear">
        </div>
        

    </div>
  </div>
   <!--lefts_side end-->
  <div class="rights_side">
            <div class="sm extra-no-pad">
   			  <ul class="social_media extra-width">
                <li class="sm001">
                    <a id="serviceList_1" href="javascript:void(0)">Customer Service</a>
                  <div id="slist_1" class="list_service">
                    <form method="post" action="http://www.ravestorysociety.com/ravestorysociety/customerService">
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          
                          <tbody><tr>
                    	    <td><label for="textfield">Email Id:</label></td>
                    	    <td><input type="text" id="customerServiceEmail" name="customerServiceEmail"></td>
                  	     </tr>
                    	  <tr>
                    	    <td><label for="textarea">Message:</label></td>
                    	    <td><textarea rows="5" cols="31" id="customerServiceMsg" name="customerServiceMsg"></textarea></td>
                  	    </tr>
                    	  <tr>
                    	    <td>&nbsp;</td>
                    	    <td><input type="submit" value="Submit" id="customerServiceSubmit" name="customerServiceSubmit"></td>
                  	    </tr>
                  	  </tbody></table>
                    </form>
                  </div>
                </li>
                <li class="sm002">
                    <a id="serviceList_2" href="javascript:void(0)">Tech Support </a>
                    <div id="slist_2" class="list_service">
                    <form method="post" action="http://www.ravestorysociety.com/ravestorysociety/techSupport">
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	                        <tbody><tr>
                    	    <td><label for="textfield">email:</label></td>
                    	    <td><input type="text" id="techSupportEmail" name="techSupportEmail"></td>
                  	    </tr>
                    	  <tr>
                    	    <td><label for="textarea">message:</label></td>
                    	    <td><textarea rows="5" cols="31" id="techSupportMsg" name="techSupportMsg"></textarea></td>
                  	    </tr>
                    	  <tr>
                    	    <td>&nbsp;</td>
                    	    <td><input type="submit" value="Submit" id="techSupportSubmit" name="techSupportSubmit"></td>
                  	    </tr>
                  	  </tbody></table>
                    </form>
                  </div>
                </li>
                <li class="sm003">
                    <a id="serviceList_3" href="javascript:void(0)">Advertising </a>
                    <div id="slist_3" class="list_service">
                     <form method="post" action="http://www.ravestorysociety.com/ravestorysociety/advertisingRequest">
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                           	  <tbody><tr>
                    	    <td><label for="textfield">email:</label></td>
                    	    <td><input type="text" id="advertisingEmail" name="advertisingEmail"></td>
                  	     </tr>
                    	  <tr>
                    	    <td><label for="textarea">message:</label></td>
                    	    <td><textarea rows="5" cols="31" id="advertisingMsg" name="advertisingMsg"></textarea></td>
                  	    </tr>
                    	  <tr>
                    	    <td>&nbsp;</td>
                    	    <td><input type="submit" value="Submit" id="advertisingSubmit" name="advertisingSubmit"></td>
                  	    </tr>
                  	  </tbody></table>
                    </form>
                  </div>
                    
                </li>
                <li class="sm007">
                    <a id="serviceList_4" href="javascript:void(0)">Listen to Rave Story Radio</a>
                   
                </li>
								<li class="sm003">
                    <a id="serviceList_5" href="javascript:void(0)">Total Member Under RaveBusiness</a>
                    <div id="slist_5" class="list_service">
                     <p class="total-number">39</p>
                  </div>
                    
                </li>
				             </ul>
     	   </div>
           <div class="webbox">
            <p class="web">
            <span>My Sign Up Page:</span>
            <a target="_blank" href="http://www.ravebusiness.com/">http://www.ravebusiness.com/</a>
            </p>
            <p class="web">
           <span>My Rave Story Products website :</span>
             <a target="_blank" href="http://www.ravestory.com/RaveStory">http://www.ravestory.com/RaveStory</a>
            </p>
                         <p class="web">
           <span>My Rave Blog:</span>
                <a target="_blank" href="http://www.raveblogger.com/?author=1000">
					http://www.raveblogger.com/?author=1000				</a>
           </p>
                                  <p class="web">
           <span>My Ravers Direct Profile:</span>
                
                <a target="_blank" href="http://www.raversdirect.com/raversdirect/ravetalent/?UID=1000">
					http://www.raversdirect.com/raversdirect/ravetalent/?UID=1000				</a>
            </p>
                                   <p class="web">
           <span>My Society Page:</span>
                 
                <a target="_blank" href="http://www.ravestorysociety.com/ravestorysociety/showSociety/?sid=7">
					http://www.ravestorysociety.com/ravestorysociety/showSociety/?sid=7				</a>
            </p>
                                   <p class="web">
           <span>My Clubguide page:</span>
                  <a target="_blank" href="http://www.clubguideworldwide.com/?uid=1000">
					http://www.clubguideworldwide.com/?uid=1000				</a>
            </p>
            </div>
              		  	
        	<div class="blue-box">
            <p class="ana">ANALYTICS</p>
            	<ul>
                	<li>Switched On Members :<span> 4</span></li>
                	 <li>My Sign Ups : <span>58</span></li>
                    <li> Visitors to my website : <span>6</span></li>
                    <li>My Ticket Sales : <span>0</span></li>
                    <li>My Music Sales : <span>0</span></li>
                    <li>My E-book Sales :<span> 0</span></li>
                </ul>
            </div>
            
            <div class="ash">
            	                
            	<img src="http://www.ravestorysociety.com/upload/profile/tmb6625284020140227-00-46-49.jpg">
                
                                
                <span class="ash_postion">You are introduced to ravebusiness by</span>
                
                <span class="ash_title">Rave  Story</span>
                
                <span class="ash_tel">9857421456</span>
               <span class="ash_mail"><a href="mailto:otizfangel@googlemail.com"> otizfangel@googlemail.com</a></span> 
                <div class="ash_social">
                <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/ash-fb.png"></a>
                <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/skype_square_color-32.jpg"></a>
                <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/youtube.jpg"></a>
                <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/ash-tw.png"></a>
                <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/ash-wp.png"></a>
           </div>
            </div>
	  </div>
  <br class="clear">

  </div>
  
  
  
  
  
</div>
</body>
</html>
