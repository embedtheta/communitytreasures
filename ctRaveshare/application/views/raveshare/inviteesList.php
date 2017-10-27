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
                        <div class="panel-title">Get Referance Details by Email</div>
                       
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
  <?php if(count($userListDetail)>0){ ?>
 <h2>User Details:</h2>
 <div class="row">
  <div class="col-sm-12 table-responsive">

<table id="example" class="table table-striped table-bordered table-sm" width="100%" cellspacing="0">
        <thead>
             <tr>
		        <th>Firstname</th>
		        <th>Lastname</th>
		        <th>Email</th>
		        <th>Q</th>
		        <th>Position</th>
		        <th>My income</th>
		        <th>Active Commission</th>
		        <th>Inviters commission</th>
		        <th>Founders commission</th>
		        <th>Password</th>
		        <th>User Status</th>
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

		
		<td><small><?php 
            if(isset($userLists['myReferalTotal'][0])){
        echo $userLists['myReferalTotal'][0]['level'];  
        // echo "<br/>Counter:".$userLists['myReferalTotal'][0]['counter']; 
       //  echo "<br/>raveType:".$userLists['myReferalTotal'][0]['raveType']; 
             	
            }
		 ?></small>
		
		</td>
		<td>
		<?php 
            if(isset($userLists['myReferalTotal'][0])){
        echo $userLists['myReferalTotal'][0]['userPosition']-1; 
           	
            }
		 ?>
		</td>
		<td>
		<?php 
           echo round($total_income,2);
		 ?>
		</td>
		<td>
		<?php 
		echo round($active_commission,2);
            
		 ?>
		</td>
		<td>
		<?php 
		echo round($inviters_commission,2);
          
		 ?>
		</td>
		<td>
		<?php 
         echo round($founders_commission,2);
         
            
		 ?>
		</td>
		<td><small><?php echo substr($userLists['password'], 0,30); ?></small></td>

		<td><?php if($userLists['afrooPaymentStatus']==1) { echo "Active"; }else { echo "Inactive";} ?></td>
      </tr>
      <?php } 

		}?>
     
    </tbody>
    </table>
    </div>
 
</div>

 <h2>Invitees List:</h2>
 <div class="row">
  <div class="col-sm-12 table-responsive">
 

 <table id="example" class="table table-striped table-bordered table-sm" width="100%" cellspacing="0">
					 <thead>
					  <tr>	
					    <th>User Id </th>
						<th>User Name </th>	
						<th>Level </th>							
						<th>Days Worked </th>
						<th>Referral Commission </th>
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
					 <?php if(isset($userListDetail[0]['myReferalCommDetail']) && count($userListDetail[0]['myReferalCommDetail'])>0){
	foreach($userListDetail[0]['myReferalCommDetail'] as $myReferalCommDetails){
			
						 ?>
				<tr>
				    <th><?php echo $myReferalCommDetails['userId']; ?> </th>
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



