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
    					<td>Select Menu
                        </td>
    					<td><select name="parentMenuID" id="parentMenuID" style="width:220px;">
                        		<option value="0" selected="selected">Select One</option>
                                <?php foreach($menuList as $key=>$val){?>
                                <option value="<?php echo $menuList[$key]["menuID"];?>"><?php echo $menuList[$key]["menuName"];?></option>
                                <?php }?>
                            </select>
    					</td>
    				</tr>
                    <tr>
    					<td>Enter Menu Name</td>
    					<td><input type="text" name="menuName" id="menuName" class="input1" value="" />
                        <?php echo form_error('menuName', '<span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
                    <tr>
    					<td colspan="2">
      						<input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;<input type="reset" name="reset" id="reset" value="reset" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/viewMenu">cancel</a>
                         </td>
    				</tr>
  				</table>
            </form>
        </div>
  	</div>
  </div>
<!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  