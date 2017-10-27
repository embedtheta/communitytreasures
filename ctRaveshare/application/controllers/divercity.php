<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Divercity extends CI_Controller {
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
		
		$viewData['myCurrPosition'] = $this->gatewaymodel->myCurrPosition($userId,$myLevel);
		$this->load->view('raveshare/divercity', $viewData);
	}
}
?>