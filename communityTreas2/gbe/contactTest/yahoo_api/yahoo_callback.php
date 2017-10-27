<?php
session_start();

require_once('globals.php');
require_once('oauth_helper.php'); 
// Fill in the next 3 variables. 
$request_token           =   $_SESSION['request_token'];
$request_token_secret   =   $_SESSION['request_token_secret'];
$oauth_verifier        =   $_GET['oauth_verifier']; 
  // Get the access token using HTTP GET and HMAC-SHA1 signature 
  $retarr = get_access_token_yahoo(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, $request_token, $request_token_secret, $oauth_verifier, false, true, true); 
  /*echo "OAUTH_CONSUMER_KEY--".OAUTH_CONSUMER_KEY."<br/>";
  echo "OAUTH_CONSUMER_SECRET--".OAUTH_CONSUMER_SECRET."<br/>";
  echo "request_token--".$request_token."<br/>";
  echo "request_token_secret--".$request_token_secret."<br/>";
  //echo "".."<br/>";
  echo "oauth_verifier--".$oauth_verifier."<br/>";*/
  print_r($retarrs);
  if (! empty($retarr)) { 
  list($info, $headers, $body, $body_parsed) = $retarr;
  if ($info['http_code'] == 200 && !empty($body)) { 
  //   print "Use oauth_token as the token for all of your API calls:\n" . 
  //      rfc3986_decode($body_parsed['oauth_token']) . "\n"; 
  // Fill in the next 3 variables. 
  $guid    =  $body_parsed['xoauth_yahoo_guid'];
   $access_token  = rfc3986_decode($body_parsed['oauth_token']) ;
    $access_token_secret  = $body_parsed['oauth_token_secret']; 
	// Call Contact API 
	$retarrs = callcontact_yahoo(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, $guid, $access_token, $access_token_secret, false, true);
	// echo "<pre/>";
	// print_r($retarrs);
	 
	 /*foreach($retarrs as $key=>$values){
		 
		 
		 foreach($values->contact as $keys=>$values_sub){
			// echo '<pre/>';
			// print_r($values_sub);
			 //echo $values_sub->fields[1]->value->givenName;
			 if(is_object($values_sub->fields[0]->value))
			 	$email = "";
			 else
			 	$email = $values_sub->fields[0]->value;
			$full_name  = $values_sub->fields[1]->value->givenName;
			if(trim($email)!="")
			$newList   .= "<div>".$full_name."------------".$email."</div>";
			
		 }
	 }*/
	 $arr = json_encode($retarrs);
	 print_r($arr);
/*echo "<script type='text/javascript'>window.location.href ='http://www.ravestorysociety.com/ravestorysociety/freetrial/?action=yahooContactImport&contactList=".$arr."';</script>";*/
}}

?> 