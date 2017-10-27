<?php

require_once( "cryptobox.class.php" );

	$options = array( 
		"public_key"  => "7514AAt3gBdBitcoin77BTCPUBRVHHcQvP8kaRkiDaCkdUcgS2",         // place your public key from gourl.io
		"private_key" => "7514AAt3gBdBitcoin77BTCPRVjfvWm6StA333MLj5k1RJ39gi",         // place your private key from gourl.io
		"webdev_key"  => "", 		// optional, gourl affiliate program key
		"orderID"     => "product1", // few your users can have the same orderID but combination 'orderID'+'userID' should be unique
		"userID"      => "", 		// optional; place your registered user id here (user1, user2, etc)
				// for example, on premium page you can use for all visitors: orderID="premium" and userID="" (empty) 
				// when userID value is empty - system will autogenerate unique identifier for every user and save it in cookies 
		"userFormat"  => "COOKIE",   // save your user identifier userID in cookies. Available: COOKIE, SESSION, IPADDRESS, MANUAL
		"amount"   	  => 0,			// amount in cryptocurrency or in USD below
		"amountUSD"   => 2,			// price is 2 USD; it will convert to cryptocoins amount, using Live Exchange Rates
									// For convert fiat currencies Euro/GBP/etc. to USD, use function convert_currency_live()
		"period"      => "24 HOUR",  // payment valid period, after 1 day user need to pay again
		"iframeID"    => "",         // optional; when iframeID value is empty - system will autogenerate iframe html payment box id
		"language"	  => "EN"		// text on EN - english, FR - french, please contact us and we can add your language
		);  
	echo "22222222222222<pre>";
	print_r($options);
	echo "</pre>";
	echo "hi"; exit;

	?>