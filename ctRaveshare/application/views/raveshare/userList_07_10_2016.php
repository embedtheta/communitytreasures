<html>
<head><u>User List </u></head>
<body>
<div>Total User : <?php echo $totalUser;?> </div>
<div>Total Active User : <?php echo $totalActiveUser;?> </div>
<div>Total Inactive User : <?php echo $totalInactiveUser;?> </div>

<div>
<table cellpadding="3" cellspacing="3" border="1" width="70%">
<tr bgcolor="#99FF99" >
<td><b><font color='#000000' size='-1' face='Courier New, Courier, mono'>first Name</font></b></td>
<td><b><font color='#000000' size='-1' face='Courier New, Courier, mono'>last Name</font></b></td>
<td><b><font color='#000000' size='-1' face='Courier New, Courier, mono'>User Name</font></b></td>
<td><b><font color='#000000' size='-1' face='Courier New, Courier, mono'>Email ID</font></b></td>
<td><b><font color='#000000' size='-1' face='Courier New, Courier, mono'>Password</font></b></td>
<td><b><font color='#000000' size='-1' face='Courier New, Courier, mono'>User Status</font></b></td>
</tr>
<tr><td colspan="6"></td></tr>
<?php 
		if(count($userListDetail)>0){
		foreach($userListDetail as $userLists){
	
			?>
<tr><td><?php echo $userLists['firstName']; ?></td>
<td><?php echo $userLists['lastName']; ?></td>
<td><?php echo $userLists['userName']; ?></td>
<td><?php echo $userLists['emailID']; ?></td>
<td><?php echo $userLists['password']; ?></td>
<td><?php if($userLists['afrooPaymentStatus']==1) { echo "Active"; }else { echo "Inactive";} ?></td>
</tr>


		<?php } 
		}?>
</table>
</div>
</body>
</html>

