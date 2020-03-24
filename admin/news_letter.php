<?php

	error_reporting(0);
	include"sidebar.php";


?>
    <center>
		<form method="POST">
			<div class="form shadow-lg p-4" style="color: black; width:60%; background:rgba(0,0,0,0.7);border-radius:30px;margin-top:20px;">						
				<center style="margin:40px 0px;"><h1><b>Send Notice to All User</b></h1></center>
				<br>				             
				<div class="form-group" style="margin-top:-20px;" align="left">
			        <label style="color: white;"><b>Subject:-</b></label>
			        <input type="text" name="subject" id="subject" required="required" placeholder="Enter Subject" class="form-control" autocomplete="off">
                </div>
                <br>
				<div class="form-group marg" align="left">
			        <label style="color: white;"><b>Message:-</b></label>
			        <textarea name="msg" rows="6" placeholder="Enter Message here" class="form-control" autocomplete="off"></textarea>
                </div>     <br><br>
    
      			<button type="submit" name="login" class="btn btn-primary" style="width: 100%"> SEND NEWS </button><br><br>			                
			</div>		    
		</form>
    </center>

<?php

if(isset($_POST['login']))
{
    

	$subject = $_POST['subject'];
	$msg = $_POST['msg'];
    $result = mysqli_query($con, "SELECT email FROM user WHERE verified = 'yes'");
    while($row = mysqli_fetch_array($result))
    {
        # Sending Mails

        sendEmail($row['email'],$subject,$msg);
    }
	$result = mysqli_query($con, "SELECT email FROM newsletter");
	while($row = mysqli_fetch_array($result))
	{
        # Sending Mails

        sendEmail($row['email'],$subject,$msg);

	}
	echo "<script> alert('News has been sent to all subscribers!'); 
		window.location = 'index.php';</script>
	";
}


function sendEmail($email,$subject,$msg)
{
    require '../phpmailer/PHPMailerAutoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer;

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
        $mail->setFrom(EMAIL, 'Vegfoods-Online-Shopping');
        $mail->addAddress($email);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo(EMAIL, 'Vegfoods-Online-Shopping');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $msg;
        $mail->AltBody = $msg;

        $mail->send();
}



include"sidebar2.php";

?>