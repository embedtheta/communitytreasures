<?php
if (!defined('BASEPATH'))

    exit('No direct script access allowed');
class Referral_Popup extends CI_Controller {
	public function index()
	{
		$this->load->model('common_model');
		$data= $this->common_model->Get_Referral_User();
		echo "Successfully data inserted";
		
	}
	
}
?>