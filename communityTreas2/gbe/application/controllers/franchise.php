<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Franchise extends CI_Controller {
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
}
