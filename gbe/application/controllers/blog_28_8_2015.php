<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends CI_Controller {
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
	public $userDetails;
	public $dataPerPage;
	public $year;
    function __construct() {
        parent::__construct();
		if (!trim($this->session->userdata('userId'))) {
            //redirect(base_url() . 'gateway/', 'refresh');
        }
		
        $this->_from_email = "blessings.jain@globalblackenterprises.com";
        $this->_from_name = "globalblackenterprises.com";
        $this->_admin_email = "blessings.jain@globalblackenterprises.com";
		$this->load->model('gatewaymodel');
		$this->load->model('blog_model');
		$this->city = $this->gatewaymodel->getCity();
		$this->dataPerPage = 10;
    }
	
	public function _setUserDetails($userId){
		if(is_numeric($userId) && $userId > 0){
			$data = $this->gatewaymodel->getUserInfo($userId);
			if($data[0]['uID'] != ''){
				$this->userId = $data[0]['uID'];//trim($this->session->userdata('userId'));
				$this->referarId = $data[0]['referarID'];//trim($this->session->userdata('referarId'));
				$this->userType = $data[0]['userType'];//trim($this->session->userdata('userType'));
				$this->userDetails = $data;
				$this->year = $this->blog_model->getYear($this->userId);
			}else{
				redirect(base_url()."fullmembers");
			}
		}else{
			redirect(base_url()."fullmembers");
		}
	}
	
    public function index($userId) {
		$this->_setUserDetails($userId);
        $viewData = array();
		$viewData["tabhide"] = 0;
        $viewData["msg"] = "";
		$viewData["status"] = "";//error
        if($this->referarId == 0 || $this->referarId == '') {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        }else{
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->referarId);
        }
        $viewData["userInfo"] = $this->userDetails;
		
		
		$base_url = base_url()."blog/index/".$this->userId.'/';
        $total_rows = $this->blog_model->getCountAllBlogDetails($this->userId);
        $per_page = $this->dataPerPage;
        $uri_segment = 4;
        $page = 0;
        if($this->uri->segment(4) > 0 && $this->uri->segment(4) != ""){
            $page = $this->uri->segment(4);
        }
		$viewData['blogDetails'] = $this->blog_model->getAllBlogDetails($this->userId,$per_page,$page);
		$viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
		
		
		$viewData['recentBlogDetails'] = $this->blog_model->getAllBlogDetails($this->userId,6,0);
		$viewData['userType'] = $this->userType;
		$viewData['city'] = $this->city;
		$viewData['year'] = $this->year;
       	$this->load->view('blog/index',$viewData);
		unset($viewData);
    }
	
	public function archive($userId,$year) {
		$this->_setUserDetails($userId);
        $viewData = array();
		$viewData["tabhide"] = 0;
        $viewData["msg"] = "";
		$viewData["status"] = "";//error
        if($this->referarId == 0 || $this->referarId == '') {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        }else{
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->referarId);
        }
        $viewData["userInfo"] = $this->userDetails;
		
		
		$base_url = base_url()."blog/archive/".$this->userId.'/'.$year.'/';
        $total_rows = $this->blog_model->getCountAllBlogDetailsArchive($this->userId,$year);
        $per_page = $this->dataPerPage;
        $uri_segment = 5;
        $page = 0;
        if($this->uri->segment(5) >0 && $this->uri->segment(5) != ""){
            $page = $this->uri->segment(5);
        }
		$viewData['blogDetails'] = $this->blog_model->getAllBlogDetailsArchive($this->userId,$year,$per_page,$page);
		$viewData["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
		
		
		$viewData['recentBlogDetails'] = $this->blog_model->getAllBlogDetails($this->userId,6,0);
		$viewData['userType'] = $this->userType;
		$viewData['city'] = $this->city;
		$viewData['year'] = $this->year;
       	$this->load->view('blog/index',$viewData);
		unset($viewData);
    }
	
	public function view($titleUrl){
		$viewData['blogDetails'] = $this->blog_model->getSingleBlogDetails($titleUrl);
		$this->_setUserDetails($viewData['blogDetails'][0]->post_auther_id);
		$viewData["userInfo"] = $this->userDetails;
		
		$viewData['recentBlogDetails'] = $this->blog_model->getAllBlogDetails($this->userId,6,0);
		$viewData['userType'] = $this->userType;
		$viewData['city'] = $this->city;
		$viewData['year'] = $this->year;
       	$this->load->view('blog/view',$viewData);
		unset($viewData);
	}
	
	public function commonPagination($base_url = "",$total_rows = 0,$per_page = "",$uri_segment = ""){
        $this->load->library('pagination');
        $config = $this->commonPaginationHtml();
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = $uri_segment;
        $config['num_links'] = 2;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
	
	public function commonPaginationHtml() {
        $page['full_tag_open'] = '<div class="new-pagi">';
        $page['full_tag_close'] = '</div>';
        $page['first_link'] = FALSE;
        $page['last_link'] = FALSE;
        $page['prev_link'] = '&lsaquo;&lsaquo; Previous Page';
        $page['next_tag_open'] = '';
        $page['next_tag_close'] = '';
        $page['next_link'] = 'Next page &rsaquo;&rsaquo;';
        $page['prev_tag_open'] = '';
        $page['prev_tag_close'] = '';
        $page['anchor_class'] = 'class="page-count"';
        $page['cur_tag_open'] = '<span class="page-label active-page">';
        $page['cur_tag_close'] = '</span>';
        return $page;
    }
	
	
	
	
	
	
	
}
