<script type="text/javascript">
$(document).ready(function(){
	$("#update_bb").click(function(){
	window.location.href="<?php echo base_url(); ?>payment/bbRegistration";
		
	});
});

</script>
<div class="rights_side<?php if($levelName==2){ echo " fulr"; } ?>">

<!--BB acc link start -->
<!--<div class="log_form ">

<?php if($userInfo[0]['account_type_ap'] && $userInfo[0]['account_type_bb'] == '1')
{
?>

<span style="float:left; width:100%;"><p class="activeuser" style="margin-left:16px; margin-bottom:10px;"><a style="padding:10px;" href="<?php echo base_url(); ?>myaccount" >Switch BB account</a></p></span>

<?php
}
?>
 </div>-->
 <div class="clear"></div>
<!--BB acc link end -->
  <div class="sm extra-no-pad">
    <ul class="social_media extra-width">
      <li class="sm001"> 
        <a href="javascript:void(0)" id="serviceList_1" onclick="funToggleSupport(this.id)">Customer Support / Help
        </a>
        <div id="slist_1" class="list_service">
          <form method="post" action="<?php echo base_url();?>dashboard/apdashboard/services/customer/<?php echo $ct_pageId;?>">
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
        
      </li>-->
    </ul>
  </div>
  
    <?php if($userInfo[0]['account_type_bb'] !="1" && $userInfo[0]['account_type_ap'] == "1"){ ?>
    
		<p class="activeuser" style="margin-left:16px;"><a id="update_bb" href="javascript:void(0)">Upgrade yourself in BB account</a></p>
		<br/>
    
    <?php }
	
	?>
     <p class="activeuser" style="margin-left:16px; margin-bottom:20px;"><a href="#" target="_blank">Association Tool-Kit</a></p>
 <p class="activeuser" style="margin-left:16px;"><a href="<?php echo base_url(); ?>dashboard/CT_catalog/" target="_blank">
 My CTTreasureChests.com</a></p>
  <br/>
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

 
</div>
