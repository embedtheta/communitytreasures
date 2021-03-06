<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Gatewaymodel extends CI_Model {

	public $forWebsite;

	function __construct(){

		parent::__construct();

		$this->forWebsite = 2;// For community

	}

	public function getBalanceInCA($userId){

		$this->db->select('MCA.*');

		$this->db->from('my_current_account MCA');

		$this->db->where('MCA.userId',$userId);		

		$sql = $this->db->get();

		return $sql->result();

	}

	//22/09/2015 us

	public function setTransactionId($paymentTblId){

		

		if( $paymentTblId !="" ){

						

			$sql = "UPDATE gbe_payment 

					SET 

					transaction_Id=id+10000

				WHERE id=".$paymentTblId;

		$rs = $this->db->query($sql);

			if($rs){

				return true;

			}else{

				return false;	

			}

		}

	

	}

	public function checkingCatalogPaymentExist($uID){

		$this->db->select('CU.uID,CU.afrooPaymentStatus');

		$this->db->from('userinfo CU');

		$this->db->where('CU.uID',$uID);

		$sql = $this->db->get();

		return $sql->result();

	}

	function chkUserAuth($emailID,$pass){

		if( $emailID !="" && $pass !="" ){

			$this->db->select('userinfo.*');

			$this->db->from('userinfo');

			$this->db->where('userinfo.emailID',$emailID);

			$this->db->where('userinfo.password',$pass); 

			/*$sql = "SELECT * FROM  userinfo WHERE emailID = '".trim($emailID)."' AND BINARY password = '".trim($pass)."'";
           
			$query = $this->db->query($sql);*/

			//$this->db->where('userinfo.forWebsite',$this->forWebsite);// 15/10/2015 ujjwal sana commented

			$query = $this->db->get();
			/*echo "</br>".$this->db->last_query();
			echo "TEST: =>".$query->num_rows();
exit;*/
			if( $query->num_rows()== 1 )

			{

				$temp = $query->result_array(); 

				return $temp[0]; 

			}else

			{

				return false;

			}

		}

	}

        

        public function allMember(){

			

			//echo trim($this->session->userdata('userId')); exit;

            $this->db->select('userinfo.*,country.name country_name,city.city as city_name,user_expell.user_id expelled_user_id');

            $this->db->from('userinfo');

            $this->db->join("country","userinfo.country=country.country_id","LEFT");

            $this->db->join('city','city.id=userinfo.city','LEFT');

            $this->db->join("user_expell","user_expell.user_id=userinfo.uID","LEFT");

            $this->db->where('userinfo.referarID >',0);

			$this->db->where('userinfo.forWebsite', $this->forWebsite);

			

            if(trim($this->session->userdata('referarId')) > 0){

                $this->db->where('userinfo.referarID',trim($this->session->userdata('userId')));

            }

            $this->db->group_by("userinfo.uID");

            $query = $this->db->get();

			// print_r($query);exit;

            return $query->result();

        }

	//new added 2/10/2015 us

	public function allMembersForHV(){

   $sql = "SELECT `userinfo` . * , `country`.`name` country_name, `city`.`city` AS city_name, `user_expell`.`user_id` expelled_user_id, `UGT`.`user_general_type_name`

     FROM (

     `userinfo`

     )

     LEFT JOIN `country` ON `userinfo`.`country` = `country`.`country_id`

     LEFT JOIN `city` ON `city`.`id` = `userinfo`.`city`

     LEFT JOIN `user_expell` ON `user_expell`.`user_id` = `userinfo`.`uID`

     LEFT JOIN `user_general_type` UGT ON `UGT`.`user_id` = `userinfo`.`uID`

     WHERE `userinfo`.`referarID` >0

     AND `userinfo`.`forWebsite` =".$this->forWebsite."

     AND `userinfo`.`referarID` = ".trim($this->session->userdata('userId'))."

     AND (`userinfo`.userType='VOLUNTEERS' OR UGT.user_general_type_name = 'afrowebb')

     GROUP BY `userinfo`.`uID`";

   $query = $this->db->query($sql);  

   /*$this->db->select('userinfo.*,country.name country_name,city.city as city_name,user_expell.user_id expelled_user_id,UGT.user_general_type_name');

            $this->db->from('userinfo');

            $this->db->join("country","userinfo.country=country.country_id","LEFT");

            $this->db->join('city','city.id=userinfo.city','LEFT');

            $this->db->join("user_expell","user_expell.user_id=userinfo.uID","LEFT"); 

   $this->db->join("user_general_type UGT","UGT.user_id=userinfo.uID AND UGT.user_general_type_name = 'afrowebb' ","LEFT");

            $this->db->where('userinfo.referarID >',0);

            if(trim($this->session->userdata('referarId')) > 0){

                $this->db->where('userinfo.referarID',trim($this->session->userdata('userId')));

            }

            $this->db->group_by("userinfo.uID");

            $query = $this->db->get();*/

   //print_r($this->db->last_query());

            return $query->result();

  }

	function chkPrePhaseUserAuth($emailID,$pass){

		if( $emailID !="" && $pass !="" ){

			$this->db->select('prephase.*');

			$this->db->from('prephase');

			$this->db->where('prephase.email',$emailID);

			$this->db->where('prephase.password',$pass);

			$query=$this->db->get();

			if( $query->num_rows()== 1 ){

				$temp = $query->result_array(); 

				return $temp[0]; 

			}else{

				return false;

			}

		}

	}

	

	function isMemberExist($UID){

		if( $UID > 0 ){

			$this->db->select('userinfo.uID');

			$this->db->from('userinfo');

			$this->db->where('userinfo.uID',$UID);

			$this->db->where('userinfo.status',"1");

			$query=$this->db->get();

			if( $query->num_rows()== 1 ){

				return true;

			}else{

				return false;

			}

		}

	}

	

	function isMailExist($emailID=""){

		if( $emailID !="" ){

			$this->db->select('userinfo.uID');

			$this->db->from('userinfo');

			$this->db->where('userinfo.emailID',$emailID);
            $this->db->where('userinfo.status',"1");
			$query=$this->db->get();

			if( $query->num_rows()== 1 ){

				return false;

			}else{

				return true;

			}

		}

	}

	function isCronMailExist($emailID=""){

		if( $emailID !="" ){

			$this->db->select('rave_userinfo.uID');

			$this->db->from('rave_userinfo');

			$this->db->where('rave_userinfo.emailID',$emailID);
            $this->db->where('rave_userinfo.status',"1");
			$query=$this->db->get();

			if( $query->num_rows()== 1 ){

				return false;

			}else{

				return true;

			}

		}

	}

	

	function insertMemberDetails($data=array()){

		if(!empty($data)){

			if(trim($data['firstName'])!=""){

				$this->db->set('userinfo.firstName',trim($data['firstName']));

			}

			if(trim($data['lastName'])!=""){

				$this->db->set('userinfo.lastName',trim($data['lastName']));

			}

			if(trim($data['userName'])!=""){

				$this->db->set('userinfo.userName',trim($data['userName']));

			}

			if(trim($data['emailID'])!=""){

				$this->db->set('userinfo.emailID',trim($data['emailID']));

			}

			if(trim($data['password'])!=""){

				$this->db->set('userinfo.password',trim($data['password']));

			}

			if(trim($data['phone'])!=""){

				$this->db->set('userinfo.phone',trim($data['phone']));

			}

			if(trim($data['gender'])!=""){

				$this->db->set('userinfo.gender',trim($data['gender']));

			}

			if(trim($data['country'])!=""){

				$this->db->set('userinfo.country',trim($data['country']));

			}

			if(trim($data['city'])!=""){

				$this->db->set('userinfo.city',trim($data['city']));

			}

			if(trim($data['parentID'])!=""){

				$this->db->set('userinfo.referarID',trim($data['parentID']));

			}

			if(trim($data['membershipStatus'])!=""){

				$this->db->set('userinfo.membershipStatus',trim($data['membershipStatus']));

			}

                        $this->db->set('userinfo.userType',"PAYING USER");

			$this->db->insert('userinfo');

			$id = $this->db->insert_id();

			$this->createRoute();

			return $id;

		}else{

			return false;

		}

	}

	

	function insertMemberProfilePic($fileName){

		if( $fileName !="" ){

			$data=array('profile'=>$fileName);

			$this->db->where('uID',$this->session->userdata('userId'));

		    $this->db->update('userinfo',$data);

		}

	}

	function insertSponcerProfilePic($fileName){

		if( $fileName !="" ){

			$status=1;

			$this->db->set('ct_sponcers.uID',$this->session->userdata('userId'));

			$this->db->set('ct_sponcers.images',$fileName);

			$this->db->set('ct_sponcers.status',$status);

			$this->db->insert('ct_sponcers');

			$id = $this->db->insert_id();

			return $id;

		}

	}

	// insert Gallery Image added by SB on 11/02/2016

	function insertGalleryImage($fileName){

		if( $fileName !="" ){

			$status=1;

			$this->db->set('ct_monetizer_gallery.uID',$this->session->userdata('userId'));

			$this->db->set('ct_monetizer_gallery.galleryImage',$fileName);

			$this->db->set('ct_monetizer_gallery.status',$status);

			$this->db->insert('ct_monetizer_gallery');

			$id = $this->db->insert_id();

			return $id;

		}

	}

	// Added by SB on 05/02/2016

	function insertMonetizerVideo($fileName){

		if( $fileName !="" ){

			$status=1;

			$this->db->set('ct_monetizer_video.uID',$this->session->userdata('userId'));

			$this->db->set('ct_monetizer_video.videoFile',$fileName);

			$this->db->set('ct_monetizer_video.status',$status);

			$this->db->insert('ct_monetizer_video');

			$id = $this->db->insert_id();

			return $id;

		}

	}

	// Added by SB on 05/02/2016

	function insertBannerImage($fileName,$bannerTitle){

		if( $fileName !="" ||  $bannerTitle!=""){

			$this->db->set('ct_banner.uID',$this->session->userdata('userId'));

			$this->db->set('ct_banner.bannerTitle',$bannerTitle);

			$this->db->set('ct_banner.bannerImage',$fileName);

			$this->db->insert('ct_banner');

			$id = $this->db->insert_id();

			return $id;

		}

	}

	// Added by SB on 05/02/2016

	function updateBanner($fileName,$bannerTitle,$bId){

		

			$imgSet ='';

			if( $fileName !="" ){

			  $imgSet ="bannerImage='".$fileName."'";

			}

			if($bId !=""){

						

			$sql = "UPDATE ct_banner 

					SET 

					bannerTitle='".$bannerTitle."'

					 ".$imgSet."

				WHERE id=".$bId;

			$rs = $this->db->query($sql);

			if($rs){

				return true;

			}

		}

		

	}

	// Added by SB on 05/02/2016

	function insertBrochureImage($fileName,$message){

		if( $fileName !="" ){

			$this->db->set('ct_brochure.uID',$this->session->userdata('userId'));

			$this->db->set('ct_brochure.brochureImage',$fileName);

			$this->db->set('ct_brochure.brochureMsg',$message);

			$this->db->insert('ct_brochure');

			$id = $this->db->insert_id();

			return $id;

		}

	}

	// update brochure 

	function UpdateBrochureMsg($message){

		if( $message !="" ){

			$sql = "UPDATE ct_brochure 

								SET 

								brochureMsg='".$message."'

								WHERE uID=".$this->session->userdata('userId');

			$rs = $this->db->query($sql);

			if($rs){

				return true;

			}else{

				return false;	

			}

		}

	}

	/*function getUserInfo($UID){

            if( $UID != "" ){

                $this->db->select('*,city.city cityName,city.id city_id,country.country_id,country.name countryName');

                $this->db->from('userinfo');

                $this->db->join("city","city.id=userinfo.city AND city.is_active=1","LEFT");

                $this->db->join("country","country.country_id=userinfo.country AND country.status=1","LEFT");

                $this->db->where('userinfo.uID',$UID);

                $query = $this->db->get();

                return $query->result_array();

            }

	}*/

	//5/10/2015 ujjwal sana 

	 public function checkZipExist($city_id,$newZipCode){

		$sql = "SELECT id							  

				FROM zip_code							 

				WHERE city_id = ".$city_id."

				AND zip_code = '".$newZipCode."'";

		$query = $this->db->query($sql);

		if( $query->num_rows()== 1 ){

			return false;

		}else{

			return true;

		}

   }

	public function getZipListByCityId($city_id){

		$this->db->select('zip_code.*');

		$this->db->from('zip_code');			

		$this->db->where('zip_code.city_id',$city_id);

		$this->db->where('zip_code.status',1);

		$query = $this->db->get();

		//echo $this->db->last_query();

		return $query->result_array();

	}

	public function getMyListingDetails($userId){

		$this->db->select('*');

		$this->db->from('listingdetails');

		$this->db->where('listingAddedBy',$userId);

		//$this->db->where('listingdetails.forWebsite', $this->forWebsite);//16/10/2015 ujjwal sana added

		$sql = $this->db->get();

		return $sql->result();

	}

	function updateUserLevel($userId){

		if( $userId !="" ){

			$sql = "UPDATE userinfo 

								SET 

								userLevel=userLevel+1

								WHERE uID=".$userId;

			$rs = $this->db->query($sql);

			if($rs){

				return true;

			}else{

				return false;	

			}

		}

	}

	function getUserInfo($UID){

            if( $UID != "" ){

                $this->db->select('userinfo.*,city.city cityName,city.id city_id,country.country_id,country.name countryName,UGT.user_general_type_name');

                $this->db->from('userinfo');

                $this->db->join("city","city.id=userinfo.city AND city.is_active=1","LEFT");

                $this->db->join("country","country.country_id=userinfo.country AND country.status=1","LEFT");

				$this->db->join("user_general_type UGT","UGT.user_id=userinfo.uID","LEFT");

                $this->db->where('userinfo.uID',$UID);

                $query = $this->db->get();
               // echo $this->db->last_query();
                return $query->result_array();

            }

	}

	

	function countSwitchOnMembers($UID){

		if( $UID != "" ){

			$this->db->select('count(userinfo.uID) as totSwitchMember');

		    $this->db->from('userinfo');

		    $this->db->where('userinfo.referarID',$UID);

			$this->db->where('userinfo.switchOnPayment','1');

		    $query=$this->db->get();

			$arr = $query->result_array();

			return $arr[0]["totSwitchMember"];

		}	

	}

	

	function countMySignUps($UID){

		if( $UID != "" ){

			$this->db->select('count(userinfo.uID) as totSignUps');

		    $this->db->from('userinfo');

		    $this->db->where('userinfo.referarID',$UID);

			$this->db->where('userinfo.status','1');

			$query=$this->db->get();

			$arr = $query->result_array();

			return $arr[0]["totSignUps"];

		}

	}

	function countTotalMembers(){

		$this->db->select('userinfo.uID');

		$this->db->from('userinfo');

		$this->db->where('userinfo.status','1');

                $this->db->where('userinfo.userLevel >','0');

                $this->db->where('userinfo.userLevel <','6');

                $this->db->where('userinfo.userType','PAYING USER');

				$this->db->where('userinfo.forWebsite', $this->forWebsite);// added by SB on 16/10/2015

		$query=$this->db->get();

		return $query->num_rows();

	}

	function getHtmlBanners(){

		$this->db->select('userbanner.bannerID,userbanner.bannerImg');

		$this->db->from('userbanner');

		$this->db->where('userbanner.status','1');

		$this->db->where('userbanner.forWebsite',$this->forWebsite);

		$query=$this->db->get();

		return $query->result_array();

	}

	function getUserAdverts(){

		$this->db->select('useradvert.advertID,useradvert.advertImg');

		$this->db->from('useradvert');

		$this->db->where('useradvert.status','1');

		$this->db->where('useradvert.forWebsite',$this->forWebsite);//15/10/ujjwal sana added

		$query=$this->db->get();

		return $query->result_array();

	}

	function getYoutubeVideos(){

		$this->db->select('useryoutube.id,useryoutube.youtubeName,useryoutube.youtubeUrl');

		$this->db->from('useryoutube');

		$this->db->where('useryoutube.status','1');

		$this->db->where('useryoutube.forWebsite',$this->forWebsite);//15/10/ujjwal sana added

		$query=$this->db->get();

		return $query->result_array();

	}

	function getSwitchOnPaymentResponse($uid){

		if( $uid !="" ){

			$data=array('switchOnPayment'=>'1');

			$this->db->where('uID',$uid);

		    $this->db->update('userinfo',$data);

		}

	}

	function getPaypalEntryFeesResponse($uid){

		if( $uid !="" ){

			$data=array('tenDollerPayment'=>'1');

			$this->db->where('uID',$uid);

		    $this->db->update('userinfo',$data);

		}

	}

	function getAfrooPaymentResponse($uid){

		if( $uid !="" ){

			$data=array('afrooPaymentStatus'=>'1');

			$this->db->where('uID',$uid);

		    $this->db->update('userinfo',$data);

		}

	}

	

	

	function checkIsExistTcPearl(){

		if( $this->session->userdata('UserId') !="" ){

			$this->db->select('usertcpearl.pearlID');

			$this->db->from('usertcpearl');

			$this->db->where('usertcpearl.UID',$this->session->userdata('UserId'));

			$query=$this->db->get();

			if( $query->num_rows()== 1 ){

				return true;

			}else{

				return false;

			}

		}

	}

	function addCodeSubmisssionTcPearl($pearlCode){

		if( $pearlCode !=""){

			if( trim($pearlCode)!="" ){

				$this->db->set('usertcpearl.code',trim($pearlCode));

			}

			if( $this->session->userdata('UserId')!="" ){

				$this->db->set('usertcpearl.UID',$this->session->userdata('UserId'));

			}

			if( $this->session->userdata('UserId')!="" ){

				$this->db->set('usertcpearl.refID',$this->session->userdata('ReferarID'));

			}

			$this->db->insert('usertcpearl');

			return $this->db->insert_id();

		}else{

			return false;

		}

	}

	function editCodeSubmisssionTcPearl($pearlCode){

		if( ($pearlCode !="") && ($this->session->userdata('UserId') !="")){

			$data=array('code'=>$pearlCode);

			$this->db->where('UID',$this->session->userdata('UserId'));

		    $this->db->update('usertcpearl',$data);

			return $this->db->affected_rows(); 

		}

	}

	function checkIsExistTcSilver(){

		if( $this->session->userdata('UserId') !="" ){

			$this->db->select('usertcsilver.silverID');

			$this->db->from('usertcsilver');

			$this->db->where('usertcsilver.UID',$this->session->userdata('UserId'));

			$query=$this->db->get();

			if( $query->num_rows()== 1 ){

				return true;

			}else{

				return false;

			}

		}

	}

	function addCodeSubmisssionTcSilver($silverCode){

		if( $silverCode !=""){

			if( trim($silverCode)!="" ){

				$this->db->set('usertcsilver.code',trim($silverCode));

			}

			if( $this->session->userdata('UserId')!="" ){

				$this->db->set('usertcsilver.UID',$this->session->userdata('UserId'));

			}

			if( $this->session->userdata('UserId')!="" ){

				$this->db->set('usertcsilver.refID',$this->session->userdata('ReferarID'));

			}

			$this->db->insert('usertcsilver');

			return $this->db->insert_id();

		}else{

			return false;

		}

	}

	function editCodeSubmisssionTcSilver($silverCode){

		if( ($silverCode !="") && ($this->session->userdata('UserId') !="")){

			$data=array('code'=>$silverCode);

			$this->db->where('UID',$this->session->userdata('UserId'));

		    $this->db->update('usertcsilver',$data);

			return $this->db->affected_rows(); 

		}

	}

	function getTCPearlCode($UID){

		if( $UID!= "" ){

			$this->db->select('usertcpearl.code');

			$this->db->from('usertcpearl');

			$this->db->where('usertcpearl.UID',$UID);

			$query=$this->db->get();

			$arr    = $query->result_array();

		    $temp   = "";

		    if(!empty($arr)){

				$temp   = $arr[0]["code"]; 

		    }

			return $temp;

		}

	}

	function getTcSilverCode($UID){

		if( $UID!= "" ){

			$this->db->select('usertcsilver.code');

			$this->db->from('usertcsilver');

			$this->db->where('usertcsilver.UID',$UID);

			$query=$this->db->get();

			$arr    = $query->result_array();

		    $temp   = "";

		    if(!empty($arr)){

				$temp   = $arr[0]["code"]; 

		    }

			return $temp;

		}

	}

	

	/// for centoru

	

	function insertData($data){

		$this->db->set('firstName',$data['name']);

		$this->db->set('lastName',$data['surname']);

		$this->db->set('userName',$data['name'].'_'.$data['surname']);

		$this->db->set('password',$data['password']);

		$this->db->set('phone',$data['cellno']);

		$this->db->set('emailID',$data['emailAddr']);

		$this->db->set('city',$data['city']);

		$this->db->set('currency',$data['currency']);

		if($data['country']!=""){

			$this->db->set('country',$data['country']);	

		}

		$this->db->set('skypeID',$data['skypeID']);

		$this->db->set('userType',$data['userType']);

		$this->db->set('referarID',$data['parentID']);

		if($data['userLevel']!=""){

			$this->db->set('userLevel',$data['userLevel']);	

		}

		$this->db->set('status','1');

        $this->db->set('created_date',  date("Y-m-d H:i:s"));		

		$this->db->set('forWebsite',$data['forWebsite']);

		$this->db->insert('userinfo');

		$id =  $this->db->insert_id();

        $this->updateUserName($id);

		$this->createRoute();

		return $id;

	}

        /*Created by RD on 11-3-2015*/

        function updateUserName($userID = 0){

            $this->db->select('userinfo.*');

            $this->db->from('userinfo');

            $this->db->where('uID',$userID);

            $query = $this->db->get();

            $result = $query->result();

            if($result[0]->firstName != "" && $result[0]->lastName != ""){

                $sql = " UPDATE userinfo SET userinfo.userName=CONCAT(REPLACE(userinfo.firstName,' ',''),'.',REPLACE(userinfo.lastName,' ',''),'.',userinfo.uID) WHERE userinfo.uID =".$userID;

            }elseif($result[0]->firstName !="" && $result[0]->lastName == ""){

                $sql = " UPDATE userinfo SET userinfo.userName=CONCAT(REPLACE(userinfo.firstName,' ',''),'.',userinfo.uID) WHERE userinfo.uID =".$userID;

            }

            $this->db->query($sql);

            return true;

        }

	

	function checkUniqueValue($tbl = '',$cond_array = array()){

            if($tbl != ''){

                $this->db->select('COUNT(uID) AS tot');

                $this->db->where($cond_array);

                $sql = $this->db->get($tbl);

                $retData = $sql->result();

                return $retData[0]->tot;

            }else{

                return false;	

            }

	}

	

	function getVendorsList($addedBy){

            $this->db->select('vendorsID,vendorName');

            $this->db->from('vendorslist');

			if($addedBy!=""){

				$this->db->where('vendorAddedBy',$addedBy);

			}

            $query = $this->db->get();

            return $query->result();

	}

        

        function productCategoryList(){

            $this->db->select('producttype.*');

            $this->db->from('producttype');

            $query = $this->db->get();

            return $query->result();

            

	}

        

        function getColor(){

            $this->db->select('id,colorName,colorCode');

            $this->db->from('color');

            $this->db->where('color.colorStatus',1);

            $query = $this->db->get();

            return $query->result();

	}

        

	/*Created by RD on 11-03-2015*/

	function createRoute(){

		$basePath = str_replace("system/","",BASEPATH)."application/config/route_dynamic.php";

		if(file_exists($basePath)){

			$this->db->select('userinfo.*');

			$this->db->from('userinfo');

			$this->db->where('userinfo.forWebsite',$this->forWebsite);//added by us 2/10/2015

			$this->db->or_where('userinfo.userType','ADMIN');//added by us 29/10/2015

			$query = $this->db->get();

			$result = $query->result();

			$output = '<?php ';

			$fp = fopen($basePath, "w");

			if(count($result) > 0){

				foreach($result as $vl){

                                    $uName = $vl->userName;

				

                                    $output .= ' $route["gateway_signup/'.$uName.'"] = "gateway/index/'.$vl->uID.'"; ';//User



                                    $output .= ' $route["signup_head_volunteers/'.$uName.'"] = "signup/head_volunteers/'.$vl->uID.'"; ';// Head volunteers



                                    $output .= ' $route["signup_volunteers/'.$uName.'"] = "signup/volunteers/'.$vl->uID.'"; ';// Volunteers



                                    $output .= ' $route["signup_industryleader/'.$uName.'"] = "signup/industryleader/'.$vl->uID.'"; ';//Gambia teacher



                                    $output .= ' $route["signup_founders/'.$uName.'"] = "signup/founders/'.$vl->uID.'"; ';//Gambia Student



                                    $output .= ' $route["signup_talented/'.$uName.'"] = "signup/talented/'.$vl->uID.'"; ';



                                    $output .= ' $route["signup_mentorship/'.$uName.'"] = "signup/mentorship/'.$vl->uID.'"; ';



                                    $output .= ' $route["signup_health/'.$uName.'"] = "signup/health/'.$vl->uID.'"; ';



                                    $output .= ' $route["signup_communities/'.$uName.'"] = "signup/communities/'.$vl->uID.'"; ';



                                    $output .= ' $route["signup_business/'.$uName.'"] = "signup/business/'.$vl->uID.'"; ';

									

									//new added for communitytreasure 27/10/2015 ujjwal sana

									

									

									$output .= ' $route["signup_realestate/'.$uName.'"] = "signup/realestate/'.$vl->uID.'"; ';



                                    $output .= ' $route["signup_fitness/'.$uName.'"] = "signup/fitness/'.$vl->uID.'"; ';



                                    $output .= ' $route["signup_food/'.$uName.'"] = "signup/food/'.$vl->uID.'"; ';



                                    $output .= ' $route["signup_hair_and_beauty/'.$uName.'"] = "signup/hair_and_beauty/'.$vl->uID.'"; ';

									

									

																		

									$output .= ' $route["blog/'.$uName.'"] = "blog/index/'.$vl->uID.'"; ';

									//13/1/2016 new link creation on Monetizer

									$output .= ' $route["signup_beauty/'.$uName.'"] = "signup/beauty/'.$vl->uID.'"; ';

									$output .= ' $route["signup_meetups/'.$uName.'"] = "signup/meetups/'.$vl->uID.'"; ';

									

									

                                        

				}				

			}

			$output .= ' ?>';

			fwrite($fp,$output);

			fclose($fp);

			unset($output);

		}else{

			return false;	

		}

	}

        

        public function getCity(){

            $this->db->select('city.*');

            $this->db->from('city');

            $this->db->where('is_active',1);

            $query = $this->db->get();

            //echo $this->db->last_query();

            return $query->result();

        }

         /* public function CtgetCity(){

            $this->db->select('city.*');

            $this->db->from('city');

            

            $query = $this->db->get();

            //echo $this->db->last_query();

            return $query->result();

        } */

        public function getLevelWiseCount(){

            $sql = "  SELECT

                        SUM(IF(userLevel = 1,1,0)) level_1,

                        SUM(IF(userLevel = 2,1,0)) level_2,

                        SUM(IF(userLevel = 3,1,0)) level_3,

                        SUM(IF(userLevel = 4,1,0)) level_4,

                        SUM(IF(userLevel = 5,1,0)) level_5

                      FROM userinfo

                      WHERE `status` = '1'

					   AND forWebsite =".$this->forWebsite."

                          AND userType = 'PAYING USER'";

            

           

            $query = $this->db->query($sql);

            //echo $this->db->last_query();

            return $query->result();

        }

        

        public function getAfroProduct(){

            $this->db->select('afrowebb_catalog_details.*');

            $this->db->from('afrowebb_catalog_details');

			 if($this->forWebsite!=""){

				  $this->db->where('forWebsite',$this->forWebsite);

			 }

            $this->db->where('level',1);

            $this->db->where('status',1);

			

            $query = $this->db->get();

            //echo $this->db->last_query();

            return $query->result();

        }

        

        public function getAfroProductById($id = ""){

            $this->db->select('afrowebb_catalog_details.*');

            $this->db->from('afrowebb_catalog_details');

            $this->db->where('id',$id);

            $this->db->where('status',1);

            $query = $this->db->get();

            //echo $this->db->last_query();

            return $query->result();

        }

		//24/08/2015 done by ujjwal sana

		public function user_details($tbl = '', $where = array(), $userName = '')

	{

		if (trim($tbl) != '' && !empty($tbl)) {

            if ($userName != '') {

                $this->db->select($tb1.'*');

				 $this->db->where($tb1.'userName',$userName);

            } else {

                $this->db->select('*');

            }

            $this->db->from($tbl);

            

            $sql = $this->db->get();

            return $sql->result();

        }

		

	}

	public function imageUnlinkPath() {

        $path = BASEPATH;

        $basePath = str_replace("system/", "", $path);

        return $basePath;

    }

	 public function insertDataToTable($tb3 = '', $id='', $data = array()) {

        if ($tb3 != '' && !empty($data) && sizeof($data) > 0) {

          //  $this->db->insert($tbl, $data);

           // $result=$this->db->insert_id();

			$this->db->where('uID',$id);

          	$this->db->update($tb3, $data);

			//$result=$this->db->insert_id();

			

			return  $result;

        } else {

            return false;

        }

    }

	 public function updateDataToTable($tb2= '',$where = array(), $id= '', $data = array() )

	  {

       if (trim($tb2) != '' && !empty($tb2))

	    {

			$this->db->where('uID',$id);

            $rdata = $this->db->update(trim($tb2), $data);

			

            if ($rdata)

			 {

                return true;

            } else

			 {

                return false;

            }

        } 

		else 

		{

			

            return false;

        }

    }

	public function city_list()

	{

		$this->db->select('city.city,city.id');

            $this->db->from('city');

           // $this->db->where('is_active',1);

            $query = $this->db->get();

            //echo $this->db->last_query();

            return $query->result();

	}

	public function country_list()

	{

		$this->db->select('country.country_id,country.name');

		$this->db->from('country');

		$query=$this->db->get();

		return $query->result();

	}

	public function fetchDataFromTable($tbl = '', $where = array(), $id= '') {

        if (trim($tbl) != '' && !empty($tbl)) {

            if ($id != '') {

                $this->db->select($tb1.'*');

				 $this->db->where($tb1.'uID',$id);

            } else {

                $this->db->select('*');

            }

            $this->db->from($tbl);

            $sql = $this->db->get();

            return $sql->result();

        }

    }

	public function getprofile_picture($tb1,$id)

		{

			

            if ($id != '') {

                $this->db->select('profile');

				$this->db->from($tb1);

				 $this->db->where('uID',$id);

            } else {

				

                $this->db->select('*');

            }

            $sql = $this->db->get();

			

            return $sql->result();

       

	}

        

        public function getCountryList(){

            $this->db->select('country.*');

            $this->db->from('country');

            $this->db->where('country.status',1);
			
			//$this->db->where('country.country_id',$cId);

			//$this->db->where('country.forWebsite',$this->forWebsite);//15/10/ujjwal sana added

            $query = $this->db->get();

            //echo $this->db->last_query();

            return $query->result();

        }	


        public function getAllCountryList($cId){

            $this->db->select('country.*');

            $this->db->from('country');

            $this->db->where('country.status',1);
			
			$this->db->where('country.country_id',$cId);

			$query = $this->db->get();

            echo $this->db->last_query();

            return $query->result();

        }			

        public function getLevelStepVideo($level = 1){

            $this->db->select('gbe_level_video.*');

            $this->db->from('gbe_level_video');

            $this->db->where('gbe_level_video.level',$level);

			$this->db->where('gbe_level_video.forWebsite',$this->forWebsite); // added n blocked by SB on 16/10/2015

            $query = $this->db->get();

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

        

        public function getInvoiceData($where = array()){

            $this->db->select('gbe_payment.*,userinfo.firstName,userinfo.lastName,userinfo.emailID');

            $this->db->from('gbe_payment');

            $this->db->join('userinfo','userinfo.uID = gbe_payment.user_id','LEFT');

            $this->db->where($where);

            $query = $this->db->get();

            $dd = $query->result();

        }

	// Added by SB on 23-04-2015

		function getExpellUserInfo($expellID){

            if( $expellID != "" ){

               /*  $this->db->select('*,city.city cityName,country.name countryName');

                $this->db->from('userinfo');

                $this->db->join("city","city.id=userinfo.city AND city.is_active=1","LEFT");

                $this->db->join("country","country.country_id=userinfo.country AND country.status=1","LEFT");

                $this->db->where('userinfo.uID',$expellID); */

				$sql = 'SELECT user_expell.*,

							  UserExpelled.firstName EUserfName,

							  UserExpelled.lastName EUserlName,

							  UserExpelled.userType EUserType,

							  (SELECT name FROM country WHERE country_id=UserExpelled.country) EUserCountry,

							  UserExpelledBy.firstName,

							  UserExpelledBy.lastName,

							 UserExpelledBy.userType UserType,

							(SELECT name FROM country WHERE country_id=UserExpelledBy.country) UserCountry

							FROM user_expell

							  LEFT JOIN userinfo UserExpelled

								ON UserExpelled.uID = user_expell.user_id

							  LEFT JOIN userinfo UserExpelledBy

								ON UserExpelledBy.uID = user_expell.expell_by_user_id

							WHERE user_expell.id = '.$expellID;

				$query = $this->db->query($sql);

                //$query = $this->db->get();

                return $query->result_array();

            }

		}

                

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

    

    public function getStep2Url(){

        $this->db->select('admin_step2_b.*,userinfo.firstName,userinfo.lastName,userinfo.emailID');

        $this->db->from('admin_step2_b');

        $this->db->join('userinfo','userinfo.uID = admin_step2_b.user_id','LEFT');

		$this->db->where('admin_step2_b.for_website',$this->forWebsite);

        $query = $this->db->get();

        //echo $this->db->last_query();

        return $query->result();

    }

	// added by SB on 24-06-2015

	

	 public function getCategory(){

            $this->db->select('menumanagement.*');

            $this->db->from('menumanagement');

            $this->db->where('menumanagement.menuStatus','1');

			 if($this->forWebsite!=""){

				$this->db->where('menumanagement.forWebsite',$this->forWebsite);

				//14/09/2015 ujjwal sana

			}

            $query = $this->db->get();

            //echo $this->db->last_query();

            return $query->result_array();

        }

	// added by Sb on 25/06/2015

	public function getArticleList($catId){

            $this->db->select('productmenucontent.*');

            $this->db->from('productmenucontent');

			$this->db->where('productmenucontent.parent_article_id',0);

			$this->db->where('productmenucontent.menu_id',$catId);

            $this->db->where('productmenucontent.status','1');

            $query = $this->db->get();

            //echo $this->db->last_query();

            return $query->result_array();

        }

	public function getSubArticleList($articleId){

		

            $this->db->select('productmenucontent.*');

            $this->db->from('productmenucontent');

			$this->db->where('productmenucontent.parent_article_id',$articleId);			

            $this->db->where('productmenucontent.status','1');

            $query = $this->db->get();

			

            //echo $this->db->last_query();

            return $query->result_array();

        }
		
		
		

	// added by SB on 29/06/2015

	public function getCityListByCountryId($countryId){

            $this->db->select('city.*');

            $this->db->from('city');

			 if($countryId!=0)

			 {

				 $this->db->where('city.countryId',$countryId);

			 }

            $this->db->where('city.is_active','1');

            $query = $this->db->get();

            //echo $this->db->last_query();

            return $query->result();

        }

	

// check city name exists or not added by SB on 02/07/2015

   public function checkCityExist($countryId,$newCityName){

			

			$sql = "SELECT city.id							  

							FROM city							 

							WHERE city.countryId = ".$countryId."

							AND city.city LIKE '%".$newCityName."%'";

			$query = $this->db->query($sql);

			if( $query->num_rows()== 1 ){

				return false;

			}else{

				return true;

			}	

				

           

   }

	// add new city name to database

	public function addNewCity($countryId,$newCityName){

		if( $countryId >0 && $newCityName!=''){

			if( trim($countryId)>0 ){

				$this->db->set('city.countryId',$countryId);

			}

			if( $newCityName!="" ){

				$this->db->set('city.city',$newCityName);

				$this->db->set('city.is_active',1);

			}

			

			$this->db->insert('city');

			return $this->db->insert_id();

		}else{

			return false;

		}

	}

        

        // get all products of a user //RD//29-06-2015

        public function getAllProductsByUser($userId = 0){

            $this->db->select("PD.*,PF.fileName,PO.voucher_code");

            $this->db->from("product_details PD");

            $this->db->join("product_files PF","PF.productId=PD.productID","LEFT");
			$this->db->join("product_offer PO","PO.product_id=PD.productID","LEFT");

            $this->db->where("PF.isMain",1);

            $this->db->where("PF.fileType",0);

            $this->db->where("PF.fileStatus",1);

			//$this->db->where("PF.forWebsite",3);

            $this->db->where("PD.addedBy",$userId);

			//$this->db->where("PD.forWebsite",$this->forWebsite);//16/10/2015 ujjwal sana added

            $this->db->order_by("PD.productID","DESC");

            $query = $this->db->get();

            //echo $this->db->last_query();

            return $query->result();

        }

	function getPassword($emailID){

		if( $emailID !=""){

			

			$this->db->select('userinfo.*');

			$this->db->from('userinfo');

			$this->db->where('userinfo.emailID',$emailID);			

			$this->db->where('userinfo.forWebsite',$this->forWebsite);

			$query = $this->db->get();

			//echo $this->db->last_query();

			//echo $query->num_rows();

			//exit;

			

			if( $query->num_rows()== 1 ){

				$temp = $query->result_array(); 

				return $temp[0]; 

			}else{

				return false;

			}

		}

	}

	// get currency id from country table

	function getCurrency($cityId){

		if( $cityId !=""){

			$sql = "SELECT country.counCurrenry 

						FROM city  

						LEFT JOIN country 

						ON city.countryId=country.country_id 

						WHERE city.id=".$cityId;	

			$query = $this->db->query($sql);			

			

			if( $query->num_rows()== 1 ){

				$currency = $query->result_array(); 

				return $currency[0]['counCurrenry']; 

			}else{

				return false;

			}

		}

	}

	//get currency from country

	function getCurrencyFromCountry($conId){

		if( $conId !=""){

			$sql = "SELECT country.counCurrenry 

						FROM country 						

						WHERE country.country_id=".$conId;	

			$query = $this->db->query($sql);			

			

			if( $query->num_rows()== 1 ){

				$currency = $query->result_array(); 

				return $currency[0]['counCurrenry']; 

			}else{

				return false;

			}

		}

	}

	// get parrent currency for currency conversion

	function getParentCurrency($parentId){

		if( $parentId !=""){

			$sql = "SELECT userinfo.currency 

						FROM userinfo  						 

						WHERE userinfo.uID=".$parentId;	

			$query = $this->db->query($sql);			

			

			if( $query->num_rows()== 1 ){

				$currency = $query->result_array(); 

				return $currency[0]['currency']; 

			}else{

				return false;

			}

		}

	}

	

	public function getOverViewOfLevel1($userType,$userId){

		if($userType == "PAYING USER"){

			$sql = $this->getPayingUserStatisticsSQL($userId);	//15/10/2015 changes forWebsite ujjwal sana

		}else{

			$sql = $this->getOthersUserStatisticsSQL($userId);//15/10/2015 changes forWebsite ujjwal sana

		}

		//echo $sql;

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		return $query->result();

	}

	

	public function getPayingUserStatisticsSQL($userId){

		$sql = "SELECT

				  UINFO.uID,

				  UINFO.referarID,

				  UINFO.firstName,

				  UINFO.lastName,

				  UINFO.userType,

				  UINFO.userLevel,

				  UGT.user_general_type_name,

				  (SELECT

					 COUNT(UINFO1.uID)

				   FROM userinfo UINFO1

				   WHERE UINFO1.referarID = UINFO.uID)    totalMember

				FROM userinfo UINFO

				  LEFT JOIN user_general_type UGT

					ON UGT.user_id = UINFO.uID

				WHERE UINFO.referarID = ".$userId." 

					AND UINFO.forWebsite = ".$this->forWebsite."

					AND UGT.user_general_type_name != ''

					AND UINFO.userLevel = 0

					AND UINFO.userType = 'PAYING USER'

				ORDER BY UINFO.uID  DESC";

		return $sql;

	}

	

	public function getOthersUserStatisticsSQL($userId){

		$sql = "SELECT

				  UINFO.uID,

				  UINFO.referarID,

				  UINFO.firstName,

				  UINFO.lastName,

				  UINFO.userType,

				  UINFO.userLevel,

				  (SELECT

					 COUNT(UINFO1.uID)

				   FROM userinfo UINFO1

				   WHERE UINFO1.referarID = UINFO.uID)    totalMember

				FROM userinfo UINFO

				WHERE UINFO.referarID = ".$userId."

					AND UINFO.forWebsite = ".$this->forWebsite."

					AND UINFO.userLevel = 0

				ORDER BY UINFO.uID  DESC";

		return $sql;

	}

	

	public function getUserMassDetails($userId){

		$this->db->select('CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.password cupwd,CU.emailID cuEmail,CU.userType cuUserType,CU.userLevel cuUserLevel,PU.firstName puFName,PU.lastName puLName,PU.userType puUserType,GMD.id,GMD.message');

		$this->db->from('userinfo CU');

		$this->db->join('userinfo PU','PU.uID = CU.referarID','LEFT');

		$this->db->join('gbe_mass_details GMD','GMD.to_user_id = CU.uID','LEFT');

		$this->db->where('CU.uID',$userId);

		$sql = $this->db->get();

		//print_r($this->db->last_query());

		return $sql->result();

	}

	// update user currency

	function updateUserCurrency($currId,$userId){

		if( $currId !="" ){

			$data=array('currency'=>$currId);

			$this->db->where('uID',$userId);

		    $this->db->update('userinfo',$data);

			return $this->db->affected_rows(); 

		}

	}

	//1/09/2015 ujjwal sana

	public function getCatalogueCommissionDetails($userId){

		$sql = "SELECT

				  `CU`.`uID`,

				  `CU`.`referarID`,

				  `CU`.`firstName`            cuFName,

				  `CU`.`lastName`             cuLName,

				  `CU`.`emailID`              cuEmail,

				  `GP`.`parent_commossion`,

				  CASE `GP`.`payment_currency`

					WHEN 'USD' THEN '$'

					WHEN 'EUR' THEN '€'

					WHEN 'GBP' THEN '£'

				   END AS pc

				FROM (`userinfo` CU)

				  JOIN `gbe_payment` GP

					ON `GP`.`user_id` = `CU`.`uID`

				WHERE `CU`.`referarID` = ".$userId."

					AND `CU`.`forWebsite` = ".$this->forWebsite."

					AND `GP`.`payment_for` = 1

					AND `GP`.`status` = 'COMPLETED'";

	

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		return $query->result();

		/*$this->db->select('CU.uID,CU.referarID,CU.firstName cuFName,CU.lastName cuLName,CU.emailID cuEmail,GP.parent_commossion,CASE payment_currency

WHEN "USD" THEN  "$"

WHEN "EUR" THEN  "€"

WHEN "GBP" THEN  "£"

END as payment_currency');

		$this->db->from('userinfo CU');

		$this->db->join('gbe_payment GP','GP.user_id = CU.uID');

		$this->db->where('CU.referarID',$userId);

		$this->db->where('GP.payment_for',1);

		$this->db->where('GP.status','COMPLETED');

		$sql = $this->db->get();*/

		//print_r($this->db->last_query());

		//return $sql->result();

	}

	//check User Exist in subscription Table added by SB on 18/09/2015

	public function checkUserExists($userId){

		$this->db->select('usi.id');

		$this->db->from('user_subscription_info usi');

		$this->db->where('usi.userId',$userId);

		$query = $this->db->get();

		if( $query->num_rows()== 1 ){

				$temp = $query->result_array(); 

				return $temp[0]['id']; 

		}else{

				return 0;

		}

	}


	##################  Method for revuserinfo #################
	function getParentId(){
		
		$sql ="SELECT userPosition,user_id FROM rave_share WHERE `level`=1 AND userCycle=1 AND userPosition =1 AND status ='1'  ORDER BY id asc LIMIT 1";// added by SB 16/09/2016

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		$parent_id_array = $query->result_array();
		if(empty($parent_id_array))
			$parentId = 0;
		else
			$parentId = $parent_id_array[0]['user_id'];

		return $parentId; 		

	}


	#################  Added by SD on 24-11-2016 ############
	function createRouteRave(){

		$basePath = str_replace("system/","",BASEPATH)."application/config/route_dynamic.php"; 

		if(file_exists($basePath)){

			$this->db->select('rave_userinfo.*');

			$this->db->from('rave_userinfo');

			$this->db->where('rave_userinfo.forWebsite',$this->forWebsite);//added by us 2/10/2015

			$this->db->or_where('rave_userinfo.userType','ADMIN');//added by us 29/10/2015

			$query = $this->db->get();

			//echo "++++".$this->db->last_query();exit;

			$result = $query->result();

			$output = '<?php ';

			$fp = fopen($basePath, "w");			

			if(count($result) > 0){ 

				foreach($result as $vl){

                                    $uName = $vl->userName;

				

                                    $output .='$route["signupuser_signupFounder/'.$uName.'"]="signupuser/signupFounder/'.$vl->uID.'";';//Founder



                                    $output .='$route["signupuser_signupLeader/'.$uName.'"]="signupuser/signupLeader/'.$vl->uID.'";';// Industrial Leader



                                    $output .='$route["signupuser_signupGuest/'.$uName.'"]="signupuser/signupGuest/'.$vl->uID.'";';// Paying User                                    

				}	

				

			}

			$output .= ' ?>';			

			fwrite($fp,$output);

			fclose($fp);

			unset($output);

		}else{

			

			return false;	

		}

	}
	#################  End by subhendu on dated 24-11-2016 ##
    function getPendingActiveUser(){
		
		$sql ="SELECT uID,emailID,password FROM `rave_userinfo` WHERE `afrooPaymentStatus` = '1' AND `status` = '1' AND `confirmStatus` = '1' ORDER BY `confirmedOn` ASC";

		$query = $this->db->query($sql);

		//echo $this->db->last_query();
		return $query->result_array(); 		

	}
	function getTopMember($level,$cycle){

		if($level==1){

			$levelPosition = 1;

		}
/// all +1
		else if($level==2){

			$levelPosition = 65; //65;

		}

		else if($level==3){

			$levelPosition = 321;//321;

		}

		else if($level==4){

			$levelPosition = 577;//577;

		}

		else if($level==5){

			$levelPosition = 833;//833;

		}

		//$sql ="SELECT userPosition,user_id FROM rave_share WHERE level=".$level." ORDER BY id desc LIMIT 1";

		//$sql ="SELECT userPosition,user_id FROM rave_share WHERE `level`=".$level." AND userCycle=".$cycle." AND userPosition=1";// blocked by SB on 16/09/2016

		$sql ="SELECT userPosition,user_id FROM rave_share WHERE `level`=".$level." AND userCycle=".$cycle." AND userPosition = ".$levelPosition."  ORDER BY id asc LIMIT 1";// added by SB 16/09/2016

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		return $query->result_array(); 		

	}


	function checkMemCount($level,$date,$userId){

		$numberOfMember = 0;

		$sql ="SELECT numOfMember FROM raveCapChk WHERE `level`=".$level." AND joinDate='".$date."' AND userId=".$userId;

		$query = $this->db->query($sql);

		//echo $this->db->last_query(); exit;

		$res = $query->result_array(); 

		if($res[0]['numOfMember']!=""){

			$numberOfMember =$res[0]['numOfMember'];

		}		

		return $numberOfMember; 

	}


	// insert cap record 

	function insertCapRecord($level,$date,$userId){

		$sql ="INSERT INTO raveCapChk(level,joinDate,numOfMember,userId) VALUES ($level,'$date',1,$userId)";

		$query = $this->db->query($sql);

		return $this->db->insert_id();

	}
    // update cap record daily basis

	function updateCapRecord($level,$date,$userId){

		$sql ="UPDATE raveCapChk SET numOfMember=numOfMember+1 

						WHERE `level`=".$level." AND joinDate='$date' AND userId=".$userId;

		$query = $this->db->query($sql);

		return $this->db->affected_rows(); 

	}
	function getCommMember($level,$cycle){

		if($level==1){

			$positionArray ="(1,9,17,25,33,41,49,57)";// blocked by SB on 11/08/2016

			//$positionArray ="(2,5,8,11,14,17,20,23)"; // added by SB on 11/08/2016

			//$positionBtwn =" (RS.userPosition  BETWEEN 9 AND 80 ) "; // added by SB on 09/09/2016

		}

		else if($level==2){

			//$positionArray ="(65,81,97,113,129,145,161,177,193,209,225,241,257,273,289,305)";//blocked by subhendu because I increment the userposition by 1 before commission calculation except userposition 65 on dated 08-11-2016
			  $positionArray ="(65,82,98,114,130,146,162,178,194,210,226,242,258,274,290,306)"; // created  by subhendu on dated 08-11-2016

			//$positionBtwn =" ( RS.userPosition=1 OR (RS.userPosition  BETWEEN 18 AND 289)) ";

		}

		else if($level==3){

			//$positionBtwn ="( RS.userPosition  BETWEEN 1 AND 272 )";

			//$positionArray ="(321,337,353,369,385,401,417,433,449,465,481,497,513,529,545,561)";//blocked by subhendu because I increment the userposition by 1 before commission calculation except userposition 321 on dated 08-11-2016

			$positionArray ="(321,338,354,370,386,402,418,434,450,466,482,498,514,530,546,562)";

		}

		else if($level==4){

			//$positionArray ="(577,593,609,625,641,657,673,689,705,721,737,753,769,785,801,817)";//blocked by subhendu because I increment the userposition by 1 before commission calculation except userposition 577 on dated 08-11-2016	
			$positionArray ="(577,594,610,626,642,658,674,690,706,722,738,754,770,786,802,818)";		

		}

		else if($level==5){

			//$positionArray ="(833,849,865,881,897,913,929,945,961,977,993,1009,1025,1041,1057,1073)";//blocked by subhendu because I increment the userposition by 1 before commission calculation except userposition 833 on dated 08-11-2016

			$positionArray ="(833,850,866,882,898,914,930,946,962,978,994,1010,1026,1042,1058,1074)";				

		}

		 $sql ="SELECT RS.userCycle,RS.level,RS.userPosition,RS.user_id,RS.status,RS.counter,URT.raveType 

					FROM rave_share RS 

					LEFT JOIN user_raveshare_type URT ON RS.user_id=URT.user_id

					WHERE RS.level=".$level." AND RS.userCycle=".$cycle." AND RS.userPosition IN ".$positionArray.""; 

				

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		return $query->result_array(); 		

	}


	// add commission to top members  & referer

	function addCommissionToTopmembernRef($parentId,$comAmount,$counter,$cycle,$userLevel){

		$addCounter = "";

		if($counter==1){

			$addCounter =", counter=counter+1 ";

		}
		if($comAmount=="")
			$comAmount=0;

		/*$sql ="UPDATE rave_share SET amount=amount+".$comAmount." ".$addCounter." 

						WHERE `status`=1 AND user_id=".$parentId; */

						

		  //echo "<br/>addCommissionToTopmembernRef:".
		  $sql ="UPDATE rave_share SET amount=amount+".$comAmount." ".$addCounter." 

						WHERE `level`=".$userLevel." AND `userCycle`=".$cycle." AND user_id=".$parentId;

				if($userLevel=="1" && $cycle=="2"){
					//echo "<br>addCommissionToTopmembernRef: ".$sql;
				}		

		$this->db->query($sql);

		return $this->db->affected_rows(); 

	}

	// trancation add 

	function tranRecordInter($instData=array()){

		

		if( $instData['note']!="" ){

				$this->db->set('raveTransactionLog.note',$instData['note']);

		  }

		  if( $instData['userCycle']!="" ){

				$this->db->set('raveTransactionLog.userCycle',$instData['userCycle']);

		  }

		  if( $instData['action']!="" ){

				$this->db->set('raveTransactionLog.action',$instData['action']);

		  }

		  if( $instData['amount']!="" ){

				$this->db->set('raveTransactionLog.amount',$instData['amount']);

		  }

		  if( $instData['tranDate']!="" ){

				$this->db->set('raveTransactionLog.tranDate',$instData['tranDate']);

		  }

		

		$this->db->insert('raveTransactionLog');

		//echo $this->db->last_query();

		return $this->db->insert_id();

	}

	// get myReferer

	function getMyReferer($userId){

		

		/* $sql ="SELECT RUI.referarID,RUI1.userLevel

				FROM rave_userinfo RUI 

				INNER JOIN rave_userinfo RUI1

				ON RUI.referarID=RUI1.uID

				WHERE RUI.uID=".$userId." 

				AND RUI.referarID!=1000"; */ // blocked by SB on 29/06/2016

				

				$sql ="SELECT RUI.referarID,RUI1.userLevel

				FROM rave_userinfo RUI 

				INNER JOIN rave_userinfo RUI1

				ON RUI.referarID=RUI1.uID

				WHERE RUI.uID=".$userId;

				

		$query = $this->db->query($sql);

		$res = $query->result_array(); 

				

		return $res;

	} 

	function chkRefDataExist($myReferrer,$userId,$level,$cycle){

		$myReferrerRow = 0;

		$sql = "SELECT id 

				FROM rave_referralDetail 

				WHERE referrerLevel=".$level." AND refCycle= ".$cycle." AND myReferrer=".$myReferrer." AND userId=".$userId;

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		$res = $query->result_array();

		// exit;

		if($res[0]['id']!=""){

			$myReferrerRow =$res[0]['id'];

		}

		

		return $myReferrerRow; 

	}


	// referal Insert 

	function updateRefData($rowid,$refData=array()){

				 

		$sql ="UPDATE rave_referralDetail SET invtAmt=invtAmt+".$refData['invtAmt']." ,

						refCommDate='".$refData['refCommDate']."' ,

						refCommCount=refCommCount+1

						WHERE id=".$rowid;

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		return $this->db->affected_rows(); 

				

	}

  function moveSelectedUserPosition($currentCycle, $level,$noPositionChangeUser=array()){

		if(sizeof($noPositionChangeUser)>0){

			$myCapUserString = implode(', ',$noPositionChangeUser);

			$sql ="UPDATE rave_share SET userPosition=userPosition+1 

						WHERE `level`=".$level." AND `status`=1 AND userPosition<1089 AND user_id NOT IN (".$myCapUserString." )";

		}

		else{

			$sql ="UPDATE rave_share SET userPosition=userPosition+1 WHERE `userCycle`=".$currentCycle." AND `level`=".$level." AND `status`='1' AND userPosition<1089";

		}

		

		$this->db->query($sql);

		return $this->db->affected_rows();

	}


	// fetch user elegible to move up to next level

	function getMoveUpUser($currPosition,$level,$cycle){

		$sql= "SELECT RS.user_id,RS.level,RS.userCycle,RS.userPosition,URT.raveType 

					FROM rave_share RS  

					LEFT JOIN user_raveshare_type URT  

					ON RS.user_id=URT.user_id 

					WHERE RS.userPosition=".$currPosition." 

					AND RS.level=".$level." 
					AND RS.userCycle=".$cycle." 

					AND RS.status=1

					ORDER BY RS.userPosition desc ";

		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}

		//level 1 amount & status Change  process 

	function userLevelStatusCh($userId,$level,$cycle){

		$sql ="UPDATE rave_share SET `status`=0

						WHERE `level`=".$level." AND userCycle=".$cycle." AND user_id=".$userId;

		$query = $this->db->query($sql);

		return $this->db->affected_rows(); 

	}

    // get current balance

	function getBalance($userId,$level,$cycle){

		$myBalance = 0;

		$sql = "SELECT amount 

				FROM rave_share 

				WHERE `level`=".$level." AND userCycle=".$cycle." AND `status`=0 AND user_id=".$userId;

		$query = $this->db->query($sql);

		$res = $query->result_array();

		if($res[0]['amount']!=""){

			$myBalance =$res[0]['amount'];

		}

		

		return $myBalance; 

	}

	function getUserFromRaveShare($level,$newUser,$cycle){

		/*$sql ="SELECT user_id

				FROM rave_share 

				WHERE status=1 AND `level`=".$level." AND userCycle=".$cycle." AND user_id!=".$newUser;

				*/

		$sql ="SELECT user_id

				FROM rave_share 

				WHERE `level`=".$level." AND userCycle=".$cycle." AND `status`='1' AND user_id!=".$newUser;

		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}


	 //  next cycle  start --- 14/10/2016
	
	//select user elegible to move to next cycle & fetch currentCycle
	
	public function getAllNextCycleUser($userPosition){
		
		$sql = "SELECT RNC.uID,RNC.firstName,RNC.lastName,RNC.userName,RNC.emailID,RNC.password,RNC.phone,RNC.afrooPaymentStatus,RNC.skypeID,RNC.userType,RNC.forWebsite,RS.userCycle,RS.userPosition,RS.id as raveShareId,URT.raveType 
					FROM rave_userinfo RNC 
					LEFT JOIN rave_share RS 
					ON RNC.uID=RS.user_id
					LEFT JOIN user_raveshare_type URT
					ON RNC.uID=URT.user_id
					WHERE RS.status=1 AND RNC.status = '1'
					AND RS.userPosition=".$userPosition."
					ORDER BY RNC.uID ASC";
					
		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}


  public function changeUserStatus($userId){
		
		$sql = "UPDATE rave_userinfo SET `status`='0'  WHERE uID=".$userId;
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $this->db->affected_rows(); 
	}

	public function changeRaveShareStatus($raveShareId){
		
		$sql = "UPDATE rave_share SET `status`='0'  WHERE id=".$raveShareId;
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $this->db->affected_rows(); 
	}
	
	public function storeCycleIds($presentCyId,$prevCyId,$prevCycle){
		if( $presentCyId !=""){

			$this->db->set('presentId',$presentCyId);

			$this->db->set('prevId',$prevCyId);

			$this->db->set('prevCycle',$prevCycle);
			//$this->db->set('newcycleStartDate',  date("Y-m-d H:i:s"));

			$this->db->insert('rave_cycle');

			$id = $this->db->insert_id();
            //echo $this->db->last_query();
			return $id;

		}
	}
	function getUserInfoRave($UID){

            if( $UID != "" ){

                $this->db->select('rave_userinfo.*,URT.raveType');

                $this->db->from('rave_userinfo');

                $this->db->join("user_raveshare_type URT","URT.user_id=rave_userinfo.uID","LEFT");

                $this->db->where('rave_userinfo.uID',$UID);

                $query = $this->db->get();

                return $query->result_array();

            }

	}

	 public function getEmailDetailsByEmail($emailID){

	 $sql = "SELECT *
FROM `rave_share` , rave_userinfo
WHERE `rave_share`.user_id = rave_userinfo.uID
AND `rave_userinfo`.`emailID` ='".$emailID."' AND `rave_share`.status = '1'";

		$query = $this->db->query($sql);

		return $query->result_array();

   }

   // my transaction detail 

	function myAccountDetail($userId,$level){

		$sql ="SELECT * FROM rave_share WHERE `level`=".$level." AND `status`=1 AND user_id=".$userId;

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		return $query->result_array(); 		

	}


	 public function getUserLists($current_user_array,$userId){
        
		$where ="";

		if($userId!=""){

			$where =" WHERE presentId='".$userId."'";

		}
		$sql= "SELECT presentId,prevId,prevCycle FROM rave_cycle					

						".$where;

		$query = $this->db->query($sql);

		$res = $query->result_array();
      
		if(count($res)>0){
         
         $current_user_array[]= array('userId'=> $res[0]['prevId'],'myCycle' => $res[0]['prevCycle']);
         $current_user_array = $this->getSubUserLists($current_user_array,$res[0]['prevId']);
		}
		 /* echo "<pre>";
		print_r($current_user_array);
        echo "</pre>";*/
		return $current_user_array;

	}

	function getReferralDetail($userId,$level,$cycle){

		/* $sql= "SELECT rave_referralDetail.invtAmt,rave_referralDetail.refCommCount,rave_userinfo.emailID,rave_userinfo.userLevel 

						FROM rave_referralDetail

						LEFT JOIN rave_userinfo

						ON rave_referralDetail.userId=rave_userinfo.uID

						WHERE rave_referralDetail.myReferrer=".$userId." 

						AND rave_referralDetail.referrerLevel=".$level."

						AND rave_referralDetail.refCycle=".$cycle; */

			$sql= "SELECT SUM(rave_referralDetail.invtAmt) invtAmt,SUM(rave_referralDetail.refCommCount) refCommCount,rave_referralDetail.userId, rave_userinfo.emailID,rave_userinfo.userLevel 

						FROM rave_referralDetail

						LEFT JOIN rave_userinfo

						ON rave_referralDetail.userId=rave_userinfo.uID

						WHERE rave_referralDetail.myReferrer=".$userId." 

						AND rave_referralDetail.refCycle=".$cycle."

						GROUP BY rave_referralDetail.userId";
					/*$sql = "SELECT 
					  `VMD`.*,
					  `RU`.`uID`,
					  `RU`.`referarID`,
					  `RU`.`firstName`,
					  `RU`.`lastName`,
					  `RU`.`emailID`,
					  `RU`.`userLevel`,
					  `RU`.`phone`,
					  `RU`.`afrooPaymentStatus`,
					  `RU`.`userType`
					FROM (`vip_mass_details` VMD)
					  RIGHT JOIN `rave_userinfo` RU
						ON `VMD`.`to_user_id`=`RU`.`uID`		 
					WHERE `RU`.`uID` != ''
						AND `RU`.`forWebsite` = ".$this->forWebsite."
						AND `RU`.`referarID` =".$userId."
					ORDER BY `VMD`.`id` DESC";*/

		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}

	// get my referrals count

	function getMyReferrals($userId){

		$myreferralTotal =0;

		$sql ="SELECT count(uID)  myreferralTotal

						FROM rave_userinfo

						WHERE rave_userinfo.referarID=".$userId;

						

		$query = $this->db->query($sql);

		$res = $query->result_array();

		if($res[0]['myreferralTotal']!=""){

			$myreferralTotal =$res[0]['myreferralTotal'];

		}

		return $myreferralTotal;

	}
  function referralSum($userId,$level,$cycle){

		$refTotal =0;

		/* $sql ="SELECT SUM(invtAmt)  refTotal

						FROM rave_referralDetail

						WHERE rave_referralDetail.myReferrer=".$userId." 

						AND rave_referralDetail.refCycle=".$cycle."

						AND rave_referralDetail.referrerLevel=".$level; */

		

		// show one cycle total referralSum edited by SB on 21/09/2016

		$sql ="SELECT SUM(invtAmt)  refTotal

						FROM rave_referralDetail

						WHERE rave_referralDetail.myReferrer=".$userId." 

						AND rave_referralDetail.refCycle=".$cycle;

		$query = $this->db->query($sql);

		$res = $query->result_array();

		if($res[0]['refTotal']!=""){

			$refTotal =$res[0]['refTotal'];

		}

		return $refTotal;

	}
    function myAccountDetailByCycle($userId,$level,$myCycle){

		$sql ="SELECT * FROM rave_share WHERE `level`=".$level." AND `status`=1 AND userCycle='".$myCycle."' AND user_id=".$userId;

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		return $query->result_array(); 		

	}

	 function getLatestUserId($userId){

		$myRavePosition=0;

		$sql ="SELECT presentId FROM `rave_cycle`  WHERE prevId=".$userId;

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		$res = $query->result_array();
		$presentId = $userId;
		if(!empty($res)){
		$presentId = $res[0]['presentId'];	
		$presentId = $this->getLatestUserId($presentId);	
		}
		

		return $presentId; 		
        }
		
      // rave share related function end //

	function getUserLevelPosition($userId){

		$myRavePosition=0;

		$sql ="SELECT rave_share.level, rave_share.userPosition, rave_share.userCycle, rave_share.counter, user_raveshare_type.raveType FROM rave_share,user_raveshare_type WHERE rave_share.user_id=user_raveshare_type.user_id AND rave_share.`user_id`=".$userId." AND rave_share.status='1'";

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		$res = $query->result_array();

		return $res; 		
        }

        public function getRaveAllUser($condition){

		$whereCon ="";

		$totalUserCount =0;

		if($condition==0){

			$whereCon = " WHERE afrooPaymentStatus='0' AND `status` = '1' ";

		}

		else if($condition==1){

			$whereCon = " WHERE afrooPaymentStatus='1' AND `status` = '1' ";

		}

		else{

			$whereCon ="WHERE `status` = '1' ";

		}

		

		$sql= "SELECT count(*) totalUser 

						FROM rave_userinfo						

						 ".$whereCon."

						";

		$query = $this->db->query($sql);

		//echo "<br>++++".$this->db->last_query();//exit;

		$res = $query->result_array();

		if($res[0]['totalUser']!=""){

			$totalUserCount =$res[0]['totalUser'];

		}

		return $totalUserCount;

		

	}

	public function getRaveAllUserDetail($uId){

		$where =" WHERE afrooPaymentStatus='1' AND `status` IN ('1', '2') ";

		if($uId!=""){

			$where =" AND rave_userinfo.uID=".$uId;

		}
		$sql= "SELECT uID,referarID,firstName,lastName,userName,emailID,password,phone, afrooPaymentStatus

						FROM rave_userinfo					

						".$where."

						 order by uID DESC";
			/*$where =" AND rave_share.status =1
			AND `rave_share`.`level` =2
			AND `rave_share`.`userCycle` =1 ";
			$sql= "SELECT *
			FROM `rave_share` , rave_userinfo
			WHERE rave_share.user_id = rave_userinfo.uID			

			".$where."

			order by rave_userinfo.uID DESC";*/
						 

		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}
    function getUserInfoByEmailId($emailID){

		if( $emailID !=""){

			$this->db->select('rave_userinfo.*');
			$this->db->from('rave_userinfo');
			$this->db->where('rave_userinfo.emailID',$emailID);
			$this->db->where('rave_userinfo.status','1');// added by SB on 29/09/2016 for cycle system
			$query = $this->db->get();

			echo $this->db->last_query();

			if( $query->num_rows()== 1 )

			{

				$temp = $query->result_array(); 

				return $temp[0]['uID']; 

			}else

			{

				return 0;

			}

		}

	}

	################ Get userposition by email id 14-12-2016 #######3
	function getUserLevelPositionByEmailId($emailID){

		$myRavePosition=0;

		$sql ="SELECT rave_share.level, rave_share.userPosition, rave_share.userCycle, rave_share.counter, user_raveshare_type.raveType FROM rave_share,user_raveshare_type,rave_userinfo 
		WHERE 
		rave_share.user_id=user_raveshare_type.user_id AND
		rave_share.user_id=rave_userinfo.uID AND
		 rave_userinfo.`emailID`='".$emailID."' AND rave_share.status='1'";

		$query = $this->db->query($sql);

		//echo $this->db->last_query();

		$res = $query->result_array();

		return $res; 		
        }
	################ Ruma 11-01-2017 #######3	
		
		
		public function getUserDetailsArray($emailId){

		$where =" WHERE afrooPaymentStatus=1 ";

		if($emailId!=""){

			$where .=" AND emailID='".$emailId."'";

		}
		$where .=" ORDER BY uID ASC LIMIT 0,1";
		$sql= "SELECT uID,referarID,userType,firstName,lastName,userName,emailID,password,afrooPaymentStatus

						FROM rave_userinfo					

						".$where;

		$query = $this->db->query($sql);
       // echo "<br>".$this->db->last_query();
		$res = $query->result_array();

		return $res;
        }
		
		
		
		
		
		
		public function getPaymentStatusOfUser($emailID){

	    $admin_db= $this->load->database('ADMINDB', TRUE);
		$admin_db->select('rave_userinfo.*,city.city cityName,city.id city_id,country.country_id,country.name countryName');
		$admin_db->from('rave_userinfo');
		$admin_db->join("user_raveshare_type","user_raveshare_type.user_id=rave_userinfo.uID","LEFT");
		$admin_db->join("city","city.id=rave_userinfo.city AND city.is_active=1","LEFT");
		$admin_db->join("country","country.country_id=rave_userinfo.country AND country.status=1","LEFT");				
		$admin_db->where('rave_userinfo.emailID',$emailID);
		$query = $admin_db->get();
		//echo $admin_db->last_query();
		/*SELECT `rave_userinfo`.*, `city`.`city` cityName, `city`.`id` city_id, `country`.`country_id`, `country`.`name` countryName FROM (`rave_userinfo`) LEFT JOIN `user_raveshare_type` ON `user_raveshare_type`.`user_id`=`rave_userinfo`.`uID` LEFT JOIN `city` ON `city`.`id`=`rave_userinfo`.`city` AND city.is_active=1 LEFT JOIN `country` ON `country`.`country_id`=`rave_userinfo`.`country` AND country.status=1 WHERE `rave_userinfo`.`emailID` = 'rdsinfo@earthlink.net' */

		$userDetail = $query->result_array();
		return $userDetail;

	}
		
	function getImmediateSponsorDetails($sponsorArray, $referarID){

		if( $referarID!= "" ){

			$this->db->select('rave_userinfo.*');

			$this->db->from('rave_userinfo');

			$this->db->where('rave_userinfo.UID',$referarID);

			$query=$this->db->get();
            //$this->db->last_query();
           
			$arr    = $query->result_array();

		   

		    if(!empty($arr)){
		    	$arr[0]['userPaymentStatus'] = $this->getPaymentStatusOfUser($arr[0]["emailID"]);
				array_push($sponsorArray,$arr[0]);
				$referarID = $arr[0]['referarID'];
				$sponsorArray = $this->getImmediateSponsorDetails($sponsorArray, $referarID); 

		    }
            /*echo "<pre>";
            print_r($sponsorArray);
            echo "</pre>";*/
			return $sponsorArray;

		}

	}	
	public function getEmailIdByPosition($userPosition){

	 $sql = "SELECT *
FROM `rave_share` , rave_userinfo
WHERE `rave_share`.user_id = rave_userinfo.uID
AND `rave_share`.`userPosition` =".$userPosition." AND `rave_share`.status = '1'";
               
		$query = $this->db->query($sql);
            
		return $query->result_array();

   }	

	public function getAllReferralUserList($emailId){

		$where =" WHERE afrooPaymentStatus=1 AND status IN('1','2') ";

		if($emailId!=""){

			$where .=" AND emailID='".$emailId."'";

		}
		$sql= "SELECT uID,referarID,firstName,lastName,userName,emailID,password,afrooPaymentStatus

						FROM rave_userinfo					

						".$where;

		$query = $this->db->query($sql);

		$res = $query->result_array();

		return $res;

	}

      
}
?>