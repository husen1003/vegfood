<?php

include"header.php";

?>
 <div style="padding-top: 20px; padding-bottom: 100px;">


    <center>
    <form action="" method="POST" style="width: 50%;" >
      <div class="form shadow-lg p-4" style="color: black; border-radius: 50px;">

    <h3>Change Password!</h3><br/>
      <div class="form-group" align="left">

        <input type="text" name="old" id="Username" required="required" placeholder="Old Password" class="form-control" autocomplete="off">
        <br>
        <input type="password" name="new" id="Username" required="required" placeholder="New Password" class="form-control" autocomplete="off">
        <br>
        <input type="password" name="cnew" id="Username" required="required" placeholder="Confirm New Password" class="form-control" autocomplete="off">                


        <br> <br>

  



      <button type="submit" name="login" class="btn btn-primary" style="width: 100%"> CHANGE PASSWORD </button><br><br>
    </div>
    </form>
  </center>
 </div>


<?php

include"dbHelper.php";

$email = $_SESSION['email'];



if(isset($_POST['login'])){

	$old = $_POST['old'];
	$new = $_POST['new'];
	$cnew = $_POST['cnew'];

	$old = md5($old);
	$new = md5($new);
	$cnew = md5($cnew);

	$check = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'");
	$record = mysqli_fetch_array($check);
	if($old == $record['pass']){
		if($new == $cnew){
			if($old != $new){
				if(mysqli_query($con, "UPDATE user SET pass = '$new' WHERE email = '$email'")){
					?>
					<script>
						alert('Password changed Successfully!');
						window.location = "index.php";
					</script>
					<?php					
				}
			}
			else
			{
					?>
					<script>
						alert('old password and new password must be different!!');
					</script>
					<?php				
			}
		}
		else
		{
			?>
			<script>
				alert('Both Password must be same!!');
			</script>
			<?php			
		}
	}
	else
	{
		?>
		<script>
			alert('Incorrect Password! Try Again!');
		</script>
		<?php
	}
}

include"footer.php";

?>