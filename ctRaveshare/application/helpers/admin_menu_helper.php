<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 


if(!function_exists('making_pre_url')){
	function making_pre_url(){
		$obj 		=& get_instance();	
		$url		=	$obj->uri->uri_string();
		$obj->session->set_userdata('pre_url',$url);
		return true;
	}
}

if(!function_exists('admin_menu')){
	function admin_menu(){
		$obj 		=& get_instance();	
		$obj->load->model('data_model');
		$val		=	$obj->data_model->getAllMenu();
		$ret_arr	=	array();
		if(!empty($val) && count($val)>0){
			foreach($val as $ja){
				$ret_arr[$ja['parentMenuID']][$ja['menuID']]					=	$ja['menuName'];
			}
		}
		return $ret_arr;
	}
}


?>  