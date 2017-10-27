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
            <h2>Update Brochure</h2>
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
    					<td><input type="text" value="<?php echo $details[0]->title;?>" name="title" id="title"><?php echo form_error('title', '<br /><span class="form_error">', '</span>'); ?></td>
    				</tr>
                    <tr>
    					<td>Cover image</td>
    					<td><input type="file" onchange="readURL(this);" value="Add photo" name="cover_img" class="brws">
                        <input type="hidden" name="temp_cover_img"  value="<?php echo $details[0]->cover_img;?>" />
                        <?php echo form_error('cover_img', '<br /><span class="form_error">', '</span>'); ?>
                        <div id="contact-image"><img alt="" src="<?php echo base_url().'adminuploads/brochureVcards/brochure/'.$details[0]->cover_img;?>" id="empPic" height="90" width="90" ></div></td>
    				</tr>
                    <tr>
    					<td class="table-row">File</td>
    					<td><input type="file" value="" name="file_name" class="brws"><?php echo $details[0]->file_name;?>
						<input type="hidden" name="temp_file_name"  value="<?php echo $details[0]->file_name;?>" />
						<?php echo form_error('file_name', '<br /><span class="form_error">', '</span>'); ?></td>
    				</tr>
    				<tr>
    					<td colspan="2"><input type="submit" name="add" value="Update" class="submit-bnt" /> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>cp/listingBrochure/<?php echo $page;?>" class="submit-bnt">Back</a></td>
    				</tr>
  				</tbody></table>
                </form>
          
        </div>
       
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  