<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Automailtoactiveuser extends CI_Controller {
    private $_admin_email ;
    private $paypal_active = 2; //1=live;2=sandbox
	private $_from_email;//22/12/2015 new aded us
    private $_from_name;
	private $_to_email;
	private $_subject;
    private $_message;
	//private $this->forWebsite = 2;
    
    function __construct() { echo "111"; exit;
        parent::__construct();
        $this->load->model('gatewaymodel');       
		$this->load->model('common_model');       
		$this->_from_email = "admin@communitytreasures.co";
        $this->_from_name = "communitytreasures.co";
        $this->_admin_email = "admin@communitytreasures.co";
		$this->forWebsite = 2;
        }
		
	 public function index(){ echo "111";
		$activeUser = array();		
		$activeUser = $this->gatewaymodel->getRaveActiveUser();
		print_r($activeUser); exit();
        $this->_subject = "Community Treasure Member Notice";		
		//print_r($eleMoveUpUser);
		if(count($activeUser)>0){
			$userCount=0;			
			foreach($activeUser as $activeUserDetail){
				$userCount++;
				$to_email='';
				$firstName ='';
				$this->_to_email = activeUserDetail['emailID'];
				$to_email = activeUserDetail['emailID'];
				$firstName   = $activeUserDetail['firstName'];
				
				if($to_email!= ""){
					
					$this->_message = '<table width="700" cellspacing="0" cellpadding="0" border="0" align="center" style="font-family:Verdana, Geneva, sans-serif; color:#5c5c5c; font-size:14px; line-height:18px;">
  <tr>
    <td align="center" valign="middle"><img src="'.base_url().'images/logoMail.png" width="554" height="131" alt="" /></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="middle">
   <p> Hello <strong>'.$firstName.' ,</strong></p>
   <p>It’s Been Another Great Few Days As More and More People 
Join The Community Treasures Queue.
We ask You to Stay 100% Motivated, Keep inviting people to Lock-In their FREE Position and keep building your referral network for the launch. It will truly be worth it.</p>
<p>Today we saw our first negative press and it seemed so strange to observe how a shallow mind can spend valuable time to abuse the Internet, pretending to know how we work, without having any knowledge of the true mechanics behind our community. </p>
<p>Anyway, Let’s Address This Negativity For One Quick Moment!</p>
<p>This is our first time ever to roll out an online business opportunity so although we don\'t have plenty of experience, 
We will provide Brand New Ideas to this industry while we implement Very Fresh Ways of doing things.
</p> 
<p>We invited All of our members to lock-in their positions for FREE - Giving people the very best chance of success and we have not asked for any enrolment fee until our entire system is running smoothly.</p>
<p>Although we have a founder, we work together as an international community and we value ALL of our members.</p>

<p>We have a unique marketing kit (which is our actual product) to be un-veiled when our fully tested community becomes ready to go live. so this is definitely NOT a ponzi or pyramid scheme.</p>
<p>We are not saints or sinners, we are not gurus or billionaires.
We are people \'Like You\' who are working hard to make a positive change in our lives and in the world around us.</p>
<p>Our membership is varied, representing many industries and all walks of life. We are not afraid to band together to make things work for our mutual benefit.</p>
<p>We know that Haters love to Hate – and Haters fear things that are new and what they don’t take the time to understand. They love to judge others and resist change.</p>
<p>We wish the haters well, but</p>
<p>WE WILL CONTINUE TO UNITE & MOVE FORWARD 
on our quest to build our amazing online business that creates wealth for our members 
while helping to make a positive change in the world.</p>
<p>THIS IS OUR MISSION, THIS IS OUR MOMENT
IT’S TIME FOR COMMUNITY TREASURES.</p>
<p>WE THANK YOU FOR YOUR BELIEF IN THIS VISION AND IN US.
WE WILL NOT LET YOU DOWN.</p>
<h2 style="font-size: 18px; line-height: 22px;">Now Back To Work - Update</h2>
<p>We are getting closer to stabilizing the system, but sometimes the income shown in the simulation may still fluctuate and your position may shift but it will all settle down soon.</p>
<h2 style="font-size: 18px; line-height: 22px;">LAUNCH DATE</h2>
<p>With the high volume of signups continuing to enter our system we are anticipating to go Live in late September or early October.</p>
<p>Many of you would like to see us launch sooner, but please consider this a blessing.</p>
<h2 style="font-size: 18px; line-height: 22px;">Example:</h2>
<p>When you board a plane, the hostess says first \'Group A\' prepare for boarding,
 then Group B, Group C and so on. Well this is the same principle.
Even if you joined today You will be invited into the live area before people who enter next week and so on. So introduce more people through your sign up pages while it remains Free for them to lock-in their positions in the Q.</p>
<h2 style="font-size: 18px; line-height: 22px;">DOUBLES ON YOUR DISPLAY</h2>
<p>A few of you are still seeing multiple entries of the same referral on your referral display. We are aware of this this issue and it will be fixed soon.
</p>
<h2 style="font-size: 18px; line-height: 22px;"> KEEP INVITING PEOPLE
into Your CT Business and check your email often, so you don\'t miss any CT updates.
</h2>
<h2 style="font-size: 18px; line-height: 22px;">\'Happy Hunting\'</h2></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
</table>';

				 if ($this->_to_email != '' && $this->_subject != '') {
							$this->send_mail_raw();
							return true;
						} else {
							return false;
						}
		
				}
				
				
				
			}
		} 
	
	//$output = json_encode($val);
	//echo $output; 
  }	
  public function send_mail_raw() {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "Bcc:testingjust100@gmail.com"."\n"; //backup mail to Community Treasure id & Senabi Test Email Id on 22/08/2016
        //$headers .= "Bcc:testingjust100@gmail.com"."\n";
	    $headers .= 'From: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\r\n";
        $headers .= 'Return-Path: ' . $this->_from_name . ' <' . $this->_from_email . '>' . "\n";
        $send = mail($this->_to_email, $this->_subject, $this->_message, $headers);
        if ($send) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
		
		
}
		
		
		
		
?>