<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gambia extends CI_Controller {

    private $_from_email = "";
    private $_from_name = "";
    private $_admin_email = "";
    private $_message = "";
    private $_subject = "";
    private $_to_email = "";
    public $city;

    function __construct() {
        parent::__construct();
        $this->_from_email = "info@globalblackenterprises.com";
        $this->_from_name = "globalblackenterprises.com";
        $this->_admin_email = "info@globalblackenterprises.com";
        $this->load->model('gatewaymodel');
        $this->city = $this->gatewaymodel->getCity();
        /* if(trim($this->session->userdata('UserId'))!=""){
          if($_REQUEST["actionLog"] == ""){
          redirect(base_url().'dashboard/', 'refresh');
          }
          } */
    }

    public function index($parentID = 0) {
        $viewData = array();
        $viewData['msgType'] = ''; //1=su;2=fa
        $viewData['msg'] = '';

        if ($parentID == 0) {
            $parentID = 1000;
            $viewData["parentID"] = $parentID;
        } else if ($parentID > 0) {
            $ustatus = $this->gatewaymodel->isMemberExist($parentID);
            if ($ustatus) {
                $viewData["parentID"] = $parentID;
            } else {
                $viewData["parentID"] = 1000;
            }
        }

        if ($this->input->post('submit')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            //$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
            $this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
            $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            //$viewData['invited']					= trim($this->input->post('invited'));
            $viewData['cellno'] = trim($this->input->post('cellno'));
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = ""; //trim($this->input->post('city'));
            $viewData['skypeID'] = trim($this->input->post('skypeID'));
            $viewData['userType'] = 'GAMBIA';

            if ($this->form_validation->run() != FALSE) {
                $this->gatewaymodel->insertData($viewData);
                $this->sendEmailToUser($viewData);
                $this->sendEmailToAdmin($viewData);
                $viewData['msgType'] = 1; //1=su;2=fa
                $viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
            } else {
                $viewData['msgType'] = 2; //1=su;2=fa
                $viewData['msg'] = 'Please check the error(s) as below.';
            }
        }
        $viewData['cityArray'] = $this->city; /* Added by Ranajit Das 11-03-2015*/
        $this->load->view('prePhase/gambia', $viewData);
    }

    public function checkUniqueEmail() {
        $emailAddr = trim($this->input->post('emailAddr'));
        $cond_array = array('emailID' => $emailAddr);
        $tbl = 'userinfo';
        $status = $this->gatewaymodel->checkUniqueValue($tbl, $cond_array);
        if ($status >= 1) {
            $this->form_validation->set_message('checkUniqueEmail', 'This Email Address "' . $emailAddr . '" is already used.');
            return false;
        } else {
            return true;
        }
    }

    private function sendEmailToUser($data = array()) {
        $this->_to_email = $data['emailAddr'];
        $this->_subject = 'Signup Email of GBE GAMBIA';
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello ' . $data['name'] . ',</td></tr>
								<tr><td colspan="2">Thank you for sign up. 
									We will send login credentials to you.Here are all details of you as below.
									</td></tr>
								<tr><td width="25%">Name:</td><td width="75%">' . $data['name'] . '</td></tr>
                                <tr><td width="25%">Surname:</td><td width="75%">' . $data['surname'] . '</td></tr>
								<tr><td width="25%">Who Invited You:</td><td width="75%">' . $data['invited'] . '</td></tr>
								<tr><td width="25%">Tel,Mob,Cell:</td><td width="75%">' . $data['cellno'] . '</td></tr>
								<tr><td width="25%">Email Address:</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
								<tr><td width="25%">Skype Username:</td><td width="75%">' . $data['skypeID'] . '</td></tr>
								
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">globalblackenterprises.com</td></tr>
                           </table>';
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
    }

    private function sendEmailToAdmin($data = array()) {
        $this->_to_email = $this->_admin_email;
        $this->_subject = 'New Signup User of GBE GAMBIA';
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Admin,</td></tr>
								<tr><td colspan="2">Here is a new Sign up of Gambia user details.Here are all details of new user as below.</td></tr>
								<tr><td width="25%">Name:</td><td width="75%">' . $data['name'] . '</td></tr>
                                <tr><td width="25%">Surname:</td><td width="75%">' . $data['surname'] . '</td></tr>
								<tr><td width="25%">Who Invited You:</td><td width="75%">' . $data['invited'] . '</td></tr>
								<tr><td width="25%">Tel,Mob,Cell:</td><td width="75%">' . $data['cellno'] . '</td></tr>
								<tr><td width="25%">Email Address:</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
								<tr><td width="25%">Skype Username:</td><td width="75%">' . $data['skypeID'] . '</td></tr>
								
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">globalblackenterprises.com</td></tr>
                           </table>';
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
    }

    function send_mail_raw() {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
        $headers .= 'From: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\r\n";
        $headers .= 'Return-Path: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\n";
        $send = mail($this->_to_email, $this->_subject, $this->_message, $headers);
        if ($send) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function productUpload() {
        $this->load->model('data_model');
        $viewData = array();
        $viewData["productTypes"] = $this->data_model->getproductType();
        $viewData["vendorsList"] = $this->gatewaymodel->getVendorsList();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('productName', 'Product Name ', 'trim|required');
            $this->form_validation->set_rules('productDesc', 'Product Desc ', 'trim|required');
            $this->form_validation->set_rules('productPrice', 'Product Price', 'trim|required');
            if (!empty($_FILES['image']['name'])) {
                $fileName = $_FILES["image"]["name"];
                $fileTmpLoc = $_FILES["image"]["tmp_name"];
                $pathAndName = "adminuploads/productPagesImg" . DIRECTORY_SEPARATOR . $fileName;
                move_uploaded_file($fileTmpLoc, $pathAndName);
            }
            if (!empty($_FILES['image1']['name'])) {
                $fileName = $_FILES["image1"]["name"];
                $fileTmpLoc = $_FILES["image1"]["tmp_name"];
                $pathAndName = "adminuploads/productPagesImg" . DIRECTORY_SEPARATOR . $fileName;
                move_uploaded_file($fileTmpLoc, $pathAndName);
            }

            $viewData["productTypeID"] = trim($this->input->post('productType'));
            $viewData["vendorID"] = trim($this->input->post('vendorID'));
            $viewData["productName"] = trim($this->input->post('productName'));
            $viewData["productDesc"] = trim($this->input->post('productDesc'));
            $viewData["productCurrencyType"] = trim($this->input->post('productCurrencyType'));
            $viewData["productPrice"] = trim($this->input->post('productPrice'));
            $viewData["productStatus"] = trim($this->input->post('productStatus'));
            $viewData["productImage"] = $_FILES["image"]["name"];
            $viewData["productMusic"] = $_FILES['image1']['name'];
            $viewData["productColour"] = $this->input->post('colour');
            $viewData["productSize"] = $this->input->post('size');
            $viewData["productCommission"] = $this->input->post('productCommission');
            $viewData["productOffer"] = $this->input->post('productOffer');
            $viewData["productYoutube"] = $this->input->post('productYoutube');
            if (!empty($viewData["productColour"])) {
                $tempStrColour = "";
                foreach ($viewData["productColour"] as $valColour) {
                    if (trim($tempStrColour) == "") {
                        $tempStrColour = $valColour;
                    } else {
                        $tempStrColour .= "," . $valColour;
                    }
                }
                $viewData["productColourStrings"] = $tempStrColour;
            }
            if (!empty($viewData["productSize"])) {
                $tempStrSize = "";
                foreach ($viewData["productSize"] as $valSize) {
                    if (trim($tempStrSize) == "") {
                        $tempStrSize = $valSize;
                    } else {
                        $tempStrSize .= "," . $valSize;
                    }
                }
                $viewData["productSizeStrings"] = $tempStrSize;
            }
            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->data_model->insertProduct($viewData);
                if ($lastInsertId > 0) {
                    if (!empty($_FILES['SecondaryImg']['name'])) {
                        for ($i = 0; $i < count($_FILES['SecondaryImg']['name']); $i++) {
                            $secondaryFileName = $_FILES["SecondaryImg"]["name"][$i];
                            $secondaryFileTmpLoc = $_FILES["SecondaryImg"]["tmp_name"][$i];
                            $secondaryPathAndName = "adminuploads/productPagesImg" . DIRECTORY_SEPARATOR . $secondaryFileName;
                            if (move_uploaded_file($secondaryFileTmpLoc, $secondaryPathAndName)) {
                                $this->data_model->insertSecondaryProductImg($secondaryFileName, $lastInsertId);
                            }
                        }
                    }
                } else {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('prePhase/centoruProductUpload', $viewData);
    }

    public function _do_upload() {
        $image = $_FILES['image']['name'];
        $config['upload_path'] = "adminuploads/productPagesImg";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '5000';

        $field_name = 'image';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($field_name)) {
            $this->form_validation->set_message('_do_upload', $this->upload->display_errors());
            return FALSE;
        } else {
            $this->filedata = $this->upload->data();
            $this->filedata = $this->resizeimg($image, 'adminuploads/productPagesImg' . DIRECTORY_SEPARATOR, '', '336', '305');

            return $this->filedata;
        }
    }

    public function listing() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('listingName', 'Listing Name', 'trim|required');
            /* $this->form_validation->set_rules('listingDesc','Listing Desc', 'trim|required');
              $this->form_validation->set_rules('listingAddr','Listing Address', 'trim|required');
              $this->form_validation->set_rules('listingNo','Listing Number', 'trim|required');
              $this->form_validation->set_rules('listingWebsite','Listing Website', 'trim|required'); */
            if (!empty($_FILES['image']['name'])) {
                $fileName = $_FILES["image"]["name"];
                $fileTmpLoc = $_FILES["image"]["tmp_name"];
                $pathAndName = "adminuploads/listingImg" . DIRECTORY_SEPARATOR . $fileName;
                move_uploaded_file($fileTmpLoc, $pathAndName);
            }
            $viewData["listingName"] = trim($this->input->post('listingName'));
            $viewData["listingDesc"] = trim($this->input->post('listingDesc'));
            $viewData["listingAddr"] = trim($this->input->post('listingAddr'));
            $viewData["listingNo"] = trim($this->input->post('listingNo'));
            $viewData["listingWebsite"] = trim($this->input->post('listingWebsite'));
            $viewData["listingUrl"] = trim($this->input->post('listingUrl'));
            $viewData["listingImage"] = $_FILES["image"]["name"];
            $viewData["listingUrls"] = $this->input->post('listingUrls');

            $viewData["listingCountry"] = $this->input->post('listingCountry');
            $viewData["listingState"] = "";
            $viewData["listingCity"] = $this->input->post('listingCity');

            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->gatewaymodel->insertListing($viewData);
                if ($lastInsertId > 0) {
                    if (!empty($viewData["listingUrls"])) {
                        $this->gatewaymodel->insertListingUrls($viewData["listingUrls"], $lastInsertId);
                    }
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('prePhase/centoruListing.php', $viewData);
    }

    public function vendors() {
        $viewData = array();
        if (trim($this->input->post('submit'))) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('vendorName', 'Vendor Name', 'trim|required');
            $this->form_validation->set_rules('vendorNo', 'VendorNo', 'trim|required');
            $this->form_validation->set_rules('vendorAddr', 'Vendor Address', 'trim|required');
            $this->form_validation->set_rules('vendorCity', 'Vendor City', 'trim|required');
            $this->form_validation->set_rules('vendorCountry', 'Vendor Country', 'trim|required');
            $this->form_validation->set_rules('vendorZip', 'Vendor Zip', 'trim|required');
            $this->form_validation->set_rules('vendorEmail', 'Vendor Email', 'trim|required');
            $this->form_validation->set_rules('vendorWebsite', 'Vendor Website', 'trim|required');

            $viewData["vendorName"] = trim($this->input->post('vendorName'));
            $viewData["vendorNo"] = trim($this->input->post('vendorNo'));
            $viewData["vendorAddr"] = trim($this->input->post('vendorAddr'));
            $viewData["vendorCity"] = trim($this->input->post('vendorCity'));
            $viewData["vendorCountry"] = trim($this->input->post('vendorCountry'));
            $viewData["vendorZip"] = trim($this->input->post('vendorZip'));
            $viewData["vendorEmail"] = trim($this->input->post('vendorEmail'));
            $viewData["vendorWebsite"] = trim($this->input->post('vendorWebsite'));
            if ($this->form_validation->run() != FALSE) {
                $lastInsertId = $this->gatewaymodel->insertVendors($viewData);
                if ($lastInsertId < 0) {
                    $viewData['errorMsg'] = 'Your data has not been inserted.';
                }
            } else {
                $viewData['errorMsg'] = 'Please check the error(s) below.';
            }
        }
        $this->load->view('prePhase/centoruVendors', $viewData);
    }

}
