<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Task extends CI_Controller {
    private $_from_email;
    private $_from_name;
    private $_admin_email;
    private $_to_email;
    private $_subject;
    private $_message;    
	public $userId;
	
	
    public function __construct() {
        parent::__construct();
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
		$this->userId = trim($this->session->userdata('userId'));
		$this->referarId = trim($this->session->userdata('referarId'));
		$this->userType = trim($this->session->userdata('userType'));
        $this->_from_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
		$this->load->model('gatewaymodel');		
		$this->forWebsite = "2";
    }
	
    public function index() {
       $viewData = array();
		if($this->referarId == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
			//print_r($viewData["parentInfo"]);exit;
        }else{
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->referarId);
        }
		$viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->userId);		
		$viewData['userId'] = $this->userId;
		$viewData["accessPermission"] = 2;
		//print_r($viewData);exit;
		$emailID  = $this->session->userdata['emailId'];
        $userPositionDetails = $this->gatewaymodel->getUserLevelPositionByEmailId($emailID);
        $viewData['userPositionArray'] = $userPositionDetails;
		$this->load->view('ads/taskView',$viewData);
    }
	
	
	
}
