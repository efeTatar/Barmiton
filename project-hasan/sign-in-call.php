<?php

    include "libraries/hn-user-moderation.php";

    session_start();
    if ($_SESSION["username"]){
        header("Location:index.php");
        exit();
    }

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if(check_credentials($username, $password) == 0)
    {
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["user_id"] = fetch_user_id($username);
        header("Location:index.php");
    }
    else
    {
        header("Location:index.php");
    }
?>