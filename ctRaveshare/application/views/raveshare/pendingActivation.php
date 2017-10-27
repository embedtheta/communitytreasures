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
table td{width:auto !important; max-width:none !important;}
table td{width:auto !important; max-width:none !important;}

.tabdaysworked, .tabreferrals, .tabreferralsdetails   {
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
.clear{clear:both; line-height:0; font-size:0;}
.newcycle-popup {
     background: #fff none repeat scroll 0 0;
    border: 2px solid #939393;
    border-radius: 5px;
    color: #414141;
    display: none;
    font: 17px/22px Arial,Helvetica,sans-serif;
    left: 20%;
    padding: 40px 20px;
    position: absolute;
    text-align: center;
    top: 40%;
    width: 780px;
    z-index: 999;
}
span.closee{/* background: #fff none repeat scroll 0 0;
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
</style>
 <script type="text/javascript">

//var userLevel  = <?php if($userInfo[0]['userLevel']>0) {echo $userInfo[0]['userLevel'].";";} else { echo "".";"; } ?>
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";

jQuery(document).ready(function($){	
 $('.close_btn_level').click(function(){
	 	$('.ppup_level').remove();
		
	 }); 
	  $('.close_btn_levelq1').click(function(){
	 	
		$('.ppup_levelq1').remove();
	 }); 
	 $('.close_btn_levelq2').click(function(){
	 	
		$('.ppup_levelq2').remove();
	 }); 
	 
	  $('.close_btn_levelq3').click(function(){
	 	
		$('.ppup_levelq3').remove();
	 }); 
	  $('.close_btn_levelq4').click(function(){
	 	
		$('.ppup_levelq4').remove();
	 }); 
	 // move up process
	  $("#moveUp").click(function(){
		//alert('click'); 
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
		//alert('click'); 
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
  if($myCurrPosition > 64 && $myCurrPosition < 320){ 
	//if($myCurrPosition > 64 && $userInfo[0]["userLevel"]==2){ ?>
<div class="ppup_levelq1" style="padding-top:10px;">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_levelq1" title="Close"></a>
<img style="border: 2px solid #c5bda1; border-radius: 5px;" width="" height="" alt="" src="<?php echo base_url();?>images/completed-q0img.png"> 
</div><br class="clear" />
</div>

</div>
	<?php //}
	}  else if($myCurrPosition > 320 && $myCurrPosition < 577){ 
	//if($myCurrPosition > 320 && $userInfo[0]["userLevel"]==3){ ?>
<div class="ppup_levelq2" style="padding-top:10px;">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_levelq2" title="Close"></a>
<img style="border: 2px solid #c5bda1; border-radius: 5px;" width="" height="" alt="" src="<?php echo base_url();?>images/completed-q1img.png"> 
</div><br class="clear" />
</div>

</div>
<?php //}
} 
 else if($myCurrPosition > 576 && $myCurrPosition < 834){
	// if($myCurrPosition > 576 & $userInfo[0]["userLevel"]==3){ ?>
<div class="ppup_levelq3" style="padding-top:10px;">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_levelq3" title="Close"></a>
<img style="border: 2px solid #c5bda1; border-radius: 5px;" width="" height="" alt="" src="<?php echo base_url();?>images/completed-q3img.png"> 
</div><br class="clear" />
</div>

</div>
<?php //}
}
  else if($myCurrPosition > 833 && $myCurrPosition < 1089){
	//if($myCurrPosition > 833 & $userInfo[0]["userLevel"]==4){ ?>
<div class="ppup_levelq4" style="padding-top:10px;">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_levelq4" title="Close"></a>
<img style="border: 2px solid #c5bda1; border-radius: 5px;" width="" height="" alt="" src="<?php echo base_url();?>images/completed-q4img.png"> 
</div><br class="clear" />
</div>

</div>
<?php //} 
}

if($myCurrPosition > 1088){
	if($myCurrPosition > 1088 && $userInfo[0]["userLevel"]==5){ ?>
<div class="ppup_level" style="padding-top:10px;">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_level" title="Close"></a>
<img style="border: 2px solid #c5bda1; border-radius: 5px;" width="" height="" alt="" src="<?php echo base_url();?>images/completed-q5img.png">
 <!-- <a href="#" class="start-newcycle">Start A New <br />
Life Cycle</a>
  <a href="#" class="start-newcycleexit">Exit The <br />
Queue</a>-->
  <div class="switch_extrapara" style="width:470px; margin:0 auto;">
    <p class="swt_img" style="margin:0;"><a id="nxtCycleMsg" href="javascript:;" class="start-newcycle">Start A New <br />
Life Cycle</a>

<a href="javascript:;" class="start-newcycleexit close_btn_level">Exit The <br />
Queue</a></p>
  </div>
</div><br class="clear" />
</div>

</div>
<?php } 
}else {?>
<div class="ppup_level" style="padding-top:5px;">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up walletpopup"><a href="javascript:;" class="close_btn_level" title="Close"></a>
  <h2>ATTENTION</h2>
  <p class="ctsimulation">CT is still in Simulation Mode</p>
  <h3>You Don't Need To View Adverts Yet</h3>
  <p class="queue">Your Position In The Queue is Secured</p>
  <br />
  <h4>WATCH ALL THREE VIDEOS ON THIS PAGE</h4>
  <p class="simplebuild">Then Simply Build Your Network By<br />
Introduce People Into Your Team<br />
And Prepare For The Launch..<br />
Thats It.
  </p>
  <br />
  <p class="simplebuildgry">Due To A Large Number of People Joining CT.<br />
We Are lengthening the Queues.<br />
Your Position may move down and your
simulated income will change.</p>
<p class="simplebuildgry">This is for the sustainability of
Community Treasures.<br />
<br />
Thank You</p>
<br />
<a href="javascript:;" class="enter-buttonn close_btn_level">Enter Your Page</a>
  
  <!--<div class="switch_extrapara">
    <p class="swt_img"><a href="javascript:;"><img width="424" height="81" style="cursor:pointer" alt="" src=""></a></p>
  </div>-->
</div>
</div>
</div>


<?php } ?>

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

     

		<h3>My CT Wallet</h3>

		<?php if($allAccountDetail[0]['counter']!=0) { 

					//echo"++++++++++++++++".$this->session->userdata('raveType');

					if($allAccountDetail[0]['counter']>1){

						$day='Days';

					}

					else{

						$day='Day';

					}

					if($MyReferrals>1){

						$member = 'Members';

					}

					else{

						$member = 'Member';

					}

						$otherComm ='';

						//$spendableAmt =0;// blocked by SB on 05/07/2016
						
						$totalAmt =0; // added by SB on 05/07/2016

						$nextLevelEntry=0;

						if($userInfo[0]['userLevel']==1){

							

							$founderBonus = 30; // total bonus

							$nextLevelEntry=60;// level2 entry fee 

							// founder comm + referral comm  is spendable amount

							$activeTotal =$perCommAmt*$allAccountDetail[0]['counter'];//-4 for 16 cycle added by SB

							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];

							$CycleComm = $perCommAmt*$allAccountDetail[0]['counter'];

							$leftAmt = $allAccountDetail[0]['amount']-$CycleComm;

							//$spendableAmt =$leftAmt;// blocked by SB on 05/07/2016
							// active total +founder total + total referal comm
							$totalAmt = $activeTotal+$founderTotal+$myReferalTotal;// added by SB on 05/07/2016 // blocked BY SB on 27/09/2016
							

							

						}			

						else if($userInfo[0]['userLevel']==2){

							

							$founderBonus = 100; // total bonus

							$nextLevelEntry=300;// level3 entry fee 

							// active + founder+ referal is spendable amount

							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];

							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];

							$middleBonusName = 'seed';

							$opportunity = 4.13; // 4.18;//2.34;

							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];

							$seed = 3.13;//1.56;

							$seedBalance = $seed*$allAccountDetail[0]['counter'];

							$karma = 6.25;//1.59;

							$karmaBalance = $karma*$allAccountDetail[0]['counter'];

							$entranceLNext= 18.75;//9.38;

							$entLNextBalance = $entranceLNext*$allAccountDetail[0]['counter'];

							

							//$otherComm =$opportunityBalance+$seedBalance+$karmaBalance+$entLNextBalance;// blocked by SB on 29-08-2016
							$otherComm =$opportunityBalance+$seedBalance+$karmaBalance;// added by SB on 29-08-2016							

							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;

							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;

							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016
							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016
							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016
							if($this->session->userdata('raveType')=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30;
							}
							
							$totalAmt = $level1FounderCom+$sumSpendableAmt; //   added by SB on 27/09/2016
						}

						else if($userInfo[0]['userLevel']==3){

							$founderBonus = 200; // total bonus

							$nextLevelEntry=800;// level4 entry fee 

							// active + founder+ referal is spendable amount

							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];

							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];
							
							$middleBonusName = 'seed';
				
							$opportunity = 21;//9.38;

							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];

							$seed = 21;//3.13;

							$seedBalance = $seed*$allAccountDetail[0]['counter'];

							$karma = 9;//9.24;//9.38;

							$karmaBalance = $karma*$allAccountDetail[0]['counter'];

							$entranceLNext= 50;//25;

							$entLNextBalance = $entranceLNext*$allAccountDetail[0]['counter'];							

							//$otherComm =$opportunityBalance+$seedBalance+$karmaBalance+$entLNextBalance;	// blocked by SB on 30-08-2016							
							$otherComm =$opportunityBalance+$seedBalance+$karmaBalance;// added by SB on 30-08-2016	
							
							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;

							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal; // blocked by SB on 05/07/2016
							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016
							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016
							if($this->session->userdata('raveType')=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100;
							}
							$level2ActiveCom = 9.38*16;
							$totalAmt = $level1FounderCom+$level2ActiveCom+$sumSpendableAmt; // My total income only show active total commission added by SB on 27/09/

						}

						else if($userInfo[0]['userLevel']==4){

							$founderBonus = 300; // total bonus

							$nextLevelEntry=1700;//1000;// level5 entry fee 

							// active + founder+ referal is spendable amount

							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];

							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];

							$middleBonusName = 'Seed';

							$opportunity = 75;//37.50;

							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];

							$seed = 31.84;//15.63; // Co -operative

							$seedBalance = $seed*$allAccountDetail[0]['counter'];

							$karma = 125;//62.50;

							$karmaBalance = $karma*$allAccountDetail[0]['counter'];

							$entranceLNext= 106.25;//53.13;

							$entLNextBalance = $entranceLNext*$allAccountDetail[0]['counter'];

							

							//$otherComm =$opportunityBalance+$seedBalance+$karmaBalance+$entLNextBalance; // blocked by SB on 30-08-2016							
							$otherComm =$opportunityBalance+$seedBalance+$karmaBalance;// added by SB on 30-08-2016
							
							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;

							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;

							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016
							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016
							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016
							if($this->session->userdata('raveType')=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100+200;
							}
							$level2ActiveCom = 9.38*16;
							$level3ActiveCom = 18.75*16;
							$totalAmt = $level1FounderCom+$level2ActiveCom+$level3ActiveCom+$sumSpendableAmt; // My total income only show active total commission added by SB on 27/09/2016
						}

						else if($userInfo[0]['userLevel']==5){

							

							$founderBonus = 500; // total bonus

							// active + founder+ referal is spendable amount

							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];

							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];

							//$middleBonusName = 'Co-Op';

							$opportunity =  281.25;//281.24;//37.50;

							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];

							

							$karma = 31.25;//31.24;//15.63;

							$karmaBalance = $karma*$allAccountDetail[0]['counter'];

							$seed=125;//53.13;

							$seedBalance = $seed*$allAccountDetail[0]['counter'];

							

							$otherComm =$opportunityBalance+$karmaBalance+$seedBalance;							

							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;

							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;

							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016
							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016
							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016
							if($this->session->userdata('raveType')=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100+200+300;
							}
							$level2ActiveCom = 9.38*16;
							$level3ActiveCom = 18.75*16;
							$level4ActiveCom = 37.50*16;
							$totalAmt = $level1FounderCom+$level2ActiveCom+$level3ActiveCom+$level4ActiveCom+$sumSpendableAmt; // My total income only show active total commission added by SB on 27/09/

						}

				}

				else{

					if($userInfo[0]['userLevel']==2 || $userInfo[0]['userLevel']==3)

					{

						$middleBonusName = 'Seed';

					}

					else if($userInfo[0]['userLevel']==4){

						$middleBonusName = 'Seed';

					}

					//$spendableAmt = $allAccountDetail[0]['amount'];// blocked by SB on 05/07/2016
					//$totalAmt = $allAccountDetail[0]['amount'];// added by SB on 05/07/2016
					if($userInfo[0]['userLevel']==1 ){
						$totalAmt = 0;
						
					}
					else if($userInfo[0]['userLevel']==2){
						if($this->session->userdata('raveType')=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30;
							}
						
						$totalAmt = $level1FounderCom+$myReferalTotal;
					}
					else if($userInfo[0]['userLevel']==3){
						if($this->session->userdata('raveType')=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100;
							}
						$level2ActiveCom = 9.38*16;
						$totalAmt = $level2ActiveCom+$level1FounderCom+$myReferalTotal;
					}
					else if($userInfo[0]['userLevel']==4){
						if($this->session->userdata('raveType')=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100+200;
							}
						$level2ActiveCom = 9.38*16;
						$level3ActiveCom = 18.75*16;
						$totalAmt = $level2ActiveCom+$level3ActiveCom+$level1FounderCom+$myReferalTotal;
					}
					else if($userInfo[0]['userLevel']==5){
						if($this->session->userdata('raveType')=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100+200+300;
							}
						$level2ActiveCom = 9.38*16;
						$level3ActiveCom = 18.75*16;
						$level4ActiveCom = 37.50*16;
						$totalAmt = $level2ActiveCom+$level3ActiveCom+$level4ActiveCom+$level1FounderCom+$myReferalTotal;
					}

				}					

					

				?>	
				<?php if($this->session->userdata('userType')=="ADMIN"){ ?>
		<div class="totalcurrentsystem">Members In The Queue - CT LAUNCH : <strong><?php echo number_format($raveActiveUser+12000); ?></strong></div>
				<?php } ?>

        <p class="myspendabletab">My Total Income<span><?php echo $currSymbol; ?><?php echo number_format($totalAmt,2);//$spendableAmt; ?></p>

		<?php if($this->session->userdata('raveType')=="founder" || $this->session->userdata('raveType')=="Founder"){ 		

		?>

     <p class="myspendabletab blue">Founders Bonus  (<?php echo $currSymbol; ?><?php echo $founderBonus; ?>)<span><?php echo $currSymbol; ?><?php echo number_format($founderTotal,2); ?></p>

		<?php } ?>

		<div>

			<div >
				<?php if($userInfo[0]['userLevel']==2 || $userInfo[0]['userLevel']==3 || $userInfo[0]['userLevel']==4){ ?>
				<div>

				 <table width="98%" cellspacing="0" cellpadding="0" border="0">

					<tbody>

					  <tr>					

						<th>Amount of Days I Worked </th>					

						<!--<th>My Target is (<?php echo $currSymbol; ?><?php echo $nextLevelEntry;?>)To Enter Q<?php echo $userInfo[0]['userLevel']+1; ?></th>-->
						<th>Count-down to Enter Q<?php echo $userInfo[0]['userLevel']+1; ?></th>
						

					  </tr>

					  <tr>

						  <td class="tabdaysworked"><?php echo $allAccountDetail[0]['counter']." ".$day; ?></td>

						  <td><?php if($nextLevelEntry>0){ ?><?php //echo $currSymbol; ?><?php echo number_format($entLNextBalance-$nextLevelEntry,2); ?><?php } ?></td>

					  </tr>

					 </tbody>

			    </table>

				</div>
				<?php } ?>

				

<br/>

				<div>

				<table width="98%" cellspacing="0" cellpadding="0" border="0">

					<tbody>

					  <tr>					

						<th style="max-width:153px;">People That I have Introduced (Referrals)</th>					

						<th>My Referral Commissions </th>

					  </tr>

					  <tr>

						  <td class="tabreferrals"><?php echo $MyReferrals." ".$member; ?></td>

						  <td><?php echo $currSymbol; ?><?php echo ($myReferalTotal?number_format($myReferalTotal,2):'0.00');  ?></td>

					  </tr>

					 </tbody>

			    </table>

				</div>

				<!--<div>

			  <table id="commTbl" width="98%" cellspacing="0" cellpadding="0" border="0">

				<tbody>

				  <tr>							

					<th>My Work Days </th>

					<th>My Commission (<?php echo $currSymbol; ?>)</th>

					<th>Referral Commissions (<?php echo $currSymbol; ?>)</th>

				  </tr>

				  

					<?php if($allAccountDetail[0]['counter']!=0) { 

											

							$CycleCommDetail = ($perCommAmt+$founderCom)*$allAccountDetail[0]['counter'];	

						

										

					

					?><tr>

					 <td style="text-align:center;"><?php echo $allAccountDetail[0]['counter']; ?></td>

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

				 <table width="98%" cellspacing="0" cellpadding="0" border="0">

					<tbody>

					  <tr>					

						<!--<th> Entrance Level <?php // echo $userInfo[0]['userLevel']+1; ?></th>	-->				
						<th>Active Commission</th>
						<th class="tabentrancelvl">Days Worked </th>

					  </tr>

					  <tr>

						  <td><?php echo $currSymbol; ?><?php echo number_format($activeTotal,2); ?></td>

						  <td><?php echo $allAccountDetail[0]['counter']; ?></td>

					  </tr>

					 </tbody>

			    </table>

				<?php //} ?>

			 </div>			 

			

			 <div class="refClass">

			  <h3>Referral Details</h3>

			  <div class="ref-scroll">
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

  <h3>Circle <?php echo $key; ?></h3>
  <div>
   <table id="refCommTbl" width="100%" cellspacing="0" cellpadding="0" border="0">

					<tbody>

					  <tr>	

						<th>User Name </th>	
						<th>Level </th>							

						<th>Days Worked </th>

						<th>Referral Commission </th>

					  </tr>					 

					 <?php 
                    if(count($myReferalCommDetails)>0){
							 foreach($myReferalCommDetails as $myReferalCommDetails){

						 ?>

					  <tr>

					     <td style="text-align:center;" class="tabreferralsdetails"><?php echo $myReferalCommDetails['emailID']; ?></td>
						 <td style="text-align:center;" ><?php echo $myReferalCommDetails['userLevel']; ?></td>

						  <td style="text-align:center;"><?php echo $myReferalCommDetails['refCommCount']; ?></td>

						  <td style="text-align:center;"><?php echo $currSymbol; ?><?php echo number_format($myReferalCommDetails['invtAmt'],2); ?></td>

					  </tr>

						 <?php 

							
                               }
						 

						} else{ ?>

					<tr><td colspan="4">No record available</td></tr>

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
<span class="closee">X</span>
<strong style=" font-size: 25px; line-height: 36px;">Thank you for your participation.</strong> <br />
Our team is working hard to give you the best! <br />
We will be enabling "Multiple Cycle" functionality soon. When this functionality is launched, you will be notified via email and you will be able to participate in our next stage of Multiple stage simulation process. <br /><br />

Thank you again for your kind co-operation and understating. <br />
We appreciate your patience and support to make this programme successful. 
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_levell" title="Close"></a>
</div>
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
