<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

/**
* Description of site_offline
*
* @author admin
*/
class Site_Offline  extends CI_Controller {
function __construct() {
//parent::__construct();
}

public function is_offline() {
if (file_exists(APPPATH . 'config/config.php')) {
include(APPPATH . 'config/config.php');

if (isset($config['is_offline']) && $config['is_offline'] === TRUE) {
//$cur_url = $_SERVER['PHP_SELF']; // For development
$cur_url = $_SERVER['REQUEST_URI']; // For LIVE Server
//signupuser/reEnterUser
//signupuser/reRegisterUser
//signupuser/createDummyUser
//CronReEnterUser
/*echo "<pre>";
print_r($_SERVER);
echo "</pre>";*/
//echo $cur_url; exit;
if(!strstr($cur_url, "signupuser/reEnterUser")){
	
$this->show_site_offline($config);
exit;
	
}//end checking
}
}
}

private function show_site_offline($config) {
	
/*echo '<html><body><span style="color:red;"><strong>The site is offline due to maintenance. We will be back soon. Please check back later</strong></span>.</body></html>';*/
echo '<html><body><div style="text-align:center;"><img src="'.$config['base_url'].'images/down-page.jpg" alt="" /></div></body></html>';
}

}

/* End of file site_offline.php */
/* Location: ./application/hooks/site_offline.php */