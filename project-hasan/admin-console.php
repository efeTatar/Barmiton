<?php
    include "libraries/hn-recipe-moderation.php";

    session_start();
    if (!(session_status() == PHP_SESSION_ACTIVE && $_SESSION["username"] != "")){
        header("Location:index.php");
    }
    
    if(check_adminship($_SESSION["user_id"]) == 1){
        header("Location:profile-page.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Console</title>
    <link rel="stylesheet" type="text/css" href="css/temporary.css">
    <script type="text/javascript" src="libraries/hn-recipe-moderation.js"></script>

    <style>
        #overview{
            background-color: grey;
            width: 50%;
        }
        #admin-button{
            background-color: grey;
            color: white;
        }
        #admin-button:hover{
            background-color: black;
        }
        .content{
            display: inline-block;
        }
        .admin-console{
            background-color: grey;
        }
        div{
            padding: 15px;
        }
    </style>

    <script>
        recipe_propositions_display();
    </script>
    
</head>

<body>
    <a href="index.php">Home Page</a>
    <h1>Admin Console</h1>
    <?php echo "<p>session: ".$_SESSION["username"]."</p>"; ?>

    <a class="admin-console" id="admin-button">Admin Console</a>

    <div class="admin-console">

        <h3>Modify User Rights</h3>
        <form action="user-rights-modify.php" method="post">
            <label for="usr">User ID</label>
            <input id="usr" name="user_id" tpye="text">
            <br><br>
            <input type="checkbox" id="recipe_checkbox" name="recipe" value="1">
            <label for="recipe_checkbox">recipe</label><br>
            <input type="checkbox" id="comment_checkbox" name="comment" value="1">
            <label for="comment_checkbox">comment</label><br>
            <input type="checkbox" id="admin_checkbox" name="admin" value="1">
            <label for="admin_checkbox">admin</label><br>
            <br>
            <input type="submit" value="proceed">
        </form>

        <h3>Delete User</h3>
        <form action="user-destroy.php" method="post">
            <label for="id">User ID</label>
            <input id="id" name="user_id" tpye="text">
            <br><br>
            <input type="submit" value="delete"><br>
        </form><br>

        <div id="propositions">
        </div>

    </div>
    
</body>

</html>