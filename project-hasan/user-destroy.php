<?php

    include "libraries/hn-user-moderation.php";

    $user_id = $_POST["user_id"];

    session_start();

    if(check_adminship($_SESSION["user_id"]) == 1){
        header("Location:profile-page.php");
        exit();
    }

    if($user_id == 100001){
        header("Location:index.php");
        exit();
    }

    if(check_adminship($user_id) == 0 && $_SESSION["user_id"] != 100001)
    {
        header("Location:admin-console.php");
        exit();
    }

    if(user_destroy($user_id) == 0)
    {
        header("Location:admin-console.php");
        exit();
    }
    else
    {
        header("Location:admin-console.php");
        exit();
    }
?>