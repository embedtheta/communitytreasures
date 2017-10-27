<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gatewaymodel extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	
	function chkUserAuth($emailID,$pass,$status="1"){
		if( $emailID !="" && $pass !="" ){
			$this->db->select('userinfo.*');
			$this->db->from('userinfo');
			$this->db->where('userinfo.emailID',$emailID);
			$this->db->where('userinfo.password',$pass);
			$this->db->where('userinfo.status',$status);
			$query = $this->db->get();
			//echo $this->db->last_query();
			//echo $query->num_rows();
			//exit;
			if( $query->num_rows()== 1 ){
				$temp = $query->result_array(); 
				return $temp[0]; 
			}else{
				return false;
			}
		}
	}
        
        public function allMember(){
			
			//echo trim($this->session->userdata('userId')); exit;
            $this->db->select('userinfo.*,country.name country_name,city.city as city_name,user_expell.user_id expelled_user_id');
            $this->db->from('userinfo');
            $this->db->join("country","userinfo.country=country.country_id","LEFT");
            $this->db->join('city','city.id=userinfo.city','LEFT');
            $this->db->join("user_expell","user_expell.user_id=userinfo.uID","LEFT");
            $this->db->where('userinfo.referarID >',0);
            if(trim($this->session->userdata('referarId')) > 0){
                $this->db->where('userinfo.referarID',trim($this->session->userdata('userId')));
            }
            $this->db->group_by("userinfo.uID");
            $query = $this->db->get();
            return $query->result();
        }
	
	function chkPrePhaseUserAuth($emailID,$pass){
		if( $emailID !="" && $pass !="" ){
			$this->db->select('prephase.*');
			$this->db->from('prephase');
			$this->db->where('prephase.email',$emailID);
			$this->db->where('prephase.password',$pass);
			$query=$this->db->get();
			if( $query->num_rows()== 1 ){
				$temp = $query->result_array(); 
				return $temp[0]; 
			}else{
				return false;
			}
		}
	}
	
	function isMemberExist($UID){
		if( $UID > 0 ){
			$this->db->select('userinfo.uID');
			$this->db->from('userinfo');
			$this->db->where('userinfo.uID',$UID);
			$this->db->where('userinfo.status',"1");
			$query=$this->db->get();
			if( $query->num_rows()== 1 ){
				return true;
			}else{
				return false;
			}
		}
	}
	
	function isMailExist($emailID=""){
		if( $emailID !="" ){
			$this->db->select('userinfo.uID');
			$this->db->from('userinfo');
			$this->db->where('userinfo.emailID',$emailID);
			$query=$this->db->get();
			if( $query->num_rows()== 1 ){
				return false;
			}else{
				return true;
			}
		}
	}
	
	function insertMemberDetails($data=array()){
		if(!empty($data)){
			if(trim($data['firstName'])!=""){
				$this->db->set('userinfo.firstName',trim($data['firstName']));
			}
			if(trim($data['lastName'])!=""){
				$this->db->set('userinfo.lastName',trim($data['lastName']));
			}
			if(trim($data['userName'])!=""){
				$this->db->set('userinfo.userName',trim($data['userName']));
			}
			if(trim($data['emailID'])!=""){
				$this->db->set('userinfo.emailID',trim($data['emailID']));
			}
			if(trim($data['password'])!=""){
				$this->db->set('userinfo.password',trim($data['password']));
			}
			if(trim($data['phone'])!=""){
				$this->db->set('userinfo.phone',trim($data['phone']));
			}
			if(trim($data['gender'])!=""){
				$this->db->set('userinfo.gender',trim($data['gender']));
			}
			if(trim($data['country'])!=""){
				$this->db->set('userinfo.country',trim($data['country']));
			}
			if(trim($data['city'])!=""){
				$this->db->set('userinfo.city',trim($data['city']));
			}
			if(trim($data['parentID'])!=""){
				$this->db->set('userinfo.referarID',trim($data['parentID']));
			}
			if(trim($data['membershipStatus'])!=""){
				$this->db->set('userinfo.membershipStatus',trim($data['membershipStatus']));
			}
                        $this->db->set('userinfo.userType',"PAYING USER");
			$this->db->insert('userinfo');
			$id = $this->db->insert_id();
			$this->createRoute();
			return $id;
		}else{
			return false;
		}
	}
	
	function insertMemberProfilePic($fileName){
		if( $fileName !="" ){
			$data=array('profile'=>$fileName);
			$this->db->where('uID',$this->session->userdata('UserId'));
		    $this->db->update('userinfo',$data);
		}
	}
	
	
	function getUserInfo($UID){
            if( $UID != "" ){
                $this->db->select('*,city.city cityName,country.name countryName');
                $this->db->from('userinfo');
                $this->db->join("city","city.id=userinfo.city AND city.is_active=1","LEFT");
                $this->db->join("country","country.country_id=userinfo.country AND country.status=1","LEFT");
                $this->db->where('userinfo.uID',$UID);
                $query = $this->db->get();
                return $query->result_array();
            }
	}
	
	function countSwitchOnMembers($UID){
		if( $UID != "" ){
			$this->db->select('count(userinfo.uID) as totSwitchMember');
		    $this->db->from('userinfo');
		    $this->db->where('userinfo.referarID',$UID);
			$this->db->where('userinfo.switchOnPayment','1');
		    $query=$this->db->get();
			$arr = $query->result_array();
			return $arr[0]["totSwitchMember"];
		}	
	}
	
	function countMySignUps($UID){
		if( $UID != "" ){
			$this->db->select('count(userinfo.uID) as totSignUps');
		    $this->db->from('userinfo');
		    $this->db->where('userinfo.referarID',$UID);
			$this->db->where('userinfo.status','1');
			$query=$this->db->get();
			$arr = $query->result_array();
			return $arr[0]["totSignUps"];
		}
	}
	function countTotalMembers(){
		$this->db->select('userinfo.uID');
		$this->db->from('userinfo');
		$this->db->where('userinfo.status','1');
                $this->db->where('userinfo.userLevel >','0');
                $this->db->where('userinfo.userLevel <','6');
                $this->db->where('userinfo.userType','PAYING USER');
		$query=$this->db->get();
		return $query->num_rows();
	}
	function getHtmlBanners(){
		$this->db->select('userbanner.bannerID,userbanner.bannerImg');
		$this->db->from('userbanner');
		$this->db->where('userbanner.status','1');
		$query=$this->db->get();
		return $query->result_array();
	}
	function getUserAdverts(){
		$this->db->select('useradvert.advertID,useradvert.advertImg');
		$this->db->from('useradvert');
		$this->db->where('useradvert.status','1');
		$query=$this->db->get();
		return $query->result_array();
	}
	function getYoutubeVideos(){
		$this->db->select('useryoutube.id,useryoutube.youtubeName,useryoutube.youtubeUrl');
		$this->db->from('useryoutube');
		$this->db->where('useryoutube.status','1');
		$query=$this->db->get();
		return $query->result_array();
	}
	function getSwitchOnPaymentResponse($uid){
		if( $uid !="" ){
			$data=array('switchOnPayment'=>'1');
			$this->db->where('uID',$uid);
		    $this->db->update('userinfo',$data);
		}
	}
	function getPaypalEntryFeesResponse($uid){
		if( $uid !="" ){
			$data=array('tenDollerPayment'=>'1');
			$this->db->where('uID',$uid);
		    $this->db->update('userinfo',$data);
		}
	}
	function getAfrooPaymentResponse($uid){
		if( $uid !="" ){
			$data=array('afrooPaymentStatus'=>'1');
			$this->db->where('uID',$uid);
		    $this->db->update('userinfo',$data);
		}
	}
	
	
	function checkIsExistTcPearl(){
		if( $this->session->userdata('UserId') !="" ){
			$this->db->select('usertcpearl.pearlID');
			$this->db->from('usertcpearl');
			$this->db->where('usertcpearl.UID',$this->session->userdata('UserId'));
			$query=$this->db->get();
			if( $query->num_rows()== 1 ){
				return true;
			}else{
				return false;
			}
		}
	}
	function addCodeSubmisssionTcPearl($pearlCode){
		if( $pearlCode !=""){
			if( trim($pearlCode)!="" ){
				$this->db->set('usertcpearl.code',trim($pearlCode));
			}
			if( $this->session->userdata('UserId')!="" ){
				$this->db->set('usertcpearl.UID',$this->session->userdata('UserId'));
			}
			if( $this->session->userdata('UserId')!="" ){
				$this->db->set('usertcpearl.refID',$this->session->userdata('ReferarID'));
			}
			$this->db->insert('usertcpearl');
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	function editCodeSubmisssionTcPearl($pearlCode){
		if( ($pearlCode !="") && ($this->session->userdata('UserId') !="")){
			$data=array('code'=>$pearlCode);
			$this->db->where('UID',$this->session->userdata('UserId'));
		    $this->db->update('usertcpearl',$data);
			return $this->db->affected_rows(); 
		}
	}
	function checkIsExistTcSilver(){
		if( $this->session->userdata('UserId') !="" ){
			$this->db->select('usertcsilver.silverID');
			$this->db->from('usertcsilver');
			$this->db->where('usertcsilver.UID',$this->session->userdata('UserId'));
			$query=$this->db->get();
			if( $query->num_rows()== 1 ){
				return true;
			}else{
				return false;
			}
		}
	}
	function addCodeSubmisssionTcSilver($silverCode){
		if( $silverCode !=""){
			if( trim($silverCode)!="" ){
				$this->db->set('usertcsilver.code',trim($silverCode));
			}
			if( $this->session->userdata('UserId')!="" ){
				$this->db->set('usertcsilver.UID',$this->session->userdata('UserId'));
			}
			if( $this->session->userdata('UserId')!="" ){
				$this->db->set('usertcsilver.refID',$this->session->userdata('ReferarID'));
			}
			$this->db->insert('usertcsilver');
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	function editCodeSubmisssionTcSilver($silverCode){
		if( ($silverCode !="") && ($this->session->userdata('UserId') !="")){
			$data=array('code'=>$silverCode);
			$this->db->where('UID',$this->session->userdata('UserId'));
		    $this->db->update('usertcsilver',$data);
			return $this->db->affected_rows(); 
		}
	}
	function getTCPearlCode($UID){
		if( $UID!= "" ){
			$this->db->select('usertcpearl.code');
			$this->db->from('usertcpearl');
			$this->db->where('usertcpearl.UID',$UID);
			$query=$this->db->get();
			$arr    = $query->result_array();
		    $temp   = "";
		    if(!empty($arr)){
				$temp   = $arr[0]["code"]; 
		    }
			return $temp;
		}
	}
	function getTcSilverCode($UID){
		if( $UID!= "" ){
			$this->db->select('usertcsilver.code');
			$this->db->from('usertcsilver');
			$this->db->where('usertcsilver.UID',$UID);
			$query=$this->db->get();
			$arr    = $query->result_array();
		    $temp   = "";
		    if(!empty($arr)){
				$temp   = $arr[0]["code"]; 
		    }
			return $temp;
		}
	}
	
	/// for centoru
	
	function insertData($data){
		$this->db->set('firstName',$data['name']);
		$this->db->set('lastName',$data['surname']);
		$this->db->set('userName',$data['name'].'_'.$data['surname']);
		$this->db->set('password',$data['password']);
		$this->db->set('phone',$data['cellno']);
		$this->db->set('emailID',$data['emailAddr']);
		$this->db->set('city',$data['city']);
		$this->db->set('skypeID',$data['skypeID']);
		$this->db->set('userType',$data['userType']);
		$this->db->set('referarID',$data['parentID']);
		$this->db->set('status','1');
                $this->db->set('created_date',  date("Y-m-d H:i:s"));
		$this->db->insert('userinfo');
		$id =  $this->db->insert_id();
                $this->updateUserName($id);
		$this->createRoute();
		return $id;
	}
        /*Created by RD on 11-3-2015*/
        function updateUserName($userID = 0){
            $this->db->select('userinfo.*');
            $this->db->from('userinfo');
            $this->db->where('uID',$userID);
            $query = $this->db->get();
            $result = $query->result();
            if($result[0]->firstName != "" && $result[0]->lastName != ""){
                $sql = " UPDATE userinfo SET userinfo.userName=CONCAT(REPLACE(userinfo.firstName,' ',''),'.',REPLACE(userinfo.lastName,' ',''),'.',userinfo.uID) WHERE userinfo.uID =".$userID;
            }elseif($result[0]->firstName !="" && $result[0]->lastName == ""){
                $sql = " UPDATE userinfo SET userinfo.userName=CONCAT(REPLACE(userinfo.firstName,' ',''),'.',userinfo.uID) WHERE userinfo.uID =".$userID;
            }
            $this->db->query($sql);
            return true;
        }
	
	function checkUniqueValue($tbl = '',$cond_array = array()){
            if($tbl != ''){
                $this->db->select('COUNT(uID) AS tot');
                $this->db->where($cond_array);
                $sql = $this->db->get($tbl);
                $retData = $sql->result();
                return $retData[0]->tot;
            }else{
                return false;	
            }
	}
	
	function getVendorsList(){
            $this->db->select('vendorsID,vendorName');
            $this->db->from('vendorslist');
            $query = $this->db->get();
            return $query->result();
	}
        
        function productCategoryList(){
            $this->db->select('producttype.*');
            $this->db->from('producttype');
            $query = $this->db->get();
            return $query->result();
            
	}
        
        function getColor(){
            $this->db->select('id,colorName,colorCode');
            $this->db->from('color');
            $this->db->where('color.colorStatus',1);
            $query = $this->db->get();
            return $query->result();
	}
        
	/*Created by RD on 11-03-2015*/
	function createRoute(){
		$basePath = str_replace("system/","",BASEPATH)."application/config/route_dynamic.php";
		if(file_exists($basePath)){
			$this->db->select('userinfo.*');
			$this->db->from('userinfo');
			$query = $this->db->get();
			$result = $query->result();
			$output = '<?php ';
			$fp = fopen($basePath, "w");
			if(count($result) > 0){
				foreach($result as $vl){
                                    $uName = $vl->userName;
				
                                    $output .= ' $route["gateway_signup/'.$uName.'"] = "gateway/index/'.$vl->uID.'"; ';//User

                                    $output .= ' $route["signup_head_volunteers/'.$uName.'"] = "signup/head_volunteers/'.$vl->uID.'"; ';// Head volunteers

                                    $output .= ' $route["signup_volunteers/'.$uName.'"] = "signup/volunteers/'.$vl->uID.'"; ';// Volunteers

                                    $output .= ' $route["signup_teachers/'.$uName.'"] = "signup/teachers/'.$vl->uID.'"; ';//Gambia teacher

                                    $output .= ' $route["signup_student/'.$uName.'"] = "signup/student/'.$vl->uID.'"; ';//Gambia Student

                                    $output .= ' $route["signup_talented/'.$uName.'"] = "signup/talented/'.$vl->uID.'"; ';

                                    $output .= ' $route["signup_mentorship/'.$uName.'"] = "signup/mentorship/'.$vl->uID.'"; ';

                                    $output .= ' $route["signup_health/'.$uName.'"] = "signup/health/'.$vl->uID.'"; ';

                                    $output .= ' $route["signup_communities/'.$uName.'"] = "signup/communities/'.$vl->uID.'"; ';

                                    $output .= ' $route["signup_business/'.$uName.'"] = "signup/business/'.$vl->uID.'"; ';
                                        
				}				
			}
			$output .= ' ?>';
			fwrite($fp,$output);
			fclose($fp);
			unset($output);
		}else{
			return false;	
		}
	}
        
        public function getCity(){
            $this->db->select('city.*');
            $this->db->from('city');
            $this->db->where('is_active',1);
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
        
        public function getLevelWiseCount(){
            $sql = "  SELECT
                        SUM(IF(userLevel = 1,1,0)) level_1,
                        SUM(IF(userLevel = 2,1,0)) level_2,
                        SUM(IF(userLevel = 3,1,0)) level_3,
                        SUM(IF(userLevel = 4,1,0)) level_4,
                        SUM(IF(userLevel = 5,1,0)) level_5
                      FROM userinfo
                      WHERE `status` = '1'
                          AND userType = 'PAYING USER'";
            
           
            $query = $this->db->query($sql);
            //echo $this->db->last_query();
            return $query->result();
        }
        
        public function getAfroProduct(){
            $this->db->select('afrowebb_catalog_details.*');
            $this->db->from('afrowebb_catalog_details');
            $this->db->where('level',1);
            $this->db->where('status',1);
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
        
        public function getAfroProductById($id = ""){
            $this->db->select('afrowebb_catalog_details.*');
            $this->db->from('afrowebb_catalog_details');
            $this->db->where('id',$id);
            $this->db->where('status',1);
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
        
        public function getCountryList(){
            $this->db->select('country.*');
            $this->db->from('country');
            $this->db->where('country.status',1);
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
        
        public function getLevelOneVideo(){
            $this->db->select('gbe_level_video.*');
            $this->db->from('gbe_level_video');
            $this->db->where('gbe_level_video.level',1);
            $query = $this->db->get();
            $retData = array();
            $dd = $query->result();
            if(count($dd) > 0){
                foreach($dd as $val){
                    $i = 1;
                    if($val->serial_field != ""){
                        $i =  $val->serial_field;
                    }                   
                    $retData[$val->step][$i] = array(
                                                    "serial_field"=>$val->serial_field,
                                                    "title"=>$val->title,
                                                    "path"=>$val->path,
                                                    "content_title"=>$val->content_title,
                                                    "content"=>$val->content,
                                                    "content_image"=>$val->content_image); 
                   
                }
            }
            return $retData;
        }
        
        public function getInvoiceData($where = array()){
            $this->db->select('gbe_payment.*,userinfo.firstName,userinfo.lastName,userinfo.emailID');
            $this->db->from('gbe_payment');
            $this->db->join('userinfo','userinfo.uID = gbe_payment.user_id','LEFT');
            $this->db->where($where);
            $query = $this->db->get();
            $dd = $query->result();
        }
	// Added by SB on 23-04-2015
		function getExpellUserInfo($expellID){
            if( $expellID != "" ){
               /*  $this->db->select('*,city.city cityName,country.name countryName');
                $this->db->from('userinfo');
                $this->db->join("city","city.id=userinfo.city AND city.is_active=1","LEFT");
                $this->db->join("country","country.country_id=userinfo.country AND country.status=1","LEFT");
                $this->db->where('userinfo.uID',$expellID); */
				$sql = 'SELECT user_expell.*,
							  UserExpelled.firstName EUserfName,
							  UserExpelled.lastName EUserlName,
							  UserExpelled.userType EUserType,
							  (SELECT name FROM country WHERE country_id=UserExpelled.country) EUserCountry,
							  UserExpelledBy.firstName,
							  UserExpelledBy.lastName,
							 UserExpelledBy.userType UserType,
							(SELECT name FROM country WHERE country_id=UserExpelledBy.country) UserCountry
							FROM user_expell
							  LEFT JOIN userinfo UserExpelled
								ON UserExpelled.uID = user_expell.user_id
							  LEFT JOIN userinfo UserExpelledBy
								ON UserExpelledBy.uID = user_expell.expell_by_user_id
							WHERE user_expell.id = '.$expellID;
				$query = $this->db->query($sql);
                //$query = $this->db->get();
                return $query->result_array();
            }
		}
                
    public function deleteDataFromTable($tbl='',$where=array()){
        if(trim($tbl)!='' && !empty($tbl) && sizeof($where)>0){
            foreach($where as $key=>$v){
                $this->db->where(trim($key),trim($v));
            }
            $this->db->delete(trim($tbl)); 
            return true;
        }else{
            return false;	
        }
    }
    
    public function getStep2Url(){
        $this->db->select('admin_step2_b.*,userinfo.firstName,userinfo.lastName,userinfo.emailID');
        $this->db->from('admin_step2_b');
        $this->db->join('userinfo','userinfo.uID = admin_step2_b.user_id','LEFT');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
	// added by SB on 24-06-2015
	
	 public function getCategory(){
            $this->db->select('menumanagement.*');
            $this->db->from('menumanagement');
            $this->db->where('menumanagement.menuStatus','1');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();
        }
	// added by Sb on 25/06/2015
	public function getArticleList($catId){
            $this->db->select('productmenucontent.*');
            $this->db->from('productmenucontent');
			$this->db->where('productmenucontent.parent_article_id',0);
			$this->db->where('productmenucontent.menu_id',$catId);
            $this->db->where('productmenucontent.status','1');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();
        }
	public function getSubArticleList($articleId){
            $this->db->select('productmenucontent.*');
            $this->db->from('productmenucontent');
			$this->db->where('productmenucontent.parent_article_id',$articleId);			
            $this->db->where('productmenucontent.status','1');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();
        }
}



?>