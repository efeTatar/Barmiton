<?php
    session_start();
    if (!(session_status() == PHP_SESSION_ACTIVE && $_SESSION["username"] != "")){
        header("Location:index.php");
    }

    include "libraries/hn-user-moderation.php";
    include "libraries/hn-recipe-moderation.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/temporary.css">
    <style>
        #user-recipes{
            background-color: grey;
            width: 50%;
        }
        #selected-button{
            background-color: grey;
            color: white;
        }
        #selected-button:hover{
            background-color: black;
        }
        .overview-content{
            display: inline-block;
        }
        #admin-console{
            background-color: red;
        }
        div{
            padding: 15px;
        }
    </style>

    <script type="text/javascript" src="libraries/hn-recipe-moderation.js"></script>

    <script>
        user_recipes_display(100001);
    </script>
</head>

<body>
    <a href="index.php">Home Page</a>
    <h1>User Recipes</h1>
    <?php echo "<p>session: ".$_SESSION["username"]."</p>"; ?>

    <a href="profile-page.php">Overview</a>
    <a id="selected-button">Recipes</a>
    <a>Comments</a>
    <a id="admin-console" href="admin-console.php">Admin Console</a>

    <div id="user-recipes">
        <p>hello</p>
    </div>
    
</body>

</html> 