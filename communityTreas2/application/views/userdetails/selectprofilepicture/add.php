<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Rave Business</title>
<link rel="shortcut icon" href="http://ravebusiness.com/ravebusinessImages/logo.jpg" type="image/x-icon"/>
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
function getOtherCurrValue(){
	//alert('selected =============='+$('#selCurId').val());
	var selCurId = $('#selCurId').val();
	if(selCurId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>currentaccount/viewCurrencyRate", 
			 data: "selCurId="+selCurId,
			 cache:false,
			 dataType: "json",
			 success: 
				  function(data){
				  // alert(data);  //as a debugging message					
					if(data.success == "yes")
					{	
						$("#otherCurFirst").html(data.othercurr1);
						$("#otherCurSec").html(data.othercurr2);						
								
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
}



</script>

<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<script>
$(document).ready(function(){
   /*  $(".click-tab").click(function(){ 
        $(".noti-details").toggle();
    }); */
	$(".noti-details").hide();
	//$("#p_1").show();
	$('.notification-section :first-child > h3').addClass('close');
	$('.notification-section :first-child > p').show();
    $(".click-tab").click(function(){
		var id = $(this).attr("id");
		$(".noti-details").hide();
		if($(this).hasClass('close')){
			$(".click-tab").removeClass('close');
			$(this).addClass('open');
			$("#p_"+id).hide();
		}else{
			$(".click-tab").removeClass('open');
			$(this).addClass('close');
			$("#p_"+id).show();
		}
		
    });
});
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="top">
  <div class="top-inn">
    <div class="logo fltleft hed_inr">
      <h1><a href="#">
        <div class="logo-img"> </div>
        </a></h1>
    </div>
    <div class="log_form fltright"> <span><a href="<?php echo base_url();?>gateway/logout/" style="color:#FFFFFF;">Log Out</a></span> </div>   
     <div class="log_form fltright"> <span><a href="<?php echo base_url();?>gateway/userdata/" style="color:#FFFFFF;">Welcome <?php echo trim($this->session->userdata('userName')); ?></a></span></div>
      <!-- 11/08/2015 done by ujjwal sana-->
    <div class="clear"></div>
    <div id="message_box"></div>
  </div>
</div>
<div class="wrapper">
  <header>
    <!--<div class="pulldiv"><a href="javascript:void(0)" class="pull">NAVIGATION</a></div>-->
    <div class="nav">
      <nav class="secondary">
        <ul class="misc_new">

          

          <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] > 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>

          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] > 2){ echo base_url()."source";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Level - 3</span> Diversity<span> Open </span></a></li>

          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo base_url()."regeneration";}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Level - 4</span> Corporation <span> Open </span> </a></li>

          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] > 4){ echo base_url()."franchise";}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Level - 5</span>Summit<span> Open </span> </a></li>

          
          <!--          <li class="levelClass" id="1"><a href="javascript:void(0)" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>
          <li class="levelClass" id="2"><a href="javascript:void(0)" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>
          <li class="levelClass" id="3"><a href="javascript:void(0)" id="gbeLevel3"><span class="level">Level - 3</span> The Source<span> Open </span></a></li>
          <li class="levelClass" id="4"><a href="javascript:void(0)" id="gbeLevel4"><span class="level">Level - 4</span>Regeneration<span> Open </span> </a></li>
          <li class="levelClass" id="5" style="padding-right:0;"><a href="javascript:void(0)" id="gbeLevel5"><span class="level">Level - 5</span> Franchise <span> Open </span> </a></li>-->
          
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
  </header>
  <div class="main_container">
    <div class="lefts_side currncy_lf">
    
    <!-- 13/08/2015 done by ujjwal sana-->
     <?php if($report == 1){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <?php if($report == 2){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
     <!----------------------------------------------------------------  -->
     <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Add Profile picture</h2>
            <h3 align="right">
<!--                 <a href="<?php echo base_url();?>cp/getXls/1">Get Report</a>-->
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
       
        
        <div class="table-content">
            <div class="main_section">               
                 <?php foreach($list as $pic){ ?>
                 <?php if ($pic->profile == ""){?>
                   <?php echo $pic->profile; ?>
                 <img id="empPic" style="margin-right:25px;" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg"  width="70" height="70" alt="">
                   <?php } ?>
                  
                <?php if ($pic->profile != ""){?>
                 <img id="empPic" style="margin-right:25px;" src="<?php echo $this->config->item('gbe_base_url');?>useruploads/<?php echo $pic->profile;?>"  width="70" height="70" alt="">
                   <?php } ?>
                    <?php } ?>
                    <form action="<?php echo base_url();?>dashboard/profilePicUpload" method="post" enctype="multipart/form-data">	
            	<table width="700" height="200" border="1" align="center" class="form-table">
     				<tbody><tr>
    					<!--<td>Title</td>
    					<td><input type="text" value="" name="title" id="title" class="input1"><?php echo form_error('title', '<br /><span class="form_error">', '</span>'); ?></td>-->
    				</tr>
                    <tr>
    					<td>Profile image</td>
    					<td><input type="file" onchange="readURL(this);" value="Add photo" name="user_file" class="brws">
                        <?php echo form_error('cover_img', '<br /><span class="form_error">', '</span>'); ?>
                        <div id="contact-image"><img alt="" src="" id="empPic" height="90" width="90" ></div></td>
    				</tr>
                    
    				<tr>
    					<td colspan="2"><input type="submit" name="update" value="update" class="submit-bnt" /> &nbsp;&nbsp;&nbsp;&nbsp;</td>
    				</tr>
  				</tbody></table>
                </form>
               
        </div>
       
  	</div>
  </div>
  </div>
  
 <!---   --------------------------------------------- -->
     
    </div>
    <div class="rights_side currncy_rit">
    
    </div>
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


/*withdraw amount Check*/
function withdrawAmtCheck(){
	//alert($("#withdrawAmt").val()+"====="+$("#myBalance").val());
    var withdrawAmt = $.trim($("#withdrawAmt").val());
    var myBalance = $.trim($("#myBalance").val());
    
    if(withdrawAmt == "" || withdrawAmt == 0){ 
		$.fancybox.open("Please enter withdraw Amount.");
        $("#withdrawAmt").focus();
      //  return false;
    } 
	if(parseInt(withdrawAmt) > parseInt(myBalance)){
		
        $.fancybox.open("Please Enter amount equal or less than your account balance.");
        $("#withdrawAmt").focus();
      //  return false;
    }
       // alert('XYZ');
	$.ajax({ 
			 type: "POST",
			 url:  "<?php echo base_url();?>currentaccount/withdrawRequest", 
			 data: "withdrawAmt="+withdrawAmt,
			 cache:false,
			 dataType: "json",
			 success: 
				function(data){
				   //alert('==='+data.success);  //as a debugging message					
					if(data.success == "yes")
					{	
						//alert(data.withDrawalTable);
						$.fancybox.open("Withdrawal Request send successfully.");
						var newBal = (myBalance-withdrawAmt).toFixed(2);
						$("#withdrawAmt").val('');
						$("#requestForWithdraw").addClass('deactivebtn');
						$("#requestForWithdraw").attr('disabled', true);						
						$("#rowValId").html(data.withDrawalTable);
						$("#BalanceChId").html(newBal);
						$("#balanceChIdright").html(newBal);
						$("#balanceChIdWith").html(newBal);						
								
					}
					else{
						alert('some error ');
					}
				}
				
			});
     //return true;
}
/*end  of this section*/
/*withdraw amount Check*/
function loanAmtCheck(){
	//alert($("#withdrawAmt").val()+"====="+$("#myBalance").val());
    var loanAmt = $.trim($("#loanAmt").val());  
    
    if(loanAmt == "" || loanAmt == 0){ 
		$.fancybox.open("Please enter Loan Amount.");
        $("#loanAmt").focus();
        return false;
    } else{
        return true;
    } 
}
/*end  of this section*/
function sendNotif(){
	
	
	var notTitle = $.trim($("#notTitle").val());
	var notMessage = $.trim($("#notMessage").val());
	//notMessage    
    
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
			 url:  "<?php echo base_url();?>currentaccount/notificationSend", 
			 data: "notTitle="+notTitle+"&notMessage="+notMessage,
			 cache:false,
			 dataType: "json",
			 success: 
				function(data){
				   //alert('==='+data.success);  //as a debugging message					
					if(data.success == "yes")
					{	
						//alert(data.withDrawalTable);
						$.fancybox.open("Notification send successfully.");	
						$("#notTitle").val('');								
						$("#notMessage").val('');						
																	
								
					}
					else{
						alert('some error');
					}
				}
				
			});
     return true;
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
</body>
</html>
