<?php
    include "../../libraries/hn-standard-library.php";
    
    $user_id = $_GET["user_id"];
    
    user_recipes_display($user_id);
?>