<?php
    session_start();
    if(session_destroy() == true){
        header("Location:../../content/home-page.php");
    }
    else{
        header("Location:../../content/home-page.php");
    }
?>