<?php
require_once("MAILER/smtpservice.php");
require_once("connection.php");
class PayPal_IPN {

    function ipn($ipn_data) {
        define('SSL_P_URL', 'https://www.paypal.com/cgi-bin/webscr');
        define('SSL_SAND_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
        $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        if (!preg_match('/paypal\.com$/', $hostname)) {
            $ipn_status = 'Validation post isn\'t from PayPal';
            if ($ipn_data == true) {
                //You can send email as well
		/*$message = 'Dear ,<br /><br />Your Received a payment from Cogito Web Payment.<br /><br />'; 		
		$headers[] = 'From: Paypal Payment';
		mail("sreela.cogito@gmail.com","payment Details in USD",$message, implode("\r\n", $headers));		*/		
            }
            return false;
        }
        // parse the paypal URL
        $paypal_url = ($_REQUEST['test_ipn'] == 1) ? SSL_SAND_URL : SSL_P_URL;
        $url_parsed = parse_url($paypal_url);

        $post_string = '';
        foreach ($_REQUEST as $field => $value) {
            $post_string .= $field . '=' . urlencode(stripslashes($value)) . '&';
        }
        $post_string.="cmd=_notify-validate"; // append ipn command
        // get the correct paypal url to post request to
        $paypal_mode_status = $ipn_data; //get_option('im_sabdbox_mode');
        if ($paypal_mode_status == true)
            $fp = fsockopen('ssl://www.sandbox.paypal.com', "443", $err_num, $err_str, 60);
        else
            $fp = fsockopen('ssl://www.paypal.com', "443", $err_num, $err_str, 60);

        $ipn_response = '';

        if (!$fp) {
            // could not open the connection.  If loggin is on, the error message
            // will be in the log.
            $ipn_status = "fsockopen error no. $err_num: $err_str";
            if ($ipn_data == true) {
                echo 'fsockopen fail';
            }
            return false;
        } else {
            // Post the data back to paypal
            fputs($fp, "POST $url_parsed[path] HTTP/1.1\r\n");
            fputs($fp, "Host: $url_parsed[host]\r\n");
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: " . strlen($post_string) . "\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $post_string . "\r\n\r\n");

            // loop through the response from the server and append to variable
            while (!feof($fp)) {
                $ipn_response .= fgets($fp, 1024);
            }
            fclose($fp); // close connection
        }
        // Invalid IPN transaction.  Check the $ipn_status and log for details.
        if (!preg_match("/VERIFIED/s", $ipn_response)) {
            $ipn_status = 'IPN Validation Failed';

            if ($ipn_data == true) {
                echo 'Validation fail';
                print_r($_REQUEST);
            }
            return false;
        } else {
            $ipn_status = "IPN VERIFIED";
            if ($ipn_data == true) {
                echo 'SUCCESS';
            }

            return true;
        }
    }
	
	 function issetCheck($post, $key) {
        if (isset($post[$key])) {
            $return = $post[$key];
        } else {
            $return = '';
        }
        return $return;
    }
	
	//print_r($request); die;
    function ipn_response($request) {
		$post = $request;
        $item_name = $this->issetCheck($post, 'item_name');
		$item_number = $this->issetCheck($post, 'item_number');
        $amount = $this->issetCheck($post, 'mc_gross');
		$get_val				= explode("||", $item_number);
		$uID = "";
		$account_type = "";
		if(!empty($get_val[10])){
		$uID					= $get_val[10];
		}			
		if(!empty($get_val[11])){
		$account_type			= $get_val[11];
		}
		
		$uID =($uID =="")?0:$uID;
        $currency = $this->issetCheck($post, 'mc_currency');
        $payer_email = $this->issetCheck($post, 'payer_email');
        $first_name = $this->issetCheck($post, 'first_name');
        $last_name = $this->issetCheck($post, 'last_name');
        $country = $this->issetCheck($post, 'residence_country');
        $txn_id = $this->issetCheck($post, 'txn_id');
        $txn_type = $this->issetCheck($post, 'txn_type');
        $payment_status = $this->issetCheck($post, 'payment_status');
        $payment_type = $this->issetCheck($post, 'payment_type');
        $payer_id = $this->issetCheck($post, 'payer_id');
        $create_date = date('Y-m-d H:i:s');
        $payment_date = date('Y-m-d H:i:s');
		
		 
		 $message = 'Dear '.$first_name.',<br /><br />Your Received a payment from Cogito Web Payment.<br /><br /> 
		 Find the payment details below:<br /><br />
		 Name:  '.$first_name.'&nbsp;'.$last_name.'<br /><br />
		 USER ID:  '.$uID .'<br /><br />
		 Country: '. $country.'<br /><br />
		 Transaction Id: '. $txn_id.'<br /><br />
		 Amount: '. $amount.'<br /><br />
		 Reference Name: '. $item_name.'<br /><br />
		 Item No: '. $item_number.'<br /><br />
		 Payment Status: '. $payment_status.'<br /><br />
		 Payment Date: '. $payment_date.'<br /><br />

		 
		 <br /><br />Thanks,<br />Cogito Team';
		 //$message = implode('|',$post);
		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';

		// Additional headers
		$headers[] = 'From: Paypal Payment <'.$payer_email.'>';
		mail("sreela.cogito@gmail.com","payment Details in USD",$message, implode("\r\n", $headers));
		$payment_details = serialize($_POST);
		$create_date = date('Y-m-d h:i:s');
		mysql_query("INSERT INTO payment_transac(item_name,account_type,amount,payment_by,item_number,payment_details,created_on) VALUES ('$item_name','$account_type','$amount','$uID','$item_number','$payment_details','$create_date')");
		/*if($account_type == "BB")
		{
			mysql_query("INSERT INTO payment_transac(item_name,account_type,amount,payment_by,item_number,payment_details,created_on) VALUES ('$item_name','$account_type','$amount','$uID','$item_number','$payment_details','$create_date')");
		}
		else
		{
			
			mysql_query("INSERT INTO payment_transac(item_name,item_number,payment_details,created_on) VALUES ('$item_name','$item_number','$payment_details','$create_date')");
		}*/
        mysql_close($con);
		
				
        $ipn_data = true;
        if ($this->ipn($ipn_data)) {
            // if paypal sends a response code back let's handle it        
            if ($ipn_data == true) {
                //mail send
                $sub = 'PayPal IPN Message';
                //$msg = print_r($request, true);
				//$msg = print_r($message, true);
				$msg=$message;
				$to = $payer_email;
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';

                sendEmail($to, $sub, $msg,implode("\r\n", $headers));
            }
            // process the membership since paypal gave us a valid +
            //$this->insert_data($request);
			
        }
    }
   
  

}

$obj = New PayPal_IPN();
$obj->ipn_response($_REQUEST);
