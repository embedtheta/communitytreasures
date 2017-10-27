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
			//$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			
			$instData = array();
			$instData["referarID"] = $userFormDetail[0]['referarID'];	
			$instData['firstName'] = trim($this->input->post('name'));
			$instData['lastName'] = trim($this->input->post('surname'));
			$instData['phone'] = trim($this->input->post('cellno'));
			$instData['emailID'] = trim($this->input->post('emailAddr'));
			$instData['city'] = 3;//trim($this->input->post('city'));
			$instData['currency'] = $this->gatewaymodel->getCurrency(trim($instData['city']));// get currency by city Added by SB on 07/08/2015
			$instData['skypeID'] = trim($this->input->post('skypeID'));
			$instData['userType'] = "FOUNDERS";
			$instData['password'] = $this->generatePassword();			
			$instData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
			$instData["userLevel"] = 1;// userlevel 1
			$instData['forWebsite'] = $this->forWebsite;//2/10/2015 us
			
			if ($this->form_validation->run() != FALSE) {
				//$signupId = $this->gatewaymodel->insertData($viewData);
				$tbl = 'rave_userinfo';
			    $raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$instData);
				if($raveSignUpId){
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveSignUpId;
					$typeData['raveType'] =$generalUserType;// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
					// free enrty to rave share at level 1 
					$levelId =1;
					$raveFreeEntry = $this->userLevelOneFreeEntry($raveSignUpId,$levelId);
					if($raveFreeEntry){
						//createCurrentAccount($signupId);// 0 balance account created added by SB on 07/08/2015
						$this->sendEmailToVipUserFounder($instData, 'Welcome To Community Treasures Founders Group');
						//$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . $this->sign_up_user_type);
						$viewData = $this->resetValueAfterSuccess();
						$viewData['msgType'] = 1; //1=su;2=fa
						$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
					}
					else{
						$viewData['msgType'] = 2; //1=su;2=fa
						$viewData['msg'] = 'Please try again.';
					}
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
	
	public function industryleader($signupId){
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
			//$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			$instData = array();			
			$instData["referarID"] = $userFormDetail[0]['referarID'];	
			$instData['firstName'] = trim($this->input->post('name'));
			$instData['lastName'] = trim($this->input->post('surname'));
			$instData['phone'] = trim($this->input->post('cellno'));
			$instData['emailID'] = trim($this->input->post('emailAddr'));
			$instData['city'] = 3;//trim($this->input->post('city'));
			$instData['currency'] = $this->gatewaymodel->getCurrency(trim($instData['city']));// get currency by city Added by SB on 07/08/2015
			$instData['skypeID'] = trim($this->input->post('skypeID'));
			$instData['userType'] = "INDUSTRY LEADER";
			$instData['password'] = $this->generatePassword();			
			$instData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
			$instData["userLevel"] = 1;// userlevel 1
			$instData['forWebsite'] = $this->forWebsite;//2/10/2015 us
			
			if ($this->form_validation->run() != FALSE) {
				//$signupId = $this->gatewaymodel->insertData($viewData);
				$tbl = 'rave_userinfo';
			    $raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$instData);
				if($raveSignUpId){
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveSignUpId;
					$typeData['raveType'] =$generalUserType;// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
					// free enrty to rave share at level 1 
					$levelId =1;
					$raveFreeEntry = $this->userLevelOneFreeEntry($raveSignUpId,$levelId);
					if($raveFreeEntry){
						//createCurrentAccount($signupId);// 0 balance account created added by SB on 07/08/2015
						$this->sendEmailToVipUserIndustryLeader($instData, 'Welcome To Community Treasures Industry Leader Group');
						//$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . $this->sign_up_user_type);
						$viewData = $this->resetValueAfterSuccess();
						$viewData['msgType'] = 1; //1=su;2=fa
						$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
					}
					else{
						$viewData['msgType'] = 2; //1=su;2=fa
						$viewData['msg'] = 'Please try again.';
					}
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
		$viewData['name'] = $userFormDetail[0]['firstName'];
		$viewData['surname'] = $userFormDetail[0]['lastName'];	
		$viewData['cellno'] = $userFormDetail[0]['phone'];	
		$viewData['emailAddr'] = $userFormDetail[0]['emailID'];	
		$viewData['skypeID'] = $userFormDetail[0]['skypeID'];
		$viewData["parentID"] = $userFormDetail[0]['referarID'];
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
			//$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			
			$instData = array();			
			$instData["referarID"] = $userFormDetail[0]['referarID'];	
			$instData['firstName'] = trim($this->input->post('name'));
			$instData['lastName'] = trim($this->input->post('surname'));
			$instData['phone'] = trim($this->input->post('cellno'));
			$instData['emailID'] = trim($this->input->post('emailAddr'));
			$instData['city'] = 3;//trim($this->input->post('city'));
			$instData['currency'] = $this->gatewaymodel->getCurrency(trim($instData['city']));// get currency by city Added by SB on 07/08/2015
			$instData['skypeID'] = trim($this->input->post('skypeID'));
			$instData['userType'] = "PAYING USER";
			$instData['password'] = $this->generatePassword();			
			$instData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
			$instData["userLevel"] = 1;// userlevel 1
			$instData['forWebsite'] = $this->forWebsite;//2/10/2015 us
			
			if ($this->form_validation->run() != FALSE) {
				//$signupId = $this->gatewaymodel->insertData($viewData);
				$tbl = 'rave_userinfo';
			    $raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$instData);
				if($raveSignUpId){
					// my raveshare type 					
					$tblType = 'user_raveshare_type';
					$typeData =array();
					$typeData['user_id'] =$raveSignUpId;
					$typeData['raveType'] =$generalUserType;// my Type
					$raveSignType = $this->common_model->insertDataToTable($tblType,$typeData);
					// free enrty to rave share at level 1 
					$levelId =1;
					$raveFreeEntry = $this->userLevelOneFreeEntry($raveSignUpId,$levelId);
					if($raveFreeEntry){
						//createCurrentAccount($signupId);// 0 balance account created added by SB on 07/08/2015
						$this->sendEmailToVipUser($instData, 'Welcome To Community Treasures User Group');
						//$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . $this->sign_up_user_type);
						$viewData = $this->resetValueAfterSuccess();
						$viewData['msgType'] = 1; //1=su;2=fa
						$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
					}
					else{
						$viewData['msgType'] = 2; //1=su;2=fa
						$viewData['msg'] = 'Please try again.';
					}
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
		$this->load->view('gateway/general_user', $viewData);
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
		$code = "RAVE" . $code;
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
		$this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
<div style="border-bottom: 1px solid #dcdcdc; padding-bottom: 10px;"><img src="'.base_url().'images/logo-login.png" width="605" height="73" alt="" /></div>
			  <p align="center">Welcome To </p>
			  <p align="center"><strong>Community Treasures</strong><br />
				<strong>Founders Group</strong> </p>
				<p></p>
			  <p>Here are all of your details with login credentials as below.</p>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="25%">Email:</td><td width="75%">' . $data['emailID'] . '</td></tr>
			<tr><td width="25%">Password:</td><td width="75%">' . $data['password'] . '</td></tr>
			<tr><td colspan="2"><a href="'.base_url().'">Click here to Login.</a></td></tr>
			<tr>
			  <td style="background:#1f3e76; color:#fff;" height="50" align="center">
			 Copyright @ Global Trade Enterprise '.date('Y').'
			  </td>
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
	public function userLevelOneFreeEntry($userId,$level){
		
		//fetch top member from rave share
		//$level =1;// level wise check top mem
		$topMember = $this->gatewaymodel->getTopMember($level);
		// insert my data to rave_share table
		$myPosition = 0; 						
		if(count($topMember)>0){							
			$myParent   = $topMember[0]['user_id'];
		 }
		 else
		 {							
			$myParent   = 0; // admin
		 }
		 // insert data to rave share table with level 1 amt& counter 0 
		 $insData = array();
		 $insData['user_id']      = $userId;
		 $insData['parentId']     = $myParent;
		 $insData['level']        = $level;
		 $insData['userPosition'] = $myPosition;						 
		 $insData['creationDate'] = date('Y-m-d');
		 $insData['status'] 	  = 1;
		 $insData['amount'] 	  = 0;
		 $insData['counter'] 	  = 0;
		
		 $catLogPrice = 30;
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
			 
			  //fetch all user eligible for commission no commission only position 
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
							
								$activeCom=4;
								$founderCom=1.88;
								if($commMemberDetail['raveType']=="Active"){
																																
									$commToUserAboveMe 	= $activeCom;// Active User commission Amount for other Cycle
									
								}else{
									
									$commToUserAboveMe 	= $activeCom+$founderCom;// Founder commission Amount for other Cycle
									
								}
							 //referral commission to referrar as per level user  
								if($userlevel==1){
									$commToInviter		= 1; // commission to inviter of level 1
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
											 $refDataExist				= $this->gatewaymodel->chkRefDataExist($refererUserId,$commMember,$userlevel);
													
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
				return true;
			}
			else {
				return false;
			}			

		 
	}
	public function sendEmailToVipUserIndustryLeader($data = array(), $sub = "COMMUNITY") {
		
	
		$this->_to_email = $data['emailID'];
		$this->_subject = $sub;
		$this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
<div style="border-bottom: 1px solid #dcdcdc; padding-bottom: 10px;"><img src="'.base_url().'images/logo-login.png" width="605" height="73" alt="" /></div>
			  <p align="center">Welcome To </p>
			  <p align="center"><strong>Community Treasures</strong><br />
				<strong>Industry Leader Group</strong> </p>
				<p></p>
			  <p>Here are all of your details with login credentials as below.</p>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="25%">Email:</td><td width="75%">' . $data['emailID'] . '</td></tr>
			<tr><td width="25%">Password:</td><td width="75%">' . $data['password'] . '</td></tr>
			<tr><td colspan="2"><a href="'.base_url().'">Click here to Login.</a></td></tr>
			<tr>
			  <td style="background:#1f3e76; color:#fff;" height="50" align="center">
			 Copyright @ Global Trade Enterprise '.date('Y').'
			  </td>
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
		$this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
<div style="border-bottom: 1px solid #dcdcdc; padding-bottom: 10px;"><img src="'.base_url().'images/logo-login.png" width="605" height="73" alt="" /></div>
			  <p align="center">Welcome To </p>
			  <p align="center"><strong>Community Treasures</strong><br />
				<strong>User Group</strong> </p>
				<p></p>
			  <p>Here are all of your details with login credentials as below.</p>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="25%">Email:</td><td width="75%">' . $data['emailID'] . '</td></tr>
			<tr><td width="25%">Password:</td><td width="75%">' . $data['password'] . '</td></tr>
			<tr><td colspan="2"><a href="'.base_url().'">Click here to Login.</a></td></tr>
			<tr>
			  <td style="background:#1f3e76; color:#fff;" height="50" align="center">
			 Copyright @ Global Trade Enterprise '.date('Y').'
			  </td>
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
	
}

?>













