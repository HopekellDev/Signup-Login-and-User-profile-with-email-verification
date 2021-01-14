<?php
include "database.php";

//Reset Password
if (isset($_POST['btn-reset'])) {
	$email= $_POST['email'];
	$newpass=$_POST['npass'];
	$cpass=$_POST['cpass'];
	$pass= md5($newpass);
	if ($newpass==$cpass) {
		$sql = "UPDATE tbl_users SET userPass='$pass' WHERE userEmail='$email'";

		if ($conn->query($sql) === TRUE) {
		  $msg="<div class='alert alert-success'>Password have been changed to <b>$newpass</b></div>";
		} else {
		  $msg= "<div class='alert alert-danger'>Error updating record: " . $conn->error."</div>";
		}

	}else{
		$msg="<div class='alert alert-danger'>Password Mismatch!!</div>";
	}

}


//make url contains toen and user email
if (empty($_GET['id'] )&& empty($_GET['mail'])) {
	header('Location: index.html');
}
if (isset($_GET['id']) && isset($_GET['mail'])) {
	$email = $_GET['mail'];
	$id = $_GET['id'];
	$sql = "SELECT * FROM tbl_users WHERE userEmail='$email' AND tokenCode='$id'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		?>

<!DOCTYPE html>
<html>
<head>
	<!-- Responsive meta tag-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Forgot password | User Registration and Login with email verification and profile management</title>

	<!--Style sheets-->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">

	<!--Custom styles-->


	<!--Font icons-->
</head>
<body>

	<!--Main Container-->
	<div class="container">
		<div class="col-md-5 signup">
			<center>
				<h3 class="text-primary">Forgot password form</h3>
			</center>
			<hr />
			<form method="post" method="">
				<?php if (isset($msg)){echo $msg;}?>
				<div class="form-group">
					<label>Email address</label>
					<input type="email" name="email" value="<?php echo $row['userEmail'];?>" placeholder="hopekell@example.com" required class="form-control" readonly>
				</div>
				<div class="form-group">
					<label>New Password</label>
					<input type="password" name="npass" placeholder="$rr76YH/=" required class="form-control">
				</div>
				<div class="form-group">
					<label>Confirm Password</label>
					<input type="password" name="cpass" placeholder="$rr76YH/=" required class="form-control">
				</div>
				<br>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" name="btn-reset">Change password</button>
					<a href="login.php" class="btn btn-secondary" style="float: right;">Login now</a>
				</div>
			</form>
		</div>
		<footer>
			<p></p>
			<p align="center">&copy; 2021 <a href="https://hopekelldev.info/php/user-profile-with-email-verification/">HopekellDev Programing</a> All rights reserved</p>
		</footer>
	</div>

<!-- Core javascript files-->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
		<?php

	}else{
		?>
		<p>Action not allowed<p>
		<?php
	}
}
?>