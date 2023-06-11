<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&family=Lobster&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <style></style>
    <script></script>
    <link rel='stylesheet' type='text/css' href='../css/hn-barmiton.css'>
    <title>Welcome to Barmiton!</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../libraries/hn-recipe-moderation.js"></script>
    <script type="text/javascript" src="../libraries/hn-user-moderation.js"></script>

	<script>
		recipe_search_initialise();
        navigation_bar_user_segment_display();
        admin_console_button_display();
	</script>
    
</head>

<body>
    <header>
        
    </header>

    <div id="navigation-bar">
        <div class="navigation-bar-sub-segment">
            <p id="navigation-bar-title">Barmiton</p>
            <p><a href="home-page.php">Home Page</a></p>
            <p><a href="browse.php">Browse</a></p>
            <p><a href="recipe-proposition-form.php">Publish Recipe</a></p>
            <div id="admin-button" class="navigation-bar-sub-segment"></div>
            <input type="text" id="search" placeholder="🔎 Search for cocktails">
            <div id="display"></div>
            
        </div>
        
        <div class="navigation-bar-sub-segment" id="navigation-bar-user-segment">
        </div>
    </div>

    <div id="container">
        <h1 style="margin-bottom: 0px;" id="title">Barmiton</h1>
        <img src="../images/menu-decor" id="decor">

        <div class="row">
            <div id="trending" class="menu-segment">
                <h3>Trending</h3>
                <hr style="width: 75%;">
                <p>Gin Tonic ⭐⭐⭐⭐</p>
                <p>Tequila Sunrise ⭐⭐⭐⭐</p>
                <p>Mojito ⭐⭐⭐⭐⭐</p>
                <p>Margarita ⭐⭐⭐</p>
                <p>Blue Lagoon ⭐⭐⭐⭐⭐</p>
            </div>
            <img class="menu-segment" src="https://www.tastingtable.com/img/gallery/11-cocktails-to-try-if-you-like-drinking-gin/intro-1659025591.jpg">
        </div>

        <div class="row">
            <img id="second-image" class="menu-segment" src="https://img.delicious.com.au/F_C2-w6_/w759-h506-cfill/del/2015/11/summer-cocktails-24374-3.jpg">
            <div id="ranking" class="menu-segment">
                <h3>Highest ranked</h3>
                <hr style="width: 75%;">
                <p>Mojito ⭐⭐⭐⭐⭐</p>
                <p>Gin Fizz ⭐⭐⭐⭐⭐</p>
                <p>Sex on the beach ⭐⭐⭐⭐⭐</p>
                <p>Black Russian ⭐⭐⭐⭐⭐</p>
                <p>Dry Martini ⭐⭐⭐⭐⭐</p>
            </div>
        </div>

        <div class="row">
            <div id="recent" class="menu-segment">
                <h3>Recently Added</h3>
                <hr style="width: 75%;">
                <p>WaterMelon Vodka ⭐⭐</p>
                <p>Cocktail de la muerte ⭐⭐⭐⭐⭐</p>
                <p>Screwdriver ⭐⭐⭐⭐⭐</p>
                <p>Caipirovska ⭐⭐⭐</p>
                <p>Woo woo ⭐⭐⭐⭐⭐</p>
            </div>
            <img id="third-image" class="menu-segment" src="https://insanelygoodrecipes.com/wp-content/uploads/2021/09/Cold-Strawberry-Cocktail-with-Fresh-Strawberries-and-Mint.jpg">
        </div>

    </div>
</body>

</html>