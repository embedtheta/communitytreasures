<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Admin_afrowebb_order extends CI_Controller {
    public $orderId; 
    private $viewdata;
    public $dataPerPage;
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_order_model');
        $this->orderId = 0;
        $this->viewdata = array();
        $this->dataPerPage = 20; 
        $this->output->enable_profiler(FALSE);
    }
    
    public function viewList(){
        $base_url = base_url()."admin_afrowebb_order/viewList/";
        $total_rows = $this->admin_order_model->getTotalOrdersAfro();
        $per_page = $this->dataPerPage;
        $uri_segment = 3;
        $page = 0;
        if($this->uri->segment(3) > 0 && $this->uri->segment(3) != ""){
            $page = $this->uri->segment(3);
        }
        $this->viewdata['orders'] = $this->admin_order_model->getOrdersAfro($per_page,$page);
        $this->viewdata["pagination"] = $this->commonPagination($base_url,$total_rows,$per_page,$uri_segment);
        $this->load->view('adminTemplates/orders/afro/viewList', $this->viewdata);
    }
    
    public function viewDetails($orderId = 0){
        $this->viewdata['details'] = $this->admin_order_model->getOrderDetail($orderId);
		// check the product type Digital/Physical 
		$typeOfProduct= array();
		foreach($this->viewdata['details'] as $key=>$orderDetails){
			$typeOfProduct[] =  $this->admin_order_model->getProductType($orderDetails->productId);
			
		}
		//print_r($typeOfProduct); exit;
        if (in_array(2, $typeOfProduct)) {
			$this->viewdata["shipAddStatus"] = 1;
		}
		else{
			$this->viewdata["shipAddStatus"] = 2;
		}
		
		//print "<pre>";
       	//print_r($this->viewdata['details']);
        $this->load->view('adminTemplates/orders/afro/viewDetails', $this->viewdata);
    }
    
    public function createPdf($orderId = 0){
        
    }
    
    public function sendEmail($orderId = 0){
        
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
    
    
}
