<?php

	include "header.php";

?>

<!--     <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>User Login</span></p>
            <h1 class="mb-0 bread">Login Here</h1>
          </div>
        </div>
      </div>
    </div> -->

 
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

    <h2 align="center" style="color: white;"> User Login </h2><br><br>
      <div class="form-group" align="left">

        <label style="color: white;"><b>First Name:-</b></label>
        <input type="text" name="fname" id="Username" required="required" placeholder="Enter First name" class="form-control" autocomplete="off">

        <label style="color: white;"><b>Last Name:-</b></label>
        <input type="text" name="lname" id="Username" required="required" placeholder="Enter Last name" class="form-control" autocomplete="off">
               
        
        <label style="color: white;"><b>Mobile no:-</b></label>
        <input type="text" name="mo" id="Username" required="required" placeholder="Enter Mobile no" class="form-control" autocomplete="off">
        
        <label style="color: white;"><b>Email:-</b></label>
        <input type="text" name="email" id="Username" required="required" placeholder="Enter Email" class="form-control" autocomplete="off">
        
        <label style="color: white;"><b>Password:-</b></label>
        <input type="password" name="pass1" id="Username" required="required" placeholder="Enter Password" class="form-control" autocomplete="off">


       <label style="color: white;"><b> Confirm Password:- </b></label></h3>
        <input type="password" name="pass2" id="password" required="required" placeholder="Re-type password" class="form-control" autocomplete="off">

        <br> <br>

  



      <button type="submit" name="login" class="btn btn-primary" style="width: 100%"> LOGIN </button><br><br>
      <a href="login.php" title="Register from here">If Already registered, Sign In!!</a>     
      <a href="forgot_pass.php" style="float: right;">Forgot Password</a>
    </div>
    </form>
  </center>
 </div>

</body>
</html>





<?php
include "dbHelper.php";
if(isset($_POST['login'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mo = $_POST['mo'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

#Checking both password are same or not
    if($pass1 == $pass2){

      $insert = "INSERT INTO user VALUES(NULL, '$fname', '$lname', '$mo', '$email', '$pass1')";
      if(!mysqli_query($con, $insert)){
        echo "
        <script>
          alert('Both Password must be same!!');
        </script>
        ";
      }
      else{
        echo "
        <script>
          window.location = 'login.php';
        </script>
        ";
      }


    }else{
      ?>
        <script type="text/javascript">
          alert('Both Password must be same!!');
        </script>
      <?php
    }
}


	include "footer.php";

?>