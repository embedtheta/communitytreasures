<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	

class cron_gambia_dist extends CI_Controller {
	public $forWebsite;
	public function __construct(){
		parent::__construct();
		$this->load->model('cron_gambia_dist_model');
	}
	
	public function index($website = 1){
		$this->forWebsite = $website;
		// 1st fetch all paying user eccept gambian paying user
		// fetch gambian paying user
		// assign gambian paying user
		// 0=L1;1=L2;2=L3;3=L4;4=L5;5=Admin
		$this->levelAssign(1,0);
		//exit;
		//$this->levelAssign(2,1);
		//$this->levelAssign(3,2);
		//$this->levelAssign(4,3);
	}
	
	public function levelAssign($uLevel = 1 , $gUserLevel = 0){
		$userLevel = $uLevel;
		$gambianUserLevel = $gUserLevel;
		$generalUser = $this->cron_gambia_dist_model->getAllGeneralUser($userLevel,$this->forWebsite);
		$gambianUser = $this->cron_gambia_dist_model->getGambianUser($gambianUserLevel,$this->forWebsite);
		if(count($gambianUser) > 0){
			$i = 0;
			foreach($gambianUser as $gamU){
				if(count($gambianUser) > 0){
					foreach($generalUser as $genU){
						$searchD = array();
						$searchD['parent_user_id'] = $genU->uID;
						$searchD['assign_user_id'] = $gamU->uID;
						$searchD['level'] = $uLevel;
						$totalCount = $this->cron_gambia_dist_model->getCountAssignUser($searchD);
						if($totalCount[0]->total == 0){
							$searchD['asign_date'] = date('Y-m-d H:i:s');
							$tbl = 'gbe_gambian_distribution';
							$this->cron_gambia_dist_model->insertDataToTable($tbl,$searchD);
							$i++;
						}
					}
				}
			}
		}
		echo 'Total assign users are : '.$i;
	}
	
}