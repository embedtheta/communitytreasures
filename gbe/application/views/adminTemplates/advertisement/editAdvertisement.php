<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	  <!--Error-->
        <?php if(isset($errorMsg)){ ?>  
        <div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $errorMsg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Error-->
   
    	<div class="main_section">
        	<form id="addAdvertisement" name="addAdvertisement" method="post" action="" enctype="multipart/form-data" class="main_form">
            <input type="hidden" name="advertisementId" id="advertisementId" value="<?php  echo $infoAdvertisement[0]["advertisementId"];?>"/>
            	<table width="600" height="200" border="1" align="center" class="form-table">
     				<tr>
    					<td>Title</td>
    					<td><input type="text" name="advertisementTitle" id="advertisementTitle" class="input1" value="<?php  echo $infoAdvertisement[0]["advertisementTitle"];?>" />
      						<?php echo form_error('advertisementTitle', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    
    					<td>Advertisement Description</td>
    					<td><textarea name="advertisementDesc" id="advertisementDesc" class="input2"><?php  echo $infoAdvertisement[0]["advertisementDesc"];?></textarea>
      						<?php echo form_error('advertisementDesc', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td class="table-row">Image</td>
    					<td><span><img src="<?php echo base_url();?>/adminuploads/productPagesImg/<?php echo $infoAdvertisement[0]["advertisementImg"];?>" width="70" height="70" /></span><input type="file" name="image" id="image" class="input-img" />(jpg|gif|png only)
      						<?php echo form_error('image', '<span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
                    <tr>
     					<td>Status</td>
      					<td>
                            <input type="radio" name="advertisementStatus" <?php if($infoAdvertisement[0]["advertisementStatus"] == "1"){?>checked="checked"<?php } ?> value="1" class="input-status"/>Active
        					<input type="radio" name="advertisementStatus" <?php if($infoAdvertisement[0]["advertisementStatus"] == "0"){?>checked="checked"<?php } ?> value="0" class="input-status" />Inactive
      					</td>
    				</tr>
    				<tr>
    					<td colspan="2">
      						<input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;<input type="reset" name="reset" id="reset" value="reset" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/viewAdvertisement">cancel</a>
                         </td>
    				</tr>
  				</table>
            </form>
        </div>
  	</div>
  </div>
<!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  