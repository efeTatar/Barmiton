<?php
    include "libraries/hn-user-moderation.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&family=Lobster&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <style></style>
    <script></script>
    <link rel='stylesheet' type='text/css' href='css/hn-barmiton.css'>
    <title>Sign Up</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="libraries/hn-recipe-moderation.js"></script>

	<script>
		recipe_search_initialise();
	</script>
</head>

<body>
    <header>
        
    </header>

    <div id="navigation-bar">
        <div class="navigation-bar-sub-segment">
            <p id="navigation-bar-title">Barmiton</p>
            <p><a href="index.php">Home Page</a></p>
            <p><a href="browse.php">Browse</a></p>
            <p><a href="recipe-proposition-form.php">Publish Recipe</a></p>
            <?php
                session_start();
                if(check_adminship($_SESSION["user_id"]) == 0)
                {
                    echo "<p id='admin-console-button'><a href='admin-console.php'>Admin Console</a></p>";
                }
            ?>
            <input type="text" id="search" placeholder="Coctail, ingredient, user...">
	        <div id="display"></div>
        </div>
        
        <div class="navigation-bar-sub-segment">
            <?php
                session_start();
                echo "<p><a href='test-profile-page.php?user_id=".$_SESSION["user_id"]."'>".$_SESSION["username"]."</a></p>";
                if (!$_SESSION["username"]){
                    echo "<p id='log-in-button'><a href='sign-in-form.php'>Sign In</a></p>";
                }
                if ($_SESSION["username"]){
                    echo "<p><a href='sign-out-call.php'>Sign Out</a></p>";
                }
            ?>
        </div>
    </div>

    <div id="container">

        <div class="row">

            <div class="menu-segment">

                <h3>Sign Up</h3>
                <form action="sign-up-call.php" method="post">
                    <input class="text-input" name="username" tpye="text" placeholder="Username">
                    <input class="text-input" name="password" tpye="password" placeholder="Password">
                    <input class="text-input" name="name" type="text" placeholder="Name">
                    <input class="text-input" name="surname" type="text" placeholder="Surname">

                    <input type="submit" value="sign up">
                </form><br>

                <a href="sign-in-form.php">sign in</a>

            </div>

        </div>

    </div>
</body>

</html>