<?php

    include "libraries/hn-user-moderation.php";

    $user_id = $_POST["user_id"];

    if(strcmp($user_id, "000001") == 0){
        header("Location:admin-console.php");
        exit();
    }

    $user_rights[] = $_POST["recipe"];
    $user_rights[] = $_POST["comment"];
    $user_rights[] = $_POST["admin"];

    for($i = 0 ; $i < 3; $i++){
        if(strcmp($user_rights[$i],"") == 0) {
            $user_rights[$i] = 0;
        }
    }
    
    if(user_rights_modify($user_id, $user_rights) == 0)
    {
        header("Location:admin-console.php");
    }
    else
    {
        header("Location:admin-console.php");
    }
?>