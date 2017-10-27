<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $_admin_email ;
    private $paypal_active = 2; //1=live;2=sandbox
	 private $_from_email;//22/12/2015 new aded us
    private $_from_name;
	//private $this->forWebsite = 2;
    private $paypal_action = '';
    private $paypal_email = '';
    function __construct() {
        parent::__construct();
        $this->load->model('gatewaymodel');
        $this->load->model('product_model');
		$this->load->model('common_model');
		$this->load->model('fullmembers_model');
        //$this->_admin_email = "blessings.jain@globalblackenterprises.com";
		 $this->_from_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";//22/12/2015 new added us
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";//"senabi.test05@gmail.com"; //
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
        //$viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
		 $viewData["htmlBanners"] = $this->common_model->getAllBannerDetail(trim($this->session->userdata('userId')));// added by SB on 30/03/2016
        $viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
        $viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
		$viewData["countryList"] = $this->gatewaymodel->getCountryList();		
        $viewData["afroProduct"] = $this->gatewaymodel->getAfroProduct();
		$viewData["stepWiseVideo"] = $this->gatewaymodel->getLevelStepVideo(1);
		$viewData["allProducts"] = $this->gatewaymodel->getAllProductsByUser($this->session->userdata('userId'));
		$viewData["step2Url"] = $this->gatewaymodel->getStep2Url();
		$viewData["cityList"] = $this->gatewaymodel->getCity();
		$viewData["zipList"] = array();
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
		//$viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
		//$viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
		//$viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
		//$viewData['url'] = $this->getGmailUrl();
        //$viewData["step2Url"] = $this->gatewaymodel->getStep2Url();

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
       $viewData['urlGmailYahoo'] = $this->getGmailUrl();
       $viewData["addedVendorId"] = $this->session->flashdata('addedVendorId');
       $viewData['levelWiseCounter'] = $this->gatewaymodel->getLevelWiseCount();
	   $viewData['catalogueCommisson'] = $this->gatewaymodel->getCatalogueCommissionDetails($this->session->userdata('userId'));
	   $viewData['infoListing'] = $this->gatewaymodel->getMyListingDetails($this->session->userdata('userId'));
	   $viewData['totalMembersUnderMeNew'] = $this->common_model->getTotalMembersUnderMeNew($this->session->userdata('userId'));// count of member logged in to site under me added by SB on 11/12/2015
	   //print_r($viewData["show_edit"]);exit;
	   $viewData['ctUserName'] = $this->common_model->getCTuname(trim($this->session->userdata('userId')));
	  //echo "+++++".$viewData['ctUserName'];exit;
	   $viewData['levelName'] = 1;// added by SB on 08/03/2016
	   $viewData['dEventValue']= array();
      // $viewData["categoryList"] = $this->common_model->fetch_category(100, 0);
       ############# Shift the code by subhendu 26-10-2016 ###########
             $emailID  = $this->session->userdata['emailId'];
             $userPositionDetails = $this->gatewaymodel->getUserLevelPositionByEmailId($emailID);
             $viewData['userPositionArray'] = $userPositionDetails;
			 //$viewData["categoryList"] = $this->common_model->fetch_category(100, 0);
          /* echo "<pre>";
          // print_r($userinfoArrayList);
           print_r($this->session->userdata);
           echo "</pre>";
echo $this->session->userdata['emailId'];
                    exit;   */
        ############# end of code By Subhendu #####################################
		
       $this->load->view('dashboard/dashboard', $viewData);
        
    }	
	
	

 public function apdashboard() { 
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
        //$viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
         $viewData["htmlBanners"] = $this->common_model->getAllBannerDetail(trim($this->session->userdata('userId')));// added by SB on 30/03/2016
		  
        $viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
        $viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
        $viewData["countryList"] = $this->gatewaymodel->getCountryList();
        $viewData["afroProduct"] = $this->gatewaymodel->getAfroProduct();
        $viewData["stepWiseVideo"] = $this->gatewaymodel->getLevelStepVideo(1);
        $viewData["allProducts"] = $this->gatewaymodel->getAllProductsByUser($this->session->userdata('userId'));
		//print_r($viewData["allProducts"]);exit;
        $viewData["step2Url"] = $this->gatewaymodel->getStep2Url();
        $viewData["cityList"] = $this->gatewaymodel->getCity();
		$viewData["zipList"] = array();
        $viewData["overView"] = $this->gatewaymodel->getOverViewOfLevel1($this->session->userdata('userType'),$this->session->userdata('userId'));//15/10/2015 ujjwal sana added 
        $viewData['massUserDetails'] = $this->gatewaymodel->getUserMassDetails($this->session->userdata('userId'));
        $viewData["categoryList"] = $this->gatewaymodel->getCategory();
		 
		$viewData['CT_Category']=$this->common_model->ct_category();
        $viewData['vendorsList'] = $this->gatewaymodel->getVendorsList(trim($this->session->userdata('userId')));
        $viewData["colorList"] = $this->gatewaymodel->getColor();
        $msgTypeDetails = $this->setMessage();  
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
        $tab = $this->setTabProduct();
        $viewData["openTabId"] = $tab["openTabId"];
        $viewData["productId"] = $tab["productId"];
        $viewData["list"] = $this->gatewaymodel->getprofile_picture($tb1,$id);
        //$viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
        //$viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
        //$viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
        //$viewData['url'] = $this->getGmailUrl();
        //$viewData["step2Url"] = $this->gatewaymodel->getStep2Url();
		
		$viewData['subcat'] = $this->gatewaymodel->getArticleList(18);
		
                if($viewData["productId"] > 0)
                {           
            $viewData["pDetails"] = $this->product_model->getProduct($viewData["productId"]);
            $viewData["offerDetails"] = $this->product_model->getOffer($viewData["productId"]);
            $subArticleID = $viewData["pDetails"][0]->productTypeID;
            $viewData['donateStatus'] = $viewData["pDetails"][0]->productDonate;
            $catNarticleID = $this->product_model->getCatIdArtId($subArticleID);
            $viewData['catID']= $catNarticleID['catId'];
            $viewData['artID']= $catNarticleID['articleId'];
            $viewData['artList'] = $this->gatewaymodel->getArticleList($catNarticleID['catId']);
			
			
			$viewData['subcat'] = $this->gatewaymodel->getArticleList(18);
			
            $viewData['productCategoryList'] = $this->gatewaymodel->getSubArticleList($catNarticleID['articleId']);
			$viewData["pColors"] = $this->product_model->getProductColors($viewData["productId"]);
            $viewData["pFiles"] = $this->product_model->getProductFiles($viewData["productId"]);
            $viewData["show_edit"]="show";          
             }
       $viewData['urlGmailYahoo'] = $this->getGmailUrl();
       $viewData["addedVendorId"] = $this->session->flashdata('addedVendorId');
       $viewData['levelWiseCounter'] = $this->gatewaymodel->getLevelWiseCount();
       $viewData['catalogueCommisson'] = $this->gatewaymodel->getCatalogueCommissionDetails($this->session->userdata('userId'));
	   
       $viewData['infoListing'] = $this->gatewaymodel->getMyListingDetails($this->session->userdata('userId'));
       $viewData['totalMembersUnderMeNew'] = $this->common_model->getTotalMembersUnderMeNew($this->session->userdata('userId'));// count of member logged in to site under me added by SB on 11/12/2015
       //print_r($viewData["show_edit"]);exit;
       $viewData['ctUserName'] = $this->common_model->getCTuname(trim($this->session->userdata('userId')));
      //echo "+++++".$viewData['ctUserName'];exit;
       $viewData['levelName'] = 1;// added by SB on 08/03/2016
	   
	   
       $viewData['dEventValue']= array();
	   
      // $viewData["categoryList"] = $this->common_model->fetch_category(100, 0);
       ############# Shift the code by subhendu 26-10-2016 ###########
             $emailID  = $this->session->userdata['emailId'];
             $userPositionDetails = $this->gatewaymodel->getUserLevelPositionByEmailId($emailID);
             $viewData['userPositionArray'] = $userPositionDetails;
             //$viewData["categoryList"] = $this->common_model->fetch_category(100, 0);
          /* echo "<pre>";
          // print_r($userinfoArrayList);
           print_r($this->session->userdata);
           echo "</pre>";
echo $this->session->userdata['emailId'];
                    exit;   */
        ############# end of code By Subhendu #####################################
        
        //$viewData['userDetails'] 	= $this->gatewaymodel->getUserDetails($this->session->userdata('userId'));
       //echo "<pre>";print_r($viewData);exit;
	   
	   $viewData['v_code'] = $this->random_str(8, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
	   //$viewData['v_code'] = var_dump($vCode);
	   
       $this->load->view('dashboard/ap-dashboard', $viewData);
        
    } 


					 
		 public function random_str($length, $keyspace)
		{
			
			//echo $length;
			//echo $keyspace;
			$str = '';
			
			$max = mb_strlen($keyspace, '8bit') - 1;
			for ($i = 0; $i < $length; $i++) {
				$str .= $keyspace[rand(0, $max)];
			}
			return $str;
			
		}				
	

	 public function edit_ap_profile(){
        $type 						= 'changePassword';
        $status 					= 'error';
		
        $userInfo 					= $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
        $fName						= $this->input->post('txtfname');
        $lName						= $this->input->post('txtlname');
        $email						= $this->input->post('txtemail');
        $address					= $this->input->post('txtaddress');
        $countryName				= $this->input->post('country_name');
        $cityName					= $this->input->post('profileCity');
        $stateName					= $this->input->post('txtstate');
        $zipName					= $this->input->post('txtzip');
        
        
        if( $fName != '' && $lName != '' && $email != '' && $countryName != '') {	
            $tbl 					= 'userinfo';
            $where					= array("uID"=>$this->session->userdata("userId"));
            $data 					= array(
            							"firstName"			=> $fName,
            							"lastName"			=> $lName,
            							"emailID"			=> $email,
            							"address"			=> $address,
            							"city"				=> $cityName,
            							"state"				=> $stateName,
            							"country"			=> $countryName,
            							"zip"				=> $zipName
            							) ;
            $update 				= $this->common_model->updateDataToTable($tbl, $where, $data );
            //$status 				= 'success';
            //$msg 					= "Profile data updated successfully.";
        } 
       
        /*$this->session->set_flashdata('type', $type);
        $this->session->set_flashdata('status', $status);
        $this->session->set_flashdata('msg', $msg);
       
		redirect(base_url()."dashboard/apdashboard");*/
		        
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
		$viewData['levelName'] = 1;// added by SB on 08/03/2016
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
                $retData["msg"] = "You have successfully updated Sponcer picture.";				
            }elseif($type == "monetizer_video"){
                $retData["msg"] = "You have successfully uploaded the Video.";				
            }elseif($type == "monetizer_banner"){
				$retData["msg"] = "You have successfully uploaded the Banner.";	
			}elseif($type == "monetizer_brochure"){
				$retData["msg"] = "You have successfully uploaded the Brochure.";	
			}elseif($type == "galleryImage"){
				$retData["msg"] = "You have successfully uploaded the Gallery Image.";	
			}elseif($type == "monetizer_ticket"){
				$retData["msg"] = "You have successfully uploaded the Ticket.";	
			}elseif($type == "cSecUpload"){
				$retData["msg"] = "You have successfully uploaded the Product.";	
			}elseif($type == "dEventAdd"){
				$retData["msg"] = "You have successfully added the Event.";	
			}elseif($type == "pUpload"){
                $retData["msg"] = "You have successfully uploaded your Product .";
            }elseif($type == "vUpload"){
                $retData["msg"] = "You have successfully added your Vendors Details.";
            }elseif($type == "profileStore"){
                $retData["msg"] = "You have successfully added your profile.";
            }elseif($type == "fListing"){
                $retData["msg"] = "You have successfully added your Free Listing on AFROWEBB.";
            }elseif($type == "deleteUser"){
                $retData["msg"] = "You have been successfully deleted this user.";
            }elseif($type == "inviteGmailFriend"){
                $retData["msg"] = "You have been successfully invited your Gmail's friend.";
            }elseif($type == "inviteYahooFriend"){
                $retData["msg"] = "You have been successfully invited your Yahoo's friend.";
            }elseif($type == "newMoneSignup"){
                $retData["msg"] = "You have been successfully registered with Us. Please check your mail for login Credentials.";
            }elseif($type == "newCTSignup"){
                $retData["msg"] = "You have been successfully registered with Us. Please check your mail.";
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
        $remoteFile = $this->config->item('gbe_base_url'). 'adminuploads/advert/' . $imgname; 
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
		header("Content-Type: application/force-download");
		//header('Cache-Control: public, no-cache');
	    //header('Content-Type: application/octet-stream');
		header('Content-Length: ' . filesize($remoteFile));
       // header("Content-Disposition: attachment; filename=\"$imgname\";");
	    header('Content-Disposition: attachment; filename="' . basename($remoteFile) . '"');
        header("Content-Transfer-Encoding: binary");
        readfile($remoteFile);
		
    }

    public function downloadVideo() {
        $video_id = $this->input->post('video_id');
        $viewData["video_id"] = $video_id;
        $this->load->view('youtube/getvideo', $viewData);
    }
    
    public function services($type = '',$pageId = 0){
		//print_r($type);
        
        if($type != ''){
			$status = 'error';
			
            $email = $this->input->post('email');
            $message = $this->input->post('message');
            if($email != "" && $message != ""){
                $retData = 2;
                if($type == "customer"){
                    $retData = $this->sendCustomerEmailToAdmin($email,$message);
					if($retData == 1){
						$status = 'success';
					}
                }elseif($type == "tech_support"){
                    $retData = $this->sendTechsupportEmailToAdmin($email,$message);
                    $retData = $this->sendTechsupportEmailToSenabi($email,$message);
					if($retData == 1){
						$status = 'success';
					}
                }elseif($type == "advertise"){
                    $retData = $this->sendAdvertiseEmailToAdmin($email,$message);
					if($retData == 1){
						$status = 'success';
					}
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
		//echo $retData."++++++".$type."==========="; print_r($status);exit;
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        //redirect(base_url()."dashboard");
		if($pageId !="")
		{
			redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh');
		}else{
			redirect(base_url()."dashboard");
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
            return 1;	
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
            return 1;	
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
            return 1;	
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
            return 1;	
        } else {
            return 2;	
        }	
        	
    }
    // send Image Link mail to admin
	  public function sendLinkToAdmin($for = 'Model',$msg = ''){
        $to = $this->_admin_email;
		if($for=='Model'){
			$subject = "Model Image Links";
			$message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Click the below link to view the Image Model.</td></tr>                   
                    <tr><td width="25%">&nbsp;</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">communitytreasures.co</td></tr>
                    </table>';
		}
		else{
			$subject = "Music Link";
			$message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Please Click the below link to to play music.</td></tr>
                    <tr><td width="25%">&nbsp;</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">communitytreasures.co</td></tr>
                    </table>';
		}
        
       
					
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
        	
    }
	
     function send_mail_raw($to = '', $subject = '', $message = '') {
        $from_email = "noreply@communitytreasures.co";
        $from_name = "communitytreasures.co";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
        $headers .= 'From: '.$from_name.' <'.$from_email.'>' . "\r\n";
        $headers .= 'Reply-To: '.$from_name.' <'.$from_email.'>' . "\r\n";
        $headers .= 'Return-Path: '.$from_name.' <'.$from_email.'>'."\n";    
		$testsend = mail('senabi.test05@gmail.com', $subject, $message, $headers);	// test mail added by SB on 09/03/2016	
        $send = mail($to, $subject, $message, $headers); 
        if($send) {
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
	// added by SB on 09/02/2016
	 public function addProfileStore($pageId=""){
        $type = 'profileStore';
        $status = 'error';
		if($pageId>0){
			$pageId  = $this->uri->segment(3, 0);
		}
		
        if($this->input->post('addProfile') != ''){
			$monitizerProfile = $this->common_model->getProfileDetail($this->session->userdata('userId'));
			
			
            $profile["artistName"] = trim($this->input->post('artistName'));
            $profile["artistPh"] = $this->input->post('artistPh');
			$profile["subCatId"] = $this->input->post('subCatList');// added by SB on 22/02/2016
            $profile["aboutMe"] = trim($this->input->post('aboutMe'));
            $profile["profileCity"] = $this->input->post('profileCity');
            $profile["profileCountry"] = trim($this->input->post('profileCountry'));
            $profile["profileZip"] = trim($this->input->post('profileZip'));
            $profile["profileSellerEmail"] = trim($this->input->post('profileSellerEmail'));
            $profile["profileSellerWebsite"] = $this->input->post('profileSellerWebsite');           
           
			
            $tbl = 'monitizer_profile_store';
			if(count($monitizerProfile)>0){
				
				$where = array("userId"=>$this->session->userdata('userId'));                
				$profileId = $this->common_model->updateDataToTable($tbl, $where, $profile);
			}
			else{
					
				$profile["userId"] = $this->session->userdata('userId');
				$profile["profileCreatedOn"] = date("Y-m-d H:i:s");
				$profileId = $this->common_model->insertDataToTable($tbl,$profile);
			}
            unset($profile);unset($tbl);
            if($profileId > 0){
                $status = 'success';
               // $this->session->set_flashdata('addedProfileId',$profileId);
            }
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        $this->session->set_flashdata('openTabId','tab6');
		if($pageId>0)
		{
			redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh');
		}
        else
		{
			redirect(base_url().'dashboard','refresh');
		}
    }
    public function addProduct($pageId = 0){
        
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
			if($pageId>0)
			{
				$tbl = 'music_monetizer_products';
				$productId = $this->common_model->insertDataToTable($tbl,$product);
			}else{
				$productId = $this->common_model->insertDataToTable($tbl,$product);
			}
            unset($product);unset($tbl);
            if($productId > 0){
					$this->allImages($productId,$pageId);
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
		if($pageId>0)
		{
			redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh'); 
		}else{
			 redirect(base_url()."dashboard");
		}
       
    }
	// added by SB on 15/02/2016
	  public function addCsection($pageId = 0){
        $type = 'cSecUpload';
        $status = 'error';
        if($this->input->post('updateTopSix') != ''){
          
            $product["productName"] = trim($this->input->post('topProductName'));
            $product["productDesc"] = $this->input->post('topProductDesc');
            $product["productCurrencyType"] = trim($this->input->post('topProductCurrencyType'));
            $product["productPrice"] = trim($this->input->post('topProductPrice'));
			// common image upload 
			$topProImage = $this->topSixFileUpload('topProImage','jpg');
			if($topProImage['status'] == 3)
			{
				$product['productFile'] = $topProImage['inputName'];	
			}
			
			
          
			$product["createdDate"] = date("Y-m-d H:i:s");
			//$product["forWebsite"] = 3;
            $product["addedBy"] = $this->session->userdata('userId');
			//$product["productDonate"] = trim($this->input->post('productDonate')); 
			if($pageId>0)
			{
				$tbl = 'music_monetizer_products';
				$productId = $this->common_model->insertDataToTable($tbl,$product);
			}
            unset($product);unset($tbl);
            if($productId > 0){
				
				$status = 'success';
				$msg = "You have successfully uploaded your product.";	
							
				$specificInsert = 0;
					$pageSpecificData = array();
					if($pageId==1){			  
					   // Beauty  detail
						
					}
					else if($pageId==2){			  
					   // Meetup detail	 
						$product["eventDate"] = trim($this->input->post('topEventDate'));
						$product["eventLocation"] = trim($this->input->post('topEventLocation'));
						$meetupFileData = $this->topSixFileUpload('topMeetupFile','pdf');
							if($meetupFileData['status'] == 3){
								$pageSpecificData['productSpecificFile'] = $meetupFileData['inputName'];
								
							}
						$specificInsert = 1;
					}
					else if($pageId==3){			  
					   // Model detail
					   $modelFiles = array();
					   
					   $modelFileData1 = $this->topSixFileUpload('topModelFile1','jpg');
							if($modelFileData1['status'] == 3){
								//$pageSpecificData['productSpecificFile'] = $modelFileData1['inputName'];
								$modelFiles[] = $modelFileData1['inputName'];
								$specificInsert = 1;
							}
					   $modelFileData2 = $this->topSixFileUpload('topModelFile2','jpg');
							if($modelFileData2['status'] == 3){
								//$pageSpecificData['productSpecificFile'] = $modelFileData2['inputName'];
								$modelFiles[] = $modelFileData2['inputName'];
								$specificInsert = 1;
							}
					   $modelFileData3 = $this->topSixFileUpload('topModelFile3','jpg');
							if($modelFileData3['status'] == 3){
								//$pageSpecificData['productSpecificFile'] = $modelFileData3['inputName'];
								$modelFiles[] = $modelFileData3['inputName'];
								$specificInsert = 1;
							}
					}
					else if($pageId==4){			  
					  // upload music file	
						
						$musicFileData = $this->topSixFileUpload('topMusicFileId','mp3');
							if($musicFileData['status'] == 3){
								$pageSpecificData['productSpecificFile'] = $musicFileData['inputName'];
								$specificInsert = 1;
							}
							
					}
					else if($pageId==5){
						// nutri detail
					}
					else if($pageId==6){
						// real estate
						$realData = array();
						$realData['proTblId'] = $productId;	
						$realData['house_for_sale'] = trim($this->input->post('house_for_sale'));						
						$realData['address'] = trim($this->input->post('area_name'));						
						$realData['bedrooms'] = trim($this->input->post('bedrooms'));
						$realData['bathrooms'] = trim($this->input->post('bathrooms'));
						$realData['receptions'] = trim($this->input->post('receptions'));
						$realData['sq_ft'] = trim($this->input->post('sq_ft'));						
						$realEstateFileData = $this->topSixFileUpload('realHouseImg','jpg');
							if($realEstateFileData['status'] == 3){
								$realData['p_img'] = $realEstateFileData['inputName'];
							}
						//p_img //addedBy
						$realData['addedBy'] = $this->session->userdata('userId');
						$realTblName ='top_seven_product';
						$realDataId = $this->common_model->insertDataToTable($realTblName,$realData);
						unset($realData);unset($realTblName);
						if($realDataId>0){
							$status = 'success';
							$msg = "You have successfully uploaded your product.";	
						}
						else{
							$msg = "Data not uploaded.";
						}
					}				
					
					// insert product specift data to table
					$specTblName ='ct_monetizer_products';	
					$pageSpecificData['userId'] = $this->session->userdata('userId');
					$pageSpecificData['proTblId'] = $productId;	
					$pageSpecificData['moneTypeId'] = $pageId;
					if($specificInsert == 1){	
					
						if(count($modelFiles)>0){
							//print_r($modelFiles);
							//echo "array 1 ".$modelFiles[0]; exit;
							$arrlength = count($modelFiles);
							for($i=0; $i < $arrlength; $i++){
								$pageSpecificData['productSpecificFile'] = $modelFiles[$i];
								$pageSpecificId = $this->common_model->insertDataToTable($specTblName,$pageSpecificData);
							}
						}
						else{
							$pageSpecificId = $this->common_model->insertDataToTable($specTblName,$pageSpecificData);
						}
										
						unset($pageSpecificData);unset($specTblName);
						if($pageSpecificId>0){
							$status = 'success';
							$msg = "You have successfully uploaded your product.";	
						}
						else{
							$msg = "Data not uploaded.";
						}
					}
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
	// event section added by SB on 11/03/2016
	public function eventAdd($pageId = 0){
		
		$type = 'dEventAdd';
        $status = 'error';
		
		if($this->input->post('moneEventBtn') != ''){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
            $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required'); 
			$this->form_validation->set_rules('end_date', 'End Date', 'trim|required'); 
			$this->form_validation->set_rules('country_id', 'Country', 'trim|required'); 
			$this->form_validation->set_rules('city_id', 'City', 'trim|required'); 
			$this->form_validation->set_rules('zip_code_id', 'Zip code', 'trim|required'); 
			//$this->form_validation->set_rules('location', 'Location', 'trim|required');
			$this->form_validation->set_rules('desc', 'Description', 'trim|required');
			
			// check if data exist update table  added by SB on 11/03/2016
			$tbl = 'ct_mone_event';
			$where['userId'] = $this->session->userdata('userId');
			$selectedData = "id,image_path,pdf";
			$chkData = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
			
            $inData['name'] = trim($this->input->post('name'));
            $inData['contact_number'] = trim($this->input->post('contact_number'));
            $inData['start_date'] = trim($this->input->post('start_date'));
            $inData['end_date'] = trim($this->input->post('end_date'));
            //$inData['location'] = trim($this->input->post('location'));
            $inData['country_id'] = trim($this->input->post('country_id'));
            $inData['city_id'] = trim($this->input->post('city_id'));
            $inData['zip_code_id'] = trim($this->input->post('zip_code_id'));
            $inData['forWebsite'] = $this->forWebsite;			
            $inData['desc'] = $this->input->post('desc');
			
			$imgData = $this->otherFileUpload('image_path','jpg');
			
			if($imgData['status'] == 3){
				$inData['image_path'] = $imgData['inputName'];
			}else{
				$this->imageStatus = $imgData['status'];
				//$this->form_validation->set_rules('image_path', 'Image', 'trim|callback_checkImage');
			}
			
			$pdfData = $this->otherFileUpload('pdf','pdf');
			if($pdfData['status'] == 3){
				$inData['pdf'] = $pdfData['inputName'];
			}else{
				$this->imageStatus = $pdfData['status'];
				//$this->form_validation->set_rules('pdf', 'PDF', 'trim|callback_checkPdf');
			}
			
			if ($this->form_validation->run() != FALSE) {
				$tbl = "ct_mone_event";
				if($chkData[0]->id > 0){
					if($imgData['inputName']!=''){
						$path = $this->config->item('gbe_image_upload_path').'useruploads/';
						$tempImg = $chkData[0]->image_path;
						if(file_exists($path.$tempImg)){
							unlink($path.$tempImg);
						}
					}
					if($pdfData['inputName']!=''){
						$pdfPath = $this->config->item('gbe_image_upload_path').'useruploads/events/';
						$tempPdf = $chkData[0]->pdf;
						if(file_exists($path.$tempPdf)){
							unlink($path.$tempPdf);
						}
					}
					
					$where = array("userId"=>$this->session->userdata('userId'));
					$this->common_model->updateDataToTable($tbl, $where, $inData);
				}
				else{
					$inData['userId'] = $this->session->userdata('userId');
					$this->common_model->insertDataToTable($tbl, $inData);
				}
        		
        		$viewData['setVal'] = array();
				$viewData['msg'] = 'You have successfully added the event details.';
				$viewData['status'] = 'success';
				$status = 'success';
			}else{
				$viewData['setVal'] = $inData;
				$viewData['msg'] = 'Please check the error(s) as below.';
				$viewData['status'] = 'error';
			}
		}
				
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh');	
	}
    
    public function allImages($pId = 0,$monetizerId= 0){
        $insertImg = array();
        $insertImg["fileType"] = 0;
        $insertImg["productId"] = $pId;
		
        if($_FILES["img_1"]["name"] != ""){
            $fileName = "img_1";
            $insertImg["isMain"] = 1;
            $ret[1] = $this->addProductImages($fileName,$insertImg,$monetizerId);
        }
		
        if($_FILES["img_2"]["name"] != ""){
            $fileName = "img_2";
            $insertImg["isMain"] = 0;
            $ret[2] = $this->addProductImages($fileName,$insertImg,$monetizerId);
        }
        if($_FILES["img_3"]["name"] != ""){
            $fileName = "img_3";
            $insertImg["isMain"] = 0;
            $ret[3] = $this->addProductImages($fileName,$insertImg,$monetizerId);
        }
        if($_FILES["img_4"]["name"] != ""){
            $fileName = "img_4";
            $insertImg["isMain"] = 0;
            $ret[3] = $this->addProductImages($fileName,$insertImg,$monetizerId);
        }
        //echo "<pre>";print_r($ret);
        return true;
    }
    
    /*public function testUpload(){
        $insertImg 						= array();
        $insertImg["fileType"] 			= 0;
        $insertImg["productId"] 		= '53';
        
        if($_FILES["img_1"]["name"] != ""){
            $fileName = "img_1";
            $insertImg["isMain"] = 1;
            $ret[1] = $this->addProductImages($fileName,$insertImg,$monetizerId);
        }
        //echo "<pre>";print_r($ret);
        return true;
    }*/
    
    public function addProductImages($fileName = "", $insertImg = array(), $monetizerId = 0) {
        $this->load->library('upload');
		if($monetizerId>0)
		{
			$config['upload_path'] =$this->config->item('gbe_image_upload_path').'topsixproduct/';
		}else{
			$config['upload_path'] =$this->config->item('gbe_image_upload_path').'adminuploads/product_files/images/';
		}
			
		
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '200000';
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['file_name'] = 'product-'.$insertImg["productId"].'-'.time();
        //print_r($config);exit;
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
		if($monetizerId<1)
		{
			$imgId = $this->common_model->insertDataToTable($tbl,$insertImg);
		}
        //print_r($ret);exit;
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
	// added by SB on 15/02/2016
	 public function addMusicFile($pId = 0){
        if($_FILES["musicFileId"]["name"] != ""){
            $path = $this->config->item('gbe_image_upload_path').'CT_sponcer_img/';
            $allowedExts = array("mp3","mp4");
            $temp = explode(".", $_FILES["musicFileId"]["name"]);
            $extension = strtolower(end($temp));
            if (($_FILES["musicFileId"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $_FILES["musicFileId"]["name"] = 'music-'.$pId.'-'.time() . "." . $extension;
                if ($_FILES["musicFileId"]["error"] > 0) {
                    $retData['status'] = 0; //error
                    $retData['errorMsg'] = 'The image has an error' . $_FILES["musicFileId"]["error"]; //error
                    $retData['name'] = $_FILES["musicFileId"]["name"];
                } else {
                    move_uploaded_file($_FILES["musicFileId"]["tmp_name"], $path . $_FILES["musicFileId"]["name"]);
                    $tbl = 'music_monetizer_products';
                    $upMusicData["productFile"] = $_FILES["musicFileId"]["name"];
					$where = array("productID"=>$pId);                
					$update = $this->common_model->updateDataToTable($tbl, $where, $upMusicData);
                   
                }
            }
        }
        return true;
    }
	// added by SB on 08/07/2015
	 
    
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
        $type 		= 'changePassword';
        $status 	= 'error';
		
        $userInfo = $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
        if(!empty($_POST))
		{
            $oldPassword = trim($this->input->post('oldpassword'));
            $newPassword = trim($this->input->post('password'));
			$confirmpass=trim($this->input->post('cpassword'));		
			
            if($userInfo[0]["password"] != $oldPassword)
			{
                
				echo "Please enter correct Old Password.";
            }			
			else{
				
                $tbl = 'userinfo';
                $where = array("uID"=>$this->session->userdata("userId"));
                $data = array("password"=>$newPassword) ;
                $update = $this->common_model->updateDataToTable($tbl, $where, $data );
                
				echo "You have been successfully updated the password.";
            }
			
        } 
       
       /* $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        $this->session->set_flashdata('msg',$msg);
        if($userInfo[0]["account_type_ap"] == '1') {
			redirect(base_url()."dashboard/apdashboard");
		} else {
			redirect(base_url()."dashboard");
		}*/
        
    }
    
 // added by SB on 25/06/2015
	public function getArticleList($cId = 0){
	 if($cId >0)
	 {
		 $catId = trim($_POST["Music_catId"]);
	 }else{
		 $catId = trim($_POST["catId"]);
	 }
		
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
			$cityList.= '<option value="'.$cityVal->id.'">'.$cityVal->city.'</option>';
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
					$cityList.= '<option value="'.$cityVal->id.'">'.$cityVal->city.'</option>';
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
		$this->session->unset_userdata('cityID');
		$this->session->unset_userdata('catID');
		$viewData["ct_userID"] = $this->getIdfromUname($CTuname);
		
		//$viewData["ct_userID"]=trim($this->session->userdata('userId'));
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData["cityList"] = $this->gatewaymodel->getCity();
		$viewData['CT_Banner']=$this->common_model->getSiteBanner();// added by SB on 23/02/2016
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['monetizer_event']=$this->common_model->getEvent();// added by SB 09/03/2016
		$viewData['category_details']=$this->common_model->cate_description();
		
		//print_r($viewData['category_details']);exit;
		$viewData['CT_FooterBanner']=$this->common_model->ct_footerBanner();// added by SB on 25/02/2016
		$viewData['CT_partnerVideo']=$this->common_model->getCT_partnerImgVideo(181);// video ID 181 for Partner video 
		//print_r($viewData);exit;
		//$uname="ssss";
    $viewData['admin_catalog_configArray']=$this->common_model->fetch_admin_catalog_config();
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
	// co creator week added by SB on 29/03/2016
	public function coCreatorWeek($eventId = 0)
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData["cityList"] = $this->gatewaymodel->getCity();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		//$viewData['category_details']=$this->common_model->catSubcatDesc($catId);// new function by SB 
		//$viewData['monetizer_user']=$this->common_model->getmonetizer_user();// blocked by SB on 22/02/2016
		//$viewData['monetizer_user']=$this->common_model->getMonetizerUser($catId);// added by SB on 22/02/2016
		$viewData['monetizer_event']=$this->common_model->getEvent();
		$viewData['CT_FooterBanner']=$this->common_model->ct_footerBanner();// added by SB on 25/02/2016
		//print_r($viewData['monetizer_user']);exit;
		
		$viewData['event_description']=$this->common_model->event_details($eventId);

		$this->load->view('ct_catalog/co_createrWeek', $viewData);
	}
	// Category page detail Added by SB on 01/02/2016
	public function search_header()
	{//echo $this->input->post('gotoMainCatBtn'); die;
	    $this->session->unset_userdata('cityID');
		$this->session->unset_userdata('catID');
		$viewData["cityList"] = $this->gatewaymodel->getCity();
		$viewData['CT_Category']=$this->common_model->ct_category();
		if ($this->input->post('gotoMainCatBtn')== 'Go!') 
		{
			$cityID=$this->input->post('pcity');
			$catID=$this->input->post('ct_category_id');
			//echo $catID;
			$this->session->set_userdata('cityID', $cityID);
			$this->session->set_userdata('catID', $catID);
			$viewData['CT_offer_list']=$this->common_model->ct_cityproduct_list($catID,$cityID);
			
		}
		//else{$viewData['CT_offer_list']=$this->common_model->ct_product_list($catId);}	
		//if(empty($viewData['CT_offer_list']))
		//{
		//$viewData['CT_offer_list_2subcat']=$this->common_model->ct_cityproduct_list_2subcat();
	
		//}
	$this->load->view('ct_catalog/searchDetail', $viewData);	
	}
	
	public function category_detail($catId = 0)
	{
		//echo $catId; die;
		$viewData=array();
		$this->session->unset_userdata('cityID');
		$this->session->unset_userdata('catID');
		$viewData["cityList"] = $this->gatewaymodel->getCity();
		$viewData['CT_Category']=$this->common_model->ct_category();
		/*if ($this->input->post('gotoMainCatBtn')== 'Go!') 
		{
			$cityID=$this->input->post('pcity');
			$catID=$this->input->post('ct_category_id');
			$this->session->set_userdata('cityID', $cityID);
			if($catID==""){
			$viewData['CT_offer_list']=$this->common_model->ct_cityproduct_list($cityID);
			}
			else{$viewData['CT_offer_list']=$this->common_model->ct_cityproduct_list($catId,$cityID);}
			
		}
		else{
			$viewData['CT_offer_list']=$this->common_model->ct_product_list($catId);
			}*/
			
		//if(empty($viewData['CT_offer_list']))
		//{
			//if ($this->input->post('gotoMainCatBtn')== 'Go!') 
			//{
			//$cityID=$this->input->post('pcity');
			//$catID=$this->input->post('ct_category_id');
			//$this->session->set_userdata('cityID', $cityID);
			//if($catID==""){
			$viewData['CT_offer_list_2subcat']=$this->common_model->ct_cityproduct_list_2subcat($catId);
		    //} 
			//else{$viewData['CT_offer_list_2subcat']=$this->common_model->ct_cityproduct_list_2subcat($catID,$cityID);}
			//}
		//else{
			
			//$viewData['CT_offer_list_2subcat']=$this->common_model->ct_product_list_2subcat($catId);
		//}	
		//}
		//print_r($viewData['CT_offer_list']);exit;
		
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['category_details']=$this->common_model->catSubcatDesc($catId);// new function by SB 
		
		//$viewData['monetizer_user']=$this->common_model->getmonetizer_user();// blocked by SB on 22/02/2016
		$viewData['monetizer_user']=$this->common_model->getMonetizerUser($catId);// added by SB on 22/02/2016
		$viewData['monetizer_event']=$this->common_model->getEvent();
		$viewData['CT_FooterBanner']=$this->common_model->ct_footerBanner();// added by SB on 25/02/2016
		//print_r($viewData['monetizer_user']);exit;
		if($catId != "")
		{
			$viewData['product_description']=$this->common_model->product_desc($catId);
		}/*else{
			$catId=236;
			$viewData['product_description']=$this->common_model->product_desc($catId);
		}*/
		$this->load->view('ct_catalog/categoryDetail', $viewData);
	}
	public function offer_detail($catId = 0)
  {
    $viewData=array();
    $viewData['CT_Category']=$this->common_model->ct_category();
    $viewData['CT_offer_list']=$this->common_model->ct_offer_list($catId);
    $viewData['CT_Monetizer']=$this->common_model->monetizer_list();
    $viewData['category_details']=$this->common_model->catSubcatDesc($catId);// new function by SB 
    
    //$viewData['monetizer_user']=$this->common_model->getmonetizer_user();// blocked by SB on 22/02/2016
    $viewData['monetizer_user']=$this->common_model->getMonetizerUser($catId);// added by SB on 22/02/2016
    $viewData['monetizer_event']=$this->common_model->getEvent();
    $viewData['CT_FooterBanner']=$this->common_model->ct_footerBanner();// added by SB on 25/02/2016
    //print_r($viewData['monetizer_user']);exit;
    if($catId != "")
    {
      $viewData['product_description']=$this->common_model->product_desc($catId);
    }/*else{
      $catId=236;
      $viewData['product_description']=$this->common_model->product_desc($catId);
    }*/
    $this->load->view('ct_catalog/offerDetail', $viewData);
  }
	public function product_view_List($productId = 0)
	{
		
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['CT_offer_list']=$this->common_model->ct_product_list($productId);
		
		//$viewData['category_details']=$this->common_model->cate_description();// blocked by SB on 02/02/2016
		$catId = 0;
		if($productId != ""){
			$catId = $this->common_model->getParentId($productId);
		}
		$viewData['category_details']=$this->common_model->catSubcatDesc($catId);// added by SB on 02/02/2016
		//$viewData['monetizer_user']=$this->common_model->getmonetizer_user();
		$viewData['monetizer_user']=$this->common_model->getMonetizerSubCatUser($productId);// productId is subCatId 
		$viewData['monetizer_event']=$this->common_model->getEvent();
		$viewData['CT_FooterBanner']=$this->common_model->ct_footerBanner();// added by SB on 25/02/2016
		//print_r($viewData['monetizer_user']);exit;
		if($productId != "")
		{
			$viewData['product_description']=$this->common_model->subCatDesc($productId);
		}else{
			$productId=236;
			$viewData['product_description']=$this->common_model->subCatDesc($productId);
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
	
	 public function ct_signup()
	{
		 $viewData = array();
		 $email_Id = trim($this->input->post('email'));
		if($email_Id != '')
		{
			$type = 'newCTSignup';
			//$emailId = trim($this->input->post('email'));
			$viewData["styleStatus"] = "none";
			$this->load->library('form_validation');
			$this->form_validation->set_rules('signUpEmail', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$viewData["parentID"] = $this->getParentId();
			$viewData['name'] = "new User";//trim($this->input->post('signUpName'));
			$viewData['surname'] = "";
			$viewData['cellno'] = "";
			$viewData['emailAddr'] =trim($this->input->post('email'));
			$viewData['city'] = "";
			$viewData['skypeID'] = "";
			if($viewData["parentID"]!=1000){
				$generalUserType =	$this->common_model->checkIsMonetizer($viewData["parentID"]);
			}
			else{
				$generalUserType ='general';
			}
			
			$viewData['userType'] = "PAYING USER";
			$password = $this->generatePassword();
			$viewData['password'] = $password;
			$viewData['forWebsite'] = 2;
			if ($this->form_validation->run() == FALSE)
			 {
				 //echo "1";exit;
				 
				$signupId = $this->gatewaymodel->insertData($viewData);
				$this->insertGeneralUserType($signupId,$generalUserType);     
				$this->sendEmailToUser($viewData);
				//$this->sendEmailToAdmin($viewData);				
				$msg = "success";
				$this->session->set_flashdata('msg',$msg);
				$this->session->set_flashdata('type',$type);
			 }
			else
			{	
				//echo "2";exit;
				$msg = "error";
				$this->session->set_flashdata('errNameMsg',form_error('signUpName'));
				$this->session->set_flashdata('errEmailMsg',form_error('signUpEmail'));
			}
		 $redirectUrl = base_url() . 'dashboard/CT_catalog/'.$viewData["parentID"];
		  redirect($redirectUrl, 'refresh');
       	}
		 else
		 {
			$viewData=array();
			$viewData["ct_userID"] = $this->getParentId();
			//$viewData["ct_userID"]=trim($this->session->userdata('userId'));
			$viewData['CT_Category']=$this->common_model->ct_category();
			$viewData['CT_Banner']=$this->common_model->getSiteBanner();// added by SB on 23/02/2016
			$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
			$viewData['monetizer_event']=$this->common_model->getEvent();// added by SB 09/03/2016
			$viewData['category_details']=$this->common_model->cate_description();
			$viewData['CT_FooterBanner']=$this->common_model->ct_footerBanner();// added by SB on 25/02/2016
        	$viewData['CT_partnerVideo']=$this->common_model->getCT_partnerImgVideo(181);// video ID 181 for Partner video 
			$msg = "error";  
			 $this->session->set_flashdata('msg',$msg);
			$this->load->view('ct_catalog/home', $viewData);
		 }
		// echo "========";exit;
		// $this->session->set_flashdata('msg',$msg);
	}
	
    private function sendEmailToUser($data = array()) {
		//print_r($data['emailAddr']);exit;
        $this->_to_email = $data['emailAddr'];
		//$this->_password=$data['password'];
        $this->_subject = 'Sign up confirmation mail';
        /*
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
	<tr><td>Thank you very much.</td></tr>
	<tr><td>communitytreasures.co</td></tr>	
  </tbody>
</table></body></html>';
		*/
		
		$this->_message = 'Testing Mail';
		

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
        $headers .= "Bcc:senabi.test01@gmail.com"."\n";
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
        
        $viewData["SwitchOnMembers"] = $this->gatewaymodel->countSwitchOnMembers($this->session->userdata('userId'));
        $viewData["mySignUps"] = $this->gatewaymodel->countMySignUps($this->session->userdata('userId'));
        $viewData["totalMembers"] = $this->gatewaymodel->countTotalMembers($this->session->userdata('userId'));
       // $viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
	   $viewData["htmlBanners"] = $this->common_model->getAllBannerDetail(trim($this->session->userdata('userId')));// added by SB on 30/03/2016
        $viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
        $viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
		$viewData["countryList"] = $this->gatewaymodel->getCountryList();		
        $viewData["afroProduct"] = $this->gatewaymodel->getAfroProduct();
		$viewData["stepWiseVideo"] = $this->gatewaymodel->getLevelStepVideo(1);
		$viewData["allProducts"] = $this->gatewaymodel->getAllProductsByUser($this->session->userdata('userId'));
		$viewData["step2Url"] = $this->gatewaymodel->getStep2Url();
				
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
		//$viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
		$viewData["htmlBanners"] = $this->common_model->getAllBannerDetail(trim($this->session->userdata('userId')));// added by SB on 30/03/2016
		$viewData['urlGmailYahoo'] = $this->getGmailUrl();        
		
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
       $viewData['urlGmailYahoo'] = $this->getGmailUrl();
       $viewData["addedVendorId"] = $this->session->flashdata('addedVendorId');
       $viewData['levelWiseCounter'] = $this->gatewaymodel->getLevelWiseCount();
	   $viewData['catalogueCommisson'] = $this->gatewaymodel->getCatalogueCommissionDetails($this->session->userdata('userId'));
	   $viewData['infoListing'] = $this->gatewaymodel->getMyListingDetails($this->session->userdata('userId'));
	   $viewData['totalMembersUnderMeNew'] = $this->common_model->getTotalMembersUnderMeNew($this->session->userdata('userId'));// count of member logged in to site under me added by SB on 11/12/2015
	   //$viewData['sponcer_pic']=$this->common_model->getCtSponcerPicture($this->session->userdata('userId'));// blocked by SB on 09/02/2016
	   $viewData['monetizerProfile']=$this->common_model->getProfileDetail($this->session->userdata('userId'));

	   $viewData['topSixPro']=$this->common_model->Top_six_Product_music($this->session->userdata('userId'));// added BY SB on 02/03/2016		
	   $viewData['dEventValue']=$this->common_model->getCT_MoneEvent($this->session->userdata('userId'));// array(); // added by SB on 16/03/2016
	   // echo $viewData['dEventValue'][0]['city_id']."++++<br>";
		//print_r($viewData['dEventValue']); exit;
		
	   if($viewData['dEventValue'][0]['country_id']!=""){
		   $viewData["cityList"] = $this->gatewaymodel->getCityListByCountryId($viewData['dEventValue'][0]['country_id']);     // added by SB on 15/03/2016
	   }
	   else{ 
		   $viewData["cityList"] = $this->gatewaymodel->getCityListByCountryId(0);
	   }
	   
	  if(isset($viewData['dEventValue'][0]['city_id'])){
		   $viewData["zipList"] = $this->gatewaymodel->getZipListByCityId($viewData['dEventValue'][0]['city_id']);// added by SB on 15/03/2016
	   }
	   else{ 
		   $viewData["zipList"] = "";// added by SB on 15/03/2016
	   }

	   $viewData['sponcerPics']=$this->common_model->getCtAllSponcer($this->session->userdata('userId'));//fetch all 3 sponcer images  added by SB on 09/02/2016 
	   $viewData['moneVideoLinks']=$this->common_model->getCtAllVideo($this->session->userdata('userId'));//fetch all 4 Video Links  added by SB on 11/02/2016 
	   $viewData['moneBannerImage'] = $this->common_model->getBannerDetail($this->session->userdata('userId'));// added by SB on 11/02/2016
	   $viewData['galleryPics']=$this->common_model->getCtAllGalleryImg($this->session->userdata('userId'));// Added by SB on 11/02/2016
	   $viewData['brochure']=$this->common_model->getBrochureDetail($this->session->userdata('userId'));// Added by SB on 11/02/2016
	   $viewData['source_pic']=$this->common_model->getCtSourcePicture($pageId);
	   $viewData['myTickets'] = $this->common_model->getCtTickets($this->session->userdata('userId'));// added by SB on 17/02/2016
	   $viewData["stepWiseMoneVideo"] = $this->common_model->getMonetizerLevelStepVideo();// added by SB on 07/03/2016
	   //print_r($viewData['source_pic']);exit;
		if($pageId != '')
		{
			$viewData['mone_into_video'] = $this->common_model->getCT_AllVideo($pageId);// added by SB on 03/03/2016
			$viewData["allMoneProducts"] = array();
			$moneCatId =0;// default set 0  added by SB on 22/02/2016
		   if($pageId == 1)
		   {
			   $viewData['ct_url']="BEAUTY SUITE";
			   $viewData['tab6Name']="Beauty Suite";
			   $viewData['ct_product']="BeautyMonetizer_buy/";
			   $moneCatId =260;
		   }
		   else if($pageId == 2)
		   {
			   $viewData['ct_url']="MEETUPS SUITE";
			   $viewData['tab6Name']="Meet Up Suite";
			   $viewData['ct_product']="meetsup_buy";
			   $moneCatId = 610;
			  // $viewData["allMoneProducts"] = $this->common_model->topSixPageSpecific($this->session->userdata('userId'),2);// added BY SB on 02/03/2016
		   }else if($pageId == 3)
		   {
			   $viewData['ct_url']="MODELS SUITE";
			   $viewData['tab6Name']="Models Suite";
			   $viewData['ct_product']="models_buy";
			   $moneCatId = 264;
			   
		   }else if($pageId == 4)
		   {
			   $viewData['ct_url']="MUSIC SUITE";
			   $viewData['tab6Name']="Music Suite";
			   $viewData['ct_product']="nutri_buy";
			   $moneCatId = 265;
			   
		   }else if($pageId == 5)
		   {
			   $viewData['ct_url']="NUTRI SUITE";
			   $viewData['tab6Name']="Nutri Suite";
			   $viewData['ct_product']="nutri_buy";
			   $moneCatId = 534;
		   }else if($pageId == 6)
		   {
			    $viewData['ct_url']="Real Estate";
				$viewData['tab6Name']="Real Estate";
				$viewData['ct_product']="real_buy";
				$moneCatId = 272;
		   }
			$viewData['ct_pageId']=$pageId;
			if($pageType!=""){
				if($pageType == "edit"){
					$viewData['pag']="show_edit";
				}
			}
		// added by SB on 22/02/2016
		$viewData['subCatList'] = $this->common_model->subCatList($moneCatId);	
	   }
	   $viewData['levelName'] = 1;// added by SB on 08/03/2016
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
	// other File upload and check added by SB on 03/02/2016
	public function otherFileUpload($inputName,$inputType){
		$retData['status'] = 1;
		$retData['inputName'] = '';
		if ($_FILES[$inputName]['name'] != "") {
			if($inputType=="mp3"){
				$allowedExts = array("mp3");
			}elseif($inputType=="pdf"){
				$allowedExts = array("pdf");
			}else{
				$allowedExts = array("jpg","png","jpeg");
			}
			
			$temp = explode(".", $_FILES[$inputName]["name"]);
			$extension = strtolower(end($temp));
			if (($_FILES[$inputName]["size"] < 20000000) && in_array($extension, $allowedExts)) {
				$_FILES[$inputName]["name"] = $inputName.'-'.time(). "." . $extension;
				if ($_FILES[$inputName]["error"] > 0) {
					$retData['status'] = 2;
				}else{
					if($inputType=="pdf"){
						$path = $this->config->item('gbe_image_upload_path').'useruploads/events/';
					}
					else{
						$path = $this->config->item('gbe_image_upload_path').'useruploads/';
					}
					
					//$this->common_model->imageUnlinkPath()."useruploads/";
					
					move_uploaded_file($_FILES[$inputName]["tmp_name"], $path.$_FILES[$inputName]["name"]);

					//$tempImg = trim($this->input->post('tempImage'));
					//if(file_exists($path.$tempImg)){
					//	unlink($path.$tempImg);
					//}
					$retData['inputName'] = $_FILES[$inputName]["name"];
					$retData['status'] = 3;
				}
			}else{
				$retData['status'] = 2;
			}
		}
		return $retData;
	}
	// other File upload and check added by SB on 03/02/2016
	public function topSixFileUpload($inputName,$inputType){
		$retData['status'] = 1;
		$retData['inputName'] = '';
		if ($_FILES[$inputName]['name'] != "") {
			if($inputType=="mp3"){
				$allowedExts = array("mp3");
			}elseif($inputType=="pdf"){
				$allowedExts = array("pdf");
			}else{
				$allowedExts = array("jpg","png","jpeg");
			}
			
			$temp = explode(".", $_FILES[$inputName]["name"]);
			$extension = strtolower(end($temp));
			if (($_FILES[$inputName]["size"] < 20000000) && in_array($extension, $allowedExts)) {
				$_FILES[$inputName]["name"] = $inputName.'-'.time(). "." . $extension;
				if ($_FILES[$inputName]["error"] > 0) {
					$retData['status'] = 2;
				}else{
					$path = $this->config->item('gbe_image_upload_path').'topsixproduct/';
					//$this->common_model->imageUnlinkPath()."topsixproduct/";
					
					move_uploaded_file($_FILES[$inputName]["tmp_name"], $path.$_FILES[$inputName]["name"]);
					$retData['inputName'] = $_FILES[$inputName]["name"];
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
	// common function for page added by SB on 18/02/2016
	public function productCommon_buy($uid="",$moneType ,$next=0)
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['monetizerDetail']=$this->common_model->getMonetizerDetail($uid);		
		$viewData['allSponcer']= $this->common_model->getCtAllSponcer($uid);// added by SB on 04/02/2016
		$viewData['allVideo']= $this->common_model->getCtAllVideo($uid);// added by SB on 05/02/2016
		$viewData['ctBrochure']= $this->common_model->getBrochureDetail($uid);// added by SB on 12/02/2016
		if($moneType==4 || $moneType==3 || $moneType==2){
			$viewData['CT_product']=$this->common_model->topSixPageSpecific($uid ,$moneType);// moneTypeId is 4 for music
		}
		elseif($moneType==1 || $moneType==5){
			$viewData['CT_product']=$this->common_model->Top_six_Product_music($uid);
		}
		else if($moneType==6){
			$viewData['CT_product']=$this->common_model->top_six_productReal($uid);
		}
		if($moneType==2){
			$viewData['next']=$next;
		}
		$viewData['CT_partnerVideo']=$this->common_model->getCT_partnerVideo(181);// video ID 181 for Partner video 
		$viewData['CT_ticket']=$this->common_model->getCtTickets($uid);
		$viewData['CT_FooterBanner']=$this->common_model->ct_footerBanner();// added by SB on 25/02/2016
		$viewData['ct_userID'] = $uid; // added by SB on 12/02/2016
		$viewData['moneType'] = $moneType;
		if($moneType==4 || $moneType==2){
			
			$viewData['bannerDetail']=$this->common_model->getBannerDetail($uid);
			$viewData['monetizerProfile']=$this->common_model->getProfileDetail($uid);// get detail of monetizer added by SB on 04/02/2016
			$viewData['monetizerGallery']=$this->common_model->getCtAllGalleryImg($uid);
			
			$this->load->view('ct_catalog/musicMeetup_product_buy', $viewData);
		}
		else {
			
			$this->load->view('ct_catalog/modelRealBeautyNutri_product_buy', $viewData);
		}
	}
	public function BeautyMonetizer_buy($uid="")
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();//for footer and dropdown
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();//for six monetizer
		$viewData['monetizerDetail']=$this->common_model->getMonetizerDetail($uid);// get detail of monetizer added by SB on 05/02/2016
		$viewData['allSponcer']= $this->common_model->getCtAllSponcer($uid);// added by SB on 05/02/2016
		$viewData['allVideo']= $this->common_model->getCtAllVideo($uid);// added by SB on 05/02/2016
		$viewData['CT_product']=$this->common_model->Top_six_Product($uid);
		$viewData['ct_userID'] = $uid; // added by SB on 12/02/2016
		//print_r($viewData);exit;
		$this->load->view('ct_catalog/beauty_product_buy', $viewData);
	}
	
	public function nutri_buy($uid="")
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['monetizerDetail']=$this->common_model->getMonetizerDetail($uid);// get detail of monetizer added by SB on 05/02/2016
		$viewData['allSponcer']= $this->common_model->getCtAllSponcer($uid);// added by SB on 05/02/2016
		$viewData['allVideo']= $this->common_model->getCtAllVideo($uid);// added by SB on 05/02/2016
		$viewData['CT_product']=$this->common_model->Top_six_Product($uid);
		$viewData['ct_userID'] = $uid; // added by SB on 12/02/2016
		$this->load->view('ct_catalog/nutri_product_buy', $viewData);
	}
	public function meetsup_buy($uid="",$next= 0)
	{
		$viewData=array();
		//print_r($next);exit;
		$viewData['CT_userId']=$this->session->userdata('userId');
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['monetizerDetail']=$this->common_model->getMonetizerDetail($uid);// get detail of monetizer added by SB on 05/02/2016
		$viewData['allSponcer']= $this->common_model->getCtAllSponcer($uid);// added by SB on 05/02/2016
		$viewData['allVideo']= $this->common_model->getCtAllVideo($uid);// added by SB on 05/02/2016
		$viewData['CT_product']=$this->common_model->Top_six_Product($uid);
		$viewData['next']=$next;
		$viewData['ct_userID'] = $uid; // added by SB on 12/02/2016
		//print_r($viewData);exit;
		$this->load->view('ct_catalog/meetups_product_buy', $viewData);
	}
	public function models_buy($uid="")
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['monetizerDetail']=$this->common_model->getMonetizerDetail($uid);// get detail of monetizer added by SB on 05/02/2016
		$viewData['allSponcer']= $this->common_model->getCtAllSponcer($uid);// added by SB on 05/02/2016
		$viewData['allVideo']= $this->common_model->getCtAllVideo($uid);// added by SB on 05/02/2016
		$viewData['ctBrochure']= $this->common_model->getBrochureDetail($uid);
		$viewData['CT_product']=$this->common_model->topSixPageSpecific($uid ,3);
		$viewData['CT_ticket']=$this->common_model->getCtTickets($uid);
		$viewData['ct_userID'] = $uid; // added by SB on 12/02/2016
		$this->load->view('ct_catalog/models_product_buy', $viewData);
	}
	public function music_buy($uid="")
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['bannerDetail']=$this->common_model->getBannerDetail($uid);
		$viewData['monetizerDetail']=$this->common_model->getMonetizerDetail($uid);
		$viewData['monetizerProfile']=$this->common_model->getProfileDetail($uid);// get detail of monetizer added by SB on 04/02/2016
		$viewData['monetizerGallery']=$this->common_model->getCtAllGalleryImg($uid);
		$viewData['allSponcer']= $this->common_model->getCtAllSponcer($uid);// added by SB on 04/02/2016
		$viewData['allVideo']= $this->common_model->getCtAllVideo($uid);// added by SB on 05/02/2016
		$viewData['ctBrochure']= $this->common_model->getBrochureDetail($uid);// added by SB on 12/02/2016
		$viewData['CT_product']=$this->common_model->topSixPageSpecific($uid ,4);// moneTypeId is 4 for music
		$viewData['CT_ticket']=$this->common_model->getCtTickets($uid);
		$viewData['ct_userID'] = $uid; // added by SB on 12/02/2016
		$this->load->view('ct_catalog/music_product_buy', $viewData);
	}
	public function real_buy($uid="")
	{
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['monetizerDetail']=$this->common_model->getMonetizerDetail($uid);// get detail of monetizer added by SB on 05/02/2016
		$viewData['allSponcer']= $this->common_model->getCtAllSponcer($uid);// added by SB on 05/02/2016
		$viewData['allVideo']= $this->common_model->getCtAllVideo($uid);// added by SB on 05/02/2016
		$viewData['CT_product']=$this->common_model->Top_six_Product($uid);
		$viewData['ct_userID'] = $uid; // added by SB on 12/02/2016
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
				/* $data = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
				$tempImg = $data[0]->images;
				//Print_r($tempImg);exit;
				if(file_exists($path.$tempImg)){
					unlink($path.$tempImg);
					$this->common_model->deleteSponcerProfilePic($id);
				} */
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
	
	// video file upload  added by SB on 05/02/2016
	 public function CT_profileVideoUpload($pageId="") {
		
        $status = 'error';
        $type = 'monetizer_video';
		if ($this->input->post('uploadvideo')) {
			  if(trim($this->input->post('proVdoLink'))!="") {			
			
				$videoFileName = trim($this->input->post('proVdoLink'));
				$insertId=$this->gatewaymodel->insertMonetizerVideo($videoFileName);
				//print_r($id);exit;
				if($insertId!="")
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
	// video file upload  added by SB on 11/02/2016
	 public function CT_BannerUpload($pageId="") {
		
        $status = 'error';
        $type = 'monetizer_banner';
		$id = trim($this->session->userdata('userId'));
        if ($this->input->post('uploadBanner')) {
			
			// check data exists 
			$tbl = 'ct_banner';
			$where['uID'] = $id;
			$selectedData = "id,bannerImage";
			$data = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
			$tempImg = $data[0]->bannerImage;
			// add banner title by SB on 08/04/2016 
			$bannerFileName="";
			$bannerTitle =$this->input->post('bannerTitle');
			if($_FILES["bannerfile"]["name"] != ""){
				$path = $this->config->item('gbe_image_upload_path').'CT_sponcer_img/';
				
				//Print_r($tempImg);exit;
				if(file_exists($path.$tempImg)){
					unlink($path.$tempImg);
					$this->common_model->deleteBannerImage($id);
				}
				$temp = explode(".", $_FILES["bannerfile"]["name"]);
				$extension = strtolower(end($temp));
				$bannerFileName = 'banner-'.$id.'-'.time() . "." . $extension;
				move_uploaded_file($_FILES["bannerfile"]["tmp_name"], $path.$bannerFileName );
				
				
			}
			if(isset($data[0]->id) && $data[0]->id!=""){
				$bannerId=$this->gatewaymodel->updateBanner($bannerFileName,$bannerTitle,$data[0]->id);
			}
			else{
				$bannerId=$this->gatewaymodel->insertBannerImage($bannerFileName,$bannerTitle);
			}
			//print_r($id);exit;
			if($bannerId!="")
			{
				$status = 'success';
			}else{
				$status = 'error';
			}
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh');
    } 
	
	// brochure upload added by SB on 11/02/2016
	public function CT_brochureUpload($pageId=""){
		 $status = 'error';
        $type = 'monetizer_brochure';
		$id = trim($this->session->userdata('userId'));
        if ($this->input->post('uploadbrochure')) {
			// check if data exist update table  added by SB on 23/02/2016
			$tbl = 'ct_brochure';
			$where['uID'] = $id;
			$selectedData = "id";
			$chkData = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
			if($chkData[0]->id > 0){
				
				$upData = array();
				if($_FILES["brochurefile"]["name"] != ""){
					$path = $this->config->item('gbe_image_upload_path').'CT_sponcer_img/';
					
					$selectedData1 = "brochureImage";
					$data = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData1);
					$tempImg = $data[0]->brochureImage;
					//Print_r($tempImg);exit;
					if(file_exists($path.$tempImg)){
						unlink($path.$tempImg);
						$this->common_model->deleteBrochureImage($id);
					}
					$temp = explode(".", $_FILES["brochurefile"]["name"]);
					$extension = strtolower(end($temp));
					$brochureFileName = 'brochure-'.$id.'-'.time() . "." . $extension;
					if(move_uploaded_file($_FILES["brochurefile"]["tmp_name"], $path.$brochureFileName ))
					//print_r($id);exit;
					{
						$upData['brochureImage'] = $brochureFileName;
					}
					
				}
								
				$upData['brochureMsg'] = trim($this->input->post('brochureMsg'));
				$upData['brochureVideo'] = trim($this->input->post('brochureVideoLink'));
				$where = array("uID"=>$this->session->userdata('userId'));
				$updateBrochure = $this->common_model->updateDataToTable($tbl, $where, $upData);
				if($updateBrochure!="")
				{
					$status = 'success';
				}else{
					$status = 'error';
				}
			}
			else{
				
				$brochureInstData = array();
				// insert record 
				if($_FILES["brochurefile"]["name"] != ""){
					$path = $this->config->item('gbe_image_upload_path').'CT_sponcer_img/';					
					
					$temp = explode(".", $_FILES["brochurefile"]["name"]);
					$extension = strtolower(end($temp));
					$brochureFileName = 'brochure-'.$id.'-'.time() . "." . $extension;
					move_uploaded_file($_FILES["brochurefile"]["tmp_name"], $path.$brochureFileName );
					//print_r($id);exit;
					
				}
				$brochureInstData['uID'] = trim($this->session->userdata('userId'));
				$brochureInstData['brochureImage'] = $brochureFileName;
				$brochureInstData['brochureMsg'] = trim($this->input->post('brochureMsg'));
				$brochureInstData['brochureVideo'] = trim($this->input->post('brochureVideoLink'));
				$brochureId=$this->common_model->insertDataToTable($tbl,$brochureInstData);
				if($brochureId!="")
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
				$profileImg = $this->common_model->updateDataToTable($tbl, $where, $upData);
				if($profileImg){
					unset($upData);unset($where);unset($tbl);
					$upImgData = array();
					// upload Face Image
					$faceImgData = $this->otherFileUpload('faceImage','jpg');
					if($faceImgData['status'] == 3){
						$upImgData['faceImage'] = $faceImgData['inputName'];
						
						// upload body Image 
						$bodyImgData = $this->otherFileUpload('bodyImage','jpg');
						if($bodyImgData['status'] == 3){
							$upImgData['bodyImage'] = $bodyImgData['inputName'];
							
							// upload body Image 
							$choiceImgData = $this->otherFileUpload('choiceImage','jpg');
							if($choiceImgData['status'] == 3){
								$upImgData['choiceImage'] = $choiceImgData['inputName'];
							}
						}
						$uploadtbl = 'monitizer_upload';
						$upImgData['userId'] = $this->session->userdata('userId');
						// update the image 
						$modelImg = $this->common_model->insertDataToTable($uploadtbl, $upImgData);
						// Mail to admin start -----/
						if($modelImg){
							$mailLink = "";
							if($upImgData['faceImage']!=''){
								$mailLink .= 'Face Image Link - '.$this->config->item('gbe_base_url').'useruploads/'.$upImgData['faceImage'].'<br>';
							}
							if($upImgData['bodyImage']!=''){
								$mailLink .= 'Entire Body Image Link - '.$this->config->item('gbe_base_url').'useruploads/'.$upImgData['bodyImage'].'<br>';
							}
							if($upImgData['choiceImage']!=''){
								$mailLink .= 'Choice Image Link - '.$this->config->item('gbe_base_url').'useruploads/'.$upImgData['choiceImage'].'<br>';
							}						
							
							$this->sendLinkToAdmin('Model',$mailLink);
							// Mail to admin end -----/
						}
					}
				}
				
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
				
				// upload music file added by SB on 05/02/2015
					$upMusicData = array();
					// upload Music File
					$musicData = $this->otherFileUpload('musicFile','mp3');
					if($musicData['status'] == 3){
						$upMusicData['mp3File'] = $musicData['inputName'];
						
						
						$uploadtbl = 'monitizer_upload';
						$upMusicData['userId'] = $this->session->userdata('userId');
						// update the image 
						$musicFile = $this->common_model->insertDataToTable($uploadtbl, $upMusicData);
						// Mail to admin start -----/
						if($musicFile){
							$mailLink = "";
							if($upMusicData['mp3File']!=''){
								$mailLink .= 'Music File Link - '.$this->config->item('gbe_base_url').'useruploads/'.$upMusicData['mp3File'].'<br>';
							}												
							
							$this->sendLinkToAdmin('Music',$mailLink);
							// Mail to admin end -----/
						}
					}
				
				
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
			$upData['price'] = trim($this->input->post('amount'));
			$upData['description'] = trim($this->input->post('description'));
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
	
	public function monetizer_divition($uID= 0,$Monetizer= 0)
	{
		if($Monetizer!="")	{
			if($Monetizer=="Beauty_Monetizer")
			{
				$moneId =1;
				//redirect(base_url().'dashboard/BeautyMonetizer_buy/'.$uID,'refresh');
				redirect(base_url().'dashboard/productCommon_buy/'.$uID.'/'.$moneId ,'refresh');
			}elseif($Monetizer=="Meetups_Monetizer")
			{
				$moneId =2;
				//redirect(base_url().'dashboard/meetsup_buy/'.$uID,'refresh');
				redirect(base_url().'dashboard/productCommon_buy/'.$uID.'/'.$moneId ,'refresh');
			}elseif($Monetizer=="Models_Monetizer")
			{
				$moneId =3;
				//redirect(base_url().'dashboard/models_buy/'.$uID,'refresh');
				redirect(base_url().'dashboard/productCommon_buy/'.$uID.'/'.$moneId ,'refresh');
			}elseif($Monetizer=="Music_Monetizer")
			{
				$moneId =4;
				//redirect(base_url().'dashboard/music_buy/'.$uID,'refresh');
				redirect(base_url().'dashboard/productCommon_buy/'.$uID.'/'.$moneId ,'refresh');
			}elseif($Monetizer=="Nutri_Monetizer")
			{
				$moneId =5;
				//redirect(base_url().'dashboard/nutri_buy/'.$uID,'refresh');
				redirect(base_url().'dashboard/productCommon_buy/'.$uID.'/'.$moneId ,'refresh');
			}elseif($Monetizer=="RealEstate_Monetizer")
			{
				$moneId =6;
				//redirect(base_url().'dashboard/real_buy/'.$uID,'refresh');
				redirect(base_url().'dashboard/productCommon_buy/'.$uID.'/'.$moneId ,'refresh');
			}
		}
	}
	//new for admin
	public function ctadminmusic(){
		$upData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(28);// signup detail added by SB on 04/03/2016
		//$upData['countryList'] = $this->common_model->getMoneMusicCountryList();
		$this->load->view('ct_catalog/music_profile', $upData);
	}
	public function ctadminmodel(){
		$upData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(27);// signup detail added by SB on 04/03/2016
		$this->load->view('ct_catalog/models_profile', $upData);
	}
	public function ctadminbeauty(){
		$upData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(13);// signup detail added by SB on 04/03/2016
		$this->load->view('ct_catalog/beauty_payment', $upData);
	}
	public function ctadminnutri(){
		$upData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(29);// signup detail added by SB on 04/03/2016
		$this->load->view('ct_catalog/nutri_payment', $upData);
	}
	public function ctadminreal(){
		$upData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(30);// signup detail added by SB on 04/03/2016
		$this->load->view('ct_catalog/Real_payment', $upData);
	}
	public function ctadminmeetsup(){
		$upData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(26);// signup detail added by SB on 04/03/2016
		$this->load->view('ct_catalog/meetups_payment', $upData);
	}
	public function Music_buy_demo(){
		$viewData=array();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$this->load->view('ct_catalog/ctmusic_product_details', $viewData);$this->load->view('ct_catalog/ctmusic_product_details', $viewData);
	}
	
	public function deal_of_the_day($deal = 0)
	{
		$viewData=array();
		$this->session->unset_userdata('cityID');
		$this->session->unset_userdata('catID');
		$viewData["cityList"] = $this->gatewaymodel->getCity();
		$viewData['CT_Category']=$this->common_model->ct_category();
		$viewData['CT_Deal']=$this->common_model->ct_dealproduct_list();
		//print_r($viewData['CT_Deal']);
		$this->load->view('ct_catalog/deal', $viewData);
	}	
	
	
	// delete 6 top listing product added by SB on 02/03/2016
	
	public function delTopSixProduct(){
		$topSixProId = trim($_POST["topSixProId"]);
		$moneType    = trim($_POST["moneType"]);
		$topSixProImg = $this->common_model->getSingleTopSixProDetail($topSixProId);
		// check image exist unlink the Image and delete the record
		$path = $this->config->item('gbe_base_url').'topsixproduct/';
		if(file_exists($path.$topSixProImg)){
			unlink($path.$topSixProImg);
		}
		// delete record from music_monetizer_products table 
		$topSixProImgDel = $this->common_model->delTopSixProImg($topSixProId);
		if($topSixProImgDel){
			if($moneType==6){
				// unlink image and delete reocrd from top_Seven_product table
				$realEstateProImg = $this->common_model->getRealEstateProdetail($topSixProId);
				if(file_exists($path.$realEstateProImg)){
					unlink($path.$realEstateProImg);
				}
				$topSixRealImgDel = $this->common_model->delRealEstateProImg($topSixProId);
			}
			else{
				// unlink image and delete reocrd from ct_monetizer_products table
				$moneSpecificImage = $this->common_model->getTopSixSpecificMoneImage($topSixProId);
				if(file_exists($path.$moneSpecificImage)){
					unlink($path.$moneSpecificImage);
				}
				$topSixSpecificProImgDel = $this->common_model->delSpecificProImg($topSixProId);
			}
			// count NO. of topsix listing  and return the count
			$topSixProCount = $this->common_model->topSixProdCount(trim($this->session->userdata('userId')));
			echo $topSixProCount;
		}
	}
	//delete sponcer Image Added by SB on 10/02/2016
	public function delSponcerImage(){
	
		$sponImgId = trim($_POST["sponImgId"]);
		$sponcerImg = $this->common_model->getSingleSponcerDetail($sponImgId);
		// check image exist unlink the Image and delete the record
		$path = $this->config->item('gbe_base_url').'CT_sponcer_img/';
		if(file_exists($path.$sponcerImg)){
			unlink($path.$sponcerImg);
		}
		
		$sponcerImgDel = $this->common_model->delSponcerImg($sponImgId);
		if($sponcerImgDel){
			// count NO. of sponcer and return the count
			$sponcerImgCount = $this->common_model->spImgCount(trim($this->session->userdata('userId')));
			echo $sponcerImgCount;
		}
		
	}
	// delete gallery Image added by SB on 11/02/2016
	public function delGalleryImage(){
		$galImgId = trim($_POST["galImgId"]);
		$galleryImg = $this->common_model->getSingleGalleryDetail($galImgId);
		// check image exist unlink the Image and delete the record
		$path = $this->config->item('gbe_image_upload_path').'CT_sponcer_img/';
		if(file_exists($path.$galleryImg)){
			unlink($path.$galleryImg);
		}
		
		$galleryImgDel = $this->common_model->delGalleryImg($galImgId);
		if($galleryImgDel){
			// count NO. of gallery and return the count
			$galleryImgCount = $this->common_model->galImgCount(trim($this->session->userdata('userId')));
			echo $galleryImgCount;
		}
	}
//delete Video Link Added by SB on 10/02/2016
	public function delVdoLink(){
	
		$videoLinkId = trim($_POST["videoLinkId"]);		
		$vdoLnkDel = $this->common_model->delVideoLink($videoLinkId);
		if($vdoLnkDel){
			// count NO. of Video Links and return the count
			$vdoLinkCount = $this->common_model->moneVideoLinkCount(trim($this->session->userdata('userId')));
			echo $vdoLinkCount;
		}
		
	} 
	// Gallery Image upload added by SB on 11/02/2016 
	public function CT_galleryImgUpload($pageId="") {
		
        $status = 'error';
        $type = 'galleryImage';
		$id = trim($this->session->userdata('userId'));
        if ($this->input->post('galupdate')) {
			if($_FILES["galleryImage"]["name"] != ""){
				$path = $this->config->item('gbe_image_upload_path').'CT_sponcer_img/';
				
				$temp = explode(".", $_FILES["galleryImage"]["name"]);
				$extension = strtolower(end($temp));
				$imageName = 'gallery-'.$id.'-'.time() . "." . $extension;
				move_uploaded_file($_FILES["galleryImage"]["tmp_name"], $path.$imageName );
				$galleryId=$this->gatewaymodel->insertGalleryImage($imageName);
				//print_r($id);exit;
				if($galleryId!="")
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
	// download monitizer pdf brochure added by SB on 12/02/2016
	function downloadBrochure() {
        $brochureFile = $_REQUEST['brochureFile'];
        $remoteFile = $this->config->item('gbe_image_upload_path').'CT_sponcer_img/' . $brochureFile;       
		header("Content-Type: application/octet-stream");
		//$file = $_GET["file"] .".pdf";
		header("Content-Disposition: attachment; filename=" . urlencode($brochureFile));   
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Description: File Transfer");            
		header("Content-Length: " . filesize($remoteFile));
		flush(); // this doesn't really matter.
		$fp = fopen($remoteFile, "r");
		while (!feof($fp))
		{
			echo fread($fp, 65536);
			flush(); // this is essential for large downloads
		} 
		fclose($fp);
    }
	// upload music file in monitizer section added by SB on 12/02/2016
	 public function addAudioFile($pId = 0){
        if($_FILES["musicFile"]["name"] != ""){
            $path = $this->config->item('gbe_base_url').'CT_sponcer_img/';
            $allowedExts = array("mp3","mp4");
            $temp = explode(".", $_FILES["musicFile"]["name"]);
            $extension = strtolower(end($temp));
            if (($_FILES["musicFile"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $_FILES["musicFile"]["name"] = 'music-'.$pId.'-'.time() . "." . $extension;
                if ($_FILES["musicFile"]["error"] > 0) {
                    $retData['status'] = 0; //error
                    $retData['errorMsg'] = 'The image has an error' . $_FILES["musicFile"]["error"]; //error
                    $retData['name'] = $_FILES["musicFile"]["name"];
                } else {
                    move_uploaded_file($_FILES["musicFile"]["tmp_name"], $path . $_FILES["musicFile"]["name"]);
                    $tbl = 'product_files';
                    $insertImg["fileName"] = $_FILES["musicFile"]["name"];
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
 // ticket Upload added by SB on 16/02/2016
 public function CT_TicketUpload($pageId=""){
		 $status = 'error';
        $type = 'monetizer_ticket';
		$id = trim($this->session->userdata('userId'));
        if($this->input->post('uploadTicket')){
			$name 			= trim($this->input->post('ticketName'));
			$ticketDesc 	= trim($this->input->post('ticketDesc'));			
			$ticketLocation	= trim($this->input->post('ticketLocation'));
			$contact_number = trim($this->input->post('ticketcontact_number'));
			$start_date 	= trim($this->input->post('ticketStartDate'));
			$end_date 		= trim($this->input->post('ticketEndDate'));
			$ticketPrice 	= trim($this->input->post('ticketPrice'));
			$country_id 	= trim($this->input->post('ticketCountry'));
			$city_id 		= trim($this->input->post('ticketCity'));
			$zip_code_id 	= trim($this->input->post('ticketZip'));
			
			if($_FILES["ticketImage"]["name"] != "" && $_FILES["ticketPdf"]["name"] != ""){

				$path = $this->config->item('gbe_image_upload_path').'CT_ticketFiles/';
				$insertData 						= array();
				$insertData['userId']				=	$id;
				$insertData['name']					=	$name;
				$insertData['ticketDesc']			=	$ticketDesc;
				$insertData['location']				=	$ticketLocation;
				$insertData['contact_number']		=	$contact_number;
				$insertData['start_date']			=	$start_date;
				$insertData['end_date']				=	$end_date;
				$insertData['ticketPrice']			=	$ticketPrice;
				$insertData['country_id']			=	$country_id;
				$insertData['city_id']				=	$city_id;
				$insertData['zip_code_id']			=	$zip_code_id;
				
				$tempImg = explode(".", $_FILES["ticketImage"]["name"]);
				$imgExtension = strtolower(end($tempImg));
				$ticketImage = 'ticketImg-'.$id.'-'.time() . "." . $imgExtension;
				$insertData['image_path'] = $ticketImage;
				if(move_uploaded_file($_FILES["ticketImage"]["tmp_name"], $path.$ticketImage )){
					
					// insert the data table
					$tableName = 'ct_monetizer_ticket';
					$ticketId=$this->common_model->insertDataToTable($tableName,$insertData);
					// if insert success then upload pdf and update the data
					if($ticketId){
						
						$temp = explode(".", $_FILES["ticketPdf"]["name"]);
						$extension = strtolower(end($temp));
						$ticketPdf = 'ticketPdf-'.$id.'-'.time() . "." . $extension;
						if(move_uploaded_file($_FILES["ticketPdf"]["tmp_name"], $path.$ticketPdf ))
						{
							
							$where = array("id"=>$ticketId);
							$upData = array("pdf"=>$ticketPdf) ;
							$upDataTicket = $this->common_model->updateDataToTable($tableName, $where, $upData);
							
							if($upDataTicket){
								$status = 'success';
							}else{
								$status = 'error';
							}
						}
					}
				}
				
			}
			
			
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url().'dashboard/ct_index/'.$pageId,'refresh');
	}
		
	// signup with monetizer link added by SB on 25/02/2016  
	public function signUpRequest($parentID = 0,$moneTypeId = 0) {
		
        $viewData = array();
        $viewData["styleStatus"] = "none";
		$type = "newMoneSignup";
        if ($this->input->post('submit')) {
			if($moneTypeId == 1){
				$generalUserType = "Beauty_Monetizer";
			}elseif($moneTypeId == 2){
				$generalUserType = "Meetups_Monetizer";
			}elseif($moneTypeId == 3){
				$generalUserType = "Models_Monetizer";
			}elseif($moneTypeId == 4){
				$generalUserType = "Music_Monetizer";
			}elseif($moneTypeId == 5){
				$generalUserType = "Nutri_Monetizer";
			}elseif($moneTypeId == 6){
				$generalUserType = "RealEstate_Monetizer";
			}else{
				$generalUserType = "general";
			}
           
			$this->load->library('form_validation');
           // $this->form_validation->set_rules('signUpName', 'Name', 'trim|required');
			$this->form_validation->set_rules('signUpEmail', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$viewData["parentID"] = $this->getParentId();
			//$viewData['name'] = "";//trim($this->input->post('signUpName'));
			//$viewData['surname'] = "";
			$viewData['name'] = "new monetizer";
			$viewData['emailAddr'] = trim($this->input->post('signUpEmail'));
			$viewData['city'] = "";
			$viewData['skypeID'] = "";
			$viewData['userType'] = "PAYING USER";
			$password = $this->generatePassword();
			$viewData['password'] = $password;
			$viewData['forWebsite'] = 2;
			//inser data start here			
			/*$insertData['firstName'] = "";//trim($this->input->post('signUpName'));
			$insertData['lastName'] = "";
			$insertData['phone'] = "";
			$insertData['emailID'] = trim($this->input->post('signUpEmail'));
			$insertData['city'] = "";
			$insertData['skypeID'] = "";
			$insertData['userType'] = "PAYING USER";
			$insertData['password'] = 'root';
			
			$tbl = 'userinfo';*/
			if ($this->form_validation->run() != FALSE)
			 {
				$signupId = $this->gatewaymodel->insertData($viewData);
                $this->insertGeneralUserType($signupId,$generalUserType);
			   // $viewData = $this->common_model->insertDataToTable_for_signup($tbl,$insertData);
				$this->mailToCTMonetizerUser($viewData);
				//$this->sendEmailToAdmin($viewData);				
				$msg = "success";
				}
				else
				{					  
					$msg = "error";
					$this->session->set_flashdata('errNameMsg',form_error('signUpName'));
					$this->session->set_flashdata('errEmailMsg',form_error('signUpEmail'));
				}
            
       		 }else{
        		$msg = "error";  
       		 }
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('msg',$msg);
        $redirectUrl = base_url() . 'dashboard/productCommon_buy/'.$parentID.'/'.$moneTypeId;
		
     	redirect($redirectUrl, 'refresh');
    }
	 // auto generate password added by SB on 26/02/2016
	 
	 private function generatePassword() {
        $string = mt_rand();
        $start = 1;
        $length = 8;
        $code = substr($string, $start, $length);
        $code = "CTM" . $code;
        return $code;
    }
	// general user type  function
	public function insertGeneralUserType($signupId,$generalUserType){
        $tbl = "user_general_type";
        $data['user_id'] = $signupId;
        $data['user_general_type_name'] = $generalUserType;
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
    } 
	// signup detail mail to CT monetizer added by SB on 26/02/2016
	public function mailToCTMonetizerUser($data = array()){
		$this->_to_email = $data['emailAddr'];
		//$this->_password=$data['password'];
        $this->_subject = "Login Credentials of New Monetizer";
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Monetizer,</td></tr>
								<tr><td colspan="2">Here is a new Sign up detail of Monetizer .</td></tr>
								<!--<tr><td width="25%">Name:</td><td width="75%">' . $data['name'] . '</td></tr>-->
                                
								
								
								<tr><td width="25%">Email :</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
								<tr><td width="25%">Password :</td><td width="75%">' . $data['password'] . '</td></tr>
                                                                   
								
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">communitytreasures.co</td></tr>
								
                           </table>';
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->ct_send_mail_raw();
            return true;
        } else {
            return false;
        }
	}
	// contact mail to monetizer added by SB on 10/03/2016
	public function mailToMonetizer(){
	
		$result="";
		$senderEmail = trim($_POST["senderEmail"]);
		$mailContent = trim($_POST["mailContent"]);
		$moneMailId = trim($_POST["moneMailId"]);
		$moneTypeId = trim($_POST["moneTypeId"]);
	
		// send mail to monetizer user
		$this->_to_email = $moneMailId;//'senabi.test05@gmail.com';
		//$this->_password=$data['password'];
        $this->_subject = "User Enquiry";
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Monetizer,</td></tr>
								<tr><td colspan="2">Here is my message.</td></tr>
								<tr><td colspan="2">'.$mailContent.'</td></tr>
								<tr><td colspan="2">Sender Email Id: '.$senderEmail.'</td></tr>
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">communitytreasures.co</td></tr>
								
                           </table>';
        if ($this->_to_email != '' && $this->_subject != '') {
           if($this->ct_send_mail_raw()){
			  $result=1; 
		   }
		   
		}
		
		echo $result;
		
	}
	
	// function to get id from username eg. abc.xyz.123
	public function checkUsernameId(){
		$uname = 'abcd.xyz..1234';
		echo "+++". $this->getIdfromUname($uname);
	}
	function getIdfromUname($uname){
		$iD = "";
		if($uname!=""){
			$nameArr = explode('.',$uname);
			for($i=0;$i<count($nameArr); $i++){
				if($i==count($nameArr)-1){
					
					if(is_numeric($nameArr[$i]) && $nameArr[$i] > 0){
						$iD= $nameArr[$i];
					}
				}
			}
			
			
		}

		return $iD;
	}
	// added by SB on 29/04/2016
	public function updateUserInfoNew(){
		$type = 'STEP2A';
		$status = 'error';
		$openTabId = 'tab2';
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
				$where = array("uID"=>$this->userId);
				$this->common_model->updateDataToTable($tbl, $where, $upData);
				unset($upData);unset($where);unset($tbl);
				$msg = "You have successfully updated your data.";
			}else{
				$msg = "Email '".$upData['emailID']."' is already used.Please try with another email.";
			}
		}
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('openTabId',$openTabId);
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url()."dashboard");
	}
	
	public function testGmailYahooUrl(){
		$url=	$this->getGmailUrl();
		echo "=====".$url['gmail'];
		print_r($url);
	}

	public function addoffers() {
		
		 $viewData = array();
         $data = array();
		$allproductlist 	= array();
		$recArr				= array();
        if(!empty($_POST)) {
			
            $product["productTypeID"] 			= trim($_POST['productTypeID']);
			$cat_id 			= trim($_POST['productTypeID']);
			
			if($cat_id == 0)
			{
				$product["productTypeID"] 			= trim($_POST['articleID']);
				$product["category_level"] 			= 'subcategory';
			}
			else if($cat_id !=0)
			{
				$product["productTypeID"] 			= trim($_POST['productTypeID']);
				$product["category_level"] 			= '2ndsubcategory';
				
			}
            $product["vendorID"] 				= 0;
            $product["productName"] 			= trim($_POST['productName']);
            $product["productDesc"] 			= $_POST['productDesc'];
            $product["productCurrencyType"] 	= trim($_POST['productCurrencyType']);
            $product["productPrice"] 			= trim($_POST['productPrice']);
            $product["productQuantity"] 		= trim($_POST['productQuantity']);
            $product["productCommission"] 		= 0.00;
            $product["productOffer"] 			= $_POST['productOffer'];
            $product["productYoutubeUrl"] 		= trim($_POST['productYoutubeUrl']);
			$product["country"] 				= $_POST['offer_country_name'];
			$product["city"] 					= $_POST['offercity'];
            $product["typeOfProduct"] 			= trim($_POST['typeOfProduct']);
			$product["productEventDate"] 		= trim($_POST['productEventEndDate']);// added by Sb on 08/07/2015
            $product["productStatus"] 			= trim($_POST['productStatus']);
            $product["createdDate"] 			= date("Y-m-d H:i:s");			
            $product["addedBy"] 				= $this->session->userdata('userId');
			$product["productDonate"] 			= trim($_POST['productDonate']); 
            $tbl 								= 'product_details';
			
			
			$productId 							= $this->common_model->insertDataToTable($tbl,$product);
			
            unset($product);unset($tbl);
            if($productId > 0){
				$this->allImages($productId,$pageId);
				$this->addProductAudio($productId);
				$this->addProductDigitalPdf($productId);				
				$this->addProductEventPdf($productId);// added by Sb on 08/07/2015
				if($this->input->post("RadioGroup1") == 1){
					$this->addColor($productId);
				}
				
				$offer['product_id']			= $productId;
				$offer['voucher_code'] 			= trim($_POST['v_code']);
				$offer['voucher_amt'] 			= trim($_POST['offer_price']);
				$this->common_model->insertDataToTable('product_offer', $offer);
				
				$data['allProducts']  = $this->gatewaymodel->getAllProductsByUser($this->session->userdata('userId'));
				
				
        $recArr['productId'] = $productId;
				$recArr['HTML']  = $this->load->view('dashboard/ajaxProductListing',$data, true);
				$recArr['process'] = "success";
				echo json_encode($recArr);
				exit;
            }
			
			
            
        }
		
        /*$msg 	= "You have successfully upload offer details.";			
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url().'dashboard/apdashboard', 'refresh');*/
		
		/*-------------------------------------
		$offer				  = array();			
		$offer['category_id'] = trim($this->input->post('category_name'));						
		$offer['offer_name'] = trim($this->input->post('offer_name'));						
		$offer['voucher_code'] = trim($this->input->post('voucher_code'));
		$offer['offer_price'] = trim($this->input->post('offer_price'));
		$offer['description'] = trim($this->input->post('offer_description'));
        	
		$realEstateFileData = $this->offerimageupload('offer_img','jpg');
			if($realEstateFileData['status'] == 3){
				$offer['image'] = $realEstateFileData['inputName'];
				
			}
			
		$offer["created_by"] = $this->session->userdata('userId');
		$offer["created_date"] = date("Y-m-d H:i:s");
		
		$realTblName ='ct_upload_offers';
		$realDataId = $this->common_model->insertDataToTable($realTblName,$offer);
		unset($offer);unset($realTblName);
		$msg = "You have successfully upload offer details.";			
		$this->session->set_flashdata('msg',$msg);*/
		
	}
	public function addProductEventPdf($pId = 0){	
		
		if($_FILES["productEventPdf"]["name"] != ""){		
            $path = $this->config->item('gbe_image_upload_path').'adminuploads/product_files/pdf/';
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
	public function addProductDigitalPdf($pId = 0){	
		
		if($_FILES["productDigitalPdf"]["name"] != ""){		
            $path = $this->config->item('gbe_image_upload_path').'adminuploads/product_files/pdf/';
            $allowedExts = array("pdf");
            $temp = explode(".", $_FILES["productDigitalPdf"]["name"]);
            $extension = strtolower(end($temp));
            if (($_FILES["productDigitalPdf"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $_FILES["productDigitalPdf"]["name"] = 'product-'.$pId.'-'.time() . "." . $extension;
                if ($_FILES["productDigitalPdf"]["error"] > 0) {
                    $retData['status'] = 0; //error
                    $retData['errorMsg'] = 'The pdf file has an error' . $_FILES["productDigitalPdf"]["error"]; //error
                    $retData['name'] = $_FILES["productDigitalPdf"]["name"];
                } else {
                    move_uploaded_file($_FILES["productDigitalPdf"]["tmp_name"], $path . $_FILES["productDigitalPdf"]["name"]);
                    $tbl = 'product_files';
                    $insertImg["fileName"] = $_FILES["productDigitalPdf"]["name"];
                    $insertImg["isMain"] = 0;
                    $insertImg["fileType"] = 2;
                    $insertImg["productId"] = $pId;
                    $imgId = $this->common_model->insertDataToTable($tbl,$insertImg);
                }
            }
        }
        return true;
    }
	public function updateapProduct($pageId=""){
		$recArr		=array();
		$type = 'pUploadUpdate';
        $status = 'error';
		if(!empty($_POST)){
			$productId = trim($this->input->post('productId'));
			$where['productID'] = $productId;
            $product["productTypeID"] = trim($this->input->post('productTypeID'));
            //$product["vendorID"] = $this->input->post('vendorID');
            $product["productName"] = trim($this->input->post('productName'));
            $product["productDesc"] = $this->input->post('productDesc');
			$product["country"] = $this->input->post('offer_country_name');
			$product["city"] = $this->input->post('offercity');
            $product["productCurrencyType"] = trim($this->input->post('productCurrencyType'));
            $product["productPrice"] = trim($this->input->post('productPrice'));
            $product["productQuantity"] = trim($this->input->post('productQuantity'));
            //$product["productCommission"] = trim($this->input->post('productCommissionEdit'));
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
                unset($where);
				$offer['voucher_code'] 			= trim($this->input->post('voucher_code'));
				$offer['voucher_amt'] 			= trim($this->input->post('offer_price'));
				$where['product_id'] 			= $productId;
				$this->common_model->updateDataToTable('product_offer',$where,$offer);
				unset($offer);unset($where);
            }
        }
		$data['allProducts']  = $this->gatewaymodel->getAllProductsByUser($this->session->userdata('userId'));
		$recArr['HTML']  = $this->load->view('dashboard/ajaxProductListing',$data, true);
		$recArr['process'] = "success";
		echo json_encode($recArr);
		exit;
	}
	
	
	
	public function editapProduct($productId = 0){
		$viewData   =array();
		$recArr		=array();
		if($productId > 0){
			$viewData["productId"] = $productId;
			$viewData["stepWiseVideo"] = $this->gatewaymodel->getLevelStepVideo(1);
			$viewData["colorList"] = $this->gatewaymodel->getColor();
			$viewData["categoryList"] = $this->gatewaymodel->getCategory();
			$viewData["countryList"] = $this->gatewaymodel->getCountryList(); 
			$viewData["cityList"] = $this->gatewaymodel->getCity();
			$viewData['vendorsList'] = $this->gatewaymodel->getVendorsList(trim($this->session->userdata('userId')));
			$viewData["pDetails"] = $this->product_model->getProduct($viewData["productId"]);
            $viewData["offerDetails"] = $this->product_model->getOffer($viewData["productId"]);
            $subArticleID = $viewData["pDetails"][0]->productTypeID;
            $viewData['donateStatus'] = $viewData["pDetails"][0]->productDonate;
            $catNarticleID = $this->product_model->getCatIdArtId($subArticleID);
            $viewData['catID']= $catNarticleID['catId'];
            $viewData['artID']= $catNarticleID['articleId'];
            $viewData['artList'] = $this->gatewaymodel->getArticleList($catNarticleID['catId']);
            $viewData['productCategoryList'] = $this->gatewaymodel->getSubArticleList($catNarticleID['articleId']);
            $viewData["pColors"] = $this->product_model->getProductColors($viewData["productId"]);
            $viewData["pFiles"] = $this->product_model->getProductFiles($viewData["productId"]);
			
			$recArr['HTML']  = $this->load->view('dashboard/ajaxEditform',$viewData, true);
			$recArr['process'] = "success";
			echo json_encode($recArr);
			exit;
		}
		//redirect(base_url()."dashboard/apdashboard");
	}
	/*public function editapProduct($productId = 0){
		if($productId > 0){
			$this->session->set_flashdata('openTabId','tab1');
			$this->session->set_flashdata('productId',$productId);
		}
		redirect(base_url()."dashboard/apdashboard");
	}*/
	
	/*public function updateapProduct($pageId=""){
		//Print_r($pageId);exit;
		$type = 'pUploadUpdate';
        $status = 'error';
		if($this->input->post('pUploadButton') != ''){
			$productId = trim($this->input->post('productId'));
			$where['productID'] = $productId;
            $product["productTypeID"] = trim($this->input->post('productTypeID'));
            //$product["vendorID"] = $this->input->post('vendorID');
            $product["productName"] = trim($this->input->post('productName'));
            $product["productDesc"] = $this->input->post('productDesc');
            $product["productCurrencyType"] = trim($this->input->post('productCurrencyType'));
            $product["productPrice"] = trim($this->input->post('productPrice'));
            $product["productQuantity"] = trim($this->input->post('productQuantity'));
            //$product["productCommission"] = trim($this->input->post('productCommissionEdit'));
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
                unset($where);
				$offer['voucher_code'] 			= trim($this->input->post('voucher_code'));
				$offer['voucher_amt'] 			= trim($this->input->post('offer_price'));
				$where['product_id'] 			= $productId;
				$this->common_model->updateDataToTable('product_offer',$where,$offer);
				unset($offer);unset($where);
                $status = 'success';
				//$this->session->set_flashdata('productId',$productId);
            }
        }
		$msg 	= "You have successfully upload offer details.";			
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url().'dashboard/apdashboard', 'refresh');
		
	}*/
	/*public function offerimageupload($inputName,$inputType){
		$img_name		   =	$_FILES[$inputName]["name"];
		$retData['status'] = 1;
		$retData['inputName'] = '';
		if ($img_name != "") {
			if($inputType=="mp3"){
				$allowedExts = array("mp3");
			}elseif($inputType=="pdf"){
				$allowedExts = array("pdf");
			}else{
				$allowedExts = array("jpg","png","jpeg");
			}
			
			$temp = explode(".", $img_name);
			$extension = strtolower(end($temp));
			if (($_FILES[$inputName]["size"] < 20000000) && in_array($extension, $allowedExts)) {
				$img_name = time()."_".rand(10,156)."_".$img_name;
				if ($_FILES[$inputName]["error"] > 0) {
					$retData['status'] = 2;
				}else{
					   $path = getcwd().'/uploads/offer_image/';
					//$this->common_model->imageUnlinkPath()."topsixproduct/";
					
					move_uploaded_file($_FILES[$inputName]['tmp_name'], $path.$img_name);
					$retData['inputName'] = $img_name;
					$retData['status'] = 3;
				}
			}else{
				$retData['status'] = 2;
			}
		}
		return $retData;
	}*/

  ############## SUBHENDU 13-07-2017 ###
   public function ajax_view_coupon_code($prodId = 0)
  {
    $viewData = array();
    $data = array();
    
    $viewData['prodId'] = $prodId;
    $this->load->view('ct_catalog/ajax_view_coupon_code', $viewData);
  }
  public function ajax_coupon_code_submission()
  {
    //print_r($_POST);
    $data = array();
       if( $this->input->post('emailid')!='') {
        $productID = $this->input->post('productID');
        $ProductDetailsArray = $this->common_model->getProductDetailsById($productID);
               // print_r($ProductDetailsArray);
                /*$recArr = array();  
                $data['total_no_of_invalid_agent']= $total_no_of_invalid_agent; 
                $recArr['HTML']   = $this->load->view('ajaxShowDetails',$data, true);
                $recArr['other']  = $total_no_of_invalid_agent;
                $recArr['process']  = "success";
                echo json_encode($recArr);*/

                $data['emailTo_product_manager'] = $ProductDetailsArray[0]['emailID'];
                $data['emailAddr']= $this->input->post('emailid');
                $data['productID']= $ProductDetailsArray[0]['productID'];
                $data['productName']= $ProductDetailsArray[0]['productName'];
                $data['voucher_code']= $ProductDetailsArray[0]['voucher_code'];
                $data['voucher_amt']= $ProductDetailsArray[0]['voucher_amt'];
                //echo "<pre>"; print_r($data);
                $this->sendVoucherEmailToProductManager($data);

                $this->sendVoucherEmailToUser($data);
                $this->sendVoucherEmailToAdmin($data);
                $retData = array(
								'process' => 'success',
								'voucherCode' => $data['voucher_code']
							);
				$callBackData = json_encode($retData);
				echo $callBackData;
                exit;
				//return 'success';
            }
            else{
                $retData = array(
								'process' => 'fail'
							);
				$callBackData = json_encode($retData);
				echo $callBackData;
			   exit;
            }
            //exit;
  }

  private function sendVoucherEmailToAdmin($data = array()) {
        
        $this->_to_email = $this->_admin_email;
    
        $this->_subject = "New General user Voucher Request Community Treasures";
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Admin,</td></tr>
                <tr><td colspan="2">Here is a new voucher request submitted from below email.</td></tr>
                
                 <tr><td width="25%">Email :</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
                <tr><td width="25%">Product Name :</td><td width="75%">' . $data['productName'] . '</td></tr>
                <tr><td width="25%">Voucher Code :</td><td width="75%">' . $data['voucher_code'] . '</td></tr>
                <tr><td width="25%">Voucher Amount :</td><td width="75%">' . $data['voucher_amt'] . '</td></tr>
                
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
  private function sendVoucherEmailToUser($data = array()) {
        
        $this->_to_email = $data['emailAddr'];
    
        $this->_subject = "Coupon Code Community Treasures";
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Admin,</td></tr>
                <tr><td colspan="2">Here is a new voucher request submitted from below email.</td></tr>
                
                
                <tr><td width="25%">Product Name :</td><td width="75%">' . $data['productName'] . '</td></tr>
                <tr><td width="25%">Voucher Code :</td><td width="75%">' . $data['voucher_code'] . '</td></tr>
                <tr><td width="25%">Voucher Amount :</td><td width="75%">' . $data['voucher_amt'] . '</td></tr>
                
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
    private function sendVoucherEmailToProductManager($data = array()) {
        
        $this->_to_email = $data['emailTo_product_manager'];
    
        $this->_subject = "New Voucher Request from ".$data['emailAddr']." Community Treasures";
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Product Manager,</td></tr>
                <tr><td colspan="2">Here is a new voucher request submitted from below email.</td></tr>
                
                <tr><td width="25%">Email :</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
                <tr><td width="25%">Product Name :</td><td width="75%">' . $data['productName'] . '</td></tr>
                <tr><td width="25%">Voucher Code :</td><td width="75%">' . $data['voucher_code'] . '</td></tr>
                <tr><td width="25%">Voucher Amount :</td><td width="75%">' . $data['voucher_amt'] . '</td></tr>
                
                <tr><td colspan="2">Thank you very much.</td></tr>
                <tr><td colspan="2">communitytreasures.co</td></tr>
                
                           </table>';
                           //echo "<pre>"; print_r($data);
                           //echo "<pre>"; print_r($this); exit;
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->ct_send_mail_raw();
            return true;
        } else {
            return false;
        }
    } /**/
}
