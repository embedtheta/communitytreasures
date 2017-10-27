

    <div class="rights_side">
      <div class="nitify-menu">
        <ul>
          <li><a href="#"><i class="fa fa-laptop"></i><span class="notify-ribon"><?php echo $levelWiseCounter[0]->level_1;?></span></a></li>
          <li><a href="#"><i class="fa fa-heart"></i><span class="notify-ribon"><?php echo $levelWiseCounter[0]->level_2;?></span></a></li>
          <li><a href="#"><i class="fa fa-globe"></i><span class="notify-ribon"><?php echo $levelWiseCounter[0]->level_3;?></span></a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i><span class="notify-ribon"><?php echo $levelWiseCounter[0]->level_4;?></span></a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i><span class="notify-ribon"><?php echo $levelWiseCounter[0]->level_5;?></span></a></li>
        </ul>
      </div>
      <div class="sm extra-no-pad">
        <ul class="social_media extra-width">
          <li class="sm001"> <a id="serviceList_1" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Customer Service</a>
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
              <form method="post" action="<?php echo base_url();?>dashboard/services/tech">
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
          <!--          <li class="sm007"> <a id="serviceList_4" href="javascript:void(0)">Listen to GBE Radio</a> </li>-->
          <li class="sm003"> <a id="serviceList_5" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Total Member Under GBE Business</a>
            <div id="slist_5" class="list_service">
              <p class="total-number"><?php echo $totalMembers;?></p>
            </div>
          </li
        >
        </ul>
      </div>
        <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
        ?>
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
        <?php } ?>
        
        
      	<div class="webbox">
        <p class="web">  <a  href="<?php echo base_url();?>currentaccount/myAccount"><span> MY WALLET </span></a></p>
        </div>
        
        
        <?php if( ($massUserDetails[0]->puUserType == 'ADMIN' && $massUserDetails[0]->id != '') || $userInfo[0]['userType'] == 'ADMIN' ): ?>
        <div class="webbox">
        <p class="web">  <a  href="<?php echo base_url();?>message"><span> MY MASS SIGNUP SYSTEM </span></a></p>
        </div>
        <?php endif;?>
        
        
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
      <?php
            //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            $viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray)){
                unset($viewArray);
        ?>
		
      <div class="blue-box">
        <p class="ana">ANALYTICS</p>
        <ul>
          <li>Switched On Members :<span> <?php echo $SwitchOnMembers;?></span></li>
          <li>My Sign Ups : <span><?php echo $mySignUps;?></span></li>
          <li> Visitors to my website : <span>6</span></li>
          <li>My Ticket Sales : <span>0</span></li>
          <li>My Music Sales : <span>0</span></li>
          <li>My E-book Sales :<span> 0</span></li>
        </ul>
      </div>
        
      <div class="ash">
          <?php if($parentInfo[0]["profile"] != ""){?>
          <img width="80" height="80" alt="" src="<?php echo base_url(); ?>useruploads/<?php echo $parentInfo[0]["profile"]; ?>">
          <?php }?>
          <span class="ash_postion">You are introduced to GBE by</span> 
          <span class="ash_title"><?php echo $parentInfo[0]["firstName"];?> <?php echo $parentInfo[0]["lastName"];?></span> 
          <span class="ash_tel"><?php echo $parentInfo[0]["phone"];?></span> 
          <span class="ash_tel"><a href="mailto:<?php echo $parentInfo[0]["emailID"];?>"><?php echo $parentInfo[0]["emailID"];?></a></span><br>
        
          <div class="ash_social"> 
            <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/ash-fb.png"></a> <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/skype_square_color-32.jpg"></a> <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/youtube.jpg"></a> <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/ash-tw.png"></a> <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/ash-wp.png"></a> </div>
            </div>
      <?php } ?>
       <?php
            $viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            //$viewArray = array("VOLUNTEERS","PAYING USER","ADMIN");
            if(in_array($this->session->userdata('userType'), $viewArray)){
                unset($viewArray);
        ?>
      <div class="blue-box webbox" style="margin:40px 0 0 0px;">
        <p class="ana">OverView of Level 1</p>
        <ul>
          <li>Members in Level 1 Under This Referral: <?php echo count($overView);?></li>
          <?php 
		  if(count($overView) > 0):
		  	foreach($overView as $ls):
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
      <?php } ?>
      
    </div>
   
  
