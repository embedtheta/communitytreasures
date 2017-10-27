
<div class="nav"> 
  
  <!-- navigation start -->
  
  <nav class="secondary">
     <ul class="misc_new">
          <?php if($accessPermission==2){?> 
          <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] >= 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Q 1 - <i>Open</i></span> CT Catalogue</a></li>
          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] >= 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Q 2 - <i>Open</i></span> LifeStyle</a> </li>
          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] >= 2){ echo base_url()."diversity";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Q 3 - <i>Open</i></span> Knowledge</a></li>
          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] >= 3){ echo 'javascript:void(0)';}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Q 4 - <i>Open</i></span> Co-operative </a></li>
          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] >= 4){ echo 'javascript:void(0)';}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Q 5 - <i>Open</i></span>Summit</a></li>
           <?php 
		  }
		  else{ 
		  
		  ?>
          <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Q 1 - <i>Open</i></span> CT Catalogue</a></li>

          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] >= 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Q 2 - <i>Open</i></span> LifeStyle</a> </li>

          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] > 2){ echo base_url()."diversity";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Q 3 - <i>Open</i></span> Knowledge</a></li>

          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo 'javascript:void(0)';}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Q 4 - <i>Open</i></span> Co-operative </a></li>

          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5"><a href="<?php if($userInfo[0]['userLevel'] > 4){ 'javascript:void(0)';}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Q 5 - <i>Open</i></span>Summit</a></li>

          <?php }?>

        </ul>
  </nav>
  
  <!-- <p class="web_add">

            <span>My Website:</span>

                <a href="<?php echo BASE_PATH_RAVE.'/'.$_SESSION['UserID'];?>" target="_blank"> 

                	<?php echo BASE_PATH_RAVE.'/'.$_SESSION['UserID'];?>

                </a>

            </p>

            <p class="web_add1">

           <span> My Sales Page:</span>

                <a href="<?php echo BASE_PATH_RAVE.'/member/fullBusiness';?>" target="_blank"> 

                	<?php echo BASE_PATH_RAVE.'/member/fullBusiness';?>

                </a>

            </p>--> 
  
  <!-- navigation end -->
  
  <div class="clear"></div>
</div>
<div class="adsimg">
<div class="pnkbar">
<div class="pnktxt">Ads Watched Today:  1  /   10</div>
<div class="pnkdrop">
<div class="select-boxhide">
<!--<span></span>-->
<select name="h">
 <option value="">Select Category</option>
<option value="">ADVERTISING - Ad Packs</option>
<option value="">AIR PURIFICATION</option>
<option value="">ANIMAL CARE</option>
<option value="">ART, CRAFTS & INSTALLATIONS</option>
<option value="">BEAUTY & COSMETICS</option>
<option value="">BUSINESS SERVICES</option>
<option value="">CARNIVALS</option>
<option value="">CELEBRATIONS OF LIFE</option>
<option value="">CHARITIES & FUNDRAISERS</option>
<option value="">CHILDREN'S SECTION</option>
<option value="">COMMUNITY SAFETY</option>
<option value="">COMMUNITY SERVICES</option>
<option value="">CONSTRUCTION & BUILDERS</option>
<option value="">CORPORATIONS & CO-OPERATIVES</option>
<option value="">CRYPTO CURRENCIES - Coins</option>
<option value="">DANCE</option>
<option value="">DATING</option>
<option value="">DESIGN, GRAPHICS, PRINTING</option>
<option value="">DISABILITY CARE & SERVICES</option>
<option value="">DJs</option>
<option value="">EDUCATION</option>
<option value="">ENERGY</option>
<option value="">ENERGY REJUVENATION</option>
<option value="">ENVIRONMENTALS</option>
<option value="">FASHION</option>
<option value="">FESTIVALS</option>
<option value="">FILM & VIDEO</option>
<option value="">FINANCIAL SERVICES</option>
<option value="">FOOD & BEVERAGE</option>
<option value="">GAMING</option>
<option value="">GARDEN</option>
<option value="">HAIRDRESSING & PRODUCTS</option>
<option value="">HEALTH & FITNESS</option>
<option value="">HOME MAINTENANCE SERVICES</option>
<option value="">HOMELESS SERVICES & HELP</option>
<option value="">LGBT</option>
<option value="">LIFE COACHES & SELF AWARENESS</option>
<option value="">MAGAZINE & BOOKS</option>
<option value="">MEET UPS & FACEBOOK GROUPS</option>
<option value="">MENTAL CARE & SERVICES</option>
<option value="">MODELING</option>
<option value="">MOTORS - Eco Cars & Bikes</option>
<option value="">MUSIC & MUSICIANS</option>
<option value="">NIGHTLIFE - Clubs & Parties</option>
<option value="">NUTRITION & SUPPLIMENTS</option>
<option value="">OFFICE</option>
<option value="">PAINTERS & DECORATORS</option>
<option value="">PARENTING SUPPORT</option>
<option value="">PERFORMERS</option>
<option value="">PHONES & ACCESSORIES</option>
<option value="">PR & MARKETING</option>
<option value="">PRECIOUS COMMODITIES</option>
<option value="">RADIO STATIONS</option>
<option value="">REAL ESTATE & PROPERTY</option>
<option value="">REHABILITATION & DETOX</option>
<option value="">RELATIONSHIP GUIDANCE</option>
<option value="">SALES & MARKETING TEAMS</option>
<option value="">SKYPE CLUB</option>
<option value="">SPORTS</option>
<option value="">STUDENTS AREA</option>
<option value="">TECHNOLOGY</option>
<option value="">TRANSPORT</option>
<option value="">VACATION - HOLIDAYS</option>
<option value="">VIRTUAL ASSISTANTS</option>
<option value="">VOLUNTEER & TIME BANKING</option>
<option value="">WATER PURIFICATION</option>
<option value="">WEBSITES</option>
<option value="">WELLNESS</option>
<option value="">WIFI & ELECTRONICS</option>
<option value="">YOUTUBE CHANNELS & VLOGS</option>

</select>
</div>
</div>
<div class="watch-backbutton">
<a class="crosclose" href="<?php echo base_url()."ads";?>">
<!--<img src="<?php// echo base_url(); ?>images/buttonAds.png" alt="" >-->
<span>Watch ads</span>
</a>
</div>
<div class="pnkhrs"><span>1</span><span>0</span></div>
<div class="Tasktabbb"><a href="<?php echo base_url()."task";?>">Tasks</a></div>
</div>
</div>
</div>
