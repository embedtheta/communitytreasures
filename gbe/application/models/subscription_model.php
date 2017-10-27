<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class subscription_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        
    }
   	
	
	
		
	function updateSubscriptionInfo($subcriptionData){
		
		if(!empty($subcriptionData)){
			if(trim($subcriptionData['subscriptionStatus'])!=""){
				$this->db->set('user_subscription_info.subscriptionStatus',trim($subcriptionData['subscriptionStatus']));
			}
			if(trim($subcriptionData['failureReason'])!=""){
				$this->db->set('user_subscription_info.failureReason',trim($subcriptionData['failureReason']));
			}			
			$this->db->where('user_subscription_info.id', trim($subcriptionData['id']));
		    $rs=$this->db->update('user_subscription_info');
			if($rs){
				return true;
			}else{
				return false;
			}
		 }
		
	}
	// get Subscription detail 
	public function getSubscriptionUser(){
		$sql = "SELECT * 
					FROM user_subscription_info 
					WHERE DATE_FORMAT(subscriptionEndDt,'%Y-%m-%d')=CURDATE()
					AND subscriptionStatus=0 ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	
	
	 
	
	 
	
	
}