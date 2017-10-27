<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * @Ranajit Das
 */

class Contact_api_gmail{
    public $clientId = '624626394980-okt8m5dh0fd2b3ujidb40lu6f02qnreq.apps.googleusercontent.com';
    public $clientSecret = '0CpbJbakTenTKg_9JAyDZifG';
    public $redirectUri ; //Add your redirect URl	
    public $maxResults	;
    public $oauthToken;
    public $oauthCode;
    public $fieldString;
    public $obj;


    public function __construct(){
        $this->obj =& get_instance();
        $this->redirectUri = base_url().'dashboard/getGmailContacts';
        $this->maxResults = '';
        $this->fieldString = '';
    }
    
    public function setOauthToken($val = ''){
        $this->oauthToken = $val;
    }
    
    public function setOauthCode($val = ''){
        $this->oauthCode = $val;
    }
    
    public function setFieldString(){
        $this->fieldString = "code=".urlencode($this->oauthCode)."&client_id=".urlencode($this->clientId)."&client_secret=".urlencode($this->clientSecret)."&redirect_uri=".urlencode($this->redirectUri)."&grant_type=".urlencode('authorization_code');
    }
    
    public function getAllContacts(){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token'); //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_POST,5);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$this->fieldString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Set so curl_exec returns the result instead of outputting it.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //to trust any ssl certificates
        $result = curl_exec($ch); //execute post
        curl_close($ch); //close connection
        //print_r($result);
        //extracting access_token from response string
        $response   =  json_decode($result);
        $accesstoken = $response->access_token;
        if( $accesstoken!='')
            $this->oauthToken = $accesstoken;
        //passing accesstoken to obtain contact details
        $xmlresponse=  file_get_contents('https://www.google.com/m8/feeds/contacts/default/full?max-results='.$this->maxResults.'&oauth_token='. $this->oauthToken);
        //reading xml using SimpleXML
        $xml=  new SimpleXMLElement($xmlresponse);
        $xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
        $result = $xml->xpath('//gd:email');
        $retData = array();
        foreach ($result as $title) {
            $retData[] = $title->attributes()->address;
        }
        return $retData;
    }
	
	public function getGmailDetails(){
		return array("clientId"=>$this->clientId,"redirectUri"=>$this->redirectUri);	
	}
    
    
}