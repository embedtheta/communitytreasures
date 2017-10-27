
<script type="text/javascript">
    
$(document).ready(function() {
   
    
	$(".share-btn").click(function(e){
		$(this).parent().find('.share-popup').fadeIn(1000);
	 }); 
	$(".share-btn").blur(function(e){
		$(this).parent().find('.share-popup').fadeOut(1000);
	}); 
	$(".watch-video-tut").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
	});
	$(".watch-video-tut1").click(function() {
		var path = $(this).attr("name");
		$.fancybox.open('<iframe width="660" height="415" src="'+path+'?autoplay=1" frameborder="0" allowfullscreen></iframe>');
	});
        
});

</script>



<script type="text/javascript">
jQuery(function ($) {
	// Load dialog on click
	$('.palvidd').click(function (e) {
            $(this).next('.basic-modal-content').modal();
            return false; 
	});
        
	$('.clickopen').click(function () {
            $(this).next().slideToggle("slow");
	});
        
        /* expell functionality */
        $(".expellClass").click(function(){
            var id = $(this).attr("id");
            $.ajax({
                type : "POST",
                data : "uID="+id,
                url : "<?php echo base_url();?>dashboard/expell/",
                success : function(data){
                    //alert(data);
					formSubmitMsg ='User expelled successfully';
					$.fancybox.open(formSubmitMsg);
                }
            }); 
        });
        
    /*end*/
	
});

var userLevel  = <?php echo $userInfo[0]['userLevel'];?>;
var formSubmitMsg = "<?php echo $msg;?>";
var formSubmitType = "<?php echo $type;?>";
</script> 
<script type='text/javascript' src='<?php echo base_url(); ?>js/custom_common.js'></script>
<link type='text/css' href='<?php echo base_url(); ?>css/basic.css' rel='stylesheet' media='screen' />
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.simplemodal.js'></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

    $(function() {
        $('#productEventEndDate').datepicker({dateFormat: "yy-mm-dd"});
		$('#productEventEndDateEdit').datepicker({dateFormat: "yy-mm-dd"});
    });

</script>

<style>
.sm.extra-no-pad td{ 
    border:none;
}
.kk {
    display: block !important;
    float: none !important;
    height: auto;
    margin: 5px auto !important;
    width: 250px;
}
.pp{ 
    margin-left:0;
}
  </style>