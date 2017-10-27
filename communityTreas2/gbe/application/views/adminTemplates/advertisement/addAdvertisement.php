<!--<script src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript">
function getNewFile(){
 $("#outPut").append('<input type="file" name="file[]" id="file" class="input-img" />');
}
</script>-->
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
            	<table width="600" height="200" border="1" align="center" class="form-table">
     				<tr>
    					<td>Title</td>
    					<td><input type="text" name="advertisementTitle" id="advertisementTitle" class="input1" value="<?php if(isset($advertisementTitle)){ echo $advertisementTitle;}?>" />
      						<?php echo form_error('advertisementTitle', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td>Advertisement Description</td>
    					<td><textarea name="advertisementDesc" id="advertisementDesc" class="input2"><?php if(isset($advertisementDesc)){ echo $advertisementDesc;}?></textarea>
      						<?php echo form_error('advertisementDesc', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td class="table-row">Image</td>
    					<td><input type="file" name="image" id="image" class="input-img" />(jpg|gif|png only supported)
      						<?php echo form_error('image', '<span class="form_error">', '</span>'); ?>
                        </td>
                        </tr>
<!--                       <tr><td><a href="javascript:void(0);" onclick="getNewFile()" >Add Upload</a></td><td>
                       <div id="outPut">
                        </div>
                        </td></tr>
    				
-->                    <tr>
     					<td>Status</td>
      					<td>
        					<input type="radio" name="advertisementStatus" checked="checked" value="1" class="input-status"/>Active
        					<input type="radio" name="advertisementStatus" value="0" class="input-status" />Inactive
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