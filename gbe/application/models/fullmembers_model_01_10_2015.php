<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fullmembers_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
		
	public function getLevelTwoVideo(){
		$this->db->select('gbe_level_video.*');
		$this->db->from('gbe_level_video');
		$this->db->where('gbe_level_video.level',2);
		$this->db->where('gbe_level_video.forWebsite',1);
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
	
	public function checkEmailExist($email,$uID){
		$this->db->select('userinfo.uID');
		$this->db->from('userinfo');
		$this->db->where("emailID",$email);
		$this->db->where("uID <>",$uID);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function getLevel2Statistics($userType,$userId,$userLevel){
		if($userType == "PAYING USER"){
			$sql = $this->getPayingUserStatisticsSQL($userType,$userId,$userLevel);	
		}else{
			$sql = $this->getOthersUserStatisticsSQL($userType,$userId,$userLevel);
		}
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	public function getPayingUserStatisticsSQL($userType,$userId,$userLevel){
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
					AND UINFO.userLevel = ".$userLevel."
					AND UINFO.userType = 'PAYING USER'
				ORDER BY UINFO.uID  DESC";
		return $sql;
	}
	
	public function getOthersUserStatisticsSQL($userType,$userId,$userLevel){
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
					AND UINFO.userLevel = ".$userLevel."
				ORDER BY UINFO.uID  DESC";
		return $sql;
	}
	
	public function getPostCategoryList(){
		$this->db->select('gbe_blog_category.*');
		$this->db->from('gbe_blog_category');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getAllPost(){
		$this->db->select('GBP.*,userinfo.firstName,userinfo.lastName,userinfo.profile');
		$this->db->from('gbe_blog_posts GBP');
		$this->db->join("userinfo","userinfo.uID=GBP.post_auther_id","LEFT");
		$this->db->where("GBP.admin_permission",1);
		$this->db->order_by('GBP.post_id','DESC');
		$this->db->limit(6);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getPostById($postId){
		$this->db->select('GBP.*');
		$this->db->from('gbe_blog_posts GBP');
		$this->db->where("GBP.post_id",$postId);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getAllBrochure(){
		$this->db->select('GBV.*' );
		$this->db->from('gbe_brochure_vcards GBV');
		$this->db->where('GBV.data_type','brochure');
      	$this->db->order_by('GBV.id','DESC');
		$this->db->limit(8);
		$query = $this->db->get();
        return $query->result();
	}
	
	public function getAllPostVcards(){
		$this->db->select('GBV.*' );
		$this->db->from('gbe_brochure_vcards GBV');
		$this->db->where('GBV.data_type','vcards');
      	$this->db->order_by('GBV.id','DESC');
		$this->db->limit(8);
		$query = $this->db->get();
        return $query->result();
	}
	
	public function getTotalMembersUnderMe($userid){
		$this->db->select('COUNT(DISTINCT(userinfo.uID)) as total');
		$this->db->from('userinfo');
		$this->db->where("referarID",$userid);
        $query = $this->db->get();
        $retData = $query->result();
        return $retData[0]->total;
	}
	
	public function getUpYoutube(){
		$this->db->select('GBV.*' );
		$this->db->from('level_2_step_2_youtube GBV');
		$this->db->where('GBV.show_for','up');
		$this->db->where('GBV.admin_approval','active');
      	$this->db->order_by('GBV.id','DESC');
		$this->db->limit(36);
		$query = $this->db->get();
        return $query->result();
	}
	public function getDownYoutube(){
		$this->db->select('GBV.*' );
		$this->db->from('level_2_step_2_youtube GBV');
		$this->db->where('GBV.show_for','down');
      	$this->db->order_by('GBV.id','DESC');
		$this->db->limit(100);
		$query = $this->db->get();
        return $query->result();
	}
	
	public function getDownYoutubeCount($userId){
		$sql = "SELECT
				  COUNT(id) AS total
				FROM level_2_step_2_youtube
				WHERE user_id = ".$userId."
					AND show_for = 'down'
					AND MONTH(created_date) = MONTH(NOW())";
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		$retData = $query->result();
        return $retData[0]->total;
	}
	
	public function updateUrlTitle($post_id,$title_url){
		$this->db->select('post_id,post_title_url');
		$this->db->from('gbe_blog_posts');
		$this->db->where('post_title_url',$title_url);
		$this->db->where('post_id !=', $post_id);
		$query = $this->db->get();
        $data = $query->result();
		if($data[0]->post_id != ''){
			$sql = "UPDATE gbe_blog_posts  SET post_title_url = '".$title_url."-".$post_id."' WHERE post_id=".$post_id;
			$this->db->query($sql);
		}
		return true;	
		
	} 
	
	public function getEventDetailsMonthWise($year,$month,$searchData){
		$sql = 'SELECT 
					*,
					YEAR(start_date)   yyyy,
					MONTH(start_date)    mm,
					DAY(start_date)    dd
				FROM gbe_event
				WHERE YEAR(start_date) = '.$year.'
					AND MONTH(start_date) = '.$month.'
					AND `status` = 1';
		if(isset($searchData['country']) && $searchData['country'] > 0){
			$sql .= ' AND `country_id` ='.$searchData['country'];
		}
		if(isset($searchData['city']) && $searchData['city'] > 0){
			$sql .= ' AND `city_id` ='.$searchData['city'];
		}
		if(isset($searchData['zip_code']) && $searchData['zip_code'] > 0){
			$sql .= ' AND `zip_code_id` ='.$searchData['zip_code'];
		}
		$sql .=	' ORDER BY `id` DESC	';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function getTotalEventMonthWise($year,$searchData){
		$sql = 'SELECT 
					 MONTH(start_date)    months,
  					 CONCAT(MONTHNAME(STR_TO_DATE(MONTH(start_date), "%m")),"  <strong>",COUNT(id),"</strong>") total_with_name
				FROM gbe_event
				WHERE YEAR(start_date) = '.$year.' 
					AND `status` = 1';
		if(isset($searchData['country']) && $searchData['country'] > 0){
			$sql .= ' AND `country_id` ='.$searchData['country'];
		}
		if(isset($searchData['city']) && $searchData['city'] > 0){
			$sql .= ' AND `city_id` ='.$searchData['city'];
		}
		if(isset($searchData['zip_code']) && $searchData['zip_code'] > 0){
			$sql .= ' AND `zip_code_id` ='.$searchData['zip_code'];
		}
		$sql .=	' GROUP BY MONTH(start_date)';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	
}


?>