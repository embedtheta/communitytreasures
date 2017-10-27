
<!--<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>adminCss/admin.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700' rel='stylesheet' type='text/css'>
<script src="<?php echo base_url();?>adminJS/modernizr.custom.js"></script>
<script src="<?php echo base_url();?>adminJS/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>adminJS/classie.js"></script>
<script src="<?php echo base_url();?>adminJS/gnmenu.js"></script>
<script src="<?php echo base_url();?>adminJS/main.js"></script>

<script type="text/javascript">

function delRequest(entityID){
	 //alert(entityID);
	/* return false;*/
	 
	 var r=confirm("do you really want to delete this entry:");
     if (r==true){
     	window.location.href = '<?php echo base_url();?>index.php/homelogin/deleteEntity/'+entityID;
     }else{
       	x="You pressed Cancel!";
     } 
	
}

</script>

<style type="text/css">
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>adminJS/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>adminJS/jquery.validate.min.js"></script> 
  
<script>

$(function() {
   $( "#addMembership" ).validate({
           rules: {
                   advertTitle: {
                           required: true,
                           customvalidation: true
                   },
				  image: {
                           required: true,
                           accept: "jpg,gif,png"
                   },
				   
				   
           },
           messages: {
                   advertTitle: {
                           required: "* Please enter advert Title",
                           
                   },
				   image: {
                           required: "* Image field is required",
                           
                   },
				   
           },
   });
   $.validator.addMethod("customvalidation",
           function(value, element) {
                   return /^([-a-z_ ])+$/i.test(value);
           },
   "* Sorry, Only characters allowed"
   );
  
});
</script>
</head>
<body>
<div class="container">
  <ul id="i2i-menu" class="i2i-menu-main">
    <li class="i2i-trigger"> <a class="i2i-icon i2i-icon-menu"><i class="fa fa-bars"></i> <span>Menu</span></a>
      <nav class="i2i-menu-wrapper i2i-open-part">
        <div class="i2i-scroller">
          <ul class="i2i-menu">
           <li><a class="i2i-icon" ><i class="fa fa-dashboard"></i> Dashboard</a></li>
           <li><a class="i2i-icon" href="<?php echo base_url();?>admin/user_youtube"><i class="fa fa-video-camera"></i> User youtube</a> 
           <li><a class="i2i-icon" href="<?php echo base_url();?>admin/user_advert"><i class="fa fa-picture-o"></i> User advert</a></li>
           <li><a class="i2i-icon" href="<?php echo base_url();?>admin/user_banner"><i class="fa fa-picture-o"></i> User banner</a></li> 
          </ul>
        </div>
       </nav>
    </li>
    <li class="i2i-logo"><img src="<?php echo base_url();?>images/admin-logo-inner.png" alt=""></li>
    <li class="i2i-logout"><a href="<?php echo base_url();?>admin/logout"><i class="fa fa-power-off"></i> <span>Log out</span></a></li>
    <li class="i2i-settings top-menu-trigger"><i class="fa fa-gear"></i>
    	<div class="top-menu">
        	<ul>
            	<li><a href="#"><i class="fa fa-key"></i> Change Password</a></li>
                <li><a href="#"><i class="fa fa-user"></i> Account setting</a></li>
            </ul>
        </div>
    </li>
    <li class="i2i-welcome">Welcome <span><?php echo trim($this->session->userdata('userName')); ?></span></li>
  </ul>-->
   <?php $this->load->view('adminTemplates/common/header',$viewData);?>
  <div class="content-wrapper">
  <div class="content-inner">
    	<div class="page-title">
            <h2>Add </h2>
        </div>
        <div>
        <form id="addMembership" name="addMembership" method="post" action="" enctype="multipart/form-data">
        <table width="500" height="200" border="1" align="center">
     <tr>
     <td>Advert Title</td>
      <td>
      <textarea name="advertTitle" id="advertTitle"> <?php echo set_value('advertTitle'); ?> </textarea>
       <span id="err_advertTitle"></span><?php echo form_error('advertTitle', '<br /><span style="color:#F00; font-weight:bold;">', '</span>'); ?>
     </td>
    </tr>
    <tr>
     <td>Status</td>
      <td>
        <input type="radio" name="status" id="status" checked="checked" value="1"/>Active
        <input type="radio" name="status" id="status" value="0"/>Inactive
      </td>
    </tr>
    <tr>
    <td>Image</td>
    <td><input type="file" name="image" id="image" />
      <?php if(isset($err_msg)){ echo "<span style=\"color:#F00; font-weight:bold;\">".$err_msg."</span>";}?>
    <?php if(isset($image_error)){ echo "<span style=\"color:#F00; font-weight:bold;\">".$image_error."</span>";}?>
    </td>
    </tr>
    <tr>
    <td colspan="2">
      <input type="submit" name="submit" id="submit" value="save" />&nbsp;<input type="reset" name="reset" id="reset" value="reset" />&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/homelogin/user_advert">cancel</a>
      
      </td>
    </tr>
  </table>
  </form>
        
   </div>
  </div>
  <!--Main Content--> 
  <?php $this->load->view('adminTemplates/common/footer',$viewData);?>
 
  <!--<footer> Copyright &copy; i2i | All rights reserved </footer>
</div>
<script>
	new gnMenu(document.getElementById('i2i-menu'));
</script>
</body>
</html>  -->   