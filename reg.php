<?php
  error_reporting(0);
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

  



      <button type="submit" name="login" class="btn btn-primary" style="width: 100%"> REGISTER </button><br><br>
      <a href="login.php" title="Register from here">If Already registered, Sign In!!</a>
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
    $otp = rand(100000,999999);

    #Checking both password are same or not
    if($pass1 == $pass2){

        #   Encrypt Password

        $pass1 = md5($pass1);

        #Checking thah The email or mobile number are already exist in database or not
        #if exist then showing error else execute as it is
        $detectnonverified = mysqli_query($con, "SELECT * FROM user WHERE (email = '$email' OR mo = '$mo') AND verified = 'no' AND removed_by ='NONE'");
        $countdeleteuser = mysqli_num_rows($detectnonverified);
        if($countdeleteuser == 1)
        {
            $deleterecord = mysqli_fetch_array($detectnonverified);
            $deleteuserid = $deleterecord['id'];
            $deleteuser = mysqli_query($con, "DELETE FROM user WHERE id = '$deleteuserid'");
        }

        $result = mysqli_query($con, "SELECT * FROM user WHERE (email = '$email' OR mo = '$mo') AND verified = 'yes'");
        $cntduplicate = mysqli_num_rows($result);

        if($cntduplicate == 0)
        {
            $insert = "INSERT INTO user VALUES(NULL, '$fname', '$lname', '$mo', '$email', '$pass1','no','$otp','NONE')";
            if(mysqli_query($con, $insert))
            {






            #Sending OTP to verify user



            require 'phpmailer/PHPMailerAutoload.php';
            require 'credential.php';

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer;

            try {
                // //Server settings
                $mail->SMTPDebug = 0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = EMAIL;                     // SMTP username
                $mail->Password   = PASS;                               // SMTP password
                $mail->SMTPSecure = tls;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom(EMAIL, 'Vegfoods-Online-anywhere');
                $mail->addAddress($email, $fname);     // Add a recipient
                // $mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo(EMAIL, 'Vegfoods-Online-anywhere');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Vegfoods verification code';
                $mail->Body    = 'Your verification code is <b>'. $otp .'</b>!';
                $mail->AltBody = 'Your verification code is '. $otp .'.';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }












              $_SESSION['verify'] = $email;
                ?>
                <script>
                    alert('OTP has been sent on your EMAIL!')
                    window.location = "verify.php";
                </script>
                <?php
            }       
        }
        else
        {
            ?>
              <script type="text/javascript">
                alert('Email or Mobile number Already exists!!');
              </script>
            <?php
        }
    }
    else
    {
        ?>
          <script type="text/javascript">
            alert('Both Password must be same!!');
          </script>
        <?php
    }
}
	include "footer.php";





?>