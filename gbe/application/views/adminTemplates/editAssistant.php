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
    <!--Success-->
        <?php if(isset($successMsg)){ ?>  
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $successMsg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
    	<div class="main_section">
        	<form id="virtualAssist" name="virtualAssist" method="post" action="" enctype="multipart/form-data" class="main_form">
            <input type="hidden" name="virtualAssistID" id="virtualAssistID" value="<?php  echo $infoAssist[0]["id"];?>"/>			
            	<table width="600" height="200" border="1" align="center" class="form-table">
     				<tr>
    					<td>Title</td>
    					<td><input type="text" name="assistTitle" id="assistTitle" class="input1" value="<?php  echo $infoAssist[0]["title"];?>" />
      						<?php echo form_error('assistTitle', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td>Description</td>
    					<td><textarea name="assistDesc" id="assistDesc" class="input2"><?php  echo $infoAssist[0]["description"];?></textarea>
      						<?php echo form_error('assistDesc', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td class="table-row">Link</td>
    					<td><input type="text" name="assistLink" id="assistLink" class="input1" value="<?php  echo $infoAssist[0]["link"];?>" />
      						<?php echo form_error('assistLink', '<span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
                    <tr>
     					<td>Status</td>
      					<td>
                            <input type="radio" name="assistStatus" <?php if($infoAssist[0]["status"] == "1"){?>checked="checked"<?php } ?> value="1" class="input-status"/>Active
        					<input type="radio" name="assistStatus" <?php if($infoAssist[0]["status"] == "0"){?>checked="checked"<?php } ?> value="0" class="input-status" />Inactive
      					</td>
    				</tr>
    				<tr>
    					<td colspan="2">
      						<input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;<input type="reset" name="reset" id="reset" value="reset" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/viewAssistants">cancel</a>
                         </td>
    				</tr>
  				</table>
            </form>
        </div>
  	</div>
  </div>
<!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  