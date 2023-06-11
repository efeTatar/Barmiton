<?php

    include "../../libraries/hn-standard-library.php";

    session_start();

    if(!isset($_SESSION["user_id"]))
    {
        header("Location:../../content/home-page.php");
        exit;
    }

    if(TEST_fetch_user_rights($_SESSION["user_id"])[2] != 1)
    {
        header("Location:../../content/home-page.php");
        exit;
    }

    $recipe_id = $_POST["recipe_id"];
    $comment_text = $_POST["comment_text"];
    $rating = $_POST["rating"];

    if(user_comemnt_check($_SESSION["user_id"], $recipe_id) != 0)
    {
        header("Location:../../content/recipe-display.php?recipe_id=".$recipe_id);
        exit;
    }

    if(comment_log($_SESSION["user_id"], $recipe_id, $comment_text, $rating) == 0)
    {
        header("Location:../../content/recipe-display.php?recipe_id=".$recipe_id);
        exit;
    }
    else
    {
        header("Location:../../content/recipe-display.php?recipe_id=".$recipe_id);
        exit;
    }

?>