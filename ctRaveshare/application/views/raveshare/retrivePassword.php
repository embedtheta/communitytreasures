<!--<html>
<head><u>User Detail</u></head>-->
<?php $this->load->view("header", "", $result); ?>
<script type="text/javascript">
jQuery(document).ready(function($){	

	$('#loading').hide();
	
 $("#getDetail").click(function(){ 
	/*  if($("#ucredId").css('display')=='none'){
		 $("#ucredId").css({'display':'block'});
	 }
	else{
		$("#ucredId").css({'display':'none'});
	} */	
	$('#ucredId').html('');
	var emailId = $("#userEmail").val();
	if(emailId==""){
		$.fancybox.open("Please enter your email");
	}
	else{
		$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>userDetail/retrievePassword",
			 data: "emailId="+emailId,
			 cache:false,
			 dataType: "json",
			 beforeSend: function() {
				$('#loading').show();  // show loading indicator
			  },
			 success: 
				  function(data){

				   //alert(data);  //as a debugging message	

					$('#loading').hide();  // hide loading indicator

					if(data.success == "yes")
					{	
						//alert(data.userData);

						//$.fancybox.open(data.message);
						$('#userEmail').val('');
						$('#ucredId').html(data.userData);

						//$('#catPurchaseId').css('display','none');

						

					}
					else{
						//$.fancybox.open(data.message);
						$('#ucredId').html('');
						$('#userEmail').val('');
						$.fancybox.open(data.message);
					} 

				  }

		 });
		 
	  }
	
	});
 
});
</script>


<div id="loading"><img src='<?php echo base_url();?>images/loading.gif' /></div>
<div><h2>Please enter your registered email to retrieve your password</h2></div>
<br>
<div>Email : <input type="text" name="userEmail" id="userEmail" value="">
<div id="ucredId"></div>
<br>
<div><input type="button" id="getDetail" value="Submit"></div>


</div>


