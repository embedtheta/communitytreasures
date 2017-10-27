<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pp extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		//echo 'hi==12';
		$this->load->library('paypal_payment');
		//echo 'hi==14';
		$this->paypal_payment->setActionType("PAY");
		$this->paypal_payment->setCancelUrl("http://globalblackenterprises.com/pp/cancel/");
		$this->paypal_payment->setReturnUrl("http://globalblackenterprises.com/pp/returns/");
		$this->paypal_payment->setCurrencyCode("USD");
		$receiverEmailArray = array('paytestevika-facilitator@gmail.com');
		$this->paypal_payment->setReceiverEmailArray($receiverEmailArray);
		$receiverAmountArray = array(10);
		$this->paypal_payment->setReceiverAmountArray($receiverAmountArray);
		$this->paypal_payment->setIpnNotificationUrl("http://globalblackenterprises.com/pp/nUrl/");
		$this->paypal_payment->setTrackingId();
		//echo 'hi';exit;
		$resArray = $this->paypal_payment->callPay();
		print_r($resArray);
		$ack = strtoupper($resArray["responseEnvelope.ack"]);
		if($ack=="SUCCESS"){
			if ("" == $preapprovalKey){
				// redirect for web approval flow
				$cmd = "cmd=_ap-payment&paykey=" . urldecode($resArray["payKey"]);
				$this->paypal_payment->redirectToPayPal ($cmd);
			}else{
				// payKey is the key that you can use to identify the result from this Pay call
				$payKey = urldecode($resArray["payKey"]);
				// paymentExecStatus is the status of the payment
				$paymentExecStatus = urldecode($resArray["paymentExecStatus"]);
			}
		}else{
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
		
	}
	
	public function cancel(){
		$this->updatePaymentInTxtFile("c");
		echo 'Cancel';	
	}
	
	public function returns(){
		$this->updatePaymentInTxtFile("r");
		echo 'returns';	
	}
	
	public function nUrl(){
		$this->updatePaymentInTxtFile("n");
	}
	
	public function updatePaymentInTxtFile($type = "n") {
        $logPath = $this->common_model->imageUnlinkPath() . 'paypal_parallel_update_'.$type.'.txt';
        if (file_exists($logPath)) {
            unlink($logPath);
        }
        $myfile = fopen($logPath, "w") or die("Unable to open file!");
        $fileData = 'Here are all details ...';
        if (count($_POST) > 0) {
            foreach ($_POST as $k => $v) {
                $fileData .= "\r\n";
                $fileData .= $k . " ==>" . $v;
            }
        }else{
            $fileData .= "\r\n";
            $fileData .= "Sorry! No Data Please. ";
        }
        fwrite($myfile, $fileData);
        fclose($myfile);
        return TRUE;
    }
}


?>