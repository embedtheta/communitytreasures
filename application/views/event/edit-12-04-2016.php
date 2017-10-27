
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

function getCity(){
	var selectedCountryId = Number($('#country_id').val());
	if(selectedCountryId > 0){
		$.post('<?php echo base_url();?>event/getCity',{ c_id: selectedCountryId})
		.done(function(data){
			var res = $.parseJSON(data);
			$('#city_id').html(res.result);
			$('#zip_code_id').html('<option value="">Select One </option>');
		});
	}
}

function getZipCode(){
	var selectedCityId = Number($('#city_id').val());
	if(selectedCityId > 0){
		$.post('<?php echo base_url();?>event/getZipCode',{ c_id: selectedCityId})
		.done(function(data){
			var res = $.parseJSON(data);
			$('#zip_code_id').html(res.result);
		});
	}
}

function openCityAddCityDiv(){
	$('#newCity').show();
}

function closeNewCityDiv(){
	$('#newCity'). hide();
}

function addNewCity(){
	 var selectedCountryId = Number($('#country_id').val());
	 var newCityName = $('#newVendorCity').val();
	 if(selectedCountryId > 0 && newCityName!=''){
		$.ajax({
		 type: "POST",
		 url:  "<?php echo base_url();?>dashboard/addNewCity", 
		 data: "countryId="+selectedCountryId+"&newCityName="+newCityName,
		 cache:false,
		 dataType: "json",
		 success: 
			  function(data){	
				if(data.success == "yes"){	
					$('#newVendorCity').val('');
					$('#newCity').css('display','none');
					$("#city_id option").remove();	
					$('#city_id').append(data.cityList);
					$('#zip_code_id').html('<option value="">Select One </option>');								
					$.fancybox.open('City added Successfully');				
				}else{
					$.fancybox.open(data.message);
				}
			  }
		  });
	}else{
		if(selectedCountryId == ''){
			$.fancybox.open('Please select the Country.');
		}else if(newCityName == ''){
			$.fancybox.open('Please enter the City.');
		}
	}
 }
 

function openZipAddZipDiv(){
	 $('#newZip').css('display','block');
}
function closeNewZipDiv(){
	$('#newVendorZip').val('');
	$('#newZip').css('display','none');
}
function addNewZip(){
	 var cityId =$('#city_id').val();
	 var newZipCode = $('#newVendorZip').val();
	 if(cityId > 0 && newZipCode!=''){
		$.ajax({
		 type: "POST",
		 url:  "<?php echo base_url();?>event/addNewZip", 
		 data: "cityId="+cityId+"&newZipCode="+newZipCode,
		 cache:false,
		 dataType: "json",
		 success: function(data){			
				if(data.success == "yes"){	
					$.fancybox.open('Zip code added Successfully');
					$('#newVendorZip').val('');
					$('#newZip').css('display','none');
					$("#zip_code option").remove();									
					$('#zip_code_id').append(data.zipList);					
				}else{
					$.fancybox.open(data.message);
				}
			  }
		  });
	 }else{
		if(cityId == ''){
			$.fancybox.open('Please select the City.');
		}else if(newZipCode == ''){
			$.fancybox.open('Please enter the Zip code.');
		}
	 }
 }

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
</script>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>
<body>
<?php $this->load->view('header-logo');?>
<div class="wrapper">
   <?php $this->load->view('header',$result);?>
  <!--header end-->
  
  <div class="main_container">
   <div class="white-bg">
      <div class="mms_page">
        <!--<div class="mms_page_frm">
         
         
          <?php if($userType == "ADMIN"):?>
          <p>You Are Super Admin</p>
          <?php else:?>
          <p>You Are Currently On Level - <?php echo $userInfo[0]['userLevel']+1;?></p>
          <?php endif;?>
        </div>-->
      
        <div class="fm_mss add_events">
          <h3>Edit Event</h3>
          <!--<h3>MSS Invititation</h3>-->
          <?php if($msg != ""):?>
          <div class="global-msg-<?php echo $status;?>"><?php echo $msg;?></div>
          <?php endif;?>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="fms_lfts">
            <p>
              <label>Name</label>
              <input name="name" type="text" value="<?php echo $eventDetails[0]->name;?>">
              <?php echo form_error('name', '<span class="form_error">', '</span>'); ?>
            </p>
            <p>
              <label>Start Date</label>
              <input name="start_date" id="start_date" type="text">
              <?php echo form_error('start_date', '<span class="form_error">', '</span>'); ?>
            </p>
            <p class="countr">
              <label>Country</label>
               <select id="country_id" name="country_id" onChange="getCity()">
                	<option value="">Select One </option>
                     <?php if(count($countryList) > 0){ 
                            foreach($countryList as $cl){
                            	$selCountry = "";
                            	if(isset($eventDetails[0]->country_id) && ($cl->country_id == $eventDetails[0]->country_id)){
                            		$selCountry = 'selected="selected"';
                            	} 
                                ?>
                        <option value="<?php echo $cl->country_id;?>" <?php echo $selCountry;?>><?php echo $cl->name;?></option>
                        <?php }}?>
              </select>
               <?php echo form_error('country_id', '<span class="form_error">', '</span>'); ?>
            </p>
            <p class="zip">
              <label>Zip code</label>
               <select id="zip_code_id" name="zip_code_id">
                	<option value="">Select One </option>
                	 <?php if(count($zipList) > 0){ 
                	 			foreach($zipList as $cl){
                            		$selZip = "";
                            		if(isset($eventDetails[0]->zip_code_id) && ($cl['id'] == $eventDetails[0]->zip_code_id)){
                            			$selZip = 'selected="selected"';
                            		} 
                                ?>
                        <option value="<?php echo $cl['id'];?>" <?php echo $selZip;?>><?php echo $cl['zip_code'];?></option>
                        <?php }}?>
              </select>
               <?php echo form_error('zip_code_id', '<span class="form_error">', '</span>'); ?>
               <span class="addcityclass" ><a href="javascript:void(0)" onClick="openZipAddZipDiv();"><em>Add Zip Code</em> </a></span><br class="clear"> </p>
			<div id="newZip" style="display:none;"><input type="text" name="newVendorZip" id="newVendorZip" placeholder="Add your Zip"> <div class="ad" onClick="addNewZip()"> Add</div><div class="can" onClick="closeNewZipDiv()">Cancel</div></div>
                 
            <p class="img_uplod">
              <label>Image</label>
              <input name="image_path" type="file" onchange="readURL(this);">
              
              <img width="75" height="75" id="image_path_img_id" src="<?php echo base_url();?>useruploads/events/<?php echo $eventDetails[0]->image_path;?>">
              <input type="hidden" name="tempImage" value="<?php echo $eventDetails[0]->image_path;?>">
              <?php echo form_error('image_path', '<span class="form_error">', '</span>'); ?>
            </p>
            </div>
           
            <div class="fms_rits">
            <p>
              <label>Contact Number</label>
              <input name="contact_number" type="text" value="<?php echo $eventDetails[0]->contact_number;?>">
              <?php echo form_error('contact_number', '<span class="form_error">', '</span>'); ?>
            </p>
            <p>
              <label>End Date</label>
              <input name="end_date" id="end_date" type="text">
               <?php echo form_error('end_date', '<span class="form_error">', '</span>'); ?>
            </p>
            <p class="city">
              <label>City</label>
               <select id="city_id" name="city_id" onChange="getZipCode()">
                	<option value="">Select One </option>
                	<?php if(count($cityList) > 0){ 
                            foreach($cityList as $cl){
                            	$selCity = "";
                            		if(isset($eventDetails[0]->city_id) && ($cl['id'] == $eventDetails[0]->city_id)){
                            			$selCity = 'selected="selected"';
                            		} 
                                ?>
                        <option value="<?php echo $cl['id'];?>" <?php echo $selCity;?>><?php echo $cl['city'];?></option>
                        <?php }}?>
              </select>
               <?php echo form_error('city_id', '<span class="form_error">', '</span>'); ?>
               <span class="addcityclass" ><a href="javascript:void(0)" onClick="openCityAddCityDiv();"><em>Add City</em> </a></span><br class="clear"></p>
			<div id="newCity" style="display:none;"><input type="text" name="newVendorCity" id="newVendorCity" placeholder="Add your City"> <div class="ad" onClick="addNewCity()"> Add</div><div class="can" onClick="closeNewCityDiv()">Cancel</div></div>
            
            <p class="pdf_uplod">
              <label>Pdf Upload</label>
              <input name="pdf" type="file">
			  <strong><?php echo $eventDetails[0]->pdf;?></strong>
              <input type="hidden" name="tempPdf" value="<?php echo $eventDetails[0]->pdf;?>">
              <?php echo form_error('pdf', '<span class="form_error">', '</span>'); ?>
            </p>
            <p class="dscipn">
              <label>Description</label>
              <textarea name="desc"><?php echo $eventDetails[0]->desc;?></textarea>
              <?php echo form_error('desc', '<span class="form_error">', '</span>'); ?>
            </p>
            <div class="clear"></div>
            </div>
            <!--<p>
              <label>Location</label>
              <input name="location" type="text" value="">
               <?php echo form_error('location', '<span class="form_error">', '</span>'); ?>
            </p>-->
            
            <p class="btnss"><input name="submit" type="submit" value="Save"> 
            <!-- <input name="" type="reset" value="reset"> -->
            <input name="button" type="reset" value="Back" onClick="window.location='<?php echo base_url();?>fullmembers'"></p>
            <div class="clear"></div>
           
          </form>
        </div>
       
        
      </div>
    </div>
    <br class="clear">
  </div>
 
</div>



</body>
</html>
