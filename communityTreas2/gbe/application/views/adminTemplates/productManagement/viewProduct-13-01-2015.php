<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Lists of Product </h2>
            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/addProduct">Add</a>
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
       	      <th width="22%" align="left" scope="col">Title</th>
       	      <th width="22%" align="left" scope="col">Picture</th>
       	      <th width="46%" align="left" scope="col">Description</th>
       	      <th width="10%" align="left" scope="col">Action</th>
   	        </tr>
            <?php foreach($infoProducts as $key=>$valCreative){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
       	      <td class="<?php echo $className;?>"><?php echo $infoProducts[$key]["productName"];?></td>
       	      <td class="<?php echo $className;?>"><img src="<?php echo base_url();?>/adminuploads/productPagesImg/<?php echo $infoProducts[$key]["productImg"];?>" width="107" height="107"/></td>
       	      <td class="<?php echo $className;?>"><?php //echo $infoProducts[$key]["productDesc"];?>
              <embed type="application/x-vlc-plugin" name="VLC" autoplay="no" loop="no" volume="100" width="300" height="30" target="http://www.globalblackenterprises.com/adminuploads/productPagesImg/<?php echo $infoProducts[$key]["productMusic"];?>">
              </td>
       	      <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/editEventsCelebrations/<?php echo $infoProducts[$key]["productID"];?>">Edit </a> | <a href="<?php echo base_url();?>admin/deleteEventsCelebrations/<?php echo $infoProducts[$key]["productID"];?>">Delete</a></td>
   	        </tr>
            <?php } ?>
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