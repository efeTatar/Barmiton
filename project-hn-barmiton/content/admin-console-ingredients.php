<!DOCTYPE html>
<html>

<head>
    <title>Admin Console</title>
    <link rel='stylesheet' type='text/css' href='../css/admin-console.css'>
    <script type="text/javascript" src="../libraries/hn-recipe-moderation.js"></script>
    <script>
        ingredient_display_call();
    </script>

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
    </style>

    <script>
    </script>
    
</head>

<body>
    <a href="home-page.php">Home Page</a>
    <h1>Admin Console</h1>

    <a href="admin-console.php" class="admin-button">Recipe Moderation</a>
    <a href="admin-console-ingredients.php" class="admin-button" id="selected">Ingredients Moderation</a>
    <a href="admin-console-users.php" class="admin-button">User Moderation</a>

    <div class="admin-console">

        <div id="ingredients">
        </div>

    </div>
    
</body>

</html>