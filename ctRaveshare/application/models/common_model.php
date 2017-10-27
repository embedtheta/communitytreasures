<?php

class common_model extends CI_model {
	public $forWebsite;
    function __construct() {
        parent::__construct();
		$this->forWebsite = 2;// For community
    }

    public function insertDataToTable($tbl = '', $data = array()) {
        if ($tbl != '' && !empty($data) && sizeof($data) > 0) {
            $this->db->insert($tbl, $data);
			//print_r($this->db->last_query());
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
	//7/10/2015 ujjwal sana added
	public function getLevelWiseVideoById($VideoId){
		 $this->db->select('gbe_level_video.*');
            $this->db->from('gbe_level_video');
			$this->db->where('gbe_level_video.forWebsite',1);
            $this->db->where_in('gbe_level_video.id',$VideoId);
			
			
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
	
    public function updateDataToTable($tbl = '', $where = array(), $data = array() ) {
        if (trim($tbl) != '' && !empty($tbl) && sizeof($where) > 0) {
            foreach ($where as $key => $v) {
                $this->db->where(trim($key), trim($v));
            }
			//print_r($data);exit;
            $rdata = $this->db->update(trim($tbl), $data);
            if ($rdata) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    
    public function fetchDataFromTable($tbl = '', $where = array(), $selectedData = '') {
        if (trim($tbl) != '' && !empty($tbl)) {
            if ($selectedData != '') {
                $this->db->select($selectedData);
            } else {
                $this->db->select('*');
            }
            $this->db->from($tbl);
            if (sizeof($where) > 0) {
                foreach ($where as $key => $v) {
                    $this->db->where(trim($key), trim($v));
                }
            }
            $sql = $this->db->get();
            return $sql->result();
        }
    }
    
    public function fetchDataFromTableOrderBy($tbl = '', $where = array(), $selectedData = '', $orderBy = array()) {
        if (trim($tbl) != '' && !empty($tbl)) {
            if ($selectedData != '') {
                $this->db->select($selectedData);
            } else {
                $this->db->select('*');
            }
            $this->db->from($tbl);
            if (sizeof($where) > 0) {
                foreach ($where as $key => $v) {
                    $this->db->where(trim($key), trim($v));
                }
            }
            if (sizeof($orderBy) > 0) {
                foreach ($orderBy as $oKey => $oValue) {
                    $this->db->order_by(trim($oKey), trim($oValue));
                }
            }
            $sql = $this->db->get();
            return $sql->result();
        }
    }

    public function deleteDataFromTable($tbl = '', $where = array(),$forwebsite) {
        if (trim($tbl) != '' && !empty($tbl) && sizeof($where) > 0) {
            foreach ($where as $key => $v) {
                $this->db->where(trim($key), trim($v));
            }
			 //$this->db->where('forWebsite',$forwebsite); //14/09/2015 commented by ujjwal sana
            $this->db->delete(trim($tbl));
            return true;
        } else {
            return false;
        }
    }

    public function getSuccessErrorMsg($msg = '', $type = '') {
        $color = ''; // it will change in class
        if ($type == 1) {
            $color = '090';
        } elseif ($type == 2) {
            $color = '933';
        }
        if ($msg != '' && $color != '') {
            $ret_data = '<span style="color:#' . $color . ';" >' . $msg . '</span>';
        }
        return $ret_data;
    }

    public function imageUnlinkPath_profile() {
        $path = BASEPATH;
		$path=$this->config->item('gbe_image_upload_path');
        //$basePath = str_replace("system/", "", $path);		
        //return $basePath;
		return $path;
		
    }
public function imageUnlinkPath() {
        $path = BASEPATH;
		//$path=$this->config->item('gbe_image_upload_path');
        $basePath = str_replace("system/", "", $path);		
        return $basePath;
		return $path;
		
    }
   

    public function change_status_from_table($tbl = '', $id = '') {
        $id = trim($id);
        if ($tbl != '' && $id != '') {
            $sql = "UPDATE `" . $tbl . "` SET `" . $tbl . "`.`status`=IF(`" . $tbl . "`.`status`=1,2,1) WHERE `" . $tbl . "`.`id`=" . $id;
            $this->db->query($sql);
        }
        $sql = '';
        $sql = "SELECT `" . $tbl . "`.`status` FROM `" . $tbl . "` WHERE `" . $tbl . "`.`id`=" . $id;
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function adminCommonPagination() {
        $page['full_tag_open'] = '<div class="new-pagi">';
        $page['full_tag_close'] = '</div>';
        $page['first_link'] = FALSE;
        $page['last_link'] = FALSE;
        $page['prev_link'] = '&lsaquo;&lsaquo; Previous Page';
        $page['next_tag_open'] = '';
        $page['next_tag_close'] = '';
        $page['next_link'] = 'Next page &rsaquo;&rsaquo;';
        $page['prev_tag_open'] = '';
        $page['prev_tag_close'] = '';
        $page['anchor_class'] = 'class="page-count"';
        $page['cur_tag_open'] = '<span class="page-label active-page">';
        $page['cur_tag_close'] = '</span>';
        return $page;
    }
	//4/9/2015 ujjwal sana done
	 public function insertDataToTable_for_signup($tbl = '', $data = array()) {
        if ($tbl != '' && !empty($data) && sizeof($data) > 0) {
            $this->db->insert($tbl, $data);
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    public function valid_url($str) {
        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
        if (!preg_match($pattern, $str)) {
            return FALSE;
        }
        return TRUE;
    }
    
	// Added by SB on 11/12/2015
	public function getTotalMembersUnderMeNew($userid){
		//$this->db->select('COUNT(DISTINCT(userinfo.uID)) as total');
	//	$this->db->from('userinfo');
		//$this->db->where("referarID",$userid);
		$sql ="select COUNT(DISTINCT(userinfo.uID)) as total 
								FROM userinfo ,user_login_info uid 
								WHERE userinfo.uID=uid.userId
								AND userinfo.referarID =".$userid;
        $query = $this->db->query($sql);
        $retData = $query->result();
        return $retData[0]->total;
	}
	public function ct_category()//this portion have to be change
	{
		$sql="select productmenucontent.id,productmenucontent.title from productmenucontent
		LEFT JOIN menumanagement ON(productmenucontent.menu_id=menumanagement.menuID)
		where menumanagement.forWebsite=2 and productmenucontent.parent_article_id=0 order by productmenucontent.title";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function cate_description()//this portion have to be change
	{
		$sql="select productmenucontent.id,productmenucontent.title,productmenucontent.description,productmenucontent.image from productmenucontent
		LEFT JOIN menumanagement ON(productmenucontent.menu_id=menumanagement.menuID)
		where menumanagement.forWebsite=2 and productmenucontent.parent_article_id=0 order by productmenucontent.title";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function monetizer_list()
	{
		$sql="select * from ct_monetizer  order by title";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	public function getCTuname($uID)
	{
		$sql="select firstName from userinfo where uID=$uID";
		$query=$this->db->query($sql);
		$result = $query->result_array();
		return $result[0]['firstName'];
	}
	public function getcitylist()
	{
		$sql="select * from country order by country_id";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function getCtSponcerPicture($id)
	{
		$sql="select ct_sponcers.images from ct_sponcers where uID=$id";
		$query=$this->db->query($sql);
		$result =$query->result_array();
		return $result[0]['images'];
	}
	public function deleteSponcerProfilePic($id)
	{
		$sql="delete from  ct_sponcers where uID=$id";
		$query=$this->db->query($sql);
		//return $query->result_array();
	}
	public function getCtSourcePicture($pageId)
	{
		$sql="select * from CT_Source  where Mid=$pageId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function product_desc($pageId)
	{
		$sql="select * from productmenucontent where id=$pageId and parent_article_id=0";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function getmonetizer_user()
	{
		//echo "+++++++++++".$this->forWebsite;
		$forwensite=$this->forWebsite;
		$sql="select * from userinfo where forWebsite=$forwensite";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function getEvent()
	{
		$sql="select * from productmenucontent where menu_id=19";//19 is heard coded because there is one menu exist
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function event_details($eventId)
	{
		$sql="select * from productmenucontent where id=$eventId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function Top_six_Product($uId)
	{
		$sql="select * from top_seven_product where addedBy=$uId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	// added by SB for VIP section on 27/06/2016
	public function getCustomCountryList()
	{
		/* $sql="(SELECT C1.* , 0 AS TMP_ORDER
								from country C1 
								WHERE C1.country_id IN (13,38,222,223) 
								ORDER BY C1.name desc LIMIT 4)
								UNION 
								(SELECT C2.*, 1 AS TMP_ORDER
								FROM country C2 
								where C2.country_id NOT IN (13,38,222,223) 
								ORDER BY name) 
								ORDER BY TMP_ORDER ASC"; */  // blocked by SB on 30/06/2016
		$sql="(SELECT C1.* , 0 AS TMP_ORDER
								from country C1 
								WHERE C1.country_id IN (13,38,222,223) 
								ORDER BY C1.name desc LIMIT 4)
								UNION 
								(SELECT C2.*, 1 AS TMP_ORDER
								FROM country C2 								 
								ORDER BY name) 
								ORDER BY TMP_ORDER ASC";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	/*=================================ADDED BY DEBAYAN(15.07.2016)=================================*/
	function updateRaveUserName($userID = 0){
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
	function getDataFromRaveuserinfo($id=""){
		$sql = "SELECT RUI.*,(SELECT URT.raveType FROM user_raveshare_type URT WHERE URT.user_id='".$id."') AS user_type FROM rave_userinfo RUI WHERE uID='".$id."'";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}
	
	##########################Ruam#####################################
	
	public function fetchTopAds_visited($limit, $start, $user_id, $categoryId) {
		
				
		$this->db->select('*');
		$this->db->where('admin_ads.status','0');
		$this->db->where('admin_ads.categoryId != ','34');	
		$this->db->where('admin_ads.categoryId != ','59');
		$this->db->limit($limit, $start);
		$this->db->order_by("admin_ads.id", "ASC");
		//$this->db->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db->get('admin_ads');
        $num=$query->num_rows(); 
		if ($query->num_rows() < 10) {
			 $status=0;
			 $value=array('status'=>$status);
			 $this->db->order_by("id", "ASC");
			 $this->db->update('admin_ads',$value);
			 
			 #############################
		foreach ($query->result() as $row) {
                $data[] = $row;
		    }
      	
		$lim=$limit-$num;
		
		$this->db->select('*');
		$this->db->where('admin_ads.status','0');
		$this->db->where('admin_ads.categoryId != ','34');	
		$this->db->where('admin_ads.categoryId != ','59');
		$this->db->limit($lim, $start);
		$this->db->order_by("admin_ads.id", "ASC");
		//$this->db->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db->get('admin_ads');
		
		
		foreach ($query->result() as $row2) {
                $data2[] = $row2;
		    }

		$data=array_merge($data,$data2);
        return $data;		
		}
		
		        
        
		foreach ($query->result() as $row) {
			$row->visited_status=$this->get_visited_status($user_id,$row->id);
			$data[] = $row;
		}
            return $data;
       
        //return false;
   }
   
   public function get_visited_status($user_id,$ad_id)
   {
		
	$this->db->select('*');
	$this->db->where('watch_video_task.user_id',$user_id);
	$this->db->where('watch_video_task.ad_id',$ad_id);
	$query = $this->db->get('watch_video_task');
	//echo $this->db2->last_query();
	$num=$query->num_rows(); 
	if($num > 0)
	{
		return 1;
	}
	else{
		return 0;
		
	}
	   
   }
   
   
    public function fetchTopAds_visited_music($limit, $start, $user_id, $categoryId) {
		
		$this->db->select('*');
		if($categoryId){
		 $this->db->where('admin_ads.categoryId',$categoryId);	
		}
		$this->db->where('admin_ads.status','0');
		$this->db->limit($limit, $start);
		$this->db->order_by("admin_ads.id", "ASC");
		//$this->db->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db->get('admin_ads');
        $num=$query->num_rows(); 
		
		if ($query->num_rows() < 1) {
			 $status=0;
			 $value=array('status'=>$status);
			 $this->db->order_by("id", "ASC");
			 $this->db->where('admin_ads.categoryId',$categoryId);
			 $this->db->update('admin_ads',$value);
			 
			 #############################
		foreach ($query->result() as $row) {
			    $row->visited_status_music=$this->get_visited_status_music($user_id,$row->id);
                $data[] = $row;
		    }
       		
		$lim=$limit-$num;
		
		$this->db->select('*');
		if($categoryId){
		 $this->db->where('admin_ads.categoryId',$categoryId);	
		}
		$this->db->where('admin_ads.status','0');
		$this->db->limit($lim, $start);
		$this->db->order_by("admin_ads.id", "ASC");
		//$this->db->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db->get('admin_ads');
		$this->db->last_query();
		
		foreach ($query->result() as $row2) {
                $data2[] = $row2;
		    }
			return $data2;
		$data=array_merge($data,$data2);
       
        return $data;		
		}
		
		foreach ($query->result() as $row) {
			$row->visited_status_music=$this->get_visited_status_music($user_id,$row->id);
                $data[] = $row;
		    }
            return $data;
       
        return false;
   }
   
   public function get_visited_status_music($user_id,$ad_id)
   {
		
	$this->db->select('*');
	$this->db->where('watch_video_task.user_id',$user_id);
	$this->db->where('watch_video_task.ad_id',$ad_id);
	$query = $this->db->get('watch_video_task');
	//echo $this->db2->last_query();
	$num=$query->num_rows(); 
	if($num > 0)
	{
		return 1;
	}
	else{
		return 0;
		
	}
	   
   }
   
   
   public function fetchTopAds_visited_events($limit, $start, $user_id, $categoryId) {
		
	
		$this->db->select('*');
		if($categoryId){
		 $this->db->where('admin_ads.categoryId',$categoryId);	
		}
		$this->db->where('admin_ads.status','0');
		$this->db->limit($limit, $start);
		$this->db->order_by("admin_ads.id", "ASC");
		//$this->db->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db->get('admin_ads');
        $num=$query->num_rows(); 
		
		if ($query->num_rows() < 1) {
			 $status=0;
			 $value=array('status'=>$status);
			 $this->db->order_by("id", "ASC");
			 $this->db->where('admin_ads.categoryId',$categoryId);
			 $this->db->update('admin_ads',$value);
			 
			 #############################
		foreach ($query->result() as $row) {
			    $row->visited_status_events=$this->get_visited_status_events($user_id,$row->id);
                $data[] = $row;
		    }
       		
		$lim=$limit-$num;
		
		$this->db->select('*');
		if($categoryId){
		 $this->db->where('admin_ads.categoryId',$categoryId);	
		}
		$this->db->where('admin_ads.status','0');
		$this->db->limit($lim, $start);
		$this->db->order_by("admin_ads.id", "ASC");
		//$this->db->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db->get('admin_ads');
		$this->db->last_query();
		
		foreach ($query->result() as $row2) {
			    $row->visited_status_events=$this->get_visited_status_events($user_id,$row->id);
                $data2[] = $row2;
		    }
			return $data2;
	
		$data=array_merge($data,$data2);
        return $data;		
		}
		
		 
		 
            foreach ($query->result() as $row) {
                $data[] = $row;
		    }
            return $data;
       
        return false;
   }
   
   
   public function get_visited_status_events($user_id,$ad_id)
   {
		
	$this->db->select('*');
	$this->db->where('watch_video_task.user_id',$user_id);
	$this->db->where('watch_video_task.ad_id',$ad_id);
	$query = $this->db->get('watch_video_task');
	//echo $this->db2->last_query();
	$num=$query->num_rows(); 
	if($num > 0)
	{
		return 1;
	}
	else{
		return 0;
		
	}
	   
   }
   
   
   public function fetchBanner() {
	    
        $this->db->order_by("id", "ASC"); 
        $query = $this->db->get("admin_adbanner");
         
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function fetch_adcms() {
	    $this->db->where('id','1');
        $query = $this->db->get("admin_adscms");
         
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function getCategory($id) {
		
        $this->db->where('ct_category.id',$id);
        $query = $this->db->get("ct_category");
        //echo $this->db->last_query(); die;
         
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row;
            }
           
        }
        return false;
    }

	function explore_task($id,$user_id) {
     
     $data = array(
            'user_id' => $user_id,
            'ad_id' => $id,
			'is_visited' => 1,
			'visited_date' => date('Y-m-d'),
    );

    $this->db->insert('watch_video_task', $data);

    }
	
	 public function totalAds_count($categoryId) {
    	if($categoryId){
    	$this->db->where('categoryId',$categoryId);	
    	}
    	return $this->db->count_all("admin_ads");
    }
	
}

?>