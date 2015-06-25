<?php

require_once('config.php');
/*Connecting to the database*/
mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
mysql_select_db('paw');


 //checks cookies to make sure they are logged in

 if(isset($_COOKIE['ID_my_site']))

 {

 	$username = $_COOKIE['ID_my_site'];

 	$pass = $_COOKIE['Key_my_site'];

 	 	$check = mysql_query("SELECT * FROM reg WHERE username = '$username'")or die(mysql_error());

 	while($info = mysql_fetch_array( $check ))

 		{



 //if the cookie has the wrong password, they are taken to the login page

 		if ($pass != $info['password'])

 			{ 			header("Location: add.php");

 			}



 //otherwise they are shown the admin area

 	else

 			{



 			}

 		}
        echo "Admin Area<p>";

        echo "Your Content<p>";

         echo "<a href=logout.php>Logout</a>";
		 header("Location: http://localhost/paw/accounts/accounts_selection.php");

 		}

 else



 //if the cookie does not exist, they are taken to the login screen

 {

 header("Location: add.php");

 }

 ?>
