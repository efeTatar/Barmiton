<?php

    include "../../libraries/hn-standard-library.php";

    session_start();
    if ( isset($_SESSION["username"]) )
    {
        header("Location:../../content/home-page.php");
        exit();
    }

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if(check_credentials($username, $password) == 0)
    {
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["user_id"] = fetch_user_id($username);
        header("Location:../../content/home-page.php");
    }
    else
    {
        header("Location:../../content/sign-in-form.php?error");
    }
?>