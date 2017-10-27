<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
<script type="application/javascript">
$( document ).ready(function() {
	
	 $( "#productType" ).change(function() {
		if( $(this).val() == "4" || $(this).val() == "1" ){
			$("#contentUpload").show();
			$("#clothesColour").hide();
			$("#clothesSize").hide();
		}else if( $(this).val() == "6" ){
			$("#clothesColour").show();
			$("#clothesSize").show();
			$("#contentUpload").hide();
		}else{
			$("#contentUpload").hide();
			$("#clothesColour").hide();
			$("#clothesSize").hide();
		}
	 });
});
</script>
  <div class="content-wrapper">
  	<div class="content-inner">
    	  <!--Error-->
        <?php if(isset($errorMsg)){ ?>  
        <div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $errorMsg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Error-->
    	<div class="main_section">
        	<form id="addProduct" name="addProduct" method="post" action="" enctype="multipart/form-data" class="main_form">
            	<table width="600" height="200" border="1" align="center" class="form-table">
     				<tr>
    					<td>Product Type</td>
    					<td><select name="productType" id="productType" >
                        		<option value=0>Please Select</option>
                        		<?php foreach($productTypes as $productType){?>
                        		<option value=<?php echo $productType["productTypeID"]?>><?php echo $productType["productTypeName"]?></option>
                                <?php } ?>
                            </select>
                            <!--<input type="text" name="productType" id="productType" class="input1" value="" />-->
      						<?php echo form_error('productType', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td>Product Title</td>
    					<td><input type="text" name="productName" id="productName" class="input1" value="<?php if(isset($productName)){ echo $productName;}?>" />
      						<?php echo form_error('productName', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td>Description</td>
    					<td><textarea name="productDesc" id="productDesc" class="input2"><?php if(isset($productDesc)){ echo $productDesc;}?></textarea>
      						<?php echo form_error('productDesc', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td>Product Cost</td>
    					<td><input type="text" name="productPrice" id="productPrice" class="input1" value="<?php if(isset($productPrice)){ echo $productPrice;}?>" />
      						<?php echo form_error('productPrice', '<span class="form_error">', '</span>'); ?>
    					</td>
    				</tr>
                    <tr>
    					<td class="table-row">Main Image</td>
    					<td><input type="file" name="image" id="image" class="input-img" />(jpg|gif|png only supported)
      						<?php echo form_error('image', '<span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
                    <tr style="display:none" id="contentUpload">
    					<td class="table-row">Upload MP3/Videos</td>
    					<td><input type="file" name="image1" id="image1" class="input-img" />
      						<?php echo form_error('image1', '<span class="form_error">', '</span>'); ?>
                        </td>
    				</tr>
                    <tr style="display:none" id="clothesColour">
    					<td class="table-row">Clothes Colour</td>
    					<td><input type="checkbox" name="colour[]" value="Red"/>Red 
                            <input type="checkbox" name="colour[]" value="Black"/>Black
                            <input type="checkbox" name="colour[]" value="Green"/>Green
                            <input type="checkbox" name="colour[]" value="Yellow"/>Yellow
                        </td>
    				</tr>
                    <tr style="display:none" id="clothesSize">
    					<td class="table-row">Clothes Size</td>
    					<td><input type="checkbox" name="size[]" value="36"/>36 
                            <input type="checkbox" name="size[]" value="38"/>38
                            <input type="checkbox" name="size[]" value="40"/>40
                            <input type="checkbox" name="size[]" value="42"/>42
                        </td>
    				</tr>
                    <tr>
    					<td class="table-row">Secondary Image</td>
    					<td><input type="file" name="SecondaryImg[]" id="image" class="input-img" /></br>
      						<input type="file" name="SecondaryImg[]" id="image" class="input-img" /></br>
                            <input type="file" name="SecondaryImg[]" id="image" class="input-img" /></br>
                        </td>
    				</tr>
                    <tr>
     					<td>Status</td>
      					<td>
        					<input type="radio" name="productStatus" checked="checked" value="1" class="input-status"/>Active
        					<input type="radio" name="productStatus" value="0" class="input-status" />Inactive
      					</td>
    				</tr>
    				<tr>
    					<td colspan="2">
      						<input type="submit" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;<input type="reset" name="reset" id="reset" value="reset" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/viewProduct">cancel</a>
                         </td>
    				</tr>
  				</table>
            </form>
        </div>
  	</div>
  </div>
<!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  