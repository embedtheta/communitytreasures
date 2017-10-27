<?php
/*$php_userid = 'arnabcse12@yahoo.com';
$php_password = 'BarneyStinson123!';
$cookie_file_path = "http://ravestorysociety.com/contactTest/cookie.txt"; // Please set your Cookie File path
$fp = fopen($cookie_file_path,'wb');
fclose($fp);
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
$reffer = "http://mail.yahoo.com/";
// log out.
$LOGINURL = "http://us.ard.yahoo.com/SIG=12hoqklmn/M=289534.5473431.6553392.5333790/D=mail/S=150500014:HEADR/Y=YAHOO/EXP=1135053978/A=2378664/R=4/SIG=133erplvs/*http://login.yahoo.com/config/login?logout=1&.done=http://mail.yahoo.com/&.src=ym&.lg=us&.intl=us";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$LOGINURL);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
$result = curl_exec ($ch);
curl_close ($ch);
//1. Get first login page to parse hash_u,hash_challenge
$LOGINURL = "http://mail.yahoo.com";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$LOGINURL);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
$loginpage_html = curl_exec ($ch);
curl_close ($ch);
preg_match_all("/name=\".u\" value=\"(.*?)\"/", $loginpage_html, $arr_hash_u);
preg_match_all("/name=\".challenge\" value=\"(.*?)\"/", $loginpage_html, $arr_hash_challenge);
$hash_u = $arr_hash_u[1][0];
$hash_challenge = $arr_hash_challenge[1][0];
// 2- Post Login Data to Page https://login.yahoo.com/config/login?
$LOGINURL = "https://login.yahoo.com/config/login?";
$POSTFIELDS = '.tries=1&.src=ym&.md5=&.hash=&.js=&.last=&promo=&.intl=us&.bypass=&.partner=&.u='.$hash_u.'&.v=0&.challenge='.$hash_challenge.'&.yplus=&.emailCode=&pkg=&stepid=&.ev=&hasMsgr=0&.chkP=Y&.done=http%3A%2F%2Fmail.yahoo.com&login='.$php_userid.'&passwd='.$php_password;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$LOGINURL);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$POSTFIELDS);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_REFERER, $reffer);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
$result = curl_exec ($ch);
curl_close ($ch);
preg_match_all("/replace\(\"(.*?)\"/", $result, $arr_url);
$WelcomeURL = $arr_url[1][0];
// 3- Redirect to Welcome page. (Login Success)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$WelcomeURL);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_REFERER, $reffer);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
$result = curl_exec ($ch);
curl_close ($ch);
// echo $result;
// 4- Get Address Book.
$addressURL = 'http://address.mail.yahoo.com/?A=B';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$addressURL);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_REFERER, $reffer);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
$result = curl_exec ($ch);
curl_close ($ch);
//print $result;
preg_match_all("/\"\/yab\/us\/Yahoo\.csv\?(.*?)\"/", $result, $arr_address_url);
$randURL = html_entity_decode($arr_address_url[1][0]);
preg_match_all("/id=\"crumb2\" value=\"(.*?)\"/", $result, $arr_crumb);
$hash_crumb = $arr_crumb[1][0];
// 5- show Address Book.
$addressURL = 'http://address.mail.yahoo.com/index.php';
$POSTFIELDS ='.crumb='.$hash_crumb.'&VPC=print&field[allc]=1&field[catid]=0&field[style]=detailed&submit[action_display]=Display for Printing';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$addressURL);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$POSTFIELDS);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_REFERER, $reffer);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
$res = curl_exec ($ch);
curl_close ($ch);
//print $res;
$contacts=array();
$emailA=array();$bulk=array();
$res=str_replace(array(' ',' ',PHP_EOL,"\n","\r\n"),array('','','','',''),$res);
preg_match_all("#\<tr class\=\"phead\"\>\<td colspan\=\"2\"\>(.+)\<\/tr\>(.+)\<div class\=\"first\"\>\<\/div\>\<div\>\<\/div\>(.+)\<\/div\>#U",$res,$bulk);
if (!empty($bulk))
{
foreach($bulk[1] as $key=>$bulkName)
{
$nameFormated=trim(strip_tags($bulkName));
if (preg_match('/\ \;\-\ \;/',$nameFormated))
{
$emailA=explode(' - ',$nameFormated);
if (!empty($emailA[1])) $contacts[$emailA[1].'@yahoo.com']=array('first_name'=>$emailA[0],'email_1'=>$emailA[1].'@yahoo.com');
}
elseif (!empty($bulk[3][$key])) { $email=strip_tags(trim($bulk[3][$key])); $contacts[$email]=array('first_name'=>$nameFormated,'email_1'=>$email); }
}
}
$i=0;
foreach($contacts as $key => $valary)
{
//$finalcontacts[]['email']=$key;
foreach($valary as $namekey => $emailvalue)
{
$finalcontacts[$i][$namekey]=$emailvalue;
//$finalcontacts[]['email']=
}
$i++;
}
echo "<pre>";
//print_r($contacts);
print_r($finalcontacts);
die;*/
?>
<?php
require("OAuth.php");
 
$cc_key  = "dj0yJmk9ZXdzSVhpNmdtRllhJmQ9WVdrOVYwNVZOMUZ0TkhFbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD1kNg--";
$cc_secret = "d8b116833888202eb4ebab86712c2f7438423cae";
$url = "http://yboss.yahooapis.com/ysearch/news,web,images";
$args = array();
$args["q"] = "yahoo";
$args["format"] = "json";
 
$consumer = new OAuthConsumer($cc_key, $cc_secret);
$request = OAuthRequest::from_consumer_and_token($consumer, NULL,"GET", $url, $args);
$request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, NULL);
$url = sprintf("%s?%s", $url, OAuthUtil::build_http_query($args));
$ch = curl_init();
$headers = array($request->to_header());
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$rsp = curl_exec($ch);
$results = json_decode($rsp);
print_r($results);
?>

