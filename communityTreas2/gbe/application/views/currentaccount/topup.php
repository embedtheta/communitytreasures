<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>GBE TopUp</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,300,500,600,700,900,200' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Muli:400,400italic,300italic,300' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>

<script src="<?php echo base_url(); ?>js/organictabs.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>
<script type="text/javascript">
function tabFunction(tabClass,tabName){

	$(this).click(function(){ 
		$("."+tabClass).removeClass('current');
		$("#id_"+tabName).addClass("current");
		$(".div"+tabClass).hide();
		$("#"+tabName).show();
		
		
	});
}

$(document).ready(function() {
	jQuery('#mycarousel').jcarousel();
	
	
	$('#topUpAmt').on('change', function() {
	  //alert( this.value ); // or $(this).val()
	  var topAmt = $.trim($("#topUpAmt").val());
		var myBal = $.trim($("#myBal").val());
		
		var newBal = parseFloat(myBal)+parseFloat(topAmt);//(myBal+topAmt).toFixed(2);
		//alert('==='+newBal.toFixed(2));
		$('#projectBal').html(newBal.toFixed(2));
	});


});
$(function() {
    
            $(".containertab").organicTabs({
                "speed": 200
            });
});

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

<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>
<!--<div class="top">
  <div class="top-inn">
    <div class="logo fltleft hed_inr">
      <h1><a href="#">
        <div class="logo-img"> </div>
        </a></h1>
    </div>
    <div class="log_form fltright"> <span><a href="<?php echo base_url();?>gateway/logout/" style="color:#FFFFFF;">Log Out</a></span> </div>
    <div class="clear"></div>
    <div id="message_box"></div>
  </div>
</div>-->
<?php $this->load->view('header-logo');?>
<div class="wrapper">
   
  <!--<header>
   
    <div class="nav">
      <nav class="secondary">
        <ul class="misc_new">

          <?php if($accessPermission==2){?>
		  <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="javascript:void(0)" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="javascript:void(0)" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>

          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="javascript:void(0)" id="gbeLevel3"><span class="level">Level - 3</span> Diversity<span> Open </span></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="javascript:void(0)" id="gbeLevel4"><span class="level">Level - 4</span> Corporation <span> Open </span> </a></li>

          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="javascript:void(0)" id="gbeLevel5"><span class="level">Level - 5</span>Summit<span> Open </span> </a></li>

		  <?php 
		  }
		  else{ 
		  
		  ?>
          <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] > 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>

          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] > 2){ echo base_url()."diversity";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Level - 3</span> Diversity<span> Open </span></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo base_url()."corporation";}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Level - 4</span> Corporation <span> Open </span> </a></li>

          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] > 4){ echo base_url()."summit";}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Level - 5</span>Summit<span> Open </span> </a></li>

          <?php }?>
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
  </header>-->
  <?php $this->load->view('header',$result);?>
  <!--header end-->
  <div class="main_container top_up_page">
    <div class="currncy_lf">
      <div class="containertab">
        
        <div class="tab_container_top">

          
           <div  class="tab_content" >
           <!--Withdrawal Payment section-->
   <div class="white-bg">
          <div class="left_hding">
                <h3>TopUp</h3>
                <p>You Are Currently On Level - <?php echo $userInfo[0]['userLevel'];?></p>
              </div>
              <div class="clear"></div>
              <div class="table_tab withdraw-details">
              <div class="tabs mar">
                   
                  <div class="tabfull wdr">
                <div class="transec_glce wdrls"> 
                <h4> Top Up Request Details</h4>
                 <div class="currentbalnc">
                 <h3>Your current Balance: <span><?php echo $currSymbol;?> <span id="balanceChIdWith"><?php echo $balance;?></span></span></h3>
                 
                 </div><div class="clear"></div>
                  <form action="" method="post">
           
               <div class="top_selects_inr"><p>Please Select Amount: <strong><?php echo $currSymbol;?></strong></p>
			   <select name="topUpAmt" id="topUpAmt">
			   
			   <option value=""> Select One </option>
			   <?php foreach($topupAmt as $topupAmts){ ?>
			    <option value="<?php echo $topupAmts; ?>"> <?php echo $topupAmts; ?> </option>
			   <?php } ?>
			   </select> <br class="clear">
			   <p>Projected Balance: <?php echo $currSymbol;?>&nbsp;<span id="projectBal"><?php echo $balance;?></span></p></div>        
				
				<div class="btns_top_up"><input type="button" value="Submit" name="requestFortopUp" id="requestFortopUp" onclick="topAmtCheck();">
				<input type="hidden" name="myBal" id="myBal" value="<?php echo $balance;?>">	
                <p><input name="" class="cancelClass" type="button" onclick="topUpUnset();" value="Reset">
				 <?php if($accessPermission==2){?>
				<input name="" class="backClass" type="button" disabled value="Back">
				 <?php } else {?>
				 <input name="" class="backClass" type="button" onclick="backToAccount();" value="Back">
				 <?php } ?>
				 </p></div><br class="clear">
            </form>
            </div>
                  </div>
              </div>
              </div>
			  <!--<div> Coming soon </div>-->
        </div>
        <!--Withdrawal Payment section end-->
           
           </div>
          
     
           </div>
          
          
        </div>
      </div>
    </div>
    <!--<div class="rights_side currncy_rit">
  
    </div>-->
    <br class="clear">
  </div>
</div>
<script type="text/javascript">
jQuery(function ($) {
	// Load dialog on click
	$('.palvidd').click(function (e) {
            $(this).next('.basic-modal-content').modal();
            return false; 
	});
        
	$('.clickopen').click(function () {
            $(this).next().slideToggle("slow");
	});
      
	
});

var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";


/*Topup amount Check*/
function topAmtCheck(){ 
	//alert($("#topUpAmt").val()+"====="+$("input[name=paymentMethod]:checked").val());
    var topUpAmt = $.trim($("#topUpAmt").val());
   // var myBalance = $.trim($("#myBalance").val());
    //var paymethod = $.trim($("input[name=paymentMethod]:checked").val());
	var error = 0;
    if(topUpAmt == "" || topUpAmt == 0){ 
		$.fancybox.open("Please Select Topup Amount.");
        $("#topUpAmt").focus();
		error=1;
      //  return false;
    } 
	
	if(error == 0){
		$('#topAmt').val(topUpAmt);
		$.fancybox.open('<div id="payMethodDiv">'+$('#payMethodDivId').html()+'</div>');
		//$.fancybox.open($('#payMethodDiv').html());
	}
	
}
/*end  of this section*/
function topUpUnset(){
	// unset selected topup value
	$("#topUpAmt").val('');
	
	$('#projectBal').html($('#myBal').val());
}

function backToAccount(){
	 window.location.replace("<?php echo base_url(); ?>currentaccount/myAccount");
}
</script> 
<script type='text/javascript' src='<?php echo base_url(); ?>js/custom_common.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.simplemodal.js'></script>
<style>
.sm.extra-no-pad td{ 
    border:none;
}
.kk {
    display: block !important;
    float: none !important;
    height: auto;
    margin: 5px auto !important;
    width: 250px;
}
.pp{ 
    margin-left:0;
}
  </style>
  <div id="payMethodDivId" style="display:none;">
  
  <form name="paymentTopUp" action="<?php echo base_url()."gbe_payment/topUp" ?>" method="POST"><strong>Please select the payment method, you would like to use from the following?</strong> 
				<p>
                
                <input type="radio" name="paymentMethod" value="paypal" checked="checked"> <img class="ppal" src="<?php echo base_url(); ?>images/Paypal0.png" alt=""></p>
                <p>
                
                <input type="radio" name="paymentMethod" value="CreditCard" disabled> <img class="ppal" src="<?php echo base_url(); ?>images/Paypal1.png" alt=""></p>
                <p>
                
                <input type="radio" name="paymentMethod" value="DebitCard" disabled> <img class="ppal" src="<?php echo base_url(); ?>images/Paypal2.png" alt=""></p>
                <p>
                
                <input type="radio" name="paymentMethod" value="AmericanExpress" disabled> <img class="ppal" src="<?php echo base_url(); ?>images/Paypal3.png" alt=""></p>
				<input type="hidden" name="topAmt" id="topAmt" value=""><br>
				<input type="hidden" name="payCurr" id="payCurr" value="<?php echo $myCurrency;?>">
				<input type="submit" name="pay" id="pay" value="Submit"> 
				<br></form></div>
</body>
</html>
