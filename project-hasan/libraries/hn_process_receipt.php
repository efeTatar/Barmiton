<?php

    /////////////
    //FUNCTIONS//
    /////////////
    define("path_to_ingredient_list","../data/ingredients.csv");
    define("path_to_recipe_ingredient_list","../data/recipe_ingredients.csv");
    define("path_to_recipe_list","../data/recipes.csv");
    define("path_to_recipe_proposition_list","../data/recipe_propositions.csv");

    /*
        Log functions ==============================================================================================================================
    */

    function recipe_proposition_log($title, $difficulty, $type, $instructions, $ingredient_list, $user_id)
    {
        $recipe_id = recipe_id_generate();

        $recipe = recipe_string_generate(
            $user_id, 
            $recipe_id, 
            prepare_string_log($title), 
            $difficulty, 
            $type, 
            prepare_string_log($instructions),
            '1'
        );

        echo $recipe;

        recipe_proposition_append($recipe);

        if (fill_ingredients($recipe_id, $ingredient_list) != 1) return 0;

        return 0;
    }

    function recipe_log($title, $difficulty, $type, $instructions, $ingredient_list, $user_id)
    {
        $recipe_id = recipe_id_generate();

        $recipe = recipe_string_generate(
            $user_id, 
            $recipe_id, 
            prepare_string_log($title), 
            $difficulty, 
            $type, 
            prepare_string_log($instructions),
            '1'
        );

        echo $recipe;

        recipe_append($recipe);

        if (fill_ingredients($recipe_id, $ingredient_list) != 1) return 0;

        return 0;
    }

    /*
        information check / fetch functions ==============================================================================================================================
    */

    function check_adminship ($user_id)
    {
        $rights = TEST_fetch_user_rights($user_id);

        if($rights[3] == 1) return 0;
        
        else return 1;
    }

    function check_presence($ingredient)
    {
        if (($file = fopen(path_to_ingredient_list, "r")) == FALSE) return 0;

        $previous_ingredient_id = 0;

        while (($row = fgetcsv($file)) !== false) {
            $check = strcmp(standardise_string($ingredient), $row[1]);
            if ($row[0] != 0) $previous_ingredient_id = $row[0];
            if ($check == 0) {
                return $row[0];
            }
        }
        
        fclose($file);
        
        $ingredient_id = add_ingredient($ingredient, $previous_ingredient_id);
        return $ingredient_id;
    }

    function TEST_fetch_user_rights ($user_id)
    {
        if (($table = fopen("../data/user_rights.csv", "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){
            
            if (strcmp($data[0], $user_id) == 0)
            {
                fclose($table);
                return $data;
            }
            
        }

        fclose($table);
        return 1;
    }

    /*
        filewise functions ==============================================================================================================================
    */

    function recipe_proposition_append ($recipe)
    {
        if (($table = fopen('../data/recipe_propositions.csv', "a")) == FALSE) return -1;
        
        fwrite($table, $recipe);

        fclose($table);

        return 0;
    }

    function recipe_append ($recipe)
    {
        if (($table = fopen('../data/recipes.csv', "a")) == FALSE) return -1;
        
        fwrite($table, $recipe);

        fclose($table);

        return 0;
    }

    function add_ingredient($ingredient, $previous_ingredient_id){

        if (($file = fopen(path_to_ingredient_list, "a")) == FALSE) return 0;
        $ingredient_id = $previous_ingredient_id+1;
        $line = "\n".$ingredient_id.",".standardise_string($ingredient).","."0";
        fwrite($file, $line);
        fclose($file);
        return $ingredient_id;
    }

    function fill_ingredients($recipe_id, $ingredient_list)
    {

        if (($file = fopen(path_to_recipe_ingredient_list, "a")) == FALSE) return 0;
        if (($list = fopen(path_to_ingredient_list, "r")) == FALSE) return 0;

        $line = $recipe_id.",".sizeof($ingredient_list);

        for($i=0; $i<sizeof($ingredient_list); $i++){
            $line .= ",".check_presence($ingredient_list[$i]);
        }

        fwrite($file, $line."\n");
        fclose($file);
        fclose($list);
        return 1;
    }

    /*
        string modifiers ==============================================================================================================================
    */

    function standardise_string($string){
        $new_str = trim($string);
        $new_str = strtolower($new_str);
        $new_str = ucfirst($new_str);
        $new_str = prepare_string_log($new_str);
        return $new_str;
    }

    function prepare_string_log ($string)
    {
        $string = str_replace(",", "#", $string);

        return $string;
    }

    /*
        Generators ==============================================================================================================================
    */

    function recipe_string_generate ($user_id, $recipe_id, $title, $difficulty, $type, $instructions, $comment)
    {
        $recipe = "\n".$user_id.",".$recipe_id.",".$title.",".$difficulty.",".$type.",".$instructions.",".$comment;

        return $recipe;
    }

    function recipe_id_generate()
    {
        return rand(100000, 999999);
    }

    //////////
    ///MAIN///
    //////////
    
    $name = $_GET["name"];
    $diff = $_GET["difficulty"];
    $ingredient_list = $_GET["ingredients_list"];
    $type_of_drink = $_GET["type_of_drink"];
    $process = $_GET["process"];

    $ingredient_array = explode(",", $ingredient_list);

    session_start();

    if(!isset($_SESSION["user_id"]))
    {
        header("Location:index.php");
        exit();
    }

    if(check_adminship($_SESSION["user_id"]) == 0)
    {
        if(recipe_log($name, $diff, $type_of_drink, $process, $ingredient_array, $_SESSION["user_id"]) == 0){
            header("Location:index.php");
            exit();
        }
        else{
            header("Location:index.php");
            exit();
        }
    }
    echo $_SESSION["user_id"];
    echo check_adminship($_SESSION["user_id"]);

    if(recipe_proposition_log($name, $diff, $type_of_drink, $process, $ingredient_array, $_SESSION["user_id"]) == 0){
        header("Location:index.php");
        exit();
    }
    else{
        header("Location:index.php");
        exit();
    }

?>