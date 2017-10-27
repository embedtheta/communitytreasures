<?
	require_once( "cryptobox.class.php" );
	
	/**** CONFIGURATION VARIABLES ****/ 
	
	$userID 		= "-place_your_users_id-";	// place your registered userID or md5(userID) here (user1, user7, ko43DC, etc).
												// your user should have already registered on your website before   
	$userFormat		= "COOKIE";					// this variable ignored when you use $userID 
	$orderID 		= "premium_membership";		// premium membership order 
	$amountUSD		= 79;						// price per membership - 79 USD
	$period			= "1 MONTH";				// one month membership; after need to pay again
	$def_language	= "en";						// default Payment Box Language
	$def_payment	= "bitcoin";				// default Coin in Payment Box

	// List of coins that you accept for payments
	// For example, for accept payments in bitcoins, dogecoins use - $available_payments = array('bitcoin', 'dogecoin'); 
	$available_payments = array('bitcoin', 'litecoin', 'paycoin', 'dogecoin', 'dash', 'speedcoin', 'reddcoin', 'potcoin', 
						'feathercoin', 'vertcoin', 'vericoin', 'peercoin', 'monetaryunit');
	
	
	// Goto  https://gourl.io/info/memberarea/My_Account.html
	// You need to create record for each your coin and get private/public keys
	// Place Public/Private keys for all your available coins from $available_payments
	
	$all_keys = array(	
		"bitcoin"  => array("public_key" => "-your public key for Bitcoin box-",  "private_key" => "-private key for Bitcoin box-"),
		"dogecoin" => array("public_key" => "-your public key for Dogecoin box-", "private_key" => "-private key for Dogecoin box-")
		// etc.
	); 
			
	/********************************/


	// Re-test - that all keys for $available_payments added in $all_keys 
	if (!in_array($def_payment, $available_payments)) $available_payments[] = $def_payment;  
	foreach($available_payments as $v)
	{
		if (!isset($all_keys[$v]["public_key"]) || !isset($all_keys[$v]["private_key"])) 
			die("Please add your public/private keys for '$v' in \$all_keys variable");
		elseif (!strpos($all_keys[$v]["public_key"], "PUB"))  die("Invalid public key for '$v' in \$all_keys variable");
		elseif (!strpos($all_keys[$v]["private_key"], "PRV")) die("Invalid private key for '$v' in \$all_keys variable");
		elseif (strpos(CRYPTOBOX_PRIVATE_KEYS, $all_keys[$v]["private_key"]) === false) 
			die("Please add your private key for '$v' in variable \$cryptobox_private_keys, file cryptobox.config.php.");
	}
	
	// Optional - Language selection list for payment box (html code)
	$languages_list = display_language_box($def_language);
	
	// Optional - Coin selection list (html code)
	$coins_list = display_currency_box($available_payments, $def_payment, $def_language, 70, "margin: 5px 0 0 20px");
	$coinName = CRYPTOBOX_SELCOIN; // current selected coin by user
	
	// Current Coin public/private keys
	$public_key  = $all_keys[$coinName]["public_key"];
	$private_key = $all_keys[$coinName]["private_key"];
	
	
	/** PAYMENT BOX **/
	$options = array(
			"public_key"  => $public_key, 	// your public key from gourl.io
			"private_key" => $private_key, 	// your private key from gourl.io
			"webdev_key"  => "", 			// optional, gourl affiliate key
			"orderID"     => $orderID, 		// order id
			"userID"      => $userID, 		// unique identifier for every user
			"userFormat"  => $userFormat, 	// save userID in COOKIE, IPADDRESS or SESSION
			"amount"   	  => 0,				// price in coins OR in USD below
			"amountUSD"   => $amountUSD,	// we use price in USD
			"period"      => $period, 		// payment valid period
			"language"	  => $def_language  // text on EN - english, FR - french, etc
	);

	// Initialise Payment Class
	$box = new Cryptobox ($options);
	
	// coin name
	$coinName = $box->coin_name(); 
	
	
	// Successful Cryptocoin Payment received
	if ($box->is_paid())
	{
		// one time action
		if (!$box->is_processed())
		{
			// One time action after payment has been made
					
			$message = "Thank you (order #".$orderID.", payment #".$box->payment_id()."). We upgraded your membership to Premium";
	
			// Set Payment Status to Processed
			$box->set_status_processed();
		}
		else $message = "You have a Premium Membership";
	}
	
	
	// ...
	// Also you can use IPN function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "") 
	// for send confirmation email, update database, update user membership, etc.
	// You need to modify file - cryptobox.newpayment.php, read more - https://gourl.io/api-php.html#ipn
	// ...

 	
?>

<!DOCTYPE html>
<html><head>
<title>Pay-Per-Membership Cryptocoin (payments in multiple cryptocurrencies) Payment Example</title>
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='Expires' content='-1'>
<script src='cryptobox.min.js' type='text/javascript'></script>
</head>
<body style='font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666;margin:0'>
<div align='center'>
<br><h2>Example - Upgrade to a Premium Member Account</h2>
<br>

<?php if ($box->is_paid()): ?>

	<!-- User already paid premium membership -->
	<!-- You can use this function - $box->is_paid() on all other your premium webpages, 
			it will return true during all user paid period (1 month) --> 
	<!-- Your Premium Pages Code Here -->

	<br><br><br>
	<?= $message ?>
	<br><br><br>
	
<? else: ?>

	 <!-- Awaiting Payment -->
	<img alt='Awaiting Payment - Cryptocoin Pay Per Membership' border='0' src='https://gourl.io/images/example10.png'>
	<br><br><br>	
	<h3>Upgrade Your Membership Now ( $<?= $amountUSD ?> per <?= $period ?> ) - </h3>
	
<? endif; ?> 	

	<br><br>
	<? if (!$box->is_paid()) echo $coins_list;  ?>
	<div style='font-size:12px;margin:50px 0 5px 370px'>Language: &#160; <?= $languages_list ?></div>
	<?= $box->display_cryptobox(true, 530, 230, "padding:3px 6px;margin:10px;border:10px solid #f7f5f2;") ?>

	
</div><br><br><br><br><br><br>
</body>
</html>