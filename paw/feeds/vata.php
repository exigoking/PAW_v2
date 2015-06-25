<?php
function json($from,$message,$time,$subject,$difference_array)
{
    //echo "arrivals are". $from . $time . $subject . "</br>";
    //echo "starting json </br>";


	$data = array(
    (object)array(
		'sender' => $from,
		'message' => $message,
		'timestamp' => $time,
        'subject' => $subject
    ),

);
	$json_new = json_encode($data);

	$result = file_get_contents('gmail.json');


        //echo "starting to decode existing json </br>";
        $difference = "";
		$i = 0;//0 means newest

         if(!empty($result))
          {
                    $prev_messages_decoded = json_decode($result);
                        if($prev_messages_decoded[0]->timestamp != $data[$i]->timestamp)
                        {


                            if($prev_messages_decoded[0]->timestamp > $data[$i]->timestamp)
                            {
                            $difference = $data[$i]->message;
                            //array_push($difference_array,$data[i]);
                            createJason($data);
                           // echo $data[$i]->message;
                            //file_put_contents("gmail.json",$json_new);
                            }
                            else
                            {
                                    $difference = $data[$i]->message;
                                    createJason($data);
                                    //array_push($difference_array,$data[i]);

                                    //file_put_contents("gmail.json",$json_new);
                            }

                        }

                        else
                        {
                            //echo "no more new messages </br>";
                            return 3;
                        }

          }

           else
           {
           $difference = $data[$i]->message;
           createJason($data);
           //array_push($difference_array,$data[i]);
           file_put_contents("gmail.json",$json_new);
           //echo $data[$i]->message;
           }

            //echo $difference;
  }



function createJason($ne_json)
{

    echo "{\"sender\":"."\"".$ne_json[0]->sender."\"}";//.","."\"message\":"."\"".$ne_json[0]->message."\"}";

}

?>