<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Gbe_payment extends CI_Controller {

    private $_admin_email;
    private $_adminPaypalEmail;
    private $_adminCatalogCommission;
    private $_adminSwitchCommission;
    private $_switchPaymentCost;
    private $_switchPaymentCurrency;

    public function __construct() {
        parent::__construct();
        $this->load->model('gatewaymodel');
        $this->_admin_email = "info@globalblackenterprises.com";
        $this->output->enable_profiler(FALSE);
        $this->_adminPaypalEmail = "senabi.test01-buyer@hotmail.com";
        $this->_adminCatalogCommission = 30;
        $this->_switchPaymentCost = 50;
        $this->_switchPaymentCurrency = "USD";
        $this->_adminSwitchCommission = 30;
		$this->load->helper('common');// added by SB on 17/07/2015
    }

    public function catalog($catalogId = 0) {
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
        $this->display();//display message and disable mouse functionality.
        $productId = trim($catalogId);
        $proDetails = $this->gatewaymodel->getAfroProductById($productId);
        $userId = $this->session->userdata('userId');
        if ($this->session->userdata('referarId') == 0) {
            $parentInfo = $this->gatewaymodel->getUserInfo(1000);
        } else {
            $parentInfo = $this->gatewaymodel->getUserInfo($this->session->userdata('referarId'));
        }
        
        if($parentInfo[0]['paypalAC'] != ""){
            $sendDataArray['gross_total'] = $proDetails[0]->cost;
            $sendDataArray['admin_email'] = $this->_adminPaypalEmail;
            $sendDataArray['admin_commission'] = $this->_adminCatalogCommission;
            $sendDataArray['parent_email'] = $parentInfo[0]['paypalAC'];
            $sendDataArray['parent_commossion'] = $sendDataArray['gross_total'] - $sendDataArray['admin_commission'];
        }else{
            $sendDataArray['gross_total'] = $proDetails[0]->cost;
            $sendDataArray['admin_email'] = $this->_adminPaypalEmail;
            $sendDataArray['admin_commission'] = $proDetails[0]->cost;//$this->_adminCatalogCommission;
            $sendDataArray['parent_email'] = "";//$parentInfo[0]['paypalAC'];
            $sendDataArray['parent_commossion'] = 0;//$sendDataArray['gross_total'] - $sendDataArray['admin_commission'];
       }
        $sendDataArray['payment_currency'] = $proDetails[0]->currency_name;
        
        
        //USD //GBP
        $return_url = base_url() . 'dashboard/';
        $cancel_url = base_url() . 'dashboard/';
        $notify_url = base_url() . 'gbe_payment/updatePayment';
       
        $this->load->library('paypal_payment');
        $this->paypal_payment->setActionType("PAY");
        $this->paypal_payment->setCancelUrl($cancel_url);
        $this->paypal_payment->setReturnUrl($return_url);
        $this->paypal_payment->setCurrencyCode($proDetails[0]->currency_name);
        /*if($sendDataArray['parent_email'] != ""){
            $receiverEmailArray = array($sendDataArray['admin_email'], $sendDataArray['parent_email']);
            $receiverAmountArray = array($sendDataArray['admin_commission'],$sendDataArray['parent_commossion']);
        }else{
            $receiverEmailArray = array($sendDataArray['admin_email']);
            $receiverAmountArray = array($sendDataArray['admin_commission']);
        }*/
		$receiverEmailArray = array($sendDataArray['admin_email']);
        $receiverAmountArray = array($sendDataArray['gross_total']);
        $this->paypal_payment->setReceiverEmailArray($receiverEmailArray);
        $this->paypal_payment->setReceiverAmountArray($receiverAmountArray);
        $this->paypal_payment->setIpnNotificationUrl($notify_url);
        $this->paypal_payment->setTrackingId();
        $resArray = $this->paypal_payment->callPay();
        
        $invoice = $this->insertPayment($userId,$productId,$resArray,$sendDataArray);
        
		// add to commission table start added by SB on 17/07/2015			
			$paymentFor 		= 'L1 Catalogue';			
			$status 			= 1;			
			$userDetail = $this->addCommissionToUserAccount($this->session->userdata('referarId'),$userId,$sendDataArray['gross_total'],$sendDataArray['parent_commossion'],$sendDataArray['payment_currency'],$invoice,$paymentFor,$status);
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
        $data['payment_for'] = 1; //1=afroweb catalog,2=level 1,3=level 2,4=level 3,5=level 4,6=level 5
        $data['level'] = 1;
        $data['pay_key'] = $resArray['payKey'];
        $data['responseEnvelope_timestamp'] = $resArray['responseEnvelope.timestamp'];
        $data['responseEnvelope_ack'] = $resArray['responseEnvelope.ack'];
        $data['responseEnvelope_correlationId'] = $resArray['responseEnvelope.correlationId'];
        $data['responseEnvelope_build'] = $resArray['responseEnvelope.build'];
        $data['paymentExecStatus'] = $resArray['paymentExecStatus'];
        $data['all_data_after_call_pay'] = serialize($resArray);
        $tbl = 'gbe_payment';
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
            $tbl = "gbe_payment";
            //update data after IPN return
            $this->common_model->updateDataToTable($tbl, $where, $insert_array);
            unset($tbl);unset($where);unset($insert_array);
            
            $tbl = "gbe_payment";
            $where['pay_key'] = trim($_POST['pay_key']);
            $selectedData = 'id,user_id';
            $invoiceData = $this->common_model->fetchDataFromTable($tbl , $where , $selectedData);
            unset($tbl);unset($where);unset($selectedData);
            
            $this->updatePaymentInTxtFileAfter($invoiceData);
            
            if (trim($_POST['status']) == 'COMPLETED') {
                $tbl = "userinfo";
                $where['uID'] = $invoiceData[0]->user_id;
                $insert_array['afrooPaymentStatus'] = "1";
                $this->common_model->updateDataToTable($tbl, $where, $insert_array);
                unset($tbl);unset($where);unset($insert_array);
            }
            $where['id'] = $invoiceData[0]->id;
            $this->sendEmailCatalogPaypalPaymentToUser($where);
            $this->sendEmailCatalogPaypalPaymentToAdmin($where);
        }

        return TRUE;
    }

    function sendEmailCatalogPaypalPaymentToUser($data = array()) {
        $where['gbe_payment.id'] = $data['id'];
        $data['invoice'] = $this->gatewaymodel->getInvoiceData($where);
        ob_start();
        $this->load->view('email_templates/sendEmailCatalogPaypalPaymentToUser', $data);
        $content = ob_get_clean();
        $subject = 'Invoice Details';
        $to = $data['invoice'][0]->emailID;
        $this->send_mail_raw($to, $subject, $content);
        return true;
    }

    function sendEmailCatalogPaypalPaymentToAdmin($data = array()) {
        $where['gbe_payment.id'] = $data['id'];
        $data['invoice'] = $this->gatewaymodel->getInvoiceData($where);
        ob_start();
        $this->load->view('email_templates/sendEmailCatalogPaypalPaymentToAdmin', $data);
        $content = ob_get_clean();
        $subject = 'New Invoice Details';
        $to = $this->_admin_email;
        $this->send_mail_raw($to, $subject, $content);
        return true;
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

    function updatePaymentInTxtFile($fileName = 'n') {
        $logPath = $this->common_model->imageUnlinkPath() . 'paypal_update_' . $fileName . '.txt';
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
        $logPath = $this->common_model->imageUnlinkPath() . 'paypal_update_userinfo.txt';
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
    
    public function swichOn(){
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
        $this->display();//display message and disable mouse functionality.
        $productId = 0;
        $userId = $this->session->userdata('userId');
        if ($this->session->userdata('referarId') == 0) {
            $parentInfo = $this->gatewaymodel->getUserInfo(1000);
        } else {
            $parentInfo = $this->gatewaymodel->getUserInfo($this->session->userdata('referarId'));
        }
        
        if($parentInfo[0]['paypalAC'] != ""){
            $sendDataArray['gross_total'] = $this->_switchPaymentCost;
            $sendDataArray['admin_email'] = $this->_adminPaypalEmail;
            $sendDataArray['admin_commission'] = $this->_adminSwitchCommission;
            $sendDataArray['parent_email'] = $parentInfo[0]['paypalAC'];
            $sendDataArray['parent_commossion'] = $sendDataArray['gross_total'] - $sendDataArray['admin_commission'];
        }else{
            $sendDataArray['gross_total'] = $this->_switchPaymentCost;
            $sendDataArray['admin_email'] = $this->_adminPaypalEmail;
            $sendDataArray['admin_commission'] = $this->_switchPaymentCost;
            $sendDataArray['parent_email'] = "";
            $sendDataArray['parent_commossion'] = 0;
        }
        $sendDataArray['payment_currency'] = $this->_switchPaymentCurrency;
        
        
        //USD //GBP
        $return_url = base_url() . 'dashboard/#tab3';
        $cancel_url = base_url() . 'dashboard/#tab3';
        $notify_url = base_url() . 'gbe_payment/updatePaymentSwitch';
       
        $this->load->library('paypal_payment');
        $this->paypal_payment->setActionType("PAY");
        $this->paypal_payment->setCancelUrl($cancel_url);
        $this->paypal_payment->setReturnUrl($return_url);
        $this->paypal_payment->setCurrencyCode($this->_switchPaymentCurrency);
        /*if($sendDataArray['parent_email'] != ""){
            $receiverEmailArray = array($sendDataArray['admin_email'], $sendDataArray['parent_email']);
            $receiverAmountArray = array($sendDataArray['admin_commission'],$sendDataArray['parent_commossion']);
        }else{
            $receiverEmailArray = array($sendDataArray['admin_email']);
            $receiverAmountArray = array($sendDataArray['admin_commission']);
        }*/
		$receiverEmailArray = array($sendDataArray['admin_email']);
        $receiverAmountArray = array($sendDataArray['gross_total']);
		
        $this->paypal_payment->setReceiverEmailArray($receiverEmailArray);
        $this->paypal_payment->setReceiverAmountArray($receiverAmountArray);
        $this->paypal_payment->setIpnNotificationUrl($notify_url);
        $this->paypal_payment->setTrackingId();
        $resArray = $this->paypal_payment->callPay();
        
        $invoice = $this->insertPaymentSwitch($userId,$productId,$resArray,$sendDataArray);
        
		// add to commission table start added by SB on 17/07/2015			
		$paymentFor 		= 'L1 Switchon';			
		$status 			= 1;			
		$userDetail = $this->addCommissionToUserAccount($this->session->userdata('referarId'),$userId,$sendDataArray['gross_total'],$sendDataArray['parent_commossion'],$sendDataArray['payment_currency'],$invoice,$paymentFor,$status);
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
    
    private function insertPaymentSwitch($userId = 0,$productId = 0,$resArray = array(),$sendDataArray = array()) {
        $data = array();
        $data['user_id'] = $userId;
        $data['catalog_id'] = $productId;
        
        if(count($sendDataArray) > 0){
            foreach ($sendDataArray as $k => $v){
                $data[$k] = $v;
            }
        }
        
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['payment_for'] = 2; //1=afroweb catalog,2=level 1 swich on
        $data['level'] = 1;
        $data['pay_key'] = $resArray['payKey'];
        $data['responseEnvelope_timestamp'] = $resArray['responseEnvelope.timestamp'];
        $data['responseEnvelope_ack'] = $resArray['responseEnvelope.ack'];
        $data['responseEnvelope_correlationId'] = $resArray['responseEnvelope.correlationId'];
        $data['responseEnvelope_build'] = $resArray['responseEnvelope.build'];
        $data['paymentExecStatus'] = $resArray['paymentExecStatus'];
        $data['all_data_after_call_pay'] = serialize($resArray);
        $tbl = 'gbe_payment';
        $insertId = $this->common_model->insertDataToTable($tbl, $data);
        return $insertId;
    }
    
    public function updatePaymentSwitch(){
        $this->updatePaymentInTxtFile("s");
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
            $tbl = "gbe_payment";
            //update data after IPN return
            $this->common_model->updateDataToTable($tbl, $where, $insert_array);
            unset($tbl);unset($where);unset($insert_array);
            
            $tbl = "gbe_payment";
            $where['pay_key'] = trim($_POST['pay_key']);
            $selectedData = 'id,user_id';
            $invoiceData = $this->common_model->fetchDataFromTable($tbl , $where , $selectedData);
            unset($tbl);unset($where);unset($selectedData);
            
            //$this->updatePaymentInTxtFileAfter($invoiceData);
            
            if (trim($_POST['status']) == 'COMPLETED') {
                $tbl = "userinfo";
                $where['uID'] = $invoiceData[0]->user_id;
                $insert_array['switchOnPayment'] = "1";
                $this->common_model->updateDataToTable($tbl, $where, $insert_array);
                unset($tbl);unset($where);unset($insert_array);
            }
            $where['id'] = $invoiceData[0]->id;
            $this->sendEmailSwitchPaypalPaymentToUser($where);
            $this->sendEmailSwitchPaypalPaymentToAdmin($where);
        }

        return TRUE;
    }
    
    function sendEmailSwitchPaypalPaymentToUser($data = array()) {
        $where['gbe_payment.id'] = $data['id'];
        $data['invoice'] = $this->gatewaymodel->getInvoiceData($where);
        ob_start();
        $this->load->view('email_templates/sendEmailSwitchPaypalPaymentToUser', $data);
        $content = ob_get_clean();
        $subject = 'Invoice Details';
        $to = $data['invoice'][0]->emailID;
        $this->send_mail_raw($to, $subject, $content);
        return true;
    }

    function sendEmailSwitchPaypalPaymentToAdmin($data = array()) {
        $where['gbe_payment.id'] = $data['id'];
        $data['invoice'] = $this->gatewaymodel->getInvoiceData($where);
        ob_start();
        $this->load->view('email_templates/sendEmailSwitchPaypalPaymentToAdmin', $data);
        $content = ob_get_clean();
        $subject = 'New Invoice Details';
        $to = $this->_admin_email;
        $this->send_mail_raw($to, $subject, $content);
        return true;
    }
	// function to add commission Added by SB on 20/07/2015
	function addCommissionToUserAccount($referarId,$userId,$paymentGrossAmt,$paymentAmt,$payment_currency,$invoice,$paymentFor,$status){
			$commData = array();
			$commData["userId"] 			= $referarId;
			$commData["myCurrency"]			= $this->gatewaymodel->getParentCurrency($referarId);// parent currency for conversion 
			$commData["paymentFromUserId"] 	= $userId;
			$commData["paymentGrossAmt"] 	= $paymentGrossAmt;
			$commData["paymentAmt"] 		= $paymentAmt;
			if($payment_currency=="USD")
			{
				$commData["paymentCurrency"] 	= '1';//USD
			}
			else if($payment_currency=="GBP")
			{
				$commData["paymentCurrency"] 	= '2';//GBP
			}
			else{
				$commData["paymentCurrency"] 	= '3';// EUR
			}
			$commData["paymentFor"] 		= $paymentFor;
			//$commData["fromWebsite"] 		= '';
			$commData["paymentId"] 			= $invoice;
			//$commData["transactionType"]	= ''; // 1-commision, 2- Withdraw, 3- Loan
			//$commData["remark"]				= '';
			$commData["status"] 			= $status;
			$userDetail = addCommisionToAccount($commData);
			return true;
	}
}
