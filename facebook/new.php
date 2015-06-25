<?php

class User {
    
    public function authorization(){
        echo "I am authorized!";
        echo "<br/>";
    }
}

$new_user = new User();

$new_user->authorization();


?>