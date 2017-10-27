<?php $this->load->view("header", "", $result); ?>

<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>-->

<script>

 $(document).ready(function(){
	  $('#loading').hide();
	 $(".ulLevel1").unbind().bind("click", function(){
		var id = $(this).attr("id");
		var hasChild = $(this).attr("name");
		if(hasChild > 0){
			$("#ul1_"+id).slideToggle('slow'); 
			if($(this).text() == '-'){
				$(this).text('+');
			}else{
				$(this).text('-');
			}
		}
	});
	
	$(".ulLevel2").unbind().bind("click", function(){
		var id = $(this).attr("id");
		var hasChild = $(this).attr("name");
		if(hasChild > 0){
			$("#ul2_"+id).slideToggle('slow'); 
			if($(this).text() == '-'){
				$(this).text('+');
			}else{
				$(this).text('-');
			}
		}
	});
	
	$(".ulLevel3").unbind().bind("click", function(){
		var id = $(this).attr("id");
		var hasChild = $(this).attr("name");
		if(hasChild > 0){
			$("#ul3_"+id).slideToggle('slow'); 
			if($(this).text() == '-'){
				$(this).text('+');
			}else{
				$(this).text('-');
			}
		}
	});	
	
	
	
	//$.fancybox.open('<div class="success-msgg"><b>Success!</b> You have successfully send Login details for the MASS user</div>');
	 <?php if ($status=="success") { ?>
        $.fancybox.open('<div class="success-msgg"><b>Success!</b><?php echo $msg; ?></div>');
    <?php } ?>
	<?php if ($status=="error") { ?>
        $.fancybox.open('<div class="success-error-vip"><p><b>Error! </b><?php echo $msg; ?></p><?php echo form_error('name', '<span class="form_error">', '</span><br>'); ?><?php echo form_error('emailAddr', '<span class="form_error">', '</span><br>'); ?><?php echo form_error('category', '<span class="form_error">', '</span><br>'); ?><?php echo form_error('country', '<span class="form_error">', '</span><br>'); ?><?php echo form_error('message', '<span class="form_error">', '</span><br>'); ?></div>');
    <?php } ?>
	
 });

</script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="wrapper">
 
   
    <div class="nav">
      <nav class="secondary">
        <ul class="misc_new">
	<?php	if($mssPayStatus==0){
		?>
           <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="javascript:void(0)" id="gbeLevel1"><span class="level">Q 1 - <i>Open</i></span>CT Rave Share</a></li>
	<?php	}
		else
		{
			?><li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Q 1 - <i>Open</i></span> CT Rave Share</a></li>
	<?php }
?>
          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] > 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Q 2 - <i>Open</i></span> LifeStyle</a> </li>

          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] > 2){ echo base_url()."source";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Q 3 - <i>Open</i></span> Knowledge</a></li>

          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo base_url()."regeneration";}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Q 4 - <i>Open</i></span> Co-operative</a></li>

          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] > 4){ echo base_url()."franchise";}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Q 5 - <i>Open</i></span>Summit</a></li>

		
          
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
 
  <!--header end-->
  
  <div class="main_container">
  
   <div class="white-bg">
      <div class="mms_page">
      <div class="watch_video_com_trs"><h2 style="color:#9ba3b3;">Welcome To <?php echo $userInfo[0]["firstName"];?> <?php echo $userInfo[0]["lastName"];?> to Payment Section
      <span style="color: #f70c14; display: block; font-size: 36px; padding-top: 15px;"></span>
      </h2>
	  <form name="frm" id="frm" action="<?php echo base_url();?>ct_payment/ctjoin">
      	<div class="watch_video_com_trs_inr" style="width:100%; background:none;">
       
        <input type="submit" name="ravepayment" value="Pay Now"></div>
		</form>
		<form  method="post" action="https://www.okpay.com/process.html">
		   <input type="hidden" name="ok_receiver" value="OK702746927"/>
		   <input type="hidden" name="ok_item_1_name" value="Registration Fees"/>
		   <input type="hidden" name="ok_item_1_price" value="1"/>
		   <input type="hidden" name="ok_currency" value="USD"/>
		   <input type="submit" name="submit" value="OKPAY"/>
		</form>
      </div>       
       
        
      </div>
    </div>
    <br class="clear">
  </div>
 
</div>


<style>
.wtch_vio {
  background: #9a0e18 none repeat scroll 0 0;
  float: left;
  width: 24%; text-align:center;
}
.flw_ibst > p {
  text-align: center;
}
</style>
 


