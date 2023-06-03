<?php

    include "libraries/hn-recipe-moderation.php";

    $recipe_id = $_GET["recipeid"];
    
    validate_recipe_proposition($recipe_id);
    echo "Recipe propositions:";
    display_recipe_propositions();
?>