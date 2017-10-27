<?php $this->load->view('adminTemplates/common/header', $viewData); ?>


<!--Main Content-->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-title">
            <h2>Edit Afrowebb Catalogue</h2>
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
                        <td><input type="text" id="title" name="title" class="input1" value="<?php if($val->title!=""){?><?php echo $val->title;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Price</td>
                        <td><input type="text" id="cost" name="cost" class="input1" value="<?php if($val->cost!=""){?><?php echo $val->cost;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Currency</td>
                        <td>
                            <select style="width:220px;" id="currency_name" name="currency_name">
                            <option value="">Select One</option>
                            <option value="EUR" <?php if($val->currency_name == "EUR"){?> selected="selected" <?php }?> >EUR</option>
                            <option value="GBP" <?php if($val->currency_name == "GBP"){?> selected="selected" <?php }?>>GBP</option>
                            <option value="USD" <?php if($val->currency_name == "USD"){?> selected="selected" <?php }?>>USD</option>
                            </select></td>
                    </tr>
                    
                    <tr>
                        <td>Description</td>
                        <td><textarea style="width: 600px;height: 300px;" class="input2" id="description" name="description"><?php if($val->description!=""){?><?php echo $val->description;?><?php }?></textarea></td>
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
                            <input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url(); ?>admin/afroCatalogueList">cancel</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  