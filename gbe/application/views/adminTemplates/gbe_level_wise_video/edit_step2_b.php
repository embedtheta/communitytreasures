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
               
        if(url == ""){
            alert("Please enter the Url value.");
            $("#url").focus();
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
            <h2><?php echo $action;?> Step-2 B Url</h2>
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
            <form id="editMenuZone" name="editMenuZone" method="post" action="" class="main_form">
                
                <table width="600" height="200" border="1" align="center" class="form-table">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" id="title" name="title" class="input1" value="<?php if($title!=""){?><?php echo $title;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Url</td>
                        <td><input type="text" id="url" name="url" class="input1" value="<?php if($url!=""){?><?php echo $url;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Description</td>
                        <td><textarea style="width: 300px;height: 150px;" class="input2" id="description" name="description"><?php if($description!=""){?><?php echo $description;?><?php }?></textarea></td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" onclick=" return validateForm();" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url(); ?>cp/viewStep2UrlList">cancel</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  