<?	
	require_once( "cryptobox.class.php" );

	/**** CONFIGURATION VARIABLES ****/ 
	
	$userID 		= "";				// new user, it will autogenerate userID and save in cookies
	$userFormat		= "COOKIE";			// save userID in cookies (or you can use IPADDRESS, SESSION)
	$orderID 		= "signuppage";		// Registration Page   
	$amountUSD		= 1;				// price per registration - 1 USD
	$period			= "NOEXPIRY";		// one time payment for each new user, not expiry
	$def_language	= "en";				// default Payment Box Language
	$def_payment	= "bitcoin";		// default Coin in Payment Box

	// List of coins that you accept for payments
	// For example, for accept payments in bitcoins, dogecoins use - $available_payments = array('bitcoin', 'dogecoin'); 
	$available_payments = array('bitcoin');
	/*, 'litecoin', 'paycoin', 'dogecoin', 'dash', 'speedcoin', 'reddcoin', 'potcoin', 
						'feathercoin', 'vertcoin', 'vericoin', 'peercoin', 'monetaryunit'*/
	
	// Goto  https://gourl.io/info/memberarea/My_Account.html
	// You need to create record for each your coin and get private/public keys
	// Place Public/Private keys for all your available coins from $available_payments
	
	$all_keys = array(	
		"bitcoin"  => array("public_key" => "7514AAt3gBdBitcoin77BTCPUBRVHHcQvP8kaRkiDaCkdUcgS2",  
			"private_key" => "7514AAt3gBdBitcoin77BTCPRVjfvWm6StA333MLj5k1RJ39gi")
		
	); 
			
			/*$all_keys = array(	
		"bitcoin"  => array("public_key" => "7514AAt3gBdBitcoin77BTCPUBRVHHcQvP8kaRkiDaCkdUcgS2",  "private_key" => "7514AAt3gBdBitcoin77BTCPRVjfvWm6StA333MLj5k1RJ39gi"),
		"dogecoin" => array("public_key" => "-your public key for Dogecoin box-", "private_key" => "-private key for Dogecoin box-")
		// etc.
	); */
			
	/********************************/

	
	// Re-test - that all keys for $available_payments added in $all_keys 
	if (!in_array($def_payment, $available_payments)) $available_payments[] = $def_payment;  
	foreach($available_payments as $v)
	{
		if (!isset($all_keys[$v]["public_key"]) || !isset($all_keys[$v]["private_key"])) 
			die("Please add your public/private keys for222222222 '$v' in \$all_keys variable");
		elseif (!strpos($all_keys[$v]["public_key"], "PUB"))  die("Invalid public key for '$v' in \$all_keys variable");
		elseif (!strpos($all_keys[$v]["private_key"], "PRV")) die("Invalid private key for '$v' in \$all_keys variable");
		elseif (strpos(CRYPTOBOX_PRIVATE_KEYS, $all_keys[$v]["private_key"]) === false) 
			die("Please add your private key for '$v' in variable \$cryptobox_private_keys, file cryptobox.config.php.");
	}
	
	// Optional - Language selection list for payment box (html code)
	$languages_list = display_language_box($def_language);
	
	// Optional - Coin selection list (html code)
	$coins_list = display_currency_box($available_payments, $def_payment, $def_language, 42, "margin: 5px 0 0 20px");
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
	
	
	// Form Data
	// --------------------------
	$fname	 	= (isset($_POST["fname"])) ? $_POST["fname"] : "";
	$femail  	= (isset($_POST["femail"])) ? $_POST["femail"] : "";
	$fpassword  = (isset($_POST["fpassword"])) ? $_POST["fpassword"] : "";
	
	$error = "";
	$successful = false;
	
	if (isset($_POST) && isset($_POST["fname"]))
	{
		if (!$fname)    		$error .= "<li>Please enter Your Name</li>";
		if (!$femail)   		$error .= "<li>Please enter Your Email</li>";
		if (!$fpassword)   		$error .= "<li>Please enter Your Password</li>";
		if (!$box->is_paid()) 	$error .= "<li>".$coinName."s have not yet been received</li>";
		if ($error)				$error  = "<br><ul style='color:#eb4847'>$error</ul>";
		
		if ($box->is_paid() && !$error)
		{
			// Successful Cryptocoin Payment received

			// Your code here - 
			// save user data in db / register new user ...
			// ...
			// ...
					
			// Set Payment Status to Processed
			$successful = true;
			$box->set_status_processed();
			
			// Optional, cryptobox_reset() will delete cookies/sessions with userID and
			// new cryptobox with new payment amount will be show after page reload.
			// Cryptobox will recognize user as a new one with new generated userID
			$box->cryptobox_reset();
		}
	}
	

	// ...
	// Also you can use IPN function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "") 
	// for send confirmation email, update database, update user membership, etc.
	// You need to modify file - cryptobox.newpayment.php, read more - https://gourl.io/api-php.html#ipn
	// ...


	
?>

<!DOCTYPE html>
<html><head>
<title>Pay-Per-Registration Cryptocoin (payments in multiple cryptocurrencies) Payment Example</title>
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='Expires' content='-1'>
<script src='cryptobox.min.js' type='text/javascript'></script>
</head>
<body style='font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#666;margin:0'>
<div align='center'>
<br><h1>Example - Website Registration Form. Protection against spam!</h1>
<br><img alt='Cryptocoin Registration Form' border='0' src='https://gourl.io/images/example8.png'>
<a name='i'></a>

<?php if ($successful): ?>

	<div align='center' style='margin:40px;font-size:24px;color:#339e2e;font-weight:bold'>
		You have been successfully registered on our website!</div>
	
<? else: ?>

	<form name='form1' style='font-size:14px;color:#444' action="pay-per-registration-multi.php#i" method="post">
		<table cellspacing='20'>
			<tr><td colspan='2'><b>NEW USER</b><?= $error ?><input type='text' style='display: none'>
				<input type='password' style='display: none'></td></tr>
			<tr><td width='100'>Name: </td><td width='300'><input style='padding:6px;font-size:18px;' size='30' 
				type="text" name="fname" value="<?= $fname ?>"></td></tr>
			<tr><td>Email: </td><td><input style='padding:6px;font-size:18px;' size='40' type="text" 
				name="femail" value="<?= $femail ?>"></td></tr>
			<tr><td>Password: </td><td><input style='padding:6px;font-size:18px;' size='35' type="password" 
				name="fpassword" value="<?= $fpassword ?>"><br><br></td></tr>
		</table>
	</form>

	<div style='width:600px;padding-top:10px'>
			<div style='font-size:12px;<? if ($box->is_paid()) echo "margin:5px 0 5px 390px;"; 
				else echo "margin:5px 0 5px 390px; position:absolute;" ?>'>Language: &#160; <?= $languages_list ?></div>
			<? if (!$box->is_paid()) echo "<div align='left'>".$coins_list."</div>";  ?>
			<?= $box->display_cryptobox(true, 530, 230, "border-radius:15px;border:1px solid #eee;padding:3px 6px;margin:10px") ?>
	</div>
	
	<?php if (!$box->is_paid()): ?>
		<br>* You need to pay <?= $coinName ?>s (~<?= $amountUSD ?> US$) for register on our website<br>
	<? endif; ?>	
	
	<br><br>
	<button onclick='document.form1.submit()' style='padding:6px 20px;font-size:18px;'>Register</button>
	
<? endif; ?> 	

</div><br><br><br><br><br><br>
</body>
</html>