<?php
if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class AllUserList extends CI_Controller {

    function __construct() {

        parent::__construct();

			

		$this->load->model('gatewaymodel');		

		

		$this->forWebsite = 2;

		

    }

	

    public function index() { //echo $this->session->userdata('userId')."++++".$this->session->userdata('userType');

		if (!trim($this->session->userdata('userId')) || ($this->session->userdata('userType')!="ADMIN") ) {

            redirect(base_url() . 'gateway/', 'refresh');	

	        }

		$viewData= array();

		$viewData['totalUser'] = $this->gatewaymodel->getRaveAllUser(2);

		$viewData['totalActiveUser'] = $this->gatewaymodel->getRaveAllUser(1);

		$viewData['totalInactiveUser'] = $this->gatewaymodel->getRaveAllUser(0);

		$viewData['userListDetail'] = $this->gatewaymodel->getRaveAllUserDetail();

        foreach ($viewData['userListDetail'] as $key => $value) {
	        $userId = $value['uID'];
	        $myReferalTotal = $this->gatewaymodel->getUserLevelPosition($userId);
			$viewData['userListDetail'][$key]['myReferalTotal'] = $myReferalTotal;
			$viewData['userListDetail'][$key]['referralSum'] = 0;
			if(!empty($viewData['userListDetail'][$key]['myReferalTotal'])){
				$myLevel = $viewData['userListDetail'][$key]['myReferalTotal'][0]['level'];
				$myCycle = $viewData['userListDetail'][$key]['myReferalTotal'][0]['userCycle'];
				$referralSum = $this->gatewaymodel->referralSum($userId,$myLevel,$myCycle);
			    $viewData['userListDetail'][$key]['referralSum'] = $referralSum;
			    }
			$viewData['userListDetail'][$key]['income_array'] = $this->get_commission_array($myReferalTotal,$referralSum);
		}

		/*echo "<pre>";
		print_r($viewData);
		exit;*/

		$this->load->view('raveshare/userList',$viewData);

		//unset($viewData);

	}
	public function downloadCsvOfAllUsersList() { //echo $this->session->userdata('userId')."++++".$this->session->userdata('userType');
/*echo "<pre>";
print_r($this->session);
echo "</pre>";
exit;*/
/*echo $this->session->userdata('emailId');
exit;
!trim($this->session->userdata('userId')) || */
		if (($this->session->userdata('emailId')!="otizfangel@gmail.com") || ($this->session->userdata('emailId')!="nichole_monteiro@yahoo.co.uk")  ) {

            //redirect(base_url() . 'gateway/', 'refresh');	

	        }

		$viewData= array();

		$viewData['totalUser'] = $this->gatewaymodel->getRaveAllUser(2);

		$viewData['totalActiveUser'] = $this->gatewaymodel->getRaveAllUser(1);

		$viewData['totalInactiveUser'] = $this->gatewaymodel->getRaveAllUser(0);

		$viewData['userListDetail'] = $this->gatewaymodel->getRaveAllUserDetail();

        foreach ($viewData['userListDetail'] as $key => $value) {
	        $userId = $value['uID'];
	        $myReferalTotal = $this->gatewaymodel->getUserLevelPosition($userId);
			$viewData['userListDetail'][$key]['myReferalTotal'] = $myReferalTotal;
			$viewData['userListDetail'][$key]['referralSum'] = 0;
			if(!empty($viewData['userListDetail'][$key]['myReferalTotal'])){
				$myLevel = $viewData['userListDetail'][$key]['myReferalTotal'][0]['level'];
				$myCycle = $viewData['userListDetail'][$key]['myReferalTotal'][0]['userCycle'];
				$referralSum = $this->gatewaymodel->referralSum($userId,$myLevel,$myCycle);
			    $viewData['userListDetail'][$key]['referralSum'] = $referralSum;
			    }
			$viewData['userListDetail'][$key]['income_array'] = $this->get_commission_array($myReferalTotal,$referralSum);
		}

		/*echo "<pre>";
		print_r($viewData);
		exit;*/
$file = fopen("downloadUsersList.csv","w");
$data = array();
foreach ($viewData['userListDetail'] as $key=>$line)
  {

      $referrerDetails = $this->getReferalIdDetails($line['uID']);
  	
  	  $data[$key]['uID'] =$line['uID'];
  	  $data[$key]['firstName'] =$line['firstName'];
  	  $data[$key]['lastName'] =$line['lastName'];
  	  $data[$key]['userName'] =$line['userName'];
  	  $data[$key]['emailID'] =$line['emailID'];
  	  $data[$key]['password'] =$line['password'];
  	  ####################################
  	  $data[$key]['ReferrerFirstName'] =$referrerDetails[0]['firstName'];
  	  $data[$key]['ReferrerLastName'] =$referrerDetails[0]['lastName'];
  	  $data[$key]['ReferrerEmailID'] =$referrerDetails[0]['emailID'];
  	  ###################################
  	  $data[$key]['phone'] =$line['phone'];
  	  $data[$key]['level'] =$line['myReferalTotal'][0]['level'];
  	  $data[$key]['userPosition'] =$line['myReferalTotal'][0]['userPosition'];
  	  $data[$key]['userCycle'] =$line['myReferalTotal'][0]['userCycle'];
  	  $data[$key]['raveType'] =$line['myReferalTotal'][0]['raveType'];
	  $data[$key]['referralSum'] =$line['referralSum'];
  	  $data[$key]['total_income'] =round($line['income_array']['total_income'],2);
  	  $data[$key]['active_commission'] =round($line['income_array']['active_commission'],2);
  	  $data[$key]['inviters_commission'] =round($line['income_array']['inviters_commission'],2);
  	  $data[$key]['founders_commission'] =round($line['income_array']['founders_commission'],2);
  	  $data[$key]['contingent_commission'] =round($line['income_array']['contingent_commission'],2);
  	  $data[$key]['BitcoinPaymentStatus'] = $this->checkPaymentStatusByEmailId($line['emailID']);
   
  }
/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
/*foreach ($data as $row1)
  {
  	echo "<pre>";
		print_r($row1);
		echo "</pre>";
  fputcsv($file,$row1);
  }*/
// output headers so that the file is downloaded rather than displayed
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="ActiveUserLists.csv"');
 
// do not cache the file
header('Pragma: no-cache');
header('Expires: 0');
 
// create a file pointer connected to the output stream
$file = fopen('php://output', 'w');
// save the column headers
fputcsv($file, array("UID", 'First Name', 'Last Name', 'User Name', 'Email ID',
	                 'password', 'Referrer First Name', 'Referrer Last Name', 'Referrer Email Id', 'Contact No', 'level', 'userPosition', 'userCycle', 'raveType',
	                 'referralSum', 'My Income', 'Active Commission', 'Inviters Commission', 'Founders Commission','Contingent Commission','Payment Status'));
 
// Sample data. This can be fetched from mysql too
/*$data = array(
    array('Data 11', 'Data 12', 'Data 13', 'Data 14', 'Data 15'),
    array('Data 21', 'Data 22', 'Data 23', 'Data 24', 'Data 25'),
    array('Data 31', 'Data 32', 'Data 33', 'Data 34', 'Data 35'),
    array('Data 41', 'Data 42', 'Data 43', 'Data 44', 'Data 45'),
    array('Data 51', 'Data 52', 'Data 53', 'Data 54', 'Data 55')
);
 */
// save each row of the data
foreach ($data as $row)
{
    fputcsv($file, $row);
}



fclose($file);
		

		//unset($viewData);

	}

public function getReferalIdDetails($referarID){
        $this->db->select('uID,referarID,firstName,lastName,emailID');
        $this->db->from('rave_userinfo');
        $this->db->where('uID',$referarID);
        $query2 = $this->db->get();
        $result2 = $query2->result_array();
       // echo "<br/><b>checkPaymentStatusByEmailId:</b>".$this->db->last_query()."<br/>";
        if(isset($result2[0]['uID'])){
        	return $result2;
        }
        else{
           return 0;
        }
	    }//end else

        public function checkPaymentStatusByEmailId($EmailID){
       
	    $this->db->select('orderID,userID,emailID,userEmailId');
        $this->db->from('crypto_payments');
        $this->db->where('txConfirmed','1');
        $this->db->where('userEmailId',$EmailID);
        $query2 = $this->db->get();
        $result2 = $query2->result_array();
        
        if(isset($result2[0]['userEmailId']) && strstr($result2[0]['userEmailId'], '@')){
        	return 'Paid';
        }
        else{
           return 'N.A';
        }
	         
        }

      public function inviteesList() { //echo $this->session->userdata('userId')."++++".$this->session->userdata('userType');

		if (!trim($this->session->userdata('userId')) || ($this->session->userdata('userType')!="ADMIN") ) {

            redirect(base_url() . 'gateway/', 'refresh');	

	        }

		$viewData= array();

        $search_data = $this->input->post(); 
		if(!empty($search_data) && strlen($this->input->post('emailID'))>3){
		/*	echo "<pre>";
		print_r($search_data);
		echo "</pre>";*/
        $emailID = $this->input->post('emailID');
		$viewData['totalUser'] = $this->gatewaymodel->getRaveAllUser(2);

		$viewData['totalActiveUser'] = $this->gatewaymodel->getRaveAllUser(1);

		$viewData['totalInactiveUser'] = $this->gatewaymodel->getRaveAllUser(0);

		$viewData['userListDetail'] = $this->gatewaymodel->getAllReferralUserList($emailID);

      
        foreach ($viewData['userListDetail'] as $key => $value) {
	        $userId = $value['uID'];
	        $myReferalTotal = $this->gatewaymodel->getUserLevelPosition($userId);
			$viewData['userListDetail'][$key]['myReferalTotal'] = $myReferalTotal;
			$viewData['userListDetail'][$key]['referralSum'] = 0;
			if(!empty($viewData['userListDetail'][$key]['myReferalTotal'])){
				$myLevel = $viewData['userListDetail'][$key]['myReferalTotal'][0]['level'];
				$myCycle = $viewData['userListDetail'][$key]['myReferalTotal'][0]['userCycle'];
				$referralSum = $this->gatewaymodel->referralSum($userId,$myLevel,$myCycle);
			    $viewData['userListDetail'][$key]['referralSum'] = $referralSum;
			    $viewData['userListDetail'][$key]['myReferalCommDetail'] = $this->gatewaymodel->getReferralDetail($userId,$myLevel,$myCycle);
			    }
			$viewData['userListDetail'][$key]['income_array'] = $this->get_commission_array($myReferalTotal,$referralSum);
		}

       }

		/*echo "<pre>";
		print_r($viewData);
		exit;*/

		$this->load->view('raveshare/inviteesList',$viewData);

		//unset($viewData);

	}


   public function userDetailsByPosition() { //echo $this->session->userdata('userId')."++++".$this->session->userdata('userType');

		if (!trim($this->session->userdata('userId')) || ($this->session->userdata('userType')!="ADMIN") ) {

            redirect(base_url() . 'gateway/', 'refresh');	

	        }

		$viewData= array();

        $search_data = $this->input->post(); 

		if(!empty($search_data) && strlen($this->input->post('userPosition'))>0){
		
        $userPosition = $this->input->post('userPosition');

		if (is_numeric($userPosition)) {
		 $emailIDList  = $this->gatewaymodel->getEmailIdByPosition($userPosition+1);
		} else {
					if (!filter_var($userPosition, FILTER_VALIDATE_EMAIL)) {
					$viewData['userListDetail']=array();
					}
					else{
					$emailIDList  = $this->gatewaymodel->getEmailDetailsByEmail($userPosition);
					}
		}


       
		
       
       
		
		foreach ($emailIDList as $key => $value) {
			$userdetailsArray = $this->gatewaymodel->getAllReferralUserList($value['emailID']);
			$viewData['userListDetail'][$key] = $userdetailsArray[0];
			 $viewData['userListDetail'][$key]['searchKey'] = $userPosition;
	        $userId = $value['uID'];
	        $myReferalTotal = $this->gatewaymodel->getUserLevelPosition($userId);
			/*echo "<pre>";
			print_r($myReferalTotal);
			echo "</pre>";
*/


			$viewData['userListDetail'][$key]['myReferalTotal'] = $myReferalTotal;
			$viewData['userListDetail'][$key]['referralSum'] = 0;
			if(!empty($myReferalTotal)){
				$myLevel = $myReferalTotal[0]['level'];
				$myCycle = $myReferalTotal[0]['userCycle'];
				$referralSum = $this->gatewaymodel->referralSum($userId,$myLevel,$myCycle);
			    $viewData['userListDetail'][$key]['referralSum'] = $referralSum;
			    $viewData['userListDetail'][$key]['myReferalCommDetail'] = $this->gatewaymodel->getReferralDetail($userId,$myLevel,$myCycle);
			    }
			$viewData['userListDetail'][$key]['income_array'] = $this->get_commission_array($myReferalTotal,$referralSum);
	


		}//end foreach
       } // end if

			/*echo "<pre>";
		print_r($viewData);
		exit;
*/

		$this->load->view('raveshare/userDetailsByPosition',$viewData);

		//unset($viewData);

	}

  public function  get_commission_array($allAccountDetail,$myReferalTotal){
	$income = array();
	$income['total_income']=0;
	$income['active_commission']=0;
	$income['inviters_commission']=0;
	$income['founders_commission']=0;
	$income['contingent_commission']=0;
	$income['no_of_days_work'] = 0;
		      
		     /* echo "<pre>";
		print_r($allAccountDetail);
		 echo "</pre>";*/
$myLevel = $allAccountDetail[0]['level'];

if($allAccountDetail[0]['raveType']=="Active"){

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

				$activeCom=75;
				$founderCom=31.25;//31.24;

			}			

		}


$perCommAmt=$activeCom;
if($allAccountDetail[0]['counter']!=0) { 
	

						$otherComm ='';
						//$spendableAmt =0;// blocked by SB on 05/07/2016
						$totalAmt =0; // added by SB on 05/07/2016
						$nextLevelEntry=0;
						if($allAccountDetail[0]['level']==1){
                            $contingent = 2.88;
							$founderBonus = 30; // total bonus
							$nextLevelEntry = 60;// level2 entry fee 
							// founder comm + referral comm  is spendable amount
							$activeTotal =$perCommAmt*$allAccountDetail[0]['counter'];//-4 for 16 cycle added by SB
							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];
							$contingent_commission = $contingent*$allAccountDetail[0]['counter'];
							$CycleComm = $perCommAmt*$allAccountDetail[0]['counter'];
							$leftAmt = $allAccountDetail[0]['amount']-$CycleComm;
							//$spendableAmt =$leftAmt;// blocked by SB on 05/07/2016
							// active total +founder total + total referal comm
							$totalAmt = $activeTotal+$founderTotal+$myReferalTotal;// added by SB on 05/07/2016 // blocked BY SB on 27/09/2016		

							$income['total_income'] =	$totalAmt;	
							$income['active_commission']= $activeTotal;	
							$income['inviters_commission'] = $myReferalTotal;
							$income['founders_commission'] = $founderTotal;
							$income['contingent_commission'] = $contingent_commission;
							$income['no_of_days_work'] = $allAccountDetail[0]['counter'];
						}			
						else if($allAccountDetail[0]['level']==2){
							$founderBonus = 100; // total bonus
							$nextLevelEntry=300;// level3 entry fee 
							// active + founder+ referal is spendable amount
							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];
							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];
							
							$middleBonusName = 'seed';
							$opportunity = 4.13; // 4.18;//2.34;
							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];
							$seed = 3.13;//1.56;
							$seedBalance = $seed*$allAccountDetail[0]['counter'];
							$karma = 6.25;//1.59;
							$karmaBalance = $karma*$allAccountDetail[0]['counter'];
							$entranceLNext= 18.75;//9.38;
							$entLNextBalance = $entranceLNext*$allAccountDetail[0]['counter'];
							//$otherComm =$opportunityBalance+$seedBalance+$karmaBalance+$entLNextBalance;// blocked by SB on 29-08-2016
							$otherComm =$opportunityBalance+$seedBalance+$karmaBalance;// added by SB on 29-08-2016		
							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;				
							$thisLevelTotal = $sumSpendableAmt+$otherComm;
							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;
							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016

							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016

							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016

							if($allAccountDetail[0]['raveType']=="Active"){

								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30;
							}
							$totalAmt = $level1FounderCom+$sumSpendableAmt; //   added by SB on 27/09/2016

							$income['total_income'] =	$totalAmt;	
							$income['active_commission']= $activeTotal;	
							$income['inviters_commission']= $myReferalTotal;
							$income['founders_commission']= $level1FounderCom+$founderTotal;//(8*3.55) 
							$income['contingent_commission'] = (2.88*8);
							$income['no_of_days_work'] = $allAccountDetail[0]['counter'];


						}



						else if($allAccountDetail[0]['level']==3){
							$founderBonus = 200; // total bonus
							$nextLevelEntry=800;// level4 entry fee 
							// active + founder+ referal is spendable amount
							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];
							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];
							
							$middleBonusName = 'seed';		
							$opportunity = 21;//9.38;
							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];
							$seed = 21;//3.13;
							$seedBalance = $seed*$allAccountDetail[0]['counter'];
							$karma = 9;//9.24;//9.38;
							$karmaBalance = $karma*$allAccountDetail[0]['counter'];
							$entranceLNext= 50;//25;
							$entLNextBalance = $entranceLNext*$allAccountDetail[0]['counter'];							
							//$otherComm =$opportunityBalance+$seedBalance+$karmaBalance+$entLNextBalance;	// blocked by SB on 30-08-2016							
							$otherComm =$opportunityBalance+$seedBalance+$karmaBalance;// added by SB on 30-08-2016	
							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;							
							$thisLevelTotal = $sumSpendableAmt+$otherComm;
							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;
							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal; // blocked by SB on 05/07/2016
							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016
							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016

							if($allAccountDetail[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}

							else{
								$level1FounderCom = 30+100; //(8*3.55)+(16*6.25) 
							}

							$level2ActiveCom = 9.38*16;
							$totalAmt = $level1FounderCom+$level2ActiveCom+$sumSpendableAmt; // My total income only show active total commission added by SB on 27/09/


							$income['total_income'] =	$totalAmt;	
							$income['active_commission']= $activeTotal;	
							$income['inviters_commission']=$myReferalTotal;
							$income['founders_commission']=$level1FounderCom + $founderTotal;
							$income['contingent_commission'] = (2.88*8) + 2.88*$allAccountDetail[0]['counter'];
							$income['no_of_days_work'] = $allAccountDetail[0]['counter'];
							
						}
						else if($allAccountDetail[0]['level']==4){
							$founderBonus = 300; // total bonus
							$nextLevelEntry=1700;//1000;// level5 entry fee 
							// active + founder+ referal is spendable amount
							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];
							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];
							//$founderTotal = 30+100+200+$founderTotal; 
							$middleBonusName = 'Seed';
							$opportunity = 75;//37.50;
							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];
							$seed = 31.84;//15.63; // Co -operative
							$seedBalance = $seed*$allAccountDetail[0]['counter'];
							$karma = 125;//62.50;
							$karmaBalance = $karma*$allAccountDetail[0]['counter'];
							$entranceLNext= 106.25;//53.13;
							$entLNextBalance = $entranceLNext*$allAccountDetail[0]['counter'];
							//$otherComm =$opportunityBalance+$seedBalance+$karmaBalance+$entLNextBalance; // blocked by SB on 30-08-2016							
							$otherComm =$opportunityBalance+$seedBalance+$karmaBalance;// added by SB on 30-08-2016
							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;
							$thisLevelTotal = $sumSpendableAmt+$otherComm;
							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;
							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016
							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016

							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016

							if($allAccountDetail[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}
							else{
								$level1FounderCom = 30+100+200;//(8*3.55)+(16*6.25)+(12.5*16) 
							}
							$level2ActiveCom = 9.38*16;
							$level3ActiveCom = 18.75*16;
							$totalAmt = $level1FounderCom+$level2ActiveCom+$level3ActiveCom+$sumSpendableAmt; // My total income only show active total commission added by SB on 27/09/2016

							$income['total_income'] =	$totalAmt;	
							$income['active_commission']= $activeTotal;	
							$income['inviters_commission']=$myReferalTotal;
							$income['founders_commission']=$level1FounderCom+$founderTotal;
							$income['contingent_commission'] = (2.88*8) + (14*16) + (100*$allAccountDetail[0]['counter']);
							$income['no_of_days_work'] = $allAccountDetail[0]['counter'];

						}
						else if($allAccountDetail[0]['level']==5){
							$founderBonus = 500; // total bonus
							// active + founder+ referal is spendable amount
							$activeTotal = $perCommAmt*$allAccountDetail[0]['counter'];
							$founderTotal = $founderCom*$allAccountDetail[0]['counter'];
							//$founderTotal = 30+100+200+300+$founderTotal; //(8*3.55)+(16*6.25)+(12.5*16)+(18.75*16) 
							//$middleBonusName = 'Co-Op';
							$opportunity =  281.25;//281.24;//37.50;
							$opportunityBalance = $opportunity*$allAccountDetail[0]['counter'];
							$karma = 31.25;//31.24;//15.63;
							$karmaBalance = $karma*$allAccountDetail[0]['counter'];
							$seed=125;//53.13;
							$seedBalance = $seed*$allAccountDetail[0]['counter'];
							$otherComm =$opportunityBalance+$karmaBalance+$seedBalance;							
							$sumSpendableAmt =$activeTotal+$founderTotal+$myReferalTotal;
							$thisLevelTotal = $sumSpendableAmt+$otherComm;
							$PreviousLevelBal=$allAccountDetail[0]['amount']-$thisLevelTotal;
							//$spendableAmt =$sumSpendableAmt+$PreviousLevelBal;// blocked by SB on 05/07/2016

							//$totalAmt = $sumSpendableAmt+$otherComm;// added by SB on 05/07/2016 // blocked by SB on 26/09/2016

							//$totalAmt = $sumSpendableAmt+$otherComm+$PreviousLevelBal;// also display previous level balance added by SB on 26/09/2016

							if($allAccountDetail[0]['raveType']=="Active"){

								$level1FounderCom = 0;

							}

							else{

								$level1FounderCom = 30+100+200+300;//(8*3.55)+(16*6.25)+(12.5*16)+(18.75*16) 

							}

							$level2ActiveCom = 9.38*16;
							$level3ActiveCom = 18.75*16;
							$level4ActiveCom = 37.50*16;
						$totalAmt = $level1FounderCom+$level2ActiveCom+$level3ActiveCom+$level4ActiveCom+$sumSpendableAmt; // My total income only show active total commission added by SB on 27/09/

							$income['total_income'] =	$totalAmt;	
							$income['active_commission']= $activeTotal;	
							$income['inviters_commission']=$myReferalTotal;
							$income['founders_commission']=$level1FounderCom+$founderTotal;
							$income['contingent_commission'] = (2.88*8) + (14*16) +  (100*16) + (148.75*$allAccountDetail[0]['counter']);
							$income['no_of_days_work'] = $allAccountDetail[0]['counter'];

						}

				}

				else{

					if($allAccountDetail[0]['level']==2 || $allAccountDetail[0]['level']==3)
					{

						$middleBonusName = 'Seed';

					}
					else if($allAccountDetail[0]['level']==4){

						$middleBonusName = 'Seed';

					}

					//$spendableAmt = $allAccountDetail[0]['amount'];// blocked by SB on 05/07/2016

					//$totalAmt = $allAccountDetail[0]['amount'];// added by SB on 05/07/2016

					if($allAccountDetail[0]['level']==1 ){
						$totalAmt = 0;
						$income['total_income'] =	$totalAmt;	
						$income['active_commission']= $activeTotal;	
						$income['inviters_commission']= $myReferalTotal;
						$income['founders_commission']= $founderTotal;
						$income['contingent_commission'] = (2.88*$allAccountDetail[0]['counter']);
						$income['no_of_days_work'] = $allAccountDetail[0]['counter'];
					}

					else if($allAccountDetail[0]['userLevel']==2){

						if($this->session->userdata('raveType')=="Active"){
								$level1FounderCom = 0;

							}

							else{
								$level1FounderCom = 30;
							}

						$totalAmt = $level1FounderCom + $myReferalTotal;

						$income['total_income'] =	$totalAmt;	
						$income['active_commission']= $activeTotal;	
						$income['inviters_commission']= $myReferalTotal;
						$income['founders_commission']= $level1FounderCom + $founderTotal;
						$income['contingent_commission'] = (2.88*8);
						$income['no_of_days_work'] = $allAccountDetail[0]['counter'];

					}

					else if($allAccountDetail[0]['level']==3){

						if($this->session->userdata('raveType')=="Active"){

								$level1FounderCom = 0;

							}

							else{

								$level1FounderCom = 30+100;

							}

						$level2ActiveCom = 9.38*16;

						$totalAmt = $level2ActiveCom+$level1FounderCom+$myReferalTotal;
                        
						$income['total_income'] =	$totalAmt;	
						$income['active_commission']= $activeTotal;	
						$income['inviters_commission']= $myReferalTotal;
						$income['founders_commission']= $level1FounderCom + $founderTotal;
                        $income['contingent_commission'] = (2.88*8) + (14*$allAccountDetail[0]['counter']);
                        $income['no_of_days_work'] = $allAccountDetail[0]['counter'];

					}

					else if($allAccountDetail[0]['level']==4){

						if($allAccountDetail[0]['raveType']=="Active"){
								$level1FounderCom = 0;
							}

							else{
								$level1FounderCom = 30+100+200;
							}

						$level2ActiveCom = 9.38*16;
						$level3ActiveCom = 18.75*16;
						$totalAmt = $level2ActiveCom+$level3ActiveCom+$level1FounderCom+$myReferalTotal;
                        
						$income['total_income'] =	$totalAmt;	
						$income['active_commission']= $activeTotal;	
						$income['inviters_commission']=$myReferalTotal;
						$income['founders_commission']=$level1FounderCom + $founderTotal;
                        $income['contingent_commission'] = (2.88*8) + (14*16) +  (100*$allAccountDetail[0]['counter']);
                        $income['no_of_days_work'] = $allAccountDetail[0]['counter'];

					}

					else if($allAccountDetail[0]['level']==5){

						if($allAccountDetail[0]['raveType']=="Active"){

								$level1FounderCom = 0;

							}

							else{

								$level1FounderCom = 30+100+200+300;

							}

						$level2ActiveCom = 9.38*16;
						$level3ActiveCom = 18.75*16;
						$level4ActiveCom = 37.50*16;
						$totalAmt = $level2ActiveCom+$level3ActiveCom+$level4ActiveCom+$level1FounderCom+$myReferalTotal;
                        
						$income['total_income'] =	$totalAmt;	
						$income['active_commission']= $activeTotal;	
						$income['inviters_commission']= $myReferalTotal;
						$income['founders_commission']= $level1FounderCom + $founderTotal;
                        $income['contingent_commission'] = (2.88*8) + (14*16) +  (100*16) + (148.75*$allAccountDetail[0]['counter']);
                        $income['no_of_days_work'] = $allAccountDetail[0]['counter'];


					}



				}	

				return $income;
}
}



?>