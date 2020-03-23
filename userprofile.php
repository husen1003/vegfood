<?php
	include "header.php";


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login Page</title>
	<link rel="stylesheet" href="">
</head>
<body>
 <div style="padding-top: 20px;">


    <center>
    <form action="" method="POST" style="width: 50%;" >
      <div class="form shadow-lg p-4" style="color: black; border-radius: 50px; background: rgba(0,0,0,0.8);">

    <h2 align="center" style="color: white;"> User Profile </h2><br><br>
      <div class="form-group" align="left">

        <label style="color: white;"><b>First Name:-</b></label>
        <input type="text" name="fname" value="<?php echo $_SESSION['user']; ?>" id="Username" required="required" placeholder="Enter First name" class="form-control" autocomplete="off"><br/>

        <label style="color: white;"><b>Last Name:-</b></label>
        <input type="text" name="lname" value="<?php echo $_SESSION['lname']; ?>" id="Username" required="required" placeholder="Enter Last name" class="form-control" autocomplete="off"><br/>
               
        
        <label style="color: white;"><b>Mobile no:-</b></label>
        <input type="text" name="mo" value="<?php echo $_SESSION['mo']; ?>" id="Username" required="required" placeholder="Enter Mobile no" class="form-control" autocomplete="off"><br/>
        
        <label style="color: white;"><b>Email:-</b></label>
        <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" id="Username" required="required" placeholder="Enter Email" class="form-control" autocomplete="off">
        

        <br> <br>

  



      <button type="submit" name="login" class="btn btn-primary" style="width: 100%"> UPDATE </button><br><br>
    </div>
    </form>
  </center>
 </div>

</body>
</html>









<?php	

if(isset($_POST['login']))
{
	$id = $_SESSION['id'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mo = $_POST['mo'];
	$email = $_POST['email'];

	$result = mysqli_query($con, "SELECT * FROM user WHERE id not in ('$id') AND (mo = '$mo' OR email = '$email')");
	$cnt = mysqli_num_rows($result);
	if($cnt == 0)
	{
		$update = mysqli_query($con, "UPDATE user SET fname = '$fname', lname = '$lname', mo = '$mo', email = '$email' WHERE id = '$id'");
		if($update)
		{
			$_SESSION['user'] = $fname;
			$_SESSION['lname'] = $lname;
			$_SESSION['mo'] = $mo;
			$_SESSION['email'] = $email;			
			echo "<script> alert('Details Updated Successfully!!'); 
			window.location = 'index.php';
			</script>";
		}
	}
	else
	{
		echo "<script>
			alert('Mobile number or Email Id already exists!');
			</script>";
	}
}



    include "footer.php"; 
?>