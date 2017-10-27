<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserDetail extends CI_Controller {
    function __construct() { 
        parent::__construct();
			
		$this->load->model('gatewaymodel');		
		
		$this->forWebsite = 2;
		
    }
	public function index(){
		
		$this->load->view('raveshare/retrivePassword');
	}
	
    public function retrievePassword() { 		 
		
		$emailID = trim($_POST["emailId"]);
		$userAuthDetail = $this->gatewaymodel->chkUserAuthRaveForPass($emailID);
		//print_r($userAuthDetail); exit;
		$userData ="";
		if($userAuthDetail){
			//echo $userAuthDetail['password'];
			//$userData = $userAuthDetail['firstName']."~".$userAuthDetail['lastName']."~".$userAuthDetail['emailID']."~".$userAuthDetail['password'];
			$userData = '<div>Email Id : '.$userAuthDetail['emailID'].' <br>User Name : '.$userAuthDetail['firstName'].' <br>Password : '.$userAuthDetail['password'].' <br>
						<a href="'. base_url().'" target="_blank" >Click the link to signup </a>
							</div>';
			
			$val = array("success" => "yes","userData"=>$userData);
		}
		else{
			//echo "5555";
			$val = array("success" => "No","message"=> "InCorrect Email Id.");
		}
		
		$output = json_encode($val);
		echo $output;
	}
}

?>