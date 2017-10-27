<?php

class Payment extends CI_Controller {

	private $_from_name;
	private $_from_email;
	private $_to_email;
    private $_subject;
    private $_message;
	
    public function __construct() {
        parent::__construct();
        $this->load->model('paymentmodel');  
		$this->_from_email = "noreply@communitytreasures.co";
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "noreply@communitytreasures.co"; 
		
        //$this->_admin_email = "admin@communitytreasures.co";
        $this->_adminPaypalEmail = "senabi.test01-facilitator@hotmail.com"; 
    }

    public function index() {print_r($_SESSION);
		$viewData					= array();
		
		$viewData['cat_list']		= $this->paymentmodel->getCatList();
		$viewData['country_list']	= $this->paymentmodel->getCountryList();
		$viewData['industry_list']	= $this->paymentmodel->getIndustryList();
		//print_r($viewData);exit;
		$this->load->view('payment/registration', $viewData);
	} 
	
	public function process() {
		//print_r($_POST);exit;
		$sendDataArray['gross_total'] = '0.01';//$this->input->post('amount');//$proDetails[0]->cost;
		$sendDataArray['admin_email'] = $this->_adminPaypalEmail;
		/*$sendDataArray['admin_commission'] = $this->_joiningAmt;
		$sendDataArray['parent_email'] = "";//$parentInfo[0]['paypalAC'];
		$sendDataArray['parent_commossion'] = 0;//$sendDataArray['gross_total'] - $sendDataArray['admin_commission'];
	   	$sendDataArray['payment_currency'] = $this->_PaymentCurrency;*/
		
		
		//USD //GBP
		$return_url = base_url() . 'payment/returnUrl';
		$cancel_url = base_url() . 'payment/';
		$notify_url = base_url() . 'payment/updatePayment';
	   
		$this->load->library('paypal_payment');
		$this->paypal_payment->setActionType("PAY");
		$this->paypal_payment->setCancelUrl($cancel_url);
		$this->paypal_payment->setReturnUrl($return_url);
		//$this->paypal_payment->setCurrencyCode($proDetails[0]->currency_name);
		$this->paypal_payment->setCurrencyCode($this->_PaymentCurrency);
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
		
		$details				= serialize($_POST);	
		$insArr					= array("details" => $details);
		$insID					= $this->paymentmodel->insertData( $insArr, 'temp_account_payment' );
		$this->session->set_userdata('lastinsertID', $insID);
		
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
	
	public function cancel() {
		$viewData				= array();		
		$this->load->view('payment/cancel', $viewData);
	}
	
	public function success() {
		//echo "<pre>";print_r($_REQUEST);exit;
		$viewData				= array();		
		$userDetails			= $_REQUEST['item_number'];
		$get_val				= explode("||", $userDetails);
		$title					= $get_val[0];
		$fName					= $get_val[1];
		$lName					= $get_val[2];
		$mName					= $get_val[3];
		$email					= $get_val[4];
		$phone					= $get_val[5];
		$category				= $get_val[6];
		$country				= $get_val[7];
		$Industry				= $get_val[8];
		
		$paymentAmt				= $_REQUEST['payment_gross'];
		$receipt				= $_REQUEST['txn_id'];
		$paymentDate			= $_REQUEST['payment_date'];
		$ref					= $_REQUEST['item_name'];
		
		$viewData['paymentAmt']	= $paymentAmt;
		$viewData['receipt']	= $receipt;
		$viewData['paymentDate']= $paymentDate;
		
		$viewData['email']		= $email;
		if($title == 'mr') {
			$gender				= "male";
		} else {
			$gender				= "female";
		}
		$insArr					= array(
									"referarID"			=> "0",
									"firstName"			=> $fName,
									"lastName"			=> $lName,
									"userName"			=> $email,
									"emailID"			=> $email,								
									"phone"				=> $phone,
									"gender"			=> $gender,
									"city"				=> 0,
									"country"			=> $country,
									"userType"			=> 'PAYING USER',
									"account_type_ap"	=> '1',
									"forWebsite"		=> '2',
									"created_date"		=> date("Y-m-d h:i:s")
									);//echo "<pre>";print_r($insArr);exit;
		$insID					= $this->paymentmodel->insertData($insArr, 'userinfo');
		
		$rlnsArr				= array(
									"user_id"			=> $insID,
									"cat_id"			=> $category,
									"industry_id"		=> $Industry,
									"payment_ref"		=> $ref,
									"payment_amt"		=> $paymentAmt
									);
		$this->paymentmodel->insertData($rlnsArr, 'user_account_rlns');
		
		$viewData['user_id']	= $insID;
		$this->load->view('payment/success', $viewData);
		/*echo $fname=$get_val[0];
		print_r($_REQUEST);
		echo $item_number = $_GET['item_number']; die;
		$txn_id = $_GET['tx'];
		$payment_gross = $_GET['amt'];
		$currency_code = $_GET['cc'];
		$payment_status = $_GET['st'];	*/
			
	}	
	
	public function returnUrl(){
		redirect(base_url() . 'payment');
	}
	
	public function signup() {		
		$viewData				= array();
		$userID					= $this->input->post('txtid');
		$userDetails			= $this->paymentmodel->getUserInfo($userID);
		$viewData['username']	= $userDetails[0]['userName'];
		$viewData['user_id']	= $userID;
		if($this->input->post('txtsignup') == 'confirm') {
			$userID				= $this->input->post('txtuserid');
			$password			= $this->input->post('txtpassword');
			$editArr			= array("password" => $password);
			$condArr			= array("uID" => $userID);
			//echo "<pre>";print_r($editArr);exit;
			$editdata			= $this->paymentmodel->updateData($editArr, 'userinfo', $condArr);
			if($editdata) {
				$userDetails 	= $this->paymentmodel->getUserInfo($userID);
                //echo "<pre>";print_r($userDetails);exit;
				
				$this->_to_email 	= $userDetails[0]["emailID"];		
				$this->_subject 	= 'Sign up confirmation mail';
				$this->_message = '<html><body><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial; font-weight:400; text-align:justify; color:#000;" align="center">
  <tbody>
    <tr><td>User</td><td>'.$userDetails[0]["emailID"].'</td></tr><tr><td>Password</td><td>'.$password.'</td></tr> 
  </tbody>
</table></body></html>';
					$this->send_mail_raw();
				  $this->session->set_userdata('userId', $userDetails[0]["uID"]);
	          	  $this->session->set_userdata('referarId', $userDetails[0]["referarID"]);
	              $this->session->set_userdata('emailId', $userDetails[0]["emailID"]);
	              $this->session->set_userdata('userName', $userDetails[0]["userName"]);                   
	              $this->session->set_userdata('userType', $userDetails[0]["userType"]);
				  $this->session->set_userdata('forWebsite', $userDetails[0]['forWebsite']);//29/10/2015 ujjwal sana added
				  $this->_addLoginData();
				  redirect(base_url() . 'dashboard/apdashboard/', 'refresh');					  
			}
		}
		//echo "<pre>";print_r($userDetails);
		$this->load->view('payment/signup', $viewData);
	}
	
	private function _addLoginData(){
		$this->load->library('user_agent');
		if ($this->agent->is_browser()){
    		$agent = $this->agent->browser().' '.$this->agent->version();
		}elseif ($this->agent->is_robot()){
    		$agent = $this->agent->robot();
		}elseif ($this->agent->is_mobile()){
		    $agent = $this->agent->mobile();
		}else{
    		$agent = 'Unidentified User Agent';
		}
		$insertData = array();
		$insertData['userId'] = trim($this->session->userdata('userId'));
		$insertData['browserDetails'] = $agent;
		$insertData['remoteIp'] = $this->input->ip_address();
		$insertData['platform'] = $this->agent->platform();
		$insertData['loginDateTime'] = date("Y-m-d H:i:s");
		$tbl = "user_login_info";
		$id = $this->common_model->insertDataToTable($tbl, $insertData);
		$this->session->set_userdata('lastLoginId', $id);
		return true;
	}
	
	function send_mail_raw() {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
        $headers .= 'From: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\r\n";
        $headers .= 'Return-Path: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\n";
        $send = mail($this->_to_email, $this->_subject, $this->_message, $headers);
        if ($send) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	function updatePayment() {
        //$this->updatePaymentInTxtFile("n");
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
					
				//Insert into userinfotable				
				
            }
            $where['id'] = $invoiceData[0]->id;
            
        }

        return TRUE;
    }
    
}
