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
    <title>Browse</title>

    <script type="text/javascript" src="libraries/hn-recipe-moderation.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script>
		recipe_search_initialise();
	</script>

    <script>
        browse_display_call();    
    </script>

    <script>
        function recipe_remove(recipe_id)
        {
            if (!confirm("Do you want to proceed ?")) {
                return;
            }
            recipe_destroy(recipe_id);
            browse_display_call();
        }
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

        <div id="browse">
        </div>

    </div>
</body>

</html>