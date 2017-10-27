<?php
/**
 *  ... Please MODIFY this file ... 
 *
 *
 *  YOUR MYSQL DATABASE DETAILS
 *
 */

 define("DB_HOST", 	"localhost");				// hostname
 define("DB_USER", 	"ravebusi_democt");		// database username
 define("DB_PASSWORD", 	"Server12#");		// database password
 define("DB_NAME", 	"ravebusi_livect");	// database name



/**
 *  ARRAY OF ALL YOUR CRYPTOBOX PRIVATE KEYS
 *  Place values from your gourl.io signup page
 *  array("your_privatekey_for_box1", "your_privatekey_for_box2 (otional), etc...");
 */
 
$cryptobox_private_keys = array('7590AA8whelBitcoin77BTCPRVuAFIgLUTeYRzbwJz2MzP4Rpa','7534AA9iqPzSpeedcoin77SPDPRVzP7SpVHvUvS7M0qvosCjgq'); // for bitcoin
//$cryptobox_private_keys = array('SdMNcBaJryMVsuFmz9MTNNxJpPqrZDrBxs');  // for speedcoin



 define("CRYPTOBOX_PRIVATE_KEYS", implode("^", $cryptobox_private_keys));
 unset($cryptobox_private_keys); 

?>