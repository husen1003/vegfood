<?php
	
	session_start();

	include"dbHelper.php";

	$id = $_GET['id'];

	$admin = $_SESSION['admin'];

	mysqli_query($con, "UPDATE user SET verified = 'no', removed_by = '$admin' WHERE id = '$id'");

	echo "<script> alert('User Removed Successfully!'); 
		window.location = 'show_user.php';
	</script>";


?>