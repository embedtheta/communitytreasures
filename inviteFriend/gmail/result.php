<?php include('header.php');?>

<script type="application/javascript">
	function validate(){
		var count = 0;
		$('.emailsClass').each(function(){ 
			if(this.checked == true){
				count = count + 1;
			}
		});
		if(count == 0){
			alert("Please checked one.");
			return false;	
		}
		var msg = $("#messegeId").val();
		if(msg == ""){
			alert("Please enter the message.");
			$("#messegeId").focus();
			return false;	
		}
		return true;
	}
</script>
    <div class=" hm_lggn">
        	<div class="body_inr">
            	<div class="main_inv">
	
            <form action="http://globalblackenterprises.com/dashboard/getGmailContacts" method="post" name="gmail">
            
<?php
//setting parameters



$authcode		= $_GET["code"];



$fields=array(
'code'=>  urlencode($authcode),
'client_id'=>  urlencode($clientid),
'client_secret'=>  urlencode($clientsecret),
'redirect_uri'=>  urlencode($redirecturi),
'grant_type'=>  urlencode('authorization_code') );

//url-ify the data for the POST

$fields_string = '';

foreach($fields as $key=>$value){ $fields_string .= $key.'='.$value.'&'; }

$fields_string	=	rtrim($fields_string,'&');

//open connection
$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token'); //set the url, number of POST vars, POST data

curl_setopt($ch,CURLOPT_POST,5);

curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Set so curl_exec returns the result instead of outputting it.

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //to trust any ssl certificates

$result = curl_exec($ch); //execute post

curl_close($ch); //close connection

//print_r($result);

//extracting access_token from response string

$response   =  json_decode($result);

$accesstoken = $response->access_token;


if( $accesstoken!='')

$_SESSION['token']= $accesstoken;

//passing accesstoken to obtain contact details

$xmlresponse=  file_get_contents('https://www.google.com/m8/feeds/contacts/default/full?max-results='.$maxresults.'&oauth_token='. $_SESSION['token']);

//reading xml using SimpleXML

$xml=  new SimpleXMLElement($xmlresponse);

$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');

$result = $xml->xpath('//gd:email');
$total = count($result);
$scrollHieght = 280;
if(($total*28) < 280){ $scrollHieght = $total*28;}
echo '<ul class="scrll" style="height: '.($scrollHieght+10).'px; overflow: auto;">';
$count = 0;
foreach ($result as $title) {
	$count++;

?>	
	<li><strong><?php echo $count;?>.</strong><input type="checkbox" class="emailsClass" name="emails[]" value="<?php echo $title->attributes()->address ;?>">
	<p><?php echo $title->attributes()->address ;?></p></li>
<?php 

}

?>
</ul>
<p class="msgesse"><strong>Message :</strong> <textarea name="message" id="messegeId"></textarea></p>
<p class="sub_mit"><input type="submit" value="send" name="send" onClick="return validate();"><a href="http://globalblackenterprises.com/dashboard/" title="Cancel">Cancel</a></p>
</form>

    </div>
</div>
</div>
</body>
</html>