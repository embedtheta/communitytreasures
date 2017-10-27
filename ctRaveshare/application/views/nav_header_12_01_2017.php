<script>

$(document).ready(function(){ 

	

	$("#adVideoLinkId01").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#adVideoLinkId02").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#adVideoLinkId03").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	

	$("#adVideoLinkId011").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<div>You have Successfully copied this Link</div>');

	});

	

});

</script>

<div class="nav ddaass" style="height: 74px;"> 

  

  <!-- navigation start -->

  

  <nav class="secondary">

     <ul class="misc_new">

          <?php if($accessPermission==2){ ?> 

          <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] >= 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Q 1 - <i>Open</i></span> &nbsp;&nbsp;&nbsp;&nbsp;<!--Advertizer--></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] >= 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Q 2 - <i>Open</i></span>  &nbsp;&nbsp;&nbsp;&nbsp;<!--Catalogue--></a> </li>

          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] >= 2){ echo base_url()."diversity";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Q 3 - <i>Open</i></span> &nbsp;&nbsp;&nbsp;&nbsp;<!--Lifestyle--></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] >= 3){ echo 'javascript:void(0)';}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Q 4 - <i>Open</i></span> &nbsp;&nbsp;&nbsp;&nbsp;<!--Co-Operatives--> </a></li>

          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] >= 4){ echo 'javascript:void(0)';}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Q 5 - <i>Open</i></span>&nbsp;&nbsp;&nbsp;&nbsp;<!--Vacation Club--></a></li>

           <?php 

		  }

		  else{ 

		  

		  ?>

          <!--<li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard/raveShareHome";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Q 1 - <i>Open</i></span> Advertizer </a></li>-->

          <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."myaccount";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Q 1 - <i>Open</i></span> &nbsp;&nbsp;&nbsp;&nbsp;<!--Advertizer--></a></li>



          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] >=2){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Q 2 - <i>Open</i></span> &nbsp;&nbsp;&nbsp;&nbsp;<!--Catalogue--></a> </li>



          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] >=3){ echo base_url()."divercity";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Q 3 - <i>Open</i></span> &nbsp;&nbsp;&nbsp;&nbsp;<!--Lifestyle--></a></li>



          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] >=4){ echo base_url()."cooperative";}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Q 4 - <i>Open</i></span> &nbsp;&nbsp;&nbsp;&nbsp;<!--Co-Operatives--> </a></li>



          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5"><a href="<?php if($userInfo[0]['userLevel'] >=5){ echo base_url()."summit";}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Q 5 - <i>Open</i></span>&nbsp;&nbsp;&nbsp;&nbsp;<!--Vacation Club--></a></li>



          <?php }?>



        </ul>

  </nav>
<h1 style="position: relative;top: -44px;text-align: center;">FREE SIMULATION AREA</h1>
  

  

  

  <!-- navigation end -->



  <div class="clear"></div>

</div>

<div class="adsimg">

<div class="pnkbar">

<div class="pnktxt">Ads Watched Today:  1  /   10</div>

<div class="pnkdrop">

<div class="select-boxhide">

<span></span>

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

<a class="crosclose" href="<?php echo base_url();?>ads">

<span>Watch ads</span>

</a>

</div>

<div class="pnkhrs"><span>1</span><span>0</span></div>

<div class="Tasktabbb">Tasks</div>

</div>

</div>

</div>

  <div class="watchvideo-popuptab">

  <ul>

<li><a id="adVideoLinkId01" name="https://www.youtube.com/embed/GZ6_f7N7VPw">Step 1 - Watch This Video <img src="<?php echo base_url(); ?>images/video-playicon.png" alt="" ></a></li>

<li><a id="adVideoLinkId02" name="https://www.youtube.com/embed/ueFzQ5tvJ7o">Step 2 - Money You will Make <img src="<?php echo base_url(); ?>images/video-playicon.png" alt="" ></a></li>

<li><a id="adVideoLinkId03" name="https://www.youtube.com/embed/Tse52gr7jxI">Step 3 - Prepare For The Launch <img src="<?php echo base_url(); ?>images/video-playicon.png" alt="" ></a>

<img src="<?php echo base_url(); ?>images/sicon.png" alt="" class="downarrow" ></li>

</ul>

  </div>