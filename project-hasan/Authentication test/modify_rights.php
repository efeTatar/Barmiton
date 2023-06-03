<?php
    include "tablewise_functions.php";

    $user_id = $_POST["user_id"];

    $user_rights[] = $_POST["add_recipe"];
    $user_rights[] = $_POST["comment"];
    $user_rights[] = $_POST["product_management"];
    $user_rights[] = $_POST["validate_recipe"];
    $user_rights[] = $_POST["manage_access_comments"];
    $user_rights[] = $_POST["user_awards"];

    for($i = 0 ; $i < 6; $i++){
        if(strcmp($user_rights[$i],"") == 0) {
            $user_rights[$i] = 0;
        }
    }

    $match = modify_user_rights($user_id, $user_rights[0], $user_rights[1], $user_rights[2], $user_rights[3], $user_rights[4], $user_rights[5]);

    if($match == 1){
        $_SESSION["username"] = $username;
        header("Location:main.php");
    }
    else{
        header("Location:main.php");
    }

?>