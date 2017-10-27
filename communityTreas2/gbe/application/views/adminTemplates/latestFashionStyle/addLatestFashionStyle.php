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
        	<form id="addLatestFashionStyle" name="addLatestFashionStyle" method="post" action="" enctype="multipart/form-data" class="main_form">
            	<table width="100%" height="200" border="1" align="center" class="form-table">
     				<tr>
    					<td>Title</td>
    					<td><input type="text" name="fashionTitle" id="fashionTitle" class="input1" value="<?php if(isset($fashionTitle)){ echo $fashionTitle;}?>" />
                        <br/>
      						<?php echo form_error('fashionTitle', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td>Description</td>
    					<td><textarea name="fashionDesc" id="fashionDesc" class="input2"><?php if(isset($fashionDesc)){ echo $fashionDesc;}?></textarea>
                        <br/>
      						<?php echo form_error('fashionDesc', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td>Fashion Position</td>
    					<td><select name="fashionPosition" id="fashionPosition" >
                        	<option value="">Select One</option>
            				<option value="firstPosition" <?php if(isset($fashionPosition)=="firstPosition") echo 'selected="selected"'; ?> id="firstPosition">First Position</option>
            				<option value="secondPosition" <?php if(isset($fashionPosition)=="secondPosition") echo 'selected="selected"'; ?> id="secondPosition">Second Position</option>
            				<option value="thirdPosition" <?php if(isset($fashionPosition)=="thirdPosition") echo 'selected="selected"'; ?> id="thirdPosition">Third Position</option>
            				</select>
                            <br />
      						<?php echo form_error('fashionPosition', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td class="table-row">Image</td>
    					<td><input type="file" name="image" id="image" class="input-img" />(jpg|gif|png only supported)
                        <br/>
      						<?php echo form_error('image', '<span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
                    <tr>
     					<td>Status</td>
      					<td>
        					<input type="radio" name="fashionStatus" checked="checked" value="1" class="input-status"/>Active
        					<input type="radio" name="fashionStatus" value="0" class="input-status" />Inactive
      					</td>
    				</tr>
    				<tr>
    					<td colspan="2">
      						<input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;<input type="reset" name="reset" id="reset" value="reset" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/viewLatestFashionStyle">cancel</a>
                         </td>
    				</tr>
  				</table>
            </form>
        </div>
  	</div>
  </div>
<!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  