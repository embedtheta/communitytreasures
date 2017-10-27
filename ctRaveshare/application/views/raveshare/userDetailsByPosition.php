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
    $(document).ready(function() {
    $("#userPosition").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
  </script>
</head>

<body>
<div class="container">
 <div class="row">
 <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-612 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Get User Details by User Position</div>
                       
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" action="" method="post">
                                 <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-6 controls">
                                    <?php
                                  
                                   $userPosition = (isset($userListDetail[0]["searchKey"]))?$userListDetail[0]["searchKey"]:'';
                                    ?>
                                      <input id="userPosition1" type="text" class="form-control" name="userPosition" value="<?php echo $userPosition; ?>" placeholder="User Position">        
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
            <th>User ID</th>
		        <th>Name & Email ID</th>
            <th>LC</th>
		        <th>Q</th>
		        <th>Position</th>
		        <th>My income</th>
		        <th>Active Commission</th>
		        <th>Inviters commission</th>
		        <th>Founders commission</th>
		        <th>Password</th>
            <th>Contingent</th>
            <th>Days Worked</th>
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
			
	/*		echo "<pre>";
			print_r($userLists);
			echo "</pre>";*/
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
            $contingent_commission = $income_array['contingent_commission'];
            $no_of_days_work = $income_array['no_of_days_work'];
            

			?>
      <tr>
    <td><small><?php echo $userLists['uID']; ?></small></td>
		<td>
    <small><?php echo $userLists['firstName']; ?></small>&nbsp;<small><?php echo $userLists['lastName']; ?></small></BR>
<small><?php echo $userLists['emailID']; ?></small>
    </td>

		

		
		<td><small><?php 
            if(isset($userLists['myReferalTotal'][0])){
        echo $userLists['myReferalTotal'][0]['userCycle'];  
        // echo "<br/>Counter:".$userLists['myReferalTotal'][0]['counter']; 
       //  echo "<br/>raveType:".$userLists['myReferalTotal'][0]['raveType']; 
             	
            }
		 ?></small>
		
		</td>
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
		<td><?php echo round($total_income,2); ?></td>
    <td><?php echo round($active_commission,2); ?></td>
    <td><?php echo round($inviters_commission,2); ?></td>
    <td><?php echo round($founders_commission,2); ?></td>
		<td><small><?php echo substr($userLists['password'], 0,30); ?></small></td>
    <td><?php echo round($contingent_commission,2); ?></td>
    <th><?php echo $no_of_days_work; ?></th>
		<td><?php if($userLists['afrooPaymentStatus']==1) { echo "Active"; }else { echo "Inactive";} ?></td>
      </tr>
      <?php
  }

		}?>
     
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
<strong>Sorry there is no record exist in our record.Please put some valid Email Id or User Position to get result.</strong> 
</div>
</div>
</div>
<?php
}
?>
</body>

</html>



