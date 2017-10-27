<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catalogue extends CI_Controller {
    private $_from_email;
    private $_from_name;
    private $_admin_email;
    private $_to_email;
    private $_subject;
    private $_message;
    public $city;
	public $userId;
	public $referarId;
	public $userType;
	public $forWebsite;// added by SB on 13/10/2015
	public $mssPayStatus;//29/10/2015 us 
	
    function __construct() {
        parent::__construct();
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
		$this->userId = trim($this->session->userdata('userId'));
		$this->referarId = trim($this->session->userdata('referarId'));
		$this->userType = trim($this->session->userdata('userType'));
        $this->_from_email = "blessings.jain@globalblackenterprises.com";
        $this->_from_name = "globalblackenterprises.com";
        $this->_admin_email = "blessings.jain@globalblackenterprises.com";
		$this->load->model('gatewaymodel');
		$this->load->model('message_model');
		$this->city = $this->gatewaymodel->getCity();
		$this->forWebsite = trim($this->session->userdata('forWebsite'));// added by SB on 13/10/2015
		$this->mssPayStatus = trim($this->session->userdata('mssPayStatus'));
    }
	
    public function index() {
        $viewData = array();
		/*$viewData["tabhide"] = 0;
        $viewData["msg"] = "";
		$viewData["status"] = "";//error
        if($this->referarId == 0 || $this->referarId == '') {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1076);
        }else{
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->referarId);
        }
		if ($this->input->post('submit')) {
			$retData = $this->addMassUser();
			$viewData["msg"] = $retData["msg"];
			$viewData["status"] = $retData["status"];
        	$viewData["type"] = 'MASS';
		}
		$viewData['countDay'] = $this->getDayDiff();
        $viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->userId);
		$viewData["massDetails"] = $this->makingMassView();//$this->message_model->getAllMassUser($this->userId,$this->userType);
		$viewData['massLoginUserDetails'] = $this->message_model->getUserDetails($this->userId);
		$viewData['sendMassUserCount'] = 0;
		$viewData['sendMassUserLevel'] = 0;
		$viewData['totalUserUnderMassUser'] = 0;
		// fetch page text of user added by SB on 13/10/2015
		$tbl = "gbe_page_text_for_user";
		$where = array("user_id" => trim($this->userId));
		$selectedData = 'page_text';
		$pageTextDetail = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		unset($tbl);		
		$viewData['page_text'] = $pageTextDetail[0]->page_text;
		if($this->userType != "ADMIN"){
			$totalMassCount = $this->message_model->getTotalMassUser($this->userId,$viewData["userInfo"][0]['userLevel']);
			if($totalMassCount == 12){
				$viewData['sendMassUserCount'] = 1;	
			}
			$viewData['totalUserUnderMassUser'] = $this->message_model->totalMassCountUnderUser($this->userId);
			if($viewData["userInfo"][0]['userLevel'] == 1 && $viewData['totalUserUnderMassUser'] >= 12){
				$tbl = 'userinfo';
				$upData['userLevel'] = 2;
				$where = array("uID"=>$this->userId);
				$this->common_model->updateDataToTable($tbl, $where, $upData);
			}
			$smul = $this->message_model->getMassUserLevel($this->userId);
			if($smul[0]->l1 != ''){
				$viewData['sendMassUserLevel'] = 1;
			}
		}
		$viewData['mssPayStatus']=$this->mssPayStatus;//29/10/2015 us added
		$viewData['userType'] = $this->userType;
		$viewData['city'] = $this->city;*/
		$tbl = 'userinfo';
				//$upData['userLevel'] = 2;
				$upData['mssLevelUpPayment'] = 1;
				$where = array("uID"=>$this->userId);
				$this->common_model->updateDataToTable($tbl, $where, $upData);
		//$viewData["afroProduct"] = $this->gatewaymodel->getAfroProduct();//29/10/2015 added ujjwal sana
		//$viewData["stepWiseVideo"] = $this->gatewaymodel->getLevelStepVideo(1);
       	//$this->load->view('catalogue/index',$viewData);
		echo redirect(base_url() . 'dashboard/', 'refresh');	
		//unset($viewData);
    }
	
	
	

	
	
	
	
}
