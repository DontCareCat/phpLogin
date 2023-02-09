<?php
	if(isset($_POST['login'])){
		session_start();
		include('dbcon.php');
		$username=$_POST['username'];
		$password=$_POST['password'];
		$query=mysqli_query($dbcon,"select * from `Users` where USERNAME='$username'");
		if (mysqli_num_rows($query) == 0){
			$_SESSION['message']="User not found";
			header("location:index.php");
		}
		else{
			$row=mysqli_fetch_array($query);
			if(isset($_POST['rememberme'])){
				setcookie("user",$row['USERNAME'],time() + (86400*30));
				setcookie("password",$password,time()+(86400*30));
			}
			if($row['SESSIONID'==0]){
				$sessionID=rand(1,999);
				$hashedpassword= hash('sha256',$password.$row['SALT']);
				if($row['HASHPASSWD']==$hashedpassword){
					setcookie("sessionID",$sessionID,time()+3600);
					$sqlstring="UPDATE Users SET SESSIONID=".$sessionID.", LASTLOGIN=SYSDATE() WHERE ID=".$row['ID'];
					if($dbcon->query($sqlstring) === TRUE){
						$_SESSION['message']="SESSIONID updated";
					}
					else{
						$_SESSION['message']="failed to update SESSIONID";
					}
					$_SESSION['id']=$sessionID;
					header('location:success.php');
				}
				else{
					$_SESSION['message']="Incorecct password";
					header('location:index.php');
				}
			}
			else{
				header('location:index.php');
				$_SESSION['message']='Already logged in';
			}
		}
	}
	if(isset($_POST['register'])){
		session_start();
		include('dbcon.php');
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
				setcookie("password",$password,time()+(86400*30));
			}
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$salt ='';
			for ($i=0; $i< 16; $i++){
				$index=rand(0,strlen($characters)-1);
				$salt.=$characters[$index];
			}
			$cryptedpassword = hash('sha256',$password.$salt);
			$sqlstring = "INSERT INTO Users ( USERNAME , HASHPASSWD , SALT ) VALUES ( \"".$username."\" , \"".$cryptedpassword."\" , \"".$salt."\" )";
			if($dbcon->query($sqlstring) === TRUE){
				$_SESSION['message']="Users updated";
			}
			else{
				$_SESSION['message']="failed to update Users";
			}
			header("location:index.php");
		}
	}
?>