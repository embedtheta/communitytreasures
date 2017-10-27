<?php $this->load->view("header_vip", "", $result); ?>



<meta name="viewport" content="width=device-width">

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>

<!--<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>-->
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

	  $('#loading').hide();

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

	

	<?php if($totalUserUnderMassUser >= 12){?>//this shoule be 5

	$.fancybox.open('<div class="switch"><h3 style="text-align:center;">Congratulations <br>You have enough people qualify you to move up.</h3><h2 style="text-align:center;">Now you are in Level 2 .So you can make more money! Hurry up.</h2><div class="switch_extrapara"><p class="swt_img"><a href="<?php echo base_url();?>catalogue"><img width="567" height="81" style="cursor:pointer" alt="" src="<?php echo base_url();?>images/submit-paypal.png"></a></p></div></div>'); 

	<?php }?>

	

	//$.fancybox.open('<div class="success-msgg"><b>Success!</b> You have successfully send Login details for the MASS user</div>');

	 <?php /* if ($status=="success") { ?>

        $.fancybox.open('<div class="success-msgg"><b>Success!</b><?php echo $msg; ?></div>');

    <?php } */ ?>

	<?php if ($status=="error") { ?>

        $.fancybox.open('<div class="success-error-vip"><p><b>Error! </b><?php echo $msg; ?></p><?php echo form_error('name', '<span class="form_error">', '</span><br>'); ?><?php echo form_error('emailAddr', '<span class="form_error">', '</span><br>'); ?><?php echo form_error('category', '<span class="form_error">', '</span><br>'); ?><?php echo form_error('country', '<span class="form_error">', '</span><br>'); ?><?php echo form_error('message', '<span class="form_error">', '</span><br>'); ?></div>');

    <?php } ?>

	

 });

 

 function showAlert(){

	 var msg = "You can send 12 request on each Level.";

	 $.fancybox.open(msg);

     return false;

 }

 

 /* function checkCity(){

	 if($("#city").val()==""){

		 var msg = "Please Select City.";

		$.fancybox.open(msg);

		 return false; 

	 }

 } */

/* function ShowMailMsgDiv(){

	 $('#mailDivId').css('display','block');

	 //alert('mail User ');

 } */

 function sendMailInvi(userId){

	// alert('mail User ');	

	

	$.ajax({

			 type: "POST",

			 url:  "<?php echo base_url();?>message/sendMailInvitation", 

			 data: "userId="+userId,

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

						//alert(data.message);

						$.fancybox.open(data.message);

						

					}

					else{

						//$.fancybox.open(data.message);

						alert(data.message);

					} 

				  }

			  });

		

 }

 

 function mailResend(userId,uType,uName,uEmail){

	// alert('mail User ');	

	

	$.ajax({

			 type: "POST",

			 url:  "<?php echo base_url();?>message/reSendMail", 

			 data: "userId="+userId+"&uType="+uType+"&uName="+uName+"&uEmail="+uEmail,

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

						//alert(data.message);

						$.fancybox.open(data.message);

						

					}

					else{

						//$.fancybox.open(data.message);

						alert(data.message);

					} 

				  }

			  });

		

 }

function reSendInvitationMail(referrerId,userId,uType,uName,uEmail){

 var request = $.ajax({
  url: "<?php echo base_url();?>message/reSendInvitationMail",
  method: "POST",
  data: "referrerId="+referrerId+"&userId="+userId+"&uType="+uType+"&uName="+uName+"&uEmail="+uEmail,
  dataType: "json"
});
 
request.done(function( data ) {

	$('#loading').hide();  // hide loading indicator				   

					if(data.success == "yes")

					{	

						//alert(data.message);

						$.fancybox.open(data.message);

						

					}

					else{

						//$.fancybox.open(data.message);

						alert(data.message);

					} 

});
 
request.fail(function( jqXHR, textStatus ) {
  alert( "Request failed: " + textStatus );
});

 }
function reSendInvitationMailA(referrerId,userId,uType,uName,uEmail){

	// alert('mail User ');	

	

	$.ajax({

			 type: "POST",

			 url:  "<?php echo base_url();?>message/reSendInvitationMail", 

			 data: "referrerId="+referrerId+"userId="+userId+"&uType="+uType+"&uName="+uName+"&uEmail="+uEmail,

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

						//alert(data.message);

						$.fancybox.open(data.message);

						

					}

					else{

						//$.fancybox.open(data.message);

						alert(data.message);

					} 

				  }

			  });

		

 }
</script>

<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />

<script>

$(document).ready(function(){ 

	

	$("#videoLinkId01").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#videoLinkId02").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#videoLinkId03").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#videoLinkId04").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});
	
	$('.close_btn_level').click(function(){
	 	$('.ppup_level').remove();
		
	 });

});

</script>
<?php  if ($status=="success") { ?>
<div class="ppup_level" style="padding-top:10px;">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_level" title="Close"></a>
<h2 style="font:normal 25px Arial, Helvetica, sans-serif; color:#a511f0; text-transform:none;"><br>
You have successfully invited your Guest<br>
to join The Queue inside Community Treasures.</h2>
<p style="font:normal 20px Arial, Helvetica, sans-serif; color:#07237d; text-transform:none;">
If your guest doest not recieve an email from us within 24hrs<br>
please contact them and advice them to check<br>
the spam box in their email account.<br>
</p><br>
<p style="font:normal 20px Arial, Helvetica, sans-serif; color:#07237d; text-transform:none;">
If your guest is still unable to locate their invite email,<br>
please click the 'Resend' button which can be found<br>
beside your guests details on the right of this page.<br>
</p><br>
<p class="simplebuildgry" style="font:normal 25px Arial, Helvetica, sans-serif; color:#a511f0;">KEEP BUILDING YOUR CT BUSINESS<br>
BY INVITING MORE GUESTS<br />
</p><br />
<p style="font:normal 20px Arial, Helvetica, sans-serif; color:#07237d; text-transform:none;">The More People You Invite<br>
The More Successful You Will Be When We Launch.<br>
Happy Hunting.</p>
</div><br class="clear" />
</div>

</div>
<?php } ?>


<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>

</head>

<body>



<div class="wrapper">

 

   

    <div class="nav">

      <nav class="secondary">

        <ul class="misc_new">

	<?php	

	if($mssPayStatus==0){

		?>

           <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="javascript:void(0)" id="gbeLevel1"><span class="level">Q 1 - <i>Open</i></span>Advertizer</a></li>

	<?php	}

		else

		{

			?><li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Q 1 - <i>Open</i></span> Advertizer</a></li>

	<?php }

?>

          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] > 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Q 2 - <i>Open</i></span> Catalogue</a> </li>



          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] > 2){ echo base_url()."source";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Q 3 - <i>Open</i></span> Lifestyle</a></li>



          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo base_url()."regeneration";}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Q 4 - <i>Open</i></span> Co-Operatives</a></li>



          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] > 4){ echo base_url()."franchise";}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Q 5 - <i>Open</i></span>Vacation Club</a></li>



		

          

        </ul>

      </nav>

      <div class="clear"></div>

    </div>

 

  <!--header end-->

  

  <div class="main_container">

  

   <div class="white-bg">

      <div class="mms_page">

      <div class="watch_video_com_trs"><h2 style="color:#9ba3b3;">Welcome To <?php echo $userInfo[0]["firstName"];?> <?php echo $userInfo[0]["lastName"];?> V.I.P Suite 
     
      <span style="color: #f70c14; display: block; font-size: 36px; padding-top: 15px;">Watch This Video</span>

      </h2>

      	<div class="watch_video_com_trs_inr" style="width:100%; background:none;"><a id="videoLinkId04" name="https://www.youtube.com/embed/OZV1b_Twi-c" >

        <!--Watch this Video-->

        <img src="<?php echo base_url();?>images/CT_Vip2.png" width="450"></a></div>

      </div>       

      

      <div class="fm_mss newviptab">

	  <a id="videoLinkId03" name="https://www.youtube.com/embed/GZ6_f7N7VPw">

      <img src="<?php echo base_url();?>images/watch-videothum.png"></a>

      <div class="right-vipcomp">

      <h2>VIP - GET PAID TO QUEUE</h2>

      <h3>Compensation Plan</h3>

      <img src="<?php echo base_url();?>images/jointab.png">

     

      </div> <br class="clr"/>

      </div>

      <div class="fm_mss newviptab">

	  <a id="videoLinkId02" name="https://www.youtube.com/embed/Tse52gr7jxI">

      <img src="<?php echo base_url();?>images/watch-videothum.png"></a>

      <div class="right-vipcomp">

      <h2>PREPARE FOR THE LAUNCH</h2>

      <h3>Invite Your Team</h3>

      <img src="<?php echo base_url();?>images/jointab.png">

     

      </div>

       <br class="clr"/>

      </div>
        <div class="adc">  <?php if($userType == "ADMIN"):?>

          <p class="super-admintext">You Are Super Admin</p>

          <?php else:?>

          <!--<p>You Are Currently On Level - <?php //if($userInfo[0]['userLevel']< 5) { echo $userInfo[0]['userLevel']+1;} else {  echo $userInfo[0]['userLevel']; }?></p>-->

		  <p>You Are Currently On Level - <?php if($userInfo[0]['userLevel']== 0) { echo $userInfo[0]['userLevel']+1;} else {  echo $userInfo[0]['userLevel']; }?></p>

          <?php endif;?>

        </div>

        <?php if($sendMassUserCount == 0 && $sendMassUserLevel == 0 ){?>

        <div class="fm_mss">

          <h3>Send An Invite To Your Team Members</h3>

          <!--<h3>MSS Invititation</h3>-->

          <?php //if($status == "error"):?>

          <!--<div class="global-msg-<?php// echo $status;?>"><?php //echo $msg;?></div>-->

          <?php //endif;?>

          <form action="" method="post">

          <input type="hidden" name="userLevel" value="<?php echo $userInfo[0]['userLevel'];?>">

		  <p style="float:none; width:100%; overflow:hidden; padding:10px 0;"><label style="float: left; margin: 0; width: 100px;">User Type : </label>

		 <?php  if ($userType=="ADMIN"){ ?>

		  

			 <span class="radio-tab1"><input type="radio" name="userType" id="userTypeF"  value="Founder"> Founder</span>

			 <span class="radio-tab1"> <input type="radio" name="userType" id="userTypeIL" value="Industry_Leader"> Leader</span>

			 <span class="radio-tab1"><input type="radio" name="userType" id="userTypeG" checked="checked" value="General"> Guest</span>

		 		  

		  <?php } else if ($userType=="FOUNDERS" || $userType=="INDUSTRY LEADER"){ ?>

		 

			  <input type="radio" name="userType" id="userTypeIL" value="Industry_Leader">Leader

			  <input type="radio" name="userType" id="userTypeG" checked="checked" value="General"> Guest

		  

		  <?php } else if ($userType=="PAYING USER"){?>

		 

			  <input type="radio" name="userType" id="userTypeG" checked="checked" value="General"> Guest

		  <?php } ?>

		  </p>

		  

            <p style="clear:both;">

              <label>First Name</label>

              <input name="name" type="text" value="<?php echo $_POST['name']; ?>">

              <?php //echo form_error('name', '<span class="form_error">', '</span>'); ?>

            </p>

            <p>

              <label>Last Name</label>

              <input name="surname" type="text" value="<?php echo $_POST['surname']; ?>">

            </p>

            <p>

              <label>E-mail</label>

              <input name="emailAddr" value="<?php echo $_POST['emailAddr']; ?>" type="text" >

         <?php //echo form_error('emailAddr', '<span class="form_error">', '</span>'); ?>

            </p>

            

            <!--<p>

              <label>Skype</label>

              <input name="skypeID" type="text">

            </p>-->

            

            <!--<p>

              <label>Contact Number</label>

              <input name="phone" type="text">

            </p>-->

			 <p style="margin-right: 4px; width: 49%;">

              <label>Category</label>

			 

              <select name="category" id="category">

			   <option value="">Select Category </option>

			   <?php if(count($category)>0){ 

					foreach($category as $categories){ 

				?>

			   <option value="<?php echo $categories->id; ?>"><?php echo $categories->title;?></option>

			   <?php } 

			   }

			   ?>

			   </select>

			    <?php //echo form_error('category', '<span class="form_error">', '</span>'); ?>

            </p>

            <p style="width:49.9%;">

            

              <label>Country</label>     

              <select name="country" id="country">

			  <option value="" <?php echo $disabled;?>>Select Country </option>

			   <?php 

					if(count($country) > 0): 

						foreach($country as $countryDetail): 

							

				?>

              <option value="<?php echo $countryDetail['country_id']; ?>"><?php echo $countryDetail['name']; ?></option>

               <?php endforeach;endif;?>

			  </select>

             

              <?php // echo form_error('country', '<span class="form_error">', '</span>'); ?>

            </p> 

            <!--<p style="width:49.9%;">

            

              <label>City</label>

              <?php if($userType == "ADMIN"):?>

              <select name="city" id="city">

                <option value="" <?php echo $disabled;?>>Select City </option>

                <?php 

					if(count($city) > 0): 

						foreach($city as $vc): 

							

				?>

                <option value="<?php echo $vc->id?>"><?php echo $vc->city?></option>

                <?php endforeach;endif;?>

              </select>

              <?php else:?>

              <select name="city">

              <option value="<?php echo $userInfo[0]['city_id']?>" selected><?php echo $userInfo[0]['cityName']?></option>

              </select>

              <?php endif;?>

              <?php //echo form_error('city', '<span class="form_error">', '</span>'); ?>

            </p> -->

            <!--<p>

              <label>Zip</label>

              <input name="zip" type="text">

            </p>-->

            

            <div class="clear"></div>

           <div class="mgs"><label>Message</label>

            	<textarea name="message"><?php echo $_POST['message']; ?></textarea>

                <?php // echo form_error('message', '<span class="form_error">', '</span>'); ?>

                </div>

            

            <!--<p><label>Zip Code</label><input name="" type="text"></p>-->

            <input name="submit" type="submit" value="send" <?php if($sendMassUserCount == 5){?> onClick="return showAlert();"<?php } else {?> onClick="return checkCity();" <?php } ?> > <input name="" type="reset" value="reset"><div class="clear"></div>

           

          </form>

        </div>

        <?php }?>

        <div class="tgg_sec"> 
                     <?php
/*echo "<pre>";
print_r($userPaymentStatus);
echo "</pre>";*/
					   if(!count($userPaymentStatus)){
					   	?>
       
        	<?php

					
					   if(!count($userPaymentStatus)){
					   	$referarID = $userInfo[0]['referarID'];
					   	$uID = $userInfo[0]['uID'];
					   	//signUpPaymentLink
                        ?>

                    <!--  <div class="statusbx" style="border: 1px solid red; width:100%; height:50px; background-color:yellow;margin-bottom:5px; fot-weight:bold;">    

 </div>-->
                         <?php } ?>
                    

        

       
        <?php } ?>

         <?php if($userType == 'ADMIN' || $userType == 'FOUNDERS' || $userType == 'INDUSTRY LEADER' || $userType == 'PAYING USER'):?>

            <?php //if(count($massDetails[$userInfo[0]['uID']]) > 0):
                  if(count($massDetails) > 0):
                  /*	echo "<pre>";
                  print_r($massDetails);
                  echo "</pre>";*/
                 /* echo "<pre>";
                  print_r($userPaymentStatus);
                  echo "</pre>";*/
                  
             ?>

            <!--<span><a href="javascript:void(0);" onClick="ShowMailMsgDiv()" class="send-mailbutton">Send Mail</a></span>-->

			<!--<span><a href="javascript:void(0);" onClick="sendMailInvi(<?php echo $userInfo[0]['uID']; ?>)" class="send-mailbutton">Activate Launch</a></span>-->

			<a class="mbr_cnt">members counter</a>

          		<ul id="toggle-view">

                	<?php //foreach($massDetails[$userInfo[0]['uID']] as $k => $vk): ?>
<?php foreach($massDetails as $k1 => $vk1){ 
foreach($vk1 as $k2 => $vk2){
	foreach($vk2 as $k => $vk){
	/*echo "<pre>";
                  print_r($vk);
                  echo "</pre>";*/
/*echo "<pre>";
                  print_r($vk['currentPaymentstatus']);
                  echo "</pre>";*/

	?>
            		<li class="">

                    	<div class="li_dve_in">

                        	<span class="pls ulLevel1" id="<?php echo $vk['user_id'];?>" name="<?php echo count($massDetails[$k]);?>">+</span>

                        

                        

                        <a href="javascript:void(0)">
                        <strong><?php echo $vk['cuFName'];?> <?php echo $vk['cuLName'];?></strong> 
                        </a>
                        <strong>
                        <?php echo $vk['cuPhone'];?>  | <?php echo $vk['cuEmail'];?>  |  <?php if($vk['created_date']!=""){echo date("d-m-Y",strtotime($vk['created_date']));}else {echo "--";}?>  |  <?php echo $vk['city'];?> 
                        </strong>
                        <?php if($vk['afrooPaymentStatus']==0){?> 
                      
                        <?php } 
                          if(count($userPaymentStatus)){
                          	if(count($vk['currentPaymentstatus'])>0){
                          		
                          		?>
 <a class="snt_ml"> <img src="<?php echo base_url();?>images/Paid.jpg" width="30" height="30" title="payment done"/></a>
                          		<?php
                          	}
                          	else
                          	{
                          		?>
                          		 <a class="snt_ml" onClick="reSendInvitationMail(<?php echo $_SESSION['userId']; ?>,<?php echo $vk['user_id'];?>,'<?php echo $vk['userType'];?>','<?php echo $vk['cuFName'];?>','<?php echo $vk['cuEmail'];?>')" > <img src="<?php echo base_url();?>images/resend.png" width="30" height="30" title="Resend Invitation"/></a>
                          		<?php

                          	}
                        ?>

                        
                         <?php } ?>
                        <h4><?php echo count($massDetails[$k]);?></h4><br class="clear">

             </div>

              

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

            		

                    <?php 
                  }
                }
                    } ?>

          		</ul>

                 

          	<?php else: ?>

          	No Mass user please..

         	<?php endif;?>

         <?php else:?>

         	You have no permission to view your Mass system user. When you will be Level 2 Then You can see your mass user.<br>

			Now you can send only request..

         <?php endif;?>

          

        </div>

      </div>

    </div>

    <br class="clear">

  </div>

 <div id="loading"><img src='<?php echo base_url();?>images/loading.gif' /></div>

</div>



<!--<div id="mailDivId" style="display:none;"> <form id="mailFrm" method="post" action="" >

	<h3>Send Joining Request</h3>

	<p><label>New User</label><input type="radio" name="mailFor" id="mailForNew" value="1">

	<label>All User</label><input type="radio" name="mailFor" id="mailForAll" value="0" ></p>

    <p><label>Message</label>

       	<textarea name="mailMessage" id="mailMessage"></textarea>

            <?php //echo form_error('message', '<span class="form_error">', '</span>'); ?>

    </p>

	<p><input type="button" value="Send Mail" id="sendMailRequest" onClick="sendMailInvi(<?php //echo $userInfo[0]['uID'];?>);" name="sendMailRequest" ></p></form>

</div>-->

<style>

.wtch_vio {

  background: #9a0e18 none repeat scroll 0 0;

  float: left;

  width: 24%; text-align:center;

}

.flw_ibst > p {

  text-align: center;

}

</style>



<script type="text/javascript">

var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;

var formSubmitMsg = "<?php echo $msg;?>";

var formSubmitType = "<?php echo $type;?>";



</script> 

<script type='text/javascript' src='<?php echo base_url();?>js/custom_common.js'></script>

<!--

</body>

</html-->

