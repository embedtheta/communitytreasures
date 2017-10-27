<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />

<div class="top-sticky">
<div class="top-shopsrc">
<div class="wrapper">
<h3>Create Your CT Account & Earn Commissions From Listed Products >> START NOW!</h3>
<h4>Shopping Cart 0 item(s)-$0.00 <a href="#"><img src="<?php echo base_url();?>images/down-arrow-small.png" alt="" /></a></h4>
<br class="clr" />
</div>
</div>
<div class="wrapper">
<div class="top-sec">
  <h1><a href="<?php echo base_url();?>dashboard/CT_catalog/" ><img src="<?php echo base_url();?>images/CT_logo.png" width="134" height="99" alt="" /></a>
<h5> Customer Service<br />
Call: 0895 786 5678 </h5>
 </h1>
    <div class="top-socialicon">
    <a href="#"><img src="<?php echo base_url();?>images/facebook.png" alt="" /></a>
    <a href="#"><img src="<?php echo base_url();?>images/twitter.png" alt="" /></a>
    <a href="#"><img src="<?php echo base_url();?>images/in.png" alt="" /></a>
    <a href="#"><img src="<?php echo base_url();?>images/gplus.png" alt="" /></a>
    </div>
    <div class="top-search-section">
	<!--<form id="srchFrm" action="<?php echo base_url();?>dashboard/goToMainCategory" method="post" >-->
    <select id="ct_category_id" name="ct_category_id">
    <option>All Categories</option>
	<?php if($CT_Category){
	foreach($CT_Category as $cm){
		?>
		<option value="<?php echo $cm['id']; ?>"><?php echo $cm['title']; ?></option>
		
<?php } }?>
    </select>
    <!--<input name="" type="text" />-->
   <!-- <input name="gotoMainCatBtn" id="gotoMainCatBtn" onClick="showCatpage()" type="submit" value="" />-->
	<!--</form>-->
    </div>
  <!--  <h3>Create Your Account, Sell Products, Earn Commissions » START</h3>-->
    <br class="clr" />
</div></div></div>
<script type="text/javascript">
 function showCatpage(){
	 var selectedCatId =$("#ct_category_id").val();
		if(selectedCatId>0){
			$(location).attr('href','<?php echo base_url();?>dashboard/category_detail/'+selectedCatId);

		}
		else{
			$.fancybox.open('Please select a Category');
		}
 }
</script>

