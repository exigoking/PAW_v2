<?php
//Retrieving data from Facebook
/**
 * @author Timur Malgazhdarov
 * @copyright 2013
 **/
 
include 'facebook.php';
include 'facebookMessages.php';
require_once('config.php');
$username = 'TimurMalgazhdar';
$config = array('appId'=>'645818095470152',
                'secret'=>'2492bdbca01c45075450c9256d423e60');
$facebook = new Facebook($config);
/*Connecting to the database*/
mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
mysql_select_db('paw');
/*Finding user's twitter oauth tokens and secrets in database if they exist*/
$query = mysql_query("SELECT * FROM facebook_users WHERE oauth_provider = 'facebook' AND username = '". $username . "'");   
$result = mysql_fetch_array($query);
if(!empty($result)){
	echo $result['oauth_token'];
	$facebook->setAccessToken($result['oauth_token']);
}
else{
	echo "No facebook account was added!";
}
$user_id = $facebook->getUser();


//$inbox = $facebook->api('/me/inbox','GET');
if($user_id){
	echo "Good";
	$facebook->setExtendedAccessToken();
	$access_token = $facebook->getAccessToken();
    $inbox = $facebook->api('/me/inbox','GET');
	$me = $facebook->api('/me','GET');
	$_SESSION['user_token'] = $access_token;
	facebookMessages($inbox,$me);
}


	
	

?>