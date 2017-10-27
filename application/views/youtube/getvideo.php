<?php
// YouTube Downloader PHP
// based on youtube-dl in Python http://rg3.github.com/youtube-dl/
// by Ricardo Garcia Gonzalez and others (details at url above)
//
// Takes a VideoID and outputs a list of formats in which the video can be
// downloaded

//include_once('http://220.225.90.155/rave_store_socity/Application/view/videogallery/youtube/curl.php');

if(isset($video_id)) {
	$my_id = trim($video_id);
} else {
	echo '<p>No video id passed in</p>';
	exit;
}


if(isset($_REQUEST['type'])) {
	$my_type =  $_REQUEST['type'];
} else {
	$my_type = 'redirect';
}

if(isset($_REQUEST['debug'])) {
	$debug = TRUE;
} else {
	$debug = FALSE;
}
$debug = TRUE;
$my_type='Download';

if ($my_type == 'Download') {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Youtube Downloader</title>
    <meta name="keywords" content="Video downloader, download youtube, video download, youtube video, youtube downloader, download youtube FLV, download youtube MP4, download youtube 3GP, php video downloader" />
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<style type="text/css">
body {
padding-top: 40px;
padding-bottom: 40px;
background-color: #f5f5f5;
}

.download {
max-width: 300px;
padding: 19px 29px 29px;
margin: 0 auto 20px;
background-color: #fff;
border: 1px solid #e5e5e5;
-webkit-border-radius: 5px;
   -moz-border-radius: 5px;
		border-radius: 5px;
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
   -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
		box-shadow: 0 1px 2px rgba(0,0,0,.05);
}

.download .download-heading {
margin-bottom: 10px;
}

.mime, .itag {
width: 75px;
display: inline-block;
}

.itag {
width: 15px;
}

.userscript {
float: right;
margin-top: 5px
}
.video-thumb{
	margin:0 0 10px;
}
.video-thumb img{
	 padding:10px;
	 background:#ccc;
	 margin:0 auto;
	 display:block;
}
ul.video-links{
	
}
ul.video-links li{
	display:block;
	padding:5px 25px;
	border-bottom:1px solid #f2f2f2;
	background:url(<?php echo base_url().'application/views/youtube/download.png'?>) no-repeat center left;
}
ul.video-links li a{
	color:#09F;
}
ul.video-links li a:hover{
	color:#000;
	text-decoration:underline;
}
.pop-header{
	padding:10px;
	margin:0 0 15px;
	background:#000;
}
.pop-header img{
	display:block;
	margin:0 auto;
}
</style>
	</head>
<body>
	<div class="download">
		<div class="pop-header"><img width="218" height="43" src="<?php echo base_url();?>/images/logo_inner.png"></div>
	<!--<h1 class="download-heading">Youtube Downloader Results</h1>-->
<?php
} // end of if for type=Download

/* First get the video info page for this video id */
$my_video_info = 'http://www.youtube.com/get_video_info?&video_id='. $my_id;
$my_video_info = curlGet($my_video_info);
/* TODO: Check return from curl for status code */

parse_str($my_video_info);
echo '<p class="video-thumb"><img src="'. $thumbnail_url .'" border="0" hspace="2" vspace="2"></p>';
$my_title = $title;

if(isset($url_encoded_fmt_stream_map)) {
	/* Now get the url_encoded_fmt_stream_map, and explode on comma */
	$my_formats_array = explode(',',$url_encoded_fmt_stream_map);
	//if($debug) {
	//	echo '<pre>';
	//	print_r($my_formats_array);
	//	echo '</pre>';
	//}
} else {
	/*echo '<p>No encoded format stream found.</p>';
	echo '<p>Here is what we got from YouTube:</p>';
	echo $my_video_info;*/
}
if (count($my_formats_array) == 0) {
	echo '<p>No encoded format stream found.</p>';
	//echo '<p>No format stream map found - was the video id correct?</p>';
	exit;
}

/* create an array of available download formats */
$avail_formats[] = '';
$i = 0;

foreach($my_formats_array as $format) {
	parse_str($format);
	$avail_formats[$i]['itag'] = $itag;
	$avail_formats[$i]['quality'] = $quality;
	$type = explode(';',$type);
	$avail_formats[$i]['type'] = $type[0];
	$avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
	parse_str(urldecode($url));
	$avail_formats[$i]['expires'] = date("G:i:s T", $expire);
	$avail_formats[$i]['ipbits'] = $ipbits;
	$avail_formats[$i]['ip'] = $ip;
	$i++;
}

if ($debug) {
	/*echo '<p>These links will expire at '. $avail_formats[0]['expires'] .'</p>';
	echo '<p>The server was at IP address '. $avail_formats[0]['ip'] .' which is an '. $avail_formats[0]['ipbits'] .' bit IP address. ';
	echo 'Note that when 8 bit IP addresses are used, the download links may fail.</p>';*/
}
if ($my_type == 'Download') {
	echo '<p>List of available formats for download:<br></p>';
	echo '<ul class="video-links">';

	/* now that we have the array, print the options */
	for ($i = 0; $i < count($avail_formats); $i++) {
		echo '<li>' .
				'<span class="itag">' . $avail_formats[$i]['itag'] . '</span> '.
				'<a href="' . $avail_formats[$i]['url'] . '" class="mime">' . $avail_formats[$i]['type'] . '</a> ' .
				'<small>(' .  $avail_formats[$i]['quality'] . ' / ' .
				'<a href="'.base_url().'application/views/youtube/download.php?mime=' . $avail_formats[$i]['type'] .'&title='. urlencode($my_title) .'&token=' . base64_encode($avail_formats[$i]['url']) . '" class="dl">download</a>' .
				')</small></li>';
	}
	echo '</ul>';
?>

<!-- @TODO: Prepend the base URI -->
<!--<a href="ytdl.user.js" class="userscript btn btn-mini" title="Install chrome extension to view a 'Download' link to this application on Youtube video pages.">
  Install Chrome Extension
</a>
-->
</div>
</body>
</html>

<?php

} else {

/* In this else, the request didn't come from a form but from something else
 * like an RSS feed.
 * As a result, we just want to return the best format, which depends on what
 * the user provided in the url.
 * If they provided "format=best" we just use the largest.
 * If they provided "format=free" we provide the best non-flash version
 * If they provided "format=ipad" we pull the best MP4 version
 *
 * Thanks to the python based youtube-dl for info on the formats
 *   							http://rg3.github.com/youtube-dl/
 */

$format =  $_REQUEST['format'];
$target_formats = '';
switch ($format) {
	case "best":
		/* largest formats first */
		$target_formats = array('38', '37', '46', '22', '45', '35', '44', '34', '18', '43', '6', '5', '17', '13');
		break;
	case "free":
		/* Here we include WebM but prefer it over FLV */
		$target_formats = array('38', '46', '37', '45', '22', '44', '35', '43', '34', '18', '6', '5', '17', '13');
		break;
	case "ipad":
		/* here we leave out WebM video and FLV - looking for MP4 */
		$target_formats = array('37','22','18','17');
		break;
	default:
		/* If they passed in a number use it */
		if (is_numeric($format)) {
			$target_formats[] = $format;
		} else {
			$target_formats = array('38', '37', '46', '22', '45', '35', '44', '34', '18', '43', '6', '5', '17', '13');
		}
	break;
}

/* Now we need to find our best format in the list of available formats */
$best_format = '';
for ($i=0; $i < count($target_formats); $i++) {
	for ($j=0; $j < count ($avail_formats); $j++) {
		if($target_formats[$i] == $avail_formats[$j]['itag']) {
			//echo '<p>Target format found, it is '. $avail_formats[$j]['itag'] .'</p>';
			$best_format = $j;
			break 2;
		}
	}
}

//echo '<p>Out of loop, best_format is '. $best_format .'</p>';
$redirect_url = $avail_formats[$best_format]['url'];
$content_type = $avail_formats[$best_format]['type'];
header("Location: $redirect_url");
} // end of else for type not being Download


?>


<?php
/*
 * function to get via cUrl 
 * From lastRSS 0.9.1 by Vojtech Semecky, webmaster @ webdot . cz
 * See      http://lastrss.webdot.cz/
 */
 
function curlGet($URL) {
    $ch = curl_init();
    $timeout = 3;
    curl_setopt( $ch , CURLOPT_URL , $URL );
    curl_setopt( $ch , CURLOPT_RETURNTRANSFER , 1 );
    curl_setopt( $ch , CURLOPT_CONNECTTIMEOUT , $timeout );
	/* if you want to force to ipv6, uncomment the following line */ 
	//curl_setopt( $ch , CURLOPT_IPRESOLVE , CURLOPT_IPRESOLVE_V6);
    $tmp = curl_exec( $ch );
    curl_close( $ch );
    return $tmp;
}  

/* 
 * function to use cUrl to get the headers of the file 
 */ 
function get_location($url) {
	$my_ch = curl_init();
	curl_setopt($my_ch, CURLOPT_URL,$url);
	curl_setopt($my_ch, CURLOPT_HEADER,         true);
	curl_setopt($my_ch, CURLOPT_NOBODY,         true);
	curl_setopt($my_ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($my_ch, CURLOPT_TIMEOUT,        10);
	$r = curl_exec($my_ch);
	 foreach(explode("\n", $r) as $header) {
		if(strpos($header, 'Location: ') === 0) {
			return trim(substr($header,10)); 
		}
	 }
	return '';
}

function get_size($url) {
	$my_ch = curl_init();
	curl_setopt($my_ch, CURLOPT_URL,$url);
	curl_setopt($my_ch, CURLOPT_HEADER,         true);
	curl_setopt($my_ch, CURLOPT_NOBODY,         true);
	curl_setopt($my_ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($my_ch, CURLOPT_TIMEOUT,        10);
	$r = curl_exec($my_ch);
	 foreach(explode("\n", $r) as $header) {
		if(strpos($header, 'Content-Length:') === 0) {
			return trim(substr($header,16)); 
		}
	 }
	return '';
}

function get_description($url) {
	$fullpage = curlGet($url);
	$dom = new DOMDocument();
	@$dom->loadHTML($fullpage);
	$xpath = new DOMXPath($dom); 
	$tags = $xpath->query('//div[@class="info-description-body"]');
	foreach ($tags as $tag) {
		$my_description .= (trim($tag->nodeValue));
	}	
	
	return utf8_decode($my_description);
}
?>
