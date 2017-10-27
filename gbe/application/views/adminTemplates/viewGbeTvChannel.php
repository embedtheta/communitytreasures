  <?php $this->load->view('adminTemplates/common/header',$viewData);?>
  <!--Main Content-->
  <div class="content-wrapper">
  	 <?php //if(!empty($results) ) {
          
          ?>
    
   
        <div class="content-inner">
    	<div class="page-title">
            <h2>GBE TV Channels</h2>  <h3 align="right"><a href="<?php echo base_url();?>admin/addGbeTvChannel">Add</a></h3>
        </div>
        
         <?php // } ?>
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
        <?php if(isset($status) && ( $status == "Invalid")) {?>
        <div class="admin-msg error-msg" id="errorMsg">
            <i class="fa fa-times"></i> 
                <span>Invalid Format or Id</span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Error-->
        
        <!--Warning-->
  
         <?php 
          
         
       
		   if(!empty($results)) { 
		?>
          <div class="table-content" id="dashreload">
       	  <form name="checkSubmit" id="checkSubmit" action="" method="post" >
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
       	    <tr>
            <th width="22%" align="left" scope="col">Title</th>
       	      <th width="46%" align="left" scope="col">Description</th>
              <th width="22%" align="left" scope="col">Image</th>       	      
             <th width="10%" align="left" scope="col">Action</th>
   	        </tr>
            
            <?php 
			
			foreach($results as $view) { 
					$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}

			?>
            
            <tr>
            <td class="<?php echo $className;?>"><?php echo $view->channeltitle; ?></td>
            <td class="<?php echo $className;?>"><?php echo substr($view->channeldesc,0, 150)."....."; ?></td>
            <td class="<?php echo $className;?>"><?php echo $view->channelimage; ?></td>            
            <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/editGbeTvChannel/<?php echo $view->id;?>">Edit</a></td>
       	     
   	        </tr>
           
            
            <?php 
			
			 }
			
			 ?>
			</table>
            
             <br />
             <p><?php //echo "pages..".$links; ?></p>
           </form>
        </div>
         <?php  }else{ ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <th scope="col">No Records Found</th>
            </tr>
            </table>
         <?php }?>
        
    </div>
  </div>
  <!--Main Content--> 
  
 <?php $this->load->view('adminTemplates/common/footer',$viewData);?>
  