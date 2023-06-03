<?php

    include "libraries/hn-comment-moderation.php";

    $recipe_id = $_GET["recipe_id"];
    
    recipe_comment_display($recipe_id);
?>