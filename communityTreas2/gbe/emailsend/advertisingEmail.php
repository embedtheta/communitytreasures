<?php
require_once "Mail.php";
 
////////////////////////////////
$senderEmail = $_REQUEST["senderEmail"]; 
$senderMsg   = $_REQUEST["senderMsg"];
///////////////////////////////

$from    = $senderEmail;
$to      = "Rave Business <info@ravebusiness.com>";
//$to      = "shatanikg@evikasystems.co.in";
$subject = "Advertising Request";
$body    = '<html><body>'.$senderMsg.'</body></html>';
 
$host     = "mail.ravebusiness.com";
$username = "info@ravebusiness.com";
$password = "PintuShatanikNaren1969";
 
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
 // header('Location: http://ravebusiness.com/index.php?msg='.$msg);
 header("Location:http://www.ravestorysociety.com/ravestorysociety/freetrial/?action=Advertising");	
}
?>

