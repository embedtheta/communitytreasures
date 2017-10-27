<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Article Zone</h2>
            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/addArticleZone">Add</a>
            </h3>
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
       	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
       	    <tr>
       	      <th width="17%" align="left" scope="col">Title</th>
       	      <th width="17%" align="left" scope="col">Picture</th>
       	      <th width="30%" align="left" scope="col">Description</th>
              <th width="17%" align="left" scope="col">Author</th>
              <th width="9%" align="left" scope="col">Date</th>
       	      <th width="10%" align="left" scope="col">Action</th>
   	        </tr>
            <?php // print_r($infoCreative);
				  foreach($infoArticleZone as $key=>$valCreative){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
            
       	      <td class="<?php echo $className;?>"><?php echo $infoArticleZone[$key]["articleTitle"];?></td>
       	      <td class="<?php echo $className;?>"><img src="<?php echo base_url();?>/adminuploads/productPagesImg/<?php echo $infoArticleZone[$key]["articleImg"];?>" width="107" height="107"/></td>
       	      <td class="<?php echo $className;?>"><?php echo $infoArticleZone[$key]["articleDesc"];?></td>
              <td class="<?php echo $className;?>"><?php echo $infoArticleZone[$key]["articleAuthor"];?></td>
              <td class="<?php echo $className;?>"><?php echo $infoArticleZone[$key]["articleDate"];?></td>
       	      <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/editArticleZone/<?php echo $infoArticleZone[$key]["articleID"];?>">Edit </a> | <a href="<?php echo base_url();?>admin/deleteArticleZone/<?php echo $infoArticleZone[$key]["articleID"];?>">Delete</a></td>
   	        </tr>
            <?php } ?>
       	   <!-- <tr>
       	      <td class="table-gray">Progressive Word</td>
       	      <td class="table-gray">Ghosh</td>
       	      <td class="table-gray">Lorem Ipsum is simply dummy text of the printing and typesetting.</td>
       	      <td class="table-gray"><a href="#">Edit </a> | <a href="#">Delete</a></td>
   	        </tr>
       	    <tr>
       	      <td>&nbsp;</td>
       	      <td>&nbsp;</td>
       	      <td>&nbsp;</td>
       	      <td>&nbsp;</td>
   	        </tr>
       	    <tr>
       	      <td class="table-gray">&nbsp;</td>
       	      <td class="table-gray">&nbsp;</td>
       	      <td class="table-gray">&nbsp;</td>
       	      <td class="table-gray">&nbsp;</td>
   	        </tr>-->
   	      </table>
        </div>
        <!--<div class="login-section">
             <form action="" method="post" id="frnd" class="main-form">
                 <input name="" type="text" placeholder="Email" class="input1">
                 <input name="" type="email" placeholder="Password" class="input2">
                 <input name="" type="submit" value="Login" class="login-submit">
             </form>
        </div>-->
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  