<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class current_account_model extends CI_Model{
    private $aTab = "my_current_account";    
    public function __construct(){
        parent::__construct();
        
    }
    
    public function getAccountDetail($userId = 0){
        $this->db->select('*');
        $this->db->from($this->aTab);
        $this->db->where($this->aTab.'.userId',$userId);
        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo $query->num_rows();
        return $query->result_array();
    }
    
	public function curl_get_contents($url)
	{
	
		$url = str_replace( "&amp;", "&", urldecode(trim($url)) );
	    $cookie = tempnam ("/tmp", "CURLCOOKIE");
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0); 
		curl_setopt( $ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);    # required for https urls
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
		$data = curl_exec( $ch );
		$response = curl_getinfo( $ch );
		curl_close ( $ch ); 
	  
	  return $data;
	}
	// currency conversion API 
	public function convertCurrency1($amount, $from, $to){
		
		$url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
		//echo "====1111111====".$url;
		$data = $this->curl_get_contents(trim($url));	
		//print_r($data);
		preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
		$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
		//echo "====222222====".$converted;
		return round($converted, 3);
	}
   function convertCurrency($from, $to){
	$url = "http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency=$from&ToCurrency=$to";
            $xml = simpleXML_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA);
            if($xml ===  FALSE)
            {
               //deal with error
            }
            else { 

              $rate = $xml;
			  return $rate;//round($rate, 3);
            }
	}
	// insert data to current account
	function insertCurrentAccount($data=array()){
		if(!empty($data)){
			if(trim($data['userId'])!=""){
				$this->db->set($this->aTab.'.userId',trim($data['userId']));
			}
			if(trim($data['commAmt'])!=""){
				$this->db->set($this->aTab.'.commAmt',trim($data['commAmt']));
			}			
			if(trim($data['myCurrency'])!=""){
				$this->db->set($this->aTab.'.myCurrency',trim($data['myCurrency']));
			}							
            
			$this->db->insert($this->aTab);
			$id = $this->db->insert_id();			
			return $id;
		}else{
			return false;
		}
	}
	// update current account table
	 function updateCurrentAccount($data=array()){
		 if(!empty($data)){
			if(trim($data['commAmt'])!=""){
				
				if($data['commAddSub']=="ADD"){					
					$setCondition = "SET my_current_account.commAmt = commAmt + ". trim($data['commAmt']);					
				}
				else if($data['commAddSub']=="SUB"){					
					$setCondition = "SET my_current_account.commAmt = commAmt - ". trim($data['commAmt']);
				}				
				
			}			
			
			
			$sql = "UPDATE  my_current_account	
							 ". $setCondition."
							WHERE my_current_account.userId = ".$data['userId'];
			
			$query = $this->db->query($sql);			
			//echo $this->db->last_query();
			if($rs){
				return true;
			}else{
				return false;
			}
		 }
	 }
	// insert data to current account detail table
	function insertCurrentAccountDetail($data=array()){
		if(!empty($data)){
			if(trim($data['paymentToUserId'])!=""){
				$this->db->set('my_current_account_details.paymentToUserId',trim($data['paymentToUserId']));
			}
			if(trim($data['paymentFromUserId'])!=""){
				$this->db->set('my_current_account_details.paymentFromUserId',trim($data['paymentFromUserId']));
			}
			if(trim($data['paymentGrossAmt'])!=""){
				$this->db->set('my_current_account_details.paymentGrossAmt',trim($data['paymentGrossAmt']));
			}
			if(trim($data['paymentAmt'])!=""){
				$this->db->set('my_current_account_details.paymentAmt',trim($data['paymentAmt']));
			}							
            if(trim($data['paymentCurrency'])!=""){
				$this->db->set('my_current_account_details.paymentCurrency',trim($data['paymentCurrency']));
			}
			if(trim($data['paymentFor'])!=""){
				$this->db->set('my_current_account_details.paymentFor',trim($data['paymentFor']));
			}
			if(trim($data['fromWebsite'])!=""){
				$this->db->set('my_current_account_details.fromWebsite',trim($data['fromWebsite']));
			}
			if(trim($data['paymentId'])!=""){
				$this->db->set('my_current_account_details.paymentId',trim($data['paymentId']));
			}
			if(trim($data['transactionType'])!=""){
				$this->db->set('my_current_account_details.transactionType',trim($data['transactionType']));
			}
			if(trim($data['remark'])!=""){
				$this->db->set('my_current_account_details.remark',trim($data['remark']));
			}
			if(trim($data['status'])!=""){
				$this->db->set('my_current_account_details.status',trim($data['status']));
			}
			
			$this->db->insert('my_current_account_details');
			$id = $this->db->insert_id();			
			return $id;
		}else{
			return false;
		}
	}
	// update currency conversion table
	 function updateCurrencyValue($data=array()){
		 if(!empty($data)){
			if(trim($data['gbpAmt'])!=""){
				$this->db->set('currency_conversion.gbpAmt',trim($data['gbpAmt']));
			}
			if(trim($data['eurAmt'])!=""){
				$this->db->set('currency_conversion.eurAmt',trim($data['eurAmt']));
			}						
			if(trim($data['usdAmt'])!=""){				
				$this->db->set('currency_conversion.usdAmt',trim($data['usdAmt']));			
			}	
			$this->db->where('id', trim($data['currId']));
		    $rs=$this->db->update('currency_conversion');
			if($rs){
				return true;
			}else{
				return false;
			}
		 }
	 }
	 
	 // get Paying user only
	  public function getPayingUserDetail($userId = 0){
        $this->db->select('*');
        $this->db->from('userinfo');
        $this->db->where('userinfo.uID',$userId);
		//$this->db->where('userinfo.userType',"PAYING USER");
        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo $query->num_rows();
        return $query->result_array();
    }
	
	
	public function getOtherCurrencyRate($selCurId=0){
		
		$this->db->select('*');
        $this->db->from('currency_conversion');
		if($selCurId>0){
			 $this->db->where('currency_conversion.id',$selCurId);		
		}
       
        $query = $this->db->get();
        //echo $this->db->last_query();    
        return $query->result_array();
	}
		
	// get currency by country id 
	public function getCurrencyByCountry($countryId){
		
		$this->db->select('country.counCurrenry');
        $this->db->from('country');
        $this->db->where('country.country_id',$countryId);		
        $query = $this->db->get();
        //echo $this->db->last_query();    
        $countryArr = $query->result_array();
		return $countryArr[0]["counCurrenry"];
	}
	// get commission detail 
	public function getCommissionDetail($userId){
		$sql = "SELECT
					MCAD.paymentAmt,
					MCAD.paymentGrossAmt,
					DATE_FORMAT(MCAD.createdDate,'%d %b %Y') AS createdDate,
					MCAD.paymentFor,
					UINFO.firstName,
					UINFO.lastName,
					UINFO.userLevel
					FROM my_current_account_details MCAD
					LEFT JOIN userinfo UINFO
					ON UINFO.uID = MCAD.paymentFromUserId
					WHERE MCAD.paymentToUserId =".$userId."
					 ORDER BY MCAD.createdDate DESC
					";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	// get product Commission 
	public function getProductCommissionDetail($userId){
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
	// my withdrawals 
	 public function getMyWithdrawals($userId = 0){
        $sql = "SELECT
				IF(SUM(paymentAmt)!=0,SUM(paymentAmt),0) as withdrawalTotal
				FROM my_current_account_details
				WHERE transactionType=2
				AND status=3
				AND paymentToUserId=".$userId;
		$query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo $query->num_rows();
        $resData	=	$query->result_array();
		return $resData[0]['withdrawalTotal'];
    }
	
	public function getWithdrawalLoanRequest($userId=0,$transactionType){
		
		$whereCon = "";
		if($userId>0){
			$whereCon = "AND MCAD.paymentToUserId =".$userId;
		}
		
		$sql = "SELECT
					MCAD.id,
					MCAD.paymentAmt,
					MCAD.paymentGrossAmt,
					DATE_FORMAT(MCAD.createdDate,'%d-%m-%Y') AS createdDate,
					MCAD.paymentFor,
					MCAD.status,
					UINFO.uID,
					UINFO.firstName,
					UINFO.lastName,
					UINFO.userLevel,
					UINFO.currency,
					MCA.commAmt
					FROM my_current_account_details MCAD
					LEFT JOIN userinfo UINFO
					ON UINFO.uID = MCAD.paymentToUserId
					LEFT JOIN my_current_account MCA
					ON MCA.userId = MCAD.paymentToUserId
					WHERE MCAD.transactionType=".$transactionType."
					".$whereCon."
					 ORDER BY MCAD.createdDate DESC
					";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		return $query->result_array();
	}
	
	// update current_account_details table
	function updateCurrentAccountDetail($data=array()){
		 if(!empty($data)){
			if(trim($data['status'])!=""){
				$this->db->set('my_current_account_details.status',trim($data['status']));
			}
			if(trim($data['approveDate'])!=""){				
				$this->db->set('my_current_account_details.approveDate',trim($data['approveDate']));			
			}	
			//$this->db->where('my_current_account_details.paymentToUserId', trim($data['userId']));
			$this->db->where('my_current_account_details.id', trim($data['tblId']));
		    $rs=$this->db->update('my_current_account_details');
			if($rs){
				return true;
			}else{
				return false;
			}
		 }
	 }
	 
	 // get week, months Payment detail
	 function getWeekMonthCalculation($userId){
		 
		 if($userId>0){
			 $whereCon = " AND paymentToUserId =".$userId;
		 }
		 
		 $sql ="SELECT
					SUM(IF(WEEKOFYEAR(createdDate) = WEEKOFYEAR(NOW()),paymentAmt,0)) AS this_week,
					SUM(IF(WEEKOFYEAR(createdDate) = (WEEKOFYEAR(NOW())-1),paymentAmt,0)) AS prev_week,
					SUM(IF(MONTH(createdDate) = MONTH(NOW()) ,paymentAmt,0)) AS this_month,
					SUM(IF(DATEDIFF(CURDATE(),createdDate) <= 180,paymentAmt,0)) AS last_six_month
					FROM my_current_account_details
					WHERE transactionType = 1
					".$whereCon."
					GROUP BY paymentToUserId";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		return $query->result_array();
	 }
	 //  Notification 
	 function addNotification($data=array()){
		 if(!empty($data)){
			if(trim($data['userType'])!=""){
				$this->db->set('notification.userType',trim($data['userType']));
			}
			if(trim($data['userLevel'])!=""){
				$this->db->set('notification.userLevel',trim($data['userLevel']));
			}
			if(trim($data['notTitle'])!=""){
				$this->db->set('notification.notTitle',trim($data['notTitle']));
			}
			if(trim($data['message'])!=""){
				$this->db->set('notification.message',trim($data['message']));
			}
			if(trim($data['msg_date'])!=""){
				$this->db->set('notification.msg_date',trim($data['msg_date']));
			} 
			if(trim($data['notBy'])!=""){
				$this->db->set('notification.notBy',trim($data['notBy']));
			}
			$this->db->insert('notification');
			$id = $this->db->insert_id();			
			return $id;
		}else{
			return false;
		}
	 }
	 
	 function getNotification($userType,$userLevel){
		 $this->db->select('*');
         $this->db->from('notification');
		 if($userType>0){
			 $this->db->where('notification.userType',$userType);	
		 }
		 if($userLevel>0){
			 $this->db->where('notification.userLevel',$userLevel);	
		 }
		 $this->db->where('notification.notBy',0);
		 $this->db->order_by("notification.id DESC");
         $query = $this->db->get();
         //echo $this->db->last_query();    
         return $query->result_array();
	 }
	 function getUnreadNotification($userType,$userLevel){
		 $this->db->select('count(*) as unReadCount');
         $this->db->from('notification');
		 if($userType>0){
			 $this->db->where('notification.userType',$userType);	
		 }
		 if($userLevel>0){
			 $this->db->where('notification.userLevel',$userLevel);	
		 }
		 $this->db->where('notification.notBy',0);
		 $this->db->where('notification.viewStatus',0);
		 $this->db->order_by("notification.id DESC");
         $query = $this->db->get();
         //echo $this->db->last_query(); 
         $resData	=	$query->result_array();
		 return $resData[0]['unReadCount'];
	 }
	 
	 function updateNotification($data=array()){
		 if(!empty($data)){
			if(trim($data['viewStatus'])!=""){
				$this->db->set('notification.viewStatus',trim($data['viewStatus']));
			}							
			$this->db->where('notification.id', trim($data['notId']));
		    $rs=$this->db->update('notification');
			if($rs){
				return true;
			}else{
				return false;
			}
		 }
	 }
	 // amount transfer
	 // insert data to current account
	function insertAmountTransfer($data=array()){
		if(!empty($data)){
			if(trim($data['accTblId'])!=""){
				$this->db->set('amount_transfer.accTblId',trim($data['accTblId']));
			}
			if(trim($data['userId'])!=""){
				$this->db->set('amount_transfer.userId',trim($data['userId']));
			}			
			if(trim($data['transferAmt'])!=""){
				$this->db->set('amount_transfer.transferAmt',trim($data['transferAmt']));
			}
			if(trim($data['cycle_date']!="")){
				$this->db->set('amount_transfer.cycle_date',trim($data['cycle_date']));
			}			
            
			$this->db->insert('amount_transfer');
			$id = $this->db->insert_id();			
			return $id;
		}else{
			return false;
		}
	}
	
	function getAmtTransferData(){
		$sql = "SELECT  *
					FROM amount_transfer
					WHERE cycle_date = CURDATE()";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	// get userType
	function getUserType($userid){
		$sql = "select UGTN.user_general_type_name  
						from user_general_type UGTN 
						LEFT JOIN userinfo UINFO
						ON UGTN.user_id=UINFO.uID  
						WHERE UGTN.user_id=".$userid;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	// get user City Id
	function getUserCityId(){
		$sql = "select uId,city 
						FROM userinfo 
						WHERE city !='' AND currency IS NULL 
						AND uID NOT IN(select GROUP_CONCAT(userId) from my_current_account)";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	//get TOPUP detail added by SB on 11/09/2015
	function getTopUpDetail($userid){
		$sql = "select gp.id,DATE_FORMAT(gp.responseEnvelope_timestamp,'%d %b %Y') AS topUpDate,gp.status,FORMAT(gp.gross_total, 2) as gross_total,gp.transaction_Id,mca.commAmt 
						FROM gbe_payment gp
						LEFT JOIN my_current_account mca
						ON gp.user_id =mca.userId
						WHERE gp.payment_for=4 
						AND gp.status='COMPLETED'
						AND gp.user_id=".$userid.
						" ORDER BY gp.id DESC
					";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}