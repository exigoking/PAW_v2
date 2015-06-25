<?php
/**
 * @file
 * Take the user when they return from Facebook. Get access tokens.
 * Verify credentials and redirect to based on response from Facebook.
 */

/* Start session and load lib */
session_start();
require_once('facebook.php');
//require_once('facebookQuery.php');
require_once('config.php');
$username = 'TimurMalgazhdar';
$config = array('appId'=>'645818095470152',
                'secret'=>'2492bdbca01c45075450c9256d423e60');


$facebook = new Facebook($config);
echo "Callback works!";


//$facebook->setExtendedAccessToken();
$long_lived_access_token = $facebook->getAccessToken($_REQUEST['oauth_verifier']);
/*Connecting to the database*/
//header('Location: ./facebookQuery.php');
mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
mysql_select_db('paw');
/*Finding user's twitter oauth tokens and secrets in database if they exist*/
$query = mysql_query("SELECT * FROM facebook_users WHERE oauth_provider = 'facebook' AND username = '". $username . "'");   			
$result = mysql_fetch_array($query);


/*If no tokens in database then add them*/
if(!empty($result)){
		echo "User is already in database!";
		//Will probably need to UPDATE tokens here
}
else {
$query = mysql_query("INSERT INTO facebook_users (oauth_provider, username, oauth_token) VALUES ('facebook', '{$username}', '{$long_lived_access_token}')"); 
}

header('Location: ../paw/accounts/accounts_selection.php');

?>