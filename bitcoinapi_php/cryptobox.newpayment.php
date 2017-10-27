<?php

/**

 *  ... Please MODIFY this file ...

 *

 *

 *  User-defined function (IPN) for new payments

 *  ---------------------------------------------

 *

 *  User-defined function - cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "").

 *  Use this function to send confirmation email, update database, update user membership, etc.

 *  

 *  This IPN function will automatically appear for each new payment usually two times : 

 *  a) when a new payment is received, with values: $box_status = cryptobox_newrecord, $payment_details[confirmed] = 0

 *  b) and a second time when existing payment is confirmed (6+ confirmations) with values: $box_status = cryptobox_updated, $payment_details[confirmed] = 1.

 *  

 *  But sometimes if the payment notification is delayed for 20-30min, the payment/transaction will already be confirmed and the function will

 *  appear once with values: $box_status = cryptobox_newrecord, $payment_details[confirmed] = 1

 *  

 *  If payment received with correct amount, function receive: $payment_details[status] = 'payment_received' and $payment_details[user] = 11, 12, etc (user_id who has made payment)

 *  If incorrectly paid amount, the system can not recognize user; function receive: $payment_details[status] = 'payment_received_unrecognised' and $payment_details[user] = ''

 *

 *  Function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "")

 *  gets $paymentID from your table crypto_payments, $box_status = 'cryptobox_newrecord' OR 'cryptobox_updated' (description above)

 *  and payment details as array -

 * 

 *  1. EXAMPLE - CORRECT PAYMENT -

 *  -----------------------------------------------------

 *  $payment_details = Array

 *        {

 *            "status":"payment_received"

 *            "err":""

 *            "private_key":"1206lO6HX76cw9Bitcoin77DOGED82Y8eyBExZ9kZpX"

 *            "box":"120"

 *            "boxtype":"paymentbox"

 *            "order":"order15620A"

 *            "user":"user26"

 *            "usercountry":"USA"

 *            "amount":"0.0479166"

 *            "amountusd":"11.5"

 *            "coinlabel":"BTC"

 *            "coinname":"bitcoin"

 *            "addr":"14dt2cSbvwghDcETJDuvFGHe5bCsCPR9jW"

 *            "tx":"95ed924c215f2945e75acfb5650e28384deac382c9629cf0d3f31d0ec23db08d"

 *            "confirmed":0

 *            "timestamp":"1422624765 "

 *            "date":"30 January 2015"

 *            "datetime":"2015-01-30 13:32:45"

 *        }

 *         						

 *  2. EXAMPLE - INCORRECT PAYMENT/WRONG AMOUNT -

 *  -----------------------------------------------------

 *     $payment_details = Array 

 *        {

 *            "status":"payment_received_unrecognised"

 *            "err":"An incorrect bitcoin amount has been received"

 *            "private_key":"1206lO6HX76cw9Bitcoin77DOGED82Y8eyBExZ9kZpX"

 *            "box":"120"

 *            "boxtype":"paymentbox"

 *            "order":""

 *            "user":""

 *            "usercountry":""

 *            "amount":"12.26"

 *            "amountusd":"0.05"

 *            "coinlabel":"BTC"

 *            "coinname":"bitcoin"

 *            "addr":"14dt2cSbvwghDcETJDuvFGHe5bCsCPR9jW"

 *            "tx":"6f1c6f34189a27446d18e25b9c79db78be55b0bb775b1768b5aa4520f27d71a8"

 *            "confirmed":0

 *            "timestamp":"1422623712"

 *            "date":"30 January 2015"

 *            "datetime":"2015-01-30 13:15:12"

 *        }	 

 *        

 *        Read more - https://gourl.io/api-php.html#ipn

 */









function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "")

{



    

    /** .............

	.............



	PLACE YOUR CODE HERE



	Update database with new payment, send email to user, etc

	Please note, all received payments store in your table `crypto_payments` also

	See - https://gourl.io/api-php.html#payment_history

	.............

	.............

	For example, you have own table `user_orders`...

	You can use function run_sql() from cryptobox.class.php ( https://gourl.io/api-php.html#run_sql )

	

	.............

	// Save new Bitcoin payment in database table `user_orders`

	$recordExists = run_sql("select paymentID as nme FROM `user_orders` WHERE paymentID = ".intval($paymentID));

	if (!$recordExists) run_sql("INSERT INTO `user_orders` VALUES(".intval($paymentID).",'".$payment_details["user"]."','".$payment_details["order"]."',".floatval($payment_details["amount"]).",".floatval($payment_details["amountusd"]).",'".$payment_details["coinlabel"]."',".intval($payment_details["confirmed"]).",'".$payment_details["status"]."')");

	

	.............

	// Received second IPN notification (optional) - Bitcoin payment confirmed (6+ transaction confirmations)

	if ($recordExists && $box_status == "cryptobox_updated")  run_sql("UPDATE `user_orders` SET txconfirmed = ".intval($payment_details["confirmed"])." WHERE paymentID = ".intval($paymentID));

	.............

	.............



	// Onetime action when payment confirmed (6+ transaction confirmations)

	$processed = run_sql("select processed as nme FROM `crypto_payments` WHERE paymentID = ".intval($paymentID)." LIMIT 1");

	if (!$processed && $payment_details["confirmed"])

	{

		// ... Your code ...



		// ... and update status

		$sql = "UPDATE crypto_payments SET processed = 1, processedDate = '".gmdate("Y-m-d H:i:s")."' WHERE paymentID = ".intval($paymentID)." LIMIT 1";

		run_sql($sql);

	}



	.............

    

   

	Debug - new payment email notification for webmaster

	Uncomment lines below and make any test payment

	--------------------------------------------

	$email = "....your email address....";

	mail($email, "Payment - " . $paymentID . " - " . $box_status, " \n Payment ID: " . $paymentID . " \n\n Status: " . $box_status . " \n\n Details: " . print_r($payment_details, true));



     */



	$obj 		= run_sql("select * from crypto_payments where paymentID = ".$paymentID);

	$emailId		= ($obj) ? $obj->emailId : "subhendu.senabi@gmail.com";

	

    

   $mailContent = "TEST=>".$emailId;

   $email = "ctrev.senabi@gmail.com,".$emailId;



  // $email = "subhendu.senabi@gmail.com";
   //$email = "subhendu.senabi@gmail.com,otizfangel@gmail.com";



   /*$mailContent ='<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#5c5c5c; font-size:14px; line-height:18px; padding: 15px; border: 15px solid #cfcfcf;">

								<tr>

									<td>

									<table width="100%" border="0" cellspacing="0" cellpadding="0">

								  <tr>

									<td align="center" valign="top">

										<img src="http://communitytreasures.co/ctRaveshare/images/logo.png" width="150" height="150" alt="" />									

								   <h2 style="  color: #1b75bc; font-size: 25px; line-height: 26px;"> Welcome To Community Treasures</h2>

									

									</td>

								  </tr>

								  <tr>

									<td align="left" valign="top">

								   <p> Hi  '.$emailId.', </p>

								<p>   

								Thank you for your payment. We are currently processing you payment. You will receive a confirmation email within 2 hrs from now.</p>



								

									</td>

								  </tr>

								 

								 

								  <tr><td>

									  <table width="100%" border="0" cellspacing="0" cellpadding="0">';

                                           foreach($payment_details as $key=>$val){

                              $mailContent .='<tr><td width="25%">' . $key . ':</td><td width="75%">' . $val . '</td></tr>';

                                           }

										

										$mailContent .='

									  </table>

									</td></tr>

									

								</table>

								</td>

								  </tr>

								  <tr>

									<td>&nbsp;</td>

								  </tr>								  

								</table>';
*/


if(!$payment_details['confirmed']){

	//$mailContent = "Thank you for your payment. We are currently processing you payment. You will receive a confirmation email within 2 hrs from now.";
$amount = $payment_details['amount'].' '.$payment_details['coinlabel'];
	$mailContenthtml = "<p>We are currently processing your payment. </p>

<p><strong>You will receive a confirmation email within 1- 2 hrs from now.</strong></p>

<p>You have made a payment of ".$amount.".\n\n

Payment - Order</p>\n\n

<p>Processing Notice\n\n

Your payment could take upto 24 hrs\n\n

depending on which bitcoin provider you made your payment with.\n\n

Thank you for joining Community Treasures</p>";

/*$mailContent = "We are currently processing your payment. \n\n

You will receive a confirmation email within 1- 2 hrs from now.\n
You have made a payment of ".$amount.".\n
Payment - Order\n
Processing Notice\n
Your payment could take upto 24 hrs\n
depending on which bitcoin provider you made your payment with.\n
Thank you for joining Community Treasures";*/

	//mail($email, "Payment - " . $paymentID . " - " . $box_status, " \n " . $mailContent . " \n\n Payment ID: " . $paymentID . " \n\n Status: " . $box_status . " \n\n Details: " . print_r($payment_details, true));

	$subject = 'Welcome To Community Treasures ';

	//$subject = "Payment - " . $paymentID . " - " . $box_status;


	    $headers = 'MIME-Version: 1.0' . "\r\n";

		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


		$headers .= 'From: communitytreasures.co <noreply@communitytreasures.co>' . "\r\n";

		$headers .= 'Reply-To: communitytreasures.co <noreply@communitytreasures.co>' . "\r\n";

		$headers .= 'Return-Path: communitytreasures.co <noreply@communitytreasures.co>' . "\n";

		


	mail($email, $subject, $mailContenthtml, $headers);
	//mail($email, $subject, $mailContent);

}

	



    return true;

}



?>