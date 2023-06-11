<?php

include "../../libraries/hn-standard-library.php";

if (!isset($_POST['search'])) exit;

$search = $_POST['search'];
$file = fopen("../../data/recipes.csv", "r");

$i = 0;

while (($data = fgetcsv($file)) !== false && $i < 6) {
    $data = array_map('trim', $data);
    /*foreach ($data as $value) {
        if (strpos(strtolower($value), strtolower($search)) !== false) {
            $coctail = $data;
            $i++;
            print_recipe($coctail);
        }
    }*/
    if (strpos(strtolower($data[2]), strtolower($search)) !== false) {
        $coctail = $data;
        $i++;
        print_recipe($coctail);
    }
}

fclose($file);

function print_recipe($cocktail)
{
    if(empty($cocktail))
    {
        echo "Aucun résultat trouvé.";
        return;
    }

    $rating = recipe_rating_fetch($cocktail[1]);
    $rating = rating_string_generator($rating);

    echo "<p><a href='recipe-display.php?recipe_id=".$cocktail[1]."'>".$cocktail[2]."<a></p>";
    echo "<p>".$rating."</p><br>";
}

?>
