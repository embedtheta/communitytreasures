<?php if( $parentInfo[0]["paypalAC"] =="" ){
  $parentInfo[0]["paypalAC"] = "paytestevika-facilitator@gmail.com";
   }
?>
<?php $this->load->view("header", "", $result); ?>
<script type="text/javascript">

/*################ START added by SD 31-08-2017 to add location into offer #######*/
// added by SB on 01/03/2016
	 $("#offerCountry").change(function() {
		//alert('==selcet val---'+$("#offerCountry").val()) ;
		var selectedCountryId =$("#offerCountry").val();
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
						$("#offercity option").remove();									
						$('#offercity').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
	 });



	 function CT_offer_openCityAddCityDiv(){
	 //alert('show');
	 $('#CT_offer_newCity').css('display','block');
	// alert($('#country').val()+'====='+$('#newVendorCity').val());
 }

  function CT_offer_addNewCity(){
	// $('#newCity').css('display','none');
	 //alert($('#country').val()+'====='+$('#newVendorCity').val());
	 var selectedCountryId =$('#offerCountry').val();
	 var newCityName = $('#offercity').val();
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
						$('#CT_offer_newCity').val('');
						$('#CT_newCity').css('display','none');
						$("#offercity option").remove();									
						$('#offercity').append(data.cityList);					
					}
					else{
						alert(data.message);
					}
				  }
			  });
		}
 }
 function closeNewCity_offer_Div(){
	 $('#offerCity').val('');
	$('#CT_offer_newCit').css('display','none');
	$('#CT_offer_newCity').css('display','none');//for ct dashboard
	$('#CT_offer_newCity').css('display','none');
	
 }

	 /*#########################################	 END ###*/

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
	
	if( balanceInCA < 49.99 ) {
		$.fancybox.open('<p style="text-align:center" margin:10px 0;>You have insufficient fund in your account. Do you want to top up your account to upgrade your account.<br>Then please click on the top up button.<br><br><a href="<?php echo base_url();?>currentaccount/topUp" class="topup" >Top Up</a></p>');
	} else {
		//window.location.href='<?php echo base_url();?>gbe_payment/switchOn'; // blocked by Sb on 25/09/2015
		window.location.href='<?php echo base_url();?>gbe_payment/switchOn/1'; // parameter set to use switchon for all levels  Added by S on 25/09/2015
		return true;
	}
}
</script>
<script>
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
</script>
<script>

//9/9/2015 changes by ujjwal sana 
$(document).ready(function(e) {
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
<?php //print_r($stepWiseVideo); die; ?>
<script type="text/javascript">
jQuery(function ($) {
	// Load dialog on click
	$("#tutorial-video101").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/ilhnNa-DrIk<?php //echo $stepWiseVideo[1][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
	$("#tutorial-videoSH_for_profile_detail").click(function() {
			$.fancybox.open('<iframe width="560" height="315" src="https://www.youtube.com/embed/TTgNlfAht4I<?php //echo $stepWiseVideo[1][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
	
		 
		 //30-10-2015 added by ujjwal sana	 
		 $("#tutorial-video1f").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/e9Dpy3yvEyg<?php //echo $stepWiseVideo[1]['F']["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video103").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[3][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 //30/10/2015 added by ujjwal sana 
         $("#tutorial-video-v-add").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][A]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#watch-video-tut4C").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/d2XB056HDjk<?php //echo $stepWiseVideo[4][C]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#watch-video-tut4E").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][E]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
	
	$("#tutorial-videoSH").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/F7ayGFHGqeQ<?php //echo $stepWiseVideo[4][E]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
    
});

 function CT_openCityAddCityDiv(){
	 //alert('show');
	 $('#CT_newCity').css('display','block');
	// alert($('#country').val()+'====='+$('#newVendorCity').val());
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
///////////////////////////Offer add city////////////////////////////////////

  function CT_offer_addNewCity(){
	 var selectedofferCountryId =$('#offerCountry').val();
	 var newOfferCityName = $('#offerCity').val();
	if(selectedofferCountryId>0 && newOfferCityName!=''){
			
			$.ajax({
			 type: "POST",
			 url:  "<?php echo base_url();?>dashboard/addNewCity", 
			 data: "countryId="+selectedofferCountryId+"&newCityName="+newOfferCityName,
			 cache:false,
			 dataType: "json",
			 success: 
				  function(data){
				   //alert(data);  //as a debugging message					
					if(data.success == "yes")
					{	
						alert('City added Successfully');
						$('#offerCity').val('');
						$('#CT_offer_newCity').css('display','none');
						$("#offercity option").remove();									
						$('#offercity').append(data.cityList);					
					}
					else{
						alert(data.message);
					}
				  }
			  });
		}
 }
 function closeNewCity_offer_Div(){
	 $('#offerCity').val('');
	$('#offernewCity').css('display','none');
	$('#CT_offer_newCity').css('display','none');//for ct dashboard
	$('#City_newCity').css('display','none');
	
 }




////////////////////////////offer add city end////////////////////////////////// 
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
    
    
    /*---------------------------------------------*/
    $(document).ready(function() {
    	$("#btneditprofile").unbind().bind("click", function(event) {    		
    		event.preventDefault();
    		
    		if($("#txtfname").val() == '') {
				$.fancybox.open("Please enter First Name.");
        		$("#txtfname").focus();
        		return false;
			} else if($("#txtlname").val() == '') {
				$.fancybox.open("Please enter Last Name.");
        		$("#txtlname").focus();
        		return false;
			} else if($("#txtemail").val() == '') {
				$.fancybox.open("Please enter Email adress.");
        		$("#txtemail").focus();
        		return false;
			} /*else if($("#city_name").val() == '') {
				$.fancybox.open("Please select city.");
        		$("#city_name").focus();
        		return false;
			}*/ else if($("#profileCountry").val() == ''){
				$.fancybox.open("Please select country.");
        		$("#profileCountry").focus();
        		return false;
			} else {				
				$.ajax({
						
						type: 'post',
						url	: '<?php echo base_url();?>dashboard/edit_ap_profile',
						data: $('#frmeditprofile').serialize(),
						success: function (data) {
						  $.fancybox.open("Profile data updated successfully.");
						}
				});
			}
    	});
		
		$("#passwordUpdate").unbind().bind("click", function(event) {    		
    		event.preventDefault();			
			$.ajax({
						
					type: 'post',
					url	: '<?php echo base_url();?>dashboard/changePassword',
					data: $('#changePasswordId').serialize(),
					success: function (data) {					
					  
						  $.fancybox.open(data);					  
					  
					}
				});
			
		
		});
		
		$('#prd_upld_sec')
		.unbind()
		.bind('submit', function (event) {
			event.preventDefault();
											
				var vAdd 			= $("#productName").val();
				var vEmail 			= $("#productPrice").val();
				var vQuantity 		= $("#productQuantity").val();
				var mainImg 		= $("#mainImageId").val();
				var prodType 		= $("#typeOfProduct").val();
				if(vAdd == ""){
					$.fancybox.open("Please enter the Name of your Product.");
					$("#productName").focus();
					return false;
				}	        
				if(vEmail == ""){
					$.fancybox.open("Please enter the Price of your Product.");
					$("#productPrice").focus();
					return false;
				}	        
				if(prodType == "2") {
					if(vQuantity == "" ||  vQuantity == 0 ){
						$.fancybox.open("Please enter the Quantity of your Product.");
						$("#productQuantity").focus();
						return false;
					}
				} 	        
				if(mainImg == "") {
					$.fancybox.open("Please upload main Image of your Product.");
					$("#mainImageId").focus();
					return false;
				}	       
				else{
					
					$("#myLoaderDiv").html('<img src="<?php echo base_url();?>images/ajax-loader.gif" alt="Wait" />');
					var form_data = new FormData(this); //Creates new FormData object
					var post_url = $(this).attr("action"); //get action URL of form
					
					//jQuery Ajax to Post form data
					$.ajax({
						url : post_url,
						type: "POST",
						data : form_data,
						contentType: false,
						cache: false,
						processData:false,
						dataType : 'JSON',
						mimeType:"multipart/form-data"
					}).done(function(result){ //
							$("#myLoaderDiv").html('');
							//alert(result);
							if(result['process']=="success"){
							$("#prd_upld_sec").trigger('reset');
							$("#product_list").html(result['HTML']);
							//$("#offer_details").attr('disabled','disabled');
							var productId = result['productId'];
							$.fancybox({ content: '<div style="width:440px;height:120px;background-color:#93BF40;padding-top:80px"><h1  style="color:white;text-align:center; font-size:18px;">You have successfully uploaded your offer.</h1><a href="https://www.communitytreasures.co/ctdemo/product/details/'+productId+'" class="oktab">View your recent uploaded Offer</a></div>' });
						}	 
					});
				}			
		});
   	
		$("#Account_tab").click(function(){		
			$("#pro_upload").hide();
			$("#acc_details").show();
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$("ul.tabs li:first").addClass("active").show(); //Activate first tab			
			
		});
		$("#Product_tab").click(function(){
			$("#acc_details").hide();			
			$("#pro_upload").show();
			$("ul.tabs li:nth-child(2)").addClass("active");
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab		
		});	
		$("#next_button").click(function() {
			$("#acc_details").hide();			
			$("#pro_upload").show();
			$("ul.tabs li:nth-child(2)").addClass("active");
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$("ul.tabs li:nth-child(2)").addClass("active"); //Add "active" class to selected tab
		});
    });	
	
	$(document).unbind().on('click','.product_edit',function(event){			
			event.preventDefault();
			var edit_url = $(this).attr("href");
			$.ajax({
					url : edit_url,
					dataType : 'JSON'					
				}).done(function(result){					
					if(result['process']=="success"){
						
						$("#edit_product_id").html(result['HTML']);
						$("#edit_product_id").show();
					}	 
				});
		});
		
	$(document).on('submit','#prd_edit_sec',function(event) {
		event.preventDefault();		
		
		var vAdd = $("#productNameEdit").val();
		var vPrice = $("#productPriceEdit").val();
		var vQuantity = $("#productQuantityEdit").val();
		var mainImg = $("#mainImageIdEdit").val();
		var prodType = $("#typeOfProductEdit").val();	        
		if(vAdd == ""){
			$.fancybox.open("Please enter the Name of your Product.");
			$("#productNameEdit").focus();
			return false;
		}  
		if(prodType == "2")
		{    
			if(vQuantity == "" ||  vQuantity == 0 ){
				$.fancybox.open("Please enter the Quantity of your Product.");
				$("#productQuantityEdit").focus();
				return false;
			}
		}   
		if(vPrice == ""){
			$.fancybox.open("Please enter the Price of your Product.");
			$("#productPriceEdit").focus();
			return false;
		}
		else{
				$("#myUpdateLoaderDiv").html('<img src="<?php echo base_url();?>images/ajax-loader.gif" alt="Wait" />');
				var form_data = new FormData(this); //Creates new FormData object
				var post_url = $(this).attr("action"); //get action URL of form									
				$.ajax({
					url : post_url,
					type: "POST",
					data : form_data,
					contentType: false,
					cache: false,
					processData:false,
					dataType : 'JSON',
					mimeType:"multipart/form-data"
				}).done(function(result){
					$("#myUpdateLoaderDiv").html();
					if(result['process']=="success"){														
						$("#edit_product_id").hide();							
						$("#product_list").html(result['HTML']);													
						$.fancybox.open("You have successfully edit the offer detail.");						
					}	 
				});			
		}
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
    .slidesjs-previous.slidesjs-navigation, .slidesjs-next.slidesjs-navigation, .slidesjs-stop.slidesjs-navigation, .slidesjs-play.slidesjs-navigation {
	display:none !important;
}
.slidesjs-pagination {
	position:absolute;
	bottom:9px;
	left:21px;
}
.slidesjs-pagination-item {
	float: left;
	position: relative;
	z-index: 99999;
	width:12px;
	height:12px;
	background:#fff;
	border:1px solid #5b626c;
	margin-right:12px;
	font-size:12px;
	line-height:12px !important;
	color:#fff !important;
}
.slidesjs-pagination a {
	color:#fff !important;
}
.slidesjs-pagination a.active {
	background:#e5082e;
	display:block;
	width:12px;
	height:12px;
	padding:0;
	cursor:pointer;
	color:red !important;
}


.vouchercode {
 
}


</style>

<?php 

    }

?>
<?php //$this->load->view("nav_header", "", $result); ?>

<!--<div class="nav">sadasdasda

         <div class="clear"></div>

         </div>-->

<!--ADDING COMMON FORM-->

<?php //$this->load->view("commonform", "", $result); ?>

<!--END OF ADDING COMMON FORM-->

<!-- header end -->

<!-- main container start -->
<br class="clear" />
</div>
<div>
<div class="watchvideo-popuptab newsecvideopopp">

  <ul>

<li><a id="adVideoLinkId01" name="https://www.youtube.com/embed/GZ6_f7N7VPw">
<div class="left-newsteptext">Step 1 <br />
<strong>Watch This Video</strong> 
<p style="font-size: 30px; line-height: 30px;">How It<br />
 Works</p></div>
<div class="step-vidpic">
<img src="<?php echo base_url(); ?>images/vid-thuum.png" alt="" class="big" >
<img src="<?php echo base_url(); ?>images/video-playicon.png" alt="" class="play-icon"  >
</div>
<br class="clear" />
</a>

</li>

<li>
<a id="adVideoLinkId02" name="https://www.youtube.com/embed/ueFzQ5tvJ7o">
<div class="left-newsteptext">Step 2 <br />
<strong>Watch This Video</strong>
<p style="height: 26px; font-size: 20px; padding-top: 15px;"><!--Start Earning--></p>
<!--<span class="apbb-button">Get B.B Account</span>-->
</div>
<div class="step-vidpic">
<img src="<?php echo base_url(); ?>images/vid-thuum.png" alt="" class="big" >
<img src="<?php echo base_url(); ?>images/video-playicon.png" alt="" class="play-icon"  >
</div>
<br class="clear" />
</a></li>

<li><a id="adVideoLinkId03" name="https://www.youtube.com/embed/Tse52gr7jxI" style="line-height: 16px;">
<div class="left-newsteptext">Step 3 <br />
<strong>Watch This Video </strong>
<p style="height: 26px; font-size: 20px; padding-top: 15px;">Start Earning</p>
<span class="apbb-button">Get B.B Account</span></div>
<div class="step-vidpic">
<img src="<?php echo base_url(); ?>images/vid-thuum.png" alt="" class="big" >
<img src="<?php echo base_url(); ?>images/video-playicon.png" alt="" class="play-icon"  >
</div>
<br class="clear" />
</a>

<!--<img src="<?php// echo base_url(); ?>images/sicon.png" alt="" class="downarrow" >--></li>

</ul>
<!--<p style="clear: both; background: #fff; text-transform: uppercase; font-size: 18px; width: 200px; padding: 5px 10px; float: right; margin-top: -57px; margin-bottom: 21px; z-index: 9 !important; position: relative; text-align: center; border: 1px solid #777777; border-radius: 3px; margin-right: 40px;"><a href="#" style="color:#5c5c5c;">Get an ap Package</a></p>-->
  </div>
</div>
<div class="main_container_new ddsh"> 

  
  <!-- lefts side start -->
  
  <div class="lefts_side"> 
    
    <!--tab start-->
    
    <div class="tabsectionstep">
      <div class="containertab">  
		 <div class="tab_container" style="width:610px;">
          <div class="tab_content" id="tab1" style="display: block;">
            <!--<div class="yvideo extra-pad"> <span class="watch-thisvideo"><?php //echo $stepWiseVideo[1][1]["content_title"];?></span>
              <div class="palvidd" style="width:540px; height:320px; margin:0 auto;"><a href="javascript:void(0)" id="tutorial-video101"><img src="<?php //echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php //echo $stepWiseVideo[1][1]["content_image"];?>" width="527" height="320" alt="" /> </a></div>
            </div>-->
            <h3 class="headign-left" style="padding-left:0; color: #c0c7d8; font-weight: bold; font-size: 27px;line-height: 30px; margin-bottom:25px;"><!--<?php //echo $stepWiseVideo[1][1]["content"];?>-->
Fill In The Forms Below To Start<br />
Your Marketing Campaign</h3>
           <!-- <div class="rarrow"><img src="<?php //echo base_url(); ?>images/rarrow.png" border="0" alt=""  /></div>-->
            <div class="clear"></div>
			<ul class="tabs" style="margin-bottom: 15px;  border-bottom: 2px solid #e4e9ef; height: 36px;">
				<?php /*if($ct_url) {?>
				<li class="active"><a rel="tab6" href="javascript:void(0)" onclick="showMonetizerTab()"><?php echo $tab6Name;?><span>&nbsp;</span></a></li>
				<?php }*/ ?>
				  <li class="active" id="Account_tab"><a rel="tab1" href="javascript:void(0)">Account Details<span>&nbsp;</span></a></li>
				  <li id="Product_tab"><a rel="tab4" href="javascript:void(0)">Upload Offer<span>&nbsp;</span></a></li>
				 
			</ul>
			
			<!--  Profile Details  START -->
			<div id="acc_details">
              <div class="ab_inner"><strong>A</strong>
                <h3 class="d_hdr">Profile Details</h3>
                <span id="passCh"><a class="watch-video-tut1" name="https://www.youtube.com/embed/TTgNlfAht4I<?php //echo $stepWiseVideo[1]["I"]["path"];?>" id="tutorial-videoSH_for_profile_detail" href="javascript:void(0)">Watch Video</a></span> </div>
              <div class="white-space">
              <form name="frmeditprofile" id="frmeditprofile" action="<?=base_url()?>dashboard/edit_ap_profile" method="post">
              <input type="hidden" name="txtuser_id" value="<?=$userInfo[0]['uID']?>" />
                <div class="verification_formsec">
                  <p>
                    <label>First Name :</label>
                    <input name="txtfname" id="txtfname" type="text" value="<?=$userInfo[0]['firstName']?>" />
                  </p>
                  <p>
                    <label>Last Name :</label>
                    <input name="txtlname" id="txtlname" type="text" value="<?=$userInfo[0]['lastName']?>" />
                  </p>
                  <p>
                    <label>Email :</label>
                    <input name="txtemail" id="txtemail" type="text" value="<?=$userInfo[0]['emailID']?>" />
                  </p>
                  <p>
                    <label>Address :</label>
                    <input name="txtaddress" id="txtaddress" type="text" value="<?=$userInfo[0]['address']?>" />
                  </p>
                  <!--<p>
                    <label>Address 2 :</label>
                    <input name="" type="text" />
                  </p>-->
                  <p>
                    <label>Country :</label>
                    <select name="country_name" id="profileCountry">
	                  <option value="">Select Country</option>
	                 <?php foreach($countryList as $key => $val) {?>
	                 	<option value="<?=$val->country_id?>" <?=($val->country_id == $userInfo[0]['country'])?"selected":"";?>><?=$val->name?></option>
	                 <?php }?>
                  </select>
                  </p>
                  
                  <p>
                    <label>City</label>
                    <select id="city1" name="profileCity">
                      <!--<option value="">Select City </option>-->
                      <?php foreach($cityList as $key => $val) {
                      			if($val->countryId == $userInfo[0]['country']){									
                      ?>
                      <option value="<?=$val->id?>" <?=($val->id == $userInfo[0]['city'])?"selected":"";?>><?=$val->city?></option>
                      <?php }}?>
                    </select>
                    <span class="addcityclass" ><a href="javascript:void(0)" onClick="CT_openCityAddCityDiv();"><em>Not in List Click to Add Your City</em> </a></span>
                  <div id="CT_newCity" style="display:none;">
                    <input type="text" name="newVendorCity" id="newVendorCity1" placeholder="Add your City">
                    <div class="ad" onClick="CT_addNewCity()"> Add</div>
                    <div class="can" onClick="closeNewCityDiv()">Cancel</div>
                  </div>
                  </p>
                  <p>
                    <label>State :</label>
                    <input name="txtstate" id="txtstate" type="text" value="<?=$userInfo[0]['state']?>" />
                  </p>
                  <p>
                    <label>Zip/Post codes :</label>
                    <input name="txtzip" id="txtzip" type="text" value="<?=$userInfo[0]['zip']?>" />
                  </p>
                  
                  <input type="submit" id="btneditprofile" name="btneditprofile" value="update Contact Info" style="width:62%;">
                </div>
                </form>
              </div>
              <br />
              <br />
              <br class="clear" />
			<!--  Profile Details END -->	
			<!--CHANGE PASSWORD SECTION START-->
            <div class="ab_inner"><strong>B</strong>
                <h3 class="d_hdr">Password Change</h3>
				
                <span><a class="watch-video-tut" id="tutorial-video1f" name="https://www.youtube.com/embed/e9Dpy3yvEyg<?php //echo $stepWiseVideo[1]["F"]["path"];?>" href="javascript:void(0)">Watch Video</a></span> </div>
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
              <a id="next_button" href="javascript:void(0);" style="background: #ce2d2b; color: #fff; font-size: 20px; padding: 10px 15px; margin: 0 auto; width: 94px;
clear: both; display: block; margin-top: 40px; border-radius: 5px;">Next Step</a>
            <!--CHANGE PASSWORD SECTION END-->	
			</div>	
			  
            <!--UPLOAD OFFERS SECTION START-->
			<div id="pro_upload" style="display:none">
				<div class="ab_inner"><strong>C</strong>
					<h3 class="d_hdr">Upload Offers</h3>
					<span id="passCh"><a class="watch-video-tut1" name="https://www.youtube.com/embed/F7ayGFHGqeQ<?php //echo $stepWiseVideo[1]["B"]["path"];?>" id="tutorial-videoSH" href="javascript:void(0)">Watch Video</a></span> </div>
				  <div class="white-space">
					<div class="verification_formsec">
						<form id="prd_upld_sec" action="<?php echo base_url();?>dashboard/addoffers" method="post" enctype="multipart/form-data">
					  <!--<p>
						<label>Vendors Name</label>
						<select name="vendorID" id="vendorID">
						  <option value="">Please Select One</option>
						  <?php if(count($vendorsList) > 0){ foreach($vendorsList as $vl){?>
						  <option value="<?php echo $vl->vendorsID;?>" <?php if($vl->vendorsID == $addedVendorId){?> selected="selected"<?php }?>><?php echo $vl->vendorName;?></option>
						  <?php } }?>
						</select>
					  </p>-->
                      <p>
						<label>Product Name</label>
						<input type="text" name="productName" id="productName">
					  </p>
                      <p>
						<label>Product Description</label>
						<textarea name="productDesc" id="productDesc"></textarea>
					  </p>
					  <p>
                    <label>Country :</label>
                    <select name="offer_country_name" id="offerCountry">
	                  <option value="">Select Country</option>
	                 <?php foreach($countryList as $key => $val) {?>
	                 	<option value="<?=$val->country_id?>" <?=($val->country_id == $userInfo[0]['country'])?"selected":"";?>><?=$val->name?></option>
	                 <?php }?>
                  </select>
                  </p>
                  <p>
                    <label>City</label>
                    <select id="offercity" name="offercity">
                      <!--<option value="">Select City </option>-->
                      <?php foreach($cityList as $key => $val) {
                      			if($val->countryId == $userInfo[0]['country']){									
                      ?>
                      <option value="<?=$val->id?>" <?=($val->id == $userInfo[0]['city'])?"selected":"";?>><?=$val->city?></option>
                      <?php }}?>
                    </select>
              <span class="addcityclass" ><a href="javascript:void(0)" onClick="CT_offer_openCityAddCityDiv();"><em>Not in List Click to Add Your City</em> </a></span>
                  <div id="CT_offer_newCity" style="display:none;">
                    <input type="text" name="offerCity" id="offerCity" placeholder="Add your City">
                    <div class="ad" onClick="CT_offer_addNewCity()"> Add</div>
                    <div class="can" onClick="closeNewCity_offer_Div()">Cancel</div>
                  </div>
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
						<label>Selling Currency</label>
						<select name="productCurrencyType" id="productCurrencyType">
						  <option value="USD">USD Dollar</option>
						  <option value="EUR">Euro</option>
						  <option value="GBE">Pound</option>
						</select>
					  </p>
                      <p>
						<label>Usual Price :</label>
						<input type="text" name="productPrice" id="productPrice">
					  </p>
                      <p>
						<label>Offer Price :</label>
						<input name="offer_price" id="offer_price" type="text" />
					  </p>
                      <p style="display:none;">
						<label>Category</label>
						<select name="catID" id="catID">
						  <option value="">Please Select Category</option>
						  <option value="18" selected>Miscellaneous</option>
						  <?php //if(count($categoryList) > 0){ 
									//foreach($categoryList as $catL){
									//echo '++'.$catL->menuID."==".$catL->menuName;
									?>
						  <!--<option value="<?php echo $catL['menuID'];?>" ><?php echo $catL['menuName'];?></option>-->
						  <?php // }}?>
						</select>
					  </p>
					  <p>
						<label>Category</label>
						<select name="articleID" id="articleID">
						  <option value="">Please Select Category</option>
						 <?php if(count($subcat) > 0){ 
									foreach($subcat as $sub){
									echo '++'.$sub->id."==".$sub->title;
									?>
						  <option value="<?php echo $sub['id'];?>" ><?php echo $sub['title'];?></option>
						  <?php  }} ?>
						</select>
					  </p>
					  <p>
						<label>Sub Category</label>
						<select name="productTypeID" id="productTypeID">
						  <option value="">Please Select Sub Category</option>
						  <?php if(count($productCategoryList) > 0){ foreach($productCategoryList as $pcl){?>
						  <option value="<?php echo $pcl->productTypeID;?>"><?php echo $pcl->productTypeName;?></option>
						  <?php } }?>
						</select>
					  </p>
					  
					  <p style ="display:none">
						<label>Voucher Code :</label>
						<input id="v_code" name="v_code" type="text" value="<?php echo $v_code;?>"/>
					  </p>
					  
					  
					  
					  
					  
					  
					  <!--<p>
						<label>Amount I'm Offering CT Members As Commission<span id="showSelCurr1">($)</span></label>
						<input type="text" name="productCommission" id="productCommission">
					  </p>-->
					  
					  <!--<div class="col_qnt">
						<div class="color_sec">
						  <div class="col_tpps">
							<label>Color Product</label>
							<p style="margin-left:12px;">
							<input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_1" class="colorRadio">
							  <strong>Yes</strong></p>
							<p>
							  <input type="radio" name="RadioGroup1" checked="checked" value="0" id="RadioGroup1_0" class="colorRadio" style=" margin-top:4px !important;">
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
					  </div>-->
					  <p id="offQuantity">
						<label>Quantity of items</label>
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
					  
					  <div id="digitalDiv">
						<p>
						  <label>Upload your Digital product PDF – 20MB</label>
						  <input type="file" name="productDigitalPdf" id="productDigitalPdf">
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
					  
					  <!--<p>
						<label>Upload the Fourth Image of your product</label>
						<input type="file" name="img_4">
					  </p>-->
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
						<input type="submit" value="Save" id="offer_details" name="offer_details">
						<span id="myLoaderDiv"></span>
					  </p>
					</form>
					</div>
				  </div>
				  <br />
				  <br />
				  <br class="clear" />
				
				<!--UPLOAD OFFERS SECTION END-->
			  
			  
			  <!-- All product list -->
			  <div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["C"]["serial_field"];?> </strong>
					<h3 class="d_hdr"><?php echo $stepWiseVideo[4]["C"]["title"];?></h3>
				  <!-- <h3><?php //echo $stepWiseVideo[4]["B"]["title"];?></h3>-->
					<span> <a href="javascript:void(0)" id="watch-video-tut4C" name="https://www.youtube.com/embed/d2XB056HDjk<?php //echo $stepWiseVideo[4]["C"]["path"];?>" class="watch-video-tut1">Watch Video</a></span> </div>
				  <div id="product_list">
					<div class="upl_frm_inre" style="  height: <?php echo (count($allProducts) > 6)?490:count($allProducts)*95;?>px; <?php if(count($allProducts) > 6):?>overflow-y: scroll;<?php endif;?>">
						<table class="ppnams" style="border: 1px;width: 100%;" id="product_list" colspan="2">
						  <tbody class="ppnams_top1">
							<!--<th>#</th>-->
                            <tr>
						  <th>Image</th>
							<th>Product Name</th>
							<th>Price</th>
							<th colspan="2">Action</th>
                            </tr>
							<?php if(count($allProducts) > 0):?>
							<?php   $i = 1; foreach ($allProducts as $prd):?>
							<tr> 	  
								<td style="background:#d2d4e1;"><img width="50px" height="50px" src="<?php echo  $this->config->item('gbe_base_url').'adminuploads/product_files/images/'.$prd->fileName;?>" title="<?php echo $prd->productName;?>" /></td>
								<td style="background:#d2d4e1;"><?php echo $prd->productName;?></td>
								<td style="background:#d2d4e1;"><?php echo $prd->productPrice;?></td>
<td style="background:#d2d4e1;"><a class="product_edit" href="<?php echo base_url().'dashboard/editapProduct/'.$prd->productID;?>" style="color: #fff; background: #84acb8;
border: 1px solid #84acb8; padding: 3px 18px; border-radius: 3px; display: inline-block; margin-top: 22px;">Edit</a><br><br>
							</tr>
							<tr style="border-bottom: 10px solid #fff;">
								<td colspan="4" style="background:#d2d4e1; padding: 0 10px;"><p style="background: #8b3f89; border-radius: 5px; padding-left:0;font-size: 17px;line-height: 40px;text-align: center; width: 36%; float:left;">
<a target="_blank" style="color:white" href="<?php echo base_url().'product/details/'.$prd->productID;?>">View my offer</a></p>     
 <p style="width: 54% !important; float: right; color: #000; margin-top: 4px;"><label>Voucher Code :</label>
						<input style="height:30px;" id ="voucher_code" name="voucher_code" type="text" value="<?php echo $prd->voucher_code; ?>" readonly/> </p>                                                    
</td>
							</tr>
                            
                           <!--<tr> <td colspan="4" height="10"></td></tr>-->
						  <?php  $i++;  endforeach;?>
						  <?php    else: ?>
						  <tr>
							<td colspan="4">Sorry! No Product please. </td>
						  </tr>
						  <?php    endif;?>
													</tbody>
</table>
					</div>
				  </div>
				
			<!-- Edit Product Section -->
			
          	                
			<div id="edit_product_id">
              
			</div>
				
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- left side tab end--> 
  <!-- right side tab start-->
  <?php $this->load->view("right_panel_ap", "", $result); ?>
  
  <!-- rights side end -->
  <div class="clear"></div>
</div>


<!-- main container end -->
<script>

$(document).ready(function(){ 

	

	$("#adVideoLinkId01").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#adVideoLinkId02").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	$("#adVideoLinkId03").click(function() {

		var path = $(this).attr("name");

		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

	

});

</script>
<style>
.clk_pr_inv {
    overflow-y: scroll; height: 290px;
}
.watchvideo-popuptab {

    clear: both;

    /*margin-top: 15px;*/

}

.watchvideo-popuptab ul {

    margin: 0;

    padding: 0;

}



.watchvideo-popuptab ul li {

    background: #e5d0e5 none repeat scroll 0 0;

    float: left;

    margin-right: 25px;

    padding: 5px;

    position: relative;

    width: 293px;

}



.watchvideo-popuptab ul li a {

    background: #fff none repeat scroll 0 0;

    color: #000;

    display: block;

    font-size: 12px;

    font-weight: bold;

    line-height: 32px;

    padding: 5px;

}



.watchvideo-popuptab ul li img {

    cursor: pointer;

    position: absolute;

    right: 7px;

    top: 6px;

    width: 56px;

}

.watchvideo-popuptab ul li img.downarrow {

    left: 0;

    top: 52px;

    width: auto;

}

.activeuser {
    background: #1b75bc none repeat scroll 0 0;
    
}

.watchvideo-popuptab ul li:last-child {

    margin-bottom: 60px;

    margin-right: 0;

}
.fancybox-skin {
    background: #f00 none repeat scroll 0 0 !important;
    color: #fff !important;
	min-width: 350px;
 
}
.fancybox-inner {
    font-size: 16px !important;
    line-height: 20px !important;
	text-align:center;
	display:block !important; width:auto !important;
}
.fancybox-inner h1 {
    color: #fff;
    display: block;
    padding-top: 10px;
    text-align: center;
    text-transform: capitalize;
}
#header-sticky-wrapper.sticky-wrapper{height: 77px !important;
border-bottom: 1px solid #6a6a6a !important;
margin-bottom: 25px !important;}
.rarrow > img{margin-top:30px !important;}
  </style>
<!--footer style--> 

