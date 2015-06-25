<?php
//twitter_temp
//This script is for obtaining user's info after
//being approved on Twitter and redirected to our site

require("twitteroauth.php"); 
require("twitterDatabase.php");
session_start();  
//Check if we have received access token for a user
if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){  
    // We've got everything we need  
} else {  
    // Something's missing, go back to square 1  
    header('Location: twitterQuery.php');  
}  

// TwitterOAuth instance, with two new parameters we got in twitterQuery.php  
$twitteroauth = new TwitterOAuth('3LUB6YoqtNAsjQ5u6ImcQ', 'TFnWIhN57Gc3HBKiu1ddngo8vTBTgBBN7hAU8Sy4', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);  
// Let's request the access token  
$access_token = $twitteroauth->getAccessToken($_REQUEST['oauth_verifier']); 
// Save it in a session var 
$_SESSION['access_token'] = $access_token; 
// Let's get the user's info 
/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);
$user_info = $twitteroauth->get('account/verify_credentials'); 
// Print user's info  
//print_r($user_info); 
//twitterDatabase($user_info);

//Connecting to the database
/*mysql_connect('localhost', 'root', 'OtanisKZ');  
mysql_select_db('sakila'); 


	//Now check if the user is in the database.
	//If the user has been registered, we must update the tokens, 
	//because Twitter has generated new ones and the ones we have
	//in the database are now unusable. Finally, we set the user’s 
	//info to the session vars and redirect to twitter_update.php.
	if(isset($user_info->error)){  
	    // Something's wrong, go back to square 1  
	    header('Location: twitterQuery.php'); 
	} else { 
	    // Let's find the user by its ID  
	    $query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'twitter' AND oauth_uid = ". $user_info->id);  
	    $result = mysql_fetch_array($query);  
	  
	    // If not, let's add it to the database  
	    if(empty($result)){  
	        $query = mysql_query("INSERT INTO users (oauth_provider, oauth_uid, username, oauth_token, oauth_secret) VALUES ('twitter', {$user_info->id}, '{$user_info->screen_name}', '{$access_token['oauth_token']}', '{$access_token['oauth_token_secret']}')");  
	        $query = mysql_query("SELECT * FROM users WHERE id = " . mysql_insert_id());  
	        $result = mysql_fetch_array($query);  
	    } else {  
	        // Update the tokens  
	        $query = mysql_query("UPDATE users SET oauth_token = '{$access_token['oauth_token']}', oauth_secret = '{$access_token['oauth_token_secret']}' WHERE oauth_provider = 'twitter' AND oauth_uid = {$user_info->id}");  
	    }  
	  
	    $_SESSION['id'] = $result['id']; 
	    $_SESSION['username'] = $result['username']; 
	    $_SESSION['oauth_uid'] = $result['oauth_uid']; 
	    $_SESSION['oauth_provider'] = $result['oauth_provider']; 
	    $_SESSION['oauth_token'] = $result['oauth_token']; 
	    $_SESSION['oauth_secret'] = $result['oauth_secret']; 
	 	//echo "Storing to the Database.";
	    //header('Location: twitterMain.php');  
	}  

if(!empty($_SESSION['username'])){  
    // User is logged in, redirect  
	//echo "I am not empty!";
    //header('Location: twitterMain.php');  
}

if(!empty($_SESSION['username'])){  
    $twitteroauth = new TwitterOAuth('3LUB6YoqtNAsjQ5u6ImcQ', 'TFnWIhN57Gc3HBKiu1ddngo8vTBTgBBN7hAU8Sy4', $_SESSION['oauth_token'], $_SESSION['oauth_secret']);  
}*/ 
$direct_messages = $twitteroauth->get('direct_messages');
echo "Message from: " . $direct_messages[0]->sender->name . ".";
echo "</br>";
echo "Sent on: " . $direct_messages[0]->sender->created_at . ".";
echo "</br>";
echo $direct_messages[0]->text;





?>