<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class GateWay extends CI_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('gatewaymodel');
		if(trim($this->session->userdata('UserId'))!=""){
			if($_REQUEST["actionLog"] == ""){
				redirect(base_url().'dashboard/', 'refresh');
			}
		}
	}	
	
	public function index(){
		$viewData									= array();
		$viewData["styleStatus"]                    = "none";
		if(isset($_REQUEST["msg"])){
			$viewData["msg"]                        = "Signup request has been sent to your email";
		}
		$this->load->view('gateway/login',$viewData);
	}
	
	public function login(){
		$viewData									= array();
		$viewData["styleStatus"]                    = "none";
		if( $this->input->post('logIN') ){
			if($this->input->post('emailID')!="" && $this->input->post('password')!=""){
				$userDetails					    = $this->gatewaymodel->chkUserAuth($this->input->post('emailID'),$this->input->post('password'));
				//$prePhaseUserDetails = $this->gatewaymodel->chkPrePhaseUserAuth($this->input->post('emailID'),$this->input->post('password'));
				if( !empty($userDetails) ){
					$this->session->set_userdata('UserId',$userDetails["uID"]);
					$this->session->set_userdata('ReferarID',$userDetails["referarID"]);
					$this->session->set_userdata('EmailID',$userDetails["emailID"]);
					$this->session->set_userdata('UserName',$userDetails["userName"]);
					$this->session->set_userdata('PaypalAC',$userDetails["paypalAC"]);
					$this->session->set_userdata('Profile',$userDetails["profile"]);
					$this->session->set_userdata('SwitchOnPayment',$userDetails["switchOnPayment"]);
					$this->session->set_userdata('TenDollerPayment',$userDetails["tenDollerPayment"]);
					$this->session->set_userdata('MembershipStatus',$userDetails["membershipStatus"]);
					$this->session->set_userdata('MembershipStatus','BlackSociety');
					$this->session->set_userdata('userType',$userDetails["userType"]);
					if(trim($this->session->userdata('UserId'))!=""){
						redirect(base_url().'dashboard/', 'refresh');
						//print_r($this->session->all_userdata());
					}
				/*}elseif(!empty($prePhaseUserDetails)){
					$this->session->set_userdata('UserId',$prePhaseUserDetails["id"]);
					$this->session->set_userdata('ReferarID',1000);
					$this->session->set_userdata('EmailID',$prePhaseUserDetails["email"]);
					$this->session->set_userdata('UserName',$prePhaseUserDetails["name"]);
					$this->session->set_userdata('PaypalAC','');
					$this->session->set_userdata('Profile','');
					$this->session->set_userdata('SwitchOnPayment','');
					$this->session->set_userdata('TenDollerPayment','');
					$this->session->set_userdata('MembershipStatus','BlackSociety');
					$this->session->set_userdata('loginType',2);
					$this->session->set_userdata('userType',$prePhaseUserDetails["userType"]);
					if(trim($this->session->userdata('UserId'))!=""){
						$uname  = str_replace(' ', '_', $prePhaseUserDetails["name"]);
						redirect(base_url().'dashboard/view/'.$uname, 'refresh');
						//print_r($this->session->all_userdata());
					}*/
				}else{
					$viewData['errorMsg']	        = "Invalid Username or Password";
					$viewData["styleStatus"]        = "block";
					//echo "--------------".$_SERVER['HTTP_REFERER'];	
					if( $_SERVER['HTTP_REFERER'] == "http://www.morpheussociety.com/gateway" || $_SERVER['HTTP_REFERER'] == "http://www.morpheussociety.com/" || $_SERVER['HTTP_REFERER'] =="http://www.morpheussociety.com/gateway/validationError" ){
						redirect('http://www.morpheussociety.com/gateway/validationError/', 'refresh');
					}
				}
			}
		}
		
		$this->load->view('gateway/login',$viewData);
	}
	
	
	
	public function logout(){
		if( trim($this->session->userdata('MembershipStatus'))=="BlackSociety" ){
			$redirect                               =  base_url().'gateway/';  
		}else if( trim($this->session->userdata('MembershipStatus'))=="MorpheusSociety" ){
			$redirect                               = 'http://www.morpheussociety.com/gateway/';
		}
		$this->session->sess_destroy();
		if(trim($this->session->userdata('UserId'))!=""){
			redirect(base_url().'dashboard/', 'refresh');
		}else{
			redirect($redirect, 'refresh');
		}
	}
	
	public function signup($parentID=0){
		$viewData									            = array();
		$viewData["styleStatus"]                                = "none";
		if( $parentID == 0 ){
			$parentID                                           = 1000;
			$viewData["parentID"]                               = $parentID;
		}else if( $parentID > 0 ){
			$ustatus                                            = $this->gatewaymodel->isMemberExist($parentID);
			if( $ustatus ){
				$viewData["parentID"]                           = $parentID;
			}else{
				$viewData["parentID"]                           = 1000;
			}
		}
		
		if($this->input->post('signUp')){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('firstName','First Name', 'trim|required');
			$this->form_validation->set_rules('lastName','Last Name', 'trim|required');
			$this->form_validation->set_rules('userName','User Name', 'trim|required');
			$this->form_validation->set_rules('emailID','Email Address', 'trim|required|callback_isValidEmail');
			$this->form_validation->set_rules('password','Password', 'trim|required|callback_confPassword');
			$this->form_validation->set_rules('gender','Gender', 'trim|required');
			$this->form_validation->set_rules('country','Country', 'trim|required');
			$this->form_validation->set_rules('city','Your City', 'trim|required');
			$this->form_validation->set_rules('phone','Contact Number', 'trim|required');
			$this->form_validation->set_rules('parentID','System error','trim|required');
			
			$viewData['firstName']							    = trim($this->input->post('firstName'));
			$viewData['lastName']					            = trim($this->input->post('lastName'));
			$viewData['userName']							    = trim($this->input->post('userName'));
			$viewData['emailID']							    = trim($this->input->post('emailID'));
			$viewData['password']								= trim($this->input->post('password'));
			$viewData['gender']									= trim($this->input->post('gender'));
		    $viewData['country']								= trim($this->input->post('country'));
			$viewData['city']								    = trim($this->input->post('city'));
			$viewData['phone']								    = trim($this->input->post('phone'));
			$viewData['parentID']								= trim($this->input->post('parentID'));
			$viewData['membershipStatus']					    = "BlackSociety";
			if($this->form_validation->run() != FALSE){
				$lastInsertId									= $this->gatewaymodel->insertMemberDetails($viewData);
				if($lastInsertId>0){
					unset($viewData);	
					$viewData['msg']						    = "Your data has been inserted succesfully";
					$viewData['loginUrl']                       = base_url(); 
					
				}else{
					$viewData['msg']						    = "Your data has not been inserted";
				}
			}else{
				$viewData['msg']								= "Please check the error(s) below."; 
				/*echo "<pre>";
				print_r($viewData);*/
			}
		}
		$this->load->view('signup/signup',$viewData);
	}
	
	public function membership($parentID=0){
		$viewData									= array();
		$viewData["styleStatus"]                    = "none";
		if( $parentID == 0 ){
			$parentID                               = 1000;
			$viewData["parentID"]                   = $parentID;
		}else if( $parentID > 0 ){
			$ustatus                                = $this->gatewaymodel->isMemberExist($parentID);
			if( $ustatus ){
				$viewData["parentID"]               = $parentID;
			}else{
				$viewData["parentID"]               = 1000;
			}
		}
		$this->load->view('gateway/login',$viewData);
	}
	
	public function signUpRequest(){
		$viewData									= array();
		$viewData["styleStatus"]                    = "none";
		if( $this->input->post('submit') ){
			$redirectUrl = base_url()."emailsend/mailsend.php?parentID=".$this->input->post('parentID')."&name=".$this->input->post('signUpName')."&email=".$this->input->post('signUpEmail') ;
		    redirect($redirectUrl, 'refresh');
		}
		
	}
	
	public function isValidEmail(){
		$email							            = trim($this->input->post('emailID'));
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        	$this->form_validation->set_message('isValidEmail','This is not a valid mail address.');	
			return false;
        }else{
			$isExist = $this->gatewaymodel->isMailExist($email);
			if(!$isExist){
				$this->form_validation->set_message('isValidEmail','This Email address already in use.');
			    return false;
			}else{
            	return true;
			}
        }
	}
	
	public function confPassword(){
		if( trim($this->input->post('password')) != trim($this->input->post('ConfPassword'))){
			$this->form_validation->set_message('confPassword','Password and Confirm password field values are not same');
			return false;
		}else{
			return true;
		}
	}
	
	public function cr(){
		//$this->gatewaymodel->createRoute();
	}
	
	
}
