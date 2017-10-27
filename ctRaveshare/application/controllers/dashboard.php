<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $_admin_email ;
    private $paypal_active = 2; //1=live;2=sandbox
	private $_from_email;//22/12/2015 new aded us
    private $_from_name;
	private $_to_email;
	private $_subject;
    private $_message;
	//private $this->forWebsite = 2;
    private $paypal_action = '';
    private $paypal_email = '';
    function __construct() {
        parent::__construct();
        $this->load->model('gatewaymodel');
        // $this->load->model('product_model');
		$this->load->model('common_model');
		//$this->load->model('fullmembers_model');
       
		$this->_from_email = "admin@communitytreasures.co";//22/12/2015 new added us
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "admin@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
		$this->_techsupport_email = "otizfangel@gmail.com";
		$this->forWebsite = 2;
        }
    public function index() { 
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');	
	        }
			
        $viewData = array();
		$viewData["tabhide"] = 0;
        $viewData["msg"] = "";
		$tb1="userinfo";
		$id=trim($this->session->userdata('userId'));
     	 if ($this->session->userdata('referarId') == 0) {
			
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        } else {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('referarId'));
        }
		
		if(in_array($this->session->userdata('userType'),array("TEACHER","ADMIN"))){
            $viewData["allUser"] = $this->gatewaymodel->allMember();
		}
		elseif($this->session->userdata('userType') == 'HEAD VOLUNTEERS'){
            $viewData["allUser"] = $this->gatewaymodel->allMembersForHV();
		}else{
			$viewData["allUser"] = array();
		}
		$viewData['ct_url']="";
		$viewData['balanceInCA'] = $this->gatewaymodel->getBalanceInCA($this->session->userdata('userId'));
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
		$viewData["overView"] = $this->gatewaymodel->getOverViewOfLevel1($this->session->userdata('userType'),$this->session->userdata('userId'));//15/10/2015 ujjwal sana added 
		$viewData['massUserDetails'] = $this->gatewaymodel->getUserMassDetails($this->session->userdata('userId'));
		$viewData["categoryList"] = $this->gatewaymodel->getCategory();
        $viewData['vendorsList'] = $this->gatewaymodel->getVendorsList(trim($this->session->userdata('userId')));
		$viewData["colorList"] = $this->gatewaymodel->getColor();
        $msgTypeDetails = $this->setMessage();  
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
        $tab = $this->setTabProduct();
        $viewData["openTabId"] = $tab["openTabId"];
        $viewData["productId"] = $tab["productId"];
		$viewData["list"] = $this->gatewaymodel->getprofile_picture($tb1,$id);
		$viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
		$viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
		$viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
		$viewData['url'] = $this->getGmailUrl();
        $viewData["step2Url"] = $this->gatewaymodel->getStep2Url();

		        if($viewData["productId"] > 0)
				{			
            $viewData["pDetails"] = $this->product_model->getProduct($viewData["productId"]);
			$subArticleID = $viewData["pDetails"][0]->productTypeID;
			$viewData['donateStatus'] = $viewData["pDetails"][0]->productDonate;
			$catNarticleID = $this->product_model->getCatIdArtId($subArticleID);
			$viewData['catID']= $catNarticleID['catId'];
			$viewData['artID']= $catNarticleID['articleId'];
			$viewData['artList'] = $this->gatewaymodel->getArticleList($catNarticleID['catId']);
			$viewData['productCategoryList'] = $this->gatewaymodel->getSubArticleList($catNarticleID['articleId']);
			$viewData["pColors"] = $this->product_model->getProductColors($viewData["productId"]);
            $viewData["pFiles"] = $this->product_model->getProductFiles($viewData["productId"]);
			$viewData["show_edit"]="show";			
       		 }
       $viewData['url'] = $this->getGmailUrl();
       $viewData["addedVendorId"] = $this->session->flashdata('addedVendorId');
       $viewData['levelWiseCounter'] = $this->gatewaymodel->getLevelWiseCount();
	   $viewData['catalogueCommisson'] = $this->gatewaymodel->getCatalogueCommissionDetails($this->session->userdata('userId'));
	   $viewData['infoListing'] = $this->gatewaymodel->getMyListingDetails($this->session->userdata('userId'));
	   $viewData['totalMembersUnderMeNew'] = $this->common_model->getTotalMembersUnderMeNew($this->session->userdata('userId'));// count of member logged in to site under me added by SB on 11/12/2015
	   //print_r($viewData["show_edit"]);exit;
	   $viewData['ctUserName'] = $this->common_model->getCTuname(trim($this->session->userdata('userId')));
	  //echo "+++++".$viewData['ctUserName'];exit;
        $this->load->view('dashboard/dashboard', $viewData);
        
    }	
    public function uploadBrochureVcards($imgArray,$path,$type,$firstName) {
		unset($retData);
		
		$id= trim($this->session->userdata('userId'));	
        $retData['is_upload'] = 0;
		$originalpath='user/profilepicture/originalprofilepicture/';
		$path = $this->gatewaymodel->imageUnlinkPath().$path;	
        if($imgArray['name'] != ""){
            $allowedExts = $type;
            $temp = explode(".", $imgArray['name']);			
            $extension = strtolower(end($temp));
			
            if (($_FILES["content_image"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $imgArray['name'] = $firstName."_".trim().$id. "." . $extension;
				//trim(); select 1 picture
                $retData['is_upload'] = 1; 
                if ($imgArray["error"] > 0) {
                    $retData['status'] = 0; //error
                    $retData['errorMsg'] = 'There are error :' . $imgArray['error']; //error
                    $retData['name'] =$imgArray["name"];
                } else {
					 move_uploaded_file($imgArray["tmp_name"], $path . $imgArray['name']);	
					copy($path . $imgArray['name'], $originalpath . $imgArray['name']);
                    $retData['status'] = 1; //success
                    $retData['errorMsg'] = '';
                    $retData['name'] = $imgArray["name"];
                }
            }
        }
		
		return $retData;
    }
	//15/09/2015 ujjwal sana
	public function view() {
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
        $viewData = array();
        if ($this->session->userdata('referarId') == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        } else {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('referarId'));
        }
        if ($_REQUEST["action"] == "gmailContactImport") {
            $arr = array();
            $string = substr($_REQUEST["contactList"], 1, -1);
            $arr = explode(",", $string);
            foreach ($arr as $val) {
                $viewData["gmailContactList"][] = substr($val, 3, -3);
            }
            $viewData["contactImportStatus"] = true;
        }
        if ($_REQUEST["returnFrom"] == "PaypalSwitchOn") {
            $this->gatewaymodel->getSwitchOnPaymentResponse($this->session->userdata('userId'));
        }
        if ($_REQUEST["returnFrom"] == "PaypalEntryFees") {
            $this->gatewaymodel->getPaypalEntryFeesResponse($this->session->userdata('userId'));
        }
        if ($_REQUEST["returnFrom"] == "PaypalAfroo") {
            $this->gatewaymodel->getAfrooPaymentResponse($this->session->userdata('userId'));
        }
        if (isset($_REQUEST["resCountryCode"])) {
            if ($_REQUEST["resCountryCode"] == "CountryCodeEdited") {
                $viewData["countryCodeStatus"] = "Country Code edited succesfully";
                $viewData["countryCodeFormActivity"] = true;
            } else if ($_REQUEST["resCountryCode"] == "CountryCodeAdded") {
                $viewData["countryCodeStatus"] = "Country Code added succesfully";
                $viewData["countryCodeFormActivity"] = true;
            }
        }
        if ($_REQUEST["action"] == "subRegTCPearl") {
            $viewData["statusTcPearl"] = $this->codeSubmisssionTcPearl();
        }
        if ($_REQUEST["action"] == "subRegTCSilver") {
            $viewData["statusTcSilver"] = $this->codeSubmisssionTcSilver();
        }
        $viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
        $viewData["SwitchOnMembers"] = $this->gatewaymodel->countSwitchOnMembers($this->session->userdata('userId'));
        $viewData["mySignUps"] = $this->gatewaymodel->countMySignUps($this->session->userdata('userId'));
        $viewData["totalMembers"] = $this->gatewaymodel->countTotalMembers($this->session->userdata('userId'));
        $viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
        $viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
        $viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
        $viewData["userCountryCode"] = $this->gatewaymodel->getCountryCode($this->session->userdata('userId'));
        $viewData["parentTCPearlCode"] = $this->gatewaymodel->getTCPearlCode($this->session->userdata('referarId'));
        $viewData["parentTcSilverCode"] = $this->gatewaymodel->getTcSilverCode($this->session->userdata('referarId'));
        $viewData["parentTcSilverCode"] = $this->gatewaymodel->getTcSilverCode($this->session->userdata('referarId'));
        if ($viewData["userCountryCode"] == "United States" || $viewData["userCountryCode"] == "Canada") {
            $viewData["userTCPearlCode"] = $this->gatewaymodel->getTCPearlCode($this->session->userdata('userId'));
            $viewData["userTcSilverCode"] = $this->gatewaymodel->getTcSilverCode($this->session->userdata('userId'));
        }
        // print_r($viewData);
        // print_r($this->session->all_userdata());
        $this->load->view('dashboard/dashboard', $viewData);
    }
    public function setMessage(){
		
        $retData = array();
        $type = $this->session->flashdata('type');
        $status = $this->session->flashdata('status');
        $msg = $this->session->flashdata('msg');
		
		if($status == "email_missing")
		{
			 $retData["msg"] = "Please insert email id.";
			 $retData["type"] = $type;
		}
		if($status == "message_missing")
		{
			 $retData["msg"] = "Please Fill Up Message Box.";
			 $retData["type"] = $type;
		}
        if($status == "success"){
            if($type == "customer"){
                $retData["msg"] = "You have successfully submitted the message for Customer Services.";
            }elseif($type == "tech_support"){
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
			}
            $retData["type"] = $type;
        }
		elseif($status == "error")
			{
             if($msg != "")
			 {
                $retData["msg"] = $msg;
           	 }
			else
			{
                $retData["msg"] = "Please try again.";
            }
            $retData["type"] = "wrong";
        }
		
        return $retData;
    }

    public function profilePicUpload() {
		
        $status = 'error';
        $type = 'image';
		$id = trim($this->session->userdata('userId'));
	
        if ($this->input->post('update')) {
			
			if($_FILES["user_file"]["name"] != ""){
				$path = $this->config->item('gbe_image_upload_path').'useruploads/';
				
				$tbl = 'userinfo';
				$where['uID'] = $id;
				$selectedData = "profile";
				$data = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
				$tempImg = $data[0]->profile;
				if(file_exists($path.$tempImg)){
					unlink($path.$tempImg);
				}
				$temp = explode(".", $_FILES["user_file"]["name"]);
				$extension = strtolower(end($temp));
				$imageName = 'profile-'.$id.'-'.time() . "." . $extension;
				
				move_uploaded_file($_FILES["user_file"]["tmp_name"], $path.$imageName );
				$this->gatewaymodel->insertMemberProfilePic($imageName);
				$status = 'success';
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
    
    public function services($type = ''){
		//print_r($type);
        $status = 'error';
        if($type != ''){
            $email = $this->input->post('email');
            $message = $this->input->post('message');
            if($email != "" && $message != ""){
                $retData = 2;
                if($type == "customer"){
                    $retData = $this->sendCustomerEmailToAdmin($email,$message);
					
                }elseif($type == "tech_support"){
                    $retData = $this->sendTechsupportEmailToAdmin($email,$message);
                    $retData = $this->sendTechsupportEmailToSenabi($email,$message);
                }elseif($type == "advertise"){
                    $retData = $this->sendAdvertiseEmailToAdmin($email,$message);
                }
				
                if($retData == 1){
                    $status = 'success' ;
                }
            }
			//print_r("dddddd");
			/*if($email == "" && $message == "")
				{
					$status= 'email_missing';
				}
				if($email == "" )
				{
					$status= 'email_missing';
				}
				if($message == "" )
				{
					$status= 'message_missing';
				}*/
        }
		//print_r($status);exit;
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }
    
  public function sendCustomerEmailToAdmin($email = '', $msg = ''){
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
    
    public function sendTechsupportEmailToAdmin($email = '',$msg = ''){
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
    
    public function sendTechsupportEmailToSenabi($email = '',$msg = ''){
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
        $from_email = "admin@communitytreasures.co";
        $from_name = "communitytreasures.co";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "Bcc:admin@communitytreasures.co,testingjust100@gmail.com"."\n"; //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
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
    public function addVendors($pageId=""){
        $type = 'vUpload';
        $status = 'error';
		if($pageId>0){
			$pageId  = $this->uri->segment(3, 0);
		}
		
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
			// $vendor["forWebsite"] =3;
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
		if($pageId>0)
		{
			redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh');
		}
        else
		{
			redirect(base_url().'dashboard','refresh');
		}
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
			//$product["forWebsite"] = 3;
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
        $config['upload_path'] =$this->config->item('gbe_image_upload_path').'adminuploads/product_files/images/';
		//print_r($config);exit;
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
        $image_lib['new_image'] =$this->config->item('gbe_image_upload_path').'adminuploads/product_files/images/thumb/'.$ret['file_name'];
        $image_lib['width'] = 192;
        $image_lib['height'] = 192;
        $this->image_lib->initialize($image_lib);
        $this->image_lib->resize();
        $this->image_lib->clear();
        $tbl = 'product_files';
		// $insertImg["forWebsite"] =3; //14/09/2015 ujjwal sana
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
					 $insertImg["forWebsite"] =2;
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
        if($this->input->post('passwordUpdate') != "")
		{
            $oldPassword = trim($this->input->post('oldpassword'));
            $newPassword = trim($this->input->post('password'));
			$confirmpass=trim($this->input->post('cpassword'));
            if($userInfo[0]["password"] != $oldPassword)
			{
                $msg = "Please enter correct Old Password.";
            }
			
			
			else{
				
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
	
	public function updateProduct($pageId=""){
		//Print_r($pageId);exit;
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
		if($pageId !="")
		{
			redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh');
		}else{
			redirect(base_url()."dashboard");
		}
		
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
		//print_r($where);exit;
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
		$forwebsite=2;
		$where['id'] = trim($this->input->post('pdfEditId'));
		if($where['id'] > 0){
			$where['productId'] = $productId;
			$selectedData = "";
			$data = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
			if($data[0]->id != "" && $data[0]->fileName != ""){
				unlink($this->common_model->imageUnlinkPath().'adminuploads/product_files/pdf/'.$data[0]->fileName);
			}
			unset($data);	
			$this->common_model->deleteDataFromTable($tbl,$where,$forwebsite);
		}
		$this->addProductEventPdf($productId);
		return true;
	}
	//21-12-2015
	public function CT_catalog($CTuname) 
	{
		$viewData=array();
		$viewData["ct_userID"]=trim($this->session->userdata('userId'));
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['category_details']=$this->common_model->cate_description();
		//print_r($viewData);exit;
		//$uname="ssss";
		$this->load->view('ct_catalog/home', $viewData);
	}
	public function Beauty()
	{
		$viewData=array();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="Beauty";
		$viewData['City']=$this->common_model->getcitylist();
		//print_r($viewData);exit;
		if($this->input->post('submit') != '')
		{
			$email_Id=trim($this->input->post('emailAddr'));
			
			//$this->ct_signup($email_Id);
			$this->load->view('ct_catalog/beauty_payment', $viewData);
		}
		else
		{
			$this->load->view('ct_catalog/beauty_signup', $viewData);
		}
	}
	public function BeautyMonetizer_buy($uid="")
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();//for footer and dropdown
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();//for six monetizer
		$viewData['CT_product']=$this->common_model->Top_six_Product($uid);
		//print_r($viewData);exit;
		$this->load->view('ct_catalog/beauty_product_buy', $viewData);
	}
	public function product_view_List($productId = 0)
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['category_details']=$this->common_model->cate_description();
		$viewData['monetizer_user']=$this->common_model->getmonetizer_user();
		$viewData['monetizer_event']=$this->common_model->getEvent();
		//print_r($viewData['monetizer_user']);exit;
		if($productId != "")
		{
			$viewData['product_description']=$this->common_model->product_desc($productId);
		}else{
			$productId=236;
			$viewData['product_description']=$this->common_model->product_desc($productId);
		}
		$this->load->view('ct_catalog/Beauty_product', $viewData);
	}
	public function Meetups()
	{
		$viewData=array();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="Meetups";
		$viewData['City']=$this->common_model->getcitylist();
		if($this->input->post('submit') != '')
		{
			$this->load->view('ct_catalog/meetups_payment', $viewData);
		}
		else
		{
			$this->load->view('ct_catalog/meetups_signup', $viewData);
		}
	}
	public function Models()
	{	
		$viewData=array();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="Models";
		$viewData['City']=$this->common_model->getcitylist();
		//print_r($viewData);exit;
		if($this->input->post('submit') != '')
		{
			$this->load->view('ct_catalog/models_profile', $viewData);
		}
		else
		{
			$this->load->view('ct_catalog/models_signup', $viewData);
		}
	}
	public function Music()
	{
		$viewData=array();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="Music";
		$viewData['City']=$this->common_model->getcitylist();
		if($this->input->post('submit') != '')
		{
			$this->load->view('ct_catalog/music_payment', $viewData);
		}
		else
		{
			$this->load->view('ct_catalog/music_signup', $viewData);
		}
	}
	public function Nutri()
	{
		$viewData=array();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="Nutri";
		$viewData['City']=$this->common_model->getcitylist();
		if($this->input->post('submit') != '')
		{
			$this->load->view('ct_catalog/nutri_payment', $viewData);
		}
		else
		{
			$this->load->view('ct_catalog/nutri_signup', $viewData);
		}
	}
	//new added 6/1/2016 us
	public function RealEstate()
	{
		$viewData=array();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="RealEstate";
		$viewData['City']=$this->common_model->getcitylist();
		if($this->input->post('submit') != '')
		{
			$this->load->view('ct_catalog/Real_payment', $viewData);
		}
		else
		{
			//echo "ddd";exit;
			$this->load->view('ct_catalog/Real_signup', $viewData);
		}
	}
	
	 public function ct_signup($email_Id)
	{
		 $viewData = array();
		if($email_Id != '')
		{
			//$emailId = trim($this->input->post('email'));
			$viewData["styleStatus"] = "none";
			$this->load->library('form_validation');
			$this->form_validation->set_rules('signUpEmail', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$viewData["parentID"] = $this->getParentId();
			$viewData['name'] = "";//trim($this->input->post('signUpName'));
			$viewData['surname'] = "";
			$viewData['cellno'] = "";
			$viewData['emailAddr'] =$email_Id;
			$viewData['city'] = "";
			$viewData['skypeID'] = "";
			$viewData['userType'] = "PAYING USER";
			$viewData['password'] = '';
			if ($this->form_validation->run() == FALSE)
			 {
				 //echo "1";exit;
				$this->sendEmailToUser($viewData);
				$this->sendEmailToAdmin($viewData);				
				$msg = "success";
			 }
			else
			{	
				echo "2";exit;
				$msg = "error";
				$this->session->set_flashdata('errNameMsg',form_error('signUpName'));
				$this->session->set_flashdata('errEmailMsg',form_error('signUpEmail'));
			}
       	}
		 else
		 {
        	$msg = "error";  
		 }
		// echo "========";exit;
		 $this->session->set_flashdata('msg',$msg);
	}
	
    private function sendEmailToUser($data = array()) {
		//print_r($data['emailAddr']);exit;
        $this->_to_email = $data['emailAddr'];
		//$this->_password=$data['password'];
        $this->_subject = 'Sign up confirmation mail';
        $this->_message = '<html><body><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial; font-weight:400; text-align:justify; color:#000;" align="center">
  <tbody>
    <tr>
      <td style="font-size:12px; font-weight:bold;padding-bottom: 1%;">Community Treasures LAUNCHING IN LONDON</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">Thank you for signing up.<br/>
		  You have now been added to the Community Treasures prospects list.</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:bold;  padding-bottom: 1%;">What is Community Treasures?</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">It&acute;s impossible to say what Community Treasures is in one single word but to best describe it, is to understand its function.</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:400;  padding-bottom: 1%;">In short, Community Treasures means Global Black Enterprises.</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">This global movement is the glue uniting thousands, in a pledge to make our communities Safer and<br/> healthier while &acute; we move as one &acute; to make ourselves wealthier.</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">Our programs are designed to boost black owned businesses, entrepreneurs, mentors and services.<br/>
We provide a global platform to give vital exposure for our talented people, fashion and creative arts.<br/>
Using Our Online system Community Treasures members can create personal wealth and dramatically raise their income.
</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:400;  padding-bottom: 1%;">Our Mindset is NOT ABOUT HATRED or discrimination. we mutually respect all people of<br/> all races.</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">Community Treasures Is about coming together,  moving as one to help put an end to poverty in African<br/> 
Taking actions to finally raise the standards for black people in the western world and throughout the entire<br/> African diaspora. 
</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:bold;  padding-bottom: 1%;">On Friday February 27th <span style="font-weight:400;">2015</span></td>
    </tr>
    <tr>
      <td style="font-size:14px; font-weight:400;  padding-bottom: 1%;">Community Treasures online will be open for prospects.</td>
    </tr>
    <tr>
      <td style="font-size:10.5px;  padding-bottom: 1%;">You will be sent a reminder email allowing you to enter and create your account.</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">You will be able to use our online business to start making money and<br/> 
in London UK, Las Vegas and Los Angeles our community programs will be launched.
</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">No matter what business you do, We welcome you and we will gladly help to increase the awareness of your<br/> brand.<br/>
      There is no politics just positive action to unite and build the black economy around the world.
      </td>
    </tr>
    <tr>
      <td style="font-size:12px;  padding-bottom: 1%;">History has shown us that Divided we fall..</td>
    </tr>
    <tr>
      <td style="font-size:12px;  padding-bottom: 1%;">So whether you call yourself Black british, African, Caribbean, African American Black<br/> Canadian or any thing else,</td>
    </tr>
    <tr>
      <td style="font-size:12px;  padding-bottom: 1%;">In This Movement, United - WE STAND.</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:bold;  padding-bottom: 1%;">We Are Community Treasures</td>
	
    </tr>    
  </tbody>
</table></body></html>';
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->ct_send_mail_raw();
			return true;
        } else {
            return false;
        }
    }
       function ct_send_mail_raw()
		{
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
        $headers .= 'From: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\r\n";
        $headers .= 'Return-Path: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\n";
        $send = mail($this->_to_email, $this->_subject, $this->_message, $headers);
        if ($send) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	 private function sendEmailToAdmin($data = array()) {
        
        $this->_to_email = $this->_admin_email;
		//$this->_password=$data['password'];
        $this->_subject = "New General user Signup of Community Treasures";
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Admin,</td></tr>
								<tr><td colspan="2">Here is a new Sign up for general user details.</td></tr>
								<!--<tr><td width="25%">Name:</td><td width="75%">' . $data['name'] . '</td></tr>-->
                                
								
								
								<tr><td width="25%">Email :</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
								
                                                                   
								
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">communitytreasures.co</td></tr>
								
                           </table>';
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->ct_send_mail_raw();
            return true;
        } else {
            return false;
        }
    } /**/
 private function getParentId(){
		$parentID = trim($this->input->post('parentID'));
		 if ($parentID == 0) {
            $parentID = 1000;
            $viewData["parentID"] = $parentID;
        } else if ($parentID > 0) {
            $ustatus = $this->gatewaymodel->isMemberExist($parentID);
            if ($ustatus) {
                $viewData["parentID"] = $parentID;
            } else {
                $viewData["parentID"] = 1000;
            }
        }
		return $viewData["parentID"];
	}
	
	public function ct_index($pageId="",$pageType="",$productID="") { 
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');	
	        }
        $viewData = array();
		if($pageId>0){
			$pageId  = $this->uri->segment(3, 0);
		}
		$viewData["tabhide"] = 0;
        $viewData["msg"] = "";
		$tb1="userinfo";
		$id=trim($this->session->userdata('userId'));
     	 if ($this->session->userdata('referarId') == 0) {
			
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        } else {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('referarId'));
        }
		
		if(in_array($this->session->userdata('userType'),array("TEACHER","ADMIN"))){
            $viewData["allUser"] = $this->gatewaymodel->allMember();
		}
		elseif($this->session->userdata('userType') == 'HEAD VOLUNTEERS'){
            $viewData["allUser"] = $this->gatewaymodel->allMembersForHV();
		}else{
			$viewData["allUser"] = array();
		}
		
		$viewData['balanceInCA'] = $this->gatewaymodel->getBalanceInCA($this->session->userdata('userId'));
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
		$viewData["overView"] = $this->gatewaymodel->getOverViewOfLevel1($this->session->userdata('userType'),$this->session->userdata('userId'));//15/10/2015 ujjwal sana added 
		$viewData['massUserDetails'] = $this->gatewaymodel->getUserMassDetails($this->session->userdata('userId'));
		$viewData["categoryList"] = $this->gatewaymodel->getCategory();
        $viewData['vendorsList'] = $this->gatewaymodel->getVendorsList(trim($this->session->userdata('userId')));
		$viewData["userInfo"] = $this->gatewaymodel->getUserInfo(trim($this->session->userdata('userId')));//for ct module "B"
		//print_r($viewData["userInfo"]);exit;
		$viewData["colorList"] = $this->gatewaymodel->getColor();
        $msgTypeDetails = $this->setMessage();  
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
        //$tab = $this->setTabProduct();
        //$viewData["openTabId"] = $tab["openTabId"];
		$viewData["openTabId"]="tab6";//new added us 22/12/2015
        $viewData["productId"] = $productID;
		//print_r($viewData["productId"]);exit;
		$viewData["list"] = $this->gatewaymodel->getprofile_picture($tb1,$id);
		$viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
		$viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
		$viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
		$viewData['url'] = $this->getGmailUrl();
        $viewData["step2Url"] = $this->gatewaymodel->getStep2Url();

		        if($viewData["productId"] > 0)
				{			
            $viewData["pDetails"] = $this->product_model->getProduct($viewData["productId"]);
			$subArticleID = $viewData["pDetails"][0]->productTypeID;
			$viewData['donateStatus'] = $viewData["pDetails"][0]->productDonate;
			$catNarticleID = $this->product_model->getCatIdArtId($subArticleID);
			$viewData['catID']= $catNarticleID['catId'];
			$viewData['artID']= $catNarticleID['articleId'];
			$viewData['artList'] = $this->gatewaymodel->getArticleList($catNarticleID['catId']);
			$viewData['productCategoryList'] = $this->gatewaymodel->getSubArticleList($catNarticleID['articleId']);
			$viewData["pColors"] = $this->product_model->getProductColors($viewData["productId"]);
            $viewData["pFiles"] = $this->product_model->getProductFiles($viewData["productId"]);
			$viewData["show_edit"]="show";
       		 }
       $viewData['url'] = $this->getGmailUrl();
       $viewData["addedVendorId"] = $this->session->flashdata('addedVendorId');
       $viewData['levelWiseCounter'] = $this->gatewaymodel->getLevelWiseCount();
	   $viewData['catalogueCommisson'] = $this->gatewaymodel->getCatalogueCommissionDetails($this->session->userdata('userId'));
	   $viewData['infoListing'] = $this->gatewaymodel->getMyListingDetails($this->session->userdata('userId'));
	   $viewData['totalMembersUnderMeNew'] = $this->common_model->getTotalMembersUnderMeNew($this->session->userdata('userId'));// count of member logged in to site under me added by SB on 11/12/2015
	   $viewData['sponcer_pic']=$this->common_model->getCtSponcerPicture($this->session->userdata('userId'));
	   $viewData['source_pic']=$this->common_model->getCtSourcePicture($pageId);
	   //print_r($viewData['source_pic']);exit;
		if($pageId != '')
		{
		   if($pageId == 1)
		   {
			   $viewData['ct_url']="BEAUTY SUITE";
			   $viewData['ct_product']="BeautyMonetizer_buy/";
		   }
		   else if($pageId == 2)
		   {
			   $viewData['ct_url']="MEETUPS SUITE";
			   $viewData['ct_product']="meetsup_buy";
		   }else if($pageId == 3)
		   {
			   $viewData['ct_url']="MODELS SUITE";
			   $viewData['ct_product']="models_buy";
		   }else if($pageId == 4)
		   {
			   $viewData['ct_url']="MUSIC SUITE";
			   $viewData['ct_product']="nutri_buy";
		   }else if($pageId == 5)
		   {
			   $viewData['ct_url']="NUTRI SUITE";
			   $viewData['ct_product']="nutri_buy";
		   }else if($pageId == 6)
		   {
			    $viewData['ct_url']="Real Estate";
				$viewData['ct_product']="real_buy";
		   }
			$viewData['ct_pageId']=$pageId;
			if($pageType!=""){
				if($pageType == "edit"){
					$viewData['pag']="show_edit";
				}
			}
			
	   }
		//print_r($viewData);exit;
        $this->load->view('dashboard/dashboard', $viewData);
        
    }
	
	public function updateUserInfo($pageId=""){
		 $type = 'STEP1A';
		$status = 'error';
		if($pageId>0){
					$pageId  = $this->uri->segment(3, 0);
				}
		if($this->input->post('update') != ""){
			$emailCheck = $this->uniqueEmailCheckingAjax();
			$upData['emailID'] = trim($this->input->post('emailID'));
			if($emailCheck == 0){
				$upData['skypeID'] = trim($this->input->post('skypeID'));
				$upData['phone'] = trim($this->input->post('phone'));
				$upData['facebookLink'] = trim($this->input->post('facebookLink'));
				$upData['myBlogger'] = trim($this->input->post('myBlogger'));
				$upData['twitterLink'] = trim($this->input->post('twitterLink'));
				$upData['youTubeUrl'] = trim($this->input->post('youTubeUrl'));
				$imgData = $this->profileImageUpload();
				
				if($imgData['status'] == 3){
					$upData['profile'] = $imgData['profile'];	
				}
				$tbl = 'userinfo';
				$where = array("uID"=>$this->session->userdata('userId'));
				$this->common_model->updateDataToTable($tbl, $where, $upData);
				unset($upData);unset($where);unset($tbl);
				$msg = "You have successfully updated your data.";
			}else{
				$msg = "Email '".$upData['emailID']."' is already used.Please try with another email.";
			}
		}
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh');
		
		
	}
	public function uniqueEmailCheckingAjax(){
		$email = trim($this->input->post('emailID'));
		$emailType = trim($this->input->post("emailType"));
		$uID = $this->session->userdata('userId');
		if($emailType == 1){
			echo $this->fullmembers_model->checkEmailExist($email,$uID);
		}elseif($emailType == 2){
			
			return $this->fullmembers_model->checkEmailExist($email,$uID);
		}
	}
	public function profileImageUpload(){
		$retData['status'] = 1;
		$retData['profile'] = '';
		if ($_FILES['profile']['name'] != "") {
			$allowedExts = array("jpg","png","jpeg");
			$temp = explode(".", $_FILES["profile"]["name"]);
			$extension = strtolower(end($temp));
			if (($_FILES["profile"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
				$_FILES["profile"]["name"] = 'profile-'.$this->userId.'-'.time() . "." . $extension;
				if ($_FILES["profile"]["error"] > 0) {
					$retData['status'] = 2;
				}else{
					$path = $this->config->item('gbe_image_upload_path').'useruploads/';
					//$this->common_model->imageUnlinkPath()."useruploads/";
					
					move_uploaded_file($_FILES["profile"]["tmp_name"], $path.$_FILES["profile"]["name"]);

					$tempImg = trim($this->input->post('tempImage'));
					if(file_exists($path.$tempImg)){
						unlink($path.$tempImg);
					}
					$retData['profile'] = $_FILES["profile"]["name"];
					$retData['status'] = 3;
				}
			}else{
				$retData['status'] = 2;
			}
		}
		return $retData;
	}
	
	public function ct_nutri_product($productId = 0)
	{
		/* $viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['category_details']=$this->common_model->cate_description();
		$this->load->view('ct_catalog/nutri_product', $viewData); */
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();//footer and dropdown
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();//all monetizer
		$viewData['category_details']=$this->common_model->cate_description();//show left side menu
		$viewData['monetizer_user']=$this->common_model->getmonetizer_user();//show thumble image
		$viewData['monetizer_event']=$this->common_model->getEvent();
		//print_r($viewData['monetizer_user']);exit;
		if($productId != "")
		{
			$viewData['product_description']=$this->common_model->product_desc($productId);//show body content
		}else{
			$productId=236;
			$viewData['product_description']=$this->common_model->product_desc($productId);
		}
		$this->load->view('ct_catalog/nutri_product', $viewData);
	}
 public function ct_meetsup_product($productId = 0)
	{
		/* $viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['category_details']=$this->common_model->cate_description();
		$this->load->view('ct_catalog/meetups_product', $viewData); */
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();//footer and dropdown
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();//all monetizer
		$viewData['category_details']=$this->common_model->cate_description();//show left side menu
		$viewData['monetizer_user']=$this->common_model->getmonetizer_user();//show thumble image
		$viewData['monetizer_event']=$this->common_model->getEvent();
		//print_r($viewData['monetizer_user']);exit;
		if($productId != "")
		{
			$viewData['product_description']=$this->common_model->product_desc($productId);//show body content
		}else{
			$productId=236;
			$viewData['product_description']=$this->common_model->product_desc($productId);
		}
		//print_r($viewData['monetizer_user']);exit;
		$this->load->view('ct_catalog/meetups_product', $viewData);
	} 
	public function ct_models_product($productId = 0)
	{
		/* $viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['category_details']=$this->common_model->cate_description();
		$this->load->view('ct_catalog/models_product', $viewData); */		
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();//footer and dropdown
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();//all monetizer
		$viewData['category_details']=$this->common_model->cate_description();//show left side menu
		$viewData['monetizer_user']=$this->common_model->getmonetizer_user();//show thumble image
		$viewData['monetizer_event']=$this->common_model->getEvent();
		//print_r($viewData['monetizer_user']);exit;
		if($productId != "")
		{
			$viewData['product_description']=$this->common_model->product_desc($productId);//show body content
		}else{
			$productId=236;
			$viewData['product_description']=$this->common_model->product_desc($productId);
		}
		$this->load->view('ct_catalog/models_product', $viewData);
	}
	public function ct_music_product($productId = 0)
	{
		/* $viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['category_details']=$this->common_model->cate_description();
		$this->load->view('ct_catalog/music_product', $viewData); */
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();//footer and dropdown
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();//all monetizer
		$viewData['category_details']=$this->common_model->cate_description();//show left side menu
		$viewData['monetizer_user']=$this->common_model->getmonetizer_user();//show thumble image
		$viewData['monetizer_event']=$this->common_model->getEvent();
		//print_r($viewData['monetizer_user']);exit;
		if($productId != "")
		{
			$viewData['product_description']=$this->common_model->product_desc($productId);//show body content
		}else{
			$productId=236;
			$viewData['product_description']=$this->common_model->product_desc($productId);
		}
		$this->load->view('ct_catalog/music_product', $viewData);
	}
	public function ct_realestate_product($productId = 0)
	{
		/* $viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['category_details']=$this->common_model->cate_description();
		$this->load->view('ct_catalog/Real_product', $viewData); */
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();//footer and dropdown
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();//all monetizer
		$viewData['category_details']=$this->common_model->cate_description();//show left side menu
		$viewData['monetizer_user']=$this->common_model->getmonetizer_user();//show thumble image
		$viewData['monetizer_event']=$this->common_model->getEvent();
		//print_r($viewData['monetizer_event']);exit;
		if($productId != "")
		{
			$viewData['product_description']=$this->common_model->product_desc($productId);//show body content
		}else{
			$productId=236;
			$viewData['product_description']=$this->common_model->product_desc($productId);
		}
		//print_r($viewData);exit;
		$this->load->view('ct_catalog/Real_product', $viewData);
	}
	
	
	
	public function nutri_buy($uid="")
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['CT_product']=$this->common_model->Top_six_Product($uid);
		$this->load->view('ct_catalog/nutri_product_buy', $viewData);
	}
	public function meetsup_buy($uid="",$next= 0)
	{
		$viewData=array();
		//print_r($next);exit;
		$viewData['CT_userId']=$this->session->userdata('userId');
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['CT_product']=$this->common_model->Top_six_Product($uid);
		$viewData['next']=$next;
		//print_r($viewData);exit;
		$this->load->view('ct_catalog/meetups_product_buy', $viewData);
	}
	public function models_buy($uid="")
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['CT_product']=$this->common_model->Top_six_Product($uid);
		$this->load->view('ct_catalog/models_product_buy', $viewData);
	}
	public function music_buy($uid="")
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_product']=$this->common_model->Top_six_Product($uid);
		$this->load->view('ct_catalog/music_product_buy', $viewData);
	}
	public function real_buy($uid="")
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['CT_product']=$this->common_model->Top_six_Product($uid);
		$this->load->view('ct_catalog/Real_product_buy', $viewData);
	} 
	 
    public function CT_profilePicUpload($pageId="") {
		
        $status = 'error';
        $type = 'image';
		$id = trim($this->session->userdata('userId'));
        if ($this->input->post('update')) {
			if($_FILES["user_file"]["name"] != ""){
				$path = $this->config->item('gbe_image_upload_path').'CT_sponcer_img/';
				$tbl = 'ct_sponcers';
				$where['uID'] = $id;
				$selectedData = "images";
				$data = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
				$tempImg = $data[0]->images;
				//Print_r($tempImg);exit;
				if(file_exists($path.$tempImg)){
					unlink($path.$tempImg);
					$this->common_model->deleteSponcerProfilePic($id);
				}
				$temp = explode(".", $_FILES["user_file"]["name"]);
				$extension = strtolower(end($temp));
				$imageName = 'profile-'.$id.'-'.time() . "." . $extension;
				move_uploaded_file($_FILES["user_file"]["tmp_name"], $path.$imageName );
				$id=$this->gatewaymodel->insertSponcerProfilePic($imageName);
				//print_r($id);exit;
				if($id!="")
				{
					$status = 'success';
				}else{
					$status = 'error';
				}
				
			}
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh');
    } 
	public function ct_editProduct($productId= 0,$pageId=""){
		/* if($productId > 0)
		{
			$this->session->set_flashdata('openTabId','tab4');
			$this->session->set_flashdata('productId',$productId);
		} */
			$pageType="edit";
			redirect(base_url().'dashboard/ct_index/'.$pageId.'/'.$pageType.'/'.$productId,'refresh');
	}
	public function CT_ModelInfo($pageId=""){
		 $type = 'STEP1A';
		$status = 'error';
		//print_r();exit;
		$this->sign_up_user_type = "PAYING USER";
		if($pageId>0){
					$pageId  = $this->uri->segment(3, 0);
				}
		if($this->input->post('update') != "")
		{
			//$emailCheck = $this->uniqueEmailCheckingAjax();
			$emailCheck = trim($this->input->post('emailID'));
			if($emailCheck != "")
			{
				
				//$imgData = $this->profileImageUpload();
				// $this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
           // $this->form_validation->set_rules('city', 'City', 'trim|required');
            $upData['firstName'] = trim($this->input->post('fname'));
            $upData['lastName'] = trim($this->input->post('lname'));
            $upData['phone'] = trim($this->input->post('phno'));
            $upData['emailID'] = trim($this->input->post('email'));
			 $upData['city'] = trim($this->input->post('city'));
            $upData['city'] = trim($this->input->post('emailID'));
			$upData['country'] = trim($this->input->post('country'));
            $upData['userType'] = $this->sign_up_user_type;
            $upData['password'] = '';//$this->generatePassword();
			$upData['forWebsite'] = $this->forWebsite;
			$imgData = $this->profileImageUpload();
				$ss=$this->session->userdata('userId');
			if($imgData['status'] == 3)
			{
				$upData['profile'] = $imgData['profile'];	
			}
				$tbl = 'userinfo';
				$where = array("uID"=>$this->session->userdata('userId'));
				$this->common_model->updateDataToTable($tbl, $where, $upData);
				unset($upData);unset($where);unset($tbl);
				$msg = "You have successfully updated your data.";
			}
			else
			{
				$msg = "Email '".$upData['emailID']."' is already used.Please try with another email.";
			}
			$this->session->set_flashdata('type',$type);
			$this->session->set_flashdata('status',$status);
			$this->session->set_flashdata('msg',$msg);
			$this->load->view('ct_catalog/models_payment', $upData);
		}
		else{
		
			$this->load->view('ct_catalog/models_profile', $upData);
		}
	}
		public function CT_MusicInfo($pageId=""){
		 $type = 'STEP1A';
		$status = 'error';
		//print_r();exit;
		$this->sign_up_user_type = "PAYING USER";
		if($pageId>0){
					$pageId  = $this->uri->segment(3, 0);
				}
		if($this->input->post('update') != ""){
			//$emailCheck = $this->uniqueEmailCheckingAjax();
			$emailCheck = trim($this->input->post('emailID'));
			if($emailCheck != ""){
				
				//$imgData = $this->profileImageUpload();
				// $this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
           // $this->form_validation->set_rules('city', 'City', 'trim|required');
            $upData['firstName'] = trim($this->input->post('fname'));
            $upData['lastName'] = trim($this->input->post('lname'));
            $upData['phone'] = trim($this->input->post('phno'));
            $upData['emailID'] = trim($this->input->post('emailID'));
            $upData['city'] = trim($this->input->post('city'));
			$upData['country'] = trim($this->input->post('country'));
            $upData['userType'] = $this->sign_up_user_type;
            $upData['password'] = '';//$this->generatePassword();
			$upData['forWebsite'] = $this->forWebsite;
			$imgData = $this->profileImageUpload();
				$ss=$this->session->userdata('userId');
			if($imgData['status'] == 3){
				$upData['profile'] = $imgData['profile'];	
			}
			//print_r($upData);exit;
				$tbl = 'userinfo';
				$where = array("uID"=>$this->session->userdata('userId'));
				$this->common_model->updateDataToTable($tbl, $where, $upData);
				unset($upData);unset($where);unset($tbl);
				$msg = "You have successfully updated your data.";
			}else{
				$msg = "Email '".$upData['emailID']."' is already used.Please try with another email.";
			}
			$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('msg',$msg);
		$this->load->view('ct_catalog/music_payment', $upData);
		}else{
		
		$this->load->view('ct_catalog/music_profile', $upData);
		}
	}
	public function view_detail($eventID){
		$viewData=array();
		$viewData['event']=$this->common_model->event_details($eventID);
		//print_r($viewData);exit;
		$this->load->view('ct_catalog/view_details', $viewData);
	}
	public function CT_TopsixInfo($pageId="")//top six product upload
	{
		 $type = 'STEP1A';
		 $status = 'error';
		 $msg = 'error';
		if($pageId>0){
					$pageId  = $this->uri->segment(3, 0);
				}
		if($this->input->post('update') != "")
		{
				//$imgData = $this->profileImageUpload();
				// $this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
           // $this->form_validation->set_rules('city', 'City', 'trim|required');
            $upData['house_for_sale'] = trim($this->input->post('house_for_sale'));
            $upData['city'] = trim($this->input->post('city'));
            $upData['address'] = trim($this->input->post('area_name'));
            $upData['zipcode'] = trim($this->input->post('zip_codes'));
			$upData['bedrooms'] = trim($this->input->post('bedrooms'));
            $upData['bathrooms'] = trim($this->input->post('bathrooms'));
			$upData['receptions'] = trim($this->input->post('receptions'));
            $upData['sq_ft'] = trim($this->input->post('sq_ft'));
			$upData['addedBy'] = trim($this->session->userdata('userId'));
			$imgData = $this->CT_top_six_product_upload();
			if($imgData['status'] == 3)
			{
				$upData['p_img'] = $imgData['profile'];	
			}
			$tbl = 'top_seven_product';
			$productId = $this->common_model->insertDataToTable($tbl,$upData);
			unset($product);unset($tbl);
			if($productId > 0)
			{
				$msg = "You have successfully updated your data.";	
				
           	}
			else{
				$msg = "Data not uploaded.";
			}
			
		}
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh');
	}
	public function CT_top_six_product_upload(){
		$retData['status'] = 1;
		$retData['profile'] = '';
		if ($_FILES['profile']['name'] != "") {
			$allowedExts = array("jpg","png","jpeg");
			$temp = explode(".", $_FILES["profile"]["name"]);
			$uid= trim($this->session->userdata('userId'));
			$extension = strtolower(end($temp));
			if (($_FILES["profile"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
				$_FILES["profile"]["name"] = 'profile-'.$uid.'-'.time() . "." . $extension;
				if ($_FILES["profile"]["error"] > 0) {
					$retData['status'] = 2;
				}else{
					$path = $this->config->item('gbe_image_upload_path').'topsixproduct/';
					//$this->common_model->imageUnlinkPath()."useruploads/";
					move_uploaded_file($_FILES["profile"]["tmp_name"], $path.$_FILES["profile"]["name"]);
					/* $tempImg = trim($this->input->post('tempImage'));
					if(file_exists($path.$tempImg)){
						unlink($path.$tempImg);
					} */
					$retData['profile'] = $_FILES["profile"]["name"];
					$retData['status'] = 3;
				}
			}else{
				$retData['status'] = 2;
			}
		}
		return $retData;
	}
	//new for admin
	public function ctadminmusic(){
		$this->load->view('ct_catalog/music_profile', $upData);
	}
	public function ctadminmodel(){
		$this->load->view('ct_catalog/models_profile', $upData);
	}
	public function ctadminbeauty(){
		$this->load->view('ct_catalog/beauty_payment', $upData);
	}
	public function ctadminnutri(){
		$this->load->view('ct_catalog/nutri_payment', $upData);
	}
	public function ctadminreal(){
		$this->load->view('ct_catalog/Real_payment', $upData);
	}
	public function ctadminmeetsup(){
		$this->load->view('ct_catalog/meetups_payment', $upData);
	}
	
	// rave share related function start //
	
	 public function raveShareHome() { 
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');	
	        } 
		$viewData = array();
		$msgTypeDetails = $this->setMessageRave();  
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
		//echo "++++++".base_url();
		$viewData["userInfo"] = $this->gatewaymodel->getUserInfoRave($this->session->userdata('userId'));
		//print_r($viewData["userInfo"]);
		//echo "++".$viewData["userInfo"][0]['raveType'];
		$this->session->set_userdata('raveType', $viewData["userInfo"][0]['raveType']);
		$level = $viewData["userInfo"][0]['userLevel'];
		$viewData['myCurrPosition'] = $this->gatewaymodel->myCurrPosition($this->session->userdata('userId'),$level);
		// check user not purchase catalogueCommisson
		$viewData['catPurDueUser'] = $this->gatewaymodel->getUserNotPurchaseCatalog();
		//print_r($viewData['catPurDueUser']);
			
		$this->load->view('raveshare/home', $viewData);
	 }
	 
	 
	 public function inviteUser(){ 
		//Print_r($pageId);exit;
		$type = 'inviteUser';
        $status = 'error';
		if($this->input->post('sendInvitation') != ''){			
			$userId = $this->session->userdata('userId');
			$userEmail = trim($this->input->post('userEmail'));
            if($userEmail != ""){               
               // $status = 'success';
				$data= array();
				$data['emailID']= $userEmail;
				$data['refererId']= $userId;
				//$data['refererId']= $_SESSION['userId'];
				$this->sendInviMailToUser($data);

				// add user to rave table 
				$viewData= array();
				$viewData["referarID"] = $userId;
				$viewData['firstName'] = "";
				$viewData['lastName'] = "";
				$viewData['phone'] = "";
				$viewData['emailID'] = $userEmail;
				$viewData['city'] = "";
				$viewData['skypeID'] = "";
				$viewData['userType'] = "PAYING USER";
				$viewData['password'] = "123456";
				$viewData['forWebsite'] = 2;
				$tbl = 'rave_userinfo';
			    $raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$viewData);
				if($raveSignUpId){
					// my raveshare type 
					$myRaveType = $this->gatewaymodel->getMyRaveAccType($userId);
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveSignUpId;
					$typeData['raveType'] =$myRaveType;// my Type
					$raveSignUpId = $this->common_model->insertDataToTable($tblType,$typeData);
				}
            }
        }
		$this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
		redirect(base_url()."dashboard/raveShareHome", 'refresh');		
		
	}
	
	//add group user 
	public function inviteGroupUser(){ 
		//Print_r($pageId);exit;
		$type = 'inviteUser';
        $status = 'error';
		if($this->input->post('sendGroupInvitation') != ''){			
			$userId = $this->session->userdata('userId');
			$userName = trim($this->input->post('groupUserName'));
			$groupCount = 10;
			for($i=1;$i<=$groupCount;$i++){
				$userEmail = strtolower($userName).$i."@gmail.com";
						
				if($userEmail != ""){               
				   // $status = 'success';
					$data= array();
					$data['emailID']= $userEmail;
					$data['refererId']= $userId;
					//$data['refererId']= $_SESSION['userId'];
					$this->sendInviMailToUser($data);

					// add user to rave table 
					$viewData= array();
					$viewData["referarID"] = $userId;
					$viewData['firstName'] = "";
					$viewData['lastName'] = "";
					$viewData['phone'] = "";
					$viewData['emailID'] = $userEmail;
					$viewData['city'] = "";
					$viewData['skypeID'] = "";
					$viewData['userType'] = "PAYING USER";
					$viewData['password'] = "123456";
					$viewData['forWebsite'] = 2;
					$tbl = 'rave_userinfo';
					$raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$viewData);
					if($raveSignUpId){
						// my raveshare type 
						$myRaveType = $this->gatewaymodel->getMyRaveAccType($userId);
						$tblType = 'user_raveshare_type';
						$typeData =array();
						$typeData['user_id'] =$raveSignUpId;
						$typeData['raveType'] =$myRaveType;// my Type
						$raveSignUpId = $this->common_model->insertDataToTable($tblType,$typeData);
					}
				}
			}
        }
		$this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
		redirect(base_url()."dashboard/raveShareHome", 'refresh');		
		
	}
	// send invitation link mail to user
	private function sendInviMailToUser($data = array()) {
        
        $this->_to_email = $data['emailID'];
		$refererId 		 = $data['refererId'];
		//$this->_password=$data['password'];
        $this->_subject = "Signup Invitation";
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello ,<td></tr>
								<tr><td colspan="2">Here is your Signup Invitation Link below.<td></tr>
								
								<tr><td colspan="2">Please <a href="'.base_url().'ravesignup/'.$refererId.'" >click </a>here to signup </td></tr>
								<tr><td colspan="2"> Your Signup Link : '.base_url().'ravesignup/'.$refererId.'</td></tr>
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">communitytreasures.co</td></tr>
								
                           </table>';
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
    }
	
	public function setMessageRave(){
		
        $retData = array();
        $type = $this->session->flashdata('type');
        $status = $this->session->flashdata('status');
        $msg = $this->session->flashdata('msg');
		
		if($status == "email_missing")
		{
			 $retData["msg"] = "Please insert email id.";
			 $retData["type"] = $type;
		}
		
        if($status == "success"){
            if($type == "inviteUser"){
                $retData["msg"] = "Invitation send successfully.";
            }elseif($type == "tech_support"){
                $retData["msg"] = "You have successfully submitted the message for Technical Support.";
            }elseif($type == "pUploadUpdate"){
				$retData["msg"] = "You have been successfully updated your product details.";
			}
            $retData["type"] = $type;
        }
		elseif($status == "error")
			{
             if($msg != "")
			 {
                $retData["msg"] = $msg;
           	 }
			else
			{
                $retData["msg"] = "Please try again.";
            }
            $retData["type"] = "wrong";
        }
		
        return $retData;
    }
	public function cataloguePurchase(){
		
		$userId   = $this->session->userdata('userId');
		$raveType = $this->session->userdata('raveType');
		if($userId!= ""){
				//echo "=====".$this->session->userdata('userId');
				$catLogPrice		= 40;
				$compShare			= 24; // added by SB on 11-08-2016
				$contingentCom 		= 2.26; // added by Sb on 11-08-2016
				// success payment update user level 1
				$paymentStatus = 1;
				if($paymentStatus == 1){
					$tbl = 'rave_userinfo';
					$where = array("uID"=>$userId);
					$data = array("userLevel"=>1,"afrooPaymentStatus"=>1) ;
					$update = $this->common_model->updateDataToTable($tbl, $where, $data );
					
					if($update){
						// fetch level 1 top member
						$level =1;// level wise check top mem
						$topMember = $this->gatewaymodel->getTopMember($level);
						// echo count($topMember);
						// insert my data to rave_share table
						$myPosition = 0; 						
					    if(count($topMember)>0){							
							$myParent   = $topMember[0]['user_id'];
						 }
						 else
						 {							
							$myParent   = 0; // admin
						 }
						 // insert data to rave share
						 $insData = array();
						 $insData['user_id']      = $userId;
						 $insData['parentId']     = $myParent;
						 $insData['level']        = $level;
						 $insData['userPosition'] = $myPosition;						 
						 $insData['creationDate'] = date('Y-m-d');
						 $insData['status'] 	  = 1;
						 $insData['amount'] 	  = 0;
						 $insData['counter'] 	  = 0;
						
						 $tblshare = 'rave_share';
						 $insertId = $this->common_model->insertDataToTable($tblshare,$insData);
						 if($insertId){
														 
							 // add admin share detail to log transaction
							 $instLog 				= array();
							 $instLog['note'] 		= "Catalog Purchase commission to Admin from userId-".$userId;
							 $instLog['action'] 	= "+";
							 $instLog['amount'] 	= $catLogPrice;
							 $instLog['tranDate'] 	=  date('Y-m-d');
							 $tblLog 				= 'raveTransactionLog';
						     $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
							 
							 // add amount to company Account  added by SB on 11-08-2016
							 $instcompAcct = array();
							 $instcompAcct['userId'] 		= $userId;
							 $instcompAcct['userLevel'] 	= $level;
							 $instcompAcct['compShare'] 	= $compShare;
							 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
							 $instcompAcct['commDate'] 		= date('Y-m-d');
							 $tblCompAcct 					= 'rave_companyAccount';
						     $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
							 
							 // add Contingent amount to company Account  added by SB on 11-08-2016
							 $instContigent = array();
							 $instContigent['userId'] 		= $userId;
							 $instContigent['userLevel'] 	= $level;
							 $instContigent['compShare'] 	= $contingentCom;
							 $instContigent['shareFor'] 	= 'C';// J joining commission , C Contingent
							 $instContigent['commDate'] 	= date('Y-m-d');
							 $tblContigent					= 'rave_companyAccount';
						     $insertContigent				= $this->common_model->insertDataToTable($tblContigent,$instContigent);
							 
							 // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
							 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId);
							 if(count($paidUser)>0){
								// check my cap
								$today = date('Y-m-d'); 
								foreach($paidUser as $paidUsers){
									$validUser ='';
									$validUser = $paidUsers['user_id'];
									$capTableUserCount = $this->gatewaymodel->checkMemCount($level,$today,$validUser);
									if($capTableUserCount==0){
										// insert user to captable
										$capRecordAdded =  $this->gatewaymodel->insertCapRecord($level,$today,$validUser);
									}
									else{
										//update user member count
										$capRecordAdded =  $this->gatewaymodel->updateCapRecord($level,$today,$validUser);
									}
								}
							   
							 }
							  //fetch all user eligible for commission
							  $commMemberList = $this->gatewaymodel->getCommMember($level);
							  $noPositionChangeUser = array();
							 // $noPositionChangeUser[]=$userId;
							  foreach($commMemberList as $commMemberDetail){
								  $checkCapStatus=0;
								  $userlevel =$commMemberDetail['level'];
								  $today = date('Y-m-d');
								  $commMember = $commMemberDetail['user_id'];
								 // $checkCapStatus = $this->gatewaymodel->checkMemCount($userlevel,$today,$commMember);// blocked cap checking on 23/05/2016
								 								  
								  if($checkCapStatus>10){
										 //no commision to top member
										 $noPositionChangeUser[] = $commMember;
									 }
									 else
									{
										 if($commMember!=0){
											
												$activeCom=8;//4
												$founderCom=3.74; //1.88
												
												if($commMemberDetail['raveType']=="Active"){
																																				
													$commToUserAboveMe 	= $activeCom;// Active User commission Amount for other Cycle
													
												}else{
													
													$commToUserAboveMe 	= $activeCom+$founderCom;// Founder commission Amount for other Cycle
													
												}
											 //referral commission to referrar as per level user  
												if($userlevel==1){
													$commToInviter		= 2;//1 // commission to inviter of level 1
												}
												else if($userlevel==2){
													$commToInviter		= 0.94; // commission to inviter of level 2
												}
										 // add commision to top member
										 $counterVal =1;
										 $comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal);
										 // echo "==".$comAddedToTopMem;
											 if($comAddedToTopMem){
												 // add Top Member share detail to log transaction
												 $instLogAboveMe 				= array();
												 $instLogAboveMe['note'] 		= "Catalog Purchase commission from Admin to ParentUser-".$commMember;
												 $instLogAboveMe['action'] 		= "-";
												 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
												 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
												 
												 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
												 
												  // add reference comission to my top member also
												  // fetch my parent Referer													
													$refererUserDetail = $this->gatewaymodel->getMyReferer($commMember);
													//if inviter other than admin (referarID!=1000) add commission to inviter
													if(count($refererUserDetail)>0){
														$counterRefVal 		= 0;
														$refererUserId 		= $refererUserDetail[0]['referarID'];
														$refererUserLevel 	= $refererUserDetail[0]['userLevel'];
														$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal);
														//if inviter other than admin (referarID=1000) add commission to inviter
														 if($refComDone){
															 $instLogRef 				= array();
															 $instLogRef['note'] 		= "Catalog Purchase commission from Admin to RefererUser-".$refererUserId;
															 $instLogRef['action'] 		= "-";
															 $instLogRef['amount'] 		= $commToInviter;
															 $instLogRef['tranDate'] 	= $today;
															 $insertLogRef =$this->gatewaymodel->tranRecordInter($instLogRef);
															// referral detail insert in referral table
															 $refDetail 				= array();
															 $refDetail['myReferrer']   = $refererUserId;
															 $refDetail['referrerLevel']= $refererUserLevel;
															 $refDetail['userId']   	= $commMember;
															 $refDetail['invtAmt']  	= $commToInviter;
															 $refDetail['refCommDate']  = date('Y-m-d');
															 $refDetail['refCommCount'] = 1;
															 $tblRefDetail 				= 'rave_referralDetail';
															 //  fetch referal detail exist or not
															 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel);
																	
															 // insert Level wise referral commission
															 if($refDataExist==0){
																$insertrefDetail 			= $this->common_model->insertDataToTable($tblRefDetail,$refDetail);
															 }
															 else{
																  // Update Level wise referral commission
																 
																 $updateRefDetail  			= $this->gatewaymodel->updateRefData($refDataExist,$refDetail);
															 }
															 
														 }
													}
															
											 }
										  }
									}
								  
							  }
							//move user position other than new  user& caped user
								//rest update all userPosition by +1
							$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($level,$noPositionChangeUser);
								//$noPositionChangeUser
							
							
						 }
						
				     }										
				}
				
				$val = array("success" => "yes","message"=>'Catalog Purchase Sucessfully');
			}
			else
			{
				$val=array("success" => "No","message"=>'Session Out');
			}
		
		$output = json_encode($val);
		echo $output;
	}
		
		
		
	public function groupCataloguePurchase(){
		
		$catPurDueUser = $this->gatewaymodel->getUserNotPurchaseCatalog();
		if(count($catPurDueUser)>0){
			$userCount=0;
			foreach($catPurDueUser as $catPurDueUserDetail){
				$userCount++;
				$userId='';
				$raveType ='';
			
				$userId   = $catPurDueUserDetail['uID'];// $this->session->userdata('userId');
				$raveType = $catPurDueUserDetail['raveType'];//$this->session->userdata('raveType');
				if($userId!= ""){
						//echo "=====".$this->session->userdata('userId');
						$catLogPrice		= 40;
						$compShare			= 24; // added by SB on 11-08-2016
						$contingentCom 		= 2.26; // added by Sb on 11-08-2016
						// success payment update user level 1
						$paymentStatus = 1;
						if($paymentStatus == 1){
							$tbl = 'rave_userinfo';
							$where = array("uID"=>$userId);
							$data = array("userLevel"=>1,"afrooPaymentStatus"=>1) ;
							$update = $this->common_model->updateDataToTable($tbl, $where, $data );
							
							if($update){
								// fetch level 1 top member
								$level =1;// level wise check top member
								$topMember = $this->gatewaymodel->getTopMember($level);
								// echo count($topMember);
								// insert my data to rave_share table
								$myPosition = 0; 						
								if(count($topMember)>0){							
									$myParent   = $topMember[0]['user_id'];
								 }
								 else
								 {							
									$myParent   = 0; // admin
								 }
								 // insert data to rave share
								 $insData = array();
								 $insData['user_id']      = $userId;
								 $insData['parentId']     = $myParent;
								 $insData['level']        = $level;
								 $insData['userPosition'] = $myPosition;						 
								 $insData['creationDate'] = date('Y-m-d');
								 $insData['status'] 	  = 1;
								 $insData['amount'] 	  = 0;
								 $insData['counter'] 	  = 0;
								
								 $tblshare = 'rave_share';
								 $insertId = $this->common_model->insertDataToTable($tblshare,$insData);
								 if($insertId){
																 
									 // add admin share detail to log transaction
									 $instLog 				= array();
									 $instLog['note'] 		= "Catalog Purchase commission to Admin from userId-".$userId;
									 $instLog['action'] 	= "+";
									 $instLog['amount'] 	= $catLogPrice;
									 $instLog['tranDate'] 	=  date('Y-m-d');
									 $tblLog 				= 'raveTransactionLog';
									 $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
									 
									// add amount to company Account  added by SB on 11-08-2016
									 $instcompAcct = array();
									 $instcompAcct['userId'] 		= $userId;
									 $instcompAcct['userLevel'] 	= $level;
									 $instcompAcct['compShare'] 	= $compShare;
									 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
									 $instcompAcct['commDate'] 		= date('Y-m-d');
									 $tblCompAcct 					= 'rave_companyAccount';
									 $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
									 
									 // add Contingent amount to company Account  added by SB on 11-08-2016
									 $instContigent = array();
									 $instContigent['userId'] 		= $userId;
									 $instContigent['userLevel'] 	= $level;
									 $instContigent['compShare'] 	= $contingentCom;
									 $instContigent['shareFor'] 	= 'C';// J joining commission , C Contingent
									 $instContigent['commDate'] 	= date('Y-m-d');
									 $tblContigent					= 'rave_companyAccount';
									 $insertContigent				= $this->common_model->insertDataToTable($tblContigent,$instContigent);
									 
									 
									 // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
									 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId);
									 if(count($paidUser)>0){
										// check my cap
										$today = date('Y-m-d'); 
										foreach($paidUser as $paidUsers){
											$validUser ='';
											$validUser = $paidUsers['user_id'];
											$capTableUserCount = $this->gatewaymodel->checkMemCount($level,$today,$validUser);
											if($capTableUserCount==0){
												// insert user to captable
												$capRecordAdded =  $this->gatewaymodel->insertCapRecord($level,$today,$validUser);
											}
											else{
												//update user member count
												$capRecordAdded =  $this->gatewaymodel->updateCapRecord($level,$today,$validUser);
											}
										}
									   
									 }
									  //fetch all user eligible for commission
									  $commMemberList = $this->gatewaymodel->getCommMember($level);
									  $noPositionChangeUser = array();
									 // $noPositionChangeUser[]=$userId;
									  foreach($commMemberList as $commMemberDetail){
										  $checkCapStatus=0;
										  $userlevel =$commMemberDetail['level'];
										  $today = date('Y-m-d');
										  $commMember = $commMemberDetail['user_id'];
										 // $checkCapStatus = $this->gatewaymodel->checkMemCount($userlevel,$today,$commMember);// blocked cap checking on 23/05/2016
																		  
										  if($checkCapStatus>10){
												 //no commision to top member
												 $noPositionChangeUser[] = $commMember;
											 }
											 else
											{
												 if($commMember!=0){
													
													$activeCom=8;
													$founderCom=3.74;
													if($commMemberDetail['raveType']=="Active"){
																																					
														$commToUserAboveMe 	= $activeCom;// Active User commission Amount for other Cycle
														
													}else{
														
														$commToUserAboveMe 	= $activeCom+$founderCom;// Founder commission Amount for other Cycle
														
													}
													//referral commission to referrar as per level user  
													if($userlevel==1){
														$commToInviter		= 2; // commission to inviter of level 1
													}
													else if($userlevel==2){
														$commToInviter		= 0.94; // commission to inviter of level 2
													}
												 // add commision to top member
												 $counterVal =1;
												 $comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal);
												 // echo "==".$comAddedToTopMem;
													 if($comAddedToTopMem){
														 // add Top Member share detail to log transaction
														 $instLogAboveMe 				= array();
														 $instLogAboveMe['note'] 		= "Catalog Purchase commission from Admin to ParentUser-".$commMember;
														 $instLogAboveMe['action'] 		= "-";
														 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
														 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
														 
														 // add reference comission to my top member also
														  // fetch my parent Referer
															
															$refererUserDetail = $this->gatewaymodel->getMyReferer($commMember);
															//if inviter other than admin (referarID!=1000) add commission to inviter
															if(count($refererUserDetail)>0){
																$counterRefVal = 0;														
																$refererUserId 		= $refererUserDetail[0]['referarID'];
																$refererUserLevel 	= $refererUserDetail[0]['userLevel'];																
																$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal);
																//if inviter other than admin (referarID=1000) add commission to inviter
																 if($refComDone){
																	 $instLogRef 				= array();
																	 $instLogRef['note'] 		= "Catalog Purchase commission from Admin to RefererUser-".$refererUserId;
																	 $instLogRef['action'] 		= "-";
																	 $instLogRef['amount'] 		= $commToInviter;
																	 $instLogRef['tranDate'] 	= $today;
																	 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogRef);
																	// referral detail insert in referral table
																	 $refDetail 				= array();
																	 $refDetail['myReferrer']   = $refererUserId;
																	 $refDetail['referrerLevel']= $refererUserLevel;
																	 $refDetail['userId']   	= $commMember;
																	 $refDetail['invtAmt']  	= $commToInviter;
																	 $refDetail['refCommDate']  = date('Y-m-d');
																	 $refDetail['refCommCount'] = 1;
																	 $tblRefDetail 				= 'rave_referralDetail';
																	 //  fetch referal detail exist or not
																	 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel);
																	
																	 // insert Level wise referral commission
																	 if($refDataExist==0){
																		$insertrefDetail 			= $this->common_model->insertDataToTable($tblRefDetail,$refDetail);
																	 }
																	 else{
																		  // Update Level wise referral commission																		  
																		 $updateRefDetail  			= $this->gatewaymodel->updateRefData($refDataExist,$refDetail);
																	 }
																 }
															}
															
														 
														 
													 }
												  }
											}
										  
									  }
									//move user position other than new  user& caped user
										//rest update all userPosition by +1
									$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($level,$noPositionChangeUser);
										//$noPositionChangeUser
																		
									
								 }
								
							 }										
						}
						
						$val = array("success" => "yes","message"=> 'Catalog Purchase Sucessfully for '.$userCount.' user');
				}
				else
				{
					$val=array("success" => "No","message"=>'Session Out');
				}
			}
		}
		
		$output = json_encode($val);
		echo $output;
	}	
	 // rave share related function end //
	 public function moveUpTonextLevel(){
		$eleMoveUpUser = array();
		$groupVal = trim($_POST["group"]);
		//echo $groupVal; //exit;
		$currLevel = 1;
		if($groupVal==0){
			//$userId   = $this->session->userdata('userId');
			//$raveType = $this->session->userdata('raveType');
			$eleMoveUpUser[0]['user_id'] = $this->session->userdata('userId');
			$eleMoveUpUser[0]['raveType'] = $this->session->userdata('raveType');
		}
		else{
			$currPosition=25;//24;// 160
			$eleMoveUpUser = $this->gatewaymodel->getMoveUpUser($currPosition,$currLevel);
		}		
		//print_r($eleMoveUpUser);
		if(count($eleMoveUpUser)>0){
			$userCount=0;			
			foreach($eleMoveUpUser as $eleMoveUpUserDetail){
				$userCount++;
				$userId='';
				$raveType ='';
				$userId   = $eleMoveUpUserDetail['user_id'];// $this->session->userdata('userId');
				$raveType = $eleMoveUpUserDetail['raveType'];//$this->session->userdata('raveType');
				if($userId!= ""){
					$levelUpPrice		= 60; //second level entry fee $60
					$compShare			= 10;
			    	// success payment update user level 2
					$paymentStatus = 1;
					if($paymentStatus == 1){
						$tbl = 'rave_userinfo';
						$where = array("uID"=>$userId);
						$data = array("userLevel"=>2) ;
						$update = $this->common_model->updateDataToTable($tbl, $where, $data );					
						if($update){
							//rave_share table amount (-)$60 & level 1 set status 0
							$upLevelStatusCh = $this->gatewaymodel->userLevelStatusCh($userId,$currLevel);
							if ($upLevelStatusCh){
								//insert new row to rave share with level 2 position 0 
								$level =$currLevel+1;// level wise check top mem
								$topMember = $this->gatewaymodel->getTopMember($level);
								// echo count($topMember);
								// insert my data to rave_share table
								$myPosition = 0; 						
								if(count($topMember)>0){							
									$myParent   = $topMember[0]['user_id'];
								 }
								 else
								 {							
									$myParent   = 0; // admin
								 }
								 $prevBalance = $this->gatewaymodel->getBalance($userId,$currLevel);// balance from previous level
								 $myBalance = round($prevBalance-$levelUpPrice,2);
								 // insert data to rave share
								 $insData = array();
								 $insData['user_id']      = $userId;
								 $insData['parentId']     = $myParent;
								 $insData['level']        = $level;
								 $insData['userPosition'] = $myPosition;						 
								 $insData['creationDate'] = date('Y-m-d');
								 $insData['status'] 	  = 1;
								 $insData['amount'] 	  = $myBalance;
								 $insData['counter'] 	  = 0;
								
								 $tblshare = 'rave_share';
								 $insertId = $this->common_model->insertDataToTable($tblshare,$insData);
								 if($insertId){
																 
									 // add admin share detail to log transaction
									 $instLog 				= array();
									 $instLog['note'] 		= "Level Up Payment to Admin from userId-".$userId;
									 $instLog['action'] 	= "+";
									 $instLog['amount'] 	= $levelUpPrice;
									 $instLog['tranDate'] 	=  date('Y-m-d');
									 $tblLog 				= 'raveTransactionLog';
									 $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
									 
									 // add amount to company Account  added by SB on 12-08-2016
									 $instcompAcct = array();
									 $instcompAcct['userId'] 		= $userId;
									 $instcompAcct['userLevel'] 	= $level;
									 $instcompAcct['compShare'] 	= $compShare;
									 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
									 $instcompAcct['commDate'] 		= date('Y-m-d');
									 $tblCompAcct 					= 'rave_companyAccount';
									 $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
									 
								 }
								  // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
								 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId);
								 if(count($paidUser)>0){
									// check my cap
									$today = date('Y-m-d'); 
									foreach($paidUser as $paidUsers){
										$validUser ='';
										$validUser = $paidUsers['user_id'];
										$capTableUserCount = $this->gatewaymodel->checkMemCount($level,$today,$validUser);
										if($capTableUserCount==0){
											// insert user to captable
											$capRecordAdded =  $this->gatewaymodel->insertCapRecord($level,$today,$validUser);
										}
										else{
											//update user member count
											$capRecordAdded =  $this->gatewaymodel->updateCapRecord($level,$today,$validUser);
										}
									}
								   
								 }
									 
									  //fetch all user eligible for commission
								  $commMemberList = $this->gatewaymodel->getCommMember($level);
								  $noPositionChangeUser = array();
								 // $noPositionChangeUser[]=$userId;
								  foreach($commMemberList as $commMemberDetail){
									  $checkCapStatus=0;
									  $userlevel =$commMemberDetail['level'];
									  $today = date('Y-m-d');
									  $commMember = $commMemberDetail['user_id'];
									 // $checkCapStatus = $this->gatewaymodel->checkMemCount($userlevel,$today,$commMember);// blocked cap checking on 30/05/2016
																	  
									  if($checkCapStatus>10){
											 //no commision to top member
											 $noPositionChangeUser[] = $commMember;
										 }
										 else
										{
											 if($commMember!=0){
																									
													//referral commission to referrar as per level user  
													if($userlevel==1){
														$activeCom		= 8;
														$founderCom		= 3.74;
														$commToInviter	= 2; // commission to inviter of level 1
													}
													else if($userlevel==2){
														$activeCom		= 9.38; //4.7;
														$founderCom		= 6.24;//3.13;
														$commToInviter	= 1.88;//0.94; // commission to inviter of level 2
														// commission to opportunity ,seed & Karma
														$opportunity 	= 4.13; //4.18;//2.34;
														$seed       	= 3.12;//1.56;
														$karma       	= 6.3;//1.59;
														$level3Entrance = 18.76;//9.38;
													}
													if($commMemberDetail['raveType']=="Active"){
																																					
														$commToUserAboveMe 	= $activeCom;// Active User commission Amount for other Cycle
														
													}else{
														
														$commToUserAboveMe 	= $activeCom+$founderCom;// Founder commission Amount for other Cycle
														
													}
																								 
											 // add commision to top member
											 $counterVal =1;
											 $comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal);
											 // echo "==".$comAddedToTopMem;
												 if($comAddedToTopMem){
													 // add Top Member share detail to log transaction
													 $instLogAboveMe 				= array();
													 $instLogAboveMe['note'] 		= "moveup commission from Admin to ParentUser-".$commMember;
													 $instLogAboveMe['action'] 		= "-";
													 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
													 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
													 
													 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
													 // add opportunity 
													 $oppAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$opportunity,0);
													 if($oppAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogOpp 				= array();
														 $instLogOpp['note'] 		= "opportunity from Admin to ParentUser-".$commMember;
														 $instLogOpp['action'] 		= "-";
														 $instLogOpp['amount'] 		= $opportunity;
														 $instLogOpp['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogOpp);
													 
													 }
													 // add seed
													 $seedAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$seed,0);
													 if($seedAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogSeed 				= array();
														 $instLogSeed['note'] 		= "seed from Admin to ParentUser-".$commMember;
														 $instLogSeed['action'] 	= "-";
														 $instLogSeed['amount'] 	= $seed;
														 $instLogSeed['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogSeed = $this->gatewaymodel->tranRecordInter($instLogSeed);
													 
													 }
													  // add karma 
													 $karmaAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$karma,0);
													 if($karmaAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogKarma 				= array();
														 $instLogKarma['note'] 		= "karma from Admin to ParentUser-".$commMember;
														 $instLogKarma['action'] 		= "-";
														 $instLogKarma['amount'] 		= $karma;
														 $instLogKarma['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogKarma);
													 
													 }
													 // add enterance Level 3
													 
													 $enterL3AddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$level3Entrance,0);
													 if($enterL3AddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogentL3 				= array();
														 $instLogentL3['note'] 		= "Enterance Level3 from Admin to ParentUser-".$commMember;
														 $instLogentL3['action'] 		= "-";
														 $instLogentL3['amount'] 		= $level3Entrance;
														 $instLogentL3['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogentL3);
													 
													 }
													  // add reference comission to my top member also
													  // fetch my parent Referer													
														$refererUserDetail = $this->gatewaymodel->getMyReferer($commMember);
														//if inviter other than admin (referarID!=1000) add commission to inviter
														if(count($refererUserDetail)>0){
															$counterRefVal = 0;
															$refererUserId 		= $refererUserDetail[0]['referarID'];
															$refererUserLevel 	= $refererUserDetail[0]['userLevel'];	
															$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal);
															//if inviter other than admin (referarID=1000) add commission to inviter
															 if($refComDone){
																 $instLogRef 				= array();
																 $instLogRef['note'] 		= "moveUp commission from Admin to RefererUser-".$refererUserId;
																 $instLogRef['action'] 		= "-";
																 $instLogRef['amount'] 		= $commToInviter;
																 $instLogRef['tranDate'] 	= $today;
																 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogRef);
																 
																 // referral detail insert in referral table
																 $refDetail 				= array();
																 $refDetail['myReferrer']   = $refererUserId;
																 $refDetail['referrerLevel']= $refererUserLevel;
																 $refDetail['userId']   	= $commMember;
																 $refDetail['invtAmt']  	= $commToInviter;
																 $refDetail['refCommDate']  = date('Y-m-d');
																 $refDetail['refCommCount'] = 1;
																 $tblRefDetail 				= 'rave_referralDetail';
																 //  fetch referal detail exist or not
																 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel);
																
																 // insert Level wise referral commission
																 if($refDataExist==0){
																	$insertrefDetail 			= $this->common_model->insertDataToTable($tblRefDetail,$refDetail);
																 }
																 else{
																	  // Update Level wise referral commission																		  
																	 $updateRefDetail  			= $this->gatewaymodel->updateRefData($refDataExist,$refDetail);
																 }
															 }
														}
																
												 }
											  }
										}
									  
								  }
								//move user position other than new  user& caped user
									//rest update all userPosition by +1
								$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($level,$noPositionChangeUser);
															
							}
						}
					}
					
					$val = array("success" => "yes","message"=> 'LevelUp Payment Sucessfully for '.$userCount.' user. Now go to level 2');
				}
				else
				{
					$val=array("success" => "No","message"=>'Session Out');
				}
				
				
			}
		} 
	
	$output = json_encode($val);
	echo $output; 
  }
  
	 public function moveUpTonextLevel3(){
		$eleMoveUpUser = array();
		$groupVal = trim($_POST["group"]);
		//echo $groupVal; //exit;
		$currLevel = 2;
		if($groupVal==0){
			//$userId   = $this->session->userdata('userId');
			//$raveType = $this->session->userdata('raveType');
			$eleMoveUpUser[0]['user_id'] = $this->session->userdata('userId');
			$eleMoveUpUser[0]['raveType'] = $this->session->userdata('raveType');
		}
		else{
			$currPosition=48;// 320
			$eleMoveUpUser = $this->gatewaymodel->getMoveUpUser($currPosition,$currLevel);
		}		
		//print_r($eleMoveUpUser);
		if(count($eleMoveUpUser)>0){
			$userCount=0;			
			foreach($eleMoveUpUser as $eleMoveUpUserDetail){
				$userCount++;
				$userId='';
				$raveType ='';
				$userId   = $eleMoveUpUserDetail['user_id'];// $this->session->userdata('userId');
				$raveType = $eleMoveUpUserDetail['raveType'];//$this->session->userdata('raveType');
				if($userId!= ""){
					$levelUpPrice		= 300; //second level entry fee $300
					$compShare			= 150; //company share
					$contingentCom		= 14;//12.5;
					
			    	// success payment update user level 3
					$paymentStatus = 1;
					if($paymentStatus == 1){
						$tbl = 'rave_userinfo';
						$where = array("uID"=>$userId);
						$data = array("userLevel"=>3) ;
						$update = $this->common_model->updateDataToTable($tbl, $where, $data );					
						if($update){
							//rave_share table amount (-)$300 & level 2 set status 0
							$upLevelStatusCh = $this->gatewaymodel->userLevelStatusCh($userId,$currLevel);
							if ($upLevelStatusCh){
								//insert new row to rave share with level 3 position 0 
								$level =$currLevel+1;// level wise check top mem
								$topMember = $this->gatewaymodel->getTopMember($level);
								// echo count($topMember);
								// insert my data to rave_share table
								$myPosition = 0; 						
								if(count($topMember)>0){							
									$myParent   = $topMember[0]['user_id'];
								 }
								 else
								 {							
									$myParent   = 0; // admin
								 }
								 $prevBalance = $this->gatewaymodel->getBalance($userId,$currLevel);// balance from previous level
								 $myBalance = round($prevBalance-$levelUpPrice,2);
								 // insert data to rave share
								 $insData = array();
								 $insData['user_id']      = $userId;
								 $insData['parentId']     = $myParent;
								 $insData['level']        = $level;
								 $insData['userPosition'] = $myPosition;						 
								 $insData['creationDate'] = date('Y-m-d');
								 $insData['status'] 	  = 1;
								 $insData['amount'] 	  = $myBalance;
								 $insData['counter'] 	  = 0;
								
								 $tblshare = 'rave_share';
								 $insertId = $this->common_model->insertDataToTable($tblshare,$insData);
								 if($insertId){
																 
									 // add admin share detail to log transaction
									 $instLog 				= array();
									 $instLog['note'] 		= "Level Up Payment to Admin from userId-".$userId;
									 $instLog['action'] 	= "+";
									 $instLog['amount'] 	= $levelUpPrice;
									 $instLog['tranDate'] 	=  date('Y-m-d');
									 $tblLog 				= 'raveTransactionLog';
									 $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
									 
									 // add amount to company Account  added by SB on 12-08-2016
									 $instcompAcct = array();
									 $instcompAcct['userId'] 		= $userId;
									 $instcompAcct['userLevel'] 	= $level;
									 $instcompAcct['compShare'] 	= $compShare;
									 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
									 $instcompAcct['commDate'] 		= date('Y-m-d');
									 $tblCompAcct 					= 'rave_companyAccount';
									 $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
									 
									 // add Contingent amount to company Account  added by SB on 12-08-2016
									 $instContigent = array();
									 $instContigent['userId'] 		= $userId;
									 $instContigent['userLevel'] 	= $level;
									 $instContigent['compShare'] 	= $contingentCom;
									 $instContigent['shareFor'] 	= 'C';// J joining commission , C Contingent
									 $instContigent['commDate'] 	= date('Y-m-d');
									 $tblContigent					= 'rave_companyAccount';
									 $insertContigent				= $this->common_model->insertDataToTable($tblContigent,$instContigent);
									 
								 }
								  // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
								 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId);
								 if(count($paidUser)>0){
									// check my cap
									$today = date('Y-m-d'); 
									foreach($paidUser as $paidUsers){
										$validUser ='';
										$validUser = $paidUsers['user_id'];
										$capTableUserCount = $this->gatewaymodel->checkMemCount($level,$today,$validUser);
										if($capTableUserCount==0){
											// insert user to captable
											$capRecordAdded =  $this->gatewaymodel->insertCapRecord($level,$today,$validUser);
										}
										else{
											//update user member count
											$capRecordAdded =  $this->gatewaymodel->updateCapRecord($level,$today,$validUser);
										}
									}
								   
								 }
									 
									  //fetch all user eligible for commission
								  $commMemberList = $this->gatewaymodel->getCommMember($level);
								  $noPositionChangeUser = array();
								 // $noPositionChangeUser[]=$userId;
								  foreach($commMemberList as $commMemberDetail){
									  $checkCapStatus=0;
									  $userlevel =$commMemberDetail['level'];
									  $today = date('Y-m-d');
									  $commMember = $commMemberDetail['user_id'];
									 // $checkCapStatus = $this->gatewaymodel->checkMemCount($userlevel,$today,$commMember);// blocked cap checking on 30/05/2016
																	  
									  if($checkCapStatus>10){
											 //no commision to top member
											 $noPositionChangeUser[] = $commMember;
										 }
										 else
										{
											 if($commMember!=0){
																									
													//referral commission to referrar as per level user  
													if($userlevel==1){
														$activeCom		= 8;
														$founderCom		= 3.74;
														$commToInviter	= 2; // commission to inviter of level 1
													}
													else if($userlevel==2){
														$activeCom		= 9.38;
														$founderCom		= 6.24;
														$commToInviter	= 1.88; // commission to inviter of level 2
														// commission to opportunity  & Karma
														$opportunity 	= 4.13; //4.18;
														$seed        	= 3.12;
														$karma       	= 6.3;
														$level3Entrance = 18.76;
													}
													else if($userlevel==3){
														$activeCom		= 18.75;//18.74;
														$founderCom		= 12.5;
														$commToInviter	= 3.75;//3.74; // commission to inviter of level 3
														// commission to opportunity  & Karma
														$opportunity 	= 21;
														$seed       	= 21;
														$karma       	= 9;//9.24;
														$level3Entrance = 50; // for level 4
													}
													if($commMemberDetail['raveType']=="Active"){
																																					
														$commToUserAboveMe 	= $activeCom;// Active User commission Amount for other Cycle
														
													}else{
														
														$commToUserAboveMe 	= $activeCom+$founderCom;// Founder commission Amount for other Cycle
														
													}
																								 
											 // add commision to top member
											 $counterVal =1;
											 $comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal);
											 // echo "==".$comAddedToTopMem;
												 if($comAddedToTopMem){
													 // add Top Member share detail to log transaction
													 $instLogAboveMe 				= array();
													 $instLogAboveMe['note'] 		= "moveup commission from Admin to ParentUser-".$commMember;
													 $instLogAboveMe['action'] 		= "-";
													 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
													 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
													 
													 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
													 // add opportunity 
													 $oppAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$opportunity,0);
													 if($oppAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogOpp 				= array();
														 $instLogOpp['note'] 		= "opportunity from Admin to ParentUser-".$commMember;
														 $instLogOpp['action'] 		= "-";
														 $instLogOpp['amount'] 		= $opportunity;
														 $instLogOpp['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogOpp);
													 
													 }
													 // add seed
													 $seedAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$seed,0);
													 if($seedAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogSeed 				= array();
														 $instLogSeed['note'] 		= "seed from Admin to ParentUser-".$commMember;
														 $instLogSeed['action'] 	= "-";
														 $instLogSeed['amount'] 	= $seed;
														 $instLogSeed['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogSeed =$this->gatewaymodel->tranRecordInter($instLogSeed);
													 
													 }
													  // add karma 
													 $karmaAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$karma,0);
													 if($karmaAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogKarma 				= array();
														 $instLogKarma['note'] 		= "karma from Admin to ParentUser-".$commMember;
														 $instLogKarma['action'] 		= "-";
														 $instLogKarma['amount'] 		= $karma;
														 $instLogKarma['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogKarma);
													 
													 }
													 // add enterance Level 4
													 
													 $enterL3AddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$level3Entrance,0);
													 if($enterL3AddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogentL3 				= array();
														 $instLogentL3['note'] 		= "Enterance Level4 from Admin to ParentUser-".$commMember;
														 $instLogentL3['action'] 		= "-";
														 $instLogentL3['amount'] 		= $level3Entrance;
														 $instLogentL3['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogentL3);
													 
													 }
													  // add reference comission to my top member also
													  // fetch my parent Referer													
														$refererUserDetail = $this->gatewaymodel->getMyReferer($commMember);
														//if inviter other than admin (referarID!=1000) add commission to inviter
														if(count($refererUserDetail)>0){
															$counterRefVal = 0;
															$refererUserId 		= $refererUserDetail[0]['referarID'];
															$refererUserLevel 	= $refererUserDetail[0]['userLevel'];	
															$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal);
															//if inviter other than admin (referarID=1000) add commission to inviter
															 if($refComDone){
																 $instLogRef 				= array();
																 $instLogRef['note'] 		= "moveUp commission from Admin to RefererUser-".$refererUserId;
																 $instLogRef['action'] 		= "-";
																 $instLogRef['amount'] 		= $commToInviter;
																 $instLogRef['tranDate'] 	= $today;
																 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogRef);
																 
																 // referral detail insert in referral table
																 $refDetail 				= array();
																 $refDetail['myReferrer']   = $refererUserId;
																 $refDetail['referrerLevel']= $refererUserLevel;
																 $refDetail['userId']   	= $commMember;
																 $refDetail['invtAmt']  	= $commToInviter;
																 $refDetail['refCommDate']  = date('Y-m-d');
																 $refDetail['refCommCount'] = 1;
																 $tblRefDetail 				= 'rave_referralDetail';
																 //  fetch referal detail exist or not
																 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel);
																
																 // insert Level wise referral commission
																 if($refDataExist==0){
																	$insertrefDetail 			= $this->common_model->insertDataToTable($tblRefDetail,$refDetail);
																 }
																 else{
																	  // Update Level wise referral commission																		  
																	 $updateRefDetail  			= $this->gatewaymodel->updateRefData($refDataExist,$refDetail);
																 }
															 }
														}
																
												 }
											  }
										}
									  
								  }
								//move user position other than new  user& caped user
									//rest update all userPosition by +1
								$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($level,$noPositionChangeUser);
															
							}
						}
					}
					
					$val = array("success" => "yes","message"=> 'LevelUp Payment Sucessfully for '.$userCount.' user. Now go to level 3');
				}
				else
				{
					$val=array("success" => "No","message"=>'Session Out');
				}
				
				
			}
		} 
	
	$output = json_encode($val);
	echo $output; 
  }

	 public function moveUpTonextLevel4(){
		$eleMoveUpUser = array();
		$groupVal = trim($_POST["group"]);
		//echo $groupVal; //exit;
		$currLevel = 3;
		if($groupVal==0){
			//$userId   = $this->session->userdata('userId');
			//$raveType = $this->session->userdata('raveType');
			$eleMoveUpUser[0]['user_id'] = $this->session->userdata('userId');
			$eleMoveUpUser[0]['raveType'] = $this->session->userdata('raveType');
		}
		else{
			$currPosition=97;//47;// 320
			$eleMoveUpUser = $this->gatewaymodel->getMoveUpUser($currPosition,$currLevel);
		}		
		//print_r($eleMoveUpUser);
		if(count($eleMoveUpUser)>0){
			$userCount=0;			
			foreach($eleMoveUpUser as $eleMoveUpUserDetail){
				$userCount++;
				$userId='';
				$raveType ='';
				$userId   = $eleMoveUpUserDetail['user_id'];// $this->session->userdata('userId');
				$raveType = $eleMoveUpUserDetail['raveType'];//$this->session->userdata('raveType');
				if($userId!= ""){
					$levelUpPrice		= 800; //second level entry fee $800
					$compShare			= 300; //company share
					$contingentCom		= 100;
			    	// success payment update user level 4
					$paymentStatus = 1;
					if($paymentStatus == 1){
						$tbl = 'rave_userinfo';
						$where = array("uID"=>$userId);
						$data = array("userLevel"=>4) ;
						$update = $this->common_model->updateDataToTable($tbl, $where, $data );					
						if($update){
							//rave_share table amount (-)$800 & level 3 set status 0
							$upLevelStatusCh = $this->gatewaymodel->userLevelStatusCh($userId,$currLevel);
							if ($upLevelStatusCh){
								//insert new row to rave share with level 4 position 0 
								$level =$currLevel+1;// level wise check top mem
								$topMember = $this->gatewaymodel->getTopMember($level);
								// echo count($topMember);
								// insert my data to rave_share table
								$myPosition = 0; 						
								if(count($topMember)>0){							
									$myParent   = $topMember[0]['user_id'];
								 }
								 else
								 {							
									$myParent   = 0; // admin
								 }
								 $prevBalance = $this->gatewaymodel->getBalance($userId,$currLevel);// balance from previous level
								 $myBalance = round($prevBalance-$levelUpPrice,2);
								 // insert data to rave share
								 $insData = array();
								 $insData['user_id']      = $userId;
								 $insData['parentId']     = $myParent;
								 $insData['level']        = $level;
								 $insData['userPosition'] = $myPosition;						 
								 $insData['creationDate'] = date('Y-m-d');
								 $insData['status'] 	  = 1;
								 $insData['amount'] 	  = $myBalance;
								 $insData['counter'] 	  = 0;
								
								 $tblshare = 'rave_share';
								 $insertId = $this->common_model->insertDataToTable($tblshare,$insData);
								 if($insertId){
																 
									 // add admin share detail to log transaction
									 $instLog 				= array();
									 $instLog['note'] 		= "Level Up Payment to Admin from userId-".$userId;
									 $instLog['action'] 	= "+";
									 $instLog['amount'] 	= $levelUpPrice;
									 $instLog['tranDate'] 	=  date('Y-m-d');
									 $tblLog 				= 'raveTransactionLog';
									 $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
									
									 // add amount to company Account  added by SB on 12-08-2016
									 $instcompAcct = array();
									 $instcompAcct['userId'] 		= $userId;
									 $instcompAcct['userLevel'] 	= $level;
									 $instcompAcct['compShare'] 	= $compShare;
									 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
									 $instcompAcct['commDate'] 		= date('Y-m-d');
									 $tblCompAcct 					= 'rave_companyAccount';
									 $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
									 
									 // add Contingent amount to company Account  added by SB on 12-08-2016
									 $instContigent = array();
									 $instContigent['userId'] 		= $userId;
									 $instContigent['userLevel'] 	= $level;
									 $instContigent['compShare'] 	= $contingentCom;
									 $instContigent['shareFor'] 	= 'C';// J joining commission , C Contingent
									 $instContigent['commDate'] 	= date('Y-m-d');
									 $tblContigent					= 'rave_companyAccount';
									 $insertContigent				= $this->common_model->insertDataToTable($tblContigent,$instContigent);
									 
									 
								 }
								  // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
								 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId);
								 if(count($paidUser)>0){
									// check my cap
									$today = date('Y-m-d'); 
									foreach($paidUser as $paidUsers){
										$validUser ='';
										$validUser = $paidUsers['user_id'];
										$capTableUserCount = $this->gatewaymodel->checkMemCount($level,$today,$validUser);
										if($capTableUserCount==0){
											// insert user to captable
											$capRecordAdded =  $this->gatewaymodel->insertCapRecord($level,$today,$validUser);
										}
										else{
											//update user member count
											$capRecordAdded =  $this->gatewaymodel->updateCapRecord($level,$today,$validUser);
										}
									}
								   
								 }
									 
									  //fetch all user eligible for commission
								  $commMemberList = $this->gatewaymodel->getCommMember($level);
								  $noPositionChangeUser = array();
								 // $noPositionChangeUser[]=$userId;
								  foreach($commMemberList as $commMemberDetail){
									  $checkCapStatus=0;
									  $userlevel =$commMemberDetail['level'];
									  $today = date('Y-m-d');
									  $commMember = $commMemberDetail['user_id'];
									 // $checkCapStatus = $this->gatewaymodel->checkMemCount($userlevel,$today,$commMember);// blocked cap checking on 30/05/2016
																	  
									  if($checkCapStatus>10){
											 //no commision to top member
											 $noPositionChangeUser[] = $commMember;
										 }
										 else
										{
											 if($commMember!=0){
																									
													//referral commission to referrar as per level user  
													if($userlevel==1){
														$activeCom		= 8;
														$founderCom		= 3.74;
														$commToInviter	= 2; // commission to inviter of level 1
													}
													else if($userlevel==2){
														$activeCom		= 9.38;
														$founderCom		= 6.24;
														$commToInviter	= 1.88; // commission to inviter of level 2
														// commission to opportunity  & Karma
														$opportunity 	=  4.13; //4.18;
														$seed        	= 3.12;
														$karma       	= 6.3;
														$level3Entrance = 18.76;
													}
													else if($userlevel==3){
														$activeCom		= 18.75;//18.74;
														$founderCom		= 12.5;
														$commToInviter	= 3.75;//3.74; // commission to inviter of level 3
														// commission to opportunity  & Karma
														$opportunity 	= 21;
														$seed       	= 21;
														$karma       	= 9;//9.24;
														$level3Entrance = 50; // for level 4
													}
													else if($userlevel==4){
														$activeCom		= 37.5;
														$founderCom		= 18.75;//18.74;
														$commToInviter	= 5.62; // commission to inviter of level 4
														// commission to opportunity ,seed & Karma
														$opportunity 	= 75;
														$seed       	= 31.88;//31.24;
														$karma       	= 125;
														$level3Entrance = 106.25;//106.24;  // entrance level 5
													}
													if($commMemberDetail['raveType']=="Active"){
																																					
														$commToUserAboveMe 	= $activeCom;// Active User commission Amount for other Cycle
														
													}else{
														
														$commToUserAboveMe 	= $activeCom+$founderCom;// Founder commission Amount for other Cycle
														
													}
																								 
											 // add commision to top member
											 $counterVal =1;
											 $comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal);
											 // echo "==".$comAddedToTopMem;
												 if($comAddedToTopMem){
													 // add Top Member share detail to log transaction
													 $instLogAboveMe 				= array();
													 $instLogAboveMe['note'] 		= "moveup commission from Admin to ParentUser-".$commMember;
													 $instLogAboveMe['action'] 		= "-";
													 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
													 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
													 
													 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
													 // add opportunity 
													 $oppAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$opportunity,0);
													 if($oppAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogOpp 				= array();
														 $instLogOpp['note'] 		= "opportunity from Admin to ParentUser-".$commMember;
														 $instLogOpp['action'] 		= "-";
														 $instLogOpp['amount'] 		= $opportunity;
														 $instLogOpp['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogOpp);
													 
													 }
													 // add seed
													 $seedAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$seed,0);
													 if($seedAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogseed				= array();
														 $instLogseed['note'] 		= "seed from Admin to ParentUser-".$commMember;
														 $instLogseed['action'] 	= "-";
														 $instLogseed['amount'] 	= $seed;
														 $instLogseed['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogseed =$this->gatewaymodel->tranRecordInter($instLogseed);
													 
													 }
													  // add karma 
													 $karmaAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$karma,0);
													 if($karmaAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogKarma 				= array();
														 $instLogKarma['note'] 		= "karma from Admin to ParentUser-".$commMember;
														 $instLogKarma['action'] 		= "-";
														 $instLogKarma['amount'] 		= $karma;
														 $instLogKarma['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogKarma);
													 
													 }
													 // add enterance Level 5
													 
													 $enterL5AddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$level3Entrance,0);
													 if($enterL5AddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogentL3 				= array();
														 $instLogentL3['note'] 		= "Enterance Level5 from Admin to ParentUser-".$commMember;
														 $instLogentL3['action'] 		= "-";
														 $instLogentL3['amount'] 		= $level3Entrance;// entrance level 5
														 $instLogentL3['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogL3 =$this->gatewaymodel->tranRecordInter($instLogentL3);
													 
													 }
													  // add reference comission to my top member also
													  // fetch my parent Referer													
														$refererUserDetail = $this->gatewaymodel->getMyReferer($commMember);
														//if inviter other than admin (referarID!=1000) add commission to inviter
														if(count($refererUserDetail)>0){
															$counterRefVal = 0;
															$refererUserId 		= $refererUserDetail[0]['referarID'];
															$refererUserLevel 	= $refererUserDetail[0]['userLevel'];	
															$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal);
															//if inviter other than admin (referarID=1000) add commission to inviter
															 if($refComDone){
																 $instLogRef 				= array();
																 $instLogRef['note'] 		= "moveUp commission from Admin to RefererUser-".$refererUserId;
																 $instLogRef['action'] 		= "-";
																 $instLogRef['amount'] 		= $commToInviter;
																 $instLogRef['tranDate'] 	= $today;
																 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogRef);
																 
																 // referral detail insert in referral table
																 $refDetail 				= array();
																 $refDetail['myReferrer']   = $refererUserId;
																 $refDetail['referrerLevel']= $refererUserLevel;
																 $refDetail['userId']   	= $commMember;
																 $refDetail['invtAmt']  	= $commToInviter;
																 $refDetail['refCommDate']  = date('Y-m-d');
																 $refDetail['refCommCount'] = 1;
																 $tblRefDetail 				= 'rave_referralDetail';
																 //  fetch referal detail exist or not
																 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel);
																
																 // insert Level wise referral commission
																 if($refDataExist==0){
																	$insertrefDetail 			= $this->common_model->insertDataToTable($tblRefDetail,$refDetail);
																 }
																 else{
																	  // Update Level wise referral commission																		  
																	 $updateRefDetail  			= $this->gatewaymodel->updateRefData($refDataExist,$refDetail);
																 }
															 }
														}
																
												 }
											  }
										}
									  
								  }
								//move user position other than new  user& caped user
									//rest update all userPosition by +1
								$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($level,$noPositionChangeUser);
															
							}
						}
					}
					
					$val = array("success" => "yes","message"=> 'LevelUp Payment Sucessfully for '.$userCount.' user. Now go to level 4');
				}
				else
				{
					$val=array("success" => "No","message"=>'Session Out');
				}
				
				
			}
		} 
	
	$output = json_encode($val);
	echo $output; 
  }
  public function moveUpTonextLevel5(){
		$eleMoveUpUser = array();
		$groupVal = trim($_POST["group"]);
		//echo $groupVal; //exit;
		$currLevel = 4;
		if($groupVal==0){
			//$userId   = $this->session->userdata('userId');
			//$raveType = $this->session->userdata('raveType');
			$eleMoveUpUser[0]['user_id'] = $this->session->userdata('userId');
			$eleMoveUpUser[0]['raveType'] = $this->session->userdata('raveType');
		}
		else{
			$currPosition=97;// 320
			$eleMoveUpUser = $this->gatewaymodel->getMoveUpUser($currPosition,$currLevel);
		}		
		//print_r($eleMoveUpUser);
		if(count($eleMoveUpUser)>0){
			$userCount=0;			
			foreach($eleMoveUpUser as $eleMoveUpUserDetail){
				$userCount++;
				$userId='';
				$raveType ='';
				$userId   = $eleMoveUpUserDetail['user_id'];// $this->session->userdata('userId');
				$raveType = $eleMoveUpUserDetail['raveType'];//$this->session->userdata('raveType');
				if($userId!= ""){
					$levelUpPrice		= 1700; //5th level entry fee $1000
					$compShare			= 1000;//400; //company share
					$contingentCom		= 148.75;//682;
			    	// success payment update user level 5
					$paymentStatus = 1;
					if($paymentStatus == 1){
						$tbl = 'rave_userinfo';
						$where = array("uID"=>$userId);
						$data = array("userLevel"=>5) ;
						$update = $this->common_model->updateDataToTable($tbl, $where, $data );					
						if($update){
							//rave_share table amount (-)$1000 & level 4 set status 0
							$upLevelStatusCh = $this->gatewaymodel->userLevelStatusCh($userId,$currLevel);
							if ($upLevelStatusCh){
								//insert new row to rave share with level 5 position 0 
								$level =$currLevel+1;// level wise check top mem
								$topMember = $this->gatewaymodel->getTopMember($level);
								// echo count($topMember);
								// insert my data to rave_share table
								$myPosition = 0; 						
								if(count($topMember)>0){							
									$myParent   = $topMember[0]['user_id'];
								 }
								 else
								 {							
									$myParent   = 0; // admin
								 }
								 $prevBalance = $this->gatewaymodel->getBalance($userId,$currLevel);// balance from previous level
								 $myBalance = round($prevBalance-$levelUpPrice,2);
								 // insert data to rave share
								 $insData = array();
								 $insData['user_id']      = $userId;
								 $insData['parentId']     = $myParent;
								 $insData['level']        = $level;
								 $insData['userPosition'] = $myPosition;						 
								 $insData['creationDate'] = date('Y-m-d');
								 $insData['status'] 	  = 1;
								 $insData['amount'] 	  = $myBalance;
								 $insData['counter'] 	  = 0;
								
								 $tblshare = 'rave_share';
								 $insertId = $this->common_model->insertDataToTable($tblshare,$insData);
								 if($insertId){
																 
									 // add admin share detail to log transaction
									 $instLog 				= array();
									 $instLog['note'] 		= "Level Up Payment to Admin from userId-".$userId;
									 $instLog['action'] 	= "+";
									 $instLog['amount'] 	= $levelUpPrice;
									 $instLog['tranDate'] 	=  date('Y-m-d');
									 $tblLog 				= 'raveTransactionLog';
									 $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
									 
									  // add amount to company Account  added by SB on 12-08-2016
									 $instcompAcct = array();
									 $instcompAcct['userId'] 		= $userId;
									 $instcompAcct['userLevel'] 	= $level;
									 $instcompAcct['compShare'] 	= $compShare;
									 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
									 $instcompAcct['commDate'] 		= date('Y-m-d');
									 $tblCompAcct 					= 'rave_companyAccount';
									 $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
									 
									 // add Contingent amount to company Account  added by SB on 12-08-2016
									 $instContigent = array();
									 $instContigent['userId'] 		= $userId;
									 $instContigent['userLevel'] 	= $level;
									 $instContigent['compShare'] 	= $contingentCom;
									 $instContigent['shareFor'] 	= 'C';// J joining commission , C Contingent
									 $instContigent['commDate'] 	= date('Y-m-d');
									 $tblContigent					= 'rave_companyAccount';
									 $insertContigent				= $this->common_model->insertDataToTable($tblContigent,$instContigent);
									 
								 }
								  // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
								 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId);
								 if(count($paidUser)>0){
									// check my cap
									$today = date('Y-m-d'); 
									foreach($paidUser as $paidUsers){
										$validUser ='';
										$validUser = $paidUsers['user_id'];
										$capTableUserCount = $this->gatewaymodel->checkMemCount($level,$today,$validUser);
										if($capTableUserCount==0){
											// insert user to captable
											$capRecordAdded =  $this->gatewaymodel->insertCapRecord($level,$today,$validUser);
										}
										else{
											//update user member count
											$capRecordAdded =  $this->gatewaymodel->updateCapRecord($level,$today,$validUser);
										}
									}
								   
								 }
									 
									  //fetch all user eligible for commission
								  $commMemberList = $this->gatewaymodel->getCommMember($level);
								  $noPositionChangeUser = array();
								 // $noPositionChangeUser[]=$userId;
								  foreach($commMemberList as $commMemberDetail){
									  $checkCapStatus=0;
									  $userlevel =$commMemberDetail['level'];
									  $today = date('Y-m-d');
									  $commMember = $commMemberDetail['user_id'];
									 // $checkCapStatus = $this->gatewaymodel->checkMemCount($userlevel,$today,$commMember);// blocked cap checking on 30/05/2016
																	  
									  if($checkCapStatus>10){
											 //no commision to top member
											 $noPositionChangeUser[] = $commMember;
										 }
										 else
										{
											 if($commMember!=0){
																									
													//referral commission to referrar as per level user  
													if($userlevel==1){
														$activeCom		= 8;
														$founderCom		= 3.74;
														$commToInviter	= 2; // commission to inviter of level 1
													}
													else if($userlevel==2){
														$activeCom		= 9.38;
														$founderCom		= 6.24;
														$commToInviter	= 1.88; // commission to inviter of level 2
														// commission to opportunity  & Karma
														$opportunity 	=  4.13; //4.18;
														$seed        	= 3.12;
														$karma       	= 6.3;
														$level3Entrance = 18.76;
													}
													else if($userlevel==3){
														$activeCom		= 18.75;//18.74;
														$founderCom		= 12.5;
														$commToInviter	= 3.75;//3.74; // commission to inviter of level 3
														// commission to opportunity  & Karma
														$opportunity 	= 21;
														$seed       	= 21;
														$karma       	= 9;//9.24;
														$level3Entrance = 50; // for level 4
													}
													else if($userlevel==4){
														$activeCom		= 37.5;
														$founderCom		= 18.75;//18.74;
														$commToInviter	= 5.62; // commission to inviter of level 4
														// commission to opportunity ,seed & Karma
														$opportunity 	= 75;
														$seed       	= 31.88;//31.24;
														$karma       	= 125;
														$level3Entrance = 106.25;//106.24;  // entrance level 5
													}
													else if($userlevel==5){
														$activeCom		= 75;
														$founderCom		= 31.25;//31.24;
														$commToInviter	= 7.5; // commission to inviter of level 5
														// commission to opportunity ,seed & Karma
														$opportunity 	= 281.25;//281.24;
														$seed       	= 125;
														$karma      	= 31.25;//31.24;
														
													}
													if($commMemberDetail['raveType']=="Active"){
																																					
														$commToUserAboveMe 	= $activeCom;// Active User commission Amount for other Cycle
														
													}else{
														
														$commToUserAboveMe 	= $activeCom+$founderCom;// Founder commission Amount for other Cycle
														
													}
																								 
											 // add commision to top member
											 $counterVal =1;
											 $comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal);
											 // echo "==".$comAddedToTopMem;
												 if($comAddedToTopMem){
													 // add Top Member share detail to log transaction
													 $instLogAboveMe 				= array();
													 $instLogAboveMe['note'] 		= "moveup commission from Admin to ParentUser-".$commMember;
													 $instLogAboveMe['action'] 		= "-";
													 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
													 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
													 
													 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
													 // add opportunity 
													 $oppAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$opportunity,0);
													 if($oppAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogOpp 				= array();
														 $instLogOpp['note'] 		= "opportunity from Admin to ParentUser-".$commMember;
														 $instLogOpp['action'] 		= "-";
														 $instLogOpp['amount'] 		= $opportunity;
														 $instLogOpp['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogOpp);
													 
													 }
													
													  // add karma 
													 $karmaAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$karma,0);
													 if($karmaAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogKarma 				= array();
														 $instLogKarma['note'] 		= "karma from Admin to ParentUser-".$commMember;
														 $instLogKarma['action'] 		= "-";
														 $instLogKarma['amount'] 		= $karma;
														 $instLogKarma['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogKarma);
													 
													 }
													 // add enterance Level 5
													 
													 $seedAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$seed,0);
													 if($seedAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogentseed 				= array();
														 $instLogentseed['note'] 		= "Seed from Admin to ParentUser-".$commMember;
														 $instLogentseed['action'] 		= "-";
														 $instLogentseed['amount'] 		= $seed;// entrance level 5
														 $instLogentseed['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogseed =$this->gatewaymodel->tranRecordInter($instLogentseed);
													 
													 }
													  // add reference comission to my top member also
													  // fetch my parent Referer													
														$refererUserDetail = $this->gatewaymodel->getMyReferer($commMember);
														//if inviter other than admin (referarID!=1000) add commission to inviter
														if(count($refererUserDetail)>0){
															$counterRefVal = 0;
															$refererUserId 		= $refererUserDetail[0]['referarID'];
															$refererUserLevel 	= $refererUserDetail[0]['userLevel'];	
															$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal);
															//if inviter other than admin (referarID=1000) add commission to inviter
															 if($refComDone){
																 $instLogRef 				= array();
																 $instLogRef['note'] 		= "moveUp commission from Admin to RefererUser-".$refererUserId;
																 $instLogRef['action'] 		= "-";
																 $instLogRef['amount'] 		= $commToInviter;
																 $instLogRef['tranDate'] 	= $today;
																 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogRef);
																 
																 // referral detail insert in referral table
																 $refDetail 				= array();
																 $refDetail['myReferrer']   = $refererUserId;
																 $refDetail['referrerLevel']= $refererUserLevel;
																 $refDetail['userId']   	= $commMember;
																 $refDetail['invtAmt']  	= $commToInviter;
																 $refDetail['refCommDate']  = date('Y-m-d');
																 $refDetail['refCommCount'] = 1;
																 $tblRefDetail 				= 'rave_referralDetail';
																 //  fetch referal detail exist or not
																 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel);
																
																 // insert Level wise referral commission
																 if($refDataExist==0){
																	$insertrefDetail 			= $this->common_model->insertDataToTable($tblRefDetail,$refDetail);
																 }
																 else{
																	  // Update Level wise referral commission																		  
																	 $updateRefDetail  			= $this->gatewaymodel->updateRefData($refDataExist,$refDetail);
																 }
															 }
														}
																
												 }
											  }
										}
									  
								  }
								//move user position other than new  user& caped user
									//rest update all userPosition by +1
								$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($level,$noPositionChangeUser);
															
							}
						}
					}
					
					$val = array("success" => "yes","message"=> 'LevelUp Payment Sucessfully for '.$userCount.' user. Now go to level 5');
				}
				else
				{
					$val=array("success" => "No","message"=>'Session Out');
				}
				
				
			}
		} 
	
	$output = json_encode($val);
	echo $output; 
  }
  public function tech_support(){
		//print_r($type);
         $status = 'error';
		 $type ='tech_support';
			//$email = $this->input->post('email');
			$supportResuestUserId = $this->input->post('supportResuestUserId');
            $message = $this->input->post('message');
            if($supportResuestUserId != "" && $message != ""){
                $retData = 2;
				$mailData = array();
                $userInfo = $this->gatewaymodel->getUserInfoRave($supportResuestUserId);
				$mailData['firstName'] =$userInfo[0]['firstName'];
				$mailData['emailID'] =$userInfo[0]['emailID'];
				$mailData['password'] =$userInfo[0]['password'];
				$mailData['message'] =$message;
				
                $retData = $this->sendTechsupportEmail($mailData);
                        
				
                if($retData == 1){
                    $status = 'success';					
                }
            }
			
       
		//print_r($status);exit;
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
		redirect(base_url()."myaccount");
    }
	
	public function sendTechsupportEmail($data = array()){
		$to = $this->_techsupport_email;
		$msg 		 = $data['message'];
		$email		 = $data['emailID'];
		$password		 = $data['password'];
		$firstName		 = $data['firstName'];
		
        $subject = "Email for Customer Tech support";
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Here are customer details as below.</td></tr>
					<tr><td width="25%">Name:</td><td width="75%">'.$firstName.'</td></tr>
                    <tr><td width="25%">Email:</td><td width="75%">'.$email.'</td></tr>
					<tr><td width="25%">Password:</td><td width="75%">'.$password.'</td></tr>
                    <tr><td width="25%">Message:</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">communitytreasures.co</td></tr>
                    </table>';
		//echo $message; exit;
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
	}
	
 // rave share related function end //
 }
