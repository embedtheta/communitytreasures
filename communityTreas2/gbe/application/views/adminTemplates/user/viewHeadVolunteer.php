<?php $this->load->view('adminTemplates/common/header',$viewData);?>


<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>View List of <?php echo $userType;?></h2>
            <h3 align="right">
                 <a href="<?php echo base_url();?>cp/getXls/4">Get Report</a>
            </h3>
        </div>
        
         <!--Success-->
        <?php if($report == 1){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if($report == 2){ ?>
        <div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Error-->
        
        <!--Warning-->
        <!--<div class="admin-msg warning-msg">
            <i class="fa fa-warning"></i>  
                <span>Aenean interdum interdum ligula, vitae auctor nisl bibendum eu.</span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>-->
        <!--Error-->
        
        <div class="table-content page_txts">
       	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
       	    <tr>
                <th width="20%" align="left" scope="col">Name</th>
                <th width="20%" align="left" scope="col">Invited By</th>
                <th width="10%" align="left" scope="col">Phone</th>
                <th width="25%" align="left" scope="col">Email</th>
                <th width="15%" align="left" scope="col">Skype ID</th>
                <th width="10%" align="left" scope="col">City</th>
                <th width="11%" align="center" scope="col">Send Email</th>
                <th width="10%" align="left" scope="col">Status</th>
   	        </tr>
            <?php 
			if(count($userList) > 0){
				  foreach($userList as $key=>$valList){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
                <td class="<?php echo $className;?>"><?php echo $valList->firstName." ".$valList->lastName;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->fn." ".$valList->ln;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->phone;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->emailID;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->skypeID;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->city_name;?></td>
                <td class="<?php echo $className;?>"><?php if($valList->email_send_status > 0){?><input type="checkbox" checked="checked" disabled><?php }else{?><a href="<?php echo base_url();?>emailclass/sendEmailToHeadVolunteerWithCredential/<?php echo $valList->uID;?>" class="sendEmail" id="<?php echo $valList->uID;?>">Send</a><?php }?>
				<a href="<?php echo base_url();?>cp/addPageText/<?php echo $valList->uID;?>"><input type="button" name="addPageText" value="Page Text"></a></td>
                <td class="<?php echo $className;?>"> <?php if($valList->status == "1"){?>Active<?php }else{?>Inactive<?php }?> </td>
   	    </tr>
            <?php } 
                }else{
            ?>
             <tr>
       	      <th align="left" scope="col" colspan="8" class="table-gray">No Data!</th>
       	      
   	        </tr>
            <?php }?>
       	   
                
   	      </table>
        </div>
        <?php echo $pagination;?> 
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  