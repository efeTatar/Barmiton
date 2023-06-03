<?php

    include "tablewise_functions.php";

    $username = $_POST["username"];
    $result = delete_user_credentials($username);

    if($result == 1) header("Location:main.php");
    else header("Location:main.php");

?>