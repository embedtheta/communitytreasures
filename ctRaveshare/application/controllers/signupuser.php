<?php
/*
Created by Ranajit Das  
*/
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Signupuser extends CI_Controller {

	private $_from_email = "";
	private $_from_name = "";
	private $_admin_email = "";
	private $_message = "";
	private $_subject = "";
	private $_to_email = "";
	public $sign_up_user_type;
	public $city;
	public $videoPath;
	public $forWebsite;

	function __construct() {
		parent::__construct();
		$this->_from_email = "admin@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";// change by SB on 22/03/2016
		$this->_from_name = "communitytreasures.co";
		$this->_admin_email = "admin@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
		$this->load->model('gatewaymodel');
		$this->load->model('common_model');
		$this->load->model('message_model');// added by SB on 10/06/2016
		$this->load->helper('common');
		$this->sign_up_user_type = '';
		$this->forWebsite = 2;
		$this->city = $this->gatewaymodel->getCity();
		//$this->country = $this->common_model->getCustomCountryList();
		/* if(trim($this->session->userdata('UserId'))!=""){
		  if($_REQUEST["actionLog"] == ""){
		  redirect(base_url().'dashboard/', 'refresh');
		  }
		  } */
		  
		 
	}

	/* public function index() { 
		redirect(base_url() . "signup/mentorship");
	} */
	
	

	public function founders($signupId) {
		$this->_setSignupPageDetails(5);
		$this->sign_up_user_type = "FOUNDERS";
		$generalUserType = "Founder";
		$viewData = array();
		$viewData['city'] = 3;
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		$userFormDetail =$this->message_model->getUserInfo($signupId);
		$viewData['name'] = $userFormDetail[0]['firstName'];
		$viewData['surname'] = $userFormDetail[0]['lastName'];	
		$viewData['cellno'] = $userFormDetail[0]['phone'];	
		$viewData['emailAddr'] = $userFormDetail[0]['emailID'];	
		$viewData['skypeID'] = $userFormDetail[0]['skypeID'];
		$viewData["parentID"] = $userFormDetail[0]['referarID'];
		$password = $userFormDetail[0]['password'];// added by SB on 23/06/2016
		$viewData["vipUserId"] = $signupId;// added by SB on 23/06/2016
		/* if ($parentID == 0) {
			$parentID = 1000;
			$viewData["parentID"] = $parentID;
		} else if ($parentID > 0) {
			$ustatus = $this->gatewaymodel->isMemberExist($parentID);
			if ($ustatus) {
				$viewData["parentID"] = $parentID;
			} else {
				$viewData["parentID"] = 1000;
			}
		} */
		//echo $viewData["parentID"];
		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			//$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmailWithId');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			
			$instData = array();
			$instData['emailID'] = trim($this->input->post('emailAddr'));
			$instData['password'] = $password ;
			/* 
			$instData["uID"] = $signupId;// added by SB on 23/06/2016
			$instData["referarID"] = $userFormDetail[0]['referarID'];	
			$instData['firstName'] = trim($this->input->post('name'));
			$instData['lastName'] = trim($this->input->post('surname'));
			$instData['phone'] = trim($this->input->post('cellno'));
			
			$instData['city'] = 3;//trim($this->input->post('city'));
			$instData['currency'] = $this->gatewaymodel->getCurrency(trim($instData['city']));// get currency by city Added by SB on 07/08/2015
			$instData['skypeID'] = trim($this->input->post('skypeID'));
			$instData['userType'] = "FOUNDERS";
			$instData['password'] = $password ;//$this->generatePassword();	// added by SB on 23/06/2016		
			$instData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
			$instData["userLevel"] = 1;// userlevel 1
			$instData['forWebsite'] = $this->forWebsite;//2/10/2015 us */
			
			
			if ($this->form_validation->run() != FALSE) {
			   //$signupId = $this->gatewaymodel->insertData($viewData);				
			   // $raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$instData);
			   // update rave_userinfo table 
			    $tbl = 'rave_userinfo';	
				$upData = array();
				$upData["firstName"] = trim($this->input->post('name'));
				$upData["lastName"] = trim($this->input->post('surname'));
				$upData["phone"] = trim($this->input->post('cellno'));
				$upData["skypeID"] = trim($this->input->post('skypeID'));
				$upData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
				$upData["status"] = '1';
				$upData['userType'] = "FOUNDERS";
				$upData['parentId'] = $this->gatewaymodel->getParentId();
				$upData['raveType'] = $generalUserType;
				$upData['confirmStatus'] = '1';
				$upData['confirmedOn'] = date("Y-m-d h:i:s");
                $raveUserId = trim($this->input->post('vipUserId'));				
				$where = array("uID"=>$raveUserId);				
			    $upDateUser = $this->common_model->updateDataToTable($tbl, $where, $upData);
				if($upDateUser){
				
					//Updating user name
					$raveuser_name	=	$this->common_model->updateRaveUserName($raveUserId);
					//Generate Signup Link
					if($raveuser_name==true){
						$this->gatewaymodel->createRouteRave();
					}
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveUserId;
					$typeData['raveType'] =$generalUserType;// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
					$viewData['msgType'] = 1; //1=su;2=fa
					$viewData['msg'] = 'You have successfully completed the signup process.<br> Please check your mail for further instructions';
				}
				else{
						$viewData['msgType'] = 2; //1=su;2=fa
						$viewData['msg'] = 'Please try again.';
					}
				
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		//$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('gateway/founder', $viewData);
	}
	
	public function industryleader($signupId){ //echo "++".$signupId;
		$this->_setSignupPageDetails(4);
		$this->sign_up_user_type = "INDUSTRY LEADER";
		$generalUserType = "Active";
		$viewData = array();
		$viewData['city'] = 3;
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		$userFormDetail =$this->message_model->getUserInfo($signupId);
		$viewData['name'] = $userFormDetail[0]['firstName'];
		$viewData['surname'] = $userFormDetail[0]['lastName'];	
		$viewData['cellno'] = $userFormDetail[0]['phone'];	
		$viewData['emailAddr'] = $userFormDetail[0]['emailID'];	
		$viewData['skypeID'] = $userFormDetail[0]['skypeID'];
		$viewData["parentID"] = $userFormDetail[0]['referarID'];
		$password = $userFormDetail[0]['password']; // added by SB on 23/06/2016
		$viewData["vipUserId"] = $signupId; // added by SB on 23/06/2016
		/* if ($parentID == 0) {
			$parentID = 1000;
			$viewData["parentID"] = $parentID;
		} else if ($parentID > 0) {
			$ustatus = $this->gatewaymodel->isMemberExist($parentID);
			if ($ustatus) {
				$viewData["parentID"] = $parentID;
			} else {
				$viewData["parentID"] = 1000;
			}
		} */

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			//$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmailWithId');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			$instData = array();
			$instData['emailID'] = trim($this->input->post('emailAddr'));
			$instData['password'] = $password ;
			/* $instData = array();
			$instData["uID"] = $signupId;// added by SB on 23/06/2016			
			$instData["referarID"] = $userFormDetail[0]['referarID'];	
			$instData['firstName'] = trim($this->input->post('name'));
			$instData['lastName'] = trim($this->input->post('surname'));
			$instData['phone'] = trim($this->input->post('cellno'));
			$instData['emailID'] = trim($this->input->post('emailAddr'));
			$instData['city'] = 3;//trim($this->input->post('city'));
			$instData['currency'] = $this->gatewaymodel->getCurrency(trim($instData['city']));// get currency by city Added by SB on 07/08/2015
			$instData['skypeID'] = trim($this->input->post('skypeID'));
			$instData['userType'] = "INDUSTRY LEADER";
			$instData['password'] = $password ;//$this->generatePassword();	// added by SB on 23/06/2016			
			$instData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
			$instData["userLevel"] = 1;// userlevel 1
			$instData['forWebsite'] = $this->forWebsite;//2/10/2015 us */
			
			if ($this->form_validation->run() != FALSE) {
				//$signupId = $this->gatewaymodel->insertData($viewData);
				// $raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$instData);
			   // update rave_userinfo table 
			    $tbl = 'rave_userinfo';	
				$upData = array();
				$upData["firstName"] = trim($this->input->post('name'));
				$upData["lastName"] = trim($this->input->post('surname'));
				$upData["phone"] = trim($this->input->post('cellno'));
				$upData["skypeID"] = trim($this->input->post('skypeID'));
				$upData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
				$upData["status"] = '1';
				$upData['userType'] = "INDUSTRY LEADER";
				$upData['parentId'] = $this->gatewaymodel->getParentId();
				$upData['raveType'] = $generalUserType;
				$upData['confirmStatus'] = '1';
				$upData['confirmedOn'] = date("Y-m-d h:i:s");
                $raveUserId = trim($this->input->post('vipUserId'));				
				$where = array("uID"=>$raveUserId);
				$upDateUser = $this->common_model->updateDataToTable($tbl, $where, $upData);
				if($upDateUser){
					//Updating user name
					$raveuser_name	=	$this->common_model->updateRaveUserName($raveUserId);
					//Generate Signup Link
					if($raveuser_name==true){
						$this->gatewaymodel->createRouteRave();
					}
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveUserId;
					$typeData['raveType'] =$generalUserType;// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
					$viewData['msgType'] = 1; //1=su;2=fa
					$viewData['msg'] = 'You have successfully completed the signup process.<br> Please check your mail for further instructions';
				}
				else{
						$viewData['msgType'] = 2; //1=su;2=fa
						$viewData['msg'] = 'Please try again.';
					}
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
			$viewData['msgType'] = 1; //1=su;2=fa
			$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		//$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('gateway/industry_leader', $viewData);
	}
      public function user($signupId){
		
		$this->_setSignupPageDetails(4);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "Active";
		$viewData = array();
		$viewData['city'] = 3;
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		$userFormDetail =$this->message_model->getUserInfo($signupId);
		/*echo "<pre>";
		print_r($userFormDetail);
		echo "</pre>";*/
		$viewData['name'] = $userFormDetail[0]['firstName'];
		$viewData['surname'] = $userFormDetail[0]['lastName'];	
		$viewData['cellno'] = $userFormDetail[0]['phone'];	
		$viewData['emailAddr'] = $userFormDetail[0]['emailID'];	
		$viewData['skypeID'] = $userFormDetail[0]['skypeID'];
		$viewData['country'] = $userFormDetail[0]['country_id'];
		$viewData["parentID"] = $userFormDetail[0]['referarID'];
		$password = $userFormDetail[0]['password'];// added by SB on 23/06/2016
		$viewData["vipUserId"] = $signupId;// added by SB on 23/06/2016
		$viewData['afrooPaymentStatus'] = $userFormDetail[0]['afrooPaymentStatus'];
		
		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmailWithId');
			
			$instData = array();
			$instData['emailID'] = trim($this->input->post('emailAddr'));
			$instData['password'] = $password ;
			
			
			if ($this->form_validation->run() != FALSE) {
				
				$tbl = 'rave_userinfo';	
				$upData = array();
				$upData["firstName"] = trim($this->input->post('name'));
				$upData["lastName"] = trim($this->input->post('surname'));
				$upData["phone"] = trim($this->input->post('cellno'));
				$upData["skypeID"] = trim($this->input->post('skypeID'));
				$upData["country"] = trim($this->input->post('country'));
				$upData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
				$upData["status"] = '1';
				$upData['userType'] = "PAYING USER";
				$upData['parentId'] = $this->gatewaymodel->getParentId();
				$upData['raveType'] = $generalUserType;
				$upData['confirmStatus'] = '1';
				$upData['confirmedOn'] = date("Y-m-d h:i:s");
				
                $raveUserId = trim($this->input->post('vipUserId'));				
				$where = array("uID"=>$raveUserId);
				$upDateUser = $this->common_model->updateDataToTable($tbl, $where, $upData);
				if($upDateUser){
					//Updating user name
					$raveuser_name	=	$this->common_model->updateRaveUserName($raveUserId);
					//Generate Signup Link
					if($raveuser_name==true){
						$this->gatewaymodel->createRouteRave();
					}
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveUserId;
					$typeData['raveType'] =$generalUserType;// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
                    $viewData['msgType'] = 1; //1=su;2=fa
					$viewData['msg'] = 'You have successfully completed the signup process.<br> Please check your mail for further instructions';
					
					
				}
				else{
						$viewData['msgType'] = 2; //1=su;2=fa
						$viewData['msg'] = 'Please try again.';
					}
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['country_list'] = $this->common_model->getCustomCountryList();
		//$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('gateway/general_user', $viewData);
	}

	public function userActivate(){
        
		$pendingActiveUserList	=	$this->gatewaymodel->getPendingActiveUser();
		if(!empty($pendingActiveUserList)){
			foreach($pendingActiveUserList as $key=>$val){
				$userId = $val['uID'];
				$instData = array();
			    $instData['emailID'] = $val['emailID'];
			    $instData['password'] = $val['password'] ;
                    $levelId =1;
					$cycle   = 1 ;
					$raveFreeEntry = $this->userLevelOneFreeEntry($userId,$levelId,$cycle);
					if($raveFreeEntry){
						
						$this->sendEmailToVipUser($instData, 'Welcome To Community Treasures User Group');
						
						$tbl = 'rave_userinfo';	
						$upData = array();
						$upData['confirmStatus'] = '2';
				        $upData['activatedOn'] = date("Y-m-d h:i:s");		
						$where = array("uID"=>$userId);
						$upDateUser = $this->common_model->updateDataToTable($tbl, $where, $upData);
						echo "<br>Successfully Activated the User with User ID: ".$userId ." Email ID:".$val['emailID'];
					}


			}
		}
		
	}
	public function testCronJob(){
        
		$pendingActiveUserList	=	$this->gatewaymodel->getPendingActiveUser();
		if(!empty($pendingActiveUserList)){
			foreach($pendingActiveUserList as $key=>$val){
				$userId = $val['uID'];
				
					if($userId){
						$tbl = 'rave_userinfo';	
						$upData = array();
						$upData['confirmStatus'] = '2';
				        $upData['activatedOn'] = date("Y-m-d h:i:s");		
						$where = array("uID"=>$userId);
						$upDateUser = $this->common_model->updateDataToTable($tbl, $where, $upData);
				echo "<br>Successfully Activated the User with User ID: ".$userId ." Email ID:".$val['emailID'];
					}


			}
		}
		exit;
	}



	public function signupFounder($referarName){
		$referarID = $this->getUserId($referarName);
		$this->_setSignupPageDetails(4);
		$this->sign_up_user_type = "FOUNDERS";
		$generalUserType = "Founder";
		$viewData = array();
		$viewData['city'] = 3;
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		
		 if ($referarID == 0) {
			$referarID = 1000;
			$viewData["parentID"] = $referarID;
		} else if ($referarID > 0) {
			$ustatus = $this->message_model->isMemberExist($referarID);
			if ($ustatus) {
				$viewData["parentID"] = $referarID;
			} else {
				$viewData["parentID"] = 1000;
			}
		} 

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			
			$instData = array();	
			//$instData["uID"] = $signupId;
			$instData["referarID"] = $viewData["parentID"];//$userFormDetail[0]['referarID'];	
			$instData['firstName'] = trim($this->input->post('name'));
			$instData['lastName'] = trim($this->input->post('surname'));
			$instData['phone'] = trim($this->input->post('cellno'));
			$instData['emailID'] = trim($this->input->post('emailAddr'));
			$instData['city'] = 3;//trim($this->input->post('city'));
			$instData['currency'] = $this->gatewaymodel->getCurrency(trim($instData['city']));// get currency by city Added by SB on 07/08/2015
			$instData['skypeID'] = trim($this->input->post('skypeID'));
			$instData['userType'] = $this->sign_up_user_type;
			$instData['password'] = $this->generatePassword();	// added by SB on 23/06/2016		
			$instData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
			$instData["userLevel"] = 1;// userlevel 1
			$instData['forWebsite'] = $this->forWebsite;
			$instData['parentId'] = $this->gatewaymodel->getParentId();
			$instData['raveType'] = $generalUserType;
			$instData['confirmStatus'] = '1';
			$instData['confirmedOn'] = date("Y-m-d h:i:s");
			
			if ($this->form_validation->run() != FALSE) {
				//$signupId = $this->gatewaymodel->insertData($viewData);
				$tbl = 'rave_userinfo';	
				$raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$instData);
				
				if($raveSignUpId){
					//Updating user name
					$raveuser_name	=	$this->common_model->updateRaveUserName($raveSignUpId);
					//Generate Signup Link
					if($raveuser_name==true){
						$this->gatewaymodel->createRouteRave();
					}
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveSignUpId;
					$typeData['raveType'] =$generalUserType;// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
					$viewData['msgType'] = 1; //1=su;2=fa
					$viewData['msg'] = 'You have successfully completed the signup process.<br> Please check your mail for further instructions';
				}
				else{
						$viewData['msgType'] = 2; //1=su;2=fa
						$viewData['msg'] = 'Please try again.';
					}
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		//$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		//$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('gateway/signup_founder', $viewData);
	}
	public function signupLeader($referarName){
		$referarID = $this->getUserId($referarName);
		$this->_setSignupPageDetails(4);
		$this->sign_up_user_type = "INDUSTRY LEADER";
		$generalUserType = "Active";
		$viewData = array();
		$viewData['city'] = 3;
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		
		 if ($referarID == 0) {
			$referarID = 1000;
			$viewData["parentID"] = $referarID;
		} else if ($referarID > 0) {
			$ustatus = $this->message_model->isMemberExist($referarID);
			if ($ustatus) {
				$viewData["parentID"] = $referarID;
			} else {
				$viewData["parentID"] = 1000;
			}
		} 

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			
			$instData = array();	
			//$instData["uID"] = $signupId;// added by SB on 23/06/2016
			$instData["referarID"] = $viewData["parentID"];//$userFormDetail[0]['referarID'];	
			$instData['firstName'] = trim($this->input->post('name'));
			$instData['lastName'] = trim($this->input->post('surname'));
			$instData['phone'] = trim($this->input->post('cellno'));
			$instData['emailID'] = trim($this->input->post('emailAddr'));
			$instData['city'] = 3;//trim($this->input->post('city'));
			$instData['currency'] = $this->gatewaymodel->getCurrency(trim($instData['city']));// get currency by city Added by SB on 07/08/2015
			$instData['skypeID'] = trim($this->input->post('skypeID'));
			$instData['userType'] = $this->sign_up_user_type;
			$instData['password'] = $this->generatePassword();	// added by SB on 23/06/2016		
			$instData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
			$instData["userLevel"] = 1;// userlevel 1
			$instData['forWebsite'] = $this->forWebsite;//2/10/2015 us 
			$instData['parentId'] = $this->gatewaymodel->getParentId();
			$instData['raveType'] = $generalUserType;
			$instData['confirmStatus'] = '1';
			$instData['confirmedOn'] = date("Y-m-d h:i:s");
			if ($this->form_validation->run() != FALSE) {
				//$signupId = $this->gatewaymodel->insertData($viewData);
				$tbl = 'rave_userinfo';	
				$raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$instData);
				
				if($raveSignUpId){
					//Updating user name
					$raveuser_name	=	$this->common_model->updateRaveUserName($raveSignUpId);
					//Generate Signup Link
					if($raveuser_name==true){
						$this->gatewaymodel->createRouteRave();
					}
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveSignUpId;
					$typeData['raveType'] =$generalUserType;// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
					$viewData['msgType'] = 1; //1=su;2=fa
					$viewData['msg'] = 'You have successfully completed the signup process.<br> Please check your mail for further instructions';
				}
				else{
						$viewData['msgType'] = 2; //1=su;2=fa
						$viewData['msg'] = 'Please try again.';
					}
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		//$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		//$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('gateway/signup_leader', $viewData);
	}
	public function signupGuest($referarName){
		//echo $referarName;exit;
		//echo "ghdshgd12332";exit;
		if(!is_numeric($referarName)){
        $referarID = $this->getUserId($referarName);
		}
		else{
			$referarID = $referarName; 
		}
	/*echo $referarID;
		exit;*/
		$this->_setSignupPageDetails(4);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "Active";
		$viewData = array();
		$viewData['city'] = 3;
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		
		 if ($referarID == 0) {
			$referarID = 1000;
			$viewData["parentID"] = $referarID;
		} else if ($referarID > 0) {
			$ustatus = $this->message_model->isMemberExist($referarID);
			if ($ustatus) {
				$viewData["parentID"] = $referarID;
			} else {
				$viewData["parentID"] = 1000;
			}
		} 

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			
			$instData = array();	
			//$instData["uID"] = $signupId;// added by SB on 23/06/2016
			$instData["referarID"] = $viewData["parentID"];//$userFormDetail[0]['referarID'];	
			$instData['firstName'] = trim($this->input->post('name'));
			$instData['lastName'] = trim($this->input->post('surname'));
			$instData['phone'] = trim($this->input->post('cellno'));
			$instData['emailID'] = trim($this->input->post('emailAddr'));
			$instData['city'] = 3;//trim($this->input->post('city'));
			$instData['currency'] = $this->gatewaymodel->getCurrency(trim($instData['city']));// get currency by city Added by SB on 07/08/2015
			$instData['skypeID'] = trim($this->input->post('skypeID'));
			$instData['userType'] = $this->sign_up_user_type;
			$instData['password'] = $this->generatePassword();	// added by SB on 23/06/2016		
			$instData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
			$instData["userLevel"] = 1;// userlevel 1
			$instData['forWebsite'] = $this->forWebsite;//2/10/2015 us 
			$instData['parentId'] = $this->gatewaymodel->getParentId();
			$instData['raveType'] = $generalUserType;
			$instData['confirmStatus'] = '1';
			$instData['confirmedOn'] = date("Y-m-d h:i:s");
			if ($this->form_validation->run() != FALSE) {
				//$signupId = $this->gatewaymodel->insertData($viewData);
				$tbl = 'rave_userinfo';	
				$raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$instData);
				
				if($raveSignUpId){
					//Updating user name
					$raveuser_name	=	$this->common_model->updateRaveUserName($raveSignUpId);
					//Generate Signup Link
					if($raveuser_name==true){
						$this->gatewaymodel->createRouteRave();
					}
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveSignUpId;
					$typeData['raveType'] =$generalUserType;// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
					$viewData['msgType'] = 1; //1=su;2=fa
					$viewData['msg'] = 'You have successfully completed the signup process.<br> Please check your mail for further instructions';
				}
				else{
						$viewData['msgType'] = 2; //1=su;2=fa
						$viewData['msg'] = 'Please try again.';
					}
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		//$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$viewData['country_list'] = $this->common_model->getCustomCountryList();
		$this->load->view('gateway/signup_user', $viewData);
	}
	public function getUserId($userName){
		$userIdOnly = 0;
		$uNameArr = explode('.',$userName);
		if(count($uNameArr)==4)
		{
			$userIdOnly = $uNameArr[3];
		}
		else if(count($uNameArr)==3)
		{
			$userIdOnly = $uNameArr[2];
		}
		else if(count($uNameArr)==2){
			$userIdOnly = $uNameArr[1];
		}
		return $userIdOnly;
	}
	public function checkUniqueEmail() {
		$emailAddr = trim($this->input->post('emailAddr'));
		$cond_array = array('emailID' => $emailAddr);
		$tbl = 'rave_userinfo';
		$status = $this->gatewaymodel->checkUniqueValue($tbl, $cond_array);
		if ($status >= 1) {
			$this->form_validation->set_message('checkUniqueEmail', 'This Email Address "' . $emailAddr . '" is already used.');
			return false;
		} else {
			return true;
		}
	}
	public function checkUniqueEmailWithId() {
		$emailAddr = trim($this->input->post('emailAddr'));
		$vipUserId = trim($this->input->post('vipUserId'));
		$cond_array = array('emailID' => $emailAddr , 'afrooPaymentStatus' => 1);
		$tbl = 'rave_userinfo';
		$status = $this->gatewaymodel->checkUniqueValue($tbl, $cond_array);
		if ($status >= 1) {
			$this->form_validation->set_message('checkUniqueEmailWithId', 'This Email Address "' . $emailAddr . '" is already used.');
			return false;
		} else {
			return true;
		}
	}
	private function sendEmailToUser($data = array(), $sub = "COMMUNITY") {
		$tbl = "city";
		$where["id"] = $data['city'];
		$selectedData = "";
		$city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData); 
	
		$this->_to_email = $data['emailAddr'];
		$this->_subject = $sub;
		/*if($data['signup_userType']=='health'){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=='realestate'){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="fitness"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="talented"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="business"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="hair_and_beauty"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="food"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="communities"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="afrowebb"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="mentorship"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="beauty"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="meetups"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="models"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="music"){
			$this->_message = 'Testing Mail';
		}elseif($data['signup_userType']=="nutri"){
			$this->_message = 'Testing Mail';
		}else{*/
			$this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr><td colspan="2">Hello ' . $data['name'] . ',</td></tr>
								<tr><td colspan="2">Thank you for sign up. 
									Here are all of your details with login credentials as below.
									</td></tr>
								<tr><td width="25%">Name:</td><td width="75%">' . $data['name'] . '</td></tr>
								<tr><td width="25%">Surname:</td><td width="75%">' . $data['surname'] . '</td></tr>
								
								<tr><td width="25%">Tel,Mob,Cell:</td><td width="75%">' . $data['cellno'] . '</td></tr>
								<tr><td width="25%">Email Address:</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
																
								<tr><td width="25%">Skype Username:</td><td width="75%">' . $data['skypeID'] . '</td></tr>
																	<tr><td width="25%">City:</td><td width="75%">' . $city[0]->city . '</td></tr>
								
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">communitytreasures.co</td></tr>
						   </table>';
		//}
		
		
		if ($this->_to_email != '' && $this->_subject != '') {
			$this->send_mail_raw();
			return true;
		} else {
			return false;
		}
	}

	private function sendEmailToAdmin($data = array(), $sub = "New Signup of COMMUNITY") {
		$tbl = "city";
		$where["id"] = $data['city'];
		$selectedData = "";
		$city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData);
		
		$this->_to_email = $this->_admin_email;
		$this->_subject = $sub;
		$this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr><td colspan="2">Hello Admin,</td></tr>
								<tr><td colspan="2">Here is a new Sign up of CT user .Here are all details of new user as below.</td></tr>
								<tr><td width="25%">Name:</td><td width="75%">' . $data['name'] . '</td></tr>
								<tr><td width="25%">Surname:</td><td width="75%">' . $data['surname'] . '</td></tr>
								
								<tr><td width="25%">Tel,Mob,Cell:</td><td width="75%">' . $data['cellno'] . '</td></tr>
								<tr><td width="25%">Email Address:</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
								<tr><td width="25%">Skype Username:</td><td width="75%">' . $data['skypeID'] . '</td></tr>
																	<tr><td width="25%">City:</td><td width="75%">' . $city[0]->city . '</td></tr>
								
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

	function send_mail_raw() {
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		//$headers .= "Bcc:senabi.test01@gmail.com"."\n";
		$headers .= "Bcc:registration@communitytreasures.co,testingjust100@gmail.com"."\n"; //backup mail to Community Treasure id & Senabi Test Email Id on 22/08/2016
		//$headers .= 'Cc:senabi.gbe@gmail.com' . "\r\n";
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
		$code = "ZXCV" . $code;
		return $code;
	}

	public function resetValueAfterSuccess() {
		$viewData['name'] = "";
		$viewData['surname'] = "";
		$viewData['cellno'] = "";
		$viewData['emailAddr'] = "";
		$viewData['city'] = "";
		$viewData['skypeID'] = "";
		$viewData['userType'] = "";
		$viewData['password'] = "";
		return $viewData;
	}
	
	public function cr(){
		$this->gatewaymodel->createRoute();
		echo "success";
	}
	
	public function html(){
		$this->load->view('signup/html');
	}
	
	public function sendEmailToVipUserFounder($data = array(), $sub = "COMMUNITY") {
		
	
		$this->_to_email = $data['emailID'];
		$this->_subject = $sub;
		$this->_message = '<div style="width:88%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;  padding: 15px; border: 15px solid #cfcfcf;">
<div style="padding-bottom: 10px; text-align:center;"><img src="'.base_url().'images/logo.png" width="150" height="150" alt="" /></div>
			 <p align="center" style="  color: #1b75bc; font-size: 25px; line-height: 26px;">Welcome To </p>
			  <p align="center" style="  color: #1b75bc; font-size: 25px; line-height: 26px;"><strong>Community Treasures</strong><br />
				<strong>Founders Group</strong> </p>
				<p></p>
			  <p>Here are all of your details with login credentials as below.</p>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="25%">Email:</td><td width="75%">' . $data['emailID'] . '</td></tr>
			<tr><td width="25%">Password:</td><td width="75%">' . $data['password'] . '</td></tr>
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr><td colspan="2"><a href="'.base_url().'" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click here to Login.</a></td></tr>		
                                    <tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>	
			</table>								
			</div>';
		
		if ($this->_to_email != '' && $this->_subject != '') {
			$this->send_mail_raw();
			return true;
		} else {
			return false;
		}
	}
	
	public function sendEmailToVolunteer($data = array(), $sub = "COMMUNITY") {
		$tbl = "city";
		$where["id"] = $data['city'];
		$selectedData = "";
		$city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData); 
	
		$this->_to_email = $data['emailAddr'];
		$this->_subject = "Join COMMUNITY Volunteers Today";
		$this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif;">
  <p align="center">Thank You For Applying To Become A COMMUNITY Volunteer.</p>
  <p align="center" style="font-size:14px;">By donating just 4 hours per week You will help develop Black communities<br />
	making them healthier, Safer and wealthier.</p>
  <p align="center"><strong>We Invite You To Meet Us</strong> <br />
	for a presentation</p>
  <p align="center"><strong>This Tuesday at 6.30pm</strong><br />
	<strong>MLB, Suite 31</strong><br />
	<strong>The Enterprise Centre</strong><br />
	<strong>639 High Road, Tottenham N17 8AA</strong></p>
  <p align="center">To confirm please call us now on:<br />
	07481 244501</p>
  <p align="center">Lets "Move As One" to make a brighter future for our families and ourselves.</p>
  <p align="center"><strong>Please arrive on time.</strong> <br />
	This presentation will take 2 hours - so donot book anything else  around that time.</p>
  <p align="center">See You Soon.</p>
</div>';
		
		if ($this->_to_email != '' && $this->_subject != '') {
			$this->send_mail_raw();
			return true;
		} else {
			return false;
		}
	}
	
	
	
	
	public function insertGeneralUserType($signupId,$generalUserType){
		$tbl = "user_general_type";
		$data['user_id'] = $signupId;
		$data['user_general_type_name'] = $generalUserType;
		// print_r($data);exit;
		$this->common_model->insertDataToTable($tbl, $data);
		return true;
	}
	
	
	private function _setSignupPageDetails($pageId = 0){
		$where = array("id" => trim($pageId));
		$tbl = "gbe_signup_page_details";
		$selectedData = "";
		$list = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		$this->videoPath = $list[0]->video_path;
	}
	
	private function createUrl(){
		
		$segments = $this->uri->uri_string();
		$ogUrl='';		
		//print_r($segments);
		$ogUrl= base_url().$segments;		
		return $ogUrl;
	}
	
	//function to fetch top member from level 1 & add to rave share , cap table entry, eligible user position move up
	public function userLevelOneFreeEntry($userId,$level,$cycle){
		
		//fetch top member from rave share
		//$level =1;// level wise check top mem
		$topMember = $this->gatewaymodel->getTopMember($level,$cycle);
		// insert my data to rave_share table
		$myPosition = 0; 						
		if(count($topMember)>0){							
			$myParent   = $topMember[0]['user_id'];
		 }
		 else
		 {							
			$myParent   = 0; // admin
		 }
		 // insert data to rave share table with level 1 amt& counter 0 & cycle 1
		 $insData = array();
		 $insData['user_id']      = $userId;
		 $insData['parentId']     = $myParent;
		 $insData['level']        = $level;
		 $insData['userPosition'] = $myPosition;
		 $insData['userCycle'] 	  = $cycle;		 
		 $insData['creationDate'] = date('Y-m-d');
		 $insData['status'] 	  = 1;
		 $insData['amount'] 	  = 0;
		 $insData['counter'] 	  = 0;
		
		 $catLogPrice		= 40; //30;
		 $compShare			= 24; // added by SB on 16-08-2016
		 $contingentCom 		= 2.88; // added by Sb on 16-08-2016
		 $tblshare = 'rave_share';
		 if($cycle==2){
		 	/*echo "<br>Cycle 2 Data:<pre>";
		 	print_r($insData);
		 	echo "</pre>";
		 	exit;*/
		 }
		 $insertId = $this->common_model->insertDataToTable($tblshare,$insData);
		 if($insertId){
														 
			 // add admin share detail to log transaction
			 $instLog 				= array();
			 $instLog['note'] 		= "Catalog Purchase commission to Admin from userId-".$userId;
			 $instLog['userCycle']  = $cycle;
			 $instLog['action'] 	= "+";
			 $instLog['amount'] 	= $catLogPrice;
			 $instLog['tranDate'] 	=  date('Y-m-d');
			 $tblLog 				= 'raveTransactionLog';
			 $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
			 
						 // add amount to company Account  added by SB on 16-08-2016
			 $instcompAcct = array();
			 $instcompAcct['userId'] 		= $userId;
			 $instcompAcct['userLevel'] 	= $level;
			 $instcompAcct['userCycle'] 	= $cycle;
			 $instcompAcct['compShare'] 	= $compShare;
			 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
			 $instcompAcct['commDate'] 		= date('Y-m-d');
			 $tblCompAcct 					= 'rave_companyAccount';
			 $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
			 
			 // add Contingent amount to company Account  added by SB on 16-08-2016
			 $instContigent = array();
			 $instContigent['userId'] 		= $userId;
			 $instContigent['userLevel'] 	= $level;
			 $instContigent['userCycle'] 	= $cycle;
			 $instContigent['compShare'] 	= $contingentCom;
			 $instContigent['shareFor'] 	= 'C';// J joining commission , C Contingent
			 $instContigent['commDate'] 	= date('Y-m-d');
			 $tblContigent					= 'rave_companyAccount';
			 $insertContigent				= $this->common_model->insertDataToTable($tblContigent,$instContigent);
			 
							 
			 // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
			 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId,$cycle);
			/* echo "<pre>";
			 print_r($paidUser);
			 echo "<pre>";*/

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
			 
			  //fetch all user eligible for commission no commission only position 
			  $commMemberList = $this->gatewaymodel->getCommMember($level,$cycle);
				/*echo "<br/><b>commMemberList: Level ==> ".$level."=>cycle==>".$cycle."</b>";
				echo "<pre>";
				print_r($commMemberList);
				echo "</pre>";*/
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
							
								$activeCom=7.50;//4
								$founderCom=3.75; //1.88
								if($commMemberDetail['raveType']=="Active"){
																																
									$commToUserAboveMe 	= $activeCom;// Active User commission Amount for other Cycle
									
								}else{
									
									$commToUserAboveMe 	= $activeCom+$founderCom;// Founder commission Amount for other Cycle
									
								}
							 //referral commission to referrar as per level user  
								if($userlevel==1){
									$commToInviter		= 1.88;//1; // commission to inviter of level 1
								}
								
						 // add commision to top member
							$counterVal =1;
							$comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal,$cycle,$userlevel);
							/*echo "<br/>addCommissionToTopmembernRef: ";
							echo "<pre>";
							print_r($comAddedToTopMem);
							echo "</pre>";*/
						 // echo "==".$comAddedToTopMem;
							 if($comAddedToTopMem){
								 // add Top Member share detail to log transaction
								 $instLogAboveMe 				= array();
								 $instLogAboveMe['note'] 		= "Catalog Purchase commission from Admin to ParentUser-".$commMember;
								 $instLogAboveMe['userCycle']   = $cycle;
								 $instLogAboveMe['action'] 		= "-";
								 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
								 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
								 
								 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
								 
								  // add reference comission to my top member also
								  // fetch my parent Referer													
									$refererUserDetail = $this->gatewaymodel->getMyReferer($commMember);
									//if inviter other than admin (referarID!=1000) add commission to inviter
									/*echo "<br/>getMyReferer: ";
				echo "<pre>";
				print_r($refererUserDetail);
				echo "</pre>";*/
									if(count($refererUserDetail)>0){
										$counterRefVal 		= 0;
										$refererUserId 		= $refererUserDetail[0]['referarID'];
										$refererUserLevel 	= $refererUserDetail[0]['userLevel'];
										$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal,$cycle,$userlevel);
										//if inviter other than admin (referarID=1000) add commission to inviter
										 if($refComDone){
											 $instLogRef 					= array();
											 $instLogRef['note'] 			= "Catalog Purchase commission from Admin to RefererUser-".$refererUserId;
											 $instLogAboveMe['userCycle']   = $cycle;
											 $instLogRef['action'] 			= "-";
											 $instLogRef['amount'] 			= $commToInviter;
											 $instLogRef['tranDate'] 		= $today;
											 $insertLogRef =$this->gatewaymodel->tranRecordInter($instLogRef);
											// referral detail insert in referral table
											 $refDetail 					= array();
											 $refDetail['myReferrer']   	= $refererUserId;
											 $refDetail['referrerLevel']	= $refererUserLevel;
											 $refDetail['refCycle']			= $cycle;
											 $refDetail['userId']   		= $commMember;
											 $refDetail['invtAmt']  		= $commToInviter;
											 $refDetail['refCommDate']  	= date('Y-m-d');
											 $refDetail['refCommCount'] 	= 1;
											 $tblRefDetail 					= 'rave_referralDetail';
											 //  fetch referal detail exist or not
											 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel,$cycle);
										     echo "<br/>Check referance data exist or not";
											 // insert Level wise referral commission
											 if($refDataExist==0){
												$insertrefDetail 			= $this->common_model->insertDataToTable($tblRefDetail,$refDetail);
												 echo "<br/>insertrefDetail";
											 }
											 else{
												  // Update Level wise referral commission
												  echo "<br/>updateRefDetail";
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
				$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($cycle, $level,$noPositionChangeUser);
				//$noPositionChangeUser
				
				$this->auto_levelup2($cycle);
				
				return true;
			}
			else {
				return false;
			}			

		 
	}
	public function sendEmailToVipUserIndustryLeader($data = array(), $sub = "COMMUNITY") {
		
	
		$this->_to_email = $data['emailID'];
		$this->_subject = $sub;
		$this->_message = '<div style="width:88%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;  padding: 15px; border: 15px solid #cfcfcf;">
<div style="padding-bottom: 10px; text-align:center;"><img src="'.base_url().'images/logo.png" width="150" height="150" alt="" /></div>
			  <p align="center" style="  color: #1b75bc; font-size: 25px; line-height: 26px;">Welcome To </p>
			  <p align="center" style="  color: #1b75bc; font-size: 25px; line-height: 26px;"><strong>Community Treasures</strong><br />
				<strong>Industry Leader Group</strong> </p>
				<p></p>
			  <p>Here are all of your details with login credentials as below.</p>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="25%">Email:</td><td width="75%">' . $data['emailID'] . '</td></tr>
			<tr><td width="25%">Password:</td><td width="75%">' . $data['password'] . '</td></tr>
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr><td colspan="2"><a href="'.base_url().'" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click here to Login.</a></td></tr>		
                                    <tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>	
			</table>								
			</div>';
		
		if ($this->_to_email != '' && $this->_subject != '') {
			$this->send_mail_raw();
			return true;
		} else {
			return false;
		}
	}
	public function sendEmailToVipUser($data = array(), $sub = "COMMUNITY") {
		
	
		$this->_to_email = $data['emailID'];
		$this->_subject = $sub;
		$this->_message = '<div style="width:88%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;  padding: 15px; border: 15px solid #cfcfcf;">
<div style="padding-bottom: 10px; text-align:center;"><img src="'.base_url().'images/logo.png" width="150" height="150" alt="" /></div>
			  <p align="center" style="  color: #1b75bc; font-size: 25px; line-height: 26px;">Welcome To </p>
			  <p align="center" style="  color: #1b75bc; font-size: 25px; line-height: 26px;"><strong>Community Treasures</strong><br />
				<strong>User Group</strong> </p>
				<p></p>
			  <p>Here are all of your details with login credentials as below.</p>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="25%">Email:</td><td width="75%">' . $data['emailID'] . '</td></tr>
			<tr><td width="25%">Password:</td><td width="75%">' . $data['password'] . '</td></tr>
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr><td colspan="2"><a href="'.base_url().'" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click here to Login.</a></td></tr>		
                                    <tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>	
			</table>								
			</div>';
		//echo "===".$this->_message; exit;
		if ($this->_to_email != '' && $this->_subject != '') {
			$this->send_mail_raw();
			return true;
		} else {
			return false;
		}
	}
	public function route_test(){
			$this->gatewaymodel->createRouteRave();
	}
	
	public function auto_levelup2($cycle){
		$eleMoveUpUser = array();
		$currLevel = 1;
		$currPosition=65;//24;// 
		$eleMoveUpUser = $this->gatewaymodel->getMoveUpUser($currPosition,$currLevel,$cycle);
		echo "<br/><h3>auto_levelup2:</h3> getMoveUpUser:<pre>";
		print_r($eleMoveUpUser);
		echo "</pre>";
		if(count($eleMoveUpUser)>0){
			 $noPositionChangeUser = array();
			// $cycle 	  = $eleMoveUpUser[0]['userCycle'];
			$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($cycle, $currLevel+1,$noPositionChangeUser);
			$userCount=0;			
			foreach($eleMoveUpUser as $eleMoveUpUserDetail){
				$userCount++;
				$userId='';
				$raveType ='';
				$userId   = $eleMoveUpUserDetail['user_id'];// $this->session->userdata('userId');
				$raveType = $eleMoveUpUserDetail['raveType'];//$this->session->userdata('raveType');
				//$cycle 	  = $eleMoveUpUserDetail['userCycle'];
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
							$upLevelStatusCh = $this->gatewaymodel->userLevelStatusCh($userId,$currLevel,$cycle);
							if ($upLevelStatusCh){
								//insert new row to rave share with level 2 position 65 
								$level =$currLevel+1;// level wise check top mem
								$topMember = $this->gatewaymodel->getTopMember($level,$cycle);
								// echo count($topMember);
								// insert my data to rave_share table
								$myPosition = 65; 						
								if(count($topMember)>0){							
									$myParent   = $topMember[0]['user_id'];
								 }
								 else
								 {							
									$myParent   = 0; // admin
								 }
								 $prevBalance = $this->gatewaymodel->getBalance($userId,$currLevel,$cycle);// balance from previous level
								 $myBalance = round($prevBalance-$levelUpPrice,2);
								 // insert data to rave share
								 $insData = array();
								 $insData['user_id']      = $userId;
								 $insData['parentId']     = $myParent;
								 $insData['level']        = $level;
								 $insData['userPosition'] = $myPosition;
								 $insData['userCycle'] 	  = $cycle;									 
								 $insData['creationDate'] = date('Y-m-d');
								 $insData['status'] 	  = 1;
								 $insData['amount'] 	  = $myBalance;
								 $insData['counter'] 	  = 0;
								
								 $tblshare = 'rave_share';
								 /*echo "<br/><h1>Insert Data In Level 2</h1>:<pre>";
								 print_r($insData);
								 echo "</pre>";*/
								 $insertId = $this->common_model->insertDataToTable($tblshare,$insData);
								 if($insertId){
																 
									 // add admin share detail to log transaction
									 $instLog 				= array();
									 $instLog['note'] 		= "Level Up Payment to Admin from userId-".$userId;
									 $instLog['userCycle']	= $cycle;
									 $instLog['action'] 	= "+";
									 $instLog['amount'] 	= $levelUpPrice;
									 $instLog['tranDate'] 	=  date('Y-m-d');
									 $tblLog 				= 'raveTransactionLog';
									 $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
									 
									 // add amount to company Account  added by SB on 12-08-2016
									 $instcompAcct = array();
									 $instcompAcct['userId'] 		= $userId;
									 $instcompAcct['userLevel'] 	= $level;
									 $instcompAcct['userCycle']		= $cycle;
									 $instcompAcct['compShare'] 	= $compShare;
									 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
									 $instcompAcct['commDate'] 		= date('Y-m-d');
									 $tblCompAcct 					= 'rave_companyAccount';
									 $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
									 
								 }
								  // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
								 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId,$cycle);
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
								  $commMemberList = $this->gatewaymodel->getCommMember($level,$cycle);
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
														$activeCom		= 7.50;
														$founderCom		= 3.75;
														$commToInviter	= 1.88; // commission to inviter of level 1
													}
													else if($userlevel==2){
														$activeCom		= 9.38; //4.7;
														$founderCom		= 6.25;//3.13;
														$commToInviter	= 1.88;//0.94; // commission to inviter of level 2
														// commission to opportunity ,seed & Karma
														$opportunity 	= 4.13; //4.18;//2.34;
														$seed       	= 3.13;//1.56;
														$karma       	= 6.25;//1.59;
														$level3Entrance = 18.75;//9.38;
													}
													if($commMemberDetail['raveType']=="Active"){
																																					
														$commToUserAboveMe 	= $activeCom;// Active User commission Amount for other Cycle
														
													}else{
														
														$commToUserAboveMe 	= $activeCom+$founderCom;// Founder commission Amount for other Cycle
														
													}
																								 
											 // add commision to top member
											 $counterVal =1;
											 $comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal,$cycle,$userlevel);
											 // echo "==".$comAddedToTopMem;
												 if($comAddedToTopMem){
													 // add Top Member share detail to log transaction
													 $instLogAboveMe 				= array();
													 $instLogAboveMe['note'] 		= "moveup commission from Admin to ParentUser-".$commMember;
													 $instLogAboveMe['userCycle'] 	= $cycle;
													 $instLogAboveMe['action'] 		= "-";
													 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
													 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
													 
													 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
													 // add opportunity 
													 $oppAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$opportunity,0,$cycle,$userlevel);
													 if($oppAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogOpp 				= array();
														 $instLogOpp['note'] 		= "opportunity from Admin to ParentUser-".$commMember;
														 $instLogOpp['userCycle'] 	= $cycle;
														 $instLogOpp['action'] 		= "-";
														 $instLogOpp['amount'] 		= $opportunity;
														 $instLogOpp['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogOpp);
													 
													 }
													 // add seed
													 $seedAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$seed,0,$cycle,$userlevel);
													 if($seedAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogSeed 				= array();
														 $instLogSeed['note'] 		= "seed from Admin to ParentUser-".$commMember;
														 $instLogSeed['userCycle'] 	= $cycle;
														 $instLogSeed['action'] 	= "-";
														 $instLogSeed['amount'] 	= $seed;
														 $instLogSeed['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogSeed = $this->gatewaymodel->tranRecordInter($instLogSeed);
													 
													 }
													  // add karma 
													 $karmaAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$karma,0,$cycle,$userlevel);
													 if($karmaAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogKarma 				= array();
														 $instLogKarma['note'] 		= "karma from Admin to ParentUser-".$commMember;
														 $instLogKarma['userCycle'] 	= $cycle;
														 $instLogKarma['action'] 		= "-";
														 $instLogKarma['amount'] 		= $karma;
														 $instLogKarma['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogKarma);
													 
													 }
													 // add enterance Level 3
													 
													 $enterL3AddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$level3Entrance,0,$cycle,$userlevel);
													 if($enterL3AddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogentL3 				= array();
														 $instLogentL3['note'] 		= "Enterance Level3 from Admin to ParentUser-".$commMember;
														 $instLogentL3['userCycle'] 	= $cycle;
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
															$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal,$cycle,$userlevel);
															//if inviter other than admin (referarID=1000) add commission to inviter
															 if($refComDone){
																 $instLogRef 				= array();
																 $instLogRef['note'] 		= "moveUp commission from Admin to RefererUser-".$refererUserId;
																 $instLogRef['userCycle'] 	= $cycle;
																 $instLogRef['action'] 		= "-";
																 $instLogRef['amount'] 		= $commToInviter;
																 $instLogRef['tranDate'] 	= $today;
																 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogRef);
																 
																 // referral detail insert in referral table
																 $refDetail 				= array();
																 $refDetail['myReferrer']   = $refererUserId;
																 $refDetail['referrerLevel']= $refererUserLevel;
																 $refDetail['refCycle']		= $cycle;
																 $refDetail['userId']   	= $commMember;
																 $refDetail['invtAmt']  	= $commToInviter;
																 $refDetail['refCommDate']  = date('Y-m-d');
																 $refDetail['refCommCount'] = 1;
																 $tblRefDetail 				= 'rave_referralDetail';
																 //  fetch referal detail exist or not
																 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel,$cycle);
																
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
								//$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($cycle, $level,$noPositionChangeUser);
															
							}
						}
					}
					
					//$val = array("success" => "yes","message"=> 'LevelUp Payment Sucessfully for '.$userCount.' user. Now go to level 2');
				}
				/* else
				{
					
				} */
				
				
			}
			
			// auto level up level 2 user to level 3  
			$this->auto_levelup3($cycle);
			return true;
		}
		else{
			return true;
		}
		
	}
	
	public function auto_levelup3($cycle){
		$eleMoveUpUser = array();
		$currLevel = 2;
		$currPosition=321;//24;// 160
		$eleMoveUpUser = $this->gatewaymodel->getMoveUpUser($currPosition,$currLevel,$cycle);
		//print_r($eleMoveUpUser);
		if(count($eleMoveUpUser)>0){
			$userCount=0;
			 $noPositionChangeUser = array();
			/// $cycle 	  = $eleMoveUpUser[0]['userCycle'];
			$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($cycle, $currLevel+1,$noPositionChangeUser);		
			foreach($eleMoveUpUser as $eleMoveUpUserDetail){
				$userCount++;
				$userId='';
				$raveType ='';
				$userId   = $eleMoveUpUserDetail['user_id'];// $this->session->userdata('userId');
				$raveType = $eleMoveUpUserDetail['raveType'];//$this->session->userdata('raveType');
				//$cycleTemp 	  = $eleMoveUpUserDetail['userCycle'];
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
							$upLevelStatusCh = $this->gatewaymodel->userLevelStatusCh($userId,$currLevel,$cycle);
							if ($upLevelStatusCh){
								//insert new row to rave share with level 3 position 321 
								$level =$currLevel+1;// level wise check top mem
								$topMember = $this->gatewaymodel->getTopMember($level,$cycle);
								// echo count($topMember);
								// insert my data to rave_share table
								$myPosition = 321; 						
								if(count($topMember)>0){							
									$myParent   = $topMember[0]['user_id'];
								 }
								 else
								 {							
									$myParent   = 0; // admin
								 }
								 $prevBalance = $this->gatewaymodel->getBalance($userId,$currLevel,$cycle);// balance from previous level
								 $myBalance = round($prevBalance-$levelUpPrice,2);
								 // insert data to rave share
								 $insData = array();
								 $insData['user_id']      = $userId;
								 $insData['parentId']     = $myParent;
								 $insData['level']        = $level;
								 $insData['userPosition'] = $myPosition;
								 $insData['userCycle'] 	  = $cycle;									 
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
									 $instLog['userCycle']	= $cycle;
									 $instLog['action'] 	= "+";
									 $instLog['amount'] 	= $levelUpPrice;
									 $instLog['tranDate'] 	=  date('Y-m-d');
									 $tblLog 				= 'raveTransactionLog';
									 $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
									 
									 // add amount to company Account  added by SB on 12-08-2016
									 $instcompAcct = array();
									 $instcompAcct['userId'] 		= $userId;
									 $instcompAcct['userLevel'] 	= $level;
									 $instcompAcct['userCycle']		= $cycle;
									 $instcompAcct['compShare'] 	= $compShare;
									 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
									 $instcompAcct['commDate'] 		= date('Y-m-d');
									 $tblCompAcct 					= 'rave_companyAccount';
									 $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
									 
									 // add Contingent amount to company Account  added by SB on 12-08-2016
									 $instContigent = array();
									 $instContigent['userId'] 		= $userId;
									 $instContigent['userLevel'] 	= $level;
									 $instContigent['userCycle']	= $cycle;
									 $instContigent['compShare'] 	= $contingentCom;
									 $instContigent['shareFor'] 	= 'C';// J joining commission , C Contingent
									 $instContigent['commDate'] 	= date('Y-m-d');
									 $tblContigent					= 'rave_companyAccount';
									 $insertContigent				= $this->common_model->insertDataToTable($tblContigent,$instContigent);
									 
								 }
								  // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
								 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId,$cycle);
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
								  $commMemberList = $this->gatewaymodel->getCommMember($level,$cycle);
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
														$activeCom		= 7.50;
														$founderCom		= 3.75;
														$commToInviter	= 1.88; // commission to inviter of level 1
													}
													else if($userlevel==2){
														$activeCom		= 9.38; //4.7;
														$founderCom		= 6.25;//3.13;
														$commToInviter	= 1.88;//0.94; // commission to inviter of level 2
														// commission to opportunity ,seed & Karma
														$opportunity 	= 4.13; //4.18;//2.34;
														$seed       	= 3.13;//1.56;
														$karma       	= 6.25;//1.59;
														$level3Entrance = 18.75;//9.38;
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
											 $comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal,$cycle,$userlevel);
											 // echo "==".$comAddedToTopMem;
												 if($comAddedToTopMem){
													 // add Top Member share detail to log transaction
													 $instLogAboveMe 				= array();
													 $instLogAboveMe['note'] 		= "moveup commission from Admin to ParentUser-".$commMember;
													 $instLogAboveMe['userCycle'] 	= $cycle;
													 $instLogAboveMe['action'] 		= "-";
													 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
													 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
													 
													 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
													 // add opportunity 
													 $oppAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$opportunity,0,$cycle,$userlevel);
													 if($oppAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogOpp 				= array();
														 $instLogOpp['note'] 		= "opportunity from Admin to ParentUser-".$commMember;
														 $instLogOpp['userCycle'] 	= $cycle;
														 $instLogOpp['action'] 		= "-";
														 $instLogOpp['amount'] 		= $opportunity;
														 $instLogOpp['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogOpp);
													 
													 }
													 // add seed
													 $seedAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$seed,0,$cycle,$userlevel);
													 if($seedAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogSeed 				= array();
														 $instLogSeed['note'] 		= "seed from Admin to ParentUser-".$commMember;
														 $instLogSeed['userCycle'] 	= $cycle;
														 $instLogSeed['action'] 	= "-";
														 $instLogSeed['amount'] 	= $seed;
														 $instLogSeed['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogSeed =$this->gatewaymodel->tranRecordInter($instLogSeed);
													 
													 }
													  // add karma 
													 $karmaAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$karma,0,$cycle,$userlevel);
													 if($karmaAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogKarma 				= array();
														 $instLogKarma['note'] 		= "karma from Admin to ParentUser-".$commMember;
														 $instLogKarma['userCycle'] 	= $cycle;
														 $instLogKarma['action'] 		= "-";
														 $instLogKarma['amount'] 		= $karma;
														 $instLogKarma['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogKarma);
													 
													 }
													 // add enterance Level 4
													 
													 $enterL3AddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$level3Entrance,0,$cycle,$userlevel);
													 if($enterL3AddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogentL3 				= array();
														 $instLogentL3['note'] 		= "Enterance Level4 from Admin to ParentUser-".$commMember;
														 $instLogentL3['userCycle'] 	= $cycle;
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
															$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal,$cycle,$userlevel);
															//if inviter other than admin (referarID=1000) add commission to inviter
															 if($refComDone){
																 $instLogRef 				= array();
																 $instLogRef['note'] 		= "moveUp commission from Admin to RefererUser-".$refererUserId;
																 $instLogRef['userCycle'] 	= $cycle;
																 $instLogRef['action'] 		= "-";
																 $instLogRef['amount'] 		= $commToInviter;
																 $instLogRef['tranDate'] 	= $today;
																 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogRef);
																 
																 // referral detail insert in referral table
																 $refDetail 				= array();
																 $refDetail['myReferrer']   = $refererUserId;
																 $refDetail['referrerLevel']= $refererUserLevel;
																 $refDetail['refCycle']		= $cycle;
																 $refDetail['userId']   	= $commMember;
																 $refDetail['invtAmt']  	= $commToInviter;
																 $refDetail['refCommDate']  = date('Y-m-d');
																 $refDetail['refCommCount'] = 1;
																 $tblRefDetail 				= 'rave_referralDetail';
																 //  fetch referal detail exist or not
																 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel,$cycle);
																
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
							//	$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($cycle, $level,$noPositionChangeUser);
															
							}
						}
					}
				}
				/* else
				{
					
				} */				
				
			}
				
			// auto level up level 3 user to level 4  
			$this->auto_levelup4($cycle);
			return true;
		}else{
			return true;
		}
		
	}
	
	public function auto_levelup4($cycle){
		$eleMoveUpUser = array();
		$currLevel = 3;
		$currPosition=577;//24;// 160
		$eleMoveUpUser = $this->gatewaymodel->getMoveUpUser($currPosition,$currLevel,$cycle);
		//print_r($eleMoveUpUser);
		if(count($eleMoveUpUser)>0){
			$userCount=0;
			 $noPositionChangeUser = array();
			 //$cycle 	  = $eleMoveUpUser[0]['userCycle'];
			 $upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($cycle, $currLevel+1,$noPositionChangeUser);	
				foreach($eleMoveUpUser as $eleMoveUpUserDetail){
				$userCount++;
				$userId='';
				$raveType ='';
				$userId   = $eleMoveUpUserDetail['user_id'];// $this->session->userdata('userId');
				$raveType = $eleMoveUpUserDetail['raveType'];//$this->session->userdata('raveType');
				//$cycle 	  = $eleMoveUpUserDetail['userCycle'];
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
							$upLevelStatusCh = $this->gatewaymodel->userLevelStatusCh($userId,$currLevel,$cycle);
							if ($upLevelStatusCh){
								//insert new row to rave share with level 4 position 577 
								$level =$currLevel+1;// level wise check top mem
								$topMember = $this->gatewaymodel->getTopMember($level,$cycle);
								// echo count($topMember);
								// insert my data to rave_share table
								$myPosition = 577; 						
								if(count($topMember)>0){							
									$myParent   = $topMember[0]['user_id'];
								 }
								 else
								 {							
									$myParent   = 0; // admin
								 }
								 $prevBalance = $this->gatewaymodel->getBalance($userId,$currLevel,$cycle);// balance from previous level
								 $myBalance = round($prevBalance-$levelUpPrice,2);
								 // insert data to rave share
								 $insData = array();
								 $insData['user_id']      = $userId;
								 $insData['parentId']     = $myParent;
								 $insData['level']        = $level;
								 $insData['userPosition'] = $myPosition;
								 $insData['userCycle'] 	  = $cycle;									 
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
									 $instLog['userCycle']	= $cycle;
									 $instLog['action'] 	= "+";
									 $instLog['amount'] 	= $levelUpPrice;
									 $instLog['tranDate'] 	=  date('Y-m-d');
									 $tblLog 				= 'raveTransactionLog';
									 $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
									
									 // add amount to company Account  added by SB on 12-08-2016
									 $instcompAcct = array();
									 $instcompAcct['userId'] 		= $userId;
									 $instcompAcct['userLevel'] 	= $level;
									 $instcompAcct['userCycle']		= $cycle;
									 $instcompAcct['compShare'] 	= $compShare;
									 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
									 $instcompAcct['commDate'] 		= date('Y-m-d');
									 $tblCompAcct 					= 'rave_companyAccount';
									 $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
									 
									 // add Contingent amount to company Account  added by SB on 12-08-2016
									 $instContigent = array();
									 $instContigent['userId'] 		= $userId;
									 $instContigent['userLevel'] 	= $level;
									 $instContigent['userCycle']	= $cycle;
									 $instContigent['compShare'] 	= $contingentCom;
									 $instContigent['shareFor'] 	= 'C';// J joining commission , C Contingent
									 $instContigent['commDate'] 	= date('Y-m-d');
									 $tblContigent					= 'rave_companyAccount';
									 $insertContigent				= $this->common_model->insertDataToTable($tblContigent,$instContigent);
									 
									 
								 }
								  // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
								 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId,$cycle);
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
								  $commMemberList = $this->gatewaymodel->getCommMember($level,$cycle);
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
														$activeCom		= 7.50;
														$founderCom		= 3.75;
														$commToInviter	= 1.88; // commission to inviter of level 1
													}
													else if($userlevel==2){
														$activeCom		= 9.38; //4.7;
														$founderCom		= 6.25;//3.13;
														$commToInviter	= 1.88;//0.94; // commission to inviter of level 2
														// commission to opportunity ,seed & Karma
														$opportunity 	= 4.13; //4.18;//2.34;
														$seed       	= 3.13;//1.56;
														$karma       	= 6.25;//1.59;
														$level3Entrance = 18.75;//9.38;
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
														$commToInviter	= 5.63; // commission to inviter of level 4
														// commission to opportunity ,seed & Karma
														$opportunity 	= 75;
														$seed       	= 31.84;//31.24;
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
											 $comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal,$cycle,$userlevel);
											 // echo "==".$comAddedToTopMem;
												 if($comAddedToTopMem){
													 // add Top Member share detail to log transaction
													 $instLogAboveMe 				= array();
													 $instLogAboveMe['note'] 		= "moveup commission from Admin to ParentUser-".$commMember;
													 $instLogAboveMe['userCycle'] 	= $cycle;
													 $instLogAboveMe['action'] 		= "-";
													 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
													 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
													 
													 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
													 // add opportunity 
													 $oppAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$opportunity,0,$cycle,$userlevel);
													 if($oppAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogOpp 				= array();
														 $instLogOpp['note'] 		= "opportunity from Admin to ParentUser-".$commMember;
														 $instLogOpp['userCycle'] 	= $cycle;
														 $instLogOpp['action'] 		= "-";
														 $instLogOpp['amount'] 		= $opportunity;
														 $instLogOpp['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogOpp);
													 
													 }
													 // add seed
													 $seedAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$seed,0,$cycle,$userlevel);
													 if($seedAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogseed				= array();
														 $instLogseed['note'] 		= "seed from Admin to ParentUser-".$commMember;
														 $instLogSeed['userCycle'] 	= $cycle;
														 $instLogseed['action'] 	= "-";
														 $instLogseed['amount'] 	= $seed;
														 $instLogseed['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogseed =$this->gatewaymodel->tranRecordInter($instLogseed);
													 
													 }
													  // add karma 
													 $karmaAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$karma,0,$cycle,$userlevel);
													 if($karmaAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogKarma 				= array();
														 $instLogKarma['note'] 		= "karma from Admin to ParentUser-".$commMember;
														 $instLogKarma['userCycle'] 	= $cycle;
														 $instLogKarma['action'] 		= "-";
														 $instLogKarma['amount'] 		= $karma;
														 $instLogKarma['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogKarma);
													 
													 }
													 // add enterance Level 5
													 
													 $enterL5AddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$level3Entrance,0,$cycle,$userlevel);
													 if($enterL5AddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogentL3 				= array();
														 $instLogentL3['note'] 		= "Enterance Level5 from Admin to ParentUser-".$commMember;
														 $instLogentL3['userCycle'] 	= $cycle;
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
															$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal,$cycle,$userlevel);
															//if inviter other than admin (referarID=1000) add commission to inviter
															 if($refComDone){
																 $instLogRef 				= array();
																 $instLogRef['note'] 		= "moveUp commission from Admin to RefererUser-".$refererUserId;
																 $instLogRef['userCycle'] 	= $cycle;
																 $instLogRef['action'] 		= "-";
																 $instLogRef['amount'] 		= $commToInviter;
																 $instLogRef['tranDate'] 	= $today;
																 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogRef);
																 
																 // referral detail insert in referral table
																 $refDetail 				= array();
																 $refDetail['myReferrer']   = $refererUserId;
																 $refDetail['referrerLevel']= $refererUserLevel;
																 $refDetail['refCycle']		= $cycle;
																 $refDetail['userId']   	= $commMember;
																 $refDetail['invtAmt']  	= $commToInviter;
																 $refDetail['refCommDate']  = date('Y-m-d');
																 $refDetail['refCommCount'] = 1;
																 $tblRefDetail 				= 'rave_referralDetail';
																 //  fetch referal detail exist or not
																 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel,$cycle);
																
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
								//$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($cycle, $level,$noPositionChangeUser);
															
							}
						}
					}
					

				}
				
				
				
			}
				
			// auto level up level 4 user to level 5  
			$this->auto_levelup5($cycle);
			return true;
		}
		else{ 
			
			return true;
		}
	}
	
	public function auto_levelup5($cycle){
		$eleMoveUpUser = array();
		$currLevel = 4;
		$currPosition=833;//24;// 160
		$eleMoveUpUser = $this->gatewaymodel->getMoveUpUser($currPosition,$currLevel,$cycle);
		//print_r($eleMoveUpUser);
		if(count($eleMoveUpUser)>0){
			$userCount=0;
			 $noPositionChangeUser = array();
			// $cycle 	  = $eleMoveUpUser[0]['userCycle'];
			$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($cycle, $currLevel+1,$noPositionChangeUser);	
			foreach($eleMoveUpUser as $eleMoveUpUserDetail){
				$userCount++;
				$userId='';
				$raveType ='';
				$userId   = $eleMoveUpUserDetail['user_id'];// $this->session->userdata('userId');
				$raveType = $eleMoveUpUserDetail['raveType'];//$this->session->userdata('raveType');
				//$cycle 	  = $eleMoveUpUserDetail['userCycle'];
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
							$upLevelStatusCh = $this->gatewaymodel->userLevelStatusCh($userId,$currLevel,$cycle);
							if ($upLevelStatusCh){
								//insert new row to rave share with level 5 position 833 
								$level =$currLevel+1;// level wise check top mem
								$topMember = $this->gatewaymodel->getTopMember($level,$cycle);
								// echo count($topMember);
								// insert my data to rave_share table
								$myPosition = 833; 						
								if(count($topMember)>0){							
									$myParent   = $topMember[0]['user_id'];
								 }
								 else
								 {							
									$myParent   = 0; // admin
								 }
								 $prevBalance = $this->gatewaymodel->getBalance($userId,$currLevel,$cycle);// balance from previous level
								 $myBalance = round($prevBalance-$levelUpPrice,2);
								 // insert data to rave share
								 $insData = array();
								 $insData['user_id']      = $userId;
								 $insData['parentId']     = $myParent;
								 $insData['level']        = $level;
								 $insData['userPosition'] = $myPosition;
								 $insData['userCycle'] 	  = $cycle;								 
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
									 $instLog['userCycle']	= $cycle;
									 $instLog['action'] 	= "+";
									 $instLog['amount'] 	= $levelUpPrice;
									 $instLog['tranDate'] 	=  date('Y-m-d');
									 $tblLog 				= 'raveTransactionLog';
									 $insertLog 			= $this->common_model->insertDataToTable($tblLog,$instLog);
									 
									  // add amount to company Account  added by SB on 12-08-2016
									 $instcompAcct = array();
									 $instcompAcct['userId'] 		= $userId;
									 $instcompAcct['userLevel'] 	= $level;
									 $instcompAcct['userCycle']		= $cycle;
									 $instcompAcct['compShare'] 	= $compShare;
									 $instcompAcct['shareFor'] 		= 'J';// J joining commission , C Contingent
									 $instcompAcct['commDate'] 		= date('Y-m-d');
									 $tblCompAcct 					= 'rave_companyAccount';
									 $insertCompAcct				= $this->common_model->insertDataToTable($tblCompAcct,$instcompAcct);
									 
									 // add Contingent amount to company Account  added by SB on 12-08-2016
									 $instContigent = array();
									 $instContigent['userId'] 		= $userId;
									 $instContigent['userLevel'] 	= $level;
									 $instContigent['userCycle']	= $cycle;
									 $instContigent['compShare'] 	= $contingentCom;
									 $instContigent['shareFor'] 	= 'C';// J joining commission , C Contingent
									 $instContigent['commDate'] 	= date('Y-m-d');
									 $tblContigent					= 'rave_companyAccount';
									 $insertContigent				= $this->common_model->insertDataToTable($tblContigent,$instContigent);
									 
								 }
								  // INTER MEMBER COUNT TO CAP TABLE FOR EACH User
								 $paidUser = $this->gatewaymodel->getUserFromRaveShare($level,$userId,$cycle);
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
								  $commMemberList = $this->gatewaymodel->getCommMember($level,$cycle);
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
														$activeCom		= 7.50;
														$founderCom		= 3.75;
														$commToInviter	= 1.88; // commission to inviter of level 1
													}
													else if($userlevel==2){
														$activeCom		= 9.38; //4.7;
														$founderCom		= 6.25;//3.13;
														$commToInviter	= 1.88;//0.94; // commission to inviter of level 2
														// commission to opportunity ,seed & Karma
														$opportunity 	= 4.13; //4.18;//2.34;
														$seed       	= 3.13;//1.56;
														$karma       	= 6.25;//1.59;
														$level3Entrance = 18.75;//9.38;
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
														$commToInviter	= 5.63; // commission to inviter of level 4
														// commission to opportunity ,seed & Karma
														$opportunity 	= 75;
														$seed       	= 31.84;//31.24;
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
											 $comAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$commToUserAboveMe,$counterVal,$cycle,$userlevel);
											 // echo "==".$comAddedToTopMem;
												 if($comAddedToTopMem){
													 // add Top Member share detail to log transaction
													 $instLogAboveMe 				= array();
													 $instLogAboveMe['note'] 		= "moveup commission from Admin to ParentUser-".$commMember;
													 $instLogAboveMe['userCycle'] 	= $cycle;
													 $instLogAboveMe['action'] 		= "-";
													 $instLogAboveMe['amount'] 		= $commToUserAboveMe;
													 $instLogAboveMe['tranDate'] 	= date('Y-m-d');
													 
													 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogAboveMe);
													 // add opportunity 
													 $oppAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$opportunity,0,$cycle,$userlevel);
													 if($oppAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogOpp 				= array();
														 $instLogOpp['note'] 		= "opportunity from Admin to ParentUser-".$commMember;
														 $instLogOpp['userCycle'] 	= $cycle;
														 $instLogOpp['action'] 		= "-";
														 $instLogOpp['amount'] 		= $opportunity;
														 $instLogOpp['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogOpp);
													 
													 }
													
													  // add karma 
													 $karmaAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$karma,0,$cycle,$userlevel);
													 if($karmaAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogKarma 				= array();
														 $instLogKarma['note'] 		= "karma from Admin to ParentUser-".$commMember;
														 $instLogKarma['userCycle'] 	= $cycle;
														 $instLogKarma['action'] 		= "-";
														 $instLogKarma['amount'] 		= $karma;
														 $instLogKarma['tranDate'] 	= date('Y-m-d');
														 
														 $insertLogOpp =$this->gatewaymodel->tranRecordInter($instLogKarma);
													 
													 }
													 // add enterance Level 5
													 
													 $seedAddedToTopMem = $this->gatewaymodel->addCommissionToTopmembernRef($commMember,$seed,0,$cycle,$userlevel);
													 if($seedAddedToTopMem){
															// add Top Member share detail to log transaction
														 $instLogentseed 				= array();
														 $instLogentseed['note'] 		= "Seed from Admin to ParentUser-".$commMember;
														 $instLogentseed['userCycle'] 	= $cycle;
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
															$refComDone   =  $this->gatewaymodel->addCommissionToTopmembernRef($refererUserId,$commToInviter,$counterRefVal,$cycle,$userlevel);
															//if inviter other than admin (referarID=1000) add commission to inviter
															 if($refComDone){
																 $instLogRef 				= array();
																 $instLogRef['note'] 		= "moveUp commission from Admin to RefererUser-".$refererUserId;
																 $instLogRef['userCycle'] 	= $cycle;
																 $instLogRef['action'] 		= "-";
																 $instLogRef['amount'] 		= $commToInviter;
																 $instLogRef['tranDate'] 	= $today;
																 $insertLogAboveMe =$this->gatewaymodel->tranRecordInter($instLogRef);
																 
																 // referral detail insert in referral table
																 $refDetail 				= array();
																 $refDetail['myReferrer']   = $refererUserId;
																 $refDetail['referrerLevel']= $refererUserLevel;
																 $refDetail['refCycle']		= $cycle;
																 $refDetail['userId']   	= $commMember;
																 $refDetail['invtAmt']  	= $commToInviter;
																 $refDetail['refCommDate']  = date('Y-m-d');
																 $refDetail['refCommCount'] = 1;
																 $tblRefDetail 				= 'rave_referralDetail';
																 //  fetch referal detail exist or not
																 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$refererUserLevel,$cycle);
																
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
								//$upUserPosition = $this->gatewaymodel->moveSelectedUserPosition($cycle, $level,$noPositionChangeUser);
															
							}
						}
					}
					
					
				}
				/* else
				{
					
				} */
				
				
			}
			
			// auto Cycle Change level 5 to level 1  
			//$this->auto_movelevel5User();
			$this->reRegisterUserForCycle2();
			
			return true;
		}
		else{
			return true;
		}
		
	}
	
	public function auto_movelevel5User(){
		$eleMoveUpUser = array();
		$currLevel = 5;
		$currPosition=1089;//24;// 160
		$eleMoveUpUser = $this->gatewaymodel->getMoveUpUserForCycle($currPosition,$currLevel);
		//print_r($eleMoveUpUser); exit;
		if(count($eleMoveUpUser)>0){
			
			$getNextCycleUserList = $this->gatewaymodel->getNextCycleUser();
			$getNextCycleUser = array();
			foreach($getNextCycleUserList as $key => $val){
				$getNextCycleUser[$key] =$val['uID'];
			}
			//$getNextCycleUser = array(1219,1223,1224,1225,1228,1229,1230); 			
			//echo "<pre>+++++++".print_r($getNextCycleUser);			exit;
			$userCount=0;
			foreach($eleMoveUpUser as $eleMoveUpUserDetail){
				if (!in_array($eleMoveUpUserDetail['user_id'], $getNextCycleUser)) 
				{
					$userCount++;
					$userId='';
					$raveType ='';
					$userId   = $eleMoveUpUserDetail['user_id'];
					//echo "<br>".$userCount."===============". $eleMoveUpUserDetail['user_id'];
					if($userId!= ""){
						$instData = array();
						$userFormDetail =$this->message_model->getUserInfo($userId);
						$instData['uID'] = $userFormDetail[0]['uID'];
						$instData['firstName'] = $userFormDetail[0]['firstName'];
						$instData['lastName'] = $userFormDetail[0]['lastName'];	
						$instData['userName'] = $userFormDetail[0]['userName'];
						$instData['phone'] = $userFormDetail[0]['phone'];	
						$instData['emailID'] = $userFormDetail[0]['emailID'];
						$instData['password'] = $userFormDetail[0]['password'];						
						$instData['skypeID'] = $userFormDetail[0]['skypeID'];
						$instData["referarID"] = $userFormDetail[0]['referarID'];
						$instData["afrooPaymentStatus"] = $userFormDetail[0]['afrooPaymentStatus'];
						$instData["userLevel"] = $userFormDetail[0]['userLevel'];
						$instData['forWebsite'] = $userFormDetail[0]['forWebsite'];
						$tbl = 'rave_NextCycleUser';	
						$cycleUser = $this->common_model->insertDataToTable($tbl,$instData);
						unset($instData);unset($tbl);
					}
				}
				/* else{
					echo "<br>".$userCount."++++++". $eleMoveUpUserDetail['user_id'];
				} */
			}
			return true;
		}
		else{
			return true;
		}
		
	}
	
	public function reEnterUser(){
		$noOfUser = 0;
		//step 1 select x user from dummy table order by asc 
		$userList = $this->gatewaymodel->getDummyUser($noOfUser);
		//print_r($userList); exit;
		if(count($userList)>0){
			$tblName = 'rave_userinfo';
			$i=0;
			
			foreach($userList as $userDetail){
				$nextCycleUser = $this->gatewaymodel->getLatestCycle();
				$cycle = 1;
				$levelId = 1;
				echo "<h1>Start re-enter with ID:".$i."====>".$userDetail['uID']." user".$userDetail['emailID']."==>levelId=>".$levelId."==>cycle=>".$nextCycleUser['curCycle']."</h1>";
				$deleterow_id = $userDetail['id'];
				//step 2 insert user to "rave_userinfo"  table  in level 1
				$instData =array();
				/*$instData['uID'] 					= $userDetail['uID'];
				$isUserIdExist = $this->gatewaymodel->isUserIdExist($userDetail['uID']);
					if($isUserIdExist){
                      $instData['uID'] 					= $userDetail['uID']+1;
					}*/
				$instData['referarID'] 			    = $userDetail['newReferarID'];
				$instData['firstName'] 				= $userDetail['firstName'];
				$instData['lastName'] 				= $userDetail['lastName'];
				$instData['userName'] 				= $userDetail['userName'];					
				$instData['emailID'] 				= $userDetail['emailID'];
				$instData['password'] 				= $userDetail['password'];
				$instData['phone'] 					= $userDetail['phone'];
				$instData['afrooPaymentStatus'] 	= $userDetail['afrooPaymentStatus'];
				$instData['skypeID'] 				= $userDetail['skypeID'];
				$instData['userType'] 				= $userDetail['userType'];
				$instData['userLevel'] 				= 1;
				$instData['status'] 				= $userDetail['status'];
				$instData['created_date'] 			= $userDetail['created_date'];
				$instData['forWebsite'] 			= $userDetail['forWebsite'];
					
				
				echo "<br>New Enter User ID: ".$raveUserId = $this->common_model->insertDataToTable($tblName,$instData);
				
				$tbl = 'dummy_rave_type';
				$where['user_id'] = $deleterow_id;
				$this->common_model->deleteDataFromTable($tbl,$where);
				// now delete the user from dummy user table 
				$tbluser = 'dummy_rave_user';
				$where1['id'] = $deleterow_id;
				$this->common_model->deleteDataFromTable($tbluser,$where1);
				/*echo "<pre>";
				print_r($userDetail);
				echo "<pre>";*/
				if($userDetail['afrooPaymentStatus']=='1'){
					if(strlen($userDetail['ravetype'])>2){
					// my raveshare type 					
					$tblType 				= 'user_raveshare_type';
					$typeData 				=  array();
					$typeData['user_id'] 	=  $raveUserId;
					$typeData['raveType'] 	=  $userDetail['ravetype'];// my Type
					$raveSignType 			=  $this->common_model->insertDataToTable($tblType,$typeData);
					}
					// free enrty to rave share at level 1 
					
					$raveFreeEntry = $this->userLevelOneFreeEntry($raveUserId,$levelId,$cycle);
					
					// now delete the user from dummy rave type table 
					
					
				}
				
				
				
				
				$i++;
			}
			
		}
	}
    public function reEnterLiveUnpaidUser(){
		$noOfUser = 3;
		//step 1 select x user from dummy table order by asc 
		$userList = $this->gatewaymodel->getLiveUnpaidUser($noOfUser);
		
		if(count($userList)>0){
			$instData =array();
			foreach($userList as $userDetail){
				$tblName = 'rave_userinfo';
								
				$d= date('Y-m-d H:i:s');
				$instData['referarID'] 			    = $userDetail['referalId'];
				$instData['firstName'] 				= $userDetail['fname'];
				$instData['lastName'] 				= $userDetail['lname'];
				$instData['userName'] 				= 'CT_'.$userDetail['fname'];					
				$instData['emailID'] 				= $userDetail['email'];
				$instData['password'] 				= $userDetail['password'];
				$instData['phone'] 					= $userDetail['mobile_no'];
				$instData['afrooPaymentStatus'] 	= 1;
				$instData['skypeID'] 				= '';
				$instData['userType'] 				= $userDetail['userType'];
				$instData['userLevel'] 				= 1;
				$instData['status'] 				= '1';
				$instData['created_date'] 			= $d;
				$instData['forWebsite'] 			= 2;
			$raveUserId = $this->common_model->insertDataToTable($tblName,$instData);	
				
				$raveuser_name	=	$this->common_model->updateRaveUserName($raveUserId);
					//Generate Signup Link
					if($raveuser_name==true){
						$this->gatewaymodel->createRouteRave();
					}
				
				$tbl = ' dummyaccount';
				$where= $userDetail['id'];
				$dummyacc_upd= $this->gatewaymodel->updateDataFromTable($tbl,$where);
				if($dummyacc_upd !=0)
				{
					echo "<h3> Data updated successfully for email id: ".$userDetail['email']."</h3>";
				}
				// my raveshare type 					
					$tblType 				= 'user_raveshare_type';
					$typeData 				=  array();
					$typeData['user_id'] 	=  $raveUserId;
					$typeData['raveType'] 	=  $userDetail['ravetype'];// my Type
					$raveSignType 			=  $this->common_model->insertDataToTable($tblType,$typeData);
					
					// free enrty to rave share at level 1 
					
					$raveFreeEntry = $this->userLevelOneFreeEntry($raveUserId,1,1);
					
					// now delete the user from dummy rave type table */
					
					
			}
			
		}
			
	}

	
	// level 5 complete userenter to next cycle  29/09/2016
	public function reRegisterUserForCycle2(){
		
		// 1- get user eligible for next cycle fetch currentCycle
		
		$userPosition = 1089;
		$tblName = 'rave_userinfo';
		$nextCycleUser = $this->gatewaymodel->getAllNextCycleUser($userPosition);
		
		if(count($nextCycleUser)>0){
			echo "<h2>reRegisterUserForCycle2:</h2><pre>";
		print_r($nextCycleUser);
		echo "</pre>";
		
			$i=1;
			foreach($nextCycleUser as $nextCycleUserDetail){
			echo "<br>".$i."===".$nextCycleUserDetail['uID']."===>".$nextCycleUserDetail['emailID'];	
		// 2- rave_userinfo change user status  make it 0
				$stChanged = $this->gatewaymodel->changeUserStatus($nextCycleUserDetail['uID']);
				$rvstChanged = $this->gatewaymodel->changeRaveShareStatus($nextCycleUserDetail['raveShareId']);
				
				if($stChanged){
					
		// 3- enter New Row in rave_userinfo with same detail and referrerId=0,userName Create & raveType table 
					
					$instData =array();
					$prevUserId 						= $nextCycleUserDetail['uID'];
					$instData['referarID'] 				= 0;					
					$instData['firstName'] 				= $nextCycleUserDetail['firstName'];
					$instData['lastName'] 				= $nextCycleUserDetail['lastName'];
					//$instData['userName'] 				= $nextCycleUserDetail['userName'];					
					$instData['emailID'] 				= $nextCycleUserDetail['emailID'];
					$instData['password'] 				= $nextCycleUserDetail['password'];
					$instData['phone'] 					= $nextCycleUserDetail['phone'];
					$instData['afrooPaymentStatus'] 	= $nextCycleUserDetail['afrooPaymentStatus'];
					$instData['skypeID'] 				= $nextCycleUserDetail['skypeID'];
					$instData['userType'] 				= $nextCycleUserDetail['userType'];
					$instData['userLevel'] 				= 1;
					$instData['status'] 				= '1';					
					$instData['forWebsite'] 			= $nextCycleUserDetail['forWebsite'];
						
					
					echo "<br>New User Id generate from Cycle2=>".$raveUserId = $this->common_model->insertDataToTable($tblName,$instData);
                   
                    if($raveUserId){
					//Updating user name
					$raveuser_name	=	$this->common_model->updateRaveUserName($raveUserId);
					//Generate Signup Link
					if($raveuser_name==true){
						$this->gatewaymodel->createRouteRave();
					}
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveUserId;
					$typeData['raveType'] =$nextCycleUserDetail['raveType'];// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
					
			// 4- store the presentId uId & previousId in rave_cycle table
					//echo "<br>raveUserId=>".$raveUserId."prevUserId=>".$prevUserId." userCycle=>".$nextCycleUserDetail['userCycle'];
					$cycleMaped = $this->gatewaymodel->storeCycleIds($raveUserId,$prevUserId,$nextCycleUserDetail['userCycle']);
					if($cycleMaped){
			// 5- mail user about new cycle 
			
					
					// next  cycle for commission on rave share at level 1					
					$levelId =1;
					$cycle =$nextCycleUserDetail['userCycle']+1;
					
			// 6-  now enter to level 1 call function userLevelOneFreeEntry($userId,$level,$cycle) pass new userId,level1 &Cycle+1
					//echo "<br>CHECKING IN PROGRESS.."; exit;
					$raveFreeEntry = $this->userLevelOneFreeEntry($raveUserId,$levelId,$cycle); 

				}//cycleMaped 
					}// end raveUserId
			
			}
			//echo "<br>Next cycle generated for ".$nextCycleUserDetail['uID']." New Id=>".$raveUserId." user";	
			$i++; 
		} // end foreach
				
		}	
	}
	// level 5 complete userenter to next cycle  29/09/2016
	public function reRegisterUser(){
		
		// 1- get user eligible for next cycle fetch currentCycle
		
		$userPosition = 1088;
		$tblName = 'rave_userinfo';
		$nextCycleUser = $this->gatewaymodel->getAllNextCycleUser($userPosition);
		/*echo "<pre>";
		print_r($nextCycleUser);
		echo "</pre>";*/
		//exit;	
		if(count($nextCycleUser)>0){
			$i=1;
			foreach($nextCycleUser as $nextCycleUserDetail){
			echo "<br>".$i."===".$nextCycleUserDetail['uID']."===>".$nextCycleUserDetail['emailID'];	
		// 2- rave_userinfo change user status  make it 0
				$stChanged = $this->gatewaymodel->changeUserStatus($nextCycleUserDetail['uID']);
				if($stChanged){
					
		// 3- enter New Row in rave_userinfo with same detail and referrerId=0,userName Create & raveType table 
					
					$instData =array();
					$prevUserId 						= $nextCycleUserDetail['uID'];
					$instData['referarID'] 				= 0;					
					$instData['firstName'] 				= $nextCycleUserDetail['firstName'];
					$instData['lastName'] 				= $nextCycleUserDetail['lastName'];
					//$instData['userName'] 				= $nextCycleUserDetail['userName'];					
					$instData['emailID'] 				= $nextCycleUserDetail['emailID'];
					$instData['password'] 				= $nextCycleUserDetail['password'];
					$instData['phone'] 					= $nextCycleUserDetail['phone'];
					$instData['afrooPaymentStatus'] 	= $nextCycleUserDetail['afrooPaymentStatus'];
					$instData['skypeID'] 				= $nextCycleUserDetail['skypeID'];
					$instData['userType'] 				= $nextCycleUserDetail['userType'];
					$instData['userLevel'] 				= 1;
					$instData['status'] 				= '1';					
					$instData['forWebsite'] 			= $nextCycleUserDetail['forWebsite'];
						
					
					$raveUserId = $this->common_model->insertDataToTable($tblName,$instData);
                    if($raveUserId){
					//Updating user name
					$raveuser_name	=	$this->common_model->updateRaveUserName($raveUserId);
					//Generate Signup Link
					if($raveuser_name==true){
						$this->gatewaymodel->createRouteRave();
					}
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveUserId;
					$typeData['raveType'] =$nextCycleUserDetail['raveType'];// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
					
			// 4- store the presentId uId & previousId in rave_cycle table
					//echo "<br>raveUserId=>".$raveUserId."prevUserId=>".$prevUserId." userCycle=>".$nextCycleUserDetail['userCycle'];
					$cycleMaped = $this->gatewaymodel->storeCycleIds($raveUserId,$prevUserId,$nextCycleUserDetail['userCycle']);
					if($cycleMaped){
			// 5- mail user about new cycle 
			
					
					// next  cycle for commission on rave share at level 1					
					$levelId =1;
					$cycle =$nextCycleUserDetail['userCycle']+1;
					
			// 6-  now enter to level 1 call function userLevelOneFreeEntry($userId,$level,$cycle) pass new userId,level1 &Cycle+1
					
					$raveFreeEntry = $this->userLevelOneFreeEntry($raveUserId,$levelId,$cycle); 
				}//cycleMaped 
					}// end raveUserId
			
			}
			echo "<br>Next cycle generated for ".$nextCycleUserDetail['uID']." New Id=>".$raveUserId." user";	
			$i++; 
		} // end foreach
			
		}	
	}
	
	//add group user 

	public function inviteGroupUser(){ 

		//Print_r($pageId);exit;

		$type = 'inviteUser';

        $status = 'error';
        echo "Referrer ID: ".$userId = $this->session->userdata('userId');
		//if($this->input->post('sendGroupInvitation') != ''){	
		if($userId){			

			
			
           
			//$userName = trim($this->input->post('groupUserName'));
			$userName = "sd".strtotime("now");

			$groupCount = 10;

			for($i=1;$i<=$groupCount;$i++){

				echo "<br>LINE $i";
				

				echo "<br>Email Id:".$userEmail = strtolower($userName).$i."@gmail.com";
                echo "<br>Email Id Exist:".$isEmailExist = $this->gatewaymodel->isUserMailExist($userEmail);
						

				if($isEmailExist){               

				   // $status = 'success';

					$data= array();

					$data['emailID']= $userEmail;

					$data['refererId']= $userId;

					//$data['refererId']= $_SESSION['userId'];

					//$this->sendInviMailToUser($data);



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
					$viewData['created_date'] = date("Y-m-d h:i:s");
					

					$viewData['forWebsite'] = 2;

					$tbl = 'rave_userinfo';

					echo "<br>New Sign Up ID:".$raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$viewData);
                   
                     /*echo "<pre>";
                    print_r($viewData);
                    echo "</pre>";*/
                   
					if($raveSignUpId){

						// my raveshare type 

						$myRaveType = $this->gatewaymodel->getMyRaveAccType($userId);

						$tblType = 'user_raveshare_type';

						$typeData =array();

						$typeData['user_id'] =$raveSignUpId;

						$typeData['raveType'] =$myRaveType;// my Type

						$this->common_model->insertDataToTable($tblType,$typeData);
						echo "<br>New User with Id $raveSignUpId created successfully.";
						// free enrty to rave share at level 1 
						$levelId =1;
						$cycle =1;
						$raveFreeEntry = $this->userLevelOneFreeEntry($raveSignUpId,$levelId,$cycle);
						

					}

				}

			
			}

        }
        else
        {
         echo "<h1>Please Sign In to generate random user.</h1>";

        }

		$this->session->set_flashdata('type',$type);

        $this->session->set_flashdata('status',$status);

		//redirect(base_url()."dashboard/raveShareHome", 'refresh');		
           exit;
		

	}

    

	public function ajaxlist() { //echo $this->session->userdata('userId')."++++".$this->session->userdata('userType');
        
         if ($this->session->userdata('emailId')!="nichole_monteiro@yahoo.co.uk" ) {
		if (!trim($this->session->userdata('userId')) || ($this->session->userdata('userType')!="ADMIN") ) {

            redirect(base_url() . 'gateway/', 'refresh');	

	        }
	         }

		$viewData= array();

		$viewData['totalUser'] = $this->gatewaymodel->getRaveAllUser(2);

		$viewData['totalActiveUser'] = $this->gatewaymodel->getRaveAllUser(1);

		$viewData['totalInactiveUser'] = $this->gatewaymodel->getRaveAllUser(0);

		$viewData['userListDetail'] = $this->gatewaymodel->getRaveAllUserDetail();

        foreach ($viewData['userListDetail'] as $key => $value) {
        $userId = $value['uID'];
		$viewData['userListDetail'][$key]['myReferalTotal'] = $this->gatewaymodel->getUserLevelPosition($userId);
		$viewData['userListDetail'][$key]['referralSum'] = 0;
		if(!empty($viewData['userListDetail'][$key]['myReferalTotal'])){
			$myLevel = $viewData['userListDetail'][$key]['myReferalTotal'][0]['level'];
			$myCycle = $viewData['userListDetail'][$key]['myReferalTotal'][0]['userCycle'];
		$viewData['userListDetail'][$key]['referralSum'] = $this->gatewaymodel->referralSum($userId,$myLevel,$myCycle);
        	
		}
		}

		/*echo "<pre>";
		print_r($viewData);
		exit;*/

		$this->load->view('raveshare/ajaxUserList',$viewData);

		//unset($viewData);

	}

######### subhendu create dummy user ################
      public function createDummyUser(){
		$this->gatewaymodel->insertAllUsersToDummyTable();
		//print_r($userList); exit;
		
	   }


	   public function testEmail() { 
		$instData = array();
		$instData['emailID'] = 'bankjp2@gmail.com';
		$instData['password'] = 'Das';
		
		$this->sendEmailToVipUser($instData, 'Welcome To Community Treasures User Group');
		}

	
}

?>