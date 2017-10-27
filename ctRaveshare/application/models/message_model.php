<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model {
	public $forWebsite;
	function __construct(){
		parent::__construct();
		$this->forWebsite = 2;// For community
	}
	
	public function getUserDetails($signupId){
		$this->db->select('CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.password cupwd,CU.emailID cuEmail,CU.userType cuUserType,CU.userLevel cuUserLevel,PU.firstName puFName,PU.lastName puLName,PU.userType puUserType,GMD.message');
		$this->db->from('userinfo CU');
		$this->db->join('userinfo PU','PU.uID = CU.referarID','LEFT');
		$this->db->join('gbe_mass_details GMD','GMD.to_user_id = CU.uID','LEFT');
		$this->db->where('CU.uID',$signupId);
		$sql = $this->db->get();
		return $sql->result();
	}
	
	public function getAllMassUser($userId){
		/*$this->db->select('GMD.*,CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.emailID cuEmail,CU.phone cuPhone,city.city');
		$this->db->from('gbe_mass_details GMD');
		$this->db->join('userinfo CU','CU.uID = GMD.to_user_id','LEFT');
		$this->db->join('city','city.id = CU.city','LEFT');
		$this->db->where('CU.uID !=', "");
		$this->db->where('CU.forWebsite',$this->forWebsite);// added by SB on 13/10/2015
		$this->db->order_by('GMD.id','DESC');
		$sql = $this->db->get();*/ //changed by SB on 29/10/2015
		$sql = "SELECT
					  `GMD`.*,
					  `CU`.`uID`,
					  `CU`.`referarID`,
					  `CU`.`firstName`    cuFName,
					  `CU`.`lastName`     cuLName,
					  `CU`.`emailID`      cuEmail,
					  `CU`.`phone`        cuPhone,
					  `city`.`city`,
					  (SELECT COUNT(ULI.id) FROM user_login_info ULI WHERE ULI.userId=`GMD`.`to_user_id`) AS login
					FROM (`gbe_mass_details` GMD)
					  LEFT JOIN `userinfo` CU
						ON `CU`.`uID` = `GMD`.`to_user_id`
					  LEFT JOIN `city`
						ON `city`.`id` = `CU`.`city`
					WHERE `CU`.`uID` != ''
						AND `CU`.`forWebsite` = ".$this->forWebsite."
					ORDER BY `GMD`.`id` DESC";
		//print_r($this->db->last_query());exit;
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function getAllMassUserBK($userId){
		$this->db->select('GMD.*,CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.emailID cuEmail,city.city');
		$this->db->from('gbe_mass_details GMD');
		$this->db->join('userinfo CU','CU.uID = GMD.to_user_id','LEFT');
		$this->db->join('city','city.id = CU.city','LEFT');
		$this->db->where('GMD.user_id',$userId);
		$this->db->order_by('GMD.id','DESC');
		$sql = $this->db->get();
		return $sql->result();
	}
	
	public function getTotalMassUser($userId,$userLevel){
		$this->db->select('COUNT(DISTINCT GMD.to_user_id) tot');
		$this->db->from('gbe_mass_details GMD');
		$this->db->where('GMD.user_id',$userId);
		$this->db->where('GMD.user_level',$userLevel);
		$sql = $this->db->get();
		//$this->_p(0);
		$retData = $sql->result();
		return $retData[0]->tot;
	}
	
	public function getDayDiff($userId){
		$this->db->select(' MIN(id), (15 - TIMESTAMPDIFF(DAY,loginDateTime,NOW())) tot_day');
		$this->db->from('user_login_info');
		$this->db->where('userId',$userId);
		$sql = $this->db->get();
		$retData = $sql->result();
		return $retData[0]->tot_day;
	}
	
	public function aaa($userId){
		return $this->totalMassCountUnderUser($userId,0);	
	}
	
	public function totalMassCountUnderUser($userId){
		$counter = 0;
		$r1 = $this->getMassUserUnderNth($userId);//l1
		if($r1[0]->tot > 0 ){
			$counter = $counter + $r1[0]->tot;
			$r11 = $this->getMassUserUnderNth($r1[0]->ids);
			if($r11[0]->tot > 0 ){
				$counter = $counter + $r11[0]->tot;
				$r111 = $this->getMassUserUnderNth($r11[0]->ids);
				if($r111[0]->tot > 0 ){
					$counter = $counter + $r111[0]->tot;
					//$r111 = $this->getMassUserUnderNth($r111[0]->ids);
				}
			}
		}
		return $counter;
	}
	
	public function getMassUserUnderNth($userId){
		$this->db->select('GROUP_CONCAT(DISTINCT to_user_id) ids,COUNT(user_id) tot');
		$this->db->from('gbe_mass_details');
		$this->db->where_in('user_id',$userId);
		$this->db->group_by('user_id');
		$sql = $this->db->get();
				//$this->_p(1);
		return $sql->result();	
	}
	
	public function getMassUserLevel($userId){
		$this->db->select('L1.to_user_id    l4,L2.to_user_id    l3,L3.to_user_id    l2,L4.to_user_id    l1');
		$this->db->from('gbe_mass_details L1');
		$this->db->join('gbe_mass_details L2','L2.to_user_id = L1.user_id','LEFT');
		$this->db->join('gbe_mass_details L3','L3.to_user_id = L2.user_id','LEFT');
		$this->db->join('gbe_mass_details L4','L4.to_user_id = L3.user_id','LEFT');
		$this->db->where('L1.to_user_id',$userId);
		$sql = $this->db->get();
		return $sql->result();	
	}
	
	
	private function _p($s = 1){
		print_r($this->db->last_query());
		echo '<br>';
		if($s == 0){
			exit;
		}
		return true;
	}
	// function added by SB to check userLevel Child exists
	public function volChildExits($level,$city){
		$sql 	=	   "SELECT GMDS.to_user_id  
						FROM gbe_mass_details GMDS 
						LEFT JOIN userinfo UINF
						ON UINF.uID=GMDS.user_id						
						WHERE GMDS.user_id IN (SELECT GROUP_CONCAT(GMD.to_user_id) FROM gbe_mass_details GMD WHERE GMD.user_level=".$level." )
						AND UINF.city=".$city."
						AND UINF.forWebsite=".$this->forWebsite."
						ORDER BY GMDS.id ASC LIMIT 1";
		$query = $this->db->query($sql);
		
		if( $query->num_rows()> 0 ){
				return 1;
				 
			}else{
				return 0;
			}	
		
	}
	
	// get 1 volunteer on that level
	public function getOneVolunteer($level,$city){
		$sql ="SELECT GMD.to_user_id 
				FROM gbe_mass_details GMD
				LEFT JOIN userinfo UINF
				ON UINF.uID=GMD.to_user_id				
				WHERE GMD.user_level=".$level." 
				AND UINF.city=".$city."
				AND UINF.forWebsite=".$this->forWebsite."
				ORDER BY GMD.id ASC LIMIT 1";
				
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$retData = $query->result();
		return $retData[0]->to_user_id;
	}
	// pick 1 volunteer having child less than 12
	public function volChildLessThanTwelve($level,$city=1){
				$levelplusOne = $level+1;
				$sql ="SELECT
							tab1.to_user_id,
							tab2.total
							FROM (SELECT DISTINCT GBD.to_user_id
										FROM gbe_mass_details GBD, userinfo UNIF
										WHERE GBD.user_level =".$level."
										AND GBD.to_user_id = UNIF.uID
										AND UNIF.city =".$city."
										AND UNIF.forWebsite=".$this->forWebsite.") AS tab1
							LEFT JOIN (SELECT
										GBD.user_id,
										COUNT(id) total
										FROM gbe_mass_details GBD
										WHERE GBD.user_level = ".$levelplusOne."
										GROUP BY GBD.user_id
										HAVING total<12
										ORDER BY total ASC,GBD.user_id ASC) AS tab2
							ON tab2.user_id = tab1.to_user_id
							WHERE tab2.user_id IS NOT NULL
							ORDER BY tab2.total ASC,tab1.to_user_id ASC
							LIMIT 0,1
							";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		if( $query->num_rows()> 0 ){
			$retData = $query->result();
				return $retData[0]->to_user_id;
				 
			}else{
				return 0;
			}	
	}
// start below functions added by SB From 09-06-2016
		/* function isMemberExist($UID){
				if( $UID > 0 ){
					$this->db->select('vip_userinfo.uID');
					$this->db->from('vip_userinfo');
					$this->db->where('vip_userinfo.uID',$UID);
					$this->db->where('vip_userinfo.status',"1");
					$query=$this->db->get();
					if( $query->num_rows()== 1 ){
						return true;
					}else{
						return false;
					}
				}
			} */
			// above function is blocked by SB on 13/07/2016 for single table access for vip & rave. 
			function isMemberExist($UID){
				if( $UID > 0 ){
					$this->db->select('rave_userinfo.uID');
					$this->db->from('rave_userinfo');
					$this->db->where('rave_userinfo.uID',$UID);
					$this->db->where('rave_userinfo.status',"1");
					$query=$this->db->get();
					if( $query->num_rows()== 1 ){
						return true;
					}else{
						return false;
					}
				}
			}
		/* function chkUserAuth($emailID,$pass){
			if( $emailID !="" && $pass !="" ){
				$this->db->select('vip_userinfo.*');
				$this->db->from('vip_userinfo');
				$this->db->where('vip_userinfo.emailID',$emailID);
				$this->db->where('vip_userinfo.password',$pass);
				//$this->db->where('vip_userinfo.forWebsite',$this->forWebsite);
				$query = $this->db->get();
				if( $query->num_rows()== 1 )
				{
					$temp = $query->result_array(); 
					return $temp[0]; 
				}else
				{
					return false;
				}
			}
		} */
		// above function is blocked by SB on 13/07/2016 for single table access for vip & rave. 
		function chkUserAuth($emailID,$pass){
			if( $emailID !="" && $pass !="" ){
				$this->db->select('rave_userinfo.*');
				$this->db->from('rave_userinfo');
				$this->db->where('rave_userinfo.emailID',$emailID);
				$this->db->where('rave_userinfo.password',$pass);
				//$this->db->where('vip_userinfo.forWebsite',$this->forWebsite);
				$query = $this->db->get();
				if( $query->num_rows()== 1 )
				{
					$temp = $query->result_array(); 
					return $temp[0]; 
				}else
				{
					return false;
				}
			}
		}
   /*  function getUserInfo($UID){
            if( $UID != "" ){
                $this->db->select('vip_userinfo.*,city.city cityName,city.id city_id,country.country_id,country.name countryName');
                $this->db->from('vip_userinfo');
                $this->db->join("city","city.id=vip_userinfo.city AND city.is_active=1","LEFT");
                $this->db->join("country","country.country_id=vip_userinfo.country AND country.status=1","LEFT");				
                $this->db->where('vip_userinfo.uID',$UID);
                $query = $this->db->get();
				//echo $this->db->last_query();
                return $query->result_array();
            }
	} */
	// above function is blocked by SB on 13/07/2016 for single table access for vip & rave.
	 function getUserInfo($UID){
            if( $UID != "" ){
                $this->db->select('rave_userinfo.*,city.city cityName,city.id city_id,country.country_id,country.name countryName');
                $this->db->from('rave_userinfo');
                $this->db->join("city","city.id=rave_userinfo.city AND city.is_active=1","LEFT");
                $this->db->join("country","country.country_id=rave_userinfo.country AND country.status=1","LEFT");				
                $this->db->where('rave_userinfo.uID',$UID);
                $query = $this->db->get();
				//echo $this->db->last_query();
                return $query->result_array();
            }
	}
	 public function getCategory(){
            $this->db->select('ct_category.*');
            $this->db->from('ct_category');
           // $this->db->where('status',1);
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $query->result();
        }
	function insertData($data){
		$this->db->set('firstName',$data['name']);
		$this->db->set('lastName',$data['surname']);
		$this->db->set('userName',$data['name'].'_'.$data['surname']);
		$this->db->set('password',$data['password']);
		$this->db->set('phone',$data['cellno']);
		$this->db->set('emailID',$data['emailAddr']);
		$this->db->set('city',$data['city']);
		$this->db->set('currency',$data['currency']);
		if($data['country']!=""){
			$this->db->set('country',$data['country']);	
		}
		$this->db->set('skypeID',$data['skypeID']);
		$this->db->set('userType',$data['userType']);
		$this->db->set('referarID',$data['parentID']);
		if($data['userLevel']!=""){
			$this->db->set('userLevel',$data['userLevel']);	
		}
		$this->db->set('status','1');
        $this->db->set('created_date',  date("Y-m-d H:i:s"));		
		$this->db->set('forWebsite',$data['forWebsite']);
		//$this->db->insert('vip_userinfo');
		$this->db->insert('rave_userinfo');
		$id =  $this->db->insert_id();
        $this->updateUserName($id);
		//$this->createRoute();
		return $id;
	}
	/*  function updateUserName($userID = 0){
            $this->db->select('vip_userinfo.*');
            $this->db->from('vip_userinfo');
            $this->db->where('uID',$userID);
            $query = $this->db->get();
            $result = $query->result();
            if($result[0]->firstName != "" && $result[0]->lastName != ""){
                $sql = " UPDATE vip_userinfo SET vip_userinfo.userName=CONCAT(REPLACE(vip_userinfo.firstName,' ',''),'.',REPLACE(vip_userinfo.lastName,' ',''),'.',vip_userinfo.uID) WHERE vip_userinfo.uID =".$userID;
            }elseif($result[0]->firstName !="" && $result[0]->lastName == ""){
                $sql = " UPDATE vip_userinfo SET vip_userinfo.userName=CONCAT(REPLACE(vip_userinfo.firstName,' ',''),'.',vip_userinfo.uID) WHERE vip_userinfo.uID =".$userID;
            }
            $this->db->query($sql);
            return true;
        } */
		function updateUserName($userID = 0){
            $this->db->select('rave_userinfo.*');
            $this->db->from('rave_userinfo');
            $this->db->where('uID',$userID);
            $query = $this->db->get();
            $result = $query->result();
            if($result[0]->firstName != "" && $result[0]->lastName != ""){
                $sql = " UPDATE rave_userinfo SET rave_userinfo.userName=CONCAT(REPLACE(rave_userinfo.firstName,' ',''),'.',REPLACE(rave_userinfo.lastName,' ',''),'.',rave_userinfo.uID) WHERE rave_userinfo.uID =".$userID;
            }elseif($result[0]->firstName !="" && $result[0]->lastName == ""){
                $sql = " UPDATE rave_userinfo SET rave_userinfo.userName=CONCAT(REPLACE(rave_userinfo.firstName,' ',''),'.',rave_userinfo.uID) WHERE rave_userinfo.uID =".$userID;
            }
            $this->db->query($sql);
            return true;
        }
	/* public function getMyRefUsers($userId){
		
		$sql = "SELECT
					  `VMD`.*,
					  `CU`.`uID`,
					  `CU`.`referarID`,
					  `CU`.`firstName`    cuFName,
					  `CU`.`lastName`     cuLName,
					  `CU`.`emailID`      cuEmail,
					  `CU`.`phone`        cuPhone
					FROM (`vip_mass_details` VMD)
					  LEFT JOIN `vip_userinfo` CU
						ON `CU`.`uID` = `VMD`.`to_user_id`					 
					WHERE `CU`.`uID` != ''
						AND `CU`.`forWebsite` = ".$this->forWebsite."
						AND `CU`.`referarID` =".$userId."
					ORDER BY `VMD`.`id` DESC";
		//print_r($this->db->last_query());exit;
		$query = $this->db->query($sql);
		return $query->result();
	} */
	// above function is blocked by SB on 13/07/2016 for single table access for vip & rave.
	public function getMyRefUsers($userId){
		
		/*$sql = "SELECT
					  `VMD`.*,
					  `CU`.`uID`,
					  `CU`.`referarID`,
					  `CU`.`firstName`    cuFName,
					  `CU`.`lastName`     cuLName,
					  `CU`.`emailID`      cuEmail,
					  `CU`.`phone`        cuPhone,
					  `CU`.`afrooPaymentStatus`,
					  `CU`.`userType`
					FROM (`vip_mass_details` VMD)
					  LEFT JOIN `rave_userinfo` CU
						ON `CU`.`uID` = `VMD`.`to_user_id`					 
					WHERE `CU`.`uID` != ''
						AND `CU`.`forWebsite` = ".$this->forWebsite."
						AND `CU`.`referarID` =".$userId."
					ORDER BY `VMD`.`id` DESC"; */
			$sql = "SELECT
					  `VMD`.*,
					  `CU`.`uID`,
					  `CU`.`referarID`,
					  `CU`.`firstName`    cuFName,
					  `CU`.`lastName`     cuLName,
					  `CU`.`emailID`      cuEmail,
					  `CU`.`phone`        cuPhone,
					  `CU`.`afrooPaymentStatus`,
					  `CU`.`userType`
					FROM (`vip_mass_details` VMD)
					  RIGHT JOIN `rave_userinfo` CU
						ON `VMD`.`to_user_id`=`CU`.`uID`				 
					WHERE `CU`.`uID` != ''
						AND `CU`.`forWebsite` = ".$this->forWebsite."
						AND `CU`.`referarID` =".$userId."
					ORDER BY `VMD`.`id` DESC";
		//print_r($this->db->last_query());exit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	/*public function getRaveJoinInviUser($userId){		
		$sql = "SELECT vip.uID,vip.emailID,vip.firstName,vip.lastName 
					FROM vip_userinfo vip 
					WHERE vip.referarID=".$userId."  
					AND vip.uID NOT IN (SELECT to_userId FROM vip_rave_join_invitation 
					WHERE referrerId=".$userId.")";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getRaveJoinInviUserAll($userId){
		$sql = "SELECT uID,emailID,firstName,lastName 
					FROM vip_userinfo 
					WHERE referarID= '".$userId."'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}*/
	public function addMailInvitation($data){
		
		$this->db->set('to_userId',$data['to_userId']);
		$this->db->set('referrerId',$data['referrerId']);
		$this->db->set('mail_send_status','1');
		$this->db->set('mail_message',$data['mail_message']);
		$this->db->set('mail_date',$data['mail_date']);		
		$this->db->insert('vip_rave_join_invitation');
		$id = $this->db->insert_id();        
		return $id;
	
	}
	/* public function getVipUserDetails($signupId){
		$this->db->select('CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.password cupwd,CU.emailID cuEmail,CU.userType cuUserType,CU.userLevel cuUserLevel,PU.firstName puFName,PU.lastName puLName,PU.userType puUserType,VMD.message');
		$this->db->from('vip_userinfo CU');
		$this->db->join('vip_userinfo PU','PU.uID = CU.referarID','LEFT');
		$this->db->join('vip_mass_details VMD','VMD.to_user_id = CU.uID','LEFT');
		$this->db->where('CU.uID',$signupId);
		$sql = $this->db->get();
		return $sql->result();
	} */
	// above function is blocked by SB on 13/07/2016 for single table access for vip & rave.
	public function getVipUserDetails($signupId){
		$this->db->select('CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.password cupwd,CU.emailID cuEmail,CU.userType cuUserType,CU.userLevel cuUserLevel,PU.firstName puFName,PU.lastName puLName,PU.userType puUserType,VMD.message');
		$this->db->from('rave_userinfo CU');
		$this->db->join('rave_userinfo PU','PU.uID = CU.referarID','LEFT');
		$this->db->join('vip_mass_details VMD','VMD.to_user_id = CU.uID','LEFT');
		$this->db->where('CU.uID',$signupId);
		$sql = $this->db->get();
		return $sql->result();
	}
	public function getReferedUserForPayment($userId){
		$sql = "SELECT ru.uID,ru.emailID,ru.firstName,ru.lastName 
					FROM rave_userinfo ru 
					WHERE ru.afrooPaymentStatus=1 
					AND ru.referarID=".$userId."  
					AND ru.uID NOT IN (SELECT to_userId FROM vip_rave_join_invitation 
					WHERE referrerId=".$userId.")";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	// function added by SB for next cycle entry start ---move this function to gateway model later 
	function getNextCycleUser(){

		$sql= "SELECT RNC.uID,RS.userCycle 
						FROM rave_NextCycleUser RNC 
						LEFT JOIN rave_share RS
						ON RS.user_id=RNC.uID
						WHERE RS.status=1 ";

		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}
	
	
	//next cycle entry end
	
	// end  of  functions added by SB 
}



?>