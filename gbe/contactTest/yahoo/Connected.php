<?
include_once 'config.php';
require_once ('Yahoo.inc');
$session = YahooSession::requireSession($consumer_key,$consumer_secret,$app_id);
if (is_object($session))
{
$user = $session->getSessionedUser();
$profile = $user->getProfile();
$name = $profile->nickname; // Getting user name
$guid = $profile->guid; // Getting Yahoo ID
$contacts=$user->getContacts()->contacts;
echo "Hi! ".$name."<br />";

for ($i=0,$k=0;$i<count($contacts->contact);$i++)
{
for($j=0;$j<count($contacts->contact[$i]->fields);$j++)
{
$url_data = $contacts->contact[$i]->fields[$j]->uri;
$url_pie=explode("/user/", $url_data);
$url_end=substr($url_pie[1], stripos($url_pie[1], "/")+1);
$data=explode("/", $url_end);
if ($data[2]==="email")
{
$email_fr[$k]=$user->getDatafrom($url_end)->email->value;
$k++;
}
}
}
echo "You have ".$k." contacts.<br />";
for($i=0;$i<$k;$i++)
echo ($i+1).": ".$email_fr[$i]."<br />";
}
else
{
header("Location :".$re_url);
}