  <?php 
  if(isset($allUser)):
  	if(count($allUser) > 0 ){ ?>
  <div class="table-status">
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tbody>
        <tr>
          <th valign="middle" height="35" align="center" scope="col">Image</th>
          <th valign="middle" height="35" align="center" scope="col">Name</th>
          <th valign="middle" height="35" align="center" scope="col">Phone</th>
          <th valign="middle" height="35" align="center" scope="col">Email</th>
          <th valign="middle" height="35" align="center" scope="col">City</th>
          <th valign="middle" height="35" align="center" scope="col">Country</th>
          <th valign="middle" height="35" align="center" scope="col">User Type</th>
          <th valign="middle" height="35" align="center" scope="col">Expel</th>
          <?php if($this->session->userdata('userType') == "ADMIN"){?>
            <th valign="middle" height="35" align="center" scope="col">Delete</th>
          <?php } ?>
        </tr>
        <?php foreach($allUser as $ald){
            $country = "";
            if($ald->city_name == "London"){
                $country = "UK";
            }elseif($ald->city_name == "Banjul"){
                $country = "The Gambia";
            }elseif($ald->city_name == "Barcelona"){
                $country = "Spain";
            }elseif($ald->city_name == "Portsmouths"){
                $country = "UK";
            }
            
            ?>
        <tr>
          <td valign="middle" height="45" align="center"><img height="35" src="<?php echo base_url()."useruploads/";?><?php if($ald->profile != ""){ echo $ald->profile;}else{?>member_img.png<?php }?>"></td>
          <td valign="middle" height="45" align="center"><?php echo $ald->firstName." ".$ald->lastName;?></td>
          <td valign="middle" height="45" align="center"><?php echo $ald->phone;?></td>
          <td valign="middle" height="45" align="center"><?php echo $ald->emailID;?></td>
          <td valign="middle" height="45" align="center"><?php echo $ald->city_name;?></td>
          <td valign="middle" height="45" align="center"><?php echo $country;?></td>
          <td valign="middle" height="45" align="center"><?php echo ucwords(strtolower($ald->userType));?></td>
          <?php if($ald->uID == $ald->expelled_user_id && $this->session->userdata('userType') == "ADMIN"){?>
          <td valign="middle" height="45" align="center"><a href="javascript:void(0);" class="expellClass" id="<?php echo $ald->uID;?>">Expel</a></td>
          <?php }else{
          $viewArray = array("TEACHER","HEAD VOLUNTEERS");
            if(in_array($this->session->userdata('userType'), $viewArray)){
                unset($viewArray);
                ?>
          <td valign="middle" height="45" align="center"><a href="javascript:void(0);" class="expellClass" id="<?php echo $ald->uID;?>">Expel</a></td>
            <?php }else{?>
          <td valign="middle" height="45" align="center">&nbsp;</td>
            <?php } ?>
          <?php }?>
          
           <?php if($this->session->userdata('userType') == "ADMIN"){?>
          <td valign="middle" height="45" align="center"><a href="<?php echo base_url();?>dashboard/deleteUserFromExpell/<?php echo $ald->uID;?>" class="expellDeleteClass" onclick="return confirm('Are you sure to delete the user details.');" id="<?php echo $ald->uID;?>">Delete</a></td>
          <?php }?>
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
  <?php } 
  endif;
  ?>