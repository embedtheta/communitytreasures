<?php
$email = "bankjp2@gmail.com";
/*echo $mailContenthtml = "<p>We are currently processing your payment. </p>

<p><strong>You will receive a confirmation email within 1- 2 hrs from now.</strong></p>

<p>You have made a payment of 0.00017123 BTC.\n\n

Payment - Order</p>\n\n

<p>Processing Notice\n\n

Your payment could take upto 24 hrs\n\n

depending on which bitcoin provider you made your payment with.\n\n

Thank you for joining Community Treasures</p>";*/
//$amount = $payment_details['amount'].' '.$payment_details['coinlabel'];
$amount = '2 USD';
echo $mailContent = "We are currently processing your payment. \n\n

You will receive a confirmation email within 1- 2 hrs from now.\n\n
You have made a payment of ".$amount.".\n
Payment - Order\n
Processing Notice\n
Your payment could take upto 24 hrs\n\n
depending on which bitcoin provider you made your payment with.\n\n
Thank you for joining Community Treasures";

	//mail($email, "Payment - " . $paymentID . " - " . $box_status, " \n " . $mailContent . " \n\n Payment ID: " . $paymentID . " \n\n Status: " . $box_status . " \n\n Details: " . print_r($payment_details, true));

	$subject = 'Welcome To Community Treasures ';

	//$subject = "Payment - " . $paymentID . " - " . $box_status;


	    $headers = 'MIME-Version: 1.0' . "\r\n";

		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


		$headers .= 'From: communitytreasures.co <noreply@communitytreasures.co>' . "\r\n";

		$headers .= 'Reply-To: communitytreasures.co <noreply@communitytreasures.co>' . "\r\n";

		$headers .= 'Return-Path: communitytreasures.co <noreply@communitytreasures.co>' . "\n";

		


//	$m1 = mail($email, $subject, $mailContenthtml, $headers);
	$m2 =mail($email, $subject, $mailContent);
	/*if($m1){

		echo "<br>Mail 1 has been succ";
	}*/
	if($m2){

		echo "<br>Mail 2 has been succ";
	}
?>