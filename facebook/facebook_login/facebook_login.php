<?php
$username = 'exigoking@gmail.com';
$password = 'IloveAU5';
$loginUrl = 'https://www.facebook.com/login.php';
 
//init curl
/*$ch = curl_init($loginUrl);

curl_setopt($ch, CURLOPT_USERPWD, $username.":".password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);

echo $result;*/

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
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");

$result = curl_exec($ch);


echo $result;

echo "done";
//the login is now done and you can continue to get the
//protected content.
 
//set the URL to the protected file
//curl_setopt($ch, CURLOPT_URL, 'http://www.example.com/protected/download.zip');
 
//execute the request
//$content = curl_exec($ch);
 
//save the data to disk
//file_put_contents('~/download.zip', $content);







?>