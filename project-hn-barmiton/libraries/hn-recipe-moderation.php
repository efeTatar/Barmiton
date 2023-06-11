<?php

    define("recipe_propositions", "../../data/recipe_propositions.csv");
    define("recipes", "../../data/recipes.csv");
    define("ingredients", "../../data/ingredients.csv");
    define("recipe_ingredients", "../../data/recipe_ingredients.csv");

    /*
        Recipe manipulation functions ================================================================================================================
    */

    function recipe_log ($user_id, $title, $instructions)
    {
        $recipe = recipe_string_generate(
            $user_id,
            recipe_id_generate(),
            prepare_string_log($title),
            prepare_string_log($instructions)
        );

        return recipe_append($recipe);
    }
    
    function recipe_proposition_log ($user_id, $title, $instructions)
    {
        $recipe = recipe_string_generate(
            $user_id,
            recipe_id_generate(),
            prepare_string_log($title),
            prepare_string_log($instructions)
        );

        return recipe_proposition_append($recipe);
    }

    function recipe_proposition_validate($recipe_id)
    {
        $recipe_array = recipe_proposition_fetch($recipe_id);

        $recipe = recipe_string_generate(
            $recipe_array[0], 
            $recipe_array[1],
            $recipe_array[2], 
            $recipe_array[3], 
            $recipe_array[4], 
            $recipe_array[5],
            $recipe_array[6]
        );

        recipe_append($recipe);

        recipe_proposition_destroy($recipe);
        
        return 0;
    }

    function recipe_proposition_refuse($recipe_id)
    {
        $recipe_array = recipe_proposition_fetch($recipe_id);

        $recipe = recipe_string_generate(
            $recipe_array[0], 
            $recipe_array[1],
            $recipe_array[2], 
            $recipe_array[3], 
            $recipe_array[4], 
            $recipe_array[5],
            $recipe_array[6]
        );
        
        recipe_proposition_destroy($recipe);
        
        return 0;
    }

    function recipe_remove($recipe_id)
    {
        $recipe_array = recipe_fetch($recipe_id);

        $recipe = recipe_string_generate(
            $recipe_array[0], 
            $recipe_array[1],
            $recipe_array[2], 
            $recipe_array[3], 
            $recipe_array[4], 
            $recipe_array[5],
            $recipe_array[6]
        );
        
        recipe_destroy($recipe);
        
        return 0;
    }

    function ingredient_price_modify($ingredient_id, $price)
    {
        $ingredient = ingredient_table_fetch($ingredient_id);

        $ingredient_string = ingredient_string_generate($ingredient);

        $updated_ingredient_string = ingredient_string_generate(array($ingredient[0], $ingredient[1], $price));

        $updated_ingredients_list = file_get_contents(ingredients);
        $updated_ingredients_list = str_replace($ingredient_string, $updated_ingredient_string, $updated_ingredients_list);

        file_put_contents(ingredients, "");
        file_put_contents(ingredients, $updated_ingredients_list);

        return 0;
    }

    /*
        Tableswise functions =======================================================================================================================
    */

    function recipe_proposition_append ($recipe)
    {
        if (($table = fopen(recipe_propositions, "a")) == FALSE) return -1;
        
        fwrite($table, $recipe);

        fclose($table);

        return 0;
    }

    function recipe_proposition_destroy ($recipe)
    {
        $recipe_propositions = file_get_contents(recipe_propositions);
        $recipe_propositions = str_replace($recipe, "", $recipe_propositions);

        file_put_contents(recipe_propositions, "");
        file_put_contents(recipe_propositions, $recipe_propositions);

        return 0;
    }

    function recipe_append ($recipe)
    {
        if (($table = fopen(recipes, "a")) == FALSE) return -1;
        
        fwrite($table, $recipe);

        fclose($table);

        return 0;
    }

    function recipe_destroy($recipe)
    {
        $recipe_string = file_get_contents(recipes);
        $recipe_string = str_replace($recipe, "", $recipe_string);

        file_put_contents(recipes, "");
        file_put_contents(recipes, $recipe_string);

        return 0;
    }

    /*
        Stringifiers / Generators ==================================================================================================================
    */

    function ingredient_string_generate($data)
    {
        $ingredient = "\n".$data[0].",".$data[1].",".$data[2];

        return $ingredient;
    }

    function recipe_string_generate ($user_id, $recipe_id, $title, $difficulty, $type, $instructions, $comment)
    {
        $recipe = "\n".$user_id.",".$recipe_id.",".$title.",".$difficulty.",".$type.",".$instructions.",".$comment;

        return $recipe;
    }

    function recipe_id_generate ()
    {
        return rand(100000, 999999);
    }

    function prepare_string_log ($string)
    {
        $string = str_replace(",", "#", $string);

        return $string;
    }

    function recipe_display_prepare($string)
    {
        $string = str_replace("#", ",", $string);

        return $string;
    }

    /*
        Fetching functions =========================================================================================================================
    */

    function recipe_proposition_fetch($recipe_id){

        if (($table = fopen(recipe_propositions, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){

            if (strcmp($data[1], $recipe_id) == 0){
                fclose($table);
                return $data;
            }

        }
        
        fclose($table);
        return 0;
    }

    function recipe_fetch($recipe_id){

        if (($table = fopen(recipes, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){

            if (strcmp($data[1], $recipe_id) == 0){
                fclose($table);
                return $data;
            }

        }
        
        fclose($table);
        return 0;
    }

    function recipe_ingredient_id_list_fetch($recipe_id){

        if (($table = fopen(recipe_ingredients, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){

            if (strcmp($data[0], $recipe_id) == 0){
                fclose($table);
                return $data;
            }

        }
        
        fclose($table);
        return 0;
    }

    function recipe_ingredient_list_fetch($recipe_ingredient_id_listedient_id_list)
    {
        $ingredient_list = array();
        for($i=0;$i<$recipe_ingredient_id_listedient_id_list[1];$i++){
            $ingredient_list[] = ingredient_fetch($recipe_ingredient_id_listedient_id_list[$i+2]);
        }

        return $ingredient_list;
    }

    function ingredient_fetch($ingredient_id)
    {
        if (($table = fopen(ingredients, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){

            if (strcmp($data[0], $ingredient_id) == 0){
                fclose($table);
                return $data[1];
            }

        }
        
        fclose($table);
        return 0;
    }

    function ingredient_table_fetch($ingredient_id)
    {
        if (($table = fopen(ingredients, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){

            if (strcmp($data[0], $ingredient_id) == 0){
                fclose($table);
                return $data;
            }

        }
        
        fclose($table);
        return 0;
    }

    function recipe_price_fetch($recipe_ingredient_id_list)
    {

        if (($table = fopen(ingredients, "r")) == FALSE) return 0;

        $price = 0;

        while (($data = fgetcsv($table)) !== FALSE){

            for($i = 1 ; $i<sizeof($recipe_ingredient_id_list) ; $i++)
            {
                if(strcmp($data[0], $recipe_ingredient_id_list[$i+1]) == 0)
                {
                    $price += $data[2];
                }
            }

        }
        
        fclose($table);
        return $price;
    }

    /*
        Verifying functions ========================================================================================================================
    */

    /*
        Display functions =======================================================================================================================
    */

    function ingredient_list_display()
    {
        if (($table = fopen(ingredients, "r")) == FALSE) return -1;
        
        $data = fgetcsv($table);
        
        while (($data = fgetcsv($table)) !== FALSE){
            echo "<div id=".$data[0]." class="."proposition".">";
            echo "<p>".$data[1]."</p>";
            echo "<p>".$data[2]."€</p>";
            echo    "<form action='javascript:price_modify(price_".$data[0].".value, ".$data[0].")'>
                        <input name ='price' id='price_".$data[0]."' type='number' step='0.25' min='0' placeholder='price'>
                        <input type='submit' value='Save'>
                    </form>";
            echo "</div>";
        }
        
        fclose($table);
        
        return 0;
    }

    function recipe_propositions_display(){

        if (($table = fopen(recipe_propositions, "r")) == FALSE) return -1;
        
        $data = fgetcsv($table);
        
        while (($data = fgetcsv($table)) !== FALSE){
            echo "<div id=".$data[1]." class="."proposition".">";
            echo "<p><a href='profile-page.php?user_id=".$data[0]."'>@".fetch_username($data[0])."</a></p>";
            echo "<p>".$data[2]."</p>";
            echo "<p>".recipe_display_prepare($data[5])."</p>";
            echo "<button onclick="."'recipe_proposition_validate(".$data[1].")'".">validate</button><button onclick="."'recipe_propsition_refuse(".$data[1].")'".">refuse</button></div>";
        }
        
        fclose($table);
        
        return 0;
    }

    function user_recipes_display($user_id)
    {
        session_start();
        if (($table = fopen(recipes, "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){
            if (strcmp($data[0], $user_id) == 0){
                echo "<div id=".$data[1]." class='recipe'>";
                if(check_adminship($_SESSION["user_id"]) == 0)
                {
                    echo "<p>User ID: ".$data[0];
                    echo "<p>Recipe ID: ".$data[1];
                }
                echo "<p><a href='recipe-display.php?recipe_id=".$data[1]."'>".$data[2]."<a></p>";
                $rating = recipe_rating_fetch($data[1]);
                $rating = rating_string_generator($rating);
                echo "<p>".$rating."</p>";
                echo "<p>".$data[3]."</p>";
                if(strcmp($data[0], $_SESSION["user_id"]) == 0 || (check_adminship($_SESSION["user_id"]) == 0 && $user_id != "100001") )
                {
                    echo "<button class='delete-button' onclick='recipe_remove(".$data[1].");'>X</button>";
                }
                echo "</div>";
            }
        }

        fclose($table);
        return 0;
    }

    function recipe_browse_display()
    {
        session_start();
        if (($table = fopen(recipes, "r")) == FALSE) return -1;

        fseek($table, 1);

        while (($data = fgetcsv($table)) !== FALSE){
            echo "<div id=".$data[1]." class='recipe'>";
                if(check_adminship($_SESSION["user_id"]) == 0)
                {
                    echo "<p>User ID: ".$data[0];
                    echo "<p>Recipe ID: ".$data[1];
                }
                echo "<p><a href='recipe-display.php?recipe_id=".$data[1]."'>".$data[2]."<a></p>";
                $rating = recipe_rating_fetch($data[1]);
                $rating = rating_string_generator($rating);
                echo "<p>".$rating."</p>";
                echo "<p>".$data[3]."</p>";
                if(strcmp($data[0], $_SESSION["user_id"]) == 0 || (check_adminship($_SESSION["user_id"]) == 0 && $user_id != "100001") )
                {
                    echo "<button class='delete-button' onclick='recipe_remove(".$data[1].");'>X</button>";
                }
                echo "</div>";
        }

        fclose($table);
        return 0;
    }

?>