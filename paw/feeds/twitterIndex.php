<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */
 /**
 * @author Timur Malgazhdarov
 * @copyright 2013
 */
/* Load required lib files. */
session_start();
require_once('./twitter/twitteroauth.php');
require_once('./twitter/config.php');


mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
mysql_select_db('paw');

$username = 'TimurMalgazhdar';

/*Finding user's twitter oauth tokens and secrets in database if they exist*/
$query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'twitter' AND username = '". $username . "'");  
$result = mysql_fetch_array($query);

if(!empty($result)){
		$_SESSION['id'] = $result['id']; 
	    $_SESSION['username'] = $result['username']; 
	    //$_SESSION['oauth_uid'] = $result['oauth_uid']; 
	    $_SESSION['oauth_provider'] = $result['oauth_provider']; 
	    $_SESSION['access_token']['oauth_token'] = $result['oauth_token']; 
	    $_SESSION['access_token']['oauth_token_secret'] = $result['oauth_secret']; 
}
/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    //header('Location: http://127.0.0.1/paw/accounts/accounts_selection.php');
	echo "";
}
else{
	/* Get user access tokens out of the session. */
	$access_token = $_SESSION['access_token'];


	/* Create a TwitterOauth object with consumer/user tokens. */
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

	/* If method is set change API call made. Test is called by default. */
	$content = $connection->get('account/verify_credentials');

	//AJAX POST Call
	if($_POST['action']== 'update'){
		$prev = file_get_contents('tweets.json');
		$prev_decoded=json_decode($prev);
		$home_timeline = $connection->get('statuses/home_timeline');
		$difference_array = array();
		//Run a loop while the first element in the previous string will be found in the new string
		//print_r($home_timeline);
		$i = 0;
		while($prev_decoded[0]->id_str != $home_timeline[$i]->id_str)
			{
				$i++;
				//echo $prev_decoded[0]->id_str . "=" . $home_timeline[$i]->id_str . "</br>";
				//If will reach the end of the twitter package
				if($home_timeline[$i]->id_str==NULL)
				{
					break;
				}
				
			}
		//echo $i;
		for ($j = $i; $j>=0;$j--)
		{
			array_push($difference_array, $home_timeline[$j]);
		}
		$output = json_encode($difference_array);
		file_put_contents("tweets.json",json_encode($home_timeline));
		//echo $difference_array;
		echo $output;
		
	}
	else {
		;//do nothing
	}
}


?>