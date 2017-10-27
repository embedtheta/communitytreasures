<?php $this->load->view("header", "", $result); ?>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>

<script type="text/javascript">
jQuery(function ($) {
	// Load dialog on click
	 $("#tutorial-video201").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#tutorial-video202").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#tutorial-video203").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[3][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#tutorial-video204").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
        
	$('.clickopen').click(function () {
            $(this).next().slideToggle("slow");
	});
      
});
</script>


<div class="nav"> 
  
  <!-- navigation start -->
  
  <nav class="secondary">
    <ul class="misc_new">
      <li><a href="<?php echo base_url(); ?>dashboard">Free Trial<span>Open</span><span class="level">Level - 1</span></a></li>
     
      <li><a href="<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 10 || ($this->session->userdata['userId'] == 1076) || ($result['paymentStatus'] == 1)) { echo base_url().'fullmembers/index';} else { echo '#'; } ?>" <?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) < 10) && ($_SESSION['UID'] != 1000) && ($result['paymentStatus'] == 0)) {?>onclick="ravsociety_permission('To access this you need to be switch on member ( Level-1 Step-3 )'); return false;" <?php } ?>> Full Member<span>
        <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 10 || ($this->session->userdata('userId') == 1076) || ($result['paymentStatus'] == 1)) {?>
        Open
        <?php }else{?>
        Locked
        <?php }?>
        </span><span class="level">Level - 2</span> </a> </li>
         
      <li><a href="<?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) >= 50) || ($_SESSION['userId'] == 1000) /*|| ($result['paymentStatus'] == 1)*/)  { echo '#';} else { echo '#'; }?>" <?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) < 50) && ($_SESSION['UID'] != 1000) /*&& ($result['paymentStatus'] == 0)*/) {?> onclick="ravsociety_permission('To access this need more than 50 membership'); return false;"<?php }else{?>onclick="return false;"<?php }?>> The Source<span>
        <?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) >= 50) || ($_SESSION['userId'] == 1000)) {?>
        Open
        <?php }else{?>
        Locked
        <?php }?>
        </span><span class="level">Level - 3</span> </a></li>
      <li><a href="<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 100 || ($_SESSION['userId'] == 1000)/* || ($result['paymentStatus'] == 1)*/) { echo base_url().'/ravestorysociety/regcontact';} else { echo '#'; } ?>"  <?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) < 100) && ($_SESSION['UID'] != 1000)/* && ($result['paymentStatus'] == 0)*/) {?> onclick="ravsociety_permission('To access this need more than 100 membership'); return false;"<?php }?>> Society Owner<span>
        <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 100 || ($_SESSION['userId'] == 1000)) {?>
        Open

        <?php }else{?>
        Locked
        <?php }?>
        </span><span class="level">Level - 4</span> </a></li>
      <li><a href="<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 200 || ($_SESSION['userId'] == 1000)) { echo base_url().'/ravestorysociety/divinomanage';} else { echo '#'; } ?>"  <?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) < 200)&& ($_SESSION['UID'] != 1000)) {?> onclick="ravsociety_permission('To access this need more than 200 membership'); return false;"<?php }?>> Create Your Lodge <span>
        <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 200 || ($_SESSION['userId'] == 1000)) {?>
        Open
        <?php }else{?>
        Locked
        <?php }?>
        </span><span class="level">Level - 5</span> </a></li>
    </ul>
  </nav>
  <div class="clear"></div>
</div>
<div class="main_container_new"> 
  
  <!-- lefts side start -->
  
  <div class="lefts_side"> 
    
    <!--tab start-->
    
    <div class="tabsectionstep">
      <div class="containertab">
        <ul class="tabs">
        </ul>
        <div class="tab_container" style="width:610px;">
         <!--step1 open-->
          <div class="tab_content" id="tab1" style="display: block;">
        
            <div class="yvideo extra-pad">
             <span class="watch-thisvideo"><?php echo $stepWiseVideo[1][1]["content_title"];?></span>
            <div class="palvidd" style="width:556px; height:320px;"><a href="javascript:void(0)" id="tutorial-video201"><img src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[1][1]["content_image"];?>" width="573" height="320" alt="" /> </a></div>
             </div>
             
             
            <h3 class="headign-left"><?php echo $stepWiseVideo[1][1]["content"];?></h3>
            <div class="rarrow"><img src="<?php echo base_url(); ?>images/rarrow.png" border="0" alt=""  /></div>
            
            <div class="clear"></div>
            <div class="ab"> 
           <!--Blog A start -->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["A"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["A"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1A" name="<?php echo $stepWiseVideo[1]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
             <div class="white-space pp st1">
                </div>
              
              <br class="clear" />
              <!--Blog A stop -->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["B"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["B"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1" name="<?php echo $stepWiseVideo[1]["B"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[1]["B"]["content"];?></h3>
                  
                </div>
              <div class="clear"></div>
              
              <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[1]["C"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["C"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2" name="<?php echo $stepWiseVideo[1]["C"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              
             
             
              
              <div class="clear"></div>
              
              <!--            <div class="ab_inner"><strong>d</strong><h3>Collect your Rave Business Kit</h3>-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["D"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["D"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1A" name="<?php echo $stepWiseVideo[1]["D"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
                  
                </div>
              <div class="clear"></div>
              
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["E"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["D"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1A" name="<?php echo $stepWiseVideo[1]["D"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
                  <div class="gal_se_agre">
                    <br class="clear">
                  </div>
                </div>
              <br class="clear">
              
              
              <div class="ab_inner"><strong>G</strong>
                <h3 class="d_hdr">Move To The Next Step</h3>
                <span id="passCh"><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["F"]["path"];?>" id="tutorial-videoS5" href="javascript:void(0)">Watch Video</a></span> </div>
              <p align="right"><a id="step2" href="javascript:void(0)" rel="tab2" onclick="showSecondTab()" style="font-size:22px; color:#f00; margin-right:38px;">Now Complete Step 2 ></a></p>
              <?php if($_REQUEST["replycc"]=="success"){?>
              <span class="err-succ">Successfully Inserted</span>
              <?php }?>
              <?php if($_REQUEST["replycc"]=="error"){?>
              <span class="err-notsucc">Due to some problem it can't updated! </span>
              <?php }?>
              
                           </span> <br />
            </div>
            <br class="clear" />
            <?php 

						if($_SESSION['UID'] == 1000){

							if(!empty($result["totalchild_admin_view"])){?>
            <div id="person_list1" style="cursor:pointer; padding-left:40px;">Click to view List of person not belongs to US,Canada,UK</div>
            <div class="fabs" id="plist1" style="display:none";>
              <h3>Non UK person</h3>
              <p>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:20px; border:1px solid #ccc; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif; color:#000;">
                <tr>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Name</td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Email</td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Total Child</td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Reset</td>
                </tr>
                <?php

						  	//print_r($result["totalchild_admin_view"]);

						  	foreach($result["totalchild_admin_view"] as $key=>$val){?>
                <tr>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_name"];?></td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_email"];?></td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><div id="count_child_<?php echo $key;?>"><?php echo $val["total_child"];?></div></td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><div id="loader_<?php echo $key;?>" class="refreshimage"> <img src="<?php echo base_url(); ?>images/reset.png" border="0" width="15" height="15" alt="" <?php if($val["total_child"]!=0){?>onclick="resetFreeBies('<?php echo $key;?>')" style="cursor:pointer;" <?php }?>> </div></td>
                </tr>
                <?php }?>
              </table>
              </p>
            </div>
            <?php }

						}?>
            
            <!--ab end--> 
            
          </div>
          
        </div>
      </div>
    </div>
    
    <!-- tab end--> 
    
  </div>
  <div class="rights_side">
    <div class="nitify-menu">
      <ul>
        <li><a href="#"><i class="fa fa-laptop"></i><span class="notify-ribon">15</span></a></li>
        <li><a href="#"><i class="fa fa-heart"></i><span class="notify-ribon">7</span></a></li>
        <li><a href="#"><i class="fa fa-globe"></i><span class="notify-ribon">2</span></a></li>
        <li><a href="javascript:void(0);" id="getNames" class="watch-video-tut"><i class="fa fa-dashboard"></i><span class="notify-ribon"><?php echo $result['getCounterJoins']; ?></span></a></li>
      </ul>
    </div>
    <div class="sm extra-no-pad">
      <ul class="social_media extra-width">
        <li class="sm001"> <a href="javascript:void(0)" id="serviceList_1" onclick="funToggleSupport(this.id)">Customer Support / Help</a>
          <div id="slist_1" class="list_service">
            <form method="post" action="<?php echo base_url();?>dashboard/services/customer">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td><label for="textfield">Email Id:</label></td>
                    <td><input type="text" id="customerServiceEmail" class="custEmailClass" name="email"></td>
                  </tr>
                  <tr>
                    <td><label for="textarea">Message:</label></td>
                    <td><textarea rows="5" cols="31" id="customerServiceMsg" class="custMessageClass" name="message"></textarea></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Submit" id="customerServiceSubmit" name="customerServiceSubmit" ></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </li>
        <li class="sm002"> <a id="serviceList_2" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Tech Support </a>
          <div id="slist_2" class="list_service">
            <form method="post" action="<?php echo base_url();?>dashboard/services/tech_support">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td><label for="textfield">email:</label></td>
                    <td><input type="text" id="advertisingEmail" class="custEmailClass" name="email"></td>
                  </tr>
                  <tr>
                    <td><label for="textarea">message:</label></td>
                    <td><textarea rows="5" cols="31" id="advertisingMsg" class="custMessageClass" name="message"></textarea></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Submit" id="advertisingSubmit" name="advertisingSubmit" ></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </li>
        <li class="sm003"> <a id="serviceList_3" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Advertising </a>
          <div id="slist_3" class="list_service">
            <form method="post" action="<?php echo base_url();?>dashboard/services/advertise">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td><label for="textfield">email:</label></td>
                    <td><input type="text" id="advertisingEmail" class="custEmailClass" name="email"></td>
                  </tr>
                  <tr>
                    <td><label for="textarea">message:</label></td>
                    <td><textarea rows="5" cols="31" id="advertisingMsg" class="custMessageClass" name="message"></textarea></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Submit" id="advertisingSubmit" name="advertisingSubmit" ></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </li>
        <li class="sm007"> <a href="javascript:void(0)" id="serviceList_4" >Listen to Rave Story Radio</a> 
        </li>
   
      </ul>
    </div>
    <div id="analytics" class="blue-box webbox">
      <p class="ana">ANALYTICS</p>
      <ul>
        <li>Switched On Members :<span> <?php echo count($result['CHILDUSERLIST']['REMAINPAID']);?></span></li>
        <li>My Sign Ups : <span><?php echo ($result['showUserFreeTriel']['totalTriel'] !='')?$result['showUserFreeTriel']['totalTriel']:0;?></span></li>
        <li> Visitors to my website : <span><?php echo $result['VISITEDMEMBERS'];?></span></li>
        <li>My Ticket Sales : <span><?php echo $result['eventsTickets'];?></span></li>
        <li>My Music Sales : <span><?php echo $result['musicSell'];?></span></li>
        <li>My E-book Sales :<span> <?php echo $result['bookSell'];?></span></li>
      </ul>
    </div>
     <!--right side profile picture-->
  <!-- <div class="ash">
      <div class="">
        <?php foreach($list as $pic){ ?>
        <?php if ($pic->profile == ""){?>
        <?php echo $pic->profile; ?> <img id="empPic" style="margin-right:25px;" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg"  width="70" height="70" alt="">
        <?php } ?>
        <?php if ($pic->profile != ""){?>
        <img id="empPic" style="margin-right:25px;" src="<?php echo $this->config->item('gbe_base_url');?>useruploads/<?php echo $pic->profile;?>"  width="70" height="70" alt="">
        <?php } ?>
        <?php } ?>
      </div>
      <span class="ash_postion">You are introduced to ravebusiness by</span> 
       <span class="ash_title"><?php echo $userInfo[0]["firstName"];?> <?php echo $userInfo[0]["lastName"];?></span> 
      <span class="ash_mail phn"> <?php echo $userInfo[0]["phone"];?></span>
       <span class="ash_mail"><a href="mailto:<?php echo $userInfo[0]["emailID"];?>"> <?php echo $userInfo[0]["emailID"];?></a></span> 
      
 
      
      <div class="ash_social"> <a href="<?php echo $result['userSocialDetails'][0]['facebook'];?>" target="_blank"><img src="<?php echo base_url(); ?>images/ash-fb.png" /></a> <a href="skype:<?php echo $result['userSocialDetails'][0]['skypeid'];?>?call" target="_blank"><img src="<?php echo base_url(); ?>images/skype_square_color-32.jpg" /></a> <a href="<?php echo $result['userSocialDetails'][0]['social_youtube'];?>" target="_blank"><img src="<?php echo base_url(); ?>images/youtube.jpg" /></a> <a href="<?php echo $result['userSocialDetails'][0]['social_twitter'];?>" target="_blank"><img src="<?php echo base_url(); ?>images/ash-tw.png" /></a> <a href="<?php echo $result['userSocialDetails'][0]['social_rave_blog'];?>" target="_blank"><img src="<?php echo base_url(); ?>images/ash-wp.png" /></a> </div>
    </div>-->
    <?php if( $result["tenDollarPaymentStatus"] == "1" ){ ?>
    <br class="clear" />
    <div class="giftdis">
      <h2>Free Gifts & Discounts </h2>
      <div class="cont">
        <?php foreach( $result["getOffersDetails"] as $key=>$val){ ?>
        <div class="postcont">
          <h3><?php echo $result["getOffersDetails"][$key]["dealoffer"];?></h3>
          <div class="imgcoll"><img src="<?php echo BASE_PATH_RAVE.'/'.UPLOAD_PATH.'deal/tmb'.$result['getOffersDetails'][$key]['dealofferfile_image']; ?>"></div>
          <a href="<?php echo BASE_PATH_RAVE.'/'.UPLOAD_PATH.'deal/'.$result['getOffersDetails'][$key]['dealofferfile']; ?>" class="colle">Collect</a> </div>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
  </div>
  <div class="clear"></div>
    <!-- rights side end -->
</div>

<!-- 15/09/2015 ujjwal sana -->
<!--footer style--> 

<script type="text/javascript">
var postImage = "<?php echo count($result['getFbPictureUpload']); ?>";

var countBanner = "<?php echo count($result['showUserBanner']); ?>";

var postYoutube = "<?php echo count($result['getYoutubeUrlLink']); ?>";


$(document).ready(function() {
	//Default Action
	//11/09/2015 done by ujjwal sana
	 var tabId = '<?php echo $openTabId;?>';
	
	 if(tabId=="tab4")
	 {	
	 	showForthTab();
	 }else if(tabId=="tab3")
	 {
		 showThirdTab();
	 }	
	 else if(tabId=="tab2")
	 {
		 showSecondTab();
	 }
	else
	{
		showFirstTab();
	
	}

	//On Click Event

	$("ul.tabs li").click(function(e) {

		for(var k=0;k<postYoutube;k++){		

		$('a#postYoutube'+k).zclip({			

			path:'<?php echo base_url(); ?>/Application/content/member/js/ZeroClipboard.swf',			

			copy:$('input#youtube'+k).val(),

			beforeCopy:function(){

			    $('input#youtube'+k).css('background','yellow');

				$(this).css('color','orange');

			},

			afterCopy:function(){

			    $('input#youtube'+k).css('background','green');

				$(this).css('color','white');

				$(this).next('.check').show();

			}

		});

	}
		$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$(this).addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("rel"); //Find the rel attribute value to identify the active tab + content

		//alert(activeTab);

		$('#'+activeTab).fadeIn(); //Fade in the active content

		e.preventDefault();

		//return false;

	});
});

$(document).ready(function() {

	$("#getNames").click(function() {

		$.fancybox.open('<?php for($i=0;$i<count($result['getNamesUID']);$i++){?><li><?php echo $result['getNamesUID'][$i]['FirstName']."&nbsp;".$result['getNamesUID'][$i]['LastName']; ?></li><?php }?>');

	});

	$("#tutorial-video1A").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/PuehFznvJUY?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video1").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/QtNQi_xKbwk?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video2").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/pZuT6raA3UQ?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video3").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/G-9NluGYpWg?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video4").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/cThsfY1zqUc?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video5").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/z6kG-TKjUzE?autoplay=1"  frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video6").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/KoUxlvQYE3c?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video7").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/tX3vzehrmn0?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video8").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/fqZvPKfX2lE?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video9").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/GHoNI_pcLuU?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video10").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/EaC2L9iu9QE?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video11").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/FzeTSC2igzo?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video12").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/uFwpnTKQk0Q?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video13").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/mmxZBcCovSo?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video141").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/Y6Sd9G78ufA?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video142").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/Hn4jqzYUHN8?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video150").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/8QwOi4-fHyo?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video151").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/dJf4snUP-Is?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video152").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/WyqzLyRPHWM?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video153").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/jRd1GGlze9E?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video154").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/Ns2LiV-xXpY?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video15").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/s4YS7eDZDg8?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video16").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/pr4_JoYxj4Y?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video17").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/sto_jKuT8lc?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video18").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/zfAuX6a_V5w?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video19").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/0AozfWahm3g?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video20").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/pvAjhTn8ntI?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	

	$("#fancybox-contact").click(function() {

	    var userid = $.trim($("#gmail_yahoo_user").val());

		var pwd    = $.trim($("#gmail_yahoo_pwd").val());

		var type   = $("#gmail_yahoo_flag").val();

		if(type=='yahoo'){

			$.fancybox.open($("#cont").css("display","block"));

			$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

			$.ajax({

				type: "POST",

				data: "userid="+userid+"&pwd="+pwd,

				url: "<?php echo base_url(); ?>/ravestorysociety/getYahooContact",

				success: function(data) {

					//alert(data);

					$.fancybox.open($("#cont").css("display","block"));

					$.fancybox.open($("#cont").html(data));

				}

			});	

		}

		if(type=='gmail'){

			$.fancybox.open("demo");

			$.fancybox.open($("#cont").css("display","block"));

			$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

			$.ajax({

				type: "POST",

				data: "userid="+userid+"&pwd="+pwd,

				url: "<?php echo base_url(); ?>/ravestorysociety/getGmailContact",

				success: function(data) {

					/*alert(1111);

					alert(data);*/

					$.fancybox.open($("#cont").css("display","block"));

					$.fancybox.open($("#cont").html(data));

				}

			});	

		}

		//$.fancybox.open($("#cont").css("display","block"));

	});	

});



$(document).ready(function() {

	$("#person_list").click(function(){

		$("#plist").slideToggle();

	})	

});



$(document).ready(function() {

	$("#person_list1").click(function(){

		$("#plist1").slideToggle();

	})	

});
function funToggleSupport(id){
	var myArray = id.split('_');
	//alert(myArray);
	$("#slist_"+myArray[1]).slideToggle();
}


function resetFreeBies(uid){

	if(confirm("Are you sure you want to reset?")){

	 $("#loader_"+uid).html('<img src="<?php echo base_url(); ?>/Application/content/member/images/loader.gif" />');	

		$.ajax({

			type: "POST",

			data: "uid="+uid,

			url: "<?php echo base_url(); ?>/ravestorysociety/updateFreebiesStatus",

			success: function(data) {

				if(data=="success"){

					$("#count_child_"+uid).html(0);

					$("#loader_"+uid).html('<img src="<?php echo base_url(); ?>/Application/content/member/images/reset.png" width="15" height="15" />');

				}

			}

		});	

	}

}

$(document).ready(function() {
	
	$(".share-btn").click(function(e){

		$(this).parent().find('.share-popup').fadeIn(1000);

	 }); 

	$(".share-btn").blur(function(e){

		$(this).parent().find('.share-popup').fadeOut(1000);

	});
	jQuery('#mycarousel').jcarousel();
	});	

</script>
<?php 

      if( $_REQUEST["action"] == "gmailContactImport"){

		  $arr = json_decode($_REQUEST["contactList"]);

		  

		  $str="";

          $str.="<form name=\"frm\" method=\"post\" action=\"".base_url()."/ravestorysociety/sendEmailToContactList\">";

          $str.="<input type=\"checkbox\" name=\"select_all\" id=\"selectall\" > Select ALL <br>";

		  foreach ($arr as $key=>$val){

	        foreach($val as $eml){

				//$val2 = $arr["gmailContactList"][$key];

				$str.="<input type=\"checkbox\" name=\"email_id[]\" class=\"case\" value=\"$eml\"> ".$eml."<br>";

			}

          }

         $str.="<input type=\"hidden\" name=\"reffer_id\" value=\"".$_SESSION['UID']."\">";

         $str.="<input type=\"hidden\" name=\"sender_email\" value=\"".$_REQUEST['userid']."\">";

         $str.="<input type=\"submit\" name=\"send_mail\" value=\"submit\">";

         $str.="</form>";
?>
<script>  

      $(document).ready(function() {

	  	$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		$("#tab2").fadeIn(); //Fade in the active content

	  });

	  


      </script> 
<script language="javascript">

$(document).ready(function() {

	// add multiple select / deselect functionality

    $("#selectall").click(function () {

          $('.case').attr('checked', this.checked);

    });    $(".case").click(function(){


});

</script>
<?php 

	  }

?>
<?php 

      if( $_REQUEST["action"] == "yahooContactImport"){

		  $arr = json_decode($_REQUEST["contactList"]);

		  //print_r($arr);

		  $str="";

          $str.="<form name=\"frm\" method=\"post\" action=\"".base_url()."/ravestorysociety/sendEmailToContactList\">";

          $str.="<input type=\"checkbox\" name=\"select_all\" id=\"selectall\" > Select ALL <br>";

		  foreach ($arr as $key=>$val){

	        $str.="<input type=\"checkbox\" name=\"email_id[]\" class=\"case\" value=\"$eml\"> ".$val."<br>";

		  }

          $str.="<input type=\"hidden\" name=\"reffer_id\" value=\"".$_SESSION['UID']."\">";

          $str.="<input type=\"hidden\" name=\"sender_email\" value=\"".$_REQUEST['userid']."\">";

          $str.="<input type=\"submit\" name=\"send_mail\" value=\"submit\">";

          $str.="</form>";

        

?>
<script>  

      $(document).ready(function() {

	  	$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		$("#tab2").fadeIn(); //Fade in the active content

		

		loadGmailContactRes();

	  });

	  

	  function loadGmailContactRes(){

		$.fancybox.open("demo");

		$.fancybox.open($("#cont").css("display","block"));

		$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

		

		$.fancybox.open($("#cont").css("display","block"));

		$.fancybox.open($("#cont").html('<?php echo $str;?>'));

	  }

      </script> 

<?php 

	  }

?>
