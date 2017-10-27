<form action="indexrav.php" method="post">
<input type="text" name="refId"/>
<input type="submit" name="formSubmit" value="Submit">
</form>

<?php
$servername = "localhost";
$username = "ravebusi_master";
$password = "dhT!M%y)MQQ6";
$database = "ravebusi_gbe";

// Create connection
$conn = mysql_connect($servername, $username, $password);


mysql_select_db($database,$conn) or die( "Unable to select database");
 if(isset($_POST['formSubmit'])){
	 
	
 $Rosql="select * from rave_referralDetail WHERE  userId ='".$_REQUEST['refId']."' order by referrerLevel ASC";
$sql=mysql_query($Rosql);

?>
<table>
<tr>
<td>ID</td><td>myReferrer</td><td>referrerLevel</td><td>userId</td><td>invtAmt</td><td>refCommDate</td><td>refCommCount</td>
</tr>
<?php
$counter =0;
$sumInvt =0;
$sumrefComm=0;
$totalinvtAmt =0;
$total1refCommCount=0;
$sum=0;
$enable=0;

while ($row = mysql_fetch_array($sql)) {
	
	 if($counter==0)
	 {
		$firstVal= $row['referrerLevel'];
		$firestinvtAmt =$row['invtAmt'];
		$firstrefCommCount = $row['refCommCount'];
		$fisrtID = $row['id'];
		$firstreferrerLevel = $row['referrerLevel'];
		$firstmyReferrer = $row['myReferrer'];
		
		
		
	 }
	 if($counter>0)
	 {
		 
		  if($firstVal == $row['referrerLevel'])
		  {
			  $sum=$sum+$row['invtAmt'];
			  $sumrefComm=$sumrefComm + $row['refCommCount'];
			  $enable=1;
			  $arr[]=$row['id'];
			   
		  }
		 	  		  
		  
	 }
	 
	?>
	<tr>
	<td align='center'><?php echo $row['id']; ?></td>
	<td align='center'><?php echo $row['myReferrer'];?></td>
	<td align='center'><?php echo $row['referrerLevel'];?></td>
	<td align='center'><?php echo $row['userId'];?></td>
	<td align='center'><?php echo $row['invtAmt'];?></td>
	<td align='center'><?php echo $row['refCommDate'];?></td>
	<td align='center'><?php echo $row['refCommCount'];?></td>
    </tr>	
	<?php
	$counter++;
	
}
 if($enable == 1) 
 {
$totalinvtAmt = $sum + $firestinvtAmt;
$total1refCommCount = $firstrefCommCount + $sumrefComm;

  $updateSql="UPDATE rave_referralDetail SET
invtAmt=".$totalinvtAmt.",refCommCount=".$total1refCommCount." WHERE myReferrer=".$firstmyReferrer." AND 
referrerLevel=".$firstreferrerLevel." AND userId=".$_REQUEST['refId']." AND id=".$fisrtID;
 mysql_query($updateSql);
 

for($i=0;$i<count($arr);$i++)
{
	    $delSql="DELETE FROM  rave_referralDetail  WHERE id ='".$arr[$i]."'";
	  print "<br/>";
	  mysql_query($delSql);
}

 }


}
?>

