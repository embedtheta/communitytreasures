<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<style type="text/css">
	.new_menu ul li ul {
    display: none;
}
.new_menu li {
    display: inline-block;
}
.new_menu li ul li {
    display: block;
}
.new_menu ul li ul li a::after {
    border: 0 none !important;
}
.new_menu ul li ul li a:hover {
    background: #aaa none repeat scroll 0 0;
    color: #fff;
}
.breadcu a:hover {
    text-decoration: underline;
}
.new_menu li:last-child a::after {
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid #1c75bc;
    content: "";
    position: relative;
    right: -4px;
    top: 9px;
}
.new_menu {
    clear: right;
    float: right;
    margin: 48px 0 0;
    position: relative;
}
.new_menu li a{color: #1c75bc; font-size: 14px; padding: 0 5px; text-transform: uppercase;}
.new_menu ul li ul li a {
    display: block;
    padding:3px 5px;
    text-transform: inherit;
    transition: all 0.45s ease 0s;
}
.new_menu ul li:hover ul{display: block; position: absolute;top: 20px; left: 0; background: #fff; border: 1px solid #aaa; width: 290px; transition: all 0.45s ease 0s; max-height: 460px; overflow-y: scroll; overflow-x:hiden;}

</style>


<div class="top-sticky">

<div class="top-shopsrc">

<div class="wrapper">

<h3>Earn Money for Watching & Sharing Videos >> START NOW!</h3>

<!--<h4>Shopping Cart 0 item(s)-$0.00 <a href="#"><img src="<?php echo base_url();?>images/down-arrow-small.png" alt="" /></a></h4>-->
<div class="top-socialicon">

    <a href="#"><img src="<?php echo base_url();?>images/facebook.png" alt="" /></a>

    <a href="#"><img src="<?php echo base_url();?>images/twitter.png" alt="" /></a>

    <a href="#"><img src="<?php echo base_url();?>images/in.png" alt="" /></a>

    <a href="#"><img src="<?php echo base_url();?>images/gplus.png" alt="" /></a>

    </div>
<br class="clr" />

</div>

</div>

<div class="wrapper">

<div class="top-sec">

<h1><a href="<?php echo base_url();?>dashboard/CT_catalog/" ><img src="<?php echo base_url();?>images/logoCT-new.png" alt="" /></a></h1>

    
<!--<div class="new_menu"><ul>
<?php
/*echo "<pre>";
print_r($_SERVER);
echo "</pre>";
exit;*/
$curent_url=$_SERVER['REQUEST_URI'];
if(!strstr($curent_url,"dashboard/CT_catalog")){
    ?>
    <li><a href="<?php echo base_url();?>dashboard/CT_catalog/">Home</a></li>
    <?php
}


?>


<li><a href="#">Categories</a>
<ul>
<?php if($CT_Category){

	foreach($CT_Category as $cm){

		?>
<li><a href="<?php echo base_url();?>dashboard/category_detail/<?php echo $cm['id']; ?>"><?php echo $cm['title']; ?></a></li>
<?php } }?>
</ul>

</div>-->
    <div class="top-search-section newproduct">

	<form id="srchFrm" name="srchFrm" action="<?php echo base_url();?>dashboard/search_header" method="post" >

<div style="position:relative; width: 240px; float: left;">
<span class="arrow-dp"></span>
<select id="ct_category_id" name="ct_category_id">

    <option>All Categories</option>

	<?php if($CT_Category){

	foreach($CT_Category as $cm){
        if($this->uri->segment(3)!="") {
		?>
		<option <?php if($this->uri->segment(3)==$cm['id']){ ?> selected="selected" <?php }?> value="<?php echo $cm['id']; ?>"><?php echo $cm['title']; ?></option>
		
		<?php } else {?>

		<option <?php if($this->session->userdata('catID')==$cm['id']){ ?> selected="selected" <?php }?> value="<?php echo $cm['id']; ?>"><?php echo $cm['title']; ?></option>
        
		<?php } ?>
		

<?php } }?>

    </select></div>
    <!--<input name="" type="text" placeholder="Deals Near Me" />-->
	<div style="position:relative; width: 158px; float: left; overflow:hidden; background:#fff; padding-left:40px ">
	<span class="arrow-dp2"></span>
<select id="pcity" name="pcity" style="width:176px; background-position:85% 50%; line-height:44px; height: 48px; display:block;
!important; float:left; padding-left:0;">
	 <option value="" selected>Select City </option>
	  <?php foreach($cityList as $key => $val) { ?>
	  <option value="<?=$val->id?>" <?=($val->id == $this->session->userdata('cityID'))?"selected":"";?>><?=$val->city?></option>
	  <?php }?>
    </select>
	</div>
    <input name="gotoMainCatBtn" id="gotoMainCatBtn" onClick="showCatpage()" type="submit" value="Go!" />
	
  	</form>

    </div>

  <!--  <h3>Create Your Account, Sell Products, Earn Commissions » START</h3>-->

    <br class="clr" />


</div></div>
<div class="new_nav">
<ul>
<li><a href="<?php echo base_url();?>dashboard/CT_catalog/">Home</a></li>
<li><a href="<?php echo base_url();?>dashboard/category_detail/622">advertising</a></li>
<li><a href="<?php echo base_url();?>dashboard/category_detail/604">Ct Festivals</a></li>
<li><a href="<?php echo base_url();?>dashboard/deal_of_the_day">Deal Of The Day</a></li>
</ul>
</div>
</div>

<!--<script type="text/javascript">

 

$(document).ready(function(){  

	 $("#ct_category_id").change(function() {

		  var selectedCatId =$("#ct_category_id").val();

		if(selectedCatId>0){

				$(location).attr('href','<?php //echo base_url();?>dashboard/category_detail/'+selectedCatId);



			}

			else{

				$.fancybox.open('Please select a Category');

			}

	 

		});



});

</script>-->



