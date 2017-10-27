<div class="rights_side<?php if($levelName==2){ echo " fulr"; } ?>">
    <!--<div style="margin: 20px 0 0 16px !important;"><a href="#"><img src="<?php echo base_url(); ?>images/ref-link.png" /></a></div>--> 
  <!--<div class="nitify-menu">
<ul>
<li><a href="#"><i class="fa fa-laptop"></i><span class="notify-ribon">15</span></a></li>
<li><a href="#"><i class="fa fa-heart"></i><span class="notify-ribon">7</span></a></li>
<li><a href="#"><i class="fa fa-globe"></i><span class="notify-ribon">2</span></a></li>
<li><a href="javascript:void(0);" id="getNames" class="watch-video-tut"><i class="fa fa-dashboard"></i><span class="notify-ribon"><?php echo $result['getCounterJoins']; ?></span></a></li>
</ul>
</div>-->
  <div class="sm extra-no-pad">
    <ul class="social_media extra-width" style="margin-top:36px;">
      <li class="sm001"> 
        <a href="javascript:void(0)" id="serviceList_1" onclick="funToggleSupport(this.id)">Customer Support / Help
        </a>
        <div id="slist_1" class="list_service">
          <form method="post" action="<?php echo base_url();?>dashboard/services/customer/<?php echo $ct_pageId;?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td>
                    <label for="textfield">Email Id:
                    </label>
                  </td>
                  <td>
                    <input type="text" id="customerServiceEmail" class="custEmailClass" name="email">
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="textarea">Message:
                    </label>
                  </td>
                  <td>
                    <textarea rows="5" cols="31" id="customerServiceMsg" class="custMessageClass" name="message">
                    </textarea>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;
                  </td>
                  <td>
                    <input type="submit" value="Submit" id="customerServiceSubmit" name="customerServiceSubmit" onclick="return checkEmailMessage('customerServiceEmail','customerServiceMsg')">
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </li>
      <li class="sm003"> 
        <!--<a id="serviceList_3" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Buy Advertising </a>-->
        <a id="serviceList_3" href="https://www.communitytreasures.co/ctdemo/dashboard/category_detail/622" target="_blank">Buy Advertising        </a>
        <div id="slist_3" class="list_service">
          <form method="post" action="<?php echo base_url();?>dashboard/services/advertise">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td>
                    <label for="textfield">Email Id:
                    </label>
                  </td>
                  <td>
                    <input type="text" id="advertisingEmail" class="custEmailClass" name="email">
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="textarea">Message:
                    </label>
                  </td>
                  <td>
                    <textarea rows="5" cols="31" id="advertisingMsg" class="custMessageClass" name="message">
                    </textarea>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;
                  </td>
                  <td>
                    <input type="submit" value="Submit" id="advertisingSubmit" name="advertisingSubmit" onclick="return checkEmailMessage('advertisingEmail','advertisingMsg')">
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </li>
      <!--<li class="sm002"> 
        <a href="http://ctmembers.com/" target="_blank">Back To Inviting Area
        </a>
        <div id="slist_2" class="list_service">
          <form method="post" action="<?php echo base_url();?>dashboard/services/tech_support">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td>
                    <label for="textfield">Email Id:
                    </label>
                  </td>
                  <td>
                    <input type="text" id="techSupportEmail" class="custEmailClass" name="email">
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="textarea">Message:
                    </label>
                  </td>
                  <td>
                    <textarea rows="5" cols="31" id="techSupportMsg" class="custMessageClass" name="message">
                    </textarea>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;
                  </td>
                  <td>
                    <input type="submit" value="Submit" id="techSupportSubmit" name="techSupportSubmit" onclick="return checkEmailMessage('techSupportEmail','techSupportMsg')">
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </li>-->
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
  
    <?php 
/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/
if(($this->session->userdata('emailId')=="otizfangel@gmail.com") || ($this->session->userdata('emailId')=="nichole_monteiro@yahoo.co.uk") ){ ?>
    
	<p class="activeuser" style="margin-left:16px;"><a href="<?php echo base_url(); ?>allUserList/sponsorList" target="blank">Upgrade yourself in BB account</a></p>
	<br/>
    
    <?php } ?>
  <p class="activeuser" style="margin-left:16px; margin-bottom:20px;"><a href="#" target="_blank">Association Tool-Kit</a></p>
 <p class="activeuser" style="margin-left:16px;"><a href="<?php echo base_url(); ?>dashboard/CT_catalog/" target="_blank">
 My CTTreasureChests.com</a></p>
  <br/>
  <!-- new added 11/09/2015 ujjwal sana-->
  <div class="webbox1" style="display: none;">
    <div class="upl_form web">
      <span>Add Listings On CT Catalogue
      </span>
      <form id="prd_upld" action="<?php echo base_url();?>dashboard/freeListing/" method="post" enctype="multipart/form-data">
        <p>
          <label>Name
          </label>
          <input type="text" name="listingName" id="listingName">
        </p>
        <p>
          <label>Address
          </label>
          <textarea name="listingAddr" id="listingAddr">
          </textarea>
        </p>
        <p>
          <label>Number
          </label>
          <input type="text" name="listingNo" id="listingNo">
        </p>
        <p>
          <label>Email
          </label>
          <input type="text" name="listingEmail" id="listingEmail">
        </p>
        <p>
          <label>Country
          </label>
          <select id="listingCountry" name="listingCountry">
            <option value="">Select Country 
            </option>
            <?php if(count($countryList) > 0){ 
foreach($countryList as $cl){
?>
            <option value="<?php echo $cl->country_id;?>" >
              <?php echo $cl->name;?>
            </option>
            <?php }}?>
          </select>
        </p>
        <p>
          <label>State
          </label>
          <input type="text" name="listingState" id="listingState">
        </p>
        <p>
          <label>City
          </label>
          <select id="listingCity" name="listingCity">
            <option value="">Select City 
            </option>
            <?php if(count($cityList) > 0){ 
foreach($cityList as $cl){
?>
            <option value="<?php echo $cl->id;?>" >
              <?php echo $cl->city;?>
            </option>
            <?php }}?>
          </select>
        </p>
        <p>
          <label>Description
          </label>
          <textarea name="listingDesc" id="listingDesc">
          </textarea>
        </p>
        <p>
          <label>Website
          </label>
          <input type="text" name="listingWebsite" id="listingWebsite">
        </p>
        <p>
          <label>Youtube Url
          </label>
          <input type="text" name="listingUrl" id="listingUrl" placeholder="Paste the embedded Link">
        </p>
        <p>
          <label>Image
          </label>
          <input type="file" name="listingImg" id="listingImg" value="Choose file">
        </p>
        <p>
          <label>Category 
          </label>
          <select id="categoryList" name="categoryList">
            <option value="">Select Category 
            </option>
            <?php if(count($categoryList) > 0){ 
foreach($categoryList as $catL){
//echo '++'.$catL->menuID."==".$catL->menuName;
?>
            <option value="<?php echo $catL['menuID'];?>" >
              <?php echo $catL['menuName'];?>
            </option>
            <?php }}?>
          </select>
        </p>
        <p>
          <label>Category 
          </label>
          <select id="articleList" name="articleList">
          </select>
        </p>
        <p>
          <label>2nd Sub Category 
          </label>
          <select id="subArticleList" name="subArticleList">
          </select>
        </p>
        <p>
          <input type="submit" name="freeListing" id="freeListingId" value="Save">
        </p>
      </form>
    </div>
  </div>
  
  <?php
//$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
//$viewArray = array("TEACHER","ADMIN","STUDENT");// Moumita(20-05-16)
$viewArray = array("ADMIN");// Moumita(20-05-16)
if(in_array($this->session->userdata('userType'), $viewArray)){
unset($viewArray);
?>
  <div class="webbox" style="display:none;">
    <!-- added for design SB --> 
    <!--<p class="web"> <span>My Sign Up of Founder Member Page :</span><a target="_blank" href="<?php echo base_url()."signup_founders/".$userInfo[0]["userName"];?>" ><?php echo base_url()."signup_founders/".$userInfo[0]["userName"];?></a> </p>-->
    <!-- signup is blocked by SB on 05/07/2016 -->
    <p class="web"> 
      <span>My Sign Up of Founder Member Page :
      </span> 
    </p>
    <!-- added by SB on 05/07/2016 -to start signup unblock the above code and block this line of code--> 
  </div>
  <?php }?>
  <?php 
$viewArray = array("ADMIN");
if(in_array($this->session->userdata('userType'), $viewArray)){
unset($viewArray);
?>
  <div class="webbox"> 
    <!--<p class="web"> <span>My Sign Up of Industry Leader Page :</span> <a target="_blank" href="<?php echo base_url()."signup_industryleader/".$userInfo[0]["userName"];?>" ><?php echo base_url()."signup_industryleader/".$userInfo[0]["userName"];?></a> </p>-->
    <!-- signup is blocked by SB on 05/07/2016 -->
    <p class="web"> 
      <span>My Sign Up of Industry Leader Page :
      </span> 
    </p>
    <!-- added by SB on 05/07/2016 -to start signup unblock the above code and block this line of code--> 
  </div>
  <!-- added for design SB-->
  <?php }?>
  <?php 
$viewArray = array("ADMIN");
if(in_array($this->session->userdata('userType'), $viewArray)){
unset($viewArray);
?>
  <div class="webbox"> 
    <!--<p class="web"> <span>My Sign Up of Head Volunteers Page :</span> <a target="_blank"><?php echo base_url()."signup_head_volunteers/".$userInfo[0]["userName"];?></a> </p>-->
    <p class="web"> 
      <span>My Sign Up of Head Volunteers Page :
      </span> 
    </p>
    <!-- added by SB on 05/07/2016 -to start signup unblock the above code and block this line of code--> 
  </div>
  <!-- added for design SB-->
  <?php }?>
  <?php
$viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","STUDENT","VOLUNTEERS","PAYING USER");
//  if(in_array($this->session->userdata('userType'), $viewArray) && $userInfo[0]["afrooPaymentStatus"]=="1"){
if(in_array($this->session->userdata('userType'), $viewArray)){
unset($viewArray);
?>
  <div class="webbox" style="display:none;">
    <!-- added for design SB --> 
    <!--<p class="web"> <span>My Sign Up of Volunteers Page :</span> <a target="_blank"><?php echo base_url()."signup_volunteers/".$userInfo[0]["userName"];?></a> </p>-->
    <p class="web"> 
      <span>My Sign Up of Volunteers Page :
      </span> 
    </p>
    <!-- added by SB on 05/07/2016 -to start signup unblock the above code and block this line of code--> 
  </div>
  <?php }?>
   <?php if($levelName==1 || $levelName==2) { 
//$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
if(in_array($this->session->userdata('userType'), $viewArray)){
unset($viewArray);
?>
  <div class="blue-box">
    <p class="ana">Catalogue Commission 
    </p>
    <ul>
      <?php if(count($catalogueCommisson) > 0): foreach($catalogueCommisson as $ccv):?>
      <li>
        <?php echo $ccv->cuFName . ' ' . $ccv->cuLName ;?> :
        <span> 
          <?php echo $ccv->pc .''. round($ccv->parent_commossion,2);?>
        </span>
      </li>
      <?php endforeach; else:?>
      <li>
        <span> Sorry! No Data please..
        </span>
      </li>
      <?php endif;?>
    </ul>
  </div>
  <?php } 
} 
?>
  <?php if($levelName==1){ ?>
  <div class="ash"> 
    <!-- 	<?php if ( !empty($result['userSocialDetails'][0]['photo'] ) ){ ?>
<img src="<?php echo base_url(); ?>/upload/profile/<?php echo $result['userSocialDetails'][0]['photo'];?>" />
<?php }else{ ?>
<img src="<?php echo base_url(); ?>/upload/profile/add_pic.png" />
<?php } ?>--> 
    <!--31/08/2015 done by sana -->
    <div class="">
      <?php foreach($list as $pic){ ?>
      <?php if ($pic->profile == ""){?>
      <img id="empPic" style="margin-right:25px;" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg"  width="70" height="70" alt="">
      <?php }else{?>
      <img id="empPic" style="margin-right:25px;" src="<?php echo $this->config->item('gbe_base_url');?>useruploads/<?php echo $pic->profile;?>"  width="70" height="70" alt="">
      <?php } ?>
      <?php } ?>
    </div>
    <span class="ash_postion">You are introduced to Community Treasures by
    </span> 
    <span class="ash_title">
      <?php echo $userInfo[0]["firstName"];?> 
      <?php echo $userInfo[0]["lastName"];?>
    </span> 
    <span class="ash_mail phn"> 
      <?php echo $userInfo[0]["phone"];?>
    </span> 
    <span class="ash_mail">
      <a href="mailto:<?php echo $userInfo[0]["emailID"];?>"> 
        <?php echo $userInfo[0]["emailID"];?>
      </a>
    </span> 
    <!--       <span class="ash_title"><?php echo $result['userSocialDetails'][0]['name'];?></span>
<span class="ash_tel"><?php echo $result['userSocialDetails'][0]['cellno'];?></span>
<span class="ash_mail"><a href="mailto:<?php echo $result['userSocialDetails'][0]['social_email'];?>"> <?php echo $result['userSocialDetails'][0]['social_email'];?></a></span> -->
    <div class="ash_social"> 
      <a href="<?php echo $result['userSocialDetails'][0]['facebook'];?>" target="_blank">
        <img src="<?php echo base_url(); ?>images/ash-fb.png" />
      </a> 
      <a href="skype:<?php echo $result['userSocialDetails'][0]['skypeid'];?>?call" target="_blank">
        <img src="<?php echo base_url(); ?>images/skype_square_color-32.jpg" />
      </a> 
      <a href="<?php echo $result['userSocialDetails'][0]['social_youtube'];?>" target="_blank">
        <img src="<?php echo base_url(); ?>images/youtube.jpg" />
      </a> 
      <a href="<?php echo $result['userSocialDetails'][0]['social_twitter'];?>" target="_blank">
        <img src="<?php echo base_url(); ?>images/ash-tw.png" />
      </a> 
      <a href="<?php echo $result['userSocialDetails'][0]['social_rave_blog'];?>" target="_blank">
        <img src="<?php echo base_url(); ?>images/ash-wp.png" />
      </a> 
    </div>
  </div>
  <?php } ?>
  <br class="clear" />
  <!--  13/10/2015 commected by ujjwal sana
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
</div>--> 
  <!--12/10/2015 ujjwal sana added start-->
  <?php
$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
//$viewArray = array("VOLUNTEERS","PAYING USER","ADMIN");'business','community','health','mentorship','talented','general','afrowebb'
if(in_array($this->session->userdata('userType'), $viewArray)){
unset($viewArray);
?>
  <div id="OverView" class="blue-box webbox" style="display:none;">
    <p class="ana">OverView of Level 
      <?php echo $levelName; ?>
    </p>
    <div style="max-height:768px; <?php if(count($overView) > 20):?> overflow-y: scroll;<?php endif;?>">
      <ul>
        <li class="mbrs">
          <strong>Members Counter:
            <span>People introduced by me
            </span>
          </strong> 
          <strong>
            <?php echo count($overView);?>
          </strong>
          <br class="clear">
        </li>
        <?php 
if(count($overView) > 0):
foreach($overView as $ls):
?>
        <li> 
          <strong>
            <?php echo $ls->firstName;?>
          </strong> 
          <strong>
            <?php echo $ls->lastName;?> :
          </strong> 
          <strong>
            <?php echo $ls->totalMember;?>
          </strong> 
        </li>
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
    <h2>Free Gifts & Discounts 
    </h2>
    <div class="cont">
      <?php foreach( $result["getOffersDetails"] as $key=>$val){ ?>
      <div class="postcont">
        <h3>
          <?php echo $result["getOffersDetails"][$key]["dealoffer"];?>
        </h3>
        <div class="imgcoll">
          <img src="<?php echo BASE_PATH_RAVE.'/'.UPLOAD_PATH.'deal/tmb'.$result['getOffersDetails'][$key]['dealofferfile_image']; ?>">
        </div>
        <a href="<?php echo BASE_PATH_RAVE.'/'.UPLOAD_PATH.'deal/'.$result['getOffersDetails'][$key]['dealofferfile']; ?>" class="colle">Collect
        </a> 
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
</div>
