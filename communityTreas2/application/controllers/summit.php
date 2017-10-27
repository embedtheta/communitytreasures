<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Summit extends CI_Controller {
    private $_from_email;
    private $_from_name;
    private $_admin_email;
    private $_to_email;
    private $_subject;
    private $_message;
    public $city;
    function __construct() {
        parent::__construct();
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
        $this->_from_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
		$this->load->model('gatewaymodel');
    }
    public function index() {
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
        $viewData = array();
		
		$viewData["tabhide"] = 0;
		
        $viewData["msg"] = "";
        if ($this->session->userdata('referarId') == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        } else {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('referarId'));
        }
        if(in_array($this->session->userdata('userType'),array("TEACHER","ADMIN","HEAD VOLUNTEERS"))){
            $viewData["allUser"] = $this->gatewaymodel->allMember();
        }else{
            $viewData["allUser"] = array();
        }
        
        $viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
       	$this->load->view('summit/index',$viewData);
    }
}
