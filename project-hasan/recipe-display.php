<?php
    include "libraries/hn-recipe-moderation.php";

    //section to move into call function page !!!

    function id_compare($id_1, $id_2)
    {
        if($id_1 == $id_2)
        {
            return 1;
        }

        return 0;
    }

    function find_recipe($recipe_id)
    {

        if (($file = fopen("data/recipes.csv", "r")) == FALSE)
        {
            return -1;
        }
        $row = fgetcsv($file);
        while (($row = fgetcsv($file)) !== false) {
            if ( id_compare($recipe_id, $row[1]) == 1)
            {
                return $row;
            }
        }

        return 0;
    }

    function find_ingredients($recipe_id)
    {
        if (($file = fopen("data/recipe_ingredients.csv", "r")) == FALSE)
        {
            return -1;
        }
        $row = fgetcsv($file);
        while (($row = fgetcsv($file)) !== false) {
            if ( id_compare($recipe_id, $row[0]) == 1)
            {
                return $row;
            }
        }

        return 0;
    }
    function find_ingredient_name($id)
    {
        if (($file = fopen("data/ingredients.csv", "r")) == FALSE)
        {
            return -1;
        }
        $row = fgetcsv($file);
        while (($row = fgetcsv($file)) !== false) {
            if ( id_compare($id, $row[0]) == 1)
            {
                return $row[1];
            }
        }
        return 0;
    }
    function id_2_name($ingredient_id)
    {
        $ingredient = array();
        for($i=0;$i<$ingredient_id[1];$i++){
            $ingredient[] = find_ingredient_name($ingredient_id[$i+2]);
        }
        return $ingredient;
    }

    ///////////
    ///MAIN////
    ///////////

    $recipe_id = $_GET["recipe_id"];
    $recipe = find_recipe($recipe_id);
    $ingredient_id = find_ingredients($recipe_id);
    $ingredient_list = id_2_name($ingredient_id);
    if($recipe == 0 || $ingredient_id == 0){
        echo "ERROR";
        return;
    }

?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&family=Lobster&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <style></style>
    <script></script>   
    <link rel='stylesheet' type='text/css' href='css/recipe_display.css'>
    <link rel='stylesheet' type='text/css' href='css/hn-barmiton.css'>
    <title>Recipe display</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="libraries/hn-recipe-moderation.js"></script>
    <script type="text/javascript" src="libraries/hn-comment-moderation.js"></script>

	<script>
		recipe_search_initialise();
	</script>

    <script>
        recipe_comment_display(<?php echo $recipe_id; ?>);
    </script>
</head>

<body>
    <div id="navigation-bar">
        <div class="navigation-bar-sub-segment">
            <p id="navigation-bar-title">Barmiton</p>
            <p><a href="index.php">Home Page</a></p>
            <p><a href="browse.php">Browse</a></p>
            <p><a href="recipe-proposition-form.php">Publish Recipe</a></p>
            <?php
                session_start();
                if(check_adminship($_SESSION["user_id"]) == 0)
                {
                    echo "<p id='admin-console-button'><a href='admin-console.php'>Admin Console</a></p>";
                }
            ?>
            <input type="text" id="search" placeholder="Coctail, ingredient, user...">
	        <div id="display"></div>
        </div>
        
        <div class="navigation-bar-sub-segment">
            <?php
                session_start();
                echo "<p><a href='test-profile-page.php?user_id=".$_SESSION["user_id"]."'>".$_SESSION["username"]."</a></p>";
                if (!$_SESSION["username"]){
                    echo "<p id='log-in-button'><a href='sign-in-form.php'>Sign In</a></p>";
                }
                if ($_SESSION["username"]){
                    echo "<p><a href='sign-out-call.php'>Sign Out</a></p>";
                }
            ?>
        </div>
    </div>

    <div id='container'>
        <h1 style="margin-bottom: 0px;" id="title"><?php echo $recipe[2]?></h1><br><br>

        <div id='image'>
            <img id="image_pick" src="https://www.cdc.gov/cancer/alcohol/reducing-excessive-alcohol-use/images/alcohol-250.jpg?_=83377">
        </div>

        <div id='difficulty' class='element'>
            <p>Difficulty</p>
            <hr style="width: 25%;">
            <?php echo "<p>".$recipe[3]."</p>" ?>
        </div><br>
        <div id='type' class='element'>
            <p>Type</p>
            <hr style="width: 25%;">
            <?php echo "<p>".$recipe[4]."</p>" ?>
        </div><br>

        <div id="ingredient" class='element'>
            <p>Ingredients</p>
            <hr style="width: 25%;">
            <?php
            for($i=0;$i<sizeof($ingredient_list);$i++)
            {
                echo "<p>-".$ingredient_list[$i]."</p>";
            }
            ?>
        </div><br>

        <div id='Process' class='element'>
            <p>Processus :</p>
            <?php 
            echo "<p>".$recipe[5]."</p>";
            ?>
        </div>
        <br>

        <form id="comment-box" action="comment-call.php" method="post">
            <input name="recipe_id" type="hidden" value=<?php echo $recipe_id; ?>>
            <input class="text-input" name="comment_text" tpye="text" placeholder="Your thoughts">
            <input name="rating" type="number" min="0" max="5" placeholder="Rate this recipe">

            <input type="submit" value="Comment">
        </form><br>         

        <div id="comments">
            <p>HELLo</p>
        </div>

    </div>
</body>

</html>