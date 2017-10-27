<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends CI_Controller {
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
	public $imageStatus;
	
    public function __construct() {
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
		$this->load->model('events');
		$this->city = $this->gatewaymodel->getCity();
    }
	
    public function index() {
       $this->add();
    }
	
	public function add(){
		$viewData = array();
		$viewData['msg'] = '';
		$viewData['status'] = '';
		
		if($this->input->post('submit') != ''){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
            $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required'); 
			$this->form_validation->set_rules('end_date', 'End Date', 'trim|required'); 
			//$this->form_validation->set_rules('location', 'Location', 'trim|required');
			$this->form_validation->set_rules('desc', 'Description', 'trim|required');
            $inData['name'] = trim($this->input->post('name'));
            $inData['contact_number'] = trim($this->input->post('contact_number'));
            $inData['start_date'] = trim($this->input->post('start_date'));
            $inData['end_date'] = trim($this->input->post('end_date'));
            //$inData['location'] = trim($this->input->post('location'));
            $inData['desc'] = $this->input->post('desc');
			$inData['userId'] = $this->userId;
			$imgData = $this->uploadImage(1);
			
			if($imgData['status'] == 3){
				$inData['image_path'] = $imgData['image_path'];
			}else{
				$this->imageStatus = $imgData['status'];
				$this->form_validation->set_rules('image_path', 'Image', 'trim|callback_checkImage');
			}
			
			$pdfData = $this->uploadPdf(1);
			if($pdfData['status'] == 3){
				$inData['pdf'] = $pdfData['pdf'];
			}else{
				$this->imageStatus = $pdfData['status'];
				$this->form_validation->set_rules('pdf', 'PDF', 'trim|callback_checkPdf');
			}
			
			if ($this->form_validation->run() != FALSE) {
				$tbl = "gbe_event";
        		$this->common_model->insertDataToTable($tbl, $inData);
				$viewData['msg'] = 'You have successfully added the event details.';
				$viewData['status'] = 'success';
			}else{
				$viewData['msg'] = 'Please check the error(s) as below.';
				$viewData['status'] = 'error';
			}
		}
		
		if($this->referarId == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        }else{
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->referarId);
        }
		$viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->userId);
		$viewData["countryList"] = $this->gatewaymodel->getCountryList();
		$this->load->view('event/add',$viewData);	
	}
	
	public function edit($eventId){
		$viewData = array();
		$viewData['msg'] = '';
		$viewData['status'] = '';
		
		if($this->input->post('submit') != ''){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required');
            $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required'); 
			$this->form_validation->set_rules('end_date', 'End Date', 'trim|required'); 
			$this->form_validation->set_rules('location', 'Location', 'trim|required');
			$this->form_validation->set_rules('desc', 'Description', 'trim|required');
            $inData['name'] = trim($this->input->post('name'));
            $inData['contact_number'] = trim($this->input->post('contact_number'));
            $inData['start_date'] = trim($this->input->post('start_date'));
            $inData['end_date'] = trim($this->input->post('end_date'));
            $inData['location'] = trim($this->input->post('location'));
            $inData['desc'] = $this->input->post('desc');
			$inData['userId'] = $this->userId;
			$imgData = $this->uploadImage(2);
			
			if($imgData['status'] == 3){
				$inData['image_path'] = $imgData['image_path'];
			}elseif($imgData['status'] == 2 || $imgData['status'] == 4){
				$this->imageStatus = $imgData['status'];
				$this->form_validation->set_rules('image_path', 'Image', 'trim|callback_checkImage');
			}
			$pdfData = $this->uploadPdf(2);
			if($pdfData['status'] == 3){
				$inData['pdf'] = $pdfData['pdf'];
			}elseif($pdfData['status'] == 2 || $pdfData['status'] == 4){
				$this->imageStatus = $pdfData['status'];
				$this->form_validation->set_rules('pdf', 'PDF', 'trim|callback_checkPdf');
			}
			
			if ($this->form_validation->run() != FALSE) {
				$tbl = "gbe_event";
				$where['id'] = $eventId;
        		$this->common_model->updateDataToTable($tbl, $where, $inData);
				$viewData['msg'] = 'You have successfully updated the event details.';
				$viewData['status'] = 'success';
			}else{
				$viewData['msg'] = 'Please check the error(s) as below.';
				$viewData['status'] = 'error';
			}
		}
		
		
		if($this->referarId == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        }else{
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->referarId);
        }
		$viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->userId);
		$viewData["eventDetails"] = $this->events->getEventDetails($eventId);
		$this->load->view('event/edit',$viewData);
	}
	
	public function view($eventId){
		$viewData = array();
		if($this->referarId == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        }else{
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->referarId);
        }
		$viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->userId);
		$viewData["eventDetails"] = $this->events->getEventDetails($eventId);
		$viewData['userId'] = $this->userId;
		$this->load->view('event/view',$viewData);
	}
	
	public function uploadImage($type = 1){
		$retData['status'] = 1;
		$retData['image_path'] = '';
		if ($_FILES['image_path']['name'] != "") {
			$allowedExts = array("jpg","png","jpeg");
			$temp = explode(".", $_FILES["image_path"]["name"]);
			$extension = strtolower(end($temp));
			
			if($_FILES["image_path"]["size"] > 20000000){
				$retData['status'] = 2;
			}elseif(!in_array($extension, $allowedExts)){
				$retData['status'] = 4;
			}elseif(($_FILES["image_path"]["size"] < 20000000) && in_array($extension, $allowedExts)){
				
				$_FILES["image_path"]["name"] = 'event-image-'.$this->userId.'-'.time() . "." . $extension;
				
				if ($_FILES["image_path"]["error"] > 0) {
					$retData['status'] = 2;
				}else{
					
					$path = $this->common_model->imageUnlinkPath()."useruploads/events/";
					move_uploaded_file($_FILES["image_path"]["tmp_name"], $path.$_FILES["image_path"]["name"]);
					$retData['image_path'] = $_FILES["image_path"]["name"];
					
					if($type == 2){
						$tempImg1 = trim($this->input->post('tempImage'));
						if(file_exists($path.$tempImg1)){
							unlink($path.$tempImg1);
						}
					}
					$retData['status'] = 3;
				}
			
			}
		}
		return $retData;
	}
	
	public function uploadPdf($type = 1){
		$retData['status'] = 1;
		$retData['pdf'] = '';
		if ($_FILES['pdf']['name'] != "") {
			$allowedExts = array("pdf");
			$temp = explode(".", $_FILES["pdf"]["name"]);
			$extension = strtolower(end($temp));
			if (($_FILES["pdf"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
				
				$_FILES["pdf"]["name"] = 'event-pdf-'.$this->userId.'-'.time() . "." . $extension;
				
				if ($_FILES["pdf"]["error"] > 0) {
					$retData['status'] = 2;
				}else{
					
					$path = $this->common_model->imageUnlinkPath()."useruploads/events/";
					move_uploaded_file($_FILES["pdf"]["tmp_name"], $path.$_FILES["pdf"]["name"]);
					$retData['pdf'] = $_FILES["pdf"]["name"];
					
					if($type == 2){
						$tempImg1 = trim($this->input->post('tempPdf'));
						if(file_exists($path.$tempImg1)){
							unlink($path.$tempImg1);
						}
					}
					$retData['status'] = 3;
				}
			}else{
				$retData['status'] = 2;
			}
		}
		return $retData;
	}
	
	public function checkImage(){
		if($this->imageStatus == 2){
			$this->form_validation->set_message('checkImage', 'The Image size must < 2MB.');
			return false;
		}elseif($this->imageStatus == 4){
			$this->form_validation->set_message('checkImage', 'The Image type should be jpg,png or jpeg.');
			return false;
		}else{
			return true;	
		}
		/*if($this->imageStatus == 1){
			$this->form_validation->set_message('checkImage', 'The Image field is required.');
			return false;
		}else*/
	}
	
	public function checkPdf(){
		if($this->imageStatus == 2){
			$this->form_validation->set_message('checkPdf', 'The Pdf size must < 2MB.');
			return false;
		}elseif($this->imageStatus == 4){
			$this->form_validation->set_message('checkPdf', 'The file type should be pdf.');
			return false;
		}else{
			return true;	
		}
		/*if($this->imageStatus == 1){
			$this->form_validation->set_message('checkImage', 'The Pdf field is required.');
			return false;
		}else*/
	}
	
	public function send_mail_raw() {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
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
	
	public function insertMssDetails($userLevel,$toUserId,$message){
		$tbl = "gbe_mass_details";
        $data['user_id'] = $this->userId;
        $data['user_level'] = $userLevel;
		$data['to_user_id'] = $toUserId;
        $data['message'] = $message;
		$data['created_date'] = date('Y-m-d H:i:s');
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
	}
	
	public function getCity(){
		$country_id = trim($this->input->post('c_id'));
		$cityList = $this->gatewaymodel->getCityListByCountryId($country_id);
		$retData = '<option value="">Select One </option>';
		
		if(count($cityList) > 0){ 
           foreach($cityList as $cl){
			   $retData .= ' <option value="'.$cl['id'].'">'. $cl['city'].'</option>';
		   }
		}
		
		$data['result'] = $retData;
		echo json_encode($data);
	}
	
	public function getZipCode(){
		$city_id = trim($this->input->post('c_id'));
		$cityList = $this->gatewaymodel->getZipListByCityId($city_id);
		$retData = '<option value="">Select One</option>';
		
		if(count($cityList) > 0){ 
           foreach($cityList as $cl){
			   $retData .= ' <option value="'.$cl['id'].'">'. $cl['zip_code'].'</option>';
		   }
		}
		
		$data['result'] = $retData;
		echo json_encode($data);
	}
	
	public function addNewZip(){
		$city_id = trim($this->input->post('cityId'));
		$newZipCode = trim($this->input->post('newZipCode'));
		$checkExist = $this->gatewaymodel->checkZipExist($city_id,$newZipCode);
		if($checkExist){
			$tbl = "zip_code";
			$inData['zip_code'] = $newZipCode;
			$inData['city_id'] = $city_id;
			$inData['added_by'] = $this->userId;
			$inData['created_date'] = date('Y-m-d H:i:s');
			$zipId = $this->common_model->insertDataToTable($tbl, $inData);
			if($zipId){
				$zipArr = $this->gatewaymodel->getZipListByCityId($city_id);
				$zipList.='<option value="" >Select One </option>';
				foreach($zipArr as $zipVal){
					$selected = '';
					if($zipId == $zipVal['id']){
						$selected = 'selected="selected"';
					}
					$zipList.= '<option value="'.$zipVal['id'].'" '.$selected.'>'.$zipVal['zip_code'].'</option>';
				}
				$retData = array("success" => "yes","zipList"=>$zipList);
			}
		}else{
			$retData = array("success" => "no","message"=>'Zip name already exist in database');
		}
		
		$res = json_encode($retData);
		echo $res;
	}
	
}
