 <div class="rights_side">


	<?php


            $viewArray = array("INDUSTRY LEADER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","FOUNDERS");


            //$viewArray = array("VOLUNTEERS","PAYING USER","ADMIN");'business','community','health','mentorship','talented','general','afrowebb'


            if(in_array($this->session->userdata('userType'), $viewArray)){


                unset($viewArray);


        ?>


        


    


    <div class="blue-box webbox" id="OverView">


     <p class="ana" style="font-weight:bold; font-size: 16px;">I am in Q <?php if($userInfo[0]['userLevel']>0) { echo $userInfo[0]['userLevel'];} else{ echo "1"; } ?></p>


      <div>


     <ul>


          <li class="mbrs"><strong style="width:60% !important;">My Current Position<span></span></strong> <strong style=" border-radius: 2px !important; padding: 2px 8px !important; width: auto !important; font-size:18px;"><?php if($myCurrPosition>0){ echo ($myCurrPosition)-1;} else { echo $myCurrPosition; } ?></strong><br class="clear"></li>


        </ul>


         </div>


    </div>


    <?php } ?>


	


	<?php if($userInfo[0]['userType']=="ADMIN"){ ?>


		<!--<div class="webbox">


			<p class="web"> <span>My Sign Up of Founder Member Page :</span><a target="_blank" href="<?php echo base_url()."signupuser_signupFounder/".$userInfo[0]["userName"];?>" ><?php echo base_url()."signupuser_signupFounder/".$userInfo[0]["userName"];?></a> </p>


		</div>


		<div class="webbox">


			<p class="web"> <span>My Sign Up of Industry Leader Page :</span><a target="_blank" href="<?php echo base_url()."signupuser_signupLeader/".$userInfo[0]["userName"];?>" ><?php echo base_url()."signupuser_signupLeader/".$userInfo[0]["userName"];?></a> </p>


		</div>-->


		<div class="webbox">


			<p class="web"> <span>Copy & Share this link - Get Sign Ups :</span><a target="_blank" href="<?php echo base_url()."signupuser_signupGuest/".$userInfo[0]["userName"];?>" ><?php echo base_url()."signupuser_signupGuest/".$userInfo[0]["userName"];?></a> </p>


		</div>


	<?php } else if($userInfo[0]['userType']=="FOUNDERS" || $userInfo[0]['userType']=="INDUSTRY LEADER"){?>


		<!--<div class="webbox">


			<p class="web"> <span>My Sign Up of Industry Leader Page :</span><a target="_blank" href="<?php echo base_url()."signupuser_signupLeader/".$userInfo[0]["userName"];?>" ><?php echo base_url()."signupuser_signupLeader/".$userInfo[0]["userName"];?></a> </p>


		</div>-->


		<div class="webbox">


			<p class="web"> <span>Copy & Share this link - Get Sign Ups :</span><a target="_blank" href="<?php echo base_url()."signupuser_signupGuest/".$userInfo[0]["userName"];?>" ><?php echo base_url()."signupuser_signupGuest/".$userInfo[0]["userName"];?></a> </p>


		</div>


	<?php } ?>


	<?php if($userInfo[0]['userType']=="PAYING USER"){ ?>


		<div class="webbox">


			<p class="web"> <span>Copy & Share this link - Get Sign Ups :</span><a target="_blank" href="<?php echo base_url()."signupuser_signupGuest/".$userInfo[0]["userName"];?>" ><?php echo base_url()."signupuser_signupGuest/".$userInfo[0]["userName"];?></a> </p>


		</div>


	<?php } ?>

	<div class="techsupporttab"><ul><li class="sm002"> <a id="serviceList_2" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Tech Support </a>
          <div id="slist_2" class="list_service">
            <form method="post" action="<?php echo base_url();?>dashboard/tech_support">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
				<tr>
                <td><label for="textarea">Message:</label></td>                   
                  </tr>
                  <tr>                  
                    <td><textarea rows="5" cols="31" id="techSupportMsg" class="custMessageClass" name="message"></textarea></td>
                  </tr>
                  <tr>                    
                    <td>
					<input type="hidden" name="supportResuestUserId" id="supportResuestUserId" value="<?php echo $userInfo[0]['uID']; ?>"> <input type="submit" value="Submit" id="techSupportSubmit" name="techSupportSubmit" onclick="return checkEmailMessage('techSupportMsg')"></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
        </li>
		</ul>
		</div>
	


	<div class="webbox invite" style="content:inherit; box-shadow:none; background:none;"><p class="web vipentrace-button" style="background: #782678;  border: 2px solid #48941f;  color: #fff; font-size: 17px;  font-weight: bold; text-align: center; margin-top: 34px; border-radius:10px; font-family: 'Roboto', helveti; height:36px; width:258px; content:inherit;"><a href="<?php echo base_url(); ?>message" style="color:#fff;" > Invite Your Guests <br />


& Team Members</a></p></div>


        <!-- <div class="webbox">


        <p class="web">  <a  href="<?php echo base_url();?>message"><span> V.I.P Entrance For My True 12 </span></a></p>


        </div>


	   <br class="clear" />-->


	


    


	


	<!--<a href="#" class="top_btn href">-->


    


      <div class="webbox redtop juu" id="catPurchaseId">	   


        <?php if($userInfo[0]["afrooPaymentStatus"]==0){


		?>


		<p><a onClick="purchaseCatalog()"> Purchase Catalogue</a></p>	


		<?php }


				else{?>


				<p style="line-height:28px;"><a href="<?php echo base_url(); ?>myaccount" style="color:#4f3a4f;">My Wallet</a></p>


				<?php } 


				?>


        <br class="clear">


       


      </div>


      <!--</a>-->


	  <a href="<?php echo base_url(); ?>myaccount" class="top_btn href"><div class="webbox redtop juu" id="walletId" style="display:none;">


	  <p> My Wallet</p>


	  <br class="clear">


      </div></a>


	  <div class="webbox">


        <p class="web"><?php echo $this->session->userdata('emailId'); ?></p>        


      </div>
	  <?php if($this->session->userdata('userType')=="ADMIN"){ ?>
		<p class="activeuser"><a href="<?php echo base_url(); ?>allUserList" target="blank">Active User List</a></p>
<?php } ?>

	  


	  <?php if($userInfo[0]['userLevel']==1){ ?>


    <!--<div style="" class="webbox1">


        <div class="upl_form web"><span>Add User</span>


            <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>dashboard/inviteUser" id="prd_upld">


            <p>


              <label>E-mail</label>


              <input type="text" id="userEmail" name="userEmail">


            </p>


           


            <p>


                <input type="submit" value="Submit" id="sendInvitation" name="sendInvitation">


            </p>


          


          </form>


        </div>


      </div>


	  


	  <div style="" class="webbox1">


        <div class="upl_form web"><span>Add Group User</span>


            <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>dashboard/inviteGroupUser" id="prd_upld">


            <p>


              <label>Username</label>


              <input type="text" id="groupUserName" name="groupUserName" placeholder="please enter name eg. abc,aaa">


            </p>


           


            <p>


                <input type="submit" value="Submit" id="sendGroupInvitation" name="sendGroupInvitation">


            </p>


          


          </form>


        </div>


      </div> -->


	  <?php } ?>


	<?php   // if(count($catPurDueUser)>0 && $userInfo[0]["afrooPaymentStatus"]==1){ ?>


	<!--<div id="groupPurchaseDiv">


	  <a href="#" onClick="groupPurchaseCatalog()" class="top_btn href"><div class="webbox redtop juu" >


	  <p> Group User Purchase Catalogue</p>


	  <br class="clear">


      </div></a>


	  </div>-->


	<?php // } ?>


      <?php // if(count($moveUpUser)>0 && $userInfo[0]["userLevel"]==2){ ?>


	<!--<div id="groupMoveUpDiv">


	  <a href="#" onClick="groupMoveUp()" class="top_btn href"><div class="webbox redtop juu" >


	  <p> Group User Level Up Process</p>


	  <br class="clear">


      </div></a>


	  </div>-->


	<?php // } ?>


	<?php  //if(count($moveUpUser)>0 && ($userInfo[0]["userLevel"]==3 || $userInfo[0]["userLevel"]==4 || $userInfo[0]["userLevel"]==5)){ ?>


	<!--<div id="groupMoveUpDiv<?php echo $userInfo[0]["userLevel"]; ?>">


	  <a href="#" onClick="groupMoveUp3(<?php echo $userInfo[0]["userLevel"]; ?>)" class="top_btn href"><div class="webbox redtop juu" >


	  <p> Group User Level Up Process</p>


	  <br class="clear">


      </div></a>


	  </div>-->


	<?php //} ?>


	


	<div id="loading"><img src='<?php echo base_url();?>images/loading.gif' /></div>


	


  </div>


  <script type="text/javascript">


 function purchaseCatalog(){


	 //alert('You want to purchase catalog now?');


	// alert(retEmail);


	 


			$.ajax({


			 type: "POST",


			 url:  "<?php echo base_url();?>dashboard/cataloguePurchase", 


			 data: "payment=1",


			 cache:false,


			 dataType: "json",


			 beforeSend: function() {


				$('#loading').show();  // show loading indicator


			  },


			 success: 


				  function(data){


				   //alert(data);  //as a debugging message	


					$('#loading').hide();  // hide loading indicator


					if(data.success == "yes")


					{	


						


						alert(data.message);


						//$.fancybox.open(data.message);


						$('#contentId').html('');


						$('#catPurchaseId').css('display','none');


						$('#walletId').css('display','block');


					}


					else{


						//$.fancybox.open(data.message);


						alert(data.message);


					} 


				  }


			  });


		


			


 }





 function groupPurchaseCatalog(){


	 //alert('You want to purchase catalog now?');


	// alert(retEmail);


	 //$('#loading').show();  // show loading indicator


			$.ajax({


			 type: "POST",


			 url:  "<?php echo base_url();?>dashboard/groupCataloguePurchase", 


			 data: "payment=1",


			 cache:false,


			 dataType: "json",


			 beforeSend: function() {


				$('#loading').show();  // show loading indicator


			  },


			 success: 


				  function(data){


				   //alert(data);  //as a debugging message	


					$('#loading').hide();  // hide loading indicator				   


					if(data.success == "yes")


					{	


				





						alert(data.message);


						//$.fancybox.open(data.message);


						//$('#contentId').html('');


						$('#groupPurchaseDiv').css('display','none');


						//$('#walletId').css('display','block');


					}


					else{


						//$.fancybox.open(data.message);


						alert(data.message);


					} 


				  }


			  });


		


			


 }


 function groupMoveUp(){


	 //alert('You want to purchase catalog now?');


	// alert(retEmail);


	 


			$.ajax({


			 type: "POST",


			 url:  "<?php echo base_url();?>dashboard/moveUpTonextLevel", 


			 data: "payment=1&group=1",


			 cache:false,


			 dataType: "json",


			 beforeSend: function() {


				$('#loading').show();  // show loading indicator


			  },


			 success: 


				  function(data){


				   //alert(data);  //as a debugging message	


					$('#loading').hide();  // hide loading indicator				   


					if(data.success == "yes")


					{	


						alert(data.message);						


						$('#groupMoveUpDiv').css('display','none');


						//$('#walletId').css('display','block');


					}


					else{


						//$.fancybox.open(data.message);


						alert(data.message);


					} 


				  }


			  });


		


			


 }


 


  function groupMoveUp3(levelId){


	 //alert('You want to purchase catalog now?');


	// alert(retEmail);


	 


			$.ajax({


			 type: "POST",


			 url:  "<?php echo base_url();?>dashboard/moveUpTonextLevel"+levelId, 


			 data: "payment=1&group=1",


			 cache:false,


			 dataType: "json",


			 beforeSend: function() {


				$('#loading').show();  // show loading indicator


			  },


			 success: 


				  function(data){


				   //alert(data);  //as a debugging message	


					$('#loading').hide();  // hide loading indicator				   


					if(data.success == "yes")


					{	


						


						alert(data.message);						


						$('#groupMoveUpDiv'+levelId).css('display','none');


						//$('#walletId').css('display','block');


					}


					else{


						//$.fancybox.open(data.message);


						alert(data.message);


					} 


				  }


			  });


		


			


 }


 


 


 jQuery(document).ready(function($){


	 $('#loading').hide();
	 


 });
 
 function funToggleSupport(id){
    //$(".list_service").hide();
    var myArray = id.split('_');
    $("#slist_"+myArray[1]).slideToggle();
    
}
function checkEmailMessage(msgID){
    var formMsg = "";
    var emailReg = 2;
    var toFocus = 1;
    
    var sMsg = $("#"+msgID).val();
    
	//alert(sEmail);
	//alert(sMsg);
	//alert(formMsg);
	//alert(toFocus);
   
   if(sMsg == ""){
        formMsg = "Please enter the Message.";
        toFocus = 2;
    }
    if(formMsg == ""){
        return true;
    }else{
        $.fancybox.open(formMsg);
         if(toFocus == 2){
            $("#"+msgID).focus();
        }
        return false;
    }
    
}

</script>