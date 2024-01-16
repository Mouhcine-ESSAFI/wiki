<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $newUser = new User($_POST["email"], null, $_POST["password"]);
        $response = $newUser->login();
        echo $response;
                die();
    }
?>