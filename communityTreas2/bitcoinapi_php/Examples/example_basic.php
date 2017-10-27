<?php
/**
 * @category    Basic Example
 * @package     GoUrl Cryptocurrency Payment API 
 * copyright 	(c) 2014-2016 Delta Consultants
 * @crypto      Supported Cryptocoins -	Bitcoin, Litecoin, Paycoin, Dogecoin, Dash, Speedcoin, Reddcoin, Potcoin, Feathercoin, Vertcoin, Vericoin, Peercoin, MonetaryUnit
 * @website     https://gourl.io/api-php.html
 */ 
	require_once( "../cryptobox.class.php" );
/*
//speedcoin
"public_key"  => "7534AA9iqPzSpeedcoin77SPDPUBgSos9BgfhcUeaeEBak0nO2", 		// place your public key from gourl.io
	"private_key" => "7534AA9iqPzSpeedcoin77SPDPRVzP7SpVHvUvS7M0qvosCjgq", 		// place your private key from gourl.io


	// bitcoin
	 "public_key"  => "7514AAt3gBdBitcoin77BTCPUBRVHHcQvP8kaRkiDaCkdUcgS2", 		// place your public key from gourl.io
	"private_key" => "7514AAt3gBdBitcoin77BTCPRVjfvWm6StA333MLj5k1RJ39gi", 		// place your private key from gourl.io	

*/
	function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

	    $parentID = $_REQUEST["tempIframeParentID"];
	    $emailId = $_REQUEST["emailId"];
	    
        $parentID = base64_decode($parentID);
        $parentIDArray = explode("#", $parentID);
		//$referrerID = base64_encode($parentIDArray[0]."@@".$emailId);
		$referrerID = $parentIDArray[0]."@@".$emailId;
		//$referrerID = $parentIDArray[0];
		$userID = $parentIDArray[1];

	$options = array( 
    "public_key"  => "7514AAt3gBdBitcoin77BTCPUBRVHHcQvP8kaRkiDaCkdUcgS2", 		// place your public key from gourl.io
	"private_key" => "7514AAt3gBdBitcoin77BTCPRVjfvWm6StA333MLj5k1RJ39gi", 		// place your private key from gourl.io	
	"webdev_key" => "", 		// optional, gourl affiliate key
	"orderID"     => $referrerID, // few your users can have the same orderID but combination 'orderID'+'userID' should be unique. 
								// for example, on premium page you can use for all visitors: orderID="premium" and userID="" (empty).
	"userID" 	  => $userID, 		// optional; when userID value is empty - system will autogenerate unique identifier for every user and save it in cookies
	"userFormat"  => "COOKIE", 	// save your user identifier userID in cookies. Available values: COOKIE, SESSION, IPADDRESS, MANUAL 
	"amount" 	  => 0,			// amount in cryptocurrency or in USD below
	"amountUSD"   => 0.01,  		// price is 2 USD; it will convert to cryptocoins amount, using Live Exchange Rates
								// *** For convert Euro/GBP/etc. to USD/Bitcoin, use function convert_currency_live() with Google Finance
								// *** examples: convert_currency_live("EUR", "BTC", 22.37) - convert 22.37 Euro to Bitcoin
								// *** convert_currency_live("EUR", "USD", 22.37) - convert 22.37 Euro to USD
	"period"      => "24 HOUR",	// payment valid period, after 1 day user need to pay again
	"iframeID"    => "",    	// optional; when iframeID value is empty - system will autogenerate iframe html payment box id
	"language" 	  => "EN" 		// english, please contact us and we can add your language	
	);  
	// IMPORTANT: Please read description of options here - https://gourl.io/api-php.html#options  

	
	// Initialise Payment Class
	$box1 = new Cryptobox ($options);

	// Display Payment Box or successful payment result   
	$paymentbox = $box1->display_cryptobox();

	// Log
	$message = "";
	
	// A. Process Received Payment
	if ($box1->is_paid()) 
	{ 

		$message .= "<div style=\"color: #dc2209;font-family: arial;font-size: 17px; text-align: center;\">You have made a payment of ".$box1->amount_paid()." ".$box1->coin_label().".<br>Thank you for your payment. We are currently processing you payment. You will receive a confirmation email within 2 hrs from now.<div>";
		$message .= "A. User will see this message during 24 hours after payment has been made!";
		
		
		
		// Your code here to handle a successful cryptocoin payment/captcha verification
		// For example, give user 24 hour access to your member pages
	

	}  
	else {
		$message .= "<div style=\"color: #dc2209;font-family: arial;font-size: 17px; text-align: center;\">Thank you for your payment. We are currently processing you payment. You will receive a confirmation email within 2 hrs from now.<div>";
		$message .= "The payment has not been made yet";
	}

	
	// B. One-time Process Received Payment
	if ($box1->is_paid() && !$box1->is_processed()) 
	{
		$message .= "<br>B. User will see this message one time after payment has been made!";	
	
		// Your code here - for example, publish order number for user
		// ...

		// Also you can use $box1->is_confirmed() - return true if payment confirmed 
		// Average transaction confirmation time - 10-20min for 6 confirmations  
		
		// Set Payment Status to Processed
		$box1->set_status_processed(); 
		
		// Optional, cryptobox_reset() will delete cookies/sessions with userID and 
		// new cryptobox with new payment amount will be show after page reload.
		// Cryptobox will recognize user as a new one with new generated userID
		// $box1->cryptobox_reset(); 
	}
	
	
	
	

	// ...
	// Also you can use IPN function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "") 
	// for send confirmation email, update database, update user membership, etc.
	// You need to modify file - cryptobox.newpayment.php, read more - https://gourl.io/api-php.html#ipn
	// ...


	
?>

<!DOCTYPE html>
<html><head>
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='Expires' content='-1'>
<script src='../cryptobox.min.js' type='text/javascript'></script>
</head>
<body>

<?php 
/*echo curPageURL();
echo "<pre>";
print_r($_REQUEST);
print_r($parentIDArray);
echo "</pre>";*/
echo $paymentbox; ?>
<?php echo $message; ?>

</body>
</html>