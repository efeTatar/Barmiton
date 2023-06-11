<?php

    include "../../libraries/hn-standard-library.php";

    $user_id = $_POST["user_id"];

    session_start();

    if(check_adminship($_SESSION["user_id"]) != 0){
        header("Location:../../content/home-page.php");
        exit();
    }

    if($user_id == 100001){
        header("Location:../../content/admin-console-users.php");
        exit();
    }

    if(check_adminship($user_id) == 0 && $_SESSION["user_id"] != 100001)
    {
        header("Location:../../content/admin-console-users.php");
        exit();
    }

    if(user_destroy($user_id) == 0)
    {
        header("Location:../../content/admin-console-users.php");
        exit();
    }
    else
    {
        header("Location:../../content/admin-console-users.php");
        exit();
    }

?>