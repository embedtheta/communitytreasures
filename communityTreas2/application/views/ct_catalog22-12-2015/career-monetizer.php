<div class="career-monetizer">
<h2>Choose Your Career Monetizer</h2>
<div class="musicians">
<ul>
<?php foreach($CT_Monetizer as $cm){?>
	<li><a href="<?php echo base_url();?>dashboard/<?php echo $cm['title'];?>">
		<h3><?php echo $cm['title'];?>
		<span><?php echo $cm['description'];?></span></h3>
		<img src="<?php echo base_url();?>images/CT_Monetizer/<?php echo $cm['img'];?>" width="111" height="145" alt="" /> </a>
	</li>
<?php }?>

</ul>
<br class="clr" />
</div>
</div>