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
		print_r($query->result_array());exit;
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
		$sql="select bannerTitle,bannerImage from ct_banner where uID=$uId";
		$query=$this->db->query($sql);		
		return $query->result_array();
		//return $retData[0]->bannerImage;
		 
	}
	public function getAllBannerDetail($uId)
	{
		$sql="select * from ct_banner where uID=$uId";
		$query=$this->db->query($sql);		
		return $query->result_array();		 
		 
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
	// CT partner with me Image & video 
	public function getCT_partnerImgVideo($videoId){
		
			$this->db->select('gbe_level_video.content_image,gbe_level_video.path');
            $this->db->from('gbe_level_video');			
            $this->db->where_in('gbe_level_video.id',$videoId);
			$query = $this->db->get();
			return $retData = $query->result_array();
		    
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
	// music specific country list 
	public function getMoneMusicCountryList()
	{
		$sql="SELECT * from country WHERE country_id IN (13,193,222,223)
						 ORDER BY name";
		$query=$this->db->query($sql);
		return $query->result();
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
	/*=================================ADDED BY SUBHENDU(24.11.2016)=================================*/
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

     ################## code for pagination by Subhendu 12-07-2016 ################
    public function totalAds_count($categoryId) {
    	if($categoryId){
    	$this->db->where('categoryId',$categoryId);	
    	}
    	return $this->db->count_all("admin_ads");
    }

    public function fetchTopAds($limit, $start, $categoryId) {
        if($categoryId){
    	$this->db->where('categoryId',$categoryId);	
    	}
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc"); 
        $query = $this->db->get("admin_ads");
         

        /*$this->db->select('admin_ads.*');
        $this->db->from('admin_ads');
        $this->db->where('admin_ads.uID',$UID);
        $this->db->where('admin_ads.status',"1");
        $query=$this->db->get();*/



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
	
	##########################Ruam#####################################
	
	public function fetchTopAds_visited($limit, $start, $user_id, $categoryId) {
		
		// Loading second db and running query.
		$CI = &get_instance();
		//setting the second parameter to TRUE (Boolean) the function will return the database object.
		$this->db2 = $CI->load->database('ADMINDB', TRUE);
		
		$this->db2->select('*');
		$this->db2->where('admin_ads.status','0');
		$this->db2->where('admin_ads.categoryId != ','34');	
		$this->db2->where('admin_ads.categoryId != ','59');
		$this->db2->limit($limit, $start);
		$this->db2->order_by("admin_ads.id", "ASC");
		$query = $this->db2->get('admin_ads');
		//echo $this->db2->last_query();
		$num=$query->num_rows(); 
		

		if ($query->num_rows() < 10) {
			 $status=0;
			 $value=array('status'=>$status);
			 $this->db2->order_by("id", "ASC");
			 $this->db2->update('admin_ads',$value);
			 
			 #############################
		foreach ($query->result() as $row) {
                $data[] = $row;
				
		}
      	
		$lim=$limit-$num;
		
		$this->db2->select('*');
		$this->db2->where('admin_ads.status','0');
		$this->db->where('admin_ads.categoryId != ','34');	
		$this->db->where('admin_ads.categoryId != ','59');
		$this->db2->limit($lim, $start);
		$this->db2->order_by("admin_ads.id", "ASC");
		//$this->db2->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db2->get('admin_ads');
		
		
		foreach ($query->result() as $row2) {
			    $row2->visited_status=$this->get_visited_status($user_id,$row->id);
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
	// Loading second db and running query.
	$CI = &get_instance();
	//setting the second parameter to TRUE (Boolean) the function will return the database object.
	$this->db2 = $CI->load->database('ADMINDB', TRUE);
	
	$this->db2->select('*');
	$this->db2->where('watch_video_task.user_id',$user_id);
	$this->db2->where('watch_video_task.ad_id',$ad_id);
	$query = $this->db2->get('watch_video_task');
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
		
		// Loading second db and running query.
		$CI = &get_instance();
		//setting the second parameter to TRUE (Boolean) the function will return the database object.
		$this->db2 = $CI->load->database('ADMINDB', TRUE);
		
		$this->db2->select('*');
		if($categoryId){
		 $this->db2->where('admin_ads.categoryId',$categoryId);	
		}
		$this->db2->where('admin_ads.status','0');
		$this->db2->limit($limit, $start);
		$this->db2->order_by("admin_ads.id", "ASC");
		//$this->db2->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db2->get('admin_ads');
        $num=$query->num_rows(); 
		
		if ($query->num_rows() < 1) {
			 $status=0;
			 $value=array('status'=>$status);
			 $this->db2->order_by("id", "ASC");
			 $this->db2->where('admin_ads.categoryId',$categoryId);
			 $this->db2->update('admin_ads',$value);
			 
			 #############################
		foreach ($query->result() as $row2) {
			    $row2->visited_status_music=$this->get_visited_status_music($user_id,$row->id);
                $data[] = $row;
		    }
       		
		$lim=$limit-$num;
		
		$this->db2->select('*');
		if($categoryId){
		 $this->db2->where('admin_ads.categoryId',$categoryId);	
		}
		$this->db2->where('admin_ads.status','0');
		$this->db2->limit($lim, $start);
		$this->db2->order_by("admin_ads.id", "ASC");
		//$this->db2->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db2->get('admin_ads');
		$this->db2->last_query();
		
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
	// Loading second db and running query.
	$CI = &get_instance();
	//setting the second parameter to TRUE (Boolean) the function will return the database object.
	$this->db2 = $CI->load->database('ADMINDB', TRUE);
	
	$this->db2->select('*');
	$this->db2->where('watch_video_task.user_id',$user_id);
	$this->db2->where('watch_video_task.ad_id',$ad_id);
	$query = $this->db2->get('watch_video_task');
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
		
		// Loading second db and running query.
		$CI = &get_instance();
		//setting the second parameter to TRUE (Boolean) the function will return the database object.
		$this->db2 = $CI->load->database('ADMINDB', TRUE);
		
		$this->db2->select('*');
		if($categoryId){
		 $this->db2->where('admin_ads.categoryId',$categoryId);	
		}
		$this->db2->where('admin_ads.status','0');
		$this->db2->limit($limit, $start);
		$this->db2->order_by("admin_ads.id", "ASC");
		//$this->db2->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db2->get('admin_ads');
        $num=$query->num_rows(); 
		
		if ($query->num_rows() < 1) {
			 $status=0;
			 $value=array('status'=>$status);
			 $this->db2->order_by("id", "ASC");
			 $this->db2->where('admin_ads.categoryId',$categoryId);
			 $this->db2->update('admin_ads',$value);
			 
			 #############################
		foreach ($query->result() as $row) {
			    $row->visited_status_events=$this->get_visited_status_events($user_id,$row->id); 
			    $data[] = $row;
		    }
       		
		$lim=$limit-$num;
		
		$this->db2->select('*');
		if($categoryId){
		 $this->db2->where('admin_ads.categoryId',$categoryId);	
		}
		$this->db2->where('admin_ads.status','0');
		$this->db2->limit($lim, $start);
		$this->db2->order_by("admin_ads.id", "ASC");
		//$this->db2->join('watch_video_task', 'admin_ads.id = watch_video_task.ad_id', 'left');
		$query = $this->db2->get('admin_ads');
		$this->db2->last_query();
		
		foreach ($query->result() as $row2) {
			    $row2->visited_status_events=$this->get_visited_status_events($user_id,$row->id); 
                $data2[] = $row2;
		    }
			return $data2;
	
		$data=array_merge($data,$data2);
        return $data;		
		}
		
		 
		 
            foreach ($query->result() as $row) {
				$row->visited_status_events=$this->get_visited_status_events($user_id,$row->id);
                $data[] = $row;
		    }
            return $data;
       
        return false;
   }
   
   public function get_visited_status_events($user_id,$ad_id)
   {
	// Loading second db and running query.
	$CI = &get_instance();
	//setting the second parameter to TRUE (Boolean) the function will return the database object.
	$this->db2 = $CI->load->database('ADMINDB', TRUE);
	
	$this->db2->select('*');
	$this->db2->where('watch_video_task.user_id',$user_id);
	$this->db2->where('watch_video_task.ad_id',$ad_id);
	$query = $this->db2->get('watch_video_task');
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
   
    public function fetchBrandCat() {
		// Loading second db and running query.
		$CI = &get_instance();
		//setting the second parameter to TRUE (Boolean) the function will return the database object.
		$this->db2 = $CI->load->database('ADMINDB', TRUE);
		$this->db2->select('ct_category.*');
		$this->db2->join('admin_ads','ct_category.id= admin_ads.categoryId');
		$this->db2->distinct('ct_category.id');
		$this->db2->order_by("ct_category.title", "asc"); 
		$this->db2->from('ct_category');
		$query = $this->db2->get();
		
		    

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $row->getAds=$this->get_allAds($row->id); 
                $data[] = $row;
				
            }
            return $data;
        }
        return false;
   }
   
    public function get_allAds($cat_id)
   {
	// Loading second db and running query.
	$CI = &get_instance();
	//setting the second parameter to TRUE (Boolean) the function will return the database object.
	$this->db2 = $CI->load->database('ADMINDB', TRUE);
	
	$this->db2->select('admin_ads.*');
	$this->db2->where('admin_ads.categoryId',$cat_id);
	$query = $this->db2->get('admin_ads');
	//echo $this->db2->last_query();
	$num=$query->num_rows(); 
	if($num > 0)
	{
		foreach ($query->result() as $row) {
                $data1[] = $row;
				
			}
			return $data1;
	}
	return false;
	   
   }
   
   public function fetchBanner() {
	    $CI = &get_instance();
		//setting the second parameter to TRUE (Boolean) the function will return the database object.
		$this->db2 = $CI->load->database('ADMINDB', TRUE);
        $this->db2->order_by("id", "ASC"); 
        $query = $this->db2->get("admin_adbanner");
         
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function fetch_adcms() {
	    $CI = &get_instance();
		//setting the second parameter to TRUE (Boolean) the function will return the database object.
		$this->db2 = $CI->load->database('ADMINDB', TRUE);
        $this->db2->where('id','1');
        $query = $this->db2->get("admin_adscms");
         
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function getCategory($id) {
		 $CI = &get_instance();
		//setting the second parameter to TRUE (Boolean) the function will return the database object.
		$this->db2 = $CI->load->database('ADMINDB', TRUE); 
        $this->db2->where('ct_category.id',$id);
        $query = $this->db2->get("ct_category");
        //echo $this->db->last_query(); die;
         
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row;
            }
           
        }
        return false;
    }

	function explore_task($id,$user_id) {
     // Loading second db and running query.
		$CI = &get_instance();
		//setting the second parameter to TRUE (Boolean) the function will return the database object.
		$this->db2 = $CI->load->database('ADMINDB', TRUE);   
     $data = array(
            'user_id' => $user_id,
            'ad_id' => $id,
			'is_visited' => 1,
			'visited_date' => date('Y-m-d'),
    );

    $this->db2->insert('watch_video_task', $data);

    }
  
    ################## End By subhendu ###########################################
	public function count_ref_user_list($user_id)
	{
		$data=array();
		$query= $this->db->query("select userPosition from referral_popup_user where referarID= '$user_id'")->result();
		{
			if(!empty($query))
			{
				foreach($query as $qd)
				{
					$data[]= $qd->userPosition;
				}
				$count = array_count_values($data);
				return $count;
			}
		}	
	}
	public function Get_Referral_User(){
		
		$result=array();
		$tbl= 'referral_popup_user';
		$uID = $this->session->userdata('userId');
		
		$SQL= $this->db->query("select uID,firstName from rave_userinfo")->result();
		
		if(!empty($SQL))
		{
			foreach($SQL as $s)
			{
				
				$sql2=$this->db->query("select uID,referarID,firstName,userName,emailID,(select level from rave_share where user_id= ru.uID order by created_on desc limit 0,1)as Userlevel,(select userPosition from rave_share where user_id= ru.uID order by created_on desc limit 0,1)as userPosition,(select userCycle from rave_share where user_id= ru.uID order by created_on desc limit 0,1)as userCycle from rave_userinfo ru where ru.referarID= '$s->uID'")->result();
				if(!empty($sql2))
				{
					foreach($sql2 as $ss)
					{
						
						if(($ss->userPosition) >= 65 && ($ss->userPosition)< 320)
						{
							
							$query=$this->db->query("select * from referral_popup_user where user_id= '$ss->uID' and popup_status='1' and userPosition= '65' and Userlevel= '2' and userCycle= '1' and email_send_status ='n'");
							$count= $query->num_rows();
							$qd= $query->row();
							if($count== 0)
							{
								$date = date("Y-m-d H:i:s");
								$result['user_id'] = $ss->uID;
								$result['referarID'] = $ss->referarID;
								$result['firstName'] = $ss->firstName;
								$result['userName'] = $ss->userName;
								$result['emailID'] = $ss->emailID;
								$result['Userlevel']= $ss->Userlevel;
								$result['userPosition']= 65 ;
								$result['userCycle']= $ss->userCycle;
								$result['popup_status']= 1;
								$result['payment_status']= 0;
								$result['email_send_status']= 'n';
								$result['create_time']= $date;
								
								$this->insertDataToTable($tbl,$result);
							}
							
						}
						else if(($ss->userPosition)>= 320 && ($ss->userPosition)< 577)
						{
							
							$query=$this->db->query("select * from referral_popup_user where user_id= '$ss->uID' and popup_status='1' and userPosition= '320' and Userlevel= '3' and userCycle= '1' and email_send_status ='n'");
							$count= $query->num_rows();
							if($count== 0)
							{
								$date = date("Y-m-d H:i:s");
								$result['user_id'] = $ss->uID;
								$result['referarID'] = $ss->referarID;
								$result['firstName'] = $ss->firstName;
								$result['userName'] = $ss->userName;
								$result['emailID'] = $ss->emailID;
								$result['Userlevel']= $ss->Userlevel;
								$result['userPosition']= 320;
								$result['userCycle']= $ss->userCycle;
								$result['popup_status']= 1;
								$result['payment_status']= 0;
								$result['email_send_status']= 'n';
								$result['create_time']= $date;
								
								$this->insertDataToTable($tbl,$result);
							}
						}
						else if(($ss->userPosition) >= 577 && ($ss->userPosition)< 834)
						{
							
							$query=$this->db->query("select * from referral_popup_user where user_id= '$ss->uID' and popup_status='1' and userPosition= '577' and Userlevel= '4' and userCycle= '1' and email_send_status ='n'");
							$count= $query->num_rows();
							if($count== 0)
							{
								$date = date("Y-m-d H:i:s");
								$result['user_id'] = $ss->uID;
								$result['referarID'] = $ss->referarID;
								$result['firstName'] = $ss->firstName;
								$result['userName'] = $ss->userName;
								$result['emailID'] = $ss->emailID;
								$result['Userlevel']= $ss->Userlevel;
								$result['userPosition']= 577;
								$result['userCycle']= $ss->userCycle;
								$result['popup_status']= 1;
								$result['payment_status']= 0;
								$result['email_send_status']= 'n';
								$result['create_time']= $date;
								
								$this->insertDataToTable($tbl,$result);
							}
						}
						else if(($ss->userPosition) >= 834 && ($ss->userPosition)< 1089)
						{
							
							$query=$this->db->query("select * from referral_popup_user where user_id= '$ss->uID' and popup_status='1' and userPosition= '834' and Userlevel= '5' and userCycle= '1' and email_send_status ='n'");
							$count= $query->num_rows();
							if($count==0)
							{
								$date = date("Y-m-d H:i:s");
								$result['user_id'] = $ss->uID;
								$result['referarID'] = $ss->referarID;
								$result['firstName'] = $ss->firstName;
								$result['userName'] = $ss->userName;
								$result['emailID'] = $ss->emailID;
								$result['Userlevel']= $ss->Userlevel;
								$result['userPosition']= 834;
								$result['userCycle']= $ss->userCycle;
								$result['popup_status']= 1;
								$result['payment_status']= 0;
								$result['email_send_status']= 'n';
								$result['create_time']= $date;
								
								$this->insertDataToTable($tbl,$result);
							}
						}
						else if(($ss->userPosition) >= 1089)
						{
							
							$query=$this->db->query("select * from referral_popup_user where user_id= '$ss->uID' and popup_status='1' and userPosition= '834' and Userlevel= '5' and userCycle= '1' and email_send_status ='n'");
							$count= $query->num_rows();
							if($count==0)
							{
								$date = date("Y-m-d H:i:s");
								$result['user_id'] = $ss->uID;
								$result['referarID'] = $ss->referarID;
								$result['firstName'] = $ss->firstName;
								$result['userName'] = $ss->userName;
								$result['emailID'] = $ss->emailID;
								$result['Userlevel']= $ss->Userlevel;
								$result['userPosition']= 1089;
								$result['userCycle']= $ss->userCycle;
								$result['popup_status ']= 1;
								$result['payment_status']= 0;
								$result['email_send_status']= 'n';
								$result['create_time']= $date;
								
								$this->insertDataToTable($tbl,$result);
							}
						}
					}
				}
				
			}
		}
		$sub = 'Congratulation! You have earned money for the users You have reffered' ;

				
				
				$query= $this->db->query("select rpu.referarID,(select emailID from rave_userinfo where uID=rpu.referarID) as referral_emailID,(select firstName from rave_userinfo where uID=rpu.referarID) as referral_firstName from referral_popup_user as rpu where rpu.email_send_status='n'")->result();
				if(!empty($query))
				{
					
					 foreach ($query as $qq)
					 {
							$count= $this->count_ref_user_list($qq->referarID);
							foreach($count as $key => $val)
							{
								if($key>=65 && $key<320)
								{
									$body = "Hello ," . $qq->referral_firstName . "<br><br>";
									$body .= "Congratulation! You have earned $15 for the user whome you have referred, is moved up from level 1 to 2. <br><br>";
									
									$body .= '<strong>With Regards</strong><br>';
									$body .= '<strong>Community Treasures</strong>';
									$to = 'sreela.cogito@gmail.com';

									$from = 'sreela.cogito@gmail.com';
									//$this->sendMail($to,$from,$sub,$body);
									$mail_status_update=$this->db->query("update referral_popup_user set email_send_status ='y' where referarID= '$qq->referarID' ");
										
								}
								if($key>=320 && $key<577)
								{
									$body = "Hello ," . $qq->referral_firstName . "<br><br>";
									$body .= "Congratulation! You have earned $30 for the user whome you have referred, are moved up from level 2 to 3. <br><br>";
									
									$body .= '<strong>With Regards</strong><br>';
									$body .= '<strong>Community Treasures</strong>';
									$to = 'sreela.cogito@gmail.com';//$qq->referarID

									$from = 'sreela.cogito@gmail.com';//have to change the sender id
									//$this->sendMail($to,$from,$sub,$body);
									$mail_status_update=$this->db->query("update referral_popup_user set email_send_status ='y' where referarID= '$qq->referarID' ");
										
								}
								if($key>=577 && $key<834)
								{
									$body = "Hello ," . $qq->referral_firstName . "<br><br>";
									$body .= "Congratulation! You have earned $60 for the user whome you have referred, are moved up from level 3 to 4. <br><br>";
									$body .= '<strong>With Regards</strong><br>';
									$body .= '<strong>Community Treasures</strong>';
									$to = 'sreela.cogito@gmail.com';//$qq->referarID

									$from = 'sreela.cogito@gmail.com';//have to change the sender id
									//$this->sendMail($to,$from,$sub,$body);
									$mail_status_update=$this->db->query("update referral_popup_user set email_send_status ='y' where referarID= '$qq->referarID' ");
										

								}
								if($key>=834 && $key<1059)
								{
									$body = "Hello ," . $qq->referral_firstName . "<br><br>";
									$body .= "Congratulation! You have earned $90 for the user whome you have referred, are moved up from level 4 to 5. <br><br>";
									$body .= '<strong>With Regards</strong><br>';
									$body .= '<strong>Community Treasures</strong>';
									$to = 'sreela.cogito@gmail.com';//$qq->referarID

									$from = 'sreela.cogito@gmail.com';////have to change the sender id
									//$this->sendMail($to,$from,$sub,$body);
									$mail_status_update=$this->db->query("update referral_popup_user set email_send_status ='y' where referarID= '$qq->referarID' ");
										
								}
							}	
					}
				}
				
	}
	 public function sendMail($to = '', $from = '',$sub = '', $body = '') {
        $this->load->library('email');

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'sreela.biswas05@gmail.com',
            'smtp_pass' => 'arnabsonai',
            'charset' => 'iso-8859-1',
            'mailtype' => 'html',
            'wordwrap' => TRUE
        );

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('sreela.biswas05@gmail.com');
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($body);

        if ($this->email->send())
            return true;
        else
            return false;
    }
	public function update_referral_user($id,$position)
	{
		$data= array('popup_status'=>'0'); 
			$this->db->where('userPosition',$position);
			$this->db->where('popup_status',1);
			$this->db->update('referral_popup_user',$data);
		return true;
	}
}

?>