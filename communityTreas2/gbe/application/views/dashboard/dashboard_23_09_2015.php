<?php if( $parentInfo[0]["paypalAC"] =="" ){
		$parentInfo[0]["paypalAC"] = "paytestevika-facilitator@gmail.com";
	  }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>GBE Level 1</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/p_color.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){	
    
        var tabId = '<?php echo $openTabId;?>';
        if(tabId != ""){
            $(".tab_content").removeClass('hide');
            $(".tab_content").addClass('hide');
            $("#"+tabId).removeClass('hide');
            $("#"+tabId).show();
            if(tabId == "tab4"){
                $(".webbox1").show();
            }else{
                $(".webbox1").hide(); 
            }
        }
        
   

<?php foreach( $userAdverts as $key=>$val){?>
	$('a#copyAdvert'+<?php echo $userAdverts[$key]["advertID"];?>).zclip({
			path:'<?php echo base_url();?>js/ZeroClipboard.swf',			
			copy:$('input#advertUrl'+<?php echo $userAdverts[$key]["advertID"];?>).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.tpbb a').css('background','#A20000');
			$('.tpbb a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
			
	});
<?php } ?>
<?php foreach( $htmlBanners as $key=>$val){?>
	$('a#bannerCopy'+<?php echo $htmlBanners[$key]["bannerID"];?>).zclip({
			path:'<?php echo base_url();?>js/ZeroClipboard.swf',			
			copy:$('input#bannerUrl'+<?php echo $htmlBanners[$key]["bannerID"];?>).val(),
			beforeCopy:function(){
			$(this).css('background','yellow');
			$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.mbr a').css('background','#A20000');
			$('.mbr a').css('color','white');
			$(this).css('background','green');
			$(this).css('color','white');
			}
	});
<?php } ?>
<?php foreach ( $userYoutube as $key=>$val){ ?>

     $('a#copyYouTube'+<?php echo $userYoutube[$key]["id"];?>).zclip({
			path:'<?php echo base_url();?>js/ZeroClipboard.swf',			
			copy:$('input#youtubeUrl'+<?php echo $userYoutube[$key]["id"];?>).val(),
			beforeCopy:function(){
			$('a#copyYouTube'+<?php echo $userYoutube[$key]["id"];?>).css('background','yellow');
				$(this).css('color','orange');
			},
			afterCopy:function(){
			$('.cbz a').css('background','#031F30');
			$('.cbz a').css('color','white');
			$('a#copyYouTube'+<?php echo $userYoutube[$key]["id"];?>).css('background','green');
				$(this).css('color','white');
				$(this).next('.check').show();
			}
	});	
	
<?php } ?>	
	/*$('a#newcopy').zclip({
	    path:'<?php echo base_url();?>js/ZeroClipboard.swf',
       copy:$('input#imagePost16').val()	
    });	*/
});	
</script>
<script src="<?php echo base_url(); ?>js/organictabs.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jcarousel.min.js"></script>
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

function siwtchOnPayment(){
	
	var balanceInCA = Number(<?php echo $balanceInCA[0]->commAmt;?>);
	if(balanceInCA < 49.99){
		$.fancybox.open('<p style="text-align:center" margin:10px 0;>You have insufficient fund in your account. Do you want to top up your account to upgrade your account.<br>Then please click on the top up button.<br><br><a href="<?php echo base_url();?>currentaccount/topUp" class="topup" >Top Up</a></p>');
	}else{
		window.location.href='<?php echo base_url();?>gbe_payment/switchOn';
		return true;
	}
}


$(document).ready(function() {
	$('#mycarousel').jcarousel();
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

function downloadVideo(video_id){
	$.fancybox.open('<img src="<?php echo base_url();?>/images/ajax-loader.gif" />');
	$.ajax({
			type: "POST",
			data: "video_id="+video_id,
			url: "<?php echo base_url();?>/dashboard/downloadVideo",
			success: function(data) {
				$.fancybox.open(data);
			}
	});
}
function valFormCountryCode(){
	if($("#country").val() == "0"){
		alert("Please select country before submission");
		return false;	
	}else{
		return true;
	}
}
</script>
<script>
 $(document).ready(function(){
	 $('.pull').click(function(){
		 $('.misc_new').slideToggle();
	 });
	 
	 // added by SB on 25/06/2015
	 $("#categoryList").change(function() {
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedCatId =$("#categoryList").val();
		if(selectedCatId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/getArticleList", 
			 data: "catId="+selectedCatId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	
						$("#articleList option").remove();
						$("#subArticleList option").remove();						
						$('#articleList').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
	 });
	 
	 // article on Change function added by SB on 26/06/2015
	 $("#articleList").change(function() {
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedArtId =$("#articleList").val();
		if(selectedArtId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/getSubArticleList", 
			 data: "subArtId="+selectedArtId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	
						$("#subArticleList option").remove();				
						$('#subArticleList').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
	 });
	 
	 
	 // added by SB on 29/06/2015
	 $("#country").change(function() {
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedCountryId =$("#country").val();
		if(selectedCountryId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/getCityList", 
			 data: "countryId="+selectedCountryId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	
						$("#city option").remove();									
						$('#city').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
	 });
	 
	 // product upload category article wise populate sub articles
	  $("#catID").change(function() {
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedCatId =$("#catID").val();
		if(selectedCatId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/getArticleList", 
			 data: "catId="+selectedCatId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	
						$("#articleID option").remove();
						$("#productTypeID option").remove();						
						$('#articleID').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
	 });
	 
	 // article on Change function added by SB on 02/07/2015
	 $("#articleID").change(function() {
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedArtId =$("#articleID").val();
		if(selectedArtId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/getSubArticleList", 
			 data: "subArtId="+selectedArtId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	
						$("#productTypeID option").remove();				
						$('#productTypeID').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
	 });
	 
	 // product edit mode onchange
	  $("#catIDEdit").change(function() {
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedCatId =$("#catIDEdit").val();
		if(selectedCatId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/getArticleList", 
			 data: "catId="+selectedCatId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	
						$("#articleIDEdit option").remove();
						$("#productTypeIDEdit option").remove();						
						$('#articleIDEdit').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
	 });
	 
	 // article on Change function added by SB on 02/07/2015
	 $("#articleIDEdit").change(function() {
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedArtId =$("#articleIDEdit").val();
		if(selectedArtId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/getSubArticleList", 
			 data: "subArtId="+selectedArtId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	
						$("#productTypeIDEdit option").remove();				
						$('#productTypeIDEdit').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
	 });	
	 
	 //on currency selection 
	 $("#productCurrencyType").change(function() {
		 var selectedCurId =$("#productCurrencyType").val();
		 var currSymbol = '';
		 if(selectedCurId=="USD"){
			 currSymbol = '($)';
		 }
		 else if(selectedCurId=="EUR"){
			 currSymbol = '(€)';
		 }
		 else{
			 currSymbol = '(£)';
		 }
		 
		 $('#showSelCurr').html(currSymbol);
		 $('#showSelCurr1').html(currSymbol);
	 });
	 
	 //on currency selection 
	 $("#productCurrencyTypeEdit").change(function() {
		 var selectedCurId =$("#productCurrencyTypeEdit").val();
		 var currSymbol = '';
		 if(selectedCurId=="USD"){
			 currSymbol = '($)';
		 }
		 else if(selectedCurId=="EUR"){
			 currSymbol = '(€)';
		 }
		 else{
			 currSymbol = '(£)';
		 }
		 
		 $('#showSelCurrEdit').html(currSymbol);
		 $('#showSelCurrEdit1').html(currSymbol);
	 });
	 
 })
 
 
 function openCityAddCityDiv(){
	 //alert('show');
	 $('#newCity').css('display','block');
	// alert($('#country').val()+'====='+$('#newVendorCity').val());
 }
 function closeNewCityDiv(){
	 $('#newVendorCity').val('');
	$('#newCity').css('display','none');
 }
 function addNewCity(){
	 //alert('show');
	// $('#newCity').css('display','none');
	 //alert($('#country').val()+'====='+$('#newVendorCity').val());
	 var selectedCountryId =$('#country').val();
	 var newCityName = $('#newVendorCity').val();
	 if(selectedCountryId>0 && newCityName!=''){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/addNewCity", 
			 data: "countryId="+selectedCountryId+"&newCityName="+newCityName,
			 cache:false,
			 dataType: "json",
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data.success == "yes")
					{	
						alert('City added Successfully');
						$('#newVendorCity').val('');
						$('#newCity').css('display','none');
						$("#city option").remove();									
						$('#city').append(data.cityList);					
					}
					else{
						alert(data.message);
					}
				  }
			  });
		}
 }
 
 function commissionStatusChange(donateVal,mode){
	 
	// alert('+++++'+donateVal+'======'+mode);
	
		if($('#'+donateVal).val()==1){
			if(mode=='add')
			{ 
				$('#productCommission').val(0);
				$('#productCommission').attr("disabled", true);
			}
			else{
				$('#productCommissionEdit').val(0);
				$('#productCommissionEdit').attr("disabled", true);
			}
		 }
		 else if($('#'+donateVal).val()==0){
			 if(mode=='add')
			{
				$('#productCommission').val('');
				$('#productCommission').attr("disabled", false);
				}
			else{
				$('#productCommissionEdit').val('');
				$('#productCommissionEdit').attr("disabled", false);
			}
		 }
	
	
	 
 }
 function priceComStatus(pageMode){
	 var productCatType;
	 if(pageMode=="add")
	 { 
		productCatType =$("#productOffer").val();
			if(productCatType==0){
				
				$('#productCurrencyType').attr("disabled", false);
				$('#productPrice').val('');
				$('#productPrice').attr("disabled", false);
				$('#productCommission').val('');
				$('#productCommission').attr("disabled", false);
			}
			if(productCatType==1){
				$('#productCommission').val(0);
				$('#productCommission').attr("disabled", true);
				$('#productCurrencyType').attr("disabled", false);
				$('#productPrice').val('');
				$('#productPrice').attr("disabled", false);
			}
			if(productCatType==2){
				$('#productCommission').val(0);
				$('#productCommission').attr("disabled", true);
				$('#productCurrencyType').attr("disabled", true);
				$('#productPrice').val('');
				$('#productPrice').attr("disabled", true);
			}
	 }
	 else if (pageMode=="edit"){
		 productCatType =$("#productOfferEdit").val();
			if(productCatType==0){
				
				$('#productCurrencyTypeEdit').attr("disabled", false);
				$('#productPriceEdit').val('');
				$('#productPriceEdit').attr("disabled", false);
				$('#productCommissionEdit').val('');
				$('#productCommissionEdit').attr("disabled", false);
			}
			if(productCatType==1){
				$('#productCommissionEdit').val(0);
				$('#productCommissionEdit').attr("disabled", true);
				$('#productCurrencyTypeEdit').attr("disabled", false);
				$('#productPriceEdit').val('');
				$('#productPriceEdit').attr("disabled", false);
			}
			if(productCatType==2){
				$('#productCommissionEdit').val(0);
				$('#productCommissionEdit').attr("disabled", true);
				$('#productCurrencyTypeEdit').attr("disabled", true);
				$('#productPriceEdit').val('');
				$('#productPriceEdit').attr("disabled", true);
			}
	 }
 }
 function typeFunctionality(pageMode){
	 var typeOfProduct;
	 if(pageMode=="add"){
		 typeOfProduct =$("#typeOfProduct").val();
		 //alert('Type Of Product===='+typeOfProduct);
		 if(typeOfProduct==1){
			$('#digitalDiv').css('display','block'); 
			$('#eventDiv').css('display','none');
		 }
		 if(typeOfProduct==2){
			$('#digitalDiv').css('display','none');
			$('#eventDiv').css('display','none');
		 }
		 if(typeOfProduct==3){
			$('#digitalDiv').css('display','none');
			$('#eventDiv').css('display','block');			
		 }
	 }
	else if(pageMode=="edit"){
		 typeOfProduct =$("#typeOfProductEdit").val();
		 //alert('Type Of Product===='+typeOfProduct);
		 if(typeOfProduct==1){
			$('#digitalDivEdit').css('display','block'); 
			$('#eventDivEdit').css('display','none');
		 }
		 if(typeOfProduct==2){
			$('#digitalDivEdit').css('display','none');
			$('#eventDivEdit').css('display','none');
		 }
		 if(typeOfProduct==3){
			$('#digitalDivEdit').css('display','none');
			$('#eventDivEdit').css('display','block');			
		 }
	 }
 }
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="top">
  <div class="top-inn">
    <div class="logo fltleft hed_inr">
      <h1><a href="<?php echo base_url();?>dashboard">
        <div class="logo-img"> </div>
        </a></h1>
    </div>
    <div class="log_form fltright"> <span><a href="<?php echo base_url();?>gateway/logout/" style="color:#FFFFFF;">Log Out</a></span> </div>
    <div class="clear"></div>
    <div id="message_box"></div>
  </div>
</div>
<div class="wrapper">
  <header>
    <div class="pulldiv"><a href="javascript:void(0)" class="pull">NAVIGATION</a></div>
    <div class="nav">
      <nav class="secondary">
        <ul class="misc_new">
          
          <li <?php if($userInfo[0]['userLevel'] < 1){?> class="levelClass" <?php }?> id="1"><a href="<?php if($userInfo[0]['userLevel'] > 0){ echo base_url()."dashboard";}else{?>javascript:void(0)<?php }?>" id="gbeLevel1"><span class="level">Level - 1</span> Afrowebb<span>Open</span></a></li>
          <li <?php if($userInfo[0]['userLevel'] < 2){?> class="levelClass" <?php }?> id="2"><a href="<?php if($userInfo[0]['userLevel'] > 1){ echo base_url()."fullmembers";}else{?>javascript:void(0)<?php }?>" id="gbeLevel2"><span class="level">Level - 2</span> Full Members<span> Open </span></a> </li>
          <li <?php if($userInfo[0]['userLevel'] < 3){?> class="levelClass" <?php }?> id="3"><a href="<?php if($userInfo[0]['userLevel'] > 2){ echo base_url()."diversity";}else{?>javascript:void(0)<?php }?>" id="gbeLevel3"><span class="level">Level - 3</span> Diversity<span> Open </span></a></li>
          <li <?php if($userInfo[0]['userLevel'] < 4){?> class="levelClass" <?php }?> id="4"><a href="<?php if($userInfo[0]['userLevel'] > 3){ echo base_url()."corporation";}else{?>javascript:void(0)<?php }?>" id="gbeLevel4"><span class="level">Level - 4</span> Corporation <span> Open </span> </a></li>
          <li <?php if($userInfo[0]['userLevel'] < 5){?> class="levelClass" <?php }?> id="5" style="padding-right:0;"><a href="<?php if($userInfo[0]['userLevel'] > 4){ echo base_url()."summit";}else{?>javascript:void(0)<?php }?>" id="gbeLevel5"><span class="level">Level - 5</span>Summit<span> Open </span> </a></li>
          
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
  <!--header end-->
  
  <div class="main_container">
    <div class="lefts_side">
      <div class="tabsectionstep">
        <div class="containertab">
            <ul class="tabs">
                <li><a href="#tab1" <?php if($openTabId == "" || $openTabId == "tab1"):?>class="current"<?php endif; ?>>Step1</a></li>
                <li><a href="#tab2" <?php if($openTabId == "tab2"):?>class="current"<?php endif; ?>>Step2</a></li>
                <li><a href="#tab3" <?php if($openTabId == "tab3"):?>class="current"<?php endif; ?>>Step3</a></li>
                <li><a href="#tab4" <?php if($openTabId == "tab4"):?>class="current"<?php endif; ?>>Product Upload</a></li>
            </ul>
          <div class="tab_container">
		  <?php if($tabhide!=1){?>
            <div id="tab1" class="tab_content ">
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[1][1]["content_title"];?></span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[1][1]["content_image"];?>" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[1][1]["path"];?>" allowfullscreen=""></iframe>
                  </div>
                </div>
                <h3 class="headign-left"> <?php echo $stepWiseVideo[1][1]["content"];?></h3>
                <h3 class="heading-right"><img border="0" alt="" src="<?php echo base_url();?>images/rarrow.png"></h3>
                <br class="clear">
                <div class="ab_inner gresd"><strong><?php //echo $stepWiseVideo[1]["AA"]["serial_field"];?> </strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["AA"]["title"];?></h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="<?php echo $stepWiseVideo[1]["AA"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
                <div class="white-space mreetng"> <img class="nobor kk" width="422" height="180" alt="" src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[1]["AA"]["content_image"];?>" style=" display:block; margin:auto;"  /> <h3>Think<br>Big</h3></div>
                
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["A"]["serial_field"];?> </strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["A"]["title"];?></h3>
                  <span><a class="watch-video-tut" id="tutorial-videoS1" name="<?php echo $stepWiseVideo[1]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
                <div class="white-space pp"> <img class="nobor kk" width="422" height="180" alt="" src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[1]["A"]["content_image"];?>" style=" display:block; margin:auto;"  /> </div>
                <div class="ab_inner "><strong><?php echo $stepWiseVideo[1]["B"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[1]["B"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["B"]["path"];?>" id="tutorial-videoS2" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space pp"> <img class="nobor kk" style=" display:block; margin:auto;" width="250" height="157" alt="" src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[1]["B"]["content_image"];?>"  /> </div>
                
                <!--end white-space-->
                
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["C"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[1]["C"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["C"]["path"];?>" id="tutorial-videoS3" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space"> 
                  <!--<div class="your-pic"><img class="nobor" width="93" height="89" alt="" src="<?php echo base_url(); ?>images/TenPaypal.png" style="float:right;cursor:pointer; " onclick="window.location.href='<?php echo base_url();?>paypalTenDollarPayment/parallelpayment.php?parentPaypalID=<?php echo $parentInfo[0]["paypalAC"];?>&uid=<?php echo $this->session->userdata('userId');?>'" >
                    <p style="width:300px; margin-top: 35px; float:left">-Click On Paypal button to pay $25</p>
                  </div>-->
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
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["D"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[1]["D"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["D"]["path"];?>" id="tutorial-videoS4" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <div class="your-pic"> <img id="empPic" style="margin-right:25px;" src="<?php echo base_url(); ?>useruploads/<?php echo $userInfo[0]["profile"];?>" width="70" height="70" alt="">
                    <p><?php echo $stepWiseVideo[1]["D"]["content"];?></p>
                    <form enctype="multipart/form-data" action="<?php echo base_url();?>dashboard/profilePicUpload" method="post" class="rday">
                      <label style="display: block; clear: both;">
                      <input type="file" onchange="readURL(this);" name="user_file" id="file">
                      <input type="submit" class="extra-blue-btn"  name="user_file_submit" value="user_file_submit" >
                      <div class="clear"></div>
                      </label>
                    </form>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["E"]["serial_field"];?></strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["E"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["E"]["path"];?>" id="tutorial-videoS5" href="javascript:void(0)">Watch Video</a></span></div>
                <?php
            //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            $viewArray = array("PAYING USER","ADMIN");
            if(in_array($this->session->userdata('userType'), $viewArray)){
                unset($viewArray);
        ?>
                <div class="white-space">
                  <p style="margin-bottom: 30px;"><?php echo $stepWiseVideo[1]["E"]["content"];?></p>
                  <form action="<?php echo base_url();?>dashboard/userPaypalUpdate" method="post" name="form1" id="form1">
                    <label><a target="_blank" href="https://www.paypal.com/"><img class="nobor" src="<?php echo base_url(); ?>images/paypal.png" width="116" height="30" alt=""></a></label>
                    <label>
                      <input type="text" name="user_paypal_name" value="<?php echo $userInfo[0]["paypalAC"];?>" >
                      <input type="submit" value="user_paypal_submit" class="extra-blue-btn"  name="user_paypal_submit">
                    </label>
                    <div class="clear"></div>
                  </form>
                </div>
                <?php }?>
                
                
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["F"]["serial_field"];?></strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["F"]["title"];?></h3>
                  <span id="passCh"><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["F"]["path"];?>" id="tutorial-videoS5" href="javascript:void(0)">Watch Video</a></span>
                </div>
                <div class="white-space change_pass">
                  <div class="pink-area">
                      <div class="upl_form">
                        <form method="post" name="changePassword" id="changePasswordId" action="<?php echo base_url();?>dashboard/changePassword">
                        
                            <p>
                                <label>Old Password :</label>
                                <input type="password" name="oldpassword" id="oldpassword">
                            </p>
                            <p>
                                <label>Password :</label>
                                <input type="password" name="password" id="password">
                                
                            </p>
                            <p>
                                <label>Confirm Password :</label>
                                <input type="password" name="cpassword" id="cpassword">
                                <input type="hidden" name="pppp" id="pppp" value="<?php echo $userInfo[0]['password'];?>">
                            </p>
                            <p>
                                <input type="submit" value="update" name="passwordUpdate" id="passwordUpdate" onclick="return passwordCheck();"> 
                            </p>
                      </form>
                    </div>
                  </div>
                </div>
                
                
                 <br class="clear">
                <div class="ab_inner"><strong>G</strong>
                  <h3 class="d_hdr">Move To The Next Step</h3>
                  <span id="passCh"><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["F"]["path"];?>" id="tutorial-videoS5" href="javascript:void(0)">Watch Video</a></span>
                </div>
               <br class="clear"> <p align="right"><a id="step3" href="javascript:void(0)" rel="tab3" onclick="showThirdTab()" class="anchortxt">Move To Step 3 &amp; 'Switch On'&gt;</a></p>
                
                
                
                <?php $ccc = 0; if($ccc == 1){?>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["F"]["serial_field"];?></strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["F"]["title"];?></h3>
                  <span><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["F"]["path"];?>" id="tutorial-videoS5" href="javascript:void(0)">Watch Video</a></span>
                </div>
                <div class="white-space">
                  <div class="pink-area">
                    <form onsubmit="return valFormCountryCode()" action="<?php echo base_url();?>dashboard/userCountryUpdate" method="post" name="formCountryCode" id="formCountryCode">
                      <select id="country" name="country">
                        <option value="">Select Country </option>
                        <?php if(count($countryList) > 0){ 
                            foreach($countryList as $cl){
                                ?>
                        <option value="<?php echo $cl->country_id;?>" <?php if($cl->country_id == $userInfo[0]["country"]){?> selected="selected" <?php }?>><?php echo $cl->name;?></option>
                        <?php }}?>
                      </select>
                      <input type="submit" value="Submit" class="extra-blue-btn extra-freebies" name="freebies_submit" style="float: right;">
                    </form>
                  </div>
                </div>
                <?php }?>
                <br class="clear">
              </div>
            </div>
            <!--1tab end......... -->
            
            <div id="tab2" class="tab_content hide">
              <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
            ?>
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[2][1]["content_title"];?></span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[2][1]["content_image"];?>" width="573" height="320" /> </div>
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[2][1]["path"];?>" allowfullscreen=""></iframe>
                  </div>
                </div>
                
                <div class="tab2-text">
                  <h1><?php echo $stepWiseVideo[2][1]["content"];?></h1>
                  <!-- <h2>PROMOTE</h2>--> 
                </div>
                <div class="ab_inner clearfix"><strong><?php echo $stepWiseVideo[2]["A"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["A"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["A"]["path"];?>" id="tutorial-video5" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[2]["A"]["content_title"];?></h3>
                  <p><?php echo $stepWiseVideo[2][1]["content"];?></p>
                  <div id="cont" style="display:none;">Lorem ipsum </div>
                  <div class="website-icon"> <a href="<?php echo $url['gmail'];?>" style="font-size:25px;font-weight:bold;"><img class="nobor" src="<?php echo base_url(); ?>images/gmail.png" width="95" height="70" alt=""></a> <a href="<?php echo $url['yahoo'];?>"><img class="nobor" src="<?php echo base_url(); ?>images/yahoo.png" width="114" height="70" alt=""></a> </div>
                </div>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["B"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["B"]["title"];?></h3>
                  <a href="javascript:void(0)" name="<?php echo $stepWiseVideo[2]["B"]["path"];?>" id="tutorial-video6" class="watch-video-tut1">Watch Video</a></div>
                <div class="white-space">
                
                  <div class="clickopen"> <?php echo $stepWiseVideo[2]["B"]["content_title"];?> </div>
                  <div class="clk_pr_inv">
                <ul>
<li><a href="#">Invite > House music Djs. Producers & Labels To This Page.</a></li>
<li><a href="#">Invite > Rappers. Scratdw Djs. Producers. I-lip-hop artists & Labels here.</a></li>
<li><a href="#">Invite > Bands. Guitarists. Drummers. Bassists. Rock Producers</a></li>
<li><a href="#">Invite > Deep House Djs. Singers, Producers, Labels</a></li>
<li><a href="#">Invite > line Singers. Producers, Rna Djs. Labels on this page</a></li>
<li><a href="#">Invite > Techno D15. Producers. Labeis. Singers</a></li>
<li><a href="#">Invite > Singers. Afrobeat Producers. Labels</a></li>
<li><a href="#">Invite > Reggae Bands. Singers. labels. MCS. Producers</a></li>
<li><a href="#">Invlte > Dubstep Djs. Producers. Mcs</a></li>
<li><a href="#">Invite > Dns I jungie Producers. Mcs. Singers</a></li>
<li><a href="#">Invite > UK Garage Producers. Singers. Mcs</a></li>
</ul>
</div>
                  <div class="togclk" style=" display:none;"> 
                    <?php 
                    if(count($step2Url) > 0):
                        foreach ($step2Url as $s2e):
                    ?>
                      <a href="<?php echo $s2e->url;?>"><?php echo $s2e->title;?></a> 
                    <?php 
                        endforeach;  
                    endif;
                    ?>
                      </div>
                </div>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["C"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["C"]["title"];?></h3>
                  <a href="javascript:void(0)" name="<?php echo $stepWiseVideo[2]["C"]["path"];?>" id="tutorial-video6" class="watch-video-tut1">Watch Video</a></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[2]["C"]["content_title"];?></h3>
                  <p><?php echo $stepWiseVideo[2]["C"]["content"];?></p>
                  <div class="ved">
                    <ul id="mycarousel" class="jcarousel-skin-tango">
                      <?php foreach ( $userYoutube as $key=>$val){
						  $arr     = explode("embed/",$userYoutube[$key]["youtubeUrl"]);
						  $title   = urlencode($userYoutube[$key]["youtubeName"]);
						  $url     = urlencode("https://www.youtube.com/watch?v=".$arr[1]);
						  $summary = urlencode(base_url());
						  $image   = urlencode("http://img.youtube.com/vi/$video_id/0.jpg");
				     ?>
                      <li>
                        <iframe width="138" height="103" frameborder="0" allowfullscreen="" src="http://www.youtube.com/embed/<?php echo $arr[1];?>"></iframe>
                        <h5><?php echo $userYoutube[$key]["youtubeName"];?></h5>
                        <input type="hidden" name="youtubeUrl<?php echo $userYoutube[$key]["id"];?>" id="youtubeUrl<?php echo $userYoutube[$key]["id"];?>" value="<iframe width='138' height='103' frameborder='0' allowfullscreen='' src='http://www.youtube.com/embed/<?php echo $arr[1];?>'></iframe>" />
                        <div class="cbz" style="cursor:pointer; background: #031F30; cursor: pointer; line-height:22px; margin-bottom: 5px; width: 138px; position:relative;"><a href="javascript:void(0)" id="copyYouTube<?php echo $userYoutube[$key]["id"];?>">Copy URL</a></div>
                        <a class="share-btn" href="javascript:void(0)">Share</a> <a class="download-btn" href="javascript:void(0)" onclick="downloadVideo('<?php echo $arr[1];?>')">Download</a>
                        <div class="share-popup" id="shareZone1" style="background-color:#fff; display:none">
                          <ul id="logoZone">
                              <li><a href="javascript:void(0)" id="button" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=550,height=400');" target="_parent"><img src="<?php echo base_url();?>images/facebook.png" border="0" /></a></li>
                            <li><a href="javascript:void(0)" onclick="window.open('http://twitter.com/share?text=<?php echo $title; ?>&url=<?php echo $url; ?>', 'child', 'scrollbars,width=650,height=600'); return false"><img src="<?php echo base_url();?>images/twitter.png" border="0" /></a></li>
                            <li><a href="javascript:void(0)" onclick="window.open('https://plus.google.com/share?url=<?php echo $url; ?>&title=<?php echo $title;?>&caption=<?php echo $title;?>&description=<?php echo $summary;?>', 'child', 'scrollbars,width=650,height=600'); return false"><img src="<?php echo base_url();?>images/google_plus.png" border="0" /></a></li>
                          </ul>
                        </div>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["D"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["D"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["D"]["path"];?>" id="tutorial-video7" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head"><?php echo $stepWiseVideo[2]["D"]["content_title"];?></h3>
                      <p><?php echo $stepWiseVideo[2]["D"]["content"];?></p>
                    </div>
                    <div class="share-pic"> <img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["D"]["content_image"];?>"> </div>
                  </div>
                  <div class="clear"></div>
                </div>
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["E"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["E"]["title"];?> </h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["E"]["path"];?>" id="tutorial-video8" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head"><?php echo $stepWiseVideo[2]["E"]["content_title"];?></h3>
                      <p><?php echo $stepWiseVideo[2]["E"]["content"];?></p>
                    </div>
                    <div class="share-pic"><img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["E"]["content_image"];?>"></div>
                    <div class="clear"></div>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["F"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["F"]["title"];?> </h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["F"]["path"];?>" id="tutorial-video20" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[2]["F"]["content_title"];?></h3>
                  <p><?php echo $stepWiseVideo[2]["E"]["content"];?></p>
                  <ul class="twitter_user">
                    <?php foreach ( $userAdverts as $key=>$val){?>
                    <li>
                      <div><a href="#"> <img width="103" height="76" src="<?php echo base_url();?>adminuploads/advert/<?php echo $userAdverts[$key]["advertImg"]?>"></a> </div>
                      <div class="tpbb"><a id="copyAdvert<?php echo $userAdverts[$key]["advertID"]?>" href="javascript:void(0)" class="">Copy</a></div>
                      <div class="tptt"><a href="<?php echo base_url();?>dashboard/downloadAdverts/?img=<?php echo $userAdverts[$key]["advertImg"]?>">Download</a></div>
                      <input type="hidden" value="<?php echo base_url();?>adminuploads/advert/<?php echo $userAdverts[$key]["advertImg"]?>" name="advertUrl<?php echo $userAdverts[$key]["advertID"]?>" id="advertUrl<?php echo $userAdverts[$key]["advertID"]?>">
                    </li>
                    <?php } ?>
                  </ul>
                </div>
                <!--<div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head">Use Photos of Your Weekend To Boost Your Rave Business</h3>
                      <p><strong>When</strong> you Upload fun pictures to facebook, Instagram, Twitter and other social networks, add a message and link to your sign up page. Do the same thing again but the time use the url link to your Rave Story website.</p>
                    </div>
                    <div class="share-pic"><img src="<?php echo base_url(); ?>images/E3.jpg"></div>
                    <div class="clear"></div>
                  </div>
                </div>--> 
                <br class="clear">
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["G"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["G"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["G"]["path"];?>" id="tutorial-video18" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head"><?php echo $stepWiseVideo[2]["G"]["content_title"];?></h3>
                      <p><?php echo $stepWiseVideo[2]["G"]["content"];?></p>
                      <h3 id="dwn-pdf"><a target="_blank" href="<?php echo base_url();?>dashboard/downloadAdverts/?img=ravestorysociety-chapter1.pdf">Click to Download PDF</a></h3>
                    </div>
                    <div class="share-pic"> <a target="_blank" href="#"><img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["G"]["content_image"];?>"></a> </div>
                    <div class="clear"></div>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["H"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["H"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["H"]["path"];?>" id="tutorial-video10" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head"><?php echo $stepWiseVideo[2]["H"]["content_title"];?></h3>
                      <p><?php echo $stepWiseVideo[2]["H"]["content"];?></p>
                    </div>
                    <div class="share-pic"> <img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["H"]["content_image"];?>"> </div>
                    <div class="clear"></div>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["I"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["I"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["I"]["path"];?>" id="tutorial-video11" href="javascript:void(0)">Watch Video</a></div>
                <div class="white-space">
                  <div class="extra-share">
                    <div class="share-text">
                      <h3 class="new_head"><?php echo $stepWiseVideo[2]["I"]["content_title"];?></h3>
                      <p><?php echo $stepWiseVideo[2]["I"]["content"];?></p>
                    </div>
                    <div class="share-pic"><img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["I"]["content_image"];?>"></div>
                    <div class="clear"></div>
                  </div>
                </div>
                <br class="clear">
                <div class="ab_inner dub"><strong><?php echo $stepWiseVideo[2]["J"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["J"]["title"];?></h3>
                  <a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["J"]["path"];?>" id="tutorial-video12" href="javascript:void(0)">Watch Video</a></div>
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["K"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["K"]["title"];?></h3>
                  <span><a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["K"]["path"];?>" id="tutorial-video13" href="javascript:void(0)">Watch Video</a></span></div>
                <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[2]["K"]["content_title"];?></h3>
                  <p><?php echo $stepWiseVideo[2]["K"]["content"];?></p>
                  <ul class="presta_shop">
                    <?php foreach( $htmlBanners as $key=>$val){?>
                    <li>
                      <div><a href="#"><img src="<?php echo base_url();?>adminuploads/banner/<?php echo $htmlBanners[$key]["bannerImg"];?>"></a></div>
                      <div class="mbr" ><a href="javascript:void(0)" id="bannerCopy<?php echo $htmlBanners[$key]["bannerID"];?>" >Copy</a></div>
                      <input type="hidden" name="bannerUrl<?php echo $htmlBanners[$key]["bannerID"];?>" id="bannerUrl<?php echo $htmlBanners[$key]["bannerID"];?>" value="<?php echo base_url();?>adminuploads/banner/<?php echo $htmlBanners[$key]["bannerImg"];?>"/>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
                <br class="clear">
                <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["L"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[2]["L"]["title"];?></h3>
                  <span><a class="watch-video-tut1" name="<?php echo $stepWiseVideo[2]["L"]["path"];?>" id="tutorial-video19" href="javascript:void(0)">Watch Video</a></span></div>
                <br class="clear">
                <p align="right"><a class="anchortxt" onclick="showThirdTab()" rel="tab3" href="javascript:void(0)" id="step3">Move To Step 3 &amp; 'Switch On'&gt;</a></p>
              </div>
              <?php } else { ?>
              <div class="white-bg">
                <div class="tab2-text"> 
                  <!--                  <h1>Buy Your Afrowebb Catalogue to Open Step -2</h1>-->
                  <div class="step02">
                    <h2> &#8249;&#8249;&#8249;&#8249; <a href="<?php echo base_url();?>dashboard/">Go Back To Step 1</a></h2>
                    <h4>Watch The Videos & Follow The Instructions</h4>
                    <h1>Get Your <br>
                      Afrowebb Catalogue</h1>
                    <h3>Then Complete Step 1</h3>
                    <h5>Once You Have Completed All The Instructions <br>
                      You Gain Access To The Second Step</h5>
                    <h6> &#8249; <a href="<?php echo base_url();?>dashboard/">Click Here To Go Back & Complete Step 1</a> </h6>
                  </div>
                </div>
              </div>
              <?php }?>
              <!--white-bg......... --> 
            </div>
            <!--2tab end......... -->
            
            <div id="tab3" class="tab_content hide">
              <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
            ?>
              <div class="white-bg">
                <div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <div class="palvidd" style="width:556px; height:320px;"> <img src="http://i1.ytimg.com/vi/yrS-kiwZK8s/hqdefault.jpg" width="573" height="320" /> </div>
                  
                  <!-- <iframe id="palvidd" width="573" height="320" frameborder="0" src="http://www.youtube.com/embed/-EkL81gUe_A" allowfullscreen=""></iframe>-->
                  
                  <div class="basic-modal-content">
                    <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[3][1]["path"];?>" allowfullscreen=""></iframe>
                  </div>
                </div>
                
                <!--<div class="yvideo extra-pad"> <span class="watch-thisvideo">Watch This Video</span>
                  <iframe width="573" height="320" frameborder="0" allowfullscreen="" src="http://www.youtube.com/embed/yrS-kiwZK8s"></iframe>
                </div>-->
                <h3 class="headign-left" style="text-align:center; width:auto; float:none;">Congratulations <br />
                  You Are Now Welcome To Become </h3>
                <h3 class="heading-right" style="text-align:center; width:auto; float:none; margin-top:0px !important;">A FULL MEMBER </h3>
                <h3 class="headign-left" style="text-align:center; width:auto; float:none;">Click Switch On To Pay & Enter Members Area </h3>
                <div class="clear"></div>
                <div class="extrapara">
                  <h3>Inside You Can Enjoy</h3>
                  <ul class="list_extra">
                    <li>Powerful Marketing Tools To explode your Rave Business</li>
                    <li>Gifts, VIP &amp; Discounts to events</li>
                    <li>Personal Marketing suite.</li>
                  </ul>
                </div>
                <?php if($userInfo[0]['switchOnPayment'] != '1'){?>
                <div class="stop_ylw"><img src="<?php echo base_url(); ?>images/submit-paypal.jpg" width="424" height="81" alt="" style="cursor:pointer" onclick="siwtchOnPayment();">
                </div>
                <?php }else{?>
                <p>You are upgraded for the next Level.</p>
                <?php }?>
                 <br class="clear">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
              </div>
              <?php } else { ?>
              <div class="white-bg">
                <div class="tab2-text"> 
                  <!-- <h1>Buy Your Afrowebb Catalogue to Open Step -3</h1>-->
                  <div class="step02">
                    <h2> &#8249;&#8249;&#8249;&#8249; <a href="<?php echo base_url();?>dashboard/">Go Back To Step 1</a></h2>
                    <h4>Watch The Videos & Follow The Instructions</h4>
                    <h1>Get Your <br>
                      Afrowebb Catalogue</h1>
                    <h3>Then Complete Step 1</h3>
                    <h5>Once You Have Completed All The Instructions <br>
                      You Gain Access To The Second Step</h5>
                    <h6> &#8249; <a href="<?php echo base_url();?>dashboard/">Click Here To Go Back & Complete Step 1</a> </h6>
                  </div>
                </div>
              </div>
              <?php } ?>
              <!--white-bg......... --> 
            </div>
            <!--3tab end......... --> 
		  <?php } else {?>
		  <div id="tab1" class="tab_content "></div>
		  <div id="tab2" class="tab_content hide"></div>
		  <div id="tab3" class="tab_content hide"></div>
		  <?php } ?>
            <!--4tab Start......... -->
            <div id="tab4" class="tab_content hide">
              <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
            ?>
              <div class="white-bg prod_uplod"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[4][1]["content_title"];?><strong><?php echo $stepWiseVideo[4][1]["content"];?></strong></span>
                <div class="ab_inner clearfix"><strong><?php echo $stepWiseVideo[4]["A"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[4]["A"]["title"];?></h3>
                  <a href="javascript:void(0)" id="tutorial-video-v-add" class="watch-video-tut1" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>">Watch Video</a></div>
                <div class="upl_form">
                    <form id="prd_upld" method="post" name="vendorFormAdd" action="<?php echo base_url();?>dashboard/addVendors">
                    <p>
                      <label>Sellers Name</label>
                      <input type="text" name="vendorName" id="vendorName">
                    </p>
                    <p>
                      <label>Sellers Contact No.</label>
                      <input type="tel" name="vendorNo" id="vendorNo">
                    </p>
                    <p>
                      <label>Sellers Address</label>
                      <textarea name="vendorAddr" id="vendorAddr"></textarea>
                    </p>
                    <p>
                      <label>Country</label>
                      <select id="country" name="vendorCountry">
                        <option value="">Select Country </option>
                        <?php if(count($countryList) > 0){ 
                            foreach($countryList as $cl){
                                ?>
                        <option value="<?php echo $cl->country_id;?>"><?php echo $cl->name;?></option>
                        <?php }}?>
                      </select>
                    </p>
                    <p>
                      <label>City</label>
                      <select id="city" name="vendorCity">
                        <!--<option value="">Select City </option>-->
                        <?php /* if(count($cityList) > 0){ 
                            foreach($cityList as $cl){
                                ?>
                        <option value="<?php echo $cl->id;?>" ><?php echo $cl->city;?></option>
                        <?php }} */?>
                      </select> <span class="addcityclass" ><a href="javascript:void(0)" onClick="openCityAddCityDiv();"><em>Add Your City To The List. - Click here</em> </a></span>
					  <div id="newCity" style="display:none;"><input type="text" name="newVendorCity" id="newVendorCity" placeholder="Add your City"> <div class="ad" onClick="addNewCity()"> Add</div><div class="can" onClick="closeNewCityDiv()">Cancel</div></div> 
                    </p>
                    <p>
                      <label>Post/Zip Codes</label>
                      <input type="text" name="vendorZip" id="vendorZip">
                    </p>
                    
                    <p>
                      <label>Sellers Email</label>
                      <input type="email" name="vendorEmail" id="vendorEmail">
                    </p>
                    <p>
                      <label>Sellers Website</label>
                      <input type="text" name="vendorWebsite" id="vendorWebsite">
                    </p>
                    <p>
                        <input type="submit" value="Save" name="addVendors" id="addVendors"> 
                    </p>
                  </form>
                </div>
                <div class="ab_inner clearfix"><strong><?php echo $stepWiseVideo[4]["B"]["serial_field"];?></strong>
                  <h3><?php echo $stepWiseVideo[4]["B"]["title"];?></h3>
                  <a href="javascript:void(0)" id="tutorial-video-p-add" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>" class="watch-video-tut1">Watch Video</a></div>
                <div class="upl_form_sec">
                    <form id="prd_upld_sec" action="<?php echo base_url();?>dashboard/addProduct" method="post" enctype="multipart/form-data">
                    <p>
                      <label>Vendors Name</label>
                      <select name="vendorID" id="vendorID">
                            <option value="">Please Select One</option>
                            <?php if(count($vendorsList) > 0){ foreach($vendorsList as $vl){?>
                            <option value="<?php echo $vl->vendorsID;?>" <?php if($vl->vendorsID == $addedVendorId){?> selected="selected"<?php }?>><?php echo $vl->vendorName;?></option>
                            <?php } }?>
                      </select>
                    </p>
					<p>
                      <label>Category</label>
                      <select name="catID" id="catID">
                            <option value="">Please Select Category</option>                            
							<?php if(count($categoryList) > 0){ 
								foreach($categoryList as $catL){
								//echo '++'.$catL->menuID."==".$catL->menuName;
								?>
								<option value="<?php echo $catL['menuID'];?>" ><?php echo $catL['menuName'];?></option>
							<?php }}?>
							
                      </select>
                    </p>
					<p>
                      <label><!--Articles-->Sub Category</label>
                      <select name="articleID" id="articleID">
                      <option value="">Please Select One</option>                           
                      </select>
                    </p>
                    <p>
                      <label><!--Selling Category-->2nd Sub Category</label>
                     <select name="productTypeID" id="productTypeID">
                            <option value="">Please Select One</option>
                        <?php if(count($productCategoryList) > 0){ foreach($productCategoryList as $pcl){?>
                        <option value="<?php echo $pcl->productTypeID;?>"><?php echo $pcl->productTypeName;?></option>
                        <?php } }?>
                      </select>
                    </p>
                    <p>
                      <label>Product Name</label>
                      <input type="text" name="productName" id="productName">
                    </p>
                    <p>
                      <label><!--Product Category-->This Item is for:</label>
                      <select name="productOffer" id="productOffer" onClick="priceComStatus('add');">
                          <option value="0">Selling</option>
                          <option value="2">Free</option>
						  <option value="1">Collection Donate</option>
                      </select>
                    </p>
                    <p>
                      <label>Product Description</label>
                      <textarea name="productDesc" id="productDesc"></textarea>
                    </p>
                    <p>
                      <label>Selling Currency</label>
                      <select name="productCurrencyType" id="productCurrencyType">
                          <option value="USD">USD Dollar</option>
                          <option value="EUR">Euro</option>
                          <option value="GBP">Pound</option>
                      </select>
                    </p>
                    <p>
                      <label><!--Enter Product Price-->Price I want Per Item<span id="showSelCurr">($)</span></label>
                      <input type="float" name="productPrice" id="productPrice">
                    </p>
                    
                     <p>
                      <label><!--Offering commission to GBE members-->Amount I'm Offering GBE Members As Commission<span id="showSelCurr1">($)</span></label>
                      <input type="text" name="productCommission" id="productCommission">
                    </p>
                    
                    <div class="col_qnt">
  <div class="color_sec">
      <div class="col_tpps">
                      <label>Color Product</label>
                      <p> <input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_1" class="colorRadio">
                          <strong>Yes</strong></p>
                      <p><input type="radio" name="RadioGroup1" checked="checked" value="0" id="RadioGroup1_0" class="colorRadio"> 
              <strong>No</strong></p>
                    </div>
   
      
      <div class="col_in" id="cq_1" style="display: none;">
      <?php if(count($colorList) > 0):?>
            <?php  foreach ($colorList as $cList):?>
          <p class="col_col" id="<?php echo $cList->id;?>">
              <span id="lblId_<?php echo $cList->id;?>"></span>
              <label style="background:<?php echo $cList->colorCode;?>;" ></label>
                <input type="hidden" name="color[<?php echo $cList->id;?>]" value="0" id="colorId_<?php echo $cList->id;?>">
                <input type="text" name="q[<?php echo $cList->id;?>]" value="" id="<?php echo $cList->id;?>" class="qClass">
            </p>
                  <?php endforeach;?>
      <?php endif;?>
    </div>
  </div>
</div>   
                    <p id="offQuantity">
                      <label>Quantity </label>
                      <input type="text" name="productQuantity" id="productQuantity">
                    </p>
					<!--<div class="donate_rd col_tpps" style="overflow: hidden;">
                      <label>Donate</label>
                      <p>
                          <input type="radio" name="productDonate" onClick="commissionStatusChange('productDonate_1','add');" value="1" id="productDonate_1" >
                        <strong>Yes</strong></p>
                      <p>
                        <input type="radio" name="productDonate" onClick="commissionStatusChange('productDonate_0','add');" value="0"  checked="checked" id="productDonate_0" >
                       <strong>No</strong></p>
                    </div>-->
                   
                    <p>
                      <label>Product You tube video</label>
                      <input type="text" name="productYoutubeUrl" id="productYoutubeUrl">
                    </p>
                    <p>
                      <label><!--Product Type-->Type of Product</label>
                      <select name="typeOfProduct" id="typeOfProduct" onClick="typeFunctionality('add');" >
					      <option value="1">Digital Upload Product</option>
                          <option value="2">Physical Sendable Product</option>
						  <option value="3">Event Ticket</option>
                      </select>
                    </p>
					<div id="digitalDiv">
                    <p>
                      <label>Upload your Digital product Mp3 / Film / PDF – 20MB</label>
                      <input type="file" name="productMusic" id="productMusic">
                    </p>
					</div>
					<div id="eventDiv" style="display:none;">
					<p>
                      <label>Upload Pdf File</label>
                      <input type="file" name="productEventPdf" id="productEventPdf">
                    </p>
					<p>
                      <label>End Date</label>
                      <input class="form-control datepicker" placeholder="Select date" type="text" name="productEventEndDate" id="productEventEndDate">
                    </p>
					</div>
                    <p>
                      <label>Upload the Main Image of your Product</label>
                      <input type="file" name="img_1" id="mainImageId">
                    </p>
                    <p>
                      <label>Upload the Secondary Image of your product</label>
                      <input type="file" name="img_2">
                    </p>
                    <p>
                      <label>Upload the Third Image of your product</label>
                      <input type="file" name="img_3">
                    </p>
                    <p>
                      <label>Upload the Fourth Image of your product</label>
                      <input type="file" name="img_4">
                    </p>
                    <div class="status_rd">
                      <label>Status</label>
                      <p>
                          <input type="radio" name="productStatus" value="1" checked="checked" id="productStatus_1">
                        Active</p>
                      <p>
                        <input type="radio" name="productStatus" value="0" id="productStatus_0">
                        Inactive</p>
                    </div>
                    <div class="clear"></div>
                    <p>
                        <input type="submit" value="Save" id="pUploadButton" name="pUploadButton">
                    </p>
                  </form>
                </div>
                  
                  <div class="ab_inner clearfix"><strong>C<?php //echo $stepWiseVideo[4]["B"]["serial_field"];?></strong>
                  <h3>All Product View<?php //echo $stepWiseVideo[4]["B"]["title"];?></h3>
                  <a href="javascript:void(0)" id="tutorial-video-p-view" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>" class="watch-video-tut1">Watch Video</a></div>
                  <div class="upl_form">
                    
                      <div class="upl_frm_inre" style="  height: <?php echo (count($allProducts) > 6)?490:((count($allProducts) > 0)?count($allProducts)*108:17);?>px; <?php if(count($allProducts) > 6):?>overflow-y: scroll;<?php endif;?>"><table class="ppnams" style="border: 1px;width: 100%;">
                            <tbody class="ppnams_top">
                                <!--<th>#</th>-->
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tbody>
                            <?php if(count($allProducts) > 0):?>
                            <?php   $i = 1; foreach ($allProducts as $prd):?>
                            <tr>
                                <!--<td><?php echo $i;?></td>-->
                                <td>
                                <img width="50px" height="50px" src="<?php echo base_url().'adminuploads/product_files/images/thumb/'.$prd->fileName;?>" title="<?php echo $prd->productName;?>" />
                                <a href="<?php echo $this->config->item('affro_base_url').'welcome/productDetailsShow/'.$prd->productID; ?>" target="_blank">
                                View 
                                </a>
                                </td>
                                <td><?php echo $prd->productName;?></td>
                                <td><?php echo $prd->productPrice;?></td>
                                <td><a href="<?php echo base_url().'dashboard/editProduct/'.$prd->productID;?>">Edit</a>
                                <!--<a onclick="return confirm('Are you sure to delete this product. It will delete all details of product.');" href="<?php echo base_url().'dashboard/deleteProduct/'.$prd->productID;?>">Delete</a>--></td>
                            </tr>
                            
                            
                            <?php  $i++;  endforeach;?>
                            <?php    else: ?>
                            <tr>
                                <td colspan="4">Sorry! No Product please. </td>
                            </tr>
                            <?php    endif;?>
                          </table></div>
                    
                   
                </div>
                  <?php if($productId > 0):?>
                  <script type="text/javascript">
				  		$(document).ready(function(e) {
							var scroll1 = $(window).scrollTop() + 2310 + <?php echo (count($allProducts) > 6)?490:count($allProducts)*95;?> ;
							$(window).scrollTop(scroll1);
                        });
				  </script>
                  <div id="" class="ab_inner clearfix d_edit_prod"><strong>D<?php //echo $stepWiseVideo[4]["B"]["serial_field"];?></strong>
                  <h3>Edit Product<?php //echo $stepWiseVideo[4]["B"]["title"];?></h3>
                  <a href="javascript:void(0)" id="tutorial-video-p-edit" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>" class="watch-video-tut1">Watch Video</a></div>
                  <div class="upl_form_sec">
                    <form id="prd_upld_sec" action="<?php echo base_url();?>dashboard/updateProduct" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="productId" value="<?php echo $productId;?>">
                    <p>
                      <label>Vendors Name</label>
                      <select name="vendorID" id="vendorIDEdit">
                            <option value="">Please Select One</option>
                            <?php if(count($vendorsList) > 0){ foreach($vendorsList as $vl){?>
                            <option value="<?php echo $vl->vendorsID;?>" <?php if($vl->vendorsID == $pDetails[0]->vendorID){?> selected="selected"<?php }?>><?php echo $vl->vendorName;?></option>
                            <?php } }?>
                      </select>
                    </p>
					<p>
                      <label>Category</label>
                      <select name="catIDEdit" id="catIDEdit">
                            <option value="">Please Select Category</option>                            
							<?php if(count($categoryList) > 0){ 
								foreach($categoryList as $catL){
								//echo '++'.$catL->menuID."==".$catL->menuName;
								?>
								<option value="<?php echo $catL['menuID'];?>" <?php if($catL['menuID'] == $catID){?> selected="selected"<?php }?>><?php echo $catL['menuName'];?></option>
							<?php }}?>
							
                      </select>
                    </p>
					<p>
                      <label><!--Articles-->Sub Category</label>
                      <select name="articleIDEdit" id="articleIDEdit">
						<option value="">Please Select One</option>                            
							<?php if(count($artList) > 0){ 
								foreach($artList as $artL){
								//echo '++'.$catL->menuID."==".$catL->menuName;
								?>
								<option value="<?php echo $artL['id'];?>" <?php if($artL['id'] == $artID){?> selected="selected"<?php }?>><?php echo $artL['title'];?></option>
							<?php }}?>					  
                      </select>
                    </p>
                    <p>
                      <label><!--Selling Category-->2nd Sub Category</label>
                     <select name="productTypeID" id="productTypeIDEdit">
                            <option value="">Please Select One</option>
                        <?php if(count($productCategoryList) > 0){ foreach($productCategoryList as $pcl){?>
                        <option value="<?php echo $pcl['id'];?>" <?php if($pcl['id'] == $pDetails[0]->productTypeID){?> selected="selected"<?php }?>><?php echo $pcl['title'];?></option>
                        <?php } }?>
                      </select>
                    </p>
                    <p>
                      <label>Product Name</label>
                      <input type="text" name="productName" id="productNameEdit" value="<?php echo $pDetails[0]->productName;?>">
                    </p>
                    <p>
                      <label><!--Product Category-->This Item is for:</label>
                      <select name="productOfferEdit" id="productOfferEdit" onClick="priceComStatus('edit');">
						  <option value="0" <?php if($pDetails[0]->productOffer == 0){?> selected="selected"<?php }?> >Selling</option>
                          <option value="2" <?php if($pDetails[0]->productOffer == 2){?> selected="selected"<?php }?> >Free</option>
						  <option value="1" <?php if($pDetails[0]->productOffer == 1){?> selected="selected"<?php }?> >Collection Donate</option>
                      </select>
                    </p>
                    <p>
                      <label>Product Description</label>
                      <textarea name="productDesc" id="productDesc"><?php echo $pDetails[0]->productDesc;?></textarea>
                    </p>
                    <p>
                      <label>Selling Currency</label>
                      <select name="productCurrencyType" id="productCurrencyTypeEdit">
                          <option value="USD" <?php if($pDetails[0]->productCurrencyType == "USD"){?> selected="selected"<?php }?>>USD Dollar</option>
                          <option value="EUR" <?php if($pDetails[0]->productCurrencyType == "EUR"){?> selected="selected"<?php }?>>Euro</option>
                          <option value="GBP" <?php if($pDetails[0]->productCurrencyType == "GBP"){?> selected="selected"<?php }?>>Pound</option>
                      </select>
                    </p>
                    <p>
                      <label><!--Enter Product Price-->Price I want Per Item<span id="showSelCurrEdit">
					  <?php if($pDetails[0]->productCurrencyType == "USD"){ echo "($)"; } 
					  else if($pDetails[0]->productCurrencyType == "EUR"){ echo "(€)";}
					  else{ echo "(£)"; }?>
					  </span></label>
                      <input type="float" name="productPrice" id="productPriceEdit" value="<?php echo $pDetails[0]->productPrice;?>">
                    </p>
                    <p>
                      <label><!--Offering commission to GBE members-->Amount I'm Offering GBE Members As Commission<span id="showSelCurrEdit1">
					  <?php if($pDetails[0]->productCurrencyType == "USD"){ echo "($)"; } 
					  else if($pDetails[0]->productCurrencyType == "EUR"){ echo "(€)";}
					  else{ echo "(£)"; }?>
					  </span></label>
                      <input type="text" name="productCommissionEdit" id="productCommissionEdit" value="<?php echo $pDetails[0]->productCommission;?>" <?php if($donateStatus == 1){ echo 'disabled="disabled"';}?>>
                    </p>
                    <?php $colorExist = count($pColors['selectedColor']);?>
                    <div class="col_qnt">
  						<div class="color_sec">
      						<div class="col_tpps">
                      			<label>Color Product </label>
                      			<p> <input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_1" class="colorRadioEdit" <?php if($colorExist > 0):?>checked="checked" <?php endif;?>>
                          		<strong>Yes</strong></p>
                      			<p><input type="radio" name="RadioGroup1"  value="0" id="RadioGroup1_0" class="colorRadioEdit" <?php if($colorExist <= 0):?>checked="checked" <?php endif;?>> 
              					<strong>No</strong></p>
                    		</div>
   
      
      						<div class="col_in_edit" id="cq_1_edit" <?php if($colorExist <= 0):?>style="display: none;"<?php endif;?>>
      						<?php 	if(count($colorList) > 0):?>
            				<?php 		foreach ($colorList as $cList):?>
                            <?php 			$qnty = 0;$colorClass = "";
											if(in_array($cList->id,$pColors['selectedColor'])) {  
												$qnty = $pColors['selectedColorDetails'][$cList->id];
												$colorClass = "colorActive";
											}
							?>
          						<p class="col_col" id="<?php echo $cList->id;?>">
              					<span id="lblId_edit_<?php echo $cList->id;?>" class="<?php echo $colorClass;?>"></span>
              					<label style="background:<?php echo $cList->colorCode;?>;" ></label>
                				<input type="hidden" name="color[<?php echo $cList->id;?>]" value="0" id="colorIdEdit_<?php echo $cList->id;?>">
                				<input type="text" name="q[<?php echo $cList->id;?>]" value="<?php echo $qnty;?>" id="<?php echo $cList->id;?>" class="qClassEdit">
            					</p>
                                	
                  				<?php endforeach;?>
      						<?php endif;?>
    					</div>
  					</div>
				</div>   
                    <p id="offQuantity">
                      <label>Quantity :</label>
                      <input type="text" name="productQuantity" id="productQuantityEdit" value="<?php echo $pDetails[0]->productQuantity;?>">
                    </p>
					<!--<div class="donate_rd col_tpps">
                      <label>Donate</label>
                      <p>
                          <input type="radio" name="productDonateEdit" onclick="commissionStatusChange('productDonateEdit_1','edit')" value="1" id="productDonateEdit_1" <?php if($pDetails[0]->productDonate == 1):?>checked="checked" <?php endif;?>>
                        Yes</p>
                      <p>
                        <input type="radio" name="productDonateEdit" onclick="commissionStatusChange('productDonateEdit_0','edit')" value="0"  id="productDonateEdit_0" <?php if($pDetails[0]->productDonate == 0 || $pDetails[0]->productDonate == ""):?>checked="checked" <?php endif;?>>
                        No</p>
                    </div>-->
                    
                    <p>
                      <label>Product You tube video</label>
                      <input type="text" name="productYoutubeUrl" id="productYoutubeUrl" value="<?php echo $pDetails[0]->productYoutubeUrl;?>">
                    </p>
                    <p>
                      <label><!--Product Type-->Type of Product</label>
                      <select name="typeOfProduct" id="typeOfProductEdit" onClick="typeFunctionality('edit');">
						  <option value="1" <?php if($pDetails[0]->typeOfProduct == 1){?> selected="selected"<?php }?>>Digital Upload Product</option>
                          <option value="2" <?php if($pDetails[0]->typeOfProduct == 2){?> selected="selected"<?php }?>>Physical Sendable Product</option>
						  <option value="3" <?php if($pDetails[0]->typeOfProduct == 3){?> selected="selected"<?php }?>>Event Ticket</option>
                      </select>
                    </p>                    
					<div id="digitalDivEdit" <?php if($pDetails[0]->typeOfProduct == 1){ echo 'style="display:block;"'; } else { echo 'style="display:none;"';} ?>>
                    <p>
                      <label>Upload your Digital product Mp3 / Film / PDF – 20MB</label>
                      <input type="file" name="productMusic" id="productMusic" value="">
                      <?php if($pFiles['mp3']['id'] != ''){ ?>
                      	<span><?php echo $pFiles['mp3']['fileName'];?></span>
                      	<input type="hidden" name="mp3EditId" value="<?php echo $pFiles['mp3']['id'];?>">
                      <?php }else{?>
                      	<input type="hidden" name="mp3EditId" value="0">
                      <?php }?>
                    </p>
					</div>
					<div id="eventDivEdit" <?php if($pDetails[0]->typeOfProduct == 3){ echo 'style="display:block;"'; }else { echo 'style="display:none;"';} ?>>
					<p>
                      <label>Upload Pdf File</label>
                      <input type="file" name="productEventPdf" id="productEventPdf" value="">
					  <?php if($pFiles['pdf']['id'] != ''){ ?>
                      	<span><?php echo $pFiles['pdf']['fileName'];?></span>
                      	<input type="hidden" name="pdfEditId" value="<?php echo $pFiles['pdf']['id'];?>">
                      <?php }else{?>
                      	<input type="hidden" name="pdfEditId" value="0">
                      <?php }?>
                    </p>
					<p>
                      <label>End Date</label>
                      <input type="text" class="form-control datepicker" name="productEventEndDate" id="productEventEndDateEdit" value="<?php echo $pDetails[0]->productEventDate; ?>">
                    </p>
					</div>
                    <p>
                      <label>Upload the Main Image of your Product</label>
                      <input type="file" name="img_1" id="mainImageIdEdit">
                      <?php if($pFiles['img_1']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo base_url();?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_1']['fileName'];?>">
                        <input type="hidden" name="img_1_edit" value="<?php echo $pFiles['img_1']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_1_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Secondary Image of your product</label>
                      <input type="file" name="img_2">
                      <?php if($pFiles['img_2']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo base_url();?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_2']['fileName'];?>">
                      <input type="hidden" name="img_2_edit" value="<?php echo $pFiles['img_2']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_2_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Third Image of your product</label>
                      <input type="file" name="img_3">
                      <?php if($pFiles['img_3']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo base_url();?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_3']['fileName'];?>">
                      <input type="hidden" name="img_3_edit" value="<?php echo $pFiles['img_3']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_3_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Fourth Image of your product</label>
                      <input type="file" name="img_4">
                      <?php if($pFiles['img_4']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo base_url();?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_4']['fileName'];?>">
                      <input type="hidden" name="img_4_edit" value="<?php echo $pFiles['img_4']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_4_edit" value="0">
                      <?php }?>
                    </p>
                    <div class="status_rd">
                      <label>Status</label>
                      <p>
                          <input type="radio" name="productStatus" value="1" <?php if($pDetails[0]->productStatus == 1):?>checked="checked" <?php endif;?> id="productStatus_1">
                        Active</p>
                      <p>
                        <input type="radio" name="productStatus" value="0" <?php if($pDetails[0]->productStatus == 0):?>checked="checked" <?php endif;?> id="productStatus_0">
                        Inactive</p>
                    </div>
                    <div class="clear"></div>
                    <p>
                        <input type="submit" value="Update" id="pUploadButtonEdit" name="pUploadButton">
                    </p>
                  </form>
                </div>
                  
                  <?php endif;?>
                  
                  <div class="ab_inner clearfix d_edit_prod"><strong>C<?php //echo $stepWiseVideo[4]["B"]["serial_field"];?></strong>
                  <h3>My Listing<?php //echo $stepWiseVideo[4]["B"]["title"];?></h3>
                  <a href="javascript:void(0)" id="tutorial-video-p-view" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>" class="watch-video-tut1">Watch Video</a></div>
                  <div class="upl_form">
                    
                      <div class="upl_frm_inre" style="  height: <?php echo (count($infoListing) > 6)?740:((count($infoListing) > 0)?count($infoListing)*145:17);?>px; <?php if(count($infoListing) > 6):?>overflow-y: scroll;<?php endif;?>">
                     
                      <div class="twitt lsts_dirc"  border="1">
 							<ul id="listTrack">
                            <?php foreach( $infoListing as $key=>$val){
							  if( strlen($val->listingDesc) > 50 ){
								$pos=strpos($val->listingDesc, ' ',50);
								$newStr = substr($val->listingDesc,0,$pos );
							  }else{
								$newStr =  $val->listingDesc;
							  }
                       
					?>
                            <li id="<?php echo $val->listingID ;?>">
    					<div class="list_dirct_left"><a href="<?php echo $this->config->item("affro_base_url");?>welcome/listingDetails/<?php echo $val->listingID ;?>" target="_blank"><img src="<?php echo base_url();?>adminuploads/listingImg/<?php echo $val->listingImg ;?>" width="80" height="80"></a></div>
						<div class="list_dirct_rit"><div class="author"><div class="titles"><a href="<?php echo base_url();?>welcome/listingDetails/<?php echo $val->listingID ;?>"><?php echo $val->listingName;?> </a><!--<p><?php echo $val->listingAddr;?> </p>--></div><div class="adrs fnt dscptn"><p class="dess"><?php echo $newStr; ?> ...</p></div></div>   					
                  <div class="mll_phn"><a data-toggle="modal" data-target="#afromail"   class="eeml twta" href="#"><?php echo $val->listingEmail;?></a>
<span class="phhn"><span>Phone No:</span> <?php echo $val->listingNo ;?></span></div>      
                        </div>
  				</li>
				
                <?php }  ?>
                
                </ul>
				
			</div>

                      </div>
                    
                   
                </div>
              </div>
              <?php } else { ?>
              <div class="white-bg">
                <div class="tab2-text">
                  <div class="step02">
                    <h2> &#8249;&#8249;&#8249;&#8249; <a href="<?php echo base_url();?>dashboard/">Go Back To Step 1</a></h2>
                    <h4>Watch The Videos & Follow The Instructions</h4>
                    <h1>Get Your <br>
                      Afrowebb Catalogue</h1>
                    <h3>Then Complete Step 1</h3>
                    <h5>Once You Have Completed All The Instructions <br>
                      You Gain Access To The Second Step</h5>
                    <h6> &#8249; <a href="<?php echo base_url();?>dashboard/">Click Here To Go Back & Complete Step 1</a> </h6>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <!--4tab end......... --> 
            
          </div>
          
          <!--all cont --> 
          <br class="clear">
        </div>
      </div>
    </div>
    <!--lefts_side end-->
    <div class="rights_side">
      <div class="nitify-menu">
        <ul>
          <li><a href="#"><i class="fa fa-laptop"></i><span class="notify-ribon"><?php echo $levelWiseCounter[0]->level_1;?></span></a></li>
          <li><a href="#"><i class="fa fa-heart"></i><span class="notify-ribon"><?php echo $levelWiseCounter[0]->level_2;?></span></a></li>
          <li><a href="#"><i class="fa fa-globe"></i><span class="notify-ribon"><?php echo $levelWiseCounter[0]->level_3;?></span></a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i><span class="notify-ribon"><?php echo $levelWiseCounter[0]->level_4;?></span></a></li>
          <li><a href="#"><i class="fa fa-dashboard"></i><span class="notify-ribon"><?php echo $levelWiseCounter[0]->level_5;?></span></a></li>
        </ul>
      </div>
      <div class="sm extra-no-pad">
        <ul class="social_media extra-width">
          <li class="sm001"> <a id="serviceList_1" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Customer Service</a>
            <div id="slist_1" class="list_service">
              <form method="post" action="<?php echo base_url();?>dashboard/services/customer">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td><label for="textfield">Email Id:</label></td>
                      <td><input type="text" id="customerServiceEmail" class="custEmailClass" name="email"></td>
                    </tr>
                    <tr>
                      <td><label for="textarea">Message:</label></td>
                      <td><textarea rows="5" cols="31" id="customerServiceMsg" class="custMessageClass" name="message"></textarea></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="submit" value="Submit" id="customerServiceSubmit" name="customerServiceSubmit" onclick="return checkEmailMessage('customerServiceEmail','customerServiceMsg')"></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </li>
          <li class="sm002"> <a id="serviceList_2" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Tech Support </a>
            <div id="slist_2" class="list_service">
              <form method="post" action="<?php echo base_url();?>dashboard/services/tech">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td><label for="textfield">email:</label></td>
                      <td><input type="text" id="techSupportEmail" class="custEmailClass" name="email"></td>
                    </tr>
                    <tr>
                      <td><label for="textarea">message:</label></td>
                      <td><textarea rows="5" cols="31" id="techSupportMsg" class="custMessageClass" name="message"></textarea></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="submit" value="Submit" id="techSupportSubmit" name="techSupportSubmit" onclick="return checkEmailMessage('techSupportEmail','techSupportMsg')"></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </li>
          <li class="sm003"> <a id="serviceList_3" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Advertising </a>
            <div id="slist_3" class="list_service">
              <form method="post" action="<?php echo base_url();?>dashboard/services/advertise">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td><label for="textfield">email:</label></td>
                      <td><input type="text" id="advertisingEmail" class="custEmailClass" name="email"></td>
                    </tr>
                    <tr>
                      <td><label for="textarea">message:</label></td>
                      <td><textarea rows="5" cols="31" id="advertisingMsg" class="custMessageClass" name="message"></textarea></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="submit" value="Submit" id="advertisingSubmit" name="advertisingSubmit" onclick="return checkEmailMessage('advertisingEmail','advertisingMsg')"></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </li>
          <!--          <li class="sm007"> <a id="serviceList_4" href="javascript:void(0)">Listen to GBE Radio</a> </li>-->
          <!--<li class="sm003"> <a id="serviceList_5" href="javascript:void(0)" onclick="funToggleSupport(this.id)">Total Member Under GBE Business</a>
            <div id="slist_5" class="list_service">
              <p class="total-number"><?php echo $totalMembers;?></p>
            </div>
          </li>-->
        </ul>
      </div>
        <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
        ?>
        
        <div class="webbox1 listing_header" style="display: none;">
        		<div class="ab_inner clearfix">
                  <h3>Listings Area-Watch Video</h3>
                  <a href="javascript:void(0)" id="tutorial-video-p-add" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>" class="watch-video-tut1"></a>
                  </div>
        	<div class="webbox1">
                <div class="upl_form web">
                
               <!-- <span>Free Listing on AFROWEBB</span>-->
                    <form id="prd_upld" action="<?php echo base_url();?>dashboard/freeListing/" method="post" enctype="multipart/form-data">
                    <p>
                      <label>Name</label>
                      <input type="text" name="listingName" id="listingName">
                    </p>
                    <p>
                      <label>Address</label>
                      <textarea name="listingAddr" id="listingAddr"></textarea>
                    </p>
                     <p>
                      <label>Number</label>
                      <input type="text" name="listingNo" id="listingNo">
                    </p>
                    <p>
                      <label>Email</label>
                      <input type="text" name="listingEmail" id="listingEmail">
                    </p>
                    <p>
                      <label>Country</label>
                      <select id="listingCountry" name="listingCountry">
                        <option value="">Select Country </option>
                        <?php if(count($countryList) > 0){ 
                            foreach($countryList as $cl){
                                ?>
                        <option value="<?php echo $cl->country_id;?>" ><?php echo $cl->name;?></option>
                        <?php }}?>
                      </select>
                    </p>
                    <p>
                      <label>State</label>
                      <input type="text" name="listingState" id="listingState">
                    </p>
                    <p>
                      <label>City</label>
                      <select id="listingCity" name="listingCity">
                        <option value="">Select City </option>
                        <?php if(count($cityList) > 0){ 
                            foreach($cityList as $cl){
                                ?>
                        <option value="<?php echo $cl->id;?>" ><?php echo $cl->city;?></option>
                        <?php }}?>
                      </select>
                    </p>
                   
                    <p>
                      <label>Description</label>
                      <textarea name="listingDesc" id="listingDesc"></textarea>
                    </p>
                    <p>
                      <label>Website</label>
                      <input type="text" name="listingWebsite" id="listingWebsite">
                    </p>
                    <p>
                      <label>Youtube Url</label>
                      <input type="text" name="listingUrl" id="listingUrl" placeholder="Paste the embedded Link">
                    </p>
                    <p>
                      <label>Image</label>
                      <input type="file" name="listingImg" id="listingImg" value="Choose file">
                    </p>
                    <p>
                      <label>Category </label>
                      <select id="categoryList" name="categoryList">
                        <option value="">Select Category </option>
                        <?php if(count($categoryList) > 0){ 
                            foreach($categoryList as $catL){
                                //echo '++'.$catL->menuID."==".$catL->menuName;
                                ?>
                        <option value="<?php echo $catL['menuID'];?>" ><?php echo $catL['menuName'];?></option>
                        <?php }}?>
                      </select>
                    </p>
                    <p>
                      <label>Sub-<br>Category </label>
                      <select id="articleList" name="articleList">                
                      </select>
                    </p>
                    <p>
                      <label>2nd Sub-<br>Category </label>
                      <select id="subArticleList" name="subArticleList">                
                      </select>
                    </p>
                    <p>
                        <input type="submit" name="freeListing" id="freeListingId" value="Save">
                    </p>
                  </form>
                </div>
                 <p class="web product_view_listing">  <a href="javascript:void(0);" id="viewMyProductListing"><span> View - My Listing </span></a></p>
            </div>
      </div>
      
        <?php } ?>
        
        
      	<div class="webbox">
        <p class="web">  <a  href="<?php echo base_url();?>currentaccount/myAccount"><span> MY WALLET </span></a></p>
        </div>
        
        
<?php if( $userInfo[0]['userType'] == 'ADMIN' || $userInfo[0]['userType'] == 'VOLUNTEERS' || $userInfo[0]['userType'] == 'HEAD VOLUNTEERS' || $userInfo[0]['user_general_type_name'] == 'afrowebb'): ?>
        <div class="webbox">
        <p class="web">  <a  href="<?php echo base_url();?>message"><span> V.I.P Entrance For My True 12 </span></a></p>
        </div>
        <?php endif;?>
        
        
      <div class="webbox">
        <p class="web"> <span>My Sign Up Page:</span> <a target="_blank" href="<?php echo base_url()."gateway_signup/".$userInfo[0]["userName"];?>"><?php echo base_url()."gateway_signup/".$userInfo[0]["userName"];?></a> </p>
        <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
            ?>
        <p class="web"> <span>My Afrowebb Catalogue :</span> 
		<a target="_blank" href="<?php echo $this->config->item("affro_base_url").'gbe/member/'.$userInfo[0]["userName"];?>"><?php echo $this->config->item("affro_base_url").'gbe/member/'.$userInfo[0]["userName"];?></a>
		</p>
        <?php }?>
      </div>
      <div class="webbox">
        <?php 
                $viewArray = array("ADMIN");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
        <p class="web"> <span>My Sign Up of Teacher Page :</span> <a target="_blank" href="<?php echo base_url()."signup_teachers/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_teachers/".$userInfo[0]["userName"];?></a> </p>
        <?php }?>
        <?php
                //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
                $viewArray = array("TEACHER","ADMIN","STUDENT");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
        <p class="web"> <span>My Sign Up of Student Page :</span> <a target="_blank" href="<?php echo base_url()."signup_student/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_student/".$userInfo[0]["userName"];?></a> </p>
        <?php }?>
      </div>
      <div class="webbox">
        <?php 
                $viewArray = array("ADMIN");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
        <p class="web"> <span>My Sign Up of Head Volunteers Page :</span> <a target="_blank" href="<?php echo base_url()."signup_head_volunteers/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_head_volunteers/".$userInfo[0]["userName"];?></a> </p>
        <?php }?>
        <?php
                //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
                $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","STUDENT","VOLUNTEERS");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
        <p class="web"> <span>My Sign Up of Volunteers Page :</span> <a target="_blank" href="<?php echo base_url()."signup_volunteers/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_volunteers/".$userInfo[0]["userName"];?></a> </p>
        <?php }?>
      </div>
      <?php
                //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
                $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","STUDENT","VOLUNTEERS");
                if(in_array($this->session->userdata('userType'), $viewArray)){
                    unset($viewArray);
            ?>
      <div class="webbox">
        <p class="web"> <span>My Sign Up of Business Page :</span> <a target="_blank" href="<?php echo base_url()."signup_business/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_business/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Talent Page:</span> <a target="_blank" href="<?php echo base_url()."signup_talented/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_talented/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Mentorship Page :</span> <a target="_blank" href="<?php echo base_url()."signup_mentorship/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_mentorship/".$userInfo[0]["userName"];?></a> </p>
        <p class="web"> <span>My Sign Up of Health Wellness Page:</span> <a target="_blank" href="<?php echo base_url()."signup_health/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_health/".$userInfo[0]["userName"];?></a> </p>
        <!--<p class="web"> <span>My Sign Up of Community Page:</span> <a target="_blank" href="<?php echo base_url()."signup_communities/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_communities/".$userInfo[0]["userName"];?></a> </p>-->
        <p class="web"> <span>My Sign Up of Afrowebb Page:</span> <a target="_blank" href="<?php echo base_url()."signup_afrowebb/".$userInfo[0]["userName"];?>"><?php echo base_url()."signup_afrowebb/".$userInfo[0]["userName"];?></a> </p>
      </div>
      <?php }?>
      <?php
            //$viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            $viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray)){
                unset($viewArray);
        ?>
		
      <div class="blue-box">
        <p class="ana">Catalogue Commission </p>
        <ul>
        <?php if(count($catalogueCommisson) > 0): foreach($catalogueCommisson as $ccv):?>
          <li><?php echo $ccv->cuFName . ' ' . $ccv->cuLName ;?> :<span> <?php echo $ccv->pc .''. round($ccv->parent_commossion,2);?></span></li>
         <?php endforeach; else:?>
         <li><span> Sorry! No Data please..</span></li>
         <?php endif;?>
         <!-- <li> Visitors to my website : <span>6</span></li>
          <li>My Ticket Sales : <span>0</span></li>
          <li>My Music Sales : <span>0</span></li>
          <li>My E-book Sales :<span> 0</span></li>-->
        </ul>
      </div>
        
      <div class="ash">
          <?php if($parentInfo[0]["profile"] != ""){?>
          <img width="80" height="80" alt="" src="<?php echo base_url(); ?>useruploads/<?php echo $parentInfo[0]["profile"]; ?>">
          <?php }?>
          <span class="ash_postion">You are introduced to GBE by</span> 
          <span class="ash_title"><?php echo $parentInfo[0]["firstName"];?> <?php echo $parentInfo[0]["lastName"];?></span> 
          <span class="ash_tel"><?php echo $parentInfo[0]["phone"];?></span> 
          <span class="ash_tel"><a href="mailto:<?php echo $parentInfo[0]["emailID"];?>"><?php echo $parentInfo[0]["emailID"];?></a></span><br>
        
          <div class="ash_social"> 
            <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/ash-fb.png"></a> <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/skype_square_color-32.jpg"></a> <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/youtube.jpg"></a> <a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/ash-tw.png"></a> <!--<a target="_blank" href="#"><img src="<?php echo base_url(); ?>images/ash-wp.png"></a>--> </div>
            </div>
      <?php } ?>
       <?php
            $viewArray = array("TEACHER","PAYING USER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            //$viewArray = array("VOLUNTEERS","PAYING USER","ADMIN");'business','community','health','mentorship','talented','general','afrowebb'
            if(in_array($this->session->userdata('userType'), $viewArray)){
                unset($viewArray);
        ?>
      <div class="blue-box1 webbox optnse" style="margin:40px 0 0 0px;">
        <p class="ana">OverView of Level 1</p>
        <div style="max-height:768px; <?php if(count($overView) > 20):?> overflow-y: scroll;<?php endif;?>">
        <ul>
          <li class="mbrs"><strong>Members Counter:<span>People introduced by me</span></strong> <strong><?php echo count($overView);?></strong><br class="clear"></li>
          <?php 
		  if(count($overView) > 0):
		  	foreach($overView as $ls):
		  ?>
          <li> <strong><?php echo $ls->firstName;?></strong> <strong><?php echo $ls->lastName;?> :</strong> <strong><?php echo $ls->totalMember;?></strong> </li>
          <?php 
		  	endforeach;
		  endif;
		  ?>
                   <!-- <li>Rave &nbsp;Story:&nbsp; 6</li>
          <li>Bhaskar&nbsp;Mandal:&nbsp; 5</li>
          <li>terter1&nbsp;terst:&nbsp; 0</li>
          <li>Naren&nbsp;Das:&nbsp; 0</li>
          <li>Abhisek&nbsp;Majumdar:&nbsp; 0</li>
          <li>Jenny Mae&nbsp;Gapasin:&nbsp; 0</li>-->
        </ul>
        </div>
      </div>
      <?php } ?>
      
    </div>
    <br class="clear">
  </div>
  
  
  <?php if(count($allUser) > 0 ){ ?>
  <div class="table-status">
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tbody>
        <tr>
          <th valign="middle" height="35" align="center" scope="col">Image</th>
          <th valign="middle" height="35" align="center" scope="col">Name</th>
          <th valign="middle" height="35" align="center" scope="col">Phone</th>
          <th valign="middle" height="35" align="center" scope="col">Email</th>
          <th valign="middle" height="35" align="center" scope="col">City</th>
          <th valign="middle" height="35" align="center" scope="col">Country</th>
          <th valign="middle" height="35" align="center" scope="col">User Type</th>
          <th valign="middle" height="35" align="center" scope="col">Expel</th>
          <?php if($this->session->userdata('userType') == "ADMIN"){?>
            <th valign="middle" height="35" align="center" scope="col">Delete</th>
          <?php } ?>
           <?php if($this->session->userdata('userType') == "HEAD VOLUNTEERS"){?>
            <th valign="middle" height="35" align="center" scope="col">Convert</th>
          <?php } ?>
        </tr>
        <?php foreach($allUser as $ald){
            $country = "";
            if($ald->city_name == "London"){
                $country = "UK";
            }elseif($ald->city_name == "Banjul"){
                $country = "The Gambia";
            }elseif($ald->city_name == "Barcelona"){
                $country = "Spain";
            }elseif($ald->city_name == "Portsmouths"){
                $country = "UK";
            }
            
            ?>
        <tr>
          <td valign="middle" height="45" align="center"><img height="35" src="<?php echo base_url()."useruploads/";?><?php if($ald->profile != ""){ echo $ald->profile;}else{?>member_img.png<?php }?>"></td>
          <td valign="middle" height="45" align="center"><?php echo $ald->firstName." ".$ald->lastName;?></td>
          <td valign="middle" height="45" align="center"><?php echo $ald->phone;?></td>
          <td valign="middle" height="45" align="center"><?php echo $ald->emailID;?></td>
          <td valign="middle" height="45" align="center"><?php echo $ald->city_name;?></td>
          <td valign="middle" height="45" align="center"><?php echo $country;?></td>
          <?php if($ald->userType == 'PAYING USER'): ?>
          <td valign="middle" height="45" align="center">
		  	<?php 
				if($ald->user_general_type_name != ''){
				 	echo ucwords(strtolower($ald->user_general_type_name));
				}else{ 
					echo ucwords(strtolower($ald->userType)); 
				}
				?></td>
          <?php else:?>
          <td valign="middle" height="45" align="center"><?php echo ucwords(strtolower($ald->userType));?></td>
          <?php endif;?>
          <?php if($ald->uID == $ald->expelled_user_id && $this->session->userdata('userType') == "ADMIN"){?>
          <td valign="middle" height="45" align="center"><a href="javascript:void(0);" class="expellClass" id="<?php echo $ald->uID;?>">Expel</a></td>
          <?php }else{
          $viewArray = array("TEACHER","HEAD VOLUNTEERS");
            if(in_array($this->session->userdata('userType'), $viewArray)){
                unset($viewArray);
                ?>
          <td valign="middle" height="45" align="center"><a href="javascript:void(0);" class="expellClass" id="<?php echo $ald->uID;?>">Expel</a></td>
            <?php }else{?>
          <td valign="middle" height="45" align="center">&nbsp;</td>
            <?php } ?>
          <?php }?>
          
           <?php if($this->session->userdata('userType') == "ADMIN"){?>
          <td valign="middle" height="45" align="center"><a href="<?php echo base_url();?>dashboard/deleteUserFromExpell/<?php echo $ald->uID;?>" class="expellDeleteClass" onclick="return confirm('Are you sure to delete the user details.');" id="<?php echo $ald->uID;?>">Delete</a></td>
          <?php }?>
          
          <?php if($this->session->userdata('userType') == "HEAD VOLUNTEERS"){ ?>
          <td valign="middle" height="45" align="center">
          <?php if($ald->user_general_type_name == 'afrowebb'){?>
          <a href="<?php echo base_url().'dashboard/convertAfroToVol/';?><?php echo $ald->uID;?>" class="convertClass" onclick="return confirm('Are you sure to convert this Afrowebb user to Volunteer.');" id="<?php echo $ald->uID;?>">Convert</a>
          <?php }else{?>&nbsp;
          <?php }?>
          </td>
          <?php }?>
          
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
  <?php } ?>
</div>
<script type="text/javascript">
    
$(document).ready(function() {
   
    
	$(".share-btn").click(function(e){
		$(this).parent().find('.share-popup').fadeIn(1000);
	 }); 
	$(".share-btn").blur(function(e){
		$(this).parent().find('.share-popup').fadeOut(1000);
	}); 
	$(".watch-video-tut").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
	});
	$(".watch-video-tut1").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
	});
	
	$("#viewMyProductListing").click(function(){
		//alert($(window).scrollTop());
		//var scroll1 = $(window).scrollTop() + 1200 ;
		var producN = <?php echo count($allProducts);?>;
		var extra = 490;
		if(producN <6){
			extra = 95*producN;
		}
		var scrolll = 2275 + extra;
		$(window).scrollTop(scrolll);
	});
        
});

</script>



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
        
        /* expell functionality */
        $(".expellClass").click(function(){
            var id = $(this).attr("id");
            $.ajax({
                type : "POST",
                data : "uID="+id,
                url : "<?php echo base_url();?>dashboard/expell/",
                success : function(data){
                    //alert(data);
					formSubmitMsg ='User expelled successfully';
					$.fancybox.open(formSubmitMsg);
                }
            }); 
        });
        
    /*end*/
	
});

var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";
</script> 
<script type='text/javascript' src='<?php echo base_url(); ?>js/custom_common.js'></script>
<link type='text/css' href='<?php echo base_url(); ?>css/basic.css' rel='stylesheet' media='screen' />
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.simplemodal.js'></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

    $(function() {
        $('#productEventEndDate').datepicker({dateFormat: "yy-mm-dd"});
		$('#productEventEndDateEdit').datepicker({dateFormat: "yy-mm-dd"});
    });

</script>

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
.clk_pr_inv {
    overflow-y: scroll; height: 290px;
}
  </style>
</body>
</html>
