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
			serviceUrl: '<?php echo base_url(); ?>cp/adName',
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
            <h2>View Payment Link</h2>
            <h3 align="right">			     			     
                 <a href="<?php echo base_url();?>cp/createDiscountLink">Create Link</a>
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
        
        <div class="table-content">
       	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		   <tr>
			 <!--<form id="searchad" name="searchad" method="post" action="<?php echo base_url(); ?>cp/viewAdsList" class="main_form">
				<td colspan="6"><input type="text" id="search" name="search" class="input1" placeholder="Search" required />
				<input type="submit" name="go" id="gp" value="Go" class="submit-bnt" />
				</td>
			</form>	-->
			</tr>
       	    <tr>
       	      <th width="7%" align="left" scope="col">#</th>
       	      <th width="20%" align="left" scope="col">First Name</th>
       	      <th width="13%" align="left" scope="col">Last Name</th>
			  <th width="13%" align="left" scope="col">Account Type</th>
              <th width="40%" align="left" scope="col">List Of Links</th>
              <th width="20%" align="left" scope="col">Action</th>
   	        </tr>
            <?php 
			
			if(count($list) >= 1){
				  foreach($list as $key=>$valList){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
                <td class="<?php echo $className;?>"><?php echo $key+1;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->firstname;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->lastname;?></td>
				<td class="<?php echo $className;?>"><?php echo $valList->account_type;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->paymentlink;?></td>
                <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>cp/editDiscountLink/<?php echo $valList->link_id;?>">Edit </a></td>
              
            </tr>
            <?php } 
			}
				
			else{
			?>
		    <tr>
       	      <th width="22%" align="left" scope="col" colspan="5" class="table-gray">No Data!</th>
       	      
   	        </tr>
            <?php }?>
   	      </table>
          <p><?php if(count($list) > 1) { echo $links; } ?></p>
        </div>
        
  	</div>
  </div>
  <!--Main Content-->
<?php $this->load->view('adminTemplates/common/footer',$viewData);?>  