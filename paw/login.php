<html>
	<head>
    	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<title>PAW</title>
		<link href="login.css" rel="stylesheet">
    </head>
	<body>
		<div id="login_box">
		<form action="login.php" method="post">
    		Name:  <input type="text" name="username" /><br />
    		Password: <input type="text" name="password" /><br />
    	<input type="submit" name="login" value="Log In" id="b_1"/>
		</form>
		</div>
<?php

/*
Author: Timur Malgazhdarov
Copyright 2014
*/
//Check the database for the user
if(!empty($_POST)){
echo 'Hello ' . $_POST["username"] . '!';
}
?>
	</body>
</html>