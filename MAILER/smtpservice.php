<?php

require_once("class.phpmailer.php");

function sendEmail($to, $subject, $bodytext) {
    $mail = new PHPMailer();  // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->IsHTML(true);
    $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    //////////////   AS Per Company   ////////////////
    $mail->Host = '74.125.129.108';
    $mail->Port = 465;

    $mail->Username = "Enter Your Gmail UserId";
    $mail->Password = "Enter Your Gmail Password";

    $mail->SetFrom("Enter Your Gmail MailID", "Enter Your Name");
    $mail->Subject = $subject;
    $mail->Body = $bodytext;

    $mail->AddAddress($to);

    /*     * ************************************************** */
    $status = $mail->Send();
}

?>
