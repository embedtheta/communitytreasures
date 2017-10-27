<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>CT Offer Details</title>

<link rel="shortcut icon" href="<?php echo base_url();?>images/headerlogo.png" type="image/x-icon"/>

<link href="<?php echo base_url();?>css/stylesheet_CT_Affro.css" rel="stylesheet" type="text/css">

<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>

<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>

<script src="<?php echo base_url();?>js/jquery.slides.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>js/responsiveCarousel.min.js"></script>

 



<style type="text/css">

  

  .fancybox-lock .fancybox-overlay {

  overflow: auto;

  overflow-y: scroll;

  z-index: 9999999;

}
.right_prodetails p span{display: block;
float: left;
width: 125px;
font-size:14px;
}
.right_prodetails p{margin:0 !important;}
</style>

</head>

<?php $this->load->view("ct_catalog/CT_header", $result); ?>

<body class="ct_afro_pro">

<div class="header">

 

</div>

<div id="maincontainers" style="margin-top: 230px;">

  <div class="bdysec">
  <?php 
/*echo "<pre>";
print_r($pCategory);
echo "</pre>";*/

    if(!empty($pCategory)){
			
				if(empty($pCategory['subcategory2']))
				{
          $subcategory_id = isset($pCategory['subcategory_id'])?$pCategory['subcategory_id']:'';
		?>	
    <p class="breadcu">
          <a href="<?php echo base_url();?>dashboard/CT_catalog/">Home</a> >> <a href="<?php echo base_url();?>dashboard/product_view_List/<?php echo $subcategory_id; ?>"><?php echo $pCategory['subcategory']; ?></a>
				<?php  //echo 'Miscellaneous  / '.$pCategory['subcategory'] ;?></p>
		
		<?php
				}
				else
				{
          $main_category_id = isset($pCategory['main_category_id'])?$pCategory['main_category_id']:'';
          $subcategory_id = isset($pCategory['subcategory_id'])?$pCategory['subcategory_id']:'';
		?>			
					<p class="breadcu">
          <a href="<?php echo base_url();?>dashboard/CT_catalog/">Home</a> >> <a href="<?php echo base_url();?>dashboard/category_detail/<?php echo $main_category_id; ?>"><?php echo $pCategory['subcategory2']; ?></a> >> <a href="<?php echo base_url();?>dashboard/product_view_List/<?php echo $subcategory_id; ?>" class="active"><?php echo $pCategory['subcategory']; ?></a>
          <?php //echo 'Miscellaneous  / '. $pCategory['subcategory2'] . ' / ' . $pCategory['subcategory']; ?></p>	
		<?php
				}
			}
		?>
<div class="new_offerbanner">
  <img src="<?php echo base_url();?>images/offer-new.png" width="" height="" alt="" />
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

        <?php //if($product_description){?>

        <div class="list-detail newpro"> 

          <!-- Image --> 

          <?php if(!empty($pFiles['img_1']['fileName'])) {

          			$file_path = $this->config->item('gbe_base_url').'adminuploads/product_files/images/'.$pFiles['img_1']['fileName'];

          		} else {

					$file_path = base_url().'uploads/offer_image/no-image-available.jpg';

				} 

				if(!empty($pFiles['img_2']['fileName'])) {

          			$file_path2 = $this->config->item('gbe_base_url').'adminuploads/product_files/images/'.$pFiles['img_2']['fileName'];

          		} else {

					$file_path2 = base_url().'uploads/offer_image/no-image-available.jpg';

				}
				if(!empty($pFiles['img_3']['fileName'])) {

          			$file_path3 = $this->config->item('gbe_base_url').'adminuploads/product_files/images/'.$pFiles['img_3']['fileName'];

          		} else {

					$file_path3 = base_url().'uploads/offer_image/no-image-available.jpg';

				}
							

          ?>

         <div class="proimg-sec"> 
         <!--<div class="full-proimg"><img width="" height="" class="article-left-img" src="<?php echo $file_path;?>"> </div>
         <ul class="thumnails_proimg">
         <li><img width="" height="" class="article-left-img" src="<?php echo $file_path;?>"></li>
         <li><img width="" height="" class="article-left-img" src="<?php echo $file_path;?>"></li>
         <li><img width="" height="" class="article-left-img" src="<?php echo $file_path;?>"></li>
         </ul>-->
         <div class="gallery">
         <h1><?php echo $pDetails[0]->productName;?></h1>
            <div class="images">
              <div class="image active">
                <div class="content" style="background-image: url(<?php echo $file_path;?>)"></div>
              </div>
              <div class="image">
                <div class="content" style="background-image: url(<?php echo $file_path2;?>)"></div>
              </div>
              <div class="image">
                <div class="content" style="background-image: url(<?php echo $file_path3;?>)"></div>
              </div>
            </div>
            <div class="thumbs">
              <div class="thumb active" style="background-image: url(<?php echo $file_path;?>)"></div>
              <div class="thumb" style="background-image: url(<?php echo $file_path2;?>)"></div>
              <div class="thumb" style="background-image: url(<?php echo $file_path3;?>)"></div>
              <div class="thumb active" style="background-image: url(<?php echo $file_path;?>)"></div>
              <div class="thumb" style="background-image: url(<?php echo $file_path2;?>)"></div>
              <div class="thumb" style="background-image: url(<?php echo $file_path3;?>)"></div>
            </div>
          </div>
		   <p class="descriptions"><?php echo $pDetails[0]->productDesc;?></p>
         </div>

          

          <!-- body -->
		
        <div class="right_prodetails"> 
         

          <div class="tvclass">			
			<p style="margin-bottom:5px;"><span>This Item is for :</span> <strong>Selling</strong></p>			
			<p class="price" style="margin-bottom:5px;"><span>Price :</span> <strong>$<?php echo $pDetails[0]->productPrice; ?></strong></p>
			<p class="price off"><span>Offer Price : </span><strong> $<?php echo $pOffer[0]->voucher_amt; ?></strong></p>
			<p><span>Collect Offer :</span> <a data-fancybox-type="iframe" href="<?php echo base_url();?>dashboard/ajax_view_coupon_code/<?php echo $pDetails[0]->productID; ?>" class="various" style="color: #fff; background:#0091d5; padding: 6px 10px;">Click Here</a></p>
             <p><span>Quantity  :</span> <strong><?php echo $pDetails[0]->productQuantity; ?></strong></p>
            <p><span>Type of Product  :</span> <strong style="font-size:13px;"><?php if($pDetails[0]->typeOfProduct == "1"){ echo "Digital Upload Product"; } else if($pDetails[0]->typeOfProduct == "2"){ echo "Physical Sendable Product"; } else if($pDetails[0]->typeOfProduct == "3"){ echo "Event Ticket"; }?></strong></p>
			<?php if($pDetails[0]->typeOfProduct == "1"){
				$tmp_fileName = $pFiles['pdf']['fileName'];
				$fileName = substr($tmp_fileName ,0, -4);
				
			?>
				<p class="digiproduct"><span>Digital product  :</span> <strong><a href="<?php echo  base_url();?>product/download_pdf/<?php echo $fileName; ?>"> <img class="" src="<?php echo base_url();?>/images/pdf-icon.png"></strong></p>
			<?php
			}
			?>
            <p><span>Status  : </span><strong><?php if($pDetails[0]->productStatus == "1"){ echo "Active"; } else{ echo Inactive; }?></strong></p>
			</div>			
           
		  </div>
        
		    <?php 
			if(isset($pDetails[0]->productYoutubeUrl) && !empty($pDetails[0]->productYoutubeUrl)){
				$youtube_url = $pDetails[0]->productYoutubeUrl;
				$y=explode('?v=',$youtube_url);
				$v=$y[1];
				$youtube_url ="https://www.youtube.com/embed/".trim($v);
				//$youtube_url ="https://www.youtube.com/embed/eOqo-sWtF9U";
			?>
        <div class="product-videores">
         <h2>Product Video</h2>
		   <!--<img src="<?php echo base_url();?>images/right-vid.jpg" width="302" height="" alt="" />-->
		 <?php
		  echo '<iframe width="302" height="215" src="'. $youtube_url .'" frameborder="0" allowfullscreen></iframe>';
			} else { echo ""; }
		 
		 ?>
         </div>
	<br/><br class="clear"/>
		  <p> <?php 
			//if(isset($pDetails[0]->productYoutubeUrl) && !empty($pDetails[0]->productYoutubeUrl)){
			?>	
			<!--<h1>Youtube Video : </h1>-->
	<?php		
    //$youtube_url = $pDetails[0]->productYoutubeUrl;
    //$y=explode('?v=',$youtube_url);
	//$v=$y[1];
	//$youtube_url ="https://www.youtube.com/embed/".trim($v);
        //if(strstr($youtube_url, "watch?v=")){
          //$youtube_url ="https://www.youtube.com/embed/jvxex_ikg0k";
        //}
		  //echo '<iframe width="340" height="215" src="'. $youtube_url .'" frameborder="0" allowfullscreen></iframe>';
			//} else { echo ""; }
		  ?> </p>
        </div>

        <?php //}?>

        <!--Product Show -->

        <div class="listwrap"> </div>

        <!--Product Show --> 

        

      </div>

        

    </div>

    <div class="bdysec_right newpan">
   <div class="right-pannewadd">
   <p>Start your<br>
<a href="<?php echo base_url();?>dashboard/category_detail/297">Marketing Campaign</p>
<h2>Promote<br>
Your Brand<br>
Or Business</h2></a>
<div class="rightnew-vidsec"> <!--<img src="<?php echo base_url();?>images/right-vid.jpg" width="" height="" alt="" />--><iframe width="222" height="230" src="https://www.youtube.com/embed/Btt-bpmmKiA" frameborder="0" allowfullscreen></iframe></div>
<h3>Get Your A.P Package Today</h3>
<a href="<?php echo base_url();?>payment" class="start-button">Start Now</a></div>
<div class="right-pannewadd">
   <p>Get Paid For Watching</p>
<a href="<?php echo base_url();?>dashboard/category_detail/597"><h2>Watching<br>
& Sharing<br>
Videos</h2></a>
<div class="rightnew-vidsec"> <!--<img src="<?php echo base_url();?>images/right-vid.jpg" width="" height="" alt="" />--><iframe width="222" height="230" src="https://www.youtube.com/embed/eOqo-sWtF9U" frameborder="0" allowfullscreen></iframe></div>
<h3>Start Earning Today!</h3>
<a href="<?php echo base_url();?>payment/bbRegistration" class="start-button">Start Now</a></div>
    </div>
    <br class="clear">
<div class="bottnew_offerbanner">
  <img src="<?php echo base_url();?>images/bottom-offer.png" width="" height="" alt="" />
  </div>
  </div>

  <br class="clear">

</div>

</div>

<!--<div class="wrapper">

  <?php //$this->load->view("ct_catalog/career-monetizer", $result);?>

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

    

    fitToView : true,

    width   : '60%',

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
<script type="text/javascript">
$(function () {
  $('.gallery').gallery();
});

</script>
  <!--<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.4/hammer.min.js"></script>
  <script src="<?php echo base_url();?>js/gallery.js"></script>
  <!--<script src="js/main.js"></script>-->
</body>

</html>

