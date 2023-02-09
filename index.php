<?php
	session_start();
	include(dbcon.php);
?>
<!DOCTYPE html>
<html>
<head>
<title>login&cookie</title>
</head>
<body>
	<h2>Input your Login and Pass</h2>
	<form method="POST" action="login.php">
	<label>USERNAME:</label><input type="text" value="<?php if (isset($_COOKIE["user"])){echo $_COOKIE["user"];}?>" name="username">
	<label>PASSWORD:</label><input type="password" value="<?php if (isset($_COOKIE)){echo $_COOKIE["password"];}?>" name="password"><br><br>
	<input type="checkbox" name="rememberme"<?php if (isset($_COOKIE["user"]) && isset($_COOKIE["password"])){ echo "checked";}?>> Remember me <br><br>
	<input type="submit" value="Login" name="login">
	</form>
	<span>
		<?php
			if (isset($_SESSION['message'])){
				echo $_SESSION['message'];
			}
			unset($_SESSION['message'])
		?>
	</span>
</body>
</html>