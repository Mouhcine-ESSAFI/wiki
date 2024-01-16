<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $newUser = new User($_POST['name'], $_POST['email'], $_POST['password']);
    $result = $newUser->register();
    if($result){
        echo $result;
        die();
    }
}

?>