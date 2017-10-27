<?php

class common_model extends CI_model {

    function _construct() {
        parent::__construct();
    }

    public function insertDataToTable($tbl = '', $data = array()) {
        if ($tbl != '' && !empty($data) && sizeof($data) > 0) {
            $this->db->insert($tbl, $data);
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

}

?>