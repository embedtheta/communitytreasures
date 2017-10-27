<?php

require_once "Mail.php";
 
////////////////////////////////
$fname             =   trim($_REQUEST["name"]);
$email             =   trim($_REQUEST["email"]);
$refId             =   base64_encode($_REQUEST["parentID"]);
$encode_email      =   base64_encode($email);
///////////////////////////////

$from              = "Global Black Enterprises <info@globalblackenterprises.com>";
$to                = $email;
$subject = "Sign up confirmation mail";
$body    = '<html><body><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">You are getting one free Trial from Global Black Enterprises </td></tr>
                                <tr><td width="25%">Your Name:</td><td width="75%">'.$fname.'</td></tr>
                                <tr><td>Your Email:</td><td>'.$email.'</td></tr>
                                <tr><td colspan="2">If you want more chapters or Ebook,Music,Tickets.</td></tr>
                                <tr><td colspan="2">Register yourself as member in Global Black Enterprises .</td></tr>
                                <tr><td colspan="2"><a href="http://www.globalblackenterprises.com/gateway/signup/'.$_REQUEST["parentID"].'" target="_blank">Join Now</a></td></tr></table></body></html>';

$host     = "mail.globalblackenterprises.com";
$username = "info@globalblackenterprises.com";
$password = "AngelAngel";

$headers = array ('From' => $from,
  'To' => $to,
  'Content-Type' => "text/html",
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
    'auth' => true,
    'username' => $username,
    'password' => $password));
 
$mail = $smtp->send($to, $headers, $body);
 
if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
} else {
  //echo("<p>Message successfully sent!</p>");
  $msg="success";
  header('Location:http://www.globalblackenterprises.com/?msg='.$msg);	
}
?>

