<?php
	
	session_start();

	include"dbHelper.php";

	$id = $_GET['id'];

	$admin = $_SESSION['admin'];

	mysqli_query($con, "UPDATE user SET verified = 'no', removed_by = '$admin' WHERE id = '$id'");

	header("location:show_user.php");

?>