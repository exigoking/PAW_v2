
<h2>Hello <?=(!empty($_SESSION['username']) ? '@' . $_SESSION['username'] : 'Guest'); ?></h2>  

<?php
require("twitteroauth.php");


if(!empty($_SESSION['username'])){  
    $twitteroauth = new TwitterOAuth('YOUR_CONSUMER_KEY', 'YOUR_CONSUMER_SECRET', $_SESSION['oauth_token'], $_SESSION['oauth_secret']);  
} 
$home_timeline = $twitteroauth->get('statuses/home_timeline');  
print_r($home_timeline); 
?>
