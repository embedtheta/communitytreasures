<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cp extends CI_Controller {
    public $dataPerPage;
	public $forWebsite; // added by SB on 13/08/2015
    function __construct() {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->model('admin_user_model');
        $this->load->helper(array('url', 'form'));
        $this->checkLogin();
        $this->dataPerPage = 20;
		$this->forWebsite = $this->session->userdata('forWebsite');
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
        $total_rows = $this->admin_user_model->getTotalUser($viewData["userType"],$viewData["selectedUserType"]);
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
        $from_email = "otizfangel@gmail.com";
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
        $where = array();
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

}
