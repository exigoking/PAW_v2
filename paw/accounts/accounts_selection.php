<html>
	<head>
    	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<title>PAW</title>
		<link href="accounts_selection.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>
		<script type="text/javascript" src="accounts_selection.js"></script>
    </head>
	<body>
		
		<?php
		//FACEBOOK ACCOUNT MANAGEMENT
		include './facebook/facebook.php';
		include './facebook/facebookMessages.php';
		/**
		 * @author Timur Malgazhdarov
		 * @copyright 2013
		 */
		require_once('./facebook/config.php');
		$username = 'TimurMalgazhdar';
		$config = array('appId'=>'645818095470152',
                'secret'=>'2492bdbca01c45075450c9256d423e60');
		$facebook = new Facebook($config);
		
		/*Connecting to the database*/
		mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
		mysql_select_db('paw');
		/*Finding user's twitter oauth tokens and secrets in database if they exist*/
		$query = mysql_query("SELECT * FROM facebook_users WHERE oauth_provider = 'facebook' AND username = '". $username . "'");   
		$result_fb = mysql_fetch_array($query);
		
		if(!empty($result_fb)){
			$facebook->setAccessToken($result_fb['oauth_token']);	
			$facebook->setExtendedAccessToken();
			$logout_url = 'http://localhost/paw/accounts/facebook/remove.php';
			echo "<div class=\"authorized\" id=\"facebook_approved\"><input type='image' src='./pics/Facebook.jpg' class='provider' id='facebook'/></div><div class='link' id='facebook_auth'> <a href='" . $logout_url . "'>Remove Facebook Account</a> </div>";		
			
			
		}
		else{
			$params = array(
	  							'scope' => 'read_mailbox, offline_access',
	  							'redirect_uri' => 'http://localhost/facebook/callback.php'
								);
				
	        $login_url = $facebook->getLoginUrl($params);
			echo "<div><input type='image' src='./pics/Facebook.jpg' class='provider' id='facebook'/>
		
		<div class='link' id='facebook_auth'> <a href='" . $login_url . "'>Add Facebook Account</a></div></div>";
	       // echo '<a href="' . $login_url . '">Authorize on Facebook</a>';
		}
		?>
		
		<?php
		//TWITTER ACCOUNT MANAGEMENT
		/**
		 * @author Timur Malgazhdarov
		 * @copyright 2013
		 */
		/*Here will ask for username*/
		$username = 'TimurMalgazhdar';
		require_once('./twitter/twitteroauth.php');
		require_once('./twitter/config.php');
		/*Connecting to the database*/
		mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
		mysql_select_db('paw');

		/*Finding user's twitter oauth tokens and secrets in database if they exist*/
		$query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'twitter' AND username = '". $username . "'");  
		$result_tw = mysql_fetch_array($query);

		if(!empty($result_tw)){
				$_SESSION['access_token']['oauth_token'] = $result_tw['oauth_token']; 
			    $_SESSION['access_token']['oauth_token_secret'] = $result_tw['oauth_secret'];
				$access_token = $_SESSION['access_token'];
				$logout_url = 'http://localhost/paw/accounts/twitter/remove.php';
				echo "<div class='authorized'><input type='image' src='./pics/twitter-logo.png' class='provider' id='twitter'/></div>
				<div class='link' id='twitter_auth'> <a href='".$logout_url."'> Remove Twitter Account </a> </div>";
				 
		}
		else{
			echo "<div><input type='image' src='./pics/twitter-logo.png' class='provider' id='twitter'/>
		<div class='link' id='twitter_auth'> <a href='http://127.0.0.1/paw/accounts/twitter/redirect.php'> Add Twitter Account </a> </div></div>";
		}
		?>
		
		<?php
		//GMAIL ACCOUNT MANAGEMENT
		/**
		 * @author Timur Malgazhdarov
		 * @copyright 2013
		 */
			$username = 'TimurMalgazhdar';
			require_once('./twitter/config.php');
			/*Connecting to the database*/
			mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
			mysql_select_db('paw');
			/*Finding user's twitter oauth tokens and secrets in database if they exist*/
			$query = mysql_query("SELECT * FROM gmail_users WHERE username = '". $username . "'");  
			$result_gm = mysql_fetch_array($query);
			if(!empty($result_gm)){
				$logout_url = 'http://localhost/paw/accounts/gmail/remove.php';
				echo "<div class='authorized'><input type='image' src='./pics/gmail-logo.png' class='provider' id='gmail'/></div>
				<div class='link' id='login'> <a href='".$logout_url."'> Remove Gmail Account </a> </div>";
			}
			else{
				echo "<input type='image' src='./pics/gmail-logo.png' class='provider' id='gmail'/>
		<div class='link' id='gmail_auth'><div id ='enclose'>
		<form id='login' action='./gmail/store_credentials.php' method='post' accept-charset='UTF-8' style='width:20%'>

		<fieldset>


		<legend>Login</legend>
		<div>
   		 <p> Please enter gmail name and password </p>
		<input type='hidden' name='submitted' id='submitted' value='1'/>
		<label for='username' >GMail_ID*:</label>
		<input type='text' name='username' id='username'  maxlength='50' Required/>
		</div>

		<div>
		<label for='password' >Password*:</label>
		<input type='password' name='password' id='password' maxlength='50' Required/>
		<input type='submit' name='Submit' value='Submit' />
 		</div>
		</div></div>";
		}

		
		
			//echo "<div><input type='image' src='./pics/gmail-logo.png' class='provider' id='gmail'/></div>";
		?>
		
		
		<?php
			echo "<a href='http://localhost/paw/feeds/feeds.php'><img src='./pics/logo.png' class='logo'/></a>
			<div id='enter_text'>Enter</div>";
		?>
		
		
		
		
	</body>





</html>
