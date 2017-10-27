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
 })
</script>
<script type="text/javascript" src="jquery.fancybox.js?v=2.1.4"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
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
          <!--<ul class="tabs">
            <li><a href="#tab1" class="tabClass current" name="tab1">Step1</a></li>
            <li><a href="#tab2" class="tabClass " name="tab2">step2</a></li>
            <li><a href="#tab3" class="tabClass " name="tab3">step3</a></li>
            <li><a href="#tab4" class="tabClass " name="tab4">step4</a></li>
          </ul>-->
          <div class="tab_container main_cntnr">
            <div id="tab1" class="tab_content">
              <div class="lable_tre">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <div class="palvidd" style="width:556px; height:438px;"> <img src="<?php  echo $this->config->item('gbe_base_url'); ?>images/hqdefault.jpg" width="573" height="320" /> </div>
                  <div class="leb_3_com"><h1>Enter Community Treasures</h1>
                  <img src="<?php echo base_url(); ?>images/grp_img.png" alt="" >
                  <!--<img src="<?php echo base_url(); ?>images/grp_img.png" alt="" >-->
                  <a href="#">Launch</a>
                  </div>
					</div>
					<!--end white-space-->
					</div>
                <div class="lable_tre">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <div class="palvidd" style="width:556px; height:438px;"> <img src="<?php  echo $this->config->item('gbe_base_url'); ?>images/hqdefault.jpg" width="573" height="320" /> </div>
                  <div class="leb_3_com"><h1>Enter Rave Business</h1>
                  <img src="<?php echo base_url(); ?>images/grp_img.png" alt="" >
                 <!-- <img src="<?php echo base_url(); ?>images/comunity_trs.png" alt="" >-->
                  <a href="#">Launch</a>
                  </div>
					</div>               
                
                <!--end white-space-->               

                
              </div>
            </div>
            
            <!--1tab end......... --> 
          
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
                    <td><input type="submit" value="Submit" id="customerServiceSubmit" name="customerServiceSubmit" onclick="return checkEmailMessage('customerServiceEmail','customerServiceMsg')"></td>
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
                    <td><input type="text" id="techSupportEmail" class="custEmailClass" name="email"></td>
                  </tr>
                  <tr>
                    <td><label for="textarea">message:</label></td>
                    <td><textarea rows="5" cols="31" id="techSupportMsg" class="custMessageClass" name="message"></textarea></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Submit" id="techSupportSubmit" name="techSupportSubmit" onclick="return checkEmailMessage('techSupportEmail','techSupportMsg')"></td>
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
                    <td><input type="submit" value="Submit" id="advertisingSubmit" name="advertisingSubmit" onclick="return checkEmailMessage('advertisingEmail','advertisingMsg')"></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </li>
        <!--<li class="sm007"> <a href="javascript:void(0)" id="serviceList_4" >Listen to Rave Story Radio</a> 
          
          <!--<div class="list_service" id="slist_4">

                    <form action="" method="get">

                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    	  <tr>

                    	    <td><label for="textfield">email:</label></td>

                    	    <td><input type="text" name="textfield" id="textfield" /></td>

                  	    </tr>

                    	  <tr>

                    	    <td><label for="textarea">message:</label></td>

                    	    <td><textarea name="textarea" id="textarea" cols="45" rows="5"></textarea></td>

                  	    </tr>

                    	  <tr>

                    	    <td>&nbsp;</td>

                    	    <td><input type="submit" name="button2" id="button2" value="Submit" /></td>

                  	    </tr>

                  	  </table>

                    </form>

                  </div> 
          
        </li>-->
      <!--  <?php if($_SESSION['UID'] == 1000){?>
        <li class="sm003"> <a href="javascript:void(0)" id="serviceList_5" onclick="funToggleSupport(this.id)">Total Member Under RaveBusiness</a>
          <div class="list_service" id="slist_5" <?php  if(isset($_REQUEST["action"]) && ($_REQUEST["action"] == "Advertising") ){ echo "style=\"display:block\"";}?>>
            <p class="total-number"><?php echo $result['getTotalMember'];?></p>
          </div>
        </li>
        <?php } ?>-->
      </ul>
    </div>
      <!--9/9/2015 close by ujjwal sana-->
  <!--  <div class=" webbox"> 
      
      <!--<p class="web">

            <span>People introduced to Level 2:</span>

            <span><?php echo $result["getNumberOfCount"];?></span>

            </p>

            <p class="web">

            <span>People introduced His Referral:</span>

            <span><?php echo $result["getNumberOfCountById"];?></span>

            </p>-->
    
     <!-- <p class="web"> <span>My Sign Up Page:</span> <a href="http://www.//192.168.2.117/ravebusiness/<?php if($_SESSION['UID']!= 1000) echo "?uid=".$_SESSION['UID'];?>" target="_blank"> http://www.ravebusiness.com/
        <?php if($_SESSION['UID']!= 1000) echo "?uid=".$_SESSION['UID'];?>
        </a> </p>-->
  <!--    <?php if( $result["tenDollarPaymentStatus"] == "1" ){ ?>
      <p class="web"> <span>My Rave Story Products website :</span> <a href="http://www.ravestory.com/<?php echo $_SESSION['UserID'];?>" target="_blank">http://www.ravestory.com/<?php echo $_SESSION['UserID'];?></a> </p>
      <?php }?>
      <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 10 || ($_SESSION['UID'] == 1000)) {?>
      <p class="web"> <span>My Rave Blog:</span> <a href="http://www.raveblogger.com/<?php echo "?author=".$_SESSION['UID'];?>" target="_blank"> http://www.raveblogger.com/<?php echo "?author=".$_SESSION['UID'];?> </a> </p>
      <?php }?>
      <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 50 || ($_SESSION['UID'] == 1000)) {?>
      <p class="web"> <span>My Ravers Direct Profile:</span> <a href="http://www.raversdirect.com/raversdirect/ravetalent/<?php echo "?UID=".$_SESSION['UID'];?>" target="_blank"> http://www.raversdirect.com/raversdirect/ravetalent/<?php echo "?UID=".$_SESSION['UID'];?> </a> </p>
      <?php }?>
      <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 100 || ($_SESSION['UID'] == 1000)) {?>
      <p class="web"> <span>My Society Page:</span> <a href="<?php echo base_url();?>/ravestorysociety/showSociety/?sid=<?php echo $result['SOCIETYDETAILS']['id'];?>" target="_blank"> <?php echo base_url();?>/ravestorysociety/showSociety/?sid=<?php echo $result['SOCIETYDETAILS']['id'];?> </a> </p>
      <?php }?>
      <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 200 || ($_SESSION['UID'] == 1000)) {?>
      <p class="web"> <span>My Clubguide page:</span> <a href="http://www.clubguideworldwide.com/<?php echo "?uid=".$_SESSION['UID'];?>" target="_blank"> http://www.clubguideworldwide.com/<?php echo "?uid=".$_SESSION['UID'];?> </a> </p>
      <?php }?>
    </div>-->
    <!-- new added 11/09/2015 ujjwal sana-->
    <div class="webbox1" style="display: none;">
        <div class="upl_form web"><span>Free Listing on AFROWEBB</span>
            <form id="prd_upld" action="<?php echo base_url();?>dashboard/freeListing/" method="post" enctype="multipart/form-data">
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
                <?php if(count($countryList) > 0){ 
                    foreach($countryList as $cl){
                        ?>
                <option value="<?php echo $cl->country_id;?>" ><?php echo $cl->name;?></option>
                <?php }}?>
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
                <?php if(count($cityList) > 0){ 
                    foreach($cityList as $cl){
                        ?>
                <option value="<?php echo $cl->id;?>" ><?php echo $cl->city;?></option>
                <?php }}?>
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
              <input type="text" name="listingUrl" id="listingUrl" placeholder="Paste the embedded Link">
            </p>
            <p>
              <label>Image</label>
              <input type="file" name="listingImg" id="listingImg" value="Choose file">
            </p>
            <p>
              <label>Category </label>
              <select id="categoryList" name="categoryList">
                <option value="">Select Category </option>
                <?php if(count($categoryList) > 0){ 
                    foreach($categoryList as $catL){
						//echo '++'.$catL->menuID."==".$catL->menuName;
                        ?>
                <option value="<?php echo $catL['menuID'];?>" ><?php echo $catL['menuName'];?></option>
                <?php }}?>
              </select>
            </p>
			<p>
              <label>Section </label>
              <select id="articleList" name="articleList">                
              </select>
            </p>
			<p>
              <label>Sub Section </label>
              <select id="subArticleList" name="subArticleList">                
              </select>
            </p>
            <p>
                <input type="submit" name="freeListing" id="freeListingId" value="Save">
            </p>
          
          </form>
        </div>
      </div>
      <div class="webbox">
        <p class="web">  <a  href="<?php echo base_url();?>currentaccount/myAccount"><span> MY WALLET </span></a></p>
        
        </div>
        
		
	  <div class="webbox">
        <p class="web"> <span>My Sign Up Page:</span> <a target="_blank" href="<?php echo base_url()."gateway_signup/".$userInfo[0]["userName"];?>"><?php echo base_url()."gateway_signup/".$userInfo[0]["userName"];?></a> </p>
        <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
            ?>
       <!--13/10/2015 ujjwal sana commanted  <p class="web"> <span>My Afrowebb Catalogue :</span> 
		<a target="_blank" href="<?php echo $this->config->item("affro_base_url").'gbe/member/'.$userInfo[0]["userName"];?>"><?php echo $this->config->item("affro_base_url").'gbe/member/'.$userInfo[0]["userName"];?></a>
		</p>-->
        <p class="web"> <span>My Afrowebb Catalogue :</span> 
		<a target="_blank"><?php echo $this->config->item("affro_base_url").'gbe/member/'.$userInfo[0]["userName"];?></a>
		</p>
        <?php }?>
      </div>
	  <?php 
                $viewArray = array("ADMIN");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
	  <div class="webbox">
		<!--3/10/2015 ujjwal sana commanted
        <p class="web"> <span>My Sign Up of Teacher Page :</span> <a target="_blank" href="<?php echo base_url()."signup_teachers/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_teachers/".$userInfo[0]["userName"];?></a> </p>-->
        <p class="web"> <span>My Sign Up of Teacher Page :</span> <a target="_blank"><?php echo base_url()."signup_teachers/".$userInfo[0]["userName"];?></a> </p>
        <?php }?>
        <?php
                //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
                $viewArray = array("TEACHER","ADMIN","STUDENT");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
            <!--3/10/2015 ujjwal sana commanted
        <p class="web"> <span>My Sign Up of Student Page :</span> <a target="_blank" href="<?php echo base_url()."signup_student/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_student/".$userInfo[0]["userName"];?></a> </p>    -->   
        <p class="web"> <span>My Sign Up of Student Page :</span> <a target="_blank"><?php echo base_url()."signup_student/".$userInfo[0]["userName"];?></a> </p> 
      </div>
	  <?php }?>
	   <?php 
                $viewArray = array("ADMIN");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
      <div class="webbox">       
       <!--12/10/2015 ujjwal sana <p class="web"> <span>My Sign Up of Head Volunteers Page :</span> <a target="_blank" href="<?php echo base_url()."signup_head_volunteers/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_head_volunteers/".$userInfo[0]["userName"];?></a> </p>-->
       <p class="web"> <span>My Sign Up of Head Volunteers Page :</span> <a target="_blank"><?php echo base_url()."signup_head_volunteers/".$userInfo[0]["userName"];?></a> </p>
        <?php }?>
        <?php
                //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
                $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","STUDENT","VOLUNTEERS");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
       <!--12/10/2015 ujjwal sana <p class="web"> <span>My Sign Up of Volunteers Page :</span> <a target="_blank" href="<?php echo base_url()."signup_volunteers/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_volunteers/".$userInfo[0]["userName"];?></a> </p>-->
         <p class="web"> <span>My Sign Up of Volunteers Page :</span> <a target="_blank"><?php echo base_url()."signup_volunteers/".$userInfo[0]["userName"];?></a> </p>
      </div>
	  <?php }?>
      <?php
                //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
                $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","STUDENT","VOLUNTEERS");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
      <div class="webbox">
      <!--  <p class="web"> <span>My Sign Up of Business Page :</span> <a target="_blank" href="<?php echo base_url()."signup_business/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_business/".$userInfo[0]["userName"];?></a> </p>-->
        
        <!--new added 13/10/2015 ujjwal sana-->
     <!--   <p class="web"> <span>My Sign Up of Talent Page:</span> <a target="_blank"><?php echo base_url()."signup_talented/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Mentorship Page :</span> <a target="_blank"><?php echo base_url()."signup_mentorship/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Health Wellness Page:</span> <a target="_blank"><?php echo base_url()."signup_health/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Afrowebb Page:</span> <a target="_blank"><?php echo base_url()."signup_afrowebb/".$userInfo[0]["userName"];?></a> </p>-->
        <!--new added 28/10/2015 ujjwal sana-->
         <p class="web"> <span>My Sign Up of Real Estate Page :</span> <a target="_blank" href="<?php echo base_url()."signup_realestate/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_real-estate/".$userInfo[0]["userName"];?></a> </p>
   <p class="web"> <span>My Sign Up of Fitness Page :</span> <a target="_blank" href="<?php echo base_url()."signup_fitness/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_fitness/".$userInfo[0]["userName"];?></a> </p>
         
          <p class="web"> <span>My Sign Up of Food Page :</span> <a target="_blank" href="<?php echo base_url()."signup_food/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_food/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Hair and Beauty Page :</span> <a target="_blank" href="<?php echo base_url()."signup_hair_and_beauty/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_hair_and_beauty/".$userInfo[0]["userName"];?></a> </p> 
        
        <!--new commanted 13/10/2015 ujjwal sana -->
      <!--  <p class="web"> <span>My Sign Up of Talent Page:</span> <a target="_blank" href="<?php echo base_url()."signup_talented/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_talented/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Mentorship Page :</span> <a target="_blank" href="<?php echo base_url()."signup_mentorship/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_mentorship/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Health Wellness Page:</span> <a target="_blank" href="<?php echo base_url()."signup_health/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_health/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Afrowebb Page:</span> <a target="_blank" href="<?php echo base_url()."signup_afrowebb/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_afrowebb/".$userInfo[0]["userName"];?></a> </p>-->
      </div>
      <?php }?>
	  
	  
	   
	   <br class="clear" />
	
    <!--12/10/2015 ujjwal sana added start-->
    <?php
            $viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            //$viewArray = array("VOLUNTEERS","PAYING USER","ADMIN");'business','community','health','mentorship','talented','general','afrowebb'
            if(in_array($this->session->userdata('userType'), $viewArray)){
                unset($viewArray);
        ?>
        
    <div id="OverView" class="blue-box webbox">
     <p class="ana">OverView of Level 3</p>
      <div style="max-height:768px; <?php if(count($overView) > 20):?> overflow-y: scroll;<?php endif;?>">
     <ul>
          <li class="mbrs"><strong>Members Counter:<span>People introduced by me</span></strong> <strong><?php echo count($overView);?></strong><br class="clear"></li>
          <?php 
		  if(count($overView) > 0):
		  	foreach($overView as $ls):
		  ?>
          <li> <strong><?php echo $ls->firstName;?></strong> <strong><?php echo $ls->lastName;?> :</strong> <strong><?php echo $ls->totalMember;?></strong> </li>
          <?php 
		  	endforeach;
		  endif;
		  ?>
                
        </ul>
         </div>
    </div>
    <?php } ?>
     <!--12/10/2015 ujjwal sana end-->
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


