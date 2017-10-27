<?php $this->load->view('adminTemplates/common/header', $viewData); ?>


<!--Main Content-->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-title">
            <h2>Edit GBE Signup Details</h2>
<!--            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/getXls">Get Report</a>
            </h3>-->
        </div>
        
       <!--Success-->
        <?php if($report == 1){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if($report == 2){ ?>
        <div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Error-->
        
        <!--Warning-->
        <!--<div class="admin-msg warning-msg">
            <i class="fa fa-warning"></i>  
                <span>Aenean interdum interdum ligula, vitae auctor nisl bibendum eu.</span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>-->
        <!--Warning-->

        <div class="main_section" style="width: 700px;">
            <form id="editMenuZone" name="editMenuZone" method="post" action="" class="main_form" enctype="multipart/form-data">
                
                <table width="600" height="200" border="1" align="center" class="form-table">
                    <tr>
                        <td>Page Name</td>
                        <td><input type="text" id="level" name="level" class="input1" value="<?php if($val->page_name!=""){?><?php echo $val->page_name;?><?php }?>" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        
                    <td>Title</td>
                        <td><input type="text" id="title" name="title" class="input1" value="<?php if($val->title!=""){?><?php echo $val->title;?><?php }?>" /></td>
                    </tr>
<!--                    <tr>
                        <td>Content</td>
                        <td><textarea rows="10" id="content" name="content" style="width: 220px; height: 163px;"><?php if($val->content!=""){?><?php echo $val->content;?><?php }?></textarea></td>
                    </tr>                    -->
                    <tr>
                        <td>Video Path</td>
                        <td><input type="text" id="video_path" name="video_path" class="input1" value="<?php if($val->video_path!=""){?><?php echo $val->video_path;?><?php }?>" /></td>
                    </tr>
                    
<!--                    <tr>
                        <td>Meta Title</td>
                        <td><input type="text" id="meta_title" name="meta_title" class="input1" value="<?php if($val->meta_title!=""){?><?php echo $val->meta_title;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Meta Keywords</td>
                        <td><input type="text" id="meta_keywords" name="meta_keywords" class="input1" value="<?php if($val->meta_keywords!=""){?><?php echo $val->meta_keywords;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Meta Description</td>
                        <td><input type="text" value="<?php if($val->meta_description!=""){?><?php echo $val->meta_description;?><?php }?>" id="meta_description" name="meta_description" class="input1" /></td>
                    </tr>-->
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url(); ?>cp/viewSignupPages">cancel</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  