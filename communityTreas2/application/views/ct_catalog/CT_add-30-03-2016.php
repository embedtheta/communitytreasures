<div class="add-sec">
<div class="wrapper">
<?php if(count($CT_FooterBanner)>0){
	foreach($CT_FooterBanner as $ctFooteBanner){
	?>
 <a href="#"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/productPagesImg/<?php echo $ctFooteBanner['bannerImg'];?>" width="300" height="416" alt="" /></a>
 <!--<a href="#"> <img src="<?php echo base_url();?>images/add2.png" width="300" height="416" alt="" /></a>
 <a href="#"><img src="<?php echo base_url();?>images/add3.png" width="300" height="416" alt="" /></a>-->
	<?php }
	}
	?>
</div>
<br class="clr" />
</div>