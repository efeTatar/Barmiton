<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&family=Lobster&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <style></style>
    
    <link rel='stylesheet' type='text/css' href='../css/hn-barmiton.css'>
    <title>Profile Page</title>

    <script type="text/javascript" src="../libraries/hn-recipe-moderation.js"></script>
    <script type="text/javascript" src="../libraries/hn-user-moderation.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script>
		recipe_search_initialise();
	</script>

    <script>
        //user id extraction
        const get_variables = window.location.search;
        user_id = get_variables.split('=')[1];
        console.log(user_id);

        user_profile_picture_display(user_id);
        user_info_display(user_id);

        navigation_bar_user_segment_display();
        admin_console_button_display();

        //validation button
        function account_self_destroy()
        {
            if (!confirm("Do you want to proceed ?")) {
                return;
            }
            window.location.href = "../requests/user-moderation-requests/user-destroy-self-request.php";
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
                
                <form action="../requests/user-moderation-requests/profile-picture-upload-request.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile-picture">
                    <input type="submit" value="upload">
                </form>
            </div>
            
            <div class="menu-segment" id="user-info">
            </div>
        </div>

        <div class="row">
            <form action="../requests/user-moderation-requests/user-modify-request.php" method="post">
                <input id="test" name="user_id" type="hidden">
                <script>
                    document.getElementById('test').value = user_id;
                </script>
                <input class="profile-modify-form-input" name="username" type="text" placeholder="Username"><br>
                <input class="profile-modify-form-input" name="password" type="password" placeholder="Password"><br>
                <input class="profile-modify-form-input" name="name" type="text" placeholder="Name"><br>
                <input class="profile-modify-form-input" name="surname" type="text" placeholder="Surname"><br>

                <input class="profile-modify-form-input" type="submit" value="Save">
            </form><br>
        </div>

        <div>
            <p id="delete-account-button" onclick="account_self_destroy()">Delete Account</p>
        </div>
    </div>
</body>

</html>