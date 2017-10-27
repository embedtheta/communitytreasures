<!--<div class="add-sec">
<div class="wrapper">
<ul class="bxslider">
<?php if(count($CT_FooterBanner)>0){
	foreach($CT_FooterBanner as $ctFooteBanner){
		$subCatId="";
		if($ctFooteBanner['footerBanID']==8){
			$subCatId = 357;
		}
		if($ctFooteBanner['footerBanID']==9){
			$subCatId = 363;
		}
		if($ctFooteBanner['footerBanID']==10){
			$subCatId = 360;
		}
	?>
 <li>
 <a href="<?php echo base_url();?>dashboard/product_view_List/<?php echo $subCatId;?>">
 <img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/productPagesImg/<?php echo $ctFooteBanner['bannerImg'];?>" width="300" height="416" alt="" />
 </a>
 </li>
 

	<?php }
	}
	?>
    </ul>
</div>
<br class="clr" />
</div>-->

