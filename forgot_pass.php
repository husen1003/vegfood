<?php
	include"header.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Forgot Password</title>
	<link rel="stylesheet" href="">
</head>
<body>
 <div style="padding-top: 20px; padding-bottom: 100px;">


    <center>
    <form action="" method="POST" style="width: 50%;" >
      <div class="form shadow-lg p-4" style="color: black; border-radius: 50px;">
<br><br>
    <h3>Forgot Password!</h3><br/>
      <div class="form-group" align="left">

        <input type="text" name="email" id="Username" required="required" placeholder="Enter Email" class="form-control" autocomplete="off">


        <br> <br>

  



      <button type="submit" name="login" class="btn btn-primary" style="width: 100%"> GET PASSWORD </button><br><br>
    </div>
    </form>
  </center>
 </div>

</body>
</html>


<?php

include"dbHelper.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];

    $check = mysqli_query($con, "SELECT * FROM user WHERE email = '$email' AND verified = 'yes'");
    if(mysqli_num_rows($check) == 1){

            $record = mysqli_fetch_array($check);
            $pass = $record['pass'];


            # Sending Password via email

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
                $mail->setFrom(EMAIL, 'Vegfoods--Forget_Password');
                $mail->addAddress($email);     // Add a recipient
                // $mail->addAddress('ellen@example.com');               // Name is optional
                $mail->addReplyTo(EMAIL, 'Vegfoods-Forget_Password');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Vegfoods forgot password';
                $mail->Body    = 'Your Password is <b>'. $pass .'</b> !';
                $mail->AltBody = 'Your Password code is '. $pass .' .';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            ?>
            <script>
              alert('Password Sent to your Email!!')
              window.location = "login.php";
            </script>
            <?php            

    }
    else
    {
            ?>
            <script>
              alert('Password Sent to your Email!!')
              window.location = "login.php";
            </script>
            <?php       
    }





}

?>