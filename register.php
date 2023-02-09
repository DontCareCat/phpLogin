<?php
	if(isset($_POST['login'])){
		session_start();
		include(dbcon.php);
		$username=$_POST['username'];
		$password=$_POST['password'];
		$query=mysqli_query($dbcon,"select * from `Users` where USERNAME='$username'");
		if (mysqli_num_rows($query) != 0){
			$_SESSION['message']="User already exists";
			header("location:index.php");
		}
		else{
			if(isset($_POST['rememberme'])){
				setcookie("user",$row['USERNAME'],time() + (86400*30));
				setcookie("password",$password],time()+(86400*30));
			}
			$salt=random_bytes(16);
			$cryptedpassword = hash('sha256',$password.$salt)
			$sqlstring = "INSERT INTO Users (USERNAME, HASHPASSWD, SALT) VALUES (".$username.",".$cryptedpassword.",".$salt.")"
			if($dbcon->query($sqlstring) === TRUE){
				$_SESSION['message']="Users updated";
			}
			else{
				$_SESSION['message']="failed to update Users";
			}
			header("index.php");
		}
	}
	else{
		header('location:index.php');
		$_SESSION['message']="Please register";
	}
?>