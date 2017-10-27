<?php $this->load->view('adminTemplates/common/header', $viewData); ?>

<script type="text/javascript">
    $(document).ready(function(){
        
    });
    
    function validateForm(){
        var title = $("#title").val();
        
		
        if(title == ""){
            alert("Please enter the Title value.");
            $("#title").focus();
            return false;
        }
        
        
        return true;        
    }
</script>
<!--Main Content-->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-title">
            <h2><?php echo $action;?> Category</h2>

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
                        <td>
                        <input type="text"  style="background-color: #d9d9d9" id="title" name="title" class="input1" value="<?php if($title!=""){?><?php echo $title;?><?php }?>"></td>
                    </tr>
                                     
                   
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" onclick=" return validateForm();" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url(); ?>cp/viewCategory">cancel</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  