<?php $this->load->view('adminTemplates/common/header',$viewData);?>


<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>View <?php echo $websiteName; ?> Catalogue List</h2>
<!--            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/getXls">Get Report</a>
            </h3>-->
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
       	      <th width="7%" align="left" scope="col">#</th>
       	      <th width="20%" align="left" scope="col">Title</th>
       	      <th width="8%" align="left" scope="col">Currency</th>
       	      <th width="8%" align="left" scope="col">Price</th>
              <th width="40%" align="left" scope="col">Description</th>
              <th width="10%" align="left" scope="col">Status</th>
              <th width="7%" align="left" scope="col">Edit</th>
   	        </tr>
            <?php 
			if(count($list) > 0){
				  foreach($list as $key=>$valList){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
                <td class="<?php echo $className;?>"><?php echo $valList->id;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->title;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->currency_name;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->cost;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->description;?></td>
                <td class="<?php echo $className;?>"><?php if($valList->status == 1){ echo "Active";}else{ echo "Inactive";}?></td>
                <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/afroCatalogueEdit/<?php echo $valList->id;?>">Edit </a></td>
              
            </tr>
            <?php } 
			}else{
			?>
             <tr>
       	      <th width="22%" align="left" scope="col" colspan="7" class="table-gray">No Data!</th>
       	      
   	        </tr>
            <?php }?>
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