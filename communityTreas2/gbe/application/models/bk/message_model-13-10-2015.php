<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model {
	function __construct(){
		parent::__construct();
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
		$this->db->select('GMD.*,CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.emailID cuEmail,CU.phone cuPhone,city.city');
		$this->db->from('gbe_mass_details GMD');
		$this->db->join('userinfo CU','CU.uID = GMD.to_user_id','LEFT');
		$this->db->join('city','city.id = CU.city','LEFT');
		$this->db->where('CU.uID !=', "");
		$this->db->order_by('GMD.id','DESC');
		$sql = $this->db->get();
		//print_r($this->db->last_query());exit;
		return $sql->result();
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
						ORDER BY GMDS.id ASC LIMIT 1";
		$query = $this->db->query($sql);
		
		if( $query->num_rows()> 1 ){
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
										AND UNIF.city =".$city.") AS tab1
							LEFT JOIN (SELECT
										GBD.user_id,
										COUNT(id) total
										FROM gbe_mass_details GBD
										WHERE GBD.user_level = ".$levelplusOne."
										GROUP BY GBD.user_id
										ORDER BY total ASC,GBD.user_id ASC) AS tab2
							ON tab2.user_id = tab1.to_user_id
							ORDER BY tab2.total ASC,tab1.to_user_id ASC
							";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		if( $query->num_rows()> 1 ){
			return	$retData = $query->result_array();
				//return $retData[0]->to_user_id;
				 
			}else{
				return 0;
			}	
	}
}



?>