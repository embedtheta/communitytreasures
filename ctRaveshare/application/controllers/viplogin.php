<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Viplogin extends CI_Controller {
	private $_from_email;
	private $_from_name;
    private $_admin_email;
    private $_to_email;
    private $_subject;
    private $_message;
    public $city;
	public $_forWebsite;

    function __construct() {
        parent::__construct();
        $this->_from_email = "noreply@communitytreasures.co";
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
        //$this->load->model('gatewaymodel');
        $this->load->model('message_model');
        $this->_forWebsite = 2;
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
            $ustatus = $this->message_model->isMemberExist($parentID);
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
       $viewData['pageDetails'] = "";//$this->_getSignupPageDetails();
			
        $this->load->view('gateway/vipLogin', $viewData);
    }
    public function login() 
      {
       $viewData = array();
        $viewData['errorMsg'] = "";
        $viewData["styleStatus"] = "none";
		$viewData["styleStatus1"] = "none";
        if ($this->input->post('logIN')) {
			
            if ($this->input->post('emailID') != "" && trim($this->input->post('password')) != "") {
				
                $userDetails = $this->message_model->chkUserAuth($this->input->post('emailID'), $this->input->post('password'));
                if (!empty($userDetails)) {
					 if($userDetails["status"]==0){
						 
						$viewData['errorMsg'] = "Your account is not Active.";
						$viewData["styleStatus"] = "block";
					 }
					 else{
						 
						  $this->session->set_userdata('userId', $userDetails["uID"]);
						  $this->session->set_userdata('referarId', $userDetails["referarID"]);
						  $this->session->set_userdata('emailId', $userDetails["emailID"]);
						  $this->session->set_userdata('userName', $userDetails["userName"]);                   
						  $this->session->set_userdata('userType', $userDetails["userType"]);
						  $this->session->set_userdata('forWebsite', $this->_forWebsite);
						//$this->_addLoginData(); // user login data stored added by SB on 10-12-2015
					/*	if($userDetails["userType"]=='PAYING USER'){

								$this->addToSubcription();

						} */ // unblock this when required
						if($userDetails[userType]=="ADMIN" || $userDetails[forWebsite]==$this->_forWebsite)
						{
						//print_r($this->_forWebsite);exit;                  	 
						  
							if(trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 1 && $userDetails["userType"]=='VOLUNTEERS' && $userDetails["mssLevelUpPayment"] == 0){
								 $this->session->set_userdata('mssPayStatus', $userDetails["mssLevelUpPayment"]);
								 redirect(base_url() . 'message', 'refresh');
							}
							else if(trim($this->session->userdata('userId')) != "" && $userDetails["userType"]=='ADMIN' && $userDetails["mssLevelUpPayment"] == 0){
								 $this->session->set_userdata('mssPayStatus', $userDetails["mssLevelUpPayment"]);
								 redirect(base_url() . 'message', 'refresh');
							}else{
								$this->session->set_userdata('mssPayStatus', $userDetails["mssLevelUpPayment"]);
								 redirect(base_url() . 'message', 'refresh');
							}
						/*	elseif(trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 2 && $userDetails["userType"]=='VOLUNTEERS' && $userDetails["mssLevelUpPayment"] == 1){
								 $this->session->set_userdata('mssPayStatus', $userDetails["mssLevelUpPayment"]);//29/10/2015 ujjwal sana added
								 redirect(base_url() . 'catalogue', 'refresh');
							}
						  elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 0) { 
							redirect(base_url() . 'dashboard', 'refresh');
						  }elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 1) { 
							redirect(base_url() . 'fullmembers', 'refresh');
						  }elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 2) { 
							redirect(base_url() . 'divercity', 'refresh');
						  }elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 3) { 
						
							redirect(base_url() . 'corporation', 'refresh');
						  }elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 4) { 
							redirect(base_url() . 'summit', 'refresh');
						  }elseif (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 5) { 
							redirect(base_url() . 'dashboard/', 'refresh');	
						  }*/
						}
						else{
						$viewData['errorMsg'] = "Please enter correct email or password.";
						$viewData["styleStatus"] = "block";
						} 
				    }
                }else{
                    $viewData['errorMsg'] = "Please enter correct email or password.";
                    $viewData["styleStatus"] = "block";
                } 
            }
        }
        $viewData['pageDetails'] = "";//$this->_getSignupPageDetails();
        $this->load->view('gateway/vipLogin', $viewData);
    } 
  public function logout() {
		//$this->_updateLoginData();
        $redirect = base_url() . 'viplogin/';
        $this->session->sess_destroy();
        redirect($redirect, 'refresh');
    }
}
?>