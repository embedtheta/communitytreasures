<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ravesignup extends CI_Controller {

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
		$this->load->helper('common');
        $this->sign_up_user_type = '';
		$this->forWebsite = 2;
        //$this->city = $this->gatewaymodel->getCity();
        /* if(trim($this->session->userdata('UserId'))!=""){
          if($_REQUEST["actionLog"] == ""){
          redirect(base_url().'dashboard/', 'refresh');
          }
          } */
		  
		 
    }

    public function index($parentID = 0) { 
        $viewData['msgType'] = ''; //1=su;2=fa
        $viewData['msg'] = '';
		 $viewData["styleStatus"] = "none";
		if ($parentID == 0) {
            $parentID = 1000;
            $viewData["parentID"] = $parentID;
        } else if ($parentID > 0) {
            $ustatus = $this->gatewaymodel->isMemberExistRave($parentID);
            if ($ustatus) {
                $viewData["parentID"] = $parentID;
            } else {
                $viewData["parentID"] = 1000;
            }
        }        
			
        $this->load->view('gateway/login', $viewData);
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
        $code = "COMMUNITY" . $code;
        return $code;
    }

	private function createUrl(){
		
		$segments = $this->uri->uri_string();
		$ogUrl='';		
		//print_r($segments);
		$ogUrl= base_url().$segments;		
		return $ogUrl;
	}


	
	
}

?>













