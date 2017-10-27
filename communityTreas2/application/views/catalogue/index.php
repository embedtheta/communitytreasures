<?php $this->load->view("header", "", $result); ?>

<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>

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
function readURL(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
         $('#empPic').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}



</script>

<script>

 $(document).ready(function(){
	 
	/* $(".ulLevel1").unbind().bind("click", function(){
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
	
	<?php if($totalUserUnderMassUser >= 12){?>
	$.fancybox.open('<div class="switch"><h3 style="text-align:center;">Congratulations <br>You have enough people qualify you to move up.</h3><h2 style="text-align:center;">Now you are in Level 2 .So you can make more money! Hurry up.</h2><div class="switch_extrapara"><p class="swt_img"><a href="<?php echo base_url();?>catalogue"><img width="567" height="81" style="cursor:pointer" alt="" src="<?php echo base_url();?>images/submit-paypal.png"></a></p></div></div>'); 
	<?php }?>*/
	
 });
 
 function showAlert(){
	 var msg = "You can send 12 request on each Level.";
	 $.fancybox.open(msg);
     return false;
 }
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script>
$(document).ready(function(){
	$("#videoLinkId").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
	});
});
</script>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="wrapper">
 
   
    <div class="nav">
      <nav class="secondary">
        <ul class="misc_new">
	<?php	if($mssPayStatus==0){
		?>
           <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="javascript:void(0)" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>
	<?php	}
		else
		{
			?><li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>
	<?php }
?>
          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] > 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>

          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] > 2){ echo base_url()."source";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Level - 3</span> Diversity<span> Open </span></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo base_url()."regeneration";}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Level - 4</span> Corporation <span> Open </span> </a></li>

          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] > 4){ echo base_url()."franchise";}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Level - 5</span>Summit<span> Open </span> </a></li>

		
          
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
 
  <!--header end-->
  
  <div class="main_container com_tres_catlog">
  <div class="ab_inner sing"><!--<strong><?php //echo $stepWiseVideo[1]["C"]["serial_field"];?> </strong>-->
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["C"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2" name="<?php echo $stepWiseVideo[1]["C"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
   <div class="white-bg">
      <div class="pricewraper">
                  <?php if(count($afroProduct) >0){
                        $color = 'green';
                        $i = 0;
                        foreach ($afroProduct as $afro){ 
                            if($i == 1){ $color = 'orang';}
                            if($i == 2){ $color = 'blue';}
                            $i++;
                       
?>
                  <div class="singpric <?php echo $color;?>">
                    <div class="pblackbox">
                      <p class="topp"><?php echo $afro->title;?></p>
                      <div class="pric"> <span class="psign"><?php echo $afro->currency_code;?></span> <span class="pmainpric"><?php echo $afro->cost;?></span> </div>
                      <p class="botp">One time payment</p>
                    </div>
                    <?php echo $afro->description;?> 
                   
                    
                    <div class="prcbutt"><a href="javascript:void(0)" class="pricbuy" onclick="catalogPayment('<?php echo $afro->id;?>')">Buy It Now</a></div>
                  </div>
                  <?php } } ?>
               <br class="clear">  </div>
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

<script type="text/javascript">
var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";

</script> 
<script type='text/javascript' src='<?php echo base_url();?>js/custom_common.js'></script>
<!--
</body>
</html-->
