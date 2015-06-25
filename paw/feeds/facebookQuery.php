<?php
include 'facebook.php';
include 'facebookMessages.php';

/**
 * @author Timur Malgazhdarov
 * @copyright 2013
 */

require_once("facebook.php");
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
	$facebook->setAccessToken($result['oauth_token']);
}

$user_id = $facebook->getUser();

?>
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    </head>
    <body>
    <?php
		
		if($user_id)
		{
	        try {
				$facebook->setExtendedAccessToken();
	       	 	$access_token = $facebook->getAccessToken();
	            $inbox = $facebook->api('/me/inbox','GET');
				$me = $facebook->api('/me','GET');
				$_SESSION['user_token'] = $access_token;
				facebookMessages($inbox,$me);
				//sleep(5);
				//facebookMessages($inbox,$me);
	            }  
	                 
	        catch(FacebookApiException $e) 
				{
				$params = array(
	  							'scope' => 'read_mailbox, offline_access',
	  							'redirect_uri' => 'http://localhost/facebook/callback.php'
								);
	            $login_url = $facebook->getLoginUrl($params);
	            echo 'No Token </br>';
	            echo '<a href="' . $login_url . '">Authorize on Facebook</a>';
	            error_log($e->getType());
	            error_log($e->getMessage());
	        	} 
	    } 
		else
		{
			$params = array(
	  							'scope' => 'read_mailbox, offline_access',
	  							'redirect_uri' => 'http://localhost/facebook/callback.php'
								);
				
	        $login_url = $facebook->getLoginUrl($params);
	        echo '<a href="' . $login_url . '">Authorize on Facebook</a>';
			
			 
			
	    }
				
    ?>
    </body>
</html>