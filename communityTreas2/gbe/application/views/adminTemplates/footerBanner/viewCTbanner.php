<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>CT footer Banner</h2>
            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/addCTfooterBanner">Add</a>
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
       	      <th width="17%" align="left" scope="col">Title</th>
       	      <th width="17%" align="left" scope="col">Picture</th>
       	      <th width="30%" align="left" scope="col">Description</th>
              <th width="9%" align="left" scope="col">Date</th>
       	      <th width="10%" align="left" scope="col">Action</th>
   	        </tr>
            <?php // print_r($infoCreative);
				  foreach($infoFooterBanner as $key=>$footerBanner){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>            
       	      <td class="<?php echo $className;?>"><?php echo $infoFooterBanner[$key]["bannerTitle"];?></td>
       	      <td class="<?php echo $className;?>"><img src="<?php echo base_url();?>/adminuploads/productPagesImg/<?php echo $infoFooterBanner[$key]["bannerImg"];?>" width="107" height="107"/></td>
       	      <td class="<?php echo $className;?>"><?php echo $infoFooterBanner[$key]["bannerDesc"];?></td>
              <td class="<?php echo $className;?>"><?php echo $infoFooterBanner[$key]["bannerDate"];?></td>
       	      <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/editCTfooterBanner/<?php echo $infoFooterBanner[$key]["footerBanID"];?>">Edit </a> | <a href="<?php echo base_url();?>admin/deleteCTfooterBanner/<?php echo $infoFooterBanner[$key]["footerBanID"];?>">Delete</a></td>
   	        </tr>
            <?php } ?>

   	      </table>
        </div>
        
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  