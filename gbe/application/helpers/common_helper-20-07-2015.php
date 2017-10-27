<?php
/* Helper is created by Ranajit Das*/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  $obj 		=& get_instance();
  $obj->load->model('data_model');
  $val		=	$obj->data_model->getAllMenu();
 */
/* this function is created by Ranajit Das on 11-03-2015*/
if (!function_exists('userTypeArray')) {
    function userTypeArray() {
        $data['userType'] = array('GAMBIA','PAYING USER','VOLUNTEERS');
        $data['gambiaUserType'] = array('TALENTED','MENTORSHIP','HEALTH','STUDENT','COMUNITIES','BUSINESS');
        return $data;
    }
}

if (!function_exists('showMenu')) {
    function showMenu($userType = "PAYING USER",$userLevel = 0,$afroPaymentStatus = "0") {
        $viewArray = array("TEACHER","ADMIN","HEAD VOLUNTEERS","VOLUNTEERS","STUDENT");;
        if(in_array($userType, $viewArray) || ($userType == "PAYING USER" && $userInfo[0]["afrooPaymentStatus"]=="1")){
            
        
        }
        unset($viewArray);
        return $data;
    }
}

if (!function_exists('createCurrentAccount')) {
    function createCurrentAccount($userId=0) {
        
		$CI = get_instance();

		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('current_account_model');
		$payingUserDetail = $CI->current_account_model->getPayingUserDetail($userId);
		//print_r($payingUserDetail);
		//echo $payingUserDetail[0]["uID"];		
		$insertData = array();
		$insertData["userId"]	=	$payingUserDetail[0]["uID"];
		$insertData["commAmt"]	=	0;
		$insertData["amtFor"]	=	"";
		$insertData["myCurrency"]	=	"USD";
		$insertData["paymentCurrency"]	=	"";
		$createZeroBalaAcct	= $CI->current_account_model->insertCurrentAccount($insertData);
        return $createZeroBalaAcct;
    }
}

?>  