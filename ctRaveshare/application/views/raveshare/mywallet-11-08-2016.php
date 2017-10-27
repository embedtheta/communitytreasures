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



<script type="text/javascript">



//var userLevel  = <?php if($userInfo[0]['userLevel']>0) {echo $userInfo[0]['userLevel'].";";} else { echo "".";"; } ?>

var formSubmitMsg = "<?php echo $msg;?>";

var formSubmitType = "<?php echo $type;?>";

</script>
<style type="text/css">
table td{width:auto !important; max-width:none !important;}
table td{width:auto !important; max-width:none !important;}

.tabdaysworked, .tabreferrals, .tabreferralsdetails   {
    width: 292px !important;
}
</style>
 





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

							$activeTotal =$perCommAmt*$allAccountDetail[0]['counter']-4;// for 16 cycle added by SB

							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];

							$CycleComm = $perCommAmt*$allAccountDetail[0]['counter'];

							$leftAmt = $allAccountDetail[0]['amount']-$CycleComm;

							//$spendableAmt =$leftAmt;// blocked by SB on 05/07/2016
							// active total +founder total + total referal comm
							$totalAmt = $activeTotal+$founderTotal+$myReferalTotal;// added by SB on 05/07/2016

							

						}			

						else if($userInfo[0]['userLevel']==2){

							

							$founderBonus = 100; // total bonus

							$nextLevelEntry=300;// level3 entry fee 

							// active + founder+ referal is spendable amount

							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];

							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];

							$middleBonusName = 'per';

							$opportunity = 2.34;

							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];

							$per = 1.56;

							$perBalance = $per*$allAccountDetail[0]['counter'];

							$karma = 1.59;

							$karmaBalance = $karma*$allAccountDetail[0]['counter'];

							$entranceLNext= 9.38;

							$entLNextBalance = $entranceLNext*$allAccountDetail[0]['counter'];

							

							$otherComm =$opportunityBalance+$perBalance+$karmaBalance+$entLNextBalance;							

							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;

							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;

							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016
							$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016

						}

						else if($userInfo[0]['userLevel']==3){

							

							$founderBonus = 200; // total bonus

							$nextLevelEntry=800;// level4 entry fee 

							// active + founder+ referal is spendable amount

							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];

							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];

							$middleBonusName = 'per';

							$opportunity = 9.38;

							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];

							$per = 3.13;

							$perBalance = $per*$allAccountDetail[0]['counter'];

							$karma = 9.38;

							$karmaBalance = $karma*$allAccountDetail[0]['counter'];

							$entranceLNext= 25;

							$entLNextBalance = $entranceLNext*$allAccountDetail[0]['counter'];

							

							$otherComm =$opportunityBalance+$perBalance+$karmaBalance+$entLNextBalance;							

							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;

							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;

							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal; // blocked by SB on 05/07/2016
							$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016

						}

						else if($userInfo[0]['userLevel']==4){

							

							$founderBonus = 300; // total bonus

							$nextLevelEntry=1000;// level5 entry fee 

							// active + founder+ referal is spendable amount

							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];

							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];

							$middleBonusName = 'Co-Op';

							$opportunity = 37.50;

							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];

							$coOperative = 15.63; // Co -operative

							$coOperBalance = $coOperative*$allAccountDetail[0]['counter'];

							$karma = 62.50;

							$karmaBalance = $karma*$allAccountDetail[0]['counter'];

							$entranceLNext= 53.13;

							$entLNextBalance = $entranceLNext*$allAccountDetail[0]['counter'];

							

							$otherComm =$opportunityBalance+$coOperBalance+$karmaBalance+$entLNextBalance;							

							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;

							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;

							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016
							$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016

						}

						else if($userInfo[0]['userLevel']==5){

							

							$founderBonus = 500; // total bonus

							// active + founder+ referal is spendable amount

							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];

							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];

							//$middleBonusName = 'Co-Op';

							$opportunity = 37.50;

							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];

							

							$karma = 15.63;

							$karmaBalance = $karma*$allAccountDetail[0]['counter'];

							$vacation= 53.13;

							$vacationBalance = $vacation*$allAccountDetail[0]['counter'];

							

							$otherComm =$opportunityBalance+$karmaBalance+$vacationBalance;							

							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;

							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;

							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016
							$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016

						}

					}

					else{

						if($userInfo[0]['userLevel']==2 || $userInfo[0]['userLevel']==3)

						{

							$middleBonusName = 'per';

						}

						else if($userInfo[0]['userLevel']==4){

							$middleBonusName = 'Co-Op';

						}

						//$spendableAmt = $allAccountDetail[0]['amount'];// blocked by SB on 05/07/2016
						$totalAmt = $allAccountDetail[0]['amount'];// added by SB on 05/07/2016

					}					

					

				?>	

        <p class="myspendabletab">My Total Income<span><?php echo $currSymbol; ?><?php echo $totalAmt;//$spendableAmt; ?></p>

		<?php if($this->session->userdata('raveType')=="founder" || $this->session->userdata('raveType')=="Founder"){ 		

		?>

     <p class="myspendabletab blue">Founders Bonus  (<?php echo $currSymbol; ?><?php echo $founderBonus; ?>)<span><?php echo $currSymbol; ?><?php echo $founderTotal; ?></p>

		<?php } ?>

		<div>

			<div >

				<div>

				 <table width="98%" cellspacing="0" cellpadding="0" border="0">

					<tbody>

					  <tr>					

						<th>Amount of Days I Worked </th>					

						<th>My Target is (<?php echo $currSymbol; ?><?php echo $nextLevelEntry;?>)To Enter Q<?php echo $userInfo[0]['userLevel']+1; ?></th>

					  </tr>

					  <tr>

						  <td class="tabdaysworked"><?php echo $allAccountDetail[0]['counter']." ".$day; ?></td>

						  <td><?php echo $currSymbol; ?><?php echo number_format($activeTotal,2); ?></td>

					  </tr>

					 </tbody>

			    </table>

				</div>

				

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

				<?php if($userInfo[0]['userLevel']==2 || $userInfo[0]['userLevel']==3 || $userInfo[0]['userLevel']==4){ ?>

				 <p>&nbsp;</p>

				 <h3>My Bonuses</h3>

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

						  <td><?php echo $currSymbol; ?><?php echo number_format($coOperBalance,2); ?></td>

						  <?php } else { ?>

						  <td><?php echo $currSymbol; ?><?php echo number_format($perBalance,2); ?></td>

						  <?php }?>

						  <td><?php echo $currSymbol; ?><?php echo number_format($karmaBalance,2); ?></td>

					  </tr>

					 </tbody>

			    </table>

				<?php }

				if($userInfo[0]['userLevel']==2 || $userInfo[0]['userLevel']==3 || $userInfo[0]['userLevel']==4){ ?>

				<p>&nbsp;</p>

				 <h3> Entrance Level <?php echo $userInfo[0]['userLevel']+1; ?></h3>

				 <table width="98%" cellspacing="0" cellpadding="0" border="0">

					<tbody>

					  <tr>					

						<th> Entrance Level <?php echo $userInfo[0]['userLevel']+1; ?></th>					

						<th class="tabentrancelvl">Days Worked </th>

					  </tr>

					  <tr>

						  <td><?php echo $currSymbol; ?><?php echo number_format($entLNextBalance,2); ?></td>

						  <td><?php echo $allAccountDetail[0]['counter']; ?></td>

					  </tr>

					 </tbody>

			    </table>

				<?php } ?>

			 </div>			 

			

			 <div class="refClass">

			  <h3>Referal Details</h3>

			  <div class="ref-scroll">

              <table id="refCommTbl" width="100%" cellspacing="0" cellpadding="0" border="0">

					<tbody>

					  <tr>	

						<th>User Name </th>					  

						<th>Days Worked </th>

						<th>Referral Commission </th>

					  </tr>					 

					 <?php if(count($myReferalCommDetail)>0){

						 foreach($myReferalCommDetail as $myReferalCommDetails){

							

						 ?>

					  <tr>

					     <td style="text-align:center;" class="tabreferralsdetails"><?php echo $myReferalCommDetails['emailID']; ?></td>

						  <td style="text-align:center;"><?php echo $myReferalCommDetails['refCommCount']; ?></td>

						  <td style="text-align:center;"><?php echo $currSymbol; ?><?php echo number_format($myReferalCommDetails['invtAmt'],2); ?></td>

					  </tr>

						 <?php 

							

						  }

						} else{ ?>

					<tr><td colspan="3">No record available</td></tr>

					<?php } ?>

					 </tbody>

			    </table>

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



<!-- main container end -->



