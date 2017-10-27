<?php $this->load->view('adminTemplates/common/header', $viewData); ?>
$("#form").trigger('reset');
<link rel="stylesheet" type="text/css" href="<?php echo  base_url()?>js/jquery.imgareaselect/css/imgareaselect-default.css" />
<link rel="stylesheet" type="text/css" href="<?php echo  base_url()?>js/jquery.imgareaselect/css/imgareaselect-animated.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/jquery.imgareaselect/css/imgareaselect-deprecated.css" />
<script src='<?php echo base_url()?>js/jquery.imgareaselect/scripts/jquery.min.js'></script>
<script src='<?php echo base_url()?>js/jquery.imgareaselect/scripts/jquery.imgareaselect.pack.js'></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#reset").click(function(){
		$("#editdiscountlinkform").trigger('reset');
	});
	
	
});
function validateForm(){
        var fastname 	= 	$("#fastname").val();
		var email 		= 	$("#email").val();
        var website 	= 	$("#website").val();
        var price 		= 	$("#price").val();
		var atpos		=	email.indexOf("@");
		var atlastpos	=	email.lastIndexOf("@");
		var dotpos		=	email.indexOf(".");
		var dotlastpos	=	email.lastIndexOf("."); 
		var acc_type 	= 	$("#acc_type").val();
		
        if(fastname == ""){
            alert("Please enter the First Name.");
            $("#title").focus();
            return false;
        } 
		if(email == ""){
            alert("Please enter the email.");
            $("#email").focus();
            return false;
        } 	
		if(atpos==0 || dotpos==0 || atlastpos==email.length-1 || dotlastpos==email.length-1 || atpos+1==dotpos || atpos-1==dotpos || atpos==-1 || dotpos==-1 || e=="" || dotlastpos==-1 || atlastpos==-1 || atpos!=atlastpos || dotpos!=dotlastpos)
		{
			alert("Please enter valid email.");
				
			$("#email").focus(); 
				
		 return false;
			
		}
        if(website == ""){
            alert("Please enter the website.");
            $("#website").focus();
            return false;
        }        
        if(price == ""){
            alert("Please enter the price.");
            $("#price").focus();
            return false;
        }		
		if(acc_type == ""){
            alert("Please enter the account type.");
            $("#acc_type").focus();
            return false;
        }
        
        return true;        
    }
</script>
<!--Main Content-->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-title">
            <h2><?php echo $action;?> Discount Link Genarate Form</h2>

        </div>
        
       
        
        <!--Error-->
        <?php if($report == 2){ ?>
        <div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $msg;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Error-->

        <div class="main_section" style="width: 700px;">
            <form id="editdiscountlinkform" name="editMenuZone" method="post" action="<?php echo base_url()?>cp/createDiscountLink" class="main_form" enctype="multipart/form-data">
                <input type="hidden" name="ad_id" value="<?php echo $id;?>">
                <table width="600" height="200" border="1" align="center" class="form-table">
                    <tr>
                        <td>First Name</td>
                        <td>
                        <input type="text" id="fastname" name="fastname" class="input1" value="<?php if($firstname!=""){?><?php echo $firstname;?><?php }?>" /></td>
                    </tr>
					
                    <tr>
                        <td>Last Name</td>
                        <td>
                        <input type="text" id="lastname" name="lastname" class="input1" value="<?php if($lastname!=""){?><?php echo $lastname;?><?php }?>" /></td>
                    </tr>
					
                    <tr>
                        <td>Email</td>
                        <td>
                        <input type="text" id="email" name="email" class="input1" value="<?php if($email!=""){?><?php echo $email;?><?php }?>" /></td>
                    </tr>
					
                    <tr>
                        <td>Website</td>
                        <td>
                        <input type="text" id="website" name="website" class="input1" value="<?php if($website!=""){?><?php echo $website;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Price</td>
                        <td>
                        <input type="text" id="price" name="price" class="input1" value="<?php if($price!=""){?><?php echo $price;?><?php }?>" /></td>
                    </tr>
					
					<tr>
                        <td>Discount Price</td>
                        <td><input type="text" id="Dis_price" name="Dis_price" class="input1" value="<?php if($discount_price!=""){?><?php echo $discount_price;?><?php }?>" /></td>
                    </tr>
					<input type="hidden" id="link_id" name="link_id" value="<?php if($link_id!=""){ echo $link_id; }?>"/></td>
                    
					<tr>
                        <td>Account Type</td>
                        <td>
                        <select id="acc_type" name="acc_type" class="input1">
                        <option value="" >Select Account Type</option>                        
                        <option value="AP" <?php if(isset($acc_type) && $acc_type == "AP"){ ?> selected <?php } ?> >AP</option>
						<option value="BB" <?php if(isset($acc_type) && $acc_type == "BB"){ ?> selected <?php } ?> >BB</option>
                        
                        </select>
                        </td>
                    </tr>
					
                    
                    <tr>
                        <td colspan="2">
                            <input style="padding:10px 10px 25px 10px" type="submit" onclick=" return validateForm();" name="submit" id="submit" value="Generate Link" class="submit-bnt" />&nbsp;&nbsp;<a href="javascript:void(0)" id="reset">cancel</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  
