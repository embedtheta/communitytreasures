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