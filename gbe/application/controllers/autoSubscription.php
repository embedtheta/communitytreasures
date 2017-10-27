<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AutoSubscription extends CI_Controller {
	
	private $_adminId;
	private $_admin_email;
    function __construct() {
        parent::__construct();
		$this->load->helper('common');
        $this->load->model('current_account_model');
		$this->load->model('gatewaymodel');
		$this->load->model('subscription_model');
		$this->_adminId = 1000; // added by SB on 17/09/2015
		$this->_admin_email = "info@globalblackenterprises.com";
    }
   
	
	
	public function subscriptionAuto(){
		// select user applicable for subscription 
		
		$subscriptionUser = $this->subscription_model->getSubscriptionUser();
		
		//print_r($subscriptionUser); exit;
		if(count($subscriptionUser)>0)
		{
			foreach($subscriptionUser as $subscriptionUserDetail){
			$userId = '';
			$userId =$subscriptionUserDetail['userId'];
				// subscription levelwise
				
				$userInfo 		= 	$this->gatewaymodel->getUserInfo($userId);
					
				$parentId = $userInfo[0]['referarID'];
				
				if ($parentId == 0) {
					
					$parentInfo = $this->gatewaymodel->getUserInfo($this->_adminId);
				
				} else {
					
					$parentInfo = $this->gatewaymodel->getUserInfo($parentId);
				
				}
				
				$adminInfo = $this->gatewaymodel->getUserInfo($this->_adminId);// admin account default 1000
					
				$subscriptionPrice =50;
				// check user balance  
				$userBalDetail = $this->gatewaymodel->getBalanceInCA($userId);
				if($userBalDetail[0]->commAmt > $subscriptionPrice){
					//sufficient balance  add commission to Admin & Parent  & deduct from User account send mail to Admin , parent & user 
					
					// paying User Detail 
						
					$payCurrency ="";
					if($userInfo[0]['currency']==1){
						$payCurrency			= "USD";
					}
					else if($userInfo[0]['currency']==2){
						$payCurrency			= "GBP";
					} 
					else{
						$payCurrency			= "EUR";
					}
					
					$grossTotal 				= $subscriptionPrice;
					$parentComm 				=30;
					$adminComm  				=20;
					
					$status 					= 1;	
					// add Payment to gbe_payment Table added by SB on 17/09/2015
					$paymentId = $this->insertVirtualPaymentSwitch($userId,$adminComm,$parentComm,$grossTotal,$payCurrency);
					$this->gatewaymodel->setTransactionId($paymentId);// Unique transaction id added by SB on 17/09/2015
					
					
					//   add Payment to Parent 		
					$userDetail = $this->addCommissionToAdminParentAccount($parentId,$userId,$grossTotal,$parentComm,$parentInfo[0]['currency'],$paymentId,$paymentFor,$status);
				
					//  add Payment to Admin 		
					$adminDetail = $this->addCommissionToAdminParentAccount($this->_adminId,$userId,$grossTotal,$adminComm,$adminInfo[0]['currency'],$paymentId,$paymentFor,$status);
					// add to commission table end
					if($adminDetail){
					
						//deduct Subscription payment from user account
							$updateComm = array();
							$updateComm["commAmt"] 			= round($grossTotal,3); //exit;
							$updateComm["commAddSub"] 		= "SUB";
							$updateComm["userId"] 			= $userId;			
							$updateAccountBalance			= $this->current_account_model->updateCurrentAccount($updateComm);				
							
							
							$viewData["currSymbol"]	="";
							$paymentCurrency ="";
							if($userBalDetail[0]->myCurrency==1){
									
									$paymentCurrency			= "USD";
							}
							else if($userBalDetail[0]->myCurrency==2){
									
									$paymentCurrency			= "GBP";
							} 
							else{
									
									$paymentCurrency			= "EUR";
								}	
								
							// get Transaction Id from payment Table				
							$where['gbe_payment.id'] = $paymentId;
							$invoiceDetail = $this->gatewaymodel->getInvoiceData($where);
							// mail to Parent 
							$parentData = array();
							
							$parentData['email']				=	$parentInfo[0]['emailID'];
							$parentData['grossAmt']				=	$grossTotal;
							$parentData['paymentCurrency']		=	$paymentCurrency;
							$parentData['userName']				=	$userInfo[0]['firstName']."".$userInfo[0]['lastName'];
							$parentData['parentName'] 			=	$parentInfo[0]['firstName']."".$parentInfo[0]['lastName'];
							$parentData['transaction_Id']		=	$invoiceDetail[0]->transaction_Id;
							$this->sendEmailSubscriptionPaymentToParent($parentData);
					
					
							// mail to admin 
							$adminData = array();
							$adminData['email']					=	$adminInfo[0]['emailID'];
							$adminData['grossAmt']				=	$grossTotal;
							$adminData['paymentCurrency']		=	$paymentCurrency;
							$adminData['userName']				=	$userInfo[0]['firstName']."".$userInfo[0]['lastName'];
							$adminData['transaction_Id']		=	$invoiceDetail[0]->transaction_Id;
							$this->sendEmailSubscriptionPaymentToAdmin($adminData);
							
							// mail to self
							$myData = array();
							$myData['email'] 					=	$userInfo[0]['emailID'];
							$myData['grossAmt']					=	$grossTotal;
							$myData['paymentCurrency']			=	$paymentCurrency;
							$myData['userName']					=	$userInfo[0]['firstName']."".$userInfo[0]['lastName'];
							$myData['transaction_Id']			=	$invoiceDetail[0]->transaction_Id;
							$this->sendEmailSubscriptionPaymentToUser($myData);				
						// Update present subscription table subscription status 
						$subscriptionData = array();
						$subscriptionData['subscriptionStatus'] = 1;
						$subscriptionData['id'] = $subscriptionUserDetail['id'];
						$updateSubscription = $this->subscription_model->updateSubscriptionInfo($subscriptionData);
						if($updateSubscription)
						{
							//insert in row with subscription date
							$tbl ="user_subscription_info";
							$inserSubscriptionData = array();
							$inserSubscriptionData['userId'] =$userId;
							$inserSubscriptionData['userLevel'] =0;
							$inserSubscriptionData['subscriptionStartDt'] = date("Y-m-d H:i:s");
							$inserSubscriptionData['subscriptionEndDt'] =  date('Y-m-d H:i:s', strtotime("+30 days") );
							$inserSubscriptionData['subscriptionStatus'] = 0;
							$this->common_model->insertDataToTable($tbl, $inserSubscriptionData);
						}
					} 
				}
				else{
				
						//check the reminderCounter if 1 then block the account
					if($subscriptionUserDetail['reminderCounter']>0){
						
						// if reminder is more than 0 then block the account
						$this->gatewaymodel->changeUserStatus($userId,2);// status 2 of permission blocked
					}
					else{
						// less balance send mail to admin, Parent, User suggest TopUp . 
						$subject 			= "Insufficient Balance in Account of ".$userInfo[0]['firstName']."".$userInfo[0]['lastName'];
						$contentUser 			= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr><td colspan="2">Hello '.$userInfo[0]['firstName']."".$userInfo[0]['lastName'].',</td></tr>
												<tr><td colspan="2">You have Insufficient Balance in Account. Please TopUp and your account balance.</td></tr>
												<tr><td colspan="2"></td></tr>									
												<tr><td colspan="2">Thank you very much.</td></tr>
												<tr><td colspan="2">globalblackenterprises.com</td></tr>
												</table>';
						$contentParent 			= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr><td colspan="2">Hello '.$parentInfo[0]['firstName']."".$parentInfo[0]['lastName'].',</td></tr>
												<tr><td colspan="2">User : '.$userInfo[0]['firstName']."".$userInfo[0]['lastName'].' has Insufficient Balance in Account. Please suggest TopUp.</td></tr>
												<tr><td colspan="2"></td></tr>									
												<tr><td colspan="2">Thank you very much.</td></tr>
												<tr><td colspan="2">globalblackenterprises.com</td></tr>
												</table>';
						$contentAdmin 			= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr><td colspan="2">Hello Admin,</td></tr>
												<tr><td colspan="2">User : '.$userInfo[0]['firstName']."".$userInfo[0]['lastName'].' has Insufficient Balance in Account. Please suggest TopUp.</td></tr>
												<tr><td colspan="2"></td></tr>									
												<tr><td colspan="2">Thank you very much.</td></tr>
												<tr><td colspan="2">globalblackenterprises.com</td></tr>
												</table>';
						
						$toUser		 		=	$userInfo[0]['emailID'];
						$toParent		 	=	$parentInfo[0]['emailID'];
						$toAdmin		 	=	$adminInfo[0]['emailID'];
						$this->send_mail_raw($toUser, $subject, $contentUser);// mail to user
						$this->send_mail_raw($toParent, $subject, $contentParent);// mail to parent
						$this->send_mail_raw($toAdmin, $subject, $contentAdmin);// mail to Admin
						
						// update the subscription table with status 2 for failure and reason Insufficient balance
					
						$subscriptionData = array();
						$subscriptionData['subscriptionStatus'] = 2;
						$subscriptionData['id'] = $subscriptionUserDetail['id'];
						$subscriptionData['failureReason'] = 'Insufficient Balance';
						$updateSubscription = $this->subscription_model->updateSubscriptionInfo($subscriptionData);
						if($updateSubscription)
						{
							//insert in row with subscription date
							$tbl ="user_subscription_info";
							$inserSubscriptionData = array();
							$inserSubscriptionData['userId'] =$userId;
							$inserSubscriptionData['userLevel'] =0;
							$inserSubscriptionData['subscriptionStartDt'] = date("Y-m-d H:i:s");
							$inserSubscriptionData['subscriptionEndDt'] =  date('Y-m-d H:i:s', strtotime("+7 days") );
							$inserSubscriptionData['subscriptionStatus'] = 0;
							$inserSubscriptionData['reminderCounter'] = 1;
							$this->common_model->insertDataToTable($tbl, $inserSubscriptionData);
						}
					}
				}
			}
		}
	}
	// Subscription Commission added to Admin & parent Account
	function addCommissionToAdminParentAccount($referarId,$userId,$paymentGrossAmt,$paymentAmt,$payment_currency,$invoice,$paymentFor,$status){
			$commData = array();
			$commData["paymentToUserId"] 	= $referarId;			 
			$commData["paymentFromUserId"] 	= $userId;
			$commData["paymentGrossAmt"] 	= $paymentGrossAmt;
			$commData["paymentAmt"] 		= $paymentAmt;
			$commData["paymentCurrency"] 	= $payment_currency;			
			$commData["paymentFor"] 		= $paymentFor;
			
			$commData["paymentId"] 			= $invoice;
			//$commData["transactionType"]	= ''; // 1-commision, 2- Withdraw, 3- Loan
			//$commData["remark"]				= '';
			$commData["status"] 			= $status;
			//$userDetail = addCommisionToAccount($commData);
			
			$currentAccDetail					= $this->current_account_model->insertCurrentAccountDetail($commData);
			if($currentAccDetail>0){
				// convert commission currency 
				
				
				$updateComm = array();
				$updateComm["commAmt"] 			= round($commData['paymentAmt'],3); //exit;
				$updateComm["commAddSub"] 		= "ADD";
				$updateComm["userId"] 			= $commData["paymentToUserId"];			
				$updateAccountBalance			= $this->current_account_model->updateCurrentAccount($updateComm);
			}
		
		
			return true;
	}	
	private function insertVirtualPaymentSwitch($userId = 0,$adminComm,$parentComm,$grossTotal,$payment_currency) {
        $data = array();
        $data['user_id'] = $userId;        
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['payment_for'] = 8; //1=afroweb catalog,2=level 1 switch on ,3=L2 switch on,4= Top up,5=L3 switch on,6=l4 switch on,7=L5 switch on ,8=L1 subscription,9=L2 subscription,10=L3 subscription,11=L4 subscription,12=L5 subscription      $data['level'] = 1;
        $data['status'] = 'COMPLETED';
		$data['payment_request_date'] = date('D M j H:i:s T Y'); //Wed Jun 17 04:05:34 PDT 2015
        $data['admin_commission'] = $adminComm;
        $data['parent_commossion'] = $parentComm;
        $data['gross_total'] = $grossTotal;
        $data['payment_currency'] = $payment_currency;
        
        $data['all_data_after_pay'] = serialize($data);
        $tbl = 'gbe_payment';
        $insertId = $this->common_model->insertDataToTable($tbl, $data);
        return $insertId;
    }
	 function sendEmailSubscriptionPaymentToUser($data = array()) {
       
        ob_start();
        $this->load->view('email_templates/sendEmailSwitchPaypalPaymentToUser', $data);
        $content = ob_get_clean();
        $subject = 'Subscription Invoice Details';
        $to = $data['email'];
        $this->send_mail_raw($to, $subject, $content);
        return true;
    }
	 function sendEmailSubscriptionPaymentToParent($data = array()) {
        
        ob_start();
        $this->load->view('email_templates/sendEmailSwitchPaypalPaymentToParent', $data);
        $content = ob_get_clean();
        $subject = 'New Subscription Invoice Details';
        $to = $data['email'];
        $this->send_mail_raw($to, $subject, $content);
        return true;
    }

    function sendEmailSubscriptionPaymentToAdmin($data = array()) {
        
        ob_start();
        $this->load->view('email_templates/sendEmailSwitchPaypalPaymentToAdmin', $data);
        $content = ob_get_clean();
        $subject = 'New Subscription Invoice Details';
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
}