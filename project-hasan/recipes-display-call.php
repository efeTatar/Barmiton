<?php
    include "libraries/hn-recipe-moderation.php";
    
    $user_id = $_GET["user_id"];
    
    user_recipes_display($user_id);
?>