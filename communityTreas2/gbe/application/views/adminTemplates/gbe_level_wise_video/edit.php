<?php $this->load->view('adminTemplates/common/header', $viewData); ?>


<!--Main Content-->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-title">
            <h2>Edit GBE Level Wise Details</h2>
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
                        <td>Level</td>
                        <td><input type="text" id="level" name="level" class="input1" value="<?php if($val->level!=""){?><?php echo $val->level;?><?php }?>" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <td>Step</td>
                        <td><input type="text" id="step" name="step" class="input1" value="<?php if($val->step!=""){?><?php echo $val->step;?><?php }?>" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <td>Serial</td>
                        <td><input type="text" id="serial_field" name="serial_field" class="input1" value="<?php if($val->serial_field!=""){?><?php echo $val->serial_field;?><?php }else{echo "Intro Video";}?>" readonly="readonly" /></td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td><input type="text" id="title" name="title" class="input1" value="<?php if($val->title!=""){?><?php echo $val->title;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Path</td>
                        <td><input type="text" id="path" name="path" class="input1" value="<?php if($val->path!=""){?><?php echo $val->path;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Content Title</td>
                        <td><input type="text" id="content_title" name="content_title" class="input1" value="<?php if($val->content_title!=""){?><?php echo $val->content_title;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Content</td>
                        <td><textarea rows="10" id="content" name="content" style="width: 220px; height: 163px;"><?php if($val->content!=""){?><?php echo $val->content;?><?php }?></textarea></td>
                    </tr>
                    
                    <tr>
                        <td>Content Image</td>
                        <td>
                            <input type="file" id="content_image" name="content_image" class="input1" value="" />
                            <?php if($val->content_image!=""){?><div style="height: 100px;width: 100px;"><img height="100" width="100" src="<?php echo base_url().'adminuploads/level_wise_images/'.$val->content_image;?>" alt=""></div><?php }?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Status</td>
                        <td>
                            <input class="input-status" type="radio" value="1" name="status" <?php if($val->status == 1){?> checked="checked" <?php }?>>
                            Active
                            <input class="input-status" type="radio" value="0" name="status" <?php if($val->status == 0){?> checked="checked" <?php }?>>
                            Inactive </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url(); ?>cp/gbeLevelWiseVideoList">cancel</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  