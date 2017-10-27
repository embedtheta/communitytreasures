<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class product_model extends CI_Model{
    private $pTab = "product_details";
    private $pColorTab = "product_color_quantity";
    private $pFilesTab = "product_files";
    public function __construct(){
        parent::__construct();
        
    }
    
    public function getProduct($productId = 0){
        $this->db->select('*');
        $this->db->from($this->pTab);
        $this->db->where($this->pTab.'.productID',$productId);
        $query = $this->db->get();
        //echo $this->db->last_query();
        //print_r($query);exit;
        return $query->result();
    }
    
    public function getProductColors($productId = 0){
        $this->db->select('*');
        $this->db->from($this->pColorTab);
        $this->db->where($this->pColorTab.'.productId',$productId);
        $query = $this->db->get();
        $dd = $query->result();
		$retData = array();
		if(count($dd) > 0){
			foreach($dd as $v):
				$retData['selectedColor'][] = $v->colorId;
				$retData['selectedColorDetails'][$v->colorId] = $v->quantity;
			endforeach;	
		}
		return $retData;
    }
    
    public function getProductFiles($productId = 0){
        $this->db->select('*');
        $this->db->from($this->pFilesTab);
        $this->db->where($this->pFilesTab.'.productId',$productId);
        $query = $this->db->get();
        $dd = $query->result();
		$retData['mp3'] = array('fileName' => '','id' => '');
		$retData['img_1'] = array('fileName' => '','id' => '');
		$retData['img_2'] = array('fileName' => '','id' => '');
		$retData['img_3'] = array('fileName' => '','id' => '');
		$retData['img_4'] = array('fileName' => '','id' => '');
		$retData['pdf'] = array('fileName' => '','id' => '');
		if(count($dd) > 0):
			$i = 2;
			foreach($dd as $v):
				if($v->fileType == 0):
					if($v->isMain == 1):
						$retData['img_1']['fileName'] = $v->fileName;
						$retData['img_1']['id'] = $v->id;
					else:
						$retData['img_'.$i]['fileName'] = $v->fileName;
						$retData['img_'.$i]['id'] = $v->id;
						$i++;
					endif;
				elseif($v->fileType == 1):
					$retData['mp3']['fileName'] = $v->fileName;
					$retData['mp3']['id'] = $v->id;				
				else:
					$retData['pdf']['fileName'] = $v->fileName;
					$retData['pdf']['id'] = $v->id;
				endif;
			endforeach;
		endif;
		return $retData;
    }
	public function getCatIdArtId($subarticleId){
        $this->db->select('productmenucontent.menu_id,productmenucontent.parent_article_id');
        $this->db->from('productmenucontent');
        $this->db->where('productmenucontent.id',$subarticleId);
        $query = $this->db->get();
		//echo $this->db->last_query();
        $tempArr = $query->result_array();
		$retData = array();		
		$retData["catId"] = $tempArr[0]["menu_id"];
		$retData["articleId"]  = $tempArr[0]["parent_article_id"];
		return $retData;
    }
}