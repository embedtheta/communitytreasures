<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Menus View</h2>
            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/addMenu">Add</a>
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
       	      <th width="17%" align="left" scope="col">Menu Name</th>
       	      <th width="17%" align="left" scope="col">Sub Menu Name</th>
       	      <th width="10%" align="left" scope="col">Action</th>
   	        </tr>
            <?php  foreach($infoAllMenus as $key=>$val){	
				  	$className    = "table-gray";
					if ($key % 2 == 0) {
                  		$className    = "";
					}
			?>
            <tr>
              <td class="<?php echo $className;?>"><?php echo $infoAllMenus[$key]["menuName"];?></td>
       	      <td class="<?php echo $className;?>"></td>
       	      <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/editMenu/<?php echo $infoAllMenus[$key]["menuID"];?>">Edit </a> | <a href="<?php echo base_url();?>admin/deleteMenu/<?php echo $infoAllMenus[$key]["menuID"];?>">Delete</a></td>
   	        </tr>
            <?php } ?>
			<?php  foreach($infoAllSubMenus as $key=>$val){	
				  	$className    = "table-gray";
					if ($key % 2 == 0) {
                  		$className    = "";
					}
			?>
            <tr>
              <td class="<?php echo $className;?>"><?php echo $infoAllSubMenus[$key]["Par"];;?></td>
       	      <td class="<?php echo $className;?>"><?php echo $infoAllSubMenus[$key]["menuName"];?></td>
       	      <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/editMenu/<?php echo $infoAllSubMenus[$key]["menuID"];?>">Edit </a> | <a href="<?php echo base_url();?>admin/deleteMenu/<?php echo $infoAllSubMenus[$key]["menuID"];?>">Delete</a></td>
   	        </tr>
            <?php } ?>
       	  </table>
        </div>
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  