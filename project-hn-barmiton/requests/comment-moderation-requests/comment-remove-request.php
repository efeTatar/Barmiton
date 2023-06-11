<?php
    
    include "../../libraries/hn-standard-library.php";

    $comment_id = $_GET["comment_id"];
    
    comment_delete($comment_id);
?>