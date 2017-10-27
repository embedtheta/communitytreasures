<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	
$(".img_scn").click(function() { 
		var path = $(this).attr("name");
		if(path!=""){
			$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
		}
	});

});
</script>
</head>
<body>
<div class="real_ppup">
  <h2>CONGRATULATIONS</h2>
  <!--p>Your Have Been Accepted</p-->
  <p style="padding-bottom:10px;"><strong>Your Have Been Accepted</strong> </p><br>
  <div name="<?php echo $paymentVideoImg[0]['path'];?>" class="img_scn"><img src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/level_wise_images/<?php echo $paymentVideoImg[0]['content_image'];?>" alt="" ></div>
  <div class="prchz">
  <img src="<?php echo base_url();?>CT_images/CT_payment.png" alt="" >
    <!--h3>Purchase Your Modelling Suite Now</h3>
    <ul>
      <li>
        <input type="checkbox">
        Image Store Front</li>
      <li>
        <input type="checkbox">
        Marketing Network</li>
      <li>
        <input type="checkbox">
        Models Brand Developer</li>
      
      <li>
        <input type="checkbox">
        Level 1 & 2 of Community Treasures Wealth System</li>
		<li>
        <input type="checkbox">
        Product Merchandising</li>
      <li>
        <input type="checkbox">
        Lifestyle Marketing</li>
    </ul-->
  </div>
  <div class="yesse">
    <!--h3>Yes I Want This  Package</h3--><br>
    <a href="<?php echo base_url();?>dashboard/ct_index/6">Buy Now</a>
    <p><img src="<?php echo base_url();?>CT_images/visa.jpg"  alt=""></p>
  </div>
</div>
</body>
</html>

