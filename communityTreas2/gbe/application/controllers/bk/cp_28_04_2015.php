<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cp extends CI_Controller {
    public $dataPerPage;
    function __construct() {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->model('admin_user_model');
        $this->load->helper(array('url', 'form'));
        $this->checkLogin();
        $this->dataPerPage = 20;
    }

    public function index() {
        redirect(base_url()."admin");
    }

    public function gbeLevelWiseVideoList() {
        $viewData = array();
        $viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $tbl = "gbe_level_video";
        $where = array();
        $selectedData = "";
        $viewData["list"] = $this->common_model->fetchDataFromTable($tbl,$where,$selectedData);
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
        $base_url = base_url()."cp/viewPayingUser/";
        $total_rows = $this->admin_user_model->getTotalUser($viewData["userType"]);
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $viewData["userList"] = $this->admin_user_model->getUser($viewData["userType"],$per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/user/viewPayingUser.php', $viewData);
    }
    
    public function viewTeacher() {
        $this->checkLogin();
        $viewData = array();
        $viewData["userType"] = "TEACHER";
        $base_url = base_url()."cp/viewTeacher/";
        $total_rows = $this->admin_user_model->getTotalUser($viewData["userType"]);
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $viewData["userList"] = $this->admin_user_model->getUser($viewData["userType"],$per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/user/viewTeacher.php', $viewData);
    }
    
    public function viewStudent() {
        $this->checkLogin();
        $viewData = array();
        $viewData["userType"] = "STUDENT";
        $base_url = base_url()."cp/viewStudent/";
        $total_rows = $this->admin_user_model->getTotalUser($viewData["userType"]);
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $viewData["userList"] = $this->admin_user_model->getUser($viewData["userType"],$per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/user/viewStudent.php', $viewData);
    }
    
    public function viewHeadVolunteer() {
        //'TEACHER','PAYING USER','ADMIN','HEAD VOLUNTEERS','VOLUNTEERS','STUDENT','AFROWEBB'
        $this->checkLogin();
        $viewData = array();
        $viewData["userType"] = "HEAD VOLUNTEERS";
        $base_url = base_url()."cp/viewHeadVolunteer/";
        $total_rows = $this->admin_user_model->getTotalUser($viewData["userType"]);
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $viewData["userList"] = $this->admin_user_model->getUser($viewData["userType"],$per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/user/viewHeadVolunteer.php', $viewData);
    }
    
    public function viewVolunteer() {
        $this->checkLogin();
        $viewData = array();
         $viewData["userType"] = "VOLUNTEERS";
        $base_url = base_url()."cp/viewVolunteer/";
        $total_rows = $this->admin_user_model->getTotalUser($viewData["userType"]);
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) >0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $viewData["userList"] = $this->admin_user_model->getUser($viewData["userType"],$per_page,$page);
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

    public function sendEmailToUserWithCredential() {
        $id = trim($this->input->post('id'));
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            $subject = "Login Credentials of GBE VOLUNTEERS";
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
									<tr><td colspan="2">Here is your login credentials as below.</td></tr>
									<tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
									<tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
									<tr><td colspan="2">Please <a href="' . base_url() . '" target="_blank">click </a>here to login</td></tr>
									<tr><td colspan="2">Thank you very much.</td></tr>
									<tr><td colspan="2">globalblackenterprises.com</td></tr>
							   </table>';
            $eml = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            if ($eml) {
                echo 1;
            } else {
                echo 21;
            }
        } else {
            echo 2;
        }
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

}
