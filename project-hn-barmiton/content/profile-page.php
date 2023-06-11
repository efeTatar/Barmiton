<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&family=Lobster&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <style></style>
    
    <link rel='stylesheet' type='text/css' href='../css/hn-barmiton.css'>
    <title>Profile Page</title>

    <!-- navigation bar -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- hn libraries -->
    <script type="text/javascript" src="../libraries/hn-recipe-moderation.js"></script>
    <script type="text/javascript" src="../libraries/hn-user-moderation.js"></script>
    <script type="text/javascript" src="../libraries/hn-comment-moderation.js"></script>

    <!-- navigation bar -->
    <script>
        //user state
        navigation_bar_user_segment_display();
        admin_console_button_display();
        
        //search bar
        recipe_search_initialise();
    </script>

    <!-- user profile page -->
    <script>
        //user id extraction
        const get_variables = window.location.search;
        user_id = get_variables.split('=')[1];
        console.log(user_id);

        //user information
        user_profile_picture_display(user_id);
        user_info_display(user_id);

        //user publications
        user_recipes_display(user_id);
        user_comment_display(user_id);
        profile_recipe_switch();
        
        //validation button
        function recipe_remove(recipe_id)
        {
            if (!confirm("Do you want to proceed ?")) {
                return;
            }
            recipe_destroy(recipe_id);
            user_recipes_display(user_id);
        }

        //comment removal function
        function comment_remove(comment_id)
        {
            comment_remove_call(comment_id);
            user_comment_display(user_id);
        }
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
                <div id="profile-picture-div">
                    <img id="profile-photo" class="animation-2">
                </div>
            </div>
            
            <div class="menu-segment" id="user-info">
            </div>
        </div>

        <div class="row">
            <button onclick="profile_recipe_switch()">Recipes</button>
            <button onclick="profile_comment_switch()">Comments</button>
        </div>
        <div class="row" id="segment-profile-page">
            <div id="segment-recipe">
            </div>
            <div id="segment-comment">
            </div>
        </div>

    </div>
</body>

</html>