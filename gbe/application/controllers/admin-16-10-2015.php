<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {
	public $dataPerPage;
	public $cycleDate1;
	public $cycleDate2;
	public $forWebsite; // added by SB on 13/08/2015
    function __construct() {
        parent::__construct();
        $this->load->model('data_model');
		$this->load->model('current_account_model');
        $this->load->helper(array('url', 'form'));
        /* if(trim($this->session->userdata('userName'))!= ""){
          //redirect(base_url().'gateway/', 'refresh');
          }else if(trim($this->session->userdata('userName'))!= ""){
          redirect(base_url().'admin/dashboard','refresh');
          } */
		$this->dataPerPage = 20; // page per value  added by SB on 27/04/2015
		$this->cycleDate1	= '10'.date('-m-Y');
		$this->cycleDate2	= '25'.date('-m-Y');
		$this->forWebsite = $this->session->userdata('forWebsite');	
    }

    public function index() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('userName', 'userName', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

            $userName = trim($this->input->post('userName'));
            $password = trim($this->input->post('password'));
			
			// added by SB on 12/08/2015
			$forWebsite = trim($this->input->post('forWebsite'));
			
            if ($this->form_validation->run() != FALSE) {
                $result = $this->data_model->login($userName, $password);
                if (!empty($result)) {
                    $this->session->set_userdata('adminId', $result[0]["id"]);
                    $this->session->set_userdata('userName', $result[0]["userName"]);
					
					// set the for website value to session added by SB on 12/08/2015
					$this->session->set_userdata('forWebsite', $forWebsite);
					//echo "++++++".trim($this->session->userdata('forWebsite')); exit;
                    if (trim($this->session->userdata('userName'))) {
                        redirect(base_url() . 'admin/dashboard', 'refresh');
                    }
                } else {
                    $viewData['error'] = "Wrong";
                }
            }
        }
        $this->load->view('adminTemplates/login', $viewData);
    }

    /*     * ***************************** ADMIN DASHBOARD ******************************* */

    public function dashboard() {
        $view_data = array();
		$view_data['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
		//print_r($view_data['navMenu']); exit;
        $this->load->view('adminTemplates/home', $view_data);
    }

    public function logout() {
        $this->session->unset_userdata('userName');
        session_destroy();
        redirect(base_url() . 'admin/', 'refresh');
    }

    public function user_youtube_bck($st = "") {
        $config = array();
        $config["base_url"] = base_url() . "admin/user_youtube";
        $config["total_rows"] = $this->data_model->youtube_count();
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;

        $this->load->library("pagination");
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $view["results"] = $this->data_model->fetch_youtube_member($config["per_page"], $page);
        $view["links"] = $this->pagination->create_links();
        if ($st == "DeleteRequest") {
            $view["st"] = "delete";
        } elseif ($st == "InvalidRequest") {
            $view["st"] = "Invalid";
        }
		$view['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view("adminTemplates/viewyoutubehome", $view);
    }
	
	public function Adduseryoutube_bck() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('youtubeName', 'youtube Name', 'trim|required|callback_test_input');
            $this->form_validation->set_rules('youtubeUrl', 'youtube Url', 'trim|required|callback_valid_url');

            $viewData['youtubeName'] = trim($this->input->post('youtubeName'));
            $viewData['youtubeUrl'] = trim($this->input->post('youtubeUrl'));
            $viewData['status'] = trim($this->input->post('status'));
            if ($this->form_validation->run() != FALSE) {
                $submit = $this->data_model->insertuseryoutube($viewData);
                if ($submit > 0) {
                    redirect(base_url() . 'admin/user_youtube');
                } else {
                    $viewData['err_msg'] = "*Please enter valid details";
                }
            }
        }
        $this->load->view('adminTemplates/insertyoutubeform', $viewData);
    }
	
	public function youtubeMembership_bck($entityid = 0) {
        if ($entityid > 0) {
            $viewData = array();
            $this->load->model('data_model');
            $viewData['rows'] = $this->data_model->getyoutubeDataModel($entityid);
            if (trim($this->input->post('submit'))) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('youtubeName', 'youtube Name', 'trim|required|callback_test_input');
                $this->form_validation->set_rules('youtubeUrl', 'youtube Url', 'trim|required|callback_valid_url');

                $viewData['id'] = $entityid;
                $viewData['youtubeName'] = trim($this->input->post('youtubeName'));
                $viewData['youtubeUrl'] = trim($this->input->post('youtubeUrl'));
                $viewData['status'] = trim($this->input->post('status'));
                if ($this->form_validation->run() != FALSE) {
                    $submit = $this->data_model->updateyoutube($viewData);
                    if ($submit) {
                        redirect(base_url() . 'admin/user_youtube');
                    }
                }
            }
            $this->load->view('adminTemplates/youtubeedit', $viewData);
        } else {
            redirect(base_url() . "admin/user_youtube/InvalidRequest", 'refresh');
        }
    }
	
	
	

    public function deleteEntityyoutube($entityid = 0) {
        if ($entityid > 0) {
            $this->load->model('data_model');
            $del_reqst = $this->data_model->isdelExistyoutube($entityid);
            if ($del_reqst) {
                redirect(base_url() . "admin/user_youtube/DeleteRequest", 'refresh');
            }
        } else {
            redirect(base_url() . "admin/user_youtube/InvalidRequest", 'refresh');
        }
    }

    public function user_youtube($status = "") {
        $config = array();
        $config["base_url"] = base_url() . "admin/user_youtube";
        $config["total_rows"] = $this->data_model->youtube_count();
        $config["per_page"] = $this->dataPerPage;
        $config["uri_segment"] = 3;

        $this->load->library("pagination");
        $this->pagination->initialize($config);
		
        $data['page'] =  ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["userList"] = $this->data_model->fetch_youtube_member($config["per_page"], $data['page']);
		//print_r($data["userList"]);
        $data["pagination"] = $this->pagination->create_links();
		
		$data['report'] = $this->session->flashdata('report');
        $data['msg'] = $this->session->flashdata('msg');
		
		$data['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
		$this->load->view("adminTemplates/Level1Step2PanelC/view", $data);
    }
	
	public function user_youtube_add(){
		$pageId = $this->uri->segment(3);
		$viewData = array();
		$viewData['image'] = '';
		$viewData['image_error'] = '';
		$viewData['error'] = '';
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('youtubeName', 'youtube Name', 'trim|required');
            $this->form_validation->set_rules('youtubeUrl', 'youtube Url', 'trim|required');
           	if ($this->form_validation->run() != FALSE) {
				$insertData['youtubeName'] = trim($this->input->post('youtubeName'));
				$insertData['youtubeUrl'] = trim($this->input->post('youtubeUrl'));
				$insertData['status'] = trim($this->input->post('status'));
				$tbl = 'useryoutube';
				$submitId = $this->common_model->insertDataToTable($tbl , $insertData) ;
				if ($submitId > 0) {
					$this->session->set_flashdata("report", 1);
					$this->session->set_flashdata("msg", "You have successfully added data.");
					redirect(base_url() . "admin/user_youtube/".$pageId);
				} 
			}else{
				$viewData['error'] = 'Please check the error(s) as below.';
			}
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
		$viewData['page'] = $pageId;
		$this->load->view("adminTemplates/Level1Step2PanelC/add", $viewData);
	}
	
	public function user_youtube_edit(){
		$id = $this->uri->segment(3);
		$pageId = $this->uri->segment(4);
		
		$viewData['error'] = '';
		$tbl = 'useryoutube'; 
		$where['id'] = $id;
        if (trim($this->input->post('submit'))) {
			$this->load->library('form_validation');
            $this->form_validation->set_rules('youtubeName', 'youtube Name', 'trim|required');
            $this->form_validation->set_rules('youtubeUrl', 'youtube Url', 'trim|required');
           	if ($this->form_validation->run() != FALSE) {
				$insertData['youtubeName'] = trim($this->input->post('youtubeName'));
				$insertData['youtubeUrl'] = trim($this->input->post('youtubeUrl'));
				$insertData['status'] = trim($this->input->post('status'));
                $submitId = $this->common_model->updateDataToTable($tbl , $where , $insertData) ;
                if ($submitId) {
                    $this->session->set_flashdata("report", 1);
					$this->session->set_flashdata("msg", "You have successfully updated the data.");
					redirect(base_url() . "admin/user_youtube/".$pageId);
                }
            }else{
				$viewData['error'] = 'Please check the error(s) as below.';
			}
            
        }
		$selectedData = '';
		$viewData['details'] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
		$viewData['page'] = $pageId;
		$this->load->view("adminTemplates/Level1Step2PanelC/edit", $viewData);
	}
	
	public function user_youtube_delete(){
		
		$id = $this->uri->segment(3);
		$pageId = $this->uri->segment(4);
		$tbl = 'useryoutube'; 
		$where['id'] = $id;
		
		$this->common_model->deleteDataFromTable($tbl , $where);
		$this->session->set_flashdata("report", 1);
		$this->session->set_flashdata("msg", "You have successfully Deleted the data.");
		redirect(base_url() . "admin/user_youtube/".$pageId);
	}
	

    public function user_advert_view($status = "") {
        $config = array();
        $config["base_url"] = base_url() . "admin/user_advert_view";
        $config["total_rows"] = $this->data_model->record_count();
        $config["per_page"] = $this->dataPerPage;
        $config["uri_segment"] = 3;

        $this->load->library("pagination");
        $this->pagination->initialize($config);
		
        $data['page'] =  ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["userList"] = $this->data_model->fetch_advert_member($config["per_page"], $data['page']);
		//print_r($data["userList"]);
        $data["pagination"] = $this->pagination->create_links();
		
		$data['report'] = $this->session->flashdata('report');
        $data['msg'] = $this->session->flashdata('msg');
		
		$data['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
		$this->load->view("adminTemplates/Level1Step2PanelF/view", $data);
    }
	
	public function user_advert_add(){
		$pageId = $this->uri->segment(3);
		$viewData = array();
		$viewData['image'] = '';
		$viewData['image_error'] = '';
		$viewData['error'] = '';
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('advertTitle', 'advert Title', 'trim|required');
            $viewData['advertTitle'] = trim($this->input->post('advertTitle'));
			
            if (!empty($_FILES['image']['name'])) {
               	$imgDet = $this->user_advert_image_upload(0);
				if($imgDet['status'] == 1){
					$viewData['image'] = $imgDet['fileName'];
				}else{
					$viewData['image_error'] = $imgDet['image_error'];
				}
            }else{
				$viewData['image_error'] = 'Please select a Image.';
			}
            if ($this->form_validation->run() != FALSE && !empty($_FILES['image']['name']) && !empty($viewData['image'])) {
				$insertData['advertTitle'] = $viewData['advertTitle'];
				$insertData['advertImg'] = $viewData['image'];
				$insertData['forWebsite'] = $this->forWebsite;
				$tbl = 'useradvert';
                $submitId = $this->common_model->insertDataToTable($tbl , $insertData) ;
                if ($submitId > 0) {
                    $this->session->set_flashdata("report", 1);
					$this->session->set_flashdata("msg", "You have successfully added data.");
					redirect(base_url() . "admin/user_advert_view/".$pageId);
                }
            }else{
				$viewData['error'] = 'Please check the error(s) as below.';
			}
            
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
		$viewData['page'] = $pageId;
		$this->load->view("adminTemplates/Level1Step2PanelF/add", $viewData);
	}
	
	public function user_advert_edit(){
		$id = $this->uri->segment(3);
		$pageId = $this->uri->segment(4);
		
		$data['image'] = '';
		$data['image_error'] = '';
		$data['error'] = '';
		$tbl = 'useradvert'; 
		$where['advertID'] = $id;
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('advertTitle', 'advert Title', 'trim|required');
            $data['advertTitle'] = trim($this->input->post('advertTitle'));
			
            if (!empty($_FILES['image']['name'])) {
               	$imgDet = $this->user_advert_image_upload($id);
				if($imgDet['status'] == 1){
					$data['image'] = $imgDet['fileName'];
				}
            }else{
				$data['image_error'] = 'Please select a Image.';
			}
            if ($this->form_validation->run() != FALSE ) {
				$insertData['advertTitle'] = $data['advertTitle'];
				if(!empty($_FILES['image']['name']) && !empty($data['image'])){
					$insertData['advertImg'] = $data['image'];
				}
                $submitId = $this->common_model->updateDataToTable($tbl , $where , $insertData) ;
                if ($submitId) {
                    $this->session->set_flashdata("report", 1);
					$this->session->set_flashdata("msg", "You have successfully updated the data.");
					redirect(base_url() . "admin/user_advert_view/".$pageId);
                }
            }else{
				$data['error'] = 'Please check the error(s) as below.';
			}
            
        }
		$selectedData = '';
		$data['details'] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		$data['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
		$data['page'] = $pageId;
		$this->load->view("adminTemplates/Level1Step2PanelF/edit", $data);
	}
	
	public function user_advert_image_upload($id){
		$retData = array();
		$retData['status'] = 2;//1=suc;2=error
		$retData['image_error'] = '';
		$retData['fileName'] = '';
		$extension = array("jpg", "png", "gif", "jpeg");
		$name = explode(".", $_FILES['image']['name']);
		$ext = strtolower(end($name));
		if (in_array($ext, $extension)) {
			$t1 = time();
			$document2 = '';
			$img2 = '';
			$image2 = $_FILES['image']['name'];
			$image2 = $t1 . $image2;
			$tname2 = $_FILES['image']['tmp_name'];
			$document2 = "adminuploads/advert/" . $image2;
			$img2 = $image2;
			if (!empty($img2) && $img2 != '') {
				if($id > 0){
					$tbl = 'useradvert'; 
					$where['advertID'] = $id;
					$selectedData = '';
					$details = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
					if(!empty($details)){
						if($details[0]->advertImg != ''){
							 $path = 'adminuploads/advert/'.$details[0]->advertImg;
							 $this->user_advert_image_unlink($path);
						}
					}
				}
				move_uploaded_file($tname2, $document2);
				$retData['status'] = 1;//1=suc;2=error
				$retData['fileName'] = $image2;
			}
		}else{
			$retData['image_error'] = "Invalid Image type";
		}
		return $retData;
	}
	
	public function user_advert_delete(){
		
		$id = $this->uri->segment(3);
		$pageId = $this->uri->segment(4);
		$tbl = 'useradvert'; 
		$where['advertID'] = $id;
		$selectedData = '';
		$details = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		
		if(!empty($details)){
			if($details[0]->advertImg != ''){
				 $path = 'adminuploads/advert/'.$details[0]->advertImg;
				 $this->user_advert_image_unlink($path);
			}
		}
				
		$this->common_model->deleteDataFromTable($tbl , $where);
		$this->session->set_flashdata("report", 1);
		$this->session->set_flashdata("msg", "You have successfully Deleted the data.");
		redirect(base_url() . "admin/user_advert_view/".$pageId);
	}
	
	function user_advert_image_unlink($val){
		$path = $this->common_model->imageUnlinkPath().$val;
		if(file_exists($path)){
			 unlink($path);
		}
		return true;
	}

    function edMembership($entityid = 0) {
        if ($entityid > 0) {
            $viewData = array();
            $this->load->model('data_model');
            $viewData['rows'] = $this->data_model->getDataModel($entityid);
            if (trim($this->input->post('submit'))) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('advertTitle', 'advert Title', 'trim|required|callback_test_input');
                $viewData['advertID'] = $entityid;
                $viewData['advertTitle'] = trim($this->input->post('advertTitle'));
                $viewData['status'] = trim($this->input->post('status'));
                if (!empty($_FILES['image']['name'])) {
                    $extension = array("jpg", "png", "gif", "jpeg");
                    $name = explode(".", $_FILES['image']['name']);
                    $ext = strtolower(end($name));
                    if (in_array($ext, $extension)) {
                        $t1 = time();
                        $document2 = '';
                        $img2 = '';
                        $image2 = $_FILES['image']['name'];
                        $image2 = $t1 . $image2;
                        $tname2 = $_FILES['image']['tmp_name'];
                        $document2 = "adminuploads/advert/" . $image2;
                        $img2 = $image2;

                        if (!empty($img2) && $img2 != '') {
                            move_uploaded_file($tname2, $document2);
                            //$this->resizeimg($img2,base_url()."adminuploads/advert/".DIRECTORY_SEPARATOR,'','200','200');
                        }
                        $viewData['image'] = $image2;
                    } else {
                        $viewData['image_error'] = "Invalid Image type";
                    }
                }
                if ($this->form_validation->run() != FALSE || empty($viewData['image_error'])) {
                    $submit = $this->data_model->updateMembershipModel($viewData);
                    if ($submit > 0) {
                        redirect(base_url() . "admin/user_advert", 'refresh');
                    }
                } elseif (!empty($viewData['image_error'])) {
                    $viewData['image_error'] = "*Invalid Image type only supported(jpg|gif|png)";
                } else {
                    $viewData['err_msg'] = "*Image field is Required";
                }
            }
            $this->load->view('adminTemplates/editform', $viewData);
        } else {
            redirect(base_url() . "admin/user_advert/InvalidRequest", 'refresh');
        }
    }

    public function Adduseradvert() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('advertTitle', 'advert Title', 'trim|required|callback_test_input');
            $this->form_validation->set_rules('status', 'status', 'trim|required');

            $viewData['advertTitle'] = trim($this->input->post('advertTitle'));
            $viewData['status'] = trim($this->input->post('status'));
            if (!empty($_FILES['image']['name'])) {
                $extension = array("jpg", "png", "gif", "jpeg");
                $name = explode(".", $_FILES['image']['name']);
                $ext = strtolower(end($name));
                if (in_array($ext, $extension)) {
                    $t1 = time();
                    $document2 = '';
                    $img2 = '';
                    $image2 = $_FILES['image']['name'];
                    $image2 = $t1 . $image2;
                    $tname2 = $_FILES['image']['tmp_name'];
                    $document2 = "adminuploads/advert/" . $image2;
                    $img2 = $image2;
                    if (!empty($img2) && $img2 != '') {
                        move_uploaded_file($tname2, $document2);
                    }
                    $viewData['image'] = $image2;
                } else {
                    $viewData['image_error'] = "Invalid Image type";
                }
            }
            if ($this->form_validation->run() != FALSE && !empty($_FILES['image']['name']) && !empty($viewData['image'])) {
                $submit = $this->data_model->insertuseradvert($viewData);
                if ($submit > 0) {
                    redirect(base_url() . "admin/user_advert", 'refresh');
                }
            } elseif (!empty($viewData['image_error'])) {
                $viewData['image_error'] = "*Invalid Image type only supported(jpg|gif|png)";
            } else {
                $viewData['err_msg'] = "*Image field is Required";
            }
        }
        $this->load->view('adminTemplates/insertadvertform', $viewData);
    }

    public function deleteEntity($entityid = 0) {
        if ($entityid > 0) {
            $this->load->model('data_model');
            $del_reqst = $this->data_model->isdelExist($entityid);
            if ($del_reqst) {
                redirect(base_url() . "admin/user_advert/DeleteRequest", 'refresh');
            }
        } else {
            redirect(base_url() . "admin/user_advert/InvalidRequest", 'refresh');
        }
    }

    public function user_banner($status = "") {
        $config = array();
        $config["base_url"] = base_url() . "admin/user_banner";
        $config["total_rows"] = $this->data_model->banner_count();
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        $this->load->library("pagination");
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->data_model->fetch_banner_member($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        if ($status == "DeleteRequest") {
            $data["status"] = "delete";
        } elseif ($status == "InvalidRequest") {
            $data["status"] = "Invalid";
        }
		$data['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view("adminTemplates/viewuserbanner", $data);
    }

    public function bannerMembership($entityid = 0) {
        if ($entityid > 0) {
            $viewData = array();
            $this->load->model('data_model');
            $viewData['rows'] = $this->data_model->getbannerDataModel($entityid);
            if (trim($this->input->post('submit'))) {
                $this->load->library('form_validation');
                $viewData['bannerID'] = $entityid;
                $viewData['status'] = trim($this->input->post('status'));
                if (!empty($_FILES['image']['name'])) {
                    $extension = array("jpg", "png", "gif", "jpeg");
                    $name = explode(".", $_FILES['image']['name']);
                    $ext = strtolower(end($name));
                    if (in_array($ext, $extension)) {
                        $t1 = time();
                        $document2 = '';
                        $img2 = '';
                        $image2 = $_FILES['image']['name'];
                        $image2 = $t1 . $image2;
                        $tname2 = $_FILES['image']['tmp_name'];
                        $document2 = "adminuploads/banner/" . $image2;
                        $img2 = $image2;
                        if (!empty($img2) && $img2 != '') {
                            move_uploaded_file($tname2, $document2);
                            //$this->resizeimg($img2,'uploads'.DIRECTORY_SEPARATOR,'','200','200');
                        }
                        $viewData['image'] = $image2;
                    } else {
                        $viewData['image_error'] = "Invalid Image type";
                    }
                }
                if ($this->form_validation->run() != FALSE || empty($viewData['image_error'])) {
                    $submit = $this->data_model->updatebanner($viewData);
                    if ($submit > 0) {
                        redirect(base_url() . 'admin/user_banner');
                    }
                } elseif (!empty($viewData['image_error'])) {
                    $viewData['image_error'] = "*Invalid Image type only supported(jpg|gif|png)";
                } else {
                    $viewData['err_msg'] = "*Image field is Required";
                }
            }
            $this->load->view('adminTemplates/banneredit', $viewData);
        } else {
            redirect(base_url() . "admin/user_banner/InvalidRequest", 'refresh');
        }
    }

    public function Adduserbanner() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $viewData['status'] = trim($this->input->post('status'));
			$viewData['forWebsite'] = $this->forWebsite;
            if (!empty($_FILES['image']['name'])) {
                $extension = array("jpg", "png", "gif");
                $name = explode(".", $_FILES['image']['name']);
                $ext = strtolower(end($name));
                if (in_array($ext, $extension)) {
                    $t1 = time();
                    $document2 = '';
                    $img2 = '';
                    $image2 = $_FILES['image']['name'];
                    $image2 = $t1 . $image2;
                    $tname2 = $_FILES['image']['tmp_name'];
                    $document2 = "adminuploads/banner/" . $image2;
                    $img2 = $image2;
                    if (!empty($img2) && $img2 != '') {
                        move_uploaded_file($tname2, $document2);
                        //$this->resizeimg($img2,'uploads'.DIRECTORY_SEPARATOR,'','200','200');
                    }
                    $viewData['image'] = $image2;
                } else {
                    $viewData['image_error'] = "Invalid Image type";
                }
            }
            if ($this->form_validation->run() != FALSE || !empty($_FILES['image']['name']) && !empty($viewData['image'])) {
                $submit = $this->data_model->insertuserbanner($viewData);
                if ($submit > 0) {
                    redirect(base_url() . 'admin/user_banner');
                }
            } elseif (!empty($viewData['image_error'])) {
                $viewData['image_error'] = "*Invalid Image type only supported(jpg|gif|png)";
            } else {
                $viewData['err_msg'] = "*Image field is Required";
            }
        }
        $this->load->view('adminTemplates/insertbannerform', $viewData);
    }

    public function deleteEntitybanner($entityid = 0) {
        if ($entityid > 0) {
            $this->load->model('data_model');
            $del_reqst = $this->data_model->isdelExistbanner($entityid);
            if ($del_reqst) {
                redirect(base_url() . "admin/user_banner/DeleteRequest", 'refresh');
            }
        } else {
            redirect(base_url() . "admin/user_banner/InvalidRequest", 'refresh');
        }
    }

    public function test_input($str) {
        $pattern = "/^([-a-z_ ])+$/i";
        if (!preg_match($pattern, $str)) {
            $this->form_validation->set_message('test_input', 'The %s field only supported charecters');
            return FALSE;
        }
        return TRUE;
    }

    /*     * ******************************************************************
      PRODUCT PAGE BACK END
      /******************************************************************* */

    public function viewCreative() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        
        $viewData["infoCreative"] = $this->data_model->getCreativeDetails();
        
        $this->load->view('adminTemplates/creative/viewCreative', $viewData);
    }

    public function addCreative() {
        $viewData = array();
		$viewData["menuTypes"] = $this->data_model->getMenusList();
		$viewData["articleTypes"] = $this->data_model->getArticleList();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('articleTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('articleDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
			
			$viewData["menuTypeID"] = trim($this->input->post('articleMenu'));
			$viewData["fashionPosition"] = trim($this->input->post('fashionPosition'));
			$viewData["articleTypeID"] = 0;
			if(trim($this->input->post('articleType'))!='')
			{
				$viewData["articleTypeID"] = trim($this->input->post('articleType'));
			}
			
            $viewData["articleTitle"] = trim($this->input->post('articleTitle'));
			if(trim($this->input->post('short_name'))!=''){
				$viewData["short_name"] = trim($this->input->post('short_name'));
			}else{
				$viewData["short_name"] = trim($this->input->post('articleTitle'));
			}
			 
            $viewData["articleDesc"] = trim($this->input->post('articleDesc'));
            $viewData["articleImg"] = $_FILES['image']['name'];
            $viewData["articleStatus"] = trim($this->input->post('creativeStatus'));
			
            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertArticleDetails($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewCreative/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewCreative/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
       // $this->load->view('adminTemplates/creative/addCreative', $viewData);// blocked by SB 24/04/2015
	    $this->load->view('adminTemplates/articles/addArticle', $viewData);
    }
	 public function addArticle() {
        $viewData = array();
		$viewData['selectedMenuId'] = trim($this->uri->segment(3));// added by SB on 05/08/2015
		$viewData["menuTypes"] = $this->data_model->getMenusList();
		$viewData["articleTypes"] = $this->data_model->getArticleList($viewData['selectedMenuId']);// menu id passed Added by Sb on 05/08/2015
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('articleTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('articleDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
			
			$viewData["menuTypeID"] = trim($this->input->post('articleMenu'));
			$viewData["fashionPosition"] = trim($this->input->post('fashionPosition'));
			$viewData["articleTypeID"] = 0;
			if(trim($this->input->post('articleType'))!='')
			{
				$viewData["articleTypeID"] = trim($this->input->post('articleType'));
			}
			
            $viewData["articleTitle"] = trim($this->input->post('articleTitle'));
			if(trim($this->input->post('short_name'))!=''){
				$viewData["short_name"] = trim($this->input->post('short_name'));
			}else{
				$viewData["short_name"] = trim($this->input->post('articleTitle'));
			}
            $viewData["articleDesc"] = trim($this->input->post('articleDesc'));
            $viewData["articleImg"] = $_FILES['image']['name'];
            $viewData["articleStatus"] = trim($this->input->post('articleStatus'));
			
            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertArticleDetails($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewArticles/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewArticles/".$viewData['selectedMenuId']."?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
       // $this->load->view('adminTemplates/creative/addCreative', $viewData);// blocked by SB 24/04/2015
	    $this->load->view('adminTemplates/articles/addArticle', $viewData);
    }
	
	public function getArticleList(){
	 
		$selectedMenu = trim($_POST["selectedMenu"]);
		$articleArr = $this->data_model->getArticleList($selectedMenu);
		$articleList = '';
		$articleList.='<option value="" >Please Select </option>';
		foreach($articleArr as $articleVal){
			$articleList.= '<option value="'.$articleVal['id'].'">'.$articleVal['title'].'</option>';
		}
		echo $articleList;
	}
	
// Added by SB on 29/04/2015
	 public function editArticle($articleID = 0) {
        $viewData = array();
		$viewData["menuTypes"] = $this->data_model->getMenusList();
		$viewData["articleTypes"] = $this->data_model->getArticleList();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('articleID', 'Article ID ', 'trim|required');
            $this->form_validation->set_rules('articleTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('articleDesc', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["articleImg"] = $_FILES['image']['name'];
            }
            $viewData["articleID"] = trim($this->input->post('articleID'));
			$viewData["menuID"] = trim($this->input->post('menuID'));
            $viewData["articleTitle"] = trim($this->input->post('articleTitle'));
			if(trim($this->input->post('short_name'))!=''){
				$viewData["short_name"] = trim($this->input->post('short_name'));
			}else{
				$viewData["short_name"] = trim($this->input->post('articleTitle'));
			}
            $viewData["articleDesc"] = trim($this->input->post('articleDesc'));
            $viewData["articleStatus"] = trim($this->input->post('articleStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateArticleData($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewCreative/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewArticles/".$viewData["menuID"]."?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoArticle"] = $this->data_model->getIndividualArticleData($articleID);
        if (empty($viewData["infoArticle"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view('adminTemplates/articles/editArticle', $viewData);
    }
    public function editCreative($creativeID = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('creativeID', 'Creative ID ', 'trim|required');
            $this->form_validation->set_rules('creativeTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('creativeDesc', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["creativeImg"] = $_FILES['image']['name'];
            }
            $viewData["creativeID"] = trim($this->input->post('creativeID'));
            $viewData["creativeTitle"] = trim($this->input->post('creativeTitle'));
            $viewData["creativeDesc"] = trim($this->input->post('creativeDesc'));
            $viewData["creativeStatus"] = trim($this->input->post('creativeStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateCreativeData($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewCreative/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewCreative/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoCreative"] = $this->data_model->getIndividualCreativeData($creativeID);
        if (empty($viewData["infoCreative"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/creative/editCreative', $viewData);
    }

    public function deleteCreative($creativeID = 0) {
        if ($creativeID > 0) {
            $delRequst = $this->data_model->deleteCreativeData($creativeID);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewCreative/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewCreative/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewCreative/?action=delError', 'refresh');
        }
    }
 // added by Sb on 29/04/2015
	public function deleteArticle($articleID = 0,$menuID) {
        if ($articleID > 0) {
            $delRequst = $this->data_model->deleteArticleData($articleID);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewArticles/'.$menuID.'?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewArticles/'.$menuID.'?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewArticles/'.$menuID.'?action=delError', 'refresh');
        }
    }
    public function viewEventsCelebrations() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoEventsCelebrations"] = $this->data_model->getEventsCelebrations();
        $this->load->view('adminTemplates/eventsCelebrations/viewEventsCelebrations', $viewData);
    }

    public function addEventsCelebrations() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('eventTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('eventDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["eventTitle"] = trim($this->input->post('eventTitle'));
            $viewData["eventDesc"] = trim($this->input->post('eventDesc'));
            $viewData["eventImg"] = $_FILES['image']['name'];
            $viewData["eventStatus"] = trim($this->input->post('eventStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertEventsCelebrationsDetails($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewEventsCelebrations/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewEventsCelebrations/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/eventsCelebrations/addEventsCelebrations', $viewData);
    }

    public function editEventsCelebrations($eventID = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('eventID', 'Event ID ', 'trim|required');
            $this->form_validation->set_rules('eventTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('eventDesc', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["eventImg"] = $_FILES['image']['name'];
            }
            $viewData["eventID"] = trim($this->input->post('eventID'));
            $viewData["eventTitle"] = trim($this->input->post('eventTitle'));
            $viewData["eventDesc"] = trim($this->input->post('eventDesc'));
            $viewData["eventStatus"] = trim($this->input->post('eventStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateEventsCelebrations($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewEventsCelebrations/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewEventsCelebrations/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoEventsCelebrations"] = $this->data_model->getIndividualEventsCelebrations($eventID);
        if (empty($viewData["infoEventsCelebrations"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/eventsCelebrations/editEventsCelebrations', $viewData);
    }

    public function deleteEventsCelebrations($eventID = 0) {
        if ($eventID > 0) {
            $delRequst = $this->data_model->deleteEventsCelebrations($eventID);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewEventsCelebrations/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewEventsCelebrations/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewEventsCelebrations/?action=delError', 'refresh');
        }
    }

    public function viewTripsHolidays() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoTripsHolidays"] = $this->data_model->getTripsHolidays();
        $this->load->view('adminTemplates/tripsHolidays/viewTripsHolidays', $viewData);
    }

    public function addTripsHolidays() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('tripTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('tripDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["tripTitle"] = trim($this->input->post('tripTitle'));
            $viewData["tripDesc"] = trim($this->input->post('tripDesc'));
            $viewData["tripImg"] = $_FILES['image']['name'];
            $viewData["tripStatus"] = trim($this->input->post('tripStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertTripsHolidays($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewTripsHolidays/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewTripsHolidays/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/tripsHolidays/addTripsHolidays', $viewData);
    }

    public function editTripsHolidays($tripID = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('tripID', 'trip ID ', 'trim|required');
            $this->form_validation->set_rules('tripTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('tripDesc', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["tripImg"] = $_FILES['image']['name'];
            }
            $viewData["tripID"] = trim($this->input->post('tripID'));
            $viewData["tripTitle"] = trim($this->input->post('tripTitle'));
            $viewData["tripDesc"] = trim($this->input->post('tripDesc'));
            $viewData["tripStatus"] = trim($this->input->post('tripStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateTripsHolidays($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewTripsHolidays/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewTripsHolidays/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoTripsHolidays"] = $this->data_model->getIndividualTripsHolidays($tripID);
        if (empty($viewData["infoTripsHolidays"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/tripsHolidays/editTripsHolidays', $viewData);
    }

    public function deleteTripsHolidays($tripID = 0) {
        if ($tripID > 0) {
            $delRequst = $this->data_model->deleteTripsHolidays($tripID);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewTripsHolidays/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewTripsHolidays/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewTripsHolidays/?action=delError', 'refresh');
        }
    }

    public function viewLatestFashionStyle() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoLatestFashionStyle"] = $this->data_model->getLatestFashionStyle();
        $this->load->view('adminTemplates/latestFashionStyle/viewLatestFashionStyle', $viewData);
    }

    public function addLatestFashionStyle() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fashionTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('fashionDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('fashionPosition', 'Fashion Position ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["fashionTitle"] = trim($this->input->post('fashionTitle'));
            $viewData["fashionDesc"] = trim($this->input->post('fashionDesc'));
            $viewData["fashionPosition"] = trim($this->input->post('fashionPosition'));
            $viewData["fashionImg"] = $_FILES['image']['name'];
            $viewData["fashionStatus"] = trim($this->input->post('fashionStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertLatestFashionStyle($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewLatestFashionStyle/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewLatestFashionStyle/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/latestFashionStyle/addLatestFashionStyle', $viewData);
    }

    public function editLatestFashionStyle($fashionID = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fashionID', 'fashion ID ', 'trim|required');
            $this->form_validation->set_rules('fashionTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('fashionDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('fashionPosition', 'Fashion Position ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["fashionImg"] = $_FILES['image']['name'];
            }
            $viewData["fashionID"] = trim($this->input->post('fashionID'));
            $viewData["fashionTitle"] = trim($this->input->post('fashionTitle'));
            $viewData["fashionDesc"] = trim($this->input->post('fashionDesc'));
            $viewData["fashionPosition"] = trim($this->input->post('fashionPosition'));
            $viewData["fashionStatus"] = trim($this->input->post('fashionStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateLatestFashionStyle($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewLatestFashionStyle/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewLatestFashionStyle/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoLatestFashionStyle"] = $this->data_model->getIndividualLatestFashionStyle($fashionID);
        if (empty($viewData["infoLatestFashionStyle"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/latestFashionStyle/editLatestFashionStyle', $viewData);
    }

    public function deleteLatestFashionStyle($fashionID = 0) {
        if ($fashionID > 0) {
            $delRequst = $this->data_model->deleteLatestFashionStyle($fashionID);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewLatestFashionStyle/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewLatestFashionStyle/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewLatestFashionStyle/?action=delError', 'refresh');
        }
    }

    public function viewNewsZone() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoNewsZone"] = $this->data_model->getNewsZone();
        $this->load->view('adminTemplates/newsZone/viewNewsZone', $viewData);
    }

    public function addNewsZone() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('newsTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('newsDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["newsTitle"] = trim($this->input->post('newsTitle'));
            $viewData["newsDesc"] = trim($this->input->post('newsDesc'));
            $viewData["newsImg"] = $_FILES['image']['name'];
            $viewData["newsStatus"] = trim($this->input->post('newsStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertNewsZone($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewNewsZone/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewNewsZone/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/newsZone/addNewsZone', $viewData);
    }

    public function editNewsZone($newsID = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('newsID', 'news ID ', 'trim|required');
            $this->form_validation->set_rules('newsTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('newsDesc', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["newsImg"] = $_FILES['image']['name'];
            }
            $viewData["newsID"] = trim($this->input->post('newsID'));
            $viewData["newsTitle"] = trim($this->input->post('newsTitle'));
            $viewData["newsDesc"] = trim($this->input->post('newsDesc'));
            $viewData["newsStatus"] = trim($this->input->post('newsStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateNewsZone($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewNewsZone/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewNewsZone/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoNewsZone"] = $this->data_model->getIndividualNewsZone($newsID);
        if (empty($viewData["infoNewsZone"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/newsZone/editNewsZone', $viewData);
    }

    public function deleteNewsZone($newsID = 0) {
        if ($newsID > 0) {
            $delRequst = $this->data_model->deleteNewszone($newsID);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewNewsZone/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewNewsZone/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewNewsZone/?action=delError', 'refresh');
        }
    }

    public function viewMentorship() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoMentorship"] = $this->data_model->getMentorship();
        $this->load->view('adminTemplates/mentorship/viewMentorship', $viewData);
    }

    public function addMentorship() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('mentorTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('mentorDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["mentorTitle"] = trim($this->input->post('mentorTitle'));
            $viewData["mentorDesc"] = trim($this->input->post('mentorDesc'));
            $viewData["mentorImg"] = $_FILES['image']['name'];
            $viewData["mentorStatus"] = trim($this->input->post('mentorStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertMentorship($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewMentorship/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewMentorship/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/mentorship/addMentorship', $viewData);
    }

    public function editMentorship($mentorID = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('mentorID', 'mentor ID ', 'trim|required');
            $this->form_validation->set_rules('mentorTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('mentorDesc', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["mentorImg"] = $_FILES['image']['name'];
            }
            $viewData["mentorID"] = trim($this->input->post('mentorID'));
            $viewData["mentorTitle"] = trim($this->input->post('mentorTitle'));
            $viewData["mentorDesc"] = trim($this->input->post('mentorDesc'));
            $viewData["mentorStatus"] = trim($this->input->post('mentorStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateMentorship($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewMentorship/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewMentorship/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoMentorship"] = $this->data_model->getIndividualMentorship($mentorID);
        if (empty($viewData["infoMentorship"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/mentorship/editMentorship', $viewData);
    }

    public function deleteMentorship($mentorID = 0) {
        if ($mentorID > 0) {
            $delRequst = $this->data_model->deleteMentorship($mentorID);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewMentorship/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewMentorship/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewMentorship/?action=delError', 'refresh');
        }
    }

    public function viewBusinessConsultants() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoBusinessConsultants"] = $this->data_model->getBusinessConsultants();
        $this->load->view('adminTemplates/businessConsultants/viewBusinessConsultants', $viewData);
    }

    public function addBusinessConsultants() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('businessTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('businessDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["businessTitle"] = trim($this->input->post('businessTitle'));
            $viewData["businessDesc"] = trim($this->input->post('businessDesc'));
            $viewData["businessImg"] = $_FILES['image']['name'];
            $viewData["businessStatus"] = trim($this->input->post('businessStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertBusinessConsultant($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewBusinessConsultants/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewBusinessConsultants/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/businessConsultants/addBusinessConsultants', $viewData);
    }

    public function editBusinessConsultants($businessID = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('businessID', 'business ID ', 'trim|required');
            $this->form_validation->set_rules('businessTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('businessDesc', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["businessImg"] = $_FILES['image']['name'];
            }
            $viewData["businessID"] = trim($this->input->post('businessID'));
            $viewData["businessTitle"] = trim($this->input->post('businessTitle'));
            $viewData["businessDesc"] = trim($this->input->post('businessDesc'));
            $viewData["businessStatus"] = trim($this->input->post('businessStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateBusinessConsultants($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewBusinessConsultants/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewBusinessConsultants/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoBusinessConsultants"] = $this->data_model->getIndividualBusinessConsultants($businessID);
        if (empty($viewData["infoBusinessConsultants"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/businessConsultants/editBusinessConsultants', $viewData);
    }

    public function deleteBusinessConsultants($businessID = 0) {
        if ($businessID > 0) {
            $delRequst = $this->data_model->deleteBusinessConsultants($businessID);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewBusinessConsultants/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewBusinessConsultants/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewBusinessConsultants/?action=delError', 'refresh');
        }
    }

    public function viewArticleZone() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoArticleZone"] = $this->data_model->getArticleZone();
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view('adminTemplates/articleZone/viewArticleZone', $viewData);
    }

    public function addArticleZone() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('articleTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('articleDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('articleAuthor', 'Author ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["articleTitle"] = trim($this->input->post('articleTitle'));
            $viewData["articleDesc"] = trim($this->input->post('articleDesc'));
            $viewData["articleAuthor"] = trim($this->input->post('articleAuthor'));
            $viewData["articleImg"] = $_FILES['image']['name'];
            $viewData["articleStatus"] = trim($this->input->post('articleStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertArticleZone($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewArticleZone/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewArticleZone/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/articleZone/addArticleZone', $viewData);
    }

    public function editArticleZone($articleID = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('articleID', 'article ID ', 'trim|required');
            $this->form_validation->set_rules('articleTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('articleDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('articleAuthor', 'Author ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["articleImg"] = $_FILES['image']['name'];
            }
            $viewData["articleID"] = trim($this->input->post('articleID'));
            $viewData["articleTitle"] = trim($this->input->post('articleTitle'));
            $viewData["articleDesc"] = trim($this->input->post('articleDesc'));
            $viewData["articleAuthor"] = trim($this->input->post('articleAuthor'));
            $viewData["articleStatus"] = trim($this->input->post('articleStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateArticleZone($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewArticleZone/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewArticleZone/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoArticleZone"] = $this->data_model->getIndividualArticleZone($articleID);
        if (empty($viewData["infoArticleZone"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/articleZone/editArticleZone', $viewData);
    }

    public function deleteArticleZone($articleID = 0) {
        if ($articleID > 0) {
            $delRequst = $this->data_model->deleteArticleZone($articleID);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewArticleZone/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewArticleZone/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewArticleZone/?action=delError', 'refresh');
        }
    }

    public function viewWebBuilder() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoWebBuilder"] = $this->data_model->getWebBuilder();
        $this->load->view('adminTemplates/webBuilder/viewWebBuilder', $viewData);
    }

    public function addWebBuilder() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('builderTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('builderUrl', 'builder Url ', 'trim|required|callback_valid_url');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["builderTitle"] = trim($this->input->post('builderTitle'));
            $viewData["builderUrl"] = trim($this->input->post('builderUrl'));
            $viewData["builderImg"] = $_FILES['image']['name'];
            $viewData["builderStatus"] = trim($this->input->post('builderStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertWebBuilder($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewWebBuilder/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewWebBuilder/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/webBuilder/addWebBuilder', $viewData);
    }

    public function editWebBuilder($builderId = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('builderId', 'builder Id ', 'trim|required');
            $this->form_validation->set_rules('builderTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('builderUrl', 'builder Url ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["builderImg"] = $_FILES['image']['name'];
            }
            $viewData["builderId"] = trim($this->input->post('builderId'));
            $viewData["builderTitle"] = trim($this->input->post('builderTitle'));
            $viewData["builderUrl"] = trim($this->input->post('builderUrl'));
            $viewData["builderStatus"] = trim($this->input->post('builderStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateWebBuilder($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewWebBuilder/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewWebBuilder/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoWebBuilder"] = $this->data_model->getIndividualWebBuilder($builderId);
        if (empty($viewData["infoWebBuilder"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/webBuilder/editWebBuilder', $viewData);
    }

    public function deleteWebBuilder($builderId = 0) {
        if ($builderId > 0) {
            $delRequst = $this->data_model->deleteWebBuilder($builderId);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewWebBuilder/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewWebBuilder/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewWebBuilder/?action=delError', 'refresh');
        }
    }

    public function viewSecurity() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoSecurity"] = $this->data_model->getSecurity();
        $this->load->view('adminTemplates/security/viewSecurity', $viewData);
    }

    public function addSecurity() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('securityTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('securityUrl', 'builder Url ', 'trim|required|callback_valid_url');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["securityTitle"] = trim($this->input->post('securityTitle'));
            $viewData["securityUrl"] = trim($this->input->post('securityUrl'));
            $viewData["securityImg"] = $_FILES['image']['name'];
            $viewData["securityStatus"] = trim($this->input->post('securityStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertSecurity($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewSecurity/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewSecurity/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/security/addSecurity', $viewData);
    }

    public function editSecurity($securityId = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('securityId', 'security Id ', 'trim|required');
            $this->form_validation->set_rules('securityTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('securityUrl', 'builder Url ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["securityImg"] = $_FILES['image']['name'];
            }
            $viewData["securityId"] = trim($this->input->post('securityId'));
            $viewData["securityTitle"] = trim($this->input->post('securityTitle'));
            $viewData["securityUrl"] = trim($this->input->post('securityUrl'));
            $viewData["securityStatus"] = trim($this->input->post('securityStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateSecurity($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewSecurity/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewSecurity/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoSecurity"] = $this->data_model->getIndividualSecurity($securityId);
        if (empty($viewData["infoSecurity"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/security/editSecurity', $viewData);
    }

    public function deleteSecurity($securityId = 0) {
        if ($securityId > 0) {
            $delRequst = $this->data_model->deleteSecurity($securityId);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewSecurity/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewSecurity/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewSecurity/?action=delError', 'refresh');
        }
    }

    public function viewAdvertisement() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoAdvertisement"] = $this->data_model->getAdvertisement();
        $this->load->view('adminTemplates/advertisement/viewAdvertisement', $viewData);
    }

    public function addAdvertisement() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('advertisementTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('advertisementDesc', 'advertisement Description', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["advertisementTitle"] = trim($this->input->post('advertisementTitle'));
            $viewData["advertisementDesc"] = trim($this->input->post('advertisementDesc'));
            $viewData["advertisementImg"] = $_FILES["image"]["name"];
            $viewData["advertisementStatus"] = trim($this->input->post('advertisementStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertAdvertisement($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewAdvertisement/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewAdvertisement/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/advertisement/addAdvertisement', $viewData);
    }

    public function editAdvertisement($advertisementId = 0) {
        $viewData = array();

        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('advertisementId', 'advertisement Id ', 'trim|required');
            $this->form_validation->set_rules('advertisementTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('advertisementDesc', 'advertisement Description', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["advertisementImg"] = $_FILES['image']['name'];
            }
            $viewData["advertisementId"] = trim($this->input->post('advertisementId'));
            $viewData["advertisementTitle"] = trim($this->input->post('advertisementTitle'));
            $viewData["advertisementDesc"] = trim($this->input->post('advertisementDesc'));
            $viewData["advertisementStatus"] = trim($this->input->post('advertisementStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateAdvertisement($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewAdvertisement/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewAdvertisement/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoAdvertisement"] = $this->data_model->getIndividualAdvertisement($advertisementId);
        if (empty($viewData["infoAdvertisement"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/advertisement/editAdvertisement', $viewData);
    }

    public function deleteAdvertisement($advertisementId = 0) {
        if ($advertisementId > 0) {
            $delRequst = $this->data_model->deleteAdvertisement($advertisementId);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewAdvertisement/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewAdvertisement/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewAdvertisement/?action=delError', 'refresh');
        }
    }

    public function _do_upload() {
        $image = $_FILES['image']['name'];
		$config = array();// added by SB on 23/06/2015
        $config['upload_path'] = "adminuploads/productPagesImg";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '5000';

        $field_name = 'image';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($field_name)) {
            $this->form_validation->set_message('_do_upload', $this->upload->display_errors());
            return FALSE;
        } else {
            $this->filedata = $this->upload->data();
            $this->filedata = $this->resizeimg($image, 'adminuploads/productPagesImg' . DIRECTORY_SEPARATOR, '', '336', '305');
            /* if($this->filedata == 1){
              return TRUE;
              } */
            return $this->filedata;
        }
    }

    public function resizeimg($image, $path, $logo, $height = '', $weight = '') {
        $this->load->library('SimpleImage');
        $this->SimpleImage = new SimpleImage();
        $this->SimpleImage->load('adminuploads/productPagesImg/' . $image);
        $this->SimpleImage->resize($height, $weight);
        $this->SimpleImage->save($path . $image);
        return TRUE;
    }

    public function valid_url($str) {
        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
        if (!preg_match($pattern, $str)) {
            return FALSE;
        }
        return TRUE;
    }

    /*     * ***************** Addded By Pritam on 12.06.2014 *************** */

    public function viewLatestFashionBanner() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoLatestFashionBanner"] = $this->data_model->getLatestFashionBanner();
        $this->load->view('adminTemplates/latestFashionBanner/viewFashionBanner', $viewData);
    }

    public function addLatestFashionBanner() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bannerPosition', 'Banner Position ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["bannerPosition"] = trim($this->input->post('bannerPosition'));
            $viewData["bannerImage"] = $_FILES['image']['name'];
            $viewData["BannerStatus"] = trim($this->input->post('BannerStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertLatestFashionBanner($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewLatestFashionBanner/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewLatestFashionBanner/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/latestFashionBanner/addLatestFashionBanner', $viewData);
    }

    public function editLatestFashionBanner($bannerID = 0) {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bannerID', 'banner ID ', 'trim|required');
            $this->form_validation->set_rules('bannerPosition', 'Banner Position ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["bannerImage"] = $_FILES['image']['name'];
            }
            $viewData["bannerID"] = trim($this->input->post('bannerID'));
            $viewData["bannerPosition"] = trim($this->input->post('bannerPosition'));
            $viewData["BannerStatus"] = trim($this->input->post('BannerStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateLatestFashionBanner($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewLatestFashionBanner/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewLatestFashionBanner/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoLatestFashionBanner"] = $this->data_model->getIndividualLatestFashionBanner($bannerID);
        if (empty($viewData["infoLatestFashionBanner"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/latestFashionBanner/editLatestFashionBanner', $viewData);
    }

    public function deleteLatestFashionBanner($bannerID = 0) {
        if ($bannerID > 0) {
            $delRequst = $this->data_model->deleteLatestFashionBanner($bannerID);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewLatestFashionBanner/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewLatestFashionBanner/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewLatestFashionBanner/?action=delError', 'refresh');
        }
    }

    public function viewResidential() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
        $viewData["infoResidential"] = $this->data_model->getResidential();
        $this->load->view('adminTemplates/residential/viewResidential', $viewData);
    }

    public function addResidential() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('residentialTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('residentialDesc', 'residential Description', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');

            $viewData["residentialTitle"] = trim($this->input->post('residentialTitle'));
            $viewData["residentialDesc"] = trim($this->input->post('residentialDesc'));
            $viewData["residentialImage"] = $_FILES["image"]["name"];
            $viewData["residentialStatus"] = trim($this->input->post('residentialStatus'));

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertResidential($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewLatestFashionBanner/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewResidential/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/residential/addResidential', $viewData);
    }

    public function editResidential($residentialId = 0) {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('residentialId', 'residential ID ', 'trim|required');
            $this->form_validation->set_rules('residentialTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('residentialDesc', 'residential Description', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["residentialImage"] = $_FILES['image']['name'];
            }
            $viewData["residentialId"] = trim($this->input->post('residentialId'));
            $viewData["residentialTitle"] = trim($this->input->post('residentialTitle'));
            $viewData["residentialDesc"] = trim($this->input->post('residentialDesc'));
            $viewData["residentialStatus"] = trim($this->input->post('residentialStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateResidential($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewLatestFashionBanner/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewResidential/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoResidential"] = $this->data_model->getIndividualResidential($residentialId);
        if (empty($viewData["infoResidential"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/residential/editResidential', $viewData);
    }

    public function deleteResidential($residentialId = 0) {
        if ($residentialId > 0) {
            $delRequst = $this->data_model->deleteResidential($residentialId);
            if ($delRequst) {
                redirect(base_url() . 'admin/viewResidential/?action=delSuccess', 'refresh');
            } else {
                redirect(base_url() . 'admin/viewResidential/?action=delError', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/viewResidential/?action=delError', 'refresh');
        }
    }

    public function addMenu() {
        $viewData = array();
        $viewData["menuList"] = $this->data_model->getMenusList();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('menuName', 'menuName ', 'trim|required');

            $viewData["parentMenuID"] = trim($this->input->post('parentMenuID'));
            $viewData["menuName"] = trim($this->input->post('menuName'));
            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertMenus($viewData);
                if ($lastInsertId > 0) {
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewMenu/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            }
        }
        $this->load->view('adminTemplates/menuMngt/addMenu', $viewData);
    }

    public function viewMenu() {
		//echo "===".trim($this->session->userdata('forWebsite'));
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        $viewData["infoAllSubMenus"] = $this->data_model->getAllSubMenus();
        $viewData["infoAllMenus"] = $this->data_model->getMenusList();
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view('adminTemplates/menuMngt/viewMenu', $viewData);
    }

    public function editMenu($menuID = 0) {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('menuName', 'menuName ', 'trim|required');

            $viewData["menuID"] = trim($this->input->post('menuID'));
            $viewData["parentMenuID"] = trim($this->input->post('parentMenuID'));
            $viewData["menuName"] = trim($this->input->post('menuName'));
            $viewData["menuStatus"] = trim($this->input->post('menuStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateMenu = $this->data_model->updateMenuDetails($viewData);
                if ($updateMenu > 0) {
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewMenu/?action=edit\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            }
        }
        $viewData["infoMainMenu"] = $this->data_model->getTotalMenuDetails();
        $viewData["infoIndivMenu"] = $this->data_model->getInfoIndivMenuDetails($menuID);
        $viewData["infoMenu"] = $this->data_model->getIndividualMenuDetails($menuID);
		//print_r($viewData["infoIndivMenu"]);		
        $this->load->view('adminTemplates/menuMngt/editMenu', $viewData);
    }

    public function deleteMenu($menuID = 0) {
        if ($menuID > 0) {
            $delRequst = $this->data_model->deleteMenuId($menuID);
            //echo $delRequst; exit;
            if ($delRequst) {
                echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewMenu/?action=delSuccess\";</script>";
            } else {
                echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewMenu/?action=delError\";</script>";
            }
        } else {
            echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewMenu/?action=delError\";</script>";
        }
    }

    public function addProduct() {
        $viewData = array();
        $viewData["productTypes"] = $this->data_model->getproductType();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('productName', 'Product Name ', 'trim|required');
            $this->form_validation->set_rules('productDesc', 'Product Desc ', 'trim|required');
            $this->form_validation->set_rules('productPrice', 'Product Price', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
            //$this->form_validation->set_rules('image1','Music','callback__do_MusicUpload');
            if (!empty($_FILES['image1']['name'])) {
                $fileName = $_FILES["image1"]["name"];
                $fileTmpLoc = $_FILES["image1"]["tmp_name"];
                $pathAndName = "adminuploads/productPagesImg" . DIRECTORY_SEPARATOR . $fileName;
                move_uploaded_file($fileTmpLoc, $pathAndName);
            }
            $viewData["productTypeID"] = trim($this->input->post('productType'));
            $viewData["productName"] = trim($this->input->post('productName'));
            $viewData["productDesc"] = trim($this->input->post('productDesc'));
            $viewData["productPrice"] = trim($this->input->post('productPrice'));
            $viewData["productStatus"] = trim($this->input->post('productStatus'));
            $viewData["productImage"] = $_FILES["image"]["name"];
            $viewData["productMusic"] = $_FILES['image1']['name']; // productColourStrings // productSizeStrings
            $viewData["productColour"] = $this->input->post('colour');
            $viewData["productSize"] = $this->input->post('size');
            if (!empty($viewData["productColour"])) {
                $tempStrColour = "";
                foreach ($viewData["productColour"] as $valColour) {
                    if (trim($tempStrColour) == "") {
                        $tempStrColour = $valColour;
                    } else {
                        $tempStrColour .= "," . $valColour;
                    }
                }
                $viewData["productColourStrings"] = $tempStrColour;
            }
            if (!empty($viewData["productSize"])) {
                $tempStrSize = "";
                foreach ($viewData["productSize"] as $valSize) {
                    if (trim($tempStrSize) == "") {
                        $tempStrSize = $valSize;
                    } else {
                        $tempStrSize .= "," . $valSize;
                    }
                }
                $viewData["productSizeStrings"] = $tempStrSize;
            }
            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertProduct($viewData);
                //print_r($_FILES['SecondaryImg']);
                if ($lastInsertId > 0) {
                    if (!empty($_FILES['SecondaryImg']['name'])) {
                        for ($i = 0; $i < count($_FILES['SecondaryImg']['name']); $i++) {
                            $secondaryFileName = $_FILES["SecondaryImg"]["name"][$i];
                            $secondaryFileTmpLoc = $_FILES["SecondaryImg"]["tmp_name"][$i];
                            $secondaryPathAndName = "adminuploads/productPagesImg" . DIRECTORY_SEPARATOR . $secondaryFileName;
                            if (move_uploaded_file($secondaryFileTmpLoc, $secondaryPathAndName)) {
                                $this->data_model->insertSecondaryProductImg($secondaryFileName, $lastInsertId);
                            }
                        }
                    }
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewProduct/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('adminTemplates/productManagement/addProduct', $viewData);
    }

    public function viewProduct() {
        $viewData = array();
        $viewData["type"] = $this->session->flashdata('type');//success,error
        $viewData["msg"] = $this->session->flashdata('msg');
        $base_url = base_url()."admin/viewProduct/";
        $total_rows = $this->data_model->getTotalProducts();
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) > 0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $viewData["infoProducts"] = $this->data_model->getAllProducts($per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view('adminTemplates/productManagement/viewProduct', $viewData);
    }

    public function deleteProduct($pId = 0) {
        $productId = trim($pId);
        if($productId > 0){
            $pFiles = $this->data_model->getProductFiles($pId);
            if(count($pFiles) > 0){
                foreach ($pFiles as $files):
                    $path = $this->common_model->imageUnlinkPath().'adminuploads/product_files/';
                    if($files->fileType == 0){
                        unlink($path.'images/'.$files->fileName);
                        unlink($path.'images/thumb/'.$files->fileName);
                    }elseif($files->fileType == 1){
                        unlink($path.'audio/'.$files->fileName);
                    }
                endforeach;
            }
            $tbl = "product_details";
            $where["productID"] =  trim($pId);
            $rd = $this->common_model->deleteDataFromTable($tbl , $where);
            if($rd){
                $this->session->set_flashdata("type","success");
                $this->session->set_flashdata("msg", "You have successfully Deleted the data.");
            }else{
                $this->session->set_flashdata('type',"error");
                $this->session->set_flashdata('msg',"Please try again.");
            }
        }else{
            $this->session->set_flashdata('type',"error");
            $this->session->set_flashdata('msg',"Please try again.");
        }
        redirect(base_url() . 'admin/viewProduct', 'refresh');
    }

    public function viewDynamicMenuContent($id = '') {
        $menu_id = trim($id);
        $viewData = array();
        if ($menu_id != '' && is_numeric($menu_id)) {
            $viewData['menuDetails'] = $this->data_model->getMenuDetails($menu_id);
            $viewData['menuContent'] = $this->data_model->getMenuContentDetails($menu_id);
            $viewData['addLink'] = 1;
            if ($viewData['menuDetails'][0]['parentMenuID'] > 0 && count($viewData['menuContent']) == 1) {
                $viewData['addLink'] = 0;
            }
        }
        $action = trim($this->session->userdata('action'));
        $this->session->set_userdata('action', '');
        if ($action == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($action == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($action == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($action == "delError") {

            $viewData["errorReport"] = "Invalid delete Request";
        }

        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */

        //$viewData["infoCreative"]                                                   = $this->data_model->getCreativeDetails();
        $this->load->view('adminTemplates/menupage/view', $viewData);
    }

    public function addDynamicMenuContent($id = '') {
        $viewData = array();
        $viewData['menu_id'] = trim($id);
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title ', 'trim|required');
            $this->form_validation->set_rules('description', 'Description ', 'trim|required');
            $this->form_validation->set_rules('image', 'Image', 'callback_do_upload_menu');
            $viewData["title"] = trim($this->input->post('title'));
            $viewData["description"] = trim($this->input->post('description'));
            $viewData["image"] = $_FILES['image']['name'];
            $viewData["status"] = trim($this->input->post('status'));
            $viewData["created_date"] = date("y-m-d H:i:s");
            if ($this->form_validation->run() != FALSE) {
                $tbl = 'productmenucontent';
                $lastInsertId = $this->data_model->insertDataToTable($tbl, $viewData);

                if ($lastInsertId) {
                    $this->session->set_userdata('action', 'add');
                    redirect(base_url() . 'admin/viewDynamicMenuContent/' . $viewData['menu_id'], 'refresh');
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) as below.';
            }
        }

        $this->load->view('adminTemplates/menupage/add', $viewData);
    }

    public function editDynamicMenuContent($id = '') {
        $viewData = array();
        $menuContentId = trim($id);
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title ', 'trim|required');
            $this->form_validation->set_rules('description', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback_do_upload_menu');
                $viewData["image"] = $_FILES['image']['name'];
                unlink($this->imageUnlinkPath() . 'adminuploads/productPagesImg/' . trim($this->input->post('old_image')));
            }
            $viewData["title"] = trim($this->input->post('title'));
            $viewData["description"] = trim($this->input->post('description'));
            $viewData["status"] = trim($this->input->post('status'));
            $menuId = trim($this->input->post('menu_id'));
            if ($this->form_validation->run() != FALSE) {
                $tbl = 'productmenucontent';
                $where['id'] = $menuContentId;
                $updateStatus = $this->data_model->updateTable($tbl, $viewData, $where);
                if ($updateStatus) {
                    $this->session->set_userdata('action', 'edit');
                    redirect(base_url() . 'admin/viewDynamicMenuContent/' . $menuId, 'refresh');
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoCreative"] = $this->data_model->getContentDetails($menuContentId);
        if (empty($viewData["infoCreative"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/menupage/edit', $viewData);
    }

    public function deleteDynamicMenuContent($id = '') {
        $content_id = trim($id);
        if ($content_id > 0) {
            $getData = $this->data_model->getContentDetails($content_id);
            $tbl = 'productmenucontent';
            $where['id'] = $content_id;
            $delRequst = $this->data_model->deleteDataFromTable($tbl, $where);
            if ($delRequst) {
                $this->session->set_userdata('action', 'delSuccess');
                unlink($this->imageUnlinkPath() . 'adminuploads/productPagesImg/' . $getData[0]['image']);
                redirect(base_url() . 'admin/viewDynamicMenuContent/' . $getData[0]['menu_id'], 'refresh');
            } else {
                $this->session->set_userdata('action', 'delError');
                redirect(base_url() . 'admin/viewDynamicMenuContent/' . $getData[0]['menu_id'], 'refresh');
            }
        } else {
            $this->session->set_userdata('action', 'delError');
            redirect(base_url() . 'admin/viewDynamicMenuContent/' . $getData[0]['menu_id'], 'refresh');
        }
    }

    public function imageUnlinkPath() {
        $path = BASEPATH;
        $basePath = str_replace("system/", "", $path);
        return $basePath;
    }

    public function do_upload_menu() {
        $image = $_FILES['image']['name'];
        $config['upload_path'] = "adminuploads/productPagesImg";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '5000';

        $field_name = 'image';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($field_name)) {
            $this->form_validation->set_message('do_upload_menu', $this->upload->display_errors());
            return FALSE;
        } else {
            //$this->filedata = $this->upload->data();
            //$this->filedata = $this->resizeimg($image,'adminuploads/productPagesImg'.DIRECTORY_SEPARATOR,'','336','305');
            /* if($this->filedata == 1){
              return TRUE;
              } */
            return true; //$this->filedata;
        }
    }

    public function productArticleMap() {
        $viewData = array();
        $viewData["menuList"] = $this->data_model->getTableList();
        $viewData["productType"] = $this->data_model->getproductType();
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view('adminTemplates/productMap/viewMap', $viewData);
    }

    /* public function getArticlesList(){
      $viewData												                    = array();
      $viewData["IDList"]                                                         = explode("_",$_POST["tableName"]);
      $viewData["articleSet"]									                    = $this->data_model->getArticlesNameID($viewData["IDList"]);
      if(!empty( $viewData["articleSet"] )){
      foreach($viewData["articleSet"] as $val){
      $temp = explode("_",$val);
      echo "<tr><td><input type=\"checkbox\" name=\"selectAll\" id=\"selectAll\" value=\"".$val."\" ></td><td>".$temp[1]."</td></tr>";
      }
      }else{
      echo "<tr><td>No Data Found</td></tr>";
      }
      } */

    public function getArticlesList() {
        $viewData = array();
        $viewData["IDList"] = explode("_", $_POST["tableName"]);
        $viewData["articleSet"] = $this->data_model->getArticlesNameID($viewData["IDList"]);
        if (!empty($viewData["articleSet"])) {
            foreach ($viewData["articleSet"] as $val) {
                $temp = explode("_", $val);
                echo "<tr><td><input type=\"checkbox\" name=\"selectElement[]\" id=\"selectAll\" value=\"" . $val . "\" ></td><td>" . $temp[1] . "</td></tr>";
            }
        } else {
            echo "<tr><td>No Data Found</td></tr>";
        }
    }
	// Added by SB 29/04/2015 
	public function getArticlesListNew() {
        $viewData = array();
        $viewData["IDList"] = explode("_", $_POST["tableName"]);
		//print_r($viewData["IDList"]); exit;
        $viewData["articleSet"] = $this->data_model->getArticlesNameIDNew($viewData["IDList"]);
        if (!empty($viewData["articleSet"])) {
            foreach ($viewData["articleSet"] as $val) {
                $temp = explode("_", $val);
                echo "<tr><td><input type=\"checkbox\" name=\"selectElement[]\" id=\"selectAll\" value=\"" . $val . "\" ></td><td>" . $temp[2] . "</td></tr>";
            }
        } else {
            echo "<tr><td>No Data Found</td></tr>";
        }
    }

    public function mapProductArticles() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $prodTypeStr = "";
            $viewData["listOfArticle"] = $this->input->post('selectElement');
            $viewData["productList"] = $this->input->post('productList');
            foreach ($viewData["productList"] as $val) {
                if (trim($prodTypeStr) == "") {
                    $prodTypeStr = $val;
                } else {
                    $prodTypeStr .= "," . $val;
                }
            }
            foreach ($viewData["listOfArticle"] as $key => $val) {
                $tempVal = explode("_", $val);
                $articleID = $tempVal[0];
                $tableID = $tempVal[3];
                $productTypeID = $prodTypeStr;
                $this->data_model->insertMapProductArticles($productTypeID, $tableID, $articleID);
            }
        }
        $this->productArticleMap();
    }
	// added by SB on 29/04/2015
	public function productArticleMapNew() {
        $viewData = array();
        $viewData["menuList"] = $this->data_model->getMenusList();
        $viewData["productType"] = $this->data_model->getproductType();
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view('adminTemplates/productMap/viewMapNew', $viewData);
    }
	// added by Sb on 29/04/2015
	 public function mapProductArticlesNew() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $prodTypeStr = "";
            $viewData["listOfArticle"] = $this->input->post('selectElement');
            $viewData["productList"] = $this->input->post('productList');
            foreach ($viewData["productList"] as $val) {
                if (trim($prodTypeStr) == "") {
                    $prodTypeStr = $val;
                } else {
                    $prodTypeStr .= "," . $val;
                }
            }
            foreach ($viewData["listOfArticle"] as $key => $val) {
                $tempVal = explode("_", $val);
                $articleID = $tempVal[0];
                $menuID = $tempVal[1];
                $productTypeID = $prodTypeStr;
                $this->data_model->insertMapProductArticlesNew($productTypeID, $menuID, $articleID);
            }
        }
        $this->productArticleMapNew();
    }
    public function viewCentoruList() {
        $this->checkLogin();
        $viewData = array();
        $viewData["centoruList"] = $this->data_model->getCentoruList();
        //print_r($viewData["centoruList"]);
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view('adminTemplates/prePhase/viewPrePhase.php', $viewData);
    }

    public function getXls() {
        $viewData = array();
        $viewData["centoruList"] = $this->data_model->getCentoruList();
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment;Filename=CentoruList.xls");
        //echo "<html>";
        //echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
        //echo "<body>";
        //echo "<b>testdata1</b> \t <u>testdata2</u> \t \n ";
        //echo "</body>";
        //echo "</html>";
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
        echo "</tr>";
        foreach ($viewData["centoruList"] as $key => $valList) {
            echo "<tr>";
            echo "<td>" . $viewData["centoruList"][$key]["firstName"] . " " . $viewData["centoruList"][$key]["lastName"] . "</td>";
            echo "<td>" . $viewData["centoruList"][$key]["fn"] . " " . $viewData["centoruList"][$key]["ln"] . "</td>";
            echo "<td>" . $viewData["centoruList"][$key]["phone"] . "</td>";
            echo "<td>" . $viewData["centoruList"][$key]["emailID"] . "</td>";
            echo "<td>" . $viewData["centoruList"][$key]["skypeID"] . "</td>";
            echo "<td>" . $viewData["centoruList"][$key]["city"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</body>";
        echo "</html>";
    }

    public function sendEmailToPrephaseUser() {
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
                echo 2;
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

    function afroCatalogueList() {
        $this->checkLogin();
        $viewData = array();
        $viewData["report"] = $this->session->flashdata('report');
        $viewData["msg"] = $this->session->flashdata('msg');
        $tbl = "afrowebb_catalog_details";
        $selectedData = "";
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
		// added by SB on 13/08/2015
		$where = array();
		$where['forWebsite'] = $this->forWebsite;
        $viewData["list"] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		if($this->forWebsite==1){
			$viewData['websiteName'] = "Afrowebb";	
		}
		else if($this->forWebsite==2){
			$viewData['websiteName'] = "Community Treasure";	
		}
		else{
			$viewData['websiteName'] = "Rave Business";	
		}
        $this->load->view('adminTemplates/afro/view.php', $viewData);
    }

    function afroCatalogueEdit($id = "") {
        $this->checkLogin();
        $viewData = array();
        $viewData["report"] = "";
        $viewData["msg"] = "";
        $where = array("id" => trim($id));
        $tbl = "afrowebb_catalog_details";
        if ($this->input->post("submit") != "") {
            $data["title"] = $this->input->post("title");
            $data["cost"] = $this->input->post("cost");
            $data["currency_name"] = $this->input->post("currency_name");
            $data["description"] = $this->input->post("description");
            $data["status"] = $this->input->post("status");
            $dd = $this->common_model->updateDataToTable($tbl, $where, $data);
            if ($dd) {
                $this->session->set_flashdata("report", 1);
                $this->session->set_flashdata("msg", "You have successfully updated the data.");
                redirect(base_url() . "admin/afroCatalogueList");
            } else {
                $viewData["report"] = 2;
                $viewData["msg"] = "Please try again.";
            }
        }

        $selectedData = "";
        $viewData["list"] = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
        $viewData["val"] = $viewData["list"][0];
        unset($viewData["list"][0]);
        $this->load->view('adminTemplates/afro/edit.php', $viewData);
    }

    function checkLogin() {
        if ($this->session->userdata("adminId") == "") {
            redirect(base_url() . "admin/");
        } else {
            return true;
        }
    }
	// added by SB on 24/04/2015
	public function viewArticles() {
        $viewData = array();
        if ($_REQUEST["action"] == "add") {
            $viewData["submissionReport"] = "One item added sucessfuly";
        }
        if ($_REQUEST["action"] == "edit") {
            $viewData["submissionReport"] = "One item edited sucessfuly";
        }
        if ($_REQUEST["action"] == "delSuccess") {
            $viewData["submissionReport"] = "One item deleted sucessfuly";
        }
        if ($_REQUEST["action"] == "delError") {
            $viewData["errorReport"] = "Invalid delete Request";
        }
        /*         * ************ Code For Pagination *************** */

        /*         * ************************************************ */
		$menuId = trim($this->uri->segment(3));	
		//echo "+++++++++++++".$menuId; exit;
		if($menuId>0)
		{
			$base_url = base_url()."admin/viewArticles/".$menuId."/";
		}
		else{
			$base_url = base_url()."admin/viewArticles/0/";
		}
					
		$total_rows = $this->data_model->getTotalMenuContentDetail($menuId);
		$per_page = $this->dataPerPage;
		$page = 0;
		$uri_segment = 4;
        if($this->uri->segment(4) >0 && $this->uri->segment(4) != ""){
            $page = $this->uri->segment(4);
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
		$viewData['selectedMenuId'] = $menuId;
		$viewData['categoryName'] = $this->data_model->getMenuName($menuId);// added by SB on 28/04/2015
		$viewData["infoArticle"] = $this->data_model->getMenuContentDetails($menuId,$per_page,$page);
        $viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/articles/viewArticles', $viewData);
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
	// added by SB on 02-06-2015
	// GBE Initiatives id =1
	public function staticArticle($articleID = 0) {
        $viewData = array();
		$viewData["menuTypes"] = $this->data_model->getMenusList();
		
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('staticArticleID', 'Article ID ', 'trim|required');
            $this->form_validation->set_rules('articleTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('articleDesc', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["articleImg"] = $_FILES['image']['name'];
            }
            $viewData["staticArticleID"] = trim($this->input->post('staticArticleID'));			
            $viewData["articleTitle"] = trim($this->input->post('articleTitle'));
            $viewData["articleDesc"] = trim($this->input->post('articleDesc'));
            $viewData["articleStatus"] = trim($this->input->post('articleStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateStaticArticleData($viewData);
                if ($updateStatus) {
                    redirect(base_url().'admin/viewAdvert/?action=edit', 'refresh');
                    /*echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/staticArticles/".$viewData["menuID"]."?action=edit\";</script>";*/
					// $viewData['successMsg'] = 'Article edited sucessfuly';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoArticle"] = $this->data_model->getStaticArticleData($articleID);
        if (empty($viewData["infoArticle"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 02/06/2015
        $this->load->view('adminTemplates/articles/staticArticle', $viewData);
    }
	// added by SB on 04/06/2015
	public function viewAdvert(){
		$config = array();
        $config["base_url"] = base_url() . "admin/viewAdvert";
        $config["total_rows"] = $this->data_model->advert_count();
        $config["per_page"] = 7;
        $config["uri_segment"] = 3;
        $this->load->library("pagination");
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->data_model->get_all_advert($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		 if ($_REQUEST["action"] == "edit") {
            $data["submissionReport"] = "One item edited successfully";
        }
        if ($status == "DeleteRequest") {
            $data["status"] = "delete";
        } elseif ($status == "InvalidRequest") {
            $data["status"] = "Invalid";
        }
		$data['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view("adminTemplates/viewAdvert", $data);
	}
	public function viewAssistants(){
		$config = array();
        $config["base_url"] = base_url() . "admin/viewAssistants";
        $config["total_rows"] = $this->data_model->assist_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $this->load->library("pagination");
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->data_model->get_all_assistants($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		 if ($_REQUEST["action"] == "edit") {
            $data["submissionReport"] = "One item edited successfully";
        }
        if ($status == "DeleteRequest") {
            $data["status"] = "delete";
        } elseif ($status == "InvalidRequest") {
            $data["status"] = "Invalid";
        }
		$data['navMenu'] = $this->data_model->getMenusList();// added by SB on 08/06/2015
        $this->load->view("adminTemplates/viewAssistants", $data);
	}
	public function editAssistant($assistID = 0) {
        $viewData = array();
		$viewData["menuTypes"] = $this->data_model->getMenusList();
		
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('virtualAssistID', 'Assistant ID ', 'trim|required');
            $this->form_validation->set_rules('assistTitle', 'Title ', 'trim|required');
           // $this->form_validation->set_rules('assistDesc', 'Description ', 'trim|required');
            $this->form_validation->set_rules('assistLink', 'Assistant Link', 'trim|required');
          
            $viewData["virtualAssistID"] = trim($this->input->post('virtualAssistID'));			
            $viewData["assistTitle"] = trim($this->input->post('assistTitle'));
			$viewData["assistLink"] = trim($this->input->post('assistLink'));
            $viewData["assistDesc"] = trim($this->input->post('assistDesc'));
            $viewData["assistStatus"] = trim($this->input->post('assistStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateVirtualAssistData($viewData);
                if ($updateStatus) {
                    redirect(base_url().'admin/viewAssistants/?action=edit', 'refresh');
                    
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoAssist"] = $this->data_model->getVirtualAssistData($assistID);
        if (empty($viewData["infoAssist"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 02/06/2015
        $this->load->view('adminTemplates/editAssistant', $viewData);
    }
	
	// ownedBusiness added by SB on 08/06/2015
	public function ownedBusiness(){
		$viewData = array();
		$viewData["menuTypes"] = $this->data_model->getMenusList();
		$businessID = 1;
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ownedBusinessID', 'Bussiness ID ', 'trim|required');
            $this->form_validation->set_rules('bussiTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('bussiDesc', 'Description ', 'trim|required');
           
          
            $viewData["ownedBusinessID"] = trim($this->input->post('ownedBusinessID'));			
            $viewData["bussiTitle"] = trim($this->input->post('bussiTitle'));
			$viewData["bussiDesc"] = trim($this->input->post('bussiDesc'));
            $viewData["bussiStatus"] = trim($this->input->post('bussiStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateOwnedBusinessData($viewData);
                if ($updateStatus) {
                   // redirect(base_url().'admin/ownedBusiness/?action=edit', 'refresh');
                  /* echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/ownedBusiness\";</script>";*/
					$viewData['successMsg'] = 'Detail edited successfully';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoOwnedBussi"] = $this->data_model->getOwnedBusinessData($businessID);
        if (empty($viewData["infoOwnedBussi"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 02/06/2015
        $this->load->view('adminTemplates/ownedBusiness', $viewData);
	}
	public function security(){
		$viewData = array();
		$viewData["menuTypes"] = $this->data_model->getMenusList();
		$securityID = 8;
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('securityID', 'Security ID ', 'trim|required');
            $this->form_validation->set_rules('securityTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('securityLink', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["securityImg"] = $_FILES['image']['name'];
            }
          
            $viewData["securityID"] = trim($this->input->post('securityID'));			
            $viewData["securityTitle"] = trim($this->input->post('securityTitle'));
			$viewData["securityLink"] = trim($this->input->post('securityLink'));
            $viewData["securityStatus"] = trim($this->input->post('securityStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateSecurityData($viewData);
                if ($updateStatus) {
                   // redirect(base_url().'admin/ownedBusiness/?action=edit', 'refresh');
                   /* echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/ownedBusiness\";</script>";*/
					$viewData['successMsg'] = 'Detail edited successfully';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoSecurity"] = $this->data_model->getSecurityData($securityID);
        if (empty($viewData["infoSecurity"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();// added by SB on 02/06/2015
        $this->load->view('adminTemplates/security', $viewData);
	}
	// TV Channel Added by SB on 16/06/2015
	public function viewGbeTv($tvID = 0) {
        $viewData = array();
		$viewData["menuTypes"] = $this->data_model->getMenusList();
		
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('tvID', 'TV ID ', 'trim|required');
            $this->form_validation->set_rules('tvTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('tvDesc', 'Description ', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
                $viewData["tvImg"] = $_FILES['image']['name'];
            }
            $viewData["tvID"] = trim($this->input->post('tvID'));			
            $viewData["tvTitle"] = trim($this->input->post('tvTitle'));
            $viewData["tvDesc"] = trim($this->input->post('tvDesc'));
            $viewData["tvStatus"] = trim($this->input->post('tvStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateGbeTvData($viewData);
                if ($updateStatus) {
                    redirect(base_url().'admin/viewGbeTv/?action=edit', 'refresh');                    
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoTv"] = $this->data_model->getGbeTvData(); // $tvID
        if (empty($viewData["infoTv"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();
        $this->load->view('adminTemplates/viewGbeTv', $viewData);
    }
	public function viewGbeTvChannel(){
		$config = array();
        $config["base_url"] = base_url() . "admin/viewGbeTvChannel";
        $config["total_rows"] = $this->data_model->channel_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->load->library("pagination");
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->data_model->get_all_channel($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		 if ($_REQUEST["action"] == "edit") {
            $data["submissionReport"] = "One item edited successfully";
        }
		 if ($_REQUEST["action"] == "add") {
            $data["submissionReport"] = "One item added successfully";
        }
        if ($status == "DeleteRequest") {
            $data["status"] = "delete";
        } elseif ($status == "InvalidRequest") {
            $data["status"] = "Invalid";
        }
		$data['navMenu'] = $this->data_model->getMenusList();
        $this->load->view("adminTemplates/viewGbeTvChannel", $data);
	}
	 public function addGbeTvChannel() {
        $viewData = array();
		$viewData["tvTypes"] = $this->data_model->getTvList();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
			$this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
			$this->createTxtFile($_FILES['image']['name']);			
			
            $this->form_validation->set_rules('channelTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('channelDesc', 'Description ', 'trim|required');
            //$this->form_validation->set_rules('channelVideo', 'Video', 'callback__do_videoupload');
			//-------------------video upload start-------------------//
			if (!empty($_FILES['channelVideo']['name'])) {
                $extension = array("avi", "mp4","flv");
                $name = explode(".", $_FILES['channelVideo']['name']);
                $ext = strtolower(end($name));
                if (in_array($ext, $extension)) {
                    $t1 = time();
                    $document2 = '';
                    $vid2 = '';
                    $video2 = $_FILES['channelVideo']['name'];
                    $video2 = $t1 . $video2;
                    $tname2 = $_FILES['channelVideo']['tmp_name'];
                    $document2 = "adminuploads/tvChannelVideos/" . $video2;
                    $vid2 = $video2;
                    if (!empty($vid2) && $vid2 != '') {
                        move_uploaded_file($tname2, $document2);
                     
                    }
                    $viewData['channelVideo'] = $video2;
                } else {
                    $viewData['video_error'] = "Invalid Video type";
                }
            }
			
			// -----------------------video upload end---------------//
			
			$viewData["tvTypeId"] = trim($this->input->post('tvType'));
					
            $viewData["channelTitle"] = trim($this->input->post('channelTitle'));
            $viewData["channelDesc"] = trim($this->input->post('channelDesc'));
            $viewData["channelimage"] = $_FILES['image']['name'];
			//$viewData["channelVideo"] = $_FILES['channelVideo']['name'];
            $viewData["channelStatus"] = trim($this->input->post('channelStatus'));
			
            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertChannelDetails($viewData);
                if ($lastInsertId > 0) {
                    //redirect(base_url().'admin/viewCreative/?action=add', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewGbeTvChannel/?action=add\";</script>";
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
		$viewData['navMenu'] = $this->data_model->getMenusList();
	    $this->load->view('adminTemplates/tvChannel/addTvChannel', $viewData);
    }
	// video upload 
	/* public function _do_videoupload() {
        $image = $_FILES['channelVideo']['name'];
		$config = array();
		$config['allowed_types']='';
        $config['upload_path'] = "adminuploads/tvChannelVideos";
        $config['allowed_types'] = 'mp4|flv|mov|avi';
        $config['max_size'] = '500000';

        $field_name = 'channelVideo';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($field_name)) {
            $this->form_validation->set_message('_do_videoupload', $this->upload->display_errors());
            return FALSE;
        } else {
            $this->filedata = $this->upload->data();           
            return $this->filedata;
        }
    } */
	 public function editGbeTvChannel($channelID = 0) {
        $viewData = array();
		$viewData["tvTypes"] = $this->data_model->getTvList();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
			if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Image', 'callback__do_upload');
				// unlink old  image file 
				$imageFieldname ='channelimage';
				$this->unlinkOldFile($channelID,$imageFieldname);
				
                $viewData["channelimage"] = $_FILES['image']['name'];
            }
            $this->form_validation->set_rules('channelID', 'channel ID ', 'trim|required');
            $this->form_validation->set_rules('channelTitle', 'Title ', 'trim|required');
            $this->form_validation->set_rules('channelDesc', 'Description ', 'trim|required');
            
			if (!empty($_FILES['channelVideo']['name'])) {
                //$this->form_validation->set_rules('channelVideo', 'Video', 'callback__do_videoupload');                				
				//-------------------video upload start-------------------//
			
                $extension = array("avi", "mp4","flv");
                $name = explode(".", $_FILES['channelVideo']['name']);
                $ext = strtolower(end($name));
                if (in_array($ext, $extension)) {
                    $t1 = time();
                    $document2 = '';
                    $vid2 = '';
                    $video2 = $_FILES['channelVideo']['name'];
                    $video2 = $t1 . $video2;
                    $tname2 = $_FILES['channelVideo']['tmp_name'];
                    $document2 = "adminuploads/tvChannelVideos/" . $video2;
                    $vid2 = $video2;
                    if (!empty($vid2) && $vid2 != '') {
                     $uploadStatus =   move_uploaded_file($tname2, $document2);
                     if($uploadStatus){
						 // unlink old  video file 
						 $fieldname ='channelVideo';
						 $this->unlinkOldFile($channelID,$fieldname);
					 }
                    }
                    $viewData['channelVideo'] = $video2;
                } else {
                    $viewData['video_error'] = "Invalid Video type";
                }           
			
			   // -----------------------video upload end---------------//
				
				
            }
			$viewData["channelID"] = trim($this->input->post('channelID'));			
            $viewData["tvTypeId"] = trim($this->input->post('tvType'));					
            $viewData["channelTitle"] = trim($this->input->post('channelTitle'));
            $viewData["channelDesc"] = trim($this->input->post('channelDesc'));     
			$viewData["channelStatus"] = trim($this->input->post('channelStatus'));
            if ($this->form_validation->run() != FALSE) {
                $updateStatus = $this->data_model->updateChannelDetails($viewData);
                if ($updateStatus) {
                    //redirect(base_url().'admin/viewArticleZone/?action=edit', 'refresh');
                    echo "<script type=\"text/javascript\">window.location=\"" . base_url() . "admin/viewGbeTvChannel/?action=edit\";</script>";
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $viewData["infoTvChannel"] = $this->data_model->getTvChannelDetail($channelID);
        if (empty($viewData["infoTvChannel"])) {
            $viewData["errorMsg"] = "Invalid Data Request";
        }
        $this->load->view('adminTemplates/tvChannel/editTvChannel', $viewData);
    }
	
// unlink old file function added by SB on 23/06/2015
public function unlinkOldFile($channelID,$imageFieldname){
	if($imageFieldname=='channelVideo'){
	 $oldFileName = $this->data_model->getOldFileName($imageFieldname,$channelID);
		if($oldFileName!=''){
			$oldFilePath = $this->imageUnlinkPath() . 'adminuploads/tvChannelVideos/'.$oldFileName;
			if(file_exists($oldFilePath)){
				unlink($oldFilePath);
			}
		}
	}
	else if($imageFieldname=='channelimage'){
		 $oldFileName = $this->data_model->getOldFileName($imageFieldname,$channelID); 
		if($oldFileName!=''){
			$oldFilePath = $this->imageUnlinkPath() . 'adminuploads/productPagesImg/'.$oldFileName; 
			if(file_exists($oldFilePath)){
				unlink($oldFilePath);
			}
		}
	}
}	
	// function to write on text file 
	public function createTxtFile($imageFileName){
		// log file start write
				
		$logPath = $this->absPath() . 'uploadFileName.txt';

		if (file_exists($logPath)) {

			unlink($logPath);

		}

		$myfile = fopen($logPath, "w") or die("Unable to open file!");		
	
		$fileData .= "\r\n";

		$fileData .= "File name =".$imageFileName ;

		fwrite($myfile, $fileData);

		fclose($myfile);

		// log file ends 
	}
	public function absPath() {

        $path = BASEPATH;

        $basePath = str_replace("system/", "", $path);

        return $basePath;

    }
	// added by SB on 22/07/2015 Current account withdrawal 
	 public function withdrawalDetail() {
        /* $config = array();
        $config["base_url"] = base_url() . "admin/user_banner";
        $config["total_rows"] = $this->data_model->banner_count();
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        $this->load->library("pagination");
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->data_model->fetch_banner_member($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        if ($status == "DeleteRequest") {
            $data["status"] = "delete";
        } elseif ($status == "InvalidRequest") {
            $data["status"] = "Invalid";
        } */
		$data["withdrawData"] 	= $this->current_account_model->getWithdrawalLoanRequest("",2);// Transaction type = 2
		
		$data["cycleDate1"]		= $this->cycleDate1;
		$data["cycleDate2"]		= $this->cycleDate2;
		$data['navMenu'] 		= $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view("adminTemplates/currentAccount/withdrawalDetail", $data);
    }
	public function paymentAction(){
		$tblId		= trim($_POST['tblId']);
		$userId 	= trim($_POST["userId"]);
		$acTion 	= trim($_POST["acTion"]);
		$reqCurAmt  = trim($_POST["reqCurAmt"]);
		$cycleDate	= trim($_POST["cycleDate"]);
		if($tblId!="" && $userId!="" && $acTion!=""){
			$upData = array();
			$upData['userId'] = $userId;
			if($acTion=='A'){
				$upData['status'] = 1;// Inprocess
				
				// insert data to amount transfer table
				$insertData = array();
				$insertData['accTblId'] = $tblId;
				$insertData['userId'] = $userId;
				$amtCurrarr = explode(' ', $reqCurAmt);
				$insertData['transferAmt'] = $amtCurrarr[1];
				$cycleDatearr = explode('-',$cycleDate);
				$insertData['cycle_date'] = $cycleDatearr[2]."-".$cycleDatearr[1]."-".$cycleDatearr[0];
				$insertResult = $this->current_account_model->insertAmountTransfer($insertData);
			}
			else{
				$upData['status'] = 2;// rejected
			}
			
			
			$upData['approveDate'] = date('Y-m-d');
			$upData['tblId'] = $tblId;
			$upAction = $this->current_account_model->updateCurrentAccountDetail($upData);
			if($upAction){
				
					$mailData = array();
					// send mail to user start 
					
					// fetch user detail for mail 					
					$userDetail 					= $this->current_account_model->getPayingUserDetail($userId);
					$mailData['firstName']			= $userDetail[0]['firstName'];
					$mailData['lastName']			= $userDetail[0]['lastName'];
					$mailData['emailID']			= $userDetail[0]['emailID'];
					$mailData['requestAmt']			= $reqCurAmt;
					$mailData['requestFor'] 		= 'Withdrawal';					
					$mailData['acTion'] 			= $acTion;					
					$this->sendEmailToUser($mailData);
					
					// send mail to user end 
				if($acTion=='A'){
										
					$msg = "Withdraw request Approved successfully";			
				}
				else{
					
					$msg = "Withdraw request Rejected";			
				}
				$val = array('success'=>"yes", 'msg'=> $msg);
			}
		}
		else{
			
			$val = array("success" => "no","message"=>'');
		}
		
		$output = json_encode($val);
		echo $output;
	}
	public function notifications(){
		$data['notificationData'] = $this->current_account_model->getNotification();
		$data['navMenu'] = $this->data_model->getMenusList();// added by SB on 28/04/2015
        $this->load->view("adminTemplates/currentAccount/notifications", $data);
	}
	public function notificationSend(){
		$userGroup		= trim($_POST['userGroup']);
		$userLevel 		= trim($_POST["userLevel"]);
		$notTitle 		= trim($_POST["notTitle"]);
		$notMessage 	= trim($_POST["notMessage"]);
		
		if($userGroup!="" && $userLevel!=""  && $notTitle!="" && $notMessage!=""){
			$data = array();
			$data['userType']		=	$userGroup;
			$data['userLevel']		=	$userLevel;
			$data['notTitle']		=	$notTitle;
			$data['message']		=	$notMessage;
			$data['msg_date']		=	date('Y-m-d');
			$addAction = $this->current_account_model->addNotification($data);
			if($addAction){
				
				$allNotif = $this->current_account_model->getNotification();
				//print_r($allNotif);
				$notifTable ='';
				foreach($allNotif as $key=> $notificationDetail){
						$className = "notification-tab white";
					if ($key % 2 == 0) {
                  		$className = "notification-tab";
					}
					
					$notifTable .= '<div class="'.$className.'"><h3><a href="#">Read More <img src="'.base_url().'/images/down-arrow.png" alt="" /></a></h3><h2>'.$allNotif[$key]["notTitle"].'</h2><p><span>Notification: </span>'.$allNotif[$key]["message"].'</p><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="left" valign="top"><span>Date: </span>'.$allNotif[$key]["msg_date"].'</td><td align="left" valign="top"><span>Level: </span>'.$allNotif[$key]["userLevel"].'</td></tr></table></div>';
					
				}
				$msg = "Notification send successfully";			
				
				$val = array('success'=>"yes", 'notifTable'=> $notifTable);	
			}	
			else{
			
				$val = array("success" => "no","msg"=>'');
			}	
			
		}
		
		
		$output = json_encode($val);
		echo $output;
	}
	 private function sendEmailToUser($data = array()) {
                
        $this->_to_email = $data['emailID'];
		$this->_from_name = "globalblackenterprises";
		$this->_from_email = "blessings.jain@globalblackenterprises.com";
		if($data['requestFor']=="Withdrawal" ){
			if($data['acTion']=="A"){
				// Approved mail
				$this->_subject = "Your ".$data['requestFor']." Request is in Process";
				$this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello ' . $data['firstName'] .' '. $data['lastName'] . ',</td></tr>
								<tr><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">Your '.$data['requestFor'].' request  for amount ' . $data['requestAmt'] . ' is in Process.</td></tr>								
								<tr><td width="25%">The amount will shortly transfer to your account.</td></tr>
								<tr><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">globalblackenterprises.com</td></tr>
                           </table>';
			}
			else{
				// Rejection mail
				$this->_subject = "Your ".$data['requestFor']." Request is Rejected";
				$this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello ' . $data['firstName'] .' '. $data['lastName'] . ',</td></tr>
								<tr><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">Your '.$data['requestFor'].' request  for amount ' . $data['requestAmt'] . ' is rejected.</td></tr>								
								<tr><td width="25%">Please make a fresh request.</td></tr>
								<tr><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">globalblackenterprises.com</td></tr>
                           </table>';
			}
			
		}	
		
        
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_rawToUser();
            return true;
        } else {
            return false;
        }
    }
	function send_mail_rawToUser() {
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
	// show currency rate 
	public function showCurrencyrate(){
		
		$otherCurRate = $this->current_account_model->getOtherCurrencyRate();
		//print_r($otherCurrrate);exit;
		$exchangeTable = '<table width="100%" border="1" cellspacing="1" cellpadding="1" class="dollr_dsn">  
							<tbody>
								<tr>
									<th colspan="4"><h3> Exchange rate of '.date('d-m-Y').'</h3></th>
										</tr>';
		foreach($otherCurRate as $otherCurRateDetail){
			
			if($otherCurRateDetail['id']==1){
				
			$exchangeTable .="<tr><td>$ ".$otherCurRateDetail['usdAmt']."</td><td><span>></span></td><td>£ ".$otherCurRateDetail['gbpAmt']."</td><td>€ ".$otherCurRateDetail['eurAmt']."</td></tr>";
				
			}
			if($otherCurRateDetail['id']==2){
				
			$exchangeTable .="<tr><td>£ ".$otherCurRateDetail['gbpAmt']."</td><td><span>></span></td><td>$ ".$otherCurRateDetail['usdAmt']."</td><td>€ ".$otherCurRateDetail['eurAmt']."</td></tr>";
				
			}
			if($otherCurRateDetail['id']==3){
				
			$exchangeTable .="<tr><td>€ ".$otherCurRateDetail['eurAmt']."</td><td><span>></span></td><td>$ ".$otherCurRateDetail['usdAmt']."</td><td>£ ".$otherCurRateDetail['gbpAmt']."</td></tr>";
				
			}
		}
		$exchangeTable .="</tbody></table>";
		
			
				
		$val = array('success'=>"yes", 'exchangeTable'=> $exchangeTable);
		$output = json_encode($val);
		echo $output;
	}
}
