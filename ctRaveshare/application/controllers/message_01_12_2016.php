<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends CI_Controller {
    private $_from_email;
    private $_from_name;
    private $_admin_email;
    private $_to_email;
    private $_subject;
    private $_message;
    //public $city;
	public $country;
	public $userId;
	public $referarId;
	public $userType;
	public $forWebsite;// added by SB on 13/10/2015
	public $mssPayStatus;//29/10/2015 us 
	
    function __construct() {
        parent::__construct();
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'viplogin/', 'refresh'); // change by SB on 09/06/2016
        }
		$this->userId = trim($this->session->userdata('userId'));
		$this->referarId = trim($this->session->userdata('referarId'));
		$this->userType = trim($this->session->userdata('userType'));
        $this->_from_email = "admin@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "admin@communitytreasures.co";//"blessings.jain@globalblackenterprises.com";
		$this->load->model('gatewaymodel');
		$this->load->model('message_model');
		//$this->city = $this->gatewaymodel->getCity();
		$this->country = $this->common_model->getCustomCountryList();
		$this->forWebsite = 2;//trim($this->session->userdata('forWebsite'));// added by SB on 13/10/2015
		$this->mssPayStatus = trim($this->session->userdata('mssPayStatus'));
    }
	
    public function index() {
        $viewData = array();
		$viewData["tabhide"] = 0;
        $viewData["msg"] = "";
		$viewData["status"] = "";//error
        if($this->referarId == 0 || $this->referarId == '') {
            $viewData["parentInfo"] = $this->message_model->getUserInfo(1076); // function call from message_model
        }else{
            $viewData["parentInfo"] = $this->message_model->getUserInfo($this->referarId);
        }
		
		if ($this->input->post('submit')) {
			$retData = $this->addMassUser();
			$viewData["msg"] = $retData["msg"];
			$viewData["status"] = $retData["status"];
        	$viewData["type"] = 'MASS';
		}
		$viewData['countDay'] = $this->getDayDiff();
        $viewData["userInfo"] = $this->message_model->getUserInfo($this->userId);
		//echo "++".$this->userType;
		//$viewData["massDetails"] = $this->makingMassView();//$this->message_model->getAllMassUser($this->userId,$this->userType);
		/*echo "<pre>";
                  print_r($viewData["userInfo"]);
                  echo "</pre>";*/
        $myLevel = $viewData["userInfo"][0]['userLevel'];
        $allAccountDetail = $this->gatewaymodel->myAccountDetail($this->userId,$myLevel);
		$myCycle  = $allAccountDetail[0]['userCycle'];
        $current_user_array = array(array('userId'=>$this->userId,'myCycle'=>$myCycle));
		$MyOldUserIdLists = $this->gatewaymodel->getUserLists($current_user_array,$this->userId);
		$cycle = array();
		foreach ($MyOldUserIdLists as $key => $row)
		{
		    $cycle[$key] = $row['myCycle'];
		}
		array_multisort($cycle, SORT_ASC, $MyOldUserIdLists);
		$viewData['MyOldUserIdLists'] = $MyOldUserIdLists;
		foreach($MyOldUserIdLists as $key=>$val){
			$userId = $val['userId'];
			$myCycle = $val['myCycle'];
		$viewData["massDetails"][$myCycle] = $this->myRefCycleView($userId);
        }

		//print_r($viewData["massDetails"]);
		$viewData['massLoginUserDetails'] = '';//$this->message_model->getUserDetails($this->userId);
		$viewData['sendMassUserCount'] = 0;
		$viewData['sendMassUserLevel'] = 0;
		$viewData['totalUserUnderMassUser'] = 0;
		$viewData["stepWiseVideo"] = $this->gatewaymodel->getLevelStepVideo(8);
		//print_r($viewData["stepWiseVideo"]);
		// fetch page text of user added by SB on 13/10/2015
		$tbl = "gbe_page_text_for_user";
		$where = array("user_id" => trim($this->userId));
		$selectedData = 'page_text';
		$pageTextDetail = $this->common_model->fetchDataFromTable($tbl, $where, $selectedData);
		unset($tbl);		
		$viewData['page_text'] = $pageTextDetail[0]->page_text;
		/* if($this->userType != "ADMIN"){
			$totalMassCount = $this->message_model->getTotalMassUser($this->userId,$viewData["userInfo"][0]['userLevel']);
			if($totalMassCount == 5){//this shoule be 5
				$viewData['sendMassUserCount'] = 1;	
			}
			$viewData['totalUserUnderMassUser'] = $this->message_model->totalMassCountUnderUser($this->userId);
			if($viewData["userInfo"][0]['userLevel'] == 1 && $viewData['totalUserUnderMassUser'] >= 5){//this shoule be 5
				$tbl = 'userinfo';
				$upData['userLevel'] = 2;
				//$upData['mssLevelUpPayment'] = 1;
				$where = array("uID"=>$this->userId);
				$this->common_model->updateDataToTable($tbl, $where, $upData);
			}
			$smul = $this->message_model->getMassUserLevel($this->userId);
			if($smul[0]->l1 != ''){
				$viewData['sendMassUserLevel'] = 1;
			}
		} */
		$viewData['mssPayStatus']=$this->mssPayStatus;//29/10/2015 us added
		$viewData['category'] = $this->message_model->getCategory();// added by SB on 10-06-2016
		//print_r($viewData['category']);
		$viewData['userType'] = $this->userType;
		//$viewData['city'] = $this->city;
		$viewData['country'] = $this->country;
       	$this->load->view('message/index',$viewData);
		unset($viewData);
    }
	
	public function makingMassView(){
		//$result = $this->message_model->getAllMassUser($this->userId);
		$result = $this->message_model->getAllVipMassUser($this->userId);
		$retData = array();
		if(count($result) > 0){
			foreach($result as $rd){
				if($rd->login!=0){
				$retData[$rd->user_id][$rd->to_user_id]['user_id'] = $rd->uID;
				$retData[$rd->user_id][$rd->to_user_id]['cuFName'] = $rd->cuFName;
				$retData[$rd->user_id][$rd->to_user_id]['cuLName'] = $rd->cuLName;
				$retData[$rd->user_id][$rd->to_user_id]['cuEmail'] = $rd->cuEmail;
				$retData[$rd->user_id][$rd->to_user_id]['cuPhone'] = $rd->cuPhone;
				$retData[$rd->user_id][$rd->to_user_id]['created_date'] = $rd->created_date;
				$retData[$rd->user_id][$rd->to_user_id]['city'] = $rd->city;
				}
			}
		}
		return $retData;
	}
	
	public function addMassUser(){
		$retData['status'] = 'error';
		$retData['msg'] = '';
		/*if($this->userType == 'ADMIN'){
			$sign_up_user_type = 'HEAD VOLUNTEERS';
		}else if($this->userType == 'HEAD VOLUNTEERS'){
        	$sign_up_user_type = 'VOLUNTEERS';
		}else{
			$sign_up_user_type = 'VOLUNTEERS';
		}*/
		$sign_up_user_type = trim($this->input->post('userType'));
		if($sign_up_user_type=="Founder"){
			$myType = "FOUNDERS";
		}
		else if($sign_up_user_type=="Industry_Leader"){
			$myType = "INDUSTRY LEADER";
		}
		else{
			$myType = "PAYING USER";
		}
       // $generalUserType = "general";
        $viewData = array();
        

        if ($this->input->post('submit')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('emailAddr', 'Email', 'trim|required|valid_email|callback_checkUniqueEmail');
           // $this->form_validation->set_rules('category', 'Category', 'trim|required');
			//$this->form_validation->set_rules('city', 'City', 'trim|required'); 
			$this->form_validation->set_rules('country', 'Country', 'trim|required'); 			
			//$this->form_validation->set_rules('message', 'Message', 'trim|required');// not required by SB on 23/08/2016
            $viewData['name'] = trim($this->input->post('name'));
            $viewData['surname'] = trim($this->input->post('surname'));
            $viewData['cellno'] = '';
            $viewData['emailAddr'] = trim($this->input->post('emailAddr'));
           // $viewData['city'] = trim($this->input->post('city'));
            $viewData['country'] = trim($this->input->post('country'));
			$viewData['status'] = '0';// set status 0 When user login to rave change this status to 1
			$viewData['userType'] = $myType;
            $viewData['password'] = $this->generatePassword();
			$viewData['forWebsite']	=	$this->forWebsite; // added by SB on 13/10/2015
			$message = $this->input->post('message');
			$category = $this->input->post('category');
			
            if ($this->form_validation->run() != FALSE) {
				if($this->userType == 'ADMIN'){
					$viewData["parentID"] = $this->userId; //block by SB on 13/10/2015					
					$userLevel = 1; //added by SB on 13/10/2015
					$viewData['userLevel']=1;// added by SB on 24/08/2016
				}
				else{
					//-----------get volunteer parent id ,and volunteer level start ------------
					/* $volChildData = $this->selectParentVolunteer($viewData['city']);
					//print_r($volChildData); exit;
					if($volChildData['selectedParentId']!=""){//29/10/2015 sb added
						$viewData["parentID"]= $volChildData['selectedParentId'];
					}
					else{ */
						$viewData["parentID"]= $this->userId;
					/* }*/
					$userLevel = 1; 
					$viewData['userLevel']=1;//mass user level set to 1 as level 1 is free after adding 12 member , mass user can upgrade to level 2 added by ujjawal on 29/10/2015
					// ------get volunteer parent id ,and volunteer level  end------------------------
				}
				//$viewData['currency'] = $this->gatewaymodel->getCurrency(trim($this->input->post('city')));// get currency by city Added by SB on 20/07/2015
                $signupId = $this->message_model->insertData($viewData);// insert user to rave_userinfo
				//createCurrentAccount($signupId);// 0 balance account created added by SB on 20/07/2015
				/*if($this->userType != "ADMIN"){
                	$this->insertGeneralUserType($signupId,$generalUserType);
				}*/
				//$this->insertMssDetails($userLevel,$signupId,$message);// block by SB on 13/10/2015
				$this->insertVipMssDetails($userLevel,$signupId,$message,$category,$viewData["parentID"]); // add by SB on 10/06/2016
						
                $this->sendEmailToVipUser($signupId,$sign_up_user_type,$viewData['name'],$viewData['emailAddr']);// rave signup link
				$this->sendEmailToReferrer($signupId,$sign_up_user_type,$viewData['name'],trim($this->session->userdata('userId')));
				//$this->sendEmailToVipLogin($signupId);	// mail vip login credential // blocked by SB on 23/06/2016	
				//$this->sendEmailToUserCheck($signupId);
				$_POST['name']='';
				$_POST['surname']='';
				$_POST['emailAddr']='';
				$_POST['message']='';
                $retData['status'] = 'success';				
				$retData['msg'] = 'You Have Invited A Guest To Your VIP & Leadership Group.';
				
            } else {
				$retData['status'] = 'error';
                $retData['msg'] = 'Please check the error(s) as below.';
            }
        }
         return $retData;
	}
	
	public function sendEmailToUser($signupId){
		$details = $this->message_model->getUserDetails($signupId);
        $this->_to_email = $details[0]->cuEmail;
        $this->_subject = "V.I.P Entrance For My True 12 - Make Money Online";
        $this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
  <p style="font-size:14px;">Hello   '.$details[0]->cuFName.' '.$details[0]->cuLName.'</p>
  <p style="font-size:14px;">You have been given the gift of V.I.P entrance to the GBE wealth platform. This means you will be one of the first in this city to upload and list a product, service or talent onto Afrowebb. You will also financially benefit from this V.I.P software giving you a short cut to your success.</p>
  <p>Take Action</p>
  <p style="font-size:14px;">You will need to move fast to secure your extremely  privileged  position in our system because if  you remain dormant, this account will be closed and your  opportunity will pass.</p>
  <p>First,</p>
  <p style="font-size:14px;">Enter your GBE account, using the username and password below. Watch the first 4 videos so you can understand the business and the payment plan. Work with the person who has invited you to Turn your business, your brand, event, service into a product to be sold on the Afrowebb.</p>
   <p>Second,</p>
  <p style="font-size:14px;">As Black people, we must develop prosperous, safe and healthy communities. We, GBE believe , this can only be done once more of us are economically empowered and financially secure enough to help ourselves. This is one of the reasons why our wealth system was created. Your task is to enter using the "username and password" below then share the V.I.P entrance to help 12 sincere Black-owned enterprises, just as somebody shared this to help you.</p>
  
  <p style="font-size:14px;">Only by rising to the challenge of becoming wealthier as a community can we truly dedicate the time and acquire the resources to make any real positive change.</p>
  
  <p style="font-size:14px;">Third, Yet most importantly - PREPARE TO MOVE AS ONE.</p>
  
  <p style="font-size:14px;">On a specific date ,when your team leader  tells you  to, you must move up to level two. There will be no risk as the entire team around you will work as one unit ,allowing immediate profits to flow for each of the participants. </p>
  
  <p style="font-size:14px;"> Remember This is Your Moment!   Be Strong, Have Faith - Move As One & Together we will be financially Free. </p>
  
  <p style="font-size:14px;">Enter Now</p>
  
  <p style="font-size:14px;">Here are your login credentials</p>
  <p style="font-size:14px;">Username:     '.$details[0]->cuEmail.'</p>
  <p style="font-size:14px;">Password:     '.$details[0]->cupwd.'</p>
  <p style="font-size:14px;">Message:     '.$details[0]->message.'</p>
	<p style="font-size:14px;"><a href="'.base_url().'">Click here to login</a></p></div>';
        
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
	}
	
	public function sendEmailToUserCheck($signupId){
		$details = $this->message_model->getUserDetails($signupId);
        $this->_to_email = 'senabi.test01@gmail.com';//$details[0]->cuEmail;
        $this->_subject = "V.I.P Entrance For My True 12 - Make Money Online";
        $this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
  <p style="font-size:14px;">Hello   '.$details[0]->cuFName.' '.$details[0]->cuLName.'</p>
  <p style="font-size:14px;">You have been given the gift of V.I.P entrance to the GBE wealth platform. This means you will be one of the first in this city to upload and list a product, service or talent onto Afrowebb. You will also financially benefit from this V.I.P software giving you a short cut to your success.</p>
  <p>Take Action</p>
  <p style="font-size:14px;">You will need to move fast to secure your extremely  privileged  position in our system because if  you remain dormant, this account will be closed and your  opportunity will pass.</p>
  <p>First,</p>
  <p style="font-size:14px;">Enter your GBE account, using the username and password below. Watch the first 4 videos so you can understand the business and the payment plan. Work with the person who has invited you to Turn your business, your brand, event, service into a product to be sold on the Afrowebb.</p>
   <p>Second,</p>
  <p style="font-size:14px;">As Black people, we must develop prosperous, safe and healthy communities. We, GBE believe , this can only be done once more of us are economically empowered and financially secure enough to help ourselves. This is one of the reasons why our wealth system was created. Your task is to enter using the "username and password" below then share the V.I.P entrance to help 12 sincere Black-owned enterprises, just as somebody shared this to help you.</p>
  
  <p style="font-size:14px;">Only by rising to the challenge of becoming wealthier as a community can we truly dedicate the time and acquire the resources to make any real positive change.</p>
  
  <p style="font-size:14px;">Third, Yet most importantly - PREPARE TO MOVE AS ONE.</p>
  
  <p style="font-size:14px;">On a specific date ,when your team leader  tells you  to, you must move up to level two. There will be no risk as the entire team around you will work as one unit ,allowing immediate profits to flow for each of the participants. </p>
  
  <p style="font-size:14px;"> Remember This is Your Moment!   Be Strong, Have Faith - Move As One & Together we will be financially Free. </p>
  
  <p style="font-size:14px;">Enter Now</p>
  
  <p style="font-size:14px;">Here are your login credentials</p>
  <p style="font-size:14px;">Username:     '.$details[0]->cuEmail.'</p>
  <p style="font-size:14px;">Password:     '.$details[0]->cupwd.'</p>
  <p style="font-size:14px;">Message:     '.$details[0]->message.'</p>
	<p style="font-size:14px;"><a href="'.base_url().'">Click here to login</a></p></div>';
        
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
	}
	
	public function send_mail_raw() {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "Bcc:registration@communitytreasures.co,testingjust100@gmail.com"."\n"; //backup mail to Community Treasure id & Senabi Test Email Id on 22/08/2016
        //$headers .= "Bcc:testingjust100@gmail.com"."\n";
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
        $code = "ZXCV" . $code;
        return $code;
    }
	
	public function insertGeneralUserType($signupId,$generalUserType){
        $tbl = "user_general_type";
        $data['user_id'] = $signupId;
        $data['user_general_type_name'] = $generalUserType;
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
    }
	
	public function checkUniqueEmail() {
        $emailAddr = trim($this->input->post('emailAddr'));
        $cond_array = array('emailID' => $emailAddr);
        $tbl = 'rave_userinfo';// check in rave account for duplicate entry 
        $status = $this->gatewaymodel->checkUniqueValue($tbl, $cond_array);
        if ($status >= 1) {
            $this->form_validation->set_message('checkUniqueEmail', 'Email "' . $emailAddr . '" is already used.');
            return false;
        } else {
            return true;
        }
    }
	
	public function insertMssDetails($userLevel,$toUserId,$message){
		$tbl = "gbe_mass_details";
        $data['user_id'] = $this->userId;
        $data['user_level'] = $userLevel;
		$data['to_user_id'] = $toUserId;
        $data['message'] = $message;
		$data['created_date'] = date('Y-m-d H:i:s');
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
	}
	// added by SB on 13/10/2015
	public function insertMssDetailsNew($userLevel,$toUserId,$message,$parentId){
		$tbl = "gbe_mass_details";
        $data['user_id'] = $parentId;
        $data['user_level'] = $userLevel;
		$data['to_user_id'] = $toUserId;
        $data['message'] = $message;
		$data['created_date'] = date('Y-m-d H:i:s');
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
	}
	public function getDayDiff(){
		$retData = 0;
		if($this->userType != "ADMIN"){
			$retData = $this->message_model->getDayDiff($this->userId);
		}
		return $retData;
	}
	// function to get user_id of volunteer to add as parent for equal MMS volunteer distribution added by SB on 08-10-2015
	public function selectParentVolunteer($city){
		$volData = array();
		// check level 1 user having child or not 
		$levelOneVol = $this->message_model->volChildExits(1,$city);
		
		if($levelOneVol>0){
		// check level 1 volunteer  having child count less than 12 take 1
			$minUserChildCount = $this->message_model->volChildLessThanTwelve(1,$city); 
			//echo $minUserChildCount; exit;
			if($minUserChildCount>0){
							 
				$volData['selectedParentId'] =$minUserChildCount;
				$volData['volLevel']= 2;
				
			}else{
				
				// if all level 1 vol having child 12 each then check for level 2 vol
			
				$levelTwoVol = $this->message_model->volChildExits(2,$city);
				if($levelTwoVol>0){
			
					//check for level 2 volunteer having child count less than 12 take 1
					$minUserChildCount2 = $this->message_model->volChildLessThanTwelve(2,$city);
				
					if($minUserChildCount2>0){
					
						$volData['selectedParentId'] =$minUserChildCount2;
						$volData['volLevel']= 3;
						
						}else{
						
							// if all level 2 vol having child 12 each then check for level 3 vol
							$levelThreeVol = $this->message_model->volChildExits(3,$city);
							if($levelThreeVol>0){							
							//check for level 2 volunteer having child count less than 12 take 1
								$minUserChildCount3 = $this->message_model->volChildLessThanTwelve(3,$city);// doing me
								if($minUserChildCount3>0){
														 
									$volData['selectedParentId'] =$minUserChildCount3;
									$volData['volLevel']= 4;
								
								}
								else{
									
									// nothing 
								}
							}else{
								// if no child exit take 1 level 2 volunteer
								$volData['selectedParentId'] = $this->message_model->getOneVolunteer(3,$city);
								$volData['volLevel']= 4;
								
							}						
						
						}					
				}
				else{
					// if no child exit take 1 level 2 volunteer
					$volData['selectedParentId'] = $this->message_model->getOneVolunteer(2,$city);
					$volData['volLevel']= 3;
				}
			}
		}
		else{
			
			// if no child exit take 1 level 1 volunteer
			$volData['selectedParentId'] = $this->message_model->getOneVolunteer(1,$city);
			$volData['volLevel']= 2;
		}
		return $volData;
	}
	
	// check the Volunteer distribution function
	 public function checkVolunteerDistributionFunction(){
		 $city = 1;
		 $volChildData = array();
		 $volChildData = $this->selectParentVolunteer($city);
		/* $minUserChildCount = $this->message_model->volChildLessThanTwelve(1,$city);
		 //print_r($minUserChildCount);
		 foreach($minUserChildCount as $minUserChildCounts){
				 if($minUserChildCounts['total']<12){
					 echo $minUserChildCounts['total']."=============".$minUserChildCounts['to_user_id']."<br>";
				 }
		 }*/
			 
		if($volChildData>0){
			echo $volChildData['selectedParentId']."+++++++++++++++++".$volChildData['volLevel'];
		}
		else{
			 echo "No data";
		}	
	 }
	 
	// added by SB on 10/06/2016 start
	public function sendEmailToVipUser($signupId,$userType,$userName,$toEmail){
		$details = $this->message_model->getUserInfo($signupId);
		//echo $details[0]['emailID']."++++++++++++++++".$details[0]['password']; exit;
		//print_r($details); exit;
		if($userType=='Founder'){
			$signUpLink = 'founders/'.$signupId;
			$userTypename = 'founder';
			$typename = 'Founders';
			$this->_message ='<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#5c5c5c; font-size:14px; line-height:18px; padding: 15px; border: 15px solid #cfcfcf;">
								<tr>
									<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td align="center" valign="top">
										<img src="'.base_url().'images/logo.png" width="150" height="150" alt="" />									
								   <h2 style="  color: #1b75bc; font-size: 25px; line-height: 26px;"> You have been recommended to us<br>
								As someone with the correct qualification<br> to be come a regional '.$userTypename.'.</h2>
									
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								   <p> Hi  '.$userName.', </p>
								<p>   
								You will be joining a small but select team who form the very pinnacle of our high profiting network.</p>

								<p>Before accepting this role and supplying your desired log-in details
								Please read the following short introduction to our company.</p>
								<p>Community Treasures is an innovative hybrid revenue share that provides all it\'s members with a safe and passive way to make money online.</p>
								<p>This platform is set to Launch in the very near future
								and you have been invited to secure a '.$typename.' position, making You a major part of our team.</p>
								<p>The financial rewards for the right '.$userTypename.'s are staggering and there will be many other benefits as your initial tour of the program will show.</p>
								<p>We have provided videos to explain what Community Treasures is, How it works and How you can benefits from being in our '.$typename.' group.</p>

								<p>The only requirement you need is the ability to move forward at a specific time. This is paramount to your success with us
								and you with be financially rewarded for your efforts.</p>
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								  <p> Join Community Treasures '.$typename.' Now - Create a better life for YOU and your family.</p> 
								 <br />

								  <a href="'.base_url().'signupuser/'.$signUpLink.'" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click Here To Enter Your Account</a>
									<br /><br /><br />
									</td>
								  </tr>
								  
								  <tr><td><p>Here are all of your details with login credentials as below.</p></td></tr>
								  <tr><td>
									  <table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr><td width="25%">Email:</td><td width="75%">' . $details[0]['emailID'] . '</td></tr>
										<tr><td width="25%">Password:</td><td width="75%">' . $details[0]['password'] . '</td></tr>
									  </table>
									</td></tr>
									
								</table>
								</td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
								  </tr>								  
								</table>';
		}
		else if($userType=='Industry_Leader'){
			$signUpLink = 'industryleader/'.$signupId;
			$userTypename = 'leader';
			$typename = 'Leadership';
			$this->_message ='<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#5c5c5c; font-size:14px; line-height:18px; padding: 15px; border: 15px solid #cfcfcf;">
								<tr>
									<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td align="center" valign="top">
										<img src="'.base_url().'images/logo.png" width="150" height="150" alt="" />									
								   <h2 style="  color: #1b75bc; font-size: 25px; line-height: 26px;"> You have been recommended <br>
								as someone qualified to become a <br> regional '.$userTypename.' for Community Treasures.</h2>
									
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								   <p> Hi  '.$userName.', </p>
								<p>   
								We invite YOU to join our select team, which forms the very pinnacle of our innovative and highly profitable leadership network.</p>

								<p>Before accepting this invitation and supplying your log-in details, please read the following short introduction to our company.</p>
								<p>Community Treasures is an innovative, hybrid retail & revenue share, that provides all its members with a safe and passive way to make money online.</p>
								<p>This platform will launch at the end of September 2016 and you have been invited to secure a position on our amazing platform now. Making You a major part of our team.</p>
								<p>The financial rewards for the right people are staggering and there will be many other benefits that you will discover in your initial tour.</p>
								<p>We have provided videos to explain what Community Treasures is, How it works and How You can benefit from joining this amazing community.</p>

								<p>The only requirement is that YOU – TAKE ACTION NOW! </p>
								<p>This is paramount to your success with us and You will be financially rewarded for your efforts.</p>
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								  <p> Join Community Treasures Now - Create a better life for YOU and your family.</p> 
								 <br />

								  <a href="'.base_url().'signupuser/'.$signUpLink.'" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click Here To Establish Your Account</a>
									<br /><br /><br />
									<p>YOU will be sent a second email after you submit the enrolment form on our website.</p>
									<p>Make sure to check your email (and spam folder)</p>
									</td>
								  </tr>
								  
								  <tr><td><p>Here are all of your details with login credentials as below.</p></td></tr>
								  <tr><td>
									  <table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr><td width="25%">Email:</td><td width="75%">' . $details[0]['emailID'] . '</td></tr>
										<tr><td width="25%">Password:</td><td width="75%">' . $details[0]['password'] . '</td></tr>
									  </table>
									</td></tr>
									
								</table>
								</td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
								  </tr>								  
								</table>';
		}
		if($userType=='General'){
			$signUpLink = 'user/'.$signupId;
			$userTypename = 'user';
			$typename = 'Users';
			$this->_message ='<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#5c5c5c; font-size:14px; line-height:18px; padding: 15px; border: 15px solid #cfcfcf;">
								<tr>
									<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td align="center" valign="top">
										<img src="'.base_url().'images/logo.png" width="150" height="150" alt="" />									
								   <h2 style="  color: #1b75bc; font-size: 25px; line-height: 26px;"> You have been recommended to us<br>
								As someone with the correct qualification<br> to be come a regional '.$userTypename.'.</h2>
									
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								   <p> Hi  '.$userName.', </p>
								<p>   
								You will be joining a small but select team who form the very pinnacle of our high profiting network.</p>

								<p>Before accepting this role and supplying your desired log-in details
								Please read the following short introduction to our company.</p>
								<p>Community Treasures is an innovative hybrid revenue share that provides all it\'s members with a safe and passive way to make money online.</p>
								<p>This platform is set to Launch in the very near future
								and you have been invited to secure a '.$typename.' position, making You a major part of our team.</p>
								<p>The financial rewards for the right '.$userTypename.'s are staggering and there will be many other benefits as your initial tour of the program will show.</p>
								<p>We have provided videos to explain what Community Treasures is, How it works and How you can benefits from being in our '.$typename.' group.</p>

								<p>The only requirement you need is the ability to move forward at a specific time. This is paramount to your success with us
								and you with be financially rewarded for your efforts.</p>
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								  <p> Join Community Treasures '.$typename.' Now - Create a better life for YOU and your family.</p> 
								 <br />

								  <a href="'.base_url().'signupuser/'.$signUpLink.'" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click Here To Enter Your Account</a>
									<br /><br /><br />
									</td>
								  </tr>
								  
								  <tr><td><p>Here are all of your details with login credentials as below.</p></td></tr>
								  <tr><td>
									  <table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr><td width="25%">Email:</td><td width="75%">' . $details[0]['emailID'] . '</td></tr>
										<tr><td width="25%">Password:</td><td width="75%">' . $details[0]['password'] . '</td></tr>
									  </table>
									</td></tr>
									
									
								</table>
								</td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
								  </tr>								  
								</table>';
		}
		//echo $this->_message; exit;
        $this->_to_email = $toEmail;
        $this->_subject = "VIP Position For Launch of CT.";
		//if($userType=='Industry_Leader'){
			
		/* }
		else{
			
        $this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
  <p style="font-size:14px;">Hello   '.$userName.'</p>
  <p style="font-size:14px;">You have been given the gift of V.I.P entrance to the CT wealth platform.</p>
  
	<p style="font-size:14px;"><a href="'.base_url().'signupuser/'.$signUpLink.'">Click here to Register.</a></p></div>';
        } */
		//echo $this->_to_email."===".$this->_subject."++++".$this->_message; exit;
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
	
	}
	Public function sendEmailToReferrer($signupId,$userType,$userName,$referrerId){
		
		//$details = $this->message_model->getUserInfo($signupId);
		$referrerDetail = $this->message_model->getUserInfo($referrerId);
		$referrerName = $referrerDetail[0]['firstName'];
		$referrerEmail = $referrerDetail[0]['emailID'];
		//echo $details[0]['emailID']."++++++++++++++++".$details[0]['password']; exit;
		//print_r($details); exit;
		if($userType=='Founder'){
			$signUpLink = 'founders/'.$signupId;
			$userTypename = 'founder';
			$typename = 'Founders';
			$this->_message ='<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#5c5c5c; font-size:14px; line-height:18px; padding: 15px; border: 15px solid #cfcfcf;">
								<tr>
									<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td align="left" valign="top">
										<p> Dear '.$referrerName.', </p>
										<p> Thank you for sending '.$userName.' a successful signup request.</p>
										<p> In case the user does not receive the email from us within 24 hrs, please advise the user to check his/her Junk email box for the email.</p>
										<p>If he/she is still unable to locate the same, please forward this email to the new user, so that the user can click on the link in this email and verify him/her to the system. Once this process is completed, the user can login to the system as an ACTIVE user.  </p>
										</td>
								    </tr>
									
								  <tr>
									<td align="center" valign="top">
										<img src="'.base_url().'images/logo.png" width="150" height="150" alt="" />									
								   <h2 style="  color: #1b75bc; font-size: 25px; line-height: 26px;"> You have been recommended to us<br>
								As someone with the correct qualification<br> to be come a regional '.$userTypename.'.</h2>
									
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								   <p> Hi  '.$userName.', </p>
								<p>   
								You will be joining a small but select team who form the very pinnacle of our high profiting network.</p>

								<p>Before accepting this role and supplying your desired log-in details
								Please read the following short introduction to our company.</p>
								<p>Community Treasures is an innovative hybrid revenue share that provides all it\'s members with a safe and passive way to make money online.</p>
								<p>This platform is set to Launch in the very near future
								and you have been invited to secure a '.$typename.' position, making You a major part of our team.</p>
								<p>The financial rewards for the right '.$userTypename.'s are staggering and there will be many other benefits as your initial tour of the program will show.</p>
								<p>We have provided videos to explain what Community Treasures is, How it works and How you can benefits from being in our '.$typename.' group.</p>

								<p>The only requirement you need is the ability to move forward at a specific time. This is paramount to your success with us
								and you with be financially rewarded for your efforts.</p>
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								  <p> Join Community Treasures '.$typename.' Now - Create a better life for YOU and your family.</p> 
								 <br />

								  <a href="'.base_url().'signupuser/'.$signUpLink.'" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click Here To Enter Your Account</a>
									<br /><br /><br />
									</td>
								  </tr>								  
								  
								</table>
								</td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
								  </tr>								  
								</table>';
		}
		else if($userType=='Industry_Leader'){
			$signUpLink = 'industryleader/'.$signupId;
			$userTypename = 'leader';
			$typename = 'Leadership';
			$this->_message ='<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#5c5c5c; font-size:14px; line-height:18px; padding: 15px; border: 15px solid #cfcfcf;">
								<tr>
									<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
										<td align="left" valign="top">
										<p> Dear '.$referrerName.', </p>
										<p> Thank you for sending '.$userName.' a successful signup request.</p>
										<p> In case the user does not receive the email from us within 24 hrs, please advise the user to check his/her Junk email box for the email.</p>
										<p>If he/she is still unable to locate the same, please forward this email to the new user, so that the user can click on the link in this email and verify him/her to the system. Once this process is completed, the user can login to the system as an ACTIVE user.  </p>
										</td>
								    </tr>
									
									<tr>
									<td align="center" valign="top">
										<img src="'.base_url().'images/logo.png" width="150" height="150" alt="" />									
								   <h2 style="  color: #1b75bc; font-size: 25px; line-height: 26px;"> You have been recommended <br>
								as someone qualified to become a <br> regional '.$userTypename.' for Community Treasures.</h2>
									
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								   <p> Hi  '.$userName.', </p>
								<p>   
								We invite YOU to join our select team, which forms the very pinnacle of our innovative and highly profitable leadership network.</p>

								<p>Before accepting this invitation and supplying your log-in details, please read the following short introduction to our company.</p>
								<p>Community Treasures is an innovative, hybrid retail & revenue share, that provides all its members with a safe and passive way to make money online.</p>
								<p>This platform will launch at the end of September 2016 and you have been invited to secure a position on our amazing platform now. Making You a major part of our team.</p>
								<p>The financial rewards for the right people are staggering and there will be many other benefits that you will discover in your initial tour.</p>
								<p>We have provided videos to explain what Community Treasures is, How it works and How You can benefit from joining this amazing community.</p>

								<p>The only requirement is that YOU – TAKE ACTION NOW! </p>
								<p>This is paramount to your success with us and You will be financially rewarded for your efforts.</p>
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								  <p> Join Community Treasures Now - Create a better life for YOU and your family.</p> 
								 <br />

								  <a href="'.base_url().'signupuser/'.$signUpLink.'" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click Here To Establish Your Account</a>
									<br /><br /><br />
									<p>YOU will be sent a second email after you submit the enrolment form on our website.</p>
									<p>Make sure to check your email (and spam folder)</p>
									</td>
								  </tr>						  

								</table>
								</td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
								  </tr>								  
								</table>';
		}
		if($userType=='General'){
			$signUpLink = 'user/'.$signupId;
			$userTypename = 'user';
			$typename = 'Users';
			$this->_message ='<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#5c5c5c; font-size:14px; line-height:18px; padding: 15px; border: 15px solid #cfcfcf;">
								<tr>
									<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
										<td align="left" valign="top">
										<p> Dear '.$referrerName.', </p>
										<p> Thank you for sending '.$userName.' a successful signup request.</p>
										<p> In case the user does not receive the email from us within 24 hrs, please advise the user to check his/her Junk email box for the email.</p>
										<p>If he/she is still unable to locate the same, please forward this email to the new user, so that the user can click on the link in this email and verify him/her to the system. Once this process is completed, the user can login to the system as an ACTIVE user.  </p>
										</td>
								    </tr>
								  <tr>
									<td align="center" valign="top">
										<img src="'.base_url().'images/logo.png" width="150" height="150" alt="" />									
								   <h2 style="  color: #1b75bc; font-size: 25px; line-height: 26px;"> You have been recommended to us<br>
								As someone with the correct qualification<br> to be come a regional '.$userTypename.'.</h2>
									
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								   <p> Hi  '.$userName.', </p>
								<p>   
								You will be joining a small but select team who form the very pinnacle of our high profiting network.</p>

								<p>Before accepting this role and supplying your desired log-in details
								Please read the following short introduction to our company.</p>
								<p>Community Treasures is an innovative hybrid revenue share that provides all it\'s members with a safe and passive way to make money online.</p>
								<p>This platform is set to Launch in the very near future
								and you have been invited to secure a '.$typename.' position, making You a major part of our team.</p>
								<p>The financial rewards for the right '.$userTypename.'s are staggering and there will be many other benefits as your initial tour of the program will show.</p>
								<p>We have provided videos to explain what Community Treasures is, How it works and How you can benefits from being in our '.$typename.' group.</p>

								<p>The only requirement you need is the ability to move forward at a specific time. This is paramount to your success with us
								and you with be financially rewarded for your efforts.</p>
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								  <p> Join Community Treasures '.$typename.' Now - Create a better life for YOU and your family.</p> 
								 <br />

								  <a href="'.base_url().'signupuser/'.$signUpLink.'" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click Here To Enter Your Account</a>
									<br /><br /><br />
									</td>
								  </tr>
								  
								</table>
								</td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
								  </tr>								  
								</table>';
		}
		//echo $this->_message ;
        $this->_to_email = $referrerEmail;
        $this->_subject = "Successful Signup Request sent For Launch of CT.";
		
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
	
	}
	public function sendEmailToVipLogin($signupId){
		$details = $this->message_model->getVipUserDetails($signupId);
        $this->_to_email = $details[0]->cuEmail;
        $this->_subject = "V.I.P Entrance For My True 12 - Make Money Online";
		if($details[0]->cuUserType=="INDUSTRY LEADER"){
			$userTypename = 'leader';
			$typename = 'Leadership';
		}
		else if($details[0]->cuUserType=="FOUNDERS"){
			$userTypename = 'founder';
			$typename = 'Founders';
		}
		else if($details[0]->cuUserType=="PAYING USER"){
			$userTypename = 'user';
			$typename = 'Users';
		}
			$this->_message ='<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#5c5c5c; font-size:14px; line-height:18px; padding: 15px; border: 15px solid #cfcfcf;">
								<tr>
									<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td align="center" valign="top">
										<img src="'.base_url().'images/logo.png" width="150" height="150" alt="" />
								   <h2 style="  color: #1b75bc; font-size: 25px; line-height: 26px;"> You have been recommended to us<br>
								As someone with the correct qualification<br> to be come a regional '.$userTypename.'.</h2>
									
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								   <p> Hi  '.$details[0]->cuFName.' '.$details[0]->cuLName.'</p>
								<p>  
								You will be joining a small but select team who form the very pinnacle of our high profiting network.</p>

								<p>Before accepting this role and supplying your desired log-in details
								Please read the following short introduction to our company.</p>
								<p>Community Treasures is an innovative hybrid revenue share that provides all it\'s members with a safe and passive way to make money online.</p>
								<p>This platform is set to Launch in the very near future
								and you have been invited to secure a '.$typename.' position, making You a major part of our team.</p>
								<p>The financial rewards for the right '.$userTypename.'s are staggering and there will be many other benefits as your initial tour of the program will show.</p>
								<p>We have provided videos to explain what Community Treasures is, How it works and How you can benefits from being in our '.$typename.' group.</p>

								<p>The only requirement you need is the ability to move forward at a specific time. This is paramount to your success with us
								and you with be financially rewarded for your efforts.</p>
									</td>
								  </tr>
								  <tr>
									<td align="left" valign="top">
								  <p> Join Community Treasures '.$typename.' Now - Create a better life for YOU and your family.</p> 
								 <br />

								  <a href="'.base_url().'viplogin/" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click Here To Enter Your Account</a>
									<br /><br /><br />
								  <table width="40%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td>Username </td>
									<td>'.$details[0]->cuEmail.'</td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								  </tr>
								  <tr>
									<td>Password </td>
									<td>'.$details[0]->cupwd.'</td>
								  </tr>
								</table>
									</td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
								  </tr>								  
								</table>';
		/* }
		else{
        $this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
  <p style="font-size:14px;">Hello   '.$details[0]->cuFName.' '.$details[0]->cuLName.'</p>
  <p style="font-size:14px;">You have been given the gift of V.I.P entrance to the CT wealth platform. This means you will be one of the first in this city to upload and list a product, service or talent onto Afrowebb. You will also financially benefit from this V.I.P software giving you a short cut to your success.</p>
  <p>Take Action</p>
  <p style="font-size:14px;">You will need to move fast to secure your extremely  privileged  position in our system because if  you remain dormant, this account will be closed and your  opportunity will pass.</p>
  <p>First,</p>
  <p style="font-size:14px;">Enter your CT account, using the username and password below. Watch the first 4 videos so you can understand the business and the payment plan. Work with the person who has invited you to Turn your business, your brand, event, service into a product to be sold on the Afrowebb.</p>
   <p>Second,</p>
  <p style="font-size:14px;">As Black people, we must develop prosperous, safe and healthy communities. We, CT believe , this can only be done once more of us are economically empowered and financially secure enough to help ourselves. This is one of the reasons why our wealth system was created. Your task is to enter using the "username and password" below then share the V.I.P entrance to help 12 sincere Black-owned enterprises, just as somebody shared this to help you.</p>
  
  <p style="font-size:14px;">Only by rising to the challenge of becoming wealthier as a community can we truly dedicate the time and acquire the resources to make any real positive change.</p>
  
  <p style="font-size:14px;">Third, Yet most importantly - PREPARE TO MOVE AS ONE.</p>
  
  <p style="font-size:14px;">On a specific date ,when your team leader  tells you  to, you must move up to level two. There will be no risk as the entire team around you will work as one unit ,allowing immediate profits to flow for each of the participants. </p>
  
  <p style="font-size:14px;"> Remember This is Your Moment!   Be Strong, Have Faith - Move As One & Together we will be financially Free. </p>
  
  <p style="font-size:14px;">Enter Now</p>
  
  <p style="font-size:14px;">Here are your login credentials</p>
  <p style="font-size:14px;">Username:     '.$details[0]->cuEmail.'</p>
  <p style="font-size:14px;">Password:     '.$details[0]->cupwd.'</p>
  <p style="font-size:14px;">Message:     '.$details[0]->message.'</p>
	<p style="font-size:14px;"><a href="'.base_url().'viplogin/">Click here to login</a></p></div>';
        } */
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            return true;
        } else {
            return false;
        }
	}
	public function insertVipMssDetails($userLevel,$toUserId,$message,$category,$parentId){
		$tbl = "vip_mass_details";
        $data['user_id'] = $parentId;
        $data['user_level'] = $userLevel;
		$data['to_user_id'] = $toUserId;
		$data['message'] = $message;
		$data['category'] = $category;
		$data['created_date'] = date('Y-m-d H:i:s');
        $this->common_model->insertDataToTable($tbl, $data);
        return true;
	}
	public function myRefView(){
		
		$result = $this->message_model->getMyRefUsers($this->userId);
		$retData = array();
		if(count($result) > 0){
			foreach($result as $rd){
				
				/* $retData[$rd->user_id][$rd->to_user_id]['user_id'] = $rd->uID;
				$retData[$rd->user_id][$rd->to_user_id]['cuFName'] = $rd->cuFName;
				$retData[$rd->user_id][$rd->to_user_id]['cuLName'] = $rd->cuLName;
				$retData[$rd->user_id][$rd->to_user_id]['cuEmail'] = $rd->cuEmail;
				$retData[$rd->user_id][$rd->to_user_id]['cuPhone'] = $rd->cuPhone;
				$retData[$rd->user_id][$rd->to_user_id]['created_date'] = $rd->created_date;
				$retData[$rd->user_id][$rd->to_user_id]['afrooPaymentStatus'] = $rd->afrooPaymentStatus; // added by SB on 22/08/2016
				$retData[$rd->user_id][$rd->to_user_id]['userType'] = $rd->userType; // added by SB on 22/08/2016 */
				
				$retData[$rd->referarID][$rd->uID]['user_id'] = $rd->uID;
				$retData[$rd->referarID][$rd->uID]['cuFName'] = $rd->cuFName;
				$retData[$rd->referarID][$rd->uID]['cuLName'] = $rd->cuLName;
				$retData[$rd->referarID][$rd->uID]['cuEmail'] = $rd->cuEmail;
				$retData[$rd->referarID][$rd->uID]['cuPhone'] = $rd->cuPhone;
				$retData[$rd->referarID][$rd->uID]['created_date'] = $rd->created_date;
				$retData[$rd->referarID][$rd->uID]['afrooPaymentStatus'] = $rd->afrooPaymentStatus; // added by SB on 22/08/2016
				$retData[$rd->referarID][$rd->uID]['userType'] = $rd->userType; // added by SB on 22/08/2016
				
			}
		}
		return $retData;
	}

	public function myRefCycleView($userId){
		
		$result = $this->message_model->getMyRefUsers($userId);
		$retData = array();
		if(count($result) > 0){
			foreach($result as $rd){
				
				$retData[$rd->referarID][$rd->uID]['user_id'] = $rd->uID;
				$retData[$rd->referarID][$rd->uID]['cuFName'] = $rd->cuFName;
				$retData[$rd->referarID][$rd->uID]['cuLName'] = $rd->cuLName;
				$retData[$rd->referarID][$rd->uID]['cuEmail'] = $rd->cuEmail;
				$retData[$rd->referarID][$rd->uID]['cuPhone'] = $rd->cuPhone;
				$retData[$rd->referarID][$rd->uID]['created_date'] = $rd->created_date;
				$retData[$rd->referarID][$rd->uID]['afrooPaymentStatus'] = $rd->afrooPaymentStatus; // added by SB on 22/08/2016
				$retData[$rd->referarID][$rd->uID]['userType'] = $rd->userType; // added by SB on 22/08/2016
				
			}
		}
		return $retData;
	}
	public function sendMailInvitation(){
		
		    //$mailMessage = trim($_POST["mailMsg"]);
			$mailMessage = 'Please Click the below link for payment';
			//$mailFor  = trim($_POST["mailFor"]);
			$userId   = trim($_POST["userId"]);
			if($userId!=""){
				// fetch user Email for all user
				$userDetail = $this->message_model->getReferedUserForPayment($userId);
			}
			/*else{
				// fetch user Email only for unsend user
				$userDetail = $this->message_model->getRaveJoinInviUser($userId);
			}*/
			
			if(count($userDetail)>0){  
				foreach($userDetail as $userDetails){
					$this->_to_email = $userDetails['emailID'];
					$this->_subject = "Rave Join Invitation Mail";
					$this->_message = '<div style="width:98%; padding:1%; font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000;">
										<p style="font-size:14px;">Hello '.$userDetails['firstName'].' '.$userDetails['lastName']. ',</p>
											<p style="font-size:14px;">'.$mailMessage.'</p>
  												
												<p style="font-size:14px;"><a href="'.base_url().'ct_payment/index/'.$userId.'" style="background: #1bb58f none repeat scroll 0 0; border-radius: 5px; clear: both; color: #fff; font-size: 16px; margin: 10px 0;
									padding: 10px; text-decoration: none;">Click To Pay</a></p>
												</div>';
        
					//echo $this->_to_email."===".$this->_subject."++++".$this->_message; exit;
					if ($this->_to_email != '' && $this->_subject != '') {
						
						$sendInvi = $this->send_mail_raw();
					   //insert record to vip_rave_join_invitation
					   if($sendInvi){
						   $inviData = array();
						   $inviData['to_userId']  = $userDetails['uID'];
						   $inviData['referrerId'] = $userId;
						   $inviData['mail_message'] = '';
						   $inviData['mail_date'] = date('Y-m-d');
						   $inviId = $this->message_model->addMailInvitation($inviData);
					   }
					  
					} 
					
				}
			
				$val = array("success" => "yes","message"=> 'Invitation send Sucessfully');
			}
			else{
				$val = array("success" => "no","message"=> 'Invitation already sent');
			}						
		
		
		$output = json_encode($val);
		echo $output; 
	}
	
	// end 
	public function testMailTest(){
		
        $this->_to_email = 'senabi.test01@gmail.com';
        $this->_subject = "Mail Test";
		
			$this->_message =' <p style="font-size:14px;">Hello  ,</p><p>Mail Test</p>';
		
        if ($this->_to_email != '' && $this->_subject != '') {
            $this->send_mail_raw();
            //return true;
			echo "Success- Mail Sent";
        } else {
            //return false;
			echo "Failure- Unable to send Mail";
        }
	}
	public function testMailContent(){
		$signupId = 1;//'';
		$userType = 'Industry_Leader';
		$userName = 'test23';
		//$toEmail  = 'senabi.test011@gmail.com';
		$referrerId = 1219;
		//$this->sendEmailToVipUser($signupId,$userType,$userName,$toEmail);
		$this->sendEmailToReferrer($signupId,$userType,$userName,$referrerId);
		}
	// 
	public function reSendMail(){
		    
			$uType  	= trim($_POST["uType"]);
			$userId   	= trim($_POST["userId"]);
			$uName    	=  trim($_POST["uName"]);
			$uEmail    	=  trim($_POST["uEmail"]);
			$succMessage = 'Registration Mail resend to this '.$uEmail.' email address';
			if($userId!=""){
				$sign_up_user_type ='';
				if($uType=='INDUSTRY LEADER'){
					$sign_up_user_type ='Industry_Leader';
				}
				else if($uType=='FOUNDERS'){
					$sign_up_user_type ='Founder';
				}
				else {
					$sign_up_user_type ='General';
				}
				
				$resendStatus =  $this->sendEmailToVipUser($userId,$sign_up_user_type,$uName,$uEmail);
			}
			
			if($resendStatus){  
							
				$val = array("success" => "yes","message"=> $succMessage );
			}
			else{
				$val = array("success" => "no","message"=> 'Unable to Resend email');
			}						
		
		
		$output = json_encode($val);
		echo $output; 
	}
}
