<?php $this->load->view('adminTemplates/common/header',$viewData);?>

<script type="text/javascript">
var totalUser = Number(<?php echo $hvDetails[0]->mss_total;?>);

$(document).ready(function(e) {
	$("#resetId").click(function(){
		totalUser = Number(<?php echo $hvDetails[0]->mss_total;?>);
	});
	
    $("#empPic").hide();
	$('.checkedClass').click(function() {
        var val = Number($(this).val());
		if(val > 0){
			if($(this).prop('checked') == true){
				totalUser = totalUser + 1;
			}else if($(this).prop('checked') == false){
				totalUser = totalUser - 1;
			}
		}
		
		if(totalUser > 12){
			totalUser = totalUser - 1;
			$(this).prop('checked',false);
			alert('12 members are already assigned of this Head Volunteers.');
			
		}
    });
	
	if(totalUser == 12){
		alert('12 members are already assigned of this Head Volunteers.Please assign to others Head Volunteers.');
	}
	
	
});
function readURL(input) {
	if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
         $('#empPic').attr('src', e.target.result);
		  $("#empPic").show();
      }
      reader.readAsDataURL(input.files[0]);
    }
}

function resetTotalVal(){
	alert('ok');
	return true;	
}


</script>

<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Assign Afroweb user as Volunteer under Head Volunteer <strong><?php echo $hvDetails[0]->firstName.' '.$hvDetails[0]->lastName;?> </strong></h2>
            <h3 align="right">
<!--                 <a href="<?php echo base_url();?>cp/getXls/1">Get Report</a>-->
            </h3>
        </div>
            
        <!--Success-->
        <?php if($report == 1){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if($report == 2){ ?>
        <div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Error-->
        
        
        <!--Warning-->
        <!--<div class="admin-msg warning-msg">
            <i class="fa fa-warning"></i>  
                <span>Aenean interdum interdum ligula, vitae auctor nisl bibendum eu.</span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>-->
        <!--Error-->
        
        
        <div class="table-content">
            <div class="main_section" style=" width:98%; padding:4px 2px; text-align: center">
        			<form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="hvId" value="<?php echo $hvId;?>" />
                    <?php if(count($list) > 0): foreach($list as $vv):?>
                    <label class="c_box">
                    	<p class="user_images"><img src="<?php echo base_url();?>useruploads/<?php if($vv->profile != ''){echo $vv->profile;}else{ echo 'member_img.png';}?>" /></p>
                        <p class="name_sec"><input name="id[]" type="checkbox" class="checkedClass" value="<?php echo $vv->uID;?>" /> 
                    	<span> Name: <?php echo $vv->firstName.' '.$vv->lastName;?></p>
                           <p class="male_usr">Email: <?php echo $vv->emailID;?></p>
                           </span> 
                           
                    </label>
                     
                  <?php endforeach;?>
                  <?php else:?>
                  No Afro User is available..
                  <?php endif;?>
                  
                        <p class="butt_ons">   
                        <input type="reset" name="assign" value="Reset" id="resetId" /> 
                        <input type="button" name="assign" value="Cancel" onclick="window.location='<?php echo base_url();?>cp/mmsHvolunteer/<?php echo $page;?>'"  />
                        <input type="submit" name="assign" value="Assign"  />
                        </p>  
                </form>
          
        </div>
      
  <style>
 .user_images{}
.butt_ons > input {
    display: inline-block;
    margin-right: 5px;
}
 .butt_ons {
    clear: both;
    padding: 4px 0 5px 6px;
    text-align: left;
}
.butt_ons input[type="submit"]{background: #0E66A1 none repeat scroll 0 0;
    border: 0 none;
    color: #fff;
    font-size: 16px;
    line-height: 20px;
    padding: 4px 10px;
    text-align: center;
	font-family: open sans;
    vertical-align: middle;}
.butt_ons input[type="button"]{background: #454545 none repeat scroll 0 0;
    border: 0 none;
    color: #fff;
    font-size: 16px;
    line-height: 20px;
    padding: 4px 10px;
    text-align: center;
	font-family: open sans;
    vertical-align: middle;}
.butt_ons input[type="reset"]{background: #da3c3c none repeat scroll 0 0;
    border: 0 none;
    color: #fff;
    font-size: 16px;
    line-height: 20px;
    padding: 4px 10px;
    text-align: center;
    vertical-align: middle;
	margin-right:0;
}
.main_section form{overflow:hidden;}
.c_box {
    background-color: #f2f2f2;
    display: inline-block;
    float: left;
    margin: 5px;
    overflow: hidden;
    padding: 8px;
    vertical-align: top;
    width: 24%;
}
.c_box input[type="checkbox"] {
    display: inline-block;
    margin: 5px 10px 0 0;
    vertical-align: top;
    width: 14px;
}
.name_sec > span {
    display: inline-block;
    padding: 0;
}
.c_box > span {
    display: inline-block;
    float: right;
    margin-top: -5px;
    text-align: left;
    vertical-align: top;
    width: 94%;
}




  </style>    
      
      
       
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  