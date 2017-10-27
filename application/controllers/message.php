<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends CI_Controller {
    private $_from_email;
    private $_from_name;
    private $_admin_email;
    private $_to_email;
    private $_subject;
    private $_message;
    public $city;
	public $userId;
	public $referarId;
	public $userType;
	public $forWebsite;// added by SB on 13/10/2015
	public $mssPayStatus;//29/10/2015 us 
	
    function __construct() {
        parent::__construct();
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
		$this->userId = trim($this->session->userdata('userId'));
		$this->referarId = trim($this->session->userdata('referarId'));
		$this->userType = trim($this->session->userdata('userType'));
        $this->_from_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
		$this->load->model('gatewaymodel');
		$this->load->model('message_model');
		$this->city = $this->gatewaymodel->getCity();
		$this->forWebsite = trim($this->session->userdata('forWebsite'));// added by SB on 13/10/2015
		$this->mssPayStatus = trim($this->session->userdata('mssPayStatus'));
    }
	
    public function index() {
        $viewData = array();
		$viewData["tabhide"] = 0;
        $viewData["msg"] = "";
		$viewData["status"] = "";//error
        if($this->referarId == 0 || $this->referarId == '') {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1076);
        }else{
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->referarId);
        }
		if ($this->input->post('submit')) {
			$retData = $this->addMassUser();
			$viewData["msg"] = $retData["msg"];
			$viewData["status"] = $retData["status"];
        	$viewData["type"] = 'MASS';
		}
		$viewData['countDay'] = $this->getDayDiff();
        $viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->userId);
		$viewData["massDetails"] = $this->makingMassView();//$this->message_model->getAllMassUser($this->userId,$this->userType);
		$viewData['massLoginUserDetails'] = $this->message_model->getUserDetails($this->userId);
		$viewData['sendMassUserCount'] = 0;
		$viewData['sendMassUserLevel'] = 0;
		$viewData['totalUserUnderMassUser'] = 0;
		$viewData["stepWiseVideo"] = $this->gatewaymodel->getLevelStepVideo(8);//29/10/2015 ujjwal sana added
		//print_r($viewData["stepWiseVideo"]);
		// fetch page text of user added by SB on 13/10/2015
		$tbl = "gbe_page_text_for_user";
		$where = array("user_id" => trim($this->userId));
		$selectedData = 'page_text';
		$pageTextDetail = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		unset($tbl);		
		$viewData['page_text'] = $pageTextDetail[0]->page_text;
		if($this->userType != "ADMIN"){
			$totalMassCount = $this->message_model->getTotalMassUser($this->userId,$viewData["userInfo"][0]['userLevel']);
			if($totalMassCount == 5){//this shoule be 5
				$viewData['sendMassUserCount'] = 1;	
			}
			$viewData['totalUserUnderMassUser'] = $this->message_model->totalMassCountUnderUser($this->userId);
			if($viewData["userInfo"][0]['userLevel'] == 1 && $viewData['totalUserUnderMassUser'] >= 5){//this shoule be 5
				$tbl = 'userinfo';
				$upData['userLevel'] = 2;
				//$upData['mssLevelUpPayment'] = 1;
				$where = array("uID"=>$this->userId);
				$this->common_model->updateDataToTable($tbl, $where, $upData);
			}
			$smul = $this->message_model->getMassUserLevel($this->userId);
			if($smul[0]->l1 != ''){
				$viewData['sendMassUserLevel'] = 1;
			}
		}
		$viewData['mssPayStatus']=$this->mssPayStatus;//29/10/2015 us added
		$viewData['userType'] = $this->userType;
		$viewData['city'] = $this->city;
       	$this->load->view('message/index',$viewData);
		unset($viewData);
    }
	
	public function makingMassView(){
		$result = $this->message_model->getAllMassUser($this->userId);
		$retData = array();
		if(count($result) > 0){
			foreach($result as $rd){
				if($rd->login!=0){
				$retData[$rd->user_id][$rd->to_user_id]['user_id'] = $rd->uID;
				$retData[$rd->user_id][$rd->to_user_id]['cuFName'] = $rd->cuFName;
				$retData[$rd->user_id][$rd->to_user_id]['cuLName'] = $rd->cuLName;
				$retData[$rd->user_id][$rd->to_user_id]['cuEmail'] = $rd->cuEmail;
				$retData[$rd->user_id][$rd->to_user_id]['cuPhone'] = $rd->cuPhone;
				$retData[$rd->user_id][$rd->to_user_id]['created_date'] = $rd->created_date;
				$retData[$rd->user_id][$rd->to_user_id]['city'] = $rd->city;
				}
			}
		}
		return $retData;
	}
	
	public function addMassUser(){
		$retData['status'] = 'error';
		$retData['msg'] = '';
		if($this->userType == 'ADMIN'){
			$sign_up_user_type = 'HEAD VOLUNTEERS';
		}else if($this->userType == 'HEAD VOLUNTEERS'){
        	$sign_up_user_type = 'VOLUNTEERS';
		}else{
			$sign_up_user_type = 'VOLUNTEERS';
		}
        $generalUserType = "general";
        $viewData = array();
        

        if ($this->input->post('submit')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
            $this->form_validation->set_rules('city', 'City', 'trim|required'); 
			$this->form_validation->set_rules('message', 'Message', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            $viewData['cellno'] = '';
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = trim($this->input->post('city'));
            //$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['phone'] = trim($this->input->post('phone'));
			$viewData['userType'] = $sign_up_user_type;
            $viewData['password'] = $this->generatePassword();
			$viewData['forWebsite']	=	$this->forWebsite; // added by SB on 13/10/2015
			$message = $this->input->post('message');
			
            if ($this->form_validation->run() != FALSE) {
				if($this->userType == 'ADMIN'){
					$viewData["parentID"] = $this->userId; //block by SB on 13/10/2015
					//$userLevel = trim($this->input->post('userLevel')); //block by SB on 13/10/2015
					$userLevel = 0; //added by SB on 13/10/2015
				}
				else{
					//-----------get volunteer parent id ,and volunteer level start ------------
					$volChildData = $this->selectParentVolunteer($viewData['city']);
					//print_r($volChildData); exit;
					if($volChildData['selectedParentId']!=""){//29/10/2015 sb added
						$viewData["parentID"]= $volChildData['selectedParentId'];
					}
					else{
						$viewData["parentID"]= $this->userId;
					}
					$userLevel = $volChildData['volLevel'];
					$viewData['userLevel']=1;//mass user level set to 1 as level 1 is free after adding 12 member , mass user can upgrade to level 2 added by ujjawal on 29/10/2015
					// ------get volunteer parent id ,and volunteer level  end------------------------
				}
				$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($this->input->post('city')));// get currency by city Added by SB on 20/07/2015
                $signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015
				/*if($this->userType != "ADMIN"){
                	$this->insertGeneralUserType($signupId,$generalUserType);
				}*/
				//$this->insertMssDetails($userLevel,$signupId,$message);// block by SB on 13/10/2015
				$this->insertMssDetailsNew($userLevel,$signupId,$message,$viewData["parentID"]); // block by SB on 13/10/2015
                $this->sendEmailToUser($signupId);
				$this->sendEmailToUserCheck($signupId);
                $retData['status'] = 'success';
                $retData['msg'] = 'You have successfully send Login details for the MASS user.';
            } else {
                $retData['msg'] = 'Please check the error(s) as below.';
            }
        }
         return $retData;
	}
	
	public function sendEmailToUser($signupId){
		$details = $this->message_model->getUserDetails($signupId);
        $this->_to_email = $details[0]->cuEmail;
        $this->_subject = "V.I.P Entrance For My True 12 - Make Money Online";
        $this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
  <p style="font-size:14px;">Hello   '.$details[0]->cuFName.' '.$details[0]->cuLName.'</p>
  <p style="font-size:14px;">You have been given the gift of V.I.P entrance to the GBE wealth platform. This means you will be one of the first in this city to upload and list a product, service or talent onto Afrowebb. You will also financially benefit from this V.I.P software giving you a short cut to your success.</p>
  <p>Take Action</p>
  <p style="font-size:14px;">You will need to move fast to secure your extremely  privileged  position in our system because if  you remain dormant, this account will be closed and your  opportunity will pass.</p>
  <p>First,</p>
  <p style="font-size:14px;">Enter your GBE account, using the username and password below. Watch the first 4 videos so you can understand the business and the payment plan. Work with the person who has invited you to Turn your business, your brand, event, service into a product to be sold on the Afrowebb.</p>
   <p>Second,</p>
  <p style="font-size:14px;">As Black people, we must develop prosperous, safe and healthy communities. We, GBE believe , this can only be done once more of us are economically empowered and financially secure enough to help ourselves. This is one of the reasons why our wealth system was created. Your task is to enter using the "username and password" below then share the V.I.P entrance to help 12 sincere Black-owned enterprises, just as somebody shared this to help you.</p>
  
  <p style="font-size:14px;">Only by rising to the challenge of becoming wealthier as a community can we truly dedicate the time and acquire the resources to make any real positive change.</p>
  
  <p style="font-size:14px;">Third, Yet most importantly - PREPARE TO MOVE AS ONE.</p>
  
  <p style="font-size:14px;">On a specific date ,when your team leader  tells you  to, you must move up to level two. There will be no risk as the entire team around you will work as one unit ,allowing immediate profits to flow for each of the participants. </p>
  
  <p style="font-size:14px;"> Remember This is Your Moment!   Be Strong, Have Faith - Move As One & Together we will be financially Free. </p>
  
  <p style="font-size:14px;">Enter Now</p>
  
  <p style="font-size:14px;">Here are your login credentials</p>
  <p style="font-size:14px;">Username:     '.$details[0]->cuEmail.'</p>
  <p style="font-size:14px;">Password:     '.$details[0]->cupwd.'</p>
  <p style="font-size:14px;">Message:     '.$details[0]->message.'</p>
	<p style="font-size:14px;"><a href="'.base_url().'">Click here to login</a></p></div>';
        
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
	}
	
	public function sendEmailToUserCheck($signupId){
		$details = $this->message_model->getUserDetails($signupId);
        $this->_to_email = 'senabi.test01@gmail.com';//$details[0]->cuEmail;
        $this->_subject = "V.I.P Entrance For My True 12 - Make Money Online";
        $this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
  <p style="font-size:14px;">Hello   '.$details[0]->cuFName.' '.$details[0]->cuLName.'</p>
  <p style="font-size:14px;">You have been given the gift of V.I.P entrance to the GBE wealth platform. This means you will be one of the first in this city to upload and list a product, service or talent onto Afrowebb. You will also financially benefit from this V.I.P software giving you a short cut to your success.</p>
  <p>Take Action</p>
  <p style="font-size:14px;">You will need to move fast to secure your extremely  privileged  position in our system because if  you remain dormant, this account will be closed and your  opportunity will pass.</p>
  <p>First,</p>
  <p style="font-size:14px;">Enter your GBE account, using the username and password below. Watch the first 4 videos so you can understand the business and the payment plan. Work with the person who has invited you to Turn your business, your brand, event, service into a product to be sold on the Afrowebb.</p>
   <p>Second,</p>
  <p style="font-size:14px;">As Black people, we must develop prosperous, safe and healthy communities. We, GBE believe , this can only be done once more of us are economically empowered and financially secure enough to help ourselves. This is one of the reasons why our wealth system was created. Your task is to enter using the "username and password" below then share the V.I.P entrance to help 12 sincere Black-owned enterprises, just as somebody shared this to help you.</p>
  
  <p style="font-size:14px;">Only by rising to the challenge of becoming wealthier as a community can we truly dedicate the time and acquire the resources to make any real positive change.</p>
  
  <p style="font-size:14px;">Third, Yet most importantly - PREPARE TO MOVE AS ONE.</p>
  
  <p style="font-size:14px;">On a specific date ,when your team leader  tells you  to, you must move up to level two. There will be no risk as the entire team around you will work as one unit ,allowing immediate profits to flow for each of the participants. </p>
  
  <p style="font-size:14px;"> Remember This is Your Moment!   Be Strong, Have Faith - Move As One & Together we will be financially Free. </p>
  
  <p style="font-size:14px;">Enter Now</p>
  
  <p style="font-size:14px;">Here are your login credentials</p>
  <p style="font-size:14px;">Username:     '.$details[0]->cuEmail.'</p>
  <p style="font-size:14px;">Password:     '.$details[0]->cupwd.'</p>
  <p style="font-size:14px;">Message:     '.$details[0]->message.'</p>
	<p style="font-size:14px;"><a href="'.base_url().'">Click here to login</a></p></div>';
        
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
	}
	
	public function send_mail_raw() {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
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
	
	private function generatePassword() {
        $string = mt_rand();
        $start = 1;
        $length = 8;
        $code = substr($string, $start, $length);
        $code = "GBE" . $code;
        return $code;
    }
	
	public function insertGeneralUserType($signupId,$generalUserType){
        $tbl = "user_general_type";
        $data['user_id'] = $signupId;
        $data['user_general_type_name'] = $generalUserType;
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
    }
	
	public function checkUniqueEmail() {
        $emailAddr = trim($this->input->post('emailAddr'));
        $cond_array = array('emailID' => $emailAddr);
        $tbl = 'userinfo';
        $status = $this->gatewaymodel->checkUniqueValue($tbl, $cond_array);
        if ($status >= 1) {
            $this->form_validation->set_message('checkUniqueEmail', 'Email "' . $emailAddr . '" is already used.');
            return false;
        } else {
            return true;
        }
    }
	
	public function insertMssDetails($userLevel,$toUserId,$message){
		$tbl = "gbe_mass_details";
        $data['user_id'] = $this->userId;
        $data['user_level'] = $userLevel;
		$data['to_user_id'] = $toUserId;
        $data['message'] = $message;
		$data['created_date'] = date('Y-m-d H:i:s');
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
	}
	// added by SB on 13/10/2015
	public function insertMssDetailsNew($userLevel,$toUserId,$message,$parentId){
		$tbl = "gbe_mass_details";
        $data['user_id'] = $parentId;
        $data['user_level'] = $userLevel;
		$data['to_user_id'] = $toUserId;
        $data['message'] = $message;
		$data['created_date'] = date('Y-m-d H:i:s');
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
	}
	public function getDayDiff(){
		$retData = 0;
		if($this->userType != "ADMIN"){
			$retData = $this->message_model->getDayDiff($this->userId);
		}
		return $retData;
	}
	    // function to get user_id of volunteer to add as parent for equal MMS volunteer distribution added by SB on 08-10-2015
	public function selectParentVolunteer($city){
		$volData = array();
		// check level 1 user having child or not 
		$levelOneVol = $this->message_model->volChildExits(1,$city);
		
		if($levelOneVol>0){
		// check level 1 volunteer  having child count less than 12 take 1
			$minUserChildCount = $this->message_model->volChildLessThanTwelve(1,$city); 
			//echo $minUserChildCount; exit;
			if($minUserChildCount>0){
							 
				$volData['selectedParentId'] =$minUserChildCount;
				$volData['volLevel']= 2;
				
			}else{
				
				// if all level 1 vol having child 12 each then check for level 2 vol
			
				$levelTwoVol = $this->message_model->volChildExits(2,$city);
				if($levelTwoVol>0){
			
					//check for level 2 volunteer having child count less than 12 take 1
					$minUserChildCount2 = $this->message_model->volChildLessThanTwelve(2,$city);
				
					if($minUserChildCount2>0){
					
						$volData['selectedParentId'] =$minUserChildCount2;
						$volData['volLevel']= 3;
						
						}else{
						
							// if all level 2 vol having child 12 each then check for level 3 vol
							$levelThreeVol = $this->message_model->volChildExits(3,$city);
							if($levelThreeVol>0){							
							//check for level 2 volunteer having child count less than 12 take 1
								$minUserChildCount3 = $this->message_model->volChildLessThanTwelve(3,$city);// doing me
								if($minUserChildCount3>0){
														 
									$volData['selectedParentId'] =$minUserChildCount3;
									$volData['volLevel']= 4;
								
								}
								else{
									
									// nothing 
								}
							}else{
								// if no child exit take 1 level 2 volunteer
								$volData['selectedParentId'] = $this->message_model->getOneVolunteer(3,$city);
								$volData['volLevel']= 4;
								
							}						
						
						}					
				}
				else{
					// if no child exit take 1 level 2 volunteer
					$volData['selectedParentId'] = $this->message_model->getOneVolunteer(2,$city);
					$volData['volLevel']= 3;
				}
			}
		}
		else{
			
			// if no child exit take 1 level 1 volunteer
			$volData['selectedParentId'] = $this->message_model->getOneVolunteer(1,$city);
			$volData['volLevel']= 2;
		}
		return $volData;
	}
	
	// check the Volunteer distribution function
	 public function checkVolunteerDistributionFunction(){
		 $city = 1;
		 $volChildData = array();
		 $volChildData = $this->selectParentVolunteer($city);
		/* $minUserChildCount = $this->message_model->volChildLessThanTwelve(1,$city);
		 //print_r($minUserChildCount);
		 foreach($minUserChildCount as $minUserChildCounts){
				 if($minUserChildCounts['total']<12){
					 echo $minUserChildCounts['total']."=============".$minUserChildCounts['to_user_id']."<br>";
				 }
		 }*/
			 
		if($volChildData>0){
			echo $volChildData['selectedParentId']."+++++++++++++++++".$volChildData['volLevel'];
		}
		else{
			 echo "No data";
		}	
	 }
	

	
	
	
	
}
