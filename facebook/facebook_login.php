<?php

facebook_login();

function facebook_login(){
$username = 'exigoking@gmail.com';
$password = 'IloveAU5';
$loginUrl = 'https://www.facebook.com/login.php';
 
//init curl
/*$ch = curl_init($loginUrl);

curl_setopt($ch, CURLOPT_USERPWD, $username.":".password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);

echo $result;*/
//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.facebook.com/login.php');
curl_setopt($ch, CURLOPT_POSTFIELDS,'email='.urlencode($username).'&pass='.urlencode($password).'&login=Login');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.57 Safari/537.36");

$result = curl_exec($ch);

// Find all links 


curl_setopt($ch, CURLOPT_URL, 'https://facebook.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.57 Safari/537.36");

$result2 = curl_exec($ch);

echo $result2;


//echo $result;

//echo "done";

}






?>