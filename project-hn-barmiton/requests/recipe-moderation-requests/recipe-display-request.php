<?php

    include "../../libraries/hn-standard-library.php";

    $recipe_id = $_GET["recipe_id"];

    $recipe = recipe_fetch($recipe_id);

    $recipe_ingredient_id_list = recipe_ingredient_id_list_fetch($recipe_id);

    $ingredient_list = recipe_ingredient_list_fetch($recipe_ingredient_id_list);

    $price = recipe_price_fetch($recipe_ingredient_id_list);

    $rating = recipe_rating_fetch($recipe_id);
    $rating = rating_string_generator($rating);

    echo "<h1>".$recipe[2]."</h1>";
    
    echo "<p>".$rating."</p>";

    echo "<p><a href='profile-page.php?user_id=".$recipe[0]."'>by @".fetch_username($recipe[0])."</a><p>";

    echo "<div class='row'>
    <div class='menu-segment'>
    <p>Information</p>
    <hr style='width: 75%;'>
    <p>Difficulty: ".$recipe[3]."</p>
    <p>Type: ".$recipe[4]."</p>
    <p>Estimated price: ".$price."€</p></div>";

    echo "<div class='menu-segment'><p>Ingredients</p>
    <hr style='width: 75%;'>";
    for($i=0;$i<sizeof($ingredient_list);$i++)
    {
        echo "<p>-".$ingredient_list[$i]."</p>";
    }
    echo "</div></div>";

    echo "<div class='row'><div id='recipe-instructions-segment' class='menu-segment'><p>Instructions</p>
    <hr style='width: 30%;'><p>".
    recipe_display_prepare($recipe[5])
    ."</p></div></div>";

?>