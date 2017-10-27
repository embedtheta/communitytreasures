<?php
class cron_gambia_dist_model extends CI_model {

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
	
	public function getAllGeneralUser($level,$forWebsite){
		$sql = "SELECT
				  `uID`,
				  `referarID`,
				  `userLevel`,
				  emailID
				FROM `userinfo`
				WHERE `status` = '1'
					AND `userType` = 'PAYING USER'
					AND `email_send_status` = 1
					AND `userLevel` = ".$level."
					AND `forWebsite` = ".$forWebsite."
					AND userinfo.referarID NOT IN(SELECT
													UINFOP.uID
												  FROM userinfo UINFOP
												  WHERE UINFOP.status = '1'
													  AND UINFOP.email_send_status = 1
													  AND (UINFOP.userType = 'TEACHER'
															OR UINFOP.userType = 'STUDENT'))
				ORDER BY `uID` ASC";
		$data = $this->db->query($sql);		
		return $data->result();		
		/*$this->db->select('uID,referarID,userLevel');
		$this->db->from('userinfo');
		$this->db->where('status', '1');
		$this->db->where('userType', 'PAYING USER');
		$this->db->where('email_send_status', 1);
		$this->db->where('userLevel', $level);
		$this->db->where('forWebsite', $forWebsite);
		$this->db->order_by('uID', 'ASC');
		$sql = $this->db->get();
		$this->_p();
		return $sql->result();*/
		
	}
	
	public function getGambianUser($level,$forWebsite){
		$sql = "SELECT
				  UINFO.uID,
				  UINFO.referarID,
				  UINFO.userLevel
				FROM userinfo UINFO
				WHERE UINFO.status = '1'
					AND UINFO.email_send_status = 1
					AND UINFO.userLevel = ".$level."
					AND UINFO.forWebsite = ".$forWebsite."
					AND UINFO.referarID IN(SELECT
											 UINFOP.uID
										   FROM userinfo UINFOP
										   WHERE UINFOP.status = '1'
											   AND UINFOP.email_send_status = 1
											   AND (UINFOP.userType = 'TEACHER'
													 OR UINFOP.userType = 'STUDENT'))";
		//echo $sql;											 
		$data = $this->db->query($sql);		
		return $data->result();									 
	}
	
	function getCountAssignUser($searchData = array()){
		$sql = "SELECT
				  COUNT(parent_user_id) AS total
				FROM gbe_gambian_distribution
				WHERE (parent_user_id = ".$searchData['parent_user_id']."
						OR assign_user_id = ".$searchData['assign_user_id'].")
					AND `level` = ".$searchData['level'];
		$data = $this->db->query($sql);		
		return $data->result();				
	}
	
	private function _p(){
		echo '<pre>';
		print_r($this->db->last_query());
		echo '</pre>';
		exit;	
	}
}
	
	
