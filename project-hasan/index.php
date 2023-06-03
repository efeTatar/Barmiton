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
    <title>Welcome to Barmiton!</title>
    
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
            <input type="text" id="search" placeholder="🔎 Coctail, ingredient, user...">
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
        <h1 style="margin-bottom: 0px;" id="title">Barmiton</h1>
        <img src="images/menu-decor" id="decor">

        <div class="row">
            <div id="trending" class="menu-segment">
                <h3>Trending</h3>
                <hr style="width: 75%;">
                <p>Cocktail A ⭐⭐⭐⭐⭐</p>
                <p>Cocktail B ⭐⭐⭐⭐</p>
                <p>Cocktail C ⭐⭐⭐</p>
                <p>Cocktail D ⭐⭐⭐⭐</p>
                <p>Cocktail E ⭐⭐⭐</p>
            </div>
            <img class="menu-segment" src="https://www.tastingtable.com/img/gallery/11-cocktails-to-try-if-you-like-drinking-gin/intro-1659025591.jpg">
        </div>

        <div class="row">
            <img id="second-image" class="menu-segment" src="https://img.delicious.com.au/F_C2-w6_/w759-h506-cfill/del/2015/11/summer-cocktails-24374-3.jpg">
            <div id="ranking" class="menu-segment">
                <h3>Highest ranked</h3>
                <hr style="width: 75%;">
                <p>Cocktail A ⭐⭐⭐⭐⭐</p>
                <p>Cocktail B ⭐⭐⭐⭐⭐</p>
                <p>Cocktail C ⭐⭐⭐⭐⭐</p>
                <p>Cocktail D ⭐⭐⭐⭐⭐</p>
                <p>Cocktail E ⭐⭐⭐⭐⭐</p>
            </div>
        </div>

        <div class="row">
            <div id="recent" class="menu-segment">
                <h3>Recently Added</h3>
                <hr style="width: 75%;">
                <p>Cocktail A ⭐⭐⭐</p>
                <p>Cocktail B ⭐⭐</p>
                <p>Cocktail C ⭐⭐⭐⭐</p>
                <p>Cocktail D ⭐</p>
                <p>Cocktail E ⭐⭐⭐⭐⭐</p>
            </div>
            <img id="third-image" class="menu-segment" src="https://insanelygoodrecipes.com/wp-content/uploads/2021/09/Cold-Strawberry-Cocktail-with-Fresh-Strawberries-and-Mint.jpg">
        </div>

    </div>
</body>

</html>