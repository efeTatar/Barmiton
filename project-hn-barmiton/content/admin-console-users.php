<!DOCTYPE html>
<html>

<head>
    <title>Admin Console</title>
    <link rel='stylesheet' type='text/css' href='../css/admin-console.css'>
    <script type="text/javascript" src="../libraries/hn-recipe-moderation.js"></script>

    <style>
        #overview{
            background-color: grey;
            width: 50%;
        }
        .admin-button{
            margin: auto 0px;
            background-color: lightgrey;
            color: black;
        }
        #selected
        {
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
        label, h3
        {
            color: white;
        }
    </style>

    <script>
    </script>
    
</head>

<body>
    <a href="home-page.php">Home Page</a>
    <h1>Admin Console</h1>

    <a href="admin-console.php" class="admin-button">Recipe Moderation</a>
    <a href="admin-console-ingredients.php" class="admin-button">Ingredients Moderation</a>
    <a href="admin-console-users.php" class="admin-button" id="selected">User Moderation</a>

    <div class="admin-console">

        <h3>Modify User Rights</h3>
        <form action="../requests/user-moderation-requests/user_rights_modify_request.php" method="post">
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
        <form action="../requests/user-moderation-requests/user-destroy-request.php" method="post">
            <label for="id">User ID</label>
            <input id="id" name="user_id" tpye="text">
            <br><br>
            <input type="submit" value="delete"><br>
        </form><br>
    </div>
    
</body>

</html>