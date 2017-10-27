<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>GBE Level 4 st1</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/p_color.css" rel="stylesheet" type="text/css">
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jqueryy-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.zclip.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){	

	$('a#copyAdvert'+1).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#advertUrl'+1).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.tpbb a').css('background','#A20000');
			$('.tpbb a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
			
	});
	$('a#copyAdvert'+2).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#advertUrl'+2).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.tpbb a').css('background','#A20000');
			$('.tpbb a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
			
	});
	$('a#copyAdvert'+21).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#advertUrl'+21).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.tpbb a').css('background','#A20000');
			$('.tpbb a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
			
	});
	$('a#copyAdvert'+4).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#advertUrl'+4).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.tpbb a').css('background','#A20000');
			$('.tpbb a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
			
	});
	$('a#copyAdvert'+14).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#advertUrl'+14).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.tpbb a').css('background','#A20000');
			$('.tpbb a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
			
	});
	$('a#copyAdvert'+20).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#advertUrl'+20).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.tpbb a').css('background','#A20000');
			$('.tpbb a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
			
	});
	$('a#bannerCopy'+1).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#bannerUrl'+1).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.mbr a').css('background','#A20000');
			$('.mbr a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
	});
	$('a#bannerCopy'+2).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#bannerUrl'+2).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.mbr a').css('background','#A20000');
			$('.mbr a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
	});
	$('a#bannerCopy'+3).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#bannerUrl'+3).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.mbr a').css('background','#A20000');
			$('.mbr a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
	});
	$('a#bannerCopy'+4).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#bannerUrl'+4).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.mbr a').css('background','#A20000');
			$('.mbr a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
	});

     $('a#copyYouTube'+1).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#youtubeUrl'+1).val(),
			beforeCopy:function(){
			$('a#copyYouTube'+1).css('background','yellow');
				$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.cbz a').css('background','#031F30');
			$('.cbz a').css('color','white');
			$('a#copyYouTube'+1).css('background','green');
				$(this).css('color','white');
				$(this).next('.check').show();
			}
	});	
	

     $('a#copyYouTube'+2).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#youtubeUrl'+2).val(),
			beforeCopy:function(){
			$('a#copyYouTube'+2).css('background','yellow');
				$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.cbz a').css('background','#031F30');
			$('.cbz a').css('color','white');
			$('a#copyYouTube'+2).css('background','green');
				$(this).css('color','white');
				$(this).next('.check').show();
			}
	});	
	

     $('a#copyYouTube'+3).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#youtubeUrl'+3).val(),
			beforeCopy:function(){
			$('a#copyYouTube'+3).css('background','yellow');
				$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.cbz a').css('background','#031F30');
			$('.cbz a').css('color','white');
			$('a#copyYouTube'+3).css('background','green');
				$(this).css('color','white');
				$(this).next('.check').show();
			}
	});	
	

     $('a#copyYouTube'+4).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#youtubeUrl'+4).val(),
			beforeCopy:function(){
			$('a#copyYouTube'+4).css('background','yellow');
				$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.cbz a').css('background','#031F30');
			$('.cbz a').css('color','white');
			$('a#copyYouTube'+4).css('background','green');
				$(this).css('color','white');
				$(this).next('.check').show();
			}
	});	
	

     $('a#copyYouTube'+5).zclip({
			path:'ZeroClipboard.swf',			
			copy:$('input#youtubeUrl'+5).val(),
			beforeCopy:function(){
			$('a#copyYouTube'+5).css('background','yellow');
				$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.cbz a').css('background','#031F30');
			$('.cbz a').css('color','white');
			$('a#copyYouTube'+5).css('background','green');
				$(this).css('color','white');
				$(this).next('.check').show();
			}
	});	
	
	
	/*$('a#newcopy').zclip({
	    path:'http://192.168.2.117/gbe/js/ZeroClipboard.swf',
       copy:$('input#imagePost16').val()	
    });	*/
});	
</script>
<script src="js/organictabs.jquery.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	jQuery('#mycarousel').jcarousel();
});
$(function() {
    
            $(".containertab").organicTabs({
                "speed": 200
            });
});
function showSecondTab(){
		$("ul.tabs li a").removeClass("current"); //Remove any "active" class
		$("ul.tabs li:nth-child(2) a").addClass("current"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		$("#tab2").fadeIn(); //Fade in the active content
		return false;
}
function showThirdTab(){
		$("ul.tabs li a").removeClass("current"); //Remove any "active" class
		$("ul.tabs li:nth-child(3) a").addClass("current"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		$("#tab3").fadeIn(); //Fade in the active content
		return false;
}
function showThirdTab(){
		$("ul.tabs li a").removeClass("current"); //Remove any "active" class
		$("ul.tabs li:nth-child(4) a").addClass("current"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		$("#tab4").fadeIn(); //Fade in the active content
		return false;
}
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
      <h1><a href="#">
        <div class="logo-img"> </div>
        </a></h1>
    </div>
    <div class="log_form fltright"> <span><a href="#" style="color:#FFFFFF;">Log Out</a></span> </div>
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
          
          <!--          <li class="levelClass" id="1"><a href="javascript:void(0)" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>
          <li class="levelClass" id="2"><a href="javascript:void(0)" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>
          <li class="levelClass" id="3"><a href="javascript:void(0)" id="gbeLevel3"><span class="level">Level - 3</span> The Source<span> Open </span></a></li>
          <li class="levelClass" id="4"><a href="javascript:void(0)" id="gbeLevel4"><span class="level">Level - 4</span>Regeneration<span> Open </span> </a></li>
          <li class="levelClass" id="5" style="padding-right:0;"><a href="javascript:void(0)" id="gbeLevel5"><span class="level">Level - 5</span> Franchise <span> Open </span> </a></li>-->
          
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
          <!--<ul class="tabs">
            <li><a href="#tab1" class="tabClass current" name="tab1">Step1</a></li>
            <li><a href="#tab2" class="tabClass " name="tab2">step2</a></li>
            <li><a href="#tab3" class="tabClass " name="tab3">step3</a></li>
            <li><a href="#tab4" class="tabClass " name="tab4">step4</a></li>
          </ul>-->
          <div class="tab_container">
            <div id="tab1" class="tab_content">
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
                  <h3 class="d_hdr">Skype</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                  <div class="paidimgeaa">
           <div class="csd"><p class="blue-txt">Add more new friends who like to party and have fun.</p>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because they can help you market your Rave Business in colleges and universities.
           <!--commented on 19-02-2014-->
           <!--Donec eget ante a ipsum porttitor adipiscing eu non nisl. Vestibulum vitae auctor nisi. Maecenas eget varius libero. Ut consequat, nunc feugiat facilisis dictum, felis 			 diam faucibus mi, sit amet suscipit eros tortor nec lorem. Fusce facilisis lorem sit amet dignissim varius. Integer pellentesque tincidunt cursus. Vivamus ante enim,             faucibus eu ultrices in, tincidunt ac tellus. --></p></div>
           
           <!--<iframe width="460" height="315" src="//www.youtube.com/embed/SDYFqQZEdRA" frameborder="0" allowfullscreen></iframe>-->
           <img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/add friends.jpg">
           <br class="clear">

           </div>
           <div class="clear"></div>
                           <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Text Message</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                  <div class="paidimgeaa">
           <div class="csd"><p class="blue-txt">Add more new friends who like to party and have fun.</p>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because they can help you market your Rave Business in colleges and universities.
           <!--commented on 19-02-2014-->
           <!--Donec eget ante a ipsum porttitor adipiscing eu non nisl. Vestibulum vitae auctor nisi. Maecenas eget varius libero. Ut consequat, nunc feugiat facilisis dictum, felis 			 diam faucibus mi, sit amet suscipit eros tortor nec lorem. Fusce facilisis lorem sit amet dignissim varius. Integer pellentesque tincidunt cursus. Vivamus ante enim,             faucibus eu ultrices in, tincidunt ac tellus. --></p></div>
           
           <!--<iframe width="460" height="315" src="//www.youtube.com/embed/SDYFqQZEdRA" frameborder="0" allowfullscreen></iframe>-->
           <img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/add friends.jpg">
           <br class="clear">

           </div>
           <div class="clear"></div>
           <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Skype</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                  <div class="paidimgeaa">
           <div class="csd"><p class="blue-txt">Add more new friends who like to party and have fun.</p>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because they can help you market your Rave Business in colleges and universities.
           <!--commented on 19-02-2014-->
           <!--Donec eget ante a ipsum porttitor adipiscing eu non nisl. Vestibulum vitae auctor nisi. Maecenas eget varius libero. Ut consequat, nunc feugiat facilisis dictum, felis 			 diam faucibus mi, sit amet suscipit eros tortor nec lorem. Fusce facilisis lorem sit amet dignissim varius. Integer pellentesque tincidunt cursus. Vivamus ante enim,             faucibus eu ultrices in, tincidunt ac tellus. --></p></div>
           
           <!--<iframe width="460" height="315" src="//www.youtube.com/embed/SDYFqQZEdRA" frameborder="0" allowfullscreen></iframe>-->
           <img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/add friends.jpg">
           <br class="clear">

           </div>
           <div class="clear"></div>
                           <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Text Message</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                  <div class="paidimgeaa">
           <div class="csd"><p class="blue-txt">Add more new friends who like to party and have fun.</p>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because they can help you market your Rave Business in colleges and universities.
           <!--commented on 19-02-2014-->
           <!--Donec eget ante a ipsum porttitor adipiscing eu non nisl. Vestibulum vitae auctor nisi. Maecenas eget varius libero. Ut consequat, nunc feugiat facilisis dictum, felis 			 diam faucibus mi, sit amet suscipit eros tortor nec lorem. Fusce facilisis lorem sit amet dignissim varius. Integer pellentesque tincidunt cursus. Vivamus ante enim,             faucibus eu ultrices in, tincidunt ac tellus. --></p></div>
           
           <!--<iframe width="460" height="315" src="//www.youtube.com/embed/SDYFqQZEdRA" frameborder="0" allowfullscreen></iframe>-->
           <img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/add friends.jpg">
           <br class="clear">

           </div>
           <div class="clear"></div>
           <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Skype</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                  <div class="paidimgeaa">
           <div class="csd"><p class="blue-txt">Add more new friends who like to party and have fun.</p>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because they can help you market your Rave Business in colleges and universities.
           <!--commented on 19-02-2014-->
           <!--Donec eget ante a ipsum porttitor adipiscing eu non nisl. Vestibulum vitae auctor nisi. Maecenas eget varius libero. Ut consequat, nunc feugiat facilisis dictum, felis 			 diam faucibus mi, sit amet suscipit eros tortor nec lorem. Fusce facilisis lorem sit amet dignissim varius. Integer pellentesque tincidunt cursus. Vivamus ante enim,             faucibus eu ultrices in, tincidunt ac tellus. --></p></div>
           
           <!--<iframe width="460" height="315" src="//www.youtube.com/embed/SDYFqQZEdRA" frameborder="0" allowfullscreen></iframe>-->
           <img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/add friends.jpg">
           <br class="clear">

           </div>
           <div class="clear"></div>
                           <div class="ab_inner"><strong>A </strong>
                  <h3 class="d_hdr">Text Message</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                  <div class="paidimgeaa">
           <div class="csd"><p class="blue-txt">Add more new friends who like to party and have fun.</p>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because they can help you market your Rave Business in colleges and universities.
           <!--commented on 19-02-2014-->
           <!--Donec eget ante a ipsum porttitor adipiscing eu non nisl. Vestibulum vitae auctor nisi. Maecenas eget varius libero. Ut consequat, nunc feugiat facilisis dictum, felis 			 diam faucibus mi, sit amet suscipit eros tortor nec lorem. Fusce facilisis lorem sit amet dignissim varius. Integer pellentesque tincidunt cursus. Vivamus ante enim,             faucibus eu ultrices in, tincidunt ac tellus. --></p></div>
           
           <!--<iframe width="460" height="315" src="//www.youtube.com/embed/SDYFqQZEdRA" frameborder="0" allowfullscreen></iframe>-->
           <img src="http://ravebusiness.com/ravestorysociety/Application/content/member/images/add friends.jpg">
           <br class="clear">

           </div>
           <div class="clear"></div>
              </div>
            </div>
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
                  <h3 class="d_hdr">Skype</h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="http://www.youtube.com/embed/-EkL81gUe_A" href="javascript:void(0)">Watch Video</a></span> </div>
                  <div class="lav_for_st_two">
           <div class="insnd">
           <img src="images/leb4_1.png" alt="" >
           <h3>ldskvmdfm</h3>
           <strong>Germeny</strong>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because </p>
           <div class="denst">
           		<div class="lines_grn">
                	<strong class="grn"></strong><strong class="ashssd"></strong>
                    <div class="clear"></div>
                </div>
            <p><strong>202</strong>bodyes</p>
           	<p><strong>$52002</strong>bodyes</p>           	
            <p><strong>2</strong>bodyes</p>           
            </div>
           </div>
           <div class="insnd">
           <img src="images/leb4_2.png" alt="" >
           <h3>ldskvmdfm</h3>
           <strong>Germeny</strong>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because </p>
           <div class="denst">
           		<div class="lines_grn">
                	<strong class="grn"></strong><strong class="ashssd"></strong>
                    <div class="clear"></div>
                </div>
            <p><strong>202</strong>bodyes</p>
           	<p><strong>$52002</strong>bodyes</p>           	
            <p><strong>2</strong>bodyes</p>           
            </div>
           </div>
           <div class="insnd">
           <img src="images/leb4_1.png" alt="" >
           <h3>ldskvmdfm</h3>
           <strong>Germeny</strong>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because </p>
           <div class="denst">
           		<div class="lines_grn">
                	<strong class="grn"></strong><strong class="ashssd"></strong>
                    <div class="clear"></div>
                </div>
            <p><strong>202</strong>bodyes</p>
           	<p><strong>$52002</strong>bodyes</p>           	
            <p><strong>2</strong>bodyes</p>           
            </div>
           </div>
           <div class="insnd">
           <img src="images/leb4_2.png" alt="" >
           <h3>ldskvmdfm</h3>
           <strong>Germeny</strong>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because </p>
           <div class="denst">
           		<div class="lines_grn">
                	<strong class="grn"></strong><strong class="ashssd"></strong>
                    <div class="clear"></div>
                </div>
            <p><strong>202</strong>bodyes</p>
           	<p><strong>$52002</strong>bodyes</p>           	
            <p><strong>2</strong>bodyes</p>           
            </div>
           </div>
           <div class="insnd">
           <img src="images/leb4_1.png" alt="" >
           <h3>ldskvmdfm</h3>
           <strong>Germeny</strong>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because </p>
           <div class="denst">
           		<div class="lines_grn">
                	<strong class="grn"></strong><strong class="ashssd"></strong>
                    <div class="clear"></div>
                </div>
            <p><strong>202</strong>bodyes</p>
           	<p><strong>$52002</strong>bodyes</p>           	
            <p><strong>2</strong>bodyes</p>           
            </div>
           </div>
           <div class="insnd">
           <img src="images/leb4_2.png" alt="" >
           <h3>ldskvmdfm</h3>
           <strong>Germeny</strong>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because </p>
           <div class="denst">
           		<div class="lines_grn">
                	<strong class="grn"></strong><strong class="ashssd"></strong>
                    <div class="clear"></div>
                </div>
            <p><strong>202</strong>bodyes</p>
           	<p><strong>$52002</strong>bodyes</p>           	
            <p><strong>2</strong>bodyes</p>           
            </div>
           </div>
           <div class="insnd">
           <img src="images/leb4_1.png" alt="" >
           <h3>ldskvmdfm</h3>
           <strong>Germeny</strong>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because </p>
           <div class="denst">
           		<div class="lines_grn">
                	<strong class="grn"></strong><strong class="ashssd"></strong>
                    <div class="clear"></div>
                </div>
            <p><strong>202</strong>bodyes</p>
           	<p><strong>$52002</strong>bodyes</p>           	
            <p><strong>2</strong>bodyes</p>           
            </div>
           </div>
           <div class="insnd">
           <img src="images/leb4_2.png" alt="" >
           <h3>ldskvmdfm</h3>
           <strong>Germeny</strong>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because </p>
           <div class="denst">
           		<div class="lines_grn">
                	<strong class="grn"></strong><strong class="ashssd"></strong>
                    <div class="clear"></div>
                </div>
            <p><strong>202</strong>bodyes</p>
           	<p><strong>$52002</strong>bodyes</p>           	
            <p><strong>2</strong>bodyes</p>           
            </div>
           </div>
           <div class="insnd">
           <img src="images/leb4_1.png" alt="" >
           <h3>ldskvmdfm</h3>
           <strong>Germeny</strong>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because </p>
           <div class="denst">
           		<div class="lines_grn">
                	<strong class="grn"></strong><strong class="ashssd"></strong>
                    <div class="clear"></div>
                </div>
            <p><strong>202</strong>bodyes</p>
           	<p><strong>$52002</strong>bodyes</p>           	
            <p><strong>2</strong>bodyes</p>           
            </div>
           </div>
           <div class="insnd">
           <img src="images/leb4_2.png" alt="" >
           <h3>ldskvmdfm</h3>
           <strong>Germeny</strong>
           <p>Remember to check out their profiles first to make sure they are decent people and have a good attitude. Students are great because </p>
           <div class="denst">
           		<div class="lines_grn">
                	<strong class="grn"></strong><strong class="ashssd"></strong>
                    <div class="clear"></div>
                </div>
            <p><strong>202</strong>bodyes</p>
           	<p><strong>$52002</strong>bodyes</p>           	
            <p><strong>2</strong>bodyes</p>           
            </div>
           </div>       
           <br class="clear">

           </div>
           <div class="clear"></div>
              </div>
            </div>
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
            <p class="ana">OverView of Level 2</p>
            	<ul>
                	<li>Members in Level 2 Under This Referral:6</li>
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
    
$(document).ready(function() {
   
    
	$(".share-btn").click(function(e){
		$(this).parent().find('.share-popup').fadeIn(1000);
	 }); 
	$(".share-btn").blur(function(e){
		$(this).parent().find('.share-popup').fadeOut(1000);
	}); 
        $(".watch-video-tut").click(function() {
            var path = $(this).attr("name");
            $.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
        });
        $(".watch-video-tut1").click(function() {
            var path = $(this).attr("name");
            $.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
        });
        
});

</script> 
<script type="text/javascript">
jQuery(function ($) {
	// Load dialog on click
	$('.palvidd').click(function (e) {
            $(this).next('.basic-modal-content').modal();
            return false; 
	});
        
	$('.clickopen').click(function () {
            $(this).next().slideToggle("slow");
	});
        
        /* expell functionality */
        $(".expellClass").click(function(){
            var id = $(this).attr("id");
            $.ajax({
                type : "POST",
                data : "uID="+id,
                url : "",
                success : function(data){
                    //alert(data);
					formSubmitMsg ='User expelled successfully';
					$.fancybox.open(formSubmitMsg);
                }
            }); 
        });
        
    /*end*/
	
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
