<?php

    include "libraries/hn-comment-moderation.php";

    session_start();

    if(!isset($_SESSION["user_id"]))
    {
        header("Location:index.php");
        exit;
    }

    if(TEST_fetch_user_rights($_SESSION["user_id"])[2] != 1)
    {
        header("Location:index.php");
        exit;
    }

    $recipe_id = $_POST["recipe_id"];
    $comment_text = $_POST["comment_text"];
    $rating = $_POST["rating"];

    if(comment_log($_SESSION["user_id"], $recipe_id, $comment_text, $rating) == 0)
    {
        header("Location:recipe-display.php?recipe_id=".$recipe_id);
        exit;
    }
    else
    {
        header("Location:recipe-display.php?recipe_id=".$recipe_id);
        exit;
    }

?>