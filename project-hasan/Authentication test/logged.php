<!DOCTYPE html>
<html>
	
<head>
</head>

<body>
    <h1>YAAAAAAAAAAAay</h1>
</body>

</html>

<?php
    session_start();
    echo "session: ".$_SESSION["username"]."<br>";
    session_destroy();
?>