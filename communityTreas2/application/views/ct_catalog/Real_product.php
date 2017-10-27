<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CT Real Estate Product</title>
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
          <ul>
			<?php if($category_details){
				  foreach($category_details as $cd){
			   ?>
				<li><a href="<?php echo base_url();?>dashboard/ct_realestate_product/<?php echo $cd['id'];?>"><?php echo $cd['title'];?></a></li>
			 <?php } }?>
		</ul>
        </div>
      </div>
      <div class="my-right-cont">
              <?php if($product_description){
				  foreach($product_description as $pd){
			   ?>
              <div class="list-detail">
                <!-- Image -->
                <img width="180" height="200" class="article-left-img" src="<?php echo $this->config->item('gbe_base_url');?>adminuploads/productPagesImg/<?php echo $cd['image'];?>">
                
                <!-- body -->
                <h1><?php echo $pd['title'];?></h1>
                <p><?php echo $pd['description'];?></p>
		<a href="#" style="color:#f00; font-weight:bold;display: block;
		text-align: right;">Read More</a>
                </div>
		 <?php } }?>
              <!--Product Show -->
              <div class="listwrap">
              
              			   </div>
              <!--Product Show -->                      
                        
             </div>
             
             <div class="new_sec_added">
             	<!--div class="srce-sec">
                <label>Search</label>
                <input type="text" placeholder="Location">
                </div-->
                <div class="src_catgr scroll-sec">
                	<ul>
					
                	<!--li><a href="<?php echo base_url();?>dashboard/real_buy"><img src="<?php echo base_url();?>/CT_images/Music.jpeg">
                                <p>A Mojito on the Rockz Productions</p>
                            </a></li-->
                            <?php if($monetizer_user){
                                foreach($monetizer_user as $mu){
                                    
                            ?>
                            <li><a href="<?php echo base_url();?>dashboard/monetizer_divition/<?php echo $mu['uID'];?>/<?php echo $mu['user_general_type_name'];?>"><img src="<?php echo $this->config->item('gbe_base_url').'useruploads/'.$mu['profile'];?>">
                                <p><?php echo $mu['firstName'];?></p>
                            </a></li>                                    
                                <?php } } ?>
</ul>
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
            
            
            
            
            <div class="fashn_rit event"><h2>Events &amp; Celebrations</h2>
            				
                            <?php if($monetizer_event){
                                foreach($monetizer_event as $me){
                            ?>
							<a href="<?php echo base_url();?>dashboard/view_detail/<?php echo $me['id'];?>">
							 <h3><?php echo $me['title'];?></h3><p><img width="105" height="105" src="<?php echo $this->config->item('gbe_base_url').'adminuploads/productPagesImg/'.$me['image'];?>">
							<?php echo $me['description'];?></p></a>
							<hr class="hrr">
							<? }}?>
                    	<!--a href="http://www.afrowebb.com/welcome/view_Detail/18">
                        <h3>CT Business Conference</h3><p><img width="105" height="105" src="http://globalblackenterprises.com/adminuploads/productPagesImg/GBEConference.jpg">
						This high powered 1 day business summit is designed to deliver an unprecedented networking space for deals, opportunities and knowledge sharing.
Durin.....</p></a>
                        <hr class="hrr">
                        	
                    	<a href="http://www.afrowebb.com/welcome/view_Detail/19">
                        <h3>Velvet Ball</h3><p><img width="105" height="105" src="http://globalblackenterprises.com/adminuploads/productPagesImg/Blackvelvet.JPG">
						The Velvet Ball is a spectacular annual event which brings together CT entrepreneurs, their partners, guests and invited business owners.&nbsp;
Thi.....</p></a-->
                        
                                     </div>
			 			 <br class="clear">
            <!--<div class="fashn_rit met"><h2>Residential</h2>
                          <a href="http://www.afrowebb.com/welcome/view_Detail/63">
             <h3>Parties &amp; Events</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/Localnight.jpg">
			 Our local event section features events hosted by GBE members who have reached level 3, a high standard of our online business.  With the vast trainin.....</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/64">
             <h3>Safe Neighbourhoods</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/Neighbourhood.jpg">
			 We must all unite and create communities where there is no place for murderous criminals to hide, whether they are young or old.
Onyx Council is a Ne.....</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/65">
             <h3>Real Estate</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/real_estate.jpg">
			 On this page you can find high quality property managers who are members of GBE, real estate agents or local realtors to assist you in all aspects of .....</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/66">
             <h3>Builders &amp; Decorators</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/decorpaint.jpeg">
			 This section is for skilled, reliable and professional tradesmen who can deal with all types of building work. 

We list Painter, 
Plastering,
Win.....</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/67">
             <h3>Interior &amp; Architecture</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/IneriorDecoraction.jpg">
			 The professions of Interior Design and Architecture are constantly evolving. This section lists practitioners who are on the cutting edge of their cra.....</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/68">
             <h3>Car Services</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/machanic.jpg">
			 Afrowebb features all types of car service providers, from maintenance, repairs to  dealers of low carbon cars.
This motoring resource features GBE me.....</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/69">
             <h3>Sports Clubs &amp; lessons</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/sports.jpg">
			 You can find info on local sports clubs and a comprehensive list of sports instructors.

You can find info on local sports clubs and a comprehensive l.....</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/70">
             <h3>Motorcycle Clubs</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/motorcycle.jpg">
			 The rise black motorcycle clubs is a phenomenon. So, Afrowebb has put together a list showing the best black motorcycle clubs that can be found in cit.....</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/71">
             <h3>Medical Services</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/Doctors.jpg">
			 This listing features health professionals and provide outpatient medical, nursing, dental, and other types of care services......</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/72">
             <h3>In Your Community</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/GBECommuni.jpg">
			 here we list public locations where members of a community gather for group activities, social support, public information, and other purposes......</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/73">
             <h3>Broadcasters &amp; Media</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/radio.jpg">
			 Find radio stations from all over the world, who are members of GBE......</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/79">
             <h3>Networking Events</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/blackbiz17.jpg">
			 Once monthly, GBE host Networking events in selected cities. These gatherings enable attendees to meet valuable new contacts, exchange knowledge and a.....</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/133">
             <h3>Seminars &amp; Trade Shows</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/GBEsiminar.jpg">
			 Listed are seminar &amp; events offered by a commercial or professional Black-owned organizations. These functions bring together audiences that focus on .....</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/138">
             <h3>Places of Prayer</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/ins.jpg">
			 This section lists local churches, mosques and temples.
We strive to only list place of harmony and peace......</p>
             </a>
              
                          <a href="http://www.afrowebb.com/welcome/view_Detail/235">
             <h3>Local Groups &amp; Meet Ups</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/GBEgroups.jpg">
			 Find groups and meet up with GBE members &amp; people in your local community who share your interests......</p>
             </a>
              
                         </div>
             <br class="clear">
             <div id="advertisementZone">
            	
                <div style="display: block; opacity: 0.869816;" id="advertisementId_91" class="book">
                <a href="http://www.afrowebb.com/welcome/view_Detail/91">
                    <img width="290" height="250" src="http://globalblackenterprises.com/adminuploads/productPagesImg/bookfrontss.jpg"><p>Rave Story Novel</p></a>
                </div>
            	
                <div style="display: none;" id="advertisementId_92" class="book">
                <a href="http://www.afrowebb.com/welcome/view_Detail/92">
                    <img width="290" height="250" src="http://globalblackenterprises.com/adminuploads/productPagesImg/think.jpg"><p>Motivation</p></a>
                </div>
                        </div>
             <div class="fashn_rit met"><h2>Mentorship</h2>
                          <a href="http://www.afrowebb.com/welcome/view_Detail/62">
             <h3>Regenesis Program</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/canstockphoto15167410.jpg">
			 The Re-genesis Program is designed to help you reboot and start again, this time stronger, wiser and fully equipped for what ever comes your way.  
Ou.....</p>
             </a>
                         </div>
            
            <br class="clear">
            <div class="fashn_rit met"><h2>Website Builders</h2>
                          <a href="http://www.afrowebb.com/welcome/view_Detail/78">
             <h3>Celestial Technologies</h3>
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/webbiz.jpg">
			 Celestial Technologies is a dedicated team of skilled developers and designers based in the UK &amp; US. 
We specialise in website development and design.....</p>
             </a>
                         </div>
  
	 <div class="fashn_rit met">    	     
             <h2> Carnivals &amp; Festivals</h2>
			               <a href="http://www.afrowebb.com/welcome/view_Detail/94">
             <p><img width="105" height="105" alt="" src="http://globalblackenterprises.com/adminuploads/productPagesImg/GBEcaribana.jpg">
			 Carnival for many people is a tradition that typically involves a public celebration or parade combining some elements of a circus, mask and public st.....</p>
             </a>
             			 </div>

    <br class="clear">
	<div class="fashn_rit met">
		<h2>Black Owned Businesses</h2>
<a href="http://www.afrowebb.com/welcome/view_ownedBusiness/1">
<p>Lorem ipsum nunc Donec mollis aliquet Maecenas adipiscing Nunc quis sem nec Duis mollis aliquet Cras nisl eros Sed pellentesque Donec a purus vel Sed .....</p>
</a>

	 	 <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div id="securityZone">
            	
                <div style="display:block;" id="securityId_8" class="book">
               <!-- <a href="http://www.afrowebb.com/welcome/viewDetail/Book/8">
                    <img width="290" height="250" src="http://globalblackenterprises.com/adminuploads/productPagesImg/security.jpg"><p>Arc-Angels Security</p></a>
                </div>
                         </div-->
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
<div class="add-sec">
<div class="wrapper">
 <a href="#"><img width="300" height="416" alt="" src="http://www.communitytreasures.co/images/add1.png"></a>
 <a href="#"> <img width="300" height="416" alt="" src="http://www.communitytreasures.co/images/add2.png"></a>
 <a href="#"><img width="300" height="416" alt="" src="http://www.communitytreasures.co/images/add3.png"></a>
</div>
<br class="clr">
</div><div class="footer-link">
<div class="wrapper">
<ul>
		<?php if($CT_Category){
			foreach($CT_Category as $cm){
		?>
		
			<li><a href="#"><?php echo $cm['title']; ?></a></li>
		<?php } }?>
		<!--li><a href="#">ART &amp; CRAFTS</a></li>
		
		<li><a href="#">BROADCASTERS &amp; MEDIA</a></li>
		
		<li><a href="#">BUILDERS &amp; DECORATORS</a></li>
		
		<li><a href="#">BUSINESS SERVICES</a></li>
		
		<li><a href="#">CARNIVALS &amp; FESTIVALS</a></li>
		
		<li><a href="#">CHARITIES &amp; FUNDRAISERS</a></li>
		
		<li><a href="#">CHILDREN</a></li>
		
		<li><a href="#">CLEAN WATER</a></li>
		
		<li><a href="#">COMMUNITY</a></li>
		
		<li><a href="#">CONSTRUCTION &amp; BUILDERS</a></li>
		
		<li><a href="#">CORPATIONS &amp; CO-OPERATIVES</a></li>
		
		<li><a href="#">DANCE</a></li>
		
		<li><a href="#">DANCE</a></li>
		
		<li><a href="#">DATING</a></li>
		
		<li><a href="#">DESIGN</a></li>
		
		<li><a href="#">DJs &ndash; Link</a></li>
		
		<li><a href="#">ECO PRODUCTS</a></li>
		
		<li><a href="#">ENERGY</a></li>
		
		<li><a href="#">FINANCIAL SERVICES</a></li>
		
		<li><a href="#">FOOD &amp; BEVERAGE</a></li>
		
		<li><a href="#">GARDEN</a></li>
		
		<li><a href="#">GIVING TIME</a></li>
		
		<li><a href="#">HAIR &amp; BEAUTY</a></li>
		
		<li><a href="#">HEALTH &amp; FITNESS</a></li>
		
		<li><a href="#">HOME CARE</a></li>
		
		<li><a href="#">MEDIA</a></li>
		
		<li><a href="#">MODELING</a></li>
		
		<li><a href="#">MUSIC</a></li>
		
		<li><a href="#">NIGTLIFE</a></li>
		
		<li><a href="#">OFFICE</a></li>
		
		<li><a href="#">PERFORMERS</a></li>
		
		<li><a href="#">PERSONAL DEVELOPEMENT</a></li>
		
		<li><a href="#">PHONES</a></li>
		
		<li><a href="#">PRECIOUS COMMODITIES</a></li>
		
		<li><a href="#">PROPERTY</a></li>
		
		<li><a href="#">PUBLISHING</a></li>
		
		<li><a href="#">REJUVENATION</a></li>
		
		<li><a href="#">SOCIALITES</a></li>
		
		<li><a href="#">SPORTS</a></li>
		
		<li><a href="#">TRADE SERVICES</a></li>
		
		<li><a href="#">TRANSPORT</a></li>
		
		<li><a href="#">TRAVEL &amp; HOLIDAYS</a></li>
		
		<li><a href="#">WEBSITES</a></li>
		
		<li><a href="#">WELLNESS</a></li-->

<br class="clr">
</ul>
</div>
</div>
<div class="copyright-sec"><p>Copyright @ Global Trade Enterprise 2015</p></div></div>
<!--footer section end-->
</body>
</html>
