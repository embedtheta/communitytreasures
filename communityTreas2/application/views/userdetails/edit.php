


<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>GBE Level 3</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,300,500,600,700,900,200' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Muli:400,400italic,300italic,300' rel='stylesheet' type='text/css'>
<!--css for fancybox -->
<link rel="stylesheet" href="css/fancybox/jquery.fancybox-buttons.css">
        <link rel="stylesheet" href="css/fancybox/jquery.fancybox-thumbs.css">
        <link rel="stylesheet" href="css/fancybox/jquery.fancybox.css">        
        <link rel="stylesheet" href="demo/demo.css"><!-- DELETE -->
       <!--js for fancybox -->
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
       <script src="js/fancybox/jquery.fancybox.js"></script>
		<script src="js/fancybox/jquery.fancybox-buttons.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>
<script src="<?php echo base_url(); ?>js/organictabs.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>
 <!--script for fancybox -->
<script type="text/javascript">
			$(document).ready(function() {
			$(".fancybox").fancybox();
			});
		</script>
<!--13/08/2015 done by ujjwal sana-->

<script type="text/javascript">
function saveDetail(){
    var firstName=$("#firstName").val();
    var lastName=$("#lastName").val();
    var gender=$("#gender").val();
    var address=$("#address").val();    
    var occupation=$("#occupation").val();
    var emailID=$("#emailID").val();
    var phone=$("#phone").val();
    var zip=$("#zip").val();
	var city=$("#cityId").val();
	var country=$("#countryid").val();
	var dataString = 'firstName='+ firstName + '&lastName='+ lastName + '&gender='+ gender + '&address='+ address +'&occupation=' + occupation + '&emailID=' + emailID + '&phone=' + phone +'&zip=' +zip+ '&city='+ city + '&country=' + country;
	var reg =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(firstName.trim()=='')
	{
		alert("Please insert First Name");
			return false;
	}
	else if(lastName.trim()=='')
	{
		alert("Please insert Last Name");
			return false;
	}
	else if(!reg.test(emailID) || emailID =='')
	{
		  alert('Invalid Email Address');
            return false;
    
		
	}
	else if(phone.trim()=='')
	{
		alert("Please insert Phone no.");
			return false;
	}
	else
	{
		
		$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>gateway/profiledataupdate",
		data: dataString,
		cache: false,
		success: function(result){
			if(result==1)
			{
				$('#div1').show();
			}
			else{
				$('#div2').show();
			}
			}
		});
	}
	

   
}
</script>
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
	$('#div1').hide();
	$('#div2').hide();
	
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
       </ul>
      </nav>
      <div class="clear"></div>
    </div>
  </header>
  <div id="div1">Daata updated sucessfully</div>
   <div id="div2">Daata not updated</div>
  <div class="main_container">
    <div class="lefts_side currncy_lf">
     
      <div class="table-status"><table width="100%" border="0" cellspacing="1" cellpadding="1">
       
       <!--12/08/2015 done by ujjwal sana-->
       <h1>This is edit page</h1>
       <form id="editMenuZone" name="editMenuZone" method="post" action="" class="main_form">
       <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tbody>
     	<!--11/08/2015 done by ujjwal sana-->
           <tr><td>
             First Name:<input type="text" id="firstName" name="firstName" class="input1" value=<?php echo $list[0]->firstName;?> /><br>
             Last Name: <input type="text" id="lastName" name="lastName" value=<?php echo $list[0]->lastName;?>><br>
            Gender: <input type="text" id="gender" name="gender" value=<?php echo $list[0]->gender;?>><br>
            Address: <input type="text" id="address" name="address" value=<?php echo $list[0]->address;?>><br>
            Occupation: <input type="text" id="occupation" name="occupation" value=<?php echo $list[0]->occupation;?>><br>
             Email: <input type="text" style="width:200px" id="emailID" name="emailID"  value=<?php echo $list[0]->emailID;?>><br>
            Phone: <input type="text" maxlength="10" id="phone" name="phone" value=<?php echo $list[0]->phone;?>><br>
             Zip: <input type="text" id="zip" name="zip" value=<?php echo $list[0]->zip;?>><br>
             
            
           City: <select id="cityId" name="cityId">
             <?php foreach($citylist as $cl){ ?>
            
  				<option value="<?php echo $cl->id;?>" <?php if($cl->id==$list[0]->city){ echo 'selected="selected"'; }?> ><?php echo $cl->city;?></option>           
                <?php } ?>
			</select><br>
            
          
          
            Country: <select id="countryid" name="countryid">
             <?php foreach($countrylist as $cls){ ?>
             	
  					<option value="<?php echo $cls->country_id;?>" <?php if($cls->country_id==$list[0]->country){ echo 'selected="selected"'; }?>><?php echo $cls->name;?></option>
                     <?php } ?>
			</select>
            </td>
            <!--show profile picture -->
            
           	<?php if ($image[0]->profile == ""){?>
             <td <a class="fancybox" rel="group"  href="<?php echo base_url();?>user/profilepicture/originalprofilepicture/no_photo.jpg"><img height="60" width="60" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg" alt=""/></a></td>
            <?php } ?>
				
			
                   <td class="<?php echo $className;?>"><a class="fancybox" rel="group"  href="<?php echo base_url();?>user/profilepicture/originalprofilepicture/<?php echo $image[0]->profile;?>"><img height="60" width="60" src="<?php echo base_url();?>user/profilepicture/<?php echo $image[0]->profile;?>" alt=""/></a></td>
            </tr>
            <tr>
             <td>
            <input type="button" name="submit" id="submit" value="save" onClick="saveDetail()" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url(); ?>gateway/userdata">cancel</a></td>
             <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>gateway/add_profile_picture/<?php echo $lis->uID;?>">Change Profile picture </a></td>
        </tr>
        
         
         </tbody>
        </table>
        </form>
        
         	
         
       
        </div>
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
