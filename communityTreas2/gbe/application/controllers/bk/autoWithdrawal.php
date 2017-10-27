<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AutoWithdrawal extends CI_Controller {
	
	private $_adminId;
	private $_admin_email;
	private $_senderEmail;// admin email
    function __construct() {
        parent::__construct();
		$this->load->helper('common');
        $this->load->model('current_account_model');
		$this->load->model('gatewaymodel');
		$this->load->model('withdrawal_model');
		$this->_adminId = 1000; // added by SB on 17/09/2015
		$this->_admin_email = "info@globalblackenterprises.com";
		$this->_senderEmail = "senabi.test04@gmail.com";
    }
   
	
	
	public function withdrawalAuto(){
		//echo '1234';
		// check Admin balance  
		$adminBalDetail = $this->gatewaymodel->getBalanceInCA($this->_adminId);
		
		// check the user have cycle date  10th day or 25th day of month
		$inProcessUser 	=	$this->withdrawal_model->getWithdrawalRequestInprocess();
		//echo "==========";print_r($inProcessUser); exit;
		// get admin detail 
		$adminInfo = $this->gatewaymodel->getUserInfo($this->_adminId);// admin account default 1000
		$currencyCode 		='';
		if($adminInfo[0]['currency']==1){
			$currencyCode = 'USD';			
		}
		else if($adminInfo['currency']==2){
			$currencyCode = 'GBP';
		}
		else{
			$currencyCode = 'EUR';
		}
		foreach($inProcessUser as $inProcessUserDetail){			
			
			$recieverEmail 			=	'';
			$recieverAmt			=	'';
			$userInfo				= 	$this->gatewaymodel->getUserInfo($inProcessUserDetail['userId']);
			//$recieverAmt		  	= 	$inProcessUserDetail['transferAmt'];
			$userRequestAmt   		=	$inProcessUserDetail['transferAmt'];
			$userCurrency			=	$userInfo[0]['currency'];
			$userCurrencyCode		='';
			if($userInfo[0]['currency']==1){
				$userCurrencyCode = 'USD';			
			}
			else if($userInfo['currency']==2){
				$userCurrencyCode = 'GBP';
			}
			else{
				$userCurrencyCode = 'EUR';
			}
			$recieverAmt			=	$this->getConvertedCurrencyValue($adminInfo[0]['currency'],$userRequestAmt,$userCurrency);	// converted price
			
			if($adminBalDetail[0]->commAmt > $recieverAmt){
			//sufficient balance  in Admin Account 		
				
				$recieverPayEmail 	  = $inProcessUserDetail['paypalAC'];// Receiver paypal Account				
				$userId				  = $inProcessUserDetail['userId'];
				$accTablId			  = $inProcessUserDetail['accTblId']; // amount_transfer , my_current_account_detail  table id 
				$notify_url 		  = base_url() . 'autoWithdrawal/updatePayment';
				$cancel_url 		  = 'http://xxxxxxxxx';
				$return_url 		  = 'http://xxxxxxxxxxxx';
				$bodyparams			  = array();
				//Create Pay body
					$bodyparams = array (   "requestEnvelope.errorLanguage" => "en_US",
							'actionType' => 'PAY',
							'currencyCode' => $currencyCode,
							'receiverList.receiver(0).email' => $recieverPayEmail,
							'receiverList.receiver(0).amount' => $recieverAmt,
							'senderEmail' => $this->_senderEmail,
							'memo' => 'Test memo',
							'ipnNotificationUrl' => $notify_url,
							'cancelUrl' => $cancel_url,
							'returnUrl' => $return_url
						);
					$updateDataArray						=   array();
					$updateDataArray['userId']				=	$userId;
					$updateDataArray['accTablId']			=	$accTablId;
					$updateDataArray['recieverAmt']			=	$recieverAmt;// amount in admin currency
					$updateDataArray['amtInUserCurrency']	=	$userRequestAmt;
					$updateDataArray['userCurrency']		=	$userCurrencyCode;
					$updateDataArray['adminCurrency']		=	$currencyCode;
					$updateDataArray['userName']			=	$userInfo[0]['firstName']." ".$userInfo[0]['lastName'];
					$updateDataArray['userEmail']			=	$userInfo[0]['emailID'];
						// Call Pay API
					$this->AdaptiveCall($bodyparams, "Pay",$updateDataArray);
			}
		}
		
		
	}
	
	/*private function insertPaymentAdminToUser($adminId = 0,$transferAmt,$payment_currency) {
        $data = array();
        $data['user_id'] = $adminId;        
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['payment_for'] = 13; //1=afroweb catalog,2=level 1 switch on ,3=L2 switch on,4= Top up,5=L3 switch on,6=l4 switch on,7=L5 switch on ,8=L1 subscription,9=L2 subscription,10=L3 subscription,11=L4 subscription,12=L5 subscription,13=withdrawal Payment 
		//$data['level'] = 1;
        $data['status'] = 'COMPLETED';
		$data['payment_request_date'] = date('D M j H:i:s T Y'); //Wed Jun 17 04:05:34 PDT 2015
        $data['gross_total'] = $transferAmt;
        $data['payment_currency'] = $payment_currency;
        
        $data['all_data_after_pay'] = serialize($data);
        $tbl = 'gbe_payment';
        $insertId = $this->common_model->insertDataToTable($tbl, $data);
        return $insertId;
    }	
	*/
	function AdaptiveCall($bodyparams, $method, $updateDataArray=array(), $payKey) {

		try
		{

			$body_data = http_build_query($bodyparams, "", chr(38));
			$url = trim("https://svcs.sandbox.paypal.com/AdaptivePayments/".$method."");
			$params = array("http" => array( 
								"method" => "POST",
								"content" => $body_data,
									"header" => "X-PAYPAL-SECURITY-USERID: senabi.test04_api1.gmail.com\r\n" .
												"X-PAYPAL-SECURITY-SIGNATURE: A8xk0kqX2d0C-2.IVOgMzMnV4b3dADbu52nVUzSDS3yKwddkLeOQIM.O\r\n" .
												"X-PAYPAL-SECURITY-PASSWORD: XXHD3A4A36HUF3NG\r\n" .
												"X-PAYPAL-APPLICATION-ID: APP-80W284485P519543T\r\n" .
												"X-PAYPAL-REQUEST-DATA-FORMAT: NV\r\n" .
												"X-PAYPAL-RESPONSE-DATA-FORMAT: NV\r\n" 
											)
							);


			//create stream context
			 $ctx = stream_context_create($params);


			//open the stream and send request
			 $fp = @fopen($url, "r", false, $ctx);

			//get response
			 $response = stream_get_contents($fp);

			//check to see if stream is open
			 if ($response === false) {
				throw new Exception("php error message = " . "$php_errormsg");
			 }

			//close the stream
			 fclose($fp);

			//parse the ap key from the response

			$keyArray = explode("&", $response);

			foreach ($keyArray as $rVal){
				list($qKey, $qVal) = explode ("=", $rVal);
					$kArray[$qKey] = $qVal;
			}
			
			//insert in payment Table added by SB on 22/09/2015
			$insertPayData = array();
			$insertPayData['pay_key']= $kArray['payKey'];
			$insertPayData['responseEnvelope_timestamp'] = $kArray['responseEnvelope.timestamp'];
			$insertPayData['responseEnvelope_ack'] = $kArray['responseEnvelope.ack'];
			$insertPayData['responseEnvelope_correlationId'] = $kArray['responseEnvelope.correlationId'];
			$insertPayData['responseEnvelope_build'] = $kArray['responseEnvelope.build'];
			$insertPayData['paymentExecStatus'] = $kArray['paymentExecStatus'];
			$insertPayData['all_data_after_call_pay'] = serialize($kArray);
			
			$insertPayData['status'] = $kArray['paymentExecStatus'];            
            $insertPayData['transaction_type'] = "Adaptive Payment PAY cron";
            $insertPayData['action_type'] = "PAY";
            $insertPayData['log_default_shipping_address_in_transaction'] = false;
            $insertPayData['payment_request_date'] = date('D M j H:i:s T Y');
                   
            $insertPayData['sender_email'] = $this->_senderEmail;
			$insertPayData['gross_total'] = $updateDataArray['recieverAmt'];
			$insertPayData['payment_currency']	= $updateDataArray['adminCurrency'];// currency code
            $insertPayData['all_data_after_pay'] = serialize($insertPayData);
            $insertPayData['fees_payer'] = "EACHRECEIVER";
			
			$tbl = 'gbe_payment';
			$paymentId = $this->common_model->insertDataToTable($tbl, $insertPayData);
			
			//return $insertId;
			if($paymentId){
				
				$this->gatewaymodel->setTransactionId($paymentId);// Unique transaction id added by SB on 22/09/2015
				
				
			}
			 //print the response to screen for testing purposes
				If ( $kArray["responseEnvelope.ack"] == "Success") {
					
					
					// send mail to user & admin 
						$where['gbe_payment.id'] = $paymentId;
						$invoiceDetail = $this->gatewaymodel->getInvoiceData($where);
						$userMailData		=		array();
						$adminMailData		=		array();
						
						$userMailData['userName']			=		$updateDataArray['userName'];
						$userMailData['userEmail']			=		$updateDataArray['userEmail'];
						$userMailData['transaction_Id']		=		$invoiceDetail[0]->transaction_Id;
						$userMailData['grossAmt']			=		$updateDataArray['amtInUserCurrency'];
						$userMailData['paymentCurrency']	=		$updateDataArray['userCurrency'];
						
						$adminMailData['userName']			=		$updateDataArray['userName'];				
						$adminMailData['transaction_Id']	=		$invoiceDetail[0]->transaction_Id;
						$adminMailData['grossAmt']			=		$updateDataArray['recieverAmt'];
						$adminMailData['paymentCurrency']	=		$updateDataArray['adminCurrency'];
						$this->sendEmailWithdrawalPaymentToUser($userMailData);
						
						$this->sendEmailWithdrawalPaymentToAdmin($adminMailData);
					// update amount_transfer table status accTblId
					
					// update amount_tranfer table status
					$this->withdrawal_model->updateAmtTransferStatus($updateDataArray['accTablId']);
					
					// update my_current_account_details table withdrawal status					
					$this->withdrawal_model->updateAmtTransferStatus($updateDataArray['accTablId']);
					
					//update the admin & user account balance					
					$accountBalanceData = array();	
					$accountBalanceData['userId']		=	$updateDataArray['userId'];	
					$accountBalanceData['adminId']		=	$this->_adminId;
					$accountBalanceData['adminAmt']		=	$updateDataArray['recieverAmt'];
					$accountBalanceData['userAmt']		=	$updateDataArray['amtInUserCurrency'];					
					$this->addCommisionToAccount($accountBalanceData);
					
					
					
						//echo "<strong>".$method ."</strong><br>";
						
						// write a text file with unique name
						$logPath = $this->common_model->imageUnlinkPath() . 'paypal_Withdrawal_' . $kArray['payKey'] . '.txt';
						if (file_exists($logPath)) {
							unlink($logPath);
						}
						$myfile = fopen($logPath, "w") or die("Unable to open file!");
						$fileData = 'Here are all details ...';
						if (count($kArray) > 0) {
							
							foreach ($kArray as $key =>$value){
									//echo $key . ": " .$value . "<br/>";	
								$fileData .= "\r\n";
								$fileData .= $key . "==> " .$value . "<br/>";				
								
							}
						} else 
						{
							$fileData .= "\r\n";
							$fileData .= "Sorry! No Data Please. ";
						}
						fwrite($myfile, $fileData);
						fclose($myfile);
						return TRUE;
						
						
					// Return payKey
					global $payKey;
					if(!empty($kArray['payKey'])) { 
						$payKey = $kArray['payKey']; return($payKey); 
					}

				 }
				else {
					
						echo 'ERROR Code: ' .  $kArray["error(0).errorId"] . " <br/>";
						echo 'ERROR Message: ' .  urldecode($kArray["error(0).message"]) . " <br/>";
				}

		   }
		catch(Exception $e) {
			echo "Message: ||" .$e->getMessage()."||";
		  }
	}

		function updatePayment() {
       /*  $this->updatePaymentInTxtFile("withdraw_".$_POST['pay_key']);
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
            
           // $this->updatePaymentInTxtFileAfter($invoiceData);
            
            if (trim($_POST['status']) == 'COMPLETED') {
               
            }
            $where['id'] = $invoiceData[0]->id;
            $this->sendEmailWithdrawalPaymentToUser($where);
            $this->sendEmailWithdrawalPaymentToAdmin($where);
        } */

        return TRUE;
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
	 function sendEmailWithdrawalPaymentToUser($data = array()) {
       
        $mailData 						= 	array();
		$mailData['userName']			=	$data['userName'];
		$mailData['transaction_Id']		=	$data['transaction_Id'];
		$mailData['grossAmt']			=	$data['grossAmt'];
		$mailData['paymentCurrency']	=	$data['paymentCurrency'];
        ob_start();
        $this->load->view('email_templates/sendEmailAutoPaymentToUser', $mailData);
        $content = ob_get_clean();
        $subject = 'Withdrawal Payment Details';
        $to = $data['userEmail'];
		//$to = $data['invoice'][0]->emailID;
        $this->send_mail_raw($to, $subject, $content);
        return true;
    }
	

    function sendEmailWithdrawalPaymentToAdmin($data = array()) {
        
        $mailData 						= 	array();
		$mailData['userName']			=	$data['userName'];
		$mailData['transaction_Id']		=	$data['transaction_Id'];
		$mailData['grossAmt']			=	$data['grossAmt'];
		$mailData['paymentCurrency']	=	$data['paymentCurrency'];
        $this->load->view('email_templates/sendEmailAutoPaymentToAdmin', $mailData);
        $content = ob_get_clean();
        $subject = 'Withdrawal Payment Details';
        $to = $this->_admin_email;
		//$to = $data['invoice'][0]->emailID;
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
	 //balance Update to Admin & user Account
	function addCommisionToAccount($accountBalanceData =array()){
		
		// add balance to User Account  		
		$updateComm = array();
		$updateComm["commAmt"] 			= round($accountBalanceData['userAmt'],3); //exit;
		$updateComm["commAddSub"] 		= "ADD";
		$updateComm["userId"] 			= $accountBalanceData['userId'];			
		$updateAccountBalance			= $this->current_account_model->updateCurrentAccount($updateComm);
		
		// deduct balance from admin account  
		// get admin detail update admin balance table
		
		$updateAdmin = array();
		$updateAdmin["commAmt"] 		= round($accountBalanceData['adminAmt'],3); //exit;
		$updateAdmin["commAddSub"] 		= "SUB";
		$updateAdmin["userId"] 			= $accountBalanceData['adminId'];			
		$updateAdminAccountBalance		= $this->current_account_model->updateCurrentAccount($updateAdmin);
		
		return true;
	}	
	
	// get currency conversion value 
	function getConvertedCurrencyValue($paymentCurrency,$paymentAmt,$userCurrency){
		// currency conversion 
		$currValue							= $this->current_account_model->getOtherCurrencyRate($paymentCurrency);
		$currAmtAfterConversion = '';
		if($paymentCurrency==1)			
			{				
				if($userCurrency==2){
					$currAmtAfterConversion 	    = $paymentAmt*$currValue[0]['gbpAmt'];					
				}
				else if($userCurrency==3){
					$currAmtAfterConversion		= $paymentAmt*$currValue[0]['eurAmt'];
				}
				else{
					$currAmtAfterConversion		= $paymentAmt;
				}
			}
		else if($paymentCurrency==2){
				
			if($userCurrency==1){
				$currAmtAfterConversion		= $paymentAmt*$currValue[0]['usdAmt'];
			}
			else if($userCurrency==3){
				$currAmtAfterConversion		= $paymentAmt*$currValue[0]['eurAmt'];
			}
			else{
				$currAmtAfterConversion		= $paymentAmt;
			}
		}
		else{
			
			if($userCurrency==1){
				$currAmtAfterConversion 		= $paymentAmt*$currValue[0]['usdAmt'];
			}
			else if($userCurrency==2){
				$currAmtAfterConversion 		= $paymentAmt*$currValue[0]['gbpAmt'];
			}
			else{
				$currAmtAfterConversion 		= $paymentAmt;
			}
		}
		
		return $currAmtAfterConversion;
	}
}