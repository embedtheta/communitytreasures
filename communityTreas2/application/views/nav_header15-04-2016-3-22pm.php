<img src="<?php echo base_url(); ?>images/blue_bar.png" alt="" style="padding-bottom:15px;" >
<div class="nav"> 
  
  <!-- navigation start -->
  
  <nav class="secondary">
     <ul class="misc_new">
          <?php if($accessPermission==2){?> 
          <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] >= 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Level - 1</span> CT Catalogue<span>Open</span></a></li>
          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] >= 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Level - 2</span> LifeStyle<span> Open </span></a> </li>
          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] >= 2){ echo base_url()."diversity";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Level - 3</span> Knowledge<span> Open </span></a></li>
          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] >= 3){ echo 'javascript:void(0)';}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Level - 4</span> Co-operative <span> Open </span> </a></li>
          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] >= 4){ echo 'javascript:void(0)';}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Level - 5</span>Summit<span> Open </span> </a></li>
           <?php 
		  }
		  else{ 
		  
		  ?>
          <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Level - 1</span> CT Catalogue<span>Open</span></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] >= 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Level - 2</span> LifeStyle<span> Open </span></a> </li>

          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] > 2){ echo base_url()."diversity";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Level - 3</span> Knowledge<span> Open </span></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo 'javascript:void(0)';}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Level - 4</span> Co-operative <span> Open </span> </a></li>

          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5"><a href="<?php if($userInfo[0]['userLevel'] > 4){ 'javascript:void(0)';}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Level - 5</span>Summit<span> Open </span> </a></li>

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
</div>
