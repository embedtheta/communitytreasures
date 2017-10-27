<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Source extends CI_Controller {
    private $_admin_email ;
    function __construct() {
        parent::__construct();
        $this->load->model('gatewaymodel');
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
        $this->_admin_email = "ranajit.das@senabi.com";
    }

    public function index() {
       echo "coming soon";
    }

    /* public function getSwitchOnPaypalRespose(){
      ob_start();
      print_r($_REQUEST);
      $page = ob_get_contents();
      ob_end_clean();
      $fw = fopen('abc.txt', "w+");
      fwrite($fw,$page);
      fclose($fw);
      /////////////////
      if($_REQUEST["status"] == "COMPLETED"){
      $obj = new DataLayer();
      $obj->OpenConnection();
      $qry  ="UPDATE tbluserdetail SET `PaymentStatus`=\"1\" Where UID='".$_REQUEST['uid']."'";
      mysql_query($qry);
      $obj->CloseConnection();
      }
      //////////////////
      $this->gatewaymodel->getSwitchOnPaymentResponse($_REQUEST["uid"]);
      } */
}
