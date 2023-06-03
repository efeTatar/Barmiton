<?php

    $user_id = $_GET["user_id"];

    $path = "images/profile-photos/".$user_id;
    if(file_exists($path.".jpg"))
    {
        echo "<img id='profile-photo' class='animation-2' src='".$path.".jpg'>";
        exit();
    }
    if(file_exists($path.".jpeg"))
    {
        echo "<img id='profile-photo' class='animation-2' src='".$path.".jpeg'>";
        exit();
    }
    if(file_exists($path.".png"))
    {
        echo "<img id='profile-photo' class='animation-2' src='".$path.".png'>";
        exit();
    }

    echo "<img id='profile-photo' class='animation-2' src='images/profile-photos/default.png'>";
?>