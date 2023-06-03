<?php

    include "tablewise_functions.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];

    $match = add_user_credentials($username, $password, $name, $surname);
    
    if($match == 1) header("Location:main.php");
    else header("Location:main.php");

?>