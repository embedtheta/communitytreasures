<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Myaccount extends CI_Controller {
    private $_admin_email ;
    private $paypal_active = 2; //1=live;2=sandbox
	private $_from_email;//22/12/2015 new aded us
    private $_from_name;
	private $_to_email;
	private $_subject;
    private $_message;
	//private $this->forWebsite = 2;
    private $paypal_action = '';
    private $paypal_email = '';
    function __construct() {
        parent::__construct();
        $this->load->model('gatewaymodel');
        $this->load->model('message_model');         
		$this->load->model('common_model');       
		$this->_from_email = "blessings.jain@globalblackenterprises.com";//22/12/2015 new added us
        $this->_from_name = "globalblackenterprises.com";
        $this->_admin_email = "ujjwal.sana92@gmail.com";//"blessings.jain@globalblackenterprises.com";
		$this->forWebsite = 2;
        }
    public function index() { 
        $userId = $this->session->userdata('userId');
    
        if (!trim($this->session->userdata('userId'))) {
            redirect(base_url() . 'gateway/', 'refresh');	
	        }
	        else{
		        $userId = $this->session->userdata('userId');
			    $mainuserinfoArray = $this->gatewaymodel->getUserInfo($userId);
			  
			    $emailID = $mainuserinfoArray[0]['emailID'];
			    $userinfoArray = $this->gatewaymodel->getEmailDetailsByEmail($emailID);
			   	/*echo "<pre>";
    	print_r($mainuserinfoArray);
    	print_r($userinfoArray);
    	
    	echo "</pre>";
    	exit;*/
			    if(!$userinfoArray[0]['afrooPaymentStatus']){
			    redirect(base_url() . 'gateway/', 'refresh');	
			    } 		
	        }//end else
        
		$viewData = array();
		
		if($userinfoArray[0]['confirmStatus']==1){
         
          $viewData["userInfo"] = $userinfoArray;
          $viewData["msginfo"] = "Please contact with site Admin.Account activation is still Pending.";
          $this->load->view('raveshare/pendingActivation', $viewData);
		
		}
		else{

		
		$viewData["userInfo"] = $userinfoArray;
		
		$viewData['currSymbol'] ='$';
		$myLevel = $viewData["userInfo"][0]['userLevel'];
		/////$this->session->set_userdata('raveType', $viewData["userInfo"][0]['raveType']);
		$userId = $userinfoArray[0]['uID'];
		$allAccountDetail = $this->gatewaymodel->myAccountDetail($userId,$myLevel);
		
		//$viewData['myCurrPosition'] = $allAccountDetail[0]['userPosition'];//$this->gatewaymodel->myCurrPosition($userId,$myLevel);
        

		$myCycle  = $allAccountDetail[0]['userCycle'];
		$current_user_cycle = $myCycle; 
		$viewData['current_user_cycle'] = $current_user_cycle;	
			
		/*$msgTypeDetails = $this->setMessage();  
        $viewData["msg"] = $msgTypeDetails["msg"];
        $viewData["type"] = $msgTypeDetails["type"];
		*/
		 
		$current_user_array = array(array('userId'=>$userId,'myCycle'=>$myCycle));
		
		$MyOldUserIdLists = $this->gatewaymodel->getUserLists($current_user_array,$userId);
		
		$cycle = array();
		foreach ($MyOldUserIdLists as $key => $row)
		{
		    $cycle[$key] = $row['myCycle'];
		}
		array_multisort($cycle, SORT_ASC, $MyOldUserIdLists);
		$viewData['MyOldUserIdLists'] = $MyOldUserIdLists;

		foreach($MyOldUserIdLists as $key=>$val){
			$userId = $val['userId'];
			$myCycle = $val['myCycle'];
		$getReferralDetail = $this->gatewaymodel->getReferralDetail($userId,$myLevel,$myCycle);

			    
		$MyReferralsVal = $this->gatewaymodel->getMyReferrals($userId);
		$myReferalTotalVal = $this->gatewaymodel->referralSum($userId,$myLevel,$myCycle);
		############# Shift the code by subhendu 26-10-2016 ###########
		     $userinfoArrayList = $this->gatewaymodel->getUserInfoRave($userId);
		     $myLevel = $userinfoArrayList[0]['userLevel'];
             $getActiveCommissionArray = $this->getActiveCommission($myLevel);
             $perCommAmtVal = $getActiveCommissionArray['activeCom'];// Active User commission Amount for other Cycle
		     $founderComVal	= $getActiveCommissionArray['founderCom'];
		     $allAccountDetail = $this->gatewaymodel->myAccountDetailByCycle($userId,$myLevel,$myCycle);
		     $myCurrPositionVal = $allAccountDetail[0]['userPosition'];//$this->gatewaymodel->

             $referal_detailsArray = $this->getReferralDetails($allAccountDetail,$MyReferralsVal,$myReferalTotalVal,$userinfoArrayList,$perCommAmtVal,$founderComVal,$myCurrPositionVal);
                
             $viewData['rs'][$myCycle]= $referal_detailsArray;

                       
		############# end of code By Subhendu #####################################
		foreach($getReferralDetail as $key=>$val){
		  $userId = $val["userId"];
		  $latestUserId = $this->gatewaymodel->getLatestUserId($userId);
          //$getReferralDetail[$key]['referralAmountArray']=$this->gatewaymodel->referralAmountArray($userId);
          $userPositionDetails = $this->gatewaymodel->getUserLevelPosition($latestUserId);
          $getReferralDetail[$key]['userPositionDetails']=$userPositionDetails;
          $getReferralDetail[$key]['latestUserId']=$latestUserId;
		}	
		 
		$viewData['myReferalCommDetail'][$myCycle] = $getReferralDetail;
	
		//$viewData['myReferalCommDetail'][$myCycle] = $this->message_model->getMyRefUsers($userId);
		}
		//print_r($viewData["myReferalTotal"]); exit;
		$viewData['raveActiveUser'] = $this->gatewaymodel->getRaveAllUser(1);// active member count
		 /* echo "<pre>";
			    print_r($viewData); exit;*/
		$this->load->view('raveshare/mywallet', $viewData);

		}
	}
	public function getReferralDetails($allAccountDetail,$MyReferrals,$myReferalTotal,$userInfo,$perCommAmt,$founderCom,$myCurrPosition){
		       /* echo "<pre>";
		        echo "<br>All Account Detail:";
				print_r($allAccountDetail);
				echo "<br>MyReferrals:";
				print_r($MyReferrals);
				echo "<br>myReferalTotal:";
				print_r($myReferalTotal);
				echo "<br>userInfo:";
				print_r($userInfo);
				echo "<br>perCommAmt:";
				print_r($perCommAmt);
				echo "<br>founderCom:";
				print_r($founderCom);
				echo "</pre>";*/
                        $uID=$userInfo[0]['uID'];
                        $userLevel=$userInfo[0]['userLevel'];
                        $raveType=$userInfo[0]['raveType'];
                        $myCurrPosition=$myCurrPosition;
                        $counter = (isset($allAccountDetail[0]['counter']))?$allAccountDetail[0]['counter']:0;
						$day=0;
						$member=0;
						$founderBonus=0;
						$nextLevelEntry=0;
						$activeTotal=0;
						$founderTotal=0;
						$CycleComm=0;
						$leftAmt=0;
						$totalAmt=0;
						$opportunityBalance=0;
						$karmaBalance=0;
						$seedBalance=0;
						$otherComm=0;
						$entLNextBalance=0;
						$sumSpendableAmt=0;
						$thisLevelTotal=0;
						$PreviousLevelBal=0;
						$myReferalTotal=$myReferalTotal;
						$MyReferrals=$MyReferrals;
						$perCommAmt=$perCommAmt;
						$founderCom=$founderCom;

					
		            if($counter!=0) { 

					//echo"++++++++++++++++".$userInfo[0]['raveType'];

							if($counter>1){

								$day='Days';
							}
							else{

								$day='Day';

							}

							if($MyReferrals>1){

								$member = 'Members';

							}

							else{

								$member = 'Member';

							}

						$otherComm ='';

						//$spendableAmt =0;// blocked by SB on 05/07/2016
						
						$totalAmt =0; // added by SB on 05/07/2016

						$nextLevelEntry=0;

						if($userInfo[0]['userLevel']==1){

							$founderBonus = 30; // total bonus
							$nextLevelEntry=60;// level2 entry fee 

							// founder comm + referral comm  is spendable amount

							$activeTotal =$perCommAmt*$counter;//-4 for 16 cycle added by SB
							$founderTotal = $founderCom*$counter;
							$CycleComm = $perCommAmt*$counter;
							$leftAmt = $allAccountDetail[0]['amount']-$CycleComm;
							//$spendableAmt =$leftAmt;// blocked by SB on 05/07/2016
							// active total +founder total + total referal comm
							$totalAmt = $activeTotal+$founderTotal+$myReferalTotal;// added by SB on 05/07/2016 // blocked BY SB on 27/09/2016

						}			

						else if($userInfo[0]['userLevel']==2){

							

							$founderBonus = 100; // total bonus
							$nextLevelEntry=300;// level3 entry fee 
							// active + founder+ referal is spendable amount

							$activeTotal = $perCommAmt*$counter;
							$founderTotal = $founderCom*$counter;
							
							$middleBonusName = 'seed';
							
							$opportunity = 4.13; // 4.18;//2.34;
							$opportunityBalance = $opportunity*$counter;

							$seed = 3.13;//1.56;
							$seedBalance = $seed*$counter;

							$karma = 6.25;//1.59;
							$karmaBalance = $karma*$counter;

							$entranceLNext= 18.75;//9.38;
							$entLNextBalance = $entranceLNext*$counter;

				
							//$otherComm =$opportunityBalance+$seedBalance+$karmaBalance+$entLNextBalance;// blocked by SB on 29-08-2016
							$otherComm =$opportunityBalance+$seedBalance+$karmaBalance;// added by SB on 29-08-2016	
							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;

							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;
							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016
							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016
							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016
							if($userInfo[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30;
							}
							
							$totalAmt = $level1FounderCom+$sumSpendableAmt; //   added by SB on 27/09/2016

                            $founderTotal = 30+$founderTotal; //(8*3.55) 
						}

						else if($userInfo[0]['userLevel']==3){

							$CycleComm=0;
						    $leftAmt=0;
							$founderBonus = 200; // total bonus
							$nextLevelEntry = 800;// level4 entry fee 
							// active + founder+ referal is spendable amount
							$activeTotal = $perCommAmt*$counter;
							$founderTotal = $founderCom*$counter;
							
							$middleBonusName = 'seed';
							
							$opportunity = 21;//9.38;
							$opportunityBalance = $opportunity*$counter;
							
							$seed = 21;//3.13;
							$seedBalance = $seed*$counter;
							
							$karma = 9;//9.24;//9.38;
							$karmaBalance = $karma*$counter;
							
							$entranceLNext= 50;//25;
							$entLNextBalance = $entranceLNext*$counter;							

							//$otherComm =$opportunityBalance+$seedBalance+$karmaBalance+$entLNextBalance;	// blocked by SB on 30-08-2016							
							$otherComm =$opportunityBalance+$seedBalance+$karmaBalance;// added by SB on 30-08-2016	
							
							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;

							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal; // blocked by SB on 05/07/2016
							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016
							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016
							if($userInfo[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100;
							}
							$level2ActiveCom = 9.38*16;
							$totalAmt = $level1FounderCom+$level2ActiveCom+$sumSpendableAmt; // My total income only show active total commission added by SB on 27/09/
                            $founderTotal = 30+100+$founderTotal; //(8*3.55)+(16*6.25) 
							

						}

						else if($userInfo[0]['userLevel']==4){

							$founderBonus = 300; // total bonus
							$nextLevelEntry=1700;//1000;// level5 entry fee 
							// active + founder+ referal is spendable amount
							 
							$activeTotal = $perCommAmt*$counter;
							$founderTotal = $founderCom*$counter;
							
							$middleBonusName = 'Seed';
							$opportunity = 75;//37.50;
							$opportunityBalance = $opportunity*$counter;

							$seed = 31.84;//15.63; // Co -operative
							$seedBalance = $seed*$counter;

							$karma = 125;//62.50;
							$karmaBalance = $karma*$counter;

							$entranceLNext= 106.25;//53.13;
							$entLNextBalance = $entranceLNext*$counter;

							//$otherComm =$opportunityBalance+$seedBalance+$karmaBalance+$entLNextBalance; // blocked by SB on 30-08-2016							
							$otherComm =$opportunityBalance+$seedBalance+$karmaBalance;// added by SB on 30-08-2016
							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;

							

							$thisLevelTotal = $sumSpendableAmt+$otherComm;
							$amount = (isset($allAccountDetail[0]['amount']))?$allAccountDetail[0]['amount']:0;
							$PreviousLevelBal=$amount-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016
							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016
							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016
							if($userInfo[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100+200;
							}
							$level2ActiveCom = 9.38*16;
							$level3ActiveCom = 18.75*16;
							$totalAmt = $level1FounderCom+$level2ActiveCom+$level3ActiveCom+$sumSpendableAmt; // My total income only show active total commission added by SB on 27/09/2016

							$founderTotal = 30+100+200+$founderTotal; //(8*3.55)+(16*6.25)+(12.5*16) 
						}

						else if($userInfo[0]['userLevel']==5){


							$nextLevelEntry = 0;
							$CycleComm=0;
						    $leftAmt=0;
						    $entLNextBalance=0;
						    $founderBonus = 500; // total bonus
							// active + founder+ referal is spendable amount

							$activeTotal = $perCommAmt*$counter;
							$founderTotal = $founderCom*$counter;
							 
							//$middleBonusName = 'Co-Op';

							$opportunity =  281.25;//281.24;//37.50;
							$opportunityBalance = $opportunity*$counter;

							$karma = 31.25;//31.24;//15.63;
							$karmaBalance = $karma*$counter;

							$seed=125;//53.13;
							$seedBalance = $seed*$counter;

	
							$otherComm =$opportunityBalance+$karmaBalance+$seedBalance;							
							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;

						
							$thisLevelTotal = $sumSpendableAmt+$otherComm;

							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;

							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016
							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016
							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016

							if($userInfo[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100+200+300;
							}
	
							$level2ActiveCom = 9.38*16;
							$level3ActiveCom = 18.75*16;
							$level4ActiveCom = 37.50*16;
							$totalAmt = $level1FounderCom+$level2ActiveCom+$level3ActiveCom+$level4ActiveCom+$sumSpendableAmt; // My total income only show active total commission added by SB on 27/09/

                            $founderTotal = 30+100+200+300+$founderTotal; //(8*3.55)+(16*6.25)+(12.5*16)+(18.75*16)
							

						}

				}

				else{

					if($userInfo[0]['userLevel']==2 || $userInfo[0]['userLevel']==3)

					{

						$middleBonusName = 'Seed';

					}

					else if($userInfo[0]['userLevel']==4){

						$middleBonusName = 'Seed';

					}

					//$spendableAmt = $allAccountDetail[0]['amount'];// blocked by SB on 05/07/2016
					//$totalAmt = $allAccountDetail[0]['amount'];// added by SB on 05/07/2016
					if($userInfo[0]['userLevel']==1 ){
						
						$totalAmt = 0;

						
					}
					else if($userInfo[0]['userLevel']==2){
						if($userInfo[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30;
							}
						
						$totalAmt = $level1FounderCom+$myReferalTotal;
					}
					else if($userInfo[0]['userLevel']==3){
						if($userInfo[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100;
							}
						$level2ActiveCom = 9.38*16;
						$totalAmt = $level2ActiveCom+$level1FounderCom+$myReferalTotal;
					}
					else if($userInfo[0]['userLevel']==4){
						if($userInfo[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100+200;
							}
						$level2ActiveCom = 9.38*16;
						$level3ActiveCom = 18.75*16;
						$totalAmt = $level2ActiveCom+$level3ActiveCom+$level1FounderCom+$myReferalTotal;
					}
					else if($userInfo[0]['userLevel']==5){
						if($userInfo[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100+200+300;
							}
						$level2ActiveCom = 9.38*16;
						$level3ActiveCom = 18.75*16;
						$level4ActiveCom = 37.50*16;
						$totalAmt = $level2ActiveCom+$level3ActiveCom+$level4ActiveCom+$level1FounderCom+$myReferalTotal;
					}

				}	
						
                 $outputArray = array(
                 	
                 	                "uID"=>$uID,
                 	                "raveType"=>$raveType,
                 	                "userLevel"=>$userLevel,
                 	                "myCurrPosition"=>$myCurrPosition,
                 	                "counter"=>$counter,
									"day"=>$day,
									"member"=>$member,
									"founderBonus"=>$founderBonus,
									"nextLevelEntry"=>$nextLevelEntry,
									"activeTotal"=>$activeTotal,
									"founderTotal"=>$founderTotal,
									"CycleComm"=>$CycleComm,
									"leftAmt"=>$leftAmt,
									"totalAmt"=>$totalAmt,

									"opportunityBalance"=>$opportunityBalance,
									"karmaBalance"=>$karmaBalance,
									"seedBalance"=>$seedBalance,
									"otherComm"=>$otherComm,
									"entLNextBalance"=>$entLNextBalance,
									"sumSpendableAmt"=>$sumSpendableAmt,
									"thisLevelTotal"=>$thisLevelTotal,
									"PreviousLevelBal"=>$PreviousLevelBal,
									"myReferalTotal"=>$myReferalTotal,
									"MyReferrals"=>$MyReferrals,
									"perCommAmt"=>$perCommAmt,
									"founderCom"=>$founderCom
									
									
							     );	
 /*echo "<pre>";
                          print_r($outputArray);
                          echo "</pre>";*/
                 return $outputArray;
			}
	public function getActiveCommission($myLevel){
    if($this->session->userdata('raveType')=="Active"){
			if($myLevel==1){
				$activeCom=7.50;
				$founderCom=0;
				
			}
			else if($myLevel==2){
				$activeCom=9.38;
				$founderCom=0;
				
			}
			else if($myLevel==3){
				$activeCom=18.75;//18.74;
				$founderCom=0;
				
			}
			else if($myLevel==4){
				$activeCom=37.5;
				$founderCom=0;
				
			}
			else if($myLevel==5){
				$activeCom=75;
				$founderCom=0;
				
			}
		}else{
			if($myLevel==1){
				$activeCom=7.50;
				$founderCom=3.75;
				
			}
			else if($myLevel==2){
				$activeCom=9.38;
				$founderCom=6.25;
				
			}
			else if($myLevel==3){
				$activeCom=18.75;//18.74;
				$founderCom=12.5;
				
			}
			else if($myLevel==4){
				$activeCom=37.5;
				$founderCom=18.75;//18.74;
				
			}
			else if($myLevel==5){
				$activeCom = 75;
				$founderCom =31.25;//31.24;
				
			}			
		}

		return $activeCommissionArray = array('activeCom' => $activeCom, 'founderCom' => $founderCom);
     }
	public function setMessage(){
		
        $retData = array();
        $type = $this->session->flashdata('type');
        $status = $this->session->flashdata('status');
        $msg = $this->session->flashdata('msg');
		
		if($status == "email_missing")
		{
			 $retData["msg"] = "Please insert email id.";
			 $retData["type"] = $type;
		}
		if($status == "message_missing")
		{
			 $retData["msg"] = "Please Fill Up Message Box.";
			 $retData["type"] = $type;
		}
        if($status == "success"){
            if($type == "customer"){
                $retData["msg"] = "You have successfully submitted the message for Customer Services.";
            }elseif($type == "tech_support"){
                $retData["msg"] = "You have successfully submitted the message for Technical Support.";
            }elseif($type == "advertise"){
                $retData["msg"] = "You have successfully submitted the message for Advertisement Services.";
            }elseif($type == "country"){
                $retData["msg"] = "You have successfully updated your country name.";
            }elseif($type == "paypal"){
                $retData["msg"] = "You have successfully updated your paypal id.";
            }elseif($type == "image"){
                $retData["msg"] = "You have successfully updated your Profile picture.";
				
            }elseif($type == "pUpload"){
                $retData["msg"] = "You have successfully uploaded your Product .";
            }elseif($type == "vUpload"){
                $retData["msg"] = "You have successfully added your Vendors Details.";
            }elseif($type == "fListing"){
                $retData["msg"] = "You have successfully added your Free Listing on AFROWEBB.";
            }elseif($type == "deleteUser"){
                $retData["msg"] = "You have been successfully deleted this user.";
            }elseif($type == "inviteGmailFriend"){
                $retData["msg"] = "You have been successfully invited your Gmail's friend.";
            }elseif($type == "inviteYahooFriend"){
                $retData["msg"] = "You have been successfully invited your Yahoo's friend.";
            }elseif($type == "changePassword"){
                if($msg != ""){
                    $retData["msg"] = $msg;
                }else{
                    $retData["msg"] = "You have been successfully changed your Password.";
                }
            }elseif($type == "pUploadUpdate"){
				$retData["msg"] = "You have been successfully updated your product details.";
			}
            $retData["type"] = $type;
        }
		elseif($status == "error")
			{
             if($msg != "")
			 {
                $retData["msg"] = $msg;
           	 }
			else
			{
                $retData["msg"] = "Please try again.";
            }
            $retData["type"] = "wrong";
        }
		
        return $retData;
    }
}
?>