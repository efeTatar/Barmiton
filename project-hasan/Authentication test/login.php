<?php
    session_start();
    include "tablewise_functions.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $match = check_credentials($username, $password);

    if($match == 1){
        $_SESSION["username"] = $username;
        header("Location:logged.php");
    }
    else{
        header("Location:main.php");
    }

?>