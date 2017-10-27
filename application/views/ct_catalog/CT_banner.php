<div class="banner-section aa"  id="slides">
<?php if(count($CT_Banner)>0){
	foreach($CT_Banner as $siteBanner){
	?>
<img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/banner/<?php echo $siteBanner['bannerImg'];?>" alt="" />
<!--<img src="<?php echo base_url();?>images/banner.png" width="1000" height="385" alt="" />
<img src="<?php echo base_url();?>images/banner.png" width="1000" height="385" alt="" />
<img src="<?php echo base_url();?>images/banner.png" width="1000" height="385" alt="" />-->
	<?php }
	} ?>
</div>