<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&family=Lobster&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <style></style>
    <script></script>
    <link rel='stylesheet' type='text/css' href='../css/hn-barmiton.css'>
    <title>Sign In</title>

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

        <div class="row">

            <div class="menu-segment">

                <h3>Sign In</h3>
                <form action="../requests/user-moderation-requests/sign-in-request.php" method="post">
                    <input class="text-input" name="username" tpye="text" placeholder="Username">
                    <input class="text-input" name="password" type="password" placeholder="Password">
                    <input type="submit" value="Login">
                </form><br>

                <a href="sign-up-form.php">sign up</a>

            </div>

        </div>

    </div>
</body>

</html>