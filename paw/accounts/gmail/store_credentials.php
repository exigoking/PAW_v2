<?php
/**
 * @file
 * Take the user when they store Gmail username and passwords. Get credentials.
 * Verify credentials and redirect to based on response from user.
 */

require_once('config.php');
/*Connecting to the database*/
$username = 'TimurMalgazhdar';
mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
mysql_select_db('paw');

if(!empty($_POST)){
	$gmail_id = (string)trim($_POST['username']);	
	$gmail_password = (string)trim($_POST['password']);
}
else{
	 header('Location: ../accounts_selection.php');
}
$query = mysql_query("SELECT * FROM gmail_users WHERE username = '". $username . "'");    
$result = mysql_fetch_array($query);

/*If no tokens in database then add them*/
if(!empty($result)){
		echo "User is already in database!";
}
else {
$query = mysql_query("INSERT INTO gmail_users (gmail_id, gmail_password, username) VALUES ('{$gmail_id}', '{$gmail_password}', '{$username}')");  
}

header('Location: ../accounts_selection.php');



?>