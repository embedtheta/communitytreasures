<html>

<head>
<title>User List</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
  <script type="text/javascript">
  	
  	$(document).ready(function() {
    $('#example').DataTable();
} );
  </script>
</head>

<body>
<div class="container">
 <div class="row">
 <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-612 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Get Sponsor Details by Email</div>
                       
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" action="" method="post">
                                 <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-6 controls">
                                      <input id="login-username" type="text" class="form-control" name="emailID" value="" placeholder="Email ID">        
                                    </div>
                                    <div class="col-sm-6 controls">
                                      
                                      <input type="submit" name="search" value="Search" class="btn btn-success">
                                    </div>
                                </div>                               
                          </form>    

                        </div>                     
                    </div>  
        </div>
 </div>
  <?php if(count($userListDetail)>0){ 
/*echo "<pre>";
			print_r($userListDetail);
			echo "</pre>";*/
  	?>
 <h2>User Details:</h2>
 <div class="row">
  <div class="col-sm-12 table-responsive">

<table id="example" class="table table-striped table-bordered table-sm" width="100%" cellspacing="0">
        <thead>
             <tr>
		        <th>Firstname</th>
		        <th>Lastname</th>
		        <th>Email</th>
		        <th>Password</th>
		        <th>User Status</th>
		        <th>Action</th>
		      </tr>
        </thead>
        <!--<tfoot>
            <tr>
                <th>Firstname</th>
		        <th>Lastname</th>
		        <th>Email</th>
		        <th>Q</th>
		        <th>Positing</th>
		        <th>My income</th>
		        <th>Active Commission</th>
		        <th>Inviters commission</th>
		        <th>Founders commission</th>
		        <th>Password</th>
		        <th>User Status</th>
            </tr>
        </tfoot>-->
        <tbody>
    <?php 

		if(count($userListDetail)>0){

		foreach($userListDetail as $userLists){

	       $referralSum = $userLists['referralSum'];
           // $income_array = get_commission_array($userLists['myReferalTotal'],$referralSum);
            $income_array = $userLists['income_array'];
           /* echo "<pre>";
            print_r($income_array);
            echo "</pre>";*/
            
            $total_income = $income_array['total_income'];
            $active_commission = $income_array['active_commission'];
            $inviters_commission = $income_array['inviters_commission'];
            $founders_commission = $income_array['founders_commission'];

			?>
      <tr>
		<td><small><?php echo $userLists['firstName']; ?></small></td>
		<td><small><?php echo $userLists['lastName']; ?></small></td>
		<td><small><?php echo $userLists['emailID']; ?></small></td>
		<td><small><?php echo substr($userLists['password'], 0,30); ?></small></td>

		<td><?php if($userLists['afrooPaymentStatus']==1) { echo "Active"; }else { echo "Inactive";} ?></td>
		<td>
 <?php if(empty($userLists['userPaymentStatus'])){ 

        $referrerId = $userLists['referarID'];
		$uID = $userLists['uID'];
		$idlink = base64_encode($referrerId.'#'.$uID);

		$signUpLink = 'signup/commonSignUpForFounder/'.$idlink;
		/*echo "<br>".$resendlink1 = $referrerId.'#'.$userLists['userType'].'#'.$uID.'#'.$userLists['userName'].'#'.$userLists['emailID']; */
		$resendlink = base64_encode($referrerId.'#'.$userLists['userType'].'#'.$uID.'#'.$userLists['userName'].'#'.$userLists['emailID']); 
 	?>
 	<a href="https://www.communitytreasures.co/<?php echo $signUpLink; ?>" target="_blank">Payment Link</a>&nbsp;|&nbsp;
					<a href="http://www.communitytreasures.co/ctRaveshare/message/reSendInvitationMailToSponsor?link=<?php echo $resendlink; ?>" target="_blank"><img src="<?php echo base_url();?>images/resend.png" width="30" height="30" title="Resend Invitation"/></a>
                     <?php } ?>
		</td>
      </tr>
      <?php } 

		}?>
     
    </tbody>
    </table>
    </div>
 
</div>

 <h2>Sponsor List:</h2>
 <div class="row">
  <div class="col-sm-12 table-responsive">
 

 <table id="example" class="table table-striped table-bordered table-sm" width="100%" cellspacing="0">
					 <thead>
					  <tr>	
					    <th>User Id </th>
					    <th>Firstname</th>
		                <th>Lastname</th>
						<th>User Name </th>	
						<th>Password </th>							
						<th>Referal User Name </th>
						<th>Referral Email </th>
						<th>Payment Link</th>
						<th>Action</th>
					  </tr>	
					   </thead>
                     <!-- <tfoot>
                        <tr>
                        <th>User Id </th>	
						<th>User Name </th>	
						<th>Level </th>							
						<th>Days Worked </th>
						<th>Referral Commission </th>
                        </tr>
                       </tfoot>-->
                     <tbody>				 
					 <?php if(isset($userListDetail[0]['sponsorList']) && count($userListDetail[0]['sponsorList'])>0){
	foreach($userListDetail[0]['sponsorList'] as $key=>$sponsorList){
		/*echo "<pre>";
		print_r($sponsorList);
		echo "</pre>";*/
		$referrerId = $sponsorList['referarID'];
		$uID = $sponsorList['uID'];
		$idlink = base64_encode($referrerId.'#'.$uID);

		$signUpLink = 'signup/commonSignUpForFounder/'.$idlink;
		$resendlink = base64_encode($referrerId.'#'.$sponsorList['userType'].'#'.$uID.'#'.$sponsorList['userName'].'#'.$sponsorList['emailID']); 
						 ?>
				<tr>
				    <th><?php echo $sponsorList['uID']; ?> </th>
				    <td style="text-align:center;" ><?php echo $sponsorList['firstName']; ?></td>
					<td style="text-align:center;"><?php  echo $sponsorList['lastName']; ?></td>
					<td style="text-align:center;" class="tabreferralsdetails"><?php echo $sponsorList['emailID']; ?></td>
					<td style="text-align:center;" ><?php echo $sponsorList['password']; ?></td>
					<td style="text-align:center;"><?php echo $userListDetail[0]['sponsorList'][$key+1]['firstName']; ?></td>
					<td style="text-align:center;"><?php echo $userListDetail[0]['sponsorList'][$key+1]['emailID']; ?>
						<?php //print_r($sponsorList['userPaymentStatus']); ?>
						
					</td>
					<td style="text-align:center;">
                     <?php if(empty($sponsorList['userPaymentStatus'])){ ?>
					<a href="https://www.communitytreasures.co/<?php echo $signUpLink; ?>" target="_blank">Payment Link</a>
                     <?php } ?>
					</td>
					<th>
 <?php if(empty($sponsorList['userPaymentStatus'])){ ?>
					<a href="http://www.communitytreasures.co/ctRaveshare/message/reSendInvitationMailToSponsor?link=<?php echo $resendlink; ?>" target="_blank"><img src="<?php echo base_url();?>images/resend.png" width="30" height="30" title="Resend Invitation"/></a>
                     <?php } ?>
					 </th>
				</tr>
						 <?php 
						  }
						} else{ ?>
					<tr><td colspan="4">No record available</td></tr>
					<?php } ?>
					 </tbody>
			    </table>
</div>
</div>
</div>
<?php 
}
else{
	?>
<div class="row">
<div class="col-sm-12 table-responsive">
<div class="alert alert-info">
<strong>Sorry there is no record exist in our record.</strong> 
</div>
</div>
</div>
<?php
}
?>
</body>

</html>



