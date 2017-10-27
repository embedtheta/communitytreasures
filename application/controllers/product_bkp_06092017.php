<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {
    private $_admin_email ;
    private $paypal_active = 2; //1=live;2=sandbox
	 private $_from_email;//22/12/2015 new aded us
    private $_from_name;
	//private $this->forWebsite = 2;
    private $paypal_action = '';
    private $paypal_email = '';
    
    function __construct() {
        parent::__construct();
        //$this->load->model('gatewaymodel');
        $this->load->model('product_model');
		$this->load->model('common_model');
		//$this->load->model('fullmembers_model');
        //$this->_admin_email = "blessings.jain@globalblackenterprises.com";
		 $this->_from_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";//22/12/2015 new added us
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "noreply@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";//"senabi.test05@gmail.com"; //
		$this->forWebsite = 2;
    }
    
    public function index() {        
       $this->details();        
    }	
    
    public function details($prod_id = 0) {
        $viewData 					= array();
        $productID					= $prod_id;
        
        if($productID > 0 && is_numeric($productID)) {
			$viewData["pDetails"] 	= $this->product_model->getProduct($productID);			
			if(!empty($viewData["pDetails"])){				
			
				$viewData["pCategory"]	= $this->product_model->getProductCategory($viewData["pDetails"][0]->productTypeID);			
			}
			//print_r($viewData["pCategory"]);exit;
			$viewData["pFiles"] 	= $this->product_model->getProductFiles($productID);
			$viewData["pOffer"] 	= $this->product_model->getOffer($productID);
			
			$viewData['CT_Category']=$this->common_model->ct_category();
			$viewData['CT_Monetizer']=$this->common_model->monetizer_list();
			$viewData['CT_FooterBanner']=$this->common_model->ct_footerBanner();// added by SB on 25/02/2016
			$viewData['monetizer_event'] = $this->common_model->getEvent();
		} else {
			redirect(base_url());
		}
        
		//echo "<pre>";print_r($viewData);echo "</pre>";	
       $this->load->view('product/productDetail', $viewData);
        
    }	
	public function download_pdf(){
		$this->load->helper("file");
		$data = array();
		$p_file = $this->uri->segment(3).".pdf";
		if(!empty($p_file)) {
				
			$file_pdf= $this->config->item('gbe_base_url').'adminuploads/product_files/pdf/'.$p_file;

			/*if (file_exists($file_pdf))
			{*/
				
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename= download.pdf');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file_pdf));
				ob_clean();
				flush();
				readfile($file_pdf);
				exit;
			//}
		}
			
	}         

 
}
