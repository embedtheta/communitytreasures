<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Currentaccount extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->_admin_email = "blessings.jain@globalblackenterprises.com";
		$this->load->helper('common');
        $this->load->model('current_account_model');
		$this->load->model('gatewaymodel');
    }
   	
	public function addCurrentAccount(){
		//echo "11"; 
		$userDetail = createCurrentAccount('1052');
		//print_r($userDetail);		echo "Success".$userDetail;
	}
	public function myAccount(){	
		        
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        } 
		$viewData = array();		
		
		$viewData["userInfo"] 		= 	$this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
		$viewData["accountInfo"]	=	$this->current_account_model->getAccountDetail($this->session->userdata('userId'));
		//print_r($viewData["userInfo"]);
		//echo "=========".$viewData["userInfo"][0]['currency'];
		$viewData["myCurrency"]	="";
		$viewData["currSymbol"]	="";
		if($viewData["accountInfo"][0]['myCurrency']==1){
			$viewData["myCurrency"] =  "USD";
			$viewData["currSymbol"]		=	"$";
		}
		else if($viewData["accountInfo"][0]['myCurrency']==2){
			$viewData["myCurrency"] =  "GBP";
			$viewData["currSymbol"]		=	"£";
		} 
		else{
			$viewData["myCurrency"] =  "EUR";
			$viewData["currSymbol"]		=	"€";
			}	
		$viewData["balance"]		=	$viewData["accountInfo"][0]['commAmt'];			
		$viewData["liability"]		=	0;	
		
		
		$viewData['totalRewardPoints'] = 0;
		$viewData['paypalAc']			= $viewData["userInfo"][0]['paypalAC'];
		
		$weekMonth						= $this->current_account_model->getWeekMonthCalculation($this->session->userdata('userId'));
		$viewData['thisWeek']			=	$weekMonth[0]['this_week'];
		$viewData['lastWeek']			=	$weekMonth[0]['prev_week'];
		$viewData['thisMonth']			=	$weekMonth[0]['this_month'];
		$viewData['lastSixMonth']		=	$weekMonth[0]['last_six_month'];
		// view Commission for catalogue
		$viewData["AllCom"]	=	$this->current_account_model->getCommissionDetail($this->session->userdata('userId'));
		
		$viewData["topUpAll"] = $this->current_account_model->getTopUpDetail($this->session->userdata('userId'));
		// print_r($userCom); exit;		
		// view Commission for Product 
		$viewData['productComm'] = $this->current_account_model->getProductCommissionDetail($this->session->userdata('userId'));
		// withdrawal Tab start 
		
		$viewData["allWithdrawal"] = $this->current_account_model->getWithdrawalLoanRequest($this->session->userdata('userId'),2);
		$viewData["withdrawStatus"] = 1;
		$viewData['withdrawPending'] =0;
		foreach($viewData["allWithdrawal"] as $allWithdrawals){
			if($allWithdrawals['status']==0){
				$viewData["withdrawStatus"] = 0;
				$viewData['withdrawPending'] = $allWithdrawals['paymentAmt'];
				$viewData["balance"]		= number_format((float)$viewData["balance"]-$allWithdrawals['paymentAmt'], 2, '.', '');
			}
		}
		$viewData['withdrawalTotal']	=	$this->current_account_model->getMyWithdrawals($this->session->userdata('userId'));
		// withdrawal Tab end
		//step wise video added by SB on 07/09/2015
		
		$viewData["stepWiseIncomeVideo"] = $this->common_model->getLevelWiseVideoById(66);
		$viewData["stepWiseafroVideo"] = $this->common_model->getLevelWiseVideoById(67);
		$viewData["topUpVideo"] = $this->common_model->getLevelWiseVideoById(68);
		//print_r($viewData["stepWiseIncomeVideo"]);
		// notifications 
		$userType					=	0 ; //$this->current_account_model->getUserType($this->session->userdata('userId'));
		$viewData['notification']	=	$this->current_account_model->getNotification($userType,$viewData["userInfo"][0]['userLevel']);
		$viewData['unReadnotif']	=	$this->current_account_model->getUnreadNotification($userType,$viewData["userInfo"][0]['userLevel']);
		$msgTypeDetails = $this->setMessage();
		$viewData['userName']	=	$this->session->userdata('userName');
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
		$this->load->view('currentaccount/myaccount', $viewData);	 
		//$this->load->view('currentaccount/myaccountCommingSoon', $viewData);	// for live cooming soon page.
		
		
	}
	public function myAccountLocal(){	
		        
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        } 
		$viewData = array();		
		$viewData["userInfo"] 		= 	$this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
		$viewData["accountInfo"]	=	$this->current_account_model->getAccountDetail($this->session->userdata('userId'));
		//print_r($viewData["userInfo"]);
		//echo "=========".$viewData["userInfo"][0]['currency'];
		$viewData["myCurrency"]	="";
		$viewData["currSymbol"]	="";
		if($viewData["accountInfo"][0]['myCurrency']==1){
			$viewData["myCurrency"] =  "USD";
			$viewData["currSymbol"]		=	"$";
		}
		else if($viewData["accountInfo"][0]['myCurrency']==2){
			$viewData["myCurrency"] =  "GBP";
			$viewData["currSymbol"]		=	"£";
		} 
		else{
			$viewData["myCurrency"] =  "EUR";
			$viewData["currSymbol"]		=	"€";
			}	
		$viewData["balance"]		=	$viewData["accountInfo"][0]['commAmt'];			
		$viewData["liability"]		=	0;	
		
		
		$viewData['totalRewardPoints'] = 0;
		$viewData['paypalAc']			= $viewData["userInfo"][0]['paypalAC'];
		
		$weekMonth						= $this->current_account_model->getWeekMonthCalculation($this->session->userdata('userId'));
		$viewData['thisWeek']			=	$weekMonth[0]['this_week'];
		$viewData['lastWeek']			=	$weekMonth[0]['prev_week'];
		$viewData['thisMonth']			=	$weekMonth[0]['this_month'];
		$viewData['lastSixMonth']		=	$weekMonth[0]['last_six_month'];
		// view Commission for catalogue
		$viewData["AllCom"]	=	$this->current_account_model->getCommissionDetail($this->session->userdata('userId'));
		// print_r($userCom); exit;		
		// view Commission for Product 
		$viewData['productComm'] = $this->current_account_model->getProductCommissionDetail($this->session->userdata('userId'));
		// withdrawal Tab start 
		
		$viewData["allWithdrawal"] = $this->current_account_model->getWithdrawalLoanRequest($this->session->userdata('userId'),2);
		$viewData["withdrawStatus"] = 1;
		foreach($viewData["allWithdrawal"] as $allWithdrawals){
			if($allWithdrawals['status']==0){
				$viewData["withdrawStatus"] = 0;
			}
		}
		$viewData['withdrawalTotal']	=	$this->current_account_model->getMyWithdrawals($this->session->userdata('userId'));
		// withdrawal Tab end
		$msgTypeDetails = $this->setMessage();
		$viewData['userName']	=	$this->session->userdata('userName');
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
		$this->load->view('currentaccount/myaccountlocal', $viewData);	 
		//$this->load->view('currentaccount/myaccountCommingSoon', $viewData);	// for live cooming soon page.
		
		
	}
	 public function setMessage(){
        $retData = array();
        $type = $this->session->flashdata('type');
        $status = $this->session->flashdata('status');
        $msg = $this->session->flashdata('msg');
        if($status == "success"){
            
                if($msg != ""){
                    $retData["msg"] = $msg;
				}
            $retData["type"] = $type;
        }elseif($status == "error"){
             if($msg != ""){
                $retData["msg"] = $msg;
            }else{
                $retData["msg"] = "Please try again.";
            }
            $retData["type"] = "wrong";
        }
        return $retData;
    }	
	public function viewCurrencyRate(){
		$selCurId = trim($_POST["selCurId"]);
		$otherCurrRate = $this->current_account_model->getOtherCurrencyRate($selCurId);
		//echo $otherCurrRate[0]["gbpAmt"];
		if($otherCurrRate){
			if($selCurId==1){
				$otherCurrRate1 ="GBP<br> <strong>".$otherCurrRate[0]["gbpAmt"]."</strong>";
				$otherCurrRate2 ="EUR<br> <strong>".$otherCurrRate[0]["eurAmt"]."</strong>";
			}
			else if($selCurId==2){
				$otherCurrRate1 ="USD<br> <strong>".$otherCurrRate[0]["usdAmt"]."</strong>";
				$otherCurrRate2 ="EUR<br> <strong>".$otherCurrRate[0]["eurAmt"]."</strong>";
			}
			else{
				$otherCurrRate1 ="USD<br> <strong>".$otherCurrRate[0]["usdAmt"]."</strong>";
				$otherCurrRate2 ="GBP<br> <strong>".$otherCurrRate[0]["gbpAmt"]."</strong>";
			}
			$val = array("success" => "yes","othercurr1"=>$otherCurrRate1,"othercurr2"=>$otherCurrRate2);				
			
		}
		else{
			
			$val = array("success" => "no","message"=>'');
		}
		
		$output = json_encode($val);
		echo $output;
	}
	public function withdrawRequest(){
		$withdrawData = array();
		$withdrawData["paymentToUserId"] 		= trim($this->session->userdata('userId'));		
		//$withdrawData["paymentFromUserId"] 	= '';
		$withdrawData["paymentAmt"] 			= trim($_POST["withdrawAmt"]);
		//$withdrawData["paymentCurrency"] 		= '1';
		$withdrawData["paymentFor"] 			= 'Withdrawal';
		$withdrawData["fromWebsite"] 			= '';
		$withdrawData["transactionType"]		= 2; // 1-commision, 2- Withdraw, 3- Loan
		//$withdrawData["remark"]				= '';
		//$withdrawData["status"] 				= '';
		$currentAccDetail						= $this->current_account_model->insertCurrentAccountDetail($withdrawData);
		if($currentAccDetail>0){
			
			// next process mail to admin
			$requestUserDetail = $this->current_account_model->getPayingUserDetail($this->session->userdata('userId'));
			$viewData = array();
			$viewData['firstName'] 			= $requestUserDetail[0]['firstName'];
			$viewData['lastName'] 			= $requestUserDetail[0]['lastName'];
			$viewData['emailID']			= $requestUserDetail[0]['emailID'];
			$viewData['paypalAC'] 			= $requestUserDetail[0]['paypalAC'];
			$viewData['withdrawalAmt'] 		= $withdrawData["paymentAmt"];
			
			$this->sendEmailToAdmin($viewData, 'Withdrawal Request');
			// get withdrawal detail
			$withDrawalTable = $this->current_account_model->getWithdrawalLoanRequest($this->session->userdata('userId'),$withdrawData["transactionType"]);
			//print_r($withDrawalTable); exit;
			$withDrawalTableData = $withDrawalTable[0]['paymentAmt'];
			$tableRow ="<tr>
                        <th>Withdrawal Date</th>
                        <th>Amount ($)</th>
                        <th>Balance</th>
                        <th>Remarks</th>
                      </tr>";
			foreach($withDrawalTable as $withDrawalTableValue){
				if($withDrawalTableValue['status']==0){
					$status ="Pending";
					$balance =$withDrawalTableValue['commAmt']-$withDrawalTableValue['paymentAmt'];
				}
				else if($withDrawalTableValue['status']==1){
					$status ="In process";
					$balance =$withDrawalTableValue['commAmt']-$withDrawalTableValue['paymentAmt'];
				}
				else if($withDrawalTableValue['status']==2){
					$status ="Rejected";
					$balance =$withDrawalTableValue['commAmt'];
				}
				else{
					$status ="Approved";
					$balance =$withDrawalTableValue['commAmt'];
				}
				$tableRow .="<tr>
                        <td>".$withDrawalTableValue['createdDate']."</td>
                        <td>".$withDrawalTableValue['paymentAmt']."</td>
                        <td>".$balance."</td>
                        <td>".$status."</td>
                      </tr>";
			}
			$tableRow .='<tr class="total_val">
                        <td >Total Value</td>
                        <td >'.$withDrawalTableValue['paymentAmt'].'</td>
                        <td colspan="2">&nbsp;</td>
                      </tr>';
			// show message in view page
			$val = array("success" => "yes","withDrawalTable"=>$tableRow);				
			
		}
		else{
			
			$val = array("success" => "no","message"=>'');
		}
		
		$output = json_encode($val); 
		echo $output;
		
	}
	
	public function loanRequest(){
		
		$loanData = array();
		$loanData["paymentToUserId"] 	= '1052';		
		$loanData["paymentFromUserId"] 	= '';
		$loanData["paymentAmt"] 		= '20';
		$loanData["paymentCurrency"] 	= '1';
		$loanData["paymentFor"] 		= '';
		$loanData["fromWebsite"] 		= '';
		$loanData["transactionType"]	= 3; // 1-commision, 2- Withdraw, 3- Loan
		$loanData["remark"]				= 'hjh khkhk hkjhkj khkjhk kjhkjh ';
		$loanData["status"] 			= '';
		$currentAccDetail				= $this->current_account_model->insertCurrentAccountDetail($loanData);
		if($currentAccDetail>0){
			// next process mail to admin
			// show message in view page
		}
	}
	public function addCommision(){
		//echo "11"; 
		$commData = array();
		$commData["userId"] 			= '1000';		
		$commData["paymentFromUserId"] 	= '1052';
		$commData["paymentGrossAmt"] 	= '49.99';
		$commData["paymentAmt"] 		= '19.99';
		$commData["paymentCurrency"] 	= 2;
		$commData["paymentFor"] 		= 'L1 Catalogue';
		$commData["fromWebsite"] 		= '';
		$commData["paymentId"] 			= '';
		$commData["transactionType"]	= ''; // 1-commision, 2- Withdraw, 3- Loan
		$commData["remark"]				='';
		$commData["status"] 			= 1;
		$commData["myCurrency"]			= 1;
		
		$userDetail = addCommisionToAccount($commData);
		if($userDetail){
			echo "Commission added successfully";
		}
		//print_r($userDetail);		echo "Success".$userDetail;
	}
	 private function sendEmailToAdmin($data = array(), $sub = "Withdrawal Request") {
                
        $this->_to_email = $this->_admin_email;
		$this->_from_name = $data['firstName']." ".$data['lastName'];
		$this->_from_email = $data['emailID'];
        $this->_subject = $sub;
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Admin,</td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr><td colspan="2">Here is a new withdrawal request details as below.</td></tr>
								<tr><td width="25%">Name:</td><td width="75%">' . $data['firstName'] . '</td></tr>
                                <tr><td width="25%">Surname:</td><td width="75%">' . $data['lastName'] . '</td></tr>
								<tr><td width="25%">Paypal Account:</td><td width="75%">' . $data['paypalAC'] . '</td></tr>
								<tr><td width="25%">Amount:</td><td width="75%">' . $data['withdrawalAmt'] . '</td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr><td>&nbsp;</td></tr>
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">globalblackenterprises.com</td></tr>
                           </table>';
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
    }

    function send_mail_raw() {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
		//$headers .= 'Cc:senabi.gbe@gmail.com' . "\r\n";
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
	// notification  send 
	public function notificationSend(){
		
		$notTitle 		= trim($_POST["notTitle"]);
		$notMessage 	= trim($_POST["notMessage"]);
		
		if($notTitle!="" && $notMessage!=""){
			$data = array();
			
			$data['notBy']			=	$this->session->userdata('userId');
			$data['notTitle']		=	$notTitle;
			$data['message']		=	$notMessage;
			$data['msg_date']		=	date('Y-m-d');
			$addAction = $this->current_account_model->addNotification($data);
			if($addAction){
				
				$msg = "Notification send successfully";			
				
				$val = array('success'=>"yes", 'msg'=> $msg);	
			}	
			else{
			
				$val = array("success" => "no","msg"=>'');
			}	
			
		}
		
		
		$output = json_encode($val);
		echo $output;
	}
	
	// notification read status change
	public function notificationRead(){
		$notId 		= trim($_POST["notId"]);
		if($notId!=""){
			$data = array();
			
			$data['notId']			=	$notId;
			$data['viewStatus']		=	1;
			$readAction = $this->current_account_model->updateNotification($data);
			if($readAction){					
				
				$val = array('success'=>"yes", 'msg'=>'');	
			}	
			else{
			
				$val = array("success" => "no","msg"=>'');
			}	
			
		}
		
		
		$output = json_encode($val);
		echo $output;
	}
	
	// topup section 
	
	public function topUp(){	
		        
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
		$viewData = array();
		$viewData["userInfo"] 		= 	$this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
		$viewData["accountInfo"]	=	$this->current_account_model->getAccountDetail($this->session->userdata('userId'));
		$viewData["myCurrency"]	="";
		$viewData["currSymbol"]	="";
		if($viewData["accountInfo"][0]['myCurrency']==1){
			$viewData["myCurrency"] =  "USD";
			$viewData["currSymbol"]		=	"$";
		}
		else if($viewData["accountInfo"][0]['myCurrency']==2){
			$viewData["myCurrency"] =  "GBP";
			$viewData["currSymbol"]		=	"£";
		} 
		else{
			$viewData["myCurrency"] =  "EUR";
			$viewData["currSymbol"]		=	"€";
			}
		$viewData["accessPermission"]	= $viewData["userInfo"][0]['status'];
		$viewData["balance"]		=	$viewData["accountInfo"][0]['commAmt'];		
		$viewData['topupAmt'] = array(10,25,40,50,100,200,250,500,1000,2500);		
		
		$this->load->view('currentaccount/topup', $viewData);	 
	}
	
	// Popup Detail  
	public function showPopUpDetail(){
		
		$transactionId 		= 	trim($_POST["transactionId"]);
		$transactionType 	= 	trim($_POST["transactionType"]);
		$userid				=	trim($this->session->userdata('userId'));
		if($transactionId!="" && $transactionType!=""){
			$tblTitle 		= '';
			$tblHeader 		= '';
			$tblData  		= '';
			if($transactionType=="TopUp"){
			
				$popUpData = $this->current_account_model->getTopUpDetail($userid,$transactionId);
				
				//print_r($popUpData);exit;
				$tblTitle		= '<h4>My TopUp Details</h4>';
				$tblHeader		='<table width="100%" cellspacing="0" cellpadding="0" border="0">
									  <tbody>
										<tr>
										  <th>Transaction Id</th>
										  <th>TopUp Date </th>
										  <th>Amount Selected </th>
										  <th>Amount Before</th>
										  <th>Amount After</th>
										  <th>Status</th>
										</tr>';
			}
			else if($transactionType=="SwitchOn"){
				
				$popUpData = $this->current_account_model->getTopUpDetailChildUser($transactionId);
				
				$tblTitle		= '<h4>Child User Payment Details</h4>';
				$tblHeader		='<table width="100%" cellspacing="0" cellpadding="0" border="0">
									  <tbody>
										<tr>
										  <th>Transaction Id</th>
										  <th>User Name</th>
											<th>User Level</th>										  
										  <th>Renewal Payment</th>
										  <th>Payment Date</th>
										  <th>My commission</th>
										</tr>';
			}
			
			if(count($popUpData)>0){
				$tblData .= $tblTitle;
				$tblData .= $tblHeader;
				
				foreach($popUpData as $popUpdetail){
						if($popUpdetail['myCurrency']==1){
							$currSymbol = '$';
						}
						else if($popUpdetail['myCurrency']==1){
							$currSymbol = '£';
						}
						else{
							$currSymbol = '€';
						}
						if($transactionType=="TopUp"){
							
							$beforeAmt	=	$popUpdetail['commAmt']-$popUpdetail['gross_total'];
							$tblData .= "<tr><td>".$popUpdetail['transaction_Id']."</td>
							<td>".$popUpdetail['topUpDate']."</td>
							<td>".$currSymbol." ".$popUpdetail['gross_total']."</td>
							<td>".$currSymbol." ".$beforeAmt."</td>
							<td>".$currSymbol." ".$popUpdetail['commAmt']."</td>
							<td>".$popUpdetail['status']."</td></tr>";	
						}						
						else if($transactionType=="SwitchOn"){
							$tblData .= "<tr><td>".$popUpdetail['transaction_Id']."</td>
							<td>".$popUpdetail['firstName']." ".$popUpdetail['lastName']."</td>
							<td>".$popUpdetail['userLevel']."</td>
							<td>".$currSymbol." ".$popUpdetail['gross_total']."</td>
							<td>".$popUpdetail['createdDate']."</td>
							<td>".$currSymbol." ".$popUpdetail['parent_commossion']."</td>
							";
						}
				}
				$tblData .= '</tbody></table>';
				$val = array('success'=>"yes", 'tblData'=> $tblData);	
			}	
			else{
			
				$val = array("success" => "no","tblData"=>'');
			}	
			
		}
		
		
		$output = json_encode($val);
		echo $output;
	}
}