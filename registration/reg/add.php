<?php

require_once('config.php');
/*Connecting to the database*/
mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
mysql_select_db('paw');


//This code runs if the form has been submitted
if (isset($_POST['submit'])) {
    //This makes sure they did not leave any fields blank
    if (!$_POST['username'] | !$_POST['pass']) {

        die('You did not complete all of the required fields');
    }


    // checks if the username is in use
    if (!get_magic_quotes_gpc()) {
        $_POST['username'] = addslashes($_POST['username']);
    }

    $usercheck = $_POST['username'];
    $check = mysql_query("SELECT username FROM reg WHERE username = '$usercheck'") or die(mysql_error());

    $check2 = mysql_num_rows($check);



    //if the name exists it gives an error

    if ($check2 != 0) {
        echo "</div class = \"regis\"> 'Sorry, the username ' " . $_POST['username'] ."' is already in use. '" . "</div>";
        die();

    }


    // this makes sure both passwords entered match
    /*if ($_POST['pass'] != $_POST['pass2']) {
        die('Your passwords did not match. ');
    }*/



    // here we encrypt the password and add slashes if needed
    $_POST['pass'] = md5($_POST['pass']);
    if (!get_magic_quotes_gpc()) {
        $_POST['pass'] = addslashes($_POST['pass']);
        $_POST['username'] = addslashes($_POST['username']);
    }

    // now we insert it into the database
    $insert = "INSERT INTO reg (username, password)
 			VALUES ('" . $_POST['username'] . "', '" . $_POST['pass'] . "')";
    $add_member = mysql_query($insert);



    echo "<div id = \"reg_complete\">  Registered </br></br> Thank you, you have registered -
        you may now login </div></body></html>";

    }
 ?>



<html>
    <head>
        <title> Registration </title>
        <script src="../../Javascript/jquery-1.10.2.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
        <script src ="../../Javascript/index_page_toggle.js"></script>
        <link rel="stylesheet" href="./css/stylize.css" type="text/css"/>
    </head>
    <body>

        <img class = "logo" src = "./images/logo.png" alt = "wallpaper" />

<p class = "site_name"> P.A.W. </p>
        <div class = "slogan" >

            <p class= "motto"> Register,Login,Enjoy </br></br> Integrate all messages into one place </p>
        </div>

<div id = "switch_reg" style = "top:300px;
    right:280px;position:fixed;">
    <label>
    <span>&nbsp;</span>
    <input type="submit" class = "button" name ="submit" value="Register" />
    </label>
</div>


<div id = "switch_sign" style = "
    right:490px;position:fixed;">
    <label>
    <span>&nbsp;</span>
    <input type="submit" class = "button" name = "submit1" value="Sign-in" />
    </label>
</div>



 <div class = "atoggler">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="smart-green">
            <h1>Registration Form
                <span>Please fill all the texts in the fields.</span>
            </h1>


            <label>
                <span>Your Email :</span>
                <input id="email" type="email" name="username" placeholder="Valid Email Address" Required/>
            </label>

            <label>
                <span> password :</span>
                <input type='password' name='pass' id='password' maxlength="50" placeholder="Your Password" Required />
            </label>

            <label>
                <span>&nbsp;</span>
                <input type="submit" class = "button" name ="submit" value="Register" />
            </label>
        </form>
</div>

 <div class = "btoggler">
         <form action="login.php" method="post" class="smart-green">
            <h1> Sign-in
                <span>Please fill all the texts in the fields.</span>
            </h1>


            <label>
                <span>Your Email :</span>
                <input id="email" type="email" name="username" placeholder="Valid Email Address" Required/>
            </label>

            <label>
                <span> password :</span>
                <input type='password' name='pass' id='password' maxlength="50" placeholder="Your Password" Required />
            </label>

            <label>
                <span>&nbsp;</span>
                <input type="submit" class = "button" name ="submit" value="Sign-in" />
            </label>
        </form>
     </div>
    </body>
    </html>

