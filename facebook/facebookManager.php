<?php

//require_once('config.php');
function facebookManager($inbox,$me)
{    		
	require_once('config.php');
	/*Connecting to the database*/
	mysql_connect(SERVER, DB_USERNAME, DB_PASSWORD);  
	mysql_select_db('paw');
	$username = "TimurMalgazhdar";
	//This script will output the content of the message, timestamp and the fb user who sent the message
    //This script directly uses an inbox array from facebook Graph API
	$facebook_messages = array();
    for($i = 0 ; $i<5; $i++) 
    {   
		//Counting number of persons in a conversation
		$personsCount = 0;
		while($inbox['data'][$i]['to']['data'][$personsCount] != NULL)
        	{
				$personsCount++;
			}
		//Print information about how many people are in a conversation
		//The number of persons is NEEDED to print RECEIVED messages only
		if ($personsCount > 1)
			{
				//echo "There are " . $personsCount . " persons in this conversation." . "</br>";
			}
		else
			{
				//echo "There is " . $personsCount . " person in this conversation." . "</br>";
			}
		
		$j = 0;
		
        while($inbox['data'][$i]['comments']['data'][$j] != NULL)
            {
				if ($personsCount > 1)
					{
						//Get only received messages
						if($inbox['data'][$i]['comments']['data'][$j]['from']['name'] == $me['name']){
							$j++;
							//echo "skipped</br>";
						}
						else{
							//$now = new DateTime();
							//$current_timestamp = $now->getTimestamp();
							$facebookTime = $inbox['data'][$i]['comments']['data'][$j]['created_time'];
							$timestamp = strtotime($facebookTime);
							//echo $timestamp."</br>";
							$provider = "facebook";
							$peopleCount = $personsCount;
							$message = $inbox['data'][$i]['comments']['data'][$j]['message'];
							$message_id = $inbox['data'][$i]['comments']['data'][$j]['id'];
							$conversation_id = $inbox['data'][$i]['id'];
							$sender_name = $inbox['data'][$i]['comments']['data'][$j]['from']['name'];
							$string = $conversation_id."|".$peopleCount."|".$message_id."|".$sender_name."|".$message."|".$timestamp."|".$provider;
							//$key = $current_timestamp - $timestamp;
							//$new_key = intval($timestamp);
							array_push($facebook_messages, $string);
							$j++;
								
							}
						
						
								
            		}
				else 
					{
						//Get only received messages
						if($inbox['data'][$i]['comments']['data'][$j]['from']['name'] == $me['name']){
							//$j++;
							//echo "skipped</br>";
							$facebookTime = $inbox['data'][$i]['comments']['data'][$j]['created_time'];
							$timestamp = strtotime($facebookTime);
							//echo $timestamp."</br>";
							$provider = "facebook";
							$peopleCount = $personsCount;
							$message = $inbox['data'][$i]['comments']['data'][$j]['message'];
							$message_id = $inbox['data'][$i]['comments']['data'][$j]['id'];
							$conversation_id = $inbox['data'][$i]['id'];
							$sender_name = $inbox['data'][$i]['comments']['data'][$j]['from']['name'];
							$string = $conversation_id."|".$peopleCount."|".$message_id."|".$sender_name."|".$message."|".$timestamp."|".$provider;
							//$key = $current_timestamp - $timestamp;
							//$new_key = intval($timestamp);
							array_push($facebook_messages, $string);
							$j++;
							
						}
						else{
							$j++;
						}
						
							
					}
    
			}
        
    }
	$result = quick_sort($facebook_messages);
	$reversed = array_reverse($result);
	//for($i = 0; $i < count($result); $i++){
	//	echo $reversed[$i]." </br>";
		
	//}
	$strings_to_db = array_slice($reversed,0,10,true);
	$m1 = $strings_to_db[0];
	$m2 = $strings_to_db[1];
	$m3 = $strings_to_db[2];
	$m4 = $strings_to_db[3];
	$m5 = $strings_to_db[4];
	$m6 = $strings_to_db[5];
	$m7 = $strings_to_db[6];
	$m8 = $strings_to_db[7];
	$m9 = $strings_to_db[8];
	$m10 = $strings_to_db[9];
	//Creating JSON String
	$substr_m1 = explode("|",$m1);
	$substr_m2 = explode("|",$m2);
	$substr_m3 = explode("|",$m3);
	$substr_m4 = explode("|",$m4);
	$substr_m5 = explode("|",$m5);
	$substr_m6 = explode("|",$m6);
	$substr_m7 = explode("|",$m7);
	$substr_m8 = explode("|",$m8);
	$substr_m9 = explode("|",$m9);
	$substr_m10 = explode("|",$m10);
	$data = array(
    (object)array(
        'conv_id' => $substr_m1[0],
        'people_count' => $substr_m1[1],
		'message_id' => $substr_m1[2],
		'sender_name' => $substr_m1[3],
		'message' => $substr_m1[4],
		'timestamp' => $substr_m1[5],
		'provider' => $substr_m1[6]
    ),
    (object)array(
        'conv_id' => $substr_m2[0],
        'people_count' => $substr_m2[1],
		'message_id' => $substr_m2[2],
		'sender_name' => $substr_m2[3],
		'message' => $substr_m2[4],
		'timestamp' => $substr_m2[5],
		'provider' => $substr_m2[6]
    ),
	(object)array(
        'conv_id' => $substr_m3[0],
        'people_count' => $substr_m3[1],
		'message_id' => $substr_m3[2],
		'sender_name' => $substr_m3[3],
		'message' => $substr_m3[4],
		'timestamp' => $substr_m3[5],
		'provider' => $substr_m3[6]
    ),
	(object)array(
        'conv_id' => $substr_m4[0],
        'people_count' => $substr_m4[1],
		'message_id' => $substr_m4[2],
		'sender_name' => $substr_m4[3],
		'message' => $substr_m4[4],
		'timestamp' => $substr_m4[5],
		'provider' => $substr_m4[6]
    ),
	(object)array(
        'conv_id' => $substr_m5[0],
        'people_count' => $substr_m5[1],
		'message_id' => $substr_m5[2],
		'sender_name' => $substr_m5[3],
		'message' => $substr_m5[4],
		'timestamp' => $substr_m5[5],
		'provider' => $substr_m5[6]
    ),
	(object)array(
        'conv_id' => $substr_m6[0],
        'people_count' => $substr_m6[1],
		'message_id' => $substr_m6[2],
		'sender_name' => $substr_m6[3],
		'message' => $substr_m6[4],
		'timestamp' => $substr_m6[5],
		'provider' => $substr_m6[6]
    ),
	(object)array(
        'conv_id' => $substr_m7[0],
        'people_count' => $substr_m7[1],
		'message_id' => $substr_m7[2],
		'sender_name' => $substr_m7[3],
		'message' => $substr_m7[4],
		'timestamp' => $substr_m7[5],
		'provider' => $substr_m7[6]
    ),
	(object)array(
        'conv_id' => $substr_m8[0],
        'people_count' => $substr_m8[1],
		'message_id' => $substr_m8[2],
		'sender_name' => $substr_m8[3],
		'message' => $substr_m8[4],
		'timestamp' => $substr_m8[5],
		'provider' => $substr_m8[6]
    ),
	(object)array(
        'conv_id' => $substr_m9[0],
        'people_count' => $substr_m9[1],
		'message_id' => $substr_m9[2],
		'sender_name' => $substr_m9[3],
		'message' => $substr_m9[4],
		'timestamp' => $substr_m9[5],
		'provider' => $substr_m9[6]
    ),
	(object)array(
        'conv_id' => $substr_m10[0],
        'people_count' => $substr_m10[1],
		'message_id' => $substr_m10[2],
		'sender_name' => $substr_m10[3],
		'message' => $substr_m10[4],
		'timestamp' => $substr_m10[5],
		'provider' => $substr_m10[6]
    ),
);
	//var_dump($data);
	$json_new = json_encode($data);
	/*Finding user's twitter oauth tokens and secrets in database if they exist*/
	//$query = mysql_query("SELECT * FROM facebook_messages WHERE	username = '". $username . "'");   
	//$result = mysql_fetch_array($query);
	$result = file_get_contents('facebook_messages.json');
	$difference_array = array();
	if(!empty($result)){
		$new_messages = $strings_to_db;
		$difference_array = array();
		$prev_messages_decoded = json_decode($result);
		//$substr_prev = explode("|",$prev_messages['m1']);
		//$prev_message_id = $substr_prev[2];
		$i = 0;
		while($prev_messages_decoded[0]->message_id != $data[$i]->message_id)
		{
			$i++;
			//echo $prev_decoded[0]->id_str . "=" . $home_timeline[$i]->id_str . "</br>";
			//If will reach the end of the twitter package
			if($data[$i]->message_id==NULL)
			{
				break;
			}
			
		}
		for ($j = $i; $j>=0;$j--)
		{
		array_push($difference_array, $data[$j-1]);
		}
		/*$query_one = mysql_query("INSERT INTO facebook_messages (message_one, message_two, message_three, message_four, message_five, message_six, message_seven, message_eight, message_nine, message_ten, username) VALUES ('{$m1}', '{$m2}', '{$m3}', '{$m4}', '{$m5}', '{$m6}', '{$m7}', '{$m8}', '{$m9}', '{$m10}', '{$username}')"); 
		 */
		file_put_contents("facebook_messages.json",$json_new);
		 
	}
	else{
	//echo "</br> Inserting into database!";
	file_put_contents("facebook_messages.json",$json_new);
	/*$query_one = mysql_query("INSERT INTO facebook_messages (message_one) VALUES ({$m1})") or die(mysql_error());
	//$query = mysql_query("INSERT INTO facebook_messages (message_one, message_two, message_three, message_four, message_five, message_six, message_seven, message_eight, message_nine, message_ten, username) VALUES ('{$m1}', '{$m2}', '{$m3}', '{$m4}', '{$m5}', '{$m6}', '{$m7}', '{$m8}', '{$m9}', '{$m10}', '{$username}')");*/  
	$difference_array = array_reverse($data);
	}
	
	return $difference_array;
		
	
		
}  

function quick_sort($array)
{
	// find array size
	$length = count($array);
	
	// base case test, if array of length 0 then just return array to caller
	if($length <= 1){
		return $array;
	}
	else{
	
		// select an item to act as our pivot point, since list is unsorted first position is easiest
		$substr = explode("|",$array[0]);
		$pivot = $substr[5];
		
		// declare our two arrays to act as partitions
		$left = $right = array();
		
		// loop and compare each item in the array to the pivot value, place item in appropriate partition
		for($i = 1; $i < count($array); $i++)
		{
			$substr = explode("|",$array[$i]);
			if($substr[5] < $pivot){
				$left[] = $array[$i];
			}
			else{
				$right[] = $array[$i];
			}
		}
		
		// use recursion to now sort the left and right lists
		return array_merge(quick_sort($left), array($array[0]), quick_sort($right));
	}
}