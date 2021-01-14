<?php
ob_start();
session_start();
require_once 'database.php';
 
// it will never let you open index(login) page if session is set
if ( isset($_SESSION['userSession'])!="" ) {
	header("Location: dashboard.php");
	exit;
}
 
$error = false;
if (isset($_POST['btn-login'])) {
	$email = trim($_POST['email']);
	$password = md5($_POST['password']); //MD5 Encrypted password

	//Check if user exist
	$sql = "SELECT * FROM tbl_users WHERE userEmail='$email'";
	$result = $conn->query($sql);

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		if ($row['userPass']==$password) {
		
			if ($row['userStatus']=="Y") {
				$_SESSION['userSession'] = $row['userID'];
				header("Location: dashboard.php");
			}else{
				$msg="<div class='alert alert-danger'>Account is not activated!!!</div>";
			}
		}
	}else{
		$msg="<div class='alert alert-danger'>User dose not exist</div>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Responsive meta tag-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login | User Registration and Login with email verification and profile management</title>

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
				<h3 class="text-primary">Login form</h3>
			</center>
			<hr />
			<form method="post" method="">
				<?php if(isset($msg)) echo $msg;  ?>
				<div class="form-group">
					<label>Enter Email</label>
					<input type="email" name="email" placeholder="hopekell@example.com" required class="form-control">
				</div>
				<div class="form-group">
					<label>Enter Password</label>
					<input type="password" name="password" placeholder="&y.999gshGGH99/" required class="form-control">
				</div>
				<br>
				<div class="form-group">
					<label><input type="checkbox" name="terms" value="yes"> Remember me</label>
				</div>
				<br>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" name="btn-login">Login</button>
					<a href="login.php" class="btn btn-secondary" style="float: right;">Signup now</a>
				</div>
			</form>
			<br>
			<p>Forgot your password? <a href="fpass.php">Reset here</a></p>
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