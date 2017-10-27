<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emailclass extends CI_Controller {
	public $forWebsite;
    function __construct() {
        parent::__construct();
        $this->load->model('data_model');
		$this->forWebsite = $this->session->userdata('forWebsite');	
    }
    
    public function sendEmailToHeadVolunteerWithCredential($id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            $subject = "Enter Your GBE Head Volunteer Account";
			
			$message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif;">
					  <p>Hello ' . $retValue[0]->firstName . ',</p>
					  <p>Below is your username and password to  enter your Head Volunteer Account.<br />
						Now you can Start to build your GBE  Business, Grow your team and progressively develop <br />
						the Black community in your city.<br />
						You can change your password once you are  inside your account.</p>
					  <p>Remember This is Your Moment! <br />
						Recruit and Teach as many Volunteers as  possible.<br />
						Your Target should be 15 or more, good  people, in Your team.<br />
						Good Luck.</p>
					  <p style=" font-size:12px">Here is your  login credentials </p>
					  <p>Username: ' . $retValue[0]->emailID . '</p>
					  <p>Password: ' . $password . '</p>
					  <p><a href="' . base_url() . '" target="_blank">Click here to login</a></p>
					</div>'; 
           
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        redirect(base_url().'cp/viewHeadVolunteer');
    }
    
    public function sendEmailToVolunterWithCredential($id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            $subject = "Enter Your GBE Head Volunteer Account";
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td colspan="2">Below is your username and password to enter your Head Volunteer Account.
Now you can Start to build your GBE Business, Grow your team and progressively develop 
the Black community in your city.</td></tr>
<tr><td colspan="2">You can change your password once you are inside your account.</td></tr>

<tr><td colspan="2">Remember This is Your Moment! </td></tr>
<tr><td colspan="2">Recruit and Teach as many Volunteers as possible.</td></tr>
<tr><td colspan="2">Your Target should be 15 or more, good people, in Your team.</td></tr>
<tr><td colspan="2">Good Luck.</td></tr>
<tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
                            <tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
                            <tr><td colspan="2">Please <a href="' . base_url() . '" target="_blank">click </a>here to login</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        redirect(base_url().'cp/viewVolunteer');
    }
    
    public function sendEmailToTeacherWithCredential($id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            $subject = "Enter Your GBE Teacher Account";
			$message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
  <p>Hello ' . $retValue[0]->firstName . ',</p>
  <p>Below is your username and password to  enter your Teachers Account.<br />
    Now you can Start to build your GBE  Business and make money.<br />
    You can change your password once you are  inside your account.</p>
  <p>Remember This is Your Moment! <br />
    Recruit and Teach as many Students as  possible.<br />
    Your Target should be 50 Students or more  in Your Online Class.<br />
    Good Luck.</p>
  <p style="font-size:14px;">Here is your  login credentials </p>
  <p>Username: ' . $retValue[0]->emailID . '</p>
  <p>Password: ' . $password . '</p>
<a  href="' . base_url() . '" target="_blank">Click here to login</a></div>';
			
            
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        redirect(base_url().'cp/viewTeacher');
        
    }
    
    public function sendEmailToStudentWithCredential($id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            $subject = "Enter Your GBE Student Account ";
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
                            <tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
                            <tr><td colspan="2">Please <a href="' . base_url() . '" target="_blank">click </a>here to login</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        redirect(base_url().'cp/viewStudent');
       
    }
    
    public function sendEmailToMentorshipWithCredential($type = 'VOLUNTEERS',$id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            if ($type == "HEAD VOLUNTEERS") {
                $subject = "Login Credentials of GBE HEAD VOLUNTEERS";
            }else{
                $subject = "Login Credentials of GBE ".$type;
            }
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
                            <tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
                            <tr><td colspan="2">Please <a href="' . base_url() . '" target="_blank">click </a>here to login</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        if($type == 'VOLUNTEERS'){
            redirect(base_url().'cp/viewVolunteer');
        }  elseif($type == "TEACHER")  {
            redirect(base_url().'cp/viewTeacher');
        }  elseif ($type == "STUDENT") {
            redirect(base_url().'cp/viewStudent');
        }  elseif ($type == "HEAD VOLUNTEERS") {
            redirect(base_url().'cp/viewHeadVolunteer');
        }
    }
    
    public function sendEmailToTalentedWithCredential($type = 'VOLUNTEERS',$id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            if ($type == "HEAD VOLUNTEERS") {
                $subject = "Login Credentials of GBE HEAD VOLUNTEERS";
            }else{
                $subject = "Login Credentials of GBE ".$type;
            }
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
                            <tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
                            <tr><td colspan="2">Please <a href="' . base_url() . '" target="_blank">click </a>here to login</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        if($type == 'VOLUNTEERS'){
            redirect(base_url().'cp/viewVolunteer');
        }  elseif($type == "TEACHER")  {
            redirect(base_url().'cp/viewTeacher');
        }  elseif ($type == "STUDENT") {
            redirect(base_url().'cp/viewStudent');
        }  elseif ($type == "HEAD VOLUNTEERS") {
            redirect(base_url().'cp/viewHeadVolunteer');
        }
    }
    
    public function sendEmailToHealthWithCredential($type = 'VOLUNTEERS',$id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            if ($type == "HEAD VOLUNTEERS") {
                $subject = "Login Credentials of GBE HEAD VOLUNTEERS";
            }else{
                $subject = "Login Credentials of GBE ".$type;
            }
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
                            <tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
                            <tr><td colspan="2">Please <a href="' . base_url() . '" target="_blank">click </a>here to login</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        if($type == 'VOLUNTEERS'){
            redirect(base_url().'cp/viewVolunteer');
        }  elseif($type == "TEACHER")  {
            redirect(base_url().'cp/viewTeacher');
        }  elseif ($type == "STUDENT") {
            redirect(base_url().'cp/viewStudent');
        }  elseif ($type == "HEAD VOLUNTEERS") {
            redirect(base_url().'cp/viewHeadVolunteer');
        }
    }
    
    public function sendEmailToCommunitiesWithCredential($type = 'VOLUNTEERS',$id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            if ($type == "HEAD VOLUNTEERS") {
                $subject = "Login Credentials of GBE HEAD VOLUNTEERS";
            }else{
                $subject = "Login Credentials of GBE ".$type;
            }
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
                            <tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
                            <tr><td colspan="2">Please <a href="' . base_url() . '" target="_blank">click </a>here to login</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        if($type == 'VOLUNTEERS'){
            redirect(base_url().'cp/viewVolunteer');
        }  elseif($type == "TEACHER")  {
            redirect(base_url().'cp/viewTeacher');
        }  elseif ($type == "STUDENT") {
            redirect(base_url().'cp/viewStudent');
        }  elseif ($type == "HEAD VOLUNTEERS") {
            redirect(base_url().'cp/viewHeadVolunteer');
        }
    }
    
    public function sendEmailToBusinessWithCredential($type = 'VOLUNTEERS',$id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            if ($type == "HEAD VOLUNTEERS") {
                $subject = "Login Credentials of GBE HEAD VOLUNTEERS";
            }else{
                $subject = "Login Credentials of GBE ".$type;
            }
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
                            <tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
                            <tr><td colspan="2">Please <a href="' . base_url() . '" target="_blank">click </a>here to login</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        if($type == 'VOLUNTEERS'){
            redirect(base_url().'cp/viewVolunteer');
        }  elseif($type == "TEACHER")  {
            redirect(base_url().'cp/viewTeacher');
        }  elseif ($type == "STUDENT") {
            redirect(base_url().'cp/viewStudent');
        }  elseif ($type == "HEAD VOLUNTEERS") {
            redirect(base_url().'cp/viewHeadVolunteer');
        }
    }
    
    public function sendEmailToUserWithCredential($type = 'VOLUNTEERS',$id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            if ($type == "HEAD VOLUNTEERS") {
                $subject = "Login Credentials of GBE HEAD VOLUNTEERS";
            }else{
                $subject = "Login Credentials of GBE ".$type;
            }
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
                            <tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
                            <tr><td colspan="2">Please <a href="' . base_url() . '" target="_blank">click </a>here to login</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        if($type == 'VOLUNTEERS'){
            redirect(base_url().'cp/viewVolunteer');
        }  elseif($type == "TEACHER")  {
            redirect(base_url().'cp/viewTeacher');
        }  elseif ($type == "STUDENT") {
            redirect(base_url().'cp/viewStudent');
        }  elseif ($type == "HEAD VOLUNTEERS") {
            redirect(base_url().'cp/viewHeadVolunteer');
        }
    }
    
    function send_mail_raw($to = '', $subject = '', $message = '') {
		if($this->forWebsite==1){
			$from_email = "blessings.jain@globalblackenterprises.com";
			$from_name = "globalblackenterprises.com";
		}
		else if($this->forWebsite==2){
			$from_email = "admin@communitytreasures.co";
			$from_name = "communitytreasures.co";
		}
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
		//$headers .= 'Cc:senabi.gbe@gmail.com' . "\r\n";
        $headers .= 'From: ' . $from_name . ' <' . $from_email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $from_name . ' <' . $from_email . '>' . "\r\n";
        $headers .= 'Return-Path:' . $from_name . ' <' . $from_email . '>' . "\n";
        
        $send = mail($to, $subject, $message, $headers);
        if($send){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
     private function generatePassword() {
        $string = mt_rand();
        $start = 1;
        $length = 8;
        $code = substr($string, $start, $length);
		if($this->forWebsite==1){
			 $code = "GBE" . $code;
		}elseif($this->forWebsite==2){
			$code = "CT" . $code;
		}
        return $code;
    }
    
    public function promoteStudentToTeacher($id = 0){
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            $subject = "Promotion Email from GBE";
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Congratulation!</td></tr>
                            <tr><td colspan="2">You are promoted as Teacher.</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->promoteStudentToTeacher($id);
            $report = 1;
            $msg = "Promoted successfully.";
        }else{
            $msg = "Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        redirect(base_url().'cp/viewStudent');
    }
    
    public function promoteVolunteerToHVolunteer($id = 0){
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
            $subject = "Promotion Email from GBE";
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Congratulation!</td></tr>
                            <tr><td colspan="2">You are promoted as Head Volunteer.</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->promoteVolunteerToHVolunteer($id);
            $report = 1;
            $msg = "Promoted successfully.";
        }else{
            $msg = "Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        redirect(base_url().'cp/viewVolunteer');
    }
    
    public function sendEmailToPayingUserWithCredential($id = 0) {
        $id = trim($id);
        $report = 2;
        if ($id != '') {
            $password = $this->generatePassword();
            $retValue = $this->data_model->getSingleValue($id);
            $to = $retValue[0]->emailID;
            //$to = "senabi.test01@gmail.com";
           if($this->forWebsite==1){
            $subject = "Login Credentials of GBE Paying User";
           
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
                            <tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
                            <tr><td colspan="2">Please <a href="' . base_url() . '" target="_blank">click </a>here to login</td></tr>
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">globalblackenterprises.com</td></tr>
                        </table>';
		   }
		   else if($this->forWebsite==2){
			   $subject = "Login Credentials of Community Treasure Paying User";
           
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr><td colspan="2">Hello ' . $retValue[0]->firstName . ',</td></tr>
                            <tr><td colspan="2">Here is your login credentials as below.</td></tr>
                            <tr><td width="25%">Username:</td><td width="75%">' . $retValue[0]->emailID . '</td></tr>
                            <tr><td width="25%">Password:</td><td width="75%">' . $password . '</td></tr>
                            
                            <tr><td colspan="2">Thank you very much.</td></tr>
                            <tr><td colspan="2">communitytreasures.co</td></tr>
                        </table>';
		   }
            $em = $this->send_mail_raw($to, $subject, $message);
            $this->data_model->updatePassword($id, $password);
            $report = 1;
            $msg = "Email has been send successfully.";
        }else{
            $msg = "Email has not been send successfully.Please try again";
        }
        $this->session->set_flashdata("report", $report);
        $this->session->set_flashdata("msg", $msg);
        
        redirect(base_url().'cp/viewPayingUser');
        
    }
    
}


