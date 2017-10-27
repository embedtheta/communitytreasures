<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<script type="application/javascript">
function getArticle(){
	var str  = "";
	var temp = 0;
	$("#menuName option:selected").each(function (){
		tempStr = $(this).val(); 
		var res = tempStr.split("_");
		//alert(temp);
		if( temp == "0" ){
		    str     = res[0];
		}else{
			str    +="_"+res[0];
		}
		temp++;
    });
	$.ajax({
         type: "POST",
         url:  "<?php echo base_url();?>admin/getArticlesListNew", 
         data: "tableName="+str,
         cache:false,
         success: 
              function(data){
                //alert(data);  //as a debugging message.3
				$("#articleShow").html("");
				$("#articleShow").html(data);
              }
          });// you have missed this bracket
}
</script>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2>Map Your Product with Article </h2>
            <!--<h3 align="right">
                 <a href="<?php echo base_url();?>admin/addCreative">Add</a>
            </h3>-->
        </div>
        
        <!--Success-->
        <?php if(isset($submissionReport)){ ?>
        <div class="admin-msg success-msg">
            <i class="fa fa-check"></i> 
                <span><?php echo $submissionReport;?></span>
            <a href="#" class="msg-close" title="Close"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php } ?>
        <!--Success-->
        
        <!--Error-->
        <?php if(isset($errorReport)){ ?>
        <div class="admin-msg error-msg">
            <i class="fa fa-times"></i> 
                <span><?php echo $errorReport;?></span>
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
         <form id="mapProductArticles" name="mapProductArticles" method="post" action="<?php echo base_url();?>admin/mapProductArticlesNew" enctype="multipart/form-data" class="main_form">
       	  <table width="100%">
          	<tr>
            	<td>Select Menus</td>
                <td><select multiple style="width: 200px;" name="menuName[]" id="menuName">
                     <?php  foreach( $menuList as $key=>$val){?> 
  						<option value="<?php echo $val["menuID"]."_".$val["menuName"];?>"><?php echo $val["menuName"];?></option>
  					  <?php } ?>	
                    </select> 
                </td>
            </tr>
            <tr>
            	<td colspan="2"><input type="button" name="submit" id="submit" value="Get Articles" onclick="getArticle()"/> </td>
            </tr>
            <tr>
            	<td>List Of Article</td>
                <td> 
                		<table width="500" id="articleShow">
                        	<tr>
                            	<td><input type="checkbox" name="selectAll" id="selectAll" /></td>
                                <td>Article Name</td>
                            </tr>
                            <tr>
                            	<td><input type="checkbox" name="selectElement[]" /></td>
                                <td>Business Consultent</td>
                            </tr>
                            
                		</table>
                </td>
            </tr>
            <tr>
            	<td>List of Product</td>
                <td><table width="500">
                        	<tr>
                            	<td><input type="checkbox" name="selectAll" id="selectAll" /></td>
                                <td><strong>Product Name</strong></td>
                            </tr>
                            <?php foreach( $productType as $type){ ?>
                            	<tr>
                            	    <td><input type="checkbox" name="productList[]" value="<?php echo $type["productTypeID"];?>" /></td>
                                    <td><?php echo $type["productTypeName"];?></td>
                                </tr>	
                            <?php }  ?>
                           <!-- <tr>
                            	    <td><input type="checkbox" name="selectElement[]" /></td>
                                    <td>Ticket1</td>
                                </tr>
                            <tr>
                            	<td><input type="checkbox" name="selectElement[]" /></td>
                                <td>Ticket2</td>
                            </tr>
                            <tr>
                            	<td><input type="checkbox" name="selectElement[]" /></td>
                                <td>music1</td>
                            </tr>
                            <tr>
                            	<td><input type="checkbox" name="selectElement[]" /></td>
                                <td>music2</td>
                            </tr>-->
                		</table></td>
            </tr>
            <tr>
            	<td colspan="2"><input type="submit" name="submit" id="submit" value="Mapp"/> </td>
            </tr>
           </table>
           </form>
        </div>
        <!--<div class="login-section">
             <form action="" method="post" id="frnd" class="main-form">
                 <input name="" type="text" placeholder="Email" class="input1">
                 <input name="" type="email" placeholder="Password" class="input2">
                 <input name="" type="submit" value="Login" class="login-submit">
             </form>
        </div>-->
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  