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
            <h2>View Ads List</h2>
            <h3 align="right">
			     <a href="<?php echo base_url();?>cp/viewBanner">Manage Ad Banner</a> &nbsp;&nbsp; 
			     <a href="<?php echo base_url();?>cp/adContent">Ad Youtube</a> &nbsp;&nbsp;
                 <a href="<?php echo base_url();?>cp/addAds">Add</a>
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
			 <form id="searchad" name="searchad" method="post" action="<?php echo base_url(); ?>cp/viewAdsList" class="main_form">
				<td colspan="5"><input type="text" id="search" name="search" class="input1" placeholder="Search" required />
				<input type="submit" name="go" id="gp" value="Go" class="submit-bnt" />
				</td>
			</form>	
			</tr>
       	    <tr>
       	      <th width="7%" align="left" scope="col">#</th>
       	      <th width="20%" align="left" scope="col">Title</th>
       	      <th width="13%" align="left" scope="col">Url & Description</th>
              <th width="40%" align="left" scope="col">Category</th>
              <th width="20%" align="left" scope="col">Action</th>
   	        </tr>
            <?php 
			
			if(count($list) > 1){
				  foreach($list as $key=>$valList){	
				  	$className = "table-gray";
					if ($key % 2 == 0) {
                  		$className = "";
					}
			?>
            <tr>
                <td class="<?php echo $className;?>"><?php echo $key+1;?></td>
                <td class="<?php echo $className;?>"><?php echo $valList->title;?></td>
                <td class="<?php echo $className;?>"><b>URL:</b> <?php echo $valList->url;?><br/><b>Description:</b> <?php echo $valList->description;?></td>
                <td class="<?php echo $className;?>"><?php //echo $valList->categoryId; 
                echo $valList->categoryName->title; 
               
//print_r($valList->$categoryName);
                ?></td>
                <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>cp/editAds/<?php echo $valList->id;?>">Edit </a>|<a href="<?php echo base_url();?>cp/deleteAds/<?php echo $valList->id;?>" onclick=" return confirm('Are you sure to delete this data?');">Delete </a></td>
              
            </tr>
            <?php } 
			}
			else if(count($list)==1)
			{
			?>
				<tr>
                <td class="<?php echo $className;?>"><?php echo '1';?></td>
                <td class="<?php echo $className;?>"><?php echo $list[0]->title;?></td>
                <td class="<?php echo $className;?>"><b>URL:</b> <?php echo $list[0]->url;?><br/><b>Description:</b> <?php echo $list[0]->description;?></td>
                <td class="<?php echo $className;?>"><?php //echo $list->categoryId; 
                echo $list[0]->categoryName->title; 
               
//print_r($list->$categoryName);
                ?></td>
                <td class="<?php echo $className;?>"><a href="<?php echo base_url();?>cp/editAds/<?php echo $list[0]->id;?>">Edit </a>|<a href="<?php echo base_url();?>cp/deleteAds/<?php echo $list[0]->id;?>" onclick=" return confirm('Are you sure to delete this data?');">Delete </a></td>
              
            </tr>
			<?php
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