<?php $this->load->view("header", "", $result); ?>

<script>
	function readURL(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
         $('#empPic').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
	
}
//17/09/2015 ujjwal sana
function showCopyPostImage(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#post_image_copy_hide_id').hide();
			$('#post_image_copy_show_id').show();
			$('#post_image_copy_show_id').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function showAddPostImage(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#post_image_add_show_id').show();
		$('#post_image_add_show_id').attr('src', e.target.result);
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
<script>

//9/9/2015 changes by ujjwal sana 
$(document).ready(function(e) {
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
	  $('.close_btn').click(function(){
	 	$('.ppup').remove();
		$('.ppup_levelup').remove();
	 });
	 
	 $('.close_btn_alert').click(function(){
	 	$('.ppup_level').remove();
	 });
	 //1/10/2015 ujjwal sana
	 $('#moveUp').click(function(e) {
		 if($('#termsCheck').is(':checked')){
			var totalMoney = Number(100);
			if(totalMoney >= 60){
				//window.location.href = '<?php echo base_url();?>fullmembers/moveup';
				window.location.href='<?php echo base_url();?>gbe_payment/switchOn/2'; // parameter set to use switchon for all levels  Added by S on 25/09/2015
			}else{
				$.fancybox.open('Sorry, You do not have sufficient money to move up.');
			}
		 }else{
			$.fancybox.open('Please select Terms & Conditions.');
		 }
        	
		return false;
    });
	 $("#articleID").change(function() {
		//alert();
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedArtId =$("#articleID").val();
		//alert(selectedArtId);
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
		 
});

</script>

<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>
<script>
function resetForm(){
	$.post('<?php echo base_url();?>fullmembers/resetEventSearch')
	.done(function(data){
		$('#country').val('');
		$('#city').val('');
		$('#zip_code').val('');
	});
}
function getCity(){
	var selectedCountryId = Number($('#country').val());
	if(selectedCountryId > 0){
		$.post('<?php echo base_url();?>event/getCity',{ c_id: selectedCountryId})
		.done(function(data){
			var res = $.parseJSON(data);
			$('#city').html(res.result);
			$('#zip_code').html('<option value="">Select One </option>');
		});
	}
}

function getZipCode(){
	var selectedCityId = Number($('#city').val());
	if(selectedCityId > 0){
		$.post('<?php echo base_url();?>event/getZipCode',{ c_id: selectedCityId})
		.done(function(data){
			var res = $.parseJSON(data);
			$('#zip_code').html(res.result);
		});
	}
}

function openCityAddCityDiv(){
 	$('#newCity').css('display','block');
}
function closeNewCityDiv(){
	$('#newVendorCity').val('');
	$('#newCity').css('display','none');
}
function openZipAddZipDiv(){
	 $('#newZip').css('display','block');
}
function closeNewZipDiv(){
	$('#newVendorZip').val('');
	$('#newZip').css('display','none');
}

 
function addNewCity(){
	 var selectedCountryId =$('#country').val();
	 var newCityName = $('#newVendorCity').val();
	 if(selectedCountryId > 0 && newCityName!=''){
			
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
						$.fancybox.open('City added Successfully');
						$('#newVendorCity').val('');
						$('#newCity').css('display','none');
						$("#city option").remove();									
						$('#city').append(data.cityList);					
					}else{
						$.fancybox.open(data.message);
					}
				  }
			  });
		}else{
			$.fancybox.open('Please enter the City.');
		}
 }
 function addNewZip(){
	 var cityId =$('#city').val();
	 var newZipCode = $('#newVendorZip').val();
	 if(cityId > 0 && newZipCode!=''){
		 
		$.ajax({
		 type: "POST",
		 url:  "<?php echo base_url();?>event/addNewZip", 
		 data: "cityId="+cityId+"&newZipCode="+newZipCode,
		 cache:false,
		 dataType: "json",
		 success: function(data){			
				if(data.success == "yes"){	
				
					$.fancybox.open('Zip added Successfully');
					$('#newVendorZip').val('');
					$('#newZip').css('display','none');
					$("#zip_code option").remove();									
					$('#zip_code').append(data.zipList);					
				}else{
					
					$.fancybox.open(data.message);
				}
			  }
		  });
		  
	 }else{
		if(cityId == ''){
			$.fancybox.open('Please select the City.');
		}else if(newZipCode == ''){
			$.fancybox.open('Please enter the Zip code.');
		}
	 }
 }
</script>
<script type="text/javascript">
jQuery(document).ready(function($){	
/*
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
				//$(".webbox1").show();
            }
        }*/
	
<?php foreach ( $userYoutube as $key=>$val){  ?> 

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
});
</script>
<script type="text/javascript">
jQuery(function ($) {
	// Load dialog on click
	 $("#tutorial-video201").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 //31/10/2015 added by ujjwal sana
		 $("#tutorial-video1A").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][A]["path"];?>" frameborder="0" allowfullscreen></iframe>');
			//$.fancybox({            'content' : $("#sanaujjwal").html() });
		 });
		 $("#tutorial-video1B").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][B]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video1C").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][C]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video1D").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][D]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#tutorial-video1E").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][E]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#tutorial-video1F").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][F]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 
		 
		  $("#tutorial-video202").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 //31/10/2015 added by ujjwqal sana 
		 $("#tutorial-video2A").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][A]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video2B").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][B]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video2C").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][C]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video2D").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][D]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video2E").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][E]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });

		 
		 
		 
		  $("#tutorial-video203").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[3][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 //31/10/2015 added by ujjwal sana
		 $("#tutorial-video3A").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[3][A]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video3B").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[3][B]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video3C").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[3][C]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video3D").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[3][D]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video3E").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[3][E]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 
		 
		  $("#tutorial-video204").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 //31/10/2015 added by ujjwal sana
		  $("#tutorial-video4A").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][A]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video4B").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][B]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 
        
	$('.clickopen').click(function () {
            $(this).next().slideToggle("slow");
	});
        
     
	
});

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
 function closeNewCityDiv(){
	 $('#newVendorCity').val('');
	$('#newCity').css('display','none');
 }

var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";
</script>
<!--new added for calender8/10/2015 start-->
<script type='text/javascript' src='<?php echo base_url();?>js/custom_calendar.js'></script><!---->
<link type='text/css' href='<?php echo base_url(); ?>css/basic.css' rel='stylesheet' media='screen' />
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.simplemodal.js'></script>
<!--8/10/2015 stop-->
<?php 

     if( $result["ProfileImage"] != ""){

?>
<style>
input[type=file] {
	width:90px;
	color:transparent;
}
</style>
<?php 

    }

?>
<!--22/09/2015 ujjwal sana-->
<?php if($totalMembersUnderMe >= 10 && $userInfo[0]['userLevel'] == 1){?>

<div class="ppup">
<div class="ppup_inr">
<div id="cong_mess" class="switch mov_up"><a href="javascript:;" class="close_btn" title="Close"></a>
  <h2>Congratulations</h2>
  <h3>You have enough people to move up.</h3>
  <h4>Click "Move Up" to get the licence to sell<br>
    the product Package of Level 2.<br>
    You will also make large commission too.</h4>
  <h5>60 will Be deducted from your CT Profits</h5>
  <p class="termsCond">
    <input type="checkbox" id="termsCheck" class="ckbxe">
    <span>Terms & Conditions</span></p>
  <div class="switch_extrapara">
    <p class="swt_img"><a id="moveUp" href="javascript:;"><img width="424" height="81" style="cursor:pointer" alt="" src="<?php echo base_url();?>images/move_up.png"></a></p>
  </div>
</div>
</div>
</div>
<?php }?>
<!--8/10/2015 us added-->
<!--11/12/2015 new added by ujjwal sana-->
<?php if($totalMembersUnderMeNew > 9){?>
<div class="ppup_level">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_alert" title="Close"></a>
 
  <h2>Congratulations</h2>
  <h3>You have enough people to move up.</h3>
  <h4>Click "Move Up" to get access next level<br>
 </h4>
  <h5>Move to level 3</h5>
  <p class="termsCond">
    <input type="checkbox" id="termsCheck" class="ckbxe">
    <span>Terms & Conditions</span></p>
  <div class="switch_extrapara">
    <p class="swt_img"><a id="moveUp" href="javascript:;"><img width="424" height="81" style="cursor:pointer" alt="" src="<?php echo base_url();?>images/move_up.png"></a></p>
  </div>
</div>
</div>
</div>
<?php }?>
<!--11/12/2015-->
<?php $this->load->view("nav_header", "", $result); ?><!--this should be changed nav_header-->
<!--<div class="nav">sadasdasda

         <div class="clear"></div>

         </div>--> 

<!--ADDING COMMON FORM-->

<?php $this->load->view("commonform", "", $result); ?>


<div class="main_container_new"> 
  <!-- lefts side start -->
  
  <div class="lefts_side"> 
    
    <!--tab start-->
    
    <div class="tabsectionstep">
      <div class="containertab">
        <ul class="tabs">
          <li class="active"><a rel="tab1" href="javascript:void(0)" onclick="showFirstTab()">Step1<span>&nbsp;</span></a></li>
          <li><a  rel="tab2" href="javascript:void(0)" onclick="showSecondTab()">Step2<span>&nbsp;</span></a></li>
          <li><a rel="tab3" href="javascript:void(0)" onclick="showThirdTab()">Step3<span>&nbsp;</span></a></li>
          <li><a rel="tab4" href="javascript:void(0)" onclick="showForthTab()">Step4<span>&nbsp;</span></a></li>
          <li><a rel="tab5" href="javascript:void(0)" onclick="showFifthTab()">Give Karma<span>&nbsp;</span></a></li>
        </ul>
        <div class="tab_container" style="width:610px;">
         <!--step1 open-->
          <div class="tab_content search_event" id="tab1" style="display: block;">
          <!--  <div class="yvideo extra-pad">
             <span class="watch-thisvideo">Watch This Video</span>
             <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[1][1]["path"];?>" allowfullscreen=""></iframe>
            </div>-->
            <div class="yvideo extra-pad">
             <span class="watch-thisvideo"><?php echo $stepWiseVideo[1][1]["content_title"];?></span>
            <div class="palvidd" style="width:556px; height:320px;"><a href="javascript:void(0)" id="tutorial-video201"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[1][1]["content_image"];?>" width="573" height="320" alt="" /> </a></div>
             </div>
             
             
            <h3 class="headign-left"><?php echo $stepWiseVideo[1][1]["content"];?></h3>
            <div class="rarrow"><img src="<?php echo base_url(); ?>images/rarrow.png" border="0" alt=""  />
			</div>
            
            <div class="clear">
			</div>
            <div class="ab full"> 
           <!--Blog A start -->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["A"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["A"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1A" name="<?php echo $stepWiseVideo[1]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> 
			</div>
             <div class="white-space pp st1">
                 
                  <form enctype="multipart/form-data" action="<?php echo base_url();?>fullmembers/updateUserInfo" method="post" id="frm_new">
                   <h3 style="margin-bottom: 8px; padding-left:38px;"><?php echo $stepWiseVideo[1]["A"]["content"];?></h3>
                  	<input type="hidden" name="emailType" value="2">
                    <label><span> Add your skype ID </span>
                    <input type="text" value="<?php echo $userInfo[0]['skypeID'];?>" name="skypeID" id="skypeID">
                    </label>
                    <label> <span>Cell Number </span>
                      <input type="text" value="<?php echo $userInfo[0]['phone'];?>" name="phone" id="phone">
                    </label>
                    <label> <span>Email ID </span>
                      <input type="text" value="<?php echo $userInfo[0]['emailID'];?>" name="emailID" id="emailID">
                    </label>
                     <label> <span>Facebook/group </span>
                      <input type="text" value="<?php echo $userInfo[0]['facebookLink'];?>" name="facebookLink" id="facebookLink">
                    </label>
                    <label> <span>My Blogger </span>
                      <input type="text" value="<?php echo $userInfo[0]['myBlogger'];?>" name="myBlogger" id="myBlogger">
                    </label>
                    <label> <span>Twitter </span>
                      <input type="text" value="<?php echo $userInfo[0]['twitterLink'];?>" name="twitterLink" id="twitterLink">
                    </label>
                    <label> <span>Youtube </span>
                      <input type="text" value="<?php echo $userInfo[0]['youTubeUrl'];?>" name="youTubeUrl" id="youTubeUrl">
                    </label>
                    <label><span>Add Photo</span>
                      <input type="file" onchange="readURL(this);" value="Add photo" name="profile" class="brws">
                      <input type="hidden" name="tempImage" value="<?php echo $userInfo[0]['profile'];?>">
                     </label>
                    <label>
                    <div id="contact-image"><img alt="" src="<?php echo $this->config->item('gbe_base_url').'useruploads/'.$userInfo[0]['profile'];?>" id="empPic"></div>
                   <!-- <?php echo $this->config->item('gbe_base_url');?>.'useruploads/'.$userInfo[0]['profile'];?>-->
                    </label>
                    <label>
                    <!--<p style="float:left!important;width:350px!important">I agree to promote & celebrate Ravers Day on<br/> 
			  April 16th - each year.</p>-->
                    <input type="submit" style="float:right;" value="Update" name="update" id="updateID" class="extra-blue-btn">
                    <!-- <div class="clear">Content for  class "clear" Goes Here</div>-->
                    <div class="clear"></div>
                    </label>
                  </form>
             </div>
              <!--Blog A stop -->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["B"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["B"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1B" name="<?php echo $stepWiseVideo[1]["B"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> 
			 </div>
               <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[1]["B"]["content"];?></h3>
				  <br class="clear" />
                  <div class="upl_form"><?php //print_r($eventSearchData);exit;?>
                  <form id="prd_upld" method="post" action="<?php echo base_url();?>fullmembers/setEventSearch">
                  	<p><label class="pstlcd">Country</label>
                   <select id="country" name="country" onChange="getCity()">
                        <option value="">Select One </option>
                        <?php if(count($countryList) > 0){ 
                            foreach($countryList as $cl){
                                ?>
                        <option value="<?php echo $cl->country_id;?>" <?php if($cl->country_id == $eventSearchData["country"]){?> selected="selected" <?php }?>><?php echo $cl->name;?></option>
                        <?php }}?>
                      </select>
                  </p>
                  	<p class="search_city">
                  <label class="pstlcd">City</label>
                     <select id="city" name="city" onChange="getZipCode()">
                        <option value="">Select One </option>
                        <?php if(count($cityList) > 0){ 
                            foreach($cityList as $cl){
                                ?>
                        <option value="<?php echo $cl->id;?>" <?php if($cl->id == $eventSearchData["city"]){?> selected="selected" <?php }?>><?php echo $cl->city;?></option>
                        <?php }}?>
                      </select>
                 
                  		<span class="addcityclass" ><a href="javascript:void(0)" onClick="openCityAddCityDiv();"><em>Add city</em> </a></span> </p>
					  <div id="newCity" style="display:none;"><input type="text" name="newVendorCity" id="newVendorCity" placeholder="Add your City"> <div class="ad" onClick="addNewCity()"> Add</div><div class="can" onClick="closeNewCityDiv()">Cancel</div></div>
                                             
                  	<p class="search_zip">
                  <label class="pstlcd">Zip Code</label>
                     <select id="zip_code" name="zip_code">
                        <option value="">Select One </option>
                        <?php if(count($zipList) > 0){ 
                            foreach($zipList as $cl){
                                ?>
                        <option value="<?php echo $cl['id'];?>" <?php if($cl['id'] == $eventSearchData["zip_code"]){?> selected="selected" <?php }?>><?php echo $cl['zip_code'];?></option>
                        <?php }}?>
                      </select>                 
                  <span class="addcityclass" ><a href="javascript:void(0)" onClick="openZipAddZipDiv();"><em>Add Zip code</em> </a></span></p>
					  <div id="newZip" style="display:none;"><input type="text" name="newVendorZip" id="newVendorZip" placeholder="Add your Zip"> <div class="ad" onClick="addNewZip()"> Add</div><div class="can" onClick="closeNewZipDiv()">Cancel</div></div>
                  	<p>
                         <input type="submit" style="float:right;" value="Search" name="search" id="searchID" class="extra-blue-btn">
                         <input type="reset" value="Reset" id="resetSearch" onClick="resetForm()" class="extra-blue-btn1">
                        </p>
                  </form>
                  </div>
                </div>

              <div class="clear"></div>
              
              <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[1]["C"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["C"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1C" name="<?php echo $stepWiseVideo[1]["C"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> 
			  </div>
              
<!--             <div><img border="0" src="<?php echo $this->config->item('base_url').'images/calender.jpg'?>" alt="" style="width: 97.5%;"></div>-->
<!--8/10/2015 us add start-->
			<div class="table-status">
                <div class="eventBrdCmp">
                <?php if(is_array($searchEvBred) && $searchEvBred[0]->country_name != ''){?>
                <strong><?php echo $searchEvBred[0]->country_name;?> </strong>
	                <?php if($searchEvBred[0]->city_name != ''){?>
		                <strong>/ <?php echo $searchEvBred[0]->city_name;?> </strong>
		                <?php if($searchEvBred[0]->zip_code_name != ''){?>
		                	<strong>/ <?php echo $searchEvBred[0]->zip_code_name;?></strong>
		                <?php }?>
	                <?php }?>
                <?php }?>
                </div>
                
                <div class="event_tab_div">
                <a id="cal_current_month" href="javascript:void(0);" name="1" class="cal_event_tab">Current</a>
                <a id="cal_current_qtrly" href="javascript:void(0);" name="2" class="cal_event_tab">Quarterly</a>
                <a id="cal_current_yearly" href="javascript:void(0);" name="3" class="cal_event_tab">Yearly</a>
                 <a id="event_add" href="<?php echo base_url();?>event/add" class="cal_event_tab">+ Add Event</a>
                </div>
                
                <div class="cal_event_show">
                	<div class="all_month" id="all_month_id" style="display:none;">
						<?php if(isset($calendar['allMonth'])){ foreach($calendar['allMonth'] as $monthK => $monthV){?>
                        	<span id="all_month_id_<?php echo $monthK;?>" name="<?php echo $monthK;?>" class="singleMonth"><?php echo $monthV;?></span>
                        <?php }}?>
                    </div>
                    <div class="qtrly" id="qtrly_id" style="display:none;">
						<?php if(count($calendar['qtrly']) > 0){ foreach($calendar['qtrly'] as $qqq){?>
                            <?php if(isset($qqq)){ echo $qqq; }?>
                        <?php }}?>
                    </div>
                    <div class="month" id="month_id">
                    	<?php if(isset($calendar['current'])){ echo $calendar['current']; }?>
                    </div>
                    <?php if(count($calendar['yearly']) > 0){ foreach($calendar['yearly'] as $kkk=>$qqq){?>
                    	<div id="monthlyId_<?php echo $kkk;?>" class="monthlyClass" style="display:none;">
						<?php if(isset($qqq)){ echo $qqq; }?>
                        </div>
                    <?php }}?>
                </div>
                </div>
              <!--8/10/2015 us addd end-->
              <div class="clear"></div>
              
              <!--            <div class="ab_inner"><strong>d</strong><h3>Collect your Rave Business Kit</h3>-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["D"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["D"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1D" name="<?php echo $stepWiseVideo[1]["D"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
                  <div class="gal_se">
                    <ul>
                      <li><img src="<?php echo base_url();?>images/gal_01.png" alt="" >
                        <p>01</p>
                      </li>
                      <li><img src="<?php echo base_url();?>images/gal_02.png" alt="" >
                        <p>15</p>
                      </li>
                      <li><img src="<?php echo base_url();?>images/gal_03.png" alt="" >
                        <p>00</p>
                      </li>
                      <li><img src="<?php echo base_url();?>images/gal_04.png" alt="" >
                        <p>09</p>
                      </li>
                      <li><img src="<?php echo base_url();?>images/gal_05.png" alt="" >
                        <p>20</p>
                      </li>
                      <li><img src="<?php echo base_url();?>images/gal_06.png" alt="" >
                        <p>67</p>
                      </li>
                    </ul>
                  </div>
                </div>
           
           
              <div class="clear"></div>
              
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["E"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["E"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1E" name="<?php echo $stepWiseVideo[1]["E"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> 
				</div>
              <div class="white-space">
                  <div class="gal_se_agre">
                    <div class="agr_lft">
                      <?php echo $stepWiseVideo[1]["E"]["content"];?>
                      <a href="<?php echo base_url();?>fullmembers/sendAgrreEmail" class="r-blog">Agree</a></div>
                    <div class="img_agre"><img src="<?php echo base_url();?>images/agre.png" alt="" >
                      <p>01</p>
                    </div>
                    <br class="clear">
                  </div>
                </div>
              <br class="clear">
              
              
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["F"]["serial_field"];?> </strong>
                 <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["F"]["title"];?></h3>
                <span id="tutorial-video1F"><a class="watch-video-tut" name="<?php echo $stepWiseVideo[1]["F"]["path"];?>" id="tutorial-videoS5" href="javascript:void(0)">Watch Video</a></span> 
			</div>
              <p align="right"><a id="step2" href="javascript:void(0)" rel="tab2" onclick="showSecondTab()" style=" background:#1b75bc; border-radius: 5px; color: #fff;  font-size: 22px; padding: 10px;">Now Complete Step 2 ></a></p>
              <?php if($_REQUEST["replycc"]=="success"){?>
              <span class="err-succ">Successfully Inserted</span>
              <?php }?>
              <?php if($_REQUEST["replycc"]=="error"){?>
              <span class="err-notsucc">Due to some problem it can't updated! </span>
              <?php }?>
              
              <!--  <div id="pink-area" class="g_box g-extra">

                           <p>If you do NOT Live in the: </p><p> U.S.A,United Kingdom,Canada</p><p>Select your country & click Submit</p><p>for $5 bonuses.</p>--> 
              
              <!--<form id="formCountryCode" name="formCountryCode" method="post" action="<?php echo base_url().'/ravestorysociety/treasureChestCountryCode';?>" onsubmit="return valFormCountryCode()">--> 
              <!-- <form id="formCountryCode" name="formCountryCode" method="post" action="<?php echo base_url().'/gateway/rave_profile_pictureupload';?>" onsubmit="return valFormCountryCode()">


								<select name="country" id="country"> 

                                <?php if($result['chestCountryCode'][1] !=""){?>

                                <option value="<?php echo $result['chestCountryCode'][1];?>" selected="selected"><?php echo $result['chestCountryCode'][1];?></option>

                                <?php }else{?>

								<option value="0" selected="selected">Select Country</option>

                                <?php }?> 

								
								<option value="Zimbabwe">Zimbabwe</option>

								</select>

								<input name="freebies_submit" type="submit" name="submit" class="freebies-submitbtn02 extra-freebies" value="Submit"/></form>--> 
              
              <!--<?php if($_REQUEST["replycc"]=="success"){?><h6><center style="color:#FF0000">Successfully Inserted</center></h6><?php }?>

				          <?php if($_REQUEST["msg"]=="update_success"){?><h6><center style="color:#FF0000">Successfully Updated</center></h6><?php }?>

				          <?php if($_REQUEST["msg"]=="update_error"){?><h6><center style="color:#FF0000">Due to some problem it can't updated! Please try again later</center></h6><?php }?>                 <?php if($_REQUEST["replycc"]=="error"){?><h6><center style="color:#FF0000">Due to some problem data can't be inserted! Please try again later.</center></h6><?php }?>

                        </div>
--> 
              
              <!-- <form action="<?php echo base_url().'/ravestorysociety/addFreeBiesCode';?>" method="post">

               	<label>--> 
              
              <!--  <?php if($result["freeBiesCode"]!=0 && $result["person_status"]=="uk_person"){?>

						<h6>Your Freebies Url is Activated:

						<a href="<?php echo 'http://pearl.freetreasurechest.com/index.php?ref='.$result["freeBiesCode"];?>" class="redlink" target="_blank">
						<?php echo 'http://pearl.freetreasurechest.com/index.php?ref='.$result["freeBiesCode"];?>

						</a> 

						</h6>
				<?php }?>                

						</form>--> 
              <!--	<br class="clear" />
						<?php 
						if($_SESSION['UID'] == 1000){
						if(!empty($result["totalchild_admin_view"])){?>
						<div id="person_list" style="cursor:pointer; padding-left:40px;">Click to view List of person not belongs to US,Canada,UK</div>	

						<div class="fabs" id="plist" style="display:none";>

                        <h3>Non UK person</h3>	

						<p>

						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:20px; border:1px solid #ccc; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif; color:#000;">

						  <tr>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Name</td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Email</td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Total Child</td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Reset</td>

						  </tr>

						  <?php

						  	//print_r($result["totalchild_admin_view"]);

						  	foreach($result["totalchild_admin_view"] as $key=>$val){?>

						  <tr>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_name"];?></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_email"];?></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><div id="count_child_<?php echo $key;?>"><?php echo $val["total_child"];?></div></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">

							<div id="loader_<?php echo $key;?>" class="refreshimage">

							<img src="<?php echo base_url(); ?>images/reset.png" border="0" width="15" height="15" alt="" <?php if($val["total_child"]!=0){?>onclick="resetFreeBies('<?php echo $key;?>')" style="cursor:pointer;" <?php }?>>

							</div>

							</td>

						  </tr>

						  <?php }?>

						</table>

						</p>

						</div>

						<?php }

						}?>--> 
              </span> <br />
            </div>
            <br class="clear" />
            <?php 

						if($_SESSION['UID'] == 1000){

							if(!empty($result["totalchild_admin_view"])){?>
            <div id="person_list1" style="cursor:pointer; padding-left:40px;">Click to view List of person not belongs to US,Canada,UK</div>
            <div class="fabs" id="plist1" style="display:none";>
              <h3>Non UK person</h3>
              <p>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:20px; border:1px solid #ccc; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif; color:#000;">
                <tr>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Name</td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Email</td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Total Child</td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Reset</td>
                </tr>
                <?php

						  	//print_r($result["totalchild_admin_view"]);

						  	foreach($result["totalchild_admin_view"] as $key=>$val){?>
                <tr>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_name"];?></td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_email"];?></td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><div id="count_child_<?php echo $key;?>"><?php echo $val["total_child"];?></div></td>
                  <td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><div id="loader_<?php echo $key;?>" class="refreshimage"> <img src="<?php echo base_url(); ?>images/reset.png" border="0" width="15" height="15" alt="" <?php if($val["total_child"]!=0){?>onclick="resetFreeBies('<?php echo $key;?>')" style="cursor:pointer;" <?php }?>> </div></td>
                </tr>
                <?php }?>
              </table>
              </p>
            </div>
            <?php }	}?>
            
            <!--ab end--> 
            
          </div>
           <!--step1 close -->
          <!--step2 open
        <div class="tab_content tab-2" id="tab2" style="">-->
          <div class="tab_content tab-2" id="tab2" style="display: none;">
         <!-- <div class="yvideo extra-pad">
             <span class="watch-thisvideo">Watch This Video</span>
             <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[2][1]["path"];?>" allowfullscreen=""></iframe>
            </div>-->
            
            <div class="yvideo extra-pad">
             <span class="watch-thisvideo"><?php echo $stepWiseVideo[2][1]["content_title"];?></span>
            <div class="palvidd" style="width:556px; height:320px;"><a href="javascript:void(0)" id="tutorial-video202"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2][1]["content_image"];?>" width="573" height="320" alt="" /> </a></div>
             </div>
             
            <h3 class="headign-left"><?php echo $stepWiseVideo[2][1]["content"];?></h3>
            <div class="rarrow"><img src="<?php echo base_url(); ?>images/rarrow.png" border="0" alt=""  /></div>
            <div class="clear"></div>
            <div class="ab"> 
           
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["A"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["A"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2A" name="<?php echo $stepWiseVideo[2]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
             <p><?php echo $stepWiseVideo[2]["A"]["content"];?></p>
             <div class="ved"> 
                  <!--<span class="nxt"><img src="http://220.225.90.155/rave_store_socity/Application/content/member/images/next.png" /></span>
            <span class="prv"><img src="http://220.225.90.155/rave_store_socity/Application/content/member/images/prev.png" /></span>-->
                  <h4>Popular Uploads</h4>
                  <div class=" jcarousel-skin-tango">
                    <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;">
                      <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                        <ul class="jcarousel-list jcarousel-list-horizontal" id="mycarousel" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 1042px;">
                          <?php if(count($upYoutube) > 0): $i = 1;foreach($upYoutube as $vyt):?>
                          <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: outside none none;" jcarouselindex="1">
                            <iframe width="138" height="103" src="<?php echo $vyt->url;?>" frameborder="0" allowfullscreen></iframe>
                            <!--<h5>Dancing SuperStar </h5>--> 
                            <a class="share-btn" href="javascript:void(0)">Share</a> <a class="download-btn" id="copyUrl_<?php echo $i;?>" name="<?php echo $vyt->url;?>" href="javascript:void(0)">Copy</a>
                            <div class="clear"></div>
                            <div style="background-color:#fff; display:none" id="shareZone1" class="share-popup">
                              <ul id="logoZone" >
                                <li><a href="javascript:void(0)" id="button" onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $vyt->title;?>&amp;p[summary]=<?php echo $vyt->desc;?>&amp;p[url]=<?php echo urlencode($vyt->url); ?>', 'sharer', 'toolbar=0,status=0,width=550,height=400');" target="_parent"><img src="<?php echo base_url(); ?>images/facebook.png" border="0" /></a></li>
                                <li><a href="javascript:void(0)" onclick="window.open('http://twitter.com/share?text=<?php echo $vyt->title;?>&url=<?php echo urlencode($vyt->url); ?>', 'child', 'scrollbars,width=650,height=600'); return false"><img src="<?php echo base_url(); ?>images/twitter.png" border="0" /></a></li>
                                <li><a href="javascript:void(0)" onclick="window.open('https://plus.google.com/share?url=<?php echo urlencode($vyt->url); ?>&title=<?php echo $vyt->title;?>&caption=<?php echo $vyt->title;?>&description=<?php echo  $vyt->desc;?>', 'child', 'scrollbars,width=650,height=600'); return false"><img src="<?php echo base_url(); ?>images/google_plus.png" border="0" /></a></li>
                              </ul>
                            </div>
                          </li>
                          <?php endforeach;endif;?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="mod">
               
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["B"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["B"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2B" name="<?php echo $stepWiseVideo[2]["B"]["path"];?>" href="javascript:void(0)">Watch Video</a></span>
				</div>
              <div class="white-space">
                    <form action="<?php echo base_url();?>fullmembers/addYoutubeUrl" method="post">
                      <input type="hidden" name="show_for" value="up">
                      <input type="hidden" name="admin_approval" value="inactive">
                      <label>
                      <h6 style="width:auto;">Add Your Own Youtube Url</h6>
                      <input type="text" onblur="if(this.value == ''){this.value ='Enter youtube url'}" onfocus="if(this.value == 'Enter youtube url') {this.value=''}" class="extra-text" id="url_displayer_1" name="url" value="" placeholder="Enter youtube url">
                      <input type="submit" class="extra-blue-btn" name="url_displayer_btn" id="1" value="Add" >
                      </label>
                      <div class="clear"></div>
                    </form>
                  </div>
              <div class="clear"></div>
              

              <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["C"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["C"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2C" name="<?php echo $stepWiseVideo[2]["C"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
               <h2><?php echo $stepWiseVideo[2]["C"]["content"];?></h2>
              <div class="sec-b paragraph">
                    <div id="disp_cont">
                      <?php if(count($downYoutube) > 0): foreach($downYoutube as $vyt):?>
                      <p><a target="_blank" href="<?php echo $vyt->url;?>"><?php echo $vyt->url;?></a><br>
                      </p>
                      <?php endforeach;endif;?>
                      
                    </div>
             
                    <div class="clear"></div>
                  </div>
              
              <!--            <div class="ab_inner"><strong>d</strong><h3>Collect your Rave Business Kit</h3>-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["D"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["D"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2D" name="<?php echo $stepWiseVideo[2]["D"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
                    <form action="<?php echo base_url();?>fullmembers/addYoutubeUrl" method="post">
                      <input type="hidden" name="show_for" value="up">
                      <input type="hidden" name="admin_approval" value="inactive">
                      <label>
                      <h6 style="width:auto;">Add Your Own Youtube Url</h6>
                      <input type="text" onblur="if(this.value == ''){this.value ='Enter youtube url'}" onfocus="if(this.value == 'Enter youtube url') {this.value=''}" class="extra-text" id="url_displayer_1" name="url" value="" placeholder="Enter youtube url">
                      <input type="submit" class="extra-blue-btn" name="url_displayer_btn" id="1" value="Add" >
                      </label>
                      <div class="clear"></div>
                    </form>
                  </div>
              <div class="clear"></div>
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["E"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["E"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2E" name="<?php echo $stepWiseVideo[2]["E"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
             
              <br class="clear">
              <p align="right"><a id="step3" href="javascript:void(0)" rel="tab3" onclick="showThirdTab()" style=" background:#1b75bc; border-radius: 5px; color: #fff;  font-size: 22px; padding: 10px;">Now Complete Step 3 ></a></p>
              <?php if($_REQUEST["replycc"]=="success"){?>
              <span class="err-succ">Successfully Inserted</span>
              <?php }?>
              <?php if($_REQUEST["replycc"]=="error"){?>
              <span class="err-notsucc">Due to some problem it can't updated! </span>
              <?php }?>
              
              <!--  <div id="pink-area" class="g_box g-extra">

                           <p>If you do NOT Live in the: </p><p> U.S.A,United Kingdom,Canada</p><p>Select your country & click Submit</p><p>for $5 bonuses.</p>--> 
              
              <!--<form id="formCountryCode" name="formCountryCode" method="post" action="<?php echo base_url().'/ravestorysociety/treasureChestCountryCode';?>" onsubmit="return valFormCountryCode()">--> 
              <!-- <form id="formCountryCode" name="formCountryCode" method="post" action="<?php echo base_url().'/gateway/rave_profile_pictureupload';?>" onsubmit="return valFormCountryCode()">


								<select name="country" id="country"> 

                                <?php if($result['chestCountryCode'][1] !=""){?>

                                <option value="<?php echo $result['chestCountryCode'][1];?>" selected="selected"><?php echo $result['chestCountryCode'][1];?></option>

                                <?php }else{?>

								<option value="0" selected="selected">Select Country</option>

                                <?php }?> 

								
								<option value="Zimbabwe">Zimbabwe</option>

								</select>

								<input name="freebies_submit" type="submit" name="submit" class="freebies-submitbtn02 extra-freebies" value="Submit"/></form>--> 
              
              <!--<?php if($_REQUEST["replycc"]=="success"){?><h6><center style="color:#FF0000">Successfully Inserted</center></h6><?php }?>

				          <?php if($_REQUEST["msg"]=="update_success"){?><h6><center style="color:#FF0000">Successfully Updated</center></h6><?php }?>

				          <?php if($_REQUEST["msg"]=="update_error"){?><h6><center style="color:#FF0000">Due to some problem it can't updated! Please try again later</center></h6><?php }?>                 <?php if($_REQUEST["replycc"]=="error"){?><h6><center style="color:#FF0000">Due to some problem data can't be inserted! Please try again later.</center></h6><?php }?>

                        </div>
--> 
              
              <!-- <form action="<?php echo base_url().'/ravestorysociety/addFreeBiesCode';?>" method="post">

               	<label>--> 
              
              <!--  <?php if($result["freeBiesCode"]!=0 && $result["person_status"]=="uk_person"){?>

						<h6>Your Freebies Url is Activated:

						<a href="<?php echo 'http://pearl.freetreasurechest.com/index.php?ref='.$result["freeBiesCode"];?>" class="redlink" target="_blank">
						<?php echo 'http://pearl.freetreasurechest.com/index.php?ref='.$result["freeBiesCode"];?>

						</a> 

						</h6>
				<?php }?>                

						</form>--> 
              <!--	<br class="clear" />
						<?php 
						if($_SESSION['UID'] == 1000){
						if(!empty($result["totalchild_admin_view"])){?>
						<div id="person_list" style="cursor:pointer; padding-left:40px;">Click to view List of person not belongs to US,Canada,UK</div>	

						<div class="fabs" id="plist" style="display:none";>

                        <h3>Non UK person</h3>	

						<p>

						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:20px; border:1px solid #ccc; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif; color:#000;">

						  <tr>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Name</td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Email</td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Total Child</td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Reset</td>

						  </tr>

						  <?php

						  	//print_r($result["totalchild_admin_view"]);

						  	foreach($result["totalchild_admin_view"] as $key=>$val){?>

						  <tr>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_name"];?></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_email"];?></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><div id="count_child_<?php echo $key;?>"><?php echo $val["total_child"];?></div></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">

							<div id="loader_<?php echo $key;?>" class="refreshimage">

							<img src="<?php echo base_url(); ?>images/reset.png" border="0" width="15" height="15" alt="" <?php if($val["total_child"]!=0){?>onclick="resetFreeBies('<?php echo $key;?>')" style="cursor:pointer;" <?php }?>>

							</div>

							</td>

						  </tr>

						  <?php }?>

						</table>

						</p>

						</div>

						<?php }

						}?>--> 
              </span> <br />
            </div>
          </div>
          <!-- step2 close-->
          <!-- step3 open-->
          <div class="tab_content tab-3" id="tab3" style="display: none;">
           
         <!-- <div class="yvideo extra-pad">
             <span class="watch-thisvideo">Watch This Video</span>
             <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[3][1]["path"];?>" allowfullscreen=""></iframe>
            </div>-->
            <div class="yvideo extra-pad">
             <span class="watch-thisvideo"><?php echo $stepWiseVideo[3][1]["content_title"];?></span>
            <div class="palvidd" style="width:556px; height:320px;"><a href="javascript:void(0)" id="tutorial-video203"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[3][1]["content_image"];?>" width="573" height="320" alt="" /> </a></div>
             </div>
            <h3 class="headign-left"><?php echo $stepWiseVideo[3][1]["content"];?></h3>
            <div class="rarrow"><img src="<?php echo base_url(); ?>images/rarrow.png" border="0" alt=""  /></div>
            <div class="clear"></div>
            <div class="ab"> 
           
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[3]["A"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[3]["A"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video3A" name="<?php echo $stepWiseVideo[3]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
             <p style="margin-top:13px;"><?php echo $stepWiseVideo[3]["A"]["content"];?></p>
                <!--<a id="paiddmemberr" class="r-blog" href="<?php echo base_url();?>blog/<?php echo $userInfo[0]['userName'];?>">Rave Blogger</a>-->
             <a class="r-blog" href="<?php echo base_url();?>blog/index/<?php echo $userInfo[0]['uID'];?>" target="_block">CT BLOGS</a>
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[3]["B"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[3]["B"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video3B" name="<?php echo $stepWiseVideo[3]["B"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <table width="478px" border="0" style="margin: 0px auto 0px 41px;">
                  <tbody>
                    <?php if(count($allPost) > 0): foreach($allPost as $ap):
					if($ap->post_image!="")
					{
						$postImage = base_url().'useruploads/blogs/others/'.$ap->post_image;
						if(@getimagesize($postImage)){
							$displayImage= $postImage;
						}else{
							$displayImage=base_url().'images/no_image.jpg';
						}
					}
					else {
						$displayImage=base_url().'images/no_image.jpg';
					}
					?>
                    <tr><!--$this->config->item('gbe_base_url')-->
                      <!--<td class=""><img width="40" height="40" src="<?php echo $this->config->item('gbe_base_url');?>useruploads/<?php echo $ap->profile;?>" style=" height: 50px; margin: 5px !important; width: 50px;"></td>-->
                                            <td class=""><img width="40" height="40" src="<?php echo $displayImage;?>" style=" height: 50px; margin: 5px !important; width: 50px;"></td><td class="para"><p><?php echo $ap->post_title;?></p></td>
                      <td class="link"><a href="<?php echo base_url();?>fullmembers/copyPost/<?php echo $ap->post_id;?>">(Read &amp; Add)</a></td>
                    </tr>
                    <?php endforeach;else:?>
                    <tr>
                      <td class="para" colspan="3"><p>No Post Please..</p></td>
                    </tr>
                    <?php endif;?>
                  </tbody>
                </table>
                <br />
                <form action="<?php echo base_url();?>fullmembers/copyPostAdd" method="post" name="addPost" id="addPost" enctype="multipart/form-data">
                  <h3> Title of The Article </h3>
                  <p>
                    <input type="text" style="width:500px" value="<?php echo $post_title;?>" id="post_title_edit" name="post_title_edit" class="text_fild">
                  </p>
                  <br>
                  <h3> Read First, Correct &amp; Copy - Paste into Your Rave Blog</h3>
                  <p> <?php echo $this->ckeditor->editor('post_content_edit',$post_content);?>
                    <?php //echo form_error('post_content','<p class="error"></p>'); ?>
                  </p>
                  <br>
                   <h3> Add Image </h3>
                  <p>
                    
                    <input type="file" name="post_image" onchange="showCopyPostImage(this);" id="post_image_copy">
                    <?php if($post_image != ''){?>
                    <img id="post_image_copy_hide_id" src="<?php echo base_url();?>useruploads/blogs/others/<?php echo $post_image;?>" height="70" width="70">
                    <input type="hidden" name="tempImage" value="<?php echo $post_image;?>">
                    <?php }?>
                    <img src="" height="60" width="60" id="post_image_copy_show_id" style="display:none;">
                    <input type="submit" name="submitPost" value="Add Post" id="submitPostId" class="here">
                  </p>
                  <br>
                  <!--  
                 <h3> Post Category </h3>
                <p>
                  <select name="post_type_id">
                  <?php if(count($postCategoryList) > 0): foreach($postCategoryList as $pcl):?>
                  	<option value="<?php echo $pcl->term_id;?>"><?php echo $pcl->name;?></option>
                    <?php endforeach;endif;?>
                  </select>
                </p>
                <br>
                
                
                 <h3> Post Status </h3>
                <p>
                  <input type="radio" value="active" id="post_status" name="post_status" class="text_fild" checked>Active
                  <input type="radio" value="inactive" id="post_status" name="post_status" class="text_fild">Inactive
                </p>
                <br>
                 <h3> Comment Status </h3>
                <p>
                  <input type="radio" value="open" id="comment_status" name="comment_status" class="text_fild" checked>Open
                  <input type="radio" value="close" id="comment_status" name="comment_status" class="text_fild">Close
                </p>
                <br>-->
                  
                  <br>
                </form>
              <div class="clear"></div>
              <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[3]["C"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[3]["C"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video3C" name="<?php echo $stepWiseVideo[3]["C"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
             <p>Copy the url of your new completed blog  and ping it to other sites
             <a class="here" id="tutorial-video142">Here</a>
             <br class="clear">
                </p>
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[3]["D"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[3]["D"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video3D" name="<?php echo $stepWiseVideo[3]["D"]["path"];?>" href="javascript:void(0)">Watch Video</a></span>
				</div>
              <p><?php echo $stepWiseVideo[3]["D"]["content"];?></p>
                <p class="ad_pic_doc">
                <form action="<?php echo base_url();?>fullmembers/addPost" method="post" name="addPost" id="addPost" enctype="multipart/form-data">
                  <h3> Title of The Post </h3>
                  <p>
                    <input type="text" style="width:500px" value="" id="post_title" name="post_title" class="text_fild">
                  </p>
                  <br>
                  <h3> Content of The Post</h3>
                  <p> <?php echo $this->ckeditor->editor('post_content','');?>
                    <?php //echo form_error('post_content','<p class="error"></p>'); ?>
                  </p>
                  <br>
                   <h3> Add Image </h3>
                  <p>
                    
                    <input type="file" name="post_image" onchange="showAddPostImage(this);" id="post_image_copy">
                    <img src="" height="70" width="70" id="post_image_add_show_id" style="display:none;">
                    <input type="submit" name="submitPost" value="Add Post" id="submitPostAddId" class="here">
                  </p>
                  <br>
                </form>
                </p>
              <div class="clear"></div>
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[3]["E"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[3]["E"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video3E" name="<?php echo $stepWiseVideo[3]["E"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
             
              <br class="clear">
              <p align="right"><a id="step4" href="javascript:void(0)" rel="tab4" onclick="showForthTab()" style=" background:#1b75bc; border-radius: 5px; color: #fff;  font-size: 22px; padding: 10px;">Now Complete Step 4 ></a></p>
              <?php if($_REQUEST["replycc"]=="success"){?>
              <span class="err-succ">Successfully Inserted</span>
              <?php }?>
              <?php if($_REQUEST["replycc"]=="error"){?>
              <span class="err-notsucc">Due to some problem it can't updated! </span>
              <?php }?>
              
             
              
              <!--<form id="formCountryCode" name="formCountryCode" method="post" action="<?php echo base_url().'/ravestorysociety/treasureChestCountryCode';?>" onsubmit="return valFormCountryCode()">--> 
              <!-- <form id="formCountryCode" name="formCountryCode" method="post" action="<?php echo base_url().'/gateway/rave_profile_pictureupload';?>" onsubmit="return valFormCountryCode()">


								<select name="country" id="country"> 

                                <?php if($result['chestCountryCode'][1] !=""){?>

                                <option value="<?php echo $result['chestCountryCode'][1];?>" selected="selected"><?php echo $result['chestCountryCode'][1];?></option>

                                <?php }else{?>

								<option value="0" selected="selected">Select Country</option>

                                <?php }?> 

								
								<option value="Zimbabwe">Zimbabwe</option>

								</select>

								<input name="freebies_submit" type="submit" name="submit" class="freebies-submitbtn02 extra-freebies" value="Submit"/></form>--> 
              
              <!--<?php if($_REQUEST["replycc"]=="success"){?><h6><center style="color:#FF0000">Successfully Inserted</center></h6><?php }?>

				          <?php if($_REQUEST["msg"]=="update_success"){?><h6><center style="color:#FF0000">Successfully Updated</center></h6><?php }?>

				          <?php if($_REQUEST["msg"]=="update_error"){?><h6><center style="color:#FF0000">Due to some problem it can't updated! Please try again later</center></h6><?php }?>                 <?php if($_REQUEST["replycc"]=="error"){?><h6><center style="color:#FF0000">Due to some problem data can't be inserted! Please try again later.</center></h6><?php }?>

                        </div>
--> 
              
              <!-- <form action="<?php echo base_url().'/ravestorysociety/addFreeBiesCode';?>" method="post">

               	<label>--> 
              
              <!--  <?php if($result["freeBiesCode"]!=0 && $result["person_status"]=="uk_person"){?>

						<h6>Your Freebies Url is Activated:

						<a href="<?php echo 'http://pearl.freetreasurechest.com/index.php?ref='.$result["freeBiesCode"];?>" class="redlink" target="_blank">
						<?php echo 'http://pearl.freetreasurechest.com/index.php?ref='.$result["freeBiesCode"];?>

						</a> 

						</h6>
				<?php }?>                

						</form>--> 
              <!--	<br class="clear" />
						<?php 
						if($_SESSION['UID'] == 1000){
						if(!empty($result["totalchild_admin_view"])){?>
						<div id="person_list" style="cursor:pointer; padding-left:40px;">Click to view List of person not belongs to US,Canada,UK</div>	

						<div class="fabs" id="plist" style="display:none";>

                        <h3>Non UK person</h3>	

						<p>

						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:20px; border:1px solid #ccc; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif; color:#000;">

						  <tr>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Name</td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Email</td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Total Child</td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">Reset</td>

						  </tr>

						  <?php

						  	//print_r($result["totalchild_admin_view"]);

						  	foreach($result["totalchild_admin_view"] as $key=>$val){?>

						  <tr>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_name"];?></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_email"];?></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><div id="count_child_<?php echo $key;?>"><?php echo $val["total_child"];?></div></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">

							<div id="loader_<?php echo $key;?>" class="refreshimage">

							<img src="<?php echo base_url(); ?>images/reset.png" border="0" width="15" height="15" alt="" <?php if($val["total_child"]!=0){?>onclick="resetFreeBies('<?php echo $key;?>')" style="cursor:pointer;" <?php }?>>

							</div>

							</td>

						  </tr>

						  <?php }?>

						</table>

						</p>

						</div>

						<?php }

						}?>--> 
              </span> <br />
            
          </div> 
            
           
            <div class="clear"></div>
            
           </div>
           <!--step3 close->
          <!--step4 open-->
          <div class="tab_content tab-4" id="tab4" style="display: none;">
          
        <!--  <div class="yvideo extra-pad">
             <span class="watch-thisvideo">Watch This Video</span>
             <iframe width="573" height="320" frameborder="0" src="<?php echo $stepWiseVideo[4][1]["path"];?>" allowfullscreen=""></iframe>
            </div>-->
            <div class="yvideo extra-pad">
             <span class="watch-thisvideo"><?php echo $stepWiseVideo[4][1]["content_title"];?></span>
            <div class="palvidd" style="width:556px; height:320px;"><a href="javascript:void(0)" id="tutorial-video204"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[4][1]["content_image"];?>" width="573" height="320" alt="" /> </a></div>
             </div>
            <h3 class="headign-left"><?php echo $stepWiseVideo[4][1]["content"];?></h3>
            <div class="rarrow"><img src="<?php echo base_url(); ?>images/rarrow.png" border="0" alt=""  /></div>
            <div class="clear"></div>
            <div class="ab"> 
           
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["A"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[4]["A"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video4A" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
            <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[4]["A"]["content"];?></h3>
                  <ul class="twitter_user">
                    <?php if(count($brochure) > 0): foreach($brochure as $br):?>
                    <li>
                      <div><img width="103" height="76" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/brochureVcards/brochure/<?php echo $br->cover_img;?>"></div>
                      <div class="tpbb"> <a href="<?php echo base_url();?>fullmembers/downloadBrochure/<?php echo $br->file_name;?>" id="dwn">Download</a> </div>
                    </li>
                    <?php endforeach;else:?>
                    <li>No Brochure Please...</li>
                    <?php endif;?>
                  </ul>
                </div>
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["B"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[4]["B"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video4B" name="<?php echo $stepWiseVideo[4]["B"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
            <div class="white-space">
                  <h3 class="new_head"><?php echo $stepWiseVideo[4]["B"]["content"];?></h3>
                  <ul class="twitter_user">
                    <?php if(count($vcards) > 0): foreach($vcards as $vc):?>
                    <li>
                      <div><img width="103" height="76" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/brochureVcards/vcards/<?php echo $vc->cover_img;?>"> </div>
                      <div class="tpbb"><a href="<?php echo base_url();?>fullmembers/downloadVcards/<?php echo $vc->cover_img;?>" id="dwn">Download</a></div>
                    </li>
                    <?php endforeach;else:?>
                    <li>No Vcards Please...</li>
                    <?php endif;?>
                  </ul>
                </div>
               <br class="clear">
                <?php if($totalMembersUnderMe < 10){?>
                <div class="switch">
                  <h3 style="text-align:center;">Hi<br>
                    You need 10 members under you to switched on for next Level 3</h3>
                  <!--  <h2 style="text-align:center;">To step up for Level 3 </h2>adminuploads/brochureVcards/vcards/brochure
                  <h4 style="text-align:center;">Click Switch On To Pay</h4>-->
                  <div class="switch_extrapara"> 
                    <!--<p><strong>Inside You Can Enjoy</strong></p>
                    <ul class="list_extra">
                      <li>Powerful Marketing Tools To explode your Rave Business</li>
                      <li>Gifts, VIP &amp; Discounts to events</li>
                      <li>Personal Marketing suite.</li><br class="clear">
                    </ul>--> 
                    
                  </div>
                </div>
                <br class="clear">
                <?php }?>
             
              <?php if($_REQUEST["replycc"]=="success"){?>
              <span class="err-succ">Successfully Inserted</span>
              <?php }?>
              <?php if($_REQUEST["replycc"]=="error"){?>
              <span class="err-notsucc">Due to some problem it can't updated! </span>
              <?php }?>
              
             
              
              <!--<form id="formCountryCode" name="formCountryCode" method="post" action="<?php echo base_url().'/ravestorysociety/treasureChestCountryCode';?>" onsubmit="return valFormCountryCode()">--> 
              <!-- <form id="formCountryCode" name="formCountryCode" method="post" action="<?php echo base_url().'/gateway/rave_profile_pictureupload';?>" onsubmit="return valFormCountryCode()">


								<select name="country" id="country"> 

                                <?php if($result['chestCountryCode'][1] !=""){?>

                                <option value="<?php echo $result['chestCountryCode'][1];?>" selected="selected"><?php echo $result['chestCountryCode'][1];?></option>

                                <?php }else{?>

								<option value="0" selected="selected">Select Country</option>

                                <?php }?> 

								
								<option value="Zimbabwe">Zimbabwe</option>

								</select>

								<input name="freebies_submit" type="submit" name="submit" class="freebies-submitbtn02 extra-freebies" value="Submit"/></form>--> 
              
              <!--<?php if($_REQUEST["replycc"]=="success"){?><h6><center style="color:#FF0000">Successfully Inserted</center></h6><?php }?>

				          <?php if($_REQUEST["msg"]=="update_success"){?><h6><center style="color:#FF0000">Successfully Updated</center></h6><?php }?>

				          <?php if($_REQUEST["msg"]=="update_error"){?><h6><center style="color:#FF0000">Due to some problem it can't updated! Please try again later</center></h6><?php }?>                 <?php if($_REQUEST["replycc"]=="error"){?><h6><center style="color:#FF0000">Due to some problem data can't be inserted! Please try again later.</center></h6><?php }?>

                        </div>
--> 
              
              <!-- <form action="<?php echo base_url().'/ravestorysociety/addFreeBiesCode';?>" method="post">

               	<label>--> 
              
              <!--  <?php if($result["freeBiesCode"]!=0 && $result["person_status"]=="uk_person"){?>

						<h6>Your Freebies Url is Activated:

						<a href="<?php echo 'http://pearl.freetreasurechest.com/index.php?ref='.$result["freeBiesCode"];?>" class="redlink" target="_blank">
						<?php echo 'http://pearl.freetreasurechest.com/index.php?ref='.$result["freeBiesCode"];?>

						</a> 

						</h6>
				<?php }?>                

						</form>--> 
              <!--	<br class="clear" />
						<?php 
						if($_SESSION['UID'] == 1000){
						if(!empty($result["totalchild_admin_view"])){?>
						<div id="person_list" style="cursor:pointer; padding-left:40px;">Click to view List of person not belongs to US,Canada,UK</div>	

						

						  <?php

						  	//print_r($result["totalchild_admin_view"]);

						  	foreach($result["totalchild_admin_view"] as $key=>$val){?>

						  <tr>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_name"];?></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><?php echo $val["parent_email"];?></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;"><div id="count_child_<?php echo $key;?>"><?php echo $val["total_child"];?></div></td>

							<td align="center" valign="top" style="border:1px solid #ccc; background:#fff; width:auto; color:#000; padding:0; margin:0; font:normal 12px/18px Verdana, Arial, Helvetica, sans-serif;">

							<div id="loader_<?php echo $key;?>" class="refreshimage">

							<img src="<?php echo base_url(); ?>images/reset.png" border="0" width="15" height="15" alt="" <?php if($val["total_child"]!=0){?>onclick="resetFreeBies('<?php echo $key;?>')" style="cursor:pointer;" <?php }?>>

							</div>

							</td>

						  </tr>

						  <?php }?>

						</table>

						</p>

						</div>

						<?php }

						}?>--> 
              </span> <br />          		
          </div> 
            
            <div class="clear"></div>
           
          </div>
          <!--step4 stop--> 
		   <!-- step5 open added by SB on 28-04-2016-->
          <div class="tab_content tab-5" id="tab5" style="display: none;">
        <div class="yvideo extra-pad">
             <span class="watch-thisvideo"><?php echo $stepWiseVideo[4][1]["content_title"];?></span>
            <div class="palvidd" style="width:556px; height:320px;"><a href="javascript:void(0)" id="tutorial-video204"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[4][1]["content_image"];?>" width="573" height="320" alt="" /> </a></div>
            <div class="givekarma-content">
            <img alt="" src="<?php echo base_url();?>images/karma-thum.jpg">
           <div class="content-right"> 
           <p><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</strong><br />
Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
           <label>
          <span> Make a </span>
           <select name="">
           <option>one-time</option>
           </select>
           <span>donation</span>
           </label>
           <p>€52 - Provides 28kg of fibre glass mesh, enough for a small</p>
           <label>
                   <input type="submit" class="extra-blue-btn" id="updateID" name="update" value="Give Now">
                    </label>
           </div><br class="clear" />
            <div class="givekarma-content">
           <img alt="" src="<?php echo base_url();?>images/karma-thum.jpg">
<div class="content-right"> 
           <p><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</strong><br />
Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
          <p class="help"> <span>How You Can Help :</span> <a href="#"><img alt="" src="<?php echo base_url();?>images/help-icon.png"></a> </p><br />

          <br class="clear" />
           <label>
          <span> Make a </span>
           <select name="">
           <option>one-time</option>
           </select>
           <span>donation</span>
           </label>
           <label><input name="" type="radio" value="" /> €52 - Provides 28kg of fibre glass mesh, enough for a small</label>
           <label><input name="" type="radio" value="" /> €52 - Provides 28kg of fibre glass mesh, enough for a small </label>
           <label><input name="" type="radio" value="" /> €52 - Provides 28kg of fibre glass mesh, enough for a small </label>
           <label><input name="" type="radio" value="" /> € <input name="" type="text" /> Other amount </label>
           <label class="gift"><input type="submit" class="extra-blue-btn" id="updateID" name="update" value="Give Now">
           <img alt="" src="<?php echo base_url();?>images/gift_box.png"> or give as a gift in honor/in  memory of someone
           </label>
           </div>
           </div>
            </div>
             </div>
		  </div>
			<!-- step5 Close-->
        </div>
      </div>
    </div>
    
    <!-- tab end--> 
    
  </div>
   <!-- right side tab start--> 
  <?php $this->load->view("right_panel", "", $result); ?>
  
  <!-- rights side end -->
  
<div class="clear"></div>
</div>
<!-- 15/09/2015 ujjwal sana -->
<!--footer style--> 

<script type="text/javascript">
var postImage = "<?php echo count($result['getFbPictureUpload']); ?>";

var countBanner = "<?php echo count($result['showUserBanner']); ?>";

var postYoutube = "<?php echo count($result['getYoutubeUrlLink']); ?>";


$(document).ready(function() {
	//Default Action
	//11/09/2015 done by ujjwal sana
	 var tabId = '<?php echo $openTabId;?>';
	
	 if(tabId=="tab4")
	 {	
	 	showForthTab();
	 }else if(tabId=="tab3")
	 {
		 showThirdTab();
	 }	
	 else if(tabId=="tab2")
	 {
		 showSecondTab();
	 }
	 else if(tabId=="tab5")// added by SB on 28/04/2016
	 {
		 showFifthTab();
	 }
	else
	{
		showFirstTab();
	
	}

	//On Click Event

	$("ul.tabs li").click(function(e) {

		for(var k=0;k<postYoutube;k++){		

		$('a#postYoutube'+k).zclip({			

			path:'<?php echo base_url(); ?>/Application/content/member/js/ZeroClipboard.swf',			

			copy:$('input#youtube'+k).val(),

			beforeCopy:function(){

			    $('input#youtube'+k).css('background','yellow');

				$(this).css('color','orange');

			},

			afterCopy:function(){

			    $('input#youtube'+k).css('background','green');

				$(this).css('color','white');

				$(this).next('.check').show();

			}

		});

	}
		$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$(this).addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("rel"); //Find the rel attribute value to identify the active tab + content

		//alert(activeTab);

		$('#'+activeTab).fadeIn(); //Fade in the active content

		e.preventDefault();

		//return false;

	});
});
function showFirstTab()
{
	$("#analytics").show();
		$(".webbox1").hide();
		$(".tab_content").hide(); //Hide all content
		$("ul.tabs li:first").addClass("active").show(); //Activate first tab
		//$("ul.tabs li:nth-child(3)").addClass("active");
		$(".tab_content:first").show(); //Show first tab content
}

function showSecondTab(){

		$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		$("#analytics").show();
		$(".webbox1").hide();
		$("#tab2").fadeIn(); //Fade in the active content

		return false;

}
function showThirdTab(){

		$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(3)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content
		$("#analytics").show();
		$(".webbox1").hide();
		$("#tab3").fadeIn(); //Fade in the active content

		return false;

}
function showForthTab(){
	
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$("ul.tabs li:nth-child(4)").addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide();
		$(".webbox1").hide(); //Hide all tab content
		$("#tab4").fadeIn(); //Fade in the active content
		//$("#tab4").show();
		return false;

}
// added by SB on 28/04/2016
function showFifthTab(){
	
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$("ul.tabs li:nth-child(5)").addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide();
		$(".webbox1").hide(); //Hide all tab content
		$("#tab5").fadeIn(); //Fade in the active content
		//$("#tab4").show();
		return false;

}
function valFormCountryCode(){

	if($("#country").val() == "0"){

		alert("Please select country before submission");

		return false;	

	}else{

		return true;

	}
}
$(document).ready(function() {

	$("#gmailContact").click(function(){

		$("#gmail_yahoo_user").val('');

		$("#gmail_yahoo_pwd").val('');

		$("#gmail_yahoo_user").attr('placeholder','Enter Your Gmail Id');

		$("#gmail_yahoo_pwd").attr('placeholder','Enter Your Gmail Password');

		$("#gmail_yahoo_flag").val('gmail');

	});

	$("#yahooContact").click(function(){

		$("#gmail_yahoo_user").val('');

		$("#gmail_yahoo_pwd").val('');

		$("#gmail_yahoo_user").attr('placeholder','Enter Your Yahoo Id');

		$("#gmail_yahoo_pwd").attr('placeholder','Enter Your Yahoo Password');

		$("#gmail_yahoo_flag").val('yahoo');

	});

	//repeat above step

	$("#gmailContactRadio").click(function(){

		$("#gmail_yahoo_user").val('');

		$("#gmail_yahoo_pwd").val('');

		$("#gmail_yahoo_user").attr('placeholder','Enter Your Gmail Id');

		$("#gmail_yahoo_pwd").attr('placeholder','Enter Your Gmail Password');

		$("#gmail_yahoo_flag").val('gmail');

	});

	$("#yahooContactRadio").click(function(){

		$("#gmail_yahoo_user").val('');

		$("#gmail_yahoo_pwd").val('');

		$("#gmail_yahoo_user").attr('placeholder','Enter Your Yahoo Id');

		$("#gmail_yahoo_pwd").attr('placeholder','Enter Your Yahoo Password');

		$("#gmail_yahoo_flag").val('yahoo');

	});

	//end repeat

	/*$("#getNames").click(function() {

		$.fancybox.open('<?php for($i=0;$i<count($result['getNamesUID']);$i++){?><li><?php echo $result['getNamesUID'][$i]['FirstName']."&nbsp;".$result['getNamesUID'][$i]['LastName']; ?></li><?php }?>');

	});

	$("#tutorial-video1A").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/PuehFznvJUY?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video1").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/QtNQi_xKbwk?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video2").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/pZuT6raA3UQ?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video3").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/G-9NluGYpWg?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video4").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/cThsfY1zqUc?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video5").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/z6kG-TKjUzE?autoplay=1"  frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video6").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/KoUxlvQYE3c?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video7").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/tX3vzehrmn0?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video8").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/fqZvPKfX2lE?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video9").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/GHoNI_pcLuU?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video10").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/EaC2L9iu9QE?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video11").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/FzeTSC2igzo?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video12").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/uFwpnTKQk0Q?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video13").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/mmxZBcCovSo?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video141").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/Y6Sd9G78ufA?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video142").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/Hn4jqzYUHN8?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video150").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/8QwOi4-fHyo?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video151").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/dJf4snUP-Is?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video152").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/WyqzLyRPHWM?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video153").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/jRd1GGlze9E?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video154").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/Ns2LiV-xXpY?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video15").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/s4YS7eDZDg8?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video16").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/pr4_JoYxj4Y?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video17").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/sto_jKuT8lc?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video18").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/zfAuX6a_V5w?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video19").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/0AozfWahm3g?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#tutorial-video20").click(function() {

		$.fancybox.open('<iframe width="660" height="415" src="//www.youtube.com/embed/pvAjhTn8ntI?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});*/

	

	$("#fancybox-contact").click(function() {

	    var userid = $.trim($("#gmail_yahoo_user").val());

		var pwd    = $.trim($("#gmail_yahoo_pwd").val());

		var type   = $("#gmail_yahoo_flag").val();

		//alert(userid);

		//alert(pwd);

		//alert(type);

		if(type=='yahoo'){

			$.fancybox.open($("#cont").css("display","block"));

			$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

			$.ajax({

				type: "POST",

				data: "userid="+userid+"&pwd="+pwd,

				url: "<?php echo base_url(); ?>/ravestorysociety/getYahooContact",

				success: function(data) {

					//alert(data);

					$.fancybox.open($("#cont").css("display","block"));

					$.fancybox.open($("#cont").html(data));

				}

			});	

		}

		if(type=='gmail'){

			$.fancybox.open("demo");

			$.fancybox.open($("#cont").css("display","block"));

			$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

			$.ajax({

				type: "POST",

				data: "userid="+userid+"&pwd="+pwd,

				url: "<?php echo base_url(); ?>/ravestorysociety/getGmailContact",

				success: function(data) {

					/*alert(1111);

					alert(data);*/

					$.fancybox.open($("#cont").css("display","block"));

					$.fancybox.open($("#cont").html(data));

				}

			});	

		}

		//$.fancybox.open($("#cont").css("display","block"));

	});	

});



$(document).ready(function() {

	$("#person_list").click(function(){

		$("#plist").slideToggle();

	})	

});



$(document).ready(function() {

	$("#person_list1").click(function(){

		$("#plist1").slideToggle();

	})	

});
function funToggleSupport(id){
	var myArray = id.split('_');
	//alert(myArray);
	$("#slist_"+myArray[1]).slideToggle();
}


function resetFreeBies(uid){

	if(confirm("Are you sure you want to reset?")){

	 $("#loader_"+uid).html('<img src="<?php echo base_url(); ?>/Application/content/member/images/loader.gif" />');	

		$.ajax({

			type: "POST",

			data: "uid="+uid,

			url: "<?php echo base_url(); ?>/ravestorysociety/updateFreebiesStatus",

			success: function(data) {

				if(data=="success"){

					$("#count_child_"+uid).html(0);

					$("#loader_"+uid).html('<img src="<?php echo base_url(); ?>/Application/content/member/images/reset.png" width="15" height="15" />');

				}

			}

		});	

	}

}

$(document).ready(function() {
	
	$(".share-btn").click(function(e){

		$(this).parent().find('.share-popup').fadeIn(1000);

	 }); 

	$(".share-btn").blur(function(e){

		$(this).parent().find('.share-popup').fadeOut(1000);

	});
	jQuery('#mycarousel').jcarousel();
	});	

</script>
<?php 

      if( $_REQUEST["action"] == "gmailContactImport"){

		  $arr = json_decode($_REQUEST["contactList"]);

		  

		  $str="";

          $str.="<form name=\"frm\" method=\"post\" action=\"".base_url()."/ravestorysociety/sendEmailToContactList\">";

          $str.="<input type=\"checkbox\" name=\"select_all\" id=\"selectall\" > Select ALL <br>";

		  foreach ($arr as $key=>$val){

	        foreach($val as $eml){

				//$val2 = $arr["gmailContactList"][$key];

				$str.="<input type=\"checkbox\" name=\"email_id[]\" class=\"case\" value=\"$eml\"> ".$eml."<br>";

			}

          }

         $str.="<input type=\"hidden\" name=\"reffer_id\" value=\"".$_SESSION['UID']."\">";

         $str.="<input type=\"hidden\" name=\"sender_email\" value=\"".$_REQUEST['userid']."\">";

         $str.="<input type=\"submit\" name=\"send_mail\" value=\"submit\">";

         $str.="</form>";
?>
<script>  

      $(document).ready(function() {

	  	$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		$("#tab2").fadeIn(); //Fade in the active content

		

		loadGmailContactRes();

	  });

	  

	  function loadGmailContactRes(){

		$.fancybox.open("demo");

		$.fancybox.open($("#cont").css("display","block"));

		$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

		

		$.fancybox.open($("#cont").css("display","block"));

		$.fancybox.open($("#cont").html('<?php echo $str;?>'));

	  }

      </script> 
<script language="javascript">

$(document).ready(function() {

	// add multiple select / deselect functionality

    $("#selectall").click(function () {

          $('.case').attr('checked', this.checked);

    });

 

    // if all checkbox are selected, check the selectall checkbox

    // and viceversa

    $(".case").click(function(){

 

        if($(".case").length == $(".case:checked").length) {

            $("#selectall").attr("checked", "checked");

        } else {

            $("#selectall").removeAttr("checked");

        }

 

    });

	

});

</script>
<?php 

	  }

?>
<?php 

      if( $_REQUEST["action"] == "yahooContactImport"){

		  $arr = json_decode($_REQUEST["contactList"]);

		  //print_r($arr);

		  $str="";

          $str.="<form name=\"frm\" method=\"post\" action=\"".base_url()."/ravestorysociety/sendEmailToContactList\">";

          $str.="<input type=\"checkbox\" name=\"select_all\" id=\"selectall\" > Select ALL <br>";

		  foreach ($arr as $key=>$val){

	        $str.="<input type=\"checkbox\" name=\"email_id[]\" class=\"case\" value=\"$eml\"> ".$val."<br>";

		  }

          $str.="<input type=\"hidden\" name=\"reffer_id\" value=\"".$_SESSION['UID']."\">";

          $str.="<input type=\"hidden\" name=\"sender_email\" value=\"".$_REQUEST['userid']."\">";

          $str.="<input type=\"submit\" name=\"send_mail\" value=\"submit\">";

          $str.="</form>";

        

?>
<script>  

      $(document).ready(function() {

	  	$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		$("#tab2").fadeIn(); //Fade in the active content

		

		loadGmailContactRes();

	  });

	  

	  function loadGmailContactRes(){

		$.fancybox.open("demo");

		$.fancybox.open($("#cont").css("display","block"));

		$.fancybox.open($("#cont").html('<img src="<?php echo base_url(); ?>/Application/content/member/images/ajax-loader.gif" />'));

		

		$.fancybox.open($("#cont").css("display","block"));

		$.fancybox.open($("#cont").html('<?php echo $str;?>'));

	  }

      </script> 

<?php 

	  }

?>
