<?php
	include"sidebar.php";
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
 <div style="padding-top: 20px; padding-bottom: 100px;">


    <center>
    <form action="" method="POST" style="width: 50%;" >
      <div class="form shadow-lg p-4" style="color: black; border-radius: 50px;">

    <br><br>
    <h3>Verify Admin account!</h3><br><br>
      <div class="form-group" align="left">

        <input type="text" name="otp" id="Username" required="required" placeholder="Enter OTP" class="form-control" autocomplete="off">


        <br> <br>

  



      <button type="submit" name="login" class="btn btn-primary" style="width: 100%"> VERIFY </button><br><br>
    </div>
    </form>
  </center>
 </div>

</body>
</html>
<?php

include"../dbHelper.php";

if(isset($_POST['login'])){

	$otp = $_POST['otp'];
	$email = $_SESSION['verify'];

	$find = mysqli_query($con, "SELECT * FROM admin WHERE email = '$email'");
	$record = mysqli_fetch_array($find);
	$otpdb = $record['otp'];
	if($otpdb == $otp){
		$verified = mysqli_query($con, "UPDATE admin SET verified = 'yes' WHERE email = '$email'");
              ?>
              <script>
                alert('Admin Added Successfull!')
                window.location = 'show_admin.php';
              </script>
              <?php  		
	}else{
		?>
          <script>
            alert('Invalid OTP!!');
          </script>	
        <?php	
	}


}


include"sidebar2.php";
?>