<?php
    include "libraries/hn-comment-moderation.php";
    
    $user_id = $_GET["user_id"];
    
    user_comment_display($user_id);
?>