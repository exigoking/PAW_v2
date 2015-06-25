<?php
require 'encoding_check.php';
require 'attachment_check.php';

function type_checker($stream,$structure,$msg,$email_id)
{
    if($structure->type === 0)
    {
        //echo "This is a text message </br>";
       return Encoding_check($structure, $msg);
    }
    else if($structure->type === 1)
    {
        //echo "This is a multipart message </br>";
        $index_html_plain = 1;

        $num_parts = count($structure->parts);
        //echo "It has " .$num_parts. " part(s) </br>";
        extract_attachments($stream, $email_id, $structure);
        foreach ($structure->parts as $parts)
        {
            if ($parts->parts)
            {
               // echo "there are more parts inside </br>";
               // extract_attachments($stream, $email_id, $structure);
            }
            else
            {
                //echo "only 1 part... printing </br>"; however, this part might be an attachment
                //extract_attachments($stream, $email_id, $structure);
                if($parts->subtype == 'HTML')
                {
                   // echo "main part is in html </br>";
                    if($parts->type == 0)
                    {
                        $index_html_plain = 0;
                        $msg = imap_fetchbody($stream,$email_id,"2");
                        return Encoding_check ($parts, $msg);

                    }
                }
                else if ($parts->subtype == 'PLAIN')
                {
                    if($index_html_plain != 1)
                    {
                       // echo "main part is in PLAIN </br>";
                        $msg = imap_fetchbody($stream,$email_id,"2");
                        return Encoding_check ($parts, $msg);
                    }
                }
                else
                {
                    //will come back to this later, very rare case when pdf is embedded into email body
                    //let's do attachments
                    //echo "subtype is unknown " . (string)$parts->subtype. " and type is". (string)$parts->type. "</br>";
                    //$msg = imap_fetchbody($stream,$email_id,"2");
                    //return Encoding_check ($parts, $msg);
                }

            }

        }
    }
    else if ($structure->type === 2) {
       // echo "This is a message </br>";
    } else if ($structure->type === 3) {
        //echo "This is an application </br>";
    } else if ($structure->type === 4) {
        //echo "This is an audio </br>";
    } else if ($structure->type === 5) {
        //echo "This is an image </br>";
    } else if ($structure->type === 6) {
        //echo "This is a video </br>";
    } else if ($structure->type === 7) {
        //echo "This is a other </br>";
    }
}

?>
