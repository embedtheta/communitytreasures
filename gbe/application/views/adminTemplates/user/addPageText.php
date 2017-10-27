<?php $this->load->view('adminTemplates/common/header', $viewData); ?>

<script type="text/javascript">
    $(document).ready(function(){
        
    });
    
    function validateForm(){
        var page_text = $("#page_text").val();
      
        if(page_text == ""){
            alert("Please enter the Page Text.");
            $("#page_text").focus();
            return false;
        }        
        
        return true;        
    }
</script>
<!--Main Content-->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-title">
            <h2><?php echo $action;?> Page Text</h2>

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
            <form id="addPageText" name="addPageText" method="post" action="" class="main_form txt_pg_bk">
                
                <table width="600" height="200" border="1" align="center" class="form-table">
                    <tr>
                        <td>Page Text :</td>
                        <td><textarea style="width: 400px;height: 50px;" class="input2" id="page_text" name="page_text"><?php if($page_text!=""){?><?php echo $page_text;?><?php }?></textarea></td>
                    </tr>         
                   
                    <tr>
                        <td colspan="2">
						<input type="hidden" name="pageAction" id="pageAction" value="<?php echo $action; ?>" >
                            <!--<input type="submit" onclick=" return validateForm();" name="submit" id="submit" value="save" class="submit-bnt" />-->
							<input type="submit"  name="submit" id="submit" value="save" class="submit-bnt" />
							<a href="<?php echo base_url(); ?>cp/viewHeadVolunteer">cancel</a><br class="clear">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  