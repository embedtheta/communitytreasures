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

    function __construct() {
        parent::__construct();
        $this->_from_email = "blessings.jain@globalblackenterprises.com";
        $this->_from_name = "globalblackenterprises.com";
        $this->_admin_email = "blessings.jain@globalblackenterprises.com";
        $this->load->model('gatewaymodel');
        $this->city = $this->gatewaymodel->getCity();
        
    }

    public function index($parentID = 0) {
        $viewData = array();
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
        $viewData["styleStatus"] = "none";
		$viewData["styleStatus1"] = "none";
		$msg = $this->session->flashdata('msg');
        if (isset($msg)) {
			if($msg != "" && $msg == 'success'){
            	//$viewData["msg"] = "Signup request has been sent to your email.";
				$viewData["msg"] = '<div class="signupMsg"><p><strong>Welcome <br>You Have Been Sent Access To Your GBE Account. Please Go To Your Email & Follow The Instructions.</strong></p><p class="redP">If you cannot see the email, please check your spam folder Thank You.</p></div>';// changed by SB on 15/09/2015
			}elseif($msg != "" && $msg == 'error'){
				$name = $this->session->flashdata('errNameMsg');
				$email = $this->session->flashdata('errEmailMsg');
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
    
    private function _getSignupPageDetails(){
        $tbl = "gbe_signup_page_details";
        $where = array('id'=>1);
        $selectedData = "";
        $list = $this->common_model->fetchDataFromTable($tbl,$where,$selectedData);
        return $list[0];
    }

    public function login() {
        
        $viewData = array();
        $viewData['errorMsg'] = "";
        $viewData["styleStatus"] = "none";
		$viewData["styleStatus1"] = "none";
        if ($this->input->post('logIN')) {
            if ($this->input->post('emailID') != "" && trim($this->input->post('password')) != "") {
                $userDetails = $this->gatewaymodel->chkUserAuth($this->input->post('emailID'), $this->input->post('password'));
                if (!empty($userDetails)) {
					
					//echo base_url()."===<br>";
						//print_r($userDetails);
						$this->session->set_userdata('userId', $userDetails["uID"]);
						$this->session->set_userdata('referarId', $userDetails["referarID"]);
						$this->session->set_userdata('emailId', $userDetails["emailID"]);
						$this->session->set_userdata('userName', $userDetails["userName"]);
						//$this->session->set_userdata('PaypalAC', $userDetails["paypalAC"]);
						//$this->session->set_userdata('Profile', $userDetails["profile"]);
						//$this->session->set_userdata('SwitchOnPayment', $userDetails["switchOnPayment"]);
						//$this->session->set_userdata('TenDollerPayment', $userDetails["tenDollerPayment"]);
						//$this->session->set_userdata('MembershipStatus', $userDetails["membershipStatus"]);
						//$this->session->set_userdata('MembershipStatus', 'BlackSociety');
						$this->session->set_userdata('userType', $userDetails["userType"]);
						//$this->session->set_userdata('userLevel', $userDetails["userLevel"]);
						$this->session->set_userdata('forWebsite', $userDetails["forWebsite"]);// added by SB on 04/09/2015
					// check user status 
					if($userDetails["status"]==1)
					{
						
						/* Added by RD 16-03-2015*/
						$this->_addLoginData();
						if($userDetails["userType"]=='PAYING USER'){
							$this->addToSubcription();
						}
						if (trim($this->session->userdata('userId')) != "" && $userDetails["userLevel"] == 0) { 
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
						}
					}
					else if($userDetails["status"]==2 && $userDetails["userType"]=='PAYING USER'){
						if (trim($this->session->userdata('userId')) != "") { 
							redirect(base_url() . 'currentaccount/topUp', 'refresh');
						}	
					}
					else{
						$viewData['errorMsg'] = "Your Account is not active";
                       $viewData["styleStatus"] = "block";
					}
                }else{
                    $viewData['errorMsg'] = "Please enter correct email or password.";
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

    public function logout() {
		$this->_updateLoginData();
        $redirect = base_url() . 'gateway/';
        $this->session->sess_destroy();
        redirect($redirect, 'refresh');
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
			if ($this->form_validation->run() != FALSE) {
				//$signupId = $this->gatewaymodel->insertData($viewData);
               // $this->insertGeneralUserType($signupId,$generalUserType);
				$this->sendEmailToUser($viewData);
				$this->sendEmailToAdmin($viewData);
				$msg = "success";
			}else{
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
        $this->_subject = "New General user Signup of GBE";
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Admin,</td></tr>
								<tr><td colspan="2">Here is a new Sign up for general user details.</td></tr>
								<!--<tr><td width="25%">Name:</td><td width="75%">' . $data['name'] . '</td></tr>-->
                                
								
								
								<tr><td width="25%">Email :</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
								
                                                                   
								
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">globalblackenterprises.com</td></tr>
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
        $this->_subject = 'Sign up confirmation mail';
        $this->_message = '<html><body><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial; font-weight:400; text-align:justify; color:#000;" align="center">
  <tbody>
    <tr>
      <td style="font-size:12px; font-weight:bold;padding-bottom: 1%;">GBE LAUNCHING IN LONDON</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">Thank you for signing up.<br/>
		  You have now been added to the GBE prospects list.</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:bold;  padding-bottom: 1%;">What is GBE?</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">It&acute;s impossible to say what GBE is in one single word but to best describe it, is to understand its function.</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:400;  padding-bottom: 1%;">In short, GBE means Global Black Enterprises.</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">This global movement is the glue uniting thousands, in a pledge to make our communities Safer and<br/> healthier while &acute; we move as one &acute; to make ourselves wealthier.</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">Our programs are designed to boost black owned businesses, entrepreneurs, mentors and services.<br/>
We provide a global platform to give vital exposure for our talented people, fashion and creative arts.<br/>
Using Our Online system GBE members can create personal wealth and dramatically raise their income.
</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:400;  padding-bottom: 1%;">Our Mindset is NOT ABOUT HATRED or discrimination. we mutually respect all people of<br/> all races.</td>
    </tr>
    <tr>
      <td style="font-size:10px;  padding-bottom: 1%;">GBE Is about coming together,  moving as one to help put an end to poverty in African<br/> 
Taking actions to finally raise the standards for black people in the western world and throughout the entire<br/> African diaspora. 
</td>
    </tr>
    <tr>
      <td style="font-size:12px; font-weight:bold;  padding-bottom: 1%;">On Friday February 27th <span style="font-weight:400;">2015</span></td>
    </tr>
    <tr>
      <td style="font-size:14px; font-weight:400;  padding-bottom: 1%;">GBE online will be open for prospects.</td>
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
      <td style="font-size:12px; font-weight:bold;  padding-bottom: 1%;">We Are GBE</td>
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
					//print_r($userDetails);
					$viewData["emailID"] = $userDetails["emailID"];//'senabi.test01@gmail.com';
					$viewData["password"] = $userDetails["password"];
					$this->forgetPasswordMailToUser($viewData);
					
                    $viewData["succMsg"] = "Password sent Successfully";
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
      <td style="font-size:10px;  padding-bottom: 1%;">Thank You, <br> GBE Team</td>
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
