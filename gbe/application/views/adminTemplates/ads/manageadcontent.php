<?php $this->load->view('adminTemplates/common/header', $viewData); ?>


<!--Main Content-->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-title">
            <h2><?php echo $action;?> Add Youtube URL</h2>
<!--            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/getXls">Get Report</a>
            </h3>-->
        </div>
        
       
        
        <!--Error-->
        <?php if($report == 2){ ?>
        <div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Error-->
		<!--Success-->
        <?php if($report == 1){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->

        <div class="main_section" style="width: 800px;">
            <form id="editAdContent" name="editAdContent" method="post" action="" class="main_form" enctype="multipart/form-data">
                
                <table width="700" height="200" border="1" align="center" class="form-table">
                    
                    
                    <tr>
                        <td>Youtube Url</td>
                        <td><input type="text" id="youtubeurl" name="youtubeurl" class="input1" value="<?php if($youtubeurl!=""){?><?php echo $youtubeurl;?><?php }?>" /></td>
                    </tr>
					
					<!--<tr>
                        <td>Banner Url</td>
                        <td><input type="text" id="bannerurl" name="bannerurl" class="input1" value="<?php if($bannerurl!=""){?><?php echo $bannerurl;?><?php }?>" /></td>
                    </tr>
                    
                   <tr>
						  <td>Image</td>
						  <td><img src="<?php echo base_url(); ?>adminuploads/adcms/<?php echo $image; ?>" alt="" height="90" width="100"/>
						  <input type="file" name="image" id="image" />(jpeg|jpg|gif|png only supported)</td>
						<?php if(isset($err_msg)){ echo "<span style=\"color:#F00; font-weight:bold;\">".$err_msg."</span>";}?>
						<?php if(isset($image_error)){ echo "<span style=\"color:#F00; font-weight:bold;\">".$image_error."</span>";}?>
					</tr>-->
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" onclick=" return validateForm();" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url(); ?>cp/viewAdsList">cancel</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  