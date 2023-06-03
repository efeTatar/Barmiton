<?php
    include "libraries/hn-user-moderation.php";
    session_start();
    $user_id = $_GET["user_id"];
    if(strcmp("", $user_id) == 0)
    {
        header("Location:index.php");
        exit;
    }

    if(strcmp($_SESSION["user_id"], $user_id) != 0)
    {
        header("Location:test-profile-page.php?user_id=".$user_id);
        exit;
    }
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,500&family=Lobster&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <style></style>
    
    <link rel='stylesheet' type='text/css' href='css/hn-barmiton.css'>
    <title>Profile Page</title>

    <script type="text/javascript" src="libraries/hn-recipe-moderation.js"></script>
    <script type="text/javascript" src="libraries/hn-user-moderation.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script>
		recipe_search_initialise();
	</script>

    <script>
        user_profile_picture_display(<?php echo $user_id; ?>);
        user_info_display(<?php echo $user_id; ?>);
        user_recipes_display(<?php echo $user_id; ?>);
        profile_recipe_switch();
        function recipe_remove(recipe_id)
        {
            if (!confirm("Do you want to proceed ?")) {
                return;
            }
            recipe_destroy(recipe_id);
            user_recipes_display(<?php echo $user_id; ?>);
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

        <div class="row">
            <div class="menu-segment">

                <div id="profile-picture-div">
                    <img id="profile-photo" class="animation-2" src=<?php echo "images/profile-photos/".$user_id.".jpg"; ?> >
                </div>
                
                <form action="profile-photo-upload-call.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile-picture">
                    <input type="submit" value="upload">
                </form>
            </div>
            
            <div class="menu-segment" id="user-info">
                <h1>Efe Tatar</h1>
                <p>@efe-tatar</p>
                <p><?php echo $user_id; ?></p>
            </div>
        </div>

        <div class="row">
            <form action="user-modify-call.php" method="post">
                <input name="user_id" type="hidden" value="<?php echo $user_id; ?>">
                <input class="profile-modify-form-input" name="username" tpye="text" placeholder="Username"><br>
                <input class="profile-modify-form-input" name="password" tpye="password" placeholder="Password"><br>
                <input class="profile-modify-form-input" name="name" type="text" placeholder="Name"><br>
                <input class="profile-modify-form-input" name="surname" type="text" placeholder="Surname"><br>

                <input class="profile-modify-form-input" type="submit" value="Save">
            </form><br>
        </div>

        <div>
            <button>Delete Account</button>
        </div>
    </div>
</body>

</html>