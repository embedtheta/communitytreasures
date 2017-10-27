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
		$insertData["myCurrency"]	=	$payingUserDetail[0]["currency"];
		$createZeroBalaAcct	= $CI->current_account_model->insertCurrentAccount($insertData);
        return $createZeroBalaAcct;
    }
}

if (!function_exists('addCommisionToAccount')) {
    function addCommisionToAccount($commData=array()) {
        
		$CI = get_instance();
		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('current_account_model');		
		$commDetail = array();
		$commDetail["paymentToUserId"] 		= $commData["userId"];		
		$commDetail["paymentFromUserId"] 	= $commData["paymentFromUserId"];
		//$commDetail["paymentGrossAmt"] 		= $commData["paymentGrossAmt"];
		//$commDetail["paymentAmt"] 			= $commData["paymentAmt"];
		$commDetail["paymentCurrency"] 		= $commData["paymentCurrency"];
		$commDetail["paymentFor"] 			= $commData["paymentFor"];
		$commDetail["fromWebsite"] 			= $commData["fromWebsite"];
		$commDetail["paymentId"] 			= $commData["paymentId"];
		$commDetail["transactionType"] 		= $commData["transactionType"];
		$commDetail["remark"]				= $commData["remark"];
		$commDetail["status"] 				= $commData["status"];
		$commDetail["myCurrency"] 			= $commData["myCurrency"];
		
		// currency conversion before insert 
		$currValue							= $CI->current_account_model->getOtherCurrencyRate($commData["paymentCurrency"]);
		if($commData["paymentCurrency"]==1)			
			{				
				if($commDetail["myCurrency"]==2){
					$commDetail['paymentGrossAmt']  = $commData["paymentGrossAmt"]*$currValue[0]['gbpAmt'];
					$commDetail["paymentAmt"] 	    = $commData["paymentAmt"]*$currValue[0]['gbpAmt'];
					
				}
				else if($commDetail["myCurrency"]==3){
					$commDetail['paymentGrossAmt']  = $commData["paymentGrossAmt"]*$currValue[0]['eurAmt'];
					$commDetail["paymentAmt"]		= $commData["paymentAmt"]*$currValue[0]['eurAmt'];
				}
				else{
					$commDetail['paymentGrossAmt']  = $commData["paymentGrossAmt"];
					$commDetail["paymentAmt"]		= $commData["paymentAmt"];
				}
			}
			else if($commData["paymentCurrency"]==2){
				
				if($commDetail["myCurrency"]==1){
					$commDetail['paymentGrossAmt']	= $commData["paymentGrossAmt"]*$currValue[0]['usdAmt'];
					$commDetail["paymentAmt"]		= $commData["paymentAmt"]*$currValue[0]['usdAmt'];
				}
				else if($commDetail["myCurrency"]==3){
					$commDetail['paymentGrossAmt']	= $commData["paymentGrossAmt"]*$currValue[0]['eurAmt'];
					$commDetail["paymentAmt"]		= $commData["paymentAmt"]*$currValue[0]['eurAmt'];
				}
				else{
					$commDetail['paymentGrossAmt']  = $commData["paymentGrossAmt"];
					$commDetail["paymentAmt"]		= $commData["paymentAmt"];
				}
			}
			else{
				
				if($commDetail["myCurrency"]==1){
					$commDetail['paymentGrossAmt']  = $commData["paymentGrossAmt"]*$currValue[0]['usdAmt'];
					$commDetail['paymentAmt'] 		= $commData["paymentAmt"]*$currValue[0]['usdAmt'];
				}
				else if($commDetail["myCurrency"]==2){
					$commDetail['paymentGrossAmt']	= $commData["paymentGrossAmt"]*$currValue[0]['gbpAmt'];
					$commDetail['paymentAmt'] 		= $commData["paymentAmt"]*$currValue[0]['gbpAmt'];
				}
				else{
					$commDetail['paymentGrossAmt']  = $commData["paymentGrossAmt"];
					$commDetail['paymentAmt'] 		= $commData["paymentAmt"];
				}
			}
				
		
		$currentAccDetail					= $CI->current_account_model->insertCurrentAccountDetail($commDetail);
		if($currentAccDetail>0){
			// convert commission currency 
			
			
			$updateComm = array();
			$updateComm["commAmt"] 			= round($commDetail['paymentAmt'],3); //exit;
			$updateComm["commAddSub"] 		= "ADD";
			$updateComm["userId"] 			= $commData["userId"];			
			$updateAccountBalance	= $CI->current_account_model->updateCurrentAccount($updateComm);
		}			
        return $updateAccountBalance;
    }
}


?>  