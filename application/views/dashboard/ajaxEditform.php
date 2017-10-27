<script type="text/javascript">
	 $("#offereCountry").change(function() {
		//alert('==selcet val---'+$("#offereCountry").val()) ;
		var selectedCountryId =$("#offereCountry").val();
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
						$("#offerecity option").remove();									
						$('#offerecity').append(data);					
					}
					else{
						alert('some error ');
					}
				  }
			  });
		}
		
	 });
	 
	function CT_offer_openCityEditCityDiv(){
	 //alert('show');
	 $('#CT_eoffer_newCity').css('display','block');
	// alert($('#country').val()+'====='+$('#newVendorCity').val());
 } 
  function CT_offer_editNewCity(){
	// $('#newCity').css('display','none');
	 //alert($('#country').val()+'====='+$('#newVendorCity').val());
	 var selectedCountryId =$('#offereCountry').val();
	 var newCityName = $('#offereCity').val();
	 //alert(selectedCountryId);
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
						$('#CT_eoffer_newCity').val('');
						$('#CT_eoffer_newCity').css('display','none');
						$(".offerecity option").remove();		
                        $('.offerecity').append(data.cityList);					
					}
					else{
						alert(data.message);
					}
				  }
			  });
		}
 }
function closeNewCity_eoffer_Div(){
	$('#offerecity').val('');
	$('#CT_eoffer_newCity').css('display','none');//for ct dashboard
}

 </script>	
	
	<div class="ab_inner"><strong><?php echo $stepWiseVideo[4]["E"]["serial_field"];?></strong>
             <!--   <h3 class="d_hdr"><?php echo $stepWiseVideo[4]["E"]["title"];?></h3>-->
                <h3><?php echo $stepWiseVideo[4]["E"]["title"];?></h3>
                <span> <a href="javascript:void(0)" id="watch-video-tut4E" name="<?php echo $stepWiseVideo[4]["E"]["path"];?>" class="watch-video-tut1">Watch Video</a></span> 
			</div>
              <div class="upl_form_sec">
                    <form id="prd_edit_sec" action="<?php echo base_url();?>dashboard/updateapProduct" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="productId" value="<?php echo $productId;?>">
                    
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
                    <label>Country :</label>
					<select name="offer_country_name" id="offereCountry">
	                  <option value="">Select Country</option>
	                 <?php if(count($countryList) > 0){ foreach($countryList as $key => $val) {?>
	                 	<option value="<?php echo $val->country_id;?>" <?php if($val->country_id == $pDetails[0]->country){?>selected="selected"<?php }?>><?php echo $val->name;?></option>
	                 <?php }} ?>
                  </select>
                  </p>
				  
				  <p>
                    <label>City</label>
                    <select id="offerecity" class="offerecity" name="offercity">
                      <!--<option value="">Select City </option>-->
                      <?php foreach($cityList as $key => $val) {
                      			if($val->countryId == $pDetails[0]->country){									
                      ?>
                      <option value="<?=$val->id?>" <?=($val->id == $pDetails[0]->city)?"selected":"";?>><?=$val->city?></option>
                      <?php }}?>
                    </select>
              <span class="addcityclass" ><a href="javascript:void(0)" onClick="CT_offer_openCityEditCityDiv();"><em>Not in List Click to Add Your City</em> </a></span>
                  <div id="CT_eoffer_newCity" class="CT_offer_newCity" style="display:none;">
                    <input type="text" name="offerCity" id="offereCity" placeholder="Add your City">
                    <div class="ad" onClick="CT_offer_editNewCity()"> Add</div>
                    <div class="can" onClick="closeNewCity_eoffer_Div()">Cancel</div>
                  </div>
                  </p>
				 
					
                    <p style ="display:none">
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
					<?php $colorExist = count($pColors['selectedColor']);?>
                    <!--<div class="col_qnt">
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
					</div>-->
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
                      <select name="typeOfProduct" id="typeOfProductEdit">
						  <option value="1" <?php if($pDetails[0]->typeOfProduct == 1){?> selected="selected"<?php }?>>Digital Upload Product</option>
                          <option value="2" <?php if($pDetails[0]->typeOfProduct == 2){?> selected="selected"<?php }?>>Physical Sendable Product</option>
						  <option value="3" <?php if($pDetails[0]->typeOfProduct == 3){?> selected="selected"<?php }?>>Event Ticket</option>
                      </select>
                    </p>
					<div id="digitalDivEdit" <?php if($pDetails[0]->typeOfProduct == 1){ echo 'style="display:block;"'; } else { echo 'style="display:none;"';} ?>>
                    <p>
                      <label>Upload your Digital product PDF – 20MB</label>
                      <input type="file" name="productMusic" id="productMusic" value="">
                      <?php if(!empty($pFiles['mp3']['id'])){ ?>
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
					  <?php if(!empty($pFiles['pdf']['id'])){ ?>
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
                      <?php if(!empty($pFiles['img_1']['id'])){ ?>
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_1']['fileName'];?>">
                        <input type="hidden" name="img_1_edit" value="<?php echo $pFiles['img_1']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_1_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Secondary Image of your product</label>
                      <input type="file" name="img_2">
                      <?php if(!empty($pFiles['img_2']['id'])){ ?>
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_2']['fileName'];?>">
                      <input type="hidden" name="img_2_edit" value="<?php echo $pFiles['img_2']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_2_edit" value="0">
                      <?php }?>
                    </p>
                    <p>
                      <label>Upload the Third Image of your product</label>
                      <input type="file" name="img_3">
                      <?php if(!empty($pFiles['img_3']['id'] )){ ?>
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_3']['fileName'];?>">
                      <input type="hidden" name="img_3_edit" value="<?php echo $pFiles['img_3']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_3_edit" value="0">
                      <?php }?>
                    </p>
                    <!--<p>
                      <label>Upload the Fourth Image of your product</label>
                      <input type="file" name="img_4">
                      <?php if(!empty($pFiles['img_4']['id'])){ ?>
                      	<img class="imgEdit" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/product_files/images/thumb/<?php echo $pFiles['img_4']['fileName'];?>">
                      <input type="hidden" name="img_4_edit" value="<?php echo $pFiles['img_4']['id'];?>">
                      <?php }else{?>
                      <input type="hidden" name="img_4_edit" value="0">
                      <?php }?>
                    </p>-->
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
						<span id="myUpdateLoaderDiv"></span>
                    </p>
					
				</form>
			</div>
		</div>
					