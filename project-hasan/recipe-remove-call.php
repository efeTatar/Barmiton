<?php
    include "libraries/hn-recipe-moderation.php";
    
    $recipe_id = $_GET["recipe_id"];
    
    recipe_remove($recipe_id);
?>