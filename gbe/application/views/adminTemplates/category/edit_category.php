<?php $this->load->view('adminTemplates/common/header', $viewData); ?>

<script type="text/javascript">
    $(document).ready(function(){
        
    });
    
    function validateForm(){
        var title = $("#title").val();
        var url = $("#url").val();
        var description = $("#description").val();
        if(title == ""){
            alert("Please enter the Title value.");
            $("#title").focus();
            return false;
        }
               
       
        
        if(description == ""){
            alert("Please enter the Description value.");
            $("#description").focus();
            return false;
        }
        
        return true;        
    }
</script>
<!--Main Content-->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-title">
            <h2><?php echo $action;?> Catalogue Category</h2>
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
                        <input type="text"  style="background-color: #d9d9d9"id="title" name="title" class="input1" value="<?php if($title!=""){?><?php echo $title;?><?php }?>" readonly></td>
                    </tr>
                    
                                     
                    <tr>
                        <td>Description</td>
                        <td><textarea style="width: 300px;height: 150px;" class="input2" id="description" name="description"><?php if($description!=""){?><?php echo $description;?><?php }?></textarea></td>
                    </tr>
					
					
					 <tr>
						  <td>Image</td>
						  <input type="hidden" name="db_img" value="<?php echo $image; ?>">
						 <td><?php if($image!=""){?>  <img src="<?php echo base_url(); ?>adminuploads/productPagesImg/<?php echo $image; ?>" alt="" height="90" width="100"/><?php } ?>
						  <input type="file" name="img" id="img" />(jpeg|jpg|gif|png only supported)</td>
						<?php if(isset($err_msg)){ echo "<span style=\"color:#F00; font-weight:bold;\">".$err_msg."</span>";}?>
						<?php if(isset($image_error)){ echo "<span style=\"color:#F00; font-weight:bold;\">".$image_error."</span>";}?>
					</tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" onclick=" return validateForm();" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url(); ?>cp/viewCategoryList">cancel</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  