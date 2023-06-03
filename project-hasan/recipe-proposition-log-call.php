<?php
    
    include "libraries/hn-recipe-moderation.php";

    session_start();
    if (!$_SESSION["username"]){
        header("Location:index.php");
        exit();
    }
    
    $title = $_POST["title"];
    $instructions = $_POST["instructions"];
    $user_id = fetch_user_id($_SESSION["username"]);

    if(check_adminship($user_id) == 0)
    {
        if(recipe_log(
            $_SESSION["user_id"],
            $title,
            $instructions
        ))
        {
            header("Location:index.php");
            exit;
        }
        else
        {
            header("Location:index.php");
            exit;
        }
    }

    if(recipe_proposition_log(
        $_SESSION["user_id"],
        $title,
        $instructions
    ))
    {
        header("Location:index.php");
    }
    else
    {
        header("Location:index.php");
    }

?>