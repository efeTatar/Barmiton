<?php
    include "../../libraries/hn-standard-library.php";

    $recipe_id = $_GET["recipe_id"];
    
    recipe_comment_display($recipe_id);
?>