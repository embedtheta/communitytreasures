<?php $this->load->view('adminTemplates/common/header',$viewData);?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.autocomplete.js"></script> 
<script>
$(document).ready(function(){
	
	$('#go').click(function(e){
		if($.trim($('#search').val())==""){
			e.preventDefault();
			jAlert('Please enter valid search keyword.', 'Keyword search!');
		}else if(/^[a-zA-Z0-9-\)\(,.:& ]*$/.test($.trim($('#s').val())) == false) {
			e.preventDefault();
    		jAlert('Please enter valid search keyword.', 'Keyword search!');
		}else{
			return true;
		}
	});
	
	$('#search').autocomplete({
			serviceUrl: '<?php echo base_url(); ?>cp/artName',
			onSelect: function (suggestion) {
				if(/^[a-zA-Z0-9-\)\(,.:& ]*$/.test($.trim(suggestion.value)) == false) {
					jAlert('Please enter valid search keyword.', 'Keyword search!');
				}
				//alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
			}
		});
});		
</script>
<style>
.autocomplete-suggestions {
    background: #fff;
    padding-left: 5px;
    max-height: 300px;
    overflow-y: scroll;
}

</style>
<!--Main Content-->
  <div class="content-wrapper">
  	<div class="content-inner">
    	<div class="page-title">
            <h2><?php echo $categoryName;?> View</h2>
            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/addArticle/<?php echo $selectedMenuId; ?>">Add</a>
            </h3>
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
       	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			 <form id="searchad" name="searchad" method="post" action="<?php echo base_url(); ?>admin/viewArticles/<?php echo $selectedMenuId?>" class="main_form">
				<td colspan="5"><input type="text" id="search" name="search" class="input1" placeholder="Search" required />
				<input type="submit" name="go" id="gp" value="Go" class="submit-bnt" />
				</td>
			</form>	
			</tr>
       	    <tr>
       	      <th width="22%" align="left" scope="col">Title</th>
       	      <th width="22%" align="left" scope="col">Picture</th>
       	      <th width="46%" align="left" scope="col">Description</th>
       	      <th width="10%" align="left" scope="col">Action</th>
   	        </tr>
            <?php 
			
				if(count($infoArticle) > 1){
				  foreach($infoArticle as $key=>$valArticle){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
       	      <td class="<?php echo $className;?>"><?php echo $infoArticle[$key]["title"];?></td>
       	      <td class="<?php echo $className;?>"><img src="<?php echo base_url();?>/adminuploads/productPagesImg/<?php echo $infoArticle[$key]["image"];?>" width="107" height="107"/></td>
       	      <td class="<?php echo $className;?>"><?php echo $infoArticle[$key]["description"];?></td>
       	      <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/editArticle/<?php echo $infoArticle[$key]["id"];?>">Edit </a> | <a href="<?php echo base_url();?>admin/deleteArticle/<?php echo $infoArticle[$key]["id"];?>/<?php echo $infoArticle[$key]["menu_id"];?>">Delete</a></td>
   	        </tr>
				<?php }
				}
				else if(count($infoArticle) == 1){
				?>	
					<tr>
       	      <td class="<?php echo $className;?>"><?php echo $infoArticle[0]["title"];?></td>
       	      <td class="<?php echo $className;?>"><img src="<?php echo base_url();?>/adminuploads/productPagesImg/<?php echo $infoArticle[0]["image"];?>" width="107" height="107"/></td>
       	      <td class="<?php echo $className;?>"><?php echo $infoArticle[0]["description"];?></td>
       	      <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>admin/editArticle/<?php echo $infoArticle[0]["id"];?>">Edit </a> | <a href="<?php echo base_url();?>admin/deleteArticle/<?php echo $infoArticle[0]["id"];?>/<?php echo $infoArticle[0]["menu_id"];?>">Delete</a></td>
   	        </tr>
			<?php
				}	
				else
				{
				?>
				<tr>
					<th width="22%" align="left" scope="col" colspan="5" class="table-gray">No Data!</th>
       	      
				</tr>
            <?php }?>
			
   	      </table>
        </div>
        <!--<div class="login-section">
             <form action="" method="post" id="frnd" class="main-form">
                 <input name="" type="text" placeholder="Email" class="input1">
                 <input name="" type="email" placeholder="Password" class="input2">
                 <input name="" type="submit" value="Login" class="login-submit">
             </form>
        </div>-->
		<?php echo $pagination;?> 
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  