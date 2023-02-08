<?php
	if(isset($_POST['login'])){
		session_start();
		include(dbcon.php);
		$username=$_POST['username'];
		$password=$_POST['password'];
		$query=mysqli_query($dbcon,"select * from `Users` where USERNAME='$username'");
		if (mysqli_num_rows($query) == 0){
			$_SESSION['message']="User not found";
			header("location:loginSSCK.php");
		}
		else{
			$row=mysqli_fetch_array($query);
			if(isset($_POST['rememberme'])){
				setcookie("user",$row['USERNAME'],time() + (86400*30));
				setcookie("password",$password],time()+(86400*30));
			}
			if($row['SESSIONID'==0]){
				$sessionID=rand(1,999);
				setcookie("sessionID"=$sessionID,time()+3600);
				$sqlstring="UPDATE Users SET SESSIONID=".$sessionID."WHERE ID=".row['ID'];
				if($dbcon->query($sqlstring) === TRUE){
					$_SESSION['message']="SESSIONID updated";
				}
				else{
					$_SESSION['message']="failed to update SESSIONID";
				}
				$_SESSION['id']=$sessionID;
			}
			else{
				header("location:alreadyLoggedIn.html");
			}
		}
	}
	else{
		
	}
?>