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
            <form id="editMenuZone" name="editMenuZone" method="post" action="" class="main_form">
            <input type="hidden" name="menuID" id="menuID" value="<?php echo $infoMenu[0]["menuID"];?>"/>
            	<table width="600" height="200" border="1" align="center" class="form-table">
     				<tr>
    					<td>Select Menu<?php ?></td>
    					<td>
                        <select name="parentMenuID" id="parentMenuID" style="width:220px;">
                        		<option value="0">Select One</option>
                                <?php 
								  foreach($infoMainMenu as $key=>$val){
									  if(isset($infoMenu[0]["parentMenuID"]) && ($infoMenu[0]["parentMenuID"] === $infoMainMenu[$key]["menuID"] )){
										echo "<option value=".$infoMainMenu[$key]["menuID"]." selected=\"selected\" >".$infoMainMenu[$key]["menuName"]."</option>" ;
									  }else{
										echo "<option value=".$infoMainMenu[$key]["menuID"].">".$infoMainMenu[$key]["menuName"]."</option>" ;
									  }
								  }
								  ?>
                            </select>
                        
    					</td>
    				</tr>
                    <tr>
    					<td>Enter Menu Name</td>
    					<td>
                        <input type="text" id="menuName" name="menuName" class="input1" value="<?php if($infoMenu[0]["menuName"]!=""){?><?php echo $infoMenu[0]["menuName"];?><?php }else{ echo $infoIndivMenu[0]["menuName"]; } ?>" />
                        <?php echo form_error('menuName', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
     					<td>Status</td>
      					<td>
                            <input type="radio" name="menuStatus" <?php if($infoMenu[0]["menuStatus"] == "1"){?>checked="checked"<?php } ?> value="1" class="input-status"/>Active
        					<input type="radio" name="menuStatus" <?php if($infoMenu[0]["menuStatus"] == "0"){?>checked="checked"<?php } ?> value="0" class="input-status" />Inactive
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