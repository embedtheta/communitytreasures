<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cp extends CI_Controller {
    public $dataPerPage;
	public $forWebsite; // added by SB on 13/08/2015
    function __construct() {
        parent::__construct();
		$this->load->library('image_lib');
        $this->load->model('data_model');
        $this->load->model('admin_user_model');
        $this->load->helper(array('url', 'form'));
        $this->checkLogin();
        $this->dataPerPage = 20;
		$this->forWebsite = $this->session->userdata('forWebsite');
        $this->load->library("pagination");
    }

    public function index() {
        redirect(base_url()."admin");
    }

    public function gbeLevelWiseVideoList() {
        $viewData = array();
        $viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $tbl = "gbe_level_video";
        $where = array("forWebsite"=>$this->forWebsite);// added by SB on 14/08/2015
        $selectedData = "";
        $orderBy = array("level"=>"DESC","step"=>'DESC',"serial_field"=>'ASC');
        $viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $viewData["list"] = $this->common_model->fetchDataFromTableOrderBy($tbl,$where,$selectedData,$orderBy);
		// added by SB on 14/08/2015
		if($this->forWebsite==1){
			$viewData['websiteName'] = "GBE";	
		}
		else if($this->forWebsite==2){
			$viewData['websiteName'] = "Community Treasure";	
		}
		else{
			$viewData['websiteName'] = "Rave Business";	
		}
		
		
        $this->load->view('adminTemplates/gbe_level_wise_video/view.php', $viewData);
    }
     // for ct monetizer added by SB on 03/03/2016
	public function ctLevelWiseVideoList() {
        $viewData = array();
        $viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $tbl = "ct_monetizer_level_video";
        $where = array("forWebsite"=>$this->forWebsite);// added by SB on 14/08/2015
        $selectedData = "";
        $orderBy = array("level"=>"DESC","step"=>'DESC',"serial_field"=>'ASC');
        $viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $viewData["list"] = $this->common_model->fetchDataFromTableOrderBy($tbl,$where,$selectedData,$orderBy);
		// added by SB on 14/08/2015
		if($this->forWebsite==1){
			$viewData['websiteName'] = "GBE";	
		}
		else if($this->forWebsite==2){
			$viewData['websiteName'] = "Community Treasure";	
		}
		else{
			$viewData['websiteName'] = "Rave Business";	
		}
		
		
        $this->load->view('adminTemplates/gbe_level_wise_video/ct_monetizer_view.php', $viewData);
    }
    public function gbeLevelWiseVideoEdit($id = 0){
        $viewData = array();
        $viewData["report"] = "";
        $viewData["msg"] = "";
        $where = array("id" => trim($id));
        $tbl = "gbe_level_video";
        if ($this->input->post("submit") != "") {
            $data["title"] = $this->input->post("title");
            $data["path"] = $this->input->post("path");
            $data["content_title"] = $this->input->post("content_title");
            $data["content"] = $this->input->post("content");
            $retImg = $this->uploadFreeListingImage();
            if($retImg['is_upload'] == 1){
                if($retImg['status'] == 1){
                    $data["content_image"] = $retImg['name'];
                    $selectedData = "content_image";
                    $imageD = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
					$delPath = $this->common_model->imageUnlinkPath().'adminuploads/level_wise_images/'.$imageD[0]->content_image;
					if(file_exists($delPath)){
                    	unlink($delPath);
					}
                    unset($selectedData);
                }
            }
            $data["status"] = $this->input->post("status");
            $dd = $this->common_model->updateDataToTable($tbl, $where, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully updated the data.");
                redirect(base_url() . "cp/gbeLevelWiseVideoList");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $selectedData = "";
        $viewData["list"] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
        $viewData["val"] = $viewData["list"][0];
        unset($viewData["list"]);
        $this->load->view('adminTemplates/gbe_level_wise_video/edit.php', $viewData);
    }
    // ct monetizer video edit 
	 public function ctLevelWiseVideoEdit($id = 0){
        $viewData = array();
        $viewData["report"] = "";
        $viewData["msg"] = "";
        $where = array("id" => trim($id));
        $tbl = "ct_monetizer_level_video";
        if ($this->input->post("submit") != "") {
            $data["title"] = $this->input->post("title");
            $data["path"] = $this->input->post("path");
            $data["content_title"] = $this->input->post("content_title");
            $data["content"] = $this->input->post("content");
            $retImg = $this->uploadFreeListingImage();
            if($retImg['is_upload'] == 1){
                if($retImg['status'] == 1){
                    $data["content_image"] = $retImg['name'];
                    $selectedData = "content_image";
                    $imageD = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
					$delPath = $this->common_model->imageUnlinkPath().'adminuploads/level_wise_images/'.$imageD[0]->content_image;
					if(file_exists($delPath)){
                    	unlink($delPath);
					}
                    unset($selectedData);
                }
            }
            $data["status"] = $this->input->post("status");
            $dd = $this->common_model->updateDataToTable($tbl, $where, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully updated the data.");
                redirect(base_url() . "cp/ctLevelWiseVideoList");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $selectedData = "";
        $viewData["list"] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
        $viewData["val"] = $viewData["list"][0];
        unset($viewData["list"]);
        $this->load->view('adminTemplates/gbe_level_wise_video/ct_monetizer_edit.php', $viewData);
    }
    public function uploadFreeListingImage() {
        $retData['is_upload'] = 0;
        if($_FILES["content_image"]["name"] != ""){
            $path = "adminuploads/level_wise_images/";
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $_FILES["content_image"]["name"]);
            $extension = strtolower(end($temp));
            if (($_FILES["content_image"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $_FILES["content_image"]["name"] = "lwi_".time(). "." . $extension;
                $retData['is_upload'] = 1;
                if ($_FILES["content_image"]["error"] > 0) {
                    $retData['status'] = 0; //error
                    $retData['errorMsg'] = 'The image has an error' . $_FILES["content_image"]["error"]; //error
                    $retData['name'] = $_FILES["content_image"]["name"];
                } else {
                    move_uploaded_file($_FILES["content_image"]["tmp_name"], $path . $_FILES["content_image"]["name"]);
                    $retData['status'] = 1; //success
                    $retData['errorMsg'] = '';
                    $retData['name'] = $_FILES["content_image"]["name"];
                }
            }
            return $retData;
        }else{
            return $retData;
        }
    }
    
    public function allTypeUser($type = "PAYING USER") {
        $this->checkLogin();
        $viewData = array();
        $tbl = "userinfo";
        $where = array("userType"=>$type);
        $selectedData = "";
        $viewData["centoruList"] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		
        //print_r($viewData["centoruList"]);
        $this->load->view('adminTemplates/user/view.php', $viewData);
    }
    
    public function viewPayingUser() {
        $this->checkLogin();
        $viewData["userType"] = "PAYING USER";
        $viewData["selectedUserType"] = "";
        if($this->input->post("search") == "Search"){
            $viewData["selectedUserType"] = trim($this->input->post("typeUser"));
        }
        $viewData["userTypeList"] = array(""=>"All","business"=>"Business","community"=>"Community","health"=>"Health","mentorship"=>"Mentorship","talented"=>"Talented","general"=>"General");
        $base_url = base_url()."cp/viewPayingUser/";
        $total_rows = $this->admin_user_model->getTotalUser($viewData["userType"],$viewData["selectedUserType"]);// block by SB on 02/10/2015		
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        
		$viewData["userList"] = $this->admin_user_model->getUser($viewData["userType"],$viewData["selectedUserType"],$per_page,$page);      
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/user/viewPayingUser.php', $viewData);
    }
    
    public function viewTeacher() {
        $this->checkLogin();
        $viewData = array();
        $viewData["userType"] = "TEACHER";
        $base_url = base_url()."cp/viewTeacher/";
        $total_rows = $this->admin_user_model->getTotalUserOthers($viewData["userType"]);
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $viewData["userList"] = $this->admin_user_model->getUserOthers($viewData["userType"],$per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/user/viewTeacher.php', $viewData);
    }
    
    public function viewStudent() {
        $this->checkLogin();
        $viewData = array();
        $viewData["userType"] = "STUDENT";
        $base_url = base_url()."cp/viewStudent/";
        $total_rows = $this->admin_user_model->getTotalUserOthers($viewData["userType"]);
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];
	$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $viewData["userList"] = $this->admin_user_model->getUserOthers($viewData["userType"],$per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/user/viewStudent.php', $viewData);
    }
    
    public function viewHeadVolunteer() {
        //'TEACHER','PAYING USER','ADMIN','HEAD VOLUNTEERS','VOLUNTEERS','STUDENT','AFROWEBB'
        $this->checkLogin();
        $viewData = array();
        $viewData["userType"] = "HEAD VOLUNTEERS";
        $base_url = base_url()."cp/viewHeadVolunteer/";
        $total_rows = $this->admin_user_model->getTotalUserOthers($viewData["userType"]);
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];
	$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $viewData["userList"] = $this->admin_user_model->getUserOthers($viewData["userType"],$per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/user/viewHeadVolunteer.php', $viewData);
    }
    
    public function viewVolunteer() {
        $this->checkLogin();
        $viewData = array();
         $viewData["userType"] = "VOLUNTEERS";
        $base_url = base_url()."cp/viewVolunteer/";
        $total_rows = $this->admin_user_model->getTotalUserOthers($viewData["userType"]);
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];
	$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $viewData["userList"] = $this->admin_user_model->getUserOthers($viewData["userType"],$per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/user/viewVolunteer.php', $viewData);
    }

    public function getXls($type = 1) {
        //'TEACHER','PAYING USER','ADMIN','HEAD VOLUNTEERS','VOLUNTEERS','STUDENT','AFROWEBB'
        if($type == 1){
            $userType = "PAYING USER";
        }  elseif($type == 2)  {
            $userType = "TEACHER";
        }  elseif ($type == 3) {
            $userType = "STUDENT";
        }  elseif ($type == 4) {
            $userType = "HEAD VOLUNTEERS";
        }  elseif ($type == 5) {
            $userType = "VOLUNTEERS";
        }
        $viewData["centoruList"] = $this->admin_user_model->getExcelData($userType);
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment;Filename=CentoruList.xls");
        echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
        echo "<head>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        echo "<title>Untitled Document</title>";
        echo "</head>";
        echo "<body>";
        echo "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">";
        echo "<tr>";
        echo "<td><strong>Name</strong></td>";
        echo "<td><strong>Invited By</strong></td>";
        echo "<td><strong>Phone</strong></td>";
        echo "<td><strong>Email</strong></td>";
        echo "<td><strong>Skype ID</strong></td>";
        echo "<td><strong>City</strong></td>";
        echo "<td><strong>Status</strong></td>";
        echo "</tr>";
        foreach ($viewData["centoruList"] as $key => $valList) {
            echo "<tr>";
            echo "<td>" . $valList->firstName . " " . $valList->lastName . "</td>";
            echo "<td>" . $valList->fn . " " . $valList->ln . "</td>";
            echo "<td>" . $valList->phone . "</td>";
            echo "<td>" . $valList->emailID . "</td>";
            echo "<td>" . $valList->skypeID . "</td>";
            echo "<td>" . $valList->city_name . "</td>";
            echo "<td>" . (($valList->status == "1")? "Active":"Inactive") . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</body>";
        echo "</html>";
       
    }

    private function generatePassword() {
        $string = mt_rand();
        $start = 1;
        $length = 8;
        $code = substr($string, $start, $length);
        $code = "GBE" . $code;
        return $code;
    }

    function send_mail_raw($to = '', $subject = '', $message = '') {
        $from_email = "info@globalblackenterprises.com";
        $from_name = "globalblackenterprises.com";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
        $headers .= 'From: ' . $from_name . ' <' . $from_email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $from_name . ' <' . $from_email . '>' . "\r\n";
        $headers .= 'Return-Path: ' . $from_name . ' <' . $from_email . '>' . "\n";
        $send = mail($to, $subject, $message, $headers);
        if ($send) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function commonPagination($base_url = "",$total_rows = 0,$per_page = "",$uri_segment = ""){
        $this->load->library('pagination');
        $config = $this->common_model->adminCommonPagination();
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = $uri_segment;
        $config['num_links'] = 2;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
   

    function checkLogin() {
        if ($this->session->userdata("adminId") == "") {
            redirect(base_url() . "admin/");
        } else {
            return true;
        }
    }
	// Added by SB on 23-04-2015
    public function viewExpellUser() {
        $this->checkLogin();
        $viewData = array();
        $viewData["userType"] = "Expelled User";
        $base_url = base_url()."cp/viewExpellUser/";
        $total_rows = $this->admin_user_model->getTotalExpellUser();
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $viewData["userList"] = $this->admin_user_model->getExpellUser($per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/user/viewExpellUser.php', $viewData);
    }

    public function deleteExpellUser() {
        $id = trim($this->input->post('id'));
        if ($id != '') {
            
            //$eml = $this->admin_user_model->deleteExpellUser($id);
			//$tbl = 'userinfo';
            $where['uID'] = $id;
			$whereExpell['user_id'] = $id;
			$delRequstExpell = $this->data_model->deleteDataFromTable('user_expell', $whereExpell);            
			if($delRequstExpell)
			{				
				$delRequstUser = $this->data_model->deleteDataFromTable('userinfo', $where);
			}				
            if ($delRequstUser) {
                echo 1;
            } else {
                echo 21;
            }
        } else {
            echo 2;
        }
    }
    
    
    public function viewStep2UrlList(){
        $viewData = array();
        $viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $tbl = "admin_step2_b";
        $where = array();
		$where['for_website'] = $this->forWebsite;// added by SB on 16/10/2015
        $selectedData = "";
        $viewData['navMenu'] = $this->data_model->getMenusList();
        $viewData["list"] = $this->common_model->fetchDataFromTable($tbl,$where,$selectedData);
        $this->load->view('adminTemplates/gbe_level_wise_video/view_step2_b.php', $viewData);
    }
    
    public function addStep2Url(){
        $viewData['action'] = 'Add';
        $viewData['title'] = '';
        $viewData['url'] = '';
        $viewData['description'] = '';
        $tbl = "admin_step2_b";
        if ($this->input->post("submit") != "") {
            $data['title'] = trim($this->input->post('title'));
            $data['url'] = trim($this->input->post('url'));
            $data['description'] = $this->input->post('description');
            $data['user_id'] = $this->session->userdata('adminId'); 
            $data['created_date'] = date("Y-m-d H:i:s");
            $dd = $this->common_model->insertDataToTable($tbl, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully added the data.");
                redirect(base_url() . "cp/viewStep2UrlList");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $this->load->view('adminTemplates/gbe_level_wise_video/edit_step2_b.php', $viewData);
    }
    
    public function editStep2Url($id = 0){
        $viewData['action'] = 'Edit';
        $where = array("id" => trim($id));
        $tbl = "admin_step2_b";
        if ($this->input->post("submit") != "") {
            $data['title'] = trim($this->input->post('title'));
            $data['url'] = trim($this->input->post('url'));
            $data['description'] = $this->input->post('description');
            $data['user_id'] = $this->session->userdata('adminId'); 
            $data['updated_date'] = date("Y-m-d H:i:s");
            $dd = $this->common_model->updateDataToTable($tbl, $where, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully updated the data.");
                redirect(base_url() . "cp/viewStep2UrlList");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $selectedData = "";
        $list = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
        $viewData['title'] = $list[0]->title;
        $viewData['url'] = $list[0]->url;
        $viewData['description'] = $list[0]->description;
        unset($viewData["list"]);
        $this->load->view('adminTemplates/gbe_level_wise_video/edit_step2_b.php', $viewData);
    }
    
    public function deleteStep2Url($id = 0){
        $where = array("id" => trim($id));
        $tbl = "admin_step2_b";
        $dd = $this->common_model->deleteDataFromTable($tbl, $where);
        if ($dd) {
            $this->session->set_flashdata("report", 1);
            $this->session->set_flashdata("msg", "You have successfully deleted the data.");
        } else {
            $this->session->set_flashdata("report", 2);
            $this->session->set_flashdata("msg", "Please try again.");
        }
        redirect(base_url() . "cp/viewStep2UrlList");
    }
    
    public function setMessageForUser(){
        $dd["report"] = $this->session->flashdata('report');
        $dd["msg"] = $this->session->flashdata('msg');
        return $dd;
    }
    
    public function viewSignupPages(){
        $viewData = array();
        $viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $tbl = "gbe_signup_page_details";
        $where = array("forWebsite"=>$this->forWebsite);// added by SB on 19/08/2015
        $selectedData = "";
        $orderBy = array("id"=>"DESC");
        $viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $viewData["list"] = $this->common_model->fetchDataFromTableOrderBy($tbl,$where,$selectedData,$orderBy);
        $this->load->view('adminTemplates/gbe_signup_page_details/viewSignupPages.php', $viewData);
		unset($viewData);
    }
    
    public function editSignupPages($id = 0){
        $viewData = array();
        $viewData["report"] = "";
        $viewData["msg"] = "";
        $where = array("id" => trim($id));
        $tbl = "gbe_signup_page_details";
        if ($this->input->post("submit") != "") {
            $data["title"] = $this->input->post("title");
            //$data["content"] = $this->input->post("content");
            $data["video_path"] = $this->input->post("video_path");
            //$data["meta_title"] = $this->input->post("meta_title");
            //$data["meta_keywords"] = $this->input->post("meta_keywords");
            //$data["meta_description"] = $this->input->post("meta_description");
            $data["user_id"] = trim($this->session->userdata("adminId"));
            $data["updated_date"] = date("Y:m:d H:i:s");
            $dd = $this->common_model->updateDataToTable($tbl, $where, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully updated the data.");
                redirect(base_url() . "cp/viewSignupPages");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $selectedData = "";
        $list = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
        $viewData["val"] = $list[0];
        unset($list);
        $this->load->view('adminTemplates/gbe_signup_page_details/editSignupPages.php', $viewData);
        unset($viewData);
    }
	
	public function listingBlogPost(){
		$this->checkLogin();
        $base_url = base_url()."cp/listingBlogPost/";
        $total_rows = $this->data_model->getCountAllPost();
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];
		$viewData['page'] = $page;
		$viewData['navMenu'] = $this->data_model->getMenusList();
        $viewData["blogList"] = $this->data_model->getAllPost($per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/level2/blog/listingBlogPost.php', $viewData);
		unset($viewData);
	}
	
	public function viewBlogPost(){
		$this->checkLogin();
		$id = trim($this->uri->segment(3));
		$pager = trim($this->uri->segment(4));
		$viewData['page'] = $pager;
		$viewData['navMenu'] = $this->data_model->getMenusList();
		$viewData['details'] = $this->data_model->getPostById($id);
		$this->load->view('adminTemplates/level2/blog/viewBlogPost.php', $viewData);
		unset($viewData);
	}
	
	public function updateBlogPost(){
		$id = trim($this->uri->segment(3));
		$pager = trim($this->uri->segment(4));
		
		$where = array("post_id" => trim($id));
        $tbl = "gbe_blog_posts";
		$data['admin_permission'] = 1;
		$dd = $this->common_model->updateDataToTable($tbl, $where, $data);
			
		$this->session->set_flashdata("report", 1);
		$this->session->set_flashdata("msg", "You have successfully publish the Blog Post.");
		redirect(base_url() . "cp/listingBlogPost/".$pager);	
	}
	
	public function listingBrochure(){
		$this->checkLogin();
        $base_url = base_url()."cp/listingBrochure/";
        $total_rows = $this->data_model->getCountAllBrochure();
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];
		$viewData['page'] = $page;
		$viewData['navMenu'] = $this->data_model->getMenusList();
        $viewData["list"] = $this->data_model->getAllBrochure($per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/level2/brochure/listing.php', $viewData);
		unset($viewData);
	}
	
	public function addBrochure(){
		if($this->input->post('add')){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			if(empty($_FILES['cover_img']['name'])){
				$this->form_validation->set_rules('cover_img', 'Cover Image', 'required');
			}
			if(empty($_FILES['file_name']['name'])){
				$this->form_validation->set_rules('file_name', 'Brochure', 'trim|required');
			}

            if ($this->form_validation->run() != FALSE) {
				$coverImg = $this->uploadBrochureVcards($_FILES['cover_img'],'adminuploads/brochureVcards/brochure/', array("jpeg","gif", "jpg", "png"),"brochure_cover");
				$files = $this->uploadBrochureVcards($_FILES['file_name'],'adminuploads/brochureVcards/brochure/',array("jpeg", "jpg","gif", "png","pdf"),"brochure");
				if($coverImg['status'] == 1 && $files['status'] == 1){
					$inData['title'] = trim($this->input->post('title'));
					$inData['cover_img'] = $coverImg['name'];
					$inData['file_name'] = $files['name'];
					$inData['created_date'] = date('Y-m-d H:i:s');
					$tbl = "gbe_brochure_vcards";
					$this->common_model->insertDataToTable($tbl, $inData);
					$this->session->set_flashdata("report", 1);
					$this->session->set_flashdata("msg", "You have successfully added the Brochure.");
					redirect(base_url() . "cp/listingBrochure/");
				}else{
					$viewData['report'] = 2;
					if($coverImg['errorMsg'] != '' || $files['errorMsg'] != ''){
        				$viewData['msg'] = (($coverImg['errorMsg'])?(($files['errorMsg'])?$coverImg['errorMsg'].'<br>'.$files['errorMsg']:$coverImg['errorMsg']):(($files['errorMsg'])?$files['errorMsg']:''));
					}
				}
			}else{
				$viewData['report'] = 2;
        		$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$this->load->view('adminTemplates/level2/brochure/add.php', $viewData);
		unset($viewData);
	}
	
	public function editBrochure(){
		$viewData = array();
		$id = trim($this->uri->segment(3));
		$viewData['page'] = trim($this->uri->segment(4));
		$tbl = "gbe_brochure_vcards";
		$where = array("id"=>$id);
		
		if($this->input->post('add')){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			if ($this->form_validation->run() != FALSE) {
				if($_FILES['cover_img']['name'] != ""){
					$coverImg = $this->uploadBrochureVcards($_FILES['cover_img'],'adminuploads/brochureVcards/brochure/', array("jpeg","gif", "jpg", "png"),"brochure_cover");
					$inData['cover_img'] = $coverImg['name'];
					$unlinkPath = 'adminuploads/brochureVcards/brochure/'.$this->input->post('temp_cover_img');
					$this->imageUnlink($unlinkPath);
					unset($unlinkPath);
				}
				if($_FILES['file_name']['name'] != ""){
					$files = $this->uploadBrochureVcards($_FILES['file_name'],'adminuploads/brochureVcards/brochure/',array("jpeg", "jpg","gif", "png","pdf"),"brochure");
					$inData['file_name'] = $files['name'];
					$unlinkPath = 'adminuploads/brochureVcards/brochure/'.$this->input->post('temp_file_name');
					$this->imageUnlink($unlinkPath);
					unset($unlinkPath);
				}
				
				$inData['title'] = trim($this->input->post('title'));
				$inData['updated_date'] = date('Y-m-d H:i:s');
				$tbl = "gbe_brochure_vcards";
				$this->common_model->updateDataToTable($tbl, $where, $inData);
				$this->session->set_flashdata("report", 1);
				$this->session->set_flashdata("msg", "You have successfully updated the Brochure.");
				redirect(base_url() . "cp/listingBrochure/".$viewData['page']);
			}else{
				$viewData['report'] = 2;
        		$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$selectedData = "";
		$viewData['details'] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		$this->load->view('adminTemplates/level2/brochure/edit.php', $viewData);
		unset($viewData);
	}
	
	public function uploadBrochureVcards($imgArray,$path,$type,$firstName) {
		unset($retData);
        $retData['is_upload'] = 0;
		$path = $this->common_model->imageUnlinkPath().$path;
        if($imgArray['name'] != ""){
            $allowedExts = $type;
            $temp = explode(".", $imgArray['name']);
            $extension = strtolower(end($temp));
            if (($_FILES["content_image"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $imgArray['name'] = $firstName."_".time(). "." . $extension;
                $retData['is_upload'] = 1;
                if ($imgArray["error"] > 0) {
                    $retData['status'] = 0; //error
                    $retData['errorMsg'] = 'There are error :' . $imgArray['error']; //error
                    $retData['name'] =$imgArray["name"];
                } else {
                    move_uploaded_file($imgArray["tmp_name"], $path . $imgArray['name']);
                    $retData['status'] = 1; //success
                    $retData['errorMsg'] = '';
                    $retData['name'] = $imgArray["name"];
                }
            }
        }
		return $retData;
    }
	
	private function imageUnlink($path){
		$delPath = $this->common_model->imageUnlinkPath().$path;
		if(file_exists($delPath)){
			unlink($delPath);
		}
		return true;
	}
	
	public function deleteBrochure(){
		$id = trim($this->uri->segment(3));
		$pager = trim($this->uri->segment(4));
		
       	$tbl = "gbe_brochure_vcards";
		$where = array("id"=>$id);
		$selectedData = "";
		$details = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		
		$unlinkPath = 'adminuploads/brochureVcards/brochure/'.$details[0]->cover_img;
		$this->imageUnlink($unlinkPath);
		unset($unlinkPath);
		$unlinkPath = 'adminuploads/brochureVcards/brochure/'.$details[0]->file_name;
		$this->imageUnlink($unlinkPath);
		unset($unlinkPath);
		
		$this->common_model->deleteDataFromTable($tbl, $where);
		
		$this->session->set_flashdata("report", 1);
		$this->session->set_flashdata("msg", "You have successfully deleted the Brochure.");
		redirect(base_url() . "cp/listingBrochure/".$pager);	
	}
	
	public function listingVCards(){
		$this->checkLogin();
        $base_url = base_url()."cp/listingVCards/";
        $total_rows = $this->data_model->getCountAllVCards();
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];
		$viewData['page'] = $page;
		$viewData['navMenu'] = $this->data_model->getMenusList();
        $viewData["list"] = $this->data_model->getAllVCards($per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/level2/vcards/listing.php', $viewData);
		unset($viewData);
	}
	
	public function addVCards(){
		if($this->input->post('add')){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			if(empty($_FILES['cover_img']['name'])){
				$this->form_validation->set_rules('cover_img', 'Cover Image', 'required');
			}
			
            if ($this->form_validation->run() != FALSE) {
				$coverImg = $this->uploadBrochureVcards($_FILES['cover_img'],'adminuploads/brochureVcards/vcards/', array("jpeg","gif", "jpg", "png"),"vcards");
				if($coverImg['status'] == 1){
					$inData['title'] = trim($this->input->post('title'));
					$inData['cover_img'] = $coverImg['name'];
					$inData['data_type'] = 'vcards';
					$inData['created_date'] = date('Y-m-d H:i:s');
					$tbl = "gbe_brochure_vcards";
					$this->common_model->insertDataToTable($tbl, $inData);
					$this->session->set_flashdata("report", 1);
					$this->session->set_flashdata("msg", "You have successfully added the Brochure.");
					redirect(base_url() . "cp/listingVCards/");
				}else{
					$viewData['report'] = 2;
					if($coverImg['errorMsg'] != ''){
        				$viewData['msg'] = $coverImg['errorMsg'];
					}
				}
			}else{
				$viewData['report'] = 2;
        		$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$this->load->view('adminTemplates/level2/vcards/add.php', $viewData);
		unset($viewData);
	}
	
	public function editVCards(){
		$viewData = array();
		$id = trim($this->uri->segment(3));
		$viewData['page'] = trim($this->uri->segment(4));
		$tbl = "gbe_brochure_vcards";
		$where = array("id"=>$id);
		
		if($this->input->post('add')){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			if ($this->form_validation->run() != FALSE) {
				if($_FILES['cover_img']['name'] != ""){
					$coverImg = $this->uploadBrochureVcards($_FILES['cover_img'],'adminuploads/brochureVcards/vcards/', array("jpeg","gif", "jpg", "png"),"vcards");
					$inData['cover_img'] = $coverImg['name'];
					$unlinkPath = 'adminuploads/brochureVcards/vcards/'.$this->input->post('temp_cover_img');
					$this->imageUnlink($unlinkPath);
					unset($unlinkPath);
				}
				$inData['title'] = trim($this->input->post('title'));
				$inData['updated_date'] = date('Y-m-d H:i:s');
				$tbl = "gbe_brochure_vcards";
				$this->common_model->updateDataToTable($tbl, $where, $inData);
				$this->session->set_flashdata("report", 1);
				$this->session->set_flashdata("msg", "You have successfully updated the Brochure.");
				redirect(base_url() . "cp/listingVCards/".$viewData['page']);
			}else{
				$viewData['report'] = 2;
        		$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$selectedData = "";
		$viewData['details'] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		$this->load->view('adminTemplates/level2/vcards/edit.php', $viewData);
		unset($viewData);
	}
	
	public function deleteVCards(){
		$id = trim($this->uri->segment(3));
		$pager = trim($this->uri->segment(4));
		
       	$tbl = "gbe_brochure_vcards";
		$where = array("id"=>$id);
		$selectedData = "";
		$details = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		
		$unlinkPath = 'adminuploads/brochureVcards/vcards/'.$details[0]->cover_img;
		$this->imageUnlink($unlinkPath);
		unset($unlinkPath);
		
		$this->common_model->deleteDataFromTable($tbl, $where);
		
		$this->session->set_flashdata("report", 1);
		$this->session->set_flashdata("msg", "You have successfully deleted the Brochure.");
		redirect(base_url() . "cp/listingVCards/".$pager);	
	}
	
	public function listingL2S2Youtube(){
		$this->checkLogin();
        $base_url = base_url()."cp/listingL2S2Youtube/";
        $total_rows = $this->data_model->getCountAllL2S2Youtube();
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];
		$viewData['page'] = $page;
		$viewData['navMenu'] = $this->data_model->getMenusList();
        $viewData["list"] = $this->data_model->getAllL2S2Youtube($per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/level2/youtube/listing.php', $viewData);
		unset($viewData);
	}
	
	public function addL2S2Youtube(){
		if($this->input->post('add')){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('url', 'Youtube Link', 'trim|required');
            if ($this->form_validation->run() != FALSE) {
				$inData['title'] = trim($this->input->post('title'));
				$inData['desc'] = $this->input->post('desc');
				$inData['url'] = trim($this->input->post('url'));
				$inData['created_date'] = date('Y-m-d H:i:s');
				$inData['admin_approval'] = 'active';
				$inData['show_for'] = 'up';
				$inData['user_id'] = 0;
				$tbl = "level_2_step_2_youtube";
				$this->common_model->insertDataToTable($tbl, $inData);
				$this->session->set_flashdata("report", 1);
				$this->session->set_flashdata("msg", "You have successfully added the youtube.");
				redirect(base_url() . "cp/listingL2S2Youtube/");
				
			}else{
				$viewData['report'] = 2;
        		$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$this->load->view('adminTemplates/level2/youtube/add.php', $viewData);
		unset($viewData);
	}
	
	public function editL2S2Youtube(){
		$viewData = array();
		$id = trim($this->uri->segment(3));
		$viewData['page'] = trim($this->uri->segment(4));
		$tbl = "level_2_step_2_youtube";
		$where = array("id"=>$id);
		
		if($this->input->post('add')){
			$this->load->library('form_validation');
           	$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('url', 'Youtube Link', 'trim|required');
			if ($this->form_validation->run() != FALSE) {
				$inData['title'] = trim($this->input->post('title'));
				$inData['desc'] = $this->input->post('desc');
				$inData['url'] = trim($this->input->post('url'));
				$inData['created_date'] = date('Y-m-d H:i:s');
				$inData['admin_approval'] = 'active';
				$inData['show_for'] = 'up';
				$inData['user_id'] = 0;
				$this->common_model->updateDataToTable($tbl, $where, $inData);
				$this->session->set_flashdata("report", 1);
				$this->session->set_flashdata("msg", "You have successfully updated the Youtube.");
				redirect(base_url() . "cp/listingL2S2Youtube/".$viewData['page']);
			}else{
				$viewData['report'] = 2;
        		$viewData['msg'] = 'Please check the error(s) as below.';
			}
		}
		$selectedData = "";
		$viewData['details'] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		$this->load->view('adminTemplates/level2/youtube/edit.php', $viewData);
		unset($viewData);
	}
	
	public function updateL2S2Youtube(){
		$id = trim($this->uri->segment(3));
		$pager = trim($this->uri->segment(4));
		
		$where = array("id" => trim($id));
        $tbl = "level_2_step_2_youtube";
		$data['admin_approval'] = 'active';
		$dd = $this->common_model->updateDataToTable($tbl, $where, $data);
			
		$this->session->set_flashdata("report", 1);
		$this->session->set_flashdata("msg", "You have successfully activated the Youtube.");
		redirect(base_url() . "cp/listingL2S2Youtube/".$pager);	
	}
	
	public function deleteL2S2Youtube(){
		$id = trim($this->uri->segment(3));
		$pager = trim($this->uri->segment(4));
		
       	$tbl = "level_2_step_2_youtube";
		$where = array("id"=>$id);
		$this->common_model->deleteDataFromTable($tbl, $where);
		
		$this->session->set_flashdata("report", 1);
		$this->session->set_flashdata("msg", "You have successfully deleted the Youtube.");
		redirect(base_url() . "cp/listingL2S2Youtube/".$pager);	
	}
	
	public function mmsHvolunteer(){
		$this->checkLogin();
        $base_url = base_url()."cp/mssHvolunteer/";
        $total_rows = $this->data_model->getCountMssHvolunteer();
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
		
        $msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];
		
		$viewData['page'] = $page;
		$viewData['navMenu'] = $this->data_model->getMenusList();
        $viewData["list"] = $this->data_model->getAllMssHvolunteer($per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/mms/listing.php', $viewData);
		unset($viewData);
	
	}
	
	
	public function assignMmsUser(){
		$hvId = trim($this->uri->segment(3));
		$page = trim($this->uri->segment(4));
		$afroIds = array();
		if($this->input->post('assign') != ""){
			$formHvId = trim($this->input->post('hvId'));
			$afroIds = $this->input->post('id');
			if($hvId == $formHvId){
				$insertData['user_id'] = $formHvId;
				$insertData['user_level'] = 0;
				$insertData['assigned_by'] = $this->session->userdata("adminId");
				$insertData['created_date'] = date("Y-m-d H:i:s");
				if(is_array($afroIds) && count($afroIds) > 0){
					foreach($afroIds as $vv ){
						$insertData['to_user_id'] = $vv;
						$tbl = 'gbe_mass_details';
						$this->common_model->insertDataToTable($tbl, $insertData);
						unset($tbl);
						$tbl = 'userinfo';
						$where['uID'] = $insertData['to_user_id'];
						$data['userType'] = 'VOLUNTEERS';
						$data['email_send_status'] = 1;
						$data['password'] = $this->generatePassword();
						$this->common_model->updateDataToTable($tbl, $where, $data);
						unset($tbl);unset($where);unset($data);
						$tbl = 'user_general_type';
						$where['user_id'] = $insertData['to_user_id'];
						$this->common_model->deleteDataFromTable($tbl, $where);	
						unset($tbl);unset($where);
						$this->sendEmailForChange($insertData['to_user_id']);
					}
					unset($insertData);
					$this->session->set_flashdata("report", 1);
					$this->session->set_flashdata("msg", "You have been successfully assigned.");
					redirect(base_url() . "cp/mmsHvolunteer/".$page);
				}else{
					$viewData['report'] = 2;
        			$viewData['msg'] = 'Please select at least one afrowebb user from this list to be converted to Volunter and added to the MSS system.';
				}
				
			}else{
				$viewData['report'] = 2;
        		$viewData['msg'] = 'Sorry, Data is not updated.Please try again.';
			}
			
		}
		
		$viewData["hvDetails"] = $this->data_model->getHVDetails($hvId);
		
        /*$msg = $this->setMessageForUser();
        $viewData['report'] = $msg['report'];
        $viewData['msg'] = $msg['msg'];*/
		
		$viewData['page'] = $page;
		$viewData['hvId'] = $hvId;
		$viewData['navMenu'] = $this->data_model->getMenusList();
        $viewData["list"] = $this->data_model->getAllAfro();
        $this->load->view('adminTemplates/mms/assign.php', $viewData);
		unset($viewData);
	
	}
	
	public function sendEmailForChange($signupId){
		$details = $this->data_model->getUserDetails($signupId);
        $to_email = $details[0]->cuEmail;
        $subject = "V.I.P Entrance For My True 12 - Make Money Online";
        $message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
  <p style="font-size:14px;">Hello&nbsp;'.$details[0]->cuFName.'&nbsp;'.$details[0]->cuLName.'</p>
  <p style="font-size:14px;">We Welcome You To Gain Access To The GBE Wealth System - V.I.P Area.</p>
  <p style="font-size:14px;">To make progress as black people, we must first, empower ourselves by raising our own personal income while developing healthier, safer and wealthier communities.</p>
  <p style="font-size:14px;">The GBE wealth platform was created with this in mind.</p>
  <p style="font-size:14px;">We believe a brighter future will only be achieved when more of us unite and together, step up to the challenge of becoming financially secure.</p>
  <p style="font-size:14px;">By raising the amount of conscious affluence within our people, we can finally make a more economically balanced society.</p>
   <p style="font-size:14px;">Within the GBE wealth system are five areas to help you generate substantial amounts of money.</p>
  <p style="font-size:16px;">You have been given the gift of <b>V.I.P entrance</b> to Level 1</p>
  
  <p style="font-size:14px;">This means you will be one of the first in this city to gain access to our powerful marketing suite called Afrowebb.</p>
  
  <p style="font-size:14px;">Inside the Afrowebb, you can boost your current business, list any of your services and utilise our network of agents to sell your own products. If you have any form of creative talents then use Afrowebb to market your items.</p>
  
  <p style="font-size:14px;">We will also show you how to rapidly increase your income using our V.I.P software.Just follow the instructions given by our VIP members, which is the person who sent you this invite and you will access a short cut to your financial success.</p>
  
  
  
  <p style="font-size:16px;">TAKE ACTION.</p>
  
  <p style="font-size:14px;">You will need to move fast to secure your extremely privileged position in our system because if you remain dormant, this account will be closed and your opportunity will pass.</p>
  
	<p style="font-size:14px;">Here is an outline of 9 steps that will secure your valuable position and dramatically build your wealth.</p>
	<p style="font-size:14px;">1. Enter your GBE account, using the username and password below.</p>
	<p style="font-size:14px;">2. Watch the first 4 videos on the page &shy; To fully understand the GBE business and commission structure.</p>
	<p style="font-size:14px;">3. Go to product upload &shy; Upload or list your items or brands. Feel free to ask the person who sent you this link to help turn your business, your brands, events, services into a products to be sold on Afrowebb.</p>
	<p style="font-size:14px;">4. On the right side of the page go to \'VIP entrance\' Watch the video then add 12 selected guests involved in Black-owned enterprises to our account.</p>
	<p style="font-size:14px;">5. If you need help finding 12 good people &shy; Go to \'Vendors Sign up page\' further down on the right.</p>
	
	<p style="font-size:14px;">6. Post the \'Vendors Sign up page\' on your facebook, whatsapp, and twitter etc. This will attract people who qualify to be part of your 12.</p>
	<p style="font-size:14px;">7. When people arrive they will be viewable at the bottom of the page.Call this person and qualify them by checking: </p>
	<p style="font-size:14px;padding-left:30px">A. Do they have a product or service to place of Afrowebb.</p>
	<p style="font-size:14px;padding-left:30px">B. Will they support 12 others by giving the gift of the V.I.P </p>
	<p style="font-size:14px;padding-left:30px">C. Will they move as one &shy; Raising up the system at an agreed date once they have fully build their GBE business.</p>

	<p style="font-size:14px;">9. Yet most importantly &shy; PREPARE TO MOVE AS ONE.On a specific date, when your team leader tells you to, you must move up to level two. There will be no risk, as the entire team around you will work as one unit, allowing immediate profits to flow for each of the participants.</p>
	<p style="font-size:16px;">Done</p>
	<p style="font-size:14px;">This is your moment!!! Be strong as together we can do this, have faith, be 100% committed to your success &shy; move as one and together we will be financially free.</p>
	<p style="font-size:16px;">ENTER NOW</p>
  
  <p style="font-size:14px;">Username:'.$details[0]->cuEmail.'</p>
  <p style="font-size:14px;">Password:'.$details[0]->cupwd.'</p>
	<p style="font-size:14px;"><a href="'.base_url().'">Click here to login</a></p></div>';
     
        if ($to_email != '' && $subject != '') {
            //$this->send_mail_raw();
			$this->send_mail_raw($to_email,$subject,$message);
			return true;
        } else {
            return false;
        }
	}
	
	public function showGambianAssignResult(){
		
		$base_url = base_url()."cp/showGambianAssignResult/";
		$total_rows = $this->admin_user_model->getCountAssignUserForAdmin();
		$per_page = $this->dataPerPage;
		$uri_segment = 3;
		$page = 0;
		if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
			$page = $this->uri->segment(3);
		}
		$msg = $this->setMessageForUser();
		$viewData['report'] = $msg['report'];
		$viewData['msg'] = $msg['msg'];
		$viewData['page'] = $page;
		$viewData['navMenu'] = $this->data_model->getMenusList();
		$viewData["list"] = $this->admin_user_model->getAssignUserForAdmin($per_page,$page);
		//print_r($viewData["list"]);exit;
		$viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
		$this->load->view('adminTemplates/user/gambian_assign_list.php', $viewData);
		unset($viewData);
	}

	 public function addPageText($userId){
        
		$viewData = array();
        $tbl = "gbe_page_text_for_user";
		$where = array("user_id" => trim($userId));
		$selectedData = 'page_text';
		$pageTextDetail = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		//echo '++++++++++++'.$pageTextDetail[0]->page_text;
		$viewData['page_text'] = $pageTextDetail[0]->page_text;
		
		if(count($pageTextDetail)>0){
			$viewData['action'] = 'Edit';
		}
		else{
			$viewData['action'] = 'Add';
		}
       
        if ($this->input->post("submit") != "") {
            
			$data['page_text']  = trim($this->input->post('page_text'));            
           
            if(trim($this->input->post('pageAction'))=="Add"){
				$data['user_id'] 	= $userId;//trim($this->input->post('user_id')); 
				$data['page_type']  = "MMS";
				$data['status']  	= 1;
				$dd = $this->common_model->insertDataToTable($tbl, $data);
				$this->session->set_flashdata("msg", "You have successfully added the data.");
			}
			else{
				
				$where = array("user_id" => trim($userId));
				//$data["page_text"] = $this->input->post("status");
				 $dd = $this->common_model->updateDataToTable($tbl, $where, $data);
				 $this->session->set_flashdata("msg", "You have successfully Updated the data.");
			}
           
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                
                redirect(base_url() . "cp/viewHeadVolunteer");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $this->load->view('adminTemplates/user/addPageText.php', $viewData);
    }
	// blog video edit function added by SB on 30-03-2016
	 public function ctBlogVideo(){
        $viewData = array();
        $viewData["report"] = "";
        $viewData["msg"] = "";
        $where = array("id" => 1);
        $tbl = "blog_video";
        if ($this->input->post("submit") != "") {
            $data["title"] = $this->input->post("title");
            $data["path"] = $this->input->post("path");
            $data["content_title"] = $this->input->post("content_title");
            $data["content"] = $this->input->post("content");
            $retImg = $this->uploadFreeListingImage();
            if($retImg['is_upload'] == 1){
                if($retImg['status'] == 1){
                    $data["content_image"] = $retImg['name'];
                    $selectedData = "content_image";
                    $imageD = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
					$delPath = $this->common_model->imageUnlinkPath().'adminuploads/level_wise_images/'.$imageD[0]->content_image;
					if(file_exists($delPath)){
                    	unlink($delPath);
					}
                    unset($selectedData);
                }
            }
            $data["status"] = $this->input->post("status");
            $dd = $this->common_model->updateDataToTable($tbl, $where, $data);
            if ($dd) {
               /*  $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully updated the data."); */
				$viewData["report"] = 1;
                $viewData['msg'] = 'You have successfully updated the data.';
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $selectedData = "";
        $viewData["list"] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
        $viewData["val"] = $viewData["list"][0];
        unset($viewData["list"]);
        $this->load->view('adminTemplates/blogVideoEdit.php', $viewData);
    }

    ###########################  12-07-2016 Manage Ads ################
	
	public function uploadAdImage() {
        $adData['is_upload'] = 0;
        if($_FILES["ad_image"]["name"] != ""){
            $path = "adminuploads/adpost/";
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $_FILES["ad_image"]["name"]);
            $extension = strtolower(end($temp));
            if (($_FILES["ad_image"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $_FILES["ad_image"]["name"] = "lwi_".time(). "." . $extension;
                $adData['is_upload'] = 1;
                if ($_FILES["ad_image"]["error"] > 0) {
                    $adData['status'] = 0; //error
                    $adData['errorMsg'] = 'The image has an error' . $_FILES["ad_image"]["error"]; //error
                    $adData['name'] = $_FILES["ad_image"]["name"];
                } else {
					move_uploaded_file($_FILES["ad_image"]["tmp_name"], $path . $_FILES["ad_image"]["name"]);
                    $adData['status'] = 1; //success
                    $adData['errorMsg'] = '';
                    $adData['name'] = $_FILES["ad_image"]["name"];
                }
            }
            return $adData;
        }else{
            return $adData;
        }
    }
	
	function adName(){
            $adName				=	isset($_GET['query'])?$_GET['query']:"";
            $adDetils			=	$this->common_model->getAdsNameByName($adName);
            $adNames			=	"";
            $returnData['query']	=	$adName;				
            if(!empty($adDetils)){
                    for($i=0;$i<count($adDetils);$i++){
                            $adNames	.=	'"'.$adDetils[$i]['title'].'"';
                            if(trim($adNames)!=""){
                                    $adNames	.=	',';
                                    $returnData['suggestions'][]	=	$adDetils[$i]['title'];
                            }
                    }
            }
            echo json_encode($returnData);
    }
	function artName(){
            $artName				=	isset($_GET['query'])?$_GET['query']:"";
            $artDetils			=	$this->common_model->getArticlesNameByName($artName);
            $artNames			=	"";
            $returnData['query']	=	$artName;				
            if(!empty($artDetils)){
                    for($i=0;$i<count($artDetils);$i++){
                            $artNames	.=	'"'.$artDetils[$i]['title'].'"';
                            if(trim($artNames)!=""){
                                    $artNames	.=	',';
                                    $returnData['suggestions'][]	=	$artDetils[$i]['title'];
                            }
                    }
            }
            echo json_encode($returnData);
    }
	
    public function viewAdsList($id){
		
		$viewData = array();
        $viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $tbl = "admin_ads";
        $where = array();
        $where['for_website'] = $this->forWebsite;// added by SB on 16/10/2015
        $selectedData = "";
        $viewData['navMenu'] = $this->data_model->getMenusList();
       // $viewData["list"] = $this->common_model->fetchDataFromTable($tbl,$where,$selectedData);
    
        //$this->load->view('adminTemplates/ads/view_step2_b.php', $viewData);

        $config = array();
        $config["base_url"] = base_url() . "cp/viewAdsList/0/";
        $config["total_rows"] = $this->common_model->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $tempList = array();
		$viewData["selectedAds"] = "";
		$id="";
		if ($this->input->post('go')!="") {
			      $viewData["selectedAds"] = trim($this->input->post('search'));
			
		}
		
		$tempList = $this->common_model->fetch_countries($config["per_page"], $page, $viewData["selectedAds"]);
		
			foreach($tempList as $key=>$val){				
				$tempList[$key]->categoryName = $this->common_model->getCategoryTitle($val->categoryId);
			}
		
        $viewData["list"] = $tempList;		
		$viewData["links"] = $this->pagination->create_links();
   /*  echo "<pre>";
        print_r($tempList);
        echo "</pre>";
        exit;*/
        $this->load->view('adminTemplates/ads/view_step2_b.php', $viewData);


    }
    
    public function addAds(){
        $viewData['action'] = 'Add';
        $viewData['title'] = '';
        $viewData['url'] = '';
		$viewData['twitter_url'] = '';
		$viewData['facebook_url'] = '';
		$viewData['another_url'] = '';
		$viewData['inst_url'] = '';
		$viewData['skype_id'] = '';
		$viewData['gplus_url'] = '';
		$viewData['youtube_url'] = '';
		$viewData['pdf_upload'] = '';
		$viewData['pinterest_url'] = '';
		$viewData['linked_in_url'] = '';
        $viewData['description'] = '';
		$files = $this->uploadBrochureVcards($_FILES['pdf_upload'],'adminuploads/pdf_upload/',array("pdf"),"ads");
        $viewData["categoryList"] = $this->common_model->fetch_category(100, 0);
        $tbl = "admin_ads";
        if ($this->input->post("submit") != "") {
			
			$x_axis=$this->input->post("x_axis");
			$y_axis=$this->input->post("y_axis");			
			
			$ad_width=$this->input->post("ad_width");
			$ad_height=$this->input->post("ad_height");
            $data['title'] = trim($this->input->post('title'));
            $data['categoryId'] = trim($this->input->post('categoryId'));
            $data['url'] = trim($this->input->post('url'));
			$data['twitter_url'] = trim($this->input->post('twitter_url'));
			$data['facebook_url'] = trim($this->input->post('facebook_url'));
			$data['another_url'] = trim($this->input->post('another_url'));
			$data['inst_url'] = trim($this->input->post('inst_url'));
			$data['skype_id'] = trim($this->input->post('skype_id'));
			$data['gplus_url'] = trim($this->input->post('gplus_url'));
			$data['youtube_url'] = trim($this->input->post('youtube_url'));
			if (!empty($_FILES['pdf_upload']['name'])) {
			$data['pdf_upload'] = $files['name'];
			}
			$data['pinterest_url'] = trim($this->input->post('pinterest_url'));
			$data['linked_in_url'] = trim($this->input->post('linked_in_url'));
			$data['gmail_link'] = trim($this->input->post('gmail_link'));
            $data['description'] = $this->input->post('description');
            $data['user_id'] = $this->session->userdata('adminId'); 
            $data['created_date'] = date("Y-m-d H:i:s");
			/*if (!empty($_FILES['ad_image']['name'])) {
               	$imgDet = $this->uploadAdImage();
				//print_r($imgDet); die();
				if($imgDet['status'] == 1){
					$data['ad_image'] = $_FILES["ad_image"]["name"];
				}else{
					$data['image_error'] = $imgDet['image_error'];
				}
            }else{
				$data['ad_image'] = '';
			}*/
			
			if (!empty($_FILES['ad_image']['name'])) {
               	$config = array(
                'upload_path' => "adminuploads/adpost/",
                'upload_url' => base_url() . "adminuploads/adpost/",
                'allowed_types' => "gif|jpg|png|jpeg"
            );
                 $this->load->library('upload', $config);
				if ($this->upload->do_upload('ad_image')) {
                //If image upload in folder, set also this value in "$image_data". 
                $image_data = $this->upload->data();
            }
				 $dataImg = $this->cropimg($image_data,$x_axis,$y_axis,$ad_width,$ad_height);
				 $data['ad_image'] = $dataImg['img_src'];
				
		  }
		
			
            $dd = $this->common_model->insertDataToTable($tbl, $data);
			
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully added the data.");
                redirect(base_url() . "cp/viewAdsList");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $this->load->view('adminTemplates/ads/edit_step2_b.php', $viewData);
    }
    
    public function editAds($id = 0){
		
        $viewData['action'] = 'Edit';
        $where = array("id" => trim($id));
        $tbl = "admin_ads";
        if ($this->input->post("submit") != "") {
			$x_axis=$this->input->post("x_axis");
			$y_axis=$this->input->post("y_axis");			
			
			$ad_width=$this->input->post("ad_width");
			$ad_height=$this->input->post("ad_height");
			$id= $this->input->post("ad_id");
			/*$imgDet = $this->uploadAdImage();
			if($imgDet['is_upload'] == 1){
                if($imgDet['status'] == 1){
                    $data["ad_image"] = $imgDet['name'];
                    $selectedData = "ad_image";
                    $imageD = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
					$delPath = $this->common_model->imageUnlinkPath().'adminuploads/adpost/'.$imageD[0]->ad_image;
					if(file_exists($delPath)){
                    	unlink($delPath);
					}
                    unset($selectedData);
                }
            }*/
			
			 if (!empty($_FILES['ad_image']['name'])) {
			$config = array(
                'upload_path' => "adminuploads/adpost/",
                'upload_url' => base_url() . "adminuploads/adpost/",
                'allowed_types' => "gif|jpg|png|jpeg"
            );
                 $this->load->library('upload', $config);
				if ($this->upload->do_upload('ad_image')) {
                //If image upload in folder, set also this value in "$image_data". 
                $image_data = $this->upload->data();
            }
				 $dataImg = $this->cropimg($image_data,$x_axis,$y_axis,$ad_width,$ad_height);
				 //print_r($dataImg);exit;
				 $data['ad_image'] = $dataImg['img_src'];
			     $selectedData = "ad_image";
                 $imageD = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
				 $delPath = $this->common_model->imageUnlinkPath().'adminuploads/adpost/'.$imageD[0]->ad_image;
					if(file_exists($delPath)){
                    	unlink($delPath);
					}
                    unset($selectedData);
			 }
			if($_FILES['pdf_upload']['name'] != ""){
					$pdf_upload = $this->uploadBrochureVcards($_FILES['pdf_upload'],'adminuploads/pdf_upload/', array("pdf"),"ads");
					$data['pdf_upload'] = $pdf_upload['name'];
					$unlinkPath = 'adminuploads/pdf_upload/'.$this->input->post('temp_ads_pdf');
					$this->imageUnlink($unlinkPath);
					unset($unlinkPath);
				}
			
            $data['title'] = trim($this->input->post('title'));
            $data['categoryId'] = trim($this->input->post('categoryId'));
            $data['url'] = trim($this->input->post('url'));
			$data['twitter_url'] = trim($this->input->post('twitter_url'));
			$data['facebook_url'] = trim($this->input->post('facebook_url'));
			$data['another_url'] = trim($this->input->post('another_url'));
			$data['inst_url'] = trim($this->input->post('inst_url'));
			$data['skype_id'] = trim($this->input->post('skype_id'));
			$data['gplus_url'] = trim($this->input->post('gplus_url'));
			$data['youtube_url'] = trim($this->input->post('youtube_url'));
			$data['pinterest_url'] = trim($this->input->post('pinterest_url'));
			$data['linked_in_url'] = trim($this->input->post('linked_in_url'));
			$data['gmail_link'] = trim($this->input->post('gmail_link'));
            $data['description'] = $this->input->post('description');
            $data['user_id'] = $this->session->userdata('adminId'); 
            $data['updated_date'] = date("Y-m-d H:i:s");
			
            $dd = $this->common_model->updateDataToTable($tbl, $where, $data);
            if ($dd) {
				//echo "sss"; die
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully updated the data.");
                redirect(base_url() . "cp/viewAdsList/".$id);
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
			
        }
        $selectedData = "";
        $list = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		
		$viewData['id'] = $list[0]->id;
        $viewData['title'] = $list[0]->title;
        $viewData['categoryId'] = $list[0]->categoryId;
        $viewData['url'] = $list[0]->url;
		$viewData['twitter_url'] = $list[0]->twitter_url;
		$viewData['facebook_url'] = $list[0]->facebook_url;
		$viewData['another_url'] = $list[0]->another_url;
		$viewData['inst_url'] = $list[0]->inst_url;
		$viewData['skype_id'] = $list[0]->skype_id;
		$viewData['gplus_url'] = $list[0]->gplus_url;
		$viewData['youtube_url'] = $list[0]->youtube_url;
		$viewData['pinterest_url'] = $list[0]->pinterest_url;
		$viewData['linked_in_url'] = $list[0]->linked_in_url;
		$viewData['gmail_link'] = $list[0]->gmail_link;
		$viewData['pdf_upload'] = $list[0]->pdf_upload;
		$viewData['ad_image'] = $list[0]->ad_image;
        $viewData['description'] = $list[0]->description;
        $viewData["categoryList"] = $this->common_model->fetch_category(100, 0);
        unset($viewData["list"]);
		//redirect('cp/viewAdsList');
        $this->load->view('adminTemplates/ads/edit_step2_b.php', $viewData);
    }
	
	// Resize Manipulation.
    /*public function resize($image_data) {
        $img = $image_data['full_path'];
	    $config['image_library'] = 'gd2';
        $config['source_image'] = 'adminuploads/adpost/'.$_FILES["ad_image"]["name"];
        $config['new_image'] = 'adminuploads/adpost/lwi_'.time().$_FILES["ad_image"]["name"];
        $config['width'] = 165;
        $config['height'] = 158;

        $this->image_lib->initialize($config);
        $src = 'lwi_'.time().$_FILES["ad_image"]["name"];
        
        $data['img_src'] = $src;
        // Call resize function in image library.
        $this->image_lib->resize();
        // Return new image contains above properties and also store in "uplods" folder.
        return $data;
    }*/
    public function cropimg($image_data,$x_axis,$y_axis,$ad_width,$ad_height) {
		
		$img = $image_data['full_path'];
		
		$config['image_library'] = 'GD2';
		$config['source_image'] = $img;
		$config['new_image'] = 'adminuploads/adpost/lwi_'.time().$_FILES["ad_image"]["name"];
		$config['x_axis'] = $x_axis;
        $config['y_axis'] = $y_axis;
		$config['height'] = $ad_width;
		$config['width'] = $ad_height;
		$config['maintain_ratio'] = FALSE;

		$this->image_lib->initialize($config);

		if ( ! $this->image_lib->crop())
		{
			echo $this->image_lib->display_errors();
		}else
		{
			$src = 'lwi_'.time().$_FILES["ad_image"]["name"];
			$data['img_src'] = $src;
			return $data;
		}	
	}
    public function deleteAds($id = 0){
        $where = array("id" => trim($id));
        $tbl = "admin_ads";
		
		$selectedData = "ad_image";
		$imageD = $this->common_model->fetchAdContent($tbl, $where, $selectedData);
		$delPath = $this->common_model->imageUnlinkPath().'adminuploads/adpost/'.$imageD[0]->ad_image;
		if(file_exists($delPath)){
			unlink($delPath);
		}
		unset($selectedData);
			
        $dd = $this->common_model->deleteDataFromTable($tbl, $where);
        if ($dd) {
            $this->session->set_flashdata("report", 1);
            $this->session->set_flashdata("msg", "You have successfully deleted the data.");
        } else {
            $this->session->set_flashdata("report", 2);
            $this->session->set_flashdata("msg", "Please try again.");
        }
        redirect(base_url() . "cp/viewAdsList");
    }

    ###########################  END 12-07-2016 Manage Ads ################
	
	###########################  START 12-01-2017 MANAGE CATEGORY BY RUMA ################
	
		public function viewCategory(){
        $viewData = array();
        $viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $tbl = "ct_category";
        $where = array();
       
        $selectedData = "";
        $viewData['navMenu'] = $this->data_model->getMenusList();
        
        
        $config = array();
        $config["base_url"] = base_url() . "cp/viewCategory";
        $config["total_rows"] = $this->common_model->record_count_category();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
		 

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
        $tempList = array();
        $tempList = $this->common_model->fetch_category($config["per_page"], $page);
        
       
        $viewData["list"] = $tempList;
        $viewData["links"] = $this->pagination->create_links();
       
        $this->load->view('adminTemplates/maincategory/category.php', $viewData);
    }
	
	
	 public function editCat($id = 0){
        $viewData['action'] = 'Edit';
        $where = array("id" => trim($id));
		$tbl="ct_category";
        
        if ($this->input->post("submit") != "") {
						
			
            $data['title'] = $this->input->post('title');
            
			
			
            $dd = $this->common_model->updateDataToTable($tbl, $where, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully updated the data.");
                redirect(base_url() . "cp/viewCategory");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $selectedData = "";
		$list = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
        $viewData['title'] = $list[0]->title;
		
		       
        //unset($viewData["list"]);
        $this->load->view('adminTemplates/maincategory/edit_category.php', $viewData);
    }
	
	
	
	
	
	public function viewCategoryList(){
        $viewData = array();
        $viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $tbl = "ct_category";
        $where = array();
       
        $selectedData = "";
        $viewData['navMenu'] = $this->data_model->getMenusList();
        
        
        $config = array();
        $config["base_url"] = base_url() . "cp/viewCategoryList";
        $config["total_rows"] = $this->common_model->record_count_category_catl();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
		 

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
        $tempList = array();
        $tempList = $this->common_model->fetch_category_catalogue($config["per_page"], $page);
        
       
        $viewData["list"] = $tempList;
        $viewData["links"] = $this->pagination->create_links();
       
        $this->load->view('adminTemplates/category/category_list.php', $viewData);
    }
	
	public function uploadCategoryImage() {
        $adData['is_upload'] = 0;
        if($_FILES["img"]["name"] != ""){
            $path = "adminuploads/category/";
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $_FILES["img"]["name"]);
            $extension = strtolower(end($temp));
            if (($_FILES["img"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $_FILES["img"]["name"] = "lwi_".time(). "." . $extension;
                $adData['is_upload'] = 1;
                if ($_FILES["img"]["error"] > 0) {
                    $adData['status'] = 0; //error
                    $adData['errorMsg'] = 'The image has an error' . $_FILES["img"]["error"]; //error
                    $adData['name'] = $_FILES["img"]["name"];
                } else {
					move_uploaded_file($_FILES["img"]["tmp_name"], $path . $_FILES["img"]["name"]);
                    $adData['status'] = 1; //success
                    $adData['errorMsg'] = '';
                    $adData['name'] = $_FILES["img"]["name"];
                }
            }
            return $adData;
        }else{
            return $adData;
        }
    }
	public function addCategory(){
		
		$viewData['action'] = 'Add';
        $viewData['title'] = '';
        $viewData['url'] = '';
        $viewData['description'] = '';
        $tbl = "ct_category";
		$tbl1 = "productmenucontent";
		$viewData['title_list']= $this->common_model->get_category();
        if ($this->input->post("submit") != "") {
            $data['title'] = trim($this->input->post('title'));
            $data['description'] = $this->input->post('description');
            
			 if (!empty($_FILES['img']['name'])) {
               	$imgDet = $this->uploadCategoryImage();
				//print_r($imgDet); die();
				if($imgDet['status'] == 1){
					$data['img'] = $_FILES["img"]["name"];
				}else{
					$data['image_error'] = $imgDet['image_error'];
				}
            }else{
				$data['img'] = '';
			}
						
            $dd = $this->common_model->insertDataToTable($tbl1, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully added the data.");
                redirect(base_url() . "cp/viewCategoryList");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $this->load->view('adminTemplates/category/edit_category.php', $viewData);
		
    } 	

     public function editCategory($id = 0){
        $viewData['action'] = 'Edit';
        $where = array("id" => trim($id));
		$tab="ct_category";
        $tbl1 = "productmenucontent";
        if ($this->input->post("submit") != "") {
						
			$old_img = $this->input->post('db_img');
			
            if (isset($_FILES) && $_FILES['img']['error'] == 0) {
				$oldimg = "./adminuploads/productPagesImg/" . $old_img;
				if (file_exists($oldimg)) {
					unlink($oldimg);
				}
				
				$filename = rand(000000000, 999999999) . time() . $_FILES['img']['name'];

				$config['upload_path'] = 'adminuploads/productPagesImg/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = 200000;
				$config['file_name'] = $filename;

				$this->load->library('upload', $config);

				if (!file_exists('adminuploads')) {
					mkdir('uploads', 0777);
				}

				if (!file_exists('adminuploads/productPagesImg/')) {
					mkdir('uploads/rink_logo/', 0777);
				}
				if (!$this->upload->do_upload('img')) {
					
					$error = $this->upload->display_errors();
					return $error;
				}
				else
				{
					$file = $this->upload->data();

					$newlogo = $file['file_name'];
				}
			}
			else{
				$newlogo = $old_img;
			}
			$data['image']= $newlogo;
            $data['description'] = $this->input->post('description');
            
			
			
            $dd = $this->common_model->updateDataToTable_catl($tbl1, $where, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully updated the data.");
                redirect(base_url() . "cp/viewCategoryList");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $selectedData = "";
        $list = $this->common_model->fetchDataFromTable_catl($tbl1, $where, $selectedData);
        $viewData['title'] = $list[0]->title;
		$viewData['image'] = $list[0]->image;
        $viewData['description'] = $list[0]->description;
       
        unset($viewData["list"]);
        $this->load->view('adminTemplates/category/edit_category.php', $viewData);
    }
    
    public function deleteCategory($id = 0){
		
        $where = array("id" => trim($id));
        $tbl = "ct_category";
		
		      
			$selectedData = "img";
			$imageD = $this->common_model->fetchCategoryContent($tbl, $where, $selectedData);
			$delPath = $this->common_model->imageUnlinkPath().'adminuploads/category/'.$imageD[0]->img;
			if(file_exists($delPath)){
				unlink($delPath);
			}
			unset($selectedData);
                
			
				
        $dd = $this->common_model->deleteDataFromTable($tbl, $where);
		
        if ($dd) {
			$this->session->set_flashdata("report", 1);
            $this->session->set_flashdata("msg", "You have successfully deleted the data.");
        } else {
            $this->session->set_flashdata("report", 2);
            $this->session->set_flashdata("msg", "Please try again.");
        }
        redirect(base_url() . "cp/viewCategoryList");
    }
	
	public function viewBanner(){
		$viewData = array();
        $viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $tbl = "admin_adbanner";
        $where = array();
       
        $selectedData = "";
        $viewData['navMenu'] = $this->data_model->getMenusList();
        
        
        $config = array();
        $config["base_url"] = base_url() . "cp/viewBanner";
        $config["total_rows"] = $this->common_model->record_count_banner();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
		 

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
        $tempList = array();
        $tempList = $this->common_model->fetch_banner($config["per_page"], $page);
        
       
        $viewData["list"] = $tempList;
        $viewData["links"] = $this->pagination->create_links();
        $this->load->view('adminTemplates/ads/banner_list.php', $viewData);
    }
	
	public function uploadBannerImage() {
        $adData['is_upload'] = 0;
        if($_FILES["banner_image"]["name"] != ""){
            $path = "adminuploads/adpost/banner/";
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $_FILES["banner_image"]["name"]);
            $extension = strtolower(end($temp));
            if (($_FILES["banner_image"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $_FILES["banner_image"]["name"] = "lwi_".time(). "." . $extension;
                $adData['is_upload'] = 1;
                if ($_FILES["banner_image"]["error"] > 0) {
                    $adData['status'] = 0; //error
                    $adData['errorMsg'] = 'The image has an error' . $_FILES["banner_image"]["error"]; //error
                    $adData['name'] = $_FILES["banner_image"]["name"];
                } else {
					move_uploaded_file($_FILES["banner_image"]["tmp_name"], $path . $_FILES["banner_image"]["name"]);
                    $adData['status'] = 1; //success
                    $adData['errorMsg'] = '';
                    $adData['name'] = $_FILES["banner_image"]["name"];
                }
            }
            return $adData;
        }else{
            return $adData;
        }
    }
	
	public function addBanner(){
		
		$viewData['action'] = 'Add';
        $viewData['banner_title'] = '';
        $viewData['banner_url'] = '';
       
        $tbl = "admin_adbanner";
        if ($this->input->post("submit") != "") {
            $data['banner_title'] = trim($this->input->post('banner_title'));
            $data['banner_url'] = $this->input->post('banner_url');
            
			 if (!empty($_FILES['banner_image']['name'])) {
               	$imgDet = $this->uploadBannerImage();
				//print_r($imgDet); die();
				if($imgDet['status'] == 1){
					$data['banner_image'] = $_FILES["banner_image"]["name"];
				}else{
					$data['image_error'] = $imgDet['image_error'];
				}
            }else{
				$data['image_error'] = 'Please select a Image.';
			}
						
            $dd = $this->common_model->insertDataToTable($tbl, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully added the data.");
                redirect(base_url() . "cp/viewBanner");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $this->load->view('adminTemplates/ads/edit_banner.php', $viewData);
		
    } 	
	
	public function editBanner($id = 0){
        $viewData['action'] = 'Edit';
        $where = array("id" => trim($id));
        $tbl = "admin_adbanner";
        if ($this->input->post("submit") != "") {
			$imgDet = $this->uploadBannerImage();
            if($imgDet['is_upload'] == 1){
                if($imgDet['status'] == 1){
                    $data["banner_image"] = $imgDet['name'];
                    $selectedData = "banner_image";
                    $imageD = $this->common_model->fetchBannerContent($tbl, $where, $selectedData);
					$delPath = $this->common_model->imageUnlinkPath().'adminuploads/adpost/banner/'.$imageD[0]->banner_image;
					if(file_exists($delPath)){
                    	unlink($delPath);
					}
                    unset($selectedData);
                }
            }
			
						
            $data['banner_title'] = trim($this->input->post('banner_title'));
            $data['banner_url'] = $this->input->post('banner_url');
            
			
			
            $dd = $this->common_model->updateDataToTable($tbl, $where, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully updated the data.");
                redirect(base_url() . "cp/viewBanner");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }
        $selectedData = "";
        $list = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
        $viewData['banner_title'] = $list[0]->banner_title;
        $viewData['banner_image'] = $list[0]->banner_image;
        $viewData['banner_url'] = $list[0]->banner_url;
       
        unset($viewData["list"]);
        $this->load->view('adminTemplates/ads/edit_banner.php', $viewData);
    }
    
    public function deleteBanner($id = 0){
		
        $where = array("id" => trim($id));
        $tbl = "admin_adbanner";
		
		      
			$selectedData = "banner_image";
			$imageD = $this->common_model->fetchBannerContent($tbl, $where, $selectedData);
			$delPath = $this->common_model->imageUnlinkPath().'adminuploads/adpost/banner/'.$imageD[0]->banner_image;
			if(file_exists($delPath)){
				unlink($delPath);
			}
			unset($selectedData);
                
			
				
        $dd = $this->common_model->deleteDataFromTable($tbl, $where);
		
        if ($dd) {
			$this->session->set_flashdata("report", 1);
            $this->session->set_flashdata("msg", "You have successfully deleted the data.");
        } else {
            $this->session->set_flashdata("report", 2);
            $this->session->set_flashdata("msg", "Please try again.");
        }
        redirect(base_url() . "cp/viewBanner");
    }
	
	 public function adContent($id = 1){
		 
	   $tbl = "admin_adscms";
	   $where = array("id" => trim($id));
	   
	   
	   if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('youtubeurl', 'Youtube URL', 'trim|required');
            
            $viewData["youtubeurl"] = trim($this->input->post('youtubeurl'));
			
            if ($this->form_validation->run() != FALSE) {
               
                $updateStatus = $this->common_model->updateAdContent($viewData);
                if ($updateStatus) {
				$viewData["report"] = 1;
                $viewData["msg"] = "You have successfully updated the content.";	
                }
            } else {
               $viewData["report"] = 2;
               $viewData["msg"] = "Please try again.";
            }
        }
	         
        
        $selectedData = "";
        $list = $this->common_model->fetchAdContent($tbl, $where, $selectedData);
        $viewData['youtubeurl'] = $list[0]->youtubeurl;
       
       
        unset($viewData["list"]);    
       $this->load->view('adminTemplates/ads/manageadcontent.php', $viewData);
    }
	/********************Manage Discount Link********************/
	public function manageDiscountLink(){
	
		$viewData		=	array();
		
		
		$viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $viewData['for_website'] = $this->forWebsite;
        
       
        $selectedData = "";
        $viewData['navMenu'] = $this->data_model->getMenusList();
        
        
        $config = array();
        $config["base_url"] = base_url() . "cp/viewdiscountlist";
        $config["total_rows"] = $this->common_model->record_count_discountLink();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
		 

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
        $tempList = array();
        $tempList = $this->common_model->fetch_discountLink($config["per_page"], $page);
        
        
        $viewData["list"] = $tempList;
		
        $viewData["links"] = $this->pagination->create_links();
       
        $this->load->view('adminTemplates/manage_discount_list.php', $viewData);
	}
	
	public function createDiscountLink(){
		
		$viewData		=	array();
		$data			=   array();
        $viewData['action'] = 'Add';
        $viewData['fastname'] = '';
        $viewData['lastname'] = '';
		$viewData['website'] = '';
		$viewData['price'] = '';
		$viewData['Dis_price'] = '';
		$viewData['acc_type'] = '';
		
		$link_id  = $this->input->post("link_id");
        $tbl = "ct_discount_link";
		
        if ($this->input->post("submit") != "" ) {				
			
            $data['firstname'] 		= trim($this->input->post('fastname'));
            $data['lastname'] 		= trim($this->input->post('lastname'));
			$data['email'] 			= trim($this->input->post('email'));
            $data['website'] 		= trim($this->input->post('website'));
			$data['price'] 			= trim($this->input->post('price'));
			$data['discount_price'] = trim($this->input->post('Dis_price'));
			$data['account_type'] 	= trim($this->input->post('acc_type'));
			$data['is_used'] 		= 'N';
			
			if($data['account_type'] == "AP")
			{
					$data['paymentlink'] = "https://www.communitytreasures.co/ctdemo/payment/index/" .base64_encode($data['price'])."_".base64_encode($data['discount_price']);
			}
			else if($data['account_type'] == "BB")
			{
					$data['paymentlink'] = "https://www.communitytreasures.co/ctdemo/payment/bbRegistration/" .base64_encode($data['price'])."_".base64_encode($data['discount_price']);
			}
			$data['created_date'] = date("Y-m-d H:i:s");
			if($link_id =="")
			{
				$dd = $this->common_model->insertDataToTable($tbl, $data);
			
				if ($dd) {
					$this->session->set_flashdata("report", 1);
					$this->session->set_flashdata("msg", "You have successfully generate the discount link.");
					redirect(base_url() . "cp/manageDiscountLink");
				} else {
					$viewData["report"] = 2;
					$viewData["msg"] = "Please try again.";
				}
			}
			else if($link_id !=""){
				
				$dd = $this->common_model->updatelinkdata($tbl,$link_id,$data);
				if ($dd) {
					$this->session->set_flashdata("report", 1);
					$this->session->set_flashdata("msg", "You have successfully updated the discount link.");
					redirect(base_url() . "cp/manageDiscountLink");
				} else {
					$viewData["report"] = 2;
					$viewData["msg"] = "Please try again.";
				}
				
			}
			//$this->load->view('adminTemplates/manage_discount_list.php', $viewData);
			redirect(base_url().'cp/manageDiscountLink', 'refresh');
		}
		else{
				$this->load->view('adminTemplates/dis_link_genarate_form.php', $viewData);
		}
    }
	public function editDiscountLink($link_id){
	
		
		//$viewData		=	array();
		$result = $this->common_model->fetch_discountLink_data($link_id);
		
		if(!empty($result))
		{
				$viewData['link_id']  			= $result->link_id;
				$viewData['firstname']  		= $result->firstname;
				$viewData['lastname']  			= $result->lastname;
				$viewData['website']  			= $result->website;
				$viewData['price']  			= $result->price;
				$viewData['discount_price']  	= $result->discount_price;
				$viewData['acc_type']  			= $result->account_type;
				$viewData['paymentlink']  		= $result->paymentlink;			
				
			
			
			$this->load->view('adminTemplates/dis_link_genarate_form', $viewData);
		}
	}
}
