<?php


require_once('globals.php'); 
require_once('oauth_helper.php');
$callback    =    "http://globalblackenterprises.com/inviteFriend/yahoo/yahoo_callback.php"; 
 // Get the request token using HTTP GET and HMAC-SHA1 signature 
$retarr = get_request_token(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, $callback, false, true, true);
//print_r($retarr);
$retUrl = "#";
if (! empty($retarr)){ 
    list($info, $headers, $body, $body_parsed) = $retarr; 
    if ($info['http_code'] == 200 && !empty($body)) { 
        $_SESSION['request_token']  = $body_parsed['oauth_token'];
        $_SESSION['request_token_secret']  = $body_parsed['oauth_token_secret']; 
        $_SESSION['oauth_verifier'] = $body_parsed['oauth_token']; 
        $retUrl = urldecode($body_parsed['xoauth_request_auth_url']);
        //echo  '<a href="'.urldecode($body_parsed['xoauth_request_auth_url']).'" >Yahoo Contact list</a>';
        ?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>GBE makes you money & builds our Community</title>
<link href="http://globalblackenterprises.com/css/style3.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://globalblackenterprises.com/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://globalblackenterprises.com/js/main.js"></script>
<style>

.main_inv {
    background: #1b1b1b none repeat scroll 0 0;
    border: 3px solid #42190c;
    margin: 0 auto;
    padding: 10px;
    text-align: center;
    width: 540px;
}
.invted .logo-img {
    background-image: none;
    text-align: center;
    width: 100%;
}
.main_inv form {
    color: #fff;
}
.invted .hed_inr h1{float:none;}
.invted .scrll li input {
    display: block;
    float: left;
    margin: 3px 8px 0 0;
}
.invted .scrll li p {
    display: block;
    float: left;
    font-size: 16px;
    line-height: 18px;
}
.invted .scrll li strong {
    display: block;
    float: left;
    font-size: 16px;
    line-height: 18px;
    margin: 0 5px 0 0;
}
.invted .scrll li {
    overflow: hidden;
    padding-bottom: 10px;
}
.invted .scrll {
    
}
.msgesse textarea {
    border: 1px solid #000;
    box-shadow: 0 0 5px #0e66a1;
    width: 100%;
	height:100px;
	padding:8px;
}
.msgesse > strong {
    display: block;
    font-size: 16px;
    line-height: 20px;
    padding-bottom: 6px;
    text-align: left;
}
.sub_mit > input[type="submit"]:hover, .sub_mit > a:hover{ opacity:0.5;}
.sub_mit > a {
    background: hsl(0, 40%, 32%) none repeat scroll 0 0;
    border: 1px solid hsl(0, 67%, 32%);
    border-radius: 5px;
    color: hsl(0, 0%, 100%);
    cursor: pointer;
    display: block;
    font-family: "Open Sans",sans-serif;
    font-size: 22px;
    font-weight: bold;
    line-height: 25px;
    margin-top: 13px;
    padding: 6px 10px;
    position: relative;
    text-transform: capitalize;
    width: 96%;
    z-index: 0;
}
.sub_mit > input[type="submit"]{
    background: hsl(0, 100%, 32%) none repeat scroll 0 0;
    border: 1px solid hsl(0, 89%, 42%);
    border-radius: 5px;
    color: hsl(0, 0%, 100%);
    cursor: pointer;
    display: block;
    font-family: "Open Sans",sans-serif;
    font-size: 22px;
    font-weight: bold;
    line-height: 25px;
    margin-top: 13px;
    padding: 6px 10px;
    position: relative;
    width: 100%;
    z-index: 0;
	text-transform:capitalize;
}
</style>


<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<!--[if lt IE 8]>
<script src="js/CreateHTML5Elements.js"></script>
<![endif]-->
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="ie/ie-fix.css" />
<![endif]-->
<!--[if IE]>
	<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->



</head>
<body class="invted">

	<!--Header section-->
    	<header>
            <div class="hed_inr">
                <h1><a href="http://www.globalblackenterprises.com/gateway"><div class="logo-img"><img src="http://www.globalblackenterprises.com/images/global-logo.png" alt="logo"></div></a></h1>
            </div>
        </header>
	<!--Header section end-->


<div class=" hm_lggn">
        	<div class="body_inr">
	<div class="main_inv">
    <a href="<?php echo urldecode($body_parsed['xoauth_request_auth_url']);?>" style="text-decoration: none"><img src="http://www.globalblackenterprises.com/inviteFriend/gmail/images/gbe_yahoo.png" alt="yahoo logo"></a></div>
</div>
</div>
</body>

</html>
<?php
    } 
}

?> 


