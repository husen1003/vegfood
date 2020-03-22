<?php

	$con = mysqli_connect("localhost","root","");
	$db = 'vegfoods';
	$createDb = "CREATE DATABASE $db";
	mysqli_query($con, $createDb);
	$con = mysqli_connect("localhost","root","", $db);
	$createAdminTbl = "CREATE TABLE admin(
		id INT(6) AUTO_INCREMENT PRIMARY KEY,
		email VARCHAR(50) NOT NULL,
		pass VARCHAR(30) NOT NULL
	)";

	mysqli_query($con, $createAdminTbl);

	$check = mysqli_query($con, "SELECT * FROM admin WHERE email = 'husen@gmail.com' AND pass = 'abcd'");
	$existornot = mysqli_num_rows($check);
	if($existornot == 0){
		$insertadmin = "INSERT INTO admin VALUES(NULL, 'husen@gmail.com','abcd')";
		mysqli_query($con, $insertadmin);
	}


	$createUserTable = "CREATE TABLE user(
		id INT(6) AUTO_INCREMENT PRIMARY KEY,
		fname VARCHAR(50) NOT NULL,
		lname VARCHAR(50) NOT NULL,
		mo VARCHAR(50) NOT NULL,
		email VARCHAR(50) NOT NULL,
		pass VARCHAR(50) NOT NULL,
		verified VARCHAR(50) NOT NULL,
		otp VARCHAR(50) NOT NULL
	)";

	mysqli_query($con, $createUserTable);

?>