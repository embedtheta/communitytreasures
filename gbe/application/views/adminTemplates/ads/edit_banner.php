<?php $this->load->view('adminTemplates/common/header', $viewData); ?>

<script type="text/javascript">
    $(document).ready(function(){
        
    });
    
    function validateForm(){
        var title = $("#banner_title").val();
        var url = $("#banner_url").val();
        //var description = $("#description").val();
        if(title == ""){
            alert("Please enter the Title value.");
            $("#banner_title").focus();
            return false;
        }
               
              
        if(url == ""){
            alert("Please enter the URL value.");
            $("#banner_url").focus();
            return false;
        }
        
        return true;        
    }
</script>
<!--Main Content-->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-title">
            <h2><?php echo $action;?> Banner</h2>
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

        <div class="main_section" style="width: 700px;">
            <form id="editMenuZone" name="editMenuZone" method="post" action="" enctype="multipart/form-data" class="main_form">
                
                <table width="600" height="200" border="1" align="center" class="form-table">
                    <tr>
                        <td>Title</td>
                        <td>
                        <input type="text" id="banner_title" name="banner_title" class="input1" value="<?php if($banner_title!=""){?><?php echo $banner_title;?><?php }?>" /></td>
                    </tr>
                    
                                     
                    <tr>
                        <td>URL</td>
                        <td><textarea style="width: 300px;height: 150px;" class="input2" id="banner_url" name="banner_url"><?php if($banner_url!=""){?><?php echo $banner_url;?><?php }?></textarea></td>
                    </tr>
					
					
					 <tr>
						  <td>Image</td>
						 <td><?php if($banner_image!=""){?>  <img src="<?php echo base_url(); ?>adminuploads/adpost/banner/<?php echo $banner_image; ?>" alt="" height="90" width="100"/><?php } ?>
						  <input type="file" name="banner_image" id="banner_image" />(jpeg|jpg|gif|png only supported)</td>
						<?php if(isset($err_msg)){ echo "<span style=\"color:#F00; font-weight:bold;\">".$err_msg."</span>";}?>
						<?php if(isset($image_error)){ echo "<span style=\"color:#F00; font-weight:bold;\">".$image_error."</span>";}?>
					</tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" onclick=" return validateForm();" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url(); ?>cp/viewBanner">cancel</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  