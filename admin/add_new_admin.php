<?php
error_reporting(0);
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
    <form action="" method="POST" style="width: 60%;" >
      <div class="form shadow-lg p-4" style="color: black; border-radius: 50px; background: rgba(0,0,0,0.8);">

    <h1 align="center" style="color: white;"> Add new Admin </h1><br><br>
      <div class="form-group" align="left">

        <label style="color: white;"><b>First Name:-</b></label>
        <input type="text" name="fname" id="fname" required="required" placeholder="Enter first name" class="form-control" autocomplete="off">

        <br/>

        <label style="color: white;"><b>Last Name:-</b></label>
        <input type="text" name="lname" id="lname" required="required" placeholder="Enter Last name" class="form-control" autocomplete="off">

        <br/>

        <label style="color: white;"><b>Mo:-</b></label>
        <input type="text" name="mo" id="mo" required="required" placeholder="Enter Mobile no" class="form-control" autocomplete="off">

        <br/>

        <label style="color: white;"><b>Email:-</b></label>
        <input type="text" name="email" id="email" required="required" placeholder="Enter your Email" class="form-control" autocomplete="off">

        <br/>

        <label style="color: white;"><b>Password:-</b></label>
        <input type="password" name="pass" id="pass" required="required" placeholder="Enter Password" class="form-control" autocomplete="off">    

        <br/>                            


       <label style="color: white;"><b>Confirm Password:- </b></label></h3>
        <input type="password" name="cpass" id="cpass" required="required" placeholder="Confirm Password" class="form-control" autocomplete="off">

        <br> <br>

  



      <button type="submit" name="login" class="btn btn-primary" style="width: 100%"> Add </button><br><br>
    </div>
    </form>
  </center>
 </div>

</body>
</html>


<?php

include"sidebar2.php";
include"dbHelper.php";

if(isset($_POST['login'])){
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mo = $_POST['mo'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $otp = rand(100000,999999);


    $pass = md5($pass);
    $cpass = md5($cpass);

    #Checking both password are same or not
    if($pass == $cpass){


        $detectnonverified = mysqli_query($con, "SELECT * FROM admin WHERE (email = '$email' OR mo = '$mo') AND verified = 'no'");
        $countdeleteuser = mysqli_num_rows($detectnonverified);
        if($countdeleteuser == 1)
        {
            $deleterecord = mysqli_fetch_array($detectnonverified);
            $deleteuserid = $deleterecord['id'];
            $deleteuser = mysqli_query($con, "DELETE FROM admin WHERE id = '$deleteuserid'");
        }
        #Checking thah The email or mobile number are already exist in database or not
        #if exist then showing error else execute as it is

        $result = mysqli_query($con, "SELECT * FROM admin WHERE email = '$email' OR mo = '$mo' AND verified = 'yes'");
        $cntduplicate = mysqli_num_rows($result);

        if($cntduplicate == 0)
        {
        	$admin_name = $_SESSION['admin'];
            $insert = "INSERT INTO admin VALUES(NULL, '$fname', '$lname', '$mo', '$email', '$pass', '$admin_name', 'no', '$otp','NONE')";
            if(mysqli_query($con, $insert))
            {






	            #Sending OTP to verify user



	            require '../phpmailer/PHPMailerAutoload.php';
	            require '../credential.php';

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
	                $mail->addAddress('coder.husen@gmail.com', 'Husen Lokhandwala');     // Add a recipient
	                // $mail->addAddress('ellen@example.com');               // Name is optional
	                $mail->addReplyTo(EMAIL, 'Vegfoods-Online-anywhere');
	                // $mail->addCC('cc@example.com');
	                // $mail->addBCC('bcc@example.com');

	                // Attachments
	                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	                // Content
	                $mail->isHTML(true);                                  // Set email format to HTML
	                $mail->Subject = 'Add new admin!!';
	                $mail->Body    = 'Hello Husain!! ' . $_SESSION['admin'] . ' is trying to add ' . $fname . '! If you are agree, verification code is '.$otp.'!';
	                $mail->AltBody = 'Your verification code is '. $otp .'. for Making '. $fname .' an admin.';

	                $mail->send();
	                echo 'Message has been sent';
	            } 
	            catch (Exception $e)
	            {
	                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	            }












              $_SESSION['verify'] = $email;
                ?>
                <script>
                  window.location = "verify.php";
                </script>
                <?php
            }       
        }
        else
        {
            echo "<script>
                alert('Admin Already exists!!');
              </script>";
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







?>