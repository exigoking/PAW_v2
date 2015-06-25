<?php
function facebookMessages($inbox,$me)
{    		
    //This script will output the content of the message, timestamp and the fb user who sent the message
    //This script directly uses an inbox array from facebook Graph API
    for($i = 0 ; $i<1; $i++) 
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
				echo "There are " . $personsCount . " persons in this conversation." . "</br>";
			}
		else
			{
				echo "There is " . $personsCount . " person in this conversation." . "</br>";
			}
		
		for($j = 0; $j<100; $j++)
        {
			
			if ($personsCount > 1)
				{
				
            	if ($inbox['data'][$i]['comments']['data'][$j] == NULL)
                 	{
					 //Will print a last message sent OR received by the user
					 //To print a last message that was only RECEIVED by the user
					 //We need to compare 'name' of the user and 'name' of the sender
					 //So that we do not print last message SENT by the user
					 while ($inbox['data'][$i]['comments']['data'][$j-1]['from']['name'] == $me['name'])
					 		{
								$j--;
							}
				 	 echo "The message is from " . $inbox['data'][$i]['comments']['data'][$j-1]['from']['name'] . "!";
                 	 echo "</br>";
                 	 echo "Sent on: " . $inbox['data'][$i]['comments']['data'][$j-1]['created_time'] . ".";
                  	 echo "</br>";
                  	 echo $inbox['data'][$i]['comments']['data'][$j-1]['message']; 
                  	 echo "</br>";
                       //The loop will break when reach the last message presented by Graph API
                 	 break;
                	}
        
				}
			else 
				{
					if ($inbox['data'][$i]['comments']['data'][$j] == NULL)
                 	{
				 	 echo "The message is from " . $inbox['data'][$i]['comments']['data'][$j-1]['from']['name'] . "!";
                 	 echo "</br>";
                 	 echo "Sent on: " . $inbox['data'][$i]['comments']['data'][$j-1]['created_time'] . ".";
                  	 echo "</br>";
                  	 echo $inbox['data'][$i]['comments']['data'][$j-1]['message']; 
                  	 echo "</br>";
                       //The loop will break when reach the last message presented by Graph API
                 	 break;
                	}
                
				}	
        }
    }
}  

