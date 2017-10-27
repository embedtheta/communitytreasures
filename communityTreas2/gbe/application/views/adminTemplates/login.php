<!doctype html>
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
<style type="text/css">
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>adminJS/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>adminJS/jquery.validate.min.js"></script> 
  
<script>
$(function() {
   $( "#login" ).validate({
           rules: {
                   userName: {
                           required: true,
                           
                   },
				   password: {
                           required: true,
                           
                   },
				   
				   
           },
           messages: {
                   userName: {
                           required: "* Please enter user Name",
                           
                   },
				   password: {
                           required: "* Please enter password",
                           
                   },
				   
           },
   });
   
});
</script>

</head>
<body>
<div class="container">
  <div class="i2i-menu-main">
    <div class="logo-cont">
      <div class="admin-logo">
        <h1><img src="<?php echo base_url();?>images/admin-logo.png" alt=""></h1>
      </div>
    </div>
  </div>
  <section class="main">
    <div class="login-form clearfix">
      <form class="clearfix" id="login" name="login" method="post" action="" >
      	<?php if(isset($error) && ($error == "Wrong")) { ?><span class="admin-msg login-error"><i class="fa fa-times"></i> Wrong username and password <a href="javascript:void()" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a></span><?php } ?>
        <p class="slct"><strong>Please Select Website</strong>
		<select name="forWebsite" id="forWebsite">
		
		  <option value="1">GBE</option>
		  <option value="2">Community Treasure</option>
		  <option value="3">Rave Business</option>
		  </select>
		  </p><p>
          <input type="text" id="userName" name="userName" value="<?php echo set_value('userName'); ?>" autocomplete="off" placeholder="Username">
          
          <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" autocomplete="off" placeholder="Password">
          </p>
        <!--<button type="submit" name="submit"> <i class="fa fa-arrow-right"></i> <span>Sign in</span> </button>-->
        <input type="submit" name="submit" value="Sign in">
      </form>
      <div class="forgot-pass clearfix">
        <div class="remember">
          <input type="checkbox" name="checkbox" id="checkbox">
          <label for="checkbox">Remember Me</label>
        </div>
        <a href="#" class="forgot">Forgot password?</a>
        </ul>
      </div>
    </div>
  </section>
</div>
</body>
</html>