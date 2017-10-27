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
        	<form id="addEventsCelebrations" name="addEventsCelebrations" method="post" action="" enctype="multipart/form-data" class="main_form">
            	<table width="600" height="200" border="1" align="center" class="form-table">
     				<tr>
    					<td>Title</td>
    					<td><input type="text" name="eventTitle" id="eventTitle" class="input1" value="<?php if(isset($eventTitle)){ echo $eventTitle;}?>" />
      						<?php echo form_error('eventTitle', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td>Description</td>
    					<td><textarea name="eventDesc" id="eventDesc" class="input2"><?php if(isset($eventDesc)){ echo $eventDesc;}?></textarea>
      						<?php echo form_error('eventDesc', '<span class="form_error">', '</span>'); ?>
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
        					<input type="radio" name="eventStatus" checked="checked" value="1" class="input-status"/>Active
        					<input type="radio" name="eventStatus" value="0" class="input-status" />Inactive
      					</td>
    				</tr>
    				<tr>
    					<td colspan="2">
      						<input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;<input type="reset" name="reset" id="reset" value="reset" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/viewEventsCelebrations">cancel</a>
                         </td>
    				</tr>
  				</table>
            </form>
        </div>
  	</div>
  </div>
<!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  