<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CT Category Detail</title>
<link rel="shortcut icon" href="<?php echo base_url();?>images/headerlogo.png" type="image/x-icon"/>
<link href="<?php echo base_url();?>css/stylesheet_CT_Affro.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.slides.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/responsiveCarousel.min.js"></script>
 <script>
$(document).ready(function(){ 
	$("#adVideoLinkId01").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
	});

	$("#adVideoLinkId02").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
	});
	$("#adVideoLinkId03").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');

	});

});

</script>

<style type="text/css">
  
  .fancybox-lock .fancybox-overlay {
  overflow: auto;
  overflow-y: scroll;
  z-index: 9999999;
}
</style>
</head>
<?php $this->load->view("ct_catalog/CT_header", $result); ?>
<body class="ct_afro_pro">
<div class="header">
 
</div>
<div id="maincontainers" style="margin-top: 230px;">
  <div class="bdysec">

   <?php if($product_description){ ?>
    <p class="breadcu">
    <a href="<?php echo base_url();?>dashboard/CT_catalog/">Home</a> >> 
	<a href="<?php echo base_url();?>dashboard/category_detail/<?php echo $product_description[0]['id'];?>"><?php echo $product_description[0]['title'];?></a>
   </p>
   <?php } ?>
   
  <div class="new_offerbanner">
  <!--<img src="<?php echo base_url();?>images/offer-new.png" width="" height="" alt="" />-->
  </div>
    <div class="bdysec_left">
	<div class="my-left-cont">
        <div id="cssmenu">
          <ul>
            <?php if(count($category_details)>0){
				 $i=0;
				  foreach($category_details as $cd){
					 
					  if($i==0){
						 ?>
            <li><a href="<?php echo base_url();?>dashboard/category_detail/<?php echo $cd['id'];?>"><?php echo $cd['title'];?></a></li>
            <?php 						 
					  }
					  else{
						    ?>
            <li><a href="<?php echo base_url();?>dashboard/product_view_List/<?php echo $cd['id'];?>"><?php echo $cd['title'];?></a></li>
            <?php 
					  }
			  
			 $i++;
			 
			 } } ?>
          </ul>
        </div>
      </div>
      <div class="my-right-cont">
        <?php if($product_description){ ?>
	
        <div class="list-detail"> 
         <h1><?php echo $product_description[0]['title'];?></h1>
          <!-- Image --> 
          <img width="485" height="320" class="article-left-img" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/productPagesImg/<?php echo $product_description[0]['image'];?>"> 
          <!-- body -->
          <p><?php echo $product_description[0]['description'];?></p>
          <!--<a href="#" style="color:#f00; font-weight:bold;display: block;
		text-align: right;">Read More</a>--> 
        </div>
        <?php }?>
        <!--Product Show -->
        <div class="listwrap"> </div>
        <!--Product Show --> 
        
      </div>
      <?php //if(trim($this->session->userdata('userType'))=='ADMIN') {?>
      <div class="listwrap offer_secn">
        <?php //echo "<pre>"; print_r($CT_offer_list); echo "</pre>";//die;
		/*if(!empty($CT_offer_list)){
			
			foreach($CT_offer_list as $val){				
					 
					 $file_path1 = getcwd().'/gbe/adminuploads/product_files/images/'.$val['product_img'];
					 if(!empty($val['product_img'])){
					  				  
					  $file_path = $this->config->item('gbe_base_url').'adminuploads/product_files/images/'.$val['product_img'];
					 
					}else{
					  $file_path = base_url().'uploads/offer_image/no-image-available.jpg';
					}

			?>
					<div class="llistitem">
					  <div class="phto"><a href="<?php echo base_url();?>product/details/<?php echo $val['productID']; ?>"><img src="<?php echo $file_path; ?>" width="105" height="105"></a></div>
					  <h3><a href="javascript:void(0);"> <?php echo substr($val['offer_name'], 0,22); ?></a></h3>
					  
					  <div class="tvclass">
						<p class="pro_newnamee"><?php echo substr($val['productName'], 0,32); ?></p>
						<p class="offer-price">Offer Price : <strong><?php echo $val['voucher_amt']; ?></strong></p>
						<p class="vouchar_code">Voucher Code : <?php //echo $val['voucher_code']; ?></strong><a data-fancybox-type="iframe" href="<?php echo base_url();?>dashboard/ajax_view_coupon_code/<?php echo $val['productID']; ?>" class="various" style="color:#f00">Click Here</a></p>
						<p><a href="<?php echo base_url();?>product/details/<?php echo $val['productID']; ?>" class="dtlsbtn">View Offers</a></p>
								  </div>
					</div>
			
			
			<?php 			
			}
           
						
		}*/
		//else{
				foreach($CT_offer_list_2subcat as $value){
					foreach($value as $val){		
					$file_path1 = getcwd().'gbe/adminuploads/product_files/images/'.$val['product_img'];
					
					 if(!empty($val['product_img'])){
					  //if (file_exists($file_path1)) {   
					  
					  $file_path = $this->config->item('gbe_base_url').'adminuploads/product_files/images/'.$val['product_img'];
					  /*}
					  else{
						  
						$file_path = base_url().'uploads/offer_image/no-image-available.jpg';
						
					  }*/
					}else{
					  $file_path = base_url().'uploads/offer_image/no-image-available.jpg';
					}
		?>
		
					<div class="llistitem">
					  <div class="phto"><a href="<?php echo base_url();?>product/details/<?php echo $val['productID']; ?>"><img src="<?php echo $file_path; ?>" width="105" height="105"></a></div>
					  <h3><a href="javascript:void(0);"> <?php echo substr($val['offer_name'], 0,22); ?></a></h3>
					  
					  <div class="tvclass">
						<p class="pro_newnamee"><?php echo substr($val['productName'], 0,32); ?></p>
						<p class="offer-price">Offer Price : <strong><?php echo $val['voucher_amt']; ?></strong></p>
						<p class="vouchar_code">Voucher Code : <?php //echo $val['voucher_code']; ?></strong><a data-fancybox-type="iframe" href="<?php echo base_url();?>dashboard/ajax_view_coupon_code/<?php echo $val['productID']; ?>" class="various" style="color:#f00">Click Here</a></p>
            <p><a href="<?php echo base_url();?>product/details/<?php echo $val['productID']; ?>" class="dtlsbtn">View Offers</a></p>
					  </div>
					</div>
		<?php
					}
				}
				
		//}
        ?>
        <br class="clear">
      </div>
    </div>
    <div class="bdysec_right newpan">
   <div class="right-pannewadd">
   <p>Start your<br>
Marketing Campaign</p>
<a href="<?php echo base_url();?>dashboard/category_detail/297"><h2>Promote<br>
Your Brand<br>
Or Business</h2></a>
<div class="rightnew-vidsec"> <a id="adVideoLinkId01" name="https://www.youtube.com/embed/Btt-bpmmKiA" style="cursor:pointer;"><img src="<?php echo base_url();?>images/right-vid.jpg" width="" height="" alt="" /></a>
<!--<iframe width="222" height="230" src="https://www.youtube.com/embed/Btt-bpmmKiA" frameborder="0" allowfullscreen></iframe>-->
</div>
<h3>Get Your A.P Package Today</h3>
<a href="<?php echo base_url();?>dashboard/category_detail/297" class="start-button">Start Now</a></div>
<div class="right-pannewadd">
   <p>Get Paid For Watching</p>
<a href="<?php echo base_url();?>myaccount"><h2>Watching<br>
& Sharing<br>
Videos</h2></a>
<div class="rightnew-vidsec"> <a id="adVideoLinkId02" name="https://www.youtube.com/embed/eOqo-sWtF9U" style="cursor:pointer;"><img src="<?php echo base_url();?>images/right-vid.jpg" width="" height="" alt="" /></a>
<!--<iframe width="222" height="230" src="https://www.youtube.com/embed/eOqo-sWtF9U" frameborder="0" allowfullscreen></iframe>-->
</div>
<h3>Start Earning Today!</h3>
<a href="<?php echo base_url();?>myaccount" class="start-button">Start Now</a></div>
    </div>
  </div>
  <br class="clear">
</div>
</div>
<!--<div class="wrapper">
  <?php// $this->load->view("ct_catalog/career-monetizer", $result);?>
  <br class="clear">
</div>-->
<!--footer section-->
<div class="footer">
  <?php $this->load->view("ct_catalog/CT_add", $result); ?>
  <?php $this->load->view("ct_catalog/CT_footer", $result);?>
</div>
<!--footer section end-->
<script type="text/javascript">
$(document).ready(function() {
  $(".various").fancybox({
    maxWidth  : 600,
    maxHeight : 300,
    fitToView : true,
    width   : '70%',
    height    : '70%',
    autoSize  : true,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
  });
});
$(function(){
  $('.crsl-items').carousel({
    visible: 5,
    itemMinWidth: 170,
    itemEqualHeight: 166,
    itemMargin: 9,
  });
  
  $("a[href=#]").on('click', function(e) {
    e.preventDefault();
  });
});

$(document).ready(function() {
  $(".vCode").unbind.bind("click", function(event) {
    event.preventDefault();
    $(this).parent('p strong.vCodeDis').show();
  })
})

</script>
</body>
</html>
