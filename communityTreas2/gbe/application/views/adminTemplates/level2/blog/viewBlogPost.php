<?php $this->load->view('adminTemplates/common/header',$viewData);?>



<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>View List of <?php echo ucwords($selectedUserType);?> Blog Post</h2>
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
        				
            	<table width="700" height="200" border="1" align="center" class="form-table">
     				<tbody><tr>
    					<td>Title</td>
    					<td><?php echo $details[0]->post_title;?></td>
    				</tr>
                    <tr>
    					<td>Content</td>
    					<td><?php echo $details[0]->post_content;?></td>
    				</tr>
                    <tr>
    					<td class="table-row">Auther Image</td>
    					<td><span><img src="<?php echo base_url();?>useruploads/<?php echo $details[0]->profile;?>" width="70" height="70"></span></td>
    				</tr>
                    <tr>
     					<td>Auther Name</td>
      					<td><?php echo $details[0]->firstName.' '.$details[0]->lastName;?></td>
    				</tr>
    				<tr>
    					<td colspan="2"><a href="<?php echo base_url();?>cp/listingBlogPost/<?php echo $page;?>">Back</a></td>
    				</tr>
  				</tbody></table>
          
        </div>
       
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  