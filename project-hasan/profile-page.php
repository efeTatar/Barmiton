<?php
    session_start();
    if (!(session_status() == PHP_SESSION_ACTIVE && $_SESSION["username"] != "")){
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/temporary.css">
    <style>
        #overview{
            background-color: grey;
            width: 50%;
        }
        #profile-button{
            background-color: grey;
            color: white;
        }
        #profile-button:hover{
            background-color: black;
        }
        .overview-content{
            display: inline-block;
        }
        #admin-console{
            background-color: red;
        }
        input{
            margin-bottom: 10px;
        }
        #modify{
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <a href="index.php">Home Page</a>
    <h1>Profile Page</h1>
    <?php echo "<p id='username-div'>session: ".$_SESSION["username"]."</p>"; ?>

    <a id="profile-button">Overview</a>
    <a href="user-recipes.php">Recipes</a>
    <a>Comments</a>
    <a id="admin-console" href="admin-console.php">Admin Console</a>

    <div id="overview">
        <div id="modify">
            <label for="username">Username</label>
            <input id="username" name="username" type="text"><br>

            <label for="password">Password</label>
            <input id="password" name="password" type="password"><br>

            <label for="name">Name</label>
            <input id="name" name="name" type="text"><br>

            <label for="surname">Surname</label>
            <input id="surname" name="surname" type="text"><br>

            <button onclick="">Save</button>
        </div>

        <a class="overview-content" href="log-out.php">Log Out</a><br>
        <a class="overview-content">Settings</a>
    </div>
    
</body>

</html> 