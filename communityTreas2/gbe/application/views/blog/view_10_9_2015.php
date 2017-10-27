<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $blogDetails[0]->post_title;?></title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/blog.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/carosel.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,300' rel='stylesheet' type='text/css'>
</head>
<body class="bllgs" style="background:url(<?php echo base_url();?>useruploads/blogs/images/body-bg.png) 0 0 no-repeat #ecf0f1">
<div class="top bggl">
  <div class="top-inn">
    <div class="logo fltleft hed_inr">
      <h1><a href="<?php echo base_url();?>dashboard">
        <div class="logo-img"> </div>
        </a></h1>
    </div>
    <!--<div class="log_form fltright"> <span><a href="<?php// echo base_url();?>gateway/logout/" style="color:#FFFFFF;">Log Out</a></span> </div>
    <div class="clear"></div>-->
    <div id="message_box"></div>
  </div>
</div>
<div class="wrapper">
   <!--header section-->
  <!--header end-->
  <div class="cont_sec">
  
    <div class="hd_sec">
      <div class="hd_sec_in">
        <div class="pr_pic_na"> <img src="<?php echo base_url().'useruploads/'.$userInfo[0]['profile'];?>" align="">
          <p>Name: <?php echo $userInfo[0]['firstName'].' '.$userInfo[0]['lastName'];?></p>
        </div>
        <div class="headerrightform">
          <h2><span>Join My Rave Business</span> To Make Money Online</h2>
          <h3>Make Friends, Make Money, Make a Difference</h3>
        </div>
        <br class="clear">
      </div>
    </div>
    <div class="main_container blog_dtls">
    
    <div class="lefts_side">
      <div class="white-bg">
        <h1 class="bgs">Blog Details</h1>
        <div class="blog_page">
          <div class="blg_dv">
            <h3><?php echo $blogDetails[0]->post_title;?></h3>
            <div class="authr">
              <p> <strong class="name"><?php echo $blogDetails[0]->firstName;?> <?php echo $blogDetails[0]->lastName;?></strong> | <strong><?php echo date("F jS, Y",strtotime($blogDetails[0]->post_date));?></strong> | <strong id="countComment"><?php echo $blogDetails[0]->comment_count;?> comments</strong> </p>
            </div>        
            <div class="short_dsc"><?php echo $blogDetails[0]->post_content;?></div>
            <div class="share_rdmr"> 
              <div class="shre_ths"> 
              <ul id="logoZone" >
					  	
						   <li>
  <a href="javascript:void(0)" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $blogDetails[0]->post_title;?>&amp;p[summary]=<?php echo $blogDetails[0]->post_title;?>&amp;p[url]=<?php echo urlencode(base_url().'blog/view/'.$blogDetails[0]->post_title_url);?>','sharer','toolbar=0,status=0,width=650,height=600');" target="_parent"><img src="<?php echo base_url(); ?>images/facebook.png" border="0" /></a></li>
                           
						   <li>
   <a href="javascript:void(0)" onclick="window.open('http://twitter.com/share?text=<?php echo $blogDetails[0]->post_title;?>&url=<?php echo urlencode(base_url().'blog/view/'.$blogDetails[0]->post_title_url); ?>', 'child', 'scrollbars,width=650,height=600'); return false"><img src="<?php echo base_url(); ?>images/twitter.png" border="0" /></a></li>
                           
						   <li>
   <a href="javascript:void(0)" onclick="window.open('https://plus.google.com/share?url=<?php echo urlencode(base_url().'blog/view/'.$blogDetails[0]->post_title_url); ?>&title=<?php echo $blogDetails[0]->post_title;?>&caption=<?php echo $blogDetails[0]->post_title;?>&description=<?php echo  $blogDetails[0]->post_title;?>', 'child', 'scrollbars,width=650,height=600'); return false"><img src="<?php echo base_url(); ?>images/google_plus.png" border="0" /></a></li>
                           
				    </ul>
              </div>
              <div class="clear"></div>
            </div>
            <div class="post_frme">
           <h3 class="comment-reply-title"><a href="#">Leave a Reply</a></h3>
           <form action="" method="post" id="psts_frmein" >
           <p class="comment-notes">Your email address will not be published. Required fields are marked <span class="required">*</span></p>
           <p class="nmes"><label for="author">Name <span class="required">*</span></label><input type="text" name="guestName" id="guestName" value="">
           	<strong class="errors" id="eGstName"></strong>
           </p>
           <p class="mles"><label for="author">Email <span class="required">*</span></label><input type="text" name="guestEmail" id="guestEmail" value="">
           <strong class="errors" id="eGstEmail"></strong></p><br class="clear">
           <!--<p><label for="author">Website</label><input type="text" value=""><strong class="errors">error</strong></p>-->
           <p><label for="author">Comment</label><textarea name="guestComment" id="guestComment" type="text" value=""></textarea>
           <strong class="errors" id="eGstComment">error</strong></p>
           <p class="btn_cnc"><input type="submit" value="Post Comment" id="commentAdd"><!--<input type="button" value="Cancel Comment">--></p>
           </form>
			<div class="cmts">
            <ul id="commentDetails">
            <?php if(count($commentDetails) > 0){ foreach($commentDetails as $cd){?>
				<li><h3><?php echo $cd->comment_content;?></h3>
            		<div class="authr">
              		<p><strong class="name"><?php echo $cd->comment_name;?></strong> | <strong><?php echo date("F jS, Y",strtotime($cd->comment_date));?></strong> </p>
            		</div>
                </li>
            <?php } }?>
			</ul> 
            </div>       				
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="rights_side">
        <div class="rightvideosec">
          <h3><?php echo $getRightPanelVideo[0]->content;?></h3>
          <img alt="" src="<?php echo base_url();?>adminuploads/level_wise_images/<?php echo $getRightPanelVideo[0]->content_image;?>"> 
          <a class="watch-video-tut1" name="<?php echo $getRightPanelVideo[0]->path;?>" id="tutorial-video5" href="javascript:void(0)"><span class="left">
          <img alt="" src="<?php echo base_url();?>img/blog/video-arrow-left.png"></span>Watch Video<span class="right">
          <img alt="" src="<?php echo base_url();?>img/blog/video-arrow-right.png"></span>
          </a> </div>
        <div class="recentpostsec">
          <h2>Recent Posts</h2>
          <ul>
          <?php if(count($recentBlogDetails) > 0): foreach($recentBlogDetails as $rbd):?>
            <li><a title="<?php echo $rbd->post_title;?>" href="<?php echo base_url().'blog/view/'.$rbd->post_title_url;?>"><?php echo $rbd->post_title;?></a></li>
            <?php endforeach; else:?>
            <li><a title="Look bla bla">No Post Please</a></li>
            <?php endif;?>
          </ul>
          <!--<p>The Money Effect Another Hyped up Marketing System…</p>
<p>Harlem Shake Dance Video Compilations</p>
<p>Copy Paste Cash Review: Is It Worth Your Time</p>--> 
        </div>
        <div class="recentpostsec yrse">
          <h2>Archive Posts</h2>
          <ul>
             <?php if(count($year) > 0): foreach($year as $yr):?>
            <li><a title="<?php echo $yr->yy;?>" href="<?php echo base_url().'blog/archive/'.$userInfo[0]['uID'].'/'.$yr->yy;?>"><?php echo $yr->yy;?></a></li>
            <?php endforeach; else:?>
            <li><a title="Look bla bla">No Post Please</a></li>
            <?php endif;?>
          </ul>
          <!--<p>The Money Effect Another Hyped up Marketing System…</p>
<p>Harlem Shake Dance Video Compilations</p>
<p>Copy Paste Cash Review: Is It Worth Your Time</p>--> 
        </div>
      </div>
    <br class="clear">
  </div>
  </div>
  <?php $this->load->view('blog/footer');?>
</div>
<script type="text/javascript">
var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";

</script> 
<script type='text/javascript' src='<?php echo base_url();?>js/custom_common.js'></script>
<script type="text/javascript">
var _baseUrl = '<?php echo base_url();?>';
$(document).ready(function(e) {
	
	
    $('#commentAdd').click(function(e) {
		$('.errors').hide();
		var post_id = '<?php echo $blogDetails[0]->post_id;?>';
		var comment_name = $('#guestName').val();
		var comment_email = $('#guestEmail').val();
		var comment_content = $('#guestComment').val();
		var retData = formValidation(comment_name,comment_email,comment_content);
		if(retData == 1){
			 $.ajax({
			 	type : 'POST',
				url : _baseUrl+'blog/addCommentAjax',
				data : 	'post_id='+post_id+'&comment_name='+comment_name+'&comment_email='+comment_email+'&comment_content='+comment_content,
				success : function(data){
					var dd = $.parseJSON(data);
					$('#countComment').text(dd.commentCount);
					$('#commentDetails').prepend(dd.commentDetails);
				}
			 });
		}
		return false;
    });
});

function formValidation(name,email,comment){
	var incr = 1;
	if(name == ''){
		$('#eGstName').text('Name field is required.');
		$('#eGstName').show();
		incr = incr + 1;
	}
	var err = emailValidation(email);
	if(err != ''){
		$('#eGstEmail').text(err);
		$('#eGstEmail').show();
		incr = incr + 1;
	}
	
	if(comment == ''){
		$('#eGstComment').text('Comment field is required.');
		$('#eGstComment').show();
		incr = incr + 1;
	}
	
	return incr;
}


$(".watch-video-tut1").click(function() {
	var path = $(this).attr("name");
	$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
});
</script>
</body>
</html>
