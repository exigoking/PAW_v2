<?php
//require("twitter_temp.php");

//twitterDatabase.php
//This script is to store user's info obtained in twitter_temp,php
//in the database. First it will check whether the user exists in 
//the database and then add/update user's info accordingly.

function twitterDatabase($user_info)
{
	
//Connecting to the database
mysql_connect('localhost', 'root', 'OtanisKZ');  
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
} 
$home_timeline = $twitteroauth->get('statuses/home_timeline');  
print_r($home_timeline); 


}

?>