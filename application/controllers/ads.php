<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ads extends CI_Controller {
    private $_from_email;
    private $_from_name;
    private $_admin_email;
    private $_to_email;
    private $_subject;
    private $_message;    
	public $userId;
	
	
    public function __construct() {
        parent::__construct();
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
		$this->userId = trim($this->session->userdata('userId'));
		$this->referarId = trim($this->session->userdata('referarId'));
		$this->userType = trim($this->session->userdata('userType'));
        $this->_from_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
		$this->load->model('gatewaymodel');		
		$this->forWebsite = "2";
        $this->load->library("pagination");
    }
	
    public function index() {
       $viewData = array();
		if($this->referarId == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
			//print_r($viewData["parentInfo"]);exit;
        }else{
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->referarId);
        }
		$viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->userId);		
		$viewData['userId'] = $this->userId;
		$viewData["accessPermission"] = 2;
        //$viewData["categoryList"] = $this->common_model->fetch_category(100, 0);
        $viewData["categoryList"] = $this->common_model->ct_category();
        ###############  Pagination Code ###########
        //$categoryId = 265;
        if ($this->input->post("categoryId") != "") {
        $categoryId = $this->input->post("categoryId");
        }
        $viewData["categoryId"] = $categoryId;
        $this->load->model('common_model');
        $config = array();
        $config["base_url"] = base_url() . "ads";
        $config["total_rows"] = $this->common_model->totalAds_count($categoryId);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //$viewData["list"] = $this->common_model->fetchTopAds($config["per_page"], $page, $categoryId);
		$tempList = $this->common_model->fetchTopAds_visited($config["per_page"], $page, $this->session->userdata('userId'), $categoryId);
		$viewData["list"] = $tempList;
		
		$tempList_music = $this->common_model->fetchTopAds_visited_music(1, $page, $this->session->userdata('userId'), 265);//MUSIC & MUSICIANS
		$viewData["list_music"] = $tempList_music;
		
		$tempList_events = $this->common_model->fetchTopAds_visited_events(1, $page, $this->session->userdata('userId'), 299);//CARERS & CARE SERVICES
		$viewData["list_events"] = $tempList_events;
		
			
		//print_r($tempList);
        $viewData["links"] = $this->pagination->create_links();
		
		$list_cms = $this->common_model->fetch_adcms(100, 0);
		$viewData['youtubeurl'] = $list_cms[0]->youtubeurl;
		
		$banners = $this->common_model->fetchBanner();
		$viewData["banner_list"] = $banners;
		
        ###############  End Pagination Code ###########
		/*echo "<pre>";
        print_r($viewData);exit;*/
		$this->load->view('ads/adsView',$viewData);
    }
	
	public function explore_taks() {
		 $ad_id=$_POST['adid'];
		 $user_id = $this->session->userdata('userId'); 
		 $this->common_model->explore_task($ad_id,$user_id);
		 //redirect(base_url() . "ads");
	}
	
	
	
}
