<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class withdrawal_model extends CI_Model{
      
    public function __construct(){
        parent::__construct();
        
    }
    
   
    
	
	// get amount transfer user match with Cycle date 10th & 25th 
	public function getWithdrawalRequestInprocess(){
		$sql = "SELECT at.*,ui.firstName,ui.lastName,ui.emailID,ui.currency,ui.paypalAC 
					FROM amount_transfer at 
					LEFT JOIN userinfo ui 
					ON at.userId=ui.uID
					WHERE at.cycle_date = CURDATE()
					AND at.status=0
					";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	// update amount_tranfer table status
	function updateAmtTransferStatus($accTablId){
		if( $accTablId !="" ){
			$sql = "UPDATE amount_transfer 
								SET 
								status=1
								WHERE accTblId=".$accTablId;
			$rs = $this->db->query($sql);
			if($rs){
				return true;
			}else{
				return false;	
			}
		}
	}
	// update my_current_account_details table withdrawal status
	function updateWithdrawalStatus($accTablId){
		if( $accTablId !="" ){
			$sql = "UPDATE my_current_account_details 
								SET 
								status=3
								WHERE id=".$accTablId;
			$rs = $this->db->query($sql);
			if($rs){
				return true;
			}else{
				return false;	
			}
		}
	}
	// get product Commission 
	/* public function getProductCommissionDetail($userId){
		$sql = "SELECT
					MCAD.paymentAmt,
					MCAD.paymentGrossAmt,
					DATE_FORMAT(MCAD.createdDate,'%d %b %Y') AS createdDate,
					MCAD.paymentFor,
					AOD.productName			
					FROM my_current_account_details MCAD
					LEFT JOIN afro_order_detail AOD
					ON AOD.orderPaymentID = MCAD.paymentId
					WHERE MCAD.paymentFor = 'Product Purchase' 
					AND MCAD.paymentToUserId =".$userId."
					 ORDER BY MCAD.createdDate DESC
					";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	*/
	
	
	 
	
	 
	
	
}