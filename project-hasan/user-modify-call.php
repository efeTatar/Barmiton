<?php

    include "libraries/hn-user-moderation.php";

    $user_id = $_POST["user_id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];

    if(username_exist_check($username) == 0)
    {
        header("Location:user-modify-form.php?user_id=".$user_id);
        exit;
    }

    $result = user_credentials_modify($user_id, $username, $password, $name, $surname);

    if($result == 0){
        session_start();
        $_SESSION["username"] = $username;
    }

    if($result == 0){
        header("Location:user-modify-form.php?user_id=".$user_id);
        exit;
    }
    else{
        header("Location:user-modify-form.php?user_id=".$user_id);
        exit;
    }
?>