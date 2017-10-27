<div id="w">
    <nav class="slidernav">
      <div id="navbtns" class="clearfix">
        <a href="#" class="previous">prev</a>
        <a href="#" class="next">next</a>
      </div>
    </nav>
    
    <div class="crsl-items" data-navigation="navbtns">
      <div class="crsl-wrap">
        
<?php foreach($CT_Monetizer as $cm){?>
	<div class="crsl-item"><a href="<?php echo base_url();?>signup/<?php echo $cm['title'];?>/<?php echo $ct_userID; ?>">
		<h3><?php echo $cm['title'];?>
		<h3><?php echo $cm['type'];?>
		<span><?php echo $cm['description'];?></span></h3>
		<img src="<?php echo base_url();?>images/CT_Monetizer/<?php echo $cm['img'];?>" width="111" height="145" alt="" /> </a>
	</div>
<?php }?>
      </div><!-- @end .crsl-wrap -->
    </div><!-- @end .crsl-items -->
    
  </div>