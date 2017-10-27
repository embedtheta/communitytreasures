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
				$activeCom=7.50;
				$founderCom=0;
				
			}
			else if($myLevel==2){
				$activeCom=9.38;
				$founderCom=0;
				
			}
			else if($myLevel==3){
				$activeCom=18.75;//18.74;
				$founderCom=0;
				
			}
			else if($myLevel==4){
				$activeCom=37.5;
				$founderCom=0;
				
			}
			else if($myLevel==5){
				$activeCom=75;
				$founderCom=0;
				
			}
		}else{
			if($myLevel==1){
				$activeCom=7.50;
				$founderCom=3.75;
				
			}
			else if($myLevel==2){
				$activeCom=9.38;
				$founderCom=6.25;
				
			}
			else if($myLevel==3){
				$activeCom=18.75;//18.74;
				$founderCom=12.5;
				
			}
			else if($myLevel==4){
				$activeCom=37.5;
				$founderCom=18.75;//18.74;
				
			}
			else if($myLevel==5){
				$activeCom=75;
				$founderCom=31.25;//31.24;
				
			}			
		}
		
		$viewData['perCommAmt'] = $activeCom;// Active User commission Amount for other Cycle	
		$viewData['founderCom']	= $founderCom;
		
		$viewData["allAccountDetail"] = $this->gatewaymodel->myAccountDetail($userId,$myLevel);
		$viewData['myCurrPosition'] = $viewData["allAccountDetail"][0]['userPosition'];//$this->gatewaymodel->myCurrPosition($userId,$myLevel);
		$myCycle  = $viewData["allAccountDetail"][0]['userCycle'];
		/*if($myLevel==1){
			$viewData['catPurDueUser'] = $this->gatewaymodel->getUserNotPurchaseCatalog();
		}
		else if($myLevel==2){
			$currPosition=48;//47;// 160
			$viewData['moveUpUser'] = $this->gatewaymodel->getMoveUpUser($currPosition,1);// user eligible to move up to level 2
			//print_r($viewData['moveUpUser']);	
		}
		else if($myLevel==3 || $myLevel==4 || $myLevel==5){
			$currPosition=97;//47;// 320
			$eligibleLevel = $myLevel-1;
			$viewData['moveUpUser'] = $this->gatewaymodel->getMoveUpUser($currPosition,$eligibleLevel);// user eligible to move up to level 3/4
			//print_r($viewData['moveUpUser']);	
		}	*/		
			
		$msgTypeDetails = $this->setMessage();  
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
		
		//$viewData['myReferalCommDetail'] = $this->gatewaymodel->getRefererCommDetail($userId,$myLevel);
		$viewData['MyReferrals'] = $this->gatewaymodel->getMyReferrals($userId);// referrals member count // unblocked the code on 30/08/2016
		//$viewData['MyReferrals'] = $this->gatewaymodel->getMyReferralsNew($userId,$myLevel);// added By SB on 26/08/2016 // blocked by SB on 30/08/2016 
		$viewData['myReferalTotal'] = $this->gatewaymodel->referralSum($userId,$myLevel,$myCycle);
		$viewData['myReferalCommDetail'] = $this->gatewaymodel->getReferralDetail($userId,$myLevel,$myCycle);
		//print_r($viewData["allAccountDetail"]);
		$viewData['raveActiveUser'] = $this->gatewaymodel->getRaveAllUser(1);// active member count
		$this->load->view('raveshare/mywallet', $viewData);
	}
	
	public function setMessage(){
		
        $retData = array();
        $type = $this->session->flashdata('type');
        $status = $this->session->flashdata('status');
        $msg = $this->session->flashdata('msg');
		
		if($status == "email_missing")
		{
			 $retData["msg"] = "Please insert email id.";
			 $retData["type"] = $type;
		}
		if($status == "message_missing")
		{
			 $retData["msg"] = "Please Fill Up Message Box.";
			 $retData["type"] = $type;
		}
        if($status == "success"){
            if($type == "customer"){
                $retData["msg"] = "You have successfully submitted the message for Customer Services.";
            }elseif($type == "tech_support"){
                $retData["msg"] = "You have successfully submitted the message for Technical Support.";
            }elseif($type == "advertise"){
                $retData["msg"] = "You have successfully submitted the message for Advertisement Services.";
            }elseif($type == "country"){
                $retData["msg"] = "You have successfully updated your country name.";
            }elseif($type == "paypal"){
                $retData["msg"] = "You have successfully updated your paypal id.";
            }elseif($type == "image"){
                $retData["msg"] = "You have successfully updated your Profile picture.";
				
            }elseif($type == "pUpload"){
                $retData["msg"] = "You have successfully uploaded your Product .";
            }elseif($type == "vUpload"){
                $retData["msg"] = "You have successfully added your Vendors Details.";
            }elseif($type == "fListing"){
                $retData["msg"] = "You have successfully added your Free Listing on AFROWEBB.";
            }elseif($type == "deleteUser"){
                $retData["msg"] = "You have been successfully deleted this user.";
            }elseif($type == "inviteGmailFriend"){
                $retData["msg"] = "You have been successfully invited your Gmail's friend.";
            }elseif($type == "inviteYahooFriend"){
                $retData["msg"] = "You have been successfully invited your Yahoo's friend.";
            }elseif($type == "changePassword"){
                if($msg != ""){
                    $retData["msg"] = $msg;
                }else{
                    $retData["msg"] = "You have been successfully changed your Password.";
                }
            }elseif($type == "pUploadUpdate"){
				$retData["msg"] = "You have been successfully updated your product details.";
			}
            $retData["type"] = $type;
        }
		elseif($status == "error")
			{
             if($msg != "")
			 {
                $retData["msg"] = $msg;
           	 }
			else
			{
                $retData["msg"] = "Please try again.";
            }
            $retData["type"] = "wrong";
        }
		
        return $retData;
    }
}
?>