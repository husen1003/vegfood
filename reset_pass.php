<?php

	include"header.php";

	if(!isset($_SESSION['verified'])){
		echo "<script> 
			window.location = 'index.php';
		</script>";
	}

?>
 <div style="padding-top: 20px; padding-bottom: 100px;">


    <center>
    <form action="" method="POST" style="width: 50%;" >
      <div class="form shadow-lg p-4" style="color: black; border-radius: 50px;">

    <h3>Reset Password!</h3><br/>
      <div class="form-group" align="left">
        <input type="password" name="new" id="Username" required="required" placeholder="New Password" class="form-control" autocomplete="off">
        <br>
        <input type="password" name="cnew" id="Username" required="required" placeholder="Confirm New Password" class="form-control" autocomplete="off">                


        <br> <br>

  



      <button type="submit" name="login" class="btn btn-primary" style="width: 100%"> RESET PASSWORD </button><br><br>
    </div>
    </form>
  </center>
 </div>

<?php

if(isset($_POST['login']))
{
	$new = $_POST['new'];
	$cnew = $_POST['cnew'];

	$new = md5($new);
	$cnew = md5($cnew);

	$email = $_SESSION['verified'];

	if($new == $cnew)
	{
		mysqli_query($con, "UPDATE user SET pass = '$new' WHERE email = '$email'");
		echo "<script> alert('Password has been reset successfylly!');
              window.location = 'login.php';
        </script>";
        $flag = 1;
	}
	else
	{
		echo "<script> alert('Both Password Must be same!'); </script>";
	}
	if($flag == 1){
		session_destroy();
	}
}

include"footer.php";

?>