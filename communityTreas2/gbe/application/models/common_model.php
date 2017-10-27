<?php

class common_model extends CI_model {

    function _construct() {
        parent::__construct();
    }

    public function insertDataToTable($tbl = '', $data = array()) {
		
        if ($tbl != '' && !empty($data) && sizeof($data) > 0) {
            $this->db->insert($tbl, $data);
			echo $this->db->insert_id();exit;
			 return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function updateDataToTable($tbl = '', $where = array(), $data = array() ) {
        if (trim($tbl) != '' && !empty($tbl) && sizeof($where) > 0) {
            foreach ($where as $key => $v) {
                $this->db->where(trim($key), trim($v));
            }
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
            /*print_r($this->db->last_query());
            exit;*/
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

    public function deleteDataFromTable($tbl = '', $where = array()) {
        if (trim($tbl) != '' && !empty($tbl) && sizeof($where) > 0) {
            foreach ($where as $key => $v) {
                $this->db->where(trim($key), trim($v));
            }
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

    public function imageUnlinkPath() {
        $path = BASEPATH;
        $basePath = str_replace("system/", "", $path);
        return $basePath;
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
    
    public function valid_url($str) {
        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
        if (!preg_match($pattern, $str)) {
            return FALSE;
        }
        return TRUE;
    }
    
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



    ################## code for pagination by Subhendu 12-07-2016 ################
    public function record_count() {
        return $this->db->count_all("admin_ads");
    }

    public function fetch_countries($limit, $start, $title) {
		
        $id=$this->uri->segment(3);
		if ($title != '') {	
				$this->db->limit($limit, $start);
                $this->db->where("admin_ads.title", $title);
				$this->db->order_by("id", "desc"); 
				$query = $this->db->get("admin_ads");
				
				if ($query->num_rows() > 0) {
					foreach ($query->result() as $row) {
						$data[] = $row;
					}
					return $data;
				}
            }
		else if($id !=0)
		{
			$this->db->where("admin_ads.id", $id);			 
			$query = $this->db->get("admin_ads");
			
			if ($query->num_rows() > 0) {
					foreach ($query->result() as $row) {
						$data[] = $row;
					}
					return $data;
				}
		}
		
		else 
		{
			$this->db->limit($limit, $start);
			$this->db->order_by("id", "desc"); 
			$query = $this->db->get("admin_ads");
			
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
		}	
        return false;
   }
   
   
   public function getAdsNameByName($adName=''){
		$this->db->select('id,title');
		$this->db->from('admin_ads');
		if( trim( $adName ) != "" ) {
			$this->db->like('title', $adName);
			//$this->db->where('status', '1');
		}
		$this->db->limit(50);
		$sql=$this->db->get();

		return $sql->result_array();

	}

   public function fetchAdsList($limit, $start,$categoryId) {
   $this->db->select('CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.password cupwd,CU.emailID cuEmail,CU.userType cuUserType,CU.userLevel cuUserLevel,PU.firstName puFName,PU.lastName puLName,PU.userType puUserType,GMD.message');
        $this->db->from('userinfo CU');
        $this->db->join('userinfo PU','PU.uID = CU.referarID','LEFT');
        $this->db->join('gbe_mass_details GMD','GMD.to_user_id = CU.uID','LEFT');
        $this->db->where('CU.uID',$signupId);
        $query = $this->db->get();
         if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
          }

    public function fetch_category($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by("title", "ASC"); 
        $query = $this->db->get("ct_category");
         
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getCategoryTitle($id) {
        $this->db->where('ct_category.id',$id);
        $query = $this->db->get("ct_category");
        //echo $this->db->last_query();
         
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row;
            }
           
        }
        return false;
    }
    ################## End By subhendu ###########################################
	
	################## Category Management BY RUMA 12-01-2017 ################
	
	public function record_count_category() {
        return $this->db->count_all("ct_category");
    }
	
	 public function fetchCategoryContent($tbl = '', $where = array(), $selectedData = '', $orderBy = array()) {
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
	
	public function fetchBannerContent($tbl = '', $where = array(), $selectedData = '', $orderBy = array()) {
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
	
	public function record_count_banner() {
        return $this->db->count_all("admin_adbanner");
    }
	
	public function fetch_banner($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by("banner_title", "ASC"); 
        $query = $this->db->get("admin_adbanner");
         
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function updateAdContent($data=array() ) {
				
        if(!empty($data)){
			if(trim($data['youtubeurl'])!=""){
				$this->db->set('admin_adscms.youtubeurl',trim($data['youtubeurl']));
			}
						 
			$this->db->where('id', '1');
		    $rs=$this->db->update('admin_adscms');
			
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
    }
    	 public function fetchAdContent($tbl = '', $where = array(), $selectedData = '', $orderBy = array()) {
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
	

}

?>