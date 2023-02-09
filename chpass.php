<?php
	if(isset($_POST['password'])){
		session_start();
		include('dbcon.php');
		$newpassword=$_POST['password'];
		$oldpassword=$_COOKIE['password'];
		$username=$_SESSION['user'];
		$cookieSessionId=$_COOKIE['sessionID'];
		$query=mysqli_query($dbcon,"SELECT * FROM `Users` where USERNAME='$username'");
		if(mysqli_num_rows($query) == 0 || mysqli_num_rows($query) >1){
			$_SESSION['message']="User not found OR too many users";
			header("location:index.php");
		}
		else{
			$row=mysqli_fetch_array($query);
			if(isset($_POST['rememberme'])){
				setcookie("user",$row['USERNAME'],time() + (86400*30));
				setcookie("password",$password,time()+(86400*30));
			}
			if($row['SESSIONID']==$_SESSION['id'] && $row['SESSIONID']==$cookieSessionId){
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$salt ='';
				for ($i=0; $i< 16; $i++){
					$index=rand(0,strlen($characters)-1);
					$salt.=$characters[$index];
				}
				$cryptedpassword = hash('sha256',$password.$salt);
				$sqlstring="UPDATE `Users` SET HASHPASSWD=\"".$cryptedpassword."\" , SALT=\"".$salt."\" WHERE USERNAME=\"".$_SESSION['user']."\" AND SESSIONID=".$_SESSION['id']." AND ID=".$row['ID'];
				#$sqlstring="UPDATE Users SET HASHPASSWD=".$cryptedpassword.", SALT=".$salt." , LASTLOGIN=SYSDATE() WHERE ID=".$row['ID'];
				if($dbcon->query($sqlstring) === TRUE){
					$_SESSION['message']="Password updated successfully";
				}
				else{
					$_SESSION['message']="Failed to update Password";
				}
				header("location:index.php");
			}
			else{
				$_SESSION['message']="Unexpected session issue";
				header("location:index.php");
			}
		}
	}
?>