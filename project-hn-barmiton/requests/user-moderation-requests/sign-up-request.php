<?php

    include "../../libraries/hn-standard-library.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];

    if(user_log($username, $password, $name, $surname, array(1, 1, 0)) == 0) header("Location:../../content/sign-in-form.php");

    else header("Location:../../index.php");
?>