<?php
	include"header.php";
  if(!isset($_SESSION['verify']) AND !isset($_SESSION['reset'])){
      echo "<script> window.location = 'index.php'; </script>";
  }
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
    <h3>Please Check <font color="green"><?php 
        if(isset($_SESSION['verify']))
        {
            echo $_SESSION['verify'];
        }
        elseif (isset($_SESSION['reset'])) 
        {
            echo $_SESSION['reset'];;
        }    

     ?></font> account!</h3>
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

include"dbHelper.php";

if(isset($_POST['login'])){
    if(isset($_SESSION['verify']))
    {
      	$otp = $_POST['otp'];
      	$email = $_SESSION['verify'];

      	$find = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'");
      	$record = mysqli_fetch_array($find);
      	$otpdb = $record['otp'];
      	if($otpdb == $otp){
      		$verified = mysqli_query($con, "UPDATE user SET verified = 'yes' WHERE email = '$email'");



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
                $mail->addAddress($record['email'], $record['fname']);     // Add a recipient
                // $mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo(EMAIL, 'Vegfoods-Online-anywhere');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Vegfoods-Subscriber';
                $mail->Body    = "Thank you for Joining <b> Vegfoods-Online-Shopping </b>!
                                  <br> <h1>Thank you! </h1> <h3 style='color: green;'> Team Vegfoods Member!</h3>
                                  ";
                $mail->AltBody = 'Thank you for joining Vegfoods-Online-Shopping!!';

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }





                    ?>
                    <script>
                      alert('Verification Successfull!')
                      window.location = 'login.php';
                    </script>
                    <?php
                    session_destroy();
      	}else{
            ?>
                <script>
                  alert('Invalid OTP!!');
                </script>	
            <?php	
            session_destroy();
      	}
    }
    elseif (isset($_SESSION['reset'])) 
    {
        $otp = $_POST['otp'];
        $email = $_SESSION['reset'];

        $find = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'");
        $record = mysqli_fetch_array($find);
        $otpdb = $record['otp'];
        if($otpdb == $otp)
        {
            $_SESSION['verified'] = $email;
            ?>
                <script>
                  alert('OTP verified Successfully! Reset your Password!');
                      window.location = 'reset_pass.php';
                </script> 
            <?php             
        }
        else
        {
            ?>
                <script>
                  alert('Invalid OTP!!');
                </script> 
            <?php           
        }
    }
}

?>