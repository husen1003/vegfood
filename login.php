<?php

	include "header.php";
  if(isset($_SESSION['user'])){
    ?>
      <script type="text/javascript">
        window.location = 'index.php';
      </script>
    <?php
  }
  elseif (isset($_SESSION['admin'])) {
    ?>
      <script type="text/javascript">
        window.location = 'admin';
      </script>
    <?php
  }

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

        <label style="color: white;"><b>Email:-</b></label>
        <input type="text" name="email" id="Username" required="required" placeholder="Enter Email or Mobile no" class="form-control" autocomplete="off">


       <label style="color: white;"><b> Password:- </b></label></h3>
        <input type="password" name="pass" id="password" required="required" placeholder="password" class="form-control" autocomplete="off">

        <br> <br>

  



      <button type="submit" name="login" class="btn btn-primary" style="width: 100%"> LOGIN </button><br><br>
      <a href="reg.php" title="Register from here">If not registered, Sign Up!!</a>     
      <a href="forgot_pass.php" style="float: right;">Forgot Password</a>
    </div>
    </form>
  </center>
 </div>

</body>
</html>


<?php

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $resultadmin = mysqli_query($con, "SELECT * FROM admin WHERE email = '$email' AND pass = '$pass'");
    $countadmin = mysqli_num_rows($resultadmin);
    if($countadmin == 0){

        $resultuser = mysqli_query($con, "SELECT * FROM user WHERE (mo = '$email' OR email = '$email') AND pass = '$pass' AND verified = 'yes'");
        $countuser = mysqli_num_rows($resultuser);
        if($countuser == 1){
              $row = mysqli_fetch_array($resultuser);
              $_SESSION['user'] = $row['fname'];
              $_SESSION['lname'] = $row['lname'];
              $_SESSION['mo'] = $row['mo'];
              $_SESSION['email'] = $row['email'];

              ?>
              <script>
                window.location = 'index.php';
              </script>
              <?php          
        }else{

              $checknonverify = mysqli_query($con, "SELECT * FROM user WHERE (mo = '$email' OR email = '$email') AND pass = '$pass' AND verified = 'no'");
              if(mysqli_num_rows($checknonverify) == 1){

                  $otp = rand(100000,999999);

                  $record = mysqli_fetch_array($checknonverify);
                  $fetchedemail = $record['email'];
                  mysqli_query($con, "UPDATE user SET otp = '$otp' WHERE email = '$fetchedemail'");
                  $_SESSION['verify'] = $fetchedemail;
                  ?>
                  <script>
                    window.location = 'verify.php';
                  </script>
                  <?php                    
              }
              else{
                  ?>
                  <script>
                    alert('Incorrect Username or Password!');
                    windows.open(login.php);
                  </script>
                  <?php                  
              }
        
        }


    }else{
              $row = mysqli_fetch_array($resultadmin);
              $_SESSION['admin'] = $row['email'];

              ?>

              <script>
                window.location = 'admin';
              </script>

              <?php   
    }

    // if($name=='Husen' AND $pass=='abcd'){
    //     $_SESSION['user'] = 'Husen';
    //     echo "<script>
    //        window.location = 'index.php';
    //     </script>";
    // }
    // else{
    //   echo "Incorrect Password";
    // }
}

	include "footer.php";

?>