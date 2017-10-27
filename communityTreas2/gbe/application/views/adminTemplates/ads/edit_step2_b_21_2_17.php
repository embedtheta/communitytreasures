<?php $this->load->view('adminTemplates/common/header', $viewData); ?>
<link rel="stylesheet" type="text/css" href="<?php echo  base_url()?>js/jquery.imgareaselect/css/imgareaselect-default.css" />
<link rel="stylesheet" type="text/css" href="<?php echo  base_url()?>js/jquery.imgareaselect/css/imgareaselect-animated.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>js/jquery.imgareaselect/css/imgareaselect-deprecated.css" />
<script src='<?php echo base_url()?>js/jquery.imgareaselect/scripts/jquery.min.js'></script>
<script src='<?php echo base_url()?>js/jquery.imgareaselect/scripts/jquery.imgareaselect.pack.js'></script>
<script type="text/javascript">
    $(document).ready(function(){
    $('#ad_crop').imgAreaSelect({
			aspectRatio: '1:1',
			handles: true,
			maxHeight: 158,
			maxWidth: 165,
        
    onSelectEnd: function (img, selection) {
        if (!selection.width || !selection.height) {
            return;
        }
		
			$('#x_axis').val(selection.x1);
            $('#y_axis').val(selection.y1);
            $('#x_axis2').val(selection.x2);
            $('#y_axis2').val(selection.y2);
            $('#ad_width').val(selection.width);
            $('#ad_height').val(selection.height);
        }
    });
});

    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#ad_crop')
                        .attr('src', e.target.result)
                        /*.width(200)
                        .height(200);*/
                };

                reader.readAsDataURL(input.files[0]);
            }
			
        }
    function validateForm(){
        var title = $("#title").val();
        var url = $("#url").val();
        var description = $("#description").val();
        if(title == ""){
            alert("Please enter the Title value.");
            $("#title").focus();
            return false;
        }
               
        if(url == ""){
            alert("Please enter the Url value.");
            $("#url").focus();
            return false;
        }
        
        if(description == ""){
            alert("Please enter the Description value.");
            $("#description").focus();
            return false;
        }
        
        return true;        
    }
</script>
<!--Main Content-->
<div class="content-wrapper">
    <div class="content-inner">
        <div class="page-title">
            <h2><?php echo $action;?> Ads</h2>
<!--            <h3 align="right">
                 <a href="<?php echo base_url();?>admin/getXls">Get Report</a>
            </h3>-->
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
            <form id="editMenuZone" name="editMenuZone" method="post" action="" class="main_form" enctype="multipart/form-data">
                <input type="hidden" name="ad_id" value="<?php echo $id;?>">
                <table width="600" height="200" border="1" align="center" class="form-table">
                    <tr>
                        <td>Title</td>
                        <td>
                        <input type="text" id="title" name="title" class="input1" value="<?php if($title!=""){?><?php echo $title;?><?php }?>" /></td>
                    </tr>
                     <tr>
                        <td>Category </td>
                        <td>
                        <select name="categoryId" class="input1">
                        <option value="" <?php if($categoryId==''){ echo 'selected="selected"'; } ?>>Select Category</option>
                        <?php 
                        foreach ($categoryList as $key => $valList) {
                        # code...
                        ?>
                        <option value="<?php echo $valList->id; ?>" <?php if($categoryId==$valList->id){?><?php echo 'selected="selected"'; ?><?php }?>><?php echo $valList->title; ?></option>

                        <?php
                        }
                        ?>
                        </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Url</td>
                        <td><input type="text" id="url" name="url" class="input1" value="<?php if($url!=""){?><?php echo $url;?><?php }?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Description</td>
						
                        <td><textarea style="width: 300px;height: 150px;" class="input2" id="description" name="description"><?php if($description!=""){?><?php echo $description;?><?php }?></textarea></td>
                    </tr>
					
					<tr>
                        <td>Twitter Url</td>
                        <td><input type="text" id="twitter_url" name="twitter_url" class="input1" value="<?php if($twitter_url!=""){?><?php echo $twitter_url;?><?php }?>" /></td>
                    </tr>
					<tr>
                        <td>Facebook URL</td>
                        <td><input type="text" id="facebook_url" name="facebook_url" class="input1" value="<?php if($facebook_url!=""){?><?php echo $facebook_url;?><?php }?>" /></td>
                    </tr>
					<tr>
                        <td>Mag Url</td>
                        <td><input type="text" id="another_url" name="another_url" class="input1" value="<?php if($another_url!=""){?><?php echo $another_url;?><?php }?>" /></td>
                    </tr>
					
					<tr>
                        <td>Pinterest Url</td>
                        <td><input type="text" id="inst_url" name="inst_url" class="input1" value="<?php if($inst_url!=""){?><?php echo $inst_url;?><?php }?>" /></td>
                    </tr>
					
					<tr>
                        <td>Skype Id</td>
                        <td><input type="text" id="skype_id" name="skype_id" class="input1" value="<?php if($skype_id!=""){?><?php echo $skype_id;?><?php }?>" /></td>
                    </tr>
					
					<tr>
                        <td>Google Plus URL</td>
                        <td><input type="text" id="gplus_url" name="gplus_url" class="input1" value="<?php if($gplus_url!=""){?><?php echo $gplus_url;?><?php }?>" /></td>
                    </tr>
					
					<tr>
                        <td>Youtube URL</td>
                        <td><input type="text" id="youtube_url" name="youtube_url" class="input1" value="<?php if($youtube_url!=""){?><?php echo $youtube_url; ?> <?php }?>" /></td>
                    </tr>
					
					<tr>
                        <td>Pinterest URL</td>
                        <td><input type="text" id="pinterest_url" name="pinterest_url" class="input1" value="<?php if($pinterest_url!=""){?><?php echo $pinterest_url;?><?php }?>" /></td>
                    </tr>
					
					<tr>
                        <td>Linked In URL</td>
                        <td><input type="text" id="linked_in_url" name="linked_in_url" class="input1" value="<?php if($linked_in_url!=""){?><?php echo $linked_in_url;?><?php }?>" /></td>
                    </tr>
					
					<tr>
                        <td>Gmail ID</td>
                        <td><input type="text" id="gmail_link" name="gmail_link" class="input1" value="<?php if($gmail_link!=""){?><?php echo $gmail_link;?><?php }?>" /></td>
                    </tr>
					
					<tr>
						  <td>PDF</td>
						 <td><input type="file" name="pdf_upload" id="pdf_upload!=""" />(pdf only supported)
						 <br/>
						 <?php if($pdf_upload!=""){?><a href="<?php echo base_url(); ?>adminuploads/pdf_upload/<?php echo $pdf_upload; ?>"> <img src="https://www.communitytreasures.co/images/download.png" alt="" height="20" width="20"/></a>
						 <input type="hidden" name="temp_ads_pdf"  value="<?php echo $pdf_upload; ?>" />
						 <?php } ?>
						 </td>
						
					</tr>
					
					 <tr>
						  <td>Image</td>
						 <td><?php if($ad_image!=""){?>  <img src="<?php echo base_url(); ?>adminuploads/adpost/<?php echo $ad_image; ?>" alt="" height="90" width="100"/><?php } ?>
						  <div id="imgParentDivID" style="position:relative">
						  <input type="hidden" id="x_axis" name="x_axis"><input type="hidden" id="y_axis" name="y_axis"><input type="hidden" id="ad_width" name="ad_width"><input type="hidden" id="ad_height" name="ad_height">
						  <input type="file" name="ad_image" id="ad_image" onchange="readURL(this);"/><br />
						  <img id="ad_crop" src="#" alt="your image" />
						  </div>
(jpeg|jpg|gif|png only supported) <br />
<span style="font-size:11px;">(Don't Upload any image below this size width: 184px; height: 163px;)</span></td>
						<?php if(isset($err_msg)){ echo "<span style=\"color:#F00; font-weight:bold;\">".$err_msg."</span>";}?>
						<?php if(isset($image_error)){ echo "<span style=\"color:#F00; font-weight:bold;\">".$image_error."</span>";}?>
					</tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" onclick=" return validateForm();" name="submit" id="submit" value="save" class="submit-bnt" />&nbsp;&nbsp;<a href="<?php echo base_url(); ?>cp/viewStep2UrlList">cancel</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!--Main Content-->

<?php $this->load->view('adminTemplates/common/footer', $viewData); ?>  
