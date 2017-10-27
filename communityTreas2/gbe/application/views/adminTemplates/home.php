
  <?php $this->load->view('adminTemplates/common/header',$viewData);?>
  <!--Main Content-->
  <div class="content-wrapper">
  	
    <div class="content-inner">
    	<div class="page-title">
            <h2>Admin Dashboard</h2>  <h3 align="right"></h3>
        </div>
       
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
        <div class="admin-msg warning-msg" id="warningMsg">
            <i class="fa fa-warning"></i>  
                <span>This is Warning Message.</span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <!--Warning-->
        
         
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <th scope="col">Coming soon.....</th>
            </tr>
            </table>
         
    </div>
  </div>
  <!--Main Content--> 
  
 <?php $this->load->view('adminTemplates/common/footer',$viewData);?>  
 