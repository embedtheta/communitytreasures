<?php $this->load->view("header", "", $result); ?>
<script type="text/javascript">

function catalogPayment(id){
	var paymentStatus = '<?php echo $userInfo[0]["afrooPaymentStatus"];?>';
	if(paymentStatus == '1'){
		$.fancybox.open('You have allready bought the Afrowebb Catalogue.So please continue.');
	}else{
		
		window.location.href='<?php echo base_url();?>gbe_payment/catalog/'+id;	
		return true;
	}
}

</script>


<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>js/custom_common.js'></script>

<script type="text/javascript">

//var userLevel  = <?php if($userInfo[0]['userLevel']>0) {echo $userInfo[0]['userLevel'].";";} else { echo "".";"; } ?>
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";

jQuery(document).ready(function($){	
 $('.close_btn_level').click(function(){
	 	$('.ppup_level').remove();
	 }); 
	 // move up process
	  $("#moveUp").click(function(){
		//alert('click'); 
		$.ajax({
		 type: "POST",
		 url:  "<?php echo base_url();?>dashboard/moveUpTonextLevel5", 
		 data: "payment=1&group=0",
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
					$('.ppup_level').remove();
					alert(data.message);
					//$.fancybox.open(data.message);					
				}
				else{
					//$.fancybox.open(data.message);
					alert(data.message);
				} 
			  }
		  });
	 });
	 
});
</script>


<?php //if($myCurrPosition > 160){
	if($myCurrPosition > 320 & $userInfo[0]["userLevel"]==4){ ?>
<div class="ppup_level">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_level" title="Close"></a>
  <h2>Congratulations</h2>
  <h3>You have successfully Completed Level 4.</h3>
  <h4>Click "Move Up" to get access next level<br>
 </h4>
  <h5>Move to level 5 </h5>
  <p class="termsCond">
    <input type="checkbox" id="termsCheck" class="ckbxe">
    <span>Terms & Conditions</span>
	</p>
  <div class="switch_extrapara">
    <p class="swt_img"><a id="moveUp" href="javascript:;"><img width="424" height="81" style="cursor:pointer" alt="" src="<?php echo base_url();?>images/move_up.png"></a></p>
  </div>
</div>
</div>
</div>
<?php } ?>

<?php $this->load->view("nav_header", "", $result); ?>


<!--ADDING COMMON FORM-->

<?php $this->load->view("commonform", "", $result); ?>

<!--END OF ADDING COMMON FORM--> 

<!-- header end --> 

<!-- main container start -->

<div class="main_container_new ddsh raveshare"> 
  
  <!-- lefts side start -->
  
  <div class="lefts_side"> 
    
    <!--tab start-->
    
    <div class="tabsectionstep">  
	 <div id="contentId">
		<?php if($userInfo[0]["afrooPaymentStatus"]==0){
			?> Please Click on Purchase Catalogue
			<?php
		}
	?>
	 </div>
    </div>
	</div>
    <!-- left side tab end--> 
     <!-- right side tab start--> 
 <?php $this->load->view("right_panel", "", $result); ?>
  
  <!-- rights side end -->
  <div class="clear"></div>
</div>

<!-- main container end -->

