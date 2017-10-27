<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2><?php echo $menuDetails[0]['menuName'];?> View</h2>
            <h3 align="right">
            <?php if($addLink	==	1){?>
                 <a href="<?php echo base_url();?>admin/addDynamicMenuContent/<?php echo $menuDetails[0]['menuID'];?>">Add</a>
            <?php }?>     
            </h3>
        </div>
        
        <!--Success-->
        <?php if(isset($submissionReport)){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $submissionReport;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if(isset($errorReport)){ ?>
        <div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $errorReport;?></span>
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
       	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
       	    <tr>
       	      <th width="16%" align="left" scope="col">Title</th>
       	      <th width="22%" align="left" scope="col">Picture</th>
       	      <th width="40%" align="left" scope="col">Description</th>
              <th width="8%" align="left" scope="col">Action</th>
       	      <th width="14%" align="left" scope="col">Action</th>
   	        </tr>
            <?php // print_r($infoCreative);
				if(!empty($menuContent) && count($menuContent)>0){
				  foreach($menuContent as $valCreative){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
       	      <td class="<?php echo $className;?>"><?php echo $valCreative["title"];?></td>
       	      <td class="<?php echo $className;?>"><img src="<?php echo base_url();?>/adminuploads/productPagesImg/<?php echo $valCreative["image"];?>" width="107" height="107"/></td>
       	      <td class="<?php echo $className;?>"><?php echo $valCreative["description"];?></td>
              <td class="<?php echo $className;?>"><?php if($valCreative["status"] == 1){echo 'Active';}else{ echo 'Inactive';}?></td>
       	      <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/editDynamicMenuContent/<?php echo $valCreative["id"];?>">Edit </a> | <a href="<?php echo base_url();?>admin/deleteDynamicMenuContent/<?php echo $valCreative["id"];?>">Delete</a></td>
   	        </tr>
            <?php }
				}else{
			?>
            <tr>
       	      <td colspan="5" class="table-gray">No Data Please!</td>
            </tr>
			<?php		
				}
			?>
       	   <!-- <tr>
       	      <td class="table-gray">Progressive Word</td>
       	      <td class="table-gray">Ghosh</td>
       	      <td class="table-gray">Lorem Ipsum is simply dummy text of the printing and typesetting.</td>
       	      <td class="table-gray"><a href="#">Edit </a> | <a href="#">Delete</a></td>
   	        </tr>
       	    <tr>
       	      <td>&nbsp;</td>
       	      <td>&nbsp;</td>
       	      <td>&nbsp;</td>
       	      <td>&nbsp;</td>
   	        </tr>
       	    <tr>
       	      <td class="table-gray">&nbsp;</td>
       	      <td class="table-gray">&nbsp;</td>
       	      <td class="table-gray">&nbsp;</td>
       	      <td class="table-gray">&nbsp;</td>
   	        </tr>-->
   	      </table>
        </div>
        <!--<div class="login-section">
             <form action="" method="post" id="frnd" class="main-form">
                 <input name="" type="text" placeholder="Email" class="input1">
                 <input name="" type="email" placeholder="Password" class="input2">
                 <input name="" type="submit" value="Login" class="login-submit">
             </form>
        </div>-->
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  