<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $_admin_email ;
            
    private $paypal_active = 2; //1=live;2=sandbox

    private $paypal_action = '';

    private $paypal_email = '';

    function __construct() {
        parent::__construct();
        $this->load->model('gatewaymodel');
        $this->load->model('product_model');
        $this->_admin_email = "info@globalblackenterprises.com";
       
    }

    public function index() { 
		
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
        $viewData = array();
		
		$viewData["tabhide"] = 0;
		
        $viewData["msg"] = "";
        if ($this->session->userdata('referarId') == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        } else {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('referarId'));
        }
        if(in_array($this->session->userdata('userType'),array("TEACHER","ADMIN"))){
            $viewData["allUser"] = $this->gatewaymodel->allMember();
        }elseif($this->session->userdata('userType') == 'HEAD VOLUNTEERS'){
            $viewData["allUser"] = $this->gatewaymodel->allMembersForHV();
        }else{
			$viewData["allUser"] = array();
		}
        $viewData['balanceInCA'] = $this->gatewaymodel->getBalanceInCA($this->session->userdata('userId'));//print_r($viewData['balanceInCA']);
        $viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
        $viewData["SwitchOnMembers"] = $this->gatewaymodel->countSwitchOnMembers($this->session->userdata('userId'));
        $viewData["mySignUps"] = $this->gatewaymodel->countMySignUps($this->session->userdata('userId'));
        $viewData["totalMembers"] = $this->gatewaymodel->countTotalMembers($this->session->userdata('userId'));
        $viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
        $viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
        $viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
		$viewData["countryList"] = $this->gatewaymodel->getCountryList();		
        $viewData["afroProduct"] = $this->gatewaymodel->getAfroProduct();
        $viewData["stepWiseVideo"] = $this->gatewaymodel->getLevelStepVideo(1);
        $viewData["allProducts"] = $this->gatewaymodel->getAllProductsByUser($this->session->userdata('userId'));
        $viewData["step2Url"] = $this->gatewaymodel->getStep2Url();
        $viewData["cityList"] = $this->gatewaymodel->getCity();
		$viewData["overView"] = $this->gatewaymodel->getOverViewOfLevel1($this->session->userdata('userType'),$this->session->userdata('userId'));
		$viewData['massUserDetails'] = $this->gatewaymodel->getUserMassDetails($this->session->userdata('userId'));
        //---------------- added by SB on 24-06-2015 start ---------//
        $viewData["categoryList"] = $this->gatewaymodel->getCategory();
        //print_r($viewData["categoryList"]);
        //---------------- added by SB on 24-06-2015 end ---------//

        $viewData['vendorsList'] = $this->gatewaymodel->getVendorsList(trim($this->session->userdata('userId')));// parameter added by SB on 07/07/2015
        //$viewData['productCategoryList'] = $this->gatewaymodel->productCategoryList();// block by SB on 03/07/2015
        $viewData["colorList"] = $this->gatewaymodel->getColor();
        
        $msgTypeDetails = $this->setMessage();  
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
        
        $tab = $this->setTabProduct();
        $viewData["openTabId"] = $tab["openTabId"];
        $viewData["productId"] = $tab["productId"];
        if($viewData["productId"] > 0){
            $viewData["pDetails"] = $this->product_model->getProduct($viewData["productId"]);
			// get categoryID  &  articleID added by SB on 02/07/2015
			
			$subArticleID = $viewData["pDetails"][0]->productTypeID;
			$viewData['donateStatus'] = $viewData["pDetails"][0]->productDonate;
			$catNarticleID = $this->product_model->getCatIdArtId($subArticleID);
			//print_r($catNarticleID);
			//echo '<br>'.$catNarticleID['catId'] .'======='.$catNarticleID['articleId'];exit;
			$viewData['catID']= $catNarticleID['catId'];
			$viewData['artID']= $catNarticleID['articleId'];
			$viewData['artList'] = $this->gatewaymodel->getArticleList($catNarticleID['catId']);// get article list by category added by SB on 03/07/2015
			$viewData['productCategoryList'] = $this->gatewaymodel->getSubArticleList($catNarticleID['articleId']);// get sub article list in respect of Article added by SB on 03/07/2015
           // print_r($viewData['productCategoryList']); exit;
			$viewData["pColors"] = $this->product_model->getProductColors($viewData["productId"]);
			//print_r($viewData["pColors"]);
            $viewData["pFiles"] = $this->product_model->getProductFiles($viewData["productId"]);
			//echo '<pre>';print_r($viewData["pFiles"]);
        }
        
        $viewData['url'] = $this->getGmailUrl();
        
        $viewData["addedVendorId"] = $this->session->flashdata('addedVendorId');
        $viewData['levelWiseCounter'] = $this->gatewaymodel->getLevelWiseCount();
		$viewData['catalogueCommisson'] = $this->gatewaymodel->getCatalogueCommissionDetails($this->session->userdata('userId'));
		$viewData['infoListing'] = $this->gatewaymodel->getMyListingDetails($this->session->userdata('userId'));
		//print_r($viewData['infoListing']);exit;
        $this->load->view('dashboard/dashboard', $viewData);
        
    }	
    
    public function setMessage(){
        $retData = array();
        $type = $this->session->flashdata('type');
        $status = $this->session->flashdata('status');
        $msg = $this->session->flashdata('msg');
        if($status == "success"){
            if($type == "customer"){
                $retData["msg"] = "You have successfully submitted the message for Customer Services.";
            }elseif($type == "tech"){
                $retData["msg"] = "You have successfully submitted the message for Technical Support.";
            }elseif($type == "advertise"){
                $retData["msg"] = "You have successfully submitted the message for Advertisement Services.";
            }elseif($type == "country"){
                $retData["msg"] = "You have successfully updated your country name.";
            }elseif($type == "paypal"){
                $retData["msg"] = "You have successfully updated your paypal id.";
            }elseif($type == "image"){
                $retData["msg"] = "You have successfully updated your Profile picture.";
            }elseif($type == "pUpload"){
                $retData["msg"] = "You have successfully uploaded your Product .";
            }elseif($type == "vUpload"){
                $retData["msg"] = "You have successfully added your Vendors Details.";
            }elseif($type == "fListing"){
                $retData["msg"] = "You have successfully added your Free Listing on AFROWEBB.";
            }elseif($type == "deleteUser"){
                $retData["msg"] = "You have been successfully deleted this user.";
            }elseif($type == "inviteGmailFriend"){
                $retData["msg"] = "You have been successfully invited your Gmail's friend.";
            }elseif($type == "inviteYahooFriend"){
                $retData["msg"] = "You have been successfully invited your Yahoo's friend.";
            }elseif($type == "changePassword"){
                if($msg != ""){
                    $retData["msg"] = $msg;
                }else{
                    $retData["msg"] = "You have been successfully changed your Password.";
                }
            }elseif($type == "pUploadUpdate"){
				$retData["msg"] = "You have been successfully updated your product details.";
			}elseif($type == "convertUser"){
                $retData["msg"] = "You have been successfully converted the Afrowebb user to Volunteer user.";
            }
            $retData["type"] = $type;
        }elseif($status == "error"){
             if($msg != ""){
                $retData["msg"] = $msg;
            }else{
                $retData["msg"] = "Please try again.";
            }
            $retData["type"] = "wrong";
        }
        return $retData;
    }

    public function profilePicUpload() {
        $status = 'error';
        $type = 'image';
        if ($this->input->post('user_file_submit')) {
			if($_FILES["user_file"]["name"] != ""){
				$path = $this->common_model->imageUnlinkPath()."useruploads/";
				$tbl = 'userinfo';
				$where['uID'] = trim($this->session->userdata('userId'));
				$selectedData = "profile";
				$data = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
				$tempImg = $data[0]->profile;
				if(file_exists($path.$tempImg)){
					unlink($path.$tempImg);
				}
				
				$temp = explode(".", $_FILES["user_file"]["name"]);
				$extension = strtolower(end($temp));
				$imageName = 'profile-'.$where['uID'].'-'.time() . "." . $extension;
				
				move_uploaded_file($_FILES["user_file"]["tmp_name"], $path.$imageName );
				$this->gatewaymodel->insertMemberProfilePic($imageName);
				$status = 'success';
				
				/*move_uploaded_file($_FILES["user_file"]["tmp_name"], str_replace("system", "useruploads", BASEPATH) . $_FILES["user_file"]["name"]);
				$this->gatewaymodel->insertMemberProfilePic($_FILES["user_file"]["name"]);
				$status = 'success';*/
			}
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }
    
    public function userCountryUpdate() {
        $status = 'error';
        $type = 'country';
        $countryId = trim($this->input->post('country'));
        if ($countryId != "") {
            $tbl = 'userinfo';
            $where = array("uID"=>$this->session->userdata("userId"));
            $data = array("country"=>$countryId) ;
            $update = $this->common_model->updateDataToTable($tbl, $where, $data );
            if($update){
                $status = 'success';
            }
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }

    public function userPaypalUpdate() {
        $status = 'error';
        $type = 'paypal';
        $paypalId = trim($this->input->post('user_paypal_name'));
        if ($paypalId != "") {
            $tbl = 'userinfo';
            $where = array("uID"=>$this->session->userdata("userId"));
            $data = array("paypalAC"=>$paypalId) ;
            $update = $this->common_model->updateDataToTable($tbl, $where, $data );
            if($update){
                $status = 'success';
            }
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }

    function downloadAdverts() {
        $imgname = $_REQUEST['img'];
        $remoteFile = base_url() . 'adminuploads/advert/' . $imgname;
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=\"$imgname\";");
        header("Content-Transfer-Encoding: binary");
        readfile($remoteFile);
    }

    public function downloadVideo() {
        $video_id = $this->input->post('video_id');
        $viewData["video_id"] = $video_id;
        $this->load->view('youtube/getvideo', $viewData);
    }
    
    public function services($type = '',$level = 1){
        $status = 'error';
        if($type != ''){
            $email = $this->input->post('email');
            $message = $this->input->post('message');
            if($email != "" && $message != ""){
                $retData = 2;
                if($type == "customer"){
                    $retData = $this->sendCustomerEmailToAdmin($email,$message);
                }elseif($type == "tech"){
                    $retData = $this->sendTechEmailToAdmin($email,$message);
                    $retData = $this->sendTechEmailToSenabi($email,$message);
                }elseif($type == "advertise"){
                    $retData = $this->sendAdvertiseEmailToAdmin($email,$message);
                }
                if($retData == 1){
                    $status = 'success' ;
                }
            }
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
		if($level == 1){
        	redirect(base_url()."dashboard");
		}elseif($level == 2){
			redirect(base_url()."fullmembers");
		}
    }
    
    public function sendCustomerEmailToAdmin($email = '',$msg = ''){
        $to = $this->_admin_email;
        $subject = "Email for Customer Services";
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Here are customer details as below.</td></tr>
                    <tr><td width="25%">Email:</td><td width="75%">'.$email.'</td></tr>
                    <tr><td width="25%">Message:</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
        	
    }
    
    public function sendTechEmailToAdmin($email = '',$msg = ''){
        $to = $this->_admin_email;
        $subject = "Email for Customer Tech support";
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Here are customer details as below.</td></tr>
                    <tr><td width="25%">Email:</td><td width="75%">'.$email.'</td></tr>
                    <tr><td width="25%">Message:</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
        	
    }
    
    public function sendTechEmailToSenabi($email = '',$msg = ''){
        $to = "senabi.test01@gmail.com";
        $subject = "Email for Customer Tech support";
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Here are customer details as below.</td></tr>
                    <tr><td width="25%">Email:</td><td width="75%">'.$email.'</td></tr>
                    <tr><td width="25%">Message:</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
        	
    }
    
    public function sendAdvertiseEmailToAdmin($email = '',$msg = ''){
        $to = $this->_admin_email;
        $subject = "Email for Customer Advertise";
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Here are customer details as below.</td></tr>
                    <tr><td width="25%">Email:</td><td width="75%">'.$email.'</td></tr>
                    <tr><td width="25%">Message:</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
        	
    }
    
    function send_mail_raw($to = '', $subject = '', $message = '') {
        $from_email = "info@globalblackenterprises.com";
        $from_name = "globalblackenterprises.com";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
        $headers .= 'From: '.$from_name.' <'.$from_email.'>' . "\r\n";
        $headers .= 'Reply-To: '.$from_name.' <'.$from_email.'>' . "\r\n";
        $headers .= 'Return-Path: '.$from_name.' <'.$from_email.'>'."\n";      
        $send = mail($to, $subject, $message, $headers);
        if ($send) {
        return TRUE;
        } else {
        return FALSE;
        }
    }
    
    public function freeListing(){
        $type = 'fListing';
        $status = 'error';
        if($this->input->post('freeListing') != ''){
			$listingdetails["subCatId"] = trim($this->input->post('subArticleList'));
            $listingdetails["listingName"] = trim($this->input->post('listingName'));
            $listingdetails["listingAddr"] = $this->input->post('listingAddr');
            $listingdetails["listingNo"] = trim($this->input->post('listingNo'));
            $listingdetails["listingDesc"] = $this->input->post('listingDesc');
            $listingdetails["listingWebsite"] = trim($this->input->post('listingWebsite'));
            $retImg = $this->uploadFreeListingImage();
            if($retImg['status'] == 1){
                $listingdetails["listingImg"] = $retImg['name'];
            }else{
                $listingdetails["listingImg"] = "";
            }
            $listingdetails["listingUrl"] = trim($this->input->post('listingUrl'));
            $listingdetails["listingEmail"] = trim($this->input->post('listingEmail'));
            $listingdetails["listingCountry"] = $this->input->post('listingCountry');
            $listingdetails["listingState"] = trim($this->input->post('listingState'));
            $listingdetails["listingCity"] = $this->input->post('listingCity');
            $listingdetails["listingAddedBy"] = $this->session->userdata('userId');
            $listingdetails["listingCreatedDate"] = date("Y-m-d H:i:s");
            $tbl = 'listingdetails';
            $listingdetailsId = $this->common_model->insertDataToTable($tbl,$listingdetails);
           /*  unset($listingdetails);unset($tbl);
            $tbl = 'listingurls';
            $listingurls["lisMemID"] = $listingdetailsId;
            $listingurls["lisUrl"] = $this->input->post('lisUrl');
            $listingurls["status"] = '1';
            $listingurlsId = $this->common_model->insertDataToTable($tbl,$listingurls); */
            if($listingdetailsId > 0){
                $status = 'success';
            }
        }
        
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        $this->session->set_flashdata('openTabId','tab4');
        redirect(base_url()."dashboard");
    }
    
    public function uploadFreeListingImage() {
        $path = "adminuploads/listingImg/";
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["listingImg"]["name"]);
        $extension = strtolower(end($temp));
        if (($_FILES["listingImg"]["size"] < 2000000) && in_array($extension, $allowedExts)) {
            $_FILES["listingImg"]["name"] = "listing_".time(). "." . $extension;
            if ($_FILES["listingImg"]["error"] > 0) {
                $retData['status'] = 0; //error
                $retData['errorMsg'] = 'The image has an error' . $_FILES["listingImg"]["error"]; //error
                $retData['name'] = $_FILES["listingImg"]["name"];
            } else {
                move_uploaded_file($_FILES["listingImg"]["tmp_name"], $path . $_FILES["listingImg"]["name"]);
                $retData['status'] = 1; //success
                $retData['errorMsg'] = '';
                $retData['name'] = $_FILES["listingImg"]["name"];
            }
        }
        return $retData;
    }

    public function addVendors(){
        $type = 'vUpload';
        $status = 'error';
        if($this->input->post('addVendors') != ''){
            $vendor["vendorName"] = trim($this->input->post('vendorName'));
            $vendor["vendorNo"] = $this->input->post('vendorNo');
            $vendor["vendorAddr"] = trim($this->input->post('vendorAddr'));
            $vendor["vendorCity"] = $this->input->post('vendorCity');
            $vendor["vendorCountry"] = trim($this->input->post('vendorCountry'));
            $vendor["vendorZip"] = trim($this->input->post('vendorZip'));
            $vendor["vendorEmail"] = trim($this->input->post('vendorEmail'));
            $vendor["vendorWebsite"] = $this->input->post('vendorWebsite');
            $vendor["vendorAddedBy"] = $this->session->userdata('userId');
            $vendor["vendorCreatedDate"] = date("Y-m-d H:i:s");
            $tbl = 'vendorslist';
            $vendorId = $this->common_model->insertDataToTable($tbl,$vendor);
            unset($vendor);unset($tbl);
            if($vendorId > 0){
                $status = 'success';
                $this->session->set_flashdata('addedVendorId',$vendorId);
            }
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        $this->session->set_flashdata('openTabId','tab4');
        redirect(base_url()."dashboard");
    }
    
    public function addProduct(){
        $type = 'pUpload';
        $status = 'error';
        if($this->input->post('pUploadButton') != ''){
            $product["productTypeID"] = trim($this->input->post('productTypeID'));
            $product["vendorID"] = $this->input->post('vendorID');
            $product["productName"] = trim($this->input->post('productName'));
            $product["productDesc"] = $this->input->post('productDesc');
            $product["productCurrencyType"] = trim($this->input->post('productCurrencyType'));
            $product["productPrice"] = trim($this->input->post('productPrice'));
            $product["productQuantity"] = trim($this->input->post('productQuantity'));
            $product["productCommission"] = trim($this->input->post('productCommission'));
            $product["productOffer"] = $this->input->post('productOffer');
            $product["productYoutubeUrl"] = $this->input->post('productYoutubeUrl');
            $product["typeOfProduct"] = trim($this->input->post('typeOfProduct'));
			$product["productEventDate"] = trim($this->input->post('productEventEndDate'));// added by Sb on 08/07/2015
            $product["productStatus"] = trim($this->input->post('productStatus'));
            $product["createdDate"] = date("Y-m-d H:i:s");
            $product["addedBy"] = $this->session->userdata('userId');
			$product["productDonate"] = trim($this->input->post('productDonate'));
            
            $tbl = 'product_details';
            $productId = $this->common_model->insertDataToTable($tbl,$product);
            unset($product);unset($tbl);
            if($productId > 0){
                $this->allImages($productId);
                $this->addProductAudio($productId);
				$this->addProductEventPdf($productId);// added by Sb on 08/07/2015
                if($this->input->post("RadioGroup1") == 1){
                    $this->addColor($productId);
                }
                $status = 'success';
            }
            
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        $this->session->set_flashdata('openTabId','tab4');
        redirect(base_url()."dashboard");
    }
    
    public function allImages($pId = 0){
        $insertImg = array();
        $insertImg["fileType"] = 0;
        $insertImg["productId"] = $pId;
        if($_FILES["img_1"]["name"] != ""){
            $fileName = "img_1";
            $insertImg["isMain"] = 1;
            $ret[1] = $this->addProductImages($fileName,$insertImg);
        }
        if($_FILES["img_2"]["name"] != ""){
            $fileName = "img_2";
            $insertImg["isMain"] = 0;
            $ret[2] = $this->addProductImages($fileName,$insertImg);
        }
        if($_FILES["img_3"]["name"] != ""){
            $fileName = "img_3";
            $insertImg["isMain"] = 0;
            $ret[3] = $this->addProductImages($fileName,$insertImg);
        }
        if($_FILES["img_4"]["name"] != ""){
            $fileName = "img_4";
            $insertImg["isMain"] = 0;
            $ret[3] = $this->addProductImages($fileName,$insertImg);
        }
        //echo "<pre>";print_r($ret);
        return true;
    }
    
    public function addProductImages($fileName = "",$insertImg = array()){
        $this->load->library('upload');
        $config['upload_path'] = $this->common_model->imageUnlinkPath().'adminuploads/product_files/images/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '200000';
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['file_name'] = 'product-'.$insertImg["productId"].'-'.time();
        $this->upload->initialize($config);
        $this->upload->do_upload($fileName);
        $ret = $this->upload->data();
        $this->load->library('image_lib');
        $image_lib['image_library'] = 'gd2';
        $image_lib['source_image'] = $ret["full_path"];
        $image_lib['create_thumb'] = FALSE;
        $image_lib['maintain_ratio'] = TRUE;
        $image_lib['new_image'] = $this->common_model->imageUnlinkPath().'adminuploads/product_files/images/thumb/'.$ret['file_name'];
        $image_lib['width'] = 192;
        $image_lib['height'] = 192;
        $this->image_lib->initialize($image_lib);
        $this->image_lib->resize();
        $this->image_lib->clear();
        $tbl = 'product_files';
        $insertImg["fileName"] = $ret["file_name"];
        $imgId = $this->common_model->insertDataToTable($tbl,$insertImg);
        return $ret;
    }
    
    public function addProductAudio($pId = 0){
        if($_FILES["productMusic"]["name"] != ""){
            $path = "adminuploads/product_files/audio/";
            $allowedExts = array("mp3","mp4");
            $temp = explode(".", $_FILES["productMusic"]["name"]);
            $extension = strtolower(end($temp));
            if (($_FILES["productMusic"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $_FILES["productMusic"]["name"] = 'product-'.$pId.'-'.time() . "." . $extension;
                if ($_FILES["productMusic"]["error"] > 0) {
                    $retData['status'] = 0; //error
                    $retData['errorMsg'] = 'The image has an error' . $_FILES["productMusic"]["error"]; //error
                    $retData['name'] = $_FILES["productMusic"]["name"];
                } else {
                    move_uploaded_file($_FILES["productMusic"]["tmp_name"], $path . $_FILES["productMusic"]["name"]);
                    $tbl = 'product_files';
                    $insertImg["fileName"] = $_FILES["productMusic"]["name"];
                    $insertImg["isMain"] = 0;
                    $insertImg["fileType"] = 1;
                    $insertImg["productId"] = $pId;
                    $imgId = $this->common_model->insertDataToTable($tbl,$insertImg);
                }
            }
        }
        return true;
    }
	// added by SB on 08/07/2015
	 public function addProductEventPdf($pId = 0){
        if($_FILES["productEventPdf"]["name"] != ""){
            $path = "adminuploads/product_files/pdf/";
            $allowedExts = array("pdf");
            $temp = explode(".", $_FILES["productEventPdf"]["name"]);
            $extension = strtolower(end($temp));
            if (($_FILES["productEventPdf"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $_FILES["productEventPdf"]["name"] = 'product-'.$pId.'-'.time() . "." . $extension;
                if ($_FILES["productEventPdf"]["error"] > 0) {
                    $retData['status'] = 0; //error
                    $retData['errorMsg'] = 'The pdf file has an error' . $_FILES["productEventPdf"]["error"]; //error
                    $retData['name'] = $_FILES["productEventPdf"]["name"];
                } else {
                    move_uploaded_file($_FILES["productEventPdf"]["tmp_name"], $path . $_FILES["productEventPdf"]["name"]);
                    $tbl = 'product_files';
                    $insertImg["fileName"] = $_FILES["productEventPdf"]["name"];
                    $insertImg["isMain"] = 0;
                    $insertImg["fileType"] = 2;
                    $insertImg["productId"] = $pId;
                    $imgId = $this->common_model->insertDataToTable($tbl,$insertImg);
                }
            }
        }
        return true;
    }
    
    public function addColor($productId = 0){
       $color = $this->input->post("color");
       $quantity = $this->input->post("q");
       if(count($color) > 0){
           //$sumQ = 0;
           foreach($color as $key=>$val){
               if($key == $val && $val > 0){
                   if($quantity[$key] != ""){
                        $colorArray['productId'] = $productId;
                        $colorArray['colorId'] = $val;
                        $colorArray['quantity'] = trim($quantity[$key]);
                        $tbl = 'product_color_quantity';
                        $cId = $this->common_model->insertDataToTable($tbl,$colorArray);
                        unset($colorArray);unset($tbl);
                        //$sumQ = $sumQ + trim($quantity[$key]);
                   }
               }
           }
       }
//       if($sumQ > 0){
//            $tbl = "product_details";
//            $where['productID'] = $productId;
//            $insert_array['productQuantity'] = $sumQ;
//            $this->common_model->updateDataToTable($tbl, $where, $insert_array);
//            unset($tbl);unset($where);unset($insert_array);
//       }
       return true;
    }
    
    public function expell(){
        $data["user_id"] = trim($this->input->post("uID"));
        $data["expell_by_user_id"] = $this->session->userdata('userId');
        $data["expell_date"] = date("Y-m-d H:i:s");
        $tbl = 'user_expell';
        $insertId = $this->common_model->insertDataToTable($tbl,$data);
        if($insertId > 0){
           $retData = $this->sendExpellEmailToAdmin($insertId);
        }
		echo $retData;
    }
    
    public function sendExpellEmailToAdmin($expellId = 0){
        $to = $this->_admin_email;
		$userDetail = $this->gatewaymodel->getExpellUserInfo($expellId);// Added by SB on 23-04-2015
		//print_r($userDetail);
		//echo $userDetail['EUserfName']." ==== ".$userDetail['EUserlName'];
        $subject = $userDetail['EUserfName']." ".$userDetail['EUserlName']." has been expelled by ".$userDetail['firstName']." ".$userDetail['lastName'];
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">'.$userDetail['EUserfName'].' '.$userDetail['EUserlName'].' has been expelled from his/her circle.</td></tr>
                    
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
    }
    
    public function deleteUserFromExpell($id = 0){
		$whereExpell['user_id'] = $id;
        $delRequstExpell = $this->gatewaymodel->deleteDataFromTable('user_expell', $whereExpell);   
        $where['uID'] = $id;
        if($delRequstExpell){				
            $delRequstUser = $this->gatewaymodel->deleteDataFromTable('userinfo', $where);
			$this->gatewaymodel->deleteDataFromTable('user_general_type', $whereExpell); 
			$this->gatewaymodel->deleteDataFromTable('gbe_mass_details', $whereExpell);
			unset($whereExpell);
			$whereExpell['to_user_id'] = $id;
			$this->gatewaymodel->deleteDataFromTable('gbe_mass_details', $whereExpell);   
        }
        $type = 'deleteUser';
        $status = 'success';
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }
    
    public function construction(){
        $viewData = array();
        $this->load->view('dashboard/under_construction', $viewData);
    }
	
    public function getGmailContacts(){
        $type = 'inviteGmailFriend';
        $status = 'error';
        if($this->input->post('send') != ""){
                $userInfo = $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
                $userName = $userInfo[0]['firstName'].' '.$userInfo[0]['lastName'];
                $emails = $this->input->post('emails');
                $message = $this->input->post('message');
                if(count($emails) > 0 && $message != ''){
                        foreach($emails as $email){
                                if($email != '' ){
                                        $this->sendEmailInvitedFriend($email,$message,$userName);
                                }
                        }
                        $status = 'success';
                }

        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        $this->session->set_flashdata('openTabId','tab2');
        redirect(base_url()."dashboard");
    }

    public function getYahooContacts(){
        $type = 'inviteYahooFriend';
        $status = 'error';
        if($this->input->post('send') != ""){
                $userInfo = $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
                $userName = $userInfo[0]['firstName'].' '.$userInfo[0]['lastName'];
                $emails = $this->input->post('emails');
                $message = $this->input->post('message');
                if(count($emails) > 0 && $message != ''){
                        foreach($emails as $email){
                                if($email != '' ){
                                        $this->sendEmailInvitedFriend($email,$message,$userName);
                                }
                        }
                        $status = 'success';
                }

        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        $this->session->set_flashdata('openTabId','tab2');
        redirect(base_url()."dashboard");
    }

    public function sendEmailInvitedFriend($to = '',$msg = '',$userName = ''){
        $subject = 'Invitation for GBE';
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello,</td></tr>
                    <tr><td colspan="2">Your are invited by your friend <strong>'.$userName.'</strong>. Here is the message of your friend.</td></tr>
                                        <tr><td><strong>Message :</strong></td><td>'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        return $eml;
    }

    public function getGmailUrl(){
        $url['gmail'] = base_url()."inviteFriend/gmail/";
        $url['yahoo'] = base_url()."inviteFriend/yahoo/";
        return $url;
    }
    
    
    public function changePassword(){
        $type = 'changePassword';
        $status = 'error';
        $userInfo = $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
        if($this->input->post('passwordUpdate') != ""){
            $oldPassword = trim($this->input->post('oldpassword'));
            $newPassword = trim($this->input->post('password'));
            if($userInfo[0]["password"] != $oldPassword){
                $msg = "Please enter correct Old Password.";
            }else{
                $tbl = 'userinfo';
                $where = array("uID"=>$this->session->userdata("userId"));
                $data = array("password"=>$newPassword) ;
                $update = $this->common_model->updateDataToTable($tbl, $where, $data );
                $status = 'success';
                $msg = "You have been successfully updated the password.";
            }
            
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        $this->session->set_flashdata('msg',$msg);
        redirect(base_url()."dashboard");
    }
    
 // added by SB on 25/06/2015
	public function getArticleList(){
	 
		$catId = trim($_POST["catId"]);
		$articleArr = $this->gatewaymodel->getArticleList($catId);
		$articleList = '';
		$articleList.='<option value="" >Select Article </option>';
		foreach($articleArr as $articleVal){
			$articleList.= '<option value="'.$articleVal['id'].'">'.$articleVal['title'].'</option>';
		}
		echo $articleList;
	}
	public function getSubArticleList(){
	 
		$subArtId = trim($_POST["subArtId"]);
		$subArticleArr = $this->gatewaymodel->getSubArticleList($subArtId);
		$subArticleList = '';
		$subArticleList.='<option value="" >Select Sub Article </option>';
		$arrCount = count($subArticleArr);
		foreach($subArticleArr as $subArticleVal){
			if($arrCount==1){
				$subArticleList.= '<option value="'.$subArticleVal['id'].'" selected="selected" >'.$subArticleVal['title'].'</option>';
			}
			else{
				$subArticleList.= '<option value="'.$subArticleVal['id'].'">'.$subArticleVal['title'].'</option>';
			}
			
		}
		echo $subArticleList;
	}
    
	// added by SB on 29/06/2015
	public function getCityList(){
	 
		$countryId = trim($_POST["countryId"]);
		$cityArr = $this->gatewaymodel->getCityListByCountryId($countryId);
		$cityList = '';
		$cityList.='<option value="" >Select City </option>';
		foreach($cityArr as $cityVal){
			$cityList.= '<option value="'.$cityVal['id'].'">'.$cityVal['city'].'</option>';
		}
		echo $cityList;
	}
	public function addNewCity(){
		$countryId = trim($_POST["countryId"]);
		$newCityName = ucwords(trim($_POST["newCityName"]));
		$cityExist = $this->gatewaymodel->checkCityExist($countryId,$newCityName);
		if($cityExist){
			$cityId = $this->gatewaymodel->addNewCity($countryId,$newCityName);
			if($cityId){
				$cityArr = $this->gatewaymodel->getCityListByCountryId($countryId);
				$cityList = '';
				$cityList.='<option value="" >Select City </option>';
				foreach($cityArr as $cityVal){
					$cityList.= '<option value="'.$cityVal['id'].'">'.$cityVal['city'].'</option>';
				}
				$val = array("success" => "yes","cityList"=>$cityList);
				
			}
		}
		else{
			
			$val = array("success" => "no","message"=>'City name already exist in database');
		}
		
		$output = json_encode($val);
		echo $output;
	}
        
	public function editProduct($productId = 0){
		if($productId > 0){
			$this->session->set_flashdata('openTabId','tab4');
			$this->session->set_flashdata('productId',$productId);
		}
		redirect(base_url()."dashboard");
	}
	
	public function setTabProduct(){
		$retData = array();
		$retData['openTabId'] = $this->session->flashdata('openTabId');
		$retData['productId'] = $this->session->flashdata('productId');
		return $retData;
	}
	
	public function updateProduct(){
		$type = 'pUploadUpdate';
        $status = 'error';
		if($this->input->post('pUploadButton') != ''){
			$productId = trim($this->input->post('productId'));
			$where['productID'] = $productId;
            $product["productTypeID"] = trim($this->input->post('productTypeID'));
            $product["vendorID"] = $this->input->post('vendorID');
            $product["productName"] = trim($this->input->post('productName'));
            $product["productDesc"] = $this->input->post('productDesc');
            $product["productCurrencyType"] = trim($this->input->post('productCurrencyType'));
            $product["productPrice"] = trim($this->input->post('productPrice'));
            $product["productQuantity"] = trim($this->input->post('productQuantity'));
            $product["productCommission"] = trim($this->input->post('productCommissionEdit'));
            $product["productOffer"] = $this->input->post('productOfferEdit');
            $product["productYoutubeUrl"] = $this->input->post('productYoutubeUrl');
            $product["typeOfProduct"] = trim($this->input->post('typeOfProduct'));
			$product["productEventDate"] = trim($this->input->post('productEventEndDate'));// added by Sb on 08/07/2015
            $product["productStatus"] = trim($this->input->post('productStatus'));
            $product["updatedDate"] = date("Y-m-d H:i:s");
			$product["productDonate"] = $this->input->post('productOfferEdit');
            
            $tbl = 'product_details';
            $this->common_model->updateDataToTable($tbl,$where,$product);
            unset($product);unset($tbl);
            if($productId > 0){
                $this->updateAllImages($productId);
                $this->updateProductAudio($productId);
				$this->updateProductPdf($productId);
				$this->deleteColor($productId);
                if($this->input->post("RadioGroup1") == 1){
					$this->addColor($productId);
                }
                $status = 'success';
				//$this->session->set_flashdata('productId',$productId);
            }
            
        }
		$this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('openTabId','tab4');
		
		redirect(base_url()."dashboard");
	}
	
	private function deleteColor($productId = 0){
		if($productId > 0){
			$where['productId'] = $productId;
            $tbl = 'product_color_quantity';
			$this->common_model->deleteDataFromTable($tbl,$where);
		}
	   return true;
	}
	
	private function updateAllImages($productId = 0){
		$insertImg = array();
        $insertImg["fileType"] = 0;
        $insertImg["productId"] = $productId;
        if($_FILES["img_1"]["name"] != ""){
			$imgEditId = trim($this->input->post('img_1_edit'));
			$this->deleteImageWithUnlink($imgEditId,$productId);
			unset($imgEditId);
            $fileName = "img_1";
            $insertImg["isMain"] = 1;
            $ret[1] = $this->addProductImages($fileName,$insertImg);
        }
        if($_FILES["img_2"]["name"] != ""){
			$imgEditId = trim($this->input->post('img_2_edit'));
			$this->deleteImageWithUnlink($imgEditId,$productId);
			unset($imgEditId);
            $fileName = "img_2";
            $insertImg["isMain"] = 0;
            $ret[2] = $this->addProductImages($fileName,$insertImg);
        }
        if($_FILES["img_3"]["name"] != ""){
			$imgEditId = trim($this->input->post('img_3_edit'));
			$this->deleteImageWithUnlink($imgEditId,$productId);
			unset($imgEditId);
            $fileName = "img_3";
            $insertImg["isMain"] = 0;
            $ret[3] = $this->addProductImages($fileName,$insertImg);
        }
        if($_FILES["img_4"]["name"] != ""){
			$imgEditId = trim($this->input->post('img_4_edit'));
			$this->deleteImageWithUnlink($imgEditId,$productId);
			unset($imgEditId);
            $fileName = "img_4";
            $insertImg["isMain"] = 0;
            $ret[3] = $this->addProductImages($fileName,$insertImg);
        }
        return true;	
	}
	
	private function deleteImageWithUnlink($imgId,$productId){
		$tbl = 'product_files';
		if($imgId > 0 && $productId > 0){
			$where['id'] = $imgId;
			$where['productId'] = $productId;
			$selectedData = "";
			$data = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
			if($data[0]->id != "" && $data[0]->fileName != ""){
				unlink($this->common_model->imageUnlinkPath().'adminuploads/product_files/images/'.$data[0]->fileName);
				unlink($this->common_model->imageUnlinkPath().'adminuploads/product_files/images/thumb/'.$data[0]->fileName);
			}
			unset($data);	
			$this->common_model->deleteDataFromTable($tbl,$where);
		}
		return true;
	}
	
	private function updateProductAudio($productId = 0){
		$tbl = 'product_files';
		$where['id'] = trim($this->input->post('mp3EditId'));
		if($where['id'] > 0){
			$where['productId'] = $productId;
			$selectedData = "";
			$data = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
			if($data[0]->id != "" && $data[0]->fileName != ""){
				unlink($this->common_model->imageUnlinkPath().'adminuploads/product_files/audio/'.$data[0]->fileName);
			}
			unset($data);	
			$this->common_model->deleteDataFromTable($tbl,$where);
		}
		$this->addProductAudio($productId);
		return true;
	}
	
	// added by SB on 08/07/2015
	private function updateProductPdf($productId = 0){
		$tbl = 'product_files';
		$where['id'] = trim($this->input->post('pdfEditId'));
		if($where['id'] > 0){
			$where['productId'] = $productId;
			$selectedData = "";
			$data = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
			if($data[0]->id != "" && $data[0]->fileName != ""){
				unlink($this->common_model->imageUnlinkPath().'adminuploads/product_files/pdf/'.$data[0]->fileName);
			}
			unset($data);	
			$this->common_model->deleteDataFromTable($tbl,$where);
		}
		$this->addProductEventPdf($productId);
		return true;
	}
	
	/*added by RD 8/9/2015*/
	public function convertAfroToVol(){
		$afroIds = trim($this->uri->segment(3));
		$insertData['user_id'] = trim($this->session->userdata('userId'));
		$insertData['user_level'] = 0;
		$insertData['created_date'] = date("Y-m-d H:i:s");
		$insertData['to_user_id'] = $afroIds;
		$tbl = 'gbe_mass_details';
		$this->common_model->insertDataToTable($tbl, $insertData);
		unset($tbl);
		$tbl = 'userinfo';
		$where['uID'] = $insertData['to_user_id'];
		$data['userType'] = 'VOLUNTEERS';
		$data['email_send_status'] = 1;
		$data['password'] = $this->generatePassword();
		$this->common_model->updateDataToTable($tbl, $where, $data);
		unset($tbl);unset($where);unset($data);
		$tbl = 'user_general_type';
		$where['user_id'] = $insertData['to_user_id'];
		$this->common_model->deleteDataFromTable($tbl, $where);	
		unset($tbl);unset($where);
		$this->sendEmailForConvert($insertData['to_user_id']);
		
		
		$type = 'convertUser';
        $status = 'success';
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
	}
	
	private function generatePassword() {
		$string = mt_rand();
		$start = 1;
		$length = 8;
		$code = substr($string, $start, $length);
		$code = "GBE" . $code;
		return $code;
	}
	
	public function sendEmailForConvert($signupId){
		$details = $this->gatewaymodel->getUserDetails($signupId);
        $to_email = $details[0]->cuEmail;
        $subject = "V.I.P Entrance For My True 12 - Make Money Online";
        $message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
	  <p style="font-size:14px;">Hello&nbsp;'.$details[0]->cuFName.'&nbsp;'.$details[0]->cuLName.'</p>
	  <p style="font-size:14px;">We Welcome You To Gain Access To The GBE Wealth System - V.I.P Area.</p>
	  <p style="font-size:14px;">To make progress as black people, we must first, empower ourselves by raising our own personal income while developing healthier, safer and wealthier communities.</p>
	  <p style="font-size:14px;">The GBE wealth platform was created with this in mind.</p>
	  <p style="font-size:14px;">We believe a brighter future will only be achieved when more of us unite and together, step up to the challenge of becoming financially secure.</p>
	  <p style="font-size:14px;">By raising the amount of conscious affluence within our people, we can finally make a more economically balanced society.</p>
	   <p style="font-size:14px;">Within the GBE wealth system are five areas to help you generate substantial amounts of money.</p>
	  <p style="font-size:16px;">You have been given the gift of <b>V.I.P entrance</b> to Level 1</p>
	  
	  <p style="font-size:14px;">This means you will be one of the first in this city to gain access to our powerful marketing suite called Afrowebb.</p>
	  
	  <p style="font-size:14px;">Inside the Afrowebb, you can boost your current business, list any of your services and utilise our network of agents to sell your own products. If you have any form of creative talents then use Afrowebb to market your items.</p>
	  
	  <p style="font-size:14px;">We will also show you how to rapidly increase your income using our V.I.P software.Just follow the instructions given by our VIP members, which is the person who sent you this invite and you will access a short cut to your financial success.</p>
	  
	  
	  
	  <p style="font-size:16px;">TAKE ACTION.</p>
	  
	  <p style="font-size:14px;">You will need to move fast to secure your extremely privileged position in our system because if you remain dormant, this account will be closed and your opportunity will pass.</p>
	  
		<p style="font-size:14px;">Here is an outline of 9 steps that will secure your valuable position and dramatically build your wealth.</p>
		<p style="font-size:14px;">1. Enter your GBE account, using the username and password below.</p>
		<p style="font-size:14px;">2. Watch the first 4 videos on the page &shy; To fully understand the GBE business and commission structure.</p>
		<p style="font-size:14px;">3. Go to product upload &shy; Upload or list your items or brands. Feel free to ask the person who sent you this link to help turn your business, your brands, events, services into a products to be sold on Afrowebb.</p>
		<p style="font-size:14px;">4. On the right side of the page go to \'VIP entrance\' Watch the video then add 12 selected guests involved in Black-owned enterprises to our account.</p>
		<p style="font-size:14px;">5. If you need help finding 12 good people &shy; Go to \'Vendors Sign up page\' further down on the right.</p>
		
		<p style="font-size:14px;">6. Post the \'Vendors Sign up page\' on your facebook, whatsapp, and twitter etc. This will attract people who qualify to be part of your 12.</p>
		<p style="font-size:14px;">7. When people arrive they will be viewable at the bottom of the page.Call this person and qualify them by checking: </p>
		<p style="font-size:14px;padding-left:30px">A. Do they have a product or service to place of Afrowebb.</p>
		<p style="font-size:14px;padding-left:30px">B. Will they support 12 others by giving the gift of the V.I.P </p>
		<p style="font-size:14px;padding-left:30px">C. Will they move as one &shy; Raising up the system at an agreed date once they have fully build their GBE business.</p>
	
		<p style="font-size:14px;">9. Yet most importantly &shy; PREPARE TO MOVE AS ONE.On a specific date, when your team leader tells you to, you must move up to level two. There will be no risk, as the entire team around you will work as one unit, allowing immediate profits to flow for each of the participants.</p>
		<p style="font-size:16px;">Done</p>
		<p style="font-size:14px;">This is your moment!!! Be strong as together we can do this, have faith, be 100% committed to your success &shy; move as one and together we will be financially free.</p>
		<p style="font-size:16px;">ENTER NOW</p>
	  
	  <p style="font-size:14px;">Username:'.$details[0]->cuEmail.'</p>
	  <p style="font-size:14px;">Password:'.$details[0]->cupwd.'</p>
		<p style="font-size:14px;"><a href="'.base_url().'">Click here to login</a></p></div>';
     
        if ($to_email != '' && $subject != '') {
            //$this->send_mail_raw();
			$this->send_mail_raw($to_email,$subject,$message);
			return true;
        } else {
            return false;
        }
	}
	
}
