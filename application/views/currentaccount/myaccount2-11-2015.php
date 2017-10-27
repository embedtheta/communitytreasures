<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Community Level-<?php echo $userInfo[0]['userLevel'];?></title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,300,500,600,700,900,200' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Muli:400,400italic,300italic,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>
<script src="<?php echo base_url(); ?>js/organictabs.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>
<script type="text/javascript">
function tabFunction(tabClass,tabName){

	$(this).click(function(){ 
		$("."+tabClass).removeClass('current');
		$("#id_"+tabName).addClass("current");
		$(".div"+tabClass).hide();
		$("#"+tabName).show();
		
		
	});
}

$(document).ready(function() {
	jQuery('#mycarousel').jcarousel();
	$('#popUpDetail').css('display','none');
});
$(function() {
    
            $(".containertab").organicTabs({
                "speed": 200
            });
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
function getOtherCurrValue(){
	//alert('selected =============='+$('#selCurId').val());
	var selCurId = $('#selCurId').val();
	if(selCurId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>currentaccount/viewCurrencyRate", 
			 data: "selCurId="+selCurId,
			 cache:false,
			 dataType: "json",
			 success: 
				  function(data){
				  // alert(data);  //as a debugging message					
					if(data.success == "yes")
					{	
						$("#otherCurFirst").html(data.othercurr1);
						$("#otherCurSec").html(data.othercurr2);						
								
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
}



</script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<script>
$(document).ready(function(){
   /*  $(".click-tab").click(function(){ 
        $(".noti-details").toggle();
    }); */
	
	
	
	$(".noti-details").hide();
	//$("#p_1").show();
	$('.notification-section :first-child > h3').addClass('close');
	$('.notification-section :first-child > p').show();
    $(".click-tab").click(function(){
		var id = $(this).attr("id");
		$(".noti-details").hide();
		if($(this).hasClass('close')){
			$(".click-tab").removeClass('close');
			$(this).addClass('open');
			$("#p_"+id).hide();
		}else{
			$(".click-tab").removeClass('open');
			$(this).addClass('close');
			$("#p_"+id).show();
		}
		
    });
	
	// watch video added by SB on 07/09/2015
	$(".watch-video-tut").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
	});
	
});

function showPopUpDiv(transactionId,transactionType){
	if(transactionId!=""){
			//alert('===='+transactionId);
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>currentaccount/showPopUpDetail", 
			 data: "transactionId="+transactionId+"&transactionType="+transactionType,
			 cache:false,
			 dataType: "json",
			 success: 
				  function(data){
				  // alert(data);  //as a debugging message					
					if(data.success == "yes")
					{	//alert(data.tblData);
						$("#tableDataId").html(data.tblData);						
						$('#popUpDetail').css('display','block');		
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
	
}
function closePopUpDiv(){
	$('#popUpDetail').css('display','none');
}
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="popUpDetail" class="ppup01">
<div class="ppup_inr01">
<div class="switch mov_up"><a href="javascript:;" class="close_btn" title="Close" onClick="closePopUpDiv()"></a>
  <div class="transec_glce01" id="tableDataId">
   
   
  </div>
</div></div>
</div>

<div class="wrapper myac">
  
  
   <?php $this->load->view('header',$result);?>
  <!--header end-->
  <div class="nav"> 
  
  <!-- navigation start -->
  
  <?php $this->load->view('nav_header',$result);?>
  
  
  <!-- navigation end -->
  
  <div class="clear"></div>
</div>
  <div class="main_container cacc">
    <div class="lefts_side ">
	 <div class="tabsectionstep my_acnt_pgs">
      <div class="containertab">
        <ul class="tabs">
          <li><a class="current" href="#tab1" name="tab1">My Account</a></li>
          <li><a class="current" href="#tab2" name="tab2">All Transaction</a></li>
          <li><a class="current"  href="#tab3" name="tab3">Withdrawal Payment</a></li>
          <li><a class="current" href="#tab4" name="tab4">Notifications</a></li>
          <li><a class="current" href="#tab5" name="tab5">Reward Point</a></li>
		    
        </ul>
        <div class="tab_container">
          <div id="tab1" class="tab_content">
            <div class="white-bg">
              <div class="left_hding">
                <h3>My Wallet</h3>
                <p>You Are Currently On Level - <?php echo $userInfo[0]['userLevel'];?></p>
              </div>
              <div class="currncy_conv">
                <div class="credits_blc">
                  <ul>
                    <li>
                      <div class="crd_blc_dtl">
                        <h4>Current Balance</h4>
                        <h3><?php echo $currSymbol; ?><span id="BalanceChId" ><?php echo $balance; ?></span></h3>
                      </div>
                    </li>
                    <li>
                      <div class="crd_blc_dtl">
                        <h4>Withdrawal Amt.</h4>
                        <h3><?php echo $currSymbol." ".$withdrawalTotal; ?></h3>
                      </div>
                    </li>
                    <li>
                      <div class="crd_blc_dtl">
                        <h4>Credit Loan</h4>
                        <h3><?php echo $currSymbol." ".$liability; ?></h3>
                      </div>
                    </li>
                    <div class="clear"></div>
                  </ul>
                </div>
              </div>
              <div class="ab_inner"><strong><?php echo $stepWiseIncomeVideo[0]["A"]["serial_field"];?></strong>
                <h3 class="d_hdr"><!--My Income from GBE System--><?php echo $stepWiseIncomeVideo[0]["A"]["content_title"];?></h3>
                <span><a href="javascript:void(0)" name="<?php echo $stepWiseIncomeVideo[0]["A"]["path"];?>
" id="tutorial-videoS1" class="watch-video-tut">Watch Video</a></span> </div>
              <div class="table_tab_rd">
                <ul class="tabs_rd ">
                  <li><a class="tabClass current" id="id_tab6" onClick="tabFunction('tabClass','tab6');"  href="javascript: void(0);">User Commission</a></li>
                  <li ><a class="tabClass" id="id_tab7" onClick="tabFunction('tabClass','tab7');"  href="javascript: void(0);">Cycle Commission</a></li>
                  <li ><a class="tabClass" id="id_tab8" onClick="tabFunction('tabClass','tab8');"  href="javascript: void(0);">Reward Point</a></li>
                </ul>
                <br class="clear">
                <div class="tabfull marginbottom">
                  <div id="tab6" class="divtabClass">
                    <div class="transec_glce">
                      <h4>Child User Payment Details</h4>
                      <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
							<th>Transaction Id </th>
                            <th>User Name </th>
                            <th>User Level </th>
                            <th>Renewal Payment </th>
                            <th>Payment Date </th>
                            <th>My commission</th>
                          </tr>
                          <?php 
					  $paymentComTotal =0;
					  $paymentGrossTotal=0;
					  foreach($AllCom as $paymentCommDetail){
						  if($paymentCommDetail['paymentFor']=='L1 Switchon'){
						   
						  ?>
                          <tr>
						  <td onclick="showPopUpDiv(<?php echo $paymentCommDetail['transaction_Id']; ?>,'SwitchOn');"><?php echo $paymentCommDetail['transaction_Id']; ?></td>
                            <td><?php echo $paymentCommDetail['firstName']." ".$paymentCommDetail['lastName']; ?></td>
                            <td><?php echo $paymentCommDetail['userLevel']; ?></td>
                            <td style="text-align:right;"><?php echo $paymentCommDetail['paymentGrossAmt']; ?></td>
                            <td style="text-align:center;"><?php echo $paymentCommDetail['createdDate']; ?></td>
                            <td style="text-align:right;"><?php echo $paymentCommDetail['paymentAmt']; ?></td>
                          </tr>
                          <?php
						    $paymentComTotal	= $paymentComTotal+$paymentCommDetail['paymentAmt'];
							$paymentGrossTotal	= $paymentGrossTotal+$paymentCommDetail['paymentGrossAmt'];
						  }
					  }						 
					  ?>
                                                   
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div id="tab7" style="display:none;" class="divtabClass">
                    <div class="transec_glce">
                      <h4>Cycle User Payment Details</h4>
                      <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
                            <th>User Name </th>
                            <th>User Level </th>
                            <th>Renual Payment </th>
                            <th>Payment Date </th>
                            <th>My commission</th>
                          </tr>
                          <tr>
                            <td colspan="5">No record available</td>
                          </tr>
                         </tbody>
                      </table>
                    </div>
                  </div>
                  <div id="tab8" style="display:none;" class="divtabClass">
                    <div class="transec_glce"><br class="clear">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Coming Soon</div>
                  </div>
                </div>
              </div>
              <div class="ab_inner blu_ee"><strong><?php echo $stepWiseafroVideo[0]["B"]["serial_field"];?></strong>
                <h3 class="d_hdr"><?php echo $stepWiseafroVideo[0]["B"]["content_title"];?><!--My Income from Afrowebb --></h3>
                <span><a href="javascript:void(0)" name="<?php echo $stepWiseafroVideo[0]["B"]["path"];?>" id="tutorial-videoS1" class="watch-video-tut">Watch Video</a></span> </div>
              <div class="table_tab300">
                <ul class="tabs300 mar">
                  <!--<li><a class="tabClass1 current" id="id_tab9" onClick="tabFunction('tabClass1','tab9');" href="javascript: void(0);">Catalogue Selling</a></li>-->
                  <li><a class="tabClass1" id="id_tab10" onClick="tabFunction('tabClass1','tab10');" href="javascript: void(0);">Product Commission</a></li>
                  <li><a class="tabClass1" id="id_tab11" onClick="tabFunction('tabClass1','tab11');" href="javascript: void(0);">Reward Points</a></li>
                </ul>
                <br class="clear"/>
                <div class="tabfull marginbottom"> 
                  
                  <div id="tab10" class="divtabClass1" >
                    <div class="transec_glce">
                      <h4>Product Commission Selling Details</h4>
                      <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
                            <th>Transaction Id </th>
							<th>Product Name </th>
                            <th>Actual Price </th>
                            <th>Selling Date </th>
                            <th>My commission</th>
                          </tr>
                          <?php  
                        
                        $paymentComProTotal =0;
                          $paymentGrossProTotal=0;
                          foreach($productComm as $productCommDetail){?>
                          <tr>
                            <td onclick="showPopUpDiv('<?php echo $productCommDetail['transaction_Id']; ?>','Product');"><?php echo $productCommDetail['transaction_Id']; ?></td>
							<td><?php echo $productCommDetail['productName']; ?></td>
                            <!--<td>Level 1</td>-->
                            <td style="text-align:right;"><?php echo $productCommDetail['paymentGrossAmt']; ?></td>
                            <td style="text-align:center;"><?php echo $productCommDetail['createdDate']; ?></td>
                            <td style="text-align:right;"><?php echo $productCommDetail['paymentAmt']; ?></td>
                          </tr>
                          <?php
                                $paymentComProTotal	= $paymentComProTotal+$productCommDetail['paymentAmt'];
                                $paymentGrossProTotal	= $paymentGrossProTotal+$productCommDetail['paymentGrossAmt'];
                              
                          }						 
                          ?>
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div id="tab11" class="divtabClass1" style="display:none;">
                    <div class="transec_glce"><br class="clear">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Coming Soon</div>
                  </div>
                </div>
              </div>
              <div class="ab_inner blu_ee"><strong><?php echo $topUpVideo[0]["C"]["serial_field"];?></strong>
                <h3 class="d_hdr"><?php echo $topUpVideo[0]["C"]["content_title"];?><!--My Income from Afrowebb --></h3>
                <span><a href="javascript:void(0)" name="<?php echo $topUpVideo[0]["C"]["path"];?>" id="tutorial-videoS1" class="watch-video-tut">Watch Video</a></span> </div>
              <div class="table_tab300">
                <ul class="tabs300 mar">
                  <li><a href="javascript: void(0);" id="" class="current">Top Up</a></li>
                  
                </ul>
                <br class="clear">
                <div class="tabfull marginbottom">
                  <div class="" id="">
                    <div class="transec_glce">
                      <h4>My TopUp Details</h4>
                      <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
                            <th>Transaction Id</th>
                            <th>TopUp Date </th>
                            <th>Amount Selected </th>
                            <th>Status</th>
                          </tr>
                          <?php  
					  if(count($topUpAll)>0){
						
						  foreach($topUpAll as $topUpAllDetail){
							  ?>
                          <tr>
                            <td onclick="showPopUpDiv(<?php echo $topUpAllDetail['transaction_Id']; ?>,'TopUp');"><?php echo $topUpAllDetail['transaction_Id']; ?></td>
                            <td style="text-align:center;"><?php echo $topUpAllDetail['topUpDate']; ?></td>
                            <td style="text-align:right;" ><?php echo $topUpAllDetail['gross_total']; ?></td>
                            <td style="text-align:center;"><?php echo $topUpAllDetail['status']; ?></td>
                          </tr>
                          <?php
							   
						  }	
					  }	else{	?>
                          <tr>
                            <td colspan="4">No record available</td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab2" class="tab_content" style="display:none;"> 
            <!--All Transaction section-->
            <div class="currncy_lf">
              <div class="left_hding">
                <h3>All Transctions</h3>
                <p>You Are Currently On Level - <?php echo $userInfo[0]['userLevel'];?></p>
              </div>
              <div class="table_tab400">
                <ul class="tabs_400">
                  <li><a  class="tabClass2 current" id="id_tab12" onClick="tabFunction('tabClass2','tab12');" href="javascript: void(0);">Transaction from CommunityTreasures</a></li>
                  <li><a  class="tabClass2" id="id_tab13" onClick="tabFunction('tabClass2','tab13');" href="javascript: void(0);">Transaction from Afroweb</a></li>
                </ul>
                <br class="clear"/>
                <div class="tabfull marginbottom">
                  <div id="tab12" class="divtabClass2">
                    <div class="transec_glce">
                      <h4>All CommunityTreasures Transactions Details</h4>
                      <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
						  <th>Transaction Id </th>
                            <th>All CommunityTreasures Name </th>
                            <th>User Level </th>
                            <th>Gross Amount</th>
                            <th>Trans. Date</th>
                            <th> My commission</th>
                          </tr>
                          <?php 
					  $paymentComTotal =0;
					  $paymentGrossTotal=0;
					  foreach($AllCom as $paymentCommDetail){
						  if($paymentCommDetail['paymentFor']=='L1 Switchon'){
						   $level = "Level 1";
						  ?>
                          <tr>
						  <td onclick="showPopUpDiv(<?php echo $paymentCommDetail['transaction_Id']; ?>,'SwitchOn');"><?php echo $paymentCommDetail['transaction_Id']; ?></td>
                            <td><?php echo $paymentCommDetail['firstName']." ".$paymentCommDetail['lastName']; ?></td>
                            <td><?php echo $level; ?></td>
                            <td style="text-align:right;"><?php echo $paymentCommDetail['paymentGrossAmt']; ?></td>
                            <td style="text-align:center;"><?php echo $paymentCommDetail['createdDate']; ?></td>
                            <td style="text-align:right;"><?php echo $paymentCommDetail['paymentAmt']; ?></td>
                          </tr>
                          <?php
						    $paymentComTotal	= $paymentComTotal+$paymentCommDetail['paymentAmt'];
							$paymentGrossTotal	= $paymentGrossTotal+$paymentCommDetail['paymentGrossAmt'];
						  }
					  }						 
					  ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div id="tab13" class="divtabClass2" style="display:none;">
                    <div class="transec_glce">
                      <h4>All Afroweb Transactions Details</h4>
                      <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
                            <th>Transaction Id </th>
							<th>Afroweb Product </th>
                            <th>Actual Price </th>
                            <th>Selling Date </th>
                            <th> My commission</th>
                          </tr>
                          <?php 					 
					
					$paymentComProdTotal =0;
					  $paymentGrossProdTotal=0;
					  foreach($productComm as $productCommDetails){?>
                          <tr>
						  <td onclick="showPopUpDiv('<?php echo $productCommDetails['transaction_Id']; ?>','Product');"> <?php echo $productCommDetails['transaction_Id']; ?></td>
                            <td><?php echo $productCommDetails['productName']; ?></td>
                            <!--<td>Level 1</td>-->
                            <td style="text-align:right;"><?php echo $productCommDetails['paymentGrossAmt']; ?></td>
                            <td style="text-align:center;"><?php echo $productCommDetails['createdDate']; ?></td>
                            <td style="text-align:right;"><?php echo $productCommDetails['paymentAmt']; ?></td>
                          </tr>
                          <?php
						    $paymentComProdTotal	= $paymentComProdTotal+$productCommDetails['paymentAmt'];
							$paymentGrossProdTotal	= $paymentGrossProdTotal+$productCommDetails['paymentGrossAmt'];
						  
					  }						 
					 
					  ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--All Transaction section end--> 
          </div>
          <div id="tab3" class="tab_content" style="display:none;"> 
            <!--Withdrawal Payment section-->
            <div class="">
              <div class="left_hding">
                <h3>Withdrawal Payment</h3>
                <p>You Are Currently On Level - <?php echo $userInfo[0]['userLevel'];?></p>
              </div>
              <div class="clear"></div>
              <div class="table_tab withdraw-details">
                <div class="tabs mar"> 
                  <!-- <ul class="tabs mar">
				  <li><a href="#">Withdrawal Request</a></li>
               <li><a href="#">Topup Request</a></li>
   				  </ul>-->
                  <div class="tabfull wdr">
                    <div class="transec_glce wdrls">
                      <h4> Withdrawal Request Details</h4>
                      <div class="currentbalnc">
                        <h3>Your current Balance: <span><?php echo $currSymbol;?> <span id="balanceChIdWith"><?php echo $balance;?></span></span></h3>
                        <p>You can’t withdraw above your present balance</p>
                      </div>
                      <div class="clear"></div>
                      <form action="" method="post">
                        <p>
                          <input type="text" name="withdrawAmt" id="withdrawAmt" value="">
                          <input type="hidden" name="myBalance" id="myBalance" value="<?php echo $balance;?>">
                          <?php  if($withdrawStatus == 0){ ?>
                          <input type="button" value="Send Request" name="requestForWithdraw" class="deactivebtn" id="requestForWithdraw" disabled onclick="withdrawAmtCheck();">
                          <?php } else {
					?>
                          <input type="button" value="Send Request" name="requestForWithdraw" id="requestForWithdraw" onclick="withdrawAmtCheck();">
                          <?php
				}?>
                          <input name="" class="cancelClass" type="button" value="Cancel">
                        </p>
                      </form>
                      <p class="wdr_ppl"><strong>Your Paypal Account :</strong> <?php echo $paypalAc;?></p>
                    </div>
                  </div>
                </div>
              </div>
              <!--<div> Coming soon </div>-->
              <div class="transec_glce" style="display:block;">
                <h4>All Withdrawal Details</h4>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                  <tbody id="rowValId">
                    <tr>
                      <th>Withdrawal Date</th>
                      <th>Amount (<?php echo $currSymbol; ?>)</th>
                      <th>Balance</th>
                      <th>Remarks</th>
                    </tr>
                    <?php 
					  $WithdrawalTotal = "";
					  foreach($allWithdrawal as $allWithdrawalDetail) {
						  $currBalance='';
						  if($allWithdrawalDetail['status']==0){
								$status ="Pending";
								//$currBalance = $balance;
								
							}
							else if($allWithdrawalDetail['status']==1){
								$status ="In Process";
								$currBalance = $allWithdrawalDetail['commAmt']-$allWithdrawalDetail['paymentAmt'];
								//$lastBalance = $currBalance;								
							}
							else if($allWithdrawalDetail['status']==2){
								$status ="Rejected";
								$currBalance = $allWithdrawalDetail['commAmt']+$allWithdrawalDetail['paymentAmt'];
							}
							else{
								$status = "Approved";
								$currBalance = $allWithdrawalDetail['commAmt'];
							}
					  ?>
                    <tr>
                      <td style="text-align:center;"><?php echo $allWithdrawalDetail['createdDate']; ?></td>
                      <td style="text-align:right;"><?php echo $allWithdrawalDetail['paymentAmt']; ?></td>
                      <td style="text-align:right;"><?php echo  $currBalance;?></td>
                      <td><?php echo $status; ?></td>
                    </tr>
                    <?php 
					  $WithdrawalTotal = $WithdrawalTotal+$allWithdrawalDetail['paymentAmt'];
					  
					  }?>
                  </tbody>
                </table>
              </div>
            </div>
            <!--Withdrawal Payment section end--> 
            
          </div>
          <div id="tab4" class="tab_content" style="display:none;"> 
            <!--Credit status section-->
            <div class="">
              <div class="left_hding">
                <h3>Notifications</h3>
                <p>You Are Currently On Level - <?php echo $userInfo[0]['userLevel'];?></p>
              </div>
              <div class="notification-section">
                <?php if(count($notification)>0){
				 $i=1;
				 foreach($notification as $notificationDetail){?>
                <div class="notification-tab">
                  <h3 class="click-tab" id="<?php echo $notificationDetail['id']; ?>" onclick="readNot(<?php echo $notificationDetail['id']; ?>,<?php echo $notificationDetail['viewStatus']; ?>);"><?php echo $notificationDetail["notTitle"];?> <span><a href="#">Read</a></span></h3>
                  <p class="noti-details" id="p_<?php echo $notificationDetail['id']; ?>"  ><?php echo $notificationDetail["message"];?> </p>
                </div>
                <?php
				
					$i++;
					}
			 }?>
                <div class="notification-formmsec">
                  <h4>Type your Notification</h4>
                  <form action="" method="post">
                    <input name="notTitle" id="notTitle" type="text" value="" placeholder="Put you Subject here">
                    <textarea name="notMessage" id="notMessage" cols="" rows="" placeholder="Put you Massage Here"></textarea>
                    <input name="" type="button" value="Send Massage" class="button-blue" onClick="sendNotif()">
                    <input name="" type="button" value="Cancle" class="button-red" >
                  </form>
                </div>
              </div>
              <div class="credit_frm" style="display:none;">
                <h4>Loan Request</h4>
                <form action="" method="post">
                  <p>
                    <label>Amount</label>
                    <input name="" type="text">
                  </p>
                  <p>
                    <label>Reason</label>
                    <textarea name="" cols="" rows=""> </textarea>
                  </p>
                  <p>
                    <input name="" type="button">
                    <input name="" type="submit">
                  </p>
                </form>
              </div>
              <div class="transec_glce" style="display:none;">
                <h4>Loan Details</h4>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                  <tbody>
                    <tr>
                      <th>Apply Date </th>
                      <th>Sanctioned Date </th>
                      <th>Loan Amount (cash) </th>
                      <th>Reason </th>
                      <th>Status </th>
                    </tr>
                    <tr>
                      <td>10 Aug 2015 </td>
                      <td>22 Aug 2015 </td>
                      <td>$3454.00</td>
                      <td>View </td>
                      <td>Verified </td>
                    </tr>
                    <tr>
                      <td>10 Aug 2015 </td>
                      <td>22 Aug 2015 </td>
                      <td>$3454.00</td>
                      <td>View </td>
                      <td>Verified </td>
                    </tr>
                    <tr>
                      <td>10 Aug 2015 </td>
                      <td>22 Aug 2015 </td>
                      <td>$3454.00</td>
                      <td>View </td>
                      <td>Verified </td>
                    </tr>
                    <tr>
                      <td>10 Aug 2015 </td>
                      <td>22 Aug 2015 </td>
                      <td>$3454.00</td>
                      <td>View </td>
                      <td>Verified </td>
                    </tr>
                    <tr>
                      <td>10 Aug 2015 </td>
                      <td>22 Aug 2015 </td>
                      <td>$3454.00</td>
                      <td>View </td>
                      <td>Verified </td>
                    </tr>
                    <tr>
                      <td>10 Aug 2015 </td>
                      <td>22 Aug 2015 </td>
                      <td>$3454.00</td>
                      <td>View </td>
                      <td>Verified </td>
                    </tr>
                    <tr class="total_val">
                      <td colspan="2">Sanctioned Loan</td>
                      <td colspan="2">$440.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!--Credit status section end--> 
          </div>
          <div id="tab5" class="tab_content" style="display:none;">
            <div class="">Reward point <br>
              <br>
              <br>
              <br>
              <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Coming Soon</div>
          </div>
        </div>
      </div>
    </div>
	</div>
 <!-- left side end -->  
   <div class="rights_side currncy_rit">
      <div class="webbox redtop">
        <p>Your total notification is<span id="notCount">
          <?php  echo $unReadnotif;?>
          </span></p>
        <br class="clear">
      </div>
      <div class="webbox grnee"> <span><img alt="" src="<?php echo base_url();?>images/rit02.png"></span> <strong><?php echo $currSymbol;?> 50</strong>
        <p class="ggrl"> Monthly Subscription</p>
      </div>
      <div class="webbox mdle_blu">
        <h4>Account Information</h4>
        <p class="mydtls"><strong>My Currency</strong>:<strong><?php echo $myCurrency;?> (<?php echo $currSymbol;?>)</strong></p>
        <p class="mydtls"><strong>A/C Balance</strong>:<strong><?php echo $currSymbol;?> <span id="balanceChIdright"><?php echo $balance; ?></span></strong></p>
        <p class="mydtls"><strong>Total Reward Point</strong>:<strong><?php echo $totalRewardPoints; ?></strong></p>
      </div>
      <div class="webbox mdle_rd">
        <h4>Payment Received</h4>
        <p class="mydtls"><strong>This Week</strong>:<strong><?php echo $currSymbol." ".$thisWeek; ?></strong></p>
        <p class="mydtls"><strong>Last Week</strong>:<strong><?php echo $currSymbol." ".$lastWeek; ?></strong></p>
        <p class="mydtls"><strong>This Month</strong>:<strong><?php echo $currSymbol." ".$thisMonth; ?></strong></p>
        <p class="mydtls"><strong>Last Six Months</strong>:<strong><?php echo $currSymbol." ".$lastSixMonth; ?></strong></p>
      </div>
      <a class="top_btn href" href="<?php echo base_url()."currentaccount/topUp"; ?>">
      <div class="webbox redtop juu">
        <p>Top Up</p>
        <br class="clear">
      </div>
      </a>
      <div class="webbox mdle_rdse">
        <h4>Notifications</h4>
        <ul>
          <li><a href="#">Policy Update</a></li>
          <li><a href="#">My next CommunityTreasures renual Date</a></li>
          <!--<li><a href="#">Your Loan</a></li>-->
        </ul>
      </div>
      <div class="webbox mdle_rdsess">
        <h4>Business Details</h4>
        <form action="" method="post">
          <p>
            <label>User Name goes : </label>
            <?php echo $userName; ?><!--<input type="text" placeholder="Here">--><br class="clear">
          </p>
          <p>
            <label>Paypal Account : </label>
            <input type="text" placeholder="user@gmail.com">
            <br class="clear">
          </p>
          <p class="rqst_pp_acnt"><a href="#">Request to change you Paypal Account</a></p>
        </form>
      </div>
    </div>
    <br class="clear">
  </div>
</div>
<script type="text/javascript">
jQuery(function ($) {
	// Load dialog on click
	$('.palvidd').click(function (e) {
            $(this).next('.basic-modal-content').modal();
            return false; 
	});
        
	$('.clickopen').click(function () {
            $(this).next().slideToggle("slow");
	});
      
	
});

var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";


/*withdraw amount Check*/
function withdrawAmtCheck(){
	//alert($("#withdrawAmt").val()+"====="+$("#myBalance").val());
    var withdrawAmt = $.trim($("#withdrawAmt").val());
    var myBalance = $.trim($("#myBalance").val());
    
    if(withdrawAmt == "" || withdrawAmt == 0){ 
		$.fancybox.open("Please enter withdraw Amount.");
        $("#withdrawAmt").focus();
        return false;
    } 
	if(parseInt(withdrawAmt) > parseInt(myBalance)){
		
        $.fancybox.open("Please Enter amount equal or less than your account balance.");
        $("#withdrawAmt").focus();
        return false;
    }
       // alert('XYZ');
	$.ajax({ 
			 type: "POST",
			 url:  "<?php echo base_url();?>currentaccount/withdrawRequest", 
			 data: "withdrawAmt="+withdrawAmt,
			 cache:false,
			 dataType: "json",
			 success: 
				function(data){
				   //alert('==='+data.success);  //as a debugging message					
					if(data.success == "yes")
					{	
						//alert(data.withDrawalTable);
						$.fancybox.open("Withdrawal Request send successfully.");
						var newBal = (myBalance-withdrawAmt).toFixed(2);
						$("#withdrawAmt").val('');
						$("#requestForWithdraw").addClass('deactivebtn');
						$("#requestForWithdraw").attr('disabled', true);						
						$("#rowValId").html(data.withDrawalTable);
						$("#BalanceChId").html(newBal);
						$("#balanceChIdright").html(newBal);
						$("#balanceChIdWith").html(newBal);						
								
					}
					else{
						alert('some error ');
					}
				}
				
			});
     //return true;
}
/*end  of this section*/
/*withdraw amount Check*/
function loanAmtCheck(){
	//alert($("#withdrawAmt").val()+"====="+$("#myBalance").val());
    var loanAmt = $.trim($("#loanAmt").val());  
    
    if(loanAmt == "" || loanAmt == 0){ 
		$.fancybox.open("Please enter Loan Amount.");
        $("#loanAmt").focus();
        return false;
    } else{
        return true;
    } 
}
/*end  of this section*/
function sendNotif(){
	
	
	var notTitle = $.trim($("#notTitle").val());
	var notMessage = $.trim($("#notMessage").val());
	//notMessage    
    
	if(notTitle ==""){
		
        alert("Please Enter Notification Message");
        $("#notTitle").focus();
        return false;
    }
	if(notMessage ==""){
		
        alert("Please Enter Notification Message");
        $("#notMessage").focus();
        return false;
    }
       // alert('XYZ');
	$.ajax({ 
			 type: "POST",
			 url:  "<?php echo base_url();?>currentaccount/notificationSend", 
			 data: "notTitle="+notTitle+"&notMessage="+notMessage,
			 cache:false,
			 dataType: "json",
			 success: 
				function(data){
				   //alert('==='+data.success);  //as a debugging message					
					if(data.success == "yes")
					{	
						//alert(data.withDrawalTable);
						$.fancybox.open("Notification send successfully.");	
						$("#notTitle").val('');								
						$("#notMessage").val('');						
																	
								
					}
					else{
						alert('some error');
					}
				}
				
			});
     return true;
  }
  function readNot(id,viewStatus){
	 
	  if(viewStatus==0){
	  //alert('==========='+id);
		$.ajax({ 
			 type: "POST",
			 url:  "<?php echo base_url();?>currentaccount/notificationRead", 
			 data: "notId="+id,
			 cache:false,
			 dataType: "json",
			 success: 
				function(data){
				   //alert('==='+data.success);  //as a debugging message					
					if(data.success == "yes")
					{	
					}
					else{
						alert('some error');
					}
				}
				
			});
	  }
  }
</script> 
<script type='text/javascript' src='<?php echo base_url(); ?>js/custom_common.js'></script> 
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.simplemodal.js'></script>
<style>
.sm.extra-no-pad td{ 
    border:none;
}
.kk {
    display: block !important;
    float: none !important;
    height: auto;
    margin: 5px auto !important;
    width: 250px;
}
.pp{ 
    margin-left:0;
}
  </style>
</body>
</html>
