<?php

    include "libraries/hn-user-moderation.php";

    $user_id = $_POST["user_id"];

    session_start();

    if(!isset($_SESSION["user_id"]))
    {
        header("Location:profile-page.php");
        exit();
    }

    if(strcmp($_SESSION["user_id"], $user_id) != 0)
    {
        header("Location:profile-page.php");
        exit();
    }

    if($user_id == 100001){
        header("Location:index.php");
        exit();
    }

    if(user_destroy($user_id) == 0)
    {
        header("Location:sign-out-call.php");
        exit();
    }
    else
    {
        header("Location:index.php");
        exit();
    }
?>