<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ct_payment extends CI_Controller {

    private $_admin_email;
    private $_adminPaypalEmail;
    private $_adminCatalogCommission;
    private $_adminSwitchCommission;
    private $_switchPaymentCost;
    private $_switchPaymentCurrency;
	private $_userId;
	private $_adminId;

    public function __construct() {
        parent::__construct();
        $this->load->model('gatewaymodel');
		//$this->load->model('current_account_model');
        $this->_admin_email = "admin@communitytreasures.co";
        $this->output->enable_profiler(FALSE);
        $this->_adminPaypalEmail = "senabi.test01-facilitator@hotmail.com";//"senabi.test01-buyer@hotmail.com";
        $this->_joiningAmt = 30;
        //$this->_switchPaymentCost = 50;
        $this->_PaymentCurrency = "USD";
        //$this->_adminSwitchCommission = 30;
		$this->load->helper('common');
		//$this->_userId = trim($this->session->userdata('userId'));
		$this->_userId ='';
		//$this->_adminId = 1000; 
    }
	
	public function index($userId = 0) {
		$viewData = array();
		if($userId!=""){
			$this->session->set_userdata('userId', $userId);
			$this->_userId = $userId;
		}
		$this->load->view('raveshare/ravePayment',$viewData);
	}
    public function ctjoin() {
		//echo "++++".$this->session->userdata('userId'); exit;
        if (!$this->session->userdata('userId')) {
			redirect(base_url() . 'gateway/', 'refresh');
	    }
		//echo "====";
		$this->_checkingCatalogPaymentExist();
		$this->display();//display message and disable mouse functionality.
		$productId = 0;//trim($catalogId);
		//$proDetails = $this->gatewaymodel->getAfroProductById($productId);
		$userId = $this->session->userdata('userId');
		/* if ($this->session->userdata('referarId') == 0) {
			$parentInfo = $this->gatewaymodel->getUserInfo($this->_adminId);
		} else {
			$parentInfo = $this->gatewaymodel->getUserInfo($this->session->userdata('referarId'));
		} */
		
		
		$sendDataArray['gross_total'] = $this->_joiningAmt;//$proDetails[0]->cost;
		$sendDataArray['admin_email'] = $this->_adminPaypalEmail;
		$sendDataArray['admin_commission'] = $this->_joiningAmt;
		$sendDataArray['parent_email'] = "";//$parentInfo[0]['paypalAC'];
		$sendDataArray['parent_commossion'] = 0;//$sendDataArray['gross_total'] - $sendDataArray['admin_commission'];
	   	$sendDataArray['payment_currency'] = $this->_PaymentCurrency;
		
		
		//USD //GBP
		$return_url = base_url() . 'ct_payment/returnUrl';
		$cancel_url = base_url() . 'ct_payment/';
		$notify_url = base_url() . 'ct_payment/updatePayment';
	   
		$this->load->library('paypal_payment');
		$this->paypal_payment->setActionType("PAY");
		$this->paypal_payment->setCancelUrl($cancel_url);
		$this->paypal_payment->setReturnUrl($return_url);
		//$this->paypal_payment->setCurrencyCode($proDetails[0]->currency_name);
		$this->paypal_payment->setCurrencyCode($this->_PaymentCurrency);
		if($sendDataArray['parent_email'] != ""){
			$receiverEmailArray = array($sendDataArray['admin_email'], $sendDataArray['parent_email']);
			$receiverAmountArray = array($sendDataArray['admin_commission'],$sendDataArray['parent_commossion']);
		}else{
			$receiverEmailArray = array($sendDataArray['admin_email']);
			$receiverAmountArray = array($sendDataArray['admin_commission']);
		}
		$receiverEmailArray = array($sendDataArray['admin_email']);
		$receiverAmountArray = array($sendDataArray['gross_total']);
		$this->paypal_payment->setReceiverEmailArray($receiverEmailArray);
		$this->paypal_payment->setReceiverAmountArray($receiverAmountArray);
		$this->paypal_payment->setIpnNotificationUrl($notify_url);
		$this->paypal_payment->setTrackingId();
		$resArray = $this->paypal_payment->callPay();
		
		$invoice = $this->insertPayment($userId,$productId,$resArray,$sendDataArray);		
		// add to commission table end		
		$ack = strtoupper($resArray["responseEnvelope.ack"]);
		if ($ack == "SUCCESS") {
			if ("" == $preapprovalKey) {
				// redirect for web approval flow
				$cmd = "cmd=_ap-payment&paykey=" . urldecode($resArray["payKey"]);
				$this->paypal_payment->redirectToPayPal($cmd);
			} else {
				// payKey is the key that you can use to identify the result from this Pay call
				$payKey = urldecode($resArray["payKey"]);
				// paymentExecStatus is the status of the payment
				$paymentExecStatus = urldecode($resArray["paymentExecStatus"]);
			}
		} else {
			//Display a user-friendly Error on the page using any of the following error 
			//information returned by PayPal.
			//TODO - There can be more than 1 error, so check for "error(1).errorId", 
			//then "error(2).errorId", and so on until you find no more errors.
			$ErrorCode = urldecode($resArray["error(0).errorId"]);
			$ErrorMsg = urldecode($resArray["error(0).message"]);
			$ErrorDomain = urldecode($resArray["error(0).domain"]);
			$ErrorSeverity = urldecode($resArray["error(0).severity"]);
			$ErrorCategory = urldecode($resArray["error(0).category"]);

			echo "Preapproval API call failed. ";
			echo "Detailed Error Message: " . $ErrorMsg;
			echo "Error Code: " . $ErrorCode;
			echo "Error Severity: " . $ErrorSeverity;
			echo "Error Domain: " . $ErrorDomain;
			echo "Error Category: " . $ErrorCategory;
		}
		return true;
    }
	
	public function returnUrl(){
		redirect(base_url() . 'ct_payment');
	}
	private function _checkingCatalogPaymentExist(){  
		$data = $this->gatewaymodel->checkingCtSignupPaymentExist($this->_userId);
		if($data[0]->afrooPaymentStatus == '2'){ // if afrooPaymentStatus = 2 that mean payment is done in live system
			$this->session->set_flashdata('type','paypal');
        	$this->session->set_flashdata('status','error');
			$this->session->set_flashdata('msg','You have allready made the Payment.So please continue.');
			redirect(base_url() . 'ct_payment');
		}
		return true;
	}
	public function display(){
        $form_element = '   Please wait....<br>
            Transaction is processing.....
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    jQuery(document).bind("contextmenu", function (e) {
                        e.preventDefault();
                        return false;
                    });
                    jQuery(window).keydown(function (e){
                        if (e.ctrlKey) return false;
                    });
                });
            </script>';
        echo $form_element;
    }
	private function insertPayment($userId = 0,$productId = 0,$resArray = array(),$sendDataArray = array()) {
        $data = array();
        $data['user_id'] = $userId;
        $data['catalog_id'] = $productId;
        
        if(count($sendDataArray) > 0){
            foreach ($sendDataArray as $k => $v){
                $data[$k] = $v;
            }
        }
        
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['payment_for'] = 2; //1=afroweb catalog,2=level 1,3=level 2,4=level 3,5=level 4,6=level 5
        $data['level'] = 1;
        $data['pay_key'] = $resArray['payKey'];
        $data['responseEnvelope_timestamp'] = $resArray['responseEnvelope.timestamp'];
        $data['responseEnvelope_ack'] = $resArray['responseEnvelope.ack'];
        $data['responseEnvelope_correlationId'] = $resArray['responseEnvelope.correlationId'];
        $data['responseEnvelope_build'] = $resArray['responseEnvelope.build'];
        $data['paymentExecStatus'] = $resArray['paymentExecStatus'];
        $data['all_data_after_call_pay'] = serialize($resArray);
        $tbl = 'rave_payment';
        $insertId = $this->common_model->insertDataToTable($tbl, $data);
        return $insertId;
    }

    function updatePayment() {
        $this->updatePaymentInTxtFile("n");
        if (trim($_POST['tracking_id']) != '' && trim($_POST['pay_key']) != '') {
            $insert_array['tracking_id'] = trim($_POST['tracking_id']);
            $insert_array['status'] = trim($_POST['status']);
            $insert_array['test_ipn'] = trim($_POST['test_ipn']);
            $insert_array['transaction_type'] = trim($_POST['transaction_type']);
            $insert_array['action_type'] = trim($_POST['action_type']);
            $insert_array['log_default_shipping_address_in_transaction'] = trim($_POST['log_default_shipping_address_in_transaction']);
            $insert_array['payment_request_date'] = trim($_POST['payment_request_date']);
            $insert_array['transaction'] = serialize($_POST['transaction']);
            $insert_array['notify_version'] = trim($_POST['notify_version']);
            $insert_array['verify_sign'] = trim($_POST['verify_sign']);
            $insert_array['sender_email'] = trim($_POST['sender_email']);
            $insert_array['all_data_after_pay'] = serialize($_POST);
            $insert_array['fees_payer'] = trim($_POST['fees_payer']);
            $where['pay_key'] = trim($_POST['pay_key']);
            $tbl = "rave_payment";
            //update data after IPN return
            $this->common_model->updateDataToTable($tbl, $where, $insert_array);
            unset($tbl);unset($where);unset($insert_array);
            
            $tbl = "rave_payment";
            $where['pay_key'] = trim($_POST['pay_key']);
            $selectedData = 'id,user_id';
            $invoiceData = $this->common_model->fetchDataFromTable($tbl , $where , $selectedData);
            unset($tbl);unset($where);unset($selectedData);
            
            $this->updatePaymentInTxtFileAfter($invoiceData);
            
            if (trim($_POST['status']) == 'COMPLETED') {
				// insert to live system with Payment Done
				
				$userInfoId		=	$this->getDetailsfromRaveshare($invoiceData[0]->user_id);
				
				// Link the rave_payment table with useinfo
				
				$tbl 	= 	"rave_payment";
				$where 	= 	array(
								"pay_key"	=>	trim($_POST['pay_key'])
							);
				$tbldata=	array(
								"user_id"	=>	$userInfoId
							);
				$this->common_model->updateDataToTable($tbl,$where,$tbldata);
				unset($tbl);unset($where);unset($tbldata);
				
				//Update the rave_userinfo payment done as afrooPaymentStatus=2
				
                $tbl = "rave_userinfo";
                $where = array(
								"uID"	=>	$invoiceData[0]->user_id
						);
                $update_array = array(
									"afrooPaymentStatus"	=>	"2"
								);
                $this->common_model->updateDataToTable($tbl, $where, $update_array);
                unset($tbl);unset($where);unset($update_array);
				
            }
            $where['id'] = $invoiceData[0]->id;
            //$this->sendEmailPaypalPaymentToUser($where);
            //$this->sendEmailPaypalPaymentToAdmin($where);
        }

        return TRUE;
    }
	/*  function sendEmailPaypalPaymentToUser($data = array()) {
        $where['gbe_payment.id'] = $data['id'];
        $data['invoice'] = $this->gatewaymodel->getInvoiceData($where);
        ob_start();
        $this->load->view('email_templates/sendEmailCatalogPaypalPaymentToUser', $data);
        $content = ob_get_clean();
        $subject = 'Invoice Details';
        $to = $data['invoice'][0]->emailID;
        $this->send_mail_raw($to, $subject, $content);
        return true;
    } */

    /* function sendEmailPaypalPaymentToAdmin($data = array()) {
        $where['gbe_payment.id'] = $data['id'];
        $data['invoice'] = $this->gatewaymodel->getInvoiceData($where);
        ob_start();
        $this->load->view('email_templates/sendEmailCatalogPaypalPaymentToAdmin', $data);
        $content = ob_get_clean();
        $subject = 'New Invoice Details';
        $to = $this->_admin_email;
        $this->send_mail_raw($to, $subject, $content);
        return true;
    } */
	function updatePaymentInTxtFile($fileName = 'n') {
        $logPath = $this->common_model->imageUnlinkPath() . 'paypal_updateRave_' . $fileName . '.txt';
        if (file_exists($logPath)) {
            unlink($logPath);
        }
        $myfile = fopen($logPath, "w") or die("Unable to open file!");
        $fileData = 'Here are all details ...';
        if (count($_POST) > 0) {
            foreach ($_POST as $k => $v) {
                $fileData .= "\r\n";
                if (is_array($_POST[$k])) {
                    $fileData .= "\r\n";
                    $fileData .= $k . " ==>Start";
                    foreach ($_POST[$k] as $kk => $vv) {
                        $fileData .= "\r\n";
                        $fileData .= $kk . " ==>" . $vv;
                    }
                    $fileData .= "\r\n";
                    $fileData .= $k . " ==>End";
                } else {
                    $fileData .= "\r\n";
                    $fileData .= $k . " ==>" . $v;
                }
            }
        } else {
            $fileData .= "\r\n";
            $fileData .= "Sorry! No Data Please. ";
        }
        fwrite($myfile, $fileData);
        fclose($myfile);
        return TRUE;
    }
	 public function updatePaymentInTxtFileAfter($result = array()) {
        $logPath = $this->common_model->imageUnlinkPath() . 'paypal_update_rave_userinfo.txt';
        if (file_exists($logPath)) {
            unlink($logPath);
        }
        $myfile = fopen($logPath, "w") or die("Unable to open file!");
        $fileData = 'Here are all details ...';
        if (count($result) > 0) {
            foreach ($result as $k => $v) {
                $fileData .= "\r\n";
                if (is_array($result[$k])) {
                    $fileData .= "\r\n";
                    $fileData .= $k . " ==>Start";
                    foreach ($result[$k] as $kk => $vv) {
                        $fileData .= "\r\n";
                        $fileData .= $kk . " ==>" . $vv;
                    }
                    $fileData .= "\r\n";
                    $fileData .= $k . " ==>End";
                } else {
                    $fileData .= "\r\n";
                    $fileData .= $k . " ==>" . $v;
                }
            }
        } else {
            $fileData .= "\r\n";
            $fileData .= "Sorry! No Data Please. ";
        }
        fwrite($myfile, $fileData);
        fclose($myfile);
        return TRUE;
    }
	public function getDetailsfromRaveshare($id){
		//$rave_table_data = $this->common_model->getDataFromRaveuserinfo("1014");
		$rave_table_data = $this->common_model->getDataFromRaveuserinfo($id);
		$user_info_insert_data 		= array(
										"referarID"			=>		$rave_table_data[0]['referarID'],
										"firstName"			=>		$rave_table_data[0]['firstName'],
										"lastName"			=>		$rave_table_data[0]['lastName'],
										"userName"			=>		$rave_table_data[0]['userName'],
										"emailID"			=>		$rave_table_data[0]['emailID'],
										"password"			=>		$rave_table_data[0]['password'],
										"phone"				=>		$rave_table_data[0]['phone'],
										"gender"			=>		$rave_table_data[0]['gender'],
										"occupation"		=>		$rave_table_data[0]['occupation'],
										"address"			=>		$rave_table_data[0]['address'],
										"city"				=>		$rave_table_data[0]['city'],
										"state"				=>		$rave_table_data[0]['state'],
										"country"			=>		$rave_table_data[0]['country'],
										"zip"				=>		$rave_table_data[0]['zip'],
										"currency"			=>		$rave_table_data[0]['currency'],
										"webUrl"			=>		$rave_table_data[0]['webUrl'],
										"profile"			=>		$rave_table_data[0]['profile'],
										"paypalAC"			=>		$rave_table_data[0]['paypalAC'],
										"switchOnPayment"	=>		$rave_table_data[0]['switchOnPayment'],
										"mssLevelUpPayment"	=>		$rave_table_data[0]['mssLevelUpPayment'],
										"tenDollerPayment"	=>		$rave_table_data[0]['tenDollerPayment'],
										"afrooPaymentStatus"=>		$rave_table_data[0]['afrooPaymentStatus'],
										"skypeID"			=>		$rave_table_data[0]['skypeID'],
										"email_send_status"	=>		$rave_table_data[0]['email_send_status'],
										"userType"			=>		$rave_table_data[0]['userType'],
										"userLevel"			=>		$rave_table_data[0]['userLevel'],
										"status"			=>		$rave_table_data[0]['status'],
										"created_date"		=>		$rave_table_data[0]['created_date'],
										"facebookLink"		=>		$rave_table_data[0]['facebookLink'],
										"myBlogger"			=>		$rave_table_data[0]['myBlogger'],
										"twitterLink"		=>		$rave_table_data[0]['twitterLink'],
										"youTubeUrl"		=>		$rave_table_data[0]['youTubeUrl'],
										"forWebsite"		=>		$rave_table_data[0]['forWebsite']
								);
		$userInfoId					=	$this->common_model->insertDataToTable("userinfo",$user_info_insert_data);
		if($userInfoId!=""){
			//updating user name to the user info table
			
				$table_name 		= 	"userinfo";
				$condition 			= 	array(
											"uID"	=>	$userInfoId
										);
				$updatedata			=	array(
											"userName"	=>	str_replace($rave_table_data[0]['uID'],$userInfoId,$rave_table_data[0]['userName']) 
										);
				$this->common_model->updateDataToTable($table_name,$condition,$updatedata);
				unset($table_name);unset($condition);unset($updatedata);
			
			$user_generalType_insert_data=	array(
												"user_id"					=>		$userInfoId,
												"user_general_type_name"	=>		$rave_table_data[0]['user_type']
											);
			$userGeneralTypeId			=	$this->common_model->insertDataToTable("user_general_type",$user_generalType_insert_data);
		}
		return $userInfoId;
		//echo "<pre>";
		//print_r($user_info_insert_data);
		//echo "</pre>";
	}
}