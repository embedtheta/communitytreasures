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
$("#tutorial-video101").click(function() {
			$.fancybox.open('<iframe width="660" height="415" src="<?php echo $stepWiseVideo[1][1]["path"];?>" frameborder="0" allowfullscreen></iframe>');
		 });
});
</script>

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
<style type="text/css">
.task-section p{font-size:17px !important; padding-bottom:10px; color:#3e3e3e !important;}
</style>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>

</head>

<body>



<div class="wrapper">

  <?php $this->load->view('header',$result);?>

  <?php $this->load->view('nav_header',$result);?>

  <!--header end-->

  

  <div class="main_container">

    <div class="lefts_side">
<!--<div class="task-section">
<h3>#339: Report a photo "Extra Energy" on you page.</h3>
<p class="brdcm-ttt"><a href="#">Online</a> > <a href="#">Social Networks</a> > <a href="#">Facebook</a> > <a href="#">Report a Photo of our community on your page</a></p>
<p>#Lorem ipsum dolor sit amet. #Consectetuer adipiscing elit sed diam.</p>
<ul>
<li class="f1"><span>Consectetuer adipiscing elit sed diam</span>
<span class="smalll">Lorem ipsum dolor sit amet. Ut wisi enim ad.</span></li>
<li>Nibh euismod tincidunt ut. Laoreet dolore magna aliquam erat.</li>
<li>Ut wisi enim ad. Minim veniam quis nostrud exerci.</li>
<li>Ullamcorper suscipit lobortis nisl. Ut aliquip ex ea commodo.</li>
</ul>
<a href="#" class="task-star-btn">Start</a>
<br class="clear">

</div> <div class="task-section">
<h3>#339: Report a photo "Extra Energy" on you page.</h3>
<p class="brdcm-ttt"><a href="#">Online</a> > <a href="#">Social Networks</a> > <a href="#">Facebook</a> > <a href="#">Report a Photo of our community on your page</a></p>
<p>#Lorem ipsum dolor sit amet. #Consectetuer adipiscing elit sed diam.</p>
<ul>
<li class="f1"><span>Consectetuer adipiscing elit sed diam</span>
<span class="smalll">Lorem ipsum dolor sit amet. Ut wisi enim ad.</span></li>
<li>Nibh euismod tincidunt ut. Laoreet dolore magna aliquam erat.</li>
<li>Ut wisi enim ad. Minim veniam quis nostrud exerci.</li>
<li>Ullamcorper suscipit lobortis nisl. Ut aliquip ex ea commodo.</li>
</ul>
<a href="#" class="task-star-btn">Start</a>
<br class="clear">

</div> <div class="task-section">
<h3>#339: Report a photo "Extra Energy" on you page.</h3>
<p class="brdcm-ttt"><a href="#">Online</a> > <a href="#">Social Networks</a> > <a href="#">Facebook</a> > <a href="#">Report a Photo of our community on your page</a></p>
<p>#Lorem ipsum dolor sit amet. #Consectetuer adipiscing elit sed diam.</p>
<ul>
<li class="f1"><span>Consectetuer adipiscing elit sed diam</span>
<span class="smalll">Lorem ipsum dolor sit amet. Ut wisi enim ad.</span></li>
<li>Nibh euismod tincidunt ut. Laoreet dolore magna aliquam erat.</li>
<li>Ut wisi enim ad. Minim veniam quis nostrud exerci.</li>
<li>Ullamcorper suscipit lobortis nisl. Ut aliquip ex ea commodo.</li>
</ul>
<a href="#" class="task-star-btn">Start</a>
<br class="clear">

</div>-->

<div class="task-section">

<div class="yvideo extra-pad">
            <span class="watch-thisvideo">Watch This Video</span>
            <div class="palvidd" style="width:530px; margin:0 auto;"><a href="javascript:void(0)" id="tutorial-video101">
<img src="http://globalblackenterprises.com/adminuploads/level_wise_images/lwi_1456323277.png" alt="" width="527" height="320">
            </a></div>
             </div>
             <br class="clear">
<!--<h3>#339: Report a photo "Extra Energy" on you page.</h3>
<p class="brdcm-ttt"><a href="#">Online</a> > <a href="#">Social Networks</a> > <a href="#">Facebook</a> > <a href="#">Report a Photo of our community on your page</a></p>
<p>#Lorem ipsum dolor sit amet. #Consectetuer adipiscing elit sed diam.</p>
<ul>
<li class="f1"><span>Consectetuer adipiscing elit sed diam</span>
<span class="smalll">Lorem ipsum dolor sit amet. Ut wisi enim ad.</span></li>
<li>Nibh euismod tincidunt ut. Laoreet dolore magna aliquam erat.</li>
<li>Ut wisi enim ad. Minim veniam quis nostrud exerci.</li>
<li>Ullamcorper suscipit lobortis nisl. Ut aliquip ex ea commodo.</li>
</ul>-->
<p>Share A Video On Facebook or Twitter</p>

<p>Go to this facebook group (Click here)
Find Todays posted video and banner 
Then click the share button and share it on your facebook.</p>

<p>Finally copy the URL here and click 'DONE' So Our team can check your action.</p>
<br>
<p><input name="" type="text" style="  height: 27px; width: 400px;">
<a href="#" class="task-star-btn">DONE</a></p>
</div>
  </div>

     <!-- right side tab start--> 

  <?php $this->load->view("right_panel", "", $result); ?>

  

  <!-- rights side end -->

	

    <br class="clear">

  </div>

</div>

</body>

</html>

