<?php $this->load->view("header", "", $result); ?>

<script type="text/javascript">
function catalogPayment(id){
	var paymentStatus = '<?php echo $userInfo[0]["afrooPaymentStatus"];?>';
	if(paymentStatus == '1'){
		$.fancybox.open('You have allready bought the Afrowebb Catalogue.So please continue.');
	}else{
		window.location.href='<?php echo base_url();?>gbe_payment/catalog/'+id;	
		return true;
	}
}
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>js/custom_common.js'></script>
<style type="text/css">
table td {
	width:auto !important;
	max-width:none !important;
}
table td {
	width:auto !important;
	max-width:none !important;
}
.tabdaysworked, .tabreferrals, .tabreferralsdetails {
	width: 292px !important;
}
.tabentrancelvl {
	width: 327px !important;
}
.start-newcycle {
	background: #258f0d;
	color: #fff;
	display: block;
	float: left;
	font-size: 21px;
	height: 45px;
	line-height: 21px;
	margin-top: 20px;
	padding: 16px;
	text-align: center;
	width: 180px;
}
.start-newcycleexit {
	background: #9c0b0d;
	color: #fff;
	display: block;
	float: left;
	font-size: 21px;
	height: 45px;
	line-height: 21px;
	margin-left: 40px;
	margin-top: 20px;
	padding: 16px;
	text-align: center;
	width: 180px;
	position:inherit;
}
.clear {
	clear:both;
	line-height:0;
	font-size:0;
}
.newcycle-popup {
	background: #fff none repeat scroll 0 0;
	border: 2px solid #939393;
	border-radius: 5px;
	color: #414141;
	display: none;
	font: 17px/22px Arial, Helvetica, sans-serif;
	left: 20%;
	padding: 40px 20px;
	position: absolute;
	text-align: center;
	top: 40%;
	width: 780px;
	z-index: 999;
}
span.closee {/* background: #fff none repeat scroll 0 0;
    border: 1px solid #5c5c5c;*/
	border-radius: 30px;
	color: #cf1111;
	height: 11px;
	margin-top: -40px;
	padding: 5px;
	position: absolute;
	right: 4px;
	width: 12px;
	cursor:pointer;
}
.raveshare .lefts_side .table-status table th, td {
	border: 1px solid #999999 !important;
	vertical-align: middle !important;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover{color:#fff !important;}
</style>
<script type="text/javascript">

//var userLevel  = <?php if($userInfo[0]['userLevel']>0) {echo $userInfo[0]['userLevel'].";";} else { echo "".";"; } ?>
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";
jQuery(document).ready(function($){	

 $('#auth_sub65').click(function(){
	 
	 var auth_code= $("#auth_code65").val();
	 
		if(auth_code == "")
		{
			$("#error_auth_code").html("Please put your authentication code");
			$("#error_auth_code").css("color","red");
			window.location.href="<?php echo base_url();?>myaccount/";
		}
		else
		{
			var id = $("#loged_uID").val();
			$.ajax({
			type: "POST",
			 url:  "<?php echo base_url();?>myaccount/update_flag", 
			 data: { user_id: id, ac:auth_code, position: '65' },
			 success:function(data){
				 
				 if(data== 0)
				 {
					$("#error_auth_code").html("Authentication code is not match, please reenter.");
					$("#error_auth_code").css("color","red");
					window.location.href="<?php echo base_url();?>myaccount/";
				 }
				 else
				 {
					 
					$('.ppup_level').remove();
				 }
				}
			  });
		}
 });
 
 $('#auth_sub320').click(function(){
	 var auth_code= $("#auth_code320").val();
	 
		if(auth_code == "")
		{
			$("#error_auth_code").html("Please put your authentication code");
			$("#error_auth_code").css("color","red");
			window.location.href="<?php echo base_url();?>myaccount/";
		}
		else
		{
			var id = $("#loged_uID").val();
			$.ajax({
			type: "POST",
			 url:  "<?php echo base_url();?>myaccount/update_flag", 
			 data: { user_id: id,ac:auth_code, position: '320' },
			 success:function(data){
				 if(data== 0)
				 {
					$("#error_auth_code").html("Authentication code is not match, please reenter.");
					$("#error_auth_code").css("color","red");
					window.location.href="<?php echo base_url();?>myaccount/";
				 }
				 else
				 {
					 
					$('.ppup_level').remove();
				 }
				}
			  });
		}
 });
	
$('#auth_sub577').click(function(){
	 var auth_code= $("#auth_code577").val();
	 
		if(auth_code == "")
		{
			$("#error_auth_code").html("Please put your authentication code");
			$("#error_auth_code").css("color","red");
			window.location.href="<?php echo base_url();?>myaccount/";
		}
		else
		{
			var id = $("#loged_uID").val();
			$.ajax({
			type: "POST",
			 url:  "<?php echo base_url();?>myaccount/update_flag", 
			 data: { user_id: id,ac:auth_code, position: '577' },
			 success:function(data){
				 if(data== 0)
				 {
					$("#error_auth_code").html("Authentication code is not match, please reenter.");
					$("#error_auth_code").css("color","red");
					window.location.href="<?php echo base_url();?>myaccount/";
				 }
				 else
				 {
					 
					$('.ppup_level').remove();
				 }
				}
			  });
		}
 });
 
 $('#auth_sub834').click(function(){
	 var auth_code= $("#auth_code834").val();
	
		if(auth_code == "")
		{
			$("#error_auth_code").html("Please put your authentication code");
			$("#error_auth_code").css("color","red");
			window.location.href="<?php echo base_url();?>myaccount/";
		}
		else
		{
			var id = $("#loged_uID").val();
			$.ajax({
			type: "POST",
			 url:  "<?php echo base_url();?>myaccount/update_flag", 
			 data: { user_id: id,ac:auth_code, position: '834' },
			 success:function(data){
				 if(data== 0)
				 {
					$("#error_auth_code").html("Authentication code is not match, please reenter.");
					$("#error_auth_code").css("color","red");
					window.location.href="<?php echo base_url();?>myaccount/";
				 }
				 else
				 {
					 
					$('.ppup_level').remove();
				 }
				}
			  });
		}
 });
 $('.close_btn_level').click(function(){
	var id = $("#loged_uID").val();
	
	var auth_code = $("#auth_code65").val();
		if(auth_code == "")
		{
			$("#error_auth_code").html("Please put your authentication code");
			$("#error_auth_code").css("color","red");
			window.location.href="<?php echo base_url();?>myaccount/";
		}
		/*else{
				$.ajax({
				type: "POST",
				 url:  "<?php echo base_url();?>Myaccount/update_flag", 
				 data: { user_id: id,ac:auth_code, position: '65' },
				 success:function(data){
						//alert(data)
							$('.ppup_level').remove();
						}
				  });
			}*/
	 }); 

$('.close_btn_levelq1').click(function(){
	var id = $("#loged_uID").val();
	var auth_code = $("#auth_code320").val();
		if(auth_code == "")
		{
			$("#error_auth_code").html("Please put your authentication code");
			$("#error_auth_code").css("color","red");
			window.location.href="<?php echo base_url();?>myaccount/";
		}
		/*else{	
				$.ajax({
				type: "POST",
				 url:  "<?php echo base_url();?>Myaccount/update_flag", 
				 data: { user_id: id,ac:auth_code, position: '320' },
				 success:function(data){
					 
						$('.ppup_levelq1').remove();
						}
				  });
			}*/
 }); 

	 $('.close_btn_levelq2').click(function(){
		var id = $("#loged_uID").val();
		var auth_code = $("#auth_code577").val();
		if(auth_code == "")
		{
			$("#error_auth_code").html("Please put your authentication code");
			$("#error_auth_code").css("color","red");
			window.location.href="<?php echo base_url();?>myaccount/";
		}
		/*else{
				$.ajax({
				type: "POST",
				 url:  "<?php echo base_url();?>Myaccount/update_flag", 
				 data: { user_id: id,ac:auth_code, position: '577' },
				 success:function(data){
					 
						$('.ppup_levelq2').remove();
						}
				  });

			}*/
	 });
	  $('.close_btn_levelq4').click(function(){
        var id = $("#loged_uID").val();
		var auth_code = $("#auth_code834").val();
		if(auth_code == "")
		{
			$("#error_auth_code").html("Please put your authentication code");
			$("#error_auth_code").css("color","red");
			window.location.href="<?php echo base_url();?>myaccount/";
		}
		/*else{
				$.ajax({
				type: "POST",
				 url:  "<?php echo base_url();?>Myaccount/update_flag", 
				 data: { user_id: id,ac:auth_code, position: '834' },
				 success:function(data){
					 
						$('.ppup_levelq4').remove();
						}
				  });
			}*/
	 }); 

	 // move up process
	  $("#moveUp").click(function(){
		alert('click'); 
		$.ajax({
		 type: "POST",
		 url:  "<?php echo base_url();?>dashboard/moveUpTonextLevel", 
		 data: "payment=1&group=0",
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
					$('.ppup_level').remove();
					alert(data.message);
					//$.fancybox.open(data.message);					
				}
				else{

					//$.fancybox.open(data.message);
					alert(data.message);
				} 
			  }
		  });
	 });
	 // move up process
	  $("#moveUp2").click(function(){

	//alert('click'); 
		$.ajax({
		 type: "POST",
		 url:  "<?php echo base_url();?>dashboard/moveUpTonextLevel3", 
		 data: "payment=1&group=0",
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

					$('.ppup_level').remove();
					alert(data.message);
					//$.fancybox.open(data.message);					
				}
				else{
					//$.fancybox.open(data.message);
					alert(data.message);
				} 
			  }
		  });
	 });
	 // move up process
	  $("#moveUp3").click(function(){
		alert('click'); 
		$.ajax({
		 type: "POST",
		 url:  "<?php echo base_url();?>dashboard/moveUpTonextLevel4", 
		 data: "payment=1&group=0",
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
					$('.ppup_level').remove();
					alert(data.message);
					//$.fancybox.open(data.message);					
				}
				else{
					//$.fancybox.open(data.message);
					alert(data.message);
				} 
			  }
		  });
	 });
	 // move up process
	  $("#moveUp4").click(function(){
		//alert('click'); 
		$.ajax({
		 type: "POST",
		 url:  "<?php echo base_url();?>dashboard/moveUpTonextLevel5", 
		 data: "payment=1&group=0",
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
					$('.ppup_level').remove();
					alert(data.message);
					//$.fancybox.open(data.message);					
				}
				else{
					//$.fancybox.open(data.message);
					alert(data.message);
				} 
			  }
		  });
	 });

	/*  $("#nxtCycleMsg").click(function(){
		alert('test message');

	 }); */

});
</script>
<?php
$myCurrPosition = $rs[$current_user_cycle]['myCurrPosition'];
$userLevel = $rs[$current_user_cycle]['userLevel'];
?>
<input type="hidden" id="myCurrPosition" value="<?php echo $myCurrPosition?>">
<script>
$(document).ready(function(){
$("#tutorial-video101").click(function() {
			//$.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/FfMlejARnvg"" frameborder="0" allowfullscreen></iframe>');
		 });
});
</script>
<input type="hidden" id="loged_uID" value="<?php echo $user_id ?>">
<?php
	 //print_r($referred_user_count);exit;
  if(!empty($referred_user_count['details'])){	
	if (array_key_exists("65",$referred_user_count['count']))	
		{		
  ?>		
				<div class="ppup_level" style="padding-top:10px;">
					<div class="ppup_inr" style="">
					<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_level" title="Close"></a>
						<!--<strong><h2>Congratulation!! You have earned </h2>Total Refferal Amount <span style="font-size:18px;color:blue"><b><i>$ <?php echo $val*15?></b></i></span><br> for <?php echo $val?> users whome you have referred, are moved up from level 1 to 2</strong><br><br>-->
						
						<img style="border: 2px solid #c5bda1; border-radius: 5px;" width="" height="" alt="" src="<?php echo base_url();?>images/referral_popup.jpg">
					</div>
						<br class="clear" />
								Authentication code: <input type="text" name="auth_code65" id="auth_code65" value="">
									<button class="auth_sub65" name="auth_sub65" id="auth_sub65">Submit</button><label id="error_auth_code"></label>	
						
					</div>
				</div>
			
<?php
			
	}
	if (array_key_exists("320",$referred_user_count['count']))
	{
?>		
		<div class="ppup_levelq1" style="padding-top:10px;">
			<div class="ppup_inr" style="">
			<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_levelq1" title="Close"></a>
				<!--<strong><h2>Congratulation!! You have earned </h2>Total Refferal Amount <span style="font-size:18px;color:blue"><b><i>$ <?php echo $val*30?></b></i></span><br> for <?php echo $val?> users whome you have referred, are moved up from level 2 to 3</strong><br><br>-->
				
				<img style="border: 2px solid #c5bda1; border-radius: 5px;" width="" height="" alt="" src="<?php echo base_url();?>images/referral_popup.jpg">
			</div>
				<br class="clear" />
				
				Authentication code: <input type="text" name="auth_code320" id="auth_code320">
						<input type="submit" class="auth_sub320" name="auth_sub320" value="Submit" ><label id="error_auth_code"></label>
			</div>
		</div>
<?php
	}
	if (array_key_exists("577",$referred_user_count['count']))
	{
?>
		<div class="ppup_levelq2" style="padding-top:10px;">
			<div class="ppup_inr" style="">
			<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_levelq2" title="Close"></a>
				<!--<strong><h2>Congratulation!! You have earned </h2>Total Refferal Amount <span style="font-size:18px;color:blue"><b><i>$ <?php echo $val*60?></b></i></span><br> for <?php echo $val?> users whome you have referred, are moved up from level 3 to 4</strong><br><br>-->
				
				<img style="border: 2px solid #c5bda1; border-radius: 5px;" width="" height="" alt="" src="<?php echo base_url();?>images/referral_popup.jpg">
			</div>
				<br class="clear" />
				
				Authentication code: <input type="text" name="auth_code577" id="auth_code577">
						<input type="submit" class="auth_sub577" name="auth_sub577" value="Submit"><label id="error_auth_code"></label>
			</div>
		</div>
<?php
	}
	if (array_key_exists("834",$referred_user_count['count']))
	{
?>
       <div class="ppup_levelq4" style="padding-top:10px;">
			<div class="ppup_inr" style="">
			<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_levelq4" title="Close"></a>
				<!--<strong><h2>Congratulation!! You have earned </h2>Total Refferal Amount <span style="font-size:18px;color:blue"><b><i>$ <?php echo $referred_user_count[834]*90?></b></i></span><br> for <?php echo $val?> users whome you have referred, are moved up from level 4 to 5</strong><br><br>-->
				
				<img style="border: 2px solid #c5bda1; border-radius: 5px;" width="" height="" alt="" src="<?php echo base_url();?>images/referral_popup.jpg">
			</div>
				<br class="clear" />
				
				Authentication code: <input type="text" name="auth_code834" id="auth_code834">
						<input type="submit" class="auth_sub834" name="auth_sub834" value="Submit"><label id="error_auth_code"></label>
			</div>
		</div>
<?php
	}
  }
?>

<?php $this->load->view("nav_header", "", $result); ?>

<!--ADDING COMMON FORM-->

<?php $this->load->view("commonform", "", $result); ?>

<!--END OF ADDING COMMON FORM--> 

<!-- header end --> 

<!-- main container start -->

<div class="main_container_new ddsh raveshare"> 
  
  <!-- lefts side start -->
  
  <div class="lefts_side"> 
    
    <!--tab start-->
    
    <div class="tabsectionstep">
      <div id="contentId"> 
        
        <!--<h3>My CT Wallet</h3>--> 
        
        <br />
        
        <!-- 

<div class="yvideo extra-pad">
           <div class="palvidd" style="width:570px; height:; margin:0 auto;"><a href="javascript:void(0)" id="tutorial-video101"><img src="http://globalblackenterprises.com/adminuploads/level_wise_images/lwi_1456323277.png" alt="" width="570" height="320"></a></div>
            </div>
-->
        
        <?php 

/*echo "<pre>";
print_r($rs);
echo "</pre>";*/

			if($this->session->userdata('userType')=="ADMIN"){ ?>
        <div class="totalcurrentsystem">Members In The Queue - CT LAUNCH : <strong><?php echo number_format($raveActiveUser+12000); ?></strong></div>
        <?php } ?>
        <?php foreach($rs as $key=>$val){ 
				extract($val);
					?>
        <p class="myspendabletab">My Income on life Cycle <?php echo $key; ?><span><?php echo $currSymbol; ?><?php echo number_format($totalAmt,2);//$spendableAmt; ?></p>
        <?php } ?>
        <?php foreach($rs as $key=>$val){ 
					extract($val);
					?>
        <?php if($raveType=="founder" || $raveType=="Founder"){ 		
				?>
        <p class="myspendabletab blue">Founders Bonus LC<?php echo $key; ?> (<?php echo $currSymbol; ?><?php echo $founderBonus; ?>)<span><?php echo $currSymbol; ?><?php echo number_format($founderTotal,2); ?></p>
        <?php } ?>
        <?php } ?>
        <div>
          <div >
            <?php 
foreach($rs as $key=>$val){ 



					       extract($val);



				if($userLevel==2 || $userLevel==3 || $userLevel==4){ ?>
            <div>
              <table width="98%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                  <tr>
                    <!--<th>Amount of Days I Worked(<?php echo digitToNumberConvert($key); ?> life Cycle) </th>-->
                    <th>Count-down to Enter Q<?php echo $userLevel+1; ?></th>
                  </tr>
                  <tr>
                    <!--<td class="tabdaysworked"><?php echo $counter." ".$day; ?></td>-->
                    <td><?php if($nextLevelEntry>0){ ?>
                      <?php //echo $currSymbol; ?>
                      <?php echo number_format($entLNextBalance-$nextLevelEntry,2); ?>
                      <?php } ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <?php } 
}
				?>
           <?php 
foreach($rs as $key=>$val){ 

					       extract($val);
					       ?>
            <div style="margin-top:15px;">
              <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                  <tr>
                    <th style="max-width:153px;">People That I have Introduced (Referrals)</th>
                    <th>My Referral Commissions(<?php echo digitToNumberConvert($key); ?> life Cycle) </th>
                  </tr>
                  <tr>
                    <td class="tabreferrals"><?php 
						 echo $MyReferrals." ".$member; ?></td>
                    <td><?php echo $currSymbol; ?><?php echo ($myReferalTotal?number_format($myReferalTotal,2):'0.00');  ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <?php } ?>
            
            <!--<div>
			  <table id="commTbl" width="98%" cellspacing="0" cellpadding="0" border="0">
				<tbody>
				  <tr>							
					<th>My Work Days </th>
					<th>My Commission (<?php echo $currSymbol; ?>)</th>
					<th>Referral Commissions (<?php echo $currSymbol; ?>)</th>
				  </tr>
					<?php if($counter!=0) { 
							$CycleCommDetail = ($perCommAmt+$founderCom)*$counter;	
					?><tr>
					 <td style="text-align:center;"><?php echo $counter; ?></td>
                    <td style="text-align:center;"><?php echo $currSymbol; ?><?php echo number_format($CycleCommDetail,2); ?></td>
					<td style="text-align:center;"><?php echo $currSymbol; ?><?php echo ($myReferalTotal?number_format($myReferalTotal,2):'0.00'); ?></td>
					 </tr>	
					<?php } else{ ?>
					<tr><td colspan="3">No record available</td> </tr>	
					<?php } ?>
				 </tbody>







			  </table>







            </div>-->
            
            <?php //if($userInfo[0]['userLevel']==2 || $userInfo[0]['userLevel']==3 || $userInfo[0]['userLevel']==4){ ?>
            <p>&nbsp;</p>
            
            <!--<h3>My Bonuses</h3>







				 <table width="98%" cellspacing="0" cellpadding="0" border="0">







					<tbody>







					  <tr>					







						<th>Opportunity Balance </th>					







						<th><?php echo $middleBonusName; ?> Balance </th>







						<th>Karma Balance </th>







					  </tr>







					  <tr>







						  <td class="mybonustab"><?php echo $currSymbol; ?><?php echo number_format($opportunityBalance,2); ?></td>







						  <?php if($userInfo[0]['userLevel']==4){  ?>







						  <td><?php echo $currSymbol; ?><?php echo number_format($seedBalance,2); ?></td>







						  <?php } else { ?>







						  <td><?php echo $currSymbol; ?><?php echo number_format($seedBalance,2); ?></td>







						  <?php }?>







						  <td><?php echo $currSymbol; ?><?php echo number_format($karmaBalance,2); ?></td>







					  </tr>







					 </tbody>







			    </table> -->
            
            <?php //}







				//if($userInfo[0]['userLevel']==2 || $userInfo[0]['userLevel']==3 || $userInfo[0]['userLevel']==4){ ?>
            <p>&nbsp;</p>
            
            <!--<h3> Entrance Level <?php //echo $userInfo[0]['userLevel']+1; ?></h3>-->
            
            <h3>Active Commission</h3>
            <?php 



/*echo "<pre>";



	print_r($rs);



	echo "</pre>";*/



foreach($rs as $key=>$val){ 



	



					       extract($val);



					       ?>
            <table width="100%" cellspacing="0" cellpadding="0" border="0"  style="margin-top:15px;">
              <tbody>
                <tr> 
                  
                  <!--<th> Entrance Level <?php // echo $userInfo[0]['userLevel']+1; ?></th>	-->
                  
                  <th>Active Commission</th>
                  <!--<th class="tabentrancelvl">Days Worked </th>-->
                </tr>
                <tr>
                  <td><?php echo $currSymbol; ?><?php echo number_format($activeTotal,2); ?>(<?php echo digitToNumberConvert($key); ?> life Cycle)</td>
                 <!-- <td><?php echo $counter; ?></td>-->
                </tr>
              </tbody>
            </table>
            <?php } ?>
          </div>
          <div class="refClass">
            <h3>Referral Details</h3>
            <div>
              <?php 



/*echo "<pre>";







//print_r($MyOldUserIdLists);



print_r($allAccountDetail);



//print_r($myReferalCommDetail);



echo "</pre>";*/











 ?>
              <div id="accordion">
                <?php if(count($myReferalCommDetail)>0){







						 foreach($myReferalCommDetail as $key=>$myReferalCommDetails){



 







						 ?>
                <h3>View Your referred Members who are in their <?php echo digitToNumberConvert($key); ?> life Cycle</h3>
                <div class="ref-scroll">
                  <table id="refCommTbl" width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                      <tr>
                        <th>User Name </th>
                        <th>Level & Life Cycle</th>
                        <!--<th>Days Worked </th>-->
                        <th>Referral Commission </th>
                      </tr>
                      <?php 



                    if(count($myReferalCommDetails)>0){



							 foreach($myReferalCommDetails as $myReferalCommDetails){







/*echo "<pre>";



print_r($myReferalCommDetails);



echo "</pre>";	*/



  /*  [invtAmt] => 315.200000762939



    [refCommCount] => 72



    [userId] => 1232



    [emailID] => SonjaTaggiasco@hotmail.com



    [userLevel] => 5*/



						 ?>
                      <tr>
                        <td style="text-align:center;" class="tabreferralsdetails"><?php echo $myReferalCommDetails['emailID']; ?></td>
                        <td style="text-align:center;" ><?php echo $myReferalCommDetails['userLevel']; ?> (LC<?php echo $myReferalCommDetails['userPositionDetails'][0]['userCycle']; ?>)</td>
                       <!-- <td style="text-align:center;"><?php 



						



						  //echo $myReferalCommDetails['refCommCount']; ?></td>-->
                        <td style="text-align:center;"><?php echo $currSymbol; ?>
                          <?php 



						  //echo number_format($myReferalCommDetails['referralAmountArray']['refTotal'],2);



						  echo number_format($myReferalCommDetails['invtAmt'],2); ?></td>
                      </tr>
                      <?php 







							



                               }



						 







						} else{ ?>
                      <tr>
                        <td colspan="4">No record available</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <?php 



}







  }



  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- left side tab end--> 
  
  <!-- right side tab start-->
  
  <?php $this->load->view("right_panel", "", $result); ?>
  
  <!-- rights side end -->
  
  <div class="clear"></div>
</div>
<div class="newcycle-popup">
<span class="closee">X</span> <strong style=" font-size: 25px; line-height: 36px;">Thank you for your participation.</strong> <br />
Our team is working hard to give you the best! <br />
We will be enabling "Multiple Cycle" functionality soon. When this functionality is launched, you will be notified via email and you will be able to participate in our next stage of Multiple stage simulation process. <br />
<br />
Thank you again for your kind co-operation and understating. <br />
We appreciate your patience and support to make this programme successful.
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_levell" title="Close"></a> </div>
<script>



$(document).ready(function(){



    $(".closee").click(function(){



        $(".newcycle-popup").hide();



    });



    $(".start-newcycle").click(function(){



        $(".newcycle-popup").show();



    });



});



</script> 

<!-- main container end -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<script type="text/javascript">



	  $( function() {



  //  $( "#accordion" ).accordion();



    $('#accordion').accordion({



    active: false,



    collapsible: true            



});



  } );



</script>
<?php







function digitToNumberConvert($num){



$list=array('Zero' => 0,



'First' => 1,



'Second' => 2,



'Third' => 3,



'Fourth' => 4,



'Fifth' => 5,



'Sixth' => 6,



'Seventh' => 7,



'Eighth' => 8,



'Ningth' => 9);



 



 $temp='';



 $arr_num=str_split ($num);



foreach($arr_num as $data)



{



$temp.=array_search($data,$list);



}



$num=$temp;



return $num; // here we get BCDE



}



?>
