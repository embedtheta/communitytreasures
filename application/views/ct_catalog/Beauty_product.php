<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CT Beauty Product</title>
<link rel="shortcut icon" href="<?php echo base_url();?>images/headerlogo.png" type="image/x-icon"/>
<link href="<?php echo base_url();?>css/stylesheet_CT_Affro.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>
 <script src="<?php echo base_url();?>js/jquery.slides.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>js/responsiveCarousel.min.js"></script>
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
</script>
<style type="text/css">
  
  .fancybox-lock .fancybox-overlay {
  overflow: auto;
  overflow-y: scroll;
  z-index: 9999999;
}
</style>
</head>
<body class="ct_afro_pro">
<div class="header">
<?php $this->load->view("ct_catalog/CT_header", $result); ?>
</div>
<div id="maincontainers" style="margin-top: 195px;">
  <div class="bdysec">
    <div class="bdysec_left">
      <div class="my-left-cont">
        <div id="cssmenu">
		<ul>
			<?php if($category_details){
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
	  <?php //print_r($product_description);
	
		if($product_description){
				
			   ?>
              <div class="list-detail">
                <!-- Image -->
                <img width="180" height="200" class="article-left-img" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/productPagesImg/<?php echo $product_description[0]['image'];?>">
                
                <!-- body -->
                <h1><?php echo $product_description[0]['title'];?></h1>
                <p><?php echo $product_description[0]['description'];?></p>
		
                </div>
		 <?php  }?>
              <!--Product Show -->
              <div class="listwrap">
              
              </div>
              <!--Product Show -->                      
                        
             </div>
      <div class="new_sec_added">
                       
                        <!--<div class="src_catgr scroll-sec">
                            <ul>
                            <?php if($monetizer_user){
                                foreach($monetizer_user as $mu){
                            ?>
                            <li><a href="<?php echo base_url();?>dashboard/monetizer_divition/<?php echo $mu['uID'];?>/<?php echo $mu['user_general_type_name'];?>"><img src="<?php echo $this->config->item('gbe_base_url').'useruploads/'.$mu['profile'];?>">
                                <p><?php echo $mu['firstName'];?></p>
                            </a></li>                                    
                                <?php } } ?>
                            
        </ul>
                        </div>-->
						<div class="listwrap offer_secn">
						<?php //print_r($CT_offer_list);
						if(!empty($CT_offer_list)){
							//print_r($CT_offer_list);exit;
							foreach($CT_offer_list as $val){
									
								//foreach($values as $key=>$val){						
																 
									 $file_path1 = getcwd().'/gbe/adminuploads/product_files/images/'.$val['product_img'];					
									 
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
                  <p><strong><?php echo substr($val['productName'], 0,32); ?></strong></p>
                  <p>Offer Price : <strong><?php echo $val['voucher_amt']; ?></strong></p>
                  <p><a href="<?php echo base_url();?>product/details/<?php echo $val['productID']; ?>" class="dtlsbtn">View Details</a></p>
                  </div>
                  </div>
							<?php 
							
							} 
						}?>
						
						<br class="clear">
					  </div>
                     </div>
             
    </div>
    <div class="bdysec_right">
            <div class="clform">
            <!--<h3>Select Languages</h3>
            <ul><li><a href="#"><img src="images/flg1.png" alt=""></a></li>
              <li><a href="#"><img src="images/flg2.png" alt=""></a></li>
              <li><a href="#"><img src="images/flg3.png" alt=""></a></li>
              <li><a href="#"><img src="images/flg4.png" alt=""></a></li>
              <li><a href="#"><img src="images/flg5.png" alt=""></a></li>
            </ul>-->
            <!--<img src="images/form-pic.png" class="fmpi">-->
           <img class="fmpi palvidd" src="<?php echo base_url();?>/images/no_image.jpg">
            <div class="basic-modal-content">

		</div>   
            <p>Sign up &amp; Make Money with CT</p>
            <form onSubmit="return false" id="fmmr" method="post" action="">
            <!--<p><label>First Name</label><input name="reqName" id="reqName" type="text" required=""></p>-->
            <p><label>Email id</label><input type="email" required id="reqEmail" name="reqEmail"></p>
            <input type="submit" onClick="sendMemReq()" value="Get CT Account" name="">
            </form>
            </div>
            <a data-target="#afroService" data-toggle="modal" href="#"><div class="put">Put Your Business, Product or Service on CT Catalog</div></a>
            
            
            
             <div style="background-color:#FFFADB;" class="fashn_rit event">
			
                        <h3>WATCH CT TV CHANNELS</h3><img width="105" height="105" src="http://globalblackenterprises.com/adminuploads/productPagesImg/GBETVpic.jpg">
						<div class="tvclass"> 							<!--<a id="contload" href="http://www.afrowebb.com/welcome/viewChannel_Detail/1">-->
							<a href="http://www.afrowebb.com/welcome/viewChannel_Detail/1">
						Business</a>
													<!--<a id="contload" href="http://www.afrowebb.com/welcome/viewChannel_Detail/2">-->
							<a href="http://www.afrowebb.com/welcome/viewChannel_Detail/2">
						Regenesis Program</a>
												</div>
			</div>
            
            <div style="display:none" id="loadiddiv"></div>
            
            
            
            
            <div class="fashn_rit event"><h2>Co-Creators Week</h2>
            			 <?php if($monetizer_event){
                                foreach($monetizer_event as $me){
                            ?>
							<a href="<?php echo base_url();?>dashboard/coCreatorWeek/<?php echo $me['id'];?>">
							 <h3><?php echo $me['title'];?></h3><p><img width="105" height="105" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/'.$me['image'];?>">
							<?php echo $me['description'];?></p></a>
							<hr class="hrr">
							<? }}?>
                                     </div>
			 			 <br class="clear">
            
                         </div>
            </div>
    <br class="clear">
  </div>
</div>
<div class="wrapper">
	<?php $this->load->view("ct_catalog/career-monetizer", $result);?>
    <br class="clear">
</div>
<!--footer section-->
<div class="footer">
<?php $this->load->view("ct_catalog/CT_add", $result); ?>
<?php $this->load->view("ct_catalog/CT_footer", $result);?>
</div>
<!--footer section end-->
</body>
</html>
