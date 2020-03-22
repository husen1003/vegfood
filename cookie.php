<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Voting from cookies</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form method="POST">
		<button type="submit" name="bjp">BJP</button>VS<button type="submit" name="congress">CONGRESS</button>
	</form>
</body>
</html>


<?php
if(isset($_POST['bjp']) OR isset($_POST['congress'])){
	if(isset($_COOKIE['vote'])){
		echo "Already Voted to " . $_COOKIE['vote'];
	}
	else{
		if(isset($_POST['bjp'])){
			setcookie('vote','BJP', time() + 10);
			echo "Voted to BJP successfully!";
		}
		elseif (isset($_POST['congress'])) {
			setcookie('vote','CONGRESS', time() + 10);
			echo "Voted to CONGRESS successfully!";
		}
	}	
}


?>