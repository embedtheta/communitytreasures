<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gatewaymodel extends CI_Model {
	public $forWebsite;
	function __construct(){
		parent::__construct();
		$this->forWebsite = 1;// For GBE
	}
	
	function chkUserAuth($emailID,$pass,$status="1"){
		if( $emailID !="" && $pass !="" ){
			$this->db->select('userinfo.*');
			$this->db->from('userinfo');
			$this->db->where('userinfo.emailID',$emailID);
			$this->db->where('userinfo.password',$pass);
			// $this->db->where('userinfo.status',$status); //blocked by SB on 23/09/2015 for blocked account
			$this->db->where('userinfo.forWebsite',$this->forWebsite);// added by SB on 04/09/2015
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
            $this->db->select('userinfo.*,country.name country_name,city.city as city_name,user_expell.user_id expelled_user_id,UGT.user_general_type_name');
            $this->db->from('userinfo');
            $this->db->join("country","userinfo.country=country.country_id","LEFT");
            $this->db->join('city','city.id=userinfo.city','LEFT');
            $this->db->join("user_expell","user_expell.user_id=userinfo.uID","LEFT"); 
			$this->db->join("user_general_type UGT","UGT.user_id=userinfo.uID","LEFT");
            $this->db->where('userinfo.referarID >',0);
			$this->db->where('userinfo.forWebsite', $this->forWebsite);
            if(trim($this->session->userdata('referarId')) > 0){
                $this->db->where('userinfo.referarID',trim($this->session->userdata('userId')));
            }
            $this->db->group_by("userinfo.uID");
            $query = $this->db->get();
            return $query->result();
        }
		
		public function allMembersForHV(){
			$sql = "SELECT `userinfo` . * , `country`.`name` country_name, `city`.`city` AS city_name, `user_expell`.`user_id` expelled_user_id, `UGT`.`user_general_type_name`
					FROM (
					`userinfo`
					)
					LEFT JOIN `country` ON `userinfo`.`country` = `country`.`country_id`
					LEFT JOIN `city` ON `city`.`id` = `userinfo`.`city`
					LEFT JOIN `user_expell` ON `user_expell`.`user_id` = `userinfo`.`uID`
					LEFT JOIN `user_general_type` UGT ON `UGT`.`user_id` = `userinfo`.`uID`
					WHERE `userinfo`.`referarID` >0
					AND `userinfo`.`forWebsite` =".$this->forWebsite."
					AND `userinfo`.`referarID` = ".trim($this->session->userdata('userId'))."
					AND (`userinfo`.userType='VOLUNTEERS' OR UGT.user_general_type_name = 'afrowebb')
					GROUP BY `userinfo`.`uID`";
			$query = $this->db->query($sql);		
			/*$this->db->select('userinfo.*,country.name country_name,city.city as city_name,user_expell.user_id expelled_user_id,UGT.user_general_type_name');
            $this->db->from('userinfo');
            $this->db->join("country","userinfo.country=country.country_id","LEFT");
            $this->db->join('city','city.id=userinfo.city','LEFT');
            $this->db->join("user_expell","user_expell.user_id=userinfo.uID","LEFT"); 
			$this->db->join("user_general_type UGT","UGT.user_id=userinfo.uID AND UGT.user_general_type_name = 'afrowebb' ","LEFT");
            $this->db->where('userinfo.referarID >',0);
            if(trim($this->session->userdata('referarId')) > 0){
                $this->db->where('userinfo.referarID',trim($this->session->userdata('userId')));
            }
            $this->db->group_by("userinfo.uID");
            $query = $this->db->get();*/
			//print_r($this->db->last_query());
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
			$this->db->where('uID',$this->session->userdata('userId'));
		    $this->db->update('userinfo',$data);
		}
	}
	
	
	function getUserInfo($UID){
            if( $UID != "" ){
                $this->db->select('userinfo.*,city.city cityName,city.id city_id,country.country_id,country.name countryName,UGT.user_general_type_name');
                $this->db->from('userinfo');
                $this->db->join("city","city.id=userinfo.city AND city.is_active=1","LEFT");
                $this->db->join("country","country.country_id=userinfo.country AND country.status=1","LEFT");
				$this->db->join("user_general_type UGT","UGT.user_id=userinfo.uID","LEFT");
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
		$this->db->set('currency',$data['currency']);
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
	
	function getVendorsList($addedBy){
            $this->db->select('vendorsID,vendorName');
            $this->db->from('vendorslist');
			if($addedBy!=""){
				$this->db->where('vendorAddedBy',$addedBy);
			}
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
			$this->db->where('userinfo.forWebsite',$this->forWebsite);// added by SB on 02/10/2015
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

                                    //$output .= ' $route["signup_communities/'.$uName.'"] = "signup/communities/'.$vl->uID.'"; ';
									
									$output .= ' $route["signup_afrowebb/'.$uName.'"] = "signup/afrowebb/'.$vl->uID.'"; ';

                                    $output .= ' $route["signup_business/'.$uName.'"] = "signup/business/'.$vl->uID.'"; ';
									
									$output .= ' $route["blog/'.$uName.'"] = "blog/index/'.$vl->uID.'"; ';
									
                                        
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
			 if($this->forWebsite!=""){
				  $this->db->where('forWebsite',$this->forWebsite);
			 }
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
        public function getLevelStepVideo($level = 1){
            $this->db->select('gbe_level_video.*');
            $this->db->from('gbe_level_video');
            $this->db->where('gbe_level_video.level',$level);
			$this->db->where('gbe_level_video.forWebsite',1);
            $query = $this->db->get();
			//print_r($this->db->last_query());
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
			//echo $this->db->last_query();
           return $dd = $query->result();
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
        $this->db->where('admin_step2_b.for_website',1);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
	// added by SB on 24-06-2015
	
	 public function getCategory(){
            $this->db->select('menumanagement.*');
            $this->db->from('menumanagement');
            $this->db->where('menumanagement.menuStatus','1');
			 if($this->forWebsite!=""){
				$this->db->where('menumanagement.forWebsite',$this->forWebsite);
			}
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
	// added by SB on 29/06/2015
	public function getCityListByCountryId($countryId){
            $this->db->select('city.*');
            $this->db->from('city');			
			$this->db->where('city.countryId',$countryId);
            $this->db->where('city.is_active','1');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result_array();
        }
		
		// added by RD on 28/09/2015
	public function getZipListByCityId($city_id){
		$this->db->select('zip_code.*');
		$this->db->from('zip_code');			
		$this->db->where('zip_code.city_id',$city_id);
		$this->db->where('zip_code.status',1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array();
	}
	
// check city name exists or not added by SB on 02/07/2015
   public function checkCityExist($countryId,$newCityName){
			
			$sql = "SELECT city.id							  
							FROM city							 
							WHERE city.countryId = ".$countryId."
							AND city.city LIKE '%".$newCityName."%'";
			$query = $this->db->query($sql);
			if( $query->num_rows()== 1 ){
				return false;
			}else{
				return true;
			}	
				
           
   }
   
   public function checkZipExist($city_id,$newZipCode){
		$sql = "SELECT id							  
				FROM zip_code							 
				WHERE city_id = ".$city_id."
				AND zip_code = '".$newZipCode."'";
		$query = $this->db->query($sql);
		if( $query->num_rows()== 1 ){
			return false;
		}else{
			return true;
		}
   }
	// add new city name to database
	public function addNewCity($countryId,$newCityName){
		if( $countryId >0 && $newCityName!=''){
			if( trim($countryId)>0 ){
				$this->db->set('city.countryId',$countryId);
			}
			if( $newCityName!="" ){
				$this->db->set('city.city',$newCityName);
				$this->db->set('city.is_active',1);
			}
			
			$this->db->insert('city');
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
        
        // get all products of a user //RD//29-06-2015
        public function getAllProductsByUser($userId = 0){
            $this->db->select("PD.*,PF.fileName");
            $this->db->from("product_details PD");
            $this->db->join("product_files PF","PF.productId=PD.productID","LEFT");
            $this->db->where("PF.isMain",1);
            $this->db->where("PF.fileType",0);
            $this->db->where("PF.fileStatus",1);
            $this->db->where("PD.addedBy",$userId);
            $this->db->order_by("PD.productName");
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
	function getPassword($emailID){
		if( $emailID !=""){
			$this->db->select('userinfo.*');
			$this->db->from('userinfo');
			$this->db->where('userinfo.emailID',$emailID);			
			$this->db->where('userinfo.status',"1");
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
	// get currency id from country table
	function getCurrency($cityId){
		if( $cityId !=""){
			$sql = "SELECT country.counCurrenry 
						FROM city  
						LEFT JOIN country 
						ON city.countryId=country.country_id 
						WHERE city.id=".$cityId;	
			$query = $this->db->query($sql);			
			
			if( $query->num_rows()== 1 ){
				$currency = $query->result_array(); 
				return $currency[0]['counCurrenry']; 
			}else{
				return false;
			}
		}
	}
	// get parrent currency for currency conversion
	function getParentCurrency($parentId){
		if( $parentId !=""){
			$sql = "SELECT userinfo.currency 
						FROM userinfo  						 
						WHERE userinfo.uID=".$parentId;	
			$query = $this->db->query($sql);			
			
			if( $query->num_rows()== 1 ){
				$currency = $query->result_array(); 
				return $currency[0]['currency']; 
			}else{
				return false;
			}
		}
	}
	
	public function getOverViewOfLevel1($userType,$userId){
		if($userType == "PAYING USER"){
			$sql = $this->getPayingUserStatisticsSQL($userId);	
		}else{
			$sql = $this->getOthersUserStatisticsSQL($userId);
		}
		//echo $sql;
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	public function getPayingUserStatisticsSQL($userId){
		$sql = "SELECT
				  UINFO.uID,
				  UINFO.referarID,
				  UINFO.firstName,
				  UINFO.lastName,
				  UINFO.userType,
				  UINFO.userLevel,
				  UGT.user_general_type_name,
				  (SELECT
					 COUNT(UINFO1.uID)
				   FROM userinfo UINFO1
				   WHERE UINFO1.referarID = UINFO.uID)    totalMember
				FROM userinfo UINFO
				  LEFT JOIN user_general_type UGT
					ON UGT.user_id = UINFO.uID
				WHERE UINFO.referarID = ".$userId."
					AND UGT.user_general_type_name != ''
					AND UINFO.userLevel = 0
					AND UINFO.forWebsite = ".$this->forWebsite."
					AND UINFO.userType = 'PAYING USER'
				ORDER BY UINFO.uID  DESC";
		return $sql;
	}
	
	public function getOthersUserStatisticsSQL($userId){
		$sql = "SELECT
				  UINFO.uID,
				  UINFO.referarID,
				  UINFO.firstName,
				  UINFO.lastName,
				  UINFO.userType,
				  UINFO.userLevel,
				  (SELECT
					 COUNT(UINFO1.uID)
				   FROM userinfo UINFO1
				   WHERE UINFO1.referarID = UINFO.uID)    totalMember
				FROM userinfo UINFO
				WHERE UINFO.referarID = ".$userId."
					AND UINFO.userLevel = 0
					AND UINFO.forWebsite = ".$this->forWebsite."
				ORDER BY UINFO.uID  DESC";
		return $sql;
	}
	
	public function getUserMassDetails($userId){
		$this->db->select('CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.password cupwd,CU.emailID cuEmail,CU.userType cuUserType,CU.userLevel cuUserLevel,PU.firstName puFName,PU.lastName puLName,PU.userType puUserType,GMD.id,GMD.message');
		$this->db->from('userinfo CU');
		$this->db->join('userinfo PU','PU.uID = CU.referarID','LEFT');
		$this->db->join('gbe_mass_details GMD','GMD.to_user_id = CU.uID','LEFT');
		$this->db->where('CU.uID',$userId);
		$sql = $this->db->get();
		//print_r($this->db->last_query());
		return $sql->result();
	}
	// update user currency
	function updateUserCurrency($currId,$userId){
		if( $currId !="" ){
			$data=array('currency'=>$currId);
			$this->db->where('uID',$userId);
		    $this->db->update('userinfo',$data);
			return $this->db->affected_rows(); 
		}
	}
	// user level update added by SB on 16/09/2015
	function updateUserLevel($userId){
		if( $userId !="" ){
			$sql = "UPDATE userinfo 
								SET 
								userLevel=userLevel+1
								WHERE uID=".$userId;
			$rs = $this->db->query($sql);
			if($rs){
				return true;
			}else{
				return false;	
			}
		}
	}
	public function getCatalogueCommissionDetails($userId){
		$sql = "SELECT
				  `CU`.`uID`,
				  `CU`.`referarID`,
				  `CU`.`firstName`            cuFName,
				  `CU`.`lastName`             cuLName,
				  `CU`.`emailID`              cuEmail,
				  `GP`.`parent_commossion`,
				  CASE `GP`.`payment_currency`
					WHEN 'USD' THEN '$'
					WHEN 'EUR' THEN '€'
					WHEN 'GBP' THEN '£'
				   END AS pc
				FROM (`userinfo` CU)
				  JOIN `gbe_payment` GP
					ON `GP`.`user_id` = `CU`.`uID`
				WHERE `CU`.`referarID` = ".$userId."
					AND `GP`.`payment_for` = 1
					AND `GP`.`status` = 'COMPLETED'";
	
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result();
		/*$this->db->select('CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.emailID cuEmail,GP.parent_commossion,CASE payment_currency
WHEN "USD" THEN  "$"
WHEN "EUR" THEN  "€"
WHEN "GBP" THEN  "£"
END as payment_currency');
		$this->db->from('userinfo CU');
		$this->db->join('gbe_payment GP','GP.user_id = CU.uID');
		$this->db->where('CU.referarID',$userId);
		$this->db->where('GP.payment_for',1);
		$this->db->where('GP.status','COMPLETED');
		$sql = $this->db->get();*/
		//print_r($this->db->last_query());
		//return $sql->result();
	}
	
	public function getUserDetails($signupId){
		$this->db->select('CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.password cupwd,CU.emailID cuEmail,CU.userType cuUserType,CU.userLevel cuUserLevel,PU.firstName puFName,PU.lastName puLName,PU.userType puUserType');
		$this->db->from('userinfo CU');
		$this->db->join('userinfo PU','PU.uID = CU.referarID','LEFT');
		/*$this->db->join('gbe_mass_details GMD','GMD.to_user_id = CU.uID','LEFT');*/
		$this->db->where('CU.uID',$signupId);
		$sql = $this->db->get();
		return $sql->result();
	}
	
	public function checkingCatalogPaymentExist($uID){
		$this->db->select('CU.uID,CU.afrooPaymentStatus');
		$this->db->from('userinfo CU');
		$this->db->where('CU.uID',$uID);
		$sql = $this->db->get();
		return $sql->result();
	}
	
	public function getBalanceInCA($userId){
		$this->db->select('MCA.*');
		$this->db->from('my_current_account MCA');
		$this->db->where('MCA.userId',$userId);
		$sql = $this->db->get();
		return $sql->result();
	}
	public function setTransactionId($paymentTblId){
		
		if( $paymentTblId !="" ){
						
			$sql = "UPDATE gbe_payment 
					SET 
					transaction_Id=id+10000
				WHERE id=".$paymentTblId;
		$rs = $this->db->query($sql);
			if($rs){
				return true;
			}else{
				return false;	
			}
		}
	
	}
	//check User Exist in subscription Table added by SB on 18/09/2015
	public function checkUserExists($userId){
		$this->db->select('usi.id');
		$this->db->from('user_subscription_info usi');
		$this->db->where('usi.userId',$userId);
		$query = $this->db->get();
		if( $query->num_rows()== 1 ){
				$temp = $query->result_array(); 
				return $temp[0]['id']; 
		}else{
				return 0;
		}
	}
	
	public function getMyListingDetails($userId){
		$this->db->select('*');
		$this->db->from('listingdetails');
		$this->db->where('listingAddedBy',$userId);
		$sql = $this->db->get();
		return $sql->result();
	}
	// Block User account and redirect to TopUp page added by SB on 23/09/2015
	function changeUserStatus($userId,$status){
		if( $userId !="" ){
			// set status 2 as all permission blocked  and 1 for account active
			$sql = "UPDATE userinfo 
					SET 
					status='".$status."'
				WHERE uID=".$userId;
			$rs = $this->db->query($sql);			
			return $this->db->affected_rows(); 
		}
	}
	
}



?>