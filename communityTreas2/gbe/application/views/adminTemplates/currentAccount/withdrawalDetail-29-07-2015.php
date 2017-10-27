  
 <!-- <link rel="stylesheet" href="/resources/demos/style.css">-->
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  
  // payment Approve / Reject Function 
  function paymentAction(tblId,uId,acTion,reqCurAmt){
	 // alert("==="+acTion);
	 if(uId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>admin/paymentAction", 
			 data: "tblId="+tblId+"&userId="+uId+"&acTion="+acTion+"&reqCurAmt="+reqCurAmt,
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
							$("#actionId_"+uId).html('<span class="approved">In Process</span>');
							$("#statusId_"+uId).html('Approved');							
						}
						else{
							$("#actionId_"+uId).html('<span class="reject">Rejected</span>');
							$("#statusId_"+uId).html('Rejected');
						}						
								
					}
					else{
						alert('some error ');
					}
				  }
			  });
		} 
  }
  </script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
<?php $this->load->view('adminTemplates/common/header',$viewData);?>
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
	 <li><a href="#tabs-5">Daily Exchange Rate</a></li>
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
		<td height="38" align="center" valign="middle" id="statusId_<?php echo $withdrawDataDetail['uID']; ?>"><?php echo $status;?></td>
		<td height="38" align="center" valign="middle" id="actionId_<?php echo $withdrawDataDetail['uID']; ?>">
		<?php if($withdrawDataDetail['status']==0){ ?>
			<span class="approved" onClick="paymentAction(<?php echo $withdrawDataDetail['id']; ?>,<?php echo $withdrawDataDetail['uID']; ?>,'A','<?php echo $userCurr." ".$withdrawDataDetail['paymentAmt'];?>');">Approve</span>&nbsp;
			<span class="reject" onClick="paymentAction(<?php echo $withdrawDataDetail['id']; ?>,<?php echo $withdrawDataDetail['uID']; ?>,'R','<?php echo $userCurr." ".$withdrawDataDetail['paymentAmt'];?>');">Reject</span><?php } 
		else if($withdrawDataDetail['status']==1){
			?>
			<span class="approved">In Process</span>
			<?php
		} else if($withdrawDataDetail['status']==2){
			?>
			<span class="reject">Rejected</span>
			<?php 
		}
		else {
			?>
			<span class="reject">Approved</span>
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
  <!--<tr>
    <td height="38" align="center" valign="middle">name 1</td>
    <td height="38" align="center" valign="middle">Level - I</td>
    <td height="38" align="center" valign="middle">$1,500.00</td>
    <td height="38" align="center" valign="middle">10-07-2015</td>
    <td height="38" align="center" valign="middle">10-07-2015</td>
    <td height="38" align="center" valign="middle">Approved</td>
    <td height="38" align="center" valign="middle"></td>
  </tr>
  <tr>
    <td height="38" align="center" valign="middle">name 2</td>
    <td height="38" align="center" valign="middle">Level - I</td>
    <td height="38" align="center" valign="middle">$1,500.00</td>
    <td height="38" align="center" valign="middle">10-07-2015</td>
    <td height="38" align="center" valign="middle">10-07-2015</td>
    <td height="38" align="center" valign="middle">Approved</td>
    <td height="38" align="center" valign="middle">
    <span class="approved">Approve</span>
    <span class="reject">Reject</span>
    </td>
  </tr>-->
   
</table>

    </div>
  </div>
  <div id="tabs-2" style="display:none;">
    sfsdfsf
  </div>
  <div id="tabs-3" style="display:none;">
  sdfsdsdsd
  </div>
  <div id="tabs-4" style="display:none;">
  sdfsdsdsd
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