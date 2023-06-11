<?php

    include "../../libraries/hn-standard-library.php";

    session_start();

    if (!isset($_SESSION["username"]) )
    {
        header("Location:../../content/home-page.php");
        exit();
    }

    if($_SESSION["user_id"] == 100001){
        header("Location:../../content/profile-page.php");
        exit();
    }

    if(user_destroy($_SESSION["user_id"]) == 0)
    {
        header("Location:sign-out-request.php");
        exit();
    }
    else
    {
        header("Location:sign-out-request.php");
        exit();
    }

?>