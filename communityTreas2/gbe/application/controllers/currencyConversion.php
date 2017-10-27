<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CurrencyConversion extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->load->helper('common');
        $this->load->model('current_account_model');
		$this->load->model('gatewaymodel');
    }
   
	public function convertValueToTable(){
		//echo  phpinfo();
		
		$usdCurr 	=	"USD";
		$gbpCurr 	=	"GBP";
		$eurCurr 	=	"EUR";
		$amount		=1;
		$upData = array();
				// 1 USD equal to GBP & EUR  for row 1
		$gbpValue	=	$this->current_account_model->convertCurrency1($amount, $usdCurr, $gbpCurr);
		$eurValue	=	$this->current_account_model->convertCurrency1($amount, $usdCurr, $eurCurr);		// 1 GBP equal to USD & EUR for row 2		
		$usdValue	=	$this->current_account_model->convertCurrency1($amount, $gbpCurr, $usdCurr);		
		$eurValue1	=	$this->current_account_model->convertCurrency1($amount, $gbpCurr, $eurCurr);				// 1 EUR equal to USD & GBP for row 3		
		$usdValue1	=	$this->current_account_model->convertCurrency1($amount, $eurCurr, $usdCurr);		
		$gbpValue1	=	$this->current_account_model->convertCurrency1($amount, $eurCurr, $gbpCurr);		
		//echo "--".$gbpValue."--".$eurValue."--".$usdValue."--".$usdValue1."--".$gbpValue1."---";
		//exit;
		if($gbpValue!="" && $eurValue!=""){			
			$upData["usdAmt"]   =	1;			
			$upData["gbpAmt"]	=	$gbpValue;			
			$upData["eurAmt"]	=	$eurValue;			
			$upData["currId"]	=	1;			
			$convert			=	$this->current_account_model->updateCurrencyValue($upData);			
			echo "===========1";			
			if($convert){				
				if($usdValue!="" && $eurValue1!=""){					
					//$upData = array();					
					$upData["gbpAmt"]	=	1;					
					$upData["usdAmt"]	=	$usdValue;					
					$upData["eurAmt"]	=	$eurValue1;					
					$upData["currId"]	=	2;					
					$convert1			=	$this->current_account_model->updateCurrencyValue($upData);					
					echo "===========2";					
					if($convert1){						
							if($usdValue1!="" && $gbpValue1!=""){							
								//$upData = array();							
								$upData["eurAmt"]	=	1;							
								$upData["usdAmt"]	=	$usdValue1;							
								$upData["gbpAmt"]	=	$gbpValue1;							
								$upData["currId"]	=	3;							
								$convert2			=	$this->current_account_model->updateCurrencyValue($upData);							
								echo "===========3";							
								if($convert2){								
									echo "Conversion Successful";							
								}else{								
									echo "Error in Conversion";							
									}						
							}					
					}				
				}		
			}					
		}  
	}  
	// automatic amount transfer to user 
	public function transferAmountToUser(){
		
		$transfer	=	$this->current_account_model->getAmtTransferData();
		foreach($transfer as $transferDetail){
			$upData = array();
			$upData['status'] = 3;
			$upData['approveDate'] = date('Y-m-d');
			$upData['tblId'] = $transferDetail['accTblId'];
			// update approved status
			$stChange	= $this->current_account_model->updateCurrentAccountDetail($upData);
			// deduct amount form account balance
			if($stChange){
				$upBal =array();
				$upBal['commAmt'] = $transferDetail['transferAmt'];
				$upBal['commAddSub'] = 'SUB';
				$upBal['userId'] = $transferDetail['userId'];
				$balanceUpdate = $this->current_account_model->updateCurrentAccount($upBal);
				if($balanceUpdate){
					// mail to User regarding transaction
				}
			}
		}
	}
	
	// function to add currency & create 0 bal account of user of previous created account
	
	public function addCurrCreateAcct(){
		
		$userDetail = $this->current_account_model->getUserCityId();// list of user not having current account & currency
		
		//print_r($userDetail);
		//exit;
		$i=1;
		foreach($userDetail as $userDetails){
			$currency='';
			// fetch Currency 
			$currency   = $this->gatewaymodel->getCurrency($userDetails['city']);
			// update user Currency
			if($currency!="")
			{
				//echo "<br>-----------".$currency."|--------------|".$userDetails['uID'];
				$upCurr 	= $this->gatewaymodel->updateUserCurrency($currency,$userDetails['uId']);
				if($upCurr>0){
					// Create 0 Balance account
					$insertData= array();
					$insertData['userId'] = $userDetails['uId'];
					$insertData['commAmt'] = '0.00';
					$insertData['myCurrency'] = $currency;
					$this->current_account_model->insertCurrentAccount($insertData);
					echo "<br>".$i." == ".$userDetails['uId']." =========== ".$currency;
				}
			
			}
			$i++;
		}
	}
		
	
}