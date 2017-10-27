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
		$this->load->helper('common');
        $this->load->model('current_account_model');
		$this->load->model('gatewaymodel');
    }
   	
	public function addCurrentAccount(){
		//echo "11"; 
		$userDetail = createCurrentAccount('1214');
		//print_r($userDetail);		echo "Success".$userDetail;
	}
	public function myAccount(){		
		$viewData = array();		
		$viewData["balance"]	=	0;			
		$viewData["liability"]	=	0;	
		$viewData["userInfo"] 		= 	$this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
		//print_r($viewData["userInfo"]);
		//echo "=========".$viewData["userInfo"][0]['currency'];
		$viewData["myCurrency"]	="";
		$viewData["currSymbol"]	="";
		if($viewData["userInfo"][0]['currency']==1){
			$viewData["myCurrency"] =  "USD";
			$viewData["currSymbol"]		=	"$";
		}
		else if($viewData["userInfo"][0]['currency']==2){
			$viewData["myCurrency"] =  "GBP";
			$viewData["currSymbol"]		=	"£";
		} 
		else{
			$viewData["myCurrency"] =  "EUR";
			$viewData["currSymbol"]		=	"€";
			}	

		$msgTypeDetails = $this->setMessage();  
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
		$this->load->view('currentaccount/myaccount', $viewData);	
		
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
		
	}
	
	public function loanRequest(){
		
	}
}