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

	$(".boxwrap").append('<iframe id="adfrem" src="'+ adurl +'"  style="width:100%;" height="'+ bxhgt +'" scrolling="auto" title="adfreme"></iframe> ');
	
	$('a.crosclose').html('<span class="back">Back</span>');
	
	
	
$(".crosclose").click( function(e){	
e.preventDefault();
	$("#adfrem").remove();
	$('span.crosclose').remove();
	$('a.crosclose').html('<span>Watch ads</span>');	
});
		
})



	
	
 });
 
 
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
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="wrapper">
  <?php $this->load->view('header',$result);?>
  <?php $this->load->view('nav_header',$result);?>
  <!--header end-->
  
  <div class="main_container">
  
  <div class="boxwrap">
  
<div class="featurebox">  
  
<div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>
  
 
<div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>
  
  
  
  <div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div></div>
 
 
 
 
 
   <div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>
  
 
<div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>
  
  
  
  <div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>  
  
  
  <div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>
  
 
<div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>
  
  
  
  <div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>
 
 <div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>
  
 
<div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>
  
  
  
  <div class="smlbox">
  <div class="smlheading">Traffic Monsoon</div>
  <div class="smldescrip">
  serch 10 Site Each Day to Quality For Hourly Reserve Share
  </div>  
  <a class="explor" href="http://www.unicef.org.uk/UNICEFs-Work/Our-UK-work/?gclid=CNXw6Pj24MwCFcG6Gwodcg4F3A&sissr=1">Explore</a>
  </div>  
  
  

 
 
 
 <br clear="all" />
 
 </div> 
  
    <!--<div class="white-bg">
      <img src="<?php echo base_url(); ?>images/CT_Rev_AD1.png" alt=""  >
	  <div class="backdiv"><a href="#" onclick="history.go(-1); return false;" >Back</a></div>
    </div>-->
	
    <br class="clear">
  </div>
</div>
</body>
</html>
