<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Myaccount extends CI_Controller {
    private $_admin_email ;
    private $paypal_active = 2; //1=live;2=sandbox
	private $_from_email;//22/12/2015 new aded us
    private $_from_name;
	private $_to_email;
	private $_subject;
    private $_message;
	//private $this->forWebsite = 2;
    private $paypal_action = '';
    private $paypal_email = '';
    function __construct() {
        parent::__construct();
        $this->load->model('gatewaymodel');        
		$this->load->model('common_model');       
		$this->_from_email = "blessings.jain@globalblackenterprises.com";//22/12/2015 new added us
        $this->_from_name = "globalblackenterprises.com";
        $this->_admin_email = "ujjwal.sana92@gmail.com";//"blessings.jain@globalblackenterprises.com";
		$this->forWebsite = 2;
        }
    public function index() { 
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');	
	        }
			
        $viewData = array();
		$userId = $this->session->userdata('userId');
		$viewData["userInfo"] = $this->gatewaymodel->getUserInfoRave($userId);
		//print_r($viewData["userInfo"]);
		$viewData['currSymbol'] ='$';
		$myLevel = $viewData["userInfo"][0]['userLevel'];
		$this->session->set_userdata('raveType', $viewData["userInfo"][0]['raveType']);
		
		if($this->session->userdata('raveType')=="Active"){
			if($myLevel==1){
				$activeCom=4;
				$founderCom=0;
				
			}
			else if($myLevel==2){
				$activeCom=4.7;
				$founderCom=0;
				
			}
			else if($myLevel==3){
				$activeCom=9.38;
				$founderCom=0;
				
			}
			else if($myLevel==4){
				$activeCom=18.75;
				$founderCom=0;
				
			}
			else if($myLevel==5){
				$activeCom=37.50;
				$founderCom=0;
				
			}
		}else{
			if($myLevel==1){
				$activeCom=4;
				$founderCom=1.88;
				
			}
			else if($myLevel==2){
				$activeCom=4.7;
				$founderCom=3.13;
				
			}
			else if($myLevel==3){
				$activeCom=9.38;
				$founderCom=6.25;
				
			}
			else if($myLevel==4){
				$activeCom=18.75;
				$founderCom=9.38;
				
			}
			else if($myLevel==5){
				$activeCom=37.50;
				$founderCom=15.63;
				
			}			
		}
		
		$viewData['perCommAmt'] = $activeCom;// Active User commission Amount for other Cycle	
		$viewData['founderCom']	= $founderCom;
		
		$viewData["allAccountDetail"] = $this->gatewaymodel->myAccountDetail($userId,$myLevel);
		$viewData['myCurrPosition'] = $this->gatewaymodel->myCurrPosition($userId,$myLevel);
		if($myLevel==1){
			$viewData['catPurDueUser'] = $this->gatewaymodel->getUserNotPurchaseCatalog();
		}
		else if($myLevel==2){
			$currPosition=160;// 160
			$viewData['moveUpUser'] = $this->gatewaymodel->getMoveUpUser($currPosition,1);// user eligible to move up to level 2
			//print_r($viewData['moveUpUser']);	
		}
		else if($myLevel==3 || $myLevel==4 || $myLevel==5){
			$currPosition=320;// 320
			$eligibleLevel = $myLevel-1;
			$viewData['moveUpUser'] = $this->gatewaymodel->getMoveUpUser($currPosition,$eligibleLevel);// user eligible to move up to level 3/4
			//print_r($viewData['moveUpUser']);	
		}			
			
		
		//$viewData['myReferalCommDetail'] = $this->gatewaymodel->getRefererCommDetail($userId,$myLevel);
		$viewData['MyReferrals'] = $this->gatewaymodel->getMyReferrals($userId);// referrals member count
		$viewData['myReferalTotal'] = $this->gatewaymodel->referralSum($userId,$myLevel);
		$viewData['myReferalCommDetail'] = $this->gatewaymodel->getReferralDetail($userId,$myLevel);
		//print_r($viewData["allAccountDetail"]);
		$this->load->view('raveshare/mywallet', $viewData);
	}
}
?>