<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>GBE Level 2</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/level2.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/p_color.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>
<script src="js/organictabs.jquery.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	 	var tabId = '<?php //echo $openTabId;?>';
        if(tabId != ""){
            $(".tab_content").removeClass('hide');
            $(".tab_content").addClass('hide');
            $("#"+tabId).removeClass('hide');
            $("#"+tabId).show();
            if(tabId == "tab4"){
                $(".webbox1").show();
            }else{
                $(".webbox1").hide(); 
            }
        }
	jQuery('#mycarousel').jcarousel();
});
$(function() {
    
            $(".containertab").organicTabs({
                "speed": 200
            });
});


function readURL(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
         $('#empPic').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}

function downloadVideo(video_id){
	$.fancybox.open('<img src="images/ajax-loader.gif" />');
	$.ajax({
			type: "POST",
			data: "video_id="+video_id,
			url: "downloadVideo",
			success: function(data) {
				$.fancybox.open(data);
			}
	});
}
function valFormCountryCode(){
	if($("#country").val() == "0"){
		alert("Please select country before submission");
		return false;	
	}else{
		return true;
	}
}
</script>
<script>
 $(document).ready(function(){
	 $('.pull').click(function(){
		 $('.misc_new').slideToggle();
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
 })
</script>
<script type="text/javascript" src="jquery.fancybox.js?v=2.1.4"></script>
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
          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo base_url()."regeneration";}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Level - 4</span> Corporation <span> Open </span> </a></li>
          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] > 4){ echo base_url()."franchise";}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Level - 5</span>Summit<span> Open </span> </a></li>
          
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
            <li><a href="#tab1" class="tabClass current" name="tab1">Step1</a></li>
            <li><a href="#tab2" class="tabClass " name="tab2">step2</a></li>
            <li><a href="#tab3" class="tabClass " name="tab3">step3</a></li>
            <li><a href="#tab4" class="tabClass " name="tab4">step4</a></li>
          </ul>
          <div class="tab_container main_cntnr">
            <div id="tab1" class="tab_content">
              <div class="white-bg lable_tre">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="<?php echo base_url(); ?>images/hqdefault.jpg" width="573" height="320" /> </div>
                  <div class="leb_3_com"><h1>Enter Community Treasures</h1>
                  <img src="<?php echo base_url(); ?>images/grp_img.png" alt="" >
                  <img src="<?php echo base_url(); ?>images/comunity_trs.png" alt="" >
                  <a href="#">Lunch</a>
                  </div>
					</div>
                
                
                
                
                
                
                
                
                <!--end white-space-->
                

                
              </div>
            </div>
            
            <!--1tab end......... --> 
            
            <!--2tab Start......... -->
            <div id="tab2" class="tab_content">
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="images/hqdefault.jpg" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>
                  </div>
                </div>
                <h3 class="headign-left"> Complete The Instructions Below</br>
                  Make $35  /  £30 in the UK</br>
                  For Everyone Who Joins You</h3>
                <h3 class="heading-right"><img border="0" alt="" src="images/rarrow.png"></h3>
                <br class="clear">
                <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Choose A Video & Upload</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                <p>If you dont like making Youtube videos, take a look through our video library made by members who have submitted videos for you to use. - Choose a video, click                download then upload onto Youtube and promote it.</p>
                <div class="ved"> 
                  <!--<span class="nxt"><img src="http://220.225.90.155/rave_store_socity/Application/content/member/images/next.png" /></span>
            <span class="prv"><img src="http://220.225.90.155/rave_store_socity/Application/content/member/images/prev.png" /></span>-->
                  <h4>Videos That You Can Use</h4>
                  <div class=" jcarousel-skin-tango">
                    <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;">
                      <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                        <ul class="jcarousel-list jcarousel-list-horizontal" id="mycarousel" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 1042px;">
                          <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: outside none none;" jcarouselindex="1">
                            <iframe width="138" height="103" src="https://www.youtube.com/embed/impZ7krcPzI" frameborder="0" allowfullscreen></iframe>
                            <h5>Dancing SuperStar </h5>
                            <input type="hidden" value="//www.youtube-nocookie.com/embed/dPhJbViFnEI" id="youtube0" name="youtube0">
                            <div style="cursor:pointer; background: #031F30; cursor: pointer; line-height: 22px; margin-bottom: 3px; width: 138px;" class="cbz"><a href="javascript:void(0)" id="postYoutube0">Copy URL</a>
                              <div class="zclip" id="zclip-ZeroClipboardMovie_1" style="position: absolute; left: 0px; top: 0px; width: 138px; height: 22px; z-index: 99;"> </div>
                            </div>
                            <a class="share-btn" href="javascript:void(0)">Share</a> <a onclick="downloadVideo('dPhJbViFnEI')" class="download-btn" href="javascript:void(0)">Download</a>
                            <div class="clear"></div>
                            <div style="background-color:#fff; display:none" id="shareZone1" class="share-popup">
                              <ul id="logoZone">
                                <li><a><img border="0" src="images/facebook.png"></a></li>
                                <li><a><img border="0" src="images/twitter.png"></a></li>
                                <li><a></a></li>
                              </ul>
                            </div>
                          </li>
                          <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: outside none none;" jcarouselindex="1">
                            <iframe width="138" height="103" src="https://www.youtube.com/embed/impZ7krcPzI" frameborder="0" allowfullscreen></iframe>
                            <h5>Dancing SuperStar </h5>
                            <input type="hidden" value="//www.youtube-nocookie.com/embed/dPhJbViFnEI" id="youtube0" name="youtube0">
                            <div style="cursor:pointer; background: #031F30; cursor: pointer; line-height: 22px; margin-bottom: 3px; width: 138px;" class="cbz"><a href="javascript:void(0)" id="postYoutube0">Copy URL</a>
                              <div class="zclip" id="zclip-ZeroClipboardMovie_1" style="position: absolute; left: 0px; top: 0px; width: 138px; height: 22px; z-index: 99;"> </div>
                            </div>
                            <a class="share-btn" href="javascript:void(0)">Share</a> <a onclick="downloadVideo('dPhJbViFnEI')" class="download-btn" href="javascript:void(0)">Download</a>
                            <div class="clear"></div>
                            <div style="background-color:#fff; display:none" id="shareZone1" class="share-popup">
                              <ul id="logoZone">
                                <li><a><img border="0" src="images/facebook.png"></a></li>
                                <li><a><img border="0" src="images/twitter.png"></a></li>
                                <li><a></a></li>
                              </ul>
                            </div>
                          </li>
                          <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: outside none none;" jcarouselindex="1">
                            <iframe width="138" height="103" src="https://www.youtube.com/embed/impZ7krcPzI" frameborder="0" allowfullscreen></iframe>
                            <h5>Dancing SuperStar </h5>
                            <input type="hidden" value="//www.youtube-nocookie.com/embed/dPhJbViFnEI" id="youtube0" name="youtube0">
                            <div style="cursor:pointer; background: #031F30; cursor: pointer; line-height: 22px; margin-bottom: 3px; width: 138px;" class="cbz"><a href="javascript:void(0)" id="postYoutube0">Copy URL</a>
                              <div class="zclip" id="zclip-ZeroClipboardMovie_1" style="position: absolute; left: 0px; top: 0px; width: 138px; height: 22px; z-index: 99;"> </div>
                            </div>
                            <a class="share-btn" href="javascript:void(0)">Share</a> <a onclick="downloadVideo('dPhJbViFnEI')" class="download-btn" href="javascript:void(0)">Download</a>
                            <div class="clear"></div>
                            <div style="background-color:#fff; display:none" id="shareZone1" class="share-popup">
                              <ul id="logoZone">
                                <li><a><img border="0" src="images/facebook.png"></a></li>
                                <li><a><img border="0" src="images/twitter.png"></a></li>
                                <li><a></a></li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="mod">
                <div class="ved"> 
                  <!--<span class="nxt"><img src="http://220.225.90.155/rave_store_socity/Application/content/member/images/next.png" /></span>
            <span class="prv"><img src="http://220.225.90.155/rave_store_socity/Application/content/member/images/prev.png" /></span>-->
                  <h4>Popular Uploads</h4>
                  <div class=" jcarousel-skin-tango">
                    <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;">
                      <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                        <ul class="jcarousel-list jcarousel-list-horizontal" id="mycarousel" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 1042px;">
                          <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: outside none none;" jcarouselindex="1">
                            <iframe width="138" height="103" src="https://www.youtube.com/embed/impZ7krcPzI" frameborder="0" allowfullscreen></iframe>
                            <h5>Dancing SuperStar </h5>
                            <input type="hidden" value="//www.youtube-nocookie.com/embed/dPhJbViFnEI" id="youtube0" name="youtube0">
                            <div style="cursor:pointer; background: #031F30; cursor: pointer; line-height: 22px; margin-bottom: 3px; width: 138px;" class="cbz"><a href="javascript:void(0)" id="postYoutube0">Copy URL</a>
                              <div class="zclip" id="zclip-ZeroClipboardMovie_1" style="position: absolute; left: 0px; top: 0px; width: 138px; height: 22px; z-index: 99;"> </div>
                            </div>
                            <a class="share-btn" href="javascript:void(0)">Share</a> <a onclick="downloadVideo('dPhJbViFnEI')" class="download-btn" href="javascript:void(0)">Download</a>
                            <div class="clear"></div>
                            <div style="background-color:#fff; display:none" id="shareZone1" class="share-popup">
                              <ul id="logoZone">
                                <li><a><img border="0" src="images/facebook.png"></a></li>
                                <li><a><img border="0" src="images/twitter.png"></a></li>
                                <li><a></a></li>
                              </ul>
                            </div>
                          </li>
                          <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: outside none none;" jcarouselindex="1">
                            <iframe width="138" height="103" src="https://www.youtube.com/embed/impZ7krcPzI" frameborder="0" allowfullscreen></iframe>
                            <h5>Dancing SuperStar </h5>
                            <input type="hidden" value="//www.youtube-nocookie.com/embed/dPhJbViFnEI" id="youtube0" name="youtube0">
                            <div style="cursor:pointer; background: #031F30; cursor: pointer; line-height: 22px; margin-bottom: 3px; width: 138px;" class="cbz"><a href="javascript:void(0)" id="postYoutube0">Copy URL</a>
                              <div class="zclip" id="zclip-ZeroClipboardMovie_1" style="position: absolute; left: 0px; top: 0px; width: 138px; height: 22px; z-index: 99;"> </div>
                            </div>
                            <a class="share-btn" href="javascript:void(0)">Share</a> <a onclick="downloadVideo('dPhJbViFnEI')" class="download-btn" href="javascript:void(0)">Download</a>
                            <div class="clear"></div>
                            <div style="background-color:#fff; display:none" id="shareZone1" class="share-popup">
                              <ul id="logoZone">
                                <li><a><img border="0" src="images/facebook.png"></a></li>
                                <li><a><img border="0" src="images/twitter.png"></a></li>
                                <li><a></a></li>
                              </ul>
                            </div>
                          </li>
                          <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: outside none none;" jcarouselindex="1">
                            <iframe width="138" height="103" src="https://www.youtube.com/embed/impZ7krcPzI" frameborder="0" allowfullscreen></iframe>
                            <h5>Dancing SuperStar </h5>
                            <input type="hidden" value="//www.youtube-nocookie.com/embed/dPhJbViFnEI" id="youtube0" name="youtube0">
                            <div style="cursor:pointer; background: #031F30; cursor: pointer; line-height: 22px; margin-bottom: 3px; width: 138px;" class="cbz"><a href="javascript:void(0)" id="postYoutube0">Copy URL</a>
                              <div class="zclip" id="zclip-ZeroClipboardMovie_1" style="position: absolute; left: 0px; top: 0px; width: 138px; height: 22px; z-index: 99;"> </div>
                            </div>
                            <a class="share-btn" href="javascript:void(0)">Share</a> <a onclick="downloadVideo('dPhJbViFnEI')" class="download-btn" href="javascript:void(0)">Download</a>
                            <div class="clear"></div>
                            <div style="background-color:#fff; display:none" id="shareZone1" class="share-popup">
                              <ul id="logoZone">
                                <li><a><img border="0" src="images/facebook.png"></a></li>
                                <li><a><img border="0" src="images/twitter.png"></a></li>
                                <li><a></a></li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="ab">
                  <div class="ab_inner "><strong>B</strong>
                    <h3>Get Promoted</h3>
                    <span><a class="watch-video-tut" name="http://www.youtube.com/watch?v=pDOdKCbaS5M&feature=youtube" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                  <div class="white-space">
                    <form>
                      <label>
                      <h6 style="width:auto;">Add Your Own Youtube Url</h6>
                      <input type="text" onblur="if(this.value == ''){this.value ='Enter youtube url'}" onfocus="if(this.value == 'Enter youtube url') {this.value=''}" class="extra-text" id="url_displayer" name="url_displayer" value="Enter youtube url">
                      <input type="button" class="extra-blue-btn" name="url_displayer_btn" id="url_displayer_btn" value="">
                      </label>
                      <div class="clear"></div>
                    </form>
                  </div>
                  <br class="clear">
                  <!--end white-space-->
                  <div class="ab_inner "><strong>B</strong>
                    <h3>Positive Power</h3>
                    <span><a class="watch-video-tut" name="http://www.youtube.com/watch?v=pDOdKCbaS5M&feature=youtube" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                  <h2>Making Positive Comments:<br>
                    Supports Other Members &amp; Gets You leads</h2>
                  <p>Login to your Youtube account then click the link below.
                    Make great comments, leave your link or offer to help others set up their own Rave Business</p>
                  <div class="sec-b paragraph">
                    <div id="disp_cont">
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=9WQXXQlL9yU">https://www.youtube.com/watch?v=9WQXXQlL9yU</a><br>
                      </p>
                      <p><a target="_blank" href="https://www.youtube.com/watch?v=dPhJbViFnEI">https://www.youtube.com/watch?v=dPhJbViFnEI</a><br>
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
                      </p>
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
                  <div class="ab_inner "><strong>B</strong>
                    <h3>Fame + Fortune</h3>
                    <span><a class="watch-video-tut" name="http://www.youtube.com/watch?v=pDOdKCbaS5M&feature=youtube" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                  <div class="white-space">
                    <form>
                      <label>
                      <h6 style="width:auto;">Add Your Own Youtube Url</h6>
                      <input type="text" onblur="if(this.value == ''){this.value ='Enter youtube url'}" onfocus="if(this.value == 'Enter youtube url') {this.value=''}" class="extra-text" id="url_displayer" name="url_displayer" value="Enter youtube url">
                      <input type="button" class="extra-blue-btn" name="url_displayer_btn" id="url_displayer_btn" value="">
                      </label>
                      <div class="clear"></div>
                    </form>
                  </div>
                  <br class="clear">
                  <div class="ab_inner "><strong>B</strong>
                    <h3>Step 1 Completed</h3>
                    <span><a class="watch-video-tut" name="http://www.youtube.com/watch?v=pDOdKCbaS5M&feature=youtube" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                  <p align="right"><a style="font-size:22px; color:#f00; margin-right:38px;" onclick="showSecondTab()" rel="tab2" href="javascript:void(0)" id="step2">Now Complete Step 2 &gt;</a></p>
                  <br class="clear">
                </div>
              </div>
            </div>
            <!--2tab end......... --> 
            
            <!--3tab Start......... -->
            <div id="tab3" class="tab_content">
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="images/hqdefault.jpg" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>
                  </div>
                </div>
                <h3 class="headign-left"> Complete The Instructions Below</br>
                  Make $35  /  £30 in the UK</br>
                  For Everyone Who Joins You</h3>
                <h3 class="heading-right"><img border="0" alt="" src="images/rarrow.png"></h3>
                <br class="clear">
                <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Lunch Your Rave Blogger</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                <p style="margin-top:13px;"> Automatically send emails to all your contacts by using the Invite friends tool just enter email id,  password, connect to your account and send invites to your friends to see your new website .</p>
                <a id="paiddmemberr" class="r-blog" href="#">Rave Blogger</a>
                <div class="ab_inner"><strong>C</strong>
                  <h3>Use our Adverts to Gain Interest</h3>
                  <span><a class="watch-video-tut" name="http://www.youtube.com/embed/-EkL81gUe_A" id="tutorial-videoS3" href="javascript:void(0)">Watch Video</a></span></div>
                <table width="478px" border="0" style="margin: 0px auto 0px 41px;">
                  <tbody>
                    <tr>
                      <td class="pic"><img width="40" height="40" src="http://ravebusiness.com/ravestorysociety/Application/content/admin/articleImages/face8.jpeg"></td>
                      <td class="para"><p>DJ moloy come to Mexico</p>
                        <input type="hidden" value="DJ moloy come to Mexico" id="articleTitle12" name="">
                        <input type="hidden" value="When it comes time to prepare your house for your 1st open house, make sure to envision it from the point of view of a likely purchaser. Make sure that the whole place is orderly and that it appears inviting. Turn on the majority of the lights in the house so that every room appears welcoming and cozy. If possible, do a bit of staging. This will likely include placing some reading material on a living room table, or putting some fresh flowers on the dining room table. A lot of real estate agents even go so far as to make some cookies or bread to give the real-estate property a welcoming and appealing atmosphere." id="articleDesc12" name=""></td>
                      <td class="link"><a onclick="sendToCopy('articleDesc12','articleTitle12','12')" href="javascript:void(0)">(Read &amp; Add)</a></td>
                    </tr>
                    <tr>
                      <td class="pic"><img width="40" height="40" src="http://ravebusiness.com/ravestorysociety/Application/content/admin/articleImages/face7.jpeg"></td>
                      <td class="para"><p>DDJ Angel Come to Delhi</p>
                        <input type="hidden" value="DDJ Angel Come to Delhi" id="articleTitle11" name="">
                        <input type="hidden" value="As you prepare your property for your first open house, be sure to envision it through the eyes of a likely purchaser. Be certain that the whole home is orderly and that it appears welcoming. Turn on every lights in the home so that each room looks welcoming and cozy. If you can, do a bit of staging. This will likely include putting some magazines on a living room table, or having a vase of fresh flowers on the kitchen table. Most real-estate agents event make some cookies or bread to give the real estate property a relaxed and appealing atmosphere." id="articleDesc11" name=""></td>
                      <td class="link"><a onclick="sendToCopy('articleDesc11','articleTitle11','11')" href="javascript:void(0)">(Read &amp; Add)</a></td>
                    </tr>
                    <tr>
                      <td class="pic"><img width="40" height="40" src="http://ravebusiness.com/ravestorysociety/Application/content/admin/articleImages/face1.jpeg"></td>
                      <td class="para"><p>Build Money on Web</p>
                        <input type="hidden" value="Build Money on Web" id="articleTitle6" name="">
                        <input type="hidden" value="There are hundreds of avenues to make cash on the net for free without ever spending a single cent. That's correct. You should know it is. You will on no account spend any cash. You will generate cash on the web via doing various kinds of free online jobs without worrying about any scams.

Before anything else, I simply need to remind you that in all undertaking whether you want or not to make cash there's always a bit that you need to invest. However do not be bothered. All you have to invest in your pursuit to make money online free is your time. You also require a device and that is nothing less other than a notebook computer as well as a consistent world wide web line." id="articleDesc6" name=""></td>
                      <td class="link"><a onclick="sendToCopy('articleDesc6','articleTitle6','6')" href="javascript:void(0)">(Read &amp; Add)</a></td>
                    </tr>
                    <tr>
                      <td class="pic"><img width="40" height="40" src="http://ravebusiness.com/ravestorysociety/Application/content/admin/articleImages/face5.jpeg"></td>
                      <td class="para"><p>Tinnitus</p>
                        <input type="hidden" value="Tinnitus" id="articleTitle5" name="">
                        <input type="hidden" value="Every year, countless ordinary people with diverse standards of living, develop a ringing in their ears. The condition is known as tinnitus. Based on the American Tinnitus Association, approximately FIFTY million Americans can be suffering with tinnitus.

So many people nowadays are stricken with tinnitus, that it's reasonable to assume it is now a top priority of the health community. It may shock you, that the problem isn't well defined and is presently not treatable. Tinnitus is really a non-life threatening problem. There is no urgency to cure it. Nevertheless, anybody who has it, knows it brings profound effect on quality of lifestyle." id="articleDesc5" name=""></td>
                      <td class="link"><a onclick="sendToCopy('articleDesc5','articleTitle5','5')" href="javascript:void(0)">(Read &amp; Add)</a></td>
                    </tr>
                    <tr>
                      <td class="pic"><img width="40" height="40" src="http://ravebusiness.com/ravestorysociety/Application/content/admin/articleImages/face4.jpeg"></td>
                      <td class="para"><p>Debt Consolidation</p>
                        <input type="hidden" value="Debt Consolidation" id="articleTitle4" name="">
                        <input type="hidden" value="In previous years, the number of debtors has grown tremendously. This might be associated with an increase in the number of loan providing companies who are at their enticing best. This may also be due to the spoiling lifestyle of persons who are more than ready to waste on lavish things. All the same, the system is cyclic. Local markets are overloaded with luxury things which ranges from phones to stationery products that are definitely enticing. Your buying power is increased by loaning companies who offer you loans at attractive rates. Subsequently you spend more than what you earn and eventually you get into a debt.

When you examine the above system, the companies as well as the loan providers are usually at an edge and it is actually you will wind up a loser. It's not a surprise, human instinct is sometimes difficult to explain. This type of situation additionally brings into picture the value of debt consolidation. When a borrower drops right into a debt trap and is set in a place to pay off the loan, the only option for him is always to consolidate his debt with normally a secured loan." id="articleDesc4" name=""></td>
                      <td class="link"><a onclick="sendToCopy('articleDesc4','articleTitle4','4')" href="javascript:void(0)">(Read &amp; Add)</a></td>
                    </tr>
                    <tr>
                      <td class="pic"><img width="40" height="40" src="http://ravebusiness.com/ravestorysociety/Application/content/admin/articleImages/face3.jpeg"></td>
                      <td class="para"><p>Weight Loss</p>
                        <input type="hidden" value="Weight Loss" id="articleTitle3" name="">
                        <input type="hidden" value="Losing weight is on the agenda for a lot of people. Nonetheless, it can seem like a unending pursuit. Cutting through all of the exercise equipment as well as diet drugs available there, the truth of the matter is, successful weight loss stays the same. Eat fewer calories than what you burn and you'll lose weight.

This does not take place by adopting diet fads, it happens when you make a genuine commitment to your existence and wellbeing. If you want to lose weight for the incorrect reasons, you are preparing yourself up for catastrophe. If you are giving in to the pressure from people all-around you than your efforts will possibly be wasted in terms of long-term weight loss. In order to be truly triumphant you have to want to lose the weight for yourself." id="articleDesc3" name=""></td>
                      <td class="link"><a onclick="sendToCopy('articleDesc3','articleTitle3','3')" href="javascript:void(0)">(Read &amp; Add)</a></td>
                    </tr>
                    <tr>
                      <td class="pic"><img width="40" height="40" src="http://ravebusiness.com/ravestorysociety/Application/content/admin/articleImages/face6.jpeg"></td>
                      <td class="para"><p>Ultra Spinnable</p>
                        <input type="hidden" value="Ultra Spinnable" id="articleTitle1" name="">
                        <input type="hidden" value="In case you believe of acne as an eruptive skin illness, you are on the right track. Further, in case you believe of it in scientific terms as a disorder of the sebaceous follicles of your skin, you should be a genius. Acne on the face, neck, and back aren't even unusual to lots of individuals. Understanding it, how it comes about, and the right way to take care of it are significant in case you want to live the rest of your life joyful and satisfied.Acne can attack just almost anyone, but it really includes a preference for people who are just turning into the puberty phase of their lives. When it gets to your neck and back, you understand you have serious problems to live and deal with. There are certainly methods to cure it &ndash; or at least try to &ndash; but not all of them have been proven to very work. But, knowing what the problem can do to you, you may just need would such as to read up and try them on anyway.People who live with acne react to it in various methods. Those who have suffered from it since infanthood tend to develop a thick skin and grow indifferent; individuals who just been with them as they developed into their adolescent years know it is for quite a while, and it would definitely before long be done away with. Nevertheless those are regular individuals. People who fall outside these ranges react to it by either becoming passively nonchalant or just outrightly indignant. In which category do you fall? But instead of becoming any of these, it is best to focus your energy on a remedy that actually works to get rid of acne" id="articleDesc1" name=""></td>
                      <td class="link"><a onclick="sendToCopy('articleDesc1','articleTitle1','1')" href="javascript:void(0)">(Read &amp; Add)</a></td>
                    </tr>
                  </tbody>
                </table>
                <h3> Title of The Article </h3>
                <p>
                  <input type="text" style="width:500px" value="" id="txtATitle" name="txtATitle" class="text_fild">
                </p>
                <br>
                <h3> Read First, Correct &amp; Copy - Paste into Your Rave Blog</h3>
                <p>
                  <textarea name="spintext" id="spintext" style="visibility: hidden; display: none;">           </textarea>
                <span lang="en" style="width: 488px;" aria-labelledby="cke_spintext_arialbl" role="application" title=" " dir="ltr" class="cke_skin_kama cke_1 cke_editor_spintext" id="cke_spintext"><span class="cke_voice_label" id="cke_spintext_arialbl">Rich Text Editor</span><span role="presentation" class="cke_browser_gecko"><span role="presentation" class="cke_wrapper cke_ltr">
                <table cellspacing="0" cellpadding="0" border="0" role="presentation" class="cke_editor">
                  <tbody>
                    <tr role="presentation" style="-moz-user-select: none;">
                      <td role="presentation" class="cke_top" id="cke_top_spintext"><div onmousedown="return false;" aria-labelledby="cke_6" role="group" class="cke_toolbox"><span class="cke_voice_label" id="cke_6">Editor toolbars</span><span role="toolbar" aria-labelledby="cke_7_label" class="cke_toolbar" id="cke_7"><span class="cke_voice_label" id="cke_7_label">Document</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(6, this); return false;" onfocus="return CKEDITOR.tools.callFunction(5, event);" onkeydown="return CKEDITOR.tools.callFunction(4, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_8_label" role="button" hidefocus="true" tabindex="-1" title="Source" class="cke_off cke_button_source" id="cke_8"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_8_label">Source</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(9, this); return false;" onfocus="return CKEDITOR.tools.callFunction(8, event);" onkeydown="return CKEDITOR.tools.callFunction(7, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_9_label" role="button" hidefocus="true" tabindex="-1" title="Save" class="cke_button_save cke_disabled" id="cke_9" aria-disabled="true"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_9_label">Save</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(12, this); return false;" onfocus="return CKEDITOR.tools.callFunction(11, event);" onkeydown="return CKEDITOR.tools.callFunction(10, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_10_label" role="button" hidefocus="true" tabindex="-1" title="New Page" class="cke_off cke_button_newpage" id="cke_10"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_10_label">New Page</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(15, this); return false;" onfocus="return CKEDITOR.tools.callFunction(14, event);" onkeydown="return CKEDITOR.tools.callFunction(13, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_11_label" role="button" hidefocus="true" tabindex="-1" title="Preview" class="cke_off cke_button_preview" id="cke_11"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_11_label">Preview</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(18, this); return false;" onfocus="return CKEDITOR.tools.callFunction(17, event);" onkeydown="return CKEDITOR.tools.callFunction(16, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_12_label" role="button" hidefocus="true" tabindex="-1" title="Print" class="cke_off cke_button_print" id="cke_12"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_12_label">Print</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(21, this); return false;" onfocus="return CKEDITOR.tools.callFunction(20, event);" onkeydown="return CKEDITOR.tools.callFunction(19, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_13_label" role="button" hidefocus="true" tabindex="-1" title="Templates" class="cke_off cke_button_templates" id="cke_13"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_13_label">Templates</span></a></span></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_14_label" class="cke_toolbar" id="cke_14"><span class="cke_voice_label" id="cke_14_label">Clipboard/Undo</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(24, this); return false;" onfocus="return CKEDITOR.tools.callFunction(23, event);" onkeydown="return CKEDITOR.tools.callFunction(22, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_15_label" role="button" hidefocus="true" tabindex="-1" title="Cut" class="cke_button_cut cke_disabled" id="cke_15" aria-disabled="true"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_15_label">Cut</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(27, this); return false;" onfocus="return CKEDITOR.tools.callFunction(26, event);" onkeydown="return CKEDITOR.tools.callFunction(25, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_16_label" role="button" hidefocus="true" tabindex="-1" title="Copy" class="cke_button_copy cke_disabled" id="cke_16" aria-disabled="true"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_16_label">Copy</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(30, this); return false;" onfocus="return CKEDITOR.tools.callFunction(29, event);" onkeydown="return CKEDITOR.tools.callFunction(28, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_17_label" role="button" hidefocus="true" tabindex="-1" title="Paste" class="cke_off cke_button_paste" id="cke_17"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_17_label">Paste</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(33, this); return false;" onfocus="return CKEDITOR.tools.callFunction(32, event);" onkeydown="return CKEDITOR.tools.callFunction(31, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_18_label" role="button" hidefocus="true" tabindex="-1" title="Paste as plain text" class="cke_off cke_button_pastetext" id="cke_18"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_18_label">Paste as plain text</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(36, this); return false;" onfocus="return CKEDITOR.tools.callFunction(35, event);" onkeydown="return CKEDITOR.tools.callFunction(34, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_19_label" role="button" hidefocus="true" tabindex="-1" title="Paste from Word" class="cke_off cke_button_pastefromword" id="cke_19"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_19_label">Paste from Word</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(39, this); return false;" onfocus="return CKEDITOR.tools.callFunction(38, event);" onkeydown="return CKEDITOR.tools.callFunction(37, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_20_label" role="button" hidefocus="true" tabindex="-1" title="Undo" class="cke_button_undo cke_disabled" id="cke_20" aria-disabled="true"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_20_label">Undo</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(42, this); return false;" onfocus="return CKEDITOR.tools.callFunction(41, event);" onkeydown="return CKEDITOR.tools.callFunction(40, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_21_label" role="button" hidefocus="true" tabindex="-1" title="Redo" class="cke_button_redo cke_disabled" id="cke_21" aria-disabled="true"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_21_label">Redo</span></a></span></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_22_label" class="cke_toolbar" id="cke_22"><span class="cke_voice_label" id="cke_22_label">Editing</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(45, this); return false;" onfocus="return CKEDITOR.tools.callFunction(44, event);" onkeydown="return CKEDITOR.tools.callFunction(43, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_23_label" role="button" hidefocus="true" tabindex="-1" title="Find" class="cke_off cke_button_find" id="cke_23"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_23_label">Find</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(48, this); return false;" onfocus="return CKEDITOR.tools.callFunction(47, event);" onkeydown="return CKEDITOR.tools.callFunction(46, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_24_label" role="button" hidefocus="true" tabindex="-1" title="Replace" class="cke_off cke_button_replace" id="cke_24"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_24_label">Replace</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(51, this); return false;" onfocus="return CKEDITOR.tools.callFunction(50, event);" onkeydown="return CKEDITOR.tools.callFunction(49, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_25_label" role="button" hidefocus="true" tabindex="-1" title="Select All" class="cke_off cke_button_selectAll" id="cke_25"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_25_label">Select All</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(54, this); return false;" onfocus="return CKEDITOR.tools.callFunction(53, event);" onkeydown="return CKEDITOR.tools.callFunction(52, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_26_label" role="button" hidefocus="true" tabindex="-1" title="Check Spelling" class="cke_off cke_button_checkspell" id="cke_26"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_26_label">Check Spelling</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(57, this); return false;" onfocus="return CKEDITOR.tools.callFunction(56, event);" onkeydown="return CKEDITOR.tools.callFunction(55, event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="true" aria-labelledby="cke_27_label" role="button" hidefocus="true" tabindex="-1" title="Spell Check As You Type" class="cke_off cke_button_scayt" id="cke_27"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_27_label">Spell Check As You Type</span><span class="cke_buttonarrow">&nbsp;</span></a></span></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_28_label" class="cke_toolbar" id="cke_28"><span class="cke_voice_label" id="cke_28_label">Forms</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(60, this); return false;" onfocus="return CKEDITOR.tools.callFunction(59, event);" onkeydown="return CKEDITOR.tools.callFunction(58, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_29_label" role="button" hidefocus="true" tabindex="-1" title="Form" class="cke_off cke_button_form" id="cke_29"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_29_label">Form</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(63, this); return false;" onfocus="return CKEDITOR.tools.callFunction(62, event);" onkeydown="return CKEDITOR.tools.callFunction(61, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_30_label" role="button" hidefocus="true" tabindex="-1" title="Checkbox" class="cke_off cke_button_checkbox" id="cke_30"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_30_label">Checkbox</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(66, this); return false;" onfocus="return CKEDITOR.tools.callFunction(65, event);" onkeydown="return CKEDITOR.tools.callFunction(64, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_31_label" role="button" hidefocus="true" tabindex="-1" title="Radio Button" class="cke_off cke_button_radio" id="cke_31"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_31_label">Radio Button</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(69, this); return false;" onfocus="return CKEDITOR.tools.callFunction(68, event);" onkeydown="return CKEDITOR.tools.callFunction(67, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_32_label" role="button" hidefocus="true" tabindex="-1" title="Text Field" class="cke_off cke_button_textfield" id="cke_32"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_32_label">Text Field</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(72, this); return false;" onfocus="return CKEDITOR.tools.callFunction(71, event);" onkeydown="return CKEDITOR.tools.callFunction(70, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_33_label" role="button" hidefocus="true" tabindex="-1" title="Textarea" class="cke_off cke_button_textarea" id="cke_33"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_33_label">Textarea</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(75, this); return false;" onfocus="return CKEDITOR.tools.callFunction(74, event);" onkeydown="return CKEDITOR.tools.callFunction(73, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_34_label" role="button" hidefocus="true" tabindex="-1" title="Selection Field" class="cke_off cke_button_select" id="cke_34"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_34_label">Selection Field</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(78, this); return false;" onfocus="return CKEDITOR.tools.callFunction(77, event);" onkeydown="return CKEDITOR.tools.callFunction(76, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_35_label" role="button" hidefocus="true" tabindex="-1" title="Button" class="cke_off cke_button_button" id="cke_35"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_35_label">Button</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(81, this); return false;" onfocus="return CKEDITOR.tools.callFunction(80, event);" onkeydown="return CKEDITOR.tools.callFunction(79, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_36_label" role="button" hidefocus="true" tabindex="-1" title="Image Button" class="cke_off cke_button_imagebutton" id="cke_36"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_36_label">Image Button</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(84, this); return false;" onfocus="return CKEDITOR.tools.callFunction(83, event);" onkeydown="return CKEDITOR.tools.callFunction(82, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_37_label" role="button" hidefocus="true" tabindex="-1" title="Hidden Field" class="cke_off cke_button_hiddenfield" id="cke_37"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_37_label">Hidden Field</span></a></span></span><span class="cke_toolbar_end"></span></span>
                          <div class="cke_break"></div>
                          <span role="toolbar" aria-labelledby="cke_38_label" class="cke_toolbar" id="cke_38"><span class="cke_voice_label" id="cke_38_label">Basic Styles</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(87, this); return false;" onfocus="return CKEDITOR.tools.callFunction(86, event);" onkeydown="return CKEDITOR.tools.callFunction(85, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_39_label" role="button" hidefocus="true" tabindex="-1" title="Bold" class="cke_off cke_button_bold" id="cke_39"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_39_label">Bold</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(90, this); return false;" onfocus="return CKEDITOR.tools.callFunction(89, event);" onkeydown="return CKEDITOR.tools.callFunction(88, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_40_label" role="button" hidefocus="true" tabindex="-1" title="Italic" class="cke_off cke_button_italic" id="cke_40"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_40_label">Italic</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(93, this); return false;" onfocus="return CKEDITOR.tools.callFunction(92, event);" onkeydown="return CKEDITOR.tools.callFunction(91, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_41_label" role="button" hidefocus="true" tabindex="-1" title="Underline" class="cke_off cke_button_underline" id="cke_41"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_41_label">Underline</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(96, this); return false;" onfocus="return CKEDITOR.tools.callFunction(95, event);" onkeydown="return CKEDITOR.tools.callFunction(94, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_42_label" role="button" hidefocus="true" tabindex="-1" title="Strike Through" class="cke_off cke_button_strike" id="cke_42"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_42_label">Strike Through</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(99, this); return false;" onfocus="return CKEDITOR.tools.callFunction(98, event);" onkeydown="return CKEDITOR.tools.callFunction(97, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_43_label" role="button" hidefocus="true" tabindex="-1" title="Subscript" class="cke_off cke_button_subscript" id="cke_43"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_43_label">Subscript</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(102, this); return false;" onfocus="return CKEDITOR.tools.callFunction(101, event);" onkeydown="return CKEDITOR.tools.callFunction(100, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_44_label" role="button" hidefocus="true" tabindex="-1" title="Superscript" class="cke_off cke_button_superscript" id="cke_44"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_44_label">Superscript</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(105, this); return false;" onfocus="return CKEDITOR.tools.callFunction(104, event);" onkeydown="return CKEDITOR.tools.callFunction(103, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_45_label" role="button" hidefocus="true" tabindex="-1" title="Remove Format" class="cke_off cke_button_removeFormat" id="cke_45"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_45_label">Remove Format</span></a></span></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_46_label" class="cke_toolbar" id="cke_46"><span class="cke_voice_label" id="cke_46_label">Paragraph</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(108, this); return false;" onfocus="return CKEDITOR.tools.callFunction(107, event);" onkeydown="return CKEDITOR.tools.callFunction(106, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_47_label" role="button" hidefocus="true" tabindex="-1" title="Insert/Remove Numbered List" class="cke_off cke_button_numberedlist" id="cke_47"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_47_label">Insert/Remove Numbered List</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(111, this); return false;" onfocus="return CKEDITOR.tools.callFunction(110, event);" onkeydown="return CKEDITOR.tools.callFunction(109, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_48_label" role="button" hidefocus="true" tabindex="-1" title="Insert/Remove Bulleted List" class="cke_off cke_button_bulletedlist" id="cke_48"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_48_label">Insert/Remove Bulleted List</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(114, this); return false;" onfocus="return CKEDITOR.tools.callFunction(113, event);" onkeydown="return CKEDITOR.tools.callFunction(112, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_49_label" role="button" hidefocus="true" tabindex="-1" title="Decrease Indent" class="cke_button_outdent cke_disabled" id="cke_49" aria-disabled="true"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_49_label">Decrease Indent</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(117, this); return false;" onfocus="return CKEDITOR.tools.callFunction(116, event);" onkeydown="return CKEDITOR.tools.callFunction(115, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_50_label" role="button" hidefocus="true" tabindex="-1" title="Increase Indent" class="cke_off cke_button_indent" id="cke_50"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_50_label">Increase Indent</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(120, this); return false;" onfocus="return CKEDITOR.tools.callFunction(119, event);" onkeydown="return CKEDITOR.tools.callFunction(118, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_51_label" role="button" hidefocus="true" tabindex="-1" title="Block Quote" class="cke_off cke_button_blockquote" id="cke_51"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_51_label">Block Quote</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(123, this); return false;" onfocus="return CKEDITOR.tools.callFunction(122, event);" onkeydown="return CKEDITOR.tools.callFunction(121, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_52_label" role="button" hidefocus="true" tabindex="-1" title="Create Div Container" class="cke_off cke_button_creatediv" id="cke_52"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_52_label">Create Div Container</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(126, this); return false;" onfocus="return CKEDITOR.tools.callFunction(125, event);" onkeydown="return CKEDITOR.tools.callFunction(124, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_53_label" role="button" hidefocus="true" tabindex="-1" title="Align Left" class="cke_off cke_button_justifyleft" id="cke_53"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_53_label">Align Left</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(129, this); return false;" onfocus="return CKEDITOR.tools.callFunction(128, event);" onkeydown="return CKEDITOR.tools.callFunction(127, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_54_label" role="button" hidefocus="true" tabindex="-1" title="Center" class="cke_off cke_button_justifycenter" id="cke_54"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_54_label">Center</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(132, this); return false;" onfocus="return CKEDITOR.tools.callFunction(131, event);" onkeydown="return CKEDITOR.tools.callFunction(130, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_55_label" role="button" hidefocus="true" tabindex="-1" title="Align Right" class="cke_off cke_button_justifyright" id="cke_55"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_55_label">Align Right</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(135, this); return false;" onfocus="return CKEDITOR.tools.callFunction(134, event);" onkeydown="return CKEDITOR.tools.callFunction(133, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_56_label" role="button" hidefocus="true" tabindex="-1" title="Justify" class="cke_off cke_button_justifyblock" id="cke_56"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_56_label">Justify</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(138, this); return false;" onfocus="return CKEDITOR.tools.callFunction(137, event);" onkeydown="return CKEDITOR.tools.callFunction(136, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_57_label" role="button" hidefocus="true" tabindex="-1" title="Text direction from left to right" class="cke_off cke_button_bidiltr" id="cke_57"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_57_label">Text direction from left to right</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(141, this); return false;" onfocus="return CKEDITOR.tools.callFunction(140, event);" onkeydown="return CKEDITOR.tools.callFunction(139, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_58_label" role="button" hidefocus="true" tabindex="-1" title="Text direction from right to left" class="cke_off cke_button_bidirtl" id="cke_58"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_58_label">Text direction from right to left</span></a></span></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_59_label" class="cke_toolbar" id="cke_59"><span class="cke_voice_label" id="cke_59_label">Links</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(144, this); return false;" onfocus="return CKEDITOR.tools.callFunction(143, event);" onkeydown="return CKEDITOR.tools.callFunction(142, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_60_label" role="button" hidefocus="true" tabindex="-1" title="Link" class="cke_off cke_button_link" id="cke_60"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_60_label">Link</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(147, this); return false;" onfocus="return CKEDITOR.tools.callFunction(146, event);" onkeydown="return CKEDITOR.tools.callFunction(145, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_61_label" role="button" hidefocus="true" tabindex="-1" title="Unlink" class="cke_button_unlink cke_disabled" id="cke_61" aria-disabled="true"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_61_label">Unlink</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(150, this); return false;" onfocus="return CKEDITOR.tools.callFunction(149, event);" onkeydown="return CKEDITOR.tools.callFunction(148, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_62_label" role="button" hidefocus="true" tabindex="-1" title="Anchor" class="cke_off cke_button_anchor" id="cke_62"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_62_label">Anchor</span></a></span></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_63_label" class="cke_toolbar" id="cke_63"><span class="cke_voice_label" id="cke_63_label">Insert</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(153, this); return false;" onfocus="return CKEDITOR.tools.callFunction(152, event);" onkeydown="return CKEDITOR.tools.callFunction(151, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_64_label" role="button" hidefocus="true" tabindex="-1" title="Image" class="cke_off cke_button_image" id="cke_64"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_64_label">Image</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(156, this); return false;" onfocus="return CKEDITOR.tools.callFunction(155, event);" onkeydown="return CKEDITOR.tools.callFunction(154, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_65_label" role="button" hidefocus="true" tabindex="-1" title="Flash" class="cke_off cke_button_flash" id="cke_65"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_65_label">Flash</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(159, this); return false;" onfocus="return CKEDITOR.tools.callFunction(158, event);" onkeydown="return CKEDITOR.tools.callFunction(157, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_66_label" role="button" hidefocus="true" tabindex="-1" title="Table" class="cke_off cke_button_table" id="cke_66"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_66_label">Table</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(162, this); return false;" onfocus="return CKEDITOR.tools.callFunction(161, event);" onkeydown="return CKEDITOR.tools.callFunction(160, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_67_label" role="button" hidefocus="true" tabindex="-1" title="Insert Horizontal Line" class="cke_off cke_button_horizontalrule" id="cke_67"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_67_label">Insert Horizontal Line</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(165, this); return false;" onfocus="return CKEDITOR.tools.callFunction(164, event);" onkeydown="return CKEDITOR.tools.callFunction(163, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_68_label" role="button" hidefocus="true" tabindex="-1" title="Smiley" class="cke_off cke_button_smiley" id="cke_68"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_68_label">Smiley</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(168, this); return false;" onfocus="return CKEDITOR.tools.callFunction(167, event);" onkeydown="return CKEDITOR.tools.callFunction(166, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_69_label" role="button" hidefocus="true" tabindex="-1" title="Insert Special Character" class="cke_off cke_button_specialchar" id="cke_69"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_69_label">Insert Special Character</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(171, this); return false;" onfocus="return CKEDITOR.tools.callFunction(170, event);" onkeydown="return CKEDITOR.tools.callFunction(169, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_70_label" role="button" hidefocus="true" tabindex="-1" title="Insert Page Break for Printing" class="cke_off cke_button_pagebreak" id="cke_70"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_70_label">Insert Page Break for Printing</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(174, this); return false;" onfocus="return CKEDITOR.tools.callFunction(173, event);" onkeydown="return CKEDITOR.tools.callFunction(172, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_71_label" role="button" hidefocus="true" tabindex="-1" title="IFrame" class="cke_off cke_button_iframe" id="cke_71"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_71_label">IFrame</span></a></span></span><span class="cke_toolbar_end"></span></span>
                          <div class="cke_break"></div>
                          <span role="toolbar" aria-labelledby="cke_73_label" class="cke_toolbar" id="cke_73"><span class="cke_voice_label" id="cke_73_label">Styles</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_rcombo"><span role="presentation" class="cke_styles cke_off" id="cke_72"><span class="cke_label" id="cke_72_label">Styles</span><a onclick="CKEDITOR.tools.callFunction(175, this); return false;" onfocus="return CKEDITOR.tools.callFunction(177, event);" onkeydown="CKEDITOR.tools.callFunction( 176, event, this );" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="true" aria-describedby="cke_72_text" aria-labelledby="cke_72_label" role="button" tabindex="-1" title="Formatting Styles" hidefocus="true"><span><span class="cke_text cke_inline_label" id="cke_72_text">Styles</span></span><span class="cke_openbutton"><span class="cke_icon"></span></span></a></span></span><span role="presentation" class="cke_rcombo"><span role="presentation" class="cke_format cke_off" id="cke_74"><span class="cke_label" id="cke_74_label">Format</span><a onclick="CKEDITOR.tools.callFunction(178, this); return false;" onfocus="return CKEDITOR.tools.callFunction(180, event);" onkeydown="CKEDITOR.tools.callFunction( 179, event, this );" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="true" aria-describedby="cke_74_text" aria-labelledby="cke_74_label" role="button" tabindex="-1" title="Paragraph Format" hidefocus="true"><span><span class="cke_text cke_inline_label" id="cke_74_text">Format</span></span><span class="cke_openbutton"><span class="cke_icon"></span></span></a></span></span><span role="presentation" class="cke_rcombo"><span role="presentation" class="cke_font cke_off" id="cke_75"><span class="cke_label" id="cke_75_label">Font</span><a onclick="CKEDITOR.tools.callFunction(181, this); return false;" onfocus="return CKEDITOR.tools.callFunction(183, event);" onkeydown="CKEDITOR.tools.callFunction( 182, event, this );" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="true" aria-describedby="cke_75_text" aria-labelledby="cke_75_label" role="button" tabindex="-1" title="Font Name" hidefocus="true"><span><span class="cke_text cke_inline_label" id="cke_75_text">Font</span></span><span class="cke_openbutton"><span class="cke_icon"></span></span></a></span></span><span role="presentation" class="cke_rcombo"><span role="presentation" class="cke_fontSize cke_off" id="cke_76"><span class="cke_label" id="cke_76_label">Size</span><a onclick="CKEDITOR.tools.callFunction(184, this); return false;" onfocus="return CKEDITOR.tools.callFunction(186, event);" onkeydown="CKEDITOR.tools.callFunction( 185, event, this );" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="true" aria-describedby="cke_76_text" aria-labelledby="cke_76_label" role="button" tabindex="-1" title="Font Size" hidefocus="true"><span><span class="cke_text cke_inline_label" id="cke_76_text">Size</span></span><span class="cke_openbutton"><span class="cke_icon"></span></span></a></span></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_77_label" class="cke_toolbar" id="cke_77"><span class="cke_voice_label" id="cke_77_label">Colors</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(189, this); return false;" onfocus="return CKEDITOR.tools.callFunction(188, event);" onkeydown="return CKEDITOR.tools.callFunction(187, event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="true" aria-labelledby="cke_78_label" role="button" hidefocus="true" tabindex="-1" title="Text Color" class="cke_off cke_button_textcolor" id="cke_78"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_78_label">Text Color</span><span class="cke_buttonarrow">&nbsp;</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(192, this); return false;" onfocus="return CKEDITOR.tools.callFunction(191, event);" onkeydown="return CKEDITOR.tools.callFunction(190, event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="true" aria-labelledby="cke_79_label" role="button" hidefocus="true" tabindex="-1" title="Background Color" class="cke_off cke_button_bgcolor" id="cke_79"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_79_label">Background Color</span><span class="cke_buttonarrow">&nbsp;</span></a></span></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_80_label" class="cke_toolbar" id="cke_80"><span class="cke_voice_label" id="cke_80_label">Tools</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(195, this); return false;" onfocus="return CKEDITOR.tools.callFunction(194, event);" onkeydown="return CKEDITOR.tools.callFunction(193, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_81_label" role="button" hidefocus="true" tabindex="-1" title="Maximize" class="cke_off cke_button_maximize" id="cke_81"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_81_label">Maximize</span></a></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(198, this); return false;" onfocus="return CKEDITOR.tools.callFunction(197, event);" onkeydown="return CKEDITOR.tools.callFunction(196, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_82_label" role="button" hidefocus="true" tabindex="-1" title="Show Blocks" class="cke_off cke_button_showblocks" id="cke_82"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_82_label">Show Blocks</span></a></span><span role="separator" class="cke_separator"></span><span class="cke_button"><a onclick="CKEDITOR.tools.callFunction(201, this); return false;" onfocus="return CKEDITOR.tools.callFunction(200, event);" onkeydown="return CKEDITOR.tools.callFunction(199, event);" onblur="this.style.cssText = this.style.cssText;" aria-labelledby="cke_83_label" role="button" hidefocus="true" tabindex="-1" title="About CKEditor" class="cke_off cke_button_about" id="cke_83"><span class="cke_icon">&nbsp;</span><span class="cke_label" id="cke_83_label">About CKEditor</span></a></span></span><span class="cke_toolbar_end"></span></span></div>
                        <a onclick="CKEDITOR.tools.callFunction(202)" class="cke_toolbox_collapser" tabindex="-1" id="cke_84" title="Collapse Toolbar"><span>▲</span></a></td>
                    </tr>
                    <tr role="presentation">
                      <td role="presentation" style="height:200px" class="cke_contents" id="cke_contents_spintext"><iframe frameborder="0" allowtransparency="true" tabindex="0" src="" title="Rich text editor, spintext, press ALT 0 for help." style="width:100%;height:100%"></iframe></td>
                    </tr>
                    <tr role="presentation" style="-moz-user-select: none;">
                      <td role="presentation" class="cke_bottom" id="cke_bottom_spintext"><div onmousedown="CKEDITOR.tools.callFunction(3, event)" title="Drag to resize" class="cke_resizer cke_resizer_ltr"></div>
                        <span class="cke_voice_label" id="cke_path_spintext_label">Elements path</span>
                        <div aria-labelledby="cke_path_spintext_label" role="group" class="cke_path" id="cke_path_spintext"><span class="cke_empty">&nbsp;</span></div></td>
                    </tr>
                  </tbody>
                </table>
                <style>
.cke_skin_kama{visibility:hidden;}
</style>
                </span></span><span role="presentation" style="position:absolute;" tabindex="-1"></span></span>
                </p>
                <br>
                <br>
                <h3>Addable Picture</h3>
                <div id="articleBodyImg">
                  <ul>
                    <li><img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/v11.png"></li>
                    <li><img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/v12.png"></li>
                    <li><img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/v13.png"></li>
                    <li><img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/v14.png"></li>
                  </ul>
                  <div class="clear"></div>
                </div>
                <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Ping Your Blog</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                <p>Copy the url of your new completed blog  and ping it to other sites<u class="here" id="tutorial-video142">Here</u><br class="clear"></p>
                  <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Add your Articles </h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                <p>Offer your articles in your network of members</p>
                  <p class="ad_pic_doc"><a href="#" class="ad_dcm">Add document</a><a href="#">Add Picture</a><br class="clear"></p>
                
                <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Step 4 Complete</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                <a style="font-size:22px; float: right; color:#f00; margin-right:38px;" onclick="loadVideoGallery()" href="#li_2">Now Complete Step 5</a>
                 </div>
            </div>
            
            <!--3tab end......... --> 
            
            <!--4tab Start......... -->
            <div id="tab4" class="tab_content">
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="images/hqdefault.jpg" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>
                  </div>
                </div>
                <h3 class="headign-left"> Complete The Instructions Below</br>
                  Make $35  /  £30 in the UK</br>
                  For Everyone Who Joins You</h3>
                <h3 class="heading-right"><img border="0" alt="" src="images/rarrow.png"></h3>
                <br class="clear">
                <!--<div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Connect width newbies</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                <div class="white-space pp st1">
                  <h3 style="margin-bottom: 8px; padding-left:38px;">Add your details so your sign ups can contact you</h3>
                  <form enctype="multipart/form-data" action="http://ravebusiness.com/ravestorysociety/ravestorysociety/socialForm" method="post" id="frm_new">
                    <label><span> Add your skype ID </span>
                      <input type="text" value="naren.evikasystems" name="skype_id">
                    </label>
                    <label> <span>Cell Number </span>
                      <input type="text" value="9857421456" name="cell_no">
                    </label>
                    <label> <span>Facebook/group </span>
                      <input type="text" value="https://www.facebook.com/otiz.angel" name="facebook_url">
                    </label>
                    <label> <span>Email ID </span>
                      <input type="text" value="otizfangel@googlemail.com" name="social_email">
                    </label>
                    <label> <span>Rave Blogger </span>
                      <input type="text" value="http://www.raveblogger.com/?author=1000" name="social_rave_blog">
                    </label>
                    <label> <span>Twitter </span>
                      <input type="text" value="www.twitter.com" name="social_twitter">
                    </label>
                    <label> <span>Youtube </span>
                      <input type="text" value="http://www.youtube.com/watch?v=rWrEbXoP5lM&amp;feature=youtu.be" name="social_youtube">
                    </label>
                    <label><span>Add Photo</span>
                      <input type="file" onchange="readURL(this);" value="Add photo" name="pro_photo" class="brws">
                    </label>
                    <label>
                    <div id="contact-image"><img alt="" src="http://ravebusiness.com/ravestorysociety/upload/profile/tmb6625284020140227-00-46-49.jpg" id="empPic"></div>
                    </label>
                    <label>
                    <p style="float:left!important;width:350px!important"></p>
                    <input type="submit" style="float:right;" value="" class="extra-blue-btn">
                    
                    <div class="clear"></div>
                    </label>
                  </form>
                </div>-->
                <div class="ab_inner "><strong>B</strong>
                  <h3>Download Brochure</h3>
                  <span><a class="watch-video-tut" name="http://www.youtube.com/watch?v=pDOdKCbaS5M&feature=youtube" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <h3 class="new_head">Use Photos of Your Weekend To Boost Your GEB Business</h3>
                  <p>If you have Instagram then collect one of our funny adverts below and post it with your message and website address (url) . Laughter always brings traffic. You can also use these pictures on your facebook &amp; other sites too.</p>
                  <ul class="twitter_user">
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/tmb6418336320140102-00-08-39.jpg"></a> </div>
                      <div class="tpbb"><a class="" href="" id="copyAdvert1">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_1" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;"> </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl1" name="advertUrl1" value="images/tmb6418336320140102-00-08-39.jpg">
                    </li>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/tmb7402021120140102-00-05-16.jpg"></a> </div>
                      <div class="tpbb"><a class="" href="javascript:void(0)" id="copyAdvert2">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_2" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;">
                          <embed width="35" height="21" align="middle" wmode="transparent" flashvars="id=2&amp;width=35&amp;height=21" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" name="ZeroClipboardMovie_2" bgcolor="#ffffff" quality="best" menu="false" loop="false" src="ZeroClipboard.swf" id="ZeroClipboardMovie_2"> 
                        </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl2" name="advertUrl2" value="images/tmb7402021120140102-00-05-16.jpg">
                    </li>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/1404371936Doctors.jpg"></a> </div>
                      <div class="tpbb"><a class="" href="javascript:void(0)" id="copyAdvert21">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_3" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;">
                          <embed width="35" height="21" align="middle" wmode="transparent" flashvars="id=3&amp;width=35&amp;height=21" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" name="ZeroClipboardMovie_3" bgcolor="#ffffff" quality="best" menu="false" loop="false" src="ZeroClipboard.swf" id="ZeroClipboardMovie_3"> 
                        </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl21" name="advertUrl21" value="images/1404371936Doctors.jpg">
                    </li>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/tmb49286150620140102-00-10-43.jpg"></a> </div>
                      <div class="tpbb"><a class="" href="javascript:void(0)" id="copyAdvert4">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_4" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;">
                          <embed width="35" height="21" align="middle" wmode="transparent" flashvars="id=4&amp;width=35&amp;height=21" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" name="ZeroClipboardMovie_4" bgcolor="#ffffff" quality="best" menu="false" loop="false" src="ZeroClipboard.swf" id="ZeroClipboardMovie_4"> 
                        </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl4" name="advertUrl4" value="images/tmb49286150620140102-00-10-43.jpg">
                    </li>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/1400695518Meaningful-Beauty-Maintenance-Night-Cream-Cindy-Crawford-signature-cream.jpg"></a> </div>
                      <div class="tpbb"><a class="" href="javascript:void(0)" id="copyAdvert14">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_5" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;">
                          <embed width="35" height="21" align="middle" wmode="transparent" flashvars="id=5&amp;width=35&amp;height=21" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" name="ZeroClipboardMovie_5" bgcolor="#ffffff" quality="best" menu="false" loop="false" src="ZeroClipboard.swf" id="ZeroClipboardMovie_5"> 
                        </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl14" name="advertUrl14" value="images/1400695518Meaningful-Beauty-Maintenance-Night-Cream-Cindy-Crawford-signature-cream.jpg">
                    </li>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/1400695345Medium_signal-128.png"></a> </div>
                      <div class="tpbb"><a class="" href="javascript:void(0)" id="copyAdvert20">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_6" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;">
                          <embed width="35" height="21" align="middle" wmode="transparent" flashvars="id=6&amp;width=35&amp;height=21" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" name="ZeroClipboardMovie_6" bgcolor="#ffffff" quality="best" menu="false" loop="false" src="ZeroClipboard.swf" id="ZeroClipboardMovie_6"> 
                        </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl20" name="advertUrl20" value="images/1400695345Medium_signal-128.png">
                    </li>
                  </ul>
                </div>
                
                <!--end white-space-->
                
                <div class="ab_inner"><strong>C</strong>
                  <h3>Download vCard</h3>
                  <span><a class="watch-video-tut" name="http://www.youtube.com/embed/-EkL81gUe_A" id="tutorial-videoS3" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <h3 class="new_head">Use Photos of Your Weekend To Boost Your GEB Business</h3>
                  <p>If you have Instagram then collect one of our funny adverts below and post it with your message and website address (url) . Laughter always brings traffic. You can also use these pictures on your facebook &amp; other sites too.</p>
                  <ul class="twitter_user">
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/tmb6418336320140102-00-08-39.jpg"></a> </div>
                      <div class="tpbb"><a class="" href="" id="copyAdvert1">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_1" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;"> </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl1" name="advertUrl1" value="images/tmb6418336320140102-00-08-39.jpg">
                    </li>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/tmb7402021120140102-00-05-16.jpg"></a> </div>
                      <div class="tpbb"><a class="" href="javascript:void(0)" id="copyAdvert2">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_2" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;">
                          <embed width="35" height="21" align="middle" wmode="transparent" flashvars="id=2&amp;width=35&amp;height=21" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" name="ZeroClipboardMovie_2" bgcolor="#ffffff" quality="best" menu="false" loop="false" src="ZeroClipboard.swf" id="ZeroClipboardMovie_2"> 
                        </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl2" name="advertUrl2" value="images/tmb7402021120140102-00-05-16.jpg">
                    </li>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/1404371936Doctors.jpg"></a> </div>
                      <div class="tpbb"><a class="" href="javascript:void(0)" id="copyAdvert21">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_3" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;">
                          <embed width="35" height="21" align="middle" wmode="transparent" flashvars="id=3&amp;width=35&amp;height=21" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" name="ZeroClipboardMovie_3" bgcolor="#ffffff" quality="best" menu="false" loop="false" src="ZeroClipboard.swf" id="ZeroClipboardMovie_3"> 
                        </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl21" name="advertUrl21" value="images/1404371936Doctors.jpg">
                    </li>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/tmb49286150620140102-00-10-43.jpg"></a> </div>
                      <div class="tpbb"><a class="" href="javascript:void(0)" id="copyAdvert4">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_4" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;">
                          <embed width="35" height="21" align="middle" wmode="transparent" flashvars="id=4&amp;width=35&amp;height=21" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" name="ZeroClipboardMovie_4" bgcolor="#ffffff" quality="best" menu="false" loop="false" src="ZeroClipboard.swf" id="ZeroClipboardMovie_4"> 
                        </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl4" name="advertUrl4" value="images/tmb49286150620140102-00-10-43.jpg">
                    </li>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/1400695518Meaningful-Beauty-Maintenance-Night-Cream-Cindy-Crawford-signature-cream.jpg"></a> </div>
                      <div class="tpbb"><a class="" href="javascript:void(0)" id="copyAdvert14">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_5" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;">
                          <embed width="35" height="21" align="middle" wmode="transparent" flashvars="id=5&amp;width=35&amp;height=21" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" name="ZeroClipboardMovie_5" bgcolor="#ffffff" quality="best" menu="false" loop="false" src="ZeroClipboard.swf" id="ZeroClipboardMovie_5"> 
                        </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl14" name="advertUrl14" value="images/1400695518Meaningful-Beauty-Maintenance-Night-Cream-Cindy-Crawford-signature-cream.jpg">
                    </li>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="images/1400695345Medium_signal-128.png"></a> </div>
                      <div class="tpbb"><a class="" href="javascript:void(0)" id="copyAdvert20">Copy</a>
                        <div class="zclip" id="zclip-ZeroClipboardMovie_6" style="position: absolute; left: 29px; top: -2px; width: 35px; height: 21px; z-index: 99;">
                          <embed width="35" height="21" align="middle" wmode="transparent" flashvars="id=6&amp;width=35&amp;height=21" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="false" allowscriptaccess="always" name="ZeroClipboardMovie_6" bgcolor="#ffffff" quality="best" menu="false" loop="false" src="ZeroClipboard.swf" id="ZeroClipboardMovie_6"> 
                        </div>
                      </div>
                      <div class="tptt"><a href="">Download</a></div>
                      <input type="hidden" id="advertUrl20" name="advertUrl20" value="images/1400695345Medium_signal-128.png">
                    </li>
                  </ul>
                </div>
                <br class="clear">
              <div class="switch">
  <h3 style="text-align:center;">Congratulations <br>
    You have completed the Level 2 </h3>
  <h2 style="text-align:center;">To step up for Level 3 </h2>
  <h4 style="text-align:center;">Click Switch On To Pay</h4>
  <div class="switch_extrapara">
    <!--<p><strong>Inside You Can Enjoy</strong></p>
    <ul class="list_extra">
      <li>Powerful Marketing Tools To explode your Rave Business</li>
      <li>Gifts, VIP &amp; Discounts to events</li>
      <li>Personal Marketing suite.</li><br class="clear">
    </ul>-->
    <p class="swt_img"><img width="424" height="81" onclick="window.location.href='http://192.168.2.117/gbe/gbe_payment/swichOn'" style="cursor:pointer" alt="" src="images/submit-paypal.png"></p>
  </div>
</div><br class="clear"></div>
              
            </div>
            <!--4tab end......... --> 
            
            <!--5tab start......... -->
            <div id="tab5" class="tab_content">
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="images/hqdefault.jpg" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>
                  </div>
                </div>
                <h3 class="headign-left"> Complete The Instructions Below</br>
                  Make $35  /  £30 in the UK</br>
                  For Everyone Who Joins You</h3>
                <h3 class="heading-right"><img border="0" alt="" src="images/rarrow.png"></h3>
                <br class="clear">
                <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Connect width newbies</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                <div class="white-space pp st1">
                  <h3 style="margin-bottom: 8px; padding-left:38px;">Find the Society That Is Nearest To Where You Live and Join It</h3>
                  <div id="main_list_new" class="main_list"> 
                    <!-- Stylish menu start -->
                    <div class="stylish_menu">
                      <ul class="accordion mix">
                        <!--<li id="one"> <a href="#one">United States</a>
                        <ul class="sub-menu">                      
                          <li>
                            <table width="100%" border="1">
                                                         
                            </table>
                          </li>
                        </ul>
                      </li>-->
                        <li id="one"> <a href="#one">North America </a>
                          <ul class="sub-menu">
                            <li>
                              <table width="100%" border="1">
                              </table>
                            </li>
                          </ul>
                        </li>
                        <li id="two"> <a href="#two">United Kingdom &amp; Ireland </a>
                          <ul class="sub-menu">
                            <li>
                              <table width="100%" border="1">
                                <tbody>
                                  <tr>
                                    <td class="one"><a href="#">Angelorum</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="leave-btn"> <a id="leave" href="#">Leave</a></div></td>
                                  </tr>
                                  <tr>
                                    <td class="one"><a href="#">bhaskar123</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=50">Join</a></div></td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                          </ul>
                        </li>
                        <li id="three"> <a href="#three">Europe</a>
                          <ul class="sub-menu">
                            <li>
                              <table width="100%" border="1">
                                <tbody>
                                  <tr>
                                    <td class="one"><a href="#">testing13</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=14">Join</a></div></td>
                                  </tr>
                                  <tr>
                                    <td class="one"><a href="#">testing14</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=18">Join</a></div></td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                          </ul>
                        </li>
                        <li id="four"> <a href="#four">Canada</a>
                          <ul class="sub-menu">
                            <li>
                              <table width="100%" border="1">
                                <tbody>
                                  <tr>
                                    <td class="one"><a href="#">testing7</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=9">Join</a></div></td>
                                  </tr>
                                  <tr>
                                    <td class="one"><a href="#">testing8</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=11">Join</a></div></td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                          </ul>
                        </li>
                        <li id="five"> <a href="#five">Australia</a>
                          <ul class="sub-menu">
                            <li>
                              <table width="100%" border="1">
                                <tbody>
                                  <tr>
                                    <td class="one"><a href="#">testing5</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=16">Join</a></div></td>
                                  </tr>
                                  <tr>
                                    <td class="one"><a href="#">testing6</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=17">Join</a></div></td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                          </ul>
                        </li>
                        <li id="six"> <a href="#six">Africa</a>
                          <ul class="sub-menu">
                            <li>
                              <table width="100%" border="1">
                                <tbody>
                                  <tr>
                                    <td class="one"><a href="#">Test1</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=8">Join</a></div></td>
                                  </tr>
                                  <tr>
                                    <td class="one"><a href="#">Test2</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=10">Join</a></div></td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                          </ul>
                        </li>
                        <li id="seven"> <a href="#seven">Asia</a>
                          <ul class="sub-menu">
                            <li>
                              <table width="100%" border="1">
                                <tbody>
                                  <tr>
                                    <td class="one"><a href="#">testing3</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=15">Join</a></div></td>
                                  </tr>
                                  <tr>
                                    <td class="one"><a href="#">testing4</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"><a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=19">Join</a></div></td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                          </ul>
                        </li>
                        <!--  <li id="seven"> <a href="#seven">Caribbean</a>
                        <ul class="sub-menu">
                          <li>
                            <table width="100%" border="1">
                                                            <tr>
                                    <td class="one"><a href="#">test9</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three">
                                                                                                            <div class="join-btn"><a href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=20" onclick="alert('You can not join two society at a time');return false;">Join</a></div>                                   
                                    </td>
                                </tr>
                                                                <tr>
                                    <td class="one"><a href="#">testing10</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three">
                                                                                                            <div class="join-btn"><a href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=21" onclick="alert('You can not join two society at a time');return false;">Join</a></div>                                   
                                    </td>
                                </tr>
                                                           
                            </table>
                          </li>
                        </ul>
                      </li>-->
                        <li id="eight"> <a href="#eight">South America</a>
                          <ul class="sub-menu">
                            <li>
                              <table width="100%" border="1">
                                <tbody>
                                  <tr>
                                    <td class="one"><a href="#">Angelorum</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="leave-btn"> <a id="leave" href="#">Leave</a></div></td>
                                  </tr>
                                  <tr>
                                    <td class="one"><a href="#">bhaskar123</a></td>
                                    <td class="two">Bam Rave Squad</td>
                                    <td class="three"><div class="join-btn"> <a onclick="alert('You can not join two society at a time');return false;" href="http://ravebusiness.com/ravestorysociety/ravestorysociety/joinsociety/?sid=50">Join</a></div></td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                          </ul>
                        </li>
                        <div class="clear"></div>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="ab_inner "><strong>B</strong>
                  <h3 class="d_hdr">Use your talent</h3>
                  <span><a class="watch-video-tut" name="http://www.youtube.com/watch?v=pDOdKCbaS5M&feature=youtube" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="table-status">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="talentst">
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Jonathan Hinds</td>
                        <td>1062</td>
                        <td>07466032702</td>
                        <td>mrjahinds@aol.co.uk</td>
                        <td>Philippines</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Jonathan Hinds</td>
                        <td>1062</td>
                        <td>07466032702</td>
                        <td>mrjahinds@aol.co.uk</td>
                        <td>Philippines</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Jonathan Hinds</td>
                        <td>1062</td>
                        <td>07466032702</td>
                        <td>mrjahinds@aol.co.uk</td>
                        <td>Philippines</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Jonathan Hinds</td>
                        <td>1062</td>
                        <td>07466032702</td>
                        <td>mrjahinds@aol.co.uk</td>
                        <td>Philippines</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Jonathan Hinds</td>
                        <td>1062</td>
                        <td>07466032702</td>
                        <td>mrjahinds@aol.co.uk</td>
                        <td>Philippines</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>Jonathan Hinds</td>
                        <td>1062</td>
                        <td>07466032702</td>
                        <td>mrjahinds@aol.co.uk</td>
                        <td>Philippines</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>Jonathan Hinds</td>
                        <td>1062</td>
                        <td>07466032702</td>
                        <td>mrjahinds@aol.co.uk</td>
                        <td>Philippines</td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td>Jonathan Hinds</td>
                        <td>1062</td>
                        <td>07466032702</td>
                        <td>mrjahinds@aol.co.uk</td>
                        <td>Philippines</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                
                <!--end white-space--> 
                
                <br class="clear">
              </div>
            </div>
            <!--5tab end......... --> 
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
          <!--          <li class="sm007"> <a id="serviceList_4" href="javascript:void(0)">Listen to GBE Radio</a> </li>-->
          <li class="sm003"> <a id="serviceList_5" href="#">Total Member Under GBE Business</a>
            <div id="slist_5" class="list_service">
              <p class="total-number">0</p>
            </div>
          </li
        >
        </ul>
      </div>
      <div class="webbox1" style="display: none;">
        <div class="upl_form web"><span>Free Listing on AFROWEBB</span>
          <form id="prd_upld" method="post" enctype="multipart/form-data">
            <p>
              <label>Name</label>
              <input type="text" name="listingName" id="listingName">
            </p>
            <p>
              <label>Address</label>
              <textarea name="listingAddr" id="listingAddr"></textarea>
            </p>
            <p>
              <label>Number</label>
              <input type="text" name="listingNo" id="listingNo">
            </p>
            <p>
              <label>Email</label>
              <input type="text" name="listingEmail" id="listingEmail">
            </p>
            <p>
              <label>Country</label>
              <select id="listingCountry" name="listingCountry">
                <option value="">Select Country </option>
                <option value="1"  selected="selected" >Afghanistan</option>
                <option value="2" >Albania</option>
                <option value="3" >Algeria</option>
                <option value="4" >American Samoa</option>
                <option value="5" >Andorra</option>
                <option value="6" >Angola</option>
                <option value="7" >Anguilla</option>
                <option value="8" >Antarctica</option>
                <option value="9" >Antigua and Barbuda</option>
                <option value="10" >Argentina</option>
                <option value="11" >Armenia</option>
                <option value="12" >Aruba</option>
                <option value="13" >Australia</option>
                <option value="14" >Austria</option>
                <option value="15" >Azerbaijan</option>
                <option value="16" >Bahamas</option>
                <option value="17" >Bahrain</option>
                <option value="18" >Bangladesh</option>
                <option value="19" >Barbados</option>
                <option value="20" >Belarus</option>
                <option value="21" >Belgium</option>
                <option value="22" >Belize</option>
                <option value="23" >Benin</option>
                <option value="24" >Bermuda</option>
                <option value="25" >Bhutan</option>
                <option value="26" >Bolivia</option>
                <option value="27" >Bosnia and Herzegovina</option>
                <option value="28" >Botswana</option>
                <option value="29" >Bouvet Island</option>
                <option value="30" >Brazil</option>
                <option value="31" >British Indian Ocean Territory</option>
                <option value="32" >Brunei Darussalam</option>
                <option value="33" >Bulgaria</option>
                <option value="34" >Burkina Faso</option>
                <option value="35" >Burundi</option>
                <option value="36" >Cambodia</option>
                <option value="37" >Cameroon</option>
                <option value="38" >Canada</option>
                <option value="39" >Cape Verde</option>
                <option value="40" >Cayman Islands</option>
                <option value="41" >Central African Republic</option>
                <option value="42" >Chad</option>
                <option value="43" >Chile</option>
                <option value="44" >China</option>
                <option value="45" >Christmas Island</option>
                <option value="46" >Cocos (Keeling) Islands</option>
                <option value="47" >Colombia</option>
                <option value="48" >Comoros</option>
                <option value="49" >Congo</option>
                <option value="50" >Cook Islands</option>
                <option value="51" >Costa Rica</option>
                <option value="52" >Cote D'Ivoire</option>
                <option value="53" >Croatia</option>
                <option value="54" >Cuba</option>
                <option value="55" >Cyprus</option>
                <option value="56" >Czech Republic</option>
                <option value="57" >Denmark</option>
                <option value="58" >Djibouti</option>
                <option value="59" >Dominica</option>
                <option value="60" >Dominican Republic</option>
                <option value="61" >East Timor</option>
                <option value="62" >Ecuador</option>
                <option value="63" >Egypt</option>
                <option value="64" >El Salvador</option>
                <option value="65" >Equatorial Guinea</option>
                <option value="66" >Eritrea</option>
                <option value="67" >Estonia</option>
                <option value="68" >Ethiopia</option>
                <option value="69" >Falkland Islands (Malvinas)</option>
                <option value="70" >Faroe Islands</option>
                <option value="71" >Fiji</option>
                <option value="72" >Finland</option>
                <option value="74" >France, Metropolitan</option>
                <option value="75" >French Guiana</option>
                <option value="76" >French Polynesia</option>
                <option value="77" >French Southern Territories</option>
                <option value="78" >Gabon</option>
                <option value="79" >Gambia</option>
                <option value="80" >Georgia</option>
                <option value="81" >Germany</option>
                <option value="82" >Ghana</option>
                <option value="83" >Gibraltar</option>
                <option value="84" >Greece</option>
                <option value="85" >Greenland</option>
                <option value="86" >Grenada</option>
                <option value="87" >Guadeloupe</option>
                <option value="88" >Guam</option>
                <option value="89" >Guatemala</option>
                <option value="90" >Guinea</option>
                <option value="91" >Guinea-Bissau</option>
                <option value="92" >Guyana</option>
                <option value="93" >Haiti</option>
                <option value="94" >Heard and Mc Donald Islands</option>
                <option value="95" >Honduras</option>
                <option value="96" >Hong Kong</option>
                <option value="97" >Hungary</option>
                <option value="98" >Iceland</option>
                <option value="99" >India</option>
                <option value="100" >Indonesia</option>
                <option value="101" >Iran (Islamic Republic of)</option>
                <option value="102" >Iraq</option>
                <option value="103" >Ireland</option>
                <option value="104" >Israel</option>
                <option value="105" >Italy</option>
                <option value="106" >Jamaica</option>
                <option value="107" >Japan</option>
                <option value="108" >Jordan</option>
                <option value="109" >Kazakhstan</option>
                <option value="110" >Kenya</option>
                <option value="111" >Kiribati</option>
                <option value="112" >North Korea</option>
                <option value="113" >Korea, Republic of</option>
                <option value="114" >Kuwait</option>
                <option value="115" >Kyrgyzstan</option>
                <option value="116" >Lao People's Democratic Republic</option>
                <option value="117" >Latvia</option>
                <option value="118" >Lebanon</option>
                <option value="119" >Lesotho</option>
                <option value="120" >Liberia</option>
                <option value="121" >Libyan Arab Jamahiriya</option>
                <option value="122" >Liechtenstein</option>
                <option value="123" >Lithuania</option>
                <option value="124" >Luxembourg</option>
                <option value="125" >Macau</option>
                <option value="126" >FYROM</option>
                <option value="127" >Madagascar</option>
                <option value="128" >Malawi</option>
                <option value="129" >Malaysia</option>
                <option value="130" >Maldives</option>
                <option value="131" >Mali</option>
                <option value="132" >Malta</option>
                <option value="133" >Marshall Islands</option>
                <option value="134" >Martinique</option>
                <option value="135" >Mauritania</option>
                <option value="136" >Mauritius</option>
                <option value="137" >Mayotte</option>
                <option value="138" >Mexico</option>
                <option value="139" >Micronesia, Federated States of</option>
                <option value="140" >Moldova, Republic of</option>
                <option value="141" >Monaco</option>
                <option value="142" >Mongolia</option>
                <option value="143" >Montserrat</option>
                <option value="144" >Morocco</option>
                <option value="145" >Mozambique</option>
                <option value="146" >Myanmar</option>
                <option value="147" >Namibia</option>
                <option value="148" >Nauru</option>
                <option value="149" >Nepal</option>
                <option value="150" >Netherlands</option>
                <option value="151" >Netherlands Antilles</option>
                <option value="152" >New Caledonia</option>
                <option value="153" >New Zealand</option>
                <option value="154" >Nicaragua</option>
                <option value="155" >Niger</option>
                <option value="156" >Nigeria</option>
                <option value="157" >Niue</option>
                <option value="158" >Norfolk Island</option>
                <option value="159" >Northern Mariana Islands</option>
                <option value="160" >Norway</option>
                <option value="161" >Oman</option>
                <option value="162" >Pakistan</option>
                <option value="163" >Palau</option>
                <option value="164" >Panama</option>
                <option value="165" >Papua New Guinea</option>
                <option value="166" >Paraguay</option>
                <option value="167" >Peru</option>
                <option value="168" >Philippines</option>
                <option value="169" >Pitcairn</option>
                <option value="170" >Poland</option>
                <option value="171" >Portugal</option>
                <option value="172" >Puerto Rico</option>
                <option value="173" >Qatar</option>
                <option value="174" >Reunion</option>
                <option value="175" >Romania</option>
                <option value="176" >Russian Federation</option>
                <option value="177" >Rwanda</option>
                <option value="178" >Saint Kitts and Nevis</option>
                <option value="179" >Saint Lucia</option>
                <option value="180" >Saint Vincent and the Grenadines</option>
                <option value="181" >Samoa</option>
                <option value="182" >San Marino</option>
                <option value="183" >Sao Tome and Principe</option>
                <option value="184" >Saudi Arabia</option>
                <option value="185" >Senegal</option>
                <option value="186" >Seychelles</option>
                <option value="187" >Sierra Leone</option>
                <option value="188" >Singapore</option>
                <option value="189" >Slovak Republic</option>
                <option value="190" >Slovenia</option>
                <option value="191" >Solomon Islands</option>
                <option value="192" >Somalia</option>
                <option value="193" >South Africa</option>
                <option value="194" >South Georgia &amp; South Sandwich Islands</option>
                <option value="195" >Spain</option>
                <option value="196" >Sri Lanka</option>
                <option value="197" >St. Helena</option>
                <option value="198" >St. Pierre and Miquelon</option>
                <option value="199" >Sudan</option>
                <option value="200" >Suriname</option>
                <option value="201" >Svalbard and Jan Mayen Islands</option>
                <option value="202" >Swaziland</option>
                <option value="203" >Sweden</option>
                <option value="204" >Switzerland</option>
                <option value="205" >Syrian Arab Republic</option>
                <option value="206" >Taiwan</option>
                <option value="207" >Tajikistan</option>
                <option value="208" >Tanzania, United Republic of</option>
                <option value="209" >Thailand</option>
                <option value="210" >Togo</option>
                <option value="211" >Tokelau</option>
                <option value="212" >Tonga</option>
                <option value="213" >Trinidad and Tobago</option>
                <option value="214" >Tunisia</option>
                <option value="215" >Turkey</option>
                <option value="216" >Turkmenistan</option>
                <option value="217" >Turks and Caicos Islands</option>
                <option value="218" >Tuvalu</option>
                <option value="219" >Uganda</option>
                <option value="220" >Ukraine</option>
                <option value="221" >United Arab Emirates</option>
                <option value="222" >United Kingdom</option>
                <option value="223" >United States</option>
                <option value="224" >United States Minor Outlying Islands</option>
                <option value="225" >Uruguay</option>
                <option value="226" >Uzbekistan</option>
                <option value="227" >Vanuatu</option>
                <option value="228" >Vatican City State (Holy See)</option>
                <option value="229" >Venezuela</option>
                <option value="230" >Viet Nam</option>
                <option value="231" >Virgin Islands (British)</option>
                <option value="232" >Virgin Islands (U.S.)</option>
                <option value="233" >Wallis and Futuna Islands</option>
                <option value="234" >Western Sahara</option>
                <option value="235" >Yemen</option>
                <option value="237" >Democratic Republic of Congo</option>
                <option value="238" >Zambia</option>
                <option value="239" >Zimbabwe</option>
                <option value="240" >Jersey</option>
                <option value="241" >Guernsey</option>
                <option value="242" >Montenegro</option>
                <option value="243" >Serbia</option>
                <option value="244" >Aaland Islands</option>
                <option value="245" >Bonaire, Sint Eustatius and Saba</option>
                <option value="246" >Curacao</option>
                <option value="247" >Palestinian Territory, Occupied</option>
                <option value="248" >South Sudan</option>
                <option value="249" >St. Barthelemy</option>
                <option value="250" >St. Martin (French part)</option>
                <option value="251" >Canary Islands</option>
              </select>
            </p>
            <p>
              <label>State</label>
              <input type="text" name="listingState" id="listingState">
            </p>
            <p>
              <label>City</label>
              <select id="listingCity" name="listingCity">
                <option value="">Select City </option>
                <option value="1" >London</option>
                <option value="2" >Portsmouths</option>
                <option value="3" >Banjul</option>
                <option value="4" >Barcelona</option>
              </select>
            </p>
            <p>
              <label>Description</label>
              <textarea name="listingDesc" id="listingDesc"></textarea>
            </p>
            <p>
              <label>Website</label>
              <input type="text" name="listingWebsite" id="listingWebsite">
            </p>
            <p>
              <label>Youtube Url</label>
              <input type="text" name="listingUrl" id="listingUrl">
            </p>
            <p>
              <label>Image</label>
              <input type="file" name="listingImg" id="listingImg" value="Choose file">
            </p>
            <p>
              <label>Put afroo links to view this members </label>
              <input type="text" name="lisUrl" id="lisUrl">
            </p>
            <p>
              <input type="submit" name="freeListing" id="freeListingId" value="Save">
            </p>
          </form>
        </div>
      </div>
      <div class="webbox">
        <p class="web"> <span>My Sign Up Page:</span> <a target="_blank" href="#">gbe/gateway_signup/Angel.Francis.999</a> </p>
        <p class="web"> <span>My Afrowebb Catalogue :</span> 
          <!--<a target="_blank" href="http://www.afrowebb.com/membership/999">http://www.afrowebb.com/membership/999</a>--> 
          <a target="_blank" href="#">www.afrowebb.com</a> </p>
      </div>
      <div class="webbox">
        <p class="web"> <span>My Sign Up of Teacher Page :</span> <a target="_blank" href="#">gbe/signup_teachers/Angel.Francis.999</a> </p>
        <p class="web"> <span>My Sign Up of Student Page :</span> <a target="_blank" href="#">gbe/signup_student/Angel.Francis.999</a> </p>
      </div>
      <div class="webbox">
        <p class="web"> <span>My Sign Up of Head Volunteers Page :</span> <a target="_blank" href="#">gbe/signup_head_volunteers/Angel.Francis.999</a> </p>
        <p class="web"> <span>My Sign Up of Volunteers Page :</span> <a target="_blank" href="#">gbe/signup_volunteers/Angel.Francis.999</a> </p>
      </div>
      <div class="webbox">
        <p class="web"> <span>My Sign Up of Business Page :</span> <a target="_blank" href="#">gbe/signup_business/Angel.Francis.999</a> </p>
        <p class="web"> <span>My Sign Up of Talent Page:</span> <a target="_blank" href="#">gbe/signup_talented/Angel.Francis.999</a> </p>
        <p class="web"> <span>My Sign Up of Mentorship Page :</span> <a target="_blank" href="#">gbe/signup_mentorship/Angel.Francis.999</a> </p>
        <p class="web"> <span>My Sign Up of Health Wellness Page:</span> <a target="_blank" href="#">gbe/signup_health/Angel.Francis.999</a> </p>
        <p class="web"> <span>My Sign Up of Community Page:</span> <a target="_blank" href="#">gbe/signup_communities/Angel.Francis.999</a> </p>
      </div>
      <div style="margin:7px 0 0 0px;" class="blue-box webbox">
        <p class="ana">OverView of Level 3</p>
        <ul>
          <li>Members in Level 3 Under This Referral:6</li>
          <li>Rave &nbsp;Story:&nbsp; 6</li>
          <li>Bhaskar&nbsp;Mandal:&nbsp; 5</li>
          <li>terter1&nbsp;terst:&nbsp; 0</li>
          <li>Naren&nbsp;Das:&nbsp; 0</li>
          <li>Abhisek&nbsp;Majumdar:&nbsp; 0</li>
          <li>Jenny Mae&nbsp;Gapasin:&nbsp; 0</li>
        </ul>
      </div>
    </div>
    <br class="clear">
  </div>
  <div class="table-status"> 
    <!--<table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tbody>
        <tr>
          <th valign="middle" height="35" align="center" scope="col">Image</th>
          <th valign="middle" height="35" align="center" scope="col">Name</th>
          <th valign="middle" height="35" align="center" scope="col">Phone</th>
          <th valign="middle" height="35" align="center" scope="col">Email</th>
          <th valign="middle" height="35" align="center" scope="col">Country</th>
          <th valign="middle" height="35" align="center" scope="col">Expel</th>
                      <th valign="middle" height="35" align="center" scope="col">Delete</th>
                  </tr>
                <tr>
          <td valign="middle" height="45" align="center"><img height="35" src="images/member_img.png"></td>
          <td valign="middle" height="45" align="center">Ricky Pon</td>
          <td valign="middle" height="45" align="center">1234567890</td>
          <td valign="middle" height="45" align="center">teacher@gbe.com</td>
          <td valign="middle" height="45" align="center">Afghanistan</td>
                    <td valign="middle" height="45" align="center">&nbsp;</td>
                                
                     <td valign="middle" height="45" align="center"><a href="http://192.168.2.117/gbe/dashboard/deleteUserFromExpell/1042" class="expellDeleteClass" onclick="return confirm('Are you sure to delete the user details.');" id="1042">Delete</a></td>
                  </tr>
                <tr>
          <td valign="middle" height="45" align="center"><img height="35" src="images/member_img.png"></td>
          <td valign="middle" height="45" align="center">steve smith</td>
          <td valign="middle" height="45" align="center">1234567890</td>
          <td valign="middle" height="45" align="center">head_volunteers@gbe.com</td>
          <td valign="middle" height="45" align="center">Afghanistan</td>
                    <td valign="middle" height="45" align="center">&nbsp;</td>
                                
                     <td valign="middle" height="45" align="center"><a href="http://192.168.2.117/gbe/dashboard/deleteUserFromExpell/1043" class="expellDeleteClass" onclick="return confirm('Are you sure to delete the user details.');" id="1043">Delete</a></td>
                  </tr>
                <tr>
          <td valign="middle" height="45" align="center"><img height="35" src="images/member_img.png"></td>
          <td valign="middle" height="45" align="center">max well</td>
          <td valign="middle" height="45" align="center">1234567890</td>
          <td valign="middle" height="45" align="center">student@gbe.com</td>
          <td valign="middle" height="45" align="center">Afghanistan</td>
                    <td valign="middle" height="45" align="center"><a href="javascript:void(0);" class="expellClass" id="1044">Expel</a></td>
                    
                     <td valign="middle" height="45" align="center"><a href="http://192.168.2.117/gbe/dashboard/deleteUserFromExpell/1044" class="expellDeleteClass" onclick="return confirm('Are you sure to delete the user details.');" id="1044">Delete</a></td>
                  </tr>
                <tr>
          <td valign="middle" height="45" align="center"><img height="35" src="images/member_img.png"></td>
          <td valign="middle" height="45" align="center">kiron polard</td>
          <td valign="middle" height="45" align="center">1234567890</td>
          <td valign="middle" height="45" align="center">volunteers@gbe.com</td>
          <td valign="middle" height="45" align="center">Afghanistan</td>
                    <td valign="middle" height="45" align="center">&nbsp;</td>
                                
                     <td valign="middle" height="45" align="center"><a href="http://192.168.2.117/gbe/dashboard/deleteUserFromExpell/1045" class="expellDeleteClass" onclick="return confirm('Are you sure to delete the user details.');" id="1045">Delete</a></td>
                  </tr>
                <tr>
          <td valign="middle" height="45" align="center"><img height="35" src="images/member_img.png"></td>
          <td valign="middle" height="45" align="center">mat damn</td>
          <td valign="middle" height="45" align="center">1234569870</td>
          <td valign="middle" height="45" align="center">paying_user@gbe.com</td>
          <td valign="middle" height="45" align="center">Afghanistan</td>
                    <td valign="middle" height="45" align="center">&nbsp;</td>
                                
                     <td valign="middle" height="45" align="center"><a href="http://192.168.2.117/gbe/dashboard/deleteUserFromExpell/1046" class="expellDeleteClass" onclick="return confirm('Are you sure to delete the user details.');" id="1046">Delete</a></td>
                  </tr>
                <tr>
          <td valign="middle" height="45" align="center"><img height="35" src="images/member_img.png"></td>
          <td valign="middle" height="45" align="center">test user</td>
          <td valign="middle" height="45" align="center">123456</td>
          <td valign="middle" height="45" align="center">non_paying_user@gbe.com</td>
          <td valign="middle" height="45" align="center">Afghanistan</td>
                    <td valign="middle" height="45" align="center">&nbsp;</td>
                                
                     <td valign="middle" height="45" align="center"><a href="http://192.168.2.117/gbe/dashboard/deleteUserFromExpell/1047" class="expellDeleteClass" onclick="return confirm('Are you sure to delete the user details.');" id="1047">Delete</a></td>
                  </tr>
              </tbody>
    </table>--> 
  </div>
</div>

<script type="text/javascript">
jQuery(function ($) {
	// Load dialog on click
	$('.palvidd').click(function (e) {
            $(this).next('.basic-modal-content').modal();
            return false; 
	});
	});
var userLevel  = 5;
var formSubmitMsg = "";
var formSubmitType = "";
</script> 
<script type='text/javascript' src='js/custom_common.js'></script>
<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
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
  </style>
</body>
</html>


