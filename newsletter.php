    <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
            <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
            <span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form method="POST" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" name="subscriber" class="form-control" placeholder="Enter email address">
                <input type="submit" name="login" value="Subscribe" class="submit px-3">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

<?php

include"dbHelper.php";

if(isset($_POST['login']))
{
    $subscriber = $_POST['subscriber'];
    $checkinusers = mysqli_query($con, "SELECT * FROM user WHERE email = '$subscriber' AND verified = 'yes'");
    if(mysqli_num_rows($checkinusers) == 0)
    {

    
        $check = mysqli_query($con, "SELECT * FROM newsletter WHERE email = '$subscriber'");
        if(mysqli_num_rows($check) == 0)
        {
            $insert = mysqli_query($con, "INSERT INTO newsletter VALUES(NULL, '$subscriber')");


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
                $mail->addAddress($subscriber);     // Add a recipient
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
                $mail->Body    = 'Thank you for Subscribe our Service<b> Vegfoods-Online-Shopping </b>!
                                  <br> <h1>Thank you! Team Vegfoods Member!</h1>
                                  ';
                $mail->AltBody = 'Your verification code is '. $otp .'.';

                $mail->send();
            } 
            catch (Exception $e) 
            {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "<script> alert('Subscribed Successfully'); </script>";
        }
        else
        {
            echo "<script> alert('Already Subscribed!'); </script>";
        }
    }
    else
    {
        echo "<script> alert('Already Registered in our Service!'); </script>";        
    }
}

?>    