<?php
    include "libraries/hn-user-moderation.php";
    
    $user_id = $_GET["user_id"];
    
    user_info_display($user_id);
?>