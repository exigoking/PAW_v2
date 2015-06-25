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
$query = mysql_query("SELECT * FROM facebook_users WHERE oauth_provider = 'facebook' AND username = '". $username . "'");   			
$result = mysql_fetch_array($query);
$access_token_fb = $result_fb['oauth_token'];

if(!empty($result)){
	//Removing from the database.
	$query = mysql_query("DELETE FROM facebook_users WHERE oauth_provider='facebook' AND username = '". $username . "'");
}
else {
	//User has been already deleted;
}

header('Location: https://www.facebook.com/logout.php?access_token='.$access_token_fb.'&confirm=1&next=https://localhost/paw/accounts/accounts_selection.php');
 
?>