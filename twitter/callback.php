<?php
/**
 * @file
 * Take the user when they return from Twitter. Get access tokens.
 * Verify credentials and redirect to based on response from Twitter.
 */

/* Start session and load lib */
session_start();
require_once('twitteroauth.php');
require_once('config.php');

/* If the oauth_token is old, redirect to the connect page. */
if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
  $_SESSION['oauth_status'] = 'oldtoken';
  header('Location: ./clearsessions.php');
}

/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* Save the access tokens. Normally these would be saved in a DATABASE for future use. */
$_SESSION['access_token'] = $access_token;
$username ='TimurMalgazhdar';

/*Connecting to the database*/
mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
mysql_select_db('paw');
/*Finding user's twitter oauth tokens and secrets in database if they exist*/
$query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'twitter' AND username = '". $username . "'");    
$result = mysql_fetch_array($query);

/*If no tokens in database then add them*/
if(!empty($result)){
		echo "User is already in database!";
}
else {
	$query = mysql_query("INSERT INTO users (oauth_provider, username, oauth_token, oauth_secret) VALUES ('twitter', '{$username}', '{$access_token['oauth_token']}', '{$access_token['oauth_token_secret']}')");  
}

/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

/* If HTTP response is 200 continue, otherwise send to connect page to retry */
if (200 == $connection->http_code) {
  /* The user has been verified and the access tokens can be saved for future use */
  $_SESSION['status'] = 'verified';
  header('Location: ./twitterIndex.php');
} else {
  /* Save HTTP status for error dialog on connnect page.*/
  header('Location: ./clearsessions.php');
}

?>