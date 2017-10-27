
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
