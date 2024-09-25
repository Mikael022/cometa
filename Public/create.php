<?php
session_start();
include "../private/createcss.php";
include "../private/config.php";


?>

<div class="login-container">
<div class="login-form">
<form action='#' method='post'>
	<h2>Username</h2>
	<input type="text" name="usernames"></br>
	<h2>Password</h2>
	<input type="password" name="passwords"></br>
	<h2>Confirm Password</h2>
	<input type="password" name="passwords2"></br>
	<input type="submit" name="register" value="Register"></br>
	<?php
	$error="";
	if (isset($_POST['register'])){
	$Q = mysqli_query($con, "SELECT * from accounts where user='".$_POST['usernames']."' and pass='".$_POST['passwords']."'");
	$QR= mysqli_num_rows($Q);

	if (!empty($_POST['usernames']) && !empty($_POST['passwords']) && !empty($_POST['passwords2'])){
		$Encry=md5($_POST['passwords2']);
		if ($_POST['passwords'] = $_POST['passwords2']){
		if ($QR<1){
			$querymove=mysqli_query($con,"INSERT INTO accounts(user,pass) VALUES ('".$_POST['usernames']."','".$Encry."')");
				echo "<script>alert('Account Successfuly Created')</script>";
				echo "<script>window.location.href='LoginPage'</script>";
		}
		else{
			$error= "Username/Password already exists";
		}
	}
	else{
		$error= "Password and confirm password doesnt match";
	}
	}
	}

if ($error !=""){ ?>
	<p class="error">
		<?= $error ?></p>
	<?php }

	?>

</form>
</div>
</div>

