<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Event | Community</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/event.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/carosel.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo base_url();?>js/jqueryy-1.7.1.min.js"></script>
<link href="<?php echo base_url(); ?>js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>js/datetimepicker/jquery.datetimepicker.js"></script>
<script type="text/javascript">


function readURL(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
		$('#image_path_img_id').show();
		$('#image_path_img_id').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}



</script>
<script>

 $(document).ready(function(){
	 
	$('#start_date').datetimepicker({
		timepicker:false,
		value:'<?php echo $eventDetails[0]->start_date;?>',
		format:'Y-m-d'
	});
	
	$('#end_date').datetimepicker({
		timepicker:false,
		value:'<?php echo $eventDetails[0]->end_date;?>',
		format:'Y-m-d'
	});
	 
	 
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
	
	
	
 });
 
 function showAlert(){
	 var msg = "You can send 12 request on each Level.";
	 $.fancybox.open(msg);
     return false;
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
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>
<!--?php $this->load->view('header-logo');?--us 26/11/2015-->
<div class="wrapper">
  <?php $this->load->view('header',$result);?>
  <?php $this->load->view('nav_header',$result);?>
  <!--header end-->
  
  <div class="main_container">
    <div class="white-bg">
      <div class="mms_page"> 
      <div class="viewban">
 <div class="titlnme"><?php echo $eventDetails[0]->name;?></div>
 <div class="viewdat"><?php echo $eventDetails[0]->start_date;?></div>
 <div class="viewloc"><?php echo $eventDetails[0]->country_name;?></div>
<?php
	$newDate =""; 
	if($eventDetails[0]->start_date!=""){
		$changeDt =date("d-M", strtotime($eventDetails[0]->start_date));
		$dtArr = explode('-',$changeDt);
		$newDate = '<span>'.$dtArr[0].' </span>'.$dtArr[1];
	}
	
	if($eventDetails[0]->video_path!=""){
		$arr     = explode("embed/",$eventDetails[0]->video_path);
	}
	?>
 
  <div class="viewmiddat"><?php echo $newDate;?><!--<span> 22 </span> Feb --></div>
  
  <div class="viewimg">
  <?php if(count($arr)>0){?>
  <a href="javascript:void(0)" onClick="openVideoDivToPlay('<?php echo $eventDetails[0]->video_path;?>')"  >
  <img  src="http://i4.ytimg.com/vi/<?php echo $arr[1];?>/0.jpg">
  </a>
  <?php } else{ ?>
  <img id="image_path_img_id" src="<?php echo base_url();?>useruploads/events/<?php echo $eventDetails[0]->image_path;?>">
  <?php } ?>
  </div>
 
  </div>
      
      
      
      
        <!--<div class="mms_page_frm">
         
         
          <?php if($userType == "ADMIN"):?>
          <p>You Are Super Admin</p>
          <?php else:?>
          <p>You Are Currently On Level - <?php echo $userInfo[0]['userLevel']+1;?></p>
          <?php endif;?>
        </div>-->
        
        <div class="fm_mss add_vew">
          <h3>
            <?php if($userId == $eventDetails[0]->userId){?>
            <a href="<?php echo base_url();?>event/edit/<?php echo $eventDetails[0]->id;?>">Edit</a>
            <?php }?>
          </h3>
          <?php if($msg != ""):?>
          <div class="global-msg-<?php echo $status;?>"><?php echo $msg;?></div>
          <?php endif;?>
          <div class="add_vw_left">
            <p>
              <label>Name</label><span>:</span>
              <strong><?php echo $eventDetails[0]->name;?></strong> </p>
              
            <p>
              <label>Start Date</label><span>:</span>
              <strong><?php echo $eventDetails[0]->start_date;?></strong> </p>
           <p>
           <label>End Date</label><span>:</span>
              <strong><?php echo $eventDetails[0]->end_date;?></strong> </p>
              <p>
              <label>Zip code</label><span>:</span>
              <strong><?php echo $eventDetails[0]->zip_code_name;?></strong> </p>
               <p>
              <label>Contact No</label><span>:</span>
              <strong><?php echo $eventDetails[0]->contact_number;?></strong> </p>
            <p>
            <!--<p>
              <label>Image</label><span>:</span><img width="75" height="75" id="image_path_img_id" src="<?php echo $this->config->item('gbe_base_url');?>useruploads/events/<?php echo $eventDetails[0]->image_path;?>"> </p>-->
          </div>
          <div class="add_vw_rits">
            <p>
              <label>Country</label><span>:</span>
              <strong><?php echo $eventDetails[0]->country_name;?></strong> </p>
              
              
              <p>
              <label>City</label><span>:</span>
              <strong><?php echo $eventDetails[0]->city_name;?></strong> </p>
            <p>
              <label>Pdf Upload</label><span>:</span>
              <a href="<?php echo base_url();?>useruploads/events/<?php echo $eventDetails[0]->pdf;?>"><?php echo $eventDetails[0]->pdf;?></a> </p>
            <p>
              <label>Description</label><span>:</span>
              <strong class="frmdescp"><?php echo $eventDetails[0]->desc;?></strong> 
              <?php echo form_error('desc', '<span class="form_error">', '</span>'); ?> </p>
          </div>
          <div class="clear"></div>
		  <div><ul>
		  <?php if($eventDetails[0]->image_path!=""){?>
		  <li><img src="<?php echo base_url();?>useruploads/events/<?php echo $eventDetails[0]->image_path;?>" height="100px" width="130px"></li>
		  <?php }?>
		  <?php if($eventDetails[0]->image_path2!=""){?>
		  <li><img src="<?php echo base_url();?>useruploads/events/<?php echo $eventDetails[0]->image_path2;?>" height="100px" width="130px"></li>
		  <?php }?>
		  <?php if($eventDetails[0]->image_path3!=""){?>
		  <li><img src="<?php echo base_url();?>useruploads/events/<?php echo $eventDetails[0]->image_path3;?>" height="100px" width="130px"></li>
		  <?php }?>
		  <?php if($eventDetails[0]->image_path4!=""){?>
		  <li><img src="<?php echo base_url();?>useruploads/events/<?php echo $eventDetails[0]->image_path4;?>" height="100px" width="130px"></li>
		  <?php }?>
		  <?php if($eventDetails[0]->image_path5!=""){?>
		  <li><img src="<?php echo base_url();?>useruploads/events/<?php echo $eventDetails[0]->image_path5;?>" height="100px" width="130px"></li>
		  <?php }?>
		  </ul></div>
          <input name="button" type="reset" class="famrst" value="Back" onClick="window.location='<?php echo base_url();?>fullmembers'">
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <br class="clear">
  </div>
</div>
</body>
</html>
