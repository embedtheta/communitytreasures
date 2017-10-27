<?php $this->load->view("header", "", $result); ?>
<!DOCTYPE html>
<html>

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
		$('.close_btn_level').click(function(){
	 	$('.ppup_level').remove();
	 });
 })
</script>
<script type="text/javascript" src="jquery.fancybox.js?v=2.1.4"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
<style type="text/css">
ul.tabs li a{padding: 6px 9px;}
</style>
</head>
<body class="source">
<div class="top">
  <div class="top-inn">
    <div class="logo fltleft hed_inr">
      <h1><a href="<?php echo base_url();?>dashboard">
        <div class="logo-img"> </div>
        </a></h1>
    </div>
    
  
  </div>
</div>
<!--11/12/2015 new added by ujjwal sana-->
<?php if($totalMembersUnderMeNew > 1){?>
<div class="ppup_level">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_level" title="Close"></a>
  <h2>Congratulations</h2>
  <h3>You have enough people to move up.</h3>
  <h4>Click "Move Up" to get access next level<br>
 </h4>
  <h5>Move to level 4 </h5>
  <p class="termsCond">
    <input type="checkbox" id="termsCheck" class="ckbxe">
    <span>Terms & Conditions</span>
	</p>
  <div class="switch_extrapara">
    <p class="swt_img"><a id="moveUp" href="javascript:;"><img width="424" height="81" style="cursor:pointer" alt="" src="<?php echo base_url();?>images/move_up.png"></a></p>
  </div>
</div>
</div>
</div>
<?php }?>
<!--11/12/2015-->
<!--new added 21/09/2015 ujjwal sana-->
<?php $this->load->view("nav_header", "", $result); ?>

<div class="wrapper">
<!--
  <header>
    <div class="pulldiv"><a href="javascript:void(0)" class="pull">NAVIGATION</a></div>
    <div class="nav">
      <nav class="secondary">
        <ul class="misc_new">
         
        <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>
          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] > 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>
          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] > 2){ echo base_url()."source";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Level - 3</span> Source<span> Open </span></a></li>
          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo base_url()."corporation";}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Level - 4</span> Corporation <span> Open </span> </a></li>
          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] > 4){ echo base_url()."summit";}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Level - 5</span>Summit<span> Open </span> </a></li>
          
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
  </header>-->
  <!--header end-->
  <!--body start-->
  <div class="main_container">
  <div class="lefts_side"> 
  <div class="tabsectionstep">
      <div class="containertab">
        <ul class="tabs">
		<?php if($ct_url) {?>
		<li class="active"><a rel="tab6" href="javascript:void(0)" onclick="showMonetizerTab()"><?php echo $tab6Name;?><span>&nbsp;</span></a></li>
		<?php } ?>
          <li class="active"><a rel="tab1" href="javascript:void(0)" onclick="showFirstTab()">Home Schooling<span>&nbsp;</span></a></li>
          <li><a  rel="tab2" href="javascript:void(0)" onclick="showSecondTab()">Career Enhancements<span>&nbsp;</span></a></li>
          <li><a rel="tab3" href="javascript:void(0)" onclick="showThirdTab()">LIfe Essentials<span>&nbsp;</span></a></li>
		 <?php if($userInfo[0]["afrooPaymentStatus"] > 0) {?>
			<li id="tab44"><a rel="tab4" href="javascript:void(0)" onclick="showProdict_UploadTab()">Give Karma<span>&nbsp;</span></a></li>
		 <?php } else {?>
					<li id="tab5"><a rel="tab5" href="javascript:void(0)" onclick="no_permission()">Give Karma<span>&nbsp;</span></a></li>
		 <?php }?>
        </ul>
        <div class="tab_container" style="width:610px;">
          <div class="tab_content" id="tab1" style="display: block;">
          
            <div class="yvideo extra-pad">
            <span class="watch-thisvideo">Watch This Video</span>
            <div class="palvidd" style="width:540px; height:320px; margin:0 auto;"><a href="javascript:void(0)" id="tutorial-video101">
           <img src="<?php echo base_url(); ?>images/homesc.png" border="0" alt=""  />
           </a></div>
             </div>
             <br class="clear"/>
          	<div class="grade-subjectsec">
            <div class="left-grade">
            <h3>Yr / Grade</h3>
            <table width="89%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20" height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Seventh Grade</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Eighth Grade</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Ninth Grade</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Tenth Grade</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Eleventh Grade</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Twelfth Grade</td>
  </tr>
</table>
            </div>
            <div class="right-subject">
            <h3>Subjects</h3>
            <table width="42%" border="0" cellspacing="0" cellpadding="0" style="float:left; margin-left:10px;">
  <tr>
    <td width="20" height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Art</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Foreign Language</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Health</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">History</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Language / English</td>
  </tr>
 <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Literature</td>
  </tr>
<tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Mathematics</td>
  </tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Music</td>
  </tr>
</table>
			<table width="55%" border="0" cellspacing="0" cellpadding="0" style="float:right;">
  <tr>
    <td width="20" height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Novels / Biographies</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Phonics</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Reading/Book Report Books</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Science</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Social Etiquette</td>
  </tr>
 <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Spelling/Poetry</td>
  </tr>
<tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Video Manuals</td>
  </tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Writing/Penmanship</td>
  </tr>
</table>
            </div>
            <br class="clear"/>
            </div>
            <div class="grade-subjectsec">
            <div class="left-grade">
            <h3>Yr / Grade</h3>
            <table width="89%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20" height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Seventh Grade</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Eighth Grade</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Ninth Grade</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Tenth Grade</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Eleventh Grade</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Twelfth Grade</td>
  </tr>
</table>
            </div>
            <div class="right-subject">
            <h3>Subjects</h3>
            <table width="42%" border="0" cellspacing="0" cellpadding="0" style="float:left; margin-left:10px;">
  <tr>
    <td width="20" height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Art</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Foreign Language</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Health</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">History</td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Language / English</td>
  </tr>
 <tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Literature</td>
  </tr>
<tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Mathematics</td>
  </tr>
    <td height="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td height="30" align="left" valign="top">Music</td>
  </tr>
</table>
			
            </div>
            <br class="clear"/>
            </div>
            
            <div class="four-oldsec">
            <h2>Four-YEar-Old</h2>
            <div class="four-oldsec-tab">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><img src="<?php echo base_url(); ?>images/four-yearold-thum.png" border="0" alt=""  /></td>
    <td align="left" valign="top" class="middle-tab">
    <h3>Readiness Skills K4</h3>
    <p>Code 138592<br>
Edition Second<br>
Dimensions 8.5" X 11"</p>
</td>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle">Qty</td>
    <td align="right" valign="middle" style="text-align:right;">
    <select name="" class="qty">
    <option>1</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="middle" style="text-align:right;">$12.05</td>
    </tr>
  <tr>
    <td colspan="2" align="right" valign="middle" style="text-align:right;"><a href="#" class="addtocart-blue-btn">Add to Cart</a></td>
    </tr>
</table>

    </td>
  </tr>
</table>
            </div>
            <div class="four-oldsec-tab">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><img src="<?php echo base_url(); ?>images/four-yearold-thum.png" border="0" alt=""  /></td>
    <td align="left" valign="top" class="middle-tab">
    <h3>Readiness Skills K4</h3>
    <p>Code 138592<br>
Edition Second<br>
Dimensions 8.5" X 11"</p>
</td>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle">Qty</td>
    <td align="right" valign="middle" style="text-align:right;">
    <select name="" class="qty">
    <option>1</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="middle" style="text-align:right;">$12.05</td>
    </tr>
  <tr>
    <td colspan="2" align="right" valign="middle" style="text-align:right;"><a href="#" class="addtocart-blue-btn">Add to Cart</a></td>
    </tr>
</table>

    </td>
  </tr>
</table>
            </div>
            <div class="four-oldsec-tab">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><img src="<?php echo base_url(); ?>images/four-yearold-thum.png" border="0" alt=""  /></td>
    <td align="left" valign="top" class="middle-tab">
    <h3>Readiness Skills K4</h3>
    <p>Code 138592<br>
Edition Second<br>
Dimensions 8.5" X 11"</p>
</td>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle">Qty</td>
    <td align="right" valign="middle" style="text-align:right;">
    <select name="" class="qty">
    <option>1</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="middle" style="text-align:right;">$12.05</td>
    </tr>
  <tr>
    <td colspan="2" align="right" valign="middle" style="text-align:right;"><a href="#" class="addtocart-blue-btn">Add to Cart</a></td>
    </tr>
</table>

    </td>
  </tr>
</table>
            </div>
            <div class="four-oldsec-tab">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><img src="<?php echo base_url(); ?>images/four-yearold-thum.png" border="0" alt=""  /></td>
    <td align="left" valign="top" class="middle-tab">
    <h3>Readiness Skills K4</h3>
    <p>Code 138592<br>
Edition Second<br>
Dimensions 8.5" X 11"</p>
</td>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle">Qty</td>
    <td align="right" valign="middle" style="text-align:right;">
    <select name="" class="qty">
    <option>1</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="right" valign="middle" style="text-align:right;">$12.05</td>
    </tr>
  <tr>
    <td colspan="2" align="right" valign="middle" style="text-align:right;"><a href="#" class="addtocart-blue-btn">Add to Cart</a></td>
    </tr>
</table>

    </td>
  </tr>
</table>
            </div>
            <ul class="pagination">
<li><a href="#">Prev</a></li>
<li><a href="#" class="active">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">Next</a></li>
</ul>
            </div>
            
          </div>
          <!--step2 open-->
          <div class="tab_content tab-2" id="tab2" style="display: none;">
          
           <div class="yvideo extra-pad">sdsdsd</div>
           
          </div>
          <!-- step2 close-->
          
          <div class="tab_content tab-3" id="tab3" style="display: none;">
             <div class="yvideo extra-pad">sdsdsd</div>
          </div>
          <!--step4 open-->
          <div class="tab_content tab-4" id="tab4" style="display: none;">
             <div class="yvideo extra-pad">sdsdsd</div>
             
          </div>
          <!--step4 stop--> 
        </div>
      </div>
    </div>
   </div>
    <!--lefts_side end-->
 <!-- right side tab start--> 
  <?php $this->load->view("right_panel", "", $result); ?>
  
  <!-- rights side end -->
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


