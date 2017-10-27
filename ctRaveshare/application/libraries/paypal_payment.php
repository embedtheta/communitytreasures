<?php 
class Paypal_payment {
	private $environment;
	private $apiUsername;
	private $apiPassword;
	private $apiSignature;
	private $apiAppID ;
 	private $apiEndpoint = "";
	private $actionType;
	private $cancelUrl;
	private $returnUrl;
	private $currencyCode;
	private $receiverEmailArray;
	private $receiverAmountArray;
	private $receiverPrimaryArray;
	private $receiverInvoiceIdArray;
	private $feesPayer;
	private $ipnNotificationUrl;
	private $memo;
	private $pin;
	private $preapprovalKey;
	private $reverseAllParallelPaymentsOnError;
	private $senderEmail;
	private $trackingId; 
	
	public function __construct(){
		$this->environment = "sandbox";
		// $this->apiUsername = "senabi.test01-facilitator_api1.hotmail.com";//"testmail.senabi_api1.aol.in";//paytestevika-facilitator_api1.gmail.com/*senabi.test01-facilitator_api1.hotmail.com*/
		//$this->apiPassword = "1393482471";//"1394448405";//8TSCVDFPRT75ABPA/*1393482471*/
		//$this->apiSignature = "AQgAtWGQKCu8D8uoMWh6kIKl2UtRAT.lRzJlKWrHMAl2Nzkspr8a4Vfv";//"AiPC9BjkCyDFQXbSkoZcgqH3hpacAC6KU7EwztwvzMTDCvuLGd1DxbS8";//An5ns1Kso7MWUdW4ErQKJJJ4qi4-AebnlDL85.vgeYPkcGtTEgSiviJT/*AQgAtWGQKCu8D8uoMWh6kIKl2UtRAT.lRzJlKWrHMAl2Nzkspr8a4Vfv*/
		//$this->apiAppID = "APP-80W284485P519543T"; 
		$this->apiUsername = "testmail.senabi_api1.aol.in";
		$this->apiPassword = "1394448405";
		$this->apiSignature = "AiPC9BjkCyDFQXbSkoZcgqH3hpacAC6KU7EwztwvzMTDCvuLGd1DxbS8";
		$this->apiAppID = "APP-80W284485P519543T";
		$this->_setApiEndPoint();
	}
	
	private function _setApiEndPoint(){
		if($this->environment == "sandbox"){
			$this->apiEndpoint = "https://svcs.sandbox.paypal.com/AdaptivePayments";
		}else{
			$this->apiEndpoint = "https://svcs.paypal.com/AdaptivePayments";
		}
	}
	
	public function generateCharacter () {
		$possible = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
		return $char;
	}

	public function generateTrackingID () {
		$GUID = $this->generateCharacter().$this->generateCharacter().$this->generateCharacter();
		$GUID .= $this->generateCharacter().$this->generateCharacter().$this->generateCharacter();
		$GUID .= $this->generateCharacter().$this->generateCharacter().$this->generateCharacter();
		return $GUID;
	}
	
	public function setActionType($val = ''){
		$this->actionType = trim($val);
		return true;
	}
	
	public function setCancelUrl($val = ''){
		$this->cancelUrl = trim($val);
		return true;
	}
	
	public function setReturnUrl($val = ''){
		$this->returnUrl = trim($val);
		return true;
	}
	
	public function setCurrencyCode($val = ''){
		$this->currencyCode = trim($val);
		return true;
	}
	
	public function setReceiverEmailArray($val = array()){
		$this->receiverEmailArray = $val;
		return true;
	}
	
	public function setReceiverAmountArray($val = array()){
		$this->receiverAmountArray = $val;
		return true;
	}
	
	public function setReceiverPrimaryArray($val = array()){
		$this->receiverPrimaryArray = $val;
		return true;
	}
	
	public function setReceiverInvoiceIdArray($val = array()){
		$this->receiverInvoiceIdArray = $val;
		return true;
	}
	
	public function setFeesPayer($val = ''){
		$this->feesPayer = $val;
		return true;
	}
	
	public function setIpnNotificationUrl($val = ''){
		$this->ipnNotificationUrl = $val;
		return true;
	}
	
	public function setMemo($val = ''){
		$this->memo = $val;
		return true;
	}
	
	public function setPin($val = ''){
		$this->pin = $val;
		return true;
	}
	
	public function setPreapprovalKey($val = ''){
		$this->preapprovalKey = $val;
		return true;
	}
	
	public function setReverseAllParallelPaymentsOnError($val = ''){
		$this->reverseAllParallelPaymentsOnError = $val;
		return true;
	}
	
	public function setSenderEmail($val = ''){
		$this->senderEmail = $val;
		return true;
	}
	
	public function setTrackingId(){
		$this->trackingId = $this->generateTrackingID();
		return true;
	}
	
	
	
	
	
	
	
	/*
	'------------------------------------------------------------------------------------
	' Purpose: 	Prepares the parameters for the Pay API Call.
	' Inputs:
	'
	' Required:
	'
	' Optional:
	'
	' Returns: 
	'  The NVP Collection object of the Pay call response.
	'------------------------------------------------------------------------------------
	*/
	public function callPay(){
		/* Gather the information to make the Pay call.
		The variable nvpstr holds the name-value pairs.
		*/
		
		// required fields
		$nvpstr = "actionType=" . urlencode($this->actionType) . "&currencyCode=";  
		$nvpstr .= urlencode($this->currencyCode) . "&returnUrl=";
		$nvpstr .= urlencode($this->returnUrl) . "&cancelUrl=" . urlencode($this->cancelUrl);
		
		if (0 != count($this->receiverAmountArray)){
			reset($this->receiverAmountArray);
			while (list($key, $value) = each($this->receiverAmountArray)){
				if ("" != $value){
					$nvpstr .= "&receiverList.receiver(" . $key . ").amount=" . urlencode($value);
				}
			}
		}
		
		if (0 != count($this->receiverEmailArray)){
			reset($this->receiverEmailArray);
			while (list($key, $value) = each($this->receiverEmailArray)){
				if ("" != $value){
					$nvpstr .= "&receiverList.receiver(" . $key . ").email=" . urlencode($value);
				}
			}
		}
		
		if (0 != count($this->receiverPrimaryArray)){
			reset($this->receiverPrimaryArray);
			while (list($key, $value) = each($this->receiverPrimaryArray)){
				if ("" != $value){
					$nvpstr = $nvpstr . "&receiverList.receiver(" . $key . ").primary=" . urlencode($value);
				}
			}
		}
		
		if (0 != count($this->receiverInvoiceIdArray)){
			reset($this->receiverInvoiceIdArray);
			while (list($key, $value) = each($this->receiverInvoiceIdArray)){
				if ("" != $value){
					$nvpstr = $nvpstr . "&receiverList.receiver(" . $key . ").invoiceId=" . urlencode($value);
				}
			}
		}
		
		// optional fields
		if ("" != $this->feesPayer){
			$nvpstr .= "&feesPayer=" . urlencode($this->feesPayer);
		}
		
		if ("" != $this->ipnNotificationUrl){
			$nvpstr .= "&ipnNotificationUrl=" . urlencode($this->ipnNotificationUrl);
		}
		
		if ("" != $this->memo){
			$nvpstr .= "&memo=" . urlencode($this->memo);
		}
		
		if ("" != $this->pin){
			$nvpstr .= "&pin=" . urlencode($this->pin);
		}
		
		if ("" != $this->preapprovalKey){
			$nvpstr .= "&preapprovalKey=" . urlencode($this->preapprovalKey);
		}
		
		if ("" != $this->reverseAllParallelPaymentsOnError){
			$nvpstr .= "&reverseAllParallelPaymentsOnError=";
			$nvpstr .= urlencode($this->reverseAllParallelPaymentsOnError);
		}
		
		if ("" != $this->senderEmail){
			$nvpstr .= "&senderEmail=" . urlencode($senderEmail);
		}
		
		if ("" != $this->trackingId){
			$nvpstr .= "&trackingId=" . urlencode($this->trackingId);
		}
		//end optional section
		/* Make the Pay call to PayPal */
		//$resArray = $this->_hashCall("Pay", $nvpstr);
		$resArray = $this->_hashCall("Pay", $nvpstr);
		/* Return the response array */
		//print_r($resArray);echo $nvpstr."===";exit;
		return $resArray;
	}
 
 
 
 
	/**
	'----------------------------------------------------------------------------------
	* hash_call: Function to perform the API call to PayPal using API signature
	* @methodName is name of API method.
	* @nvpStr is nvp string.
	* returns an associative array containing the response from the server.
	'----------------------------------------------------------------------------------
	*/
	private function _hashCall($methodName, $nvpStr){  //declaring of global variables
		//global $API_Endpoint, $API_UserName, $API_Password, $API_Signature, $API_AppID;
		//global $USE_PROXY, $PROXY_HOST, $PROXY_PORT;
		
		$this->apiEndpoint .= "/" . $methodName;
		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$this->apiEndpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		// Set the HTTP Headers
		curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
		'X-PAYPAL-REQUEST-DATA-FORMAT: NV',
		'X-PAYPAL-RESPONSE-DATA-FORMAT: NV',
		'X-PAYPAL-SECURITY-USERID: ' .$this->apiUsername,
		'X-PAYPAL-SECURITY-PASSWORD: ' .$this->apiPassword,
		'X-PAYPAL-SECURITY-SIGNATURE: ' . $this->apiSignature,
		'X-PAYPAL-SERVICE-VERSION: 1.3.0',
		'X-PAYPAL-APPLICATION-ID: ' .$this->apiAppID
		));
		
		//if USE_PROXY constant set to TRUE in Constants.php, 
		//then only proxy will be enabled.
		//Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
		//if($USE_PROXY)
		//curl_setopt ($ch, CURLOPT_PROXY, $PROXY_HOST. ":" . $PROXY_PORT); 
		
		// RequestEnvelope fields
		$detailLevel = urlencode("ReturnAll"); // See DetailLevelCode in the WSDL 
									 // for valid enumerations
		$errorLanguage = urlencode("en_US");  // This should be the standard RFC 
									// 3066 language identification tag, 
									// e.g., en_US
		// NVPRequest for submitting to server
		$nvpreq = "requestEnvelope.errorLanguage=$errorLanguage&requestEnvelope";
		$nvpreq .= "detailLevel=$detailLevel&$nvpStr";
		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
		//getting response from server
		 $response = curl_exec($ch);
		//print_r($response);exit;//30/09/2015 ujjwal sana
		//converting NVPResponse to an Associative Array
		$nvpResArray = $this->_deformatNVP($response);
		
		$nvpReqArray = $this->_deformatNVP($nvpreq);
		//$_SESSION['nvpReqArray']=$nvpReqArray;
		
		if (curl_errno($ch)) {
			// moving to display page to display curl errors
			//$_SESSION['curl_error_no']=curl_errno($ch) ;
			//$_SESSION['curl_error_msg']=curl_error($ch);
			//Execute the Error handling module to display errors. 
		} else {
			//closing the curl
			curl_close($ch);
		}
		
		return $nvpResArray;
	}
	
	/*'----------------------------------------------------------------------------
	Purpose: Redirects to PayPal.com site.
	Inputs:  $cmd is the querystring
	Returns: 
	-------------------------------------------------------------------------------
	*/
	function redirectToPayPal ( $cmd ){
	// Redirect to paypal.com here
		$payPalURL = "";
		if($this->environment == "sandbox"){
			$payPalURL = "https://www.sandbox.paypal.com/webscr?" . $cmd;
		}else{
			$payPalURL = "https://www.paypal.com/webscr?" . $cmd;
		}
		header("Location: ".$payPalURL);
	}


	/*'----------------------------------------------------------------------------
	* This function will take NVPString and convert it to an Associative Array 
	* and then will decode the response.
	* It is useful to search for a particular key and display arrays.
	* @nvpstr is NVPString.
	* @nvpArray is Associative Array.
	----------------------------------------------------------------------------
	*/
	private function _deformatNVP($nvpstr){
  		$intial=0;
  		$nvpArray = array();

  		while(strlen($nvpstr)){
		   //postion of Key
		   $keypos= strpos($nvpstr,'=');
		   //position of value
		   $valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

		   /*getting the Key and Value values and storing in a Associative Array*/
		   $keyval=substr($nvpstr,$intial,$keypos);
		   $valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
		   //decoding the respose
		   $nvpArray[urldecode($keyval)] =urldecode( $valval);
		   $nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
      	}
  		return $nvpArray;
 	}
	
	
 
}

//$bj = new Paypal_payment();
//print_r($bj);



?>