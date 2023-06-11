<?php
    include "../../libraries/hn-standard-library.php";

    $recipe_id = $_GET["recipe_id"];

    recipe_proposition_validate($recipe_id);
?>