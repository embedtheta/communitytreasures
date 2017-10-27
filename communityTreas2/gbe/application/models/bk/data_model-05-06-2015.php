<?php
class data_model extends CI_model{
	function _construct(){
		parent::__construct();
	}
	
	function login($userName, $password)
	 {
	   $this -> db -> select('id, userName, password');
	   $this -> db -> from('admin_login');
	   $this -> db -> where('userName', $userName);
       $this -> db -> where('password', $password);
	   $this -> db -> limit(1);
	 
	   $query = $this -> db -> get();
	 
	   if($query -> num_rows() == 1)
	   {
	     return $query->result_array();
	   }
	   else
	   {
	     return false;
	   }
	 }
	 function record_count() {
        return $this->db->count_all("useradvert");
     }
	 
	 function fetch_advert_member($limit, $start) {
		$this->db->limit($limit, $start);
        $query = $this->db->get("useradvert");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
     }
	 function dashboard_count() {
        return $this->db->count_all("viewuserdashboard");
     }
	
	 function youtube_count() {
        return $this->db->count_all("useryoutube");
     }
	 function fetch_youtube_member($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("useryoutube");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
     }
	 
	 function banner_count() {
        return $this->db->count_all("userbanner");
     }
	 function fetch_banner_member($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("userbanner");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
     }
	 function isdelExist($entityid) {
	  if($entityid != ""){
		  $this->db->where('useradvert.advertID',$entityid);
		  $res = $this->db->delete('useradvert');
		  return $res;
	  }
	 }
	
	 function isdelExistbanner($entityid) {
	  if($entityid != ""){
		  $this->db->where('userbanner.bannerID',$entityid);
		  $res = $this->db->delete('userbanner');
		  return $res;
	  }
	 }
	 function isdelExistyoutube($entityid) {
	  if($entityid != ""){
		  $this->db->where('useryoutube.id',$entityid);
		  $res = $this->db->delete('useryoutube');
		  return $res;
	  }
	 }
	 
		  
	 function getyoutubeDataModel($id){
	   $this->db->select('useryoutube.*');
	   $this->db->from('useryoutube');
	   $this->db->where('id', $id);
	   $query = $this->db->get();
	   return $query->result_array();
    }
	
	function updateyoutube($data=array()){
		
	   if(!empty($data)){
		   
		   
		   if(trim($data['youtubeName']) != ""){
			   $this->db->set('useryoutube.youtubeName',trim($data['youtubeName']));
		   }
		   if(trim($data['youtubeUrl']) != ""){
			   $this->db->set('useryoutube.youtubeUrl',trim($data['youtubeUrl']));
		   }
		   if(trim($data['status']) != ""){
			   $this->db->set('useryoutube.status',trim($data['status']));
		   }
		   
		   
		 $this->db->where('id', $data['id']);
		   $rs=$this->db->update('useryoutube');
		   
		        if($rs){
		  	       return true;
		        }else{
			       return false;
		        }
	      }
          }
		  
	function getbannerDataModel($bannerID){
	   $this->db->select('userbanner.*');
	   $this->db->from('userbanner');
	   $this->db->where('bannerID', $bannerID);
	   $query = $this->db->get();
	   return $query->result_array();
    }
	
	function updatebanner($data=array()){
		
	   if(!empty($data)){
		   
		   
		   if(trim($data['image']) != ""){
			   $this->db->set('userbanner.bannerImg',trim($data['image']));
		   }
		   if(trim($data['status']) != ""){
			   $this->db->set('userbanner.status',trim($data['status']));
		   }
		  
		  
		    
		   
		   $this->db->where('bannerID', $data['bannerID']);
		   $rs=$this->db->update('userbanner');
		   
		        if($rs){
		  	       return true;
		        }else{
			       return false;
		        }
	      }
          }
		  	  
	function getDataModel($advertID){
	   $this->db->select('useradvert.*');
	   $this->db->from('useradvert');
	   $this->db->where('advertID', $advertID);
	   $query = $this->db->get();
	   return $query->result_array();
    }
	function updateMembershipModel($data=array()){
	   if(!empty($data)){
		   if(trim($data['advertTitle']) != ""){
			   $this->db->set('useradvert.advertTitle',trim($data['advertTitle']));
		   }
		   if(trim($data['image']) != ""){
			   $this->db->set('useradvert.advertImg',trim($data['image']));
		   }
		   if(trim($data['status']) != ""){
			   $this->db->set('useradvert.status',trim($data['status']));
		   }
		   $this->db->where('advertID', $data['advertID']);
		   $rs=$this->db->update('useradvert');
		   if($rs){
		      return true;
		   }else{
			  return false;
		   }
	   }
    } 
		  
	function insertuseradvert($data=array()){
	   if(!empty($data)){
		   if(trim($data['advertTitle']) != ""){
			   $this->db->set('useradvert.advertTitle',trim($data['advertTitle']));
		   }
		    if(trim($data['status']) != ""){
			   $this->db->set('useradvert.status',trim($data['status']));
		   }
		  
		   if(trim($data['image']) != ""){
			   $this->db->set('useradvert.advertImg',trim($data['image']));
		   }
		   $query = $this->db->insert('useradvert');
		   return $this->db->insert_id();
	   }else{
			return false;
	   }
   }
   
   function insertuseryoutube($data=array()){
	   if(!empty($data)){
		   if(trim($data['youtubeName']) != ""){
			   $this->db->set('useryoutube.youtubeName',trim($data['youtubeName']));
		   }
		    if(trim($data['status']) != ""){
			   $this->db->set('useryoutube.status',trim($data['status']));
		   }
		  
		   if(trim($data['youtubeUrl']) != ""){
			   $this->db->set('useryoutube.youtubeUrl',trim($data['youtubeUrl']));
		   }
		   $query = $this->db->insert('useryoutube');
		   return $query; 
	   }
   }
   
   function insertuserbanner($data=array()){
	   if(!empty($data)){
		  if(trim($data['status']) != ""){
			   $this->db->set('userbanner.status',trim($data['status']));
		  }
		  if(trim($data['image']) != ""){
			   $this->db->set('userbanner.bannerImg',trim($data['image']));
		  }
		  $query = $this->db->insert('userbanner');
		  return $query; 
	   }
   }
   
   function delete_checkedyoutube($checked_messages){
	   //print_r($checked_messages); exit;
	   $result=count($checked_messages);
	   //echo $result; exit;
      for($key=0; $key < $result; $key++){
          $this->db->where('useryoutube.id',$checked_messages[$key]);
		  
		  $res = $this->db->delete('useryoutube');
		 // echo $this->db->last_query(); exit;
		 
	  }
	  //echo $res; exit;
	   return $res;
		 
   }
   
	function delete_checkedadvert($checked_messages){
	   //print_r($checked_messages); exit;
	   $result=count($checked_messages);
	   //echo $result; exit;
      for($key=0; $key < $result; $key++){
          $this->db->where('useradvert.advertID',$checked_messages[$key]);
		  
		  $res = $this->db->delete('useradvert');
		 // echo $this->db->last_query(); exit;
		 
	  }
	  //echo $res; exit;
	   return $res;
		 
   }
   
   function delete_checkedbanner($checked_messages){
	   //print_r($checked_messages); exit;
	   $result=count($checked_messages);
	   //echo $result; exit;
      for($key=0; $key < $result; $key++){
          $this->db->where('userbanner.bannerID',$checked_messages[$key]);
		  
		  $res = $this->db->delete('userbanner');
		 // echo $this->db->last_query(); exit;
		 
	  }
	  //echo $res; exit;
	   return $res;
		 
   }
	/********************************************************************
							PRODUCT PAGE BACK END
   /********************************************************************/	
   function insertCreativeDetails($data=array()){
	   if(!empty($data)){
			if(trim($data['creativeTitle'])!=""){
				$this->db->set('productcreative.creativeTitle',trim($data['creativeTitle']));
			}
			if(trim($data['creativeDesc'])!=""){
				$this->db->set('productcreative.creativeDesc',trim($data['creativeDesc']));
			}
			if(trim($data['creativeImg'])!=""){
				$this->db->set('productcreative.creativeImg',trim($data['creativeImg']));
			}
			if(trim($data['creativeStatus'])!=""){
				$this->db->set('productcreative.creativeStatus',trim($data['creativeStatus']));
			}
			$this->db->insert('productcreative');
			return $this->db->insert_id();
		}else{
			return false;
		}
   }
   function insertEventsCelebrationsDetails($data=array()){
	 if(!empty($data)){
			if(trim($data['eventTitle'])!=""){
				$this->db->set('productevent.eventTitle',trim($data['eventTitle']));
			}
			if(trim($data['eventDesc'])!=""){
				$this->db->set('productevent.eventDesc',trim($data['eventDesc']));
			}
			if(trim($data['eventImg'])!=""){
				$this->db->set('productevent.eventImg',trim($data['eventImg']));
			}
			if(trim($data['eventStatus'])!=""){
				$this->db->set('productevent.eventStatus',trim($data['eventStatus']));
			}
			$this->db->insert('productevent');
			return $this->db->insert_id();
		}else{
			return false;
		}  
   }
   function insertTripsHolidays($data=array()){
	if(!empty($data)){
			if(trim($data['tripTitle'])!=""){
				$this->db->set('producttrip.tripTitle',trim($data['tripTitle']));
			}
			if(trim($data['tripDesc'])!=""){
				$this->db->set('producttrip.tripDesc',trim($data['tripDesc']));
			}
			if(trim($data['tripImg'])!=""){
				$this->db->set('producttrip.tripImg',trim($data['tripImg']));
			}
			if(trim($data['tripStatus'])!=""){
				$this->db->set('producttrip.tripStatus',trim($data['tripStatus']));
			}
			$this->db->insert('producttrip');
			return $this->db->insert_id();
		}else{
			return false;
		}     
   }
   function insertLatestFashionStyle($data=array()){
	   if(!empty($data)){
			if(trim($data['fashionTitle'])!=""){
				$this->db->set('productfashion.fashionTitle',trim($data['fashionTitle']));
			}
			if(trim($data['fashionDesc'])!=""){
				$this->db->set('productfashion.fashionDesc',trim($data['fashionDesc']));
			}
			if(trim($data['fashionPosition'])!=""){
				$this->db->set('productfashion.fashionPosition',trim($data['fashionPosition']));
			}
			if(trim($data['fashionImg'])!=""){
				$this->db->set('productfashion.fashionImg',trim($data['fashionImg']));
			}
			if(trim($data['fashionStatus'])!=""){
				$this->db->set('productfashion.fashionStatus',trim($data['fashionStatus']));
			}
			$this->db->insert('productfashion');
			return $this->db->insert_id();
		}else{
			return false;
		}     
   }
   function insertLatestFashionBanner($data=array()){
	   if(!empty($data)){
			if(trim($data['bannerPosition'])!=""){
				$this->db->set('productstylebanner.bannerPosition',trim($data['bannerPosition']));
			}
			if(trim($data['bannerImage'])!=""){
				$this->db->set('productstylebanner.bannerImage',trim($data['bannerImage']));
			}
			if(trim($data['BannerStatus'])!=""){
				$this->db->set('productstylebanner.BannerStatus',trim($data['BannerStatus']));
			}
			$this->db->insert('productstylebanner');
			return $this->db->insert_id();
		}else{
			return false;
		}     
   }
   function insertNewsZone($data=array()){
	   if(!empty($data)){
			if(trim($data['newsTitle'])!=""){
				$this->db->set('productnews.newsTitle',trim($data['newsTitle']));
			}
			if(trim($data['newsDesc'])!=""){
				$this->db->set('productnews.newsDesc',trim($data['newsDesc']));
			}
			if(trim($data['newsImg'])!=""){
				$this->db->set('productnews.newsImg',trim($data['newsImg']));
			}
			if(trim($data['newsStatus'])!=""){
				$this->db->set('productnews.newsStatus',trim($data['newsStatus']));
			}
			$this->db->insert('productnews');
			return $this->db->insert_id();
		}else{
			return false;
		}     
   }
   function insertMentorship($data=array()){
	   if(!empty($data)){
			if(trim($data['mentorTitle'])!=""){
				$this->db->set('productmentorship.mentorTitle',trim($data['mentorTitle']));
			}
			if(trim($data['mentorDesc'])!=""){
				$this->db->set('productmentorship.mentorDesc',trim($data['mentorDesc']));
			}
			if(trim($data['mentorImg'])!=""){
				$this->db->set('productmentorship.mentorImg',trim($data['mentorImg']));
			}
			if(trim($data['mentorStatus'])!=""){
				$this->db->set('productmentorship.mentorStatus',trim($data['mentorStatus']));
			}
			$this->db->insert('productmentorship');
			return $this->db->insert_id();
		}else{
			return false;
		}  
   }
   function insertResidential($data=array()){
	   if(!empty($data)){
			if(trim($data['residentialTitle'])!=""){
				$this->db->set('productresidential.residentialTitle',trim($data['residentialTitle']));
			}
			if(trim($data['residentialDesc'])!=""){
				$this->db->set('productresidential.residentialDesc',trim($data['residentialDesc']));
			}
			if(trim($data['residentialImage'])!=""){
				$this->db->set('productresidential.residentialImage',trim($data['residentialImage']));
			}
			if(trim($data['residentialStatus'])!=""){
				$this->db->set('productresidential.residentialStatus',trim($data['residentialStatus']));
			}
			$this->db->insert('productresidential');
			return $this->db->insert_id();
		}else{
			return false;
		}  
   }
   function insertBusinessConsultant($data=array()){
	   if(!empty($data)){
			if(trim($data['businessTitle'])!=""){
				$this->db->set('productbusiness.businessTitle',trim($data['businessTitle']));
			}
			if(trim($data['businessDesc'])!=""){
				$this->db->set('productbusiness.businessDesc',trim($data['businessDesc']));
			}
			if(trim($data['businessImg'])!=""){
				$this->db->set('productbusiness.businessImg',trim($data['businessImg']));
			}
			if(trim($data['businessStatus'])!=""){
				$this->db->set('productbusiness.businessStatus',trim($data['businessStatus']));
			}
			$this->db->insert('productbusiness');
			return $this->db->insert_id();
		}else{
			return false;
		}  
   }
   function insertArticleZone($data=array()){
	   date_default_timezone_set("Asia/Kolkata");
	   /*$dat=date('Y-m-d h:i:s');*/
		$datee=date("j, F Y , g:i A", time());
	   if(!empty($data)){
			if(trim($data['articleTitle'])!=""){
				$this->db->set('productarticle.articleTitle',trim($data['articleTitle']));
			}
			if(trim($data['articleDesc'])!=""){
				$this->db->set('productarticle.articleDesc',trim($data['articleDesc']));
			}
			if(trim($data['articleAuthor'])!=""){
				$this->db->set('productarticle.articleAuthor',trim($data['articleAuthor']));
			}
			if(trim($data['articleImg'])!=""){
				$this->db->set('productarticle.articleImg',trim($data['articleImg']));
			}
			 
			 $this->db->set('productarticle.articleDate',$datee);
			
			if(trim($data['articleStatus'])!=""){
				$this->db->set('productarticle.articleStatus',trim($data['articleStatus']));
			}
			$this->db->insert('productarticle');
			return $this->db->insert_id();
		}else{
			return false;
		}  
   }
   function insertWebBuilder($data=array()){
	   if(!empty($data)){
			if(trim($data['builderTitle'])!=""){
				$this->db->set('productwebbuilder.builderTitle',trim($data['builderTitle']));
			}
			if(trim($data['builderUrl'])!=""){
				$this->db->set('productwebbuilder.builderUrl',trim($data['builderUrl']));
			}
			if(trim($data['builderImg'])!=""){
				$this->db->set('productwebbuilder.builderImg',trim($data['builderImg']));
			}
			if(trim($data['builderStatus'])!=""){
				$this->db->set('productwebbuilder.builderStatus',trim($data['builderStatus']));
			}
			$this->db->insert('productwebbuilder');
			return $this->db->insert_id();
		}else{
			return false;
		}  
   }
   function insertSecurity($data=array()){
	   if(!empty($data)){
			if(trim($data['securityTitle'])!=""){
				$this->db->set('productsecurity.securityTitle',trim($data['securityTitle']));
			}
			if(trim($data['securityUrl'])!=""){
				$this->db->set('productsecurity.securityUrl',trim($data['securityUrl']));
			}
			if(trim($data['securityImg'])!=""){
				$this->db->set('productsecurity.securityImg',trim($data['securityImg']));
			}
			if(trim($data['securityStatus'])!=""){
				$this->db->set('productsecurity.securityStatus',trim($data['securityStatus']));
			}
			$this->db->insert('productsecurity');
			return $this->db->insert_id();
		}else{
			return false;
		}  
   }
   function insertAdvertisement($data=array()){
	   if(!empty($data)){
			if(trim($data['advertisementTitle'])!=""){
				$this->db->set('productadvertisement.advertisementTitle',trim($data['advertisementTitle']));
			}
			if(trim($data['advertisementDesc'])!=""){
				$this->db->set('productadvertisement.advertisementDesc',trim($data['advertisementDesc']));
			}
			if(trim($data['advertisementImg'])!=""){
				$this->db->set('productadvertisement.advertisementImg',trim($data['advertisementImg']));
			}
			if(trim($data['advertisementStatus'])!=""){
				$this->db->set('productadvertisement.advertisementStatus',trim($data['advertisementStatus']));
			}
			$this->db->insert('productadvertisement');
			return $this->db->insert_id();
		 
		}else{
			return false;
		} 
   }
   function getCreativeDetails(){
	   $this->db->select('productcreative.*');
	   $this->db->from('productcreative');
	   $this->db->where('productcreative.creativeStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();
   }
   function getEventsCelebrations(){
	   $this->db->select('productevent.*');
	   $this->db->from('productevent');
	   $this->db->where('productevent.eventStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();
   }
   function getTripsHolidays(){
	   $this->db->select('producttrip.*');
	   $this->db->from('producttrip');
	   $this->db->where('producttrip.tripStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();   
   }
   function getLatestFashionStyle(){
	   $this->db->select('productfashion.*');
	   $this->db->from('productfashion');
	   $this->db->where('productfashion.fashionStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();  
   }
   function getLatestFashionBanner(){
	   $this->db->select('productstylebanner.*');
	   $this->db->from('productstylebanner');
	   $this->db->where('productstylebanner.BannerStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();  
   }
   function getResidential(){
	   $this->db->select(' productresidential.*');
	   $this->db->from(' productresidential');
	   $this->db->where('productresidential.residentialStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();  

   }
   function getNewsZone(){
	   $this->db->select('productnews.*');
	   $this->db->from('productnews');
	   $this->db->where('productnews.newsStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();
   }
   function getMentorship(){
	   $this->db->select('productmentorship.*');
	   $this->db->from('productmentorship');
	   $this->db->where('productmentorship.mentorStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();
   }
   function getBusinessConsultants(){
	   $this->db->select('productbusiness.*');
	   $this->db->from('productbusiness');
	   $this->db->where('productbusiness.businessStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();
   }
   function getArticleZone(){
	   $this->db->select('productarticle.*');
	   $this->db->from('productarticle');
	   $this->db->where('productarticle.articleStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();
   }
   function getWebBuilder(){
	   $this->db->select('productwebbuilder.*');
	   $this->db->from('productwebbuilder');
	   $this->db->where('productwebbuilder.builderStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();
   }
   function getSecurity(){
	   $this->db->select('productsecurity.*');
	   $this->db->from('productsecurity');
	   $this->db->where('productsecurity.securityStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();
   }
   function getAdvertisement(){
	   $this->db->select('productadvertisement.*');
	   $this->db->from('productadvertisement');
	   $this->db->where('productadvertisement.advertisementStatus','1');
	   $query=$this->db->get();
	   return $query->result_array();
   }
   function getIndividualCreativeData($creativeID){
	   if($creativeID !=""){
		   $this->db->select('productcreative.*');
	       $this->db->from('productcreative');
	       $this->db->where('productcreative.creativeID',$creativeID);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
   }
   // Added by SB on 29/04/2015
   function getIndividualArticleData($articleID){
	   if($articleID !=""){
		   $this->db->select('productmenucontent.*');
	       $this->db->from('productmenucontent');
	       $this->db->where('productmenucontent.id',$articleID);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
   }
   function getIndividualResidential($residentialId){
	   if($residentialId !=""){
		   $this->db->select('productresidential.*');
	       $this->db->from('productresidential');
	       $this->db->where('productresidential.residentialId',$residentialId);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
   }
   function getIndividualEventsCelebrations($eventID){
	   if($eventID !=""){
		   $this->db->select('productevent.*');
	       $this->db->from('productevent');
	       $this->db->where('productevent.eventID',$eventID);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
    }
	function getIndividualTripsHolidays($tripID){
		if($tripID !=""){
		   $this->db->select('producttrip.*');
	       $this->db->from('producttrip');
	       $this->db->where('producttrip.tripID',$tripID);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }	
    }
	function getIndividualLatestFashionStyle($fashionID){
		if($fashionID !=""){
		   $this->db->select('productfashion.*');
	       $this->db->from('productfashion');
	       $this->db->where('productfashion.fashionID',$fashionID);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }	
	}
	function getIndividualLatestFashionBanner($bannerID){
		if($bannerID !=""){
		   $this->db->select('productstylebanner.*');
	       $this->db->from('productstylebanner');
	       $this->db->where('productstylebanner.bannerID',$bannerID);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }	
	}
	function getIndividualNewsZone($newsID){
		if($newsID !=""){
		   $this->db->select('productnews.*');
	       $this->db->from('productnews');
	       $this->db->where('productnews.newsID',$newsID);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
	}
	function getIndividualMentorship($mentorID){
		if($mentorID !=""){
		   $this->db->select('productmentorship.*');
	       $this->db->from('productmentorship');
	       $this->db->where('productmentorship.mentorID',$mentorID);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
	}
	function getIndividualBusinessConsultants($businessID){
		if($businessID !=""){
		   $this->db->select('productbusiness.*');
	       $this->db->from('productbusiness');
	       $this->db->where('productbusiness.businessID',$businessID);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
	}
	function getIndividualArticleZone($articleID){
		if($articleID !=""){
		   $this->db->select('productarticle.*');
	       $this->db->from('productarticle');
	       $this->db->where('productarticle.articleID',$articleID);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
	}
	function getIndividualWebBuilder($builderId){
		if($builderId !=""){
		   $this->db->select('productwebbuilder.*');
	       $this->db->from('productwebbuilder');
	       $this->db->where('productwebbuilder.builderId',$builderId);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
	}
	function getIndividualSecurity($securityId){
		if($securityId !=""){
		   $this->db->select('productsecurity.*');
	       $this->db->from('productsecurity');
	       $this->db->where('productsecurity.securityId',$securityId);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
	}
	function getIndividualAdvertisement($advertisementId){
		if($advertisementId !=""){
		   $this->db->select('productadvertisement.*');
	       $this->db->from('productadvertisement');
	       $this->db->where('productadvertisement.advertisementId',$advertisementId);
	       $query=$this->db->get();
	       return $query->result_array(); 
	   }
	}
	function updateCreativeData($data=array()){
   		if(!empty($data)){
			if(isset($data['creativeImg'])&&trim($data['creativeImg']) != ""){
			   $this->db->set('productcreative.creativeImg',trim($data['creativeImg']));
		    }
		    if(trim($data['creativeTitle']) != ""){
			   $this->db->set('productcreative.creativeTitle',trim($data['creativeTitle']));
		    }
			if(trim($data['creativeDesc']) != ""){
			   $this->db->set('productcreative.creativeDesc',trim($data['creativeDesc']));
		    }
			if(trim($data['creativeStatus']) != ""){
			   $this->db->set('productcreative.creativeStatus',trim($data['creativeStatus']));
		    }
			$this->db->where('creativeID', $data['creativeID']);
		    $rs=$this->db->update('productcreative');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }
   }
   function updateArticleData($data=array()){
   		if(!empty($data)){
			if(isset($data['articleImg'])&&trim($data['articleImg']) != ""){
			   $this->db->set('productmenucontent.creativeImg',trim($data['articleImg']));
		    }
		    if(trim($data['articleTitle']) != ""){
			   $this->db->set('productmenucontent.title',trim($data['articleTitle']));
		    }
			if(trim($data['articleDesc']) != ""){
			   $this->db->set('productmenucontent.description',trim($data['articleDesc']));
		    }
			if(trim($data['articleStatus']) != ""){
			   $this->db->set('productmenucontent.status',trim($data['articleStatus']));
		    }
			$this->db->where('id', $data['articleID']);
		    $rs=$this->db->update('productmenucontent');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }
   }
   function updateResidential($data=array()){
   		if(!empty($data)){
			if(isset($data['residentialImage'])&&trim($data['residentialImage']) != ""){
			   $this->db->set('productresidential.residentialImage',trim($data['residentialImage']));
		    }
		    if(trim($data['residentialTitle']) != ""){
			   $this->db->set('productresidential.residentialTitle',trim($data['residentialTitle']));
		    }
			if(trim($data['residentialDesc']) != ""){
			   $this->db->set('productresidential.residentialDesc',trim($data['residentialDesc']));
		    }
			if(trim($data['residentialStatus']) != ""){
			   $this->db->set('productresidential.residentialStatus',trim($data['residentialStatus']));
		    }
			$this->db->where('residentialId', $data['residentialId']);
		    $rs=$this->db->update('productresidential');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }
   }
   function updateEventsCelebrations($data=array()){
	 if(!empty($data)){
			if(isset($data['eventImg'])&&trim($data['eventImg']) != ""){
			   $this->db->set('productevent.eventImg',trim($data['eventImg']));
		    }
		    if(trim($data['eventTitle']) != ""){
			   $this->db->set('productevent.eventTitle',trim($data['eventTitle']));
		    }
			if(trim($data['eventDesc']) != ""){
			   $this->db->set('productevent.eventDesc',trim($data['eventDesc']));
		    }
			if(trim($data['eventStatus']) != ""){
			   $this->db->set('productevent.eventStatus',trim($data['eventStatus']));
		    }
			$this->db->where('eventID', $data['eventID']);
		    $rs=$this->db->update('productevent');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
   }
   function updateTripsHolidays($data=array()){
	   if(!empty($data)){
			if(isset($data['tripImg'])&&trim($data['tripImg']) != ""){
			   $this->db->set('producttrip.tripImg',trim($data['tripImg']));
		    }
		    if(trim($data['tripTitle']) != ""){
			   $this->db->set('producttrip.tripTitle',trim($data['tripTitle']));
		    }
			if(trim($data['tripDesc']) != ""){
			   $this->db->set('producttrip.tripDesc',trim($data['tripDesc']));
		    }
			if(trim($data['tripStatus']) != ""){
			   $this->db->set('producttrip.tripStatus',trim($data['tripStatus']));
		    }
			$this->db->where('tripID', $data['tripID']);
		    $rs=$this->db->update('producttrip');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
	   }
	function updateLatestFashionStyle($data=array()){
		if(!empty($data)){
			if(isset($data['fashionImg'])&&trim($data['fashionImg']) != ""){
			   $this->db->set('productfashion.fashionImg',trim($data['fashionImg']));
		    }
		    if(trim($data['fashionTitle']) != ""){
			   $this->db->set('productfashion.fashionTitle',trim($data['fashionTitle']));
		    }
			if(trim($data['fashionDesc']) != ""){
			   $this->db->set('productfashion.fashionDesc',trim($data['fashionDesc']));
		    }
			if(trim($data['fashionPosition']) != ""){
			   $this->db->set('productfashion.fashionPosition',trim($data['fashionPosition']));
		    }
			if(trim($data['fashionStatus']) != ""){
			   $this->db->set('productfashion.fashionStatus',trim($data['fashionStatus']));
		    }
			$this->db->where('fashionID', $data['fashionID']);
		    $rs=$this->db->update('productfashion');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
	}
	function updateLatestFashionBanner($data=array()){
		if(!empty($data)){
			if(isset($data['bannerImage'])&&trim($data['bannerImage']) != ""){
			   $this->db->set('productstylebanner.bannerImage',trim($data['bannerImage']));
		    }
		    if(trim($data['bannerPosition']) != ""){
			   $this->db->set('productstylebanner.bannerPosition',trim($data['bannerPosition']));
		    }
			if(trim($data['BannerStatus']) != ""){
			   $this->db->set('productstylebanner.BannerStatus',trim($data['BannerStatus']));
		    }
			$this->db->where('bannerID', $data['bannerID']);
		    $rs=$this->db->update('productstylebanner');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
	}
	function updateNewsZone($data=array()){
		if(!empty($data)){
			if(isset($data['newsImg'])&&trim($data['newsImg']) != ""){
			   $this->db->set('productnews.newsImg',trim($data['newsImg']));
		    }
		    if(trim($data['newsTitle']) != ""){
			   $this->db->set('productnews.newsTitle',trim($data['newsTitle']));
		    }
			if(trim($data['newsDesc']) != ""){
			   $this->db->set('productnews.newsDesc',trim($data['newsDesc']));
		    }
			if(trim($data['newsStatus']) != ""){
			   $this->db->set('productnews.newsStatus',trim($data['newsStatus']));
		    }
			$this->db->where('newsID', $data['newsID']);
		    $rs=$this->db->update('productnews');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
	}
	function updateMentorship($data=array()){
		if(!empty($data)){
			if(isset($data['mentorImg'])&&trim($data['mentorImg']) != ""){
			   $this->db->set('productmentorship.mentorImg',trim($data['mentorImg']));
		    }
		    if(trim($data['mentorTitle']) != ""){
			   $this->db->set('productmentorship.mentorTitle',trim($data['mentorTitle']));
		    }
			if(trim($data['mentorDesc']) != ""){
			   $this->db->set('productmentorship.mentorDesc',trim($data['mentorDesc']));
		    }
			if(trim($data['mentorStatus']) != ""){
			   $this->db->set('productmentorship.mentorStatus',trim($data['mentorStatus']));
		    }
			$this->db->where('mentorID', $data['mentorID']);
		    $rs=$this->db->update('productmentorship');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
		
    }
	function updateBusinessConsultants($data=array()){
		if(!empty($data)){
			if(isset($data['businessImg'])&&trim($data['businessImg']) != ""){
			   $this->db->set('productbusiness.businessImg',trim($data['businessImg']));
		    }
		    if(trim($data['businessTitle']) != ""){
			   $this->db->set('productbusiness.businessTitle',trim($data['businessTitle']));
		    }
			if(trim($data['businessDesc']) != ""){
			   $this->db->set('productbusiness.businessDesc',trim($data['businessDesc']));
		    }
			if(trim($data['businessStatus']) != ""){
			   $this->db->set('productbusiness.businessStatus',trim($data['businessStatus']));
		    }
			$this->db->where('businessID', $data['businessID']);
		    $rs=$this->db->update('productbusiness');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
	}
	function updateArticleZone($data=array()){
		date_default_timezone_set("Asia/Kolkata");
	   /*$dat=date('Y-m-d h:i:s');*/
		$datee=date("j, F Y , g:i A", time());
	   if(!empty($data)){
			if(trim($data['articleTitle'])!=""){
				$this->db->set('productarticle.articleTitle',trim($data['articleTitle']));
			}
			if(trim($data['articleDesc'])!=""){
				$this->db->set('productarticle.articleDesc',trim($data['articleDesc']));
			}
			if(trim($data['articleAuthor'])!=""){
				$this->db->set('productarticle.articleAuthor',trim($data['articleAuthor']));
			}
			if(trim($data['articleImg'])!=""){
				$this->db->set('productarticle.articleImg',trim($data['articleImg']));
			}
			 
			 $this->db->set('productarticle.articleDate',$datee);
			
			if(trim($data['articleStatus'])!=""){
				$this->db->set('productarticle.articleStatus',trim($data['articleStatus']));
			}
			$this->db->where('articleID', $data['articleID']);
		    $rs=$this->db->update('productarticle');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
	}
	function updateWebBuilder($data=array()){
		if(!empty($data)){
			if(isset($data['builderImg'])&&trim($data['builderImg']) != ""){
			   $this->db->set('productwebbuilder.builderImg',trim($data['builderImg']));
		    }
		    if(trim($data['builderTitle']) != ""){
			   $this->db->set('productwebbuilder.builderTitle',trim($data['builderTitle']));
		    }
			if(trim($data['builderUrl']) != ""){
			   $this->db->set('productwebbuilder.builderUrl',trim($data['builderUrl']));
		    }
			if(trim($data['builderStatus']) != ""){
			   $this->db->set('productwebbuilder.builderStatus',trim($data['builderStatus']));
		    }
			$this->db->where('builderId', $data['builderId']);
		    $rs=$this->db->update('productwebbuilder');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
	}
	function updateSecurity($data=array()){
		if(!empty($data)){
			if(isset($data['securityImg'])&&trim($data['securityImg']) != ""){
			   $this->db->set('productsecurity.securityImg',trim($data['securityImg']));
		    }
		    if(trim($data['securityTitle']) != ""){
			   $this->db->set('productsecurity.securityTitle',trim($data['securityTitle']));
		    }
			if(trim($data['securityUrl']) != ""){
			   $this->db->set('productsecurity.securityUrl',trim($data['securityUrl']));
		    }
			if(trim($data['securityStatus']) != ""){
			   $this->db->set('productsecurity.securityStatus',trim($data['securityStatus']));
		    }
			$this->db->where('securityId', $data['securityId']);
		    $rs=$this->db->update('productsecurity');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
	}
	function updateAdvertisement($data=array()){
		if(!empty($data)){
			if(isset($data['advertisementImg'])&&trim($data['advertisementImg']) != ""){
			   $this->db->set('productadvertisement.advertisementImg',trim($data['advertisementImg']));
		    }
		    if(trim($data['advertisementTitle']) != ""){
			   $this->db->set('productadvertisement.advertisementTitle',trim($data['advertisementTitle']));
		    }
			if(trim($data['advertisementDesc']) != ""){
			   $this->db->set('productadvertisement.advertisementDesc',trim($data['advertisementDesc']));
		    }
			if(trim($data['advertisementStatus']) != ""){
			   $this->db->set('productadvertisement.advertisementStatus',trim($data['advertisementStatus']));
		    }
			$this->db->where('advertisementId', $data['advertisementId']);
		    $rs=$this->db->update('productadvertisement');
			if($rs){
				return true;
			}else{
				return false;
			}
	    }  
	}   
   	function deleteCreativeData($creativeID) {
		if($creativeID != ""){
		  $this->db->where('productcreative.creativeID',$creativeID);
		  $this->db->delete('productcreative');
		  return $this->db->affected_rows(); 
	  	}
   }
   function deleteArticleData($articleID) {
		if($articleID != ""){
		  $this->db->where('productmenucontent.id',$articleID);
		  $this->db->delete('productmenucontent');
		  return $this->db->affected_rows(); 
	  	}
   }
   	function deleteResidential($residentialId) {
		if($residentialId != ""){
		  $this->db->where('productresidential.residentialId',$residentialId);
		  $this->db->delete('productresidential');
		  return $this->db->affected_rows(); 
	  	}
   }
   function deleteEventsCelebrations($eventID){
	   if($eventID != ""){
		  $this->db->where('productevent.eventID',$eventID);
		  $this->db->delete('productevent');
		  return $this->db->affected_rows(); 
	  	}
  }
  function deleteTripsHolidays($tripID){
	if($tripID != ""){
		  $this->db->where('producttrip.tripID',$tripID);
		  $this->db->delete('producttrip');
		  return $this->db->affected_rows(); 
	  	}  
  }
  function deleteLatestFashionStyle($fashionID){
	  if($fashionID != ""){
		  $this->db->where('productfashion.fashionID',$fashionID);
		  $this->db->delete('productfashion');
		  return $this->db->affected_rows(); 
	  	} 
  }
  function deleteLatestFashionBanner($bannerID){
	  if($bannerID != ""){
		  $this->db->where('productstylebanner.bannerID',$bannerID);
		  $this->db->delete('productstylebanner');
		  return $this->db->affected_rows(); 
	  	} 
  }
  function deleteNewszone($newsID){
	  if($newsID != ""){
		  $this->db->where('productnews.newsID',$newsID);
		  $this->db->delete('productnews');
		  return $this->db->affected_rows(); 
	  	} 
  }
  function deleteMentorship($mentorID){
	  if($mentorID != ""){
		  $this->db->where('productmentorship.mentorID',$mentorID);
		  $this->db->delete('productmentorship');
		  return $this->db->affected_rows(); 
	  	} 
  }
  function deleteBusinessConsultants($businessID){
	  if($businessID != ""){
		  $this->db->where('productbusiness.businessID',$businessID);
		  $this->db->delete('productbusiness');
		  return $this->db->affected_rows(); 
	  	} 
  }
  function deleteArticleZone($articleID){
	  if($articleID != ""){
		  $this->db->where('productarticle.articleID',$articleID);
		  $this->db->delete('productarticle');
		  return $this->db->affected_rows(); 
	  	} 
  }
  function deleteWebBuilder($builderId){
	  if($builderId != ""){
		  $this->db->where('productwebbuilder.builderId',$builderId);
		  $this->db->delete('productwebbuilder');
		  return $this->db->affected_rows(); 
	  	} 
  }
  function deleteSecurity($securityId){
	  if($securityId != ""){
		  $this->db->where('productsecurity.securityId',$securityId);
		  $this->db->delete('productsecurity');
		  return $this->db->affected_rows(); 
	  	} 
  }
  function deleteAdvertisement($advertisementId){
	  if($advertisementId != ""){
		  $this->db->where('productadvertisement.advertisementId',$advertisementId);
		  $this->db->delete('productadvertisement');
		  return $this->db->affected_rows(); 
	  	} 
  }	
  function deleteMenuId($menuID){
	if($menuID != ""){
		 $this->db->where('menumanagement.menuID',$menuID);
		 $this->db->delete('menumanagement');
		 return $this->db->affected_rows();
	}
  }
  function insertMenus($data=array()){
	  if(!empty($data)){
		  if(trim($data['parentMenuID'])!=""){
				$this->db->set('menumanagement.parentMenuID',trim($data['parentMenuID']));
		  }
		  if(trim($data['menuName'])!=""){
				$this->db->set('menumanagement.menuName',trim($data['menuName']));
		  }
		  $this->db->insert('menumanagement');
		  return $this->db->insert_id();
	  }else{
		  return false;
	  } 
  }
  function updateMenuDetails($data=array()){
	  if(!empty($data)){
		  if(trim($data['parentMenuID'])!=""){
				$this->db->set('menumanagement.parentMenuID',trim($data['parentMenuID']));
		  }
		  if(trim($data['menuName'])!=""){
				$this->db->set('menumanagement.menuName',trim($data['menuName']));
		  }
		  if(trim($data['menuStatus'])!=""){
				$this->db->set('menumanagement.menuStatus',trim($data['menuStatus']));
		  }
		  $this->db->where('menuID',$data["menuID"]);
		  $res = $this->db->update('menumanagement');
		  return $res;
	  }else{
		  return false;
	  }
  }
  function getMenusList(){
	   $this->db->select('menumanagement.*');
	   $this->db->from('menumanagement');
	   $this->db->where('menumanagement.parentMenuID',0);
	   $query=$this->db->get();
	   return $query->result_array(); 
  }
  function getProductTypes(){
	  $this->db->select('producttype.*');
	  $this->db->from('producttype');
	  $this->db->where('producttype.status',"1");
	  $query=$this->db->get();
	  return $query->result_array();
  }
  function getAllSubMenus(){
	   $this->db->select('a.*,b.menuName as Par');
	   $this->db->from('menumanagement as a');
	   $this->db->join('menumanagement as b','a.parentMenuID = b.menuID');
	   //$this->db->where('a.menuStatus ','1');
	   $query=$this->db->get();
	   return $query->result_array(); 
  }
  function insertProduct($data=array()){
	  if(!empty($data)){
		  if(trim($data['productTypeID'])!=""){
				$this->db->set('productdetails.productTypeID',trim($data['productTypeID']));
		  }
		  if(trim($data['productName'])!=""){
				$this->db->set('productdetails.productName',trim($data['productName']));
		  }
		  if(trim($data['productDesc'])!=""){
				$this->db->set('productdetails.productDesc',trim($data['productDesc']));
		  }
		  if(trim($data['productImage'])!=""){
				$this->db->set('productdetails.productImg',trim($data['productImage']));
		  }
		  if(trim($data['productMusic'])!=""){
				$this->db->set('productdetails.productMusic',trim($data['productMusic']));
		  }
		  if(trim($data['productCurrencyType'])!=""){
				$this->db->set('productdetails.productCurrencyType',trim($data['productCurrencyType']));
		  }
		  if(trim($data['productPrice'])!=""){
				$this->db->set('productdetails.productPrice',trim($data['productPrice']));
		  }
		  if(trim($data['productColourStrings'])!=""){
				$this->db->set('productdetails.productColour',trim($data['productColourStrings']));
		  }
		  if(trim($data['productSizeStrings'])!=""){
				$this->db->set('productdetails.productSize',trim($data['productSizeStrings']));
		  }
		  if(trim($data['productStatus'])!=""){
				$this->db->set('productdetails.productStatus',trim($data['productStatus']));
		  }
		  if(trim($data['vendorID'])!=""){
				$this->db->set('productdetails.vendorID',trim($data['vendorID']));
		  }
		  if(trim($data['productCommission'])!=""){
				$this->db->set('productdetails.productCommission',trim($data['productCommission']));
		  }
		  if(trim($data['productOffer'])!=""){
				$this->db->set('productdetails.productOffer',trim($data['productOffer']));
		  }
		  if(trim($data['productYoutube'])!=""){
				$this->db->set('productdetails.productYoutubeUrl',trim($data['productYoutube']));
		  }
		  // Added by SB on 27-03-2015
		  if(trim($data['typeOfProduct'])!=""){
				$this->db->set('productdetails.typeOfProduct',trim($data['typeOfProduct']));
		  }
		  $this->db->insert('productdetails');
		  return $this->db->insert_id();
	  }else{
		  return false;
	  } 
  }
  function insertSecondaryProductImg( $imageName,$productID ){
	  if( trim($imageName)!= "" ){
		$this->db->set('productsecondaryimages.productImg',trim($imageName));
	  }
	  if( trim($productID)!= "" ){
		$this->db->set('productsecondaryimages.ProductID',trim($productID));
	  }
	  $this->db->insert('productsecondaryimages');
  }
  function getAllProducts(){
	   $this->db->select('productdetails.*');
	   $this->db->from('productdetails');
	   $this->db->where('productdetails.productStatus','1');
	   $query=$this->db->get();
	   return $query->result_array(); 
  }
  function getIndividualMenuDetails($menuID){
	  if($menuID != ""){
		   $this->db->select('a.*,b.menuName as Par');
		   $this->db->from('menumanagement as a');
		   $this->db->join('menumanagement as b','a.parentMenuID = b.menuID');
		   $this->db->where('a.MenuID',$menuID);
		   $query=$this->db->get();
		   return $query->result_array();
	  }
  }
  function getTotalMenuDetails(){
	  $this->db->select('menumanagement.*');
	   $this->db->from('menumanagement');
	   $this->db->where('menumanagement.parentMenuID',0);
	   $query=$this->db->get();
	   return $query->result_array();
  }
  function getInfoIndivMenuDetails($menuID){
	   if($menuID != ""){
		   $this->db->select('menumanagement.*');
		   $this->db->from('menumanagement');
		   $this->db->where('menumanagement.menuID',$menuID);
		   $query=$this->db->get();
		   return $query->result_array();
	   }
  }
  // function getAllMenu() is created by Juhir Alam 14/07/2014
  function getAllMenu(){
	  $this->db->select('menumanagement.* ');
	   $this->db->from('menumanagement');
	   $this->db->where('menumanagement.menuStatus','1');
	   $this->db->order_by('parentMenuID','ASC');
	   $this->db->order_by('menuID','ASC');
	   $query=$this->db->get();
	   //echo $this->db->last_query(); exit;
	   return $query->result_array();
  }
  
  // end
  
  // function getMenuDetails() is created by Juhir Alam 15/07/2014
   function getMenuDetails($id=''){
		$this->db->select('menumanagement.* ');
		$this->db->from('menumanagement');
		$this->db->where('menumanagement.menuID',$id);
		$query=$this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result_array();
  }
  // end
  // function getMenuContentDetails() is created by Juhir Alam 15/07/2014
  function getMenuContentDetails($id='',$per_page,$page){
		$this->db->select('productmenucontent.* ');
		$this->db->from('productmenucontent');
		//$this->db->where('productmenucontent.status',1);
		if($id>0)
		{
			$this->db->where('productmenucontent.menu_id',$id);
		}
		 $this->db->limit($per_page,$page); // pagging added by SB on 27/04/2015
		$query=$this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result_array();
  }
  // end
  // get total row count for articles added by SB on 27/04/2015
   public function getTotalMenuContentDetail($id=''){
        $this->db->select('COUNT(productmenucontent.id) as total');
        $this->db->from('productmenucontent');
        if($id>0){
           $this->db->where('productmenucontent.menu_id',$id);
        }
        $query = $this->db->get();
        $retData = $query->result();
        return $retData[0]->total;
    }
  // function insertDataToTable() is created by Juhir Alam 15/07/2014
  public function insertDataToTable($tbl='',$data=array()){
		if($tbl	!='' && !empty($data) && sizeof($data)>0){
			$this->db->insert($tbl,$data);
			return $this->db->insert_id();
		}else{
			return false;	
		}
	}
	// end
	
	// function deleteDataFromTable() is created by Juhir Alam 15/07/2014
 	public function deleteDataFromTable($tbl='',$where=array()){
		if(trim($tbl)!='' && !empty($tbl) && sizeof($where)>0){
			foreach($where as $key=>$v){
				$this->db->where(trim($key),trim($v));
			}
			$this->db->delete(trim($tbl)); 
			return true;
		}else{
			return false;	
		}
	}
	// end
	
	// function getContentDetails() is created by Juhir Alam 15/07/2014
 	public function getContentDetails($id=''){
		$this->db->select('productmenucontent.* ');
		$this->db->from('productmenucontent');
		$this->db->where('productmenucontent.id',$id);
		$query=$this->db->get();
		//echo $this->db->last_query(); exit;
		return $query->result_array();
	}
	// end
	// function updateTable() is created by Juhir Alam 16/07/2014
	public function updateTable($tbl='',$data=array(),$where=array()){
		if(trim($tbl)!='' && !empty($tbl) && sizeof($where)>0){
			foreach($where as $key=>$v){
				$this->db->where(trim($key),trim($v));
			}
			$rdata	=	$this->db->update(trim($tbl), $data); 
			if($rdata){
				return true;
			}else{
				return false;	
			}
		}else{
			return false;	
		}
	}
	// end
	
	// product Artcle Mapping
	public function getTableList(){
		$this->db->select('tabledetails.*');
		$this->db->from('tabledetails');
		$query=$this->db->get();
		return $query->result_array();
	}
	public function getproductType(){
		$this->db->select('producttype.*');
		$this->db->from('producttype');
		$query=$this->db->get();
		return $query->result_array();
	}
	/*public function getArticlesNameID($arr){
		if(!empty($arr)){
			$tempArr       = array();
			$finalArr      = array();
			foreach($arr as $val){
				$this->db->select('tabledetails.*');
		        $this->db->from('tabledetails');
				$this->db->where('tabledetails.tableID',$val);
		        $query     =  $this->db->get();
				$tempArr[] =  $query->result_array();
			}
		    foreach( $tempArr as $key=>$secVal){
				$temp = "";
				$this->db->select('*');
		        $this->db->from($tempArr[$key][0]["tableName"]);
				$query1      =  $this->db->get();
				$temp        =  $query1->result_array() ; 
				foreach($temp as $vall){
					//$finalArr[]  = $vall[$tempArr[$key][0]["fieldID"]]."_".$vall[$tempArr[$key][0]["fieldTitle"]]."_".$tempArr[$key][0]["tableName"];
					$finalArr[]  = $vall[$tempArr[$key][0]["fieldID"]]."_".$vall[$tempArr[$key][0]["fieldTitle"]]."_".$tempArr[$key][0]["tableName"];
				}
			}
			
		}
		return $finalArr;
	}*/
	public function getArticlesNameID($arr){
		if(!empty($arr)){
			$tempArr       = array();
			$finalArr      = array();
			foreach($arr as $val){
				$this->db->select('tabledetails.*');
		        $this->db->from('tabledetails');
				$this->db->where('tabledetails.tableID',$val);
		        $query     =  $this->db->get();
				$tempArr[] =  $query->result_array();
			}
			foreach( $tempArr as $key=>$secVal){
				$temp = "";
				$this->db->select('*');
		        $this->db->from($tempArr[$key][0]["tableName"]);
				$query1      =  $this->db->get();
				$temp        =  $query1->result_array() ; 
				foreach($temp as $vall){
					$finalArr[]  = $vall[$tempArr[$key][0]["fieldID"]]."_".$vall[$tempArr[$key][0]["fieldTitle"]]."_".$tempArr[$key][0]["tableName"]."_".$tempArr[$key][0]["tableID"];
				}
			}
			
		}
		return $finalArr;
	}
	public function getArticlesNameIDNew($arr){
		if(!empty($arr)){
			$tempArr       = array();
			$finalArr      = array();
			foreach($arr as $val){
				$this->db->select('productmenucontent.*');
		        $this->db->from('productmenucontent');
				$this->db->where('productmenucontent.menu_id',$val);
		        $query     =  $this->db->get();				
				$tempArr =  $query->result_array();
				//echo  $this->db->last_query(); exit;
			}
			foreach( $tempArr as $key=>$secVal){
				
					$finalArr[]  = $secVal["id"]."_".$secVal["menu_id"]."_".$secVal["title"];
				
			}
			
		}
		return $finalArr;
	}
	public function insertMapProductArticles( $productTypeID="",$tableID="",$articleID="" ){
		if(trim($productTypeID !="")&&trim($tableID !="")&&trim($articleID !="")){
		  if(trim($productTypeID)!=""){
				$this->db->set('productarticlemap.productTypeID',trim($productTypeID));
		  }
		  if(trim($tableID)!=""){
				$this->db->set('productarticlemap.tableID',trim($tableID));
		  }
		  if(trim($articleID)!=""){
				$this->db->set('productarticlemap.articleID',trim($articleID));
		  }
		  $this->db->insert('productarticlemap');
		  return $this->db->insert_id();
	   }else{
		  return false;
	   }
	}
	//Added by SB on 29/04/2015
	public function insertMapProductArticlesNew( $productTypeID="",$menuID="",$articleID="" ){
		if(trim($productTypeID !="")&&trim($menuID !="")&&trim($articleID !="")){
		  if(trim($productTypeID)!=""){
				$this->db->set('product_article_map.productTypeID',trim($productTypeID));
		  }
		  if(trim($menuID)!=""){
				$this->db->set('product_article_map.menuID',trim($menuID));
		  }
		  if(trim($articleID)!=""){
				$this->db->set('product_article_map.articleID',trim($articleID));
		  }
		  $this->db->insert('product_article_map');
		  return $this->db->insert_id();
	   }else{
		  return false;
	   }
	}
	public function getCentoruList(){
		$this->db->select('userinfo.*,RINFO.firstName fn,RINFO.lastName ln');
		$this->db->from('userinfo');
		$this->db->join('userinfo AS RINFO','userinfo.referarID=RINFO.uID','LEFT');
		$this->db->where('userinfo.userType','VOL');
		$this->db->order_by('userinfo.uID','DESC');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function getSingleValue($id = 0){
		$this->db->select('userinfo.*,RINFO.firstName fn,RINFO.lastName ln');
		$this->db->from('userinfo');
		$this->db->join('userinfo AS RINFO','userinfo.referarID=RINFO.uID','LEFT');
		$this->db->where('userinfo.uID',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function updatePassword($id = 0,$password = ''){
		$sql = "UPDATE userinfo 
				SET 
					email_send_status=email_send_status+1,
					password = '".$password."',
					status='1'
				WHERE uID=".$id;
		$rs = $this->db->query($sql);
		if($rs){
			return true;
		}else{
			return false;	
		}
	}
	// Added by SB on 24/04/2015
	function getArticleList(){
	   $this->db->select('productmenucontent.*');
	   $this->db->from('productmenucontent');
	   $this->db->where('productmenucontent.parent_article_id',0);
	   $query=$this->db->get();
	   return $query->result_array(); 
  }
  function getArticleList1(){
	   $this->db->select('article_management.*');
	   $this->db->from('article_management');
	   $this->db->where('article_management.parent_article_id',0);
	   $query=$this->db->get();
	   return $query->result_array(); 
  }
  //Added by SB on 24/04/2015
  function insertArticleDetails($data=array()){
	   if(!empty($data)){
		   if(trim($data['menuTypeID'])!=""){
				$this->db->set('productmenucontent.menu_id',trim($data['menuTypeID']));
			}
			if(trim($data['articleTypeID'])!=""){
				$this->db->set('productmenucontent.parent_article_id',trim($data['articleTypeID']));
			}
			if(trim($data['articleTitle'])!=""){
				$this->db->set('productmenucontent.title',trim($data['articleTitle']));
			}
			if(trim($data['articleDesc'])!=""){
				$this->db->set('productmenucontent.description',trim($data['articleDesc']));
			}
			if(trim($data['articleImg'])!=""){
				$this->db->set('productmenucontent.image',trim($data['articleImg']));
			}
			if(trim($data['articleStatus'])!=""){
				$this->db->set('productmenucontent.status',trim($data['articleStatus']));
			}
			if(trim($data['fashionPosition'])!=""){
				$this->db->set('productmenucontent.position',trim($data['fashionPosition']));
			}
			$this->db->insert('productmenucontent');
			return $this->db->insert_id();
		}else{
			return false;
		}
   }
   // Added by SB on 28/04/2015
	function getMenuName($menuId){
	   $this->db->select('menumanagement.menuName');
	   $this->db->from('menumanagement');
	   $this->db->where('menumanagement.menuID',$menuId);
	   $query=$this->db->get();
	   $retData =  $query->result(); 
	    return $retData[0]->menuName;
  }
}
	
?>