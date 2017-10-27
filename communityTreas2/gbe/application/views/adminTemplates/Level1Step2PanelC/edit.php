<?php $this->load->view('adminTemplates/common/header',$viewData);?>

<script type="application/javascript">
/*$(document).ready(function(e) {
    $(".sendEmail").click(function(){
		var id = $(this).attr("id"); //alert(id);
		$.ajax({
			type : "POST",
			async:false,
			url:"<?php echo base_url();?>cp/deleteExpellUser",
			data:"id="+id,
			success: function(data){
				if(data == 1){
					location.reload();
				}else{
					alert('There is a problem in email or user id.');
				}
			}
		});
	});
});*/
</script>

<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Edit</h2>
            
        </div>
        
        <!--Success-->
        <?php if(isset($submissionReport)){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $submissionReport;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if(isset($errorReport)){ ?>
        <div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $errorReport;?></span>
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
       	  <form id="addCreative" name="addCreative" method="post" action="" enctype="multipart/form-data" class="main_form">
            	<table width="100%" border="1" align="center" class="form-table">
     				<tr>
    					<td>Title</td>
    					<td><input type="text" name="youtubeName" id="youtubeName" class="input1" value="<?php echo $details[0]->youtubeName;?>" />
      						<?php echo form_error('youtubeName', '<br><span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    
                    <tr>
    					<td>Url</td>
    					<td><input type="text" name="youtubeUrl" id="youtubeUrl" class="input1" value="<?php echo $details[0]->youtubeUrl;?>" />
      						<?php echo form_error('youtubeUrl', '<br><span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    
                    <tr>
    					<td>Status</td>
    					<td>
                        	<input type="radio" name="status" id="status" value="1" <?php if($details[0]->status == '1'){?> checked="checked"<?php } ?>/>Active
       					 	<input type="radio" name="status" id="status" value="0" <?php if($details[0]->status == '0'){?> checked="checked"<?php } ?> />Inactive
    					</td>
    				</tr>
                   
    				<tr>
    					<td colspan="2">
      						<input type="submit" name="submit" id="submit" value="update" class="submit-bnt" /><!--&nbsp;<input type="reset" name="reset" id="reset" value="reset" class="submit-bnt" />-->&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/user_youtube/<?php echo $page;?>">cancel</a>
                         </td>
    				</tr>
  				</table>
            </form>
        </div>
        <?php echo $pagination;?> 
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  