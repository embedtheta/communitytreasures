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
<script type="text/javascript">
jQuery(function ($) {
	// Load dialog on click
	$("#tutorial-video101").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 //30-10-2015 added by ujjwal sana	 
		 $("#tutorial-video1f").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][F]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#tutorial-video103").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[3][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 
		 //30/10/2015 added by ujjwal sana 
         $("#tutorial-video-v-add").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][A]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#watch-video-tut4C").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][C]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
		 $("#watch-video-tut4E").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[4][E]["path"];?>" frameborder="0" allowfullscreen></iframe>');
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
				$("#frmeditprofile").submit();
			}
    	})
    	
    	$("#offer_details").click(function(){
	        //var vName = $("#vendorID").val();
	        //var vContactNo = $("#productTypeID").val();
	        var vAdd 		= $("#productName").val();
	        var vEmail 		= $("#productPrice").val();
	        var vQuantity 	= $("#productQuantity").val();
	        var mainImg 	= $("#mainImageId").val();
			var prodType 	= $("#typeOfProduct").val();
			
	        /*if(vName == "") {
	            $.fancybox.open("Please select Vendor Name.");
	            $("#vendorID").focus();
	            return false;
	        }
	        if(vContactNo == ""){
	            $.fancybox.open("Please select Product Type.");
	            $("#productTypeID").focus();
	            return false;
	        }*/	        
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
	        return true;
	    });    
    	
    	$("#pUploadButtonEdit").click(function(){
	        //var vName = $("#vendorIDEdit").val();
	        //var vContactNo = $("#productTypeIDEdit").val();
	        var vAdd = $("#productNameEdit").val();
	        var vPrice = $("#productPriceEdit").val();
	        var vQuantity = $("#productQuantityEdit").val();
	        var mainImg = $("#mainImageIdEdit").val();
			var prodType = $("#typeOfProductEdit").val();
	        /*if(vName == ""){
	            $.fancybox.open("Please select Vendor Name.");
	            $("#vendorIDEdit").focus();
	            return false;
	        }
	        if(vContactNo == ""){
	            $.fancybox.open("Please select Product Type.");
	            $("#productTypeIDEdit").focus();
	            return false;
	        }*/
	        
	        if(vAdd == ""){
	            $.fancybox.open("Please enter the Name of your Product.");
	            $("#productNameEdit").focus();
	            return false;
	        }	        
	        if(vPrice == ""){
	            $.fancybox.open("Please enter the Price of your Product.");
	            $("#productPriceEdit").focus();
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
	       
	       
	        return true;
	    });
    })
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
<div class="main_container_new ddsh"> 
  
  <!-- lefts side start -->
  
  <div class="lefts_side"> 
    
    <!--tab start-->
    
    <div class="tabsectionstep">
      <div class="containertab">
        <ul class="tabs">
          <?php //if($ct_url) {?>
          <!--<li class="active"><a rel="tab6" href="javascript:void(0)" onclick="showMonetizerTab()"><?php echo $tab6Name;?><span>&nbsp;</span></a></li>-->
          <?php //} ?>
          <li class="active"><a rel="tab1" href="javascript:void(0)" onclick="showFirstTab()">Step1<span>&nbsp;</span></a></li>
        </ul>
        <div class="tab_container" style="width:610px;">
          <div class="tab_content" id="tab1" style="display: block;">
            <div class="yvideo extra-pad"> <span class="watch-thisvideo"><?php echo $stepWiseVideo[1][1]["content_title"];?></span>
              <div class="palvidd" style="width:540px; height:320px; margin:0 auto;"><a href="javascript:void(0)" id="tutorial-video101"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $stepWiseVideo[1][1]["content_image"];?>" width="527" height="320" alt="" /> </a></div>
            </div>
            <h3 class="headign-left" style="padding-left:50px;"><?php echo $stepWiseVideo[1][1]["content"];?></h3>
            <div class="rarrow"><img src="<?php echo base_url(); ?>images/rarrow.png" border="0" alt=""  /></div>
            <div class="clear"></div>
			
			<!--CHANGE PASSWORD SECTION START-->
            <div class="ab_inner"><strong>A</strong>
                <h3 class="d_hdr">Password Change</h3>
				
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
            <!--CHANGE PASSWORD SECTION END-->
			
			<!--  Profile Details  START -->
              <div class="ab_inner"><strong>B</strong>
                <h3 class="d_hdr">Profile Details</h3>
                <span id="passCh"><a class="watch-video-tut1" name="<?php echo $stepWiseVideo[1]["I"]["path"];?>" id="tutorial-videoSH" href="javascript:void(0)">Watch Video</a></span> </div>
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
                  
                  <input type="submit" id="btneditprofile" name="btneditprofile" value="update Contact Info" style="width:57%;">
                </div>
                </form>
              </div>
              <br />
              <br />
              <br class="clear" />
			<!--  Profile Details END -->		
			  
            <!--UPLOAD PRODUCT SECTION START-->
			<div class="ab_inner"><strong>C</strong>
                <h3 class="d_hdr">Upload Offers</h3>
                <span id="passCh"><a class="watch-video-tut1" name="<?php echo $stepWiseVideo[1]["B"]["path"];?>" id="tutorial-videoSH" href="javascript:void(0)">Watch Video</a></span> </div>
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
					<label>Voucher Code :</label>
					<input name="voucher_code" type="text" />
				  </p>
				  <p>
					<label>Offer Price :</label>
					<input name="offer_price" id="offer_price" type="text" />
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
				  <!--<p>
                    <label>Amount I'm Offering CT Members As Commission<span id="showSelCurr1">($)</span></label>
                    <input type="text" name="productCommission" id="productCommission">
                  </p>-->
				  
                  <div class="col_qnt">
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
                    <input type="submit" value="Save" id="offer_details" name="offer_details">
                  </p>
                </form>
                </div>
              </div>
              <br />
              <br />
              <br class="clear" />
			
            <!--UPLOAD PRODUCT SECTION END-->
          </div>
          
          <!-- All product list -->
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
                    <td><a href="<?php echo base_url().'dashboard/editapProduct/'.$prd->productID;?>">Edit</a></td>
                  </tr>
                  <?php  $i++;  endforeach;?>
                  <?php    else: ?>
                  <tr>
                    <td colspan="4">Sorry! No Product please. </td>
                  </tr>
                  <?php    endif;?>
                </table>
              </div>
          	
          	<!-- Edit Product Section -->
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
                    <form id="prd_upld_sec" action="<?php echo base_url();?>dashboard/updateapProduct" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="productId" value="<?php echo $productId;?>">
                    <!--<p>
                      <label>Vendors Name</label>
                      <select name="vendorID" id="vendorIDEdit">
                            <option value="">Please Select One</option>
                            <?php if(count($vendorsList) > 0){ foreach($vendorsList as $vl){?>
                            <option value="<?php echo $vl->vendorsID;?>" <?php if($vl->vendorsID == $pDetails[0]->vendorID){?> selected="selected"<?php }?>><?php echo $vl->vendorName;?></option>
                            <?php } }?>
                      </select>
                    </p>-->
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
					<label>Voucher Code :</label>
					<input name="voucher_code" type="text" value="<?=$offerDetails[0]->voucher_code?>" />
				  </p>
				  <p>
					<label>Offer Price :</label>
					<input name="offer_price" id="offer_price" type="text" value="<?=$offerDetails[0]->voucher_amt?>" />
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
					<!--<p>
                      <label>Amount I'm Offering GBE Members As Commission<span id="showSelCurr1">($)</span></label>
                      <input type="text" name="productCommissionEdit" id="productCommissionEdit" value="<?php echo $pDetails[0]->productCommission;?>" <?php if($donateStatus == 1){ echo 'disabled="disabled"';}?>>
                    </p>-->
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

<style>
.clk_pr_inv {
    overflow-y: scroll; height: 290px;
}
  </style>
<!--footer style--> 

