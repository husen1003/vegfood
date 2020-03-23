<?php


	# Creating Images Folder if not exists

	if(!is_dir('products')){
		mkdir('products');
	}


	$con = mysqli_connect("localhost","root","");
	$db = 'vegfoods';
	$createDb = "CREATE DATABASE $db";
	mysqli_query($con, $createDb);
	$con = mysqli_connect("localhost","root","", $db);



	$createAdminTbl = "CREATE TABLE admin(
		id INT(6) AUTO_INCREMENT PRIMARY KEY,
		fname VARCHAR(50) NOT NULL,
		lname VARCHAR(50) NOT NULL,
		mo VARCHAR(50) NOT NULL,
		email VARCHAR(50) NOT NULL,
		pass VARCHAR(50) NOT NULL,
		added_by VARCHAR(50) NOT NULL,
		verified VARCHAR(50) NOT NULL,
		otp VARCHAR(50) NOT NULL,
		removed_by VARCHAR(50) NOT NULL
	)";

	mysqli_query($con, $createAdminTbl);

	$check = mysqli_query($con, "SELECT * FROM admin WHERE email = 'husen@gmail.com'");
	$existornot = mysqli_num_rows($check);
	if($existornot == 0){
		$insertadmin = "INSERT INTO admin VALUES(NULL, 'Husen', 'Lokhandwala', '7016868559', 'husen@gmail.com','e2fc714c4727ee9395f324cd2e7f331f','Source','yes','777777', 'NONE')";
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
		otp VARCHAR(50) NOT NULL,
		removed_by VARCHAR(50) NOT NULL
	)";

	mysqli_query($con, $createUserTable);


	$createProductTable = "CREATE TABLE product(
		id INT(6) AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50) NOT NULL,
		price VARCHAR(50) NOT NULL,
		image VARCHAR(500) NOT NULL,
		category VARCHAR(50) NOT NULL,
		description VARCHAR(1000) NOT NULL
	)";

	mysqli_query($con, $createProductTable);



?>