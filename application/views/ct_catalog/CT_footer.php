<div class="footer-link">
<div class="wrapper">
<ul>
<?php if($CT_Category){
	foreach($CT_Category as $cm){
		?>
		
		<li><a href="<?php echo base_url();?>dashboard/category_detail/<?php echo $cm['id'];?>"><?php echo $cm['title']; ?></a></li>
<?php } }?>

<br class="clr" />
</ul>
</div>
</div>
<div class="copyright-sec"><p>Copyright @ Global Trade Enterprise 2015</p></div>


<!-- jQuery library (served from Google) -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="<?php echo base_url();?>js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url();?>js/jquery.bxslider.css" rel="stylesheet" />
<script type="application/javascript">
$('.bxslider').bxSlider({
  minSlides: 3,
  maxSlides: 3,
  slideWidth: 336,
  slideMargin: 10
});
</script>