<?php

function extract_attachments($connection, $message_number, $structureToExplore = null) {
   // echo "Extracting started </br>";
    $attachments = array();
    if ($structureToExplore != null)
        {
         $structure = $structureToExplore;
        }
    else
        {
        $structure = imap_fetchstructure($connection, $message_number);
        }


    $attachments = array();

    if (isset($structure->parts) && count($structure->parts))
        {
         //   echo "all parameters are set </br>";
            for ($i = 0; $i < count($structure->parts); $i++)
            {
                if ($structure->parts && count($structure->parts[$i]) > 0)
                {
                    $toAdd = extract_attachments($connection, $message_number, $structure->parts[$i]);
                    if (count($toAdd) > 0)
                    {
                    foreach ($toAdd as $att)
                        array_push($attachments, $att);
                    }
                }

            // here we get to the last node of the part and we check it for presence of
                // parameters and dparameters
            $attachment = array(
                'is_attachment' => false,
                'filename' => '',
                'name' => '',
                'attachment' => ''
            );

            if ($structure->parts[$i]->ifdparameters) {
              //echo "The original message contained attachments </br>";
                foreach ($structure->parts[$i]->dparameters as $object) {
                    if (strtolower($object->attribute) == 'filename') {
                        $attachment['is_attachment'] = true;
                        $attachment['filename'] = $object->value;
                        //<a href="http://localhost/MsgCollector/index.php" >Personal Assistant Website</a>

                       // $addr = "http://localhost/MsgCollector/gmail_inbox_get.php";
                        //echo "Name is <a href = \"". $addr. "\">". (string)$object->value. "</a></br>";
                        //echo "Name is ". (string)$object->value. "</br>";
                      //  $addr = pathinfo($structure->parts[$i]);
                       // echo "path is ". (string)$addr. "</br>";
                    }
                }
            }

            if ($structure->parts[$i]->ifparameters) {

                foreach ($structure->parts[$i]->parameters as $object) {
                    if (strtolower($object->attribute) == 'name') {
                        //echo "The original message contained attachments </br>";
                        $attachment['is_attachment'] = true;
                        $attachment['name'] = $object->value;
                        //echo "name is ". (string)$object->value. "</br>";
                    }
                }
            }

          /*  if ($attachment['is_attachment']) {
                $attachment['attachment'] = imap_fetchbody($connection, $message_number, $i + 1);

                if ($structure->parts[$i]->encoding == 3) { // 3 = BASE64
                    $attachment['attachment'] = base64_decode($attachment['attachment']);
                } elseif ($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                    $attachment['attachment'] = quoted_printable_decode($attachment['attachment']);
                }
            }*/

            array_push($attachments, $attachment);
        }
    }

    return $attachments;
}

?>