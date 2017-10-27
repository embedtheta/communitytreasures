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
            <h2>View Listing</h2>
            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/user_youtube_add/<?php echo $page;?>">Add</a>
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
       	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
       	    <tr>
                <th width="10%" align="left" scope="col">Id</th>
                <th width="35%" align="left" scope="col">Youtube Title</th>
                <th width="30%" align="left" scope="col">Youtube Url</th>
                <th width="15%" align="left" scope="col">Status</th>
                <th width="10%" align="left" scope="col">Action</th>
   	        </tr>
            <?php 
			if(count($userList) > 0){
				$i = 1;
				  foreach($userList as $key=>$valList){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
             <tr>
               		
                <td class="<?php echo $className;?>"><?php echo $valList->id;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->youtubeName;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->youtubeUrl;?></td>
                <td class="<?php echo $className;?>"> <?php if($valList->status == "1"){?>Active<?php }else{?>Inactive<?php }?> </td>
                <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/user_youtube_edit/<?php echo $valList->id;?>/<?php echo $page;?>">Edit</a> ||<a onclick="return confirm('Are you sure to delete this Record.')" href="<?php echo base_url();?>admin/user_youtube_delete/<?php echo $valList->id;?>/<?php echo $page;?>">Delete</a></td>
   	    </tr>
            <?php } 
                }else{
            ?>
             <tr>
       	      <th align="left" scope="col" colspan="5" class="table-gray">No Data!</th>
       	      
   	        </tr>
            <?php }?>
       	   
                
   	      </table>
        </div>
        <?php echo $pagination;?> 
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  