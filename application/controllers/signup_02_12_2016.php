<?php
/*
Created by Ranajit Das  
*/
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Signup extends CI_Controller {

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
		$this->_from_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";// change by SB on 22/03/2016
		$this->_from_name = "communitytreasures.co";
		$this->_admin_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
		$this->load->model('gatewaymodel');
		$this->load->model('common_model');
		$this->load->model('message_model');
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

	public function index() { 
		redirect(base_url() . "signup/mentorship");
	}
	
	public function head_volunteers($parentID = 0) { 
		$this->_setSignupPageDetails(2);
		$this->sign_up_user_type = "HEAD VOLUNTEERS";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($this->input->post('city')));// get currency by city Added by SB on 07/08/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;//2/10/2015 us 
		
			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 07/08/2015
				$this->sendEmailToHeadVolunteer($viewData, 'Signup Email of COMMUNITY ' . $this->sign_up_user_type);
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . $this->sign_up_user_type);
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('signup/head_volunteers', $viewData);
	}

	public function volunteers($parentID = 0) {
		$this->_setSignupPageDetails(3);
		$this->sign_up_user_type = "VOLUNTEERS";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($this->input->post('city')));// get currency by city Added by SB on 07/08/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;//2/10/2015 us
			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 07/08/2015
				$this->sendEmailToVolunteer($viewData, 'Signup Email of COMMUNITY ' . $this->sign_up_user_type);
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . $this->sign_up_user_type);
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('signup/volunteers', $viewData);
	}

	public function founders($parentID = 0) {
		$this->_setSignupPageDetails(5);
		$this->sign_up_user_type = "FOUNDERS";
		$generalUserType = "Founder";
		$viewData = array();
		$viewData['city'] = 3;
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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
		//echo $viewData["parentID"];
		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = 3;//trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($viewData['city']));// get currency by city Added by SB on 07/08/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;//2/10/2015 us

			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				$this->insertGeneralUserType($signupId,$generalUserType);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 07/08/2015
				$this->sendEmailToStudent($viewData, 'Welcome To Community Treasures Founders Group');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . $this->sign_up_user_type);
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('signup/student', $viewData);
	}
	
	public function industryleader(){
		$this->_setSignupPageDetails(4);
		$this->sign_up_user_type = "INDUSTRY LEADER";
		$generalUserType = "Industry_Leader";
		$viewData = array();
		$viewData['city'] = 3;
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = 3;//trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($viewData['city']));// get currency by city Added by SB on 07/08/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;//2/10/2015 us

			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				$this->insertGeneralUserType($signupId,$generalUserType);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 07/08/2015
				$this->sendEmailToTeacher($viewData, 'Signup Email of COMMUNITY ' . $this->sign_up_user_type);
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . $this->sign_up_user_type);
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('signup/teachers', $viewData);
	}

	public function business($parentID = 0) {
		$this->_setSignupPageDetails(7);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "business";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($this->input->post('city')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'business';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('signup/business', $viewData);
		
	}
	
	//27/10/2015 ujjwal sana added
	/*  public function realestate($parentID = 0) {
		 //print_r("dsffff");exit;
		$this->_setSignupPageDetails(18);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "real_estate";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015				
				$this->insertGeneralUserType($signupId,$generalUserType);
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] = $this->createUrl();
		//$this->load->view('signup/real_estate', $viewData);
		$this->load->view('signup/real_estate', $viewData);
	} 
	//new change 18/12/2015 us
	public function realestate($parentID = 0) {
		 //print_r("dsffff");exit;
		$this->_setSignupPageDetails(18);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "real_estate";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015				
				$this->insertGeneralUserType($signupId,$generalUserType);
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] = $this->createUrl();
		//$this->load->view('signup/real_estate', $viewData);
		$this->load->view('signup/real_estate', $viewData);
	}*/
//27/10/2015 ujjwal sana added
	 public function fitness($parentID = 0) {
		 //print_r("dsffff");exit;
		$this->_setSignupPageDetails(20);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "fitness";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
				//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015				
				$this->insertGeneralUserType($signupId,$generalUserType);
				//print_r("ddd");exit;
				$viewData['signup_userType']	=	'fitness';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] = $this->createUrl();
		$this->load->view('signup/fitness', $viewData);
		
	}
	//27/10/2015 ujjwal sana added
	 public function hair_and_beauty($parentID = 0) {
		 //print_r("dsffff");exit;
		$this->_setSignupPageDetails(19);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "hair_and_beauty";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015				
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'hair_and_beauty';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] = $this->createUrl();
		$this->load->view('signup/hair_and_beauty', $viewData);
		
	}

	//27/10/2015 ujjwal sana added
	 public function food($parentID = 0) {
		 //print_r("dsffff");exit;
		$this->_setSignupPageDetails(17);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "food";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015				
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'food';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] = $this->createUrl();
		$this->load->view('signup/food', $viewData);
		
	}

	public function communities($parentID = 0) {
		show_404();
		$this->_setSignupPageDetails(8);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "community";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($this->input->post('city')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;//2/10/2015 us

			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'communities';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY '  . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY '  . ucwords($generalUserType) .' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('signup/comunities', $viewData);
	}
	
	public function afrowebb($parentID = 0) {
		$this->_setSignupPageDetails(11);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "afrowebb";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($this->input->post('city')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;//2/10/2015 us

			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'afrowebb';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY '  . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY '  . ucwords($generalUserType) .' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('signup/afrowebb', $viewData);
	}
	
	public function mentorship($parentID = 0) {
		$this->_setSignupPageDetails(10);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "mentorship";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($this->input->post('city')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;//2/10/2015 us

			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'mentorship';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType) .' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('signup/mentorship', $viewData);
	}
	
	public function talented($parentID = 0) {
		$this->_setSignupPageDetails(6);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "talented";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		   // $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($this->input->post('city')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;//2/10/2015 us

			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'talented';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType) .' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('signup/talented', $viewData);
	}

	public function health($parentID = 0) {
		$this->_setSignupPageDetails(9);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "health";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($this->input->post('city')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;//2/10/2015 us 

			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'health';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType) .' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();
		$this->load->view('signup/health', $viewData);
	}
	
	public function checkUniqueEmail() {
		$emailAddr = trim($this->input->post('emailAddr'));
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
	
	 function send_mail_raw1() {
		 //print_r($this);
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "Bcc:senabi.test01@gmail.com"."\n";
		//$headers .= 'Cc:senabi.test01@gmail.com' . "\r\n";//senabi.gbe@gmail.com
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
		$code = "COMMUNITY" . $code;
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
	
	public function sendEmailToStudent($data = array(), $sub = "COMMUNITY") {
		$tbl = "city";
		$where["id"] = $data['city'];
		$selectedData = "";
		$city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData); 
	
		$this->_to_email = $data['emailAddr'];
		$this->_subject = "Welcome To Community Treasures Founders Group";
		$this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
			  <p align="center">Welcome To </p>
			  <p align="center"><strong>Community Treasures</strong><br />
				<strong>Founders Group</strong> </p>
				<p></p>
			  <p align="center">Please wait, 24hours (max) for us to verify your details<br />
				and give you access. </p>
			  <p align="center">Once verified, You will receive an email with the login details <br />
				to enter your V.I.P position on our platform.</p>
			  <p align="center">Thank You For Your Support  <br/>
			  \'Together, We Can Make A Difference\' </p>			 
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
	
	public function sendEmailToHeadVolunteer($data = array(), $sub = "COMMUNITY") {
		$tbl = "city";
		$where["id"] = $data['city'];
		$selectedData = "";
		$city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData); 
	
		$this->_to_email = $data['emailAddr'];
		$this->_subject = "Promotion To COMMUNITY Head Volunteer";
		$this->_message = '<div style="width:98%; padding:1%;">
<p align="center">Thank You for  Registering.</p>
<p align="center">This area is  restricted to Head Volunteers Only.<br />
  You have been given  the honourable position of? Captain to  lead a Volunteer team.<br />
  Remember to be loyal, <br />
  be motivated and be  committed to the success of others <br />
  while being committed  to the success of yourself.</p>
<p align="center">We are a Meritocracy,  So, We are watching.<strong></strong><br />
  <strong>The better you lead  your team, the higher you will go in this organisation.</strong></p>
<p align="center">Teach them how to  "Move As One".<br />
  Be the Best You Can  Be.<strong></strong><br />
  <strong>We Are COMMUNITY</strong>.</p>
<p align="center">An  email will be sent to You giving you access into your <br />
  Head  Volunteer account.</p>
 </div>';
		
		if ($this->_to_email != '' && $this->_subject != '') {
			$this->send_mail_raw();
			return true;
		} else {
			return false;
		}
	}
	
	public function sendEmailToTeacher($data = array(), $sub = "COMMUNITY") {
		$tbl = "city";
		$where["id"] = $data['city'];
		$selectedData = "";
		$city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData); 
	
		$this->_to_email = $data['emailAddr'];
		$this->_subject = "Promotion To COMMUNITY Industry Leader";
	   /* $this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif;">
  <p align="center">Thank You for  Registering.</p>
  <p align="center">This area is  restricted to COMMUNITY Online Teachers Only.<br />You have been given  the honourable position of Online Teacher to lead a class of Students.<br /> Remember to be loyal, <br />be motivated and be  committed to the success of others <br /> while being committed  to the success of yourself.</p>
  <p align="center">We are a Meritocracy,  So, We are watching.<strong></strong><br />
	<strong>The better you lead  your team, the higher you will go in this organisation.</strong></p>
  <p align="center">Teach them how to  "Move As One".<br />
	Be the Best You Can  Be.<strong></strong><br />
  <strong>We Are COMMUNITY.</strong></p>
  <p align="center">An email will be sent  to You giving you access into your <br />
	Teacher account. </p>
</div>';*/
	   
	   $this->_message = 'Testing Mail';
		
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
	
	
	public function sendEmailTest() {
		//error_reporting(E_ALL);
		$this->_to_email = 'senabi.gbe@gmail.com';
		$this->_subject = "Join COMMUNITY Today - Make Money Online";
		$this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
  <p>Hello   Name</p>
  <p>Below is your username and password to  enter your Teachers Account.<br />
	Now you can Start to build your COMMUNITY  Business and make money.<br />
	You can change your password once you are  inside your account.</p>
  <p>Remember This is Your Moment! <br />
	Recruit and Teach as many Students as  possible.<br />
	Your Target should be 50 Students or more  in Your Online Class.<br />
	Good Luck.</p>
  <p style="font-size:14px;">Here is your  login credentials </p>
  <p>Username:     gjhjfgg</p>
  <p>Password:     kfhgkhgh</p>
<a href="">Click here to login</a></div>';
		
		if ($this->_to_email != '' && $this->_subject != '') {
			$this->send_mail_raw1();
			return true;
		} else {
			return false;
		}
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
	//new section add for CT_product signup for CT by ujjwal sana 2015
	//============================================================================
/* 	public function beautyMonetizerSignup($parentID = 0) {
		//echo "dd";exit;
		//$this->_setSignupPageDetails(18);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "beauty_monetizer";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';

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
		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
		   // $this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
		  //  $this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = "ujjwal";//trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = "2";//trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = $this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015				
				$this->insertGeneralUserType($signupId,$generalUserType);
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
				//new added 23/12/2015 us
				$viewData['cityArray'] = $this->city;
				$viewData['videoPath'] = $this->videoPath;
				$viewData['ogUrl'] = $this->createUrl();
				$this->load->view('ct_catalog/beauty_payment', $viewData);
			} else 
			{
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
				//print_r($viewData);exit;
				$this->load->view('ct_catalog/beauty_signup', $viewData);
			}
	   
			
		}
		else
		{
			//echo "2";exit;
			$this->load->view('ct_catalog/beauty_signup', $viewData);
		}
	} */
	public function beauty($parentID = 0) {
		//print_r("dsffff");exit;
	   // $this->_setSignupPageDetails(18);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "Beauty_Monetizer";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		$viewData["ct_userID"]=$parentID;
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

		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$str=trim($this->input->post('emailAddr'));
			$userName=explode("@",$str);
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = $userName[0];//trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE)
			{
				$signupId = $this->gatewaymodel->insertData($viewData);
				//15-1-2016 set id in session
				$this->session->set_userdata('userId', $signupId);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015	
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'beauty';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
				
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="Beauty";
		$viewData['City']=$this->common_model->getMoneCountryList();// specific country  list added by SB on 04/03/2016
		$viewData['videoPath'] = $this->videoPath;
		$viewData['signupVideoImg'] = $this->common_model->getCT_AllVideo(7);// signup detail added by SB on 04/03/2016
		$viewData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(13);// signup detail added by SB on 04/03/2016
		$viewData['ogUrl'] = $this->createUrl();
		//$this->load->view('signup/real_estate', $viewData);
		if($viewData['msgType'] == 1){
			$this->load->view('ct_catalog/beauty_payment', $viewData);
		}else{
			$this->load->view('ct_catalog/beauty_signup', $viewData);
		}
		
	}
	public function Meetups($parentID = 0) {
		//print_r("dsffff");exit;
	   // $this->_setSignupPageDetails(18);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "Meetups_Monetizer";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		$viewData["ct_userID"]=$parentID;
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
		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$str=trim($this->input->post('emailAddr'));
			$userName=explode("@",$str);
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = $userName[0];//trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE)
			{
				$signupId = $this->gatewaymodel->insertData($viewData);
				//15-1-2016 set id in session
				$this->session->set_userdata('userId', $signupId);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015	
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'meetups';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
				
			} else {
				
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="Meetups";
		$viewData['City']=$this->common_model->getMoneCountryList();// specific country  list added by SB on 04/03/2016
		$viewData['videoPath'] = $this->videoPath;
		$viewData['signupVideoImg'] = $this->common_model->getCT_AllVideo(8);// signup detail added by SB on 04/03/2016
		$viewData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(13);// signup detail added by SB on 04/03/2016
		$viewData['ogUrl'] = $this->createUrl();
		//$this->load->view('signup/real_estate', $viewData);
		if($viewData['msgType'] == 1){
			$this->load->view('ct_catalog/meetups_payment', $viewData);
		}else{
			$this->load->view('ct_catalog/meetups_signup', $viewData);//meetups_signup
		}
		
	}
	public function Models($parentID = 0) {
		//print_r("dsffff");exit;
	   // $this->_setSignupPageDetails(18);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "Models_Monetizer";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		$viewData["ct_userID"]=$parentID;
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
		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$str=trim($this->input->post('emailAddr'));
			$userName=explode("@",$str);
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = $userName[0];//trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE)
			{
				$signupId = $this->gatewaymodel->insertData($viewData);
				//15-1-2016 set id in session
				$this->session->set_userdata('userId', $signupId);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015	
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'models';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
				
			} else {
				
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="Models";
		$viewData['City']=$this->common_model->getMoneCountryList();// specific country  list added by SB on 04/03/2016
		$viewData['videoPath'] = $this->videoPath;
		$viewData['signupVideoImg'] = $this->common_model->getCT_AllVideo(9);// signup detail added by SB on 04/03/2016
		$viewData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(13);// signup detail added by SB on 04/03/2016
		$viewData['ogUrl'] = $this->createUrl();
		//$this->load->view('signup/real_estate', $viewData);
		$viewData["cityList"] = $this->gatewaymodel->getCity();
		$viewData["countryList"] = $this->gatewaymodel->getCountryList();
		if($viewData['msgType'] == 1){
			$this->load->view('ct_catalog/models_profile', $viewData);
		}else{
			$this->load->view('ct_catalog/models_signup', $viewData);//meetups_signup
		}
		
	}
	public function Music($parentID = 0) {
		//print_r("dsffff");exit;
	   // $this->_setSignupPageDetails(18);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "Music_Monetizer ";
		$status = 'error';
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		$viewData["ct_userID"]=$parentID;
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
		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$str=trim($this->input->post('emailAddr'));
			$userName=explode("@",$str);
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = $userName[0];//trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//18/1/2016 new added
			/* $imgData = $this->profileImageUpload();
			if($viewData['status'] == 3){
					$viewData['profile'] = $imgData['profile'];	
				} */
				//----------------------------
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE)
			{
				$signupId = $this->gatewaymodel->insertData($viewData);
				//15-1-2016 set id in session
				$this->session->set_userdata('userId', $signupId);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015	
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'music';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
				
			} else {
				
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="Music";
		$viewData['City']=$this->common_model->getMoneCountryList();// specific country  list added by SB on 04/03/2016
		$viewData['videoPath'] = $this->videoPath;
		$viewData['signupVideoImg'] = $this->common_model->getCT_AllVideo(10);// signup detail added by SB on 04/03/2016
		$viewData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(13);// signup detail added by SB on 04/03/2016
		$viewData['ogUrl'] = $this->createUrl();
		$viewData["cityList"] = $this->gatewaymodel->getCity();
		//print_r($viewData["cityList"]);exit;
		//$this->load->view('signup/real_estate', $viewData);
		//$viewData["cityList"] = $this->gatewaymodel->CtgetCity();
		$viewData["countryList"] = $this->gatewaymodel->getCountryList();
		if($viewData['msgType'] == 1){
			$this->load->view('ct_catalog/music_profile', $viewData);
		}else{
			$this->load->view('ct_catalog/music_signup', $viewData);//meetups_signup
		}
		
	}
 
		public function Nutri($parentID = 0) {
		//print_r("dsffff");exit;
	   // $this->_setSignupPageDetails(18);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "Nutri_Monetizer";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		$viewData["ct_userID"]=$parentID;
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
		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$str=trim($this->input->post('emailAddr'));
			$userName=explode("@",$str);
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = $userName[0];//trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE)
			{
				$signupId = $this->gatewaymodel->insertData($viewData);
				//15-1-2016 set id in session
				$this->session->set_userdata('userId', $signupId);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015	
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'nutri';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
				
			} else {
				
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="Nutri";
		$viewData['City']=$this->common_model->getMoneCountryList();// specific country  list added by SB on 04/03/2016
		$viewData['videoPath'] = $this->videoPath;
		$viewData['signupVideoImg'] = $this->common_model->getCT_AllVideo(11);// signup detail added by SB on 04/03/2016
		$viewData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(13);// signup detail added by SB on 04/03/2016
		$viewData['ogUrl'] = $this->createUrl();
		//$this->load->view('signup/real_estate', $viewData);
		if($viewData['msgType'] == 1){
			$this->load->view('ct_catalog/nutri_payment', $viewData);
		}else{
			$this->load->view('ct_catalog/nutri_signup', $viewData);//meetups_signup
		}
		
	}
	
		public function RealEstate($parentID = 0) 
		{
		//print_r("dsffff");exit;
	   // $this->_setSignupPageDetails(18);
		$this->sign_up_user_type = "PAYING USER";
		$generalUserType = "RealEstate_Monetizer";
		$viewData = array();
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
		$viewData["ct_userID"]=$parentID;
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
		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$str=trim($this->input->post('emailAddr'));
			$userName=explode("@",$str);
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = $userName[0];//trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['country'] = trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrencyFromCountry(trim($this->input->post('country')));// get currency by city Added by SB on 20/07/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = '';//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;
			//print_r($viewData);exit;
			if ($this->form_validation->run() != FALSE)
			{
				$signupId = $this->gatewaymodel->insertData($viewData);
				//15-1-2016 set id in session
				$this->session->set_userdata('userId', $signupId);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015	
				$this->insertGeneralUserType($signupId,$generalUserType);
				$viewData['signup_userType']	=	'realestate';
				$this->sendEmailToUser($viewData, 'Signup Email of COMMUNITY ' . ucwords($generalUserType) .' User');
				$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . ucwords($generalUserType).' User');
				$viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
				
			} else {
				
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
		$viewData['Page_name']="RealEstate";
		$viewData['City']=$this->common_model->getMoneCountryList();// specific country  list added by SB on 04/03/2016
		$viewData['videoPath'] = $this->videoPath;
		$viewData['signupVideoImg'] = $this->common_model->getCT_AllVideo(12);// signup detail added by SB on 04/03/2016
		$viewData['paymentVideoImg'] = $this->common_model->getCT_AllVideo(13);// signup detail added by SB on 04/03/2016
		$viewData['ogUrl'] = $this->createUrl();
		//$this->load->view('signup/real_estate', $viewData);
		if($viewData['msgType'] == 1){
			$this->load->view('ct_catalog/Real_payment', $viewData);
		}else{
			$this->load->view('ct_catalog/Real_signup', $viewData);//meetups_signup
		}
		
	}
	//18/1/2016 new added for CT
		public function profileImageUpload(){
		$retData['status'] = 1;
		$retData['profile'] = '';
		$rr=$this->userId;
		if ($_FILES['profile']['name'] != "") {
			$allowedExts = array("jpg","png","jpeg");
			$temp = explode(".", $_FILES["profile"]["name"]);
			$extension = strtolower(end($temp));
			if (($_FILES["profile"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
				$_FILES["profile"]["name"] = 'profile-'.$this->userId.'-'.time() . "." . $extension;
			print_r($rr);exit;
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



	public function commonSignUpForFounder($parentID = 0) {
		$this->_setSignupPageDetails(5);
		$this->sign_up_user_type = "FOUNDERS";
		$generalUserType = "Founder";
		$viewData = array();
		$viewData['city'] = 3;
		$viewData['msgType'] = ''; //1=su;2=fa
		$viewData['msg'] = '';
        //echo $parentID; exit;
        $parentID = base64_decode($parentID);
        $parentIDArray = explode("#", $parentID);
		$parentID = $parentIDArray[0];
		$userID = $parentIDArray[1];


        

        //access the second database
		$admin_db= $this->load->database('ADMINDB', TRUE);

		$admin_db->select('rave_userinfo.*,city.city cityName,city.id city_id,country.country_id,country.name countryName');
		$admin_db->from('rave_userinfo');
		$admin_db->join("city","city.id=rave_userinfo.city AND city.is_active=1","LEFT");
		$admin_db->join("country","country.country_id=rave_userinfo.country AND country.status=1","LEFT");				
		$admin_db->where('rave_userinfo.uID',$userID);
		$query = $admin_db->get();
		//$admin_db->last_query();
		$userFormDetail = $query->result_array();

		$viewData['name'] = $userFormDetail[0]['firstName'];
		$viewData['surname'] = $userFormDetail[0]['lastName'];	
		$viewData['cellno'] = $userFormDetail[0]['phone'];	
		$viewData['emailAddr'] = $userFormDetail[0]['emailID'];	
		$viewData['password'] = $userFormDetail[0]['password'];	
		$viewData['skypeID'] = $userFormDetail[0]['skypeID'];
		$viewData["parentID"] = $userFormDetail[0]['referarID'];
		$password = $userFormDetail[0]['password'];// added by SB on 23/06/2016
		$viewData["vipUserId"] = $signupId;// added by SB on 23/06/2016
		$viewData['afrooPaymentStatus'] = $userFormDetail[0]['afrooPaymentStatus'];

		############## Here we are checking the user has already register or not ######
        $ustatus = $this->gatewaymodel->isMailExist($userFormDetail[0]['emailID']);
        $viewData['activationStatus'] = 0;
        if($ustatus){
        $viewData['activationStatus'] = 1;
        }
		############## END Subhendu ###################################################
		
		/*if ($parentID == 0) {
			$parentID = 1000;
			$viewData["parentID"] = $parentID;
		} else if ($parentID > 0) {
			$ustatus = $this->gatewaymodel->isMemberExist($parentID);
			if ($ustatus) {
				$viewData["parentID"] = $parentID;
			} else {
				$viewData["parentID"] = 1000;
			}
		}*/
		//echo $viewData["parentID"];
		if ($this->input->post('submit')) {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
			$this->form_validation->set_rules('cellno', 'Contact Number', 'trim|required');
			//$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
			$this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			//$this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required');
			$viewData['name'] = trim($this->input->post('name'));
			$viewData['surname'] = trim($this->input->post('surname'));
			//$viewData['invited']					= trim($this->input->post('invited'));
			$viewData['cellno'] = trim($this->input->post('cellno'));
			$viewData['emailAddr'] = trim($this->input->post('emailAddr'));
			$viewData['city'] = 3;//trim($this->input->post('city'));
			$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($viewData['city']));// get currency by city Added by SB on 07/08/2015
			$viewData['skypeID'] = trim($this->input->post('skypeID'));
			$viewData['userType'] = $this->sign_up_user_type;
			$viewData['password'] = trim($this->input->post('password'));//$this->generatePassword();
			$viewData['forWebsite'] = $this->forWebsite;//2/10/2015 us

			
			if ($this->form_validation->run() != FALSE) {
				$signupId = $this->gatewaymodel->insertData($viewData);
				
				$this->insertGeneralUserType($signupId,$generalUserType);
				createCurrentAccount($signupId);// 0 balance account created added by SB on 07/08/2015
			    //$this->sendEmailToStudent($viewData, 'Welcome To Community Treasures Founders Group');
				//$this->sendEmailToAdmin($viewData, 'New Signup of COMMUNITY ' . $this->sign_up_user_type);
				
				##################### insert all the sign up info into revshare ##########
                $instData = array();	
				$instData["referarID"] = $viewData["parentID"];//$userFormDetail[0]['referarID'];	
				$instData['firstName'] = trim($this->input->post('name'));
				$instData['lastName'] = trim($this->input->post('surname'));
				$instData['phone'] = trim($this->input->post('cellno'));
				$instData['emailID'] = trim($this->input->post('emailAddr'));
				$instData['city'] = 3;//trim($this->input->post('city'));
				$instData['currency'] = $this->gatewaymodel->getCurrency(trim($viewData['city']));// get currency by city Added by SB on 07/08/2015
				$instData['skypeID'] = trim($this->input->post('skypeID'));
				$instData['userType'] = $this->sign_up_user_type;
				$instData['password'] = trim($this->input->post('password'));	// added by SB on 23/06/2016		
				$instData["afrooPaymentStatus"] = 1;// catalogue purchase done	as free for VIP user
				$instData["userLevel"] = 1;// userlevel 1
				$instData['forWebsite'] = $this->forWebsite;
				$instData['parentId'] = $this->gatewaymodel->getParentId();
				$instData['raveType'] = $generalUserType;
				$instData['confirmStatus'] = '1';
				$instData['confirmedOn'] = date("Y-m-d h:i:s");
				$tbl = 'rave_userinfo';	
				
				$raveSignUpId = $this->common_model->insertDataToTable_for_signup($tbl,$instData);
				/*echo "<pre>";
				print_r($instData);
				echo "</pre>";
				exit;*/
			
				
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

					$this->userActivate();
				}
				else{
						$viewData['msgType'] = 2; //1=su;2=fa
						$viewData['msg'] = 'Please try again.';
					}

			    ####################   End of revshare entry by subhendu ############################	

			    $viewData = $this->resetValueAfterSuccess();
				$viewData['msgType'] = 1; //1=su;2=fa
				$viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
	 
			} else {
				$viewData['msgType'] = 2; //1=su;2=fa
				$viewData['msg'] = 'Please check the error(s) as below.';
			}

			
			
		}
		

		$viewData['cityArray'] = $this->city;
		$viewData['videoPath'] = $this->videoPath;
		$viewData['ogUrl'] =$this->createUrl();

		$this->load->view('signup/commonSignUp', $viewData);
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
						
						//$this->sendEmailToVipUser($instData, 'Welcome To Community Treasures User Group');
						
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
		 	echo "<br>Cycle 2 Data:<pre>";
		 	print_r($insData);
		 	echo "</pre>";
		 	//exit;
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
			 /*echo "<pre>";
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
				echo "<br/><b>commMemberList: Level ==> ".$level."=>cycle==>".$cycle."</b>";
				echo "<pre>";
				print_r($commMemberList);
				echo "</pre>";
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
							echo "<br/>addCommissionToTopmembernRef: ";
							echo "<pre>";
							print_r($comAddedToTopMem);
							echo "</pre>";
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
									echo "<br/>getMyReferer: ";
				echo "<pre>";
				print_r($refererUserDetail);
				echo "</pre>";
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

	
}

?>













