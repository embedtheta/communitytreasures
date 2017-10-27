
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>MMS | GBE</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/mass.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/carosel.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>

<script type="text/javascript">


function readURL(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
         $('#empPic').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}



</script>

<script>

 $(document).ready(function(){
	 
	 $(".ulLevel1").unbind().bind("click", function(){
		var id = $(this).attr("id");
		var hasChild = $(this).attr("name");
		if(hasChild > 0){
			$("#ul1_"+id).slideToggle('slow'); 
			if($(this).text() == '-'){
				$(this).text('+');
			}else{
				$(this).text('-');
			}
		}
	});
	
	$(".ulLevel2").unbind().bind("click", function(){
		var id = $(this).attr("id");
		var hasChild = $(this).attr("name");
		if(hasChild > 0){
			$("#ul2_"+id).slideToggle('slow'); 
			if($(this).text() == '-'){
				$(this).text('+');
			}else{
				$(this).text('-');
			}
		}
	});
	
	$(".ulLevel3").unbind().bind("click", function(){
		var id = $(this).attr("id");
		var hasChild = $(this).attr("name");
		if(hasChild > 0){
			$("#ul3_"+id).slideToggle('slow'); 
			if($(this).text() == '-'){
				$(this).text('+');
			}else{
				$(this).text('-');
			}
		}
	});	
	
	<?php if($totalUserUnderMassUser >= 120){?>
	$.fancybox.open('<div class="switch"><h3 style="text-align:center;">Congratulations <br>You have enough people qualify you to move up.</h3><h2 style="text-align:center;">Now you are in Level 2 .So you can make more money! Hurry up.</h2><div class="switch_extrapara"><p class="swt_img"><a href="<?php echo base_url();?>fullmembers"><img width="567" height="81" style="cursor:pointer" alt="" src="<?php echo base_url();?>images/submit-paypal.png"></a></p></div></div>'); 
	<?php }?>
	
 });
 
 function showAlert(){
	 var msg = "You can send 12 request on each Level.";
	 $.fancybox.open(msg);
     return false;
 }
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script>
$(document).ready(function(){
	$("#videoLinkId").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
	});
});
</script>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>
<?php $this->load->view('header-logo');?>
<div class="wrapper">
   <?php $this->load->view('header',$result);?>
  <!--header end-->
  
  <div class="main_container">
   <div class="white-bg">
      <div class="mms_page">
        <div class="mms_page_frm">
          <div class="wch_vdo nsfdn">
			<!--<a href="javascript:void(0);" name="https://www.youtube.com/embed/tL0UErz8rLA" id="videoLinkId">--><!--changed 21/8/2015 by RD-->
            <!--<a href="javascript:void(0);" name="https://www.youtube.com/embed/zILF2fLhW_E" id="videoLinkId"> --><!-- Changed by SB on 14/09/2015 -->
			<a href="javascript:void(0);" name="https://www.youtube.com/embed/aI_BhCEKhCc" id="videoLinkId">
                <div class="wtch_vio ">
                    <div class="vdo_img">
                    <img src="<?php echo base_url();?>img/wtch.png">
                    <h3>Watch Video</h3></div>
                </div>
            </a>
            <div class="flw_ibst">
            <h3>The Faster - You Add 12<br>THe Quicker - You Get Paid!</h3>
          <!--  <p>1) Add 12 People   2) Move Up The Level Two  3) Get Paid</p>-->
          <p><img src="<?php echo base_url();?>img/mse.png"></p>
            <!--<p><img src="<?php //echo base_url();?>img/mssg.png"></p>-->
           <!-- <h3>Follow This Instructions</h3>-->
            <!--<p>Give This Gift To 12 Sincere People 'Your True 12'. Help Them Put Their Product, Service On Afrowebb. All Together 'Move As One' upto Level 2.<br>Help Your 12 To Repeat The Process For Themselves. When They Do You Will Be on Level 4 - Financially Free.</p>-->
           <!-- <div class="mss_cont">
            <ul>
            <li>1. If you need help finding 12 good people - Go to your Sign Up page called  'My Sellers On Afrowebb' on the right colunm in Level 1.</li>
            <li>2. Post the URL of  'My Sellers On Afrowebb'  on your facebook, whatsapp, and twitter etc. This  will attract people who qualify to be part of your 12.</li>
            <li>3. When people arrive they will be viewable at the bottom of the page. Call this person and qualify them by checking: 
             		<ul>
<li>A. Do they have a product or service to place of Afrowebb.</li>
            		<li>B. Will they support 12 others by giving the gift of the V.I.P</li> 
             		<li>C. Will they move as one - Raising up the system at an agreed date once they have fully build their GBE business.</li>
</ul>
             </li>
             </ul>
             <p>NOW GET YOUR 12 & PREPARE TO MOVE AS ONE.</p>
            </div>-->
            </div>
            <!--<div class="rndud"><?php //if($countDay > 0):?><h5><strong><?php //echo $countDay; ?></strong> <?php if($countDay > 1):?>Days<?php //else:?>Day<?php endif;?></h5><?php //else:?><?php ?><img src="<?php //echo base_url();?>img/trophy.png"><?php //endif;?></div>-->
            <div class="clear"></div>
          </div>
          <p>&nbsp;</p>
          <!--<h3>My MMS signup System</h3>-->
          <?php if($userType == "ADMIN"):?>
          <p>You Are Super Admin</p>
          <?php else:?>
          <p>You Are Currently On Level - <?php echo $userInfo[0]['userLevel']+1;?></p>
          <?php endif;?>
        </div>
        <?php if($sendMassUserCount == 0 && $sendMassUserLevel == 0 ){?>
        <div class="fm_mss">
          <h3>V.I.P Access For 12 of Your Guests (Only)</h3>
          <?php if($page_text!="") { ?><h4><?php echo $page_text; ?></h4> <?php }?>
          <?php if($msg != ""):?>
          <div class="global-msg-<?php echo $status;?>"><?php echo $msg;?></div>
          <?php endif;?>
          <form action="" method="post">
          <input type="hidden" name="userLevel" value="<?php echo $userInfo[0]['userLevel'];?>">
            <p>
              <label>Name</label>
              <input name="name" type="text">
              <?php echo form_error('name', '<span class="form_error">', '</span>'); ?>
            </p>
            <p>
              <label>Surname</label>
              <input name="surname" type="text">
            </p>
            <p>
              <label>E-mail</label>
              <input name="emailAddr" value="" type="text">
         <?php echo form_error('emailAddr', '<span class="form_error">', '</span>'); ?>
            </p>
            
            <!--<p>
              <label>Skype</label>
              <input name="skypeID" type="text">
            </p>-->
            
            <p>
              <label>Contact Number</label>
              <input name="phone" type="text">
            </p>
            
            <p>
            
              <label>City</label>
              <?php if($userType == "ADMIN"):?>
		              <select name="city">
		                <option value="" <?php echo $disabled;?>>Select City </option>
		                <?php 
							if(count($city) > 0): 
								foreach($city as $vc): 
									
						?>
		                <option value="<?php echo $vc->id?>"><?php echo $vc->city?></option>
		                <?php endforeach;endif;?>
		              </select>
              <?php else:?>
	              <?php if($userId == 1456):?>
			              <select name="city">
		                <option value="">Select City </option>
		                <?php 
							if(count($city) > 0): 
								foreach($city as $vc): 
									if($vc->id != 1):
							?>
		                <option value="<?php echo $vc->id?>"><?php echo $vc->city?></option>
		                <?php endif; endforeach; endif;?>
		              </select>
	              <?php else:?>
			              <select name="city">
			              <option value="<?php echo $userInfo[0]['city_id']?>" selected><?php echo $userInfo[0]['cityName']?></option>
			              </select>
	              <?php endif;?>
              <?php endif;?>
              <?php echo form_error('city', '<span class="form_error">', '</span>'); ?>
            </p> 
            <p>
              <label>Zip</label>
              <input name="zip" type="text">
            </p>
            
            <div class="clear"></div>
           <div class="mgs"><label>Message</label>
            	<textarea name="message"></textarea>
                <?php echo form_error('message', '<span class="form_error">', '</span>'); ?>
                </div>
            
            <!--<p><label>Zip Code</label><input name="" type="text"></p>-->
            <input name="submit" type="submit" value="send" <?php if($sendMassUserCount == 1){?> onClick="return showAlert();"<?php }?>> <input name="" type="reset" value="reset"><div class="clear"></div>
           
          </form>
        </div>
        <?php }?>
        <div class="tgg_sec"> 
        
         <?php if($userType == 'ADMIN' || $userType == 'HEAD VOLUNTEERS' || $userType == 'VOLUNTEERS'):?>
            <?php if(count($massDetails[$userInfo[0]['uID']]) > 0): ?>
            <a class="mbr_cnt">members counter</a>
          		<ul id="toggle-view">
                	<?php foreach($massDetails[$userInfo[0]['uID']] as $k => $vk): ?>
            		<li class="">
                    	<div class="li_dve_in">
                        	<span class="pls ulLevel1" id="<?php echo $vk['user_id'];?>" name="<?php echo count($massDetails[$k]);?>">+</span>
                        
                        
                        <a href="javascript:void(0)"><strong><?php echo $vk['cuFName'];?> <?php echo $vk['cuLName'];?></strong> 
                        <strong><?php echo $vk['cuPhone'];?>  | <?php echo $vk['cuEmail'];?>  |  <?php echo date("d-m-Y",strtotime($vk['created_date']));?>  |  <?php echo $vk['city'];?></strong><h4><?php echo count($massDetails[$k]);?></h4><br class="clear">
              </a></div>
              
           			<?php if(isset($massDetails[$k]) && count($massDetails[$k]) > 0){ ?>
              			<ul class="panel" style="display:none;" id="ul1_<?php echo $vk['user_id'];?>">
              				<?php foreach($massDetails[$k] as $kk => $vkk){?>
                				<li>
                                <div class="li_dve_in">
                                <span class="pls ulLevel2" id="<?php echo $vkk['user_id'];?>" name="<?php echo count($massDetails[$kk]);?>">+</span><a href="javascript:void(0)"><strong><?php echo $vkk['cuFName'];?> <?php echo $vkk['cuLName'];?></strong> <strong><?php echo $vkk['cuPhone'];?>  | <?php echo $vkk['cuEmail'];?>  |  <?php echo date("d-m-Y",strtotime($vkk['created_date']));?>  |  <?php echo $vkk['city'];?></strong><h4><?php echo count($massDetails[$kk]);?></h4><br class="clear"></a>
                                </div>
                                
                				<?php if(isset($massDetails[$kk]) && count($massDetails[$kk]) > 0){ ?>
                					<ul class="panel" style="display:none;" id="ul2_<?php echo $vkk['user_id'];?>">
                                    	<?php foreach($massDetails[$kk] as $kkk => $vkkk){?>
                  							<li>
                                            <div class="li_dve_in">
                                            <span class="pls ulLevel3" id="<?php echo $vkkk['user_id'];?>" name="<?php echo count($massDetails[$kkk]);?>"><?php if($userType == 'ADMIN'){?>+<?php }else{?>&nbsp;<?php }?></span>
                                        	<a href="javascript:void(0)">
                                            	<strong><?php echo $vkkk['cuFName'];?> <?php echo $vkkk['cuLName'];?></strong> <strong><?php echo $vkkk['cuPhone'];?> | <?php echo $vkkk['cuEmail'];?>  |   <?php echo date("d-m-Y",strtotime($vkkk['created_date']));?>  | <?php echo $vkkk['city'];?></strong><h4><?php echo count($massDetails[$kkk]);?></h4><br class="clear">
                  							</a> 
                                            </div>
                                            <?php if(isset($massDetails[$kkk]) && count($massDetails[$kkk]) > 0){ ?>
                                            <ul class="panel" style="display:none;" id="ul3_<?php echo $vkkk['user_id'];?>">
                                            	<?php foreach($massDetails[$kkk] as $kkkk => $vkkkk){?>
                                                <li>
                                                <div class="li_dve_in">
                                                <span class="pls ulLevel3" id="<?php echo $vkkkk['user_id'];?>" name="<?php echo count($massDetails[$kkkk]);?>">&nbsp;</span>
                                                <a href="javascript:void(0)">
                                                    <strong><?php echo $vkkkk['cuFName'];?> <?php echo $vkkkk['cuLName'];?></strong> <strong><?php echo $vkkkk['cuPhone'];?> | <?php echo $vkkkk['cuEmail'];?>  |  <?php echo date("d-m-Y",strtotime($vkkkk['created_date']));?>  |  <?php echo $vkkkk['city'];?></strong><br class="clear">
                                                </a>
                                                </div>
                                                </li>
                                                
                                                <?php }?>
                                            </ul>
                                            <?php }?>
                                            
                                        </li>
                                        
                                        <?php }?>
                  					</ul>
                  				<?php }?>
                  				</li>
                  				
                  			<?php } ?>
              			</ul>
              			
              		<?php  }?>
            		</li>
            		
                    <?php endforeach; ?>
          		</ul>
                 
          	<?php else: ?>
          	No MMS user please..
         	<?php endif;?>
         <?php else:?>
         	You have no permission to view your MMS system user. When you will be Level 2 Then You can see your MMS user.<br>
			Now you can send only request..
         <?php endif;?>
          
        </div>
      </div>
    </div>
    <br class="clear">
  </div>
 
</div>

<script type="text/javascript">
var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";

</script> 
<script type='text/javascript' src='<?php echo base_url();?>js/custom_common.js'></script>

</body>
</html>
