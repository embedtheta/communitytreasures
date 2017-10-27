<?php
/*
Created by Ranajit Das  
*/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Signup extends CI_Controller {

    private $_from_email = "";
    private $_from_name = "";
    private $_admin_email = "";
    private $_message = "";
    private $_subject = "";
    private $_to_email = "";
    public $sign_up_user_type;
    public $city;

    function __construct() {
        parent::__construct();
        $this->_from_email = "otizfangel@gmail.com";
        $this->_from_name = "globalblackenterprises.com";
        $this->_admin_email = "otizfangel@gmail.com";
        $this->load->model('gatewaymodel');
        $this->sign_up_user_type = '';
        $this->city = $this->gatewaymodel->getCity();
        /* if(trim($this->session->userdata('UserId'))!=""){
          if($_REQUEST["actionLog"] == ""){
          redirect(base_url().'dashboard/', 'refresh');
          }
          } */
    }

    public function index() {
        redirect(base_url() . "signup/mentorship");
    }
    
    public function head_volunteers($parentID = 0) {
        $this->sign_up_user_type = "HEAD VOLUNTEERS";
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
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            //$viewData['invited']					= trim($this->input->post('invited'));
            $viewData['cellno'] = trim($this->input->post('cellno'));
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = trim($this->input->post('city'));
            $viewData['skypeID'] = trim($this->input->post('skypeID'));
            $viewData['userType'] = $this->sign_up_user_type;
            $viewData['password'] = '';//$this->generatePassword();

            if ($this->form_validation->run() != FALSE) {
                $this->gatewaymodel->insertData($viewData);
                $this->sendEmailToHeadVolunteer($viewData, 'Signup Email of GBE ' . $this->sign_up_user_type);
                $this->sendEmailToAdmin($viewData, 'New Signup of GBE ' . $this->sign_up_user_type);
                $viewData = $this->resetValueAfterSuccess();
                $viewData['msgType'] = 1; //1=su;2=fa
                $viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
            } else {
                $viewData['msgType'] = 2; //1=su;2=fa
                $viewData['msg'] = 'Please check the error(s) as below.';
            }
        }
        $viewData['cityArray'] = $this->city;
        $this->load->view('signup/head_volunteers', $viewData);
    }

    public function volunteers($parentID = 0) {
        $this->sign_up_user_type = "VOLUNTEERS";
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
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            //$viewData['invited']					= trim($this->input->post('invited'));
            $viewData['cellno'] = trim($this->input->post('cellno'));
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = trim($this->input->post('city'));
            $viewData['skypeID'] = trim($this->input->post('skypeID'));
            $viewData['userType'] = $this->sign_up_user_type;
            $viewData['password'] = '';//$this->generatePassword();

            if ($this->form_validation->run() != FALSE) {
                $this->gatewaymodel->insertData($viewData);
                $this->sendEmailToVolunteer($viewData, 'Signup Email of GBE ' . $this->sign_up_user_type);
                $this->sendEmailToAdmin($viewData, 'New Signup of GBE ' . $this->sign_up_user_type);
                $viewData = $this->resetValueAfterSuccess();
                $viewData['msgType'] = 1; //1=su;2=fa
                $viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
            } else {
                $viewData['msgType'] = 2; //1=su;2=fa
                $viewData['msg'] = 'Please check the error(s) as below.';
            }
        }
        $viewData['cityArray'] = $this->city;
        $this->load->view('signup/volunteers', $viewData);
    }

    public function student($parentID = 0) {
        $this->sign_up_user_type = "STUDENT";
        $viewData = array();
        $viewData['city'] = 3;
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
        //echo $viewData["parentID"];
        if ($this->input->post('submit')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            //$this->form_validation->set_rules('invited','Who Invited You', 'trim|required');
            $this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
            $this->form_validation->set_rules('skypeID', 'Skype Id', 'trim|required');
            //$this->form_validation->set_rules('city', 'City', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            //$viewData['invited']					= trim($this->input->post('invited'));
            $viewData['cellno'] = trim($this->input->post('cellno'));
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = 3;//trim($this->input->post('city'));
            $viewData['skypeID'] = trim($this->input->post('skypeID'));
            $viewData['userType'] = $this->sign_up_user_type;
            $viewData['password'] = '';//$this->generatePassword();

            if ($this->form_validation->run() != FALSE) {
                $this->gatewaymodel->insertData($viewData);
                $this->sendEmailToStudent($viewData, 'Signup Email of GBE ' . $this->sign_up_user_type);
                $this->sendEmailToAdmin($viewData, 'New Signup of GBE ' . $this->sign_up_user_type);
                $viewData = $this->resetValueAfterSuccess();
                $viewData['msgType'] = 1; //1=su;2=fa
                $viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
            } else {
                $viewData['msgType'] = 2; //1=su;2=fa
                $viewData['msg'] = 'Please check the error(s) as below.';
            }
        }
        $viewData['cityArray'] = $this->city;
        $this->load->view('signup/student', $viewData);
    }
    
    public function teachers(){
        $this->sign_up_user_type = "TEACHER";
        $viewData = array();
        $viewData['city'] = 3;
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
            //$this->form_validation->set_rules('city', 'City', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            //$viewData['invited']					= trim($this->input->post('invited'));
            $viewData['cellno'] = trim($this->input->post('cellno'));
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = 3;//trim($this->input->post('city'));
            $viewData['skypeID'] = trim($this->input->post('skypeID'));
            $viewData['userType'] = $this->sign_up_user_type;
            $viewData['password'] = '';//$this->generatePassword();

            if ($this->form_validation->run() != FALSE) {
                $this->gatewaymodel->insertData($viewData);
                $this->sendEmailToTeacher($viewData, 'Signup Email of GBE ' . $this->sign_up_user_type);
                $this->sendEmailToAdmin($viewData, 'New Signup of GBE ' . $this->sign_up_user_type);
                $viewData = $this->resetValueAfterSuccess();
                $viewData['msgType'] = 1; //1=su;2=fa
                $viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
            } else {
                $viewData['msgType'] = 2; //1=su;2=fa
                $viewData['msg'] = 'Please check the error(s) as below.';
            }
        }
        $viewData['cityArray'] = $this->city;
        $this->load->view('signup/teachers', $viewData);
    }

    public function business($parentID = 0) {
        $this->sign_up_user_type = "PAYING USER";
        $generalUserType = "business";
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
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            //$viewData['invited']					= trim($this->input->post('invited'));
            $viewData['cellno'] = trim($this->input->post('cellno'));
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = trim($this->input->post('city'));
            $viewData['skypeID'] = trim($this->input->post('skypeID'));
            $viewData['userType'] = $this->sign_up_user_type;
            $viewData['password'] = '';//$this->generatePassword();
            //print_r($viewData);
            if ($this->form_validation->run() != FALSE) {
                $signupId = $this->gatewaymodel->insertData($viewData);
                $this->insertGeneralUserType($signupId,$generalUserType);
                $this->sendEmailToUser($viewData, 'Signup Email of GBE ' . ucwords($generalUserType) .' User');
                $this->sendEmailToAdmin($viewData, 'New Signup of GBE ' . ucwords($generalUserType).' User');
                $viewData = $this->resetValueAfterSuccess();
                $viewData['msgType'] = 1; //1=su;2=fa
                $viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
            } else {
                $viewData['msgType'] = 2; //1=su;2=fa
                $viewData['msg'] = 'Please check the error(s) as below.';
            }
        }
        $viewData['cityArray'] = $this->city;
        $this->load->view('signup/business', $viewData);
    }

    public function communities($parentID = 0) {
        $this->sign_up_user_type = "PAYING USER";
        $generalUserType = "community";
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
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            //$viewData['invited']					= trim($this->input->post('invited'));
            $viewData['cellno'] = trim($this->input->post('cellno'));
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = trim($this->input->post('city'));
            $viewData['skypeID'] = trim($this->input->post('skypeID'));
            $viewData['userType'] = $this->sign_up_user_type;
            $viewData['password'] = '';//$this->generatePassword();

            if ($this->form_validation->run() != FALSE) {
                $signupId = $this->gatewaymodel->insertData($viewData);
                $this->insertGeneralUserType($signupId,$generalUserType);
                $this->sendEmailToUser($viewData, 'Signup Email of GBE '  . ucwords($generalUserType) .' User');
                $this->sendEmailToAdmin($viewData, 'New Signup of GBE '  . ucwords($generalUserType) .' User');
                $viewData = $this->resetValueAfterSuccess();
                $viewData['msgType'] = 1; //1=su;2=fa
                $viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
            } else {
                $viewData['msgType'] = 2; //1=su;2=fa
                $viewData['msg'] = 'Please check the error(s) as below.';
            }
        }
        $viewData['cityArray'] = $this->city;
        $this->load->view('signup/comunities', $viewData);
    }
    
    public function mentorship($parentID = 0) {
        //$this->sign_up_user_type = "MENTORSHIP";
        $this->sign_up_user_type = "PAYING USER";
        $generalUserType = "mentorship";
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
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            //$viewData['invited']					= trim($this->input->post('invited'));
            $viewData['cellno'] = trim($this->input->post('cellno'));
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = trim($this->input->post('city'));
            $viewData['skypeID'] = trim($this->input->post('skypeID'));
            $viewData['userType'] = $this->sign_up_user_type;
            $viewData['password'] = '';//$this->generatePassword();

            if ($this->form_validation->run() != FALSE) {
                $signupId = $this->gatewaymodel->insertData($viewData);
                $this->insertGeneralUserType($signupId,$generalUserType);
                $this->sendEmailToUser($viewData, 'Signup Email of GBE ' . ucwords($generalUserType) .' User');
                $this->sendEmailToAdmin($viewData, 'New Signup of GBE ' . ucwords($generalUserType) .' User');
                $viewData = $this->resetValueAfterSuccess();
                $viewData['msgType'] = 1; //1=su;2=fa
                $viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
            } else {
                $viewData['msgType'] = 2; //1=su;2=fa
                $viewData['msg'] = 'Please check the error(s) as below.';
            }
        }
        $viewData['cityArray'] = $this->city;
        $this->load->view('signup/mentorship', $viewData);
    }
    
    public function talented($parentID = 0) {
        $this->sign_up_user_type = "PAYING USER";
        $generalUserType = "talented";
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
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            //$viewData['invited']					= trim($this->input->post('invited'));
            $viewData['cellno'] = trim($this->input->post('cellno'));
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = trim($this->input->post('city'));
            $viewData['skypeID'] = trim($this->input->post('skypeID'));
            $viewData['userType'] = $this->sign_up_user_type;
            $viewData['password'] = '';//$this->generatePassword();

            if ($this->form_validation->run() != FALSE) {
                $signupId = $this->gatewaymodel->insertData($viewData);
                $this->insertGeneralUserType($signupId,$generalUserType);
                $this->sendEmailToUser($viewData, 'Signup Email of GBE ' . ucwords($generalUserType) .' User');
                $this->sendEmailToAdmin($viewData, 'New Signup of GBE ' . ucwords($generalUserType) .' User');
                $viewData = $this->resetValueAfterSuccess();
                $viewData['msgType'] = 1; //1=su;2=fa
                $viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
            } else {
                $viewData['msgType'] = 2; //1=su;2=fa
                $viewData['msg'] = 'Please check the error(s) as below.';
            }
        }
        $viewData['cityArray'] = $this->city;
        $this->load->view('signup/talented', $viewData);
    }

    public function health($parentID = 0) {
        //$this->sign_up_user_type = "HEALTH";
        $this->sign_up_user_type = "PAYING USER";
        $generalUserType = "health";
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
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            //$viewData['invited']					= trim($this->input->post('invited'));
            $viewData['cellno'] = trim($this->input->post('cellno'));
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
            $viewData['city'] = trim($this->input->post('city'));
            $viewData['skypeID'] = trim($this->input->post('skypeID'));
            $viewData['userType'] = $this->sign_up_user_type;
            $viewData['password'] = '';//$this->generatePassword();

            if ($this->form_validation->run() != FALSE) {
                $signupId = $this->gatewaymodel->insertData($viewData);
                $this->insertGeneralUserType($signupId,$generalUserType);
                $this->sendEmailToUser($viewData, 'Signup Email of GBE ' . ucwords($generalUserType) .' User');
                $this->sendEmailToAdmin($viewData, 'New Signup of GBE ' . ucwords($generalUserType) .' User');
                $viewData = $this->resetValueAfterSuccess();
                $viewData['msgType'] = 1; //1=su;2=fa
                $viewData['msg'] = 'You have successfully done the Sign up.Please Go To Your Email for Instructions';
            } else {
                $viewData['msgType'] = 2; //1=su;2=fa
                $viewData['msg'] = 'Please check the error(s) as below.';
            }
        }
        $viewData['cityArray'] = $this->city;
        $this->load->view('signup/health', $viewData);
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

    private function sendEmailToUser($data = array(), $sub = "GBE") {
        $tbl = "city";
        $where["id"] = $data['city'];
        $selectedData = "";
        $city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData); 
    
        $this->_to_email = $data['emailAddr'];
        $this->_subject = $sub;
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello ' . $data['name'] . ',</td></tr>
								<tr><td colspan="2">Thank you for sign up. 
									Here are all of your details with login credentials as below.
									</td></tr>
								<tr><td width="25%">Name:</td><td width="75%">' . $data['name'] . '</td></tr>
                                <tr><td width="25%">Surname:</td><td width="75%">' . $data['surname'] . '</td></tr>
								
								<tr><td width="25%">Tel,Mob,Cell:</td><td width="75%">' . $data['cellno'] . '</td></tr>
								<tr><td width="25%">Email Address:</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
                                                                
								<tr><td width="25%">Skype Username:</td><td width="75%">' . $data['skypeID'] . '</td></tr>
                                                                    <tr><td width="25%">City:</td><td width="75%">' . $city[0]->city . '</td></tr>
								
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

    private function sendEmailToAdmin($data = array(), $sub = "New Signup of GBE") {
        $tbl = "city";
        $where["id"] = $data['city'];
        $selectedData = "";
        $city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData);
        
        $this->_to_email = $this->_admin_email;
        $this->_subject = $sub;
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Admin,</td></tr>
								<tr><td colspan="2">Here is a new Sign up of Gambia user details.Here are all details of new user as below.</td></tr>
								<tr><td width="25%">Name:</td><td width="75%">' . $data['name'] . '</td></tr>
                                <tr><td width="25%">Surname:</td><td width="75%">' . $data['surname'] . '</td></tr>
								
								<tr><td width="25%">Tel,Mob,Cell:</td><td width="75%">' . $data['cellno'] . '</td></tr>
								<tr><td width="25%">Email Address:</td><td width="75%">' . $data['emailAddr'] . '</td></tr>
								<tr><td width="25%">Skype Username:</td><td width="75%">' . $data['skypeID'] . '</td></tr>
                                                                    <tr><td width="25%">City:</td><td width="75%">' . $city[0]->city . '</td></tr>
								
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

    private function generatePassword() {
        $string = mt_rand();
        $start = 1;
        $length = 8;
        $code = substr($string, $start, $length);
        $code = "GBE" . $code;
        return $code;
    }

    public function resetValueAfterSuccess() {
        $viewData['name'] = "";
        $viewData['surname'] = "";
        $viewData['cellno'] = "";
        $viewData['emailAddr'] = "";
        $viewData['city'] = "";
        $viewData['skypeID'] = "";
        $viewData['userType'] = "";
        $viewData['password'] = "";
        return $viewData;
    }
    
    public function cr(){
        $this->gatewaymodel->createRoute();
        echo "success";
    }
    
    public function html(){
        $this->load->view('signup/html');
    }
    
    public function sendEmailToStudent($data = array(), $sub = "GBE") {
        $tbl = "city";
        $where["id"] = $data['city'];
        $selectedData = "";
        $city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData); 
    
        $this->_to_email = $data['emailAddr'];
        $this->_subject = "Join GBE Today - Make Money Online";
        $this->_message = '<div class="bdy_sec">
            <div id="wrap">
              <div class="bdy_lft">
                <div class="bdy_right">
                  <div class="signup sign_pg">
                    <p ALIGN="CENTER">Thank You For Applying To Become A Student Of GBE Gambia.</p>
                    <p ALIGN="CENTER"><strong>To Join Us</strong> </p>
                    <p ALIGN="CENTER"><strong>YOU MUST ALREADY HAVE FACEBOOK</strong></p>
                    <p ALIGN="CENTER">AND BE ON IT REGULARLY</p>
                    <p ALIGN="CENTER">Our Presentation is near</p>
                    <p ALIGN="CENTER"><strong>Kerrserign New Highway</strong></p>
                    <p ALIGN="CENTER">Close to Kerrserign Garage on the way to Sukuta</p>
                    <p ALIGN="CENTER">To arrange an interview and presentation </p>
                    <p ALIGN="CENTER"><strong>Call Us Now on:</strong></p>
                    <p ALIGN="CENTER">Beris -  2685772   /    Sheriffo – 7962235    /      Nabieu - 7935084/ 9911238</p>
                    <p ALIGN="CENTER"><strong>When You come for your interview dress Professional, Clean and Tidy.</strong></p>
                    <p ALIGN="CENTER">If you are willing to patiently build your business, if you are motivated and <p> 
                    <p ALIGN="CENTER">100% committed to completing this course then you will be able to join GBE.<p> 
                    <p ALIGN="CENTER">You must be able to read and write in English<p>
                    <p ALIGN="CENTER">This is Your Chance of Success!</p>
                    <p ALIGN="CENTER">If you are chosen, We will teach you how to use our system and make Money using</p>
                    <p ALIGN="CENTER">Facebook.</p>
                    <p ALIGN="CENTER">Take a large step towards a brighter future for you and your family.</p>
                    <p ALIGN="CENTER">Your Interview will be:</p>
                     <p ALIGN="CENTER">2pm – 5pm    Or       5pm - 8pm</p>
                    <p ALIGN="CENTER"><strong>Make sure you arrive on time.</strong></p>
                    <p ALIGN="CENTER">This presentation will take 2 hours – so don\'t book anything else around that time.</p>
                    <p ALIGN="CENTER">See  You Soon.</p>
                    <p ALIGN="CENTER">Thank you very much.</p>
                    <p ALIGN="CENTER">globalblackenterprises.com</p>
                  </div>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>';
        
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
    }
	
	
	
    
    public function sendEmailToVolunteer($data = array(), $sub = "GBE") {
        $tbl = "city";
        $where["id"] = $data['city'];
        $selectedData = "";
        $city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData); 
    
        $this->_to_email = $data['emailAddr'];
        $this->_subject = "Join GBE Volunteers Today";
        $this->_message = '<div class="bdy_sec">
            <div id="wrap">
              <div class="bdy_lft">
                <div class="bdy_right">
                  <div class="signup sign_pg">
                    <p ALIGN="CENTER">Thank You For Applying To Become A GBE Volunteer.</p>
                    <p ALIGN="CENTER">By donating just 4 hours per week You will help develop Black communities </p>
                    <p ALIGN="CENTER">making them healthier, Safer and wealthier.</p>
                    <p ALIGN="CENTER"><strong>We Invite You To Meet Us </strong></p>
                    <p ALIGN="CENTER">for a presentation </p>
                    <p ALIGN="CENTER"><strong>This Tuesday at 6.30pm</strong></p>
                    <p ALIGN="CENTER"><strong>MLB, Suite 31</strong></p>
                    <p ALIGN="CENTER"><strong>The Enterprise Centre</strong></p>
                    <p ALIGN="CENTER"><strong>639 High Road, Tottenham N17 8AA</strong></p>
                    <p ALIGN="CENTER">To confirm please call us now on:</p>
                    <p ALIGN="CENTER">07481 244501</p>
                    <p ALIGN="CENTER">Lets \'Move As One\' to make a brighter future for our families and ourselves .</p>
                    <p ALIGN="CENTER"><strong>Please arrive on time.</strong></p>
                    <p ALIGN="CENTER">This presentation will take 2 hours – so don\'t book anything else around that time.</p>
                    <p ALIGN="CENTER">See  You Soon.</p>
                    <p ALIGN="CENTER">Thank you very much.</p>
                    <p ALIGN="CENTER">globalblackenterprises.com</p>
                  </div>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>';
        
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
    }
    
    public function sendEmailToHeadVolunteer($data = array(), $sub = "GBE") {
        $tbl = "city";
        $where["id"] = $data['city'];
        $selectedData = "";
        $city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData); 
    
        $this->_to_email = $data['emailAddr'];
        $this->_subject = "Promotion To GBE Head Volunteer";
        $this->_message = '<div class="bdy_sec">
            <div id="wrap">
              <div class="bdy_lft">
                <div class="bdy_right">
                  <div class="signup sign_pg">
                    <p ALIGN="CENTER">Thank You for Registering.</p>
                    <p ALIGN="CENTER">This area is restricted to Head Volunteers Only.</p>
                    <p ALIGN="CENTER">You have been given the honourable position of  Captain to lead a Volunteer team.</p>
                    <p ALIGN="CENTER">Remember to be loyal, </p>
                    <p ALIGN="CENTER">be motivated and be committed to the success of others</p>
                    <p ALIGN="CENTER">while being committed to the success of yourself.</p>
                    <p ALIGN="CENTER">We are a Meritocracy, So, We are watching.</p>
                    <p ALIGN="CENTER">The better you lead your team, the higher you will go in this organisation.</p>
                    <p ALIGN="CENTER">Teach them how to \'Move As One\'.</p>
                    <p ALIGN="CENTER">Be the Best You Can Be.</p>
                    <p ALIGN="CENTER">We Are GBE.</p>
                    <p ALIGN="CENTER">An email will be sent to You giving you access into your </p>
                    <p ALIGN="CENTER"><strong>Head Volunteer account.</strong></p>
                    <p ALIGN="CENTER">See You Soon.</p>
                    <p ALIGN="CENTER">Thank you very much.</p>
                    <p ALIGN="CENTER">globalblackenterprises.com</p>
                  </div>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>';
        
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
    }
    
    public function sendEmailToTeacher($data = array(), $sub = "GBE") {
        $tbl = "city";
        $where["id"] = $data['city'];
        $selectedData = "";
        $city = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData); 
    
        $this->_to_email = $data['emailAddr'];
        $this->_subject = "Promotion To GBE Teacher";
        $this->_message = '<div class="bdy_sec">
            <div id="wrap">
              <div class="bdy_lft">
                <div class="bdy_right">
                  <div class="signup sign_pg">
                    <p ALIGN="CENTER">Thank You for Registering.</p>
                    <p ALIGN="CENTER">This area is restricted to GBE Online Teachers Only.</p>
                    <p ALIGN="CENTER">You have been given the honourable position of Online Teacher to lead a class of Students.</p>
                    <p ALIGN="CENTER">Remember to be loyal, </p>
                    <p ALIGN="CENTER">be motivated and be committed to the success of others </p>
                    <p ALIGN="CENTER">while being committed to the success of yourself.</p>
                    <p ALIGN="CENTER">We are a Meritocracy, So, We are watching.</p>
                    <p ALIGN="CENTER">The better you lead your team, the higher you will go in this organisation.</p>
                    <p ALIGN="CENTER">Teach them how to \'Move As One\'.</p>
                    <p ALIGN="CENTER">Be the Best You Can Be.</p>
                    <p ALIGN="CENTER">We Are GBE.</p>
                    <p ALIGN="CENTER">An email will be sent to You giving you access into your </p>
                    <p ALIGN="CENTER"><strong>Teacher account.</strong></p>
                    <p ALIGN="CENTER">See You Soon.</p>
                    <p ALIGN="CENTER">Thank you very much.</p>
                    <p ALIGN="CENTER">globalblackenterprises.com</p>
                  </div>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>';
        
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
    }
	
	
	 
	
    
    public function insertGeneralUserType($signupId,$generalUserType){
        $tbl = "user_general_type";
        $data['user_id'] = $signupId;
        $data['user_general_type_name'] = $generalUserType;
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
    }
	
	
	public function sendEmailTest() {
        
        $this->_to_email = 'graphicsom@gmail.com';
        $this->_subject = "Join GBE Today - Make Money Online";
        $this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
  <p>Hello   Name</p>
  <p>Below is your username and password to  enter your Teachers Account.<br />
    Now you can Start to build your GBE  Business and make money.<br />
    You can change your password once you are  inside your account.</p>
  <p>Remember This is Your Moment! <br />
    Recruit and Teach as many Students as  possible.<br />
    Your Target should be 50 Students or more  in Your Online Class.<br />
    Good Luck.</p>
  <p style="font-size:14px;">Here is your  login credentials </p>
  <p>Username:     gjhjfgg</p>
  <p>Password:     kfhgkhgh</p>
<a href="">Click here to login</a></div>';
        
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
    }
	
	
}















