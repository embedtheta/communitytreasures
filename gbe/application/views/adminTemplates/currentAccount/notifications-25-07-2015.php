  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
  
<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Current Account System - Notification</h2>
            
            <h3 align="right">
<!--                 <a href="<?php echo base_url();?>admin/addProduct">Add</a>-->
            </h3>
        </div>
        <div class="admin-notification">
        <div class="notification-tab">
        <h3><a href="#">Read More 
        <img src="<?php echo base_url();?>/images/down-arrow.png" alt="" /></a></h3>
       <h2> Title Notification 1</h2>
      <p> <span>Notification:</span> Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
<td align="left" valign="top"><span>Date:</span> 15-07-2015									</td>
    <td align="left" valign="top"><span>Name:</span> Mr. J. K. Smith</td>
    <td align="left" valign="top"><span>Level:</span> IV</td>
    <td align="left" valign="top"><span>Reply</span></td>
  </tr>
</table>

        </div>
        <div class="notification-tab white">
        <h3><a href="#">Read More 
        <img src="<?php echo base_url();?>/images/down-arrow.png" alt="" /></a></h3>
       <h2> Title Notification 1</h2>
      <p> <span>Notification:</span> Lorem Ipsum is simply dummy text of the printing and typesetting industry...</p>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
<td align="left" valign="top"><span>Date:</span> 15-07-2015									</td>
    <td align="left" valign="top"><span>Name:</span> Mr. J. K. Smith</td>
    <td align="left" valign="top"><span>Level:</span> IV</td>
    <td align="left" valign="top"><span>Reply</span></td>
  </tr>
</table>

        </div>
        <div class="notification-tab">
        <h3><a href="#">Read More 
        <img src="<?php echo base_url();?>/images/down-arrow.png" alt="" /></a></h3>
       <h2> Title Notification 1</h2>
      <p> <span>Notification:</span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.</p>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
<td align="left" valign="top"><span>Date:</span> 15-07-2015									</td>
    <td align="left" valign="top"><span>Name:</span> Mr. J. K. Smith</td>
    <td align="left" valign="top"><span>Level:</span> IV</td>
    <td align="left" valign="top"><span>Reply</span></td>
  </tr>
</table>

        </div>
        <div class="general-msgsec">
        <h2>Send General Message</h2>
        <form action="" method="post">
        <p><label>Select</label>
        <select name="">
        <option>Select</option>
        </select>
        <br class="clear" />
        <label>Level</label>
         <select name="">
        <option>Select</option>
        </select>
        </p>
       <p> <label>Message</label>
        <textarea name="" cols="" rows=""></textarea></p>
        <input name="" type="submit" value="Send Message" />
        </form>
        <br class="clear" />
        </div>
        </div>
      
      <!--Success-->
        <?php if($type != ''){ ?>
        <div class="admin-msg <?php echo $type;?>-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if($type == 'error'){ ?>
        <!--<div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>-->
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
       	  
        </div>
       
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  