<?php $this->load->view("header", "", $result); ?>

<?php 

  // print_r(tttt);
  // exit;

   //echo  "-----".$result['getTotalMember'][0]['id'];

?>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>

<?php 

     if( $result["ProfileImage"] != ""){

?>

<style>

input[type=file]{

    width:90px;

    color:transparent;

}

</style>

<?php 

    }

?>

 <div class="nav">

            <!-- navigation start -->

            <nav class="secondary">

            	<ul class="misc_new">

                    <li><a href="<?php echo base_url(); ?>/ravestorysociety/freetrial">Free Trial<span>Open</span><span class="level">Level - 1</span></a></li>                    

					<li><a href="<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 10 || ($_SESSION['userId'] == 1000) || ($result['paymentStatus'] == 1)) { echo base_url().'/ravestorysociety/login';} else { echo '#'; } ?>" <?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) < 10) && ($_SESSION['UID'] != 1000) && ($result['paymentStatus'] == 0)) {?>onclick="ravsociety_permission('To access this you need to be switch on member ( Level-1 Step-3 )'); return false;" <?php } ?>>

					Full Member<span>

					<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 10 || ($_SESSION['userId'] == 1000) || ($result['paymentStatus'] == 1)) {?>

					Open <?php }else{?>Locked <?php }?>

					</span><span class="level">Level - 2</span>

					</a>

					</li>					

					<!--<li><a href="<?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) >= 50) || ($_SESSION['userId'] == 1000) /*|| ($result['paymentStatus'] == 1)*/)  { echo '#';} else { echo '#'; }?>" <?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) < 50) && ($_SESSION['UID'] != 1000) /*&& ($result['paymentStatus'] == 0)*/) {?> onclick="ravsociety_permission('To access this need more than 50 membership'); return false;"<?php }else{?>onclick="autoSubmitToRaversDirect();return false;"<?php }?>>

					The Source<span>

					<?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) >= 50) || ($_SESSION['userId'] == 1000)) {?>

					Open<?php }else{?>Locked<?php }?>

					</span><span class="level">Level - 3</span>

					</a></li>-->

					<li><a href="<?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) >= 50) || ($_SESSION['userId'] == 1000) /*|| ($result['paymentStatus'] == 1)*/)  { echo '#';} else { echo '#'; }?>" <?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) < 50) && ($_SESSION['UID'] != 1000) /*&& ($result['paymentStatus'] == 0)*/) {?> onclick="ravsociety_permission('To access this need more than 50 membership'); return false;"<?php }else{?>onclick="return false;"<?php }?>>

					The Source<span>

					<?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) >= 50) || ($_SESSION['userId'] == 1000)) {?>

					Open<?php }else{?>Locked<?php }?>

					</span><span class="level">Level - 3</span>

					</a></li>							

					<li><a href="<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 100 || ($_SESSION['userId'] == 1000)/* || ($result['paymentStatus'] == 1)*/) { echo base_url().'/ravestorysociety/regcontact';} else { echo '#'; } ?>"  <?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) < 100) && ($_SESSION['UID'] != 1000)/* && ($result['paymentStatus'] == 0)*/) {?> onclick="ravsociety_permission('To access this need more than 100 membership'); return false;"<?php }?>>

					Society Owner<span>

					<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 100 || ($_SESSION['userId'] == 1000)) {?>

					Open<?php }else{?>Locked<?php }?>

					</span><span class="level">Level - 4</span>

					</a></li>							

					<li><a href="<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 200 || ($_SESSION['userId'] == 1000)) { echo base_url().'/ravestorysociety/divinomanage';} else { echo '#'; } ?>"  <?php if((count($result['CHILDUSERLIST']['TOTALCHILD']) < 200)&& ($_SESSION['UID'] != 1000)) {?> onclick="ravsociety_permission('To access this need more than 200 membership'); return false;"<?php }?>>

					Create Your Lodge <span>

					<?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 200 || ($_SESSION['userId'] == 1000)) {?>

					Open<?php }else{?>Locked<?php }?>

					</span><span class="level">Level - 5</span>

					</a></li>	

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

        <div class="nitify-menu">

        	<ul>

            	<li><a href="#"><i class="fa fa-laptop"></i><span class="notify-ribon">15</span></a></li>

                <li><a href="#"><i class="fa fa-heart"></i><span class="notify-ribon">7</span></a></li>

                <li><a href="#"><i class="fa fa-globe"></i><span class="notify-ribon">2</span></a></li>

                <li><a href="javascript:void(0);" id="getNames" class="watch-video-tut"><i class="fa fa-dashboard"></i><span class="notify-ribon"><?php echo $result['getCounterJoins']; ?></span></a></li>

            </ul>

        </div>

        </div>

        <!--<div class="nav">sadasdasda

         <div class="clear"></div>

         </div>-->

 <!--ADDING COMMON FORM-->

 <?php $this->load->view("commonform", "", $result); ?>

 <!--END OF ADDING COMMON FORM-->       

   		</header>

		<!-- header end -->

    	

    <!-- main container start -->   

    <div class="main_container_new">

    

    	<!-- lefts side start -->

  		<div class="lefts_side">
			 <?php if($report == 1){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <?php if($report == 2){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
			<!--tab start-->

            <div class="tabsectionstep">
				<div class="table-status"><table width="100%" border="0" cellspacing="1" cellpadding="1">
      
       <table width="100%" border="0" cellspacing="1" cellpadding="1">
       
      <tbody>
     	<!--11/08/2015 done by ujjwal sana-->
      
        	
             <tr ><td>
             First Name: <?php echo $details[0]->firstName;?><br>
            Last Name: <?php echo $details[0]->lastName;?><br>
           Gender: <?php echo $details[0]->gender;?><br>
            Address: <?php echo $details[0]->address;?><br>
       Occupation: <?php echo $details[0]->occupation;?><br>
             Email: <?php echo $details[0]->emailID;?><br>
            Phone: <?php echo $details[0]->phone;?><br>
             Zip: <?php echo $details[0]->zip;?><br>
            
        City: 
             <?php foreach($citylist as $cls){ ?>
             	<?php if($cls->id==$details[0]->city){?>
					<!-- echo 'selected="selected"'; } -->
  					<?php echo $cls->city;?>
                     <?php } ?>
  				<?php } ?>	
			<br>
          <!--  State: <select>
             <?php foreach($citylist as $cls){ ?>
             	
  					<option value=<?php echo $cls;?>><?php echo $cls->city;?></option>
                    <?php if($cls->id==$ald->city){ ?>
                    <option value=<?php echo $cls;?>><?php echo $cls->city;?></option>
                     <?php } ?>
                     <?php } ?>
  					
			</select><br>  -->
            <!--12/08/2015 done by sana-->
             
          Country:
             <?php foreach($countrylist as $cls){ ?>
             	<?php if($cls->country_id==$details[0]->country){?>
  					<?php echo $cls->name;?>
                 
                     <?php } ?>
                   <?php } ?>
                     
                    
			</td>
            <?php foreach($list as $pic){ ?>
           
            	<?php if ($pic->profile == ""){?>
                
             <td <a class="fancybox" rel="group"  href="<?php echo base_url();?>user/profilepicture/originalprofilepicture/no_photo.jpg"><img height="60" width="60" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg" alt=""/></a></td>
            <?php } ?>
            <?php } ?>
             <!-- show profile picture -->
            <td class="<?php echo $className;?>"><?php foreach($list as $pic){ ?>
           
         	<a class="fancybox" id="profile_picture" rel="group" href="javascript:void(0)" >
            <!--<?php echo $this->config->item('gbe_base_url');?>useruploads/<?php echo $pic->profile;?>-->
<img height="60" width="60" src="<?php echo $this->config->item('gbe_base_url');?>useruploads/<?php echo $pic->profile;?>" alt=""/></a>
          <?php }?></td>
            <tr>
             <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>gateway/gatewayprofileEdit/<?php echo $ald->uID;?>">Edit </a></td>
              <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>gateway/add_profile_picture/<?php echo $ald->uID;?>">Change Profile picture </a></td>
           
        </tr>
         
         
         </tbody>
        </table>
         
        </div>

				

			
			</div>
            <!-- tab end-->

		</div>

			

			<div class="rights_side">

            

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
                      <td><input type="submit" value="Submit" id="customerServiceSubmit" name="customerServiceSubmit" ></td>
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
                      <td><input type="text" id="advertisingEmail" class="custEmailClass" name="email"></td>
                    </tr>
                    <tr>
                      <td><label for="textarea">message:</label></td>
                      <td><textarea rows="5" cols="31" id="advertisingMsg" class="custMessageClass" name="message"></textarea></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="submit" value="Submit" id="advertisingSubmit" name="advertisingSubmit" ></td>
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
                      <td><input type="submit" value="Submit" id="advertisingSubmit" name="advertisingSubmit" ></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </li>

                <li class="sm007">

                    <a href="javascript:void(0)" id="serviceList_4" >Listen to Rave Story Radio</a>

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

                  </div>-->

                </li>

				<?php if($_SESSION['UID'] == 1000){?>

				<li class="sm003">

                    <a href="javascript:void(0)" id="serviceList_5" onclick="funToggleSupport(this.id)">Total Member Under RaveBusiness</a>

                    <div class="list_service" id="slist_5" <?php  if(isset($_REQUEST["action"]) && ($_REQUEST["action"] == "Advertising") ){ echo "style=\"display:block\"";}?>>

                     <p class="total-number"><?php echo $result['getTotalMember'];?></p>

                  </div>

                    

                </li>

				<?php } ?>

             </ul>

     	   </div>

           <div class=" webbox">

           

            <!--<p class="web">

            <span>People introduced to Level 2:</span>

            <span><?php echo $result["getNumberOfCount"];?></span>

            </p>

            <p class="web">

            <span>People introduced His Referral:</span>

            <span><?php echo $result["getNumberOfCountById"];?></span>

            </p>-->

            

            <p class="web">

            <span>My Sign Up Page:</span>

            <a href="http://www.ravebusiness.com/<?php if($_SESSION['UID']!= 1000) echo "?uid=".$_SESSION['UID'];?>" target="_blank">http://www.ravebusiness.com/<?php if($_SESSION['UID']!= 1000) echo "?uid=".$_SESSION['UID'];?></a>

            </p>

            <?php if( $result["tenDollarPaymentStatus"] == "1" ){ ?>

            <p class="web">

           <span>My Rave Story Products website :</span>

             <a href="http://www.ravestory.com/<?php echo $_SESSION['UserID'];?>" target="_blank">http://www.ravestory.com/<?php echo $_SESSION['UserID'];?></a>

            </p>

            <?php }?>

            <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 10 || ($_SESSION['UID'] == 1000)) {?>

             <p class="web">

           <span>My Rave Blog:</span>

                <a href="http://www.raveblogger.com/<?php echo "?author=".$_SESSION['UID'];?>" target="_blank">

					http://www.raveblogger.com/<?php echo "?author=".$_SESSION['UID'];?>

				</a>

           </p>

           <?php }?>

           <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 50 || ($_SESSION['UID'] == 1000)) {?>

            <p class="web">

           <span>My Ravers Direct Profile:</span>

                

                <a href="http://www.raversdirect.com/raversdirect/ravetalent/<?php echo "?UID=".$_SESSION['UID'];?>" target="_blank">

					http://www.raversdirect.com/raversdirect/ravetalent/<?php echo "?UID=".$_SESSION['UID'];?>

				</a>

            </p>

            <?php }?>

            <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 100 || ($_SESSION['UID'] == 1000)) {?>

           <p class="web">

           <span>My Society Page:</span>

                 

                <a href="<?php echo base_url();?>/ravestorysociety/showSociety/?sid=<?php echo $result['SOCIETYDETAILS']['id'];?>" target="_blank">

					<?php echo base_url();?>/ravestorysociety/showSociety/?sid=<?php echo $result['SOCIETYDETAILS']['id'];?>

				</a>

            </p>

            <?php }?>

            <?php if(count($result['CHILDUSERLIST']['TOTALCHILD']) >= 200 || ($_SESSION['UID'] == 1000)) {?>

           <p class="web">

           <span>My Clubguide page:</span>

                  <a href="http://www.clubguideworldwide.com/<?php echo "?uid=".$_SESSION['UID'];?>" target="_blank">

					http://www.clubguideworldwide.com/<?php echo "?uid=".$_SESSION['UID'];?>

				</a>

            </p>

            <?php }?>

  		  	</div>

        	<div class="blue-box webbox">

            <p class="ana">ANALYTICS</p>

            	<ul>

                	<!--<li>Members in Level 2 Under This Referral:<?php echo $result['getNumberOfCount']; ?></li>-->

                	<li>Switched On Members :<span> <?php echo count($result['CHILDUSERLIST']['REMAINPAID']);?></span></li>

                	 <li>My Sign Ups : <span><?php echo ($result['showUserFreeTriel']['totalTriel'] !='')?$result['showUserFreeTriel']['totalTriel']:0;?></span></li>

                    <li> Visitors to my website : <span><?php echo $result['VISITEDMEMBERS'];?></span></li>

                    <li>My Ticket Sales : <span><?php echo $result['eventsTickets'];?></span></li>

                    <li>My Music Sales : <span><?php echo $result['musicSell'];?></span></li>

                    <li>My E-book Sales :<span> <?php echo $result['bookSell'];?></span></li>

                </ul>

            </div>

            

            

            <div class="ash">
                <div class=""> 
                 <?php foreach($list as $pic){ ?>
                 <?php if ($pic->profile == ""){?>
                   <?php echo $pic->profile; ?>
                 <img id="empPic" style="margin-right:25px;" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg"  width="70" height="70" alt="">
                   <?php } ?>
                   
              		<?php if ($pic->profile != ""){?>
                 <img id="empPic" style="margin-right:25px;" src="<?php echo $this->config->item('gbe_base_url');?>useruploads/<?php echo $pic->profile;?>"  width="70" height="70" alt="">
                   <?php } ?>
                 <?php } ?>  
                  </div>

                <span class="ash_postion">You are introduced to ravebusiness by</span>

                

                <span class="ash_title"><?php echo $result['userSocialDetails'][0]['name'];?></span>

                

                <span class="ash_tel"><?php echo $result['userSocialDetails'][0]['cellno'];?></span>

               <span class="ash_mail"><a href="mailto:<?php echo $result['userSocialDetails'][0]['social_email'];?>"> <?php echo $result['userSocialDetails'][0]['social_email'];?></a></span> 

                <div class="ash_social">

                <a href="<?php echo $result['userSocialDetails'][0]['facebook'];?>" target="_blank"><img src="<?php echo base_url(); ?>images/ash-fb.png" /></a>

                <a href="skype:<?php echo $result['userSocialDetails'][0]['skypeid'];?>?call" target="_blank"><img src="<?php echo base_url(); ?>images/skype_square_color-32.jpg" /></a>

                <a href="<?php echo $result['userSocialDetails'][0]['social_youtube'];?>" target="_blank"><img src="<?php echo base_url(); ?>images/youtube.jpg" /></a>

                <a href="<?php echo $result['userSocialDetails'][0]['social_twitter'];?>" target="_blank"><img src="<?php echo base_url(); ?>images/ash-tw.png" /></a>

                <a href="<?php echo $result['userSocialDetails'][0]['social_rave_blog'];?>" target="_blank"><img src="<?php echo base_url(); ?>images/ash-wp.png" /></a>

           </div>

            </div>

            

<?php if( $result["tenDollarPaymentStatus"] == "1" ){ ?>

<br class="clear" />

<div class="giftdis">

	<h2>Free Gifts & Discounts </h2>

    <div class="cont">

     <?php foreach( $result["getOffersDetails"] as $key=>$val){ ?>

    	<div class="postcont">

        	<h3><?php echo $result["getOffersDetails"][$key]["dealoffer"];?></h3>

            <div class="imgcoll"><img src="<?php echo BASE_PATH_RAVE.'/'.UPLOAD_PATH.'deal/tmb'.$result['getOffersDetails'][$key]['dealofferfile_image']; ?>"></div>

            <a href="<?php echo BASE_PATH_RAVE.'/'.UPLOAD_PATH.'deal/'.$result['getOffersDetails'][$key]['dealofferfile']; ?>" class="colle">Collect</a>

        </div>

     <?php } ?>   

    </div>

</div>

<?php } ?>   

	  </div>

      <!-- rights side end -->



    <div class="clear"></div>

	

    </div>

	<?php if($_SESSION['UID'] == 1000){

			

	      	if( !empty($result['getRaveMemberList'])){

			

	?>

	<div class="table-status">

	<table width="100%" border="0" cellspacing="5" cellpadding="5">

  <tr>

    <th height="35" align="center" valign="middle" scope="col">Image</th>

    <th height="35" align="center" valign="middle" scope="col">Name</th>

    <th height="35" align="center" valign="middle" scope="col">UID</th>

    <th height="35" align="center" valign="middle" scope="col">RefID</th>

    <th height="35" align="center" valign="middle" scope="col">Phone</th>

    <th height="35" align="center" valign="middle" scope="col">Email</th>

	<th height="35" align="center" valign="middle" scope="col">Country</th>

    <!--<th height="35" align="center" valign="middle" scope="col">Status</th>-->

  </tr>

  <?php foreach($result['getRaveMemberList'] as $val){?>

  

  <tr>

    <td height="45" align="center" valign="middle"><img src="<?php echo base_url(); ?>/upload/profile/<?php if($val['ProfileImage'] !=""){echo $val['ProfileImage'] ;}else { echo "member_img.png";}?>" height="35" /></td>

    <td height="45" align="center" valign="middle"><?php echo  $val['FirstName']." ".$val['LastName']; ?></td>

    <td height="45" align="center" valign="middle"><?php echo  $val['UID']; ?></td>

    <td height="45" align="center" valign="middle"><?php echo  $val['ReferalID']; ?></td>

    <td height="45" align="center" valign="middle"><?php echo  $val['Phone']; ?></td>

    <td height="45" align="center" valign="middle"><?php echo  $val['EmailId']; ?></td>

	 <td height="45" align="center" valign="middle"><?php echo  $val['Country']; ?></td>

    <!--<td height="45" align="center" valign="middle">Deactive</td>-->

  </tr>

  

  <?php } ?>

  

</table>



	</div>

	

	<?php }}?>

    <!-- main container end -->

    <?php if($_SESSION['UID'] == 1054){?>

	<!--<div class="table-status">

	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">

<input type="hidden" name="cmd" value="_s-xclick">

<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----

">

<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">

</form>

	</div>-->	

	<?php }?>

  <!--footer style-->





<script type="text/javascript">





var postImage = "<?php echo count($result['getFbPictureUpload']); ?>";

var countBanner = "<?php echo count($result['showUserBanner']); ?>";

var postYoutube = "<?php echo count($result['getYoutubeUrlLink']); ?>";

$(document).ready(function(){ 

	

	for(var j=0;j<postImage;j++){

		$('a#po_image'+j).zclip({			

			path:'<?php echo base_url(); ?>/Application/content/member/js/ZeroClipboard.swf',			

			copy:$('input#imagePost'+j).val(),

			beforeCopy:function(){

			$('input#imagePost'+j).css('background','yellow');

			$(this).css('color','orange');

			},

			afterCopy:function(){

			$('.tpbb a').css('background','');

			$('.tpbb a').css('color','');

			$(this).css('background','green');

			$(this).css('color','purple');

			//$(this).next('.check').show();tpbb

			}

		});

	}

		

//});



//$(document).ready(function(){ 	

	for(var i=0;i<countBanner;i++){

		$('a#coppy'+i).zclip({

			path:'<?php echo base_url(); ?>/Application/content/member/js/ZeroClipboard.swf',			

			copy:$('input#banner'+i).val(),

			beforeCopy:function(){

			$(this).css('background','yellow');

			$(this).css('color','orange');

			},

			afterCopy:function(){

			$('.mbr a').css('background','blue');

			$('.mbr a').css('color','white');

			$(this).css('background','green');

			$(this).css('color','white');

			}

		});

	}

		

//});





//$(document).ready(function(){ 	

	for(var k=0;k<postYoutube;k++){		

		$('a#postYoutube'+k).zclip({			

			path:'<?php echo base_url(); ?>/Application/content/member/js/ZeroClipboard.swf',			

			copy:$('input#youtube'+k).val(),

			beforeCopy:function(){

			$('input#youtube'+k).css('background','yellow');

				$(this).css('color','orange');

			},

			afterCopy:function(){

			    $('.cbz a').css('background','#031F30');

				$('.cbz a').css('color','white');

				$(this).css('background','green');

				$(this).css('color','white');

				//$(this).next('.check').show();cbz

			}

		});

	}

		

});







$(document).ready(function() {



	





	//Default Action

	$(".tab_content").hide(); //Hide all content

	$("ul.tabs li:first").addClass("active").show(); //Activate first tab

	$(".tab_content:first").show(); //Show first tab content

	

	//On Click Event

	$("ul.tabs li").click(function(e) {

		

		for(var k=0;k<postYoutube;k++){		

		$('a#postYoutube'+k).zclip({			

			path:'<?php echo base_url(); ?>/Application/content/member/js/ZeroClipboard.swf',			

			copy:$('input#youtube'+k).val(),

			beforeCopy:function(){

			    $('input#youtube'+k).css('background','yellow');

				$(this).css('color','orange');

			},

			afterCopy:function(){

			    $('input#youtube'+k).css('background','green');

				$(this).css('color','white');

				$(this).next('.check').show();

			}

		});

	}

		

		

		$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$(this).addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("rel"); //Find the rel attribute value to identify the active tab + content

		//alert(activeTab);

		$('#'+activeTab).fadeIn(); //Fade in the active content

		e.preventDefault();

		//return false;

	});



});



function showSecondTab(){

		$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		$("#tab2").fadeIn(); //Fade in the active content

		return false;

}



function showThirdTab(){

		$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(3)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		$("#tab3").fadeIn(); //Fade in the active content

		return false;

}



function valFormCountryCode(){

	if($("#country").val() == "0"){

		alert("Please select country before submission");

		return false;	

	}else{

		return true;

	}

}



function valaddFreeBiesCodeForDouble(){

	if($("#pearlCode").val() == ""){

		alert("Please put your pearl chest code before submission");

		return false;	

	}else{

		return true;

	}

}

function valAddSilverChestCode(){

	if($("#silverCode").val() == ""){

		alert("Please put your silver chest code before submission");

		return false;	

	}else{

		return true;

	}

}

$(document).ready(function() {



	//Default Action

	$(".tab_content").hide(); //Hide all content

	$("ul.tabs li:first").addClass("active").show(); //Activate first tab

	$(".tab_content:first").show(); //Show first tab content

	

	//On Click Event

	$("ul.tabs li").click(function(e) {

		

		for(var k=0;k<postYoutube;k++){		

		$('a#postYoutube'+k).zclip({			

			path:'<?php echo base_url(); ?>/Application/content/member/js/ZeroClipboard.swf',			

			copy:$('input#youtube'+k).val(),

			beforeCopy:function(){

			$('input#youtube'+k).css('background','yellow');

				$(this).css('color','orange');

			},

			afterCopy:function(){

			$('input#youtube'+k).css('background','green');

				$(this).css('color','white');

				$(this).next('.check').show();

			}

		});

	}

		

		

		$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$(this).addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("rel"); //Find the rel attribute value to identify the active tab + content

		//alert(activeTab);

		$('#'+activeTab).fadeIn(); //Fade in the active content

		e.preventDefault();

		//return false;

	});



});







$(document).ready(function() {
	$("#profile_picture").click(function() {

		$.fancybox.open('<iframe width="620" height="415" src="<?php echo $this->config->item('gbe_base_url');?>useruploads/<?php echo $pic->profile;?>" frameborder="0" allowfullscreen></iframe>');

	});

	$("#gmailContact").click(function(){

		$("#gmail_yahoo_user").val('');

		$("#gmail_yahoo_pwd").val('');

		$("#gmail_yahoo_user").attr('placeholder','Enter Your Gmail Id');

		$("#gmail_yahoo_pwd").attr('placeholder','Enter Your Gmail Password');

		$("#gmail_yahoo_flag").val('gmail');

	});

	$("#yahooContact").click(function(){

		$("#gmail_yahoo_user").val('');

		$("#gmail_yahoo_pwd").val('');

		$("#gmail_yahoo_user").attr('placeholder','Enter Your Yahoo Id');

		$("#gmail_yahoo_pwd").attr('placeholder','Enter Your Yahoo Password');

		$("#gmail_yahoo_flag").val('yahoo');

	});

	//repeat above step

	$("#gmailContactRadio").click(function(){

		$("#gmail_yahoo_user").val('');

		$("#gmail_yahoo_pwd").val('');

		$("#gmail_yahoo_user").attr('placeholder','Enter Your Gmail Id');

		$("#gmail_yahoo_pwd").attr('placeholder','Enter Your Gmail Password');

		$("#gmail_yahoo_flag").val('gmail');

	});

	$("#yahooContactRadio").click(function(){

		$("#gmail_yahoo_user").val('');

		$("#gmail_yahoo_pwd").val('');

		$("#gmail_yahoo_user").attr('placeholder','Enter Your Yahoo Id');

		$("#gmail_yahoo_pwd").attr('placeholder','Enter Your Yahoo Password');

		$("#gmail_yahoo_flag").val('yahoo');

	});

	//end repeat

	$("#getNames").click(function() {

		$.fancybox.open('<?php for($i=0;$i<count($result['getNamesUID']);$i++){?><li><?php echo $result['getNamesUID'][$i]['FirstName']."&nbsp;".$result['getNamesUID'][$i]['LastName']; ?></li><?php }?>');

	});

	$("#tutorial-video1A").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/PuehFznvJUY?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video1").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/QtNQi_xKbwk?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video2").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/pZuT6raA3UQ?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video3").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/G-9NluGYpWg?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video4").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/cThsfY1zqUc?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video5").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/z6kG-TKjUzE?autoplay=1"  frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video6").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/KoUxlvQYE3c?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video7").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/tX3vzehrmn0?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video8").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/fqZvPKfX2lE?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video9").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/GHoNI_pcLuU?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video10").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/EaC2L9iu9QE?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video11").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/FzeTSC2igzo?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video12").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/uFwpnTKQk0Q?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video13").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/mmxZBcCovSo?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video141").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/Y6Sd9G78ufA?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video142").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/Hn4jqzYUHN8?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video150").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/8QwOi4-fHyo?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video151").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/dJf4snUP-Is?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video152").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/WyqzLyRPHWM?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video153").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/jRd1GGlze9E?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video154").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/Ns2LiV-xXpY?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video15").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/s4YS7eDZDg8?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video16").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/pr4_JoYxj4Y?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video17").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/sto_jKuT8lc?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video18").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/zfAuX6a_V5w?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video19").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/0AozfWahm3g?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video20").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/pvAjhTn8ntI?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	

	$("#fancybox-contact").click(function() {

	    var userid = $.trim($("#gmail_yahoo_user").val());

		var pwd    = $.trim($("#gmail_yahoo_pwd").val());

		var type   = $("#gmail_yahoo_flag").val();

		//alert(userid);

		//alert(pwd);

		//alert(type);

		if(type=='yahoo'){

			$.fancybox.open($("#cont").css("display","block"));

			$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

			$.ajax({

				type: "POST",

				data: "userid="+userid+"&pwd="+pwd,

				url: "<?php echo base_url(); ?>/ravestorysociety/getYahooContact",

				success: function(data) {

					//alert(data);

					$.fancybox.open($("#cont").css("display","block"));

					$.fancybox.open($("#cont").html(data));

				}

			});	

		}

		if(type=='gmail'){

			$.fancybox.open("demo");

			$.fancybox.open($("#cont").css("display","block"));

			$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

			$.ajax({

				type: "POST",

				data: "userid="+userid+"&pwd="+pwd,

				url: "<?php echo base_url(); ?>/ravestorysociety/getGmailContact",

				success: function(data) {

					/*alert(1111);

					alert(data);*/

					$.fancybox.open($("#cont").css("display","block"));

					$.fancybox.open($("#cont").html(data));

				}

			});	

		}

		//$.fancybox.open($("#cont").css("display","block"));

	});	

});



$(document).ready(function() {

	$("#person_list").click(function(){

		$("#plist").slideToggle();

	})	

});



$(document).ready(function() {

	$("#person_list1").click(function(){

		$("#plist1").slideToggle();

	})	

});



function funToggleSupport(id){

	var myArray = id.split('_');

	$("#slist_"+myArray[1]).slideToggle();

    

}

/*$(document).ready(function() {

	$("#person_list3").click(function(){

		$("#plist3").slideToggle();

	})	

});*/

/*$(document).ready(function() {

	//var SlideCont = $(".social_media li").child(".list_service");

	$(".social_media li a").click(function(event){

		event.preventDefault();

		//$(SlideCont).hide();

		//$(this).parent("").slideToggle();

		alert();

		$(SlideCont).slideToggle();

	})	

});*/

/*$(function () {

    $('.social_media li').click(function () {

		alert(this);

        $(this).next('div.list_service').slideToggle();



        $(this).parent().siblings().children().next().slideUp();

        return false;

    });

});*/

function resetFreeBies(uid){

	if(confirm("Are you sure you want to reset?")){

	 $("#loader_"+uid).html('<img src="<?php echo base_url(); ?>/Application/content/member/images/loader.gif" />');	

		$.ajax({

			type: "POST",

			data: "uid="+uid,

			url: "<?php echo base_url(); ?>/ravestorysociety/updateFreebiesStatus",

			success: function(data) {

				if(data=="success"){

					$("#count_child_"+uid).html(0);

					$("#loader_"+uid).html('<img src="<?php echo base_url(); ?>/Application/content/member/images/reset.png" width="15" height="15" />');

				}

			}

		});	

	}

}



function downloadVideo(video_id){

	//alert(video_id);

	$.fancybox.open('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />');

	$.ajax({

			type: "POST",

			data: "video_id="+video_id,

			url: "<?php echo base_url(); ?>/ravestorysociety/downloadVideo",

			success: function(data) {

				$.fancybox.open(data);

			}

		});

}



$(document).ready(function() {

	$(".share-btn").click(function(e){

		$(this).parent().find('.share-popup').fadeIn(1000);

	 }); 

	$(".share-btn").blur(function(e){

		$(this).parent().find('.share-popup').fadeOut(1000);

	});

	jQuery('#mycarousel').jcarousel();

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

		

		

</script>     



<?php 

      if( $_REQUEST["action"] == "gmailContactImport"){

		  $arr = json_decode($_REQUEST["contactList"]);

		  

		  $str="";

          $str.="<form name=\"frm\" method=\"post\" action=\"".base_url()."/ravestorysociety/sendEmailToContactList\">";

          $str.="<input type=\"checkbox\" name=\"select_all\" id=\"selectall\" > Select ALL <br>";

		  foreach ($arr as $key=>$val){

	        foreach($val as $eml){

				//$val2 = $arr["gmailContactList"][$key];

				$str.="<input type=\"checkbox\" name=\"email_id[]\" class=\"case\" value=\"$eml\"> ".$eml."<br>";

			}

          }

         $str.="<input type=\"hidden\" name=\"reffer_id\" value=\"".$_SESSION['UID']."\">";

         $str.="<input type=\"hidden\" name=\"sender_email\" value=\"".$_REQUEST['userid']."\">";

         $str.="<input type=\"submit\" name=\"send_mail\" value=\"submit\">";

         $str.="</form>";

        

?>

      <script>  

      $(document).ready(function() {

	  	$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		$("#tab2").fadeIn(); //Fade in the active content

		

		loadGmailContactRes();

	  });

	  

	  function loadGmailContactRes(){

		$.fancybox.open("demo");

		$.fancybox.open($("#cont").css("display","block"));

		$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

		

		$.fancybox.open($("#cont").css("display","block"));

		$.fancybox.open($("#cont").html('<?php echo $str;?>'));

	  }

      </script>  

      <script language="javascript">

$(document).ready(function() {

	// add multiple select / deselect functionality

    $("#selectall").click(function () {

          $('.case').attr('checked', this.checked);

    });

 

    // if all checkbox are selected, check the selectall checkbox

    // and viceversa

    $(".case").click(function(){

 

        if($(".case").length == $(".case:checked").length) {

            $("#selectall").attr("checked", "checked");

        } else {

            $("#selectall").removeAttr("checked");

        }

 

    });

	

});

</script>

<?php 

	  }

?>

<?php 

      if( $_REQUEST["action"] == "yahooContactImport"){

		  $arr = json_decode($_REQUEST["contactList"]);

		  //print_r($arr);

		  $str="";

          $str.="<form name=\"frm\" method=\"post\" action=\"".base_url()."/ravestorysociety/sendEmailToContactList\">";

          $str.="<input type=\"checkbox\" name=\"select_all\" id=\"selectall\" > Select ALL <br>";

		  foreach ($arr as $key=>$val){

	        $str.="<input type=\"checkbox\" name=\"email_id[]\" class=\"case\" value=\"$eml\"> ".$val."<br>";

		  }

          $str.="<input type=\"hidden\" name=\"reffer_id\" value=\"".$_SESSION['UID']."\">";

          $str.="<input type=\"hidden\" name=\"sender_email\" value=\"".$_REQUEST['userid']."\">";

          $str.="<input type=\"submit\" name=\"send_mail\" value=\"submit\">";

          $str.="</form>";

        

?>

      <script>  

      $(document).ready(function() {

	  	$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		$("#tab2").fadeIn(); //Fade in the active content

		

		loadGmailContactRes();

	  });

	  

	  function loadGmailContactRes(){

		$.fancybox.open("demo");

		$.fancybox.open($("#cont").css("display","block"));

		$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

		

		$.fancybox.open($("#cont").css("display","block"));

		$.fancybox.open($("#cont").html('<?php echo $str;?>'));

	  }

      </script>  

      <script language="javascript">

$(document).ready(function() {

	// add multiple select / deselect functionality

    $("#selectall").click(function () {

          $('.case').attr('checked', this.checked);

    });

 

    // if all checkbox are selected, check the selectall checkbox

    // and viceversa

    $(".case").click(function(){

 

        if($(".case").length == $(".case:checked").length) {

            $("#selectall").attr("checked", "checked");

        } else {

            $("#selectall").removeAttr("checked");

        }

 

    });

	

});

</script>

<?php 

	  }

?>

 <?php if( $_REQUEST["action"] == "pdfDownload"){?>	

  <script>  

      $(document).ready(function() {

	  	$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		$("#tab2").fadeIn(); //Fade in the active content

	  });

  </script>	  

<?php }?>	  





