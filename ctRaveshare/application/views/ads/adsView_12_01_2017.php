<!--<?php //$this->load->view("header", "", $result); ?>
<?php //$this->load->view("nav_header", "", $result); ?>
Coming Soon-->
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Ads | Community</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/event.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/carosel.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<link href="<?php echo base_url(); ?>js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>js/datetimepicker/jquery.datetimepicker.js"></script>

<script>
var rlink='<?php echo base_url()."ads";?>';
//alert(rlink);
 $(document).ready(function(){
   
  
   
   $(".ulLevel1").unbind().bind("click", function(){
    var id = $(this).attr("id");
    var hasChild = $(this).attr("name");
    if(hasChild > 0){
      $("#ul1_"+id).slideToggle('slow'); 
      if($(this).text() == '-'){
        $(this).text('+');
      }else{
        $(this).text('-');
      }
    }
  });
  
  $(".ulLevel2").unbind().bind("click", function(){
    var id = $(this).attr("id");
    var hasChild = $(this).attr("name");
    if(hasChild > 0){
      $("#ul2_"+id).slideToggle('slow'); 
      if($(this).text() == '-'){
        $(this).text('+');
      }else{
        $(this).text('-');
      }
    }
  });
  
  $(".ulLevel3").unbind().bind("click", function(){
    var id = $(this).attr("id");
    var hasChild = $(this).attr("name");
    if(hasChild > 0){
      $("#ul3_"+id).slideToggle('slow'); 
      if($(this).text() == '-'){
        $(this).text('+');
      }else{
        $(this).text('-');
      }
    }
  }); 
  


$(".explor").click( function(e){
  
  e.preventDefault();
  var adurl = $(this).attr("href");
  var bxhgt = $(".boxwrap").height();

  $(".boxwrap").append('<iframe id="adfrem" src="'+ adurl +'?autoplay=1"  style="width:100%;" height="'+ bxhgt +'" scrolling="auto" title="adfreme"></iframe> ');
//$(".boxwrap").append('<iframe width="100%" height="'+ bxhgt +'" src="'+ adurl +'"></iframe>');
//$(".boxwrap").append('<iframe width="420" height="345" src="https://www.youtube.com/embed/FIRT7lf8byw"></iframe>');



  $('a.crosclose').html('<span class="back12">Loading....</span>');
  $(".crosclose a").attr("href", "#");
  /*########### START #########*/

 var count=12;

var counter=setInterval(timer, 1000); //1000 will  run it every 1 second

function timer()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     return;
  }

 document.getElementById("timer").innerHTML=count; // watch for spelling
}
  /*########### END ##########*/
  setTimeout(myBackFunction, 12000);
  
  
  
  
$(".crosclose").click( function(e){ 
e.preventDefault();
  $("#adfrem").remove();
  $('span.crosclose').remove();
  $('a.crosclose').html('<span>Watch ads</span>');  
  $(".crosclose a").attr("href", rlink);
});
    
})



  
  
 });
 
 function myBackFunction() {
    
    $('a.crosclose').html('<span class="back">Back</span>');
}
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancyBoxContent/jquery.fancybox.css?v=2.1.4" media="screen" />
<script>
$(document).ready(function(){
  $("#videoLinkId").click(function() {
    var path = $(this).attr("name");
    $.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
  });
});

//watch Event Video 
function openVideoDivToPlay(path){
  $.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
    
}
</script>
<script type="text/javascript">
$(document).ready(function() {
$("#tutorial-videoAb").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="https://www.youtube.com/embed/xp5RlT8O2zU" frameborder="0" allowfullscreen></iframe>');
		 });
		 });
</script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
<style type="text/css">
.adsnewtab{}
.adsnewtab .left-logo{width:202px; float:left; text-align:center;}
.adsnewtab .right-exp {
    border-left: 1px solid #bcbcbc;
    float: right;
    padding-left: 25px;
    width: 202px;
	text-align:center;
}

.adsnewtab .right-exp h3 {
    color: #a80fa8;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 20px;
    margin-top: 20px;
	text-transform: uppercase;
}

.adsnewtab .right-exp p {
    color: #5c5c5c;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 14px;
	line-height: 22px;
	min-height:119px;
}

.adsnewtab .right-exp a.expbutton {
    background: #a80fa8;
    color: #fff;
    display: block;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 17px;
    line-height: 30px;
    margin-left: -24px;
    margin-right: -3px;
    text-align: center;
	text-transform: uppercase;
}
.adsnewtab ul li {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #b3b3b3;
    float: left;
    height: 190px;
    margin-bottom: 10px;
    margin-left: 10px;
    padding: 4px;
    width: 434px;
}
.adsnewtab ul li p.icon-brands {
    background: #dedede none repeat scroll 0 0;
    margin-left: -3px;
    margin-right: -3px;
    padding-left: 10px;
	text-align:left;
}
.adsnewtab a img {
    height: 20px;
    margin-top: 6px;
	margin-right: 9px;
}

.add-videoban {
    background: #fefefe none repeat scroll 0 0;
    border: 1px solid #e8e5e5;
    margin-bottom: 20px;
    margin-left: 10px;
    margin-right: 10px;
    padding: 15px;
}
.add-videoban h4{float: left; display:inline !important;}
.add-videoban h4 span {
    color: #4e4e4e;
    display: block;
    float: left;
    font-family: arial;
    font-size: 20px;
    font-weight: normal;
    line-height: 24px;
	margin-top:10px;
}
.add-videoban p {
    float: right;
    font-family: arial;
    font-size: 17px;
    font-weight: normal;
    line-height: 20px;
	width: 50%;
	padding-top:5px;
}
.add-videoban img {
    margin-left: 110px;
}
.add-bannerbott {
    margin-left: 10px;
    margin-right: 10px;
    margin-top: 20px;
    text-align: center;
}
.add-bannerbott a img{width:auto !important; height:auto !important;}
.add-videoban a img{width:auto !important; height:auto !important;}
.add-bannerbott h3 {
    color: #fff;
    font-family: arial;
    font-size: 26px;
    font-weight: normal;
    line-height: 26px;
}
.watchvideo-popuptab{display:none;}
.slider, #slider1{
 margin: 0 auto;
 width: 902px !important;
 height: 139px !important;	
 border: 0;
 border-radius:0;
 box-shadow: 0;
}
.slider li, #slider1 li{
  border: 0 none;
    height: 139px !important;
    margin: 0 !important;
    padding: 0 !important;
    width: 902px !important;
}
.slider img{ width: 902px !important;
 height: 139px !important;
}
</style>
</head>
<body>

<div class="wrapper">
  <?php $this->load->view('header',$result);?>
  <?php $this->load->view('nav_header',$result);?>
  <!--header end-->
  
  <div class="main_container">
  
  <!--<div class="boxwrap" style="min-height:800px;">
   
   <?php 
      if(count($list) > 0){
          foreach($list as $key=>$valList){ 
            $className = "table-gray";
          if ($key % 2 == 0) {
                      $className = "";
          }
      ?>

      <div class="smlbox">
      <div class="smlheading"><?php echo substr($valList->title, 0,30); ?></div>
      <div class="smldescrip">
      <?php echo $valList->description; ?>
      </div>  
      <a class="explor" href="<?php echo $valList->url;?>">Explore</a>

      </div>

           
            <?php } 
      }else{
      ?>
      <div class="smlbox">No Data!</div>
      <?php } ?>
 
 
 <br clear="all" />
 
 </div>--> 
  
    <!--<div class="white-bg">
      <img src="<?php echo base_url(); ?>images/CT_Rev_AD1.png" alt=""  >
    <div class="backdiv"><a href="#" onclick="history.go(-1); return false;" >Back</a></div>
    </div>-->
  <div class="adsnewtab">
  <div class="add-videoban">
  <a id="tutorial-videoAb" name="https://www.youtube.com/embed/xp5RlT8O2zU" href="javascript:void(0)">
  <h4>
<span>Click Explore & <br>
Watch ALL 12 Ads</span>
 <img src="<?php echo base_url(); ?>images/video-playicon.png" alt=""  >
 </h4></a>
<p>if you find an offer you want, or if you wish to enter
your business into one of our partnership associations<br>
Please mail us or call CT Switchboard on</p>
<br class="clear">
</div>
  <ul>
  <li>
<div class="left-logo">
<img alt="" src="http://www.communitytreasures.co/images/a1.png">
<p class="icon-brands">

<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
</p></div>
<div class="right-exp">
<h3>Fashion</h3>
<p>Get Members Discounts<br>
Jobs / Career<br>
Partnerships<br>
Call CT Switchboard</p>
<a href="#" class="expbutton">Explore</a>
</div>
 <br class="clear">
</li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a2.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Music</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
     <li>
<div class="left-logo">
<img alt="" src="http://www.communitytreasures.co/images/a3.png">
<p class="icon-brands">

<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
</p></div>
<div class="right-exp">
<h3>Publishing</h3>
<p>Get Members Discounts<br>
Jobs / Career<br>
Partnerships<br>
Call CT Switchboard</p>
<a href="#" class="expbutton">Explore</a>
</div>
 <br class="clear">
</li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a4.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Mag</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
  <li>
<div class="left-logo">
<img alt="" src="http://www.communitytreasures.co/images/a5.png">
<p class="icon-brands">

<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
</p></div>
<div class="right-exp">
<h3>Games</h3>
<p>Get Members Discounts<br>
Jobs / Career<br>
Partnerships<br>
Call CT Switchboard</p>
<a href="#" class="expbutton">Explore</a>
</div>
 <br class="clear">
</li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a6.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Active</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
     <li>
<div class="left-logo">
<img alt="" src="http://www.communitytreasures.co/images/a7.png">
<p class="icon-brands">

<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
</p></div>
<div class="right-exp">
<h3>Business</h3>
<p>Get Members Discounts<br>
Jobs / Career<br>
Partnerships<br>
Call CT Switchboard</p>
<a href="#" class="expbutton">Explore</a>
</div>
 <br class="clear">
</li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a8.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Resort</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
     <li>
<div class="left-logo">
<img alt="" src="http://www.communitytreasures.co/images/a9.png">
<p class="icon-brands">

<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
</p></div>
<div class="right-exp">
<h3>Travel</h3>
<p>Get Members Discounts<br>
Jobs / Career<br>
Partnerships<br>
Call CT Switchboard</p>
<a href="#" class="expbutton">Explore</a>
</div>
 <br class="clear">
</li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a10.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Radio</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a11.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Online tv</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a12.png">
    <p class="icon-brands">
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Trading Club</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>

<div style="display:none;">    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a11.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Online tv</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a12.png">
    <p class="icon-brands">
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Trading Club</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a11.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Online tv</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a12.png">
    <p class="icon-brands">
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Trading Club</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a11.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Online tv</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a12.png">
    <p class="icon-brands">
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Trading Club</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a11.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Online tv</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a12.png">
    <p class="icon-brands">
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Trading Club</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a11.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Online tv</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a12.png">
    <p class="icon-brands">
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Trading Club</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a11.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Online tv</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a12.png">
    <p class="icon-brands">
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Trading Club</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>

    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a11.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Online tv</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a12.png">
    <p class="icon-brands">
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Trading Club</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a11.png">
    <p class="icon-brands">
    
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Online tv</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li>
    <li>
    <div class="left-logo">
    <img alt="" src="http://www.communitytreasures.co/images/a12.png">
    <p class="icon-brands">
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/brand-facebook.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/mag-small.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/twitter_new.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/inst-icon.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/skype.png"></a>
<a href="#"><img alt="" src="http://www.communitytreasures.co/images/gmail-icon.png"></a>
    </p></div>
    <div class="right-exp">
    <h3>Trading Club</h3>
    <p>Get Members Discounts<br>
    Jobs / Career<br>
    Partnerships<br>
    Call CT Switchboard</p>
    <a href="#" class="expbutton">Explore</a>
    </div>
     <br class="clear">
    </li></div>
    
  </ul>
  <br class="clear">
  <div class="add-bannerbott">
  <div class="slider">
<ul id="slider1">
	<li><img alt="" src="http://www.communitytreasures.co/images/mov-banner.png"></li>
    <li><img alt="" src="http://www.communitytreasures.co/images/mov-banner2.png"></li>
    <li><img alt="" src="http://www.communitytreasures.co/images/mov-banner.png"></li>
    <li><img alt="" src="http://www.communitytreasures.co/images/mov-banner2.png"></li>
    <li><img alt="" src="http://www.communitytreasures.co/images/mov-banner.png"></li>

</ul>
</div>
 <!-- <a href="#"><img alt="" src="http://www.communitytreasures.co/images/mov-banner.png"></a>-->
</div>
  </div>
    <br class="clear">
  </div>
</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.cycle.all.js"></script> 
<script language="javascript">
$(document).ready(function(){
	$('#slider1') .cycle({
		fx: 'fade', //'scrollLeft,scrollDown,scrollRight,scrollUp',blindX, blindY, blindZ, cover, curtainX, curtainY, fade, fadeZoom, growX, growY, none, scrollUp,scrollDown,scrollLeft,scrollRight,scrollHorz,scrollVert,shuffle,slideX,slideY,toss,turnUp,turnDown,turnLeft,turnRight,uncover,ipe ,zoom
		speed:  'slow', 
   		timeout: 2000 
	});
});	
</script>
</body>
</html>


