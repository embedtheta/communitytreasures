  <?php $this->load->view('adminTemplates/common/header',$viewData);?>
 <!-- <link rel="stylesheet" href="/resources/demos/style.css">-->
  <script>
/*  $(function() {
    $( "#tabs" ).tabs();
  });*/
  
  // payment Approve / Reject Function 
  function paymentAction(tblId,uId,acTion,reqCurAmt,cycleDate){
	 // alert("==="+acTion);
	 if(uId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>admin/paymentAction", 
			 data: "tblId="+tblId+"&userId="+uId+"&acTion="+acTion+"&reqCurAmt="+reqCurAmt+"&cycleDate="+cycleDate,
			 cache:false,
			 dataType: "json",
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data.success == "yes")
					{	
						alert(data.msg);
						if(acTion=='A')
						{
							$("#actionId_"+tblId).html('<span class="inprocess">In Process</span>');
							$("#statusId_"+tblId).html('In Process');	
							$("#penRowId_"+tblId).remove();
						}
						else{
							$("#actionId_"+tblId).html('<span class="reject">Rejected</span>');
							$("#statusId_"+tblId).html('Rejected');
						}						
								
					}
					else{
						alert('some error ');
					}
				  }
			  });
		} 
  }
  
  // show exchange rate 
  function showExchangeRate(){
	//alert('45 6777777777777777');  
	$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>admin/showCurrencyrate", 
			 data: "",
			 cache:false,
			 dataType: "json",
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data.success == "yes")
					{	
						//alert(data.msg);						
						$("#exRateId").html(data.exchangeTable);
							
					}
					else{
						alert('some error ');
					}
				  }
			  });
  }
  </script>
<!--  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
  <!--  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
    <script>
   jQuery(function() {
    jQuery( "#tabs" ).tabs();
  });
  </script>

<!--Main Content-->
  <div class="content-wrapper">
  
  
  
  
  
  
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Current Account System - Loan/Credit Request</h2>
            
            <h3 align="right">
<!--                 <a href="<?php echo base_url();?>admin/addProduct">Add</a>-->
            </h3>
        </div>
        <!--<div class="exchange-rate">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="2" align="left" valign="top">
<h2><span>Today’s</span><br />
Exchange Rate</h2>
<p>25th Aug 2015</p>
    </td>
    <td align="left" valign="top">
    $1 = € 0.0000<br />
	$1 = € 0.0000
    </td>
    <td align="left" valign="top">$1 = € 0.0000<br />
	$1 = € 0.0000</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
</table>

        </div>-->
      <div class="withdrow-tab">
        <div id="tabs">
  <ul>
    <li class="current"><a href="#tabs-1">All Request</a></li>
    <li><a href="#tabs-2">Pending</a></li>
    <li><a href="#tabs-3">Approve</a></li>
     <li><a href="#tabs-4">Payment Due</a></li>
	 <li><a href="#tabs-5" onClick="showExchangeRate();">Daily Exchange Rate</a></li>
  </ul>
  <br class="clear" />
  <div id="tabs-1">
    <div class="table-wrapper">
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
  <thead>
<tr>
    <th height="38" align="center" valign="middle">Name</th>
    <th height="38" align="center" valign="middle">Level</th>
    <th height="38" align="center" valign="middle">Loan Amount</th>
   <th height="38" align="center" valign="middle">Request Date</th>
    <th height="38" align="center" valign="middle">Cycle Date</th>
    <th height="38" align="center" valign="middle">Status</th>
    <th height="38" align="center" valign="middle">Action</th>
</tr>
  </thead>
  <?php 
	$cycleDate1gap = strtotime($cycleDate1.' - 1 week');
	$cycleDate2gap = strtotime($cycleDate2.' - 1 week'); 
	//echo "+++++++".date('d-m-Y',$cycleDate1gap);
	if(count($withdrawData)>0)
	{
	foreach($withdrawData as $withdrawDataDetail){ 
		//echo "+++++++".$withdrawDataDetail['status'];
		$status = "";
		if($withdrawDataDetail['status']==1){
			$status = "In Process";
		}
		else if($withdrawDataDetail['status']==2){
			$status = "Rejected";
		}
		else if($withdrawDataDetail['status']==0){
			$status = "Pending";
		}
		else{
			$status = "Approved";
		}
		if(strtotime($withdrawDataDetail['createdDate']) < $cycleDate1gap){
			$NextCycleDate = $cycleDate1;
		}
		else if(strtotime($withdrawDataDetail['createdDate']) < $cycleDate2gap){
			$NextCycleDate = $cycleDate2;
		}
		else{
			$NextCycleDate = date('d-m-Y', strtotime($cycleDate1.'+ 1 month'));
		}
		
		if($withdrawDataDetail['currency']==1){
			$userCurr = '$';
		}
		else if($withdrawDataDetail['currency']==2){
			$userCurr = '£';
		}
		else{
			$userCurr = '€';
		}
  
  ?>
	  <tr>
		<td height="38" align="center" valign="middle"><?php echo $withdrawDataDetail['firstName']." ".$withdrawDataDetail['lastName'];?></td>
		<td height="38" align="center" valign="middle"><?php echo $withdrawDataDetail['userLevel'];?></td>
		<td height="38" align="center" valign="middle"><?php echo $userCurr." ".$withdrawDataDetail['paymentAmt'];?></td>
		<td height="38" align="center" valign="middle"><?php echo $withdrawDataDetail['createdDate'];?></td>
		<td height="38" align="center" valign="middle"><?php echo $NextCycleDate; ?></td>
		<td height="38" align="center" valign="middle" id="statusId_<?php echo $withdrawDataDetail['id']; ?>"><?php echo $status;?></td>
		<td height="38" align="center" valign="middle" id="actionId_<?php echo $withdrawDataDetail['id']; ?>">
		<?php if($withdrawDataDetail['status']==0){ ?>
			<span class="inprocess" onClick="paymentAction(<?php echo $withdrawDataDetail['id']; ?>,<?php echo $withdrawDataDetail['uID']; ?>,'A','<?php echo $userCurr." ".$withdrawDataDetail['paymentAmt'];?>','<?php echo $NextCycleDate; ?>');">Approve</span>&nbsp;
			<span class="reject" onClick="paymentAction(<?php echo $withdrawDataDetail['id']; ?>,<?php echo $withdrawDataDetail['uID']; ?>,'R','<?php echo $userCurr." ".$withdrawDataDetail['paymentAmt'];?>','<?php echo $NextCycleDate; ?>');">Reject</span><?php } 
		else if($withdrawDataDetail['status']==1){
			?>
			<span class="inprocess">In Process</span>
			<?php
		} else if($withdrawDataDetail['status']==2){
			?>
			<span class="reject">Rejected</span>
			<?php 
		}
		else {
			?>
			<span class="approved">Approved</span>
			<?php
		}?></td>
	  </tr>
  
  <?php } 
	}
	else{
		?>
		<tr><td colspan="7" height="38" align="center" valign="middle" >&nbsp;No data </td></tr>
		<?php
		
	}?> 
   
</table>

    </div>
  </div>
  <div id="tabs-2" style="display:none;">
   <div class="table-wrapper">
   <table width="100%" border="0" cellspacing="1" cellpadding="1">
  <thead>
<tr>
    <th height="38" align="center" valign="middle">Name</th>
    <th height="38" align="center" valign="middle">Level</th>
    <th height="38" align="center" valign="middle">Loan Amount</th>
   <th height="38" align="center" valign="middle">Request Date</th>
    <th height="38" align="center" valign="middle">Cycle Date</th>
    <th height="38" align="center" valign="middle">Status</th>
    <th height="38" align="center" valign="middle">Action</th>
</tr>
  </thead> 
  <?php 
	$cycleDate1gaptab2 = strtotime($cycleDate1.' - 1 week');
	$cycleDate2gaptab2 = strtotime($cycleDate2.' - 1 week'); 
	//echo "+++++++".date('d-m-Y',$cycleDate1gap);
	if(count($withdrawData)>0)
	{
		
	foreach($withdrawData as $withdrawDataDetailtab2){ 
		//echo "+++++++".$withdrawDataDetail['status'];
		$status = "";
		 
		if($withdrawDataDetailtab2['status']==0 ){
			$status = "Pending";
		    
			if(strtotime($withdrawDataDetailtab2['createdDate']) < $cycleDate1gaptab2){
				$NextCycleDate = $cycleDate1;
			}
			else if(strtotime($withdrawDataDetailtab2['createdDate']) < $cycleDate2gaptab2){
				$NextCycleDate = $cycleDate2;
			}
			else{
				$NextCycleDate = date('d-m-Y', strtotime($cycleDate1.'+ 1 month'));
			}
			
			if($withdrawDataDetailtab2['currency']==1){
				$userCurrtab2 = '$';
			}
			else if($withdrawDataDetailtab2['currency']==2){
				$userCurrtab2 = '£';
			}
			else{
				$userCurrtab2 = '€';
			}
	  
	  ?>
		  <tr id="penRowId_<?php echo $withdrawDataDetailtab2['id']; ?>">
			<td height="38" align="center" valign="middle"><?php echo $withdrawDataDetailtab2['firstName']." ".$withdrawDataDetailtab2['lastName'];?></td>
			<td height="38" align="center" valign="middle"><?php echo $withdrawDataDetailtab2['userLevel'];?></td>
			<td height="38" align="center" valign="middle"><?php echo $userCurrtab2." ".$withdrawDataDetailtab2['paymentAmt'];?></td>
			<td height="38" align="center" valign="middle"><?php echo $withdrawDataDetailtab2['createdDate'];?></td>
			<td height="38" align="center" valign="middle"><?php echo $NextCycleDate; ?></td>
			<td height="38" align="center" valign="middle" ><?php echo $status;?></td>
			<td height="38" align="center" valign="middle" >
			<?php if($withdrawDataDetailtab2['status']==0){ ?>
				<span class="inprocess" onClick="paymentAction(<?php echo $withdrawDataDetailtab2['id']; ?>,<?php echo $withdrawDataDetailtab2['uID']; ?>,'A','<?php echo $userCurr." ".$withdrawDataDetailtab2['paymentAmt'];?>','<?php echo $NextCycleDate; ?>');">Approve</span>&nbsp;
				<span class="reject" onClick="paymentAction(<?php echo $withdrawDataDetailtab2['id']; ?>,<?php echo $withdrawDataDetailtab2['uID']; ?>,'R','<?php echo $userCurr." ".$withdrawDataDetailtab2['paymentAmt'];?>','<?php echo $NextCycleDate; ?>');">Reject</span><?php } 
			?></td>
		  </tr>
	  
	  <?php 
		}
		else{
			
			?>
		<!--<tr><td colspan="7" height="38" align="center" valign="middle" >&nbsp;No data </td></tr>-->
		<?php
		}
	  } 
	}
	?>
  
  
  </table>
   </div>
  </div>
  <div id="tabs-3" style="display:none;">
  <div class="table-wrapper">
   <table width="100%" border="0" cellspacing="1" cellpadding="1">
  <thead>
<tr>
    <th height="38" align="center" valign="middle">Name</th>
    <th height="38" align="center" valign="middle">Level</th>
    <th height="38" align="center" valign="middle">Loan Amount</th>
   <th height="38" align="center" valign="middle">Request Date</th>
    <th height="38" align="center" valign="middle">Cycle Date</th>
    <th height="38" align="center" valign="middle">Status</th>
    <!--<th height="38" align="center" valign="middle">Action</th>-->
</tr>
  </thead> 
  <?php 
	$cycleDate1gaptab3 = strtotime($cycleDate1.' - 1 week');
	$cycleDate2gaptab3 = strtotime($cycleDate2.' - 1 week'); 
	//echo "+++++++".date('d-m-Y',$cycleDate1gap);
	if(count($withdrawData)>0)
	{
		
	foreach($withdrawData as $withdrawDataDetailtab3){ 
		//echo "+++++++".$withdrawDataDetail['status'];
		$status3 = "";
		 
		if($withdrawDataDetailtab3['status']==3 ){
			$status3 = "Approved";
		    
			if(strtotime($withdrawDataDetailtab3['createdDate']) < $cycleDate1gaptab3){
				$NextCycleDate = $cycleDate1;
			}
			else if(strtotime($withdrawDataDetailtab3['createdDate']) < $cycleDate2gaptab3){
				$NextCycleDate = $cycleDate2;
			}
			else{
				$NextCycleDate = date('d-m-Y', strtotime($cycleDate1.'+ 1 month'));
			}
			
			if($withdrawDataDetailtab3['currency']==1){
				$userCurrtab3 = '$';
			}
			else if($withdrawDataDetailtab3['currency']==2){
				$userCurrtab3 = '£';
			}
			else{
				$userCurrtab3 = '€';
			}
	  
	  ?>
		  <tr>
			<td height="38" align="center" valign="middle"><?php echo $withdrawDataDetailtab3['firstName']." ".$withdrawDataDetailtab3['lastName'];?></td>
			<td height="38" align="center" valign="middle"><?php echo $withdrawDataDetailtab3['userLevel'];?></td>
			<td height="38" align="center" valign="middle"><?php echo $userCurrtab3." ".$withdrawDataDetailtab3['paymentAmt'];?></td>
			<td height="38" align="center" valign="middle"><?php echo $withdrawDataDetailtab3['createdDate'];?></td>
			<td height="38" align="center" valign="middle"><?php echo $NextCycleDate; ?></td>
			<td height="38" align="center" valign="middle"><span class="approved">Approved</span></td>			
		  </tr>
	  
	  <?php 
		}
	  }
	}
		?>
  
  
  <!--<tr><td colspan="6" height="38" align="center" valign="middle" >&nbsp; Coming Soon</td></tr>-->
  </table>
   </div>
  </div>
  <div id="tabs-4" style="display:none;">
  Payment Due <br>Coming Soon
  </div>
  <div id="tabs-5" style="display:none;">
   <!--Exchange Rate <br>Coming Soon-->
   <div id="exRateId">
   <!--<table width="100%" border="1" cellspacing="1" cellpadding="1" class="dollr_dsn">
  
		<tbody>
		<tr>
		<th colspan="4"><h3> Exchange rate of 31/07/2015</h3></th>
		</tr>
		<tr>
		<td>$ 1</td>
		<td><span>></span></td>
		<td>£ 0.643</td>
		<td>€ 0.923</td>
		</tr>
		<tr>
		<td>£ 1</td>
		<td><span>></span></td>
		<td>$ 1.555</td>
		<td>€ 1.435</td>
		</tr>
		<tr>
		<td>€ 1</td>
		<td><span>></span></td>
		<td>$ 1.083</td>
		<td>£ 0.697</td>
		</tr>
		</tbody>
	</table>-->
	</div>
  </div>
</div>
      </div>
      <!--Success-->
        <?php if($type != ''){ ?>
        <div class="admin-msg <?php echo $type;?>-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if($type == 'error'){ ?>
        <!--<div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>-->
        <?php } ?>
        <!--Error-->
        
        <!--Warning-->
        <!--<div class="admin-msg warning-msg">
            <i class="fa fa-warning"></i>  
                <span>Aenean interdum interdum ligula, vitae auctor nisl bibendum eu.</span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>-->
        <!--Error-->
        
        <div class="table-content">
       	  
        </div>
       
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  