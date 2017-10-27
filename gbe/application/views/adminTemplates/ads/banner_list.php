<?php $this->load->view('adminTemplates/common/header',$viewData);?>


<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>View Banner List</h2>

            <h3 align="right">
			    <a href="<?php echo base_url();?>cp/addBanner">Add</a>
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
			  <th width="13%" align="left" scope="col">URL</th>
       	      <th width="20%" align="left" scope="col">Action</th>
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
                <td class="<?php echo $className;?>"><?php echo $key+1;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->banner_title;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->banner_url;?></td>
				<td class="<?php echo $className;?>"><a href="<?php echo base_url();?>cp/editBanner/<?php echo $valList->id;?>">Edit </a>|<a href="<?php echo base_url();?>cp/deleteBanner/<?php echo $valList->id;?>" onclick=" return confirm('Are you sure to delete this data?');">Delete </a></td>
              
            </tr>
            <?php } 
			}else{
			?>
             <tr>
       	      <th width="22%" align="left" scope="col" colspan="5" class="table-gray">No Data!</th>
       	      
   	        </tr>
            <?php }?>
   	      </table>
          <p><?php echo $links; ?></p>
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