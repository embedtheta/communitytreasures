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

<SCRIPT language="javascript">
$(function(){
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
        var checkAll = $("#selectall").prop('checked');
        if (checkAll) {
            $(".msg").prop("checked", true);
        } else {
            $(".msg").prop("checked", false);
        }
    });
   
    // if all checkbox are selected, check the selectall checkbox and vice versa
    $(".msg").click(function(){
        if($(".msg").length == $(".msg:checked").length) {
            $("#selectall").prop("checked", true);
        } else {
            $("#selectall").prop("checked", false);
        }
    });
});
</SCRIPT>

<script type="text/javascript">

function delElement(entityID){
	var confirmationDelete	= confirm("do you really want to delete this entry");
	if( confirmationDelete == true ){
		//alert('<?php echo base_url();?>index.php/homelogin/deleteEntity/'+entityID);
		window.location.href = '<?php echo base_url();?>admin/deleteEntitybanner/'+entityID;
		
	}else{
		
		 var x="You pressed Cancel!";
	}
}
</script>
<script type="text/javascript">
$(function() {
	$("#warningMsg").hide();
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
           <li><a class="i2i-icon" href="<?php echo base_url();?>admin/user_advert"><i class="fa fa-picture-o"></i> User advert</a>
           </li>
          <li><a class="i2i-icon" href="<?php echo base_url();?>admin/user_banner"><i class="fa fa-picture-o"></i> User banner</a> </li>
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
  <!--Main Content-->
  <div class="content-wrapper">
  	 <?php if(!empty($results) ) {
          
          ?>
    
   
        <div class="content-inner">
    	<div class="page-title">
            <h2>UserBanner</h2>  <h3 align="right"><a href="<?php echo base_url();?>admin/Adduserbanner">Add</a></h3>
        </div>
        
         <?php } ?>
        <!--Success-->
        <?php if(isset($status) && ( $status == "delete")) {?>
        <div class="admin-msg success-msg" id="successMsg">
            <i class="fa fa-check"></i> 
                <span>Successfully Deleted.</span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if(isset($status) && ( $status == "Invalid")) {?>
        <div class="admin-msg error-msg" id="errorMsg">
            <i class="fa fa-times"></i> 
                <span>Invalid Format or Id</span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Error-->
        
        <!--Warning-->
     <!--   <div class="admin-msg warning-msg" id="warningMsg">
            <i class="fa fa-warning"></i>  
                <span>This is Warning Message.</span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>-->
        <!--Error-->
        <!--<?php //if(isset($_REQUEST['msg'])==1){ echo "<span style=\"color:#F00; font-weight:bold;\">Invalid Id</span>"; }?>-->
         <?php 
          
         
        // if(!empty($results) && isset($flag) && ( $flag == "viewDashboard")) { 
		   if(!empty($results)) { 
		?>
          <div class="table-content" id="dashreload">
       	  <form name="checkSubmit" id="checkSubmit" action="<?php echo base_url();?>index.php/homelogin/remove_checkedbanner" method="post" >
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
       	    <tr>
            <th scope="col"><input type="checkbox" id="selectall"/></th>
       	      <th scope="col">Banner id</th>
              <th scope="col">Image</th>
       	      <th scope="col">Status</th>
              <th scope="col">Action</th>
   	        </tr>
            
            <?php 
			
			foreach($results as $view) {   ?>
            
            <tr>
            <th scope="col"><input type="checkbox" class="msg" name="msg[]" value="<?php echo $view->bannerID; ?>"/></th>
            <th scope="col"><?php echo $view->bannerID; ?></th>
            <th scope="col"><img src="<?php echo base_url(); ?>adminuploads/banner/<?php echo $view->bannerImg ; ?>" alt="" height="70" width="60"/></th>
            <th scope="col"><?php if($view->status == 1){ echo "active"; }elseif($view->status == 0){ echo "deactive";  }?></th>
            <th scope="col"><a href="<?php echo base_url();?>admin/bannerMembership/<?php echo $view->bannerID ;?>">Edit</a>||<a href="javascript:void(0)" onClick="delElement('<?php echo $view->bannerID ;?>')">Delete</a></th>
       	     
   	        </tr>
           
            
            <?php 
			
			 }
			
			 ?>
			</table>
            <br />
             <input type="submit" name="delete" value="delete all"/>
             <br />
             <br />
             <p><?php echo "pages..".$links; ?></p>
           </form>
        </div>
         <?php  }else{ ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <th scope="col">No Records Found</th>
            </tr>
            </table>
         <?php }?>
        
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
</html>-->