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
        	<form id="addTvChannel" name="addTvChannel" method="post" action="" enctype="multipart/form-data" class="main_form">
			<input type="hidden" name="channelID" id="channelID" value="<?php  echo $infoTvChannel[0]["id"];?>"/>
            	<table width="600" height="200" border="1" align="center" class="form-table">
     				<tr>
    					<td>TV</td>
    					<td><select name="tvType" id="tvType" >
                        		<option value=0>Please Select </option>
                        		<?php foreach($tvTypes as $tvType){?>
                        		<option value="<?php echo $tvType['id']?>" <?php if($infoTvChannel[0]["tvId"] == $tvType['id']) echo "selected='selected'"; ?> ><?php echo $tvType["title"]?></option>
                                <?php } ?>
                            </select>
      						<?php echo form_error('tvType', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>					
					<tr>
    					<td>Title</td>
    					<td><input type="text" name="channelTitle" id="channelTitle" class="input1" value="<?php  echo $infoTvChannel[0]["channeltitle"];?>" />
      						<?php echo form_error('channelTitle', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>

                    <tr>
    					<td>Description</td>
    					<td><textarea name="channelDesc" id="channelDesc" class="input2"><?php  echo $infoTvChannel[0]["channeldesc"];?></textarea>
      						<?php echo form_error('channelDesc', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td class="table-row">Image</td>
    					<td><span><img src="<?php echo base_url();?>/adminuploads/productPagesImg/<?php echo $infoTvChannel[0]["channelimage"];?>" width="70" height="70" /></span><input type="file" name="image" id="image" class="input-img" />(jpg|gif|png only supported)
      						<?php echo form_error('image', '<span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
					<tr>
    					<td class="table-row">Video</td>
    					<td><input type="file" name="channelVideo" id="channelVideo" class="input-img" />(mp4|flv|avi only supported)
      						<?php echo form_error('channelVideo', '<span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
                    <tr>
     					<td>Status</td>
      					<td>
        					<input type="radio" name="channelStatus" <?php if($infoTvChannel[0]["status"] == "1"){?>checked="checked"<?php } ?> value="1" class="input-status"/>Active
        					<input type="radio" name="channelStatus" <?php if($infoTvChannel[0]["status"] == "0"){?>checked="checked"<?php } ?> value="0" class="input-status" />Inactive
      					</td>
    				</tr>
    				<tr>
    					<td colspan="2">
      						<input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;<input type="reset" name="reset" id="reset" value="reset" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/viewGbeTvChannel">cancel</a>
                         </td>
    				</tr>
  				</table>
            </form>
        </div>
  	</div>
  </div>
<!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  