<?php
class admin_user_model extends CI_model{
	function _construct(){
		parent::__construct();
	}

    public function getUser($type,$subType,$per_page,$page){
        $this->db->select('userinfo.*,PINFO.firstName fn,PINFO.lastName ln,city.city as city_name,UGT.user_general_type_name');
        $this->db->from('userinfo');
        $this->db->join('userinfo AS PINFO','userinfo.referarID=PINFO.uID','LEFT');
        $this->db->join('city','city.id=userinfo.city','LEFT');
        $this->db->join('user_general_type UGT','UGT.user_id=userinfo.uID','LEFT');
        if($type != ""){
            $this->db->where('userinfo.userType',$type);
        }
        if($subType != ""){
            $this->db->where('UGT.user_general_type_name',$subType);
        }
        $this->db->order_by('userinfo.uID','DESC');
        $this->db->limit($per_page,$page);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getTotalUser($type ,$subType){
        $this->db->select('COUNT(userinfo.uID) as total');
        $this->db->from('userinfo');
        $this->db->join('user_general_type UGT','UGT.user_id=userinfo.uID','LEFT');
        if($type != ""){
            $this->db->where('userinfo.userType',$type);
        }
        if($subType != ""){
            $this->db->where('UGT.user_general_type_name',$subType);
        }
        $query = $this->db->get();
        $retData = $query->result();
        return $retData[0]->total;
    }
	
	 public function getUserOthers($type,$per_page,$page){
        $this->db->select('userinfo.*,PINFO.firstName fn,PINFO.lastName ln,city.city as city_name');
        $this->db->from('userinfo');
        $this->db->join('userinfo AS PINFO','userinfo.referarID=PINFO.uID','LEFT');
        $this->db->join('city','city.id=userinfo.city','LEFT');
        if($type != ""){
            $this->db->where('userinfo.userType',$type);
        }
       
        $this->db->order_by('userinfo.uID','DESC');
        $this->db->limit($per_page,$page);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getTotalUserOthers($type ){
        $this->db->select('COUNT(userinfo.uID) as total');
        $this->db->from('userinfo');
        
        if($type != ""){
            $this->db->where('userinfo.userType',$type);
        }
        
        $query = $this->db->get();
        $retData = $query->result();
        return $retData[0]->total;
    }
	
    public function getSingleUser($id = 0){
        $this->db->select('userinfo.*,RINFO.firstName fn,RINFO.lastName ln');
        $this->db->from('userinfo');
        $this->db->join('userinfo AS RINFO','userinfo.referarID=RINFO.uID','LEFT');
        $this->db->where('userinfo.uID',$id);
        $query = $this->db->get();
        return $query->result();
    }
    
     public function getExcelData($type){
        $this->db->select('userinfo.*,PINFO.firstName fn,PINFO.lastName ln,city.city as city_name');
        $this->db->from('userinfo');
        $this->db->join('userinfo AS PINFO','userinfo.referarID=PINFO.uID','LEFT');
        $this->db->join('city','city.id=userinfo.city','LEFT');
        if($type != ""){
            $this->db->where('userinfo.userType',$type);
        }
        $this->db->order_by('userinfo.uID','DESC');
        $query = $this->db->get();
        return $query->result();
    }
	 public function getTotalExpellUser(){
        $this->db->select('COUNT(DISTINCT(user_expell.id)) as total');
        $this->db->from('user_expell');
       /*  if($type != ""){
            $this->db->where('userinfo.userType',$type);
        } */
        $query = $this->db->get();
        $retData = $query->result();
        return $retData[0]->total;
    }
	 public function getExpellUser($per_page,$page){
        $this->db->select('user_expell.*,city.city as city_name, EUINFO.firstName EUserfName,EUINFO.lastName EUserlName,EUINFO.userType EuserType,EUINFO.emailID EemailID,EUINFO.status ,UINFO.firstName ,UINFO.lastName ' );
		$this->db->from('user_expell');
		$this->db->join('userinfo AS EUINFO ','user_expell.user_id=EUINFO.uID','INNER');
		$this->db->join('userinfo AS UINFO','user_expell.expell_by_user_id=UINFO.uID','INNER');
        $this->db->join('city','city.id=EUINFO.city','LEFT');
       /*  if($type != ""){
            $this->db->where('userinfo.userType',$type);
        } */
		$this->db->group_by('user_expell.user_id');
        $this->db->order_by('EUINFO.uID','DESC');
        $this->db->limit($per_page,$page);
        $query = $this->db->get();
        return $query->result();
    }
	
}
	
?>