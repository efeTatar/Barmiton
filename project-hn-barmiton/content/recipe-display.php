<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&family=Lobster&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <style></style>
    <script></script>   
    <link rel='stylesheet' type='text/css' href='../css/recipe_display.css'>
    <link rel='stylesheet' type='text/css' href='../css/hn-barmiton.css'>
    <title>Recipe display</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../libraries/hn-recipe-moderation.js"></script>
    <script type="text/javascript" src="../libraries/hn-user-moderation.js"></script>
    <script type="text/javascript" src="../libraries/hn-comment-moderation.js"></script>

	<script>
        //user id extraction
        const get_variables = window.location.search;
        recipe_id = get_variables.split('=')[1];
        console.log(recipe_id);

		recipe_search_initialise();
        navigation_bar_user_segment_display();
        admin_console_button_display();
        recipe_display_call(recipe_id);
        recipe_comment_display(recipe_id);

        //comment removal function
        function comment_remove(comment_id)
        {
            comment_remove_call(comment_id);
            recipe_comment_display(recipe_id);
        }
	</script>

    <script>
    </script>
</head>

<body>
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

    <div id='container'>
        
        <div id="recipe-display-box">
        </div>

        <br>

        <form id="comment-box" action="../requests/comment-moderation-requests/comment-log-request.php" method="post">
            <input id="recipeID" name="recipe_id" type="hidden">
            <script>
                document.getElementById('recipeID').value = recipe_id;
            </script>
            <input class="text-input" name="comment_text" tpye="text" placeholder="Your thoughts">
            <input name="rating" type="number" min="0" max="5" placeholder="Rate this recipe">

            <input type="submit" value="Comment">
        </form><br>         

        <div id="comments">
            <p>comments</p>
        </div>

    </div>
</body>

</html>