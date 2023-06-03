<!DOCTYPE html>
<html>
	
<head>
</head>

<body>
	<h2>Authentication</h2>
	<form action="login.php" method="post">
		<label for="usr">Username</label>
		<input id="usr" name="username" tpye="text">
		<br>
		<br>
		
		<label for="psw">Password</label>
		<input id="psw" name="password" type="password">
		<br>
		<br>

		<input type="submit" value="Login">
	</form>

	<h2>Sign Up</h2>
	<form action="signup.php" method="post">
		<label for="usr">Username</label>
		<input id="usr" name="username" tpye="text">
		<br>
		<br>
		
		<label for="psw">Password</label>
		<input id="psw" name="password" type="password">
		<br>
		<br>

		<label for="nme">Name</label>
		<input id="nme" name="name" type="text">
		<br>
		<br>

		<label for="srnme">Surname</label>
		<input id="srnme" name="surname" type="text">
		<br>
		<br>

		<input type="submit" value="sign up">
	</form>

	<h2>Modify user rights</h2>
	<form action="modify_rights.php" method="post">
		<label for="usr">User ID</label>
		<input id="usr" name="user_id" tpye="text">
		<br>
		<br>
		<input type="checkbox" id="AR" name="add_recipe" value="1">
		<label for="AR">add_recipe</label><br>
		<input type="checkbox" id="C" name="comment" value="1">
		<label for="C">comment</label><br>
		<input type="checkbox" id="PM" name="product_management" value="1">
		<label for="PM">product_management</label><br>
		<input type="checkbox" id="VR" name="validate_recipe" value="1">
		<label for="VR">validate_recipe</label><br>
		<input type="checkbox" id="MAC" name="manage_access_comments" value="1">
		<label for="MAC">manage_access_comments</label><br>
		<input type="checkbox" id="UA" name="user_awards" value="1">
		<label for="UA">user_awards</label><br><br>

		<input type="submit" value="proceed">
	</form>

	<h2>Remove user</h2>
	<form action="remove_user.php" method="post">
		<label for="usr">Username</label>
		<input id="usr" name="username" tpye="text">
		<br><br>

		<input type="submit" value="delete">
	</form>

</body>

</html>