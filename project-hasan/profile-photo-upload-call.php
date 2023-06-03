<?php
    session_start();
    
    if(!isset($_FILES["profile-picture"]))
    {
        echo "Image not found";
        header("Location:user-modify-form.php?user_id=".$_SESSION["user_id"]."&upload-failed-image-not-found=1");
        exit;
    }

    $file = $_FILES["profile-picture"];

    $file_extension = explode(".", $file["name"]);
    
    $allowed_formats = array('jpg', 'jpeg', 'png');

    if(!in_array($file_extension[1], $allowed_formats))
    {
        echo "Format not supported";
        header("Location:user-modify-form.php?user_id=".$_SESSION["user_id"]."&upload-failed-format-not-supported=1");
        exit;
    }

    if(!$file["error"] === 0)
    {
        echo "Unknown error";
        header("Location:user-modify-form.php?user_id=".$_SESSION["user_id"]."&upload-failed-unknown-error=1");
        exit;
    }

    $file_name_new = $_SESSION["user_id"].".".$file_extension[1];
    $file_destination = "images/profile-photos/".$file_name_new;

    unlink("images/profile-photos/".$_SESSION["user_id"].".jpg");
    unlink("images/profile-photos/".$_SESSION["user_id"].".jpeg");
    unlink("images/profile-photos/".$_SESSION["user_id"].".png");

    if(move_uploaded_file($file["tmp_name"], $file_destination))
    {
        echo "File uploaded";
        header("Location:user-modify-form.php?user_id=".$_SESSION["user_id"]."&image-uploaded=1");
        exit;
    }
    else{
        echo "File couldn't be uploaded";
        header("Location:user-modify-form.php?user_id=".$_SESSION["user_id"]."&upload-failed-unknown-error=1");
        exit;
    }

?>