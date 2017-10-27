<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Lists of Product </h2>
            <h3 align="right">
<!--                 <a href="<?php echo base_url();?>admin/addProduct">Add</a>-->
            </h3>
        </div>
        
        <!--Success-->
        <?php if($type != ''){ ?>
        <div class="admin-msg <?php echo $type;?>-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if($type == 'error'){ ?>
        <!--<div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>-->
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
       	      <th width="22%" align="left" scope="col">Picture</th>
       	      <th width="22%" align="left" scope="col">Name</th>
       	      <th width="15%" align="left" scope="col">Price</th>
              <th width="16%" align="left" scope="col">Currency</th>
              <th width="15%" align="left" scope="col">Quantity</th>
       	      <th width="10%" align="left" scope="col">Action</th>
   	        </tr>
            <?php if(count($infoProducts) > 0):
                foreach($infoProducts as $key=>$valCreative):	
                    $className = "table-gray";
                    if ($key % 2 == 0) {
                        $className = "";
                    }
			?>
            <tr>
       	      <td class="<?php echo $className;?>"><img src="<?php echo base_url();?>/adminuploads/product_files/images/thumb/<?php echo (($valCreative->fileName == "")?'no_img.png':$valCreative->fileName);?>" width="107" height="107"/></td>
       	      <td class="<?php echo $className;?>"><?php echo $valCreative->productName;?></td>
       	      <td class="<?php echo $className;?>"><?php echo $valCreative->productPrice;?></td>
              <td class="<?php echo $className;?>"><?php echo $valCreative->productCurrencyType;?></td>
       	      <td class="<?php echo $className;?>"><?php echo $valCreative->productQuantity;?></td>
                                                 <td class="<?php echo $className;?>"><!--  <a href="<?php echo base_url();?>admin/editEventsCelebrations/<?php echo $valCreative->productID;?>">Edit </a> |--> <a onclick="return confirm('Are you sure to delete all the data related to products?');" href="<?php echo base_url();?>admin/deleteProduct/<?php echo $valCreative->productID;?>">Delete</a></td>
   	        </tr>
            <?php endforeach;
                else: ?>
                 <tr>
       	      <th align="left" scope="col" colspan="6" class="table-gray">No Product!</th>
       	      
   	        </tr>
                <?php endif;?>
       	  </table>
        </div>
        <?php echo $pagination;?> 
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  