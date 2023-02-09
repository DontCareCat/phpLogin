<?php
	sessin_start();
	if (!isset($_SESSION['id']) || )
	include('dbcon.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login with Session&Cookie </title>
	</head>
	<body>
		 <h2>Change passord</h2>
		 <form method="POST" action="chpass.php">
		 <label>Change password</label>
		 <label>Username:</label><input type="text" value="<?php if (isset($_COOKIE["user"])){echo $_COOKIE["user"];}?>" name="username">
		 <label>Password:</label><input type="password" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="password"><br><br>
		 <input type="checkbox" name="remember"<?php if (isset($_COOKIE["user"]) && isset($_COOKIE["pass"])){ echo "checked";}?>> Remember me <br><br>
		 <input type="submit" value="Login" name="login">
		 </form>
		 <span>
		 <?php
		  if (isset($_SESSION['message'])){
		   echo $_SESSION['message'];
		  }
		  unset($_SESSION['message']);
		 ?>
		</span>
	</body>
</html>