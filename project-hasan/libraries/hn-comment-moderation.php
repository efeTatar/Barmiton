<?php
    include "libraries/hn-user-moderation.php";
    /*
        moderation functions
    */

    function comment_log($user_id, $recipe_id, $comment_text, $rating)
    {
        $comment = comment_string_generate(
            $user_id,
            $recipe_id,
            comment_id_generate(),
            string_coma_replace($comment_text),
            $rating
        );
        echo $comment;
        append_comment($comment);

        return 0;
    }

    function comment_delete($comment_id)
    {
        $comment_array = comment_fetch($comment_id);

        $comment = comment_string_generate(
            $comment_array[0],
            $comment_array[1],
            $comment_array[2],
            $comment_array[3],
            $comment_array[4]
        );

        comment_destroy($comment);

        return 0;
    }

    /*
        fetch functions
    */

    function comment_fetch($comment_id)
    {
        if (($table = fopen("data/comment.csv", "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){

            if (strcmp($data[1], $comment_id) == 0){
                fclose($table);
                return $data;
            }

        }
        
        fclose($table);
        return 0;
    }

    function comment_destroy($comment)
    {
        $comment_string = file_get_contents("data/recipes.csv");
        $comment_string = str_replace($comment, "", $comment_string);

        file_put_contents("data/recipes.csv", "");
        file_put_contents("data/recipes.csv", $comment_string);

        return 0;
    }

    /*
        filewise functions
    */

    function append_comment($comment)
    {
        if (($table = fopen("data/comment.csv", "a")) == FALSE) return -1;
        
        fwrite($table, $comment);

        fclose($table);

        return 0;
    }

    /*
        generators
    */

    function comment_id_generate()
    {
        return rand(100000, 999999);
    }

    function comment_string_generate($user_id, $recipe_id, $comment_id, $comment_text, $rating)
    {
        $comment = "\n".$user_id.",".$recipe_id.",".$comment_id.",".$comment_text.",".$rating;

        return $comment;
    }

    function rating_string_generator($rating)
    {
        for($i = 0; $i < 5 ; $i++)
        {
            if($rating > $i)
            {
                $string .= ⭐;
            }
        }

        return $string;
    }

    /*
        string modifiers
    */

    function string_coma_replace($string)
    {
        $string = str_replace(",", "#", $string);

        return $string;
    }

    /*
        display functions
    */

    function recipe_comment_display($recipe_id)
    {
        session_start();
        if (($table = fopen("data/comment.csv", "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){
            if (strcmp($data[1], $recipe_id) == 0){
                echo "<div id=".$data[2]." class='comment'>";
                echo "<p><a href='test-profile-page.php?user_id=".$data[0]."'>@".fetch_username($data[0])."</a></p>";
                if(check_adminship($_SESSION["user_id"]) == 0)
                {
                    echo "<p>User ID: ".$data[0];
                    echo "<p>Recipe ID: ".$data[1];
                    echo "<p>Comment ID: ".$data[2];
                }
                echo "<br>".rating_string_generator($data[4]); 
                echo "<p>".$data[3]."</p>";
                if(strcmp($data[0], $_SESSION["user_id"]) == 0 || (check_adminship($_SESSION["user_id"]) == 0 && $user_id != "100001") )
                {
                    echo "<button class='delete-button' onclick='comment_remove(".$data[1].");'>X</button>";
                }
                echo "</div>";
            }
        }

        fclose($table);
        return 0;
    }

    function user_comment_display($user_id)
    {
        session_start();
        if (($table = fopen("data/comment.csv", "r")) == FALSE) return -1;

        while (($data = fgetcsv($table)) !== FALSE){
            if (strcmp($data[0], $user_id) == 0){
                echo "<div id=".$data[2]." class='comment'>";
                echo "<p><a href='test-profile-page.php?user_id=".$data[0]."'>@".fetch_username($data[0])."</a></p>";
                if(check_adminship($_SESSION["user_id"]) == 0)
                {
                    echo "<p>User ID: ".$data[0];
                    echo "<p>Recipe ID: ".$data[1];
                    echo "<p>Comment ID: ".$data[2];
                }
                echo "<br>".rating_string_generator($data[4]); 
                echo "<p>".$data[3]."</p>";
                if(strcmp($data[0], $_SESSION["user_id"]) == 0 || (check_adminship($_SESSION["user_id"]) == 0 && $user_id != "100001") )
                {
                    echo "<button class='delete-button' onclick='comment_remove(".$data[1].");'>X</button>";
                }
                echo "</div>";
            }
        }

        fclose($table);
        return 0;
    }

?>