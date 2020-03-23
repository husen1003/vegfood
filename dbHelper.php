<?php


	# Creating Images Folder if not exists

	if(!is_dir('products')){
		mkdir('products');
	}


	# Connecting to the Localhost Server

	$con = mysqli_connect("localhost","root","");





	# Defining Database name

	$db = 'vegfoods';



	# Creating Database
	$createDb = "CREATE DATABASE $db";
	mysqli_query($con, $createDb);




	# Connecting to Database

	$con = mysqli_connect("localhost","root","", $db);


	# Creating Admin Table

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


	# Inserting Default Admin value if not exists

	# Checking in table that default value is exists or not

	$check = mysqli_query($con, "SELECT * FROM admin WHERE email = 'husen@gmail.com'");
	$existornot = mysqli_num_rows($check);


	# If default admin exists in admin table below query will not run

	if($existornot == 0){

		# This record will insert only once when this script will run first time

		$insertadmin = "INSERT INTO admin VALUES(NULL, 'Husen', 'Lokhandwala', '7016868559', 'husen@gmail.com','e2fc714c4727ee9395f324cd2e7f331f','Source','yes','777777', 'NONE')";
		mysqli_query($con, $insertadmin);
	}


	# Creating user table

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




	# Creating product table

	$createProductTable = "CREATE TABLE product(
		id INT(6) AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50) NOT NULL,
		price VARCHAR(50) NOT NULL,
		image VARCHAR(500) NOT NULL,
		category VARCHAR(50) NOT NULL,
		description VARCHAR(1000) NOT NULL
	)";

	mysqli_query($con, $createProductTable);



	# Creating newsletter table

	$createNewsLetterTable = "CREATE TABLE newsletter(
		id INT(6) AUTO_INCREMENT PRIMARY KEY,
		email VARCHAR(50) NOT NULL
	)";

	mysqli_query($con, $createNewsLetterTable);



?>