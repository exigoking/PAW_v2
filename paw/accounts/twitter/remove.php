<?php
/**
 * @file
 *Remove a client from the database
 */
//require_once('facebookQuery.php');
require_once('config.php');
$username = 'TimurMalgazhdar';
/*Connecting to the database*/

mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
mysql_select_db('paw');
/*Finding user's twitter oauth tokens and secrets in database if they exist*/
$query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'twitter' AND username = '". $username . "'");   			
$result = mysql_fetch_array($query);
$access_token_tw = $result_tw['oauth_token'];

if(!empty($result)){
	//Removing from the database.
	$query = mysql_query("DELETE FROM users WHERE oauth_provider='twitter' AND username = '". $username . "'");
}
else {
	//User has been already deleted;
}

header('Location: https://twitter.com/logout');
 
?>