<?php

    include "../../libraries/hn-standard-library.php";

    $user_id = $_POST["user_id"];

    if(strcmp($user_id, "000001") == 0){
        header("Location:../../content/admin-console-users.php");
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
        header("Location:../../content/admin-console-users.php");
    }
    else
    {
        header("Location:../../content/admin-console-users.php");
    }
?>