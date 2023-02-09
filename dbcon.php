<?php
	$host='localhost';
	$user='ubuntutestwhm_U1';
	$password='P@ssw0rd';
	$dbName='ubuntutestwhm_loginDB';
	$dbCon=mysqli_connect($host,$user,$password,$dbName);
	if(!$dbCon){
		die('Could not connect to mysql server:' .mysql_error());
	}
?>