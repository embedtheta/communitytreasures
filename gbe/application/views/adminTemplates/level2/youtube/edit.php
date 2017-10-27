<?php $this->load->view('adminTemplates/common/header',$viewData);?>

<script type="text/javascript">
<?php if($details[0]->cover_img == ""):?>
$(document).ready(function(e) {
    $("#empPic").hide();
});
<?php endif;?>
function readURL(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
         $('#empPic').attr('src', e.target.result);
		 $("#empPic").show();
      }
      reader.readAsDataURL(input.files[0]);
    }
}
</script>

<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Update Level 2 step 2 Youtube</h2>
            <h3 align="right">
<!--                 <a href="<?php echo base_url();?>cp/getXls/1">Get Report</a>-->
            </h3>
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
        <!--Error-->
        
        
        <div class="table-content">
            <div class="main_section">
        			<form action="" method="post" enctype="multipart/form-data">	
            	<table width="700" height="200" border="1" align="center" class="form-table">
     				<tbody><tr>
    					<td>Title</td>
    					<td><input type="text" value="<?php echo $details[0]->title;?>" name="title" id="title" class="input1"><?php echo form_error('title', '<br /><span class="form_error">', '</span>'); ?></td>
    				</tr>
                     <tr>
    					<td>Description</td>
    					<td><textarea cols="70" rows="5" name="desc"><?php echo $details[0]->desc;?></textarea>
                        <?php echo form_error('desc', '<br /><span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
                    <tr>
    					<td class="table-row">Youtube Url</td>
    					<td><input type="text" value="<?php echo $details[0]->url;?>" name="url" class="input1"><?php echo form_error('url', '<br /><span class="form_error">', '</span>'); ?></td>
    				</tr>
    				<tr>
    					<td colspan="2"><input type="submit" name="add" value="Update" class="submit-bnt" /> &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo base_url();?>cp/listingL2S2Youtube/<?php echo $page;?>" class="submit-bnt">Back</a></td>
    				</tr>
  				</tbody></table>
                </form>
          
        </div>
       
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  