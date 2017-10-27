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
  <div class="col-sm-12">
  <h2>User List:</h2>
 <div>Total User : <?php echo $totalUser;?> </div>

<div>Total Active User : <?php echo $totalActiveUser;?> </div>

<div>Total Inactive User : <?php echo $totalInactiveUser;?> </div>
</div>
</div>
 <div class="row">
  <div class="col-sm-12 table-responsive">
 
<table id="example" class="table table-striped table-bordered table-sm" width="100%" cellspacing="0">
        <thead>
             <tr>
		        <th>Firstname</th>
		        <th>Lastname</th>
		        <th>Email</th>
		        <th>User Cycle</th>
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
		        <th>User Cycle</th>
		        <th>Q</th>
		        <th>position</th>
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
            //$income_array = get_commission_array($userLists['myReferalTotal'],$referralSum);
           $income_array = $userLists['income_array'];
            
            /*echo "<pre>";
            print_r($userLists);
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
        echo $userLists['myReferalTotal'][0]['userCycle'];  

            }
		 ?></small>
		
		</td>
		<td><small><?php 
            if(isset($userLists['myReferalTotal'][0])){
        echo $userLists['myReferalTotal'][0]['level'];  
         //echo "<br/>Counter:".$userLists['myReferalTotal'][0]['counter']; 
         //echo "<br/>raveType:".$userLists['myReferalTotal'][0]['raveType']; 
             	
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
		<td><small><?php echo substr($userLists['password'], 0,40); ?></small></td>

		<td><?php if($userLists['afrooPaymentStatus']==1) { echo "Active"; }else { echo "Inactive";} ?></td>
      </tr>
      <?php } 

		}?>
     
    </tbody>
    </table>
    </div>
 
</div>
</div>

</body>

</html>



