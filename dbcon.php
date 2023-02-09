<?php
	$host='localhost';
	$user='ubuntutestwhm_U1';
	$password='P@ssw0rd';
	$dbName='ubuntutestwhm_loginDB';
	$dbcon=mysqli_connect($host,$user,$password,$dbName);
	if(!$dbcon){
		die('Could not connect to mysql server:' .mysql_error());
	}
?>