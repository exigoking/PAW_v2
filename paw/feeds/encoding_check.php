<?php
function Encoding_check($structure,$msg)
{
    if($structure->encoding == 3)
        {
            //echo "encoding type is 3 </br>";
            /*$msg= "<div>" .base64_decode($msg). "</div>";
            echo "$msg </br>";*/
         return  print_msg_content(base64_decode($msg));
        }
   else if ($structure -> encoding == 4)
        {
           // echo "encoding type is 4 </br>";
           // $msg = "<div>" .quoted_printable_decode($msg). "</div>";
            //$text = imap_utf7_decode($text);
            //echo "$msg </br></br>";
           return print_msg_content(quoted_printable_decode($msg));
        }
   else if ($structure->encoding == 0)
        {
            //echo "encoding type is 0 </br>";
            //$text = decode7Bit($text);
           // echo "<div>" .$msg. "</div></br>";
      return print_msg_content($msg);
         }
   else if ($structure->encoding == 1)
        {
           // echo "encoding type is 1 </br>";
            /*echo "<div>" .$msg. "</div></br>";*/
    return print_msg_content($msg);
        }
   else
         {
       echo "Some other encoding format of type " .$structure->encoding . "</br>";
         }

}

function print_msg_content ($data)
{
    $message = $data;
    return $message;
}

?>
