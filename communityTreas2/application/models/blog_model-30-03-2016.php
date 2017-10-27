<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	
	public function getAllBlogDetails($userId,$per_page,$page){
		$this->db->select('GBP.*,U.firstName,U.lastName');
		$this->db->from('gbe_blog_posts GBP');
		$this->db->join('userinfo U','U.uID=GBP.post_auther_id','LEFT');
		$this->db->where('GBP.post_auther_id',$userId);
		$this->db->order_by('GBP.post_id','DESC');
		$this->db->limit($per_page,$page);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getCountAllBlogDetails($userId){
		$this->db->select('COUNT(GBP.post_id) as tot');
		$this->db->from('gbe_blog_posts GBP');
		$this->db->where('GBP.post_auther_id',$userId);
		$query = $this->db->get();
		$dd = $query->result();
		return $dd[0]->tot;
	}
	
	public function getAllBlogDetailsArchive($userId,$year,$per_page,$page){
		$this->db->select('GBP.*,U.firstName,U.lastName');
		$this->db->from('gbe_blog_posts GBP');
		$this->db->join('userinfo U','U.uID=GBP.post_auther_id','LEFT');
		$this->db->where('GBP.post_auther_id',$userId);
		$this->db->where('YEAR(GBP.post_date)',$year);
		$this->db->order_by('GBP.post_id','DESC');
		$this->db->limit($per_page,$page);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getCountAllBlogDetailsArchive($userId,$year){
		$this->db->select('COUNT(GBP.post_id) as tot');
		$this->db->from('gbe_blog_posts GBP');
		$this->db->where('GBP.post_auther_id',$userId);
		$this->db->where('YEAR(GBP.post_date)',$year);
		$query = $this->db->get();
		$dd = $query->result();
		return $dd[0]->tot;
	}
	
	public function getYear($userId){
		$sql = 'SELECT
				  YEAR(post_date) yy
				FROM gbe_blog_posts
				WHERE post_auther_id = '.$userId.'
				GROUP BY YEAR(post_date)
				ORDER BY YEAR(post_date)DESC';
		$query = $this->db->query($sql);
		return $query->result();		
	}
	
	public function getSingleBlogDetails($titleUrl){
		$this->db->select('GBP.*,U.firstName,U.lastName');
		$this->db->from('gbe_blog_posts GBP');
		$this->db->join('userinfo U','U.uID=GBP.post_auther_id','LEFT');
		$this->db->where('GBP.post_title_url',$titleUrl);
		$query = $this->db->get();
		return $query->result();
	}
	
	private function _p($s = 1){
		print_r($this->db->last_query());
		if($s == 0){
			exit;
		}
		return true;
	}
	//24/09/2015 ujjwal sana
	public function updateCountComment($post_id){
		$sql = 'UPDATE gbe_blog_posts
				SET comment_count = comment_count + 1
				WHERE post_id = '.$post_id;
		$this->db->query($sql);
		return $this->getCommentCount($post_id);		
	}
	
	private function getCommentCount($post_id){
		$this->db->select('GBP.comment_count');
		$this->db->from('gbe_blog_posts GBP');
		$this->db->where('GBP.post_id',$post_id);
		$query = $this->db->get();
		$data = $query->result();
		return $data[0]->comment_count;
	}
	
	public function getAllComments($post_id){
		$this->db->select('GBC.*');
		$this->db->from('gbe_blog_comments GBC');
		$this->db->where('GBC.comment_post_id',$post_id);
		$this->db->order_by('GBC.comment_id','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function getRightPanelVideo(){
		$this->db->select('GLV.*');
		$this->db->from('gbe_level_video GLV');
		$this->db->where('GLV.id',65);
		$query = $this->db->get();
		return $query->result();
	}
	

	
}



?>