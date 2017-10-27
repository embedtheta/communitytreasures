  <!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  
  
  function sendNotif(){
	
	var userGroup = $.trim($("#userGroup").val());
    var userLevel = $.trim($("#userLevel").val());
	var notTitle = $.trim($("#notTitle").val());
	var notMessage = $.trim($("#notMessage").val());
	//notMessage
    
    if(userGroup == "" || userGroup == 0){ 
		alert("Please select User Group.");
        $("#userGroup").focus();
       return false;
    } 
	if(userLevel =="" || userLevel == 0){
		
        alert("Please select User Level");
        $("#userLevel").focus();
      return false;
    }
	if(notTitle ==""){
		
        alert("Please Enter Notification Message");
        $("#notTitle").focus();
        return false;
    }
	if(notMessage ==""){
		
        alert("Please Enter Notification Message");
        $("#notMessage").focus();
        return false;
    }
       // alert('XYZ');
	$.ajax({ 
			 type: "POST",
			 url:  "<?php echo base_url();?>admin/notificationSend", 
			 data: "userGroup="+userGroup+"&userLevel="+userLevel+"&notTitle="+notTitle+"&notMessage="+notMessage,
			 cache:false,
			 dataType: "json",
			 success: 
				function(data){
				   //alert('==='+data.success);  //as a debugging message					
					if(data.success == "yes")
					{	
						//alert(data.withDrawalTable);
						alert("Notification send successfully.");	
						$("#notTitle").val('');								
						$("#notMessage").val('');						
						$("#rowValId").html(data.notifTable);											
								
					}
					else{
						alert('some error');
					}
				}
				
			});
     return true;
  }
  </script>
  
<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Current Account System - Notification</h2>
            
            <h3 align="right">
<!--                 <a href="<?php echo base_url();?>admin/addProduct">Add</a>-->
            </h3>
        </div>
        <div class="admin-notification">
		<div id="rowValId">
		<?php if(count($notificationData)>0){
				foreach($notificationData as $key=> $notificationDetail){
						$className = "notification-tab white";
					if ($key % 2 == 0) {
                  		$className = "notification-tab";
					}
					
					
					?>
				<div class="<?php echo $className;?>">
				<h3><a href="#">Read More 
				<img src="<?php echo base_url();?>/images/down-arrow.png" alt="" /></a></h3>
			   <h2><?php echo $notificationData[$key]["notTitle"]; ?></h2>
			  <p> <span>Notification: </span><?php echo $notificationData[$key]["message"]; ?></p>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		<td align="left" valign="top"><span>Date: </span><?php echo $notificationData[$key]["msg_date"]; ?></td>
			<td align="left" valign="top"><!--<span>Name:</span> Mr. J. K. Smith -->&nbsp;</td>
			<td align="left" valign="top"><span>Level: </span><?php echo $notificationData[$key]["userLevel"]; ?></td>
			<!--<td align="left" valign="top"><span>Reply</span></td>-->
		  </tr>
		</table>

				</div>
				<?php 
				
				}
		} else {
			?> <div class="notification-tab" >No Data</div>
		<?php }?>
        </div>
        <div class="general-msgsec">
        <h2>Send General Message</h2>
        <form action="" method="post">
        <p><label>Select</label>
        <select name="userGroup" id="userGroup">
        <option value="">Select Group</option>
		<option value="1">Business</option>
		<option value="2">Community</option>
		<option value="3">Health</option>
		<option value="4">Mentorship</option>
		<option value="5">talented</option>
		<option value="6">Teacher</option>
		<option value="7">Volunteers</option>
		
        </select>
        <br class="clear" />
        <label>Level</label>
         <select name="userLevel" id="userLevel">
		 <option value="">Select Level</option>
        <option value="1">Level 1</option>
		<option value="2">Level 2</option>
		<option value="3">Level 3</option>
		<option value="4">Level 4</option>
		<option value="5">Level 5</option>
        </select>
        </p>
		<p style="padding-bottom:0;"> <label>Title</label>
        <input type="text" name="notTitle" id="notTitle" /> </p>
       <p style="padding-top:0;"> <label>Message</label>
        <textarea name="notMessage" id="notMessage" cols="" rows=""></textarea> </p>
		<!--<input name="" type="submit" value="Send Message" >-->
       <p style="padding-top:0;"> <input name="" type="button" class="notifClass" value="Send Message" onclick="sendNotif();" /></p>
        </form>
        <br class="clear" />
        </div>
        </div>
      
      <!--Success-->
        <?php if($type != ''){ ?>
        <div class="admin-msg <?php echo $type;?>-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if($type == 'error'){ ?>
        <!--<div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>-->
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
       	  
        </div>
       
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  