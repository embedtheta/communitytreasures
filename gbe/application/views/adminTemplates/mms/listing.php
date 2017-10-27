<?php $this->load->view('adminTemplates/common/header',$viewData);?>



<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Convert Afrowebb user to Volunteer & MSS System </h2>
            <h3 align="right">
               <!--<a href="<?php echo base_url();?>cp/addVCards">Add</a>-->
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
        
        
        <div class="table-content">
            <!--<div>
                <form name="userSearch" action="" method="post">
                    <select name="typeUser" style="width:150px;height: 30px;margin: 0 0 2px 0;">
                        <?php foreach($userTypeList as $k=>$v):?>
                        <option value="<?php echo $k;?>" <?php if($k == $selectedUserType):?>selected="selected"<?php endif;?>>
                                <?php echo $v;?></option>
                        <?php endforeach;?>
                    </select>
                    <input type="submit" class="submit-bnt" name="search" value="Search">
                </form>
            </div>-->
       	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
       	    <tr>
                <th width="8%" align="left" scope="col">#</th>
                 <th width="12%" align="left" scope="col">Image</th>
                <th width="25%" align="left" scope="col">Name</th>
                <th width="25%" align="left" scope="col">Email</th>
                <th width="15%" align="left" scope="col">Total MSS user</th>
                 <th width="15%" align="left" scope="col">Action</th>
   	        </tr>
            <?php 
			if(count($list) > 0){
				$i = 1;
				  foreach($list as $key=>$valList){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
                <td class="<?php echo $className;?>"><?php echo $i;$i++;?></td>
                 <td class="<?php echo $className;?>"><img height="60" width="60" src="<?php echo base_url();?>useruploads/<?php echo $valList->profile;?>" /></td>
                <td class="<?php echo $className;?>"><?php echo $valList->firstName.' '.$valList->lastName;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->emailID;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->mss_total;?></td>
                <td class="<?php echo $className;?>"> 
                	<?php if($valList->mss_total >= 12):?>
                    	Completed
                    <?php else:?>
                    	<a href="<?php echo base_url();?>cp/assignMmsUser/<?php echo $valList->uID;?>/<?php echo $page;?>">View Afrowebb List </a>
                    <?php endif;?>
                </td>
   	        </tr>
            <?php } 
                }else{
            ?>
             <tr>
       	      <th align="left" scope="col" colspan="6" class="table-gray">No Data Please!</th>
       	      
   	        </tr>
            <?php }?>
       	   
                
   	      </table>
        </div>
        <?php echo $pagination;?> 
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  