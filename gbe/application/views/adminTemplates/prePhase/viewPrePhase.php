<?php $this->load->view('adminTemplates/common/header',$viewData);?>

<script type="application/javascript">
$(document).ready(function(e) {
    $(".sendEmail").click(function(){
		var id = $(this).attr("id");
		$.ajax({
			type : "POST",
			async:false,
			url:"<?php echo base_url();?>admin/sendEmailToPrephaseUser",
			data:"id="+id,
			success: function(data){
				if(data == '1'){
					location.reload();
				}else{
					alert('There is a problem in email or user id.');
				}
			}
		});
	});
});
</script>

<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>View List</h2>
            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/getXls">Get Report</a>
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
       	      <th width="22%" align="left" scope="col">Name</th>
       	      <th width="22%" align="left" scope="col">Invited By</th>
       	      <th width="10%" align="left" scope="col">Phone</th>
       	      <th width="20%" align="left" scope="col">Email</th>
              <th width="15%" align="left" scope="col">Skype ID</th>
			  <th width="10%" align="left" scope="col">City</th>
              <th width="11%" align="left" scope="col">Send Email</th>
   	        </tr>
            <?php 
			if(count($centoruList) > 0){
				  foreach($centoruList as $key=>$valList){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
       	      <td class="<?php echo $className;?>"><?php echo $centoruList[$key]["firstName"]." ".$centoruList[$key]["lastName"];?></td>
       	      <td class="<?php echo $className;?>"><?php echo $centoruList[$key]["fn"]." ".$centoruList[$key]["ln"];?></td>
       	      <td class="<?php echo $className;?>"><?php echo $centoruList[$key]["phone"];?></td>
       	      <td class="<?php echo $className;?>"><?php echo $centoruList[$key]["emailID"];?></td>
              <td class="<?php echo $className;?>"><?php echo $centoruList[$key]["skypeID"];?></td>
			  <td class="<?php echo $className;?>"><?php echo $centoruList[$key]["city"];?></td>
              <td class="<?php echo $className;?>"><?php if($centoruList[$key]["email_send_status"] > 0){?><input type="checkbox" checked="checked" disabled><?php }else{?><a href="javascript:void(0);" class="sendEmail" id="<?php echo $centoruList[$key]["uID"];?>">Send</a><?php }?></td>
   	        </tr>
            <?php } 
			}else{
			?>
             <tr>
       	      <th align="left" scope="col" colspan="7" class="table-gray">No Data!</th>
       	      
   	        </tr>
            <?php }?>
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