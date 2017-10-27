<div class="upl_frm_inre" style="  height: <?php echo (count($allProducts) > 6)?490:count($allProducts)*95;?>px; <?php if(count($allProducts) > 6):?>overflow-y: scroll;<?php endif;?>">
	<table class="ppnams" style="border: 1px;width: 100%;" id="product_list">
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
			<td><img width="50px" height="50px" src="<?php echo  $this->config->item('gbe_base_url').'adminuploads/product_files/images/'.$prd->fileName;?>" title="<?php echo $prd->productName;?>" /></td>
			<td><?php echo $prd->productName;?></td>
			<td><?php echo $prd->productPrice;?></td>
			<td><a class="product_edit" href="<?php echo base_url().'dashboard/editapProduct/'.$prd->productID;?>" style="color: #fff; background: #3b5998;
border: 1px solid #3E5C9B; padding: 3px 18px; border-radius: 3px; display: inline-block; margin-top: 22px;">Edit</a><br><br>
		</tr>
		<tr>
			<td colspan="4"><p style="background: #3b5998 none repeat scroll 0 0;border-radius: 5px; padding-left:0;font-size: 17px;line-height: 40px;text-align: center;"><a target="_blank" style="color:white" href="<?php echo base_url().'product/details/'.$prd->productID;?>">View my offer</a>
							<span style="width: 58% !important; float: right;  border-left: 1px solid #3b5998; color: #fff;"><label>Voucher Code :</label>
							<input id ="voucher_code" name="voucher_code" type="text" value="<?php echo $prd->voucher_code; ?>" readonly/> </span>
							</p>                          
			</td>
		</tr>
	  <?php  $i++;  endforeach;?>
	  <?php    else: ?>
	  <tr>
		<td colspan="4">Sorry! No Product please. </td>
	  </tr>
	  <?php    endif;?>
      </tbody>
	</table>
</div>