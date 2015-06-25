<!doctype html>
<html lang="en">
<head>
<!--
  <meta charset="utf-8">
-->
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

  <title> GMail inbox </title>
    <script src = "Javascript/jquery-1.10.2.js"></script>
     <script src = "Javascript/testscript.js"></script>
    <!-- <link rel="stylesheet" href="css/hide_show.css" type="text/css"/>-->

</head>
<body>

    <div id ="omg">
            <?php
            require 'type_checker.php';
            require 'vata.php';
            search();

            ?>
    </div>
    </body>
</html>

<?php
require 'type_checker.php';
require 'vata.php';
//search();
//require 'encoding_check.php';
/* connect to gmail */
// Need to wrap everything inside some tag so that clicking will trigger appearance of div field
// It implies that I need to wrap every message into div tag or say <p> tags
function search()
{
  //  echo "Connecting to Gmail... </br>";
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = (string)trim($_POST['username']);
$password = (string)trim($_POST['password']);
//open connection to Gmail
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
$difference_array = array();
// set the email_limit to show
$email_show_limit = 0;
$limit = 5;

//start searching inside the mailbox
$emails = imap_search($inbox,'ALL');
    if(emails)
    {
        //rsort puts latest emails on top
        rsort($emails);
        //echo "[";
        foreach($emails as $email_number)
        {
            if($email_show_limit === $limit)
           {
               // echo "]";
                return ;
           }
            //get specifics of email,i.e. subject,from,date,etc
            $overview = imap_fetch_overview($inbox, $email_number,0);
            $subject =  "Subject:" .$overview[0]->subject;
            $from =  "From:" .$overview[0]->from;
            $date = "Date:". $overview[0]->date;

            // get the structure of particular email
            $msg_struct = imap_fetchstructure($inbox,$email_number);

            //get the text part of the message
            $text = imap_body($inbox,$email_number);
            $time = strtotime($overview[0]->date);
            ///echo $overview[0]->date. " and ".$time ."and". date('l m'). "</br>";
            //$date = "Mon, 05 Dec 2005 16:38:22";
            $time =  date("U", $time);

            //type_checker($inbox,$msg_struct,$text,$email_number);
            // So we get every message separately , which is good

           $result = type_checker($inbox,$msg_struct,$text,$email_number);
           $print = $result;

           //$msg = "<div class = \"msg\">". $print. "</div>";
           $output = "<div class = \"selected\">" .$print. "</div>";
           $combine = "<div class = \"info\">".$from. "</br>" .$subject."</br>".$date."</br>". $output. "</br><div>";

           echo $combine;
           // $enough = json($from,$print,$time,$subject,$difference_array);
               // if($enough == 3){
//
               // return;}

               // if($email_show_limit != $limit -1)
                   // echo ",";

           //echo $print;
           //



            $email_show_limit++;

       }

       /*for($i = 0; $i< limit;$i++ )
       {
            echo json_encode($difference_array);
       }*/
    }

//close stream
imap_close($inbox);
}
?>
