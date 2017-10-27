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
		where menumanagement.forWebsite=2 and productmenucontent.parent_article_id=0 AND productmenucontent.menu_id=18 order by productmenucontent.title";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function cate_description()//this portion have to be change
	{
		$sql="select productmenucontent.id,productmenucontent.title,productmenucontent.description,productmenucontent.image from productmenucontent
		LEFT JOIN menumanagement ON(productmenucontent.menu_id=menumanagement.menuID)
		where menumanagement.forWebsite=2 and productmenucontent.parent_article_id=0 AND productmenucontent.menu_id=18 order by productmenucontent.title";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	// added by SB on 02/02/2016
	public function catSubcatDesc($catId)
	{
		$sql="select id,title,description,image from productmenucontent where id=$catId
					UNION 
					SELECT sc.id, sc.title, sc.description, sc.image 
					FROM productmenucontent sc
					INNER JOIN productmenucontent pm ON sc.`parent_article_id` = pm.id 
					WHERE sc.`parent_article_id`=$catId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	// get subcategory list added by SB on 22/02/2016
	public function subCatList($catId)
	{
		$sql="select id,title from productmenucontent where parent_article_id=$catId
					";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	// get parent_article_id from subcategory id added by SB on 02/02/2016
	public function getParentId($subCatId){
		$sql = "SELECT parent_article_id 
						FROM productmenucontent 
						WHERE id=$subCatId";
		$query=$this->db->query($sql);
		$result = $query->result_array();			
		return $result[0]['parent_article_id'];
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
	// added by SB on 10/02/2016
	public function delSponcerImg($sponcerImgid)
	{
		$sql="delete from  ct_sponcers where id=$sponcerImgid";
		$query=$this->db->query($sql);
		//return $query->result_array();
		if($query){
			return true;
		}else{
			return false;
		}
		
	}
	// fetch sponcer Image count added by SB on 10/02/2016
	public function spImgCount($userId)
	{
		$sql ="select COUNT(id) as sponcerImgCount 
									FROM ct_sponcers 
									WHERE uID=".$userId;
		$query = $this->db->query($sql);
		$retData = $query->result();
		return $retData[0]->sponcerImgCount;
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
	public function subCatDesc($subCatId)
	{
		$sql="select * from productmenucontent where id=$subCatId ";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function getmonetizer_user()
	{
		//echo "+++++++++++".$this->forWebsite;
		$forwensite=$this->forWebsite;
		$sql="select userinfo.*,user_general_type.* from userinfo LEFT JOIN user_general_type ON(userinfo.uID=user_general_type.user_id)
		 where forWebsite=$forwensite order by userinfo.uID";
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
	public function top_six_productReal($uid){
		/*$sql= "select mp.*,tsp.house_for_sale,tsp.p_img 
						FROM music_monetizer_products mp 
						LEFT JOIN  top_seven_product tsp 
						ON mp.addedBy=tsp.addedBy
						WHERE mp.addedBy=$uid"; */
						
		$sql = "select mp.productID,mp.addedBy,mp.productName,mp.productDesc,mp.productPrice,tsp.house_for_sale,tsp.p_img 
							FROM music_monetizer_products mp 
							LEFT JOIN  top_seven_product tsp
							ON mp.productID=tsp.proTblId       
							WHERE tsp.addedBy=$uid 
							";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function Top_six_Product_music($uId)
	{
		$sql="select * from music_monetizer_products where addedBy=$uId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function topSixPageSpecific($uId ,$moneType)
	{
		//$sql="select * from ct_monetizer_products where userId=$uId and moneTypeId=$moneType";
		$sql ="select ct_monetizer_products.proId,ct_monetizer_products.userId,ct_monetizer_products.productSpecificFile,ct_monetizer_products.eventDate,ct_monetizer_products.eventLocation,music_monetizer_products.productID,music_monetizer_products.productPrice,music_monetizer_products.productName,music_monetizer_products.productDesc,music_monetizer_products.productFile
						FROM ct_monetizer_products LEFT JOIN music_monetizer_products
						ON ct_monetizer_products.proTblId=music_monetizer_products.productID 
						AND ct_monetizer_products.moneTypeId=$moneType 
						WHERE music_monetizer_products.addedBy=$uId
						";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	// Added by SB on 04/02/2016
	public function getMonetizerDetail($monetizerId)
	{
		$sql="select firstName,lastName,emailID,phone,webUrl,profile,facebookLink,myBlogger,twitterLink,youTubeUrl from userinfo where uID=$monetizerId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function getProfileDetail($monetizerId){
		$sql="select artistName,artistPh,aboutMe,profileCountry,profileCity,profileZip,profileSellerEmail,profileSellerWebsite from monitizer_profile_store where userId=$monetizerId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function getSingleSponcerDetail($sponceId)
	{
		$sql="select ct_sponcers.images from ct_sponcers where id=$sponceId";
		$query=$this->db->query($sql);		
		$retData = $query->result();
		return $retData[0]->images;
		 
	}
	// single top six listing image from music_monetizer_products table
	public function getSingleTopSixProDetail($topSixProId)
	{
		$sql="select  productFile from  music_monetizer_products where productID=$topSixProId";
		$query=$this->db->query($sql);		
		$retData = $query->result();
		return $retData[0]->productFile;
		 
	}
	// real estate product image from top_seven_product table
	public function getRealEstateProdetail($topSixProId){
		$sql="select p_img from top_seven_product where proTblId=$topSixProId";
		$query=$this->db->query($sql);		
		$retData = $query->result();
		return $retData[0]->p_img;
	}
	// topsix specific monetizer product image from ct_monetizer_products table
	public function getTopSixSpecificMoneImage($topSixProId){
		$sql="select productSpecificFile from ct_monetizer_products where proTblId=$topSixProId";
		$query=$this->db->query($sql);		
		$retData = $query->result();
		return $retData[0]->productSpecificFile;
	}
	// get single sponcer image detail added by SB on 10/02/2016
	public function getCtAllSponcer($uId)
	{
		$sql="select ct_sponcers.id,ct_sponcers.images from ct_sponcers where uID=$uId";
		$query=$this->db->query($sql);
		return $query->result_array();
		 
	}
	// added by SB on 05/02/2016
	public function getCtAllVideo($uId)
	{
		$sql="select id,videoFile from ct_monetizer_video where uID=$uId";
		$query=$this->db->query($sql);
		return $query->result_array();
		 
	}
	//Added by SB on 11/02/2016
	public function getCtAllGalleryImg($uId){
		$sql="select ct_monetizer_gallery.id,ct_monetizer_gallery.galleryImage from ct_monetizer_gallery where uID=$uId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	// added by SB on 11/02/2016

	public function delVideoLink($videoLinkId)
	{
		$sql="delete from ct_monetizer_video where id=$videoLinkId";
		$query=$this->db->query($sql);
		//return $query->result_array();
		if($query){
			return true;
		}else{
			return false;
		}
		
	}
	public function delRealEstateProImg($realEstateProId){
		$sql="delete from top_seven_product where proTblId=$realEstateProId";
		$query=$this->db->query($sql);
		//return $query->result_array();
		if($query){
			return true;
		}else{
			return false;
		}
	}
	public function delSpecificProImg($topSixSpecificProId){
		$sql="delete from ct_monetizer_products where proTblId=$topSixSpecificProId";
		$query=$this->db->query($sql);
		//return $query->result_array();
		if($query){
			return true;
		}else{
			return false;
		}
	}
	public function delTopSixProImg($topSixProId)
	{
		$sql="delete from  music_monetizer_products where productID=$topSixProId";
		$query=$this->db->query($sql);
		//return $query->result_array();
		if($query){
			return true;
		}else{
			return false;
		}
		
	}
	public function topSixProdCount($userId){
		$sql ="select COUNT(productID) as topSixCount 
									FROM music_monetizer_products 
									WHERE addedBy=".$userId;
		$query = $this->db->query($sql);
		$retData = $query->result();
		return $retData[0]->topSixCount;
	}
	// fetch sponcer Image count added by SB on 10/02/2016
	public function moneVideoLinkCount($userId)
	{
		$sql ="select COUNT(id) as vdoLinkCount 
									FROM ct_monetizer_video 
									WHERE uID=".$userId;
		$query = $this->db->query($sql);
		$retData = $query->result();
		return $retData[0]->vdoLinkCount;
	}
	// banner image delete added by SB on 11/02/2016
	public function deleteBannerImage($id)
	{
		$sql="delete from ct_banner where uID=$id";
		$query=$this->db->query($sql);
		
	}
	// fetch banner Image 
	public function getBannerDetail($uId)
	{
		$sql="select ct_banner.bannerImage from ct_banner where uID=$uId";
		$query=$this->db->query($sql);		
		$retData = $query->result();
		return $retData[0]->bannerImage;
		 
	}
	public function getSiteBanner()
	{
		$sql="select bannerImg from userbanner where forWebsite=".$this->forWebsite;
		$query=$this->db->query($sql);		
		return $query->result_array();
		 
	}
	public function getSingleGalleryDetail($galleryId)
	{
		$sql="select ct_monetizer_gallery.galleryImage from ct_monetizer_gallery where id=$galleryId";
		$query=$this->db->query($sql);		
		$retData = $query->result();
		return $retData[0]->galleryImage;
		 
	}
	public function delGalleryImg($galleryId)
	{
		$sql="delete from ct_monetizer_gallery where id=$galleryId";
		$query=$this->db->query($sql);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	// fetch gallery Image count added by SB on 10/02/2016
	public function galImgCount($userId)
	{
		$sql ="select COUNT(id) as galleryImgCount 
									FROM ct_monetizer_gallery 
									WHERE uID=".$userId;
		$query = $this->db->query($sql);
		$retData = $query->result();
		return $retData[0]->galleryImgCount;
	}
	// delete brochure detail 
	public function deleteBrochureImage($brochureId){
		$sql="delete from ct_brochure where id=$brochureId";
		$query=$this->db->query($sql);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	// get brochure Detail 
	public function getBrochureDetail($uId){
		$sql="select ct_brochure.id,ct_brochure.brochureImage,ct_brochure.brochureMsg,ct_brochure.brochureVideo from ct_brochure where uID=$uId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	// get ticket detail added by SB on 17/02/2016
	public function getCtTickets($uId){
		$sql="select ct_monetizer_ticket.id,ct_monetizer_ticket.name,ct_monetizer_ticket.ticketPrice,ct_monetizer_ticket.image_path,ct_monetizer_ticket.pdf from ct_monetizer_ticket where userId=$uId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	// get monetizer user added by SB on 22/02/2016
	public function getMonetizerUser($catId){
		$anotherWhereCon =" ";
		if($catId==260){ // beauty
			$anotherWhereCon = " OR (ugt.user_general_type_name ='Beauty_Monetizer')";
		}
		elseif($catId==610){ //meetups
			$anotherWhereCon = " OR (ugt.user_general_type_name ='Meetups_Monetizer')";
		}
		elseif($catId==264){ //models
			$anotherWhereCon = " OR (ugt.user_general_type_name ='Models_Monetizer')";
		}
		elseif($catId==265){// music
			$anotherWhereCon = " OR (ugt.user_general_type_name ='Music_Monetizer')";
		}
		elseif($catId==534){// nutri
			$anotherWhereCon = " OR (ugt.user_general_type_name ='Nutri_Monetizer')";
		}
		elseif($catId==272){ // real estate
			$anotherWhereCon = " OR (ugt.user_general_type_name ='RealEstate_Monetizer')";
		}
		$sql = "SELECT u.uID,u.firstName,u.profile,ugt.user_general_type_name 
					FROM userinfo u 
					LEFT JOIN user_general_type ugt 
					ON u.uID=ugt.user_id
					LEFT JOIN monitizer_profile_store mps
					ON u.uID=mps.userId 					
					WHERE (mps.subCatId IN(select id FROM productmenucontent where parent_article_id=$catId)) $anotherWhereCon";
					
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function getMonetizerSubCatUser($subCatId){
		
		$sql = "SELECT u.uID,u.firstName,u.profile,ugt.user_general_type_name 
					FROM userinfo u 
					LEFT JOIN user_general_type ugt 
					ON u.uID=ugt.user_id
					LEFT JOIN monitizer_profile_store mps
					ON u.uID=mps.userId 					
					WHERE mps.subCatId=$subCatId";
					
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	// check userType is monetizer added by SB on 22/02/2016
	public function checkIsMonetizer($userId){
		$sql = "SELECT user_general_type_name 
					FROM  user_general_type  					
					WHERE user_id=$userId";
					
		$query=$this->db->query($sql);
		$retData = $query->result();
		return $retData[0]->user_general_type_name;
	}
	// ct footer banner added by SB on 25/02/2016
	public function ct_footerBanner() //this portion have to be change
	{
		$sql="select ct_footer_banner.footerBanID,ct_footer_banner.bannerImg 
							from ct_footer_banner
							where ct_footer_banner.bannerStatus=1 ";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
		
	// CT partner with me on CT video
	public function getCT_partnerVideo($videoId){
		
			$this->db->select('gbe_level_video.path');
            $this->db->from('gbe_level_video');			
            $this->db->where_in('gbe_level_video.id',$videoId);
			$query = $this->db->get();
			$retData = $query->result();
		    return $retData[0]->path;
	}
	
	// Monetizer Into Signup Payment Video on 03/03/2016
	public function getCT_AllVideo($videoId){
		
			$this->db->select('path,content_image');
            $this->db->from('ct_monetizer_level_video');			
            $this->db->where_in('id',$videoId);
			$query = $this->db->get();
			return $query->result_array();
		   
	}
	// monetizer Country drop down added by SB on 04/03/2016
	public function getMoneCountryList()
	{
		$sql="SELECT * from country WHERE country_id IN (13,38,222,223)
						UNION 
						(SELECT * FROM country where country_id NOT IN (13,38,222,223) ORDER BY name)";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	// level wise text & video for monetizer added by SB on 07/03/2016
		 public function getMonetizerLevelStepVideo(){
            
			$sql = "SELECT * 
								FROM ct_monetizer_level_video 
								WHERE serial_field !=''
								AND forWebsite=$this->forWebsite";
            $query = $this->db->query($sql);
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
		// Monetizer event add section 
		public function getCT_MoneEvent($userId){
		
			$sql = "SELECT * 
								FROM ct_mone_event 
								WHERE userId = $userId
								AND forWebsite=$this->forWebsite";
            $query = $this->db->query($sql);
			return $query->result_array();
		   
		}
}

?>