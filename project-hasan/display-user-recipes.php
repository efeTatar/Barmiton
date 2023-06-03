<?php

    include "libraries/hn-user-moderation.php";
    include "libraries/hn-recipe-moderation.php";

    session_start();
    if (!(session_status() == PHP_SESSION_ACTIVE && $_SESSION["username"] != "")){
        header("Location:index.php");
    }

    $user_id = fetch_user_id($_SESSION["username"]);
    display_user_recipes($user_id);
?>