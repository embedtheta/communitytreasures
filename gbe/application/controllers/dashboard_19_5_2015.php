<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $_admin_email ;
            
    private $paypal_active = 2; //1=live;2=sandbox

    private $paypal_action = '';

    private $paypal_email = '';

    function __construct() {
        parent::__construct();
        $this->load->model('gatewaymodel');
        $this->_admin_email = "info@globalblackenterprises.com";
        $this->output->enable_profiler(FALSE);
    }

    public function index() { 
	
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
        $viewData = array();
        $viewData["msg"] = "";
        if ($this->session->userdata('referarId') == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        } else {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('referarId'));
        }
        if(in_array($this->session->userdata('userType'),array("TEACHER","ADMIN","HEAD VOLUNTEERS"))){
            $viewData["allUser"] = $this->gatewaymodel->allMember();
        }else{
            $viewData["allUser"] = array();
        }
        
        $viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
        $viewData["SwitchOnMembers"] = $this->gatewaymodel->countSwitchOnMembers($this->session->userdata('userId'));
        $viewData["mySignUps"] = $this->gatewaymodel->countMySignUps($this->session->userdata('userId'));
        $viewData["totalMembers"] = $this->gatewaymodel->countTotalMembers($this->session->userdata('userId'));
        $viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
        $viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
        $viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
        $viewData["countryList"] = $this->gatewaymodel->getCountryList();
        $viewData["afroProduct"] = $this->gatewaymodel->getAfroProduct();
        $viewData["stepWiseVideo"] = $this->gatewaymodel->getLevelOneVideo();
        $viewData["cityList"] = $this->gatewaymodel->getCity();

        $viewData['vendorsList'] = $this->gatewaymodel->getVendorsList();
        $viewData['productCategoryList'] = $this->gatewaymodel->productCategoryList();
        $viewData["colorList"] = $this->gatewaymodel->getColor();
        
        $msgTypeDetails = $this->setMessage();  
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
        $viewData['levelWiseCounter'] = $this->gatewaymodel->getLevelWiseCount();
        $this->load->view('dashboard/dashboard', $viewData);
        
    }
    
    
    public function payment($productId = "") {
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
        $productId = trim($productId);
        $userId = $this->session->userdata('userId');
        //USD //GBP

        $return_url = base_url() . 'dashboard';

        $cancel_url = base_url() . 'dashboard';

        $notify_url = base_url() . 'dashboard/updatePayment';
        
        $proDetails = $this->gatewaymodel->getAfroProductById($productId);
        
        $this->setPaypalDetails();
        
        $invoice = $this->insertPayment($proDetails);

        $form_element = '   Please wait....<br>
                            Transaction is processing.....
                            <script type="text/javascript">
                                jQuery(document).ready(function() {
                                    jQuery(document).bind("contextmenu", function (e) {
                                        e.preventDefault();
                                        return false;
                                    });
                                    jQuery(window).keydown(function (e){
                                        if (e.ctrlKey) return false;
                                    });
                                });
                            </script>

					<form name="paypal_buy" id="paypal_id" method="post" action="' . $this->paypal_action . '">

					 <input id="cpp_header_image" name="cpp_header_image" value="' . base_url() . 'images/logo-in-pdf.png" type="hidden"/>

					<input type="hidden" name="cmd" value="_xclick">

					<input type="hidden" value="' . $this->paypal_email . '" name="business">

					<input type="hidden" name="currency_code" value="'.$proDetails[0]->currency_name.'">

					<input type="hidden" name="item_name" value="Afrowebb Catalogue of ' . $proDetails[0]->title. '">

					<input type="hidden" name="item_number" value="' . $proDetails[0]->id . '">

					<input type="hidden" name="quantity" value="1" />

					<input type="hidden" name="amount" value="' . $proDetails[0]->cost . '">

					<input type="hidden" name="invoice" value="' . $invoice . '">

					<input type="hidden" name="no_shipping" value="1">

					<input type="hidden" name="charset" value="utf-8">

					<input type="hidden" name="return" value="' . $return_url . '">

					<input type="hidden" name="cancel_return" value="' . $cancel_url . '">

					<input type="hidden" name="notify_url" value="' . $notify_url . '">

					<input type="hidden" value="' . trim($userId) . '" name="custom">

					<input type="image" style="display:none;" src="http://www.paypal.com/en_GB/i/btn/x-click-but01.gif" border="0" name="submit" alt="Make payments with PayPal - it\'\s fast, free and secure!">

					</form>

                                        <script type="text/javascript">
                                           
                                            document.getElementById("paypal_id").submit();

                                        </script>

					';

        echo $form_element;

        return true;

    }

    public function setPaypalDetails() {

        if ($this->paypal_active == 1) {

            $this->paypal_action = 'https://www.paypal.com/cgi-bin/webscr';

            $this->paypal_email = '';

        } else {

            $this->paypal_action = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

            $this->paypal_email = 'testmail.senabi@aol.in';

        }

    }

    private function insertPayment($proDetails = array()) {

        $data = array();

        $data['user_id'] = $this->session->userdata('userId');
        
        $data['grand_total'] = $proDetails[0]->cost;
        
        $data['product_id'] = $proDetails[0]->id;

        $data['order_date'] = date("Y-m-d H:i:s");

        $data['mc_currency'] = $proDetails[0]->currency_name;

        $data['payment_status'] = 3; //1=Completed;2=pending;3=send to paypal;

        $data['payment_type'] = 2; //1=admin;2=paypal;3=credit

        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        
        $data['payment_for'] = 1;//1=afroweb product,2=level 1,3=level 2,4=level 3,5=level 4,6=level 5

        $data['payment_data'] = serialize($data);
        
        $tbl = 'payment';
        
        $insertId = $this->common_model->insertDataToTable($tbl,$data);

        return $insertId;

    }

    function updatePayment() {

        $this->updatePaymentInTxtFile();

        if (trim($_POST['txn_id']) != '' && trim($_POST['invoice']) != '' && trim($_POST['custom']) != '' && trim($_POST['item_number']) != '') {

            $insert_array['txn_type'] = trim($_POST['txn_type']);

            $insert_array['txn_id'] = trim($_POST['txn_id']);

            $insert_array['ipn_track_id'] = trim($_POST['ipn_track_id']);

            $insert_array['test_ipn'] = trim($_POST['test_ipn']);

            $insert_array['mc_gross'] = trim($_POST['mc_gross']);

            $insert_array['payment_gross'] = trim($_POST['payment_gross']);

            $ps = trim($_POST['payment_status']);

            if ($ps == 'Pending') {

                $insert_array['payment_status'] = 2;

            } elseif ($ps == 'Completed') {

                $insert_array['payment_status'] = 1;

            }

            $insert_array['payment_date'] = trim($_POST['payment_date']);
            
            $insert_array['pending_reason'] = trim($_POST['pending_reason']);

            $insert_array['verify_sign'] = trim($_POST['verify_sign']);

            $insert_array['payer_id'] = trim($_POST['payer_id']);

            $insert_array['payer_email'] = trim($_POST['payer_email']);

            $insert_array['payer_status'] = trim($_POST['payer_status']);

            $insert_array['real_name'] = trim($_POST['first_name']);

            $insert_array['residence_country'] = trim($_POST['residence_country']);

            $insert_array['notify_version'] = trim($_POST['notify_version']);

            $insert_array['mc_currency'] = trim($_POST['mc_currency']);

            $insert_array['receiver_id'] = trim($_POST['receiver_id']);

            $insert_array['receiver_email'] = trim($_POST['receiver_email']);

            $insert_array['business'] = trim($_POST['business']);

            $insert_array['auth'] = trim($_POST['auth']);

            $insert_array['first_name'] = trim($_POST['first_name']);

            $insert_array['last_name'] = trim($_POST['last_name']);

            $insert_array['payment_data'] = serialize($_POST);

            if (trim($_POST['payment_status']) == 'Completed') {

                $insert_array['paid_date'] = date("Y-m-d H:i:s");

            }

            $where['id'] = trim($_POST['invoice']);

            $where['user_id'] = trim($_POST['custom']);
            
            $tbl = "payment";
            //update data after IPN return

            $this->common_model->updateDataToTable($tbl, $where, $insert_array);
            unset($tbl);unset($where);unset($insert_array);
            
            if (trim($_POST['payment_status']) == 'Completed') {
                $tbl = "userinfo";
                $where['user_id'] = trim($_POST['custom']);
                $insert_array['afrooPaymentStatus'] = "1";
                $this->common_model->updateDataToTable($tbl, $where, $insert_array);
                unset($tbl);unset($where);unset($insert_array);
            }
            //$where['id'] = trim($_POST['invoice']);
            //$where['user_id'] = trim($_POST['custom']);
            //$this->sendPaypalPaymentEmailToUser($where);
            //$this->sendPaypalPaymentEmailToAdmin($where);

        }

        return TRUE;

    }

    function sendPaypalPaymentEmailToUser($where = array()) {
        
        $data['invoice'] = $this->gatewaymodel->getInvoiceData($where);

        ob_start();

        $this->load->view('email_templates/afro_invoice_email_user', $data);

        $content = ob_get_clean();

        $subject = 'Invoice Details';

        $to = $data['invoice'][0]->employer_email;

        $this->send_mail_raw($to, $subject, $content);

        return true;

    }

    function sendPaypalPaymentEmailToAdmin($where = array()) {

        $data['invoice'] = $this->gatewaymodel->getInvoiceData($where);
        
        ob_start();

        $this->load->view('email_templates/afro_invoice_email_admin', $data);

        $content = ob_get_clean();

        $subject = 'New Invoice Details';

        $to = $this->_admin_email;

        $this->send_mail_raw($to, $subject, $content);

        return true;

    }

    function updatePaymentInTxtFile() {

        $logPath = $this->common_model->imageUnlinkPath() . 'paypal_update.txt';
        
        if (file_exists($logPath)) {

            unlink($logPath);

        }

        $myfile = fopen($logPath, "w") or die("Unable to open file!");

        $fileData = 'Here are all details ...';

        if (count($_POST) > 0) {

            foreach ($_POST as $k => $v) {

                $fileData .= "\r\n";

                $fileData .= $k . " ==>" . $v;

            }

        } else {

            $fileData .= "\r\n";

            $fileData .= "Sorry! No Data Please. ";

        }



        fwrite($myfile, $fileData);

        fclose($myfile);

        return TRUE;

    }
    
    public function setMessage(){
        $retData = array();
        $type = $this->session->flashdata('type');
        $status = $this->session->flashdata('status');
        if($status == "success"){
            if($type == "customer"){
                $retData["msg"] = "You have successfully submitted the message for Customer Services.";
            }elseif($type == "tech"){
                $retData["msg"] = "You have successfully submitted the message for Technical Support.";
            }elseif($type == "advertise"){
                $retData["msg"] = "You have successfully submitted the message for Advertisement Services.";
            }elseif($type == "country"){
                $retData["msg"] = "You have successfully updated your country name.";
            }elseif($type == "paypal"){
                $retData["msg"] = "You have successfully updated your paypal id.";
            }elseif($type == "image"){
                $retData["msg"] = "You have successfully updated your Profile picture.";
            }elseif($type == "pUpload"){
                $retData["msg"] = "You have successfully uploaded your Product .";
            }elseif($type == "vUpload"){
                $retData["msg"] = "You have successfully added your Vendors Details.";
            }elseif($type == "fListing"){
                $retData["msg"] = "You have successfully added your Free Listing on AFROWEBB.";
            }
            $retData["type"] = $type;
        }elseif($status == "error"){
            $retData["msg"] = "Please try again.";
            $retData["type"] = "wrong";
        }
        return $retData;
    }

    public function view() {
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
        $viewData = array();
        if ($this->session->userdata('referarId') == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        } else {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('referarId'));
        }
        if ($_REQUEST["action"] == "gmailContactImport") {
            $arr = array();
            $string = substr($_REQUEST["contactList"], 1, -1);
            $arr = explode(",", $string);
            foreach ($arr as $val) {
                $viewData["gmailContactList"][] = substr($val, 3, -3);
            }
            $viewData["contactImportStatus"] = true;
        }
        if ($_REQUEST["returnFrom"] == "PaypalSwitchOn") {
            $this->gatewaymodel->getSwitchOnPaymentResponse($this->session->userdata('userId'));
        }
        if ($_REQUEST["returnFrom"] == "PaypalEntryFees") {
            $this->gatewaymodel->getPaypalEntryFeesResponse($this->session->userdata('userId'));
        }
        if ($_REQUEST["returnFrom"] == "PaypalAfroo") {
            $this->gatewaymodel->getAfrooPaymentResponse($this->session->userdata('userId'));
        }
        if (isset($_REQUEST["resCountryCode"])) {
            if ($_REQUEST["resCountryCode"] == "CountryCodeEdited") {
                $viewData["countryCodeStatus"] = "Country Code edited succesfully";
                $viewData["countryCodeFormActivity"] = true;
            } else if ($_REQUEST["resCountryCode"] == "CountryCodeAdded") {
                $viewData["countryCodeStatus"] = "Country Code added succesfully";
                $viewData["countryCodeFormActivity"] = true;
            }
        }
        if ($_REQUEST["action"] == "subRegTCPearl") {
            $viewData["statusTcPearl"] = $this->codeSubmisssionTcPearl();
        }
        if ($_REQUEST["action"] == "subRegTCSilver") {
            $viewData["statusTcSilver"] = $this->codeSubmisssionTcSilver();
        }
        $viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->session->userdata('userId'));
        $viewData["SwitchOnMembers"] = $this->gatewaymodel->countSwitchOnMembers($this->session->userdata('userId'));
        $viewData["mySignUps"] = $this->gatewaymodel->countMySignUps($this->session->userdata('userId'));
        $viewData["totalMembers"] = $this->gatewaymodel->countTotalMembers($this->session->userdata('userId'));
        $viewData["htmlBanners"] = $this->gatewaymodel->getHtmlBanners();
        $viewData["userAdverts"] = $this->gatewaymodel->getUserAdverts();
        $viewData["userYoutube"] = $this->gatewaymodel->getYoutubeVideos();
        $viewData["userCountryCode"] = $this->gatewaymodel->getCountryCode($this->session->userdata('userId'));
        $viewData["parentTCPearlCode"] = $this->gatewaymodel->getTCPearlCode($this->session->userdata('referarId'));
        $viewData["parentTcSilverCode"] = $this->gatewaymodel->getTcSilverCode($this->session->userdata('referarId'));
        $viewData["parentTcSilverCode"] = $this->gatewaymodel->getTcSilverCode($this->session->userdata('referarId'));
        if ($viewData["userCountryCode"] == "United States" || $viewData["userCountryCode"] == "Canada") {
            $viewData["userTCPearlCode"] = $this->gatewaymodel->getTCPearlCode($this->session->userdata('userId'));
            $viewData["userTcSilverCode"] = $this->gatewaymodel->getTcSilverCode($this->session->userdata('userId'));
        }
        // print_r($viewData);
        // print_r($this->session->all_userdata());
        $this->load->view('dashboard/dashboard', $viewData);
    }

    public function profilePicUpload() {
        $status = 'error';
        $type = 'image';
        if ($this->input->post('user_file_submit')) {
            move_uploaded_file($_FILES["user_file"]["tmp_name"], str_replace("system", "useruploads", BASEPATH) . $_FILES["user_file"]["name"]);
            $this->gatewaymodel->insertMemberProfilePic($_FILES["user_file"]["name"]);
            $status = 'success';
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }
    
    public function userCountryUpdate() {
        $status = 'error';
        $type = 'country';
        $countryId = trim($this->input->post('country'));
        if ($countryId != "") {
            $tbl = 'userinfo';
            $where = array("uID"=>$this->session->userdata("userId"));
            $data = array("country"=>$countryId) ;
            $update = $this->common_model->updateDataToTable($tbl, $where, $data );
            if($update){
                $status = 'success';
            }
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }

    public function userPaypalUpdate() {
        $status = 'error';
        $type = 'paypal';
        $paypalId = trim($this->input->post('user_paypal_name'));
        if ($paypalId != "") {
            $tbl = 'userinfo';
            $where = array("uID"=>$this->session->userdata("userId"));
            $data = array("paypalAC"=>$paypalId) ;
            $update = $this->common_model->updateDataToTable($tbl, $where, $data );
            if($update){
                $status = 'success';
            }
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }

    function downloadAdverts() {
        $imgname = $_REQUEST['img'];
        $remoteFile = base_url() . 'adminuploads/advert/' . $imgname;
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=\"$imgname\";");
        header("Content-Transfer-Encoding: binary");
        readfile($remoteFile);
    }

    public function downloadVideo() {
        $video_id = $this->input->post('video_id');
        $viewData["video_id"] = $video_id;
        $this->load->view('youtube/getvideo', $viewData);
    }
    
    public function services($type = ''){
        $status = 'error';
        if($type != ''){
            $email = $this->input->post('email');
            $message = $this->input->post('message');
            if($email != "" && $message != ""){
                $retData = 2;
                if($type == "customer"){
                    $retData = $this->sendCustomerEmailToAdmin($email,$message);
                }elseif($type == "tech"){
                    $retData = $this->sendTechEmailToAdmin($email,$message);
                    $retData = $this->sendTechEmailToSenabi($email,$message);
                }elseif($type == "advertise"){
                    $retData = $this->sendAdvertiseEmailToAdmin($email,$message);
                }
                if($retData == 1){
                    $status = 'success' ;
                }
            }
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }
    
    public function sendCustomerEmailToAdmin($email = '',$msg = ''){
        $to = $this->_admin_email;
        $subject = "Email for Customer Services";
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Here are customer details as below.</td></tr>
                    <tr><td width="25%">Email:</td><td width="75%">'.$email.'</td></tr>
                    <tr><td width="25%">Message:</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
        	
    }
    
    public function sendTechEmailToAdmin($email = '',$msg = ''){
        $to = $this->_admin_email;
        $subject = "Email for Customer Tech support";
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Here are customer details as below.</td></tr>
                    <tr><td width="25%">Email:</td><td width="75%">'.$email.'</td></tr>
                    <tr><td width="25%">Message:</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
        	
    }
    
    public function sendTechEmailToSenabi($email = '',$msg = ''){
        $to = "senabi.test01@gmail.com";
        $subject = "Email for Customer Tech support";
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Here are customer details as below.</td></tr>
                    <tr><td width="25%">Email:</td><td width="75%">'.$email.'</td></tr>
                    <tr><td width="25%">Message:</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
        	
    }
    
    public function sendAdvertiseEmailToAdmin($email = '',$msg = ''){
        $to = $this->_admin_email;
        $subject = "Email for Customer Advertise";
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">Here are customer details as below.</td></tr>
                    <tr><td width="25%">Email:</td><td width="75%">'.$email.'</td></tr>
                    <tr><td width="25%">Message:</td><td width="75%">'.$msg.'</td></tr>
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
        	
    }
    
    function send_mail_raw($to = '', $subject = '', $message = '') {
        $from_email = "info@globalblackenterprises.com";
        $from_name = "globalblackenterprises.com";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
        $headers .= 'From: '.$from_name.' <'.$from_email.'>' . "\r\n";
        $headers .= 'Reply-To: '.$from_name.' <'.$from_email.'>' . "\r\n";
        $headers .= 'Return-Path: '.$from_name.' <'.$from_email.'>'."\n";      
        $send = mail($to, $subject, $message, $headers);
        if ($send) {
        return TRUE;
        } else {
        return FALSE;
        }
    }
    
    public function freeListing(){
        $type = 'fListing';
        $status = 'error';
        if($this->input->post('freeListing') != ''){
            $listingdetails["listingName"] = trim($this->input->post('listingName'));
            $listingdetails["listingAddr"] = $this->input->post('listingAddr');
            $listingdetails["listingNo"] = trim($this->input->post('listingNo'));
            $listingdetails["listingDesc"] = $this->input->post('listingDesc');
            $listingdetails["listingWebsite"] = trim($this->input->post('listingWebsite'));
            $retImg = $this->uploadFreeListingImage();
            if($retImg['status'] == 1){
                $listingdetails["listingImg"] = $retImg['name'];
            }else{
                $listingdetails["listingImg"] = "";
            }
            $listingdetails["listingUrl"] = trim($this->input->post('listingUrl'));
            $listingdetails["listingEmail"] = trim($this->input->post('listingEmail'));
            $listingdetails["listingCountry"] = $this->input->post('listingCountry');
            $listingdetails["listingState"] = trim($this->input->post('listingState'));
            $listingdetails["listingCity"] = $this->input->post('listingCity');
            $listingdetails["listingAddedBy"] = $this->session->userdata('userId');
            $listingdetails["listingCreatedDate"] = date("Y-m-d H:i:s");
            $tbl = 'listingdetails';
            $listingdetailsId = $this->common_model->insertDataToTable($tbl,$listingdetails);
            unset($listingdetails);unset($tbl);
            $tbl = 'listingurls';
            $listingurls["lisMemID"] = $listingdetailsId;
            $listingurls["lisUrl"] = $this->input->post('lisUrl');
            $listingurls["status"] = '1';
            $listingurlsId = $this->common_model->insertDataToTable($tbl,$listingurls);
            if($listingurlsId > 0){
                $status = 'success';
            }
        }
        
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }
    
    public function uploadFreeListingImage() {
        $path = "adminuploads/listingImg/";
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["listingImg"]["name"]);
        $extension = strtolower(end($temp));
        if (($_FILES["listingImg"]["size"] < 2000000) && in_array($extension, $allowedExts)) {
            $_FILES["listingImg"]["name"] = "listing_".time(). "." . $extension;
            if ($_FILES["listingImg"]["error"] > 0) {
                $retData['status'] = 0; //error
                $retData['errorMsg'] = 'The image has an error' . $_FILES["listingImg"]["error"]; //error
                $retData['name'] = $_FILES["listingImg"]["name"];
            } else {
                move_uploaded_file($_FILES["listingImg"]["tmp_name"], $path . $_FILES["listingImg"]["name"]);
                $retData['status'] = 1; //success
                $retData['errorMsg'] = '';
                $retData['name'] = $_FILES["listingImg"]["name"];
            }
        }
        return $retData;
    }

    public function addVendors(){
        $type = 'vUpload';
        $status = 'error';
        if($this->input->post('addVendors') != ''){
            $vendor["vendorName"] = trim($this->input->post('vendorName'));
            $vendor["vendorNo"] = $this->input->post('vendorNo');
            $vendor["vendorAddr"] = trim($this->input->post('vendorAddr'));
            $vendor["vendorCity"] = $this->input->post('vendorCity');
            $vendor["vendorCountry"] = trim($this->input->post('vendorCountry'));
            $vendor["vendorZip"] = trim($this->input->post('vendorZip'));
            $vendor["vendorEmail"] = trim($this->input->post('vendorEmail'));
            $vendor["vendorWebsite"] = $this->input->post('vendorWebsite');
            $vendor["vendorAddedBy"] = $this->session->userdata('userId');
            $vendor["vendorCreatedDate"] = date("Y-m-d H:i:s");
            $tbl = 'vendorslist';
            $vendorId = $this->common_model->insertDataToTable($tbl,$vendor);
            unset($vendor);unset($tbl);
            if($vendorId > 0){
                $status = 'success';
            }
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }
    
    public function addProduct(){
        $type = 'pUpload';
        $status = 'error';
        if($this->input->post('pUploadButton') != ''){
            $product["productTypeID"] = trim($this->input->post('productTypeID'));
            $product["vendorID"] = $this->input->post('vendorID');
            $product["productName"] = trim($this->input->post('productName'));
            $product["productDesc"] = $this->input->post('productDesc');
            $product["productCurrencyType"] = trim($this->input->post('productCurrencyType'));
            $product["productPrice"] = trim($this->input->post('productPrice'));
            $product["productQuantity"] = trim($this->input->post('productQuantity'));
            $product["productCommission"] = trim($this->input->post('productCommission'));
            $product["productOffer"] = $this->input->post('productOffer');
            $product["productYoutubeUrl"] = $this->input->post('productYoutubeUrl');
            $product["typeOfProduct"] = trim($this->input->post('typeOfProduct'));
            $product["productStatus"] = trim($this->input->post('productStatus'));
            $product["createdDate"] = date("Y-m-d H:i:s");
            
            $tbl = 'product_details';
            $productId = $this->common_model->insertDataToTable($tbl,$product);
            unset($product);unset($tbl);
            if($productId > 0){
                $this->allImages($productId);
                $this->addProductAudio($productId);
                if($this->input->post("RadioGroup1") == 1){
                    $this->addColor($productId);
                }
                $status = 'success';
            }
            
        }
        $this->session->set_flashdata('type',$type);
        $this->session->set_flashdata('status',$status);
        redirect(base_url()."dashboard");
    }
    
    public function allImages($pId = 0){
        $insertImg = array();
        $insertImg["fileType"] = 0;
        $insertImg["productId"] = $pId;
        if($_FILES["img_1"]["name"] != ""){
            $fileName = "img_1";
            $insertImg["isMain"] = 1;
            $ret[1] =$this->addProductImages($fileName,$insertImg);
        }
        if($_FILES["img_2"]["name"] != ""){
            $fileName = "img_2";
            $insertImg["isMain"] = 0;
            $ret[2] =$this->addProductImages($fileName,$insertImg);
        }
        if($_FILES["img_3"]["name"] != ""){
            $fileName = "img_3";
            $insertImg["isMain"] = 0;
            $ret[3] =$this->addProductImages($fileName,$insertImg);
        }
        if($_FILES["img_4"]["name"] != ""){
            $fileName = "img_4";
            $insertImg["isMain"] = 0;
            $this->addProductImages($fileName,$insertImg);
        }
        //echo "<pre>";print_r($ret);
        return true;
    }
    
    public function addProductImages($fileName = "",$insertImg = array()){
        $this->load->library('upload');
        $config['upload_path'] = $this->common_model->imageUnlinkPath().'adminuploads/product_files/images/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '200000';
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['file_name'] = 'product-'.$insertImg["productId"].'-'.time();
        $this->upload->initialize($config);
        $this->upload->do_upload($fileName);
        $ret = $this->upload->data();
        $this->load->library('image_lib');
        $image_lib['image_library'] = 'gd2';
        $image_lib['source_image'] = $ret["full_path"];
        $image_lib['create_thumb'] = FALSE;
        $image_lib['maintain_ratio'] = TRUE;
        $image_lib['new_image'] = $this->common_model->imageUnlinkPath().'adminuploads/product_files/images/thumb/'.$ret['file_name'];
        $image_lib['width'] = 192;
        $image_lib['height'] = 192;
        $this->image_lib->initialize($image_lib);
        $this->image_lib->resize();
        $this->image_lib->clear();
        $tbl = 'product_files';
        $insertImg["fileName"] = $ret["file_name"];
        $imgId = $this->common_model->insertDataToTable($tbl,$insertImg);
        return $ret;
    }
    
    public function addProductAudio($pId = 0){
        if($_FILES["productMusic"]["name"] != ""){
            $path = "adminuploads/product_files/audio/";
            $allowedExts = array("mp3","mp4");
            $temp = explode(".", $_FILES["productMusic"]["name"]);
            $extension = strtolower(end($temp));
            if (($_FILES["productMusic"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
                $_FILES["productMusic"]["name"] = 'product-'.$pId.'-'.time() . "." . $extension;
                if ($_FILES["productMusic"]["error"] > 0) {
                    $retData['status'] = 0; //error
                    $retData['errorMsg'] = 'The image has an error' . $_FILES["productMusic"]["error"]; //error
                    $retData['name'] = $_FILES["listingImg"]["name"];
                } else {
                    move_uploaded_file($_FILES["productMusic"]["tmp_name"], $path . $_FILES["productMusic"]["name"]);
                    $tbl = 'product_files';
                    $insertImg["fileName"] = $_FILES["productMusic"]["name"];
                    $insertImg["isMain"] = 0;
                    $insertImg["fileType"] = 1;
                    $insertImg["productId"] = $pId;
                    $imgId = $this->common_model->insertDataToTable($tbl,$insertImg);
                }
            }
        }
        return true;
    }
    
    public function addColor($productId = 0){
       $color = $this->input->post("color");
       $quantity = $this->input->post("q");
       if(count($color) > 0){
           //$sumQ = 0;
           foreach($color as $key=>$val){
               if($key == $val && $val > 0){
                   if($quantity[$key] != ""){
                        $colorArray['productId'] = $productId;
                        $colorArray['colorId'] = $val;
                        $colorArray['quantity'] = trim($quantity[$key]);
                        $tbl = 'product_color_quantity';
                        $cId = $this->common_model->insertDataToTable($tbl,$colorArray);
                        unset($colorArray);unset($tbl);
                        //$sumQ = $sumQ + trim($quantity[$key]);
                   }
               }
           }
       }
//       if($sumQ > 0){
//            $tbl = "product_details";
//            $where['productID'] = $productId;
//            $insert_array['productQuantity'] = $sumQ;
//            $this->common_model->updateDataToTable($tbl, $where, $insert_array);
//            unset($tbl);unset($where);unset($insert_array);
//       }
       return true;
    }
    
    public function expell(){
        $data["user_id"] = trim($this->input->post("uID"));
        $data["expell_by_user_id"] = $this->session->userdata('userId');
        $data["expell_date"] = date("Y-m-d H:i:s");
        $tbl = 'user_expell';
        $insertId = $this->common_model->insertDataToTable($tbl,$data);
        if($insertId > 0){
           $retData = $this->sendExpellEmailToAdmin($insertId);
        }
		echo $retData;
    }
    
    public function sendExpellEmailToAdmin($expellId = 0){
        $to = $this->_admin_email;
		$userDetail = $this->gatewaymodel->getExpellUserInfo($expellId);// Added by SB on 23-04-2015
		//print_r($userDetail);
		//echo $userDetail['EUserfName']." ==== ".$userDetail['EUserlName'];
        $subject = $userDetail['EUserfName']." ".$userDetail['EUserlName']." has been expelled by ".$userDetail['firstName']." ".$userDetail['lastName'];
        $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr><td colspan="2">Hello Admin,</td></tr>
                    <tr><td colspan="2">'.$userDetail['EUserfName'].' '.$userDetail['EUserlName'].' has been expelled from his/her circle.</td></tr>
                    
                    <tr><td colspan="2">Thank you very much.</td></tr>
                    <tr><td colspan="2">globalblackenterprises.com</td></tr>
                    </table>';
        $eml = $this->send_mail_raw($to,$subject,$message);	
        if ($eml) {
            return  1;	
        } else {
            return 2;	
        }	
    }
    
    public function construction(){
        $viewData = array();
        $this->load->view('dashboard/under_construction', $viewData);
    }
    

    /* public function getSwitchOnPaypalRespose(){
      ob_start();
      print_r($_REQUEST);
      $page = ob_get_contents();
      ob_end_clean();
      $fw = fopen('abc.txt', "w+");
      fwrite($fw,$page);
      fclose($fw);
      /////////////////
      if($_REQUEST["status"] == "COMPLETED"){
      $obj = new DataLayer();
      $obj->OpenConnection();
      $qry  ="UPDATE tbluserdetail SET `PaymentStatus`=\"1\" Where UID='".$_REQUEST['uid']."'";
      mysql_query($qry);
      $obj->CloseConnection();
      }
      //////////////////
      $this->gatewaymodel->getSwitchOnPaymentResponse($_REQUEST["uid"]);
      } */
}
