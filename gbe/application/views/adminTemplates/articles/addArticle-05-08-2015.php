<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
<script type="application/javascript">
$( document ).ready(function() {
	
	 $( "#articleMenu" ).change(function() {
		if( $(this).val() == "4"){
			$("#fashionDiv").show();
		}else{
			$("#fashionDiv").hide();
		}
	 });
});
</script>
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
        	<form id="addArticle" name="addArticle" method="post" action="" enctype="multipart/form-data" class="main_form">
            	<table width="600" height="200" border="1" align="center" class="form-table">
     				<tr>
    					<td>Menu</td>
    					<td><select name="articleMenu" id="articleMenu" >
                        		<option value=0>Please Select </option>
                        		<?php foreach($menuTypes as $menuType){?>
                        		<option value=<?php echo $menuType["menuID"]?>><?php echo $menuType["menuName"]?></option>
                                <?php } ?>
                            </select>
      						<?php echo form_error('articleMenu', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
					<tr id="fashionDiv" style="display:none;">
    					<td>Fashion Position</td>
    					<td><select name="fashionPosition" id="fashionPosition" >
                        	<option value="">Select One</option>
            				<option value="1" <?php if(isset($fashionPosition)=="1") echo 'selected="selected"'; ?> id="firstPosition">First Position</option>
            				<option value="2" <?php if(isset($fashionPosition)=="2") echo 'selected="selected"'; ?> id="secondPosition">Second Position</option>
            				<option value="3" <?php if(isset($fashionPosition)=="3") echo 'selected="selected"'; ?> id="thirdPosition">Third Position</option>
            				</select>
                            <br />
      						<?php echo form_error('fashionPosition', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
					<tr>
    					<td>Article</td>
    					<td><select name="articleType" id="articleType" >
                        		<option value=0>Please Select </option>
                        		<?php foreach($articleTypes as $articleType){?>
                        		<option value=<?php echo $articleType["id"]?>><?php echo $articleType["title"]?></option>
                                <?php } ?>
                            </select>
      						<?php echo form_error('articleType', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
					<tr>
    					<td>Title</td>
    					<td><input type="text" name="articleTitle" id="articleTitle" class="input1" value="<?php if(isset($articleTitle)){ echo $articleTitle;}?>" />
      						<?php echo form_error('articleTitle', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>

                    <tr>
    					<td>Description</td>
    					<td><textarea name="articleDesc" id="articleDesc" class="input2"><?php if(isset($articleDesc)){ echo $articleDesc;}?></textarea>
      						<?php echo form_error('articleDesc', '<span class="form_error">', '</span>'); ?>
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
        					<input type="radio" name="articleStatus" checked="checked" value="1" class="input-status"/>Active
        					<input type="radio" name="articleStatus" value="0" class="input-status" />Inactive
      					</td>
    				</tr>
    				<tr>
    					<td colspan="2">
      						<input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;<input type="reset" name="reset" id="reset" value="reset" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/viewArticles">cancel</a>
                         </td>
    				</tr>
  				</table>
            </form>
        </div>
  	</div>
  </div>
<!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  