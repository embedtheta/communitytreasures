<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AllUserList extends CI_Controller {
    function __construct() {
        parent::__construct();
			
		$this->load->model('gatewaymodel');		
		
		$this->forWebsite = 2;
		
    }
	
    public function index() { //echo $this->session->userdata('userId')."++++".$this->session->userdata('userType');
		if (!trim($this->session->userdata('userId')) || ($this->session->userdata('userType')!="ADMIN") ) {
            redirect(base_url() . 'gateway/', 'refresh');	
	        }
		$viewData= array();
		$viewData['totalUser'] = $this->gatewaymodel->getRaveAllUser(2);
		$viewData['totalActiveUser'] = $this->gatewaymodel->getRaveAllUser(1);
		$viewData['totalInactiveUser'] = $this->gatewaymodel->getRaveAllUser(0);
		$viewData['userListDetail'] = $this->gatewaymodel->getRaveAllUserDetail();
		//print_r($viewData);
		$this->load->view('raveshare/userList',$viewData);
		//unset($viewData);
	}
}

?>