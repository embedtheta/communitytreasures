<?php

//-------------------------------------------------
// When you integrate this code,
// look for TODO as an indication
// that you may need to provide a value or take 
// action before executing this code.
//-------------------------------------------------

require_once ("paypalplatform.php");


// ==================================
// PayPal Platform Parallel Payment Module
// ==================================

// Request specific required fields
$actionType = "PAY";
$cancelUrl = "http://www.globalblackenterprises.com/dashboard"; // TODO - If you are not executing the Pay call 
                                    // for a preapproval, then you must set a valid 
                                    // cancelUrl for the web approval flow that 
                                    // immediately follows this Pay call
$returnUrl = "http://www.globalblackenterprises.com/dashboard?returnFrom=PaypalSwitchOn"; // TODO - If you are not executing the Pay call 
                                    // for a preapproval, then you must set a valid 
                                    // returnUrl for the web approval flow that 
                                    // immediately follows this Pay call
$currencyCode = "USD";

// A parallel payment can be made among two to six receivers
// TODO - Specify the receiver emails
//        Remove or set to an empty string the array entries for receivers that you 
//        do not have

if($_REQUEST["parentPaypalID"] == "paytestevika-facilitator@gmail.com"){

	$receiverEmailArray = array(
	  'paytestevika-facilitator@gmail.com'
	);
	
	// TODO - Specify the receiver amounts as the amount of money, for example, '5' or '5.55'
	//        Remove or set to an empty string the array entries for receivers that you 
	//        do not have
	$receiverAmountArray = array(
	  '49.99'
	 );
}else if( $_REQUEST["parentPaypalID"] !="" ){
	   $receiverEmailArray = array(
	   'paytestevika-facilitator@gmail.com',
	   $_REQUEST["parentPaypalID"]
	   );
	
	// TODO - Specify the receiver amounts as the amount of money, for example, '5' or '5.55'
	//        Remove or set to an empty string the array entries for receivers that you 
	//        do not have
	$receiverAmountArray = array(
	  '19.99',
	  '30.00'
	);
}else{
	echo "<strong>Your Parent don't have Paypal Account Yet</strong><br/>";
} 
// For parallel payment, no primary indicators are needed, so set empty array.
$receiverPrimaryArray = array();

// TODO - Set invoiceId to uniquely identify the transaction associated with 
//        each receiver
//        Set the array entries with value for receivers that you have
//        Each of the array values must be unique
$receiverInvoiceIdArray = array(
  '',
  '',
  '',
  '',
  '',
  ''
  );

// Request specific optional fields
//   Provide a value for each field that you want to include in the request;
//   if left as an empty string, the field will not be passed in the request
 //$senderEmail = "paypersonalevika@gmail.com";
 $senderEmail = ""; 
                    // TODO - If you are executing the Pay call against a 
                   // preapprovalKey, you should set senderEmail
                   // It is not required if the web approval flow immediately 
                   // follows this Pay call
$feesPayer = "";
$ipnNotificationUrl = "http://www.globalblackenterprises.com/dashboard/getSwitchOnPaypalRespose?uid=".$_REQUEST["uid"];
$memo = ""; // maxlength is 1000 characters
$pin = ""; // TODO - If you are executing the Pay call against an existing 
           // preapproval that requires a pin, then you must set this
$preapprovalKey = ""; // TODO - If you are executing the Pay call against 
                      // an existing preapproval, set the preapprovalKey here
$reverseAllParallelPaymentsOnError = ""; // TODO - Set this to "true" if you would 
                                         // like each parallel payment to be reversed 
                                         // if an error occurs
                                         // Defaults to "false" if you don't specify
$trackingId = generateTrackingID(); // generateTrackingID function is found 
                                    // in paypalplatform.php


//-------------------------------------------------
// Make the Pay API call
//
// The CallPay function is defined in the paypalplatform.php file,
// which is included at the top of this file.
//-------------------------------------------------
$resArray = CallPay ($actionType, $cancelUrl, $returnUrl, $currencyCode, 
      $receiverEmailArray, $receiverAmountArray, $receiverPrimaryArray, 
      $receiverInvoiceIdArray, $feesPayer, $ipnNotificationUrl, $memo, 
      $pin, $preapprovalKey, $reverseAllParallelPaymentsOnError, 
      $senderEmail, $trackingId
);

$ack = strtoupper($resArray["responseEnvelope.ack"]);
if($ack=="SUCCESS")
{
  
 if ("" == $preapprovalKey)
 {
  // redirect for web approval flow
  $cmd = "cmd=_ap-payment&paykey=" . urldecode($resArray["payKey"]);
  RedirectToPayPal ( $cmd );
 }
 else
 {
  // payKey is the key that you can use to identify the result from this Pay call
  $payKey = urldecode($resArray["payKey"]);
  // paymentExecStatus is the status of the payment
  $paymentExecStatus = urldecode($resArray["paymentExecStatus"]);
 }
} 
else  
{
 //Display a user-friendly Error on the page using any of the following error 
 //information returned by PayPal.
 //TODO - There can be more than 1 error, so check for "error(1).errorId", 
 //       then "error(2).errorId", and so on until you find no more errors.
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


?>
