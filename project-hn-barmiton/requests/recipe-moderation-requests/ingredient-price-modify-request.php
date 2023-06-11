<?php

    include "../../libraries/hn-standard-library.php";

    $price = $_GET["price"];
    $ingredient_id = $_GET["ingredient_id"];

    ingredient_price_modify($ingredient_id, $price);
?>