<?php
    include "libraries/hn-user-moderation.php";
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

    /*
        Tableswise functions =======================================================================================================================
    */

    function recipe_proposition_append ($recipe)
    {
        if (($table = fopen("data/recipe_propositions.csv", "a")) == FALSE) return -1;
        
        fwrite($table, $recipe);

        fclose($table);

        return 0;
    }

    function recipe_proposition_destroy ($recipe)
    {
        $recipe_propositions = file_get_contents("data/recipe_propositions.csv");
        $recipe_propositions = str_replace($recipe, "", $recipe_propositions);

        file_put_contents("data/recipe_propositions.csv", "");
        file_put_contents("data/recipe_propositions.csv", $recipe_propositions);

        return 0;
    }

    function recipe_append ($recipe)
    {
        if (($table = fopen("data/recipes.csv", "a")) == FALSE) return -1;
        
        fwrite($table, $recipe);

        fclose($table);

        return 0;
    }

    function recipe_destroy($recipe)
    {
        $recipe_string = file_get_contents("data/recipes.csv");
        $recipe_string = str_replace($recipe, "", $recipe_string);

        file_put_contents("data/recipes.csv", "");
        file_put_contents("data/recipes.csv", $recipe_string);

        return 0;
    }

    /*
        Stringifiers / Generators ==================================================================================================================
    */

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

    /*
        Fetching functions =========================================================================================================================
    */

    function recipe_proposition_fetch($recipe_id){

        if (($table = fopen("data/recipe_propositions.csv", "r")) == FALSE) return -1;

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

        if (($table = fopen("data/recipes.csv", "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){

            if (strcmp($data[1], $recipe_id) == 0){
                fclose($table);
                return $data;
            }

        }
        
        fclose($table);
        return 0;
    }

    /*
        Verifying functions ========================================================================================================================
    */

    /*
        Display functions =======================================================================================================================
    */

    function recipe_propositions_display(){

        //$table = fopen("data/recipe_propositions.csv", "r");
        if (($table = fopen("data/recipe_propositions.csv", "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){
            echo "<div id=".$data[1]." class="."proposition".">";
            echo "<p>Recipe ID: ".$data[1];
            echo "<p>User ID: ".$data[0];
            echo "<p>".$data[2]."</p>";
            echo "<p>".$data[5]."</p>";
            echo "<button onclick="."'recipe_proposition_validate(".$data[1].")'".">validate</button><button onclick="."'recipe_propsition_refuse(".$data[1].")'".">refuse</button></div>";
        }
        
        fclose($table);
        
        return 0;
    }

    function user_recipes_display($user_id)
    {
        session_start();
        if (($table = fopen("data/recipes.csv", "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){
            if (strcmp($data[0], $user_id) == 0){
                echo "<div id=".$data[1]." class='recipe'>";
                if(check_adminship($_SESSION["user_id"]) == 0)
                {
                    echo "<p>User ID: ".$data[0];
                    echo "<p>Recipe ID: ".$data[1];
                }
                echo "<p><a href='recipe-display.php?recipe_id=".$data[1]."'>".$data[2]."<a></p>"; 
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
        if (($table = fopen("data/recipes.csv", "r")) == FALSE) return -1;

        fseek($table, 1);

        while (($data = fgetcsv($table)) !== FALSE){
            echo "<div id=".$data[1]." class='recipe'>";
                if(check_adminship($_SESSION["user_id"]) == 0)
                {
                    echo "<p>User ID: ".$data[0];
                    echo "<p>Recipe ID: ".$data[1];
                }
                echo "<p><a href='recipe-display.php?recipe_id=".$data[1]."'>".$data[2]."<a></p>"; 
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