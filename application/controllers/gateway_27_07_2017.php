<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class GateWay extends CI_Controller {

    private $_from_email;
    private $_from_name;
    private $_admin_email;
    private $_to_email;
    private $_subject;
    private $_message;
    public $city;
	public $_forWebsite;//15/10/2015 ujjwal sana added

    function __construct() {
        parent::__construct();
        $this->load->library('curl'); 
        $this->load->library('session');
        $this->_from_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
        $this->load->model('gatewaymodel');
        $this->city = $this->gatewaymodel->getCity();
        $this->_forWebsite = 2;//15/10/2015 ujjwal sana added
    }

    public function index($parentID = 0) {
        $viewData = array();
        if ($parentID == 0) 
		{
            $parentID = 1000;
            $viewData["parentID"] = $parentID;
       	 }
		  else if ($parentID > 0) 
		  {
            $ustatus = $this->gatewaymodel->isMemberExist($parentID);
            if ($ustatus)
			 {
                $viewData["parentID"] = $parentID;
              } else 
			  {
                $viewData["parentID"] = 1000;
           	  }
           }
        $viewData["styleStatus"] = "none";
		$viewData["styleStatus1"] = "none";
		$msg = $this->session->flashdata('msg');
		
        if (isset($msg)) {
			
			if($msg != "" && $msg == 'success'){
	       	$viewData["msg"] = "Signup request has been sent to your email.";
			
			}elseif($msg != "" && $msg == 'error'){
				
				$name = $this->session->flashdata('errNameMsg');
				$email = $this->session->flashdata('errEmailMsg');
				$viewData["msg"] = $email;
				
				if($name != "" && $email != ""){					
					$viewData["msg"] = $name .'<br>'.$email;
				}elseif($name == "" && $email != ""){
					$viewData["msg"] = $email;
				}elseif($name != "" && $email == ""){					
					$viewData["msg"] = $name;
				}
			}
			
        }
       $viewData['pageDetails'] = $this->_getSignupPageDetails();
			
        $this->load->view('gateway/login', $viewData);
    }

    public function contentDetails($contentID = 0) {
        $viewData = array();
      // echo $contentID; exit;
        $viewData["styleStatus"] = "none";
		$viewData["styleStatus1"] = "none";
		$BrandData["styleStatus"] = "none";
		$BrandData["styleStatus1"] = "none";
		
		$this->load->model('common_model');
		$BrandData["BrandList"] = $this->common_model->fetchBrandCat();
//print_r($BrandData["BrandList"]);exit;
		$msg = $this->session->flashdata('msg');
		
       
       // you need to load the url helper to call base_url()
        $this->load->helper("url");
        if($contentID=="about-us"){
        	$page_name='aboutUs.php';
        }
        if($contentID=="qspace"){
        	$page_name='qspace.php';
        }
        if($contentID=="brand"){
        	//$page_name='brand.php';
			$this->load->view('gateway/cms/brand', $BrandData);
        }
         if($contentID=="opportunity"){
        	$page_name='opportunity.php';
        }
         if($contentID=="signup"){
        	$page_name='signUp.php';
        }
         if($contentID=="contact-us"){
        	$page_name='contactUs.php';
        }
		 if($contentID=="earnings-disclaimer"){
        	$page_name='earnings-disclaimer.php';
        }
		 if($contentID=="terms-and-conditions"){
        	$page_name='terms-and-conditions.php';
        }
		if($contentID=="privacy-policy"){
        	$page_name='privacy-policy.php';
        }
		if($contentID=="compliance"){
        	$page_name='compliance.php';
        }
       
        // you can change the location of your file wherever you want
        $content = file_get_contents(base_url()."application/views/gateway/cms/".$page_name);
		//$content1 = $this->load->view('gateway/content');
		$viewData["content"] = $content;
		$viewData["base_url"] = base_url();
		if ($this->input->post('submit')) {
            $generalUserType = "general";
			$this->load->library('form_validation');
			$post_array = $this->input->post();
         
           
           
            $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
             $secret='6LcrtQsUAAAAAF92qtda-Iewg6HQr9_SYXyR5GwE';
             echo $userIp=$this->input->ip_address();
			echo "<br>".$url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response;=".$recaptchaResponse."&remoteip;=".$userIp;

			$response = $this->curl->simple_get($url);

			$status= json_decode($response, true);
 echo "<pre>";
            print_r($post_array);
              print_r($status);
            echo "</pre>";
            exit;
			if($status['success']){     
			$this->session->set_flashdata('flashSuccess', 'Google Recaptcha Successful');
			}else{
			$this->session->set_flashdata('flashSuccess', 'Sorry Google Recaptcha Unsuccessful!!');
			}
			redirect(base_url());
         /*
			$this->form_validation->set_rules('signUpEmail', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$viewData["parentID"] = $this->getParentId();
			$viewData['name'] = "";//trim($this->input->post('signUpName'));
			$viewData['surname'] = "";
			$viewData['cellno'] = "";
			$viewData['emailAddr'] = trim($this->input->post('signUpEmail'));
			$viewData['city'] = "";
			$viewData['skypeID'] = "";
			$viewData['userType'] = "PAYING USER";
			$viewData['password'] = '';
		*/
			if ($this->form_validation->run() != FALSE)
			 {
			
				$this->sendEmailToUser($viewData);
				$this->sendEmailToAdmin($viewData);				
				$msg = "success";
				}
				else
				{					  
					$msg = "error";
					$this->session->set_flashdata('errNameMsg',form_error('signUpName'));
					$this->session->set_flashdata('errEmailMsg',form_error('signUpEmail'));
				}
            
       		 }
        if($contentID!="brand"){	
        $this->load->view('gateway/content', $viewData);
		}
    }
    
    private function _getSignupPageDetails(){
        $tbl = "gbe_signup_page_details";
        $where = array('id'=>12);
        $selectedData = "";
		
        $list = $this->common_model->fetchDataFromTable($tbl,$where,$selectedData);
        return $list[0];
		
    }

    public function login() 
      {
       $viewData = array();
        $viewData['errorMsg'] = "";
        $viewData["styleStatus"] = "none";
		$viewData["styleStatus1"] = "none";
        if ($this->input->post('logIN')) {
			
            if ($this->input->post('emailID') != "" && trim($this->input->post('password')) != "") {
				
                $userDetails = $this->gatewaymodel->chkUserAuth($this->input->post('emailID'), $this->input->post('password'));
                if (!empty($userDetails)) {
					 
					  $this->session->set_userdata('userId', $userDetails["uID"]);
                  	  $this->session->set_userdata('referarId', $userDetails["referarID"]);
                      $this->session->set_userdata('emailId', $userDetails["emailID"]);
                      $this->session->set_userdata('userName', $userDetails["userName"]);                   
                      $this->session->set_userdata('userType', $userDetails["userType"]);
					  $this->session->set_userdata('forWebsite', $this->_forWebsite);//29/10/2015 ujjwal sana added
					  $this->_addLoginData(); // user login data stored added by SB on 10-12-2015

					/*echo "<pre>";
					print_r($userDetails);
					echo "</pre>";
					exit;*/
				/*	if($userDetails["userType"]=='PAYING USER'){
                    
							$this->addToSubcription();

					} */ // unblock this when required
					if($userDetails['userType']=="ADMIN" || $userDetails['forWebsite']==$this->_forWebsite)
					{
				/*	print_r($this->_forWebsite);
                    echo "<pre>";
					print_r($userDetails);
					echo "</pre>";
					exit;*/
					
                  	 
					  $a=$userDetails["userLevel"];  
						if(trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 1 && $userDetails["userType"]=='VOLUNTEERS' && $userDetails["mssLevelUpPayment"] == 0){
							 $this->session->set_userdata('mssPayStatus', $userDetails["mssLevelUpPayment"]);//29/10/2015 ujjwal sana added
							 redirect(base_url() . 'message', 'refresh');
						}
						elseif(trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 2 && $userDetails["userType"]=='VOLUNTEERS' && $userDetails["mssLevelUpPayment"] == 1){
							 $this->session->set_userdata('mssPayStatus', $userDetails["mssLevelUpPayment"]);//29/10/2015 ujjwal sana added
							 redirect(base_url() . 'catalogue', 'refresh');
						}
                      elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 0) { 
							  $allUserType = $this->common_model->checkIsMonetizer(trim($this->session->userdata('userId')));
							  $uTypeArr = explode('_',$allUserType);
							  if(count($uTypeArr)>0){
								  if($uTypeArr[1]=="Monetizer"){
									  if($uTypeArr[0]=='Beauty'){
										  $moneTypeIdtoIndex = 1;
									  }
									  elseif($uTypeArr[0]=='Meetups'){
										  $moneTypeIdtoIndex = 2;
									  }
									  elseif($uTypeArr[0]=='Models'){
										  $moneTypeIdtoIndex = 3;
									  }
									  elseif($uTypeArr[0]=='Music'){
										  $moneTypeIdtoIndex = 4;
									  }
									  elseif($uTypeArr[0]=='Nutri'){
										  $moneTypeIdtoIndex = 5;
									  }
									  elseif($uTypeArr[0]=='RealEstate'){
										  $moneTypeIdtoIndex = 6;
									  }
									  redirect(base_url() . 'dashboard/ct_index/'.$moneTypeIdtoIndex, 'refresh');
								  }
								  else{
									  redirect(base_url() . 'myaccount', 'refresh');
								  }
								  
							  }else{
								   redirect(base_url() . 'myaccount', 'refresh');
							  }                       
						
                      }elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 1) { 
                        redirect(base_url() . 'fullmembers', 'refresh');
                      }elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 2) { 
                        redirect(base_url() . 'divercity', 'refresh');
                      }elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 3) { 
					
                        redirect(base_url() . 'corporation', 'refresh');
                      }elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 4) { 
                        redirect(base_url() . 'summit', 'refresh');
                      }elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 5) { 
                        redirect(base_url() . 'myaccount/', 'refresh');	
                      }
					}
					else{
                    $viewData['errorMsg'] = "Please enter correct email and password.";
                    $viewData["styleStatus"] = "block";
                    } 
                }else{
                    $viewData['errorMsg'] = "Please enter correct email and password.";
                    $viewData["styleStatus"] = "block";
                } 
            }
        }
        $viewData['pageDetails'] = $this->_getSignupPageDetails();
        $this->load->view('gateway/login', $viewData);
    }
	
	private function _addLoginData(){
		$this->load->library('user_agent');
		if ($this->agent->is_browser()){
    		$agent = $this->agent->browser().' '.$this->agent->version();
		}elseif ($this->agent->is_robot()){
    		$agent = $this->agent->robot();
		}elseif ($this->agent->is_mobile()){
		    $agent = $this->agent->mobile();
		}else{
    		$agent = 'Unidentified User Agent';
		}
		$insertData = array();
		$insertData['userId'] = trim($this->session->userdata('userId'));
		$insertData['browserDetails'] = $agent;
		$insertData['remoteIp'] = $this->input->ip_address();
		$insertData['platform'] = $this->agent->platform();
		$insertData['loginDateTime'] = date("Y-m-d H:i:s");
		$tbl = "user_login_info";
		$id = $this->common_model->insertDataToTable($tbl, $insertData);
		$this->session->set_userdata('lastLoginId', $id);
		return true;
	}
	//24/08/2015 done by ujjwal sana
	public function userdata()
	{
		
		$this->checkLogin();
		$viewData=array();
		$tb1="userinfo";
		$tb2="city";
		$userName=trim($this->session->userdata('userName'));
		$viewData['details']=$this->gatewaymodel->user_details($tb1, $where, $userName);
		$viewData['citylist']=$this->gatewaymodel->city_list();		
		$viewData['countrylist']=$this->gatewaymodel->country_list();			
		$viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
		$id=trim($this->session->userdata('userId'));
		
		 $viewData["list"] = $this->gatewaymodel->getprofile_picture($tb1,$id);
		
		$this->load->view('userdetails/rave_user_details', $viewData);
	}
	function checkLogin() {
        if ($this->session->userdata("userId") == "") {
            redirect(base_url() . "gateway/userdata");
        } else {
            return true;
        }
    }
	

    public function logout() {
		$this->_updateLoginData();
        $redirect = base_url() . 'gateway/';
        $this->session->sess_destroy();
        redirect($redirect, 'refresh');
    }
	public function add_profile_picture()
	{
		
		$id= trim($this->session->userdata('userId'));
		$tb3 = 'userinfo';
		$viewData["list"] = $this->gatewaymodel->getprofile_picture($tb3,$id);
		if($this->input->post('add'))
		{
				$coverImg = $this->uploadBrochureVcards($_FILES['cover_img'],'user/profilepicture/', array("jpeg","gif", "jpg", "png"),"profile");
				if($coverImg['status'] == 1)
				{
					//$inData['title'] = trim($this->input->post('title'));
					$inData['profile'] = $coverImg['name'];
					$this->gatewaymodel->insertDataToTable($tb3, $id, $inData);
					redirect(base_url() . 'gateway/userdata', 'refresh');
				}
		}
		$this->load->view('userdetails/selectprofilepicture/add.php', $viewData);
		//sunset($viewData);
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
	public function gatewayprofileEdit($id= "")
	{
		 $this->checkLogin();
        $viewData = array();
        $viewData["report"] = "";
        $viewData["msg"] = "";        
        $tb1="userinfo";	
         $selectedData = "";
		 $id=$this->session->userdata('userId');
		  $viewData["image"] = $this->gatewaymodel->getprofile_picture($tb1,$id);
        $viewData["list"] = $this->gatewaymodel->fetchDataFromTable($tb1, $where, $id);
		$viewData['citylist']=$this->gatewaymodel->city_list();
		$viewData['countrylist']=$this->gatewaymodel->country_list();
       // $viewData["val"] = $viewData["list"][0];
        //unset($viewData["list"][0]);
        $this->load->view('userdetails/edit.php', $viewData);

	}
	public function profiledataupdate()
	{
		$data = array();
			$tb2="userinfo";
			$id= trim($this->session->userdata('userId'));	
            $data["firstName"] = $_POST['firstName'];
            $data["lastName"] = $_POST['lastName'];
            $data["gender"] = $_POST['gender'];
            $data["address"] = $_POST['address'];
            $data["occupation"] = $_POST['occupation'];
			$data["emailID"] =$_POST['emailID'];
            $data["phone"] = $_POST['phone'];
            $data["zip"] = $_POST['zip'];
			$data["city"]=$_POST['city'];
			$data["country"]= $_POST['country'];
			//$data["country"]=  $this->input->post('countryid');
			//$data["state"]=$this->input->post('state');
		    $add = $this->gatewaymodel->updateDataToTable($tb2,$where,$id,$data);
            if ($add) {
               echo  $add;
			   
            } else {
				$add=0;
				echo $add;
               
            }
			
	}
	
	private function _updateLoginData(){
		$tbl = 'user_login_info';
		$where = array("id"=>trim($this->session->userdata('lastLoginId')));
		$data = array("logoutDateTime"=>date("Y-m-d H:i:s"),'loginStatus'=>0) ;
		$update = $this->common_model->updateDataToTable($tbl, $where, $data );
		return true;
	}

    public function signUpRequest($parentID = 0) {
		
        $viewData = array();
        $viewData["styleStatus"] = "none";
        
        if ($this->input->post('submit')) {
            $generalUserType = "general";
			$this->load->library('form_validation');
           // $this->form_validation->set_rules('signUpName', 'Name', 'trim|required');
			$this->form_validation->set_rules('signUpEmail', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$viewData["parentID"] = $this->getParentId();
			$viewData['name'] = "";//trim($this->input->post('signUpName'));
			$viewData['surname'] = "";
			$viewData['cellno'] = "";
			$viewData['emailAddr'] = trim($this->input->post('signUpEmail'));
			$viewData['city'] = "";
			$viewData['skypeID'] = "";
			$viewData['userType'] = "PAYING USER";
			$viewData['password'] = '';
			//inser data start here			
			/*$insertData['firstName'] = "";//trim($this->input->post('signUpName'));
			$insertData['lastName'] = "";
			$insertData['phone'] = "";
			$insertData['emailID'] = trim($this->input->post('signUpEmail'));
			$insertData['city'] = "";
			$insertData['skypeID'] = "";
			$insertData['userType'] = "PAYING USER";
			$insertData['password'] = 'root';
			$insertData['forWebsite'] = 3;
			$tbl = 'userinfo';*/
			if ($this->form_validation->run() != FALSE)
			 {
				//$signupId = $this->gatewaymodel->insertData($viewData);
               // $this->insertGeneralUserType($signupId,$generalUserType);
			   // $viewData = $this->common_model->insertDataToTable_for_signup($tbl,$insertData);
				$this->sendEmailToUser($viewData);
				$this->sendEmailToAdmin($viewData);				
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
		$this->session->set_flashdata('msg',$msg);
        $redirectUrl = base_url() . 'gateway';
		
     	redirect($redirectUrl, 'refresh');
    }
	
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
	
	public function checkUniqueEmail() {
        $emailAddr = trim($this->input->post('signUpEmail'));
        $cond_array = array('emailID' => $emailAddr);
        $tbl = 'userinfo';
        $status = $this->gatewaymodel->checkUniqueValue($tbl, $cond_array);
        if ($status >= 1) {
            $this->form_validation->set_message('checkUniqueEmail', 'This Email Address "' . $emailAddr . '" is already used.');
            return false;
        } else {
            return true;
        }
    }
    
    public function insertGeneralUserType($signupId,$generalUserType){
        $tbl = "user_general_type";
        $data['user_id'] = $signupId;
        $data['user_general_type_name'] = $generalUserType;
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
    }
	    
    private function sendEmailToAdmin($data = array()) {
        
        $this->_to_email = $this->_admin_email;
		//$this->_password=$data['password'];
        $this->_subject = "New General user Signup of CT";
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Admin,</td></tr>
								<tr><td colspan="2">Here is a new Sign up for general user details.</td></tr>
								<!--<tr><td width="25%">Name:</td><td width="75%">' . $data['name'] . '</td></tr>-->
                                
								
								
								<tr><td width="25%">Email :</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
								
                                                                   
								
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

    private function sendEmailToUser($data = array()) {
        $this->_to_email = $data['emailAddr'];
		//$this->_password=$data['password'];
        $this->_subject = 'Sign up confirmation mail';
        $this->_message = '<html><body><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial; font-weight:400; text-align:justify; color:#000;" align="center">
  <tbody>
    <tr>
      <td style="font-size:12px; font-weight:bold;padding-bottom: 1%;">CT LAUNCHING IN LONDON</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">Thank you for signing up.<br/>
		  You have now been added to the CT prospects list.</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:bold;  padding-bottom: 1%;">What is CT?</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">It&acute;s impossible to say what CT is in one single word but to best describe it, is to understand its function.</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:400;  padding-bottom: 1%;">In short, CT means Global Black Enterprises.</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">This global movement is the glue uniting thousands, in a pledge to make our communities Safer and<br/> healthier while &acute; we move as one &acute; to make ourselves wealthier.</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">Our programs are designed to boost black owned businesses, entrepreneurs, mentors and services.<br/>
We provide a global platform to give vital exposure for our talented people, fashion and creative arts.<br/>
Using Our Online system CT members can create personal wealth and dramatically raise their income.
</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:400;  padding-bottom: 1%;">Our Mindset is NOT ABOUT HATRED or discrimination. we mutually respect all people of<br/> all races.</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">CT Is about coming together,  moving as one to help put an end to poverty in African<br/> 
Taking actions to finally raise the standards for black people in the western world and throughout the entire<br/> African diaspora. 
</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:bold;  padding-bottom: 1%;">On Friday February 27th <span style="font-weight:400;">2015</span></td>
    </tr>
    <tr>
      <td style="font-size:14px; font-weight:400;  padding-bottom: 1%;">CT online will be open for prospects.</td>
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
      <td style="font-size:12px; font-weight:bold;  padding-bottom: 1%;">We Are CT</td>
	
    </tr>    
  </tbody>
</table></body></html>';
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
			return true;
        } else {
            return false;
        }
    }

    function send_mail_raw() {
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

    public function isValidEmail() {
        $email = trim($this->input->post('emailID'));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->form_validation->set_message('isValidEmail', 'This is not a valid mail address.');
            return false;
        } else {
            $isExist = $this->gatewaymodel->isMailExist($email);
            if (!$isExist) {
                $this->form_validation->set_message('isValidEmail', 'This Email address already in use.');
                return false;
            } else {
                return true;
            }
        }
    }

    public function confPassword() {
        if (trim($this->input->post('password')) != trim($this->input->post('ConfPassword'))) {
            $this->form_validation->set_message('confPassword', 'Password and Confirm password field values are not same');
            return false;
        } else {
            return true;
        }
    }
    // added by SB on 06/07/2015
     public function forgetPass() {
        
        $viewData = array();
        $viewData["errorMsg1"] = "";
		$viewData["succMsg"] = "";
        $viewData["styleStatus1"] = "block";
		$viewData["styleStatus"] = "none";
        if ($this->input->post('forgetPassBtn')) {		
			
            if ($this->input->post('emailIDforFrogetPass') != "") {				
                $userDetails = $this->gatewaymodel->getPassword($this->input->post('emailIDforFrogetPass'));
                if (!empty($userDetails)) {
					//echo base_url()."===<br>";
					
					$viewData["emailID"] = $userDetails["emailID"];//'senabi.test01@gmail.com';
					$viewData["password"] = $userDetails["password"];
					$this->forgetPasswordMailToUser($viewData);					
                    $viewData["succMsg"] = "Mail sent Successfully";
                    $viewData["styleStatus1"] = "block";
                   
                }else{
					
                    $viewData["errorMsg1"] = "Please enter correct email.";
                    $viewData["styleStatus1"] = "block";
					
                } 
            }
        }
		//print_r($viewData);
        $viewData['pageDetails'] = $this->_getSignupPageDetails();
        $this->load->view('gateway/login', $viewData);
    } 
	
    
    private function forgetPasswordMailToUser($data = array()) {
        $this->_to_email = $data['emailID'];
		 $this->_subject = 'Forget Password Request';
		if($data['password']!=""){	
       
        $this->_message = '<html><body><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial; font-weight:400; text-align:justify; color:#000;" align="center">
  <tbody>
    <tr>
      <td style="font-size:12px; font-weight:bold;padding-bottom: 1%;">Request for Password</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;"><br/>
		  Please find your sign up Detail below.</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:bold;  padding-bottom: 1%;">Email: '. $data['emailID'].'</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">Password: '.$data['password'] .'</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:400;  padding-bottom: 1%;"></td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">Thank You, <br> CT Team</td>
    </tr>     
  </tbody>
</table></body></html>';

		}
		else{
			
        $this->_message = '<html><body><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial; font-weight:400; text-align:justify; color:#000;" align="center">
  <tbody>
    <tr>
      <td style="font-size:12px; font-weight:bold;padding-bottom: 1%;">Request for Password</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;"><br/>
		  Your account is not approved by Administrator, you cannot retrieve your password.</td>
    </tr>
    
    <tr>
      <td style="font-size:12px; font-weight:400;  padding-bottom: 1%;"></td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">Thank You, <br> CT Team</td>
    </tr>     
  </tbody>
</table></body></html>';
		}
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
    }

	// function to track first login  added by SB on 18/09/2015

	function addToSubcription(){

		$tbl = "user_subscription_info";

        $data['userId'] = trim($this->session->userdata('userId'));

		$userSubscriptionExist = $this->gatewaymodel->checkUserExists(trim($this->session->userdata('userId'))); 

		if($userSubscriptionExist==0){

			$data['userLevel'] = 0;

			$data['subscriptionStartDt'] = date("Y-m-d H:i:s");

			$data['subscriptionEndDt'] =  date('Y-m-d H:i:s', strtotime("+30 days") );

			$data['subscriptionStatus'] = 0;

			

			$this->common_model->insertDataToTable($tbl, $data);

			return true;

		}

	}
	
}
