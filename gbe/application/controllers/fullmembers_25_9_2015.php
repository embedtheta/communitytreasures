<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fullmembers extends CI_Controller {
    private $_from_email;
    private $_from_name;
    private $_admin_email;
    private $_to_email;
    private $_subject;
    private $_message;
    public $city;
	public $userId;
	public $referarId;
	public $userType;
	
    function __construct() {
        parent::__construct();
		if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');
        }
		$this->userId = trim($this->session->userdata('userId'));
		$this->referarId = trim($this->session->userdata('referarId'));
		$this->userType = trim($this->session->userdata('userType'));
        $this->_from_email = "blessings.jain@globalblackenterprises.com";
        $this->_from_name = "globalblackenterprises.com";
        $this->_admin_email = "blessings.jain@globalblackenterprises.com";
		$this->load->model('gatewaymodel');
		$this->load->model('fullmembers_model');
    }
	
    public function index() {
        $viewData = array();
		$viewData["tabhide"] = 0;
        $viewData["msg"] = "";
		$msgTypeDetails = $this->setMessage();  
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
		$viewData["openTabId"] = $msgTypeDetails["openTabId"];
		$viewData["postId"] = $msgTypeDetails["postId"];
		if($viewData["postId"] > 0){
			$retData = $this->fullmembers_model->getPostById($viewData["postId"]);
			$viewData['post_title'] = $retData[0]->post_title;
			$viewData['post_content'] = $retData[0]->post_content;
			$viewData['post_image'] = $retData[0]->post_image;
		}else{
			$viewData['post_title'] = "";
			$viewData['post_content'] = "";
			$viewData['post_image'] = '';
		}
		unset($msgTypeDetails);
		$width = '550px';
		$this->ckEditor($width);
        if($this->referarId == 0) {
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo(1000);
        }else{
            $viewData["parentInfo"] = $this->gatewaymodel->getUserInfo($this->referarId);
        }
        $viewData['level2Statistics'] = $this->fullmembers_model->getLevel2Statistics($this->userType,$this->userId,1);
        $viewData["userInfo"] = $this->gatewaymodel->getUserInfo($this->userId);
		$viewData["stepWiseVideo"] = $this->gatewaymodel->getLevelStepVideo(2);
		
		//$viewData["postCategoryList"] = $this->fullmembers_model->getPostCategoryList();
		$viewData["allPost"] = $this->fullmembers_model->getAllPost();
		$viewData["brochure"] = $this->fullmembers_model->getAllBrochure();
		$viewData["vcards"] = $this->fullmembers_model->getAllPostVcards();
		$viewData['levelWiseCounter'] = $this->gatewaymodel->getLevelWiseCount();
		$viewData['totalMembersUnderMe'] = $this->fullmembers_model->getTotalMembersUnderMe($this->userId);
		$viewData['upYoutube'] = $this->fullmembers_model->getUpYoutube();
		$viewData['downYoutube'] = $this->fullmembers_model->getDownYoutube();
		$viewData['downYoutubeCount'] = $this->fullmembers_model->getDownYoutubeCount($this->userId);
		//print_r($viewData["userInfo"]);
       	$this->load->view('fullmembers/index',$viewData);
		unset($viewData);
    }
	
	public function setMessage(){
        $retData = array();
		
        $type = $this->session->flashdata('type');
        $status = $this->session->flashdata('status');
		$openTabId = $this->session->flashdata('openTabId');
		$msg = $this->session->flashdata('msg');
		if($type == "customer"){
			$msg = "You have successfully submitted the message for Customer Services.";
		}elseif($type == "tech"){
			$msg = "You have successfully submitted the message for Technical Support.";
		}elseif($type == "advertise"){
			$msg = "You have successfully submitted the message for Advertisement Services.";
		}
       
		$postId = $this->session->flashdata('postId');
		
        $retData["msg"] = $msg;
        $retData["type"] = $type;
		$retData['openTabId'] = $openTabId;
		$retData['postId'] = $postId;
        return $retData;
    }
	
	public function updateUserInfo(){
		$type = 'STEP1A';
		$status = 'error';
		$openTabId = 'tab1';
		if($this->input->post('update') != ""){
			$emailCheck = $this->uniqueEmailCheckingAjax();
			$upData['emailID'] = trim($this->input->post('emailID'));
			if($emailCheck == 0){
				$upData['skypeID'] = trim($this->input->post('skypeID'));
				$upData['phone'] = trim($this->input->post('phone'));
				$upData['facebookLink'] = trim($this->input->post('facebookLink'));
				$upData['myBlogger'] = trim($this->input->post('myBlogger'));
				$upData['twitterLink'] = trim($this->input->post('twitterLink'));
				$upData['youTubeUrl'] = trim($this->input->post('youTubeUrl'));
				$imgData = $this->profileImageUpload();
				if($imgData['status'] == 3){
					$upData['profile'] = $imgData['profile'];	
				}
				$tbl = 'userinfo';
				$where = array("uID"=>$this->userId);
				$this->common_model->updateDataToTable($tbl, $where, $upData);
				unset($upData);unset($where);unset($tbl);
				$msg = "You have successfully updated your data.";
			}else{
				$msg = "Email '".$upData['emailID']."' is already used.Please try with another email.";
			}
		}
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('openTabId',$openTabId);
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url()."fullmembers");
	}
	
	public function uniqueEmailCheckingAjax(){
		$email = trim($this->input->post('emailID'));
		$emailType = trim($this->input->post("emailType"));
		$uID = $this->userId;
		if($emailType == 1){
			echo $this->fullmembers_model->checkEmailExist($email,$uID);
		}elseif($emailType == 2){
			return $this->fullmembers_model->checkEmailExist($email,$uID);
		}
	}
	
	public function profileImageUpload(){
		$retData['status'] = 1;
		$retData['profile'] = '';
		if ($_FILES['profile']['name'] != "") {
			$allowedExts = array("jpg","png","jpeg");
			$temp = explode(".", $_FILES["profile"]["name"]);
			$extension = strtolower(end($temp));
			if (($_FILES["profile"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
				$_FILES["profile"]["name"] = 'profile-'.$this->userId.'-'.time() . "." . $extension;
				if ($_FILES["profile"]["error"] > 0) {
					$retData['status'] = 2;
				}else{
					$path = $this->common_model->imageUnlinkPath()."useruploads/";
					move_uploaded_file($_FILES["profile"]["tmp_name"], $path.$_FILES["profile"]["name"]);
					$tempImg = trim($this->input->post('tempImage'));
					if(file_exists($path.$tempImg)){
						unlink($path.$tempImg);
					}
					$retData['profile'] = $_FILES["profile"]["name"];
					$retData['status'] = 3;
				}
			}else{
				$retData['status'] = 2;
			}
		}
		return $retData;
	}
	
	private function ckEditor($width){
		$path = '../gbe/js/ckfinder';
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
	}
	
	public function addPost(){
		$msg = "";
		$type = 'STEP3POSTADD';
		$status = 'error';
		$openTabId = 'tab3';
		$insertData = array();
		if($this->input->post('submitPost')):
			$insertData['post_title'] = trim($this->input->post('post_title'));
			$insertData['post_content'] = $this->input->post('post_content');
			$insertData['post_auther_id'] = $this->userId;
			$insertData['post_date'] = date("Y-m-d H:i:s");
			$insertData['comment_count'] = 0;
			$insertData['post_type'] = 'article';
			$insertData['post_title_url'] = url_title($insertData['post_title']);
			if($this->userType == 'ADMIN'){
				$insertData['admin_permission'] = 1;
			}
			$imgData = $this->blogImageUpload(1);
			if($imgData['status'] == 3){
				$insertData['post_image'] = $imgData['post_image'];	
			}
			/*$insertData['post_category_id'] = trim($this->input->post('post_type_id'));
			$insertData['post_status'] = trim($this->input->post('post_status'));
			$insertData['comment_status'] = trim($this->input->post('comment_status'));
			$insertData['post_parent'] = 0;*/
			if($insertData['post_content'] == ""){
				$msg = "Please enter the Post Content";
			}else{
				$tbl = "gbe_blog_posts";
				$inId = $this->common_model->insertDataToTable($tbl,$insertData);
				$this->fullmembers_model->updateUrlTitle($inId,$insertData['post_title_url']);
				if($inId >0){
					$msg = "You have successfully added the Post.";
					$status = 'success';
				}else{
					$msg = "There is an internal Problem.Please try again.";
				}
			}
		endif;
		
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('openTabId',$openTabId);
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url()."fullmembers");
	}
	
	public function copyPost(){
		$msg = "";
		$type = 'STEP3POSTADD';
		$status = 'error';
		$openTabId = 'tab3';
		$postId = trim($this->uri->segment(3));
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('openTabId',$openTabId);
		$this->session->set_flashdata('postId',$postId);
		redirect(base_url()."fullmembers");
	}
	
	public function copyPostAdd(){
		$msg = "";
		$type = 'STEP3POSTADD';
		$status = 'error';
		$openTabId = 'tab3';
		$insertData = array();
		if($this->input->post('submitPost')):
			$insertData['post_title'] = trim($this->input->post('post_title_edit'));
			$insertData['post_content'] = $this->input->post('post_content_edit');
			$insertData['post_auther_id'] = $this->userId;
			$insertData['post_date'] = date("Y-m-d H:i:s");
			$insertData['comment_count'] = 0;
			$insertData['post_type'] = 'post';
			$insertData['post_title_url'] = url_title($insertData['post_title']);
			if($this->userType == 'ADMIN'){
				$insertData['admin_permission'] = 1;
			}
			$imgData = $this->blogImageUpload(2);
			if($imgData['status'] == 3){
				$insertData['post_image'] = $imgData['post_image'];	
			}
			/*$insertData['post_category_id'] = trim($this->input->post('post_type_id'));
			$insertData['post_status'] = trim($this->input->post('post_status'));
			$insertData['comment_status'] = trim($this->input->post('comment_status'));
			$insertData['post_parent'] = 0;*/
			
			if($insertData['post_content'] == ""){
				$msg = "Please enter the Post Content";
			}else{
				$tbl = "gbe_blog_posts";
				$inId = $this->common_model->insertDataToTable($tbl,$insertData);
				$this->fullmembers_model->updateUrlTitle($inId,$insertData['post_title_url']);
				if($inId >0){
					$msg = "You have successfully added the Post.";
				}else{
					$msg = "There is an internal Problem.Please try again.";
				}
			}
		endif;
		
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('openTabId',$openTabId);
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url()."fullmembers");
	}
	
	public function blogImageUpload($tempImg = 1){
		$retData['status'] = 1;
		$retData['post_image'] = '';
		if ($_FILES['post_image']['name'] != "") {
			$allowedExts = array("jpg","png","jpeg");
			$temp = explode(".", $_FILES["post_image"]["name"]);
			$extension = strtolower(end($temp));
			if (($_FILES["post_image"]["size"] < 20000000) && in_array($extension, $allowedExts)) {
				$_FILES["post_image"]["name"] = 'blog-'.$this->userId.'-'.time() . "." . $extension;
				if ($_FILES["post_image"]["error"] > 0) {
					$retData['status'] = 2;
				}else{
					$path = $this->common_model->imageUnlinkPath()."useruploads/blogs/others/";
					move_uploaded_file($_FILES["post_image"]["tmp_name"], $path.$_FILES["post_image"]["name"]);
					$retData['post_image'] = $_FILES["post_image"]["name"];
					
					if($tempImg == 2){
						$tempImg1 = trim($this->input->post('tempImage'));
						if(file_exists($path.$tempImg1)){
							unlink($path.$tempImg1);
						}
					}
					
					
					$retData['status'] = 3;
				}
			}else{
				$retData['status'] = 2;
			}
		}
		return $retData;
	}
	
	public function downloadBrochure($fileName){
		set_time_limit(0);
		$path = "adminuploads/brochureVcards/brochure/".$fileName; // change the path to fit your websites document structure
		$name = $fileName;
		$mimType = " ";
		$this->download($path,$name,$mimType);
	}
	
	public function downloadVcards($fileName){
		set_time_limit(0);
		$path = "adminuploads/brochureVcards/vcards/".$fileName; // change the path to fit your websites document structure
		$name = $fileName;
		$mimType = " ";
		$this->download($path,$name,$mimType);
	}
	
	public function download($file, $name, $mime_type=''){
		//Check the file premission
		if(!is_readable($file)): 
			die('File not found or inaccessible!');
		endif;
		$size = filesize($file);
		$name = rawurldecode($name);
		/* Figure out the MIME type | Check in array */
		$known_mime_types=array(
			"pdf" => "application/pdf",
			"txt" => "text/plain",
			"html" => "text/html",
			"htm" => "text/html",
			"exe" => "application/octet-stream",
			"zip" => "application/zip",
			"doc" => "application/msword",
			"xls" => "application/vnd.ms-excel",
			"ppt" => "application/vnd.ms-powerpoint",
			"gif" => "image/gif",
			"png" => "image/png",
			"jpeg"=> "image/jpg",
			"jpg" =>  "image/jpg",
			"php" => "text/plain"
		);
		
		if($mime_type==''){
			$file_extension = strtolower(substr(strrchr($file,"."),1));
			if(array_key_exists($file_extension, $known_mime_types)){
				$mime_type=$known_mime_types[$file_extension];
			} else {
				$mime_type="application/force-download";
			}
		}
		//turn off output buffering to decrease cpu usage
 		@ob_end_clean(); 
 
 		// required for IE, otherwise Content-Disposition may be ignored
 		if(ini_get('zlib.output_compression')):
  			ini_set('zlib.output_compression', 'Off');
		endif;	
		header('Content-Type: ' . $mime_type);
		header('Content-Disposition: attachment; filename="'.$name.'"');
		header("Content-Transfer-Encoding: binary");
		header('Accept-Ranges: bytes');
 
		/* The three lines below basically make the download non-cacheable */
		header("Cache-control: private");
		header('Pragma: private');
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 
 		// multipart-download and download resuming support
		if(isset($_SERVER['HTTP_RANGE'])){
			list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
			list($range) = explode(",",$range,2);
			list($range, $range_end) = explode("-", $range);
			$range=intval($range);
			if(!$range_end) {
				$range_end=$size-1;
			} else {
				$range_end=intval($range_end);
			}
			$new_length = $range_end-$range+1;
			header("HTTP/1.1 206 Partial Content");
			header("Content-Length: $new_length");
			header("Content-Range: bytes $range-$range_end/$size");
		} else {
			$new_length=$size;
			header("Content-Length: ".$size);
		}
 
		/* Will output the file itself */
		$chunksize = 1*(1024*1024); //you may want to change this
		$bytes_send = 0;
		if ($file = fopen($file, 'r')){
			if(isset($_SERVER['HTTP_RANGE']))
				fseek($file, $range);
				while(!feof($file) && (!connection_aborted()) && ($bytes_send<$new_length)){
					$buffer = fread($file, $chunksize);
					print($buffer); //echo($buffer); // can also possible
					flush();
					$bytes_send += strlen($buffer);
				}
				fclose($file);
			} else {
			//If no permissiion
			die('Error - can not open file.');
			//die
			die();
		}
		
	}
	
	public function addYoutubeUrl(){
		$msg = "";
		$type = 'STEP3POSTADD';
		$status = 'error';
		$openTabId = 'tab2';
		$insertData = array();
		if($this->input->post('url_displayer_btn')):
			$insertData['url'] = trim($this->input->post('url'));
			$insertData['show_for'] = trim($this->input->post('show_for'));
			$insertData['user_id'] = $this->userId;
			$insertData['created_date'] = date("Y-m-d H:i:s");
			$insertData['admin_approval'] = trim($this->input->post('admin_approval'));
			if($insertData['url'] == ""){
				$msg = "Please enter the Youtube Link";
			}else{
				$tbl = "level_2_step_2_youtube";
				$inId = $this->common_model->insertDataToTable($tbl,$insertData);
				if($inId >0){
					$msg = "You have successfully added the Youtube Link.";
					$status = 'success';
				}else{
					$msg = "There is an internal Problem.Please try again.";
				}
			}
		endif;
		
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('openTabId',$openTabId);
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url()."fullmembers");
	}
	
	public function moveup(){
		echo 'coming soon..';
	}
	
	public function sendAgrreEmail(){
		$type = 'STEP1A';
		$status = 'error';
		$openTabId = 'tab1';
		
		$tbl = "userinfo";
        $where["uID"] = $this->userId;
        $selectedData = "";
        $userDetails = $this->common_model->fetchDataFromTable( $tbl , $where , $selectedData);
		
		$this->_to_email = $this->_admin_email;
        $this->_subject = "Agree user in GBE";
        $this->_message = '<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr><td colspan="2">Hello Admin,</td></tr>
								<tr><td colspan="2">A user '.$userDetails[0]->firstName.' '.$userDetails[0]->lastName.' agree.</td></tr>				
								<tr><td colspan="2">Thank you very much.</td></tr>
								<tr><td colspan="2">globalblackenterprises.com</td></tr>
                           </table>';
        if ($this->_to_email != '' && $this->_subject != '') {
            //$this->send_mail_raw();
			$status = 'success';
            $msg = "Your email has been send to Admin.";
        } else {
            $msg = "Sorry, Try Again.";
        }
		
		$this->session->set_flashdata('type',$type);
		$this->session->set_flashdata('status',$status);
		$this->session->set_flashdata('openTabId',$openTabId);
		$this->session->set_flashdata('msg',$msg);
		redirect(base_url()."fullmembers");
	}
	
	public function send_mail_raw() {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= "Bcc:senabi.test01@gmail.com"."\n";
		//$headers .= 'Cc:senabi.gbe@gmail.com' . "\r\n";
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
	
	
	
}
