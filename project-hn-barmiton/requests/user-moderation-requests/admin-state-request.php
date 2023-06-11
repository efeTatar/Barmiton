<?php
    
    include "../../libraries/hn-standard-library.php";

    session_start();

    if(check_adminship($_SESSION["user_id"]) != 0)
    {
        exit();
    }

    display_admin_console_button();

?>