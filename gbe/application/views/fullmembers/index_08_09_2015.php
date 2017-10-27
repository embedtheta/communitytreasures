
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>GBE Level 2</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/level2.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/p_color.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/carosel.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>

<script type="text/javascript">


function readURL(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
         $('#empPic').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}

 $(document).ready(function(){
	 var totYouTube = <?php echo count($upYoutube);?>;
	 for( var yy = 1;yy <= totYouTube;yy++){
		$("a#copyUrl_"+yy).zclip({
			path:'<?php echo base_url(); ?>js/ZeroClipboard.swf',	
			copy: $("#copyUrl_"+yy).attr("name")
		}); 
	 }
		
 });


</script>

<script src="<?php echo base_url(); ?>js/organictabs.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.jcarousel.min.js"></script>

<script>
 $(document).ready(function(){
	 
	$(".share-btn").click(function(e){
		$(this).parent().find('.share-popup').fadeIn(1000);	
	}); 
	$(".share-btn").blur(function(e){
		$(this).parent().find('.share-popup').fadeOut(1000);
	});
	 
	$('.pull').click(function(){
	 	$('.misc_new').slideToggle();
	});
	
	 $(".containertab").organicTabs({
		"speed": 200
	});
			
	$(".tab_content").hide();
	$("#tab1").show();
	$(".tabClass").unbind().bind("click",function(){
		$(".tabClass").removeClass("current");
		var id = $(this).attr("name");
		$(".tab_content").hide();
		$(this).addClass("current");
		$("#"+id).show();
	});
	
	var tabId = '<?php echo $openTabId;?>';
	//var tabId = 'tab2';
	if(tabId != ""){
		$(".tab_content").hide();
		$("#"+tabId).removeClass('hide');
		$("#"+tabId).show();
	}
	
	jQuery('#mycarousel').jcarousel({scroll:3,visible:3});
	
	
	$("#emailID").change(function(){
		var email = $("#emailID").val();
		var retD = emailValidation(email);
		if(retD != ""){
			$.fancybox.open(retD); 
			return false;	
		}
		var url = "<?php echo base_url();?>fullmembers/uniqueEmailCheckingAjax" ;
		$.post(url,{emailID:email,emailType:1}).done(function(data){ 
			if(data > 0){ 
				$.fancybox.open("Email '"+email+"' is already used.Please try with another email."); 
			}
		});
	});
	
	$("#submitPostId").unbind().bind("click", function(){
		 var post_title = $("#post_title_edit").val();
		 if(post_title == ""){
			$.fancybox.open("Please enter the Post Title."); 
			$("#post_title_edit").focus();
			return false;	
		 }
		return true;
		
	});
	$("#submitPostAddId").unbind().bind("click", function(){
		 var post_title = $("#post_title").val();
		 if(post_title == ""){
			$.fancybox.open("Please enter the Post Title."); 
			$("#post_title").focus();
			return false;	
		 }
		 return true;
		//return false;
	});
	
	$(".extra-blue-btn").unbind().bind("click", function(){
		 var urlId = $(this).attr("id");
		 var url = $("#url_displayer_"+urlId).val();
		 
		 if(urlId == 2){
			var check3 =  $("#check3").val();
			if(check3 >= 3){
				$.fancybox.open("You have already added 3 youtube link in this month.<br>So please add to next month.");
				return false; 
			}
		 }
		 
		 if(url == ""){
			$.fancybox.open("Please enter the Youtube Link."); 
			$("#url_displayer_"+urlId).focus();
			return false;	
		 }
		 
		 return true;
		//return false;
	});
	<?php if($totalMembersUnderMe >= 10){?>
	$.fancybox.open('<div class="switch mov_up"><h2>Congratulations</h2><h3>You have enough people to move up.</h3><h4>Click "Move Up" to get the licence to sell<br> the product Package of Level 2.<br> You will also make large commission too.</h4><h5>60 will Be deducted from your GBE Profits</h5><p class="termsCond"> <input type="checkbox" class="ckbxe"> <span>Terms & Conditions</span></p><div class="switch_extrapara"><p class="swt_img"><img width="424" height="81" style="cursor:pointer" alt="" src="<?php echo base_url();?>images/move_up.png"></p> </div></div>');
	<?php }?>
	
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
         
        <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>
          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] > 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>
          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] > 2){ echo base_url()."diversity";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Level - 3</span> Diversity<span> Open </span></a></li>
          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo base_url()."corporation";}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Level - 4</span> Corporation <span> Open </span> </a></li>
          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] > 4){ echo base_url()."summit";}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Level - 5</span>Summit<span> Open </span> </a></li>
          
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
  </header>
  <!--header end-->
  
  <div class="main_container">
    <div class="lefts_side">
      <div class="tabsectionstep">
        <div class="containertab">
          <ul class="tabs">
            <li><a href="#tab1" class="tabClass <?php if($openTabId == "" || $openTabId == "tab1"):?>current<?php endif; ?>" name="tab1">Step1</a></li>
            <li><a href="#tab2" class="tabClass <?php if($openTabId == "tab2"):?>current<?php endif; ?>" name="tab2">step2</a></li>
            <li><a href="#tab3" class="tabClass <?php if($openTabId == "tab3"):?>current<?php endif; ?>" name="tab3">step3</a></li>
            <li><a href="#tab4" class="tabClass <?php if($openTabId == "tab4"):?>current<?php endif; ?>" name="tab4">step4</a></li>
          </ul>
          <div class="tab_container main_cntnr">
            <div id="tab1" class="tab_content">
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[1][1]["content_title"];?></span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[1][1]["content_image"];?>" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[1][1]["path"];?>" allowfullscreen=""></iframe>
                  </div>
                </div>
                <h3 class="headign-left"> <?php echo $stepWiseVideo[1][1]["content"];?></h3>
                <h3 class="heading-right"><img border="0" alt="" src="<?php echo base_url();?>images/rarrow.png"></h3>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["A"]["serial_field"];?> </strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["A"]["title"];?></h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="<?php echo $stepWiseVideo[1]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
                <div class="white-space pp st1">
                  <h3 style="margin-bottom: 8px; padding-left:38px;"><?php echo $stepWiseVideo[1]["A"]["content"];?></h3>
                  <form enctype="multipart/form-data" action="<?php echo base_url();?>fullmembers/updateUserInfo" method="post" id="frm_new">
                  	<input type="hidden" name="emailType" value="2">
                    <label><span> Add your skype ID </span>
                      <input type="text" value="<?php echo $userInfo[0]['skypeID'];?>" name="skypeID" id="skypeID">
                    </label>
                    <label> <span>Cell Number </span>
                      <input type="text" value="<?php echo $userInfo[0]['phone'];?>" name="phone" id="phone">
                    </label>
                    <label> <span>Email ID </span>
                      <input type="text" value="<?php echo $userInfo[0]['emailID'];?>" name="emailID" id="emailID">
                    </label>
                     <label> <span>Facebook/group </span>
                      <input type="text" value="<?php echo $userInfo[0]['facebookLink'];?>" name="facebookLink" id="facebookLink">
                    </label>
                    <label> <span>My Blogger </span>
                      <input type="text" value="<?php echo $userInfo[0]['myBlogger'];?>" name="myBlogger" id="myBlogger">
                    </label>
                    <label> <span>Twitter </span>
                      <input type="text" value="<?php echo $userInfo[0]['twitterLink'];?>" name="twitterLink" id="twitterLink">
                    </label>
                    <label> <span>Youtube </span>
                      <input type="text" value="<?php echo $userInfo[0]['youTubeUrl'];?>" name="youTubeUrl" id="youTubeUrl">
                    </label>
                    <label><span>Add Photo</span>
                      <input type="file" onchange="readURL(this);" value="Add photo" name="profile" class="brws">
                      <input type="hidden" name="tempImage" value="<?php echo $userInfo[0]['profile'];?>">
                     </label>
                    <label>
                    <div id="contact-image"><img alt="" src="<?php echo base_url().'useruploads/'.$userInfo[0]['profile'];?>" id="empPic"></div>
                    </label>
                    <label>
                    <p style="float:left!important;width:350px!important"><!--I agree to promote & celebrate Ravers Day on<br/> 
			  April 16th - each year.--></p>
                    <input type="submit" style="float:right;" value="Update" name="update" id="updateID" class="extra-blue-btn">
                    <!-- <div class="clear">Content for  class "clear" Goes Here</div>-->
                    <div class="clear"></div>
                    </label>
                  </form>
                </div>
                <div class="ab_inner "><strong><?php echo $stepWiseVideo[1]["B"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[1]["B"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["B"]["path"];?>" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[1]["B"]["content"];?></h3>
                  <label class="pstlcd"><span>Zip / Postal Code</span>
                    <input type="text" value="">
                  </label>
                </div>
                
                <!--end white-space-->
                
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["C"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[1]["C"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["C"]["path"];?>" id="tutorial-videoS3" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="table-status">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="talentst" class="user_tln">
  <tbody>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
  </tbody>
</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="talentst" class="user_tln">
  <tbody>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
    <tr>
      <td>Jonathan Hinds</td>
      <td>1062</td>
      <td>07466032702</td>
      <td>mrjahinds@aol.co.uk</td>
      <td>Philippines</td>
    </tr>
  </tbody>
</table>
	


	</div>
                <br class="clear">
                <div class="ab_inner "><strong><?php echo $stepWiseVideo[1]["D"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[1]["D"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["D"]["path"];?>" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <div class="gal_se">
                    <ul>
                      <li><img src="<?php echo base_url();?>images/gal_01.png" alt="" >
                        <p>01</p>
                      </li>
                      <li><img src="<?php echo base_url();?>images/gal_02.png" alt="" >
                        <p>15</p>
                      </li>
                      <li><img src="<?php echo base_url();?>images/gal_03.png" alt="" >
                        <p>00</p>
                      </li>
                      <li><img src="<?php echo base_url();?>images/gal_04.png" alt="" >
                        <p>09</p>
                      </li>
                      <li><img src="<?php echo base_url();?>images/gal_05.png" alt="" >
                        <p>20</p>
                      </li>
                      <li><img src="<?php echo base_url();?>images/gal_06.png" alt="" >
                        <p>67</p>
                      </li>
                    </ul>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner "><strong><?php echo $stepWiseVideo[1]["E"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[1]["E"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["E"]["path"];?>" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <div class="gal_se_agre">
                    <div class="agr_lft">
                      <?php echo $stepWiseVideo[1]["E"]["content"];?>
                      <a href="<?php echo base_url();?>fullmembers/sendAgrreEmail" class="r-blog">Agree</a></div>
                    <div class="img_agre"><img src="<?php echo base_url();?>images/agre.png" alt="" >
                      <p>01</p>
                    </div>
                    <br class="clear">
                  </div>
                </div>
                <br class="clear">
              </div>
            </div>
            
            <!--1tab end......... --> 
            
            <!--2tab Start......... -->
            <div id="tab2" class="tab_content">
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[2][1]["content_title"];?></span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[2][1]["content_image"];?>" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[2][1]["path"];?>" allowfullscreen=""></iframe>
                  </div>
                </div>
                <h3 class="headign-left"> <?php echo $stepWiseVideo[2][1]["content"];?></h3>
                <h3 class="heading-right"><img border="0" alt="" src="<?php echo base_url();?>images/rarrow.png"></h3>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["A"]["serial_field"];?></strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["A"]["title"];?></h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="<?php echo $stepWiseVideo[2]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
                <p><?php echo $stepWiseVideo[2]["A"]["content"];?></p>
                <div class="ved"> 
                  <!--<span class="nxt"><img src="http://220.225.90.155/rave_store_socity/Application/content/member/images/next.png" /></span>
            <span class="prv"><img src="http://220.225.90.155/rave_store_socity/Application/content/member/images/prev.png" /></span>-->
                  <h4>Popular Uploads</h4>
                  <div class=" jcarousel-skin-tango">
                    <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;">
                      <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                        <ul class="jcarousel-list jcarousel-list-horizontal" id="mycarousel" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 1042px;">
                        <?php if(count($upYoutube) > 0): $i = 1;foreach($upYoutube as $vyt):?>
                          <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: outside none none;" jcarouselindex="1">
                            <iframe width="138" height="103" src="<?php echo $vyt->url;?>" frameborder="0" allowfullscreen></iframe>
                            <!--<h5>Dancing SuperStar </h5>-->
                            <a class="share-btn" href="javascript:void(0)">Share</a> 
                            <a class="download-btn" id="copyUrl_<?php echo $i;?>" name="<?php echo $vyt->url;?>" href="javascript:void(0)">Copy</a>
                            <div class="clear"></div>
				  <div style="background-color:#fff; display:none" id="shareZone1" class="share-popup">
					  <ul id="logoZone" >
					  
						   <li><a href="javascript:void(0)" id="button" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $vyt->title;?>&amp;p[summary]=<?php echo $vyt->desc;?>&amp;p[url]=<?php echo urlencode($vyt->url); ?>', 'sharer', 'toolbar=0,status=0,width=550,height=400');" target="_parent"><img src="<?php echo base_url(); ?>images/facebook.png" border="0" /></a></li>
                           
						   <li><a href="javascript:void(0)" onclick="window.open('http://twitter.com/share?text=<?php echo $vyt->title;?>&url=<?php echo urlencode($vyt->url); ?>', 'child', 'scrollbars,width=650,height=600'); return false"><img src="<?php echo base_url(); ?>images/twitter.png" border="0" /></a></li>
                           
						   <li><a href="javascript:void(0)" onclick="window.open('https://plus.google.com/share?url=<?php echo urlencode($vyt->url); ?>&title=<?php echo $vyt->title;?>&caption=<?php echo $vyt->title;?>&description=<?php echo  $vyt->desc;?>', 'child', 'scrollbars,width=650,height=600'); return false"><img src="<?php echo base_url(); ?>images/google_plus.png" border="0" /></a></li>
				    </ul>
				  </div>
                          </li>
                          <?php endforeach;endif;?>
                         
                          
                        </ul>
                      </div>
                    </div>
                  </div>
                  
                  
                </div>
                <hr class="mod">
                <div class="ved"> 
                  
                 
                </div>
                <div class="ab">
                  <div class="ab_inner "><strong><?php echo $stepWiseVideo[2]["B"]["serial_field"];?></strong>
                    <h3><?php echo $stepWiseVideo[2]["B"]["title"];?></h3>
                    <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[2]["B"]["path"];?>" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                  <div class="white-space">
                    <form action="<?php echo base_url();?>fullmembers/addYoutubeUrl" method="post">
                    <input type="hidden" name="show_for" value="up">
                    <input type="hidden" name="admin_approval" value="inactive">
                      <label>
                      <h6 style="width:auto;">Add Your Own Youtube Url</h6>
                      <input type="text" onblur="if(this.value == ''){this.value ='Enter youtube url'}" onfocus="if(this.value == 'Enter youtube url') {this.value=''}" class="extra-text" id="url_displayer_1" name="url" value="" placeholder="Enter youtube url">
                      <input type="submit" class="extra-blue-btn" name="url_displayer_btn" id="1" value="Add" >
                      </label>
                      <div class="clear"></div>
                    </form>
                  </div>
                  <br class="clear">
                  <!--end white-space-->
                  <div class="ab_inner "><strong><?php echo $stepWiseVideo[2]["C"]["serial_field"];?></strong>
                    <h3><?php echo $stepWiseVideo[2]["C"]["title"];?></h3>
                    <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[2]["C"]["path"];?>" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                  <h2><?php echo $stepWiseVideo[2]["C"]["content"];?></h2>
                 
                  <div class="sec-b paragraph">
                    <div id="disp_cont">
                    <?php if(count($downYoutube) > 0): foreach($downYoutube as $vyt):?>
                      <p><a target="_blank" href="<?php echo $vyt->url;?>"><?php echo $vyt->url;?></a><br></p>
                    <?php endforeach;endif;?>
                     <!-- <p><a target="_blank" href="https://www.youtube.com/watch?v=dPhJbViFnEI">https://www.youtube.com/watch?v=dPhJbViFnEI</a><br>
                      </p>
                      <p><a target="_blank" href="http://www.youtube.com/watch?v=8Biv_8xjj8E">http://www.youtube.com/watch?v=8Biv_8xjj8E</a><br>
                      </p>
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=cThsfY1zqUc">https://www.youtube.com/watch?v=cThsfY1zqUc</a><br>
                      </p>
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=TLjRtQDcL18">https://www.youtube.com/watch?v=TLjRtQDcL18</a><br>
                      </p>
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=9WQXXQlL9yU">https://www.youtube.com/watch?v=9WQXXQlL9yU</a><br>
                      </p>
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=9WQXXQlL9yU">https://www.youtube.com/watch?v=9WQXXQlL9yU</a><br>
                      </p>
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=9WQXXQlL9yU">https://www.youtube.com/watch?v=9WQXXQlL9yU</a><br>
                      </p>
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=Tx2FOrJgoWE">https://www.youtube.com/watch?v=Tx2FOrJgoWE</a><br>
                      </p>
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=Tx2FOrJgoWE">https://www.youtube.com/watch?v=Tx2FOrJgoWE</a><br>
                      </p>
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=dPhJbViFnEI">https://www.youtube.com/watch?v=dPhJbViFnEI</a><br>
                      </p>
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=fct-OgGoaLc">https://www.youtube.com/watch?v=fct-OgGoaLc</a><br>
                      </p>-->
                    </div>
                    <!--<div class="sec-b paragraph">
			   <p>Curabitur iaculis scelerisque venenatis. Nunc consequat ornare mi, aliquet eleifend purus malesuada vitae. 
Integer vulputate, elit sed consectetur auctor, est magna dignissim ligula, quis laoreet mauris tortor nec massa. 
Donc pretium mauris sed tincidunt pellentesque. Vestibulum placerat enim dolor, at condimentum sapien commodo eget. Curabitur iaculis scelerisque venenatis.</p>
<p>Curabitur iaculis scelerisque venenatis. Nunc consequat ornare mi, aliquet eleifend purus malesuada vitae. 
Integer vulputate, elit sed consectetur auctor, est magna dignissim ligula, quis laoreet mauris tortor nec massa. 
Donec pretium mauris sed tincidunt pellentesque. Vestibulum placerat enim dolor, at condimentum sapien commodo eget. Curabitur iaculis scelerisque venenatis.</p>
</div>-->
                    <div class="clear"></div>
                  </div>
                  <div class="ab_inner "><strong><?php echo $stepWiseVideo[2]["D"]["serial_field"];?></strong>
                    <h3><?php echo $stepWiseVideo[2]["D"]["title"];?></h3>
                    <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[2]["D"]["path"];?>" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                  <div class="white-space">
                    <form action="<?php echo base_url();?>fullmembers/addYoutubeUrl" method="post">
                    <input type="hidden" name="show_for" value="down">
                    <input type="hidden" name="admin_approval" value="active">
                    <input type="hidden" value="<?php echo $downYoutubeCount ;?>" name="check3" id="check3">
                      <label>
                      <h6 style="width:auto;">Add Your Own Youtube Url</h6>
                      <input type="text" onblur="if(this.value == ''){this.value ='Enter youtube url'}" onfocus="if(this.value == 'Enter youtube url') {this.value=''}" class="extra-text" id="url_displayer_2" name="url" value="" placeholder="Enter youtube url" <?php if($downYoutubeCount == 3){?> readonly <?php }?>>
                      <input type="submit" class="extra-blue-btn" name="url_displayer_btn" id="2" value="Add">
                      </label>
                      <div class="clear"></div>
                    </form>
                  </div>
                  <br class="clear">
                  <div class="ab_inner "><strong><?php echo $stepWiseVideo[2]["E"]["serial_field"];?></strong>
                    <h3><?php echo $stepWiseVideo[2]["E"]["title"];?></h3>
                    <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[2]["E"]["path"];?>" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                  <p align="right"><a style="font-size:22px; color:#f00; margin-right:38px;" onclick="showSecondTab()" rel="tab2" href="javascript:void(0)" id="step2">Now Complete Step 2 &gt;</a></p>
                  <br class="clear">
                </div>
              </div>
            </div>
            <!--2tab end......... --> 
            
            <!--3tab Start......... -->
            <div id="tab3" class="tab_content">
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[3][1]["content_title"];?></span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[3][1]["content_image"];?>" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[3][1]["path"];?>" allowfullscreen=""></iframe>
                  </div>
                </div>
                <h3 class="headign-left"><?php echo $stepWiseVideo[3][1]["content"];?></h3>
                <h3 class="heading-right"><img border="0" alt="" src="<?php echo base_url();?>images/rarrow.png"></h3>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[3]["A"]["serial_field"];?> </strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[3]["A"]["title"];?></h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="<?php echo $stepWiseVideo[3]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
                <p style="margin-top:13px;"><?php echo $stepWiseVideo[3]["A"]["content"];?></p>
                <a id="paiddmemberr" class="r-blog" href="<?php echo base_url();?>blog/<?php echo $userInfo[0]['userName'];?>">GBE Blogger</a>
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[3]["B"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[3]["B"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[3]["B"]["path"];?>" id="tutorial-videoS3" href="javascript:void(0)">Watch Video</a></span></div>
                <table width="478px" border="0" style="margin: 0px auto 0px 41px;">
                  <tbody>
                  <?php if(count($allPost) > 0): foreach($allPost as $ap):?>
                    <tr>
                      <td class="pic"><img width="40" height="40" src="<?php echo base_url();?>useruploads/<?php echo $ap->profile;?>"></td>
                      <td class="para"><p><?php echo $ap->post_title;?></p></td>
                      <td class="link"><a href="<?php echo base_url();?>fullmembers/copyPost/<?php echo $ap->post_id;?>">(Read &amp; Add)</a></td>
                    </tr>
                   <?php endforeach;else:?>
                    <tr>
                     
                      <td class="para" colspan="3"><p>No Post Please..</p></td>
                      
                    </tr>
                   <?php endif;?>
                  </tbody>
                </table>
                <br>
                <form action="<?php echo base_url();?>fullmembers/copyPostAdd" method="post" name="addPost" id="addPost">
                <h3> Title of The Article </h3>
                <p>
                  <input type="text" style="width:500px" value="<?php echo $post_title;?>" id="post_title_edit" name="post_title_edit" class="text_fild">
                </p>
                <br>
                <h3> Read First, Correct &amp; Copy - Paste into Your Rave Blog</h3>
                <p>
                 <?php echo $this->ckeditor->editor('post_content_edit',$post_content);?> <?php //echo form_error('post_content','<p class="error"></p>'); ?>
                </p>
                <br>
              <!--  
                 <h3> Post Category </h3>
                <p>
                  <select name="post_type_id">
                  <?php if(count($postCategoryList) > 0): foreach($postCategoryList as $pcl):?>
                  	<option value="<?php echo $pcl->term_id;?>"><?php echo $pcl->name;?></option>
                    <?php endforeach;endif;?>
                  </select>
                </p>
                <br>
                
                
                 <h3> Post Status </h3>
                <p>
                  <input type="radio" value="active" id="post_status" name="post_status" class="text_fild" checked>Active
                  <input type="radio" value="inactive" id="post_status" name="post_status" class="text_fild">Inactive
                </p>
                <br>
                 <h3> Comment Status </h3>
                <p>
                  <input type="radio" value="open" id="comment_status" name="comment_status" class="text_fild" checked>Open
                  <input type="radio" value="close" id="comment_status" name="comment_status" class="text_fild">Close
                </p>
                <br>-->
                <input type="submit" name="submitPost" value="Add Post" id="submitPostId" class="here">
                <br>
                </form>
                
                <!--<h3>Addable Picture</h3>
                <div id="articleBodyImg">
                  <ul>
                    <li><img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/v11.png"></li>
                    <li><img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/v12.png"></li>
                    <li><img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/v13.png"></li>
                    <li><img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/v14.png"></li>
                  </ul>
                  <div class="clear"></div>
                </div>-->
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[3]["C"]["serial_field"];?></strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[3]["C"]["title"];?></h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="<?php echo $stepWiseVideo[3]["C"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
                <p>Copy the url of your new completed blog  and ping it to other sites<u class="here" id="tutorial-video142">Here</u><br class="clear"></p>
                  <div class="ab_inner"><strong><?php echo $stepWiseVideo[3]["D"]["serial_field"];?> </strong>
                  
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[3]["D"]["title"];?></h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="<?php echo $stepWiseVideo[3]["D"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
                <p><?php echo $stepWiseVideo[3]["D"]["content"];?></p>
                  <p class="ad_pic_doc">
                  <form action="<?php echo base_url();?>fullmembers/addPost" method="post" name="addPost" id="addPost">
                        <h3> Title of The Post </h3>
                        <p>
                          <input type="text" style="width:500px" value="" id="post_title" name="post_title" class="text_fild">
                        </p>
                        <br>
                        <h3> Content of The Post</h3>
                        <p>
                         <?php echo $this->ckeditor->editor('post_content','');?> <?php //echo form_error('post_content','<p class="error"></p>'); ?>
                        </p>
                        <br>
                        <p> <input type="submit" name="submitPost" value="Add Post" id="submitPostAddId" class="here">
                        </p>
                        <br>
                        </form>
                  </p>
                       
                
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[3]["E"]["serial_field"];?></strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[3]["E"]["title"];?></h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="<?php echo $stepWiseVideo[3]["E"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
                <a style="font-size:22px; float: right; color:#f00; margin-right:38px;" onclick="loadVideoGallery()" href="#li_2">Now Complete Step 4</a>
                 </div>
            </div>
            
            <!--3tab end......... --> 
            
            <!--4tab Start......... -->
            <div id="tab4" class="tab_content">
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[4][1]["content_title"];?></span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[4][1]["content_image"];?>" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[4][1]["path"];?>" allowfullscreen=""></iframe>
                  </div>
                </div>
                <h3 class="headign-left"><?php echo $stepWiseVideo[4][1]["content"];?></h3>
                <h3 class="heading-right"><img border="0" alt="" src="<?php echo base_url();?>images/rarrow.png"></h3>
                <br class="clear">
                <div class="ab_inner "><strong><?php echo $stepWiseVideo[4]["A"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[4]["A"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[4]["A"]["content"];?></h3>
                  <ul class="twitter_user">
                  	<?php if(count($brochure) > 0): foreach($brochure as $br):?>
                    <li>
                      <div><img width="103" height="76" src="<?php echo base_url();?>adminuploads/brochureVcards/brochure/<?php echo $br->cover_img;?>"></div>
                      <div class="tpbb">
                      	
                      <a href="<?php echo base_url();?>fullmembers/downloadBrochure/<?php echo $br->file_name;?>" id="dwn">Download</a>
                      
                      </div>
                    </li>
                    <?php endforeach;else:?>
                    <li>No Brochure Please...</li>
                    <?php endif;?>
                   
                  </ul>
                </div>
                
                <!--end white-space-->
                
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["B"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[4]["B"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[4]["B"]["path"];?>" id="tutorial-videoS3" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[4]["B"]["content"];?></h3>
                  
                  <ul class="twitter_user">
                  <?php if(count($vcards) > 0): foreach($vcards as $vc):?>
                    <li>
                      <div><img width="103" height="76" src="<?php echo base_url();?>adminuploads/brochureVcards/vcards/<?php echo $vc->cover_img;?>"> </div>
                      <div class="tpbb"><a href="<?php echo base_url();?>fullmembers/downloadVcards/<?php echo $vc->cover_img;?>" id="dwn">Download</a></div>
                    </li>
                     <?php endforeach;else:?>
                    <li>No Vcards Please...</li>
                    <?php endif;?>
                  </ul>
                </div>
                <br class="clear">
                
                <?php if($totalMembersUnderMe < 10){?>
              <div class="switch">
                  <h3 style="text-align:center;">Hi<br>
                    You need 10 members under you to switched on for next Level 3</h3>
                <!--  <h2 style="text-align:center;">To step up for Level 3 </h2>adminuploads/brochureVcards/vcards/brochure
                  <h4 style="text-align:center;">Click Switch On To Pay</h4>-->
                  <div class="switch_extrapara">
                    <!--<p><strong>Inside You Can Enjoy</strong></p>
                    <ul class="list_extra">
                      <li>Powerful Marketing Tools To explode your Rave Business</li>
                      <li>Gifts, VIP &amp; Discounts to events</li>
                      <li>Personal Marketing suite.</li><br class="clear">
                    </ul>-->
                   
                  </div>
                </div><br class="clear">
				<?php }?>
                
                </div>
              
            </div>
            <!--4tab end......... --> 
            
           
          </div>
          
          <!--all cont --> 
          <br class="clear">
        </div>
      </div>
    </div>
    <!--lefts_side end-->
    <div class="rights_side">
      <div class="nitify-menu">
        <ul>
          <li><a href="#"><i class="fa fa-laptop"></i><span class="notify-ribon">0</span></a></li>
          <li><a href="#"><i class="fa fa-heart"></i><span class="notify-ribon">0</span></a></li>
          <li><a href="#"><i class="fa fa-globe"></i><span class="notify-ribon">0</span></a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i><span class="notify-ribon">0</span></a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i><span class="notify-ribon">0</span></a></li>
        </ul>
      </div>
      <div class="sm extra-no-pad">
        <ul class="social_media extra-width">
          <li class="sm001"> <a id="serviceList_1" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Customer Service</a>
            <div id="slist_1" class="list_service">
              <form method="post">
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
                      <td><input type="submit" value="Submit" id="customerServiceSubmit" name="customerServiceSubmit" onclick="return checkEmailMessage('customerServiceEmail','customerServiceMsg')"></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </li>
          <li class="sm002"> <a id="serviceList_2" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Tech Support </a>
            <div id="slist_2" class="list_service">
              <form method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td><label for="textfield">email:</label></td>
                      <td><input type="text" id="techSupportEmail" class="custEmailClass" name="email"></td>
                    </tr>
                    <tr>
                      <td><label for="textarea">message:</label></td>
                      <td><textarea rows="5" cols="31" id="techSupportMsg" class="custMessageClass" name="message"></textarea></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="submit" value="Submit"></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </li>
          <li class="sm003"> <a id="serviceList_3" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Advertising </a>
            <div id="slist_3" class="list_service">
              <form method="post">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td><label for="textfield">email:</label></td>
                      <td><input type="text"></td>
                    </tr>
                    <tr>
                      <td><label for="textarea">message:</label></td>
                      <td><textarea></textarea></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="submit" value="Submit"></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </li>

         <!-- <li class="sm003"> <a id="serviceList_5" href="#">Total Member Under GBE Business</a>
            <div id="slist_5" class="list_service">
              <p class="total-number">0</p>
            </div>
          </li>-->
        </ul>
      </div>
        <div class="webbox">
        <p class="web"> <span>My Sign Up Page:</span> <a target="_blank" href="<?php echo base_url()."gateway_signup/".$userInfo[0]["userName"];?>"><?php echo base_url()."gateway_signup/".$userInfo[0]["userName"];?></a> </p>
        <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
            ?>
        <p class="web"> <span>My Afrowebb Catalogue :</span> 
		<a target="_blank" href="<?php echo $this->config->item("affro_base_url").'gbe/member/'.$userInfo[0]["userName"];?>"><?php echo $this->config->item("affro_base_url").'gbe/member/'.$userInfo[0]["userName"];?></a>
		</p>
        <?php }?>
      </div>
      <div class="webbox">
        <?php 
                $viewArray = array("ADMIN");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
        <p class="web"> <span>My Sign Up of Teacher Page :</span> <a target="_blank" href="<?php echo base_url()."signup_teachers/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_teachers/".$userInfo[0]["userName"];?></a> </p>
        <?php }?>
        <?php
                //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
                $viewArray = array("TEACHER","ADMIN","STUDENT");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
        <p class="web"> <span>My Sign Up of Student Page :</span> <a target="_blank" href="<?php echo base_url()."signup_student/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_student/".$userInfo[0]["userName"];?></a> </p>
        <?php }?>
      </div>
      <div class="webbox">
        <?php 
                $viewArray = array("ADMIN");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
        <p class="web"> <span>My Sign Up of Head Volunteers Page :</span> <a target="_blank" href="<?php echo base_url()."signup_head_volunteers/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_head_volunteers/".$userInfo[0]["userName"];?></a> </p>
        <?php }?>
        <?php
                //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
                $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","STUDENT","VOLUNTEERS");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
        <p class="web"> <span>My Sign Up of Volunteers Page :</span> <a target="_blank" href="<?php echo base_url()."signup_volunteers/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_volunteers/".$userInfo[0]["userName"];?></a> </p>
        <?php }?>
      </div>
      <?php
                //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
                $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","STUDENT","VOLUNTEERS");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
      <div class="webbox">
        <p class="web"> <span>My Sign Up of Business Page :</span> <a target="_blank" href="<?php echo base_url()."signup_business/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_business/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Talent Page:</span> <a target="_blank" href="<?php echo base_url()."signup_talented/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_talented/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Mentorship Page :</span> <a target="_blank" href="<?php echo base_url()."signup_mentorship/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_mentorship/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Health Wellness Page:</span> <a target="_blank" href="<?php echo base_url()."signup_health/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_health/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Community Page:</span> <a target="_blank" href="<?php echo base_url()."signup_communities/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_communities/".$userInfo[0]["userName"];?></a> </p>
      </div>
      <?php }?>
    
     
      <div style="margin:7px 0 0 0px;" class="blue-box webbox">
        <p class="ana">OverView of Level 2</p>
        <ul>
          <li>Members in Level 2 Under This Referral: <?php echo count($level2Statistics);?></li>
          <?php 
		  if(count($level2Statistics) > 0):
		  	foreach($level2Statistics as $ls):
		  ?>
          <li><?php echo $ls->firstName.' '.$ls->lastName.' : '.$ls->totalMember;?></li>
          <?php 
		  	endforeach;
		  endif;
		  ?>
         <!-- <li>Rave &nbsp;Story:&nbsp; 6</li>
          <li>Bhaskar&nbsp;Mandal:&nbsp; 5</li>
          <li>terter1&nbsp;terst:&nbsp; 0</li>
          <li>Naren&nbsp;Das:&nbsp; 0</li>
          <li>Abhisek&nbsp;Majumdar:&nbsp; 0</li>
          <li>Jenny Mae&nbsp;Gapasin:&nbsp; 0</li>-->
        </ul>
      </div>
    </div>
    <br class="clear">
  </div>
 
</div>

<script type="text/javascript">
jQuery(function ($) {
	// Load dialog on click
	$('.palvidd').click(function (e) {
		$(this).next('.basic-modal-content').modal();
		return false; 
	});
	
	$(".watch-video-tut").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
	});
});

var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";

</script> 
<script type='text/javascript' src='<?php echo base_url();?>js/custom_common.js'></script>
<link type='text/css' href='<?php echo base_url(); ?>css/basic.css' rel='stylesheet' media='screen' />
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.simplemodal.js'></script>
<style>
.sm.extra-no-pad td{ 
    border:none;
}
.kk {
    display: block !important;
    float: none !important;
    height: auto;
    margin: 5px auto !important;
    width: 250px;
}
.pp{ 
    margin-left:0;
}
/*textarea{resize:none !important;}*/
 .cke_bottom{display:none !important}
  </style>
</body>
</html>
