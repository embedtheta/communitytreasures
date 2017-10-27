<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CT Category Detail</title>
<link rel="shortcut icon" href="<?php echo base_url();?>images/headerlogo.png" type="image/x-icon"/>
<link href="<?php echo base_url();?>css/stylesheet_CT_Affro.css" rel="stylesheet" type="text/css">
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>css/style_ct_catalog.css" rel="stylesheet" type="text/css" />
 <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
 <script src="<?php echo base_url();?>js/jquery.slides.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>js/responsiveCarousel.min.js"></script>
 <script type="text/javascript">
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
		
          
        </div>
      </div>
      <div class="my-right-cont">
	  <?php if($event_description){
				
			   ?>
              <div class="list-detail">
                <!-- Image -->
                <img width="180" height="200" class="article-left-img" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/productPagesImg/<?php echo $event_description[0]['image'];?>">
                
                <!-- body -->
                <h1><?php echo $event_description[0]['title'];?></h1>
                <p><?php echo $event_description[0]['description'];?></p>
		
                </div>
		 <?php }?>
              <!--Product Show -->
              <div class="listwrap">
              
              </div>
              <!--Product Show -->                      
                        
             </div>
			
             <br class="clear">
             
    </div>
    <div class="bdysec_right">
            <div class="clform">

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
