
<?php if( $parentInfo[0]["paypalAC"] =="" ){
  $parentInfo[0]["paypalAC"] = "paytestevika-facilitator@gmail.com";
   }
?>
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

function siwtchOnPayment(){ 
	
	var balanceInCA = Number(<?php echo $balanceInCA[0]->commAmt;?>);
	
	if(balanceInCA < 49.99){
		$.fancybox.open('<p style="text-align:center" margin:10px 0;>You have insufficient fund in your account. Do you want to top up your account to upgrade your account.<br>Then please click on the top up button.<br><br><a href="<?php echo base_url();?>currentaccount/topUp" class="topup" >Top Up</a></p>');
	}else{
		//window.location.href='<?php echo base_url();?>gbe_payment/switchOn'; // blocked by Sb on 25/09/2015
		window.location.href='<?php echo base_url();?>gbe_payment/switchOn/1'; // parameter set to use switchon for all levels  Added by S on 25/09/2015
		return true;
	}
}
</script>
<script>
function readURL_ct(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
         $('#empPic_ct').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
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
function downloadVideo(video_id){
	$.fancybox.open('<img src="<?php echo base_url();?>images/ajax-loader.gif" />');
	$.ajax({
			type: "POST",
			data: "video_id="+video_id,
			url: "<?php echo base_url();?>dashboard/downloadVideo",
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
 //alert("++++++"+pageMode+"==============="+$("#typeOfProduct").val());
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

 function ct_readURL(input){
	if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function (e){
         $('#ct_empPic').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
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
	 //new added for monetizer 27-01-2016
	   $("#Music_catID").change(function() {
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedCatId =$("#Music_catID").val();
		if(selectedCatId>0){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/getArticleList/1", 
			 data: "Music_catId="+selectedCatId,
			 cache:false,
			 success: 
				  function(data){					
					if(data)
					{	
						$("#Music_articleID option").remove();
						$("#Music_productTypeID option").remove();						
						$('#Music_articleID').append(data);					
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
	 // added by SB on 01/03/2016
	 $("#profileCountry").change(function() {
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedCountryId =$("#profileCountry").val();
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
						$("#city1 option").remove();									
						$('#city1').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
	 });
	 
	 //new added for monetizer 27/01/2016
	  $("#Music_articleID").change(function() {
		//alert();
		//alert('==selcet val---'+$("#categoryList").val()) ;
		var selectedArtId =$("#Music_articleID").val();
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
						
						$("#Music_productTypeID option").remove();				
						$('#Music_productTypeID').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
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
	 //--------------------------

	 $('#start_date').datetimepicker({
		timepicker:false,
		value:'<?php if(isset($setVal['start_date'])){ echo $setVal['start_date'];} ?>',
		format:'Y-m-d'
	});
	
	$('#end_date').datetimepicker({
		timepicker:false,
		value:'<?php if(isset($setVal['end_date'])){ echo $setVal['end_date'];} ?>',
		format:'Y-m-d'
	});
	
	
	
		 
});


	
</script>
<script>
// ticket start date end date added by SB on 17/02/2016	
  $(function() {
       // $('#ticketStartDate').datepicker({dateFormat: "yy-mm-dd"});
			
		 $('#ticketStartDate').datetimepicker({
			timepicker:false,			
			format:'Y-m-d'
		});
		 $('#ticketEndDate').datetimepicker({
			timepicker:false,
			format:'Y-m-d'
		});
			//$('#ticketEndDate').datepicker({dateFormat: "yy-mm-dd"});
		 $('#topEventDate').datetimepicker({
			timepicker:false,
			format:'Y-m-d'
		});
		//$('#topEventDate').datepicker({dateFormat: "yy-mm-dd"});// meetup event date added by SB on 18/02/2016
    });
	
	
function getCity(){
	var selectedCountryId = Number($('#country_id').val());
	if(selectedCountryId > 0){
		$.post('<?php echo base_url();?>event/getCity',{ c_id: selectedCountryId})
		.done(function(data){
			var res = $.parseJSON(data);
			$('#city_id').html(res.result);
			$('#zip_code_id').html('<option value="">Select One </option>');
		});
	}
}

function getZipCode(){
	var selectedCityId = Number($('#city_id').val());
	if(selectedCityId > 0){
		$.post('<?php echo base_url();?>event/getZipCode',{ c_id: selectedCityId})
		.done(function(data){
			var res = $.parseJSON(data);
			$('#zip_code_id').html(res.result);
		});
	}
}
function openZipAddZipDiv(){
	 $('#newZip').css('display','block');
}
function closeNewZipDiv(){
	$('#newVendorZip').val('');
	$('#newZip').css('display','none');
}
function addNewZip(){
	 var cityId =$('#city_id').val();
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
					$.fancybox.open('Zip code added Successfully');
					$('#newVendorZip').val('');
					$('#newZip').css('display','none');
					$("#zip_code_id option").remove();									
					$('#zip_code_id').append(data.zipList);					
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
function CT_EreadURL(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
		$('#image_path_img_id').show();
		$('#image_path_img_id').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}

</script>

<!--<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>-->
<script type='text/javascript' src='<?php echo base_url(); ?>js/custom_common.js'></script>
<script type="text/javascript">
jQuery(document).ready(function($){	
 $('.close_btn_level').click(function(){
	 	$('.ppup_level').remove();
	 });
	
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

});
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.zclip.js"></script>
<script type="text/javascript">
//$(document).ready(function(e) {
    <?php foreach( $htmlBanners as $key=>$val){?> 
	
	document.getElementById("bannerCopy<?php echo $htmlBanners[$key]["id"];?>").addEventListener("click", function() {
		alert('did stuff #1');
    copyToClipboardMsg(document.getElementById("bannerUrl<?php echo $htmlBanners[$key]["id"];?>"));
});
	
	
	
/*	$('a#bannerCopy'+<?php echo $htmlBanners[$key]["id"];?>).click( function(){alert('ff2');}).zclip({ 
			path:'<?php echo base_url();?>js/ZeroClipboard.swf',			
			copy:$('input#bannerUrl'+<?php echo $htmlBanners[$key]["id"];?>).val(),
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
	});*/
	
	
<?php } ?>
//});

jQuery(function ($) {
	// Load dialog on click
	$("#tutorial-video101").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 //30-10-2015 added by ujjwal sana	 
		 
		 $("#tutorial-video1").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][AA]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video1A").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][A]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video1b").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][B]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video1c").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][C]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video1d").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][D]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#tutorial-video1e").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][E]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#tutorial-video1f").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][F]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#tutorial-videoSG").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][G]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 
		 
		 $("#tutorial-video102").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 //30/10/2015 added by ujjwal sana
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
		 $("#tutorial-video2F").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][F]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video2G").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][G]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video2H").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][H]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video2I").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][I]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video2J").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][J]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video2K").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][K]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video2L").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[2][L]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 
		 
		 $("#tutorial-video103").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[3][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 //30/10/2015 added by ujjwal sana 
         $("#tutorial-video-v-add").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][A]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#watch-video-tut4B").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][B]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#watch-video-tut4C").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][C]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#watch-video-tut4D").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][D]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		  $("#watch-video-tut4E").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][E]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 
		 // moneIntro video mone_intro_video_id
		 $("#mone_intro_video_id").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $mone_into_video[0]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
	$('.clickopen').click(function () {
            $(this).next().slideToggle("slow");
	});
        
        /* expell functionality */
        
        
    /*end*/
	
	/* $("#vdoLinkDivId1").click(function(){
			$("#video1")[0].src += "&autoplay=1";
			$(this).unbind("click");//or some other way to make sure that this only happens once
			});*/
	
});
// // added by SB 
/*function playVideoLink(videoLinkToPlay){
     $.fancybox.open('<iframe width="660" height="415" src="'+videoLinkToPlay+'?autoplay=1" data-autoplay-src="'+videoLinkToPlay+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');			
} */
	
// 8/9/2015 done by ujjwal sana
 function openCityAddCityDiv(){
	 //alert('show');
	 $('#newCity').css('display','block');
	// alert($('#country').val()+'====='+$('#newVendorCity').val());
 }
 function addNewCity(){
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
				   alert(data);  //as a debugging message					
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
 function City_addNewCity(){
	var selectedCountryId = Number($('#country_id').val());
	 var newCityName = $('#CT_newVendorCity').val();
	 //alert(selectedCountryId);
	 if(selectedCountryId > 0 && newCityName!=''){
		$.ajax({
		 type: "POST",
		 url:  "<?php echo base_url();?>dashboard/addNewCity", 
		 data: "countryId="+selectedCountryId+"&newCityName="+newCityName,
		 cache:false,
		 dataType: "json",
		 success: 
			  function(data){	
				if(data.success == "yes"){	
					$('#CT_newVendorCity').val('');
					$('#City_newCity').css('display','none');
					$("#city_id option").remove();	
					$('#city_id').append(data.cityList);
					$('#zip_code_id').html('<option value="">Select One </option>');								
					$.fancybox.open('City added Successfully');				
				}else{
					$.fancybox.open(data.message);
				}
			  }
		  });
	}else{
		if(selectedCountryId == ''){
			$.fancybox.open('Please select the Country.');
		}else if(newCityName == ''){
			$.fancybox.open('Please enter the City.');
		}
	}
	}
 function CT_openCityAddCityDiv(){
	 //alert('show');
	 $('#CT_newCity').css('display','block');
	// alert($('#country').val()+'====='+$('#newVendorCity').val());
 }
 function city_openCityAddCityDiv(){
	$('#City_newCity').show();
}
  function CT_addNewCity(){
	// $('#newCity').css('display','none');
	 //alert($('#country').val()+'====='+$('#newVendorCity').val());
	 var selectedCountryId =$('#profileCountry').val();
	 var newCityName = $('#newVendorCity1').val();
	 //alert(newCityName);
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
						$('#newVendorCity1').val('');
						$('#CT_newCity').css('display','none');
						$("#city1 option").remove();									
						$('#city1').append(data.cityList);					
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
	$('#CT_newCity').css('display','none');//for ct dashboard
	$('#City_newCity').css('display','none');
	
 }

var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";
</script>
 <script src="<?php echo base_url();?>js/jquery.slides.min.js"></script>
   <script>
    $(function() {
      $('#slides').slidesjs({
        width: 540,
        height: 220,
		 play: {
          active: true,
          auto: true,
          interval: 4000,
          swap: true
        }
      });
    }); 
  </script>
<?php 

     if( $result["ProfileImage"] != ""){

?>
<style>
input[type=file] {
	width:90px;
	color:transparent;
}
   /* Prevent the slideshow from flashing on load */
    #slides {
     position:relative;
    }

    /* Center the slideshow */
    .container {
      margin: 0 auto
    }

    /* Show active item in the pagination */
    .slidesjs-pagination .active {
      color:red;
    }

    /* Media quires for a responsive layout */
    .slidesjs-previous.slidesjs-navigation, .slidesjs-next.slidesjs-navigation,   .slidesjs-stop.slidesjs-navigation, .slidesjs-play.slidesjs-navigation{display:none !important;}
   .slidesjs-pagination{position:absolute; bottom:9px; left:21px;}
   .slidesjs-pagination-item {
    float: left;
    position: relative;
    z-index: 99999;
    width:12px; height:12px; background:#fff; border:1px solid #5b626c;
    margin-right:12px; font-size:12px; line-height:12px !important; color:#fff !important;
}
.slidesjs-pagination a{color:#fff !important;}
.slidesjs-pagination a.active{background:#e5082e; display:block; width:12px; height:12px; padding:0; cursor:pointer; color:red !important;}
</style>
<?php 

    }

?>
<!--11/12/2015 new added by ujjwal sana-->
<?php if($totalMembersUnderMeNew > 4){?>
<div class="ppup_level">
<div class="ppup_inr">
<div id="levelup_alert" class="switch mov_up"><a href="javascript:;" class="close_btn_level" title="Close"></a>
  <h2>Congratulations</h2>
  <h3>You have enough people to move up.</h3>
  <h4>Click "Move Up" to get access next level<br>
 </h4>
  <h5>Move to level 2 </h5>
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
<?php }?>
<?php $this->load->view("nav_header", "", $result); ?>

<!--<div class="nav">sadasdasda

         <div class="clear"></div>

         </div>--> 

<!--ADDING COMMON FORM-->

<?php $this->load->view("commonform", "", $result); ?>

<!--END OF ADDING COMMON FORM--> 

<!-- header end --> 

<!-- main container start -->

<div class="main_container_new ddsh"> 
  
  <!-- lefts side start -->
  
  <div class="lefts_side"> 
    
    <!--tab start-->
    
    <div class="tabsectionstep">
      <div class="containertab">
        <ul class="tabs">
		<?php if($ct_url) {?>
		<li class="active"><a rel="tab6" href="javascript:void(0)" onclick="showMonetizerTab()"><?php echo $tab6Name;?><span>&nbsp;</span></a></li>
		<?php } ?>
          <li class="active"><a rel="tab1" href="javascript:void(0)" onclick="showFirstTab()">Step1<span>&nbsp;</span></a></li>
          <li><a  rel="tab2" href="javascript:void(0)" onclick="showSecondTab()">Step2<span>&nbsp;</span></a></li>
          <li><a rel="tab3" href="javascript:void(0)" onclick="showThirdTab()">Step3<span>&nbsp;</span></a></li>
		 <?php if($userInfo[0]["afrooPaymentStatus"] > 0) {?>
			<li id="tab44"><a rel="tab4" href="javascript:void(0)" onclick="showProdict_UploadTab()">Product Upload<span>&nbsp;</span></a></li>
		 <?php } else {?>
					<li id="tab5"><a rel="tab5" href="javascript:void(0)" onclick="no_permission()">Product Upload<span>&nbsp;</span></a></li>
		 <?php }?>
        </ul>
        <div class="tab_container" style="width:610px;">
          <div class="tab_content" id="tab1" style="display: block;">
          
            <div class="yvideo extra-pad">
            <span class="watch-thisvideo"><?php echo $stepWiseVideo[1][1]["content_title"];?></span>
            <div class="palvidd" style="width:540px; height:320px; margin:0 auto;"><a href="javascript:void(0)" id="tutorial-video101"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[1][1]["content_image"];?>" width="527" height="320" alt="" /> </a></div>
             </div>
          
            <h3 class="headign-left" style="padding-left:50px;"><?php echo $stepWiseVideo[1][1]["content"];?></h3>
            <div class="rarrow"><img src="<?php echo base_url(); ?>images/rarrow.png" border="0" alt=""  /></div>
            
            <div class="clear"></div>
            <div class="ab_inner gresd"><strong><?php //echo $stepWiseVideo[1]["AA"]["serial_field"];?> </strong>
                  <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["AA"]["title"];?></h3>
                  <span><a class="watch-video-tut" id="tutorial-video1" name="<?php echo $stepWiseVideo[1]["AA"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
               <div class="white-space mreetng"> <img class="nobor kk" width="422" height="180" alt="" src="<?php echo base_url().'adminuploads/level_wise_images/'.$stepWiseVideo[1]["AA"]["content_image"];?>" style=" display:block; margin:auto;"  /> <h3>Think<br>Big</h3></div>
            <div class="ab"> 
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["A"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["A"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1A" name="<?php echo $stepWiseVideo[1]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space pp"> <img class="nobor kk" width="190" height="139" alt="" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[1]["A"]["content_image"];?>" style=" display:block; margin:auto;"  /> </div>
              
              <br class="clear" />
              
              <!--         	<div class="ab_inner sing"><strong>B</strong>
            <h3>Add Your Picture</h3><span><a href="javascript:void(0)" id="tutorial-video1" class="watch-video-tut">Watch Video</a></span></div>-->
              
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["B"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["B"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1b" name="<?php echo $stepWiseVideo[1]["B"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space pp"> <img class="nobor kk" style=" display:block; margin:auto;" width="250" height="157" alt="" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[1]["B"]["content_image"];?>"  /> </div>
              
              <!-- 25/08/2015 done by ujjwal sana --> 
              
              <!--  <div class="load">
			  
            <p style="margin-bottom:26px;">Add your profile picture to your Rave Story Website</p>
		
                 <div class="your-pic"> 
                 <?php foreach($list as $pic){ ?>
                 <?php if ($pic->profile == ""){?>
                   <?php echo $pic->profile; ?>
                 <img id="empPic" style="margin-right:25px;" src="<?php echo base_url();?>useruploads/member_img.png"  width="70" height="70" alt="">
                   <?php } ?>
                   <?php } ?>
                <?php foreach($list as $pic){ ?>
                 <img id="empPic" style="margin-right:25px;" src="<?php echo $this->config->item('gbe_base_url');?>useruploads/<?php echo $pic->profile;?>"  width="70" height="70" alt="">
                   <?php } ?>
                    <form enctype="multipart/form-data" action="<?php echo base_url();?>dashboard/profilePicUpload" method="post" class="rday">
                      <label style="display: block; clear: both;">
                      <input type="file" onchange="readURL(this);" name="user_file" id="file">
                      <input type="submit" class="submit-bnt"  name="update" value="update"  >
                      <div class="clear"></div>
                      </label>
                    </form>
                  </div>  
           
            </div> -->
              
              <div class="clear"></div>
              <!--   <div class="ab_inner sing"><strong>c</strong><h3>we will pay you here</h3>-->
              
              <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[1]["C"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["C"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1c" name="<?php echo $stepWiseVideo[1]["C"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              
              <!--<span><a href="javascript:void(0)" id="tutorial-video2" class="watch-video-tut">Watch Video</a></span></div>-->
              <div class="white-space">
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
              
              <!-- <p>Enter Your Paypal ID,This is where we will pay your money.</p><br />



            <form id="form1" name="form1" method="post" action="<?php echo base_url().'/ravestorysociety/freetrial';?>">

              <p>

                <label><a href="https://www.paypal.com/" target="_blank"><img src="<?php echo base_url();?>images/paypal.png" class="pic-none" style="margin-top:4px !important;" /></a></label>

               

             </p>

              <label style="float: right; margin:0px 20px 0 0;">

              <input type="text" value="<?php echo $result["memberPaypalID"];?>" name="user_paypal_name">

 				<input type="submit" name="user_paypal_submit" style="float:left; margin-top:2px;" class="extra-blue-btn" value=""></label>

                <div class="clear"></div>
            </form>-->
              
              <div class="clear"></div>
              
              <!--            <div class="ab_inner"><strong>d</strong><h3>Collect your Rave Business Kit</h3>-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["D"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["D"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1d" name="<?php echo $stepWiseVideo[1]["D"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="load">
                <div class="your-pic">
                  <?php foreach($list as $pic){ ?>
                  <?php if ($pic->profile == ""){?>
                  <?php echo $pic->profile; ?> <img id="empPic" style="margin-right:25px;" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg"  width="70" height="70" alt="">
                  <?php } ?>
                  <?php if ($pic->profile != ""){?>
                  <img id="empPic" style="margin-right:25px;" src="<?php echo $this->config->item('gbe_base_url');?>useruploads/<?php echo $pic->profile;?>"  width="70" height="70" alt="">
                  <?php } ?>
                  <?php } ?>
                  <p style="margin-bottom: 26px; float: left; width: 360px;" ><?php echo $stepWiseVideo[1]["D"]["content"];?> </p>
                  <form enctype="multipart/form-data" action="<?php echo base_url();?>dashboard/profilePicUpload" method="post" class="rday">
                    <label style="display: block; clear: both;">
                    <input type="file" onchange="readURL(this);" name="user_file" id="file">
                    <input type="submit" class="submit-bnt"  name="update" value="update"  >
                    <div class="clear"></div>
                    </label>
                  </form>
                </div>
              </div>
              <!--     <div class="white-space"> 
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
                      <div class="prcbutt"><a href="javascript:void(0)" class="pricbuy" onclick="window.location.href='<?php echo base_url();?>gbe_payment/catalog/<?php echo $afro->id;?>'">Buy It Now</a></div>
                    </div>
                    <?php } } ?>
                  </div>
                  </div>--> 
              <!--				 <span><a href="javascript:void(0)" id="tutorial-video1A" class="watch-video-tut">Watch Video</a></span></div>

				 <span class="stt2" style="margin: 0 0 0 40px; padding: 0;"><span style="float: left; font-weight: bold; margin: 39px 0 0;"> -Click On Paypal button to pay $25</span><img src="http://"<?php echo base_url();?>"/ravestorysociety/Application/content/member/images/TenPaypal.png" style="cursor:pointer;border:none; float:right; margin:0;" onclick="window.location.href='http://"<?php echo base_url();?>"/ravestorysociety/paypalTenDollarPayment/parallelpayment.php?parentPaypalID=<?php echo $_SESSION['PARENT_PAYPAL_ACCOUNT'][0];?>&uid=<?php echo $_SESSION['UID'];?>'"/> </span>-->
              <div class="clear"></div>
              
              <!--            <div class="ab_inner"><strong>E</strong><h3>Select The Country Where You Live</h3>

                <span><a href="javascript:void(0)" id="tutorial-video16" class="watch-video-tut">Watch Video</a></span></div>-->
              
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["E"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["E"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1e" name="<?php echo $stepWiseVideo[1]["E"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
                <p style="margin-bottom: 30px;"><?php echo $stepWiseVideo[1]["E"]["content"];?></p>
                <form action="<?php echo base_url();?>dashboard/userPaypalUpdate" method="post" name="form1" id="form1">
                  <label><a target="_blank" href="https://www.paypal.com/"><img class="nobor" src="<?php echo base_url(); ?>images/paypal.png" width="116" height="30" alt=""></a></label>
                  <label>
                    <input type="text" name="user_paypal_name" value="<?php echo $userInfo[0]["paypalAC"];?>" >
                    <input type="submit" value="submit" class="extra-blue-btn"  name="user_paypal_submit">
                  </label>
                  <div class="clear"></div>
                </form>
              </div>
              <br class="clear">
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["F"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["F"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video1f" name="<?php echo $stepWiseVideo[1]["F"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
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
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[1]["G"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[1]["G"]["title"];?></h3>
                <span id="passCh"><a class="watch-video-tut1" name="<?php echo $stepWiseVideo[1]["G"]["path"];?>" id="tutorial-videoSG" href="javascript:void(0)">Watch Video</a></span> </div>
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

								<option value="Afghanistan">Afghanistan</option> 

								<option value="Albania">Albania</option> 

								<option value="Algeria">Algeria</option> 

								<option value="American Samoa">American Samoa</option> 

								<option value="Andorra">Andorra</option> 

								<option value="Angola">Angola</option> 

								<option value="Anguilla">Anguilla</option> 

								<option value="Antarctica">Antarctica</option> 

								<option value="Antigua and Barbuda">Antigua and Barbuda</option> 

								<option value="Argentina">Argentina</option> 

								<option value="Armenia">Armenia</option> 

								<option value="Aruba">Aruba</option> 

								<option value="Australia">Australia</option> 

								<option value="Austria">Austria</option> 

								<option value="Azerbaijan">Azerbaijan</option> 

								<option value="Bahamas">Bahamas</option> 

								<option value="Bahrain">Bahrain</option> 

								<option value="Bangladesh">Bangladesh</option> 

								<option value="Barbados">Barbados</option> 

								<option value="Belarus">Belarus</option> 

								<option value="Belgium">Belgium</option> 

								<option value="Belize">Belize</option> 

								<option value="Benin">Benin</option> 

								<option value="Bermuda">Bermuda</option> 

								<option value="Bhutan">Bhutan</option> 

								<option value="Bolivia">Bolivia</option> 

								<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 

								<option value="Botswana">Botswana</option> 

								<option value="Bouvet Island">Bouvet Island</option> 

								<option value="Brazil">Brazil</option> 

								<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 

								<option value="Brunei Darussalam">Brunei Darussalam</option> 

								<option value="Bulgaria">Bulgaria</option> 

								<option value="Burkina Faso">Burkina Faso</option> 

								<option value="Burundi">Burundi</option> 

								<option value="Cambodia">Cambodia</option> 

								<option value="Cameroon">Cameroon</option> 

								<option value="Cape Verde">Cape Verde</option> 

								<option value="Cayman Islands">Cayman Islands</option> 

								<option value="Central African Republic">Central African Republic</option> 

								<option value="Chad">Chad</option> 

								<option value="Chile">Chile</option> 

								<option value="China">China</option> 

								<option value="Christmas Island">Christmas Island</option> 

								<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 

								<option value="Colombia">Colombia</option> 

								<option value="Comoros">Comoros</option> 

								<option value="Congo">Congo</option> 

								<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 

								<option value="Cook Islands">Cook Islands</option> 

								<option value="Costa Rica">Costa Rica</option> 

								<option value="Cote D'ivoire">Cote D'ivoire</option> 

								<option value="Croatia">Croatia</option> 

								<option value="Cuba">Cuba</option> 

								<option value="Cyprus">Cyprus</option> 

								<option value="Czech Republic">Czech Republic</option> 

								<option value="Denmark">Denmark</option> 

								<option value="Djibouti">Djibouti</option> 

								<option value="Dominica">Dominica</option> 

								<option value="Dominican Republic">Dominican Republic</option> 

								<option value="Ecuador">Ecuador</option> 

								<option value="Egypt">Egypt</option> 



								<option value="El Salvador">El Salvador</option> 

								<option value="Equatorial Guinea">Equatorial Guinea</option> 

								<option value="Eritrea">Eritrea</option> 

								<option value="Estonia">Estonia</option> 

								<option value="Ethiopia">Ethiopia</option> 

								<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 

								<option value="Faroe Islands">Faroe Islands</option> 

								<option value="Fiji">Fiji</option> 

								<option value="Finland">Finland</option> 

								<option value="France">France</option> 

								<option value="French Guiana">French Guiana</option> 

								<option value="French Polynesia">French Polynesia</option> 

								<option value="French Southern Territories">French Southern Territories</option> 

								<option value="Gabon">Gabon</option> 

								<option value="Gambia">Gambia</option> 

								<option value="Georgia">Georgia</option> 

								<option value="Germany">Germany</option> 

								<option value="Ghana">Ghana</option> 

								<option value="Gibraltar">Gibraltar</option> 

								<option value="Greece">Greece</option> 

								<option value="Greenland">Greenland</option> 

								<option value="Grenada">Grenada</option> 

								<option value="Guadeloupe">Guadeloupe</option> 

								<option value="Guam">Guam</option> 

								<option value="Guatemala">Guatemala</option> 

								<option value="Guinea">Guinea</option> 

								<option value="Guinea-bissau">Guinea-bissau</option> 

								<option value="Guyana">Guyana</option> 

								<option value="Haiti">Haiti</option> 

								<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 

								<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 

								<option value="Honduras">Honduras</option> 

								<option value="Hong Kong">Hong Kong</option> 

								<option value="Hungary">Hungary</option> 

								<option value="Iceland">Iceland</option> 

								<option value="India">India</option> 

								<option value="Indonesia">Indonesia</option> 

								<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 

								<option value="Iraq">Iraq</option> 

								<option value="Ireland">Ireland</option> 

								<option value="Israel">Israel</option> 

								<option value="Italy">Italy</option> 

								<option value="Jamaica">Jamaica</option> 

								<option value="Japan">Japan</option> 

								<option value="Jordan">Jordan</option> 

								<option value="Kazakhstan">Kazakhstan</option> 

								<option value="Kenya">Kenya</option> 

								<option value="Kiribati">Kiribati</option> 

								<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 

								<option value="Korea, Republic of">Korea, Republic of</option> 

								<option value="Kuwait">Kuwait</option> 

								<option value="Kyrgyzstan">Kyrgyzstan</option> 

								<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 

								<option value="Latvia">Latvia</option> 

								<option value="Lebanon">Lebanon</option> 

								<option value="Lesotho">Lesotho</option> 

								<option value="Liberia">Liberia</option> 

								<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 

								<option value="Liechtenstein">Liechtenstein</option> 

								<option value="Lithuania">Lithuania</option> 

								<option value="Luxembourg">Luxembourg</option> 

								<option value="Macao">Macao</option> 

								<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 

								<option value="Madagascar">Madagascar</option> 

								<option value="Malawi">Malawi</option> 

								<option value="Malaysia">Malaysia</option> 

								<option value="Maldives">Maldives</option> 

								<option value="Mali">Mali</option> 

								<option value="Malta">Malta</option> 

								<option value="Marshall Islands">Marshall Islands</option> 

								<option value="Martinique">Martinique</option> 

								<option value="Mauritania">Mauritania</option> 

								<option value="Mauritius">Mauritius</option> 

								<option value="Mayotte">Mayotte</option> 

								<option value="Mexico">Mexico</option> 

								<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 

								<option value="Moldova, Republic of">Moldova, Republic of</option> 

								<option value="Monaco">Monaco</option> 

								<option value="Mongolia">Mongolia</option> 

								<option value="Montserrat">Montserrat</option> 

								<option value="Morocco">Morocco</option> 

								<option value="Mozambique">Mozambique</option> 

								<option value="Myanmar">Myanmar</option> 

								<option value="Namibia">Namibia</option> 

								<option value="Nauru">Nauru</option> 

								<option value="Nepal">Nepal</option> 

								<option value="Netherlands">Netherlands</option> 

								<option value="Netherlands Antilles">Netherlands Antilles</option> 

								<option value="New Caledonia">New Caledonia</option> 

								<option value="New Zealand">New Zealand</option> 

								<option value="Nicaragua">Nicaragua</option> 

								<option value="Niger">Niger</option> 

								<option value="Nigeria">Nigeria</option> 

								<option value="Niue">Niue</option> 

								<option value="Norfolk Island">Norfolk Island</option> 

								<option value="Northern Mariana Islands">Northern Mariana Islands</option> 

								<option value="Norway">Norway</option> 

								<option value="Oman">Oman</option> 

								<option value="Pakistan">Pakistan</option> 

								<option value="Palau">Palau</option> 

								<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 

								<option value="Panama">Panama</option> 

								<option value="Papua New Guinea">Papua New Guinea</option> 

								<option value="Paraguay">Paraguay</option> 

								<option value="Peru">Peru</option> 

								<option value="Philippines">Philippines</option> 

								<option value="Pitcairn">Pitcairn</option> 

								<option value="Poland">Poland</option> 

								<option value="Portugal">Portugal</option> 

								<option value="Puerto Rico">Puerto Rico</option> 

								<option value="Qatar">Qatar</option> 

								<option value="Reunion">Reunion</option> 

								<option value="Romania">Romania</option> 

								<option value="Russian Federation">Russian Federation</option> 

								<option value="Rwanda">Rwanda</option> 

								<option value="Saint Helena">Saint Helena</option> 

								<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 

								<option value="Saint Lucia">Saint Lucia</option> 

								<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 

								<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 

								<option value="Samoa">Samoa</option> 

								<option value="San Marino">San Marino</option> 

								<option value="Sao Tome and Principe">Sao Tome and Principe</option> 

								<option value="Saudi Arabia">Saudi Arabia</option> 

								<option value="Senegal">Senegal</option> 

								<option value="Serbia and Montenegro">Serbia and Montenegro</option> 

								<option value="Seychelles">Seychelles</option> 

								<option value="Sierra Leone">Sierra Leone</option> 

								<option value="Singapore">Singapore</option> 

								<option value="Slovakia">Slovakia</option> 

								<option value="Slovenia">Slovenia</option> 

								<option value="Solomon Islands">Solomon Islands</option> 

								<option value="Somalia">Somalia</option> 

								<option value="South Africa">South Africa</option> 

								<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 

								<option value="Spain">Spain</option> 

								<option value="Sri Lanka">Sri Lanka</option> 

								<option value="Sudan">Sudan</option> 

								<option value="Suriname">Suriname</option> 

								<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 

								<option value="Swaziland">Swaziland</option> 

								<option value="Sweden">Sweden</option> 

								<option value="Switzerland">Switzerland</option> 

								<option value="Syrian Arab Republic">Syrian Arab Republic</option> 

								<option value="Taiwan, Province of China">Taiwan, Province of China</option> 

								<option value="Tajikistan">Tajikistan</option> 

								<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 

								<option value="Thailand">Thailand</option> 

								<option value="Timor-leste">Timor-leste</option> 

								<option value="Togo">Togo</option> 

								<option value="Tokelau">Tokelau</option> 

								<option value="Tonga">Tonga</option> 

								<option value="Trinidad and Tobago">Trinidad and Tobago</option> 

								<option value="Tunisia">Tunisia</option> 

								<option value="Turkey">Turkey</option> 

								<option value="Turkmenistan">Turkmenistan</option> 

								<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 

								<option value="Tuvalu">Tuvalu</option> 

								<option value="Uganda">Uganda</option> 

								<option value="Ukraine">Ukraine</option> 

								<option value="United Arab Emirates">United Arab Emirates</option> 

								<!--<option value="United Kingdom">United Kingdom</option> 

								<option value="United States">United States</option>

								<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 

								<option value="Uruguay">Uruguay</option> 

								<option value="Uzbekistan">Uzbekistan</option> 

								<option value="Vanuatu">Vanuatu</option> 

								<option value="Venezuela">Venezuela</option> 

								<option value="Viet Nam">Viet Nam</option> 

								<option value="Virgin Islands, British">Virgin Islands, British</option> 

								<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 

								<option value="Wallis and Futuna">Wallis and Futuna</option> 

								<option value="Western Sahara">Western Sahara</option> 

								<option value="Yemen">Yemen</option> 

								<option value="Zambia">Zambia</option> 

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
            <?php }

						}?>
            
            <!--ab end--> 
            
          </div>
          <!--step2 open
        <div class="tab_content tab-2" id="tab2" style="">-->
          <div class="tab_content tab-2" id="tab2" style="display: none;">
          
           <div class="yvideo extra-pad">
            <span class="watch-thisvideo"><?php echo $stepWiseVideo[1][1]["content_title"];?></span>
            <div class="palvidd" style="width:540px; height:320px; margin:0 auto;"><a href="javascript:void(0)" id="tutorial-video102"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2][1]["content_image"];?>" width="527" height="320" alt="" /> </a></div>
             </div>
                      
            <!--    <h3 class="headign-left">Start Making Money Now!<br />
Follow The Instructions Below &<br />
 Invite People To Join Your Rave Business 

</h3><div class="rarrow"><img src="<?php echo base_url(); ?>images/rarrow.png" border="0" alt=""  /></div>-->
            
            <h3 class="headign-left" style="padding-left:50px;"><?php echo $stepWiseVideo[2][1]["content"];?></h3>
            <div class="rarrow"><img src="<?php echo base_url(); ?>images/rarrow.png" border="0" alt=""  /></div>
            <div class="clear"></div>
            <div>
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["A"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["A"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2A" name="<?php echo $stepWiseVideo[2]["A"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <!--body-->
              <div class="white-space">
                <h3 class="new_head"><?php echo $stepWiseVideo[2]["A"]["content_title"];?></h3>
                <p><?php echo $stepWiseVideo[2][1]["content"];?></p>
                <div id="cont" style="display:none;">Lorem ipsum </div>
                <div class="website-icon"> <a href="<?php echo $url['gmail'];?>" target="_blank" style="font-size:25px;font-weight:bold;"><img class="nobor" src="<?php echo base_url(); ?>images/gmail.png" width="95" height="70" alt=""></a> <a href="<?php echo $url['yahoo'];?>" target="_blank"><img class="nobor" src="<?php echo base_url(); ?>images/yahoo.png" width="114" height="70" alt=""></a> </div>
              </div>
              <!--br class="clear" /-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["B"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["B"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2B" name="<?php echo $stepWiseVideo[2]["B"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              
              <!-- 25/08/2015 done by ujjwal sana --> 
              <!--body-->
              <div class="white-space">
                <div class="clickopen"> <?php echo $stepWiseVideo[2]["B"]["content_title"];?> </div>
                <div class="clk_pr_inv">
				 <ul>
                  <?php 
                    if(count($step2Url) > 0):
                        foreach ($step2Url as $s2e):
                    ?>
					<li><a href="<?php echo $s2e->url;?><?php echo $userInfo[0]['uID'];?>" target="_blank"><?php echo $s2e->title;?></a></li>
                  <?php 
                        endforeach;  
                    endif;
                    ?>
					<li><a href="<?php echo base_url();?>dashboard/CT_catalog/<?php echo $userInfo[0]['userName'];?>" target="_blank">CT PRODUCT</a></li>
					</ul>
                </div>
				<!--this part for testing-->				
				 <div class="togclk" style="display:none;"> 
                    
                      <a href="<?php echo $s2e->url;?>"><?php echo $s2e->title;?></a> 
                   
                      </div>
              </div>
               <br class="clear">
               <!-- <div class="ab_inner sing"><strong>c</strong><h3>we will pay you here</h3>-->
              
              <div class="ab_inner sing"><strong><?php echo $stepWiseVideo[2]["C"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["C"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2C" name="<?php echo $stepWiseVideo[2]["C"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              
              <!--<span><a href="javascript:void(0)" id="tutorial-video2" class="watch-video-tut">Watch Video</a></span></div>--> 
              <!--body-->
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
                    
                    <!--user video -->
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
             <!--  <div class="clear"></div>
              
                         <div class="ab_inner"><strong>d</strong><h3>Collect your Rave Business Kit</h3>-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["D"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["D"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2D" name="<?php echo $stepWiseVideo[2]["D"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
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
              <!--div class="clear"></div-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["E"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["E"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2E" name="<?php echo $stepWiseVideo[2]["E"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
                <div class="extra-share">
                  <div class="share-text">
                    <h3 class="new_head"><?php echo $stepWiseVideo[2]["E"]["content_title"];?></h3>
                    <p><?php echo $stepWiseVideo[2]["E"]["content"];?></p>
                     <div>asasas</div>
                  </div>
                  <div class="share-pic"><img class="share-none" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["E"]["content_image"];?>"></div>
                 
                  <div class="clear"></div>
                </div>
              </div>
              <!--div class="clear"></div-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["F"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["F"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2F" name="<?php echo $stepWiseVideo[2]["F"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
                <h3 class="new_head"><?php echo $stepWiseVideo[2]["F"]["content_title"];?></h3>
                <p><?php echo $stepWiseVideo[2]["E"]["content"];?></p>
                <ul class="twitter_user">
                  <?php foreach ( $userAdverts as $key=>$val){?>
                               
                  <li>
                    <div><a href="#"> <img width="103" height="76" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/advert/<?php echo $userAdverts[$key]["advertImg"]?>"></a> </div>
                    <div class="tpbb"><a id="copyAdvert<?php echo $userAdverts[$key]["advertID"]?>" href="javascript:void(0)" class="">Copy</a></div>
                    <div class="tptt"><a href="<?php echo base_url();?>dashboard/downloadAdverts/?img=<?php echo $userAdverts[$key]["advertImg"]?>">Download</a></div>
                    <input type="hidden" value="<?php echo base_url();?>adminuploads/advert/<?php echo $userAdverts[$key]["advertImg"]?>" name="advertUrl<?php echo $userAdverts[$key]["advertID"]?>" id="advertUrl<?php echo $userAdverts[$key]["advertID"]?>">
                  </li>
                  <?php } ?>
                </ul>
              </div>
              <!--div class="clear"></div-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["G"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["G"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2G" name="<?php echo $stepWiseVideo[2]["G"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
                <div class="extra-share">
                  <div class="share-text">
                    <h3 class="new_head"><?php echo $stepWiseVideo[2]["G"]["content_title"];?></h3>
                    <p><?php echo $stepWiseVideo[2]["G"]["content"];?></p>
                    <h3 id="dwn-pdf"><a target="_blank" href="<?php echo base_url();?>dashboard/downloadAdverts/?img=ravestorysociety-chapter1.pdf">Click to Download PDF</a></h3>
                  </div>
                  <div class="share-pic"><img class="share-none" width="106" height="150" src="<?php echo base_url(); ?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[2]["G"]["content_image"];?>"></div>
                  <div class="clear"></div>
                </div>
              </div>
              <!--div class="clear"></div-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["H"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["H"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2H" name="<?php echo $stepWiseVideo[2]["H"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
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
            <!--  <div class="clear"></div>
              <div class="clear"></div>-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["I"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["I"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2I" name="<?php echo $stepWiseVideo[2]["I"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
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
               <!-- <div class="clear"></div>
              <div class="clear"></div>-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["J"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["J"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2J" name="<?php echo $stepWiseVideo[2]["J"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
               <!-- <div class="clear"></div>
              <div class="clear"></div>-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["K"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["K"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2K" name="<?php echo $stepWiseVideo[2]["K"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
                <h3 class="new_head"><?php echo $stepWiseVideo[2]["K"]["content_title"];?></h3>
                <p><?php echo $stepWiseVideo[2]["K"]["content"];?></p>
                <ul class="presta_shop">
                  <?php foreach( $htmlBanners as $key=>$val){?>
                  <li>
                    <div class="prest_sp_li"><a href="#"><?php if($htmlBanners[$key]["bannerImage"]!=""){ ?><img src="<?php echo $this->config->item('gbe_base_url'); ?>CT_sponcer_img/<?php echo $htmlBanners[$key]["bannerImage"];?>">
					<?php }else { ?> <img src="<?php echo base_url(); ?>CT_images/no-banner-image.png"> <?php } ?></a></div>
                    <div class="mbr" ><a href="javascript:void(0)" id="bannerCopy<?php echo $htmlBanners[$key]["id"];?>" >Copy</a></div>
                    <input type="hidden" name="bannerUrl<?php echo $htmlBanners[$key]["id"];?>" id="bannerUrl<?php echo $htmlBanners[$key]["id"];?>" value="<?php echo base_url(); ?>dashboard/productCommon_buy/<?php echo $htmlBanners[$key]["uID"];?>/<?php echo $ct_pageId;?>"/>
                  </li>
                  <?php } ?>
                </ul>
              </div>
               <!-- <div class="clear"></div>
              <div class="clear"></div>-->
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[2]["L"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[2]["L"]["title"];?></h3>
                <span><a class="watch-video-tut" id="tutorial-video2L" name="<?php echo $stepWiseVideo[2]["L"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="clear"></div>
              <?php if($_REQUEST["replycc"]=="success"){?>
              <span class="err-succ">Successfully Inserted</span>
              <?php }?>
              <?php if($_REQUEST["replycc"]=="error"){?>
              <span class="err-notsucc">Due to some problem it can't updated! </span>
              <?php }?>
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
            <?php }

						}?>
            <p align="right"><a id="step3" href="javascript:void(0)" rel="tab3" onclick="showThirdTab()" style=" background:#1b75bc; border-radius: 5px; color: #fff;  font-size: 22px; padding: 10px;">Now Complete Step 3 ></a></p>
            
            <!--ab end--> 
            
          </div>
          <!-- step2 close-->
          
          <div class="tab_content tab-3" id="tab3" style="display: none;">
            <div class="yvideo extra-pad">
             <span class="watch-thisvideo"><?php echo $stepWiseVideo[1][1]["content_title"];?></span>
            <div class="palvidd" style="width:540px; height:320px; margin:0 auto;"><a href="javascript:void(0)" id="tutorial-video103"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[3][1]["content_image"];?>" width="527" height="320" alt="" /> </a></div>
             </div>
                 <?php 
            $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");
            if(in_array($this->session->userdata('userType'), $viewArray) || ($this->session->userdata('userType') == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            unset($viewArray);
            ?>
              <!--<div class="">
                <h3 class="headign-left" style="text-align:center; width:auto; float:none;">Congratulations! <br />
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
                <div class="stop_ylw">
				<img src="<?php echo base_url(); ?>images/submit-paypal.png" width="424" height="81" alt="" style="cursor:pointer" onclick="siwtchOnPayment();">
				</div>
                <?php }else{?>
                <p style="font-size:font-size: 20px;">You are upgraded to the next Level.</p>
                <?php }?>
                 <br class="clear">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
              </div>-->
              <div class="new-advsection">
             <form action="" method="post">
             <h3> ADD NEW TEXT ADVERTISEMENT</h3>
             <label>
             <span>Advertisement title (Length from 3 to 40 signs)</span>
             <input name="" type="text" />
             </label>
             <label>
             <span>Advertisement text (minimum 10 signs, maximum 120)</span>
            <textarea name="" cols="" rows=""></textarea>
             </label>
             <label>
             <span>Url - link to website you want to promote</span>
             <input name="" type="text" />
             </label>
            <h3>FILTERING SETTINGS</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="filter-table">
  <tr>
    <td width="100" align="left" valign="top">Gender</td>
    <td width="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td width="60" align="left" valign="top">any</td>
    <td width="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td align="left" valign="top">man</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td width="30" align="left" valign="top"><input name="" type="radio" value=""></td>
    <td width="60" align="left" valign="top">Women</td>
    <td width="30" align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="100" align="left" valign="top">Age</td>
    <td width="30" align="left" valign="top"><input name="" type="checkbox" value=""></td>
    <td width="60" align="left" valign="top">&lt; 21</td>
    <td width="30" align="left" valign="top"><input name="" type="checkbox" value=""></td>
    <td align="left" valign="top">21-30</td>
  </tr>
  <tr>
    <td width="" align="left" valign="top">&nbsp;</td>
    <td width="30" align="left" valign="top"><input name="" type="checkbox" value=""></td>
    <td width="60" align="left" valign="top">30-50</td>
    <td width="30" align="left" valign="top"><input name="" type="checkbox" value=""></td>
    <td align="left" valign="top">&gt; 50</td>
  </tr>
</table>
<h3>ASSIGN VIEWS</h3>
            <label>
            <span>Views available</span>
            <input name="" type="text" style="float: left; width: 78% !important;" />
            <input name="" type="button" value="Buy adpacks" class="buy-adpacks" />
            </label>
            <br class="clear" />
            <label>
            <span>Views assigned</span>
             <input name="" type="text" />
            </label>
            <label><input name="" type="button" value="Submit" class="extra-blue-btnadv" /></label>
             </form>
              </div>
              <?php } else { ?>
              <div class="">
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
          </div>
          <!--step4 open-->
          <div class="tab_content tab-4" id="tab4" style="display: none;">
            <div class="prod_uplod"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[4][1]["content_title"];?><strong><?php echo $stepWiseVideo[4][1]["content"];?></strong></span>
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["A"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[4]["A"]["title"];?></h3>
                <span> <a href="javascript:void(0)" id="tutorial-video-v-add" class="watch-video-tut4A" name="<?php echo $stepWiseVideo[4]["A"]["path"];?>">Watch Video</a></span> </div>
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
                      
                    </select>
                    <span class="addcityclass" ><a href="javascript:void(0)" onClick="openCityAddCityDiv();"><em>Not in List Click to Add Your City</em> </a></span>
                  <div id="newCity" style="display:none;">
                    <input type="text" name="newVendorCity" id="newVendorCity" placeholder="Add your City">
                    <div class="ad" onClick="addNewCity()"> Add</div>
                    <div class="can" onClick="closeNewCityDiv()">Cancel</div>
                  </div>
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
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["B"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[4]["B"]["title"];?></h3>
                <span> <a href="javascript:void(0)" id="watch-video-tut4B" name="<?php echo $stepWiseVideo[4]["B"]["path"];?>" class="watch-video-tut1">Watch Video</a></span> </div>
              <!--Blog b body -->
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
                    <label>Sub Category</label>
                    <select name="articleID" id="articleID">
                    </select>
                  </p>
                  <p>
                    <label>2nd Sub Category</label>
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
                    <label>This Item is for:</label>
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
                      <option value="GBE">Pound</option>
                    </select>
                  </p>
                  <p>
                    <label>Price I want Per Item<span id="showSelCurr">($)</span></label>
                    <input type="float" name="productPrice" id="productPrice">
                  </p>
				  <p>
                    <label>Amount I'm Offering CT Members As Commission<span id="showSelCurr1">($)</span></label>
                    <input type="text" name="productCommission" id="productCommission">
                  </p>
				  
                  <div class="col_qnt">
                    <div class="color_sec">
                      <div class="col_tpps">
                        <label>Color Product</label>
                        <p style="margin-left:12px;">
                          <input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_1" class="colorRadio">
                          <strong>Yes</strong></p>
                        <p>
                          <input type="radio" name="RadioGroup1" checked="checked" value="0" id="RadioGroup1_0" class="colorRadio">
                          <strong>No</strong></p>
                      </div>
                      <div class="col_in" id="cq_1" style="display: none;">
                        <?php if(count($colorList) > 0):?>
                        <?php  foreach ($colorList as $cList):?>
                        <p class="col_col" id="<?php echo $cList->id;?>"> <span id="lblId_<?php echo $cList->id;?>"></span>
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
                  
                  <p>
                    <label>Product You tube video</label>
                    <input type="text" name="productYoutubeUrl" id="productYoutubeUrl">
                  </p>
                  <p>
                    <label>Type of Product</label>
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
                    <p style="margin-left:12px;">
                      <input type="radio" name="productStatus" value="1" checked="checked" id="productStatus_1">
                     <strong> Active</strong></p>
                    <p>
                      <input type="radio" name="productStatus" value="0" id="productStatus_0">
                      <strong>Inactive</strong></p>
                  </div>
                  <div class="clear"></div>
                  <p>
                    <input type="submit" value="Save" id="pUploadButton" name="pUploadButton">
                  </p>
                </form>
              </div>
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["C"]["serial_field"];?> </strong>
                <h3 class="d_hdr"><?php echo $stepWiseVideo[4]["C"]["title"];?></h3>
              <!-- <h3><?php //echo $stepWiseVideo[4]["B"]["title"];?></h3>-->
                <span> <a href="javascript:void(0)" id="watch-video-tut4C" name="<?php echo $stepWiseVideo[4]["C"]["path"];?>" class="watch-video-tut1">Watch Video</a></span> </div>
              <div class="upl_frm_inre" style="  height: <?php echo (count($allProducts) > 6)?490:count($allProducts)*95;?>px; <?php if(count($allProducts) > 6):?>overflow-y: scroll;<?php endif;?>">
                <table class="ppnams" style="border: 1px;width: 100%;">
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
                  
                    <td><img width="50px" height="50px" src="<?php echo  $this->config->item('gbe_base_url').'adminuploads/product_files/images/'.$prd->fileName;?>" title="<?php echo $prd->productName;?>" /></td>
                    <td><?php echo $prd->productName;?></td>
                    <td><?php echo $prd->productPrice;?></td>
                    <td><a href="<?php echo base_url().'dashboard/editProduct/'.$prd->productID;?>">Edit</a></td>
                  </tr>
                  <?php  $i++;  endforeach;?>
                  <?php    else: ?>
                  <tr>
                    <td colspan="4">Sorry! No Product please. </td>
                  </tr>
                  <?php    endif;?>
                </table>
              </div>
			  			  <!--5/10/2015 ujjwal sana added-->
			 
				 <?php if($productId > 0):?>
                  <script type="text/javascript">
				  		$(document).ready(function(e) {
							var scroll1 = $(window).scrollTop() + 2310 + <?php echo (count($allProducts) > 6)?490:count($allProducts)*95;?> ;
							//alert(scroll1);
							$(window).scrollTop(scroll1);
                        });
				  </script>
              <div id="edit_product_id">
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["E"]["serial_field"];?></strong>
             <!--   <h3 class="d_hdr"><?php echo $stepWiseVideo[4]["E"]["title"];?></h3>-->
                <h3><?php echo $stepWiseVideo[4]["E"]["title"];?></h3>
                <span> <a href="javascript:void(0)" id="watch-video-tut4E" name="<?php echo $stepWiseVideo[4]["E"]["path"];?>" class="watch-video-tut1">Watch Video</a></span> 
			</div>
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
                      <label>Sub Category</label>
                      <select name="articleIDEdit" id="articleIDEdit">
						<option value="">Please Select Article</option>                            
							<?php if(count($artList) > 0){ 
								foreach($artList as $artL){
								//echo '++'.$catL->menuID."==".$catL->menuName;
								?>
								<option value="<?php echo $artL['id'];?>" <?php if($artL['id'] == $artID){?> selected="selected"<?php }?>><?php echo $artL['title'];?></option>
							<?php }}?>					  
                      </select>
                    </p>
                    <p>
                      <label>2nd Sub Category</label>
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
                      <label>This Item is for:</label>
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
                          <option value="GBE" <?php if($pDetails[0]->productCurrencyType == "GBE"){?> selected="selected"<?php }?>>Pound</option>
                      </select>
                    </p>
                    <p>
                      <label>Price I want Per Item<span id="showSelCurr">($)</span></label>
                      <input type="float" name="productPrice" id="productPriceEdit" value="<?php echo $pDetails[0]->productPrice;?>">
                    </p>
					<p>
                      <label>Amount I'm Offering GBE Members As Commission<span id="showSelCurr1">($)</span></label>
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
                      <label>Type of Product</label>
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
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_1']['fileName'];?>">
                        <input type="hidden" name="img_1_edit" value="<?php echo $pFiles['img_1']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_1_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Secondary Image of your product</label>
                      <input type="file" name="img_2">
                      <?php if($pFiles['img_2']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_2']['fileName'];?>">
                      <input type="hidden" name="img_2_edit" value="<?php echo $pFiles['img_2']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_2_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Third Image of your product</label>
                      <input type="file" name="img_3">
                      <?php if($pFiles['img_3']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_3']['fileName'];?>">
                      <input type="hidden" name="img_3_edit" value="<?php echo $pFiles['img_3']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_3_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Fourth Image of your product</label>
                      <input type="file" name="img_4">
                      <?php if($pFiles['img_4']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_4']['fileName'];?>">
                      <input type="hidden" name="img_4_edit" value="<?php echo $pFiles['img_4']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_4_edit" value="0">
                      <?php }?>
                    </p>
                    <div class="status_rd">
                      <label>Status</label>
                      <p style="margin-left:12px;">
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
                </div>
				<?php endif;?>
				  <div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["D"]["serial_field"];?></strong>
                <h3><?php echo $stepWiseVideo[4]["D"]["title"];?></h3>
                <span> <a href="javascript:void(0)" id="watch-video-tut4D" name="<?php echo $stepWiseVideo[4]["D"]["path"];?>" class="watch-video-tut1">Watch Video</a></span> </div>
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
             
          </div>
          <!--step4 stop--> 
		  <!--Monetizer tab start-->
		   <div class="tab_content " id="tab6" style="display: none;">
           
  <div class="prod_uplod"> <div class="yvideo yvideo_extra-pad">
            <span class="watch-thisvideo">Watch This Video</span>
            <div style="width:540px; height:320px; margin:0 auto;" class="palvidd"><a id="mone_intro_video_id" name="<?php echo $mone_into_video[0]['path'];?>" href="javascript:void(0)"><img width="527" height="320" alt="" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/level_wise_images/'.$mone_into_video[0]['content_image'];?>"> </a></div>
             </div>
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["A"]["serial_field"];?></strong>
      <h3 class="d_hdr"><?php echo $stepWiseMoneVideo[0]["A"]["title"];?></h3>
      <span> <a name="<?php echo $stepWiseMoneVideo[0]["A"]["path"];?>" class="watch-video-tut4A" id="tutorial-video-moneA" href="javascript:void(0)">Watch Video</a></span> </div>
    <div class="upl_form">
                <form id="prd_upld" method="post" name="profileFormAdd" action="<?php echo base_url();?>dashboard/addProfileStore/<?php echo $ct_pageId;?>">
                  <p>
                    <label>Artist / Band Name</label>
                    <input type="text" name="artistName" id="artistName" value="<?php echo $monetizerProfile[0]['artistName'];?>">
                  </p>
                  <p>
                    <label>Artist Contact No.</label>
                    <input type="tel" name="artistPh" id="artistPh" value="<?php echo $monetizerProfile[0]['artistPh'];?>">
                  </p>
                   <p>
                    <label>Sub Category </label>
                   <select name="subCatList" id="subCatList">
				   
				    <option value="">Select Sub category </option>
                      <?php if(count($subCatList) > 0){ 
                            foreach($subCatList as $subCatListItems){
                                ?>
                      <option value="<?php echo $subCatListItems['id'];?>" <?php if($subCatListItems['id']==$monetizerProfile[0]['subCatId']) { echo 'selected="selected"'; } ?>><?php echo $subCatListItems['title'];?></option>
                      <?php }}?>
				   </select>
                  </p>
                  <p>
                    <label>About Me / Us</label>
                    <textarea name="aboutMe" id="aboutMe"><?php echo $monetizerProfile[0]['aboutMe'];?></textarea>
                  </p>
                  <p>
                    <label>Country</label>
                    <select id="profileCountry" name="profileCountry">
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
                    <select id="city1" name="profileCity">
                      <!--<option value="">Select City </option>-->
                      
                    </select>
                    <span class="addcityclass" ><a href="javascript:void(0)" onClick="CT_openCityAddCityDiv();"><em>Not in List Click to Add Your City</em> </a></span>
                  <div id="CT_newCity" style="display:none;">
                    <input type="text" name="newVendorCity" id="newVendorCity1" placeholder="Add your City">
                    <div class="ad" onClick="CT_addNewCity()"> Add</div>
                    <div class="can" onClick="closeNewCityDiv()">Cancel</div>
                  </div>
                  </p>
                  <p>
                    <label>Post/Zip Codes</label>
                    <input type="text" name="profileZip" id="profileZip" value="<?php echo $monetizerProfile[0]['profileZip'];?>" >
                  </p>
                  <p>
                    <label>Sellers Email</label>
                    <input type="email" name="profileSellerEmail" id="profileSellerEmail" value="<?php echo $monetizerProfile[0]['profileSellerEmail'];?>">
                  </p>
                  <p>
                    <label>Sellers Website</label>
                    <input type="text" name="profileSellerWebsite" id="profileSellerWebsite1" value="<?php echo $monetizerProfile[0]['profileSellerWebsite'];?>" >
                  </p>
                  <p>
                    <input type="submit" value="Save" name="addProfile" id="addProfile">
                  </p>
                </form>
              </div>
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["B"]["serial_field"];?></strong>
      <h3 class="d_hdr"><?php echo $stepWiseMoneVideo[0]["B"]["title"];?></h3>
      <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["B"]["path"];?>" id="tutorial-video-moneB" href="javascript:void(0)">Watch Video</a></span> </div>
    <div class="white-space pp st1">
                 
                  <form enctype="multipart/form-data" action="<?php echo base_url();?>dashboard/updateUserInfo/<?php echo $ct_pageId;?>" method="post" id="frm_new">
                   <!--h3 style="margin-bottom: 8px; padding-left:38px;"><?php echo $stepWiseVideo[1]["A"]["content"];?></h3-->
				   <h3 style="margin-bottom: 8px; text-align:center;">Add your details so your sign ups can contact you</h3>
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
                      <input type="file" onchange="ct_readURL(this);" value="Add photo" name="profile" class="brws">
                      <input type="hidden" name="tempImage" value="<?php echo $userInfo[0]['profile'];?>">
                     </label>
                    <label style="float: left; overflow: inherit;">
                    <div id="contact-image"><img alt="" src="<?php echo $this->config->item('gbe_base_url').'useruploads/'.$userInfo[0]['profile'];?>" id="ct_empPic"></div>
                    </label>
                    <label style="margin-top: 30px;">
                  
                    <input type="submit" style="float:right;" value="Update" name="update" id="updateID" class="extra-blue-btn">
                    <div class="clear"></div>
                    </label>
                  </form>
             </div>
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["C"]["serial_field"];?> </strong>
      <h3 class="d_hdr"><?php echo $stepWiseMoneVideo[0]["C"]["title"];?></h3>
      <!-- <h3></h3>--> 
      <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["C"]["path"];?>" id="tutorial-video-moneC" href="javascript:void(0)">Watch Video</a></span> 
	</div>
	
   <!-- <div class="upl_form">
     
	  <form enctype="multipart/form-data" action="<?php echo base_url();?>dashboard/CT_TopsixInfo/<?php echo $ct_pageId;?>" method="post" id="frm_new_topsix">
      <label><span>Product Name</span>
		  <input type="text" value="" name="area_name" id="area_name">
        </label>
          <label><span>Price</span>
           <input type="text" value="" name="house_for_sale" id="house_for_sale">
        </label>
		<label><span>Description</span>
		   <textarea name="productDesc" id="productDesc" class="ticket-description"></textarea>
        </label>
	 <p>
                    <label>Upload your Product Image</label>
                    <input type="file" name="img_1" id="mainImageId">
                  </p>
                  
        <p>
          <label>       
           <input type="submit" value="Submit" name="update" id="top_six_product" class="extra-blue-btn">
           <div class="clear"></div>
		   </label>
        </p>
      </form>
    </div> -->  
	
	<!-- Music product upload-->
		<div class="upl_form_sec">
    <form id="prd_upld_sec" action="<?php echo base_url();?>dashboard/addCsection/<?php echo $ct_pageId;?>" method="post" enctype="multipart/form-data">
                  <p>
                    <label>Product Name</label>
                    <input type="text" name="topProductName" id="topProductName">
                  </p>
                  <p>
                    <label>Product Description</label>
                    <textarea name="topProductDesc" id="topProductDesc"></textarea>
                  </p>
                  <p>
                    <label>Selling Currency</label>
                    <select name="topProductCurrencyType" id="topProductCurrencyType">
                      <option value="USD">USD Dollar</option>
                      <option value="EUR">Euro</option>
                      <option value="GBE">Pound</option>
                    </select>
                  </p>
                  <p>
                    <label>Price I want Per Item<span id="showSelCurr">($)</span></label>
                    <input type="float" name="topProductPrice" id="topProductPrice">
                  </p>
				  <p>
                    <label>Upload your Product Image</label>
                    <input type="file" name="topProImage" id="topProImage">
                  </p>
				  
				 <?php if($ct_url == "MUSIC SUITE"){ ?>
                  <p>
                    <label>Upload your Product Music file</label>
                    <input type="file" name="topMusicFileId" id="topMusicFileId">
                  </p>
				 <?php }  elseif($ct_url == "MODELS SUITE"){ ?>
                  <p>
                    <label>Upload your Model Image 1</label>
                    <input type="file" name="topModelFile1" id="topModelFile1">
                  </p>
				  <p>
                    <label>Upload your Model Image 2</label>
                    <input type="file" name="topModelFile2" id="topModelFile2">
                  </p>
				  <p>
                    <label>Upload your Model Image 3</label>
                    <input type="file" name="topModelFile3" id="topModelFile3">
                  </p>
				 <?php } elseif($ct_url == "MEETUPS SUITE"){ ?>
				 <p>
                    <label>Event date</label>
                    <input type="text" name="topEventDate" id="topEventDate">
                  </p>
				  <p>
                    <label>Event Location </label>
                    <input type="text" name="topEventLocation" id="topEventLocation">
                  </p>
				 <p>
                    <label>Upload your Ticket pdf </label>
                    <input type="file" name="topMeetupFile" id="topMeetupFile">
                  </p>
				 <?php } elseif($ct_url == "Real Estate"){ ?> 
				 <p>
                    <label>House Name </label>
                    <input type="text" name="house_for_sale" id="house_for_sale">
                  </p>
				  <p>
                    <label>Area Name </label>
                    <input type="text" name="area_name" id="area_name">
                  </p>
				  <p>
                    <label>Bedrooms </label>
                    <input type="text" name="bedrooms" id="bedrooms">
                  </p>
				  <p>
                    <label>Bathrooms </label>
                    <input type="text" name="bathrooms" id="bathrooms">
                  </p>
				  <p>
                    <label>Receptions </label>
                    <input type="text" name="receptions" id="receptions">
                  </p>
				  <p>
                    <label>sq ft. </label>
                    <input type="text" name="sq_ft" id="sq_ft">
                  </p>
				 <p>
                    <label>Upload your House Image </label>
                    <input type="file" name="realHouseImg" id="realHouseImg">
                  </p>
				 <?php } ?>
                  <div class="clear"></div>
                  <p>
				  <?php if($ct_pageId == 2){?>
				  <input value="Save" id="updateTopSix" name="updateTopSix" <?php if(count($topSixPro)==1){ ?>  type="button" class="button-blue"  onClick="showAlert();" <?php } else { ?> type="submit" <?php } ?> >
				  <?php } else if($ct_pageId == 3){?>
				  <input type="submit" value="Save" id="updateTopSix" name="updateTopSix" <?php if(count($topSixPro)==9){ ?> disabled="disabled"  <?php } ?>>
				  
				  <?php } else { ?>
                    <input type="submit" value="Save" id="updateTopSix" name="updateTopSix" <?php if(count($topSixPro)==6){ ?> disabled="disabled"  <?php } ?>>
				  <?php } ?>
				 </p>
    </form>
</div>
	<!-- added by SB on 02/03/2016 --->
	 <div class="your-pic">		 
                 <div class="sponcer-thumsec">
                  <?php if (count($topSixPro)>0){
					  $i=1;
					  foreach($topSixPro as $topSixProDetail){?>
                 <div class="thum-del" style="margin-bottom:20px;" id="topSixDivId<?php echo $i; ?>"> <?php if($topSixProDetail['productFile']!=""){?> <img style="margin-right:25px;" src="<?php echo $this->config->item('gbe_base_url');?>topsixproduct/<?php echo $topSixProDetail['productFile'];?>"  width="70" height="70" alt="">
				 <?php } else {?><img id="empPic_ct" style="margin-right:25px;" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg"  width="70" height="70" alt="">
				 <?php } ?>
                 <img src="<?php echo base_url(); ?>images/delete-icon-spon.png" onclick="delTopSixPro(<?php echo $topSixProDetail['productID'];?>, <?php echo $i; ?>, <?php  echo $ct_pageId; ?>)" class="delete-icon" />
                 </div>
                  <?php
					 
						$i++;	
						}
					} 
					  ?>
					  
                 </div>
				 <br class="clear">
	 </div>
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["D"]["serial_field"];?>  </strong>
      <h3 class="d_hdr"><?php echo $stepWiseMoneVideo[0]["D"]["title"];?> </h3>
      <!-- <h3></h3>--> 
      <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["D"]["path"];?>" id="tutorial-video-moneD" href="javascript:void(0)">Watch Video</a></span> </div>
    <div class="mms_page ct_products">
      
         <div class="fm_mss add_events">
          <h3>Add Event</h3>		  
           <form action="<?php echo base_url();?>dashboard/eventAdd/<?php echo $ct_pageId;?>" method="post" enctype="multipart/form-data">
		   
            <div class="fms_lfts">
             <p>
              <label>Name</label>
              <input name="name" type="text" value="<?php if($dEventValue[0]['name']!=""){ echo $dEventValue[0]['name']; }?>">
              <?php echo form_error('name', '<span class="form_error">', '</span>'); ?>
            </p>
            <p>
              <label>Start Date</label>
              <input name="start_date" id="start_date" type="text" value="<?php if($dEventValue[0]['start_date']!=""){ echo $dEventValue[0]['start_date']; }?>">
              <?php echo form_error('start_date', '<span class="form_error">', '</span>'); ?>
            </p>
            <p class="countr">
              <label>Country</label>
               <select id="country_id" name="country_id" onChange="getCity()">
                	<option value="">Select One </option>
                     <?php if(count($countryList) > 0){ 
                            foreach($countryList as $conList){
                            	$selCountry = "";
                            	if($dEventValue[0]['country_id']!="" && ($conList->country_id==$dEventValue[0]['country_id'])){
                            		//$selCountry = 'selected="selected"';
									$selCountry = " selected ";
                            	}
                                ?>
                        <option value="<?php echo $conList->country_id;?>" <?php echo $selCountry;?>><?php echo $conList->name;?></option>
                        <?php }}?>
              </select>
               <?php echo form_error('country_id', '<span class="form_error">', '</span>'); ?>
            </p>
           <p class="zip">
              <label>Zip code</label>
               <select id="zip_code_id" name="zip_code_id">
                	<option value="">Select One </option>
                	 <?php if(count($zipList) > 0){ 
                	 			foreach($zipList as $cl){
                            		$selZip = '';
                            		if($dEventValue[0]['zip_code_id']!="" && ($cl['id'] ==  $dEventValue[0]['zip_code_id'])){
                            			$selZip = 'selected="selected"';
                            		} 
                                ?>
                        <option value="<?php echo $cl['id'];?>" <?php echo $selZip;?>><?php echo $cl['zip_code'];?></option>
                        <?php }}?>
              </select>
               <?php echo form_error('zip_code_id', '<span class="form_error">', '</span>'); ?>
               <span class="addcityclass" ><a href="javascript:void(0)" onClick="openZipAddZipDiv();"><em>Add Zip Code</em> </a></span><br class="clear"> 
			</p>
			<div style="display:none;" id="newZip"><input type="text" placeholder="Add your Zip" id="newVendorZip" name="newVendorZip"> <div onclick="addNewZip()" class="ad"> Add</div><div onclick="closeNewZipDiv()" class="can">Cancel</div></div>
                 
            <p class="img_uplod">
              <label>Image</label>
              <input name="image_path" type="file" onchange="CT_EreadURL(this);"><br class="clear">
              <img width="75" height="75" id="image_path_img_id" style="display:none;">
              <?php echo form_error('image_path', '<span class="form_error">', '</span>'); ?>
            </p>
            </div>
           
            <div class="fms_rits">
            <p>
              <label>Contact Number</label>
              <input name="contact_number" type="text" value="<?php if($dEventValue[0]['contact_number']!=""){ echo $dEventValue[0]['contact_number']; }?>">
              <?php echo form_error('contact_number', '<span class="form_error">', '</span>'); ?>
            </p>
            <p>
              <label>End Date</label>
              <input name="end_date" id="end_date" type="text" value="<?php if($dEventValue[0]['end_date']!=""){ echo $dEventValue[0]['end_date']; }?>">
               <?php echo form_error('end_date', '<span class="form_error">', '</span>'); ?>
            </p>
            <p class="city">
              <label>City</label>
               <select id="city_id" name="city_id" onChange="getZipCode()">
                	<option value="">Select One </option>
                	<?php if(count($cityList) > 0){ 
						 foreach($cityList as $cl){
							 $selCity = "";
                            		if($dEventValue[0]['city_id']!="" && ($cl->id == $dEventValue[0]['city_id'])){
                            			$selCity = " selected ";
                            		} ?>
					<option value="<?php echo $cl->id;?>" <?php echo $selCity;?>><?php echo $cl->city;?></option>
						 <?php }  }?>
              </select>
              <?php echo form_error('city_id', '<span class="form_error">', '</span>'); ?>
			  <span class="addcityclass" ><a href="javascript:void(0)" onClick="city_openCityAddCityDiv();"><em>Add City</em> </a></span><br class="clear">
               </p>
		
			<div id="City_newCity" style="display:none;"><input type="text" name="CT_newVendorCity" id="CT_newVendorCity" placeholder="Add your City"> <div class="ad" onClick="City_addNewCity()"> Add</div><div class="can" onClick="closeNewCityDiv()">Cancel</div></div>
            
           <p class="pdf_uplod">
              <label>Pdf Upload</label>
              <input name="pdf" type="file"><br class="clear">
              <?php echo form_error('pdf', '<span class="form_error">', '</span>'); ?>
            </p>
            <p class="dscipn">
              <label>Description</label>
              <textarea name="desc"><?php if($dEventValue[0]['desc']!=""){ echo $dEventValue[0]['desc']; }?></textarea>
              <?php echo form_error('desc', '<span class="form_error">', '</span>'); ?>
            </p>
			<div class="clear"></div>
            </div>
           <p class="btnss"><input name="moneEventBtn" id="moneEventBtn" type="submit" value="Save"> 
            <input name="" type="reset" value="reset">
            </p>
            <div class="clear"></div>
          </form>
        </div> 
		
      </div>
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["E"]["serial_field"];?></strong>
      <h3 class="d_hdr"><?php echo $stepWiseMoneVideo[0]["E"]["title"];?></h3>
      <!-- <h3></h3>--> 
      <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["E"]["path"];?>" id="tutorial-video-moneE" href="javascript:void(0)">Watch Video</a></span> </div>
    <div class="upl_frm_inre" style="  height: <?php echo (count($allProducts) > 6)?490:count($allProducts)*95;?>px; <?php if(count($allProducts) > 6):?>overflow-y: scroll;<?php endif;?>">
                <table class="ppnams" style="border: 1px;width: 100%;">
                  <tbody class="ppnams_top">
          <!--<th>#</th>-->
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Price</th>
            <!--<th>Share</th>-->
            <th>Action</th>
          </tr>
        </tbody>
        <tbody>
		<?php if(count($allMoneProducts) > 0):?>
                    <?php   $i = 1; foreach ($allMoneProducts as $moneProDetail):?>
          <tr> 
                  
            <td><?php if($moneProDetail['productSpecificFile']!=""){ ?><img width="50px" height="50px" src="<?php echo  $this->config->item('gbe_base_url').'topsixproduct/'.$moneProDetail['productSpecificFile'];?>" title="<?php echo $moneProDetail['productName'];?>" />
			<?php } else { ?><img width="50px" height="50px" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg" > <?php } ?></td>
            <td><?php echo $moneProDetail['productName'];?></td>
            <td><?php echo $moneProDetail['productPrice'];?></td>
			<!--<td><a href="#">Share</a></td>-->
            <td><a href="<?php echo base_url().'dashboard/ct_editProduct/'.$moneProDetail['productId']."/$ct_pageId";?>">Edit</a></td>
          </tr>
		  <?php  $i++;  endforeach;?>
                  <?php    else: ?>
			<tr>
               <td colspan="4">Sorry! No Product please. </td>
             </tr>
          <?php    endif;?>
          <!--tr>
            <td><img width="50px" height="50px" title="gun" src="http://globalblackenterprises.com/adminuploads/product_files/images/product-40-1448445357.jpg"></td>
            <td>gun</td>
            <td>12.00</td>
            <td><a href="#">Share</a></td>
            <td><a href="http://www.communitytreasures.co/dashboard/editProduct/40">Edit</a></td>
          </tr-->
        </tbody>
      </table>
    </div>
	<!--4/1/2016 new added us-->
	<?php if($pag != ""){
		if($pag =="show_edit"){
	?>
	<div id="ct_edit_product_id">
              <div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["E"]["serial_field"];?></strong>
             <!--   <h3 class="d_hdr"><?php echo $stepWiseVideo[4]["E"]["title"];?></h3>-->
                <h3><?php echo $stepWiseVideo[4]["E"]["title"];?></h3>
                <span> <a href="javascript:void(0)" id="watch-video-tut4E" name="<?php echo $stepWiseVideo[4]["E"]["path"];?>" class="watch-video-tut1">Watch Video</a></span> 
			</div>
		<div class="upl_form_sec">
                    <form id="prd_upld_sec" action="<?php echo base_url();?>dashboard/updateProduct/<?php echo $ct_pageId;?>" method="post" enctype="multipart/form-data">
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
                      <label>Sub Category</label>
                      <select name="articleIDEdit" id="articleIDEdit">
						<option value="">Please Select Article</option>                            
							<?php if(count($artList) > 0){ 
								foreach($artList as $artL){
								//echo '++'.$catL->menuID."==".$catL->menuName;
								?>
								<option value="<?php echo $artL['id'];?>" <?php if($artL['id'] == $artID){?> selected="selected"<?php }?>><?php echo $artL['title'];?></option>
							<?php }}?>					  
                      </select>
                    </p>
                    <p>
                      <label>2nd Sub Category</label>
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
                      <label>This Item is for:</label>
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
                          <option value="GBE" <?php if($pDetails[0]->productCurrencyType == "GBE"){?> selected="selected"<?php }?>>Pound</option>
                      </select>
                    </p>
                    <p>
                      <label>Price I want Per Item<span id="showSelCurr">($)</span></label>
                      <input type="float" name="productPrice" id="productPriceEdit" value="<?php echo $pDetails[0]->productPrice;?>">
                    </p>
					<p>
                      <label>Amount I'm Offering GBE Members As Commission<span id="showSelCurr1">($)</span></label>
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
                      <label>Type of Product</label>
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
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_1']['fileName'];?>">
                        <input type="hidden" name="img_1_edit" value="<?php echo $pFiles['img_1']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_1_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Secondary Image of your product</label>
                      <input type="file" name="img_2">
                      <?php if($pFiles['img_2']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_2']['fileName'];?>">
                      <input type="hidden" name="img_2_edit" value="<?php echo $pFiles['img_2']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_2_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Third Image of your product</label>
                      <input type="file" name="img_3">
                      <?php if($pFiles['img_3']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_3']['fileName'];?>">
                      <input type="hidden" name="img_3_edit" value="<?php echo $pFiles['img_3']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_3_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Fourth Image of your product</label>
                      <input type="file" name="img_4">
                      <?php if($pFiles['img_4']['id'] != ''){ ?>
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_4']['fileName'];?>">
                      <input type="hidden" name="img_4_edit" value="<?php echo $pFiles['img_4']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_4_edit" value="0">
                      <?php }?>
                    </p>
                    <div class="status_rd">
                      <label>Status</label>
                      <p style="margin-left:12px;">
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
	</div>
	<?php } }?>
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["F"]["serial_field"];?></strong>
      <h3 class="d_hdr"><?php echo $stepWiseMoneVideo[0]["F"]["title"];?></h3>
      <!-- <h3></h3>--> 
      <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["F"]["path"];?>" id="tutorial-video-moneF" href="javascript:void(0)">Watch Video</a></span> </div>
    <div class="load">
      <div class="your-pic">		 
                 <div class="sponcer-thumsec">
                  <?php if (count($sponcerPics)>0){
					  $i=1;
					  foreach($sponcerPics as $spPic){?>
                 <div class="thum-del" id="spImgDivId<?php echo $i; ?>"> <img id="empPic_ct" style="margin-right:25px;" src="<?php echo $this->config->item('gbe_base_url');?>CT_sponcer_img/<?php echo $spPic['images'];?>"  width="70" height="70" alt="">
                 <img src="<?php echo base_url(); ?>images/delete-icon-spon.png" onclick="delSponcerImg(<?php echo $spPic['id'];?>, <?php echo $i; ?>)" class="delete-icon" />
                 </div>
                  <?php
					 
						$i++;	
						}
					} else {
					  ?>
					   <?php echo $pic->profile; ?> <img id="empPic_ct" style="margin-right:25px;" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg"  width="70" height="70" alt="">
					  <?php
				  } ?>
                 </div>
            <br class="clear">    
		 <p style="margin-bottom:26px; margin-top:20px;">Add your profile picture to your Rave Story Website</p>
                  <form enctype="multipart/form-data" action="<?php echo base_url();?>dashboard/CT_profilePicUpload/<?php echo $ct_pageId;?>" method="post" class="rday">
                    <label style="display: block; clear: both;">
                    <!--<input type="file" onchange="readURL_ct(this);" name="user_file" id="file">-->
					<input type="file" name="user_file" id="spfile" <?php if(count($sponcerPics)==3){ ?> disabled="disabled"  <?php } ?>  >
                    <input type="submit" class="submit-bnt" id="sponcerBtnId"  name="update" value="update" <?php if(count($sponcerPics)==3){ ?> disabled="disabled"  <?php } ?>  >
                    <div class="clear"></div>
                    </label>
                  </form>
      </div>
    </div>
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["G"]["serial_field"];?></strong>
      <h3 class="d_hdr" style="float: left; line-height: 70px;"><?php echo $stepWiseMoneVideo[0]["G"]["title"];?></h3>
      <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["G"]["path"];?>" id="tutorial-video-moneG" href="javascript:void(0)">Watch Video</a></span> 
      </div>
      <div class="load">
      <div class="your-pic">
			<div class="sponcer-thumsec">
				<ul id="mycarousel" class="jcarousel-skin-tango">			
            <?php if(count($moneVideoLinks)>0){
				 $i=1;
				 // foreach($allVideo as $key=>$allVideos){
					foreach($moneVideoLinks as $key=>$moneVdoLink){
						  $arr     = explode("embed/",$moneVideoLinks[$key]["videoFile"]);
						  $title   = urlencode($moneVideoLinks[$key]["videoFile"]);
						  $url     = urlencode("https://www.youtube.com/watch?v=".$arr[1]);
						  $summary = urlencode(base_url());
						  $image   = urlencode("http://img.youtube.com/vi/$video_id/0.jpg");	  
			?>                                  
				<!--<div class="thum-del"  >-->
				<!--<img width="70" height="70" onclick="playVideoLink('<?php echo $moneVdoLink['videoFile'];?>')" alt="Play Video" src="<?php echo base_url();?>CT_images/play-videoimg.png" style="margin-right:25px;" id="empPic_ct">-->
				<li id="vdoLinkDivId<?php echo $i; ?>" class="videoli">
                      <iframe width="138" height="103" frameborder="0" allowfullscreen="" src="http://www.youtube.com/embed/<?php echo $arr[1];?>"></iframe>
                      <input type="hidden" name="youtubeUrl<?php echo $moneVideoLinks[$key]["id"];?>" id="youtubeUrl<?php echo $moneVideoLinks[$key]["id"];?>" value="<iframe width='138' height='103' frameborder='0' allowfullscreen='' src='http://www.youtube.com/embed/<?php echo $arr[1];?>'></iframe>" />
					<img src="<?php echo base_url(); ?>images/delete-icon-spon.png" onclick="delVideoLink(<?php echo $moneVdoLink['id'];?>, <?php echo $i; ?>)" class="delete-icon" />
			   </li>
				
				<!--</div-->
			<?php
					$i++;	
					} ?></ul>
					<?php 
					  } 
					  else{
						  ?><img width="70" height="70" alt="Video" src="<?php echo base_url();?>CT_images/no-video-small.png" style="margin-right:25px;" id="empPic_ct">
						  <?php
					  }?> 
			</div>
            <br class="clear">                      
		 <p style="margin-bottom:26px; margin-top:20px;">Upload Your Product Video</p>
                  <form class="rday" method="post" action="<?php echo base_url();?>dashboard/CT_profileVideoUpload/<?php echo $ct_pageId;?>" enctype="multipart/form-data">
                    <label style="display: block; clear: both;">
                    <input type="text" id="proVdoLink" name="proVdoLink" >
                    <input type="submit" value="Upload" name="uploadvideo" id="vdoLinkBtnId" <?php if(count($moneVideoLinks)==6){ ?> disabled="disabled"  <?php } ?> class="submit-bnt">
                    <div class="clear"></div>
                    </label>
                  </form>
      </div>
    </div>
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["H"]["serial_field"];?></strong>
      <h3 class="d_hdr" style="float: left; line-height: 70px;"><?php echo $stepWiseMoneVideo[0]["H"]["title"];?></h3>
     <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["H"]["path"];?>" id="tutorial-video-moneH" href="javascript:void(0)">Watch Video</a></span> 
      </div>
      <div class="load">
      <div class="your-pic">		 
    <form class="rday" method="post" action="<?php echo base_url();?>dashboard/CT_BannerUpload/<?php echo $ct_pageId;?>" enctype="multipart/form-data">       
     <?php
if(count($moneBannerImage)>0){
	$bannerTitle = "";
	if($moneBannerImage[0]['bannerTitle']!=""){
		$bannerTitle = $moneBannerImage[0]['bannerTitle'];
	}
			if($moneBannerImage[0]['bannerImage']!=""){
				   ?>
				   <img width="70" height="70" alt="" src="<?php echo $this->config->item('gbe_base_url'); ?>CT_sponcer_img/<?php echo $moneBannerImage[0]['bannerImage']; ?>" style="margin-right:25px !important;" id="empPic_ct"> 
              <?php 
			   }else{
				   ?>
				    <img width="70" height="70" alt="" src="<?php echo base_url();?>CT_images/no-banner-image.png" style="margin-right:25px;" id="empPic_ct">
              
				   <?php
			} } ?>             
		 <p style="margin-bottom:9px;">Upload Your Banner</p>
                   <input type="file" id="bannerfile" name="bannerfile" >
                    <label style="display: block; clear: both;">
					<p>Banner Title:
                     <input type="text" id="bannerTitle" name="bannerTitle" maxlength="30" value="<?php echo $bannerTitle; ?>" > </p>
                    
					
                  
                    <input type="submit" value="Upload" name="uploadBanner" class="submit-bnt">
                    <div class="clear"></div>
                    </label>
                  </form>
				  
      </div>
    </div>
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["I"]["serial_field"];?></strong>
      <h3 class="d_hdr" style="float: left; line-height: 70px;"><?php echo $stepWiseMoneVideo[0]["I"]["title"];?></h3>
      <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["I"]["path"];?>" id="tutorial-video-moneI" href="javascript:void(0)">Watch Video</a></span>  
      </div>
      <div class="load">
      <div class="your-pic">		 
<div class="sponcer-thumsec">
                  <?php if (count($galleryPics)>0){
					  $i=1;
					  foreach($galleryPics as $galPic){?>
                 <div class="thum-del" id="galImgDivId<?php echo $i; ?>"> <img style="margin-right:25px;" src="<?php echo $this->config->item('gbe_base_url');?>CT_sponcer_img/<?php echo $galPic['galleryImage'];?>"  width="70" height="70" alt="">
                 <img src="<?php echo base_url(); ?>images/delete-icon-spon.png" onclick="delGalleryImg(<?php echo $galPic['id'];?>, <?php echo $i; ?>)" class="delete-icon" />
                 </div>
                  <?php
					 
						$i++;	
						}
					} else {
					  ?>
					   <img id="empPic_ct" style="margin-right:25px;" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg"  width="70" height="70" alt="">
					  <?php
				  } ?>
                 </div>
            <br class="clear">    
		 <p style="margin-bottom:26px; margin-top:20px;">Upload your Gallery Image</p>
                  <form enctype="multipart/form-data" action="<?php echo base_url();?>dashboard/CT_galleryImgUpload/<?php echo $ct_pageId;?>" method="post" class="rday">
                    <label style="display: block; clear: both;">
                    <!--<input type="file" onchange="readURL_ct(this);" name="user_file" id="file">-->
					<input type="file" name="galleryImage" id="galleryImage" <?php if(count($galleryPics)==4){ ?> disabled="disabled"  <?php } ?>  >
                    <input type="submit" class="submit-bnt" id="galleryBtnId"  name="galupdate" value="update" <?php if(count($galleryPics)==4){ ?> disabled="disabled"  <?php } ?>  >
                    <div class="clear"></div>
                    </label>
                  </form>
      </div>
    </div> 
     <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["J"]["serial_field"];?></strong>
      <h3 class="d_hdr" style="float: left; line-height: 70px;"><?php echo $stepWiseMoneVideo[0]["J"]["title"];?></h3>
      <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["J"]["path"];?>" id="tutorial-video-moneJ" href="javascript:void(0)">Watch Video</a></span>  
      </div>
	  <div class="sponcer-thumsec">
                  <?php if (count($myTickets)>0){
					 
					  foreach($myTickets as $myTicketImg){?>
                 <div class="thum-del"> <img style="margin-right:25px;" src="<?php echo $this->config->item('gbe_base_url');?>CT_ticketFiles/<?php echo $myTicketImg['image_path'];?>"  width="70" height="70" alt="">

                 </div>
                  <?php					 
					
						}
					} else {
					  ?>
					   <img style="margin-right:25px;" src="<?php echo base_url();?>user/profilepicture/no_photo.jpg"  width="70" height="70" alt="">
					  <?php
				  } ?>
                 </div>
            <br class="clear">   
	  <br />
<br />

      <div class="load">
      <div class="your-pic">		 
                                              
                                                    
                                  
		 <p style="margin-bottom:26px;">Upload Your Tickets</p>
                  <form class="rday" method="post" action="<?php echo base_url();?>dashboard/CT_TicketUpload/<?php echo $ct_pageId;?>" enctype="multipart/form-data">
                    <label style="display: block; clear: both;">                   
                    <input type="file" id="ticketImage" name="ticketImage" >
                    <br /><br />
                    <p class="ticket-input"><span>Name :</span> <input name="ticketName" id="ticketName" type="text" /></p>
                     <p class="ticket-input"><span>Contact Number :</span> <input name="ticketcontact_number" id="ticketcontact_number" type="text" /></p>
                       <p class="ticket-input"><span>Start Date :</span> <input class="form-control datepicker" name="ticketStartDate" id="ticketStartDate" type="text" /></p>
                       <p class="ticket-input"><span>End Date :</span> <input class="form-control datepicker" name="ticketEndDate" id="ticketEndDate" type="text" /></p>
                        <p class="ticket-input"><span>Price :</span> <input name="ticketPrice" id="ticketPrice" type="text" /></p>
                        <p class="ticket-input"><span>City :</span> <input name="ticketCity" id="ticketCity" type="text" /></p>
                         <p class="ticket-input"><span>Zip Code :</span> <input name="ticketZip" id="ticketZip" type="text" /></p>
                     <p class="ticket-input"><span>Location :</span> <select name="ticketLocation" id="ticketLocation"></select></p>
                     <p class="ticket-input"><span>Description :</span> 
                     <textarea name="ticketDesc" id="ticketDesc" cols="" rows="" class="ticket-description"></textarea></p>
                     <p style="margin-bottom:10px;">Upload Your Tickets pdf : </p>
                      <input type="file" id="ticketPdf" name="ticketPdf" >
                     <br />
                    <input type="submit" value="Upload" name="uploadTicket" <?php if(count($myTickets)==4){ ?> disabled="disabled"  <?php } ?> class="submit-bnt">
                    <div class="clear"></div>
                    </label>
                  </form>
      </div>
    </div>
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["K"]["serial_field"];?></strong>
      <h3 class="d_hdr" style="float: left; line-height: 70px;"><?php echo $stepWiseMoneVideo[0]["K"]["title"];?></h3>
      <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["K"]["path"];?>" id="tutorial-video-moneK" href="javascript:void(0)">Watch Video</a></span> 
      </div>
      <div class="load">
      <div class="your-pic">		 
                 <?php if(count($brochure)>0){?>                             
            <img width="70" height="70" alt="" src="<?php echo $this->config->item('gbe_base_url');?>CT_sponcer_img/<?php echo $brochure[0]['brochureImage']?>" style="margin-right:25px;" id="empPic_ct">
				 <?php }
				 else{
					 ?>
					 <img width="70" height="70" alt="" src="<?php echo base_url();?>user/profilepicture/no-pdf.png" style="margin-right:25px;" id="empPic_ct">
			
					 <?php 
					 
				 }
?>				 
		 <p style="margin-bottom:26px;">Upload Your Brochure</p>
                  <form class="rday" method="post" action="<?php echo base_url();?>dashboard/CT_brochureUpload/<?php echo $ct_pageId;?>" enctype="multipart/form-data">
                    <label style="display: block; clear: both;">
                    <!--<input type="file" name="brochurefile" value="<?php echo $brochure[0]['brochureImage']; ?>" >-->
					<input type="file" name="brochurefile" value="" >
                    <br /><br />
                     <p style="float: left; width: 85px;">Message : </p><textarea name="brochureMsg" cols="" rows="" style="height: 48px; width: 237px;"><?php echo $brochure[0]['brochureMsg']?></textarea><br />
                   <br /><br />
				   <p style="float: left; width: 85px;">Offer Video : </p><input type="text" name="brochureVideoLink" id="brochureVideoLink" value="<?php echo $brochure[0]['brochureVideo']; ?>" > <br />
                   <input type="submit" value="Upload" name="uploadbrochure" class="submit-bnt">
                    <div class="clear"></div>
                    </label>
                  </form>
      </div>
    </div>
    <br class="clear">
    <div class="ab_inner"><strong><?php echo $stepWiseMoneVideo[0]["L"]["serial_field"];?></strong>
      <h3 class="d_hdr"><?php echo $stepWiseMoneVideo[0]["L"]["title"];?></h3>
      <!-- <h3></h3>--> 
      <span> <a class="watch-video-tut1" name="<?php echo $stepWiseMoneVideo[0]["L"]["path"];?>" id="tutorial-video-moneL" href="javascript:void(0)">Watch Video</a></span> </div>
      <div id="slides" style="height:220px; width:540px;">
      <?php  if($source_pic !=""){
	  foreach($source_pic as $sp){?>
      <div class="from_sorce">
		<img style="width:175px !important;" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/productPagesImg/<?php echo $sp['image'];?>" alt="">
		<p><?php echo $sp['description'];?></p>
	        <br class="clear">
      	</div><?php } }?>

        </div>
        <!-- a class="step2_new" href="<?php echo base_url();?>dashboard/product_view_List">Click here to go product page</a><br>
		<a class="step2_new" href="<?php echo base_url();?>dashboard/ct_meetsup_product">Click here meetsup</a><br>
		<a class="step2_new" href="<?php echo base_url();?>dashboard/ct_models_product">Click here models</a><br>
		<a class="step2_new" href="<?php echo base_url();?>dashboard/ct_music_product">Click here music</a><br>
		<a class="step2_new" href="<?php echo base_url();?>dashboard/ct_nutri_product">Click here nutri</a><br>
		<a class="step2_new" href="<?php echo base_url();?>dashboard/ct_realestate_product">Click here realestate</a-->
  </div>


		   </div><!--Monetizer tab end-->
		  <!--step4 for checking-->
		  <div id="tab5">
			<h1 id="tab5h1">
			You Must pay for this Area ...</h1>
		  </div>
        </div>
      </div>
    </div>
    </div>
    <!-- left side tab end--> 
     <!-- right side tab start--> 
  <?php $this->load->view("right_panel", "", $result); ?>
  
  <!-- rights side end -->
  <div class="clear"></div>
</div>
<!--08/10/2015 ujjwal sana -->
<!-- footer table start-->
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
   <!-- footer table end-->


 

<!-- main container end -->

<?php if($_SESSION['UID'] == 1054){?>

<!--<div class="table-status">

	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">

<input type="hidden" name="cmd" value="_s-xclick">

<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHmQYJKoZIhvcNAQcEoIIHijCCB4YCAQExggE6MIIBNgIBADCBnjCBmDELMAkGA1UEBhMCVVMxEzARBgNVBAgTCkNhbGlmb3JuaWExETAPBgNVBAcTCFNhbiBKb3NlMRUwEwYDVQQKEwxQYXlQYWwsIEluYy4xFjAUBgNVBAsUDXNhbmRib3hfY2VydHMxFDASBgNVBAMUC3NhbmRib3hfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMA0GCSqGSIb3DQEBAQUABIGAoLXv8xaD5vB+I4FFoKIi7IFFxleVny5IZZGwRfIJFYvFWyYalwpV9XlzzJiZEJjlwAVEk4m8pTtUSh6bxxWeqIuyXBsSKgnG59vWajQ3qAEqbCaJgFP4Se94rQJ49IBPXRqo7tUFrI4UF8xGEU/gaRgiqEdRKb7xDwdvEmHPzb0xCzAJBgUrDgMCGgUAMIHkBgkqhkiG9w0BBwEwFAYIKoZIhvcNAwcECEIG+UKdUBrpgIHAyps6IzyZtFf29/S294XeTFePw9gCz3M371ddKQFpurPhzHObKzqKban8U3kdN1cZAtxMYMbWofSQEmQGIioWvoQ833sAjVRrWjoRDmfdzPi/j3vtYYqWHZKyfqGQJHKqzt7eAtr/nBNEcmSRL7TABzEEU+d4cZIxFNmYaLKMrqc2Br6TKRa1TOPFBAHWD53gWkNrblLCdOqrDplq813VSNYPVv3NjkwL7y95g1w+eh8rUAPwQ8KY/qvVTfsd7jS2oIIDpTCCA6EwggMKoAMCAQICAQAwDQYJKoZIhvcNAQEFBQAwgZgxCzAJBgNVBAYTAlVTMRMwEQYDVQQIEwpDYWxpZm9ybmlhMREwDwYDVQQHEwhTYW4gSm9zZTEVMBMGA1UEChMMUGF5UGFsLCBJbmMuMRYwFAYDVQQLFA1zYW5kYm94X2NlcnRzMRQwEgYDVQQDFAtzYW5kYm94X2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTAeFw0wNDA0MTkwNzAyNTRaFw0zNTA0MTkwNzAyNTRaMIGYMQswCQYDVQQGEwJVUzETMBEGA1UECBMKQ2FsaWZvcm5pYTERMA8GA1UEBxMIU2FuIEpvc2UxFTATBgNVBAoTDFBheVBhbCwgSW5jLjEWMBQGA1UECxQNc2FuZGJveF9jZXJ0czEUMBIGA1UEAxQLc2FuZGJveF9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBALeW47/9DdKjd04gS/tfi/xI6TtY3qj2iQtXw4vnAurerU20OeTneKaE/MY0szR+UuPIh3WYdAuxKnxNTDwnNnKCagkqQ6sZjqzvvUF7Ix1gJ8erG+n6Bx6bD5u1oEMlJg7DcE1k9zhkd/fBEZgc83KC+aMH98wUqUT9DZU1qJzzAgMBAAGjgfgwgfUwHQYDVR0OBBYEFIMuItmrKogta6eTLPNQ8fJ31anSMIHFBgNVHSMEgb0wgbqAFIMuItmrKogta6eTLPNQ8fJ31anSoYGepIGbMIGYMQswCQYDVQQGEwJVUzETMBEGA1UECBMKQ2FsaWZvcm5pYTERMA8GA1UEBxMIU2FuIEpvc2UxFTATBgNVBAoTDFBheVBhbCwgSW5jLjEWMBQGA1UECxQNc2FuZGJveF9jZXJ0czEUMBIGA1UEAxQLc2FuZGJveF9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb22CAQAwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOBgQBXNvPA2Bl/hl9vlj/3cHV8H4nH/q5RvtFfRgTyWWCmSUNOvVv2UZFLlhUPjqXdsoT6Z3hns5sN2lNttghq3SoTqwSUUXKaDtxYxx5l1pKoG0Kg1nRu0vv5fJ9UHwz6fo6VCzq3JxhFGONSJo2SU8pWyUNW+TwQYxoj9D6SuPHHRTGCAaQwggGgAgEBMIGeMIGYMQswCQYDVQQGEwJVUzETMBEGA1UECBMKQ2FsaWZvcm5pYTERMA8GA1UEBxMIU2FuIEpvc2UxFTATBgNVBAoTDFBheVBhbCwgSW5jLjEWMBQGA1UECxQNc2FuZGJveF9jZXJ0czEUMBIGA1UEAxQLc2FuZGJveF9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwCQYFKw4DAhoFAKBdMBgGCSqGSIb3DQEJAzELBgkqhkiG9w0BBwEwHAYJKoZIhvcNAQkFMQ8XDTE0MDMxOTE1NDAwN1owIwYJKoZIhvcNAQkEMRYEFKFUcxYBO8L0CQ7E09KYsSh3efp5MA0GCSqGSIb3DQEBAQUABIGASW4UAYssykPEkIemCWmz9iDofNZYhVuEu/t0VGlnA0qhXpIms5rFhXODw5ov7jMBsV/xHnZER1fVRcRts8Rr2hTpto6hqmEAtz6zlHW00fPYQrfKUWGX8Yv13p5VpAMzZtS0Anxm9seDV4kTthvMXYXGJ9+oEkyZbAndV6AdLt0=-----END PKCS7-----

">

<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">

</form>

	</div>-->

<?php }?>
<style>
.clk_pr_inv {
    overflow-y: scroll; height: 290px;
}
  </style>
<!--footer style--> 

<script type="text/javascript">





var postImage = "<?php echo count($result['getFbPictureUpload']); ?>";

var countBanner = "<?php echo count($result['showUserBanner']); ?>";

var postYoutube = "<?php echo count($result['getYoutubeUrlLink']); ?>";
$(document).ready(function(){ 

	/*

	for(var j=0;j<postImage;j++){

		$('a#po_image'+j).zclip({			

			path:'<?php echo base_url(); ?>/Application/content/member/js/ZeroClipboard.swf',			

			copy:$('input#imagePost'+j).val(),

			beforeCopy:function(){

			$('input#imagePost'+j).css('background','yellow');

			$(this).css('color','orange');

			},

			afterCopy:function(){

			$('.tpbb a').css('background','');

			$('.tpbb a').css('color','');

			$(this).css('background','green');

			$(this).css('color','purple');

			//$(this).next('.check').show();tpbb

			}

		});

	}

		

//});



//$(document).ready(function(){ 	

	for(var i=0;i<countBanner;i++){

		$('a#coppy'+i).zclip({

			path:'<?php echo base_url(); ?>/Application/content/member/js/ZeroClipboard.swf',			

			copy:$('input#banner'+i).val(),

			beforeCopy:function(){

			$(this).css('background','yellow');

			$(this).css('color','orange');

			},

			afterCopy:function(){

			$('.mbr a').css('background','blue');

			$('.mbr a').css('color','white');

			$(this).css('background','green');

			$(this).css('color','white');

			}

		});

	}

		

//});





//$(document).ready(function(){ 	

	for(var k=0;k<postYoutube;k++){		

		$('a#postYoutube'+k).zclip({			

			path:'<?php echo base_url(); ?>/Application/content/member/js/ZeroClipboard.swf',			

			copy:$('input#youtube'+k).val(),

			beforeCopy:function(){

			$('input#youtube'+k).css('background','yellow');

				$(this).css('color','orange');

			},

			afterCopy:function(){

			    $('.cbz a').css('background','#031F30');

				$('.cbz a').css('color','white');

				$(this).css('background','green');

				$(this).css('color','white');

				//$(this).next('.check').show();cbz

			}

		});

	}*/

		

});

/* $(document).ready(function(){
	var showId = '<?php echo $openShowId;?>';
	alert(showId);
	if(showId == "edit_product_id"){
		$("#edit_product_id").show();
	}
}); */
function showAlert(){
	$.fancybox.open('Please delete the Image before another Upload.');
	return false;
}
// delete topsix product added by SB on 02/03/2016
function delTopSixPro(topSixProId, divNo, moneType){
	// delete the value
	if(topSixProId>0)
	{
		$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/delTopSixProduct", 
			 data: "topSixProId="+topSixProId+"&moneType="+moneType,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	//alert(data);
						$.fancybox.open('Top Listing product Deleted Successfully');
						//update the sponcer Img count
						if(moneType==2){
							if(data<1){
								$('#updateTopSix').removeAttr("disabled"); // check monetype condition 								
								
							}	
						}
						else if(moneType==3){
							if(data<9){
								$('#updateTopSix').removeAttr("disabled"); // check monetype condition 								
								
							}
						}else{
							if(data<6){
								$('#updateTopSix').removeAttr("disabled"); // check monetype condition 
								
							}	
						}
						$('#topSixDivId'+divNo).html('');				
											
					}
					else{
						alert('some error ');
					}
				  }
			  });
	}
}
// delete sponcer image added by SB on 10/02/2016
function delSponcerImg(sponImgId, divNo){
	// delete the value
	if(sponImgId>0)
	{
		$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/delSponcerImage", 
			 data: "sponImgId="+sponImgId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	//alert(data);
						$.fancybox.open('Sponcer Image Deleted Successfully');
						//update the sponcer Img count
						if(data<3){
							$('#sponcerBtnId').removeAttr("disabled");
							$('#spfile').removeAttr("disabled");
							$('#spImgDivId'+divNo).html('');
						}					
											
					}
					else{
						alert('some error ');
					}
				  }
			  });
	}
	
}
// delete gallery image added by SB on 10/02/2016
function delGalleryImg(galImgId, divNo){
	// delete the value
	if(galImgId>0)
	{
		$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/delGalleryImage", 
			 data: "galImgId="+galImgId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	//alert(data);
						$.fancybox.open('Gallery Image Deleted Successfully');
						//update the sponcer Img count
						if(data<4){
							$('#galleryBtnId').removeAttr("disabled");
							$('#galleryImage').removeAttr("disabled");
							$('#galImgDivId'+divNo).html('');
						}					
											
					}
					else{
						alert('some error ');
					}
				  }
			  });
	}
	
}
// delete video Links added by SB on 11/02/2016
function delVideoLink(videoLinkId, divNo){
	// delete the value
	if(videoLinkId>0)
	{
		$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/delVdoLink", 
			 data: "videoLinkId="+videoLinkId,
			 cache:false,
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data)
					{	//alert(data);
							$.fancybox.open('Video Link Deleted Successfully');
						//update the Video Link count
						if(data<6){
							$('#vdoLinkBtnId').removeAttr("disabled");
							$('#vdoLinkDivId'+divNo).html('');
						}					
											
					}
					else{
						alert('some error ');
					}
				  }
			  });
	}
	
}

$(document).ready(function() {
	//Default Action
	//11/09/2015 done by ujjwal sana
	 var tabId = '<?php echo $openTabId;?>';
	 if(tabId=="tab4")
	 {
	 	showProdict_UploadTab();
	 }else if(tabId=="tab3")
	 {
		 showThirdTab();
	 }	
	 else if(tabId=="tab2")
	 {
		 showSecondTab();
	 }
	else if(tabId=="tab5")
	{
		no_permission();
	
	}
	else if(tabId=="tab6"){
		
	 
		showMonetizerTab();
	}else{
		showFirstTab();
		
	}

	//On Click Event

	$("ul.tabs li").click(function(e) {

		for(var k=0;k<postYoutube;k++){		

		$('a#postYoutube'+k).zclip({			

			path:'<?php echo base_url(); ?>Application/content/member/js/ZeroClipboard.swf',			

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
		$("#tab5h1").hide();
		$("#analytics").show();
		$(".webbox1").hide();
		$(".tab_content").hide(); //Hide all content
		$("ul.tabs li:first").addClass("active").show(); //Activate first tab
		//$("ul.tabs li:nth-child(3)").addClass("active");
		$(".tab_content:first").show(); //Show first tab content
}
	function showMonetizerTab()
	{  
		$("#tab5h1").hide();
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		//$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		$("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$("#analytics").show();
		$(".webbox1").hide();
		$("#tab6").show(); 
		return false;
	}
function showSecondTab(){
		$("#tab5h1").hide();
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		$("#analytics").show();
		$(".webbox1").hide();
		$("#tab2").fadeIn(); //Fade in the active content

		return false;

}
function showThirdTab(){
		$("#tab5h1").hide();
		$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(3)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content
		$("#analytics").show();
		$(".webbox1").hide();
		$("#tab3").fadeIn(); //Fade in the active content

		return false;

}
function showProdict_UploadTab(){
		 
			//alert(afrooPaymentStatus);
			$("#tab5tab5h1").hide();
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$("ul.tabs li:nth-child(4)").addClass("active"); //Add "active" class to selected tab
			$(".tab_content").hide(); //Hide all tab content
			$("#tab4").fadeIn(); //Fade in the active content
			$("#analytics").hide();
			$(".webbox1").show();
			$("#edit_product_id").hide();
			$show_edit_div='<?php echo $show_edit;?>';
			if( $show_edit_div == "show")
			{
				$("#edit_product_id").show();
			}
			return false;
		
}
function no_permission()
{
		$("#tab5h1").show();
		$(".tab_content").hide(); //Hide all tab content
		$("#analytics").hide();
		$("#edit_product_id").hide();
}


function valFormCountryCode(){

	if($("#country").val() == "0"){

		alert("Please select country before submission");

		return false;	

	}else{

		return true;

	}

}



function valaddFreeBiesCodeForDouble(){

	if($("#pearlCode").val() == ""){

		alert("Please put your pearl chest code before submission");

		return false;	

	}else{

		return true;

	}

}

function valAddSilverChestCode(){

	if($("#silverCode").val() == ""){

		alert("Please put your silver chest code before submission");

		return false;	

	}else{

		return true;

	}

}
 
$(document).ready(function() {
	//Default Action
/*11/09/2015  by ujjwal sana*/
	/*$(".tab_content").hide(); //Hide all content

	$("ul.tabs li:first").addClass("active").show(); //Activate first tab

	$(".tab_content:first").show(); //Show first tab content*/

	

	//On Click Event

	$("ul.tabs li").click(function(e) {

		

		for(var k=0;k<postYoutube;k++){		

		$('a#postYoutube'+k).zclip({			

			path:'<?php echo base_url(); ?>Application/content/member/js/ZeroClipboard.swf',			

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

	$("#getNames").click(function() {

		$.fancybox.open('<?php for($i=0;$i<count($result['getNamesUID']);$i++){?><li><?php echo $result['getNamesUID'][$i]['FirstName']."&nbsp;".$result['getNamesUID'][$i]['LastName']; ?></li><?php }?>');

	});
 
 // mone step wise video link added by SB on 07/03/2016
	$("#tutorial-video-moneA").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneB").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneC").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneD").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneE").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneF").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneG").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneH").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneI").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneJ").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneK").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});
	$("#tutorial-video-moneL").click(function() {
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});

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
/*function funToggleSupport(id){
	var myArray = id.split('_');
	//alert(myArray);
	$("#slist_"+myArray[1]).slideToggle();
}

$(document).ready(function() {

	$("#person_list3").click(function(){

		$("#plist3").slideToggle();

	})	

});*/

/*$(document).ready(function() {

	//var SlideCont = $(".social_media li").child(".list_service");

	$(".social_media li a").click(function(event){

		event.preventDefault();

		//$(SlideCont).hide();

		//$(this).parent("").slideToggle();

		alert();

		$(SlideCont).slideToggle();

	})	

});*/

/*$(function () {

    $('.social_media li').click(function () {

		alert(this);

        $(this).next('div.list_service').slideToggle();



        $(this).parent().siblings().children().next().slideUp();

        return false;

    });

});*/

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
<?php if( $_REQUEST["action"] == "pdfDownload"){?>
<script>  

      $(document).ready(function() {

	  	$("ul.tabs li").removeClass("active"); //Remove any "active" class

		$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab

		$(".tab_content").hide(); //Hide all tab content

		$("#tab2").fadeIn(); //Fade in the active content
		
	
		

	  });

  </script>
 <?php }?>


<script>
function copyToClipboardMsg(elem, msgElem) {
	  var succeed = copyToClipboard(elem);
    var msg;
    if (!succeed) {
        msg = "Copy not supported or blocked.  Press Ctrl+c to copy."
    } else {
        msg = "Text copied to the clipboard."
    }
    if (typeof msgElem === "string") {
        msgElem = document.getElementById(msgElem);
    }
    msgElem.innerHTML = msg;
    setTimeout(function() {
        msgElem.innerHTML = "";
    }, 2000);
}

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
	
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

</script>