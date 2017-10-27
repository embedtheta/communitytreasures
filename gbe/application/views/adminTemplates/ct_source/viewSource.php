<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2><?php echo $categoryName;?> View</h2>
            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/addCTSourceZone/<?php echo $selectedMenuId; ?>">Add</a>
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
        
       
        <!--Error-->
        
        <div class="table-content">
       	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
       	    <tr>
       	      
       	      <th width="22%" align="left" scope="col">Picture</th>
       	      <th width="46%" align="left" scope="col">Description</th>
			  <th width="46%" align="left" scope="col">Monetizer</th>
       	      <th width="10%" align="left" scope="col">Action</th>
   	        </tr>
            <?php // print_r($infoCreative);
				  foreach($infoArticle as $key=>$valArticle){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
       	      <td class="<?php echo $className;?>"><img src="<?php echo base_url();?>/adminuploads/productPagesImg/<?php echo $infoArticle[$key]["image"];?>" width="107" height="107"/></td>
       	      <td class="<?php echo $className;?>"><?php echo $infoArticle[$key]["description"];?></td>
			  <td class="<?php echo $className;?>"><?php echo $infoArticle[$key]["title"];?></td>
       	      <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/editSourceZone/<?php echo $infoArticle[$key]["id"];?>">Edit </a> | <a href="<?php echo base_url();?>admin/deleteSource/<?php echo $infoArticle[$key]["id"];?>/<?php echo $infoArticle[$key]["Mid"];?>">Delete</a></td>
   	        </tr>
            <?php } ?>
       	  
   	      </table>
        </div>
       
		<?php echo $pagination;?> 
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  