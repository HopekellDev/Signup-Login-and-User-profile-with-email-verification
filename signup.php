<?php
ob_start();
session_start();

//include database connection file
require_once 'database.php';
 
// it will never let you open index(login) page if session is set
if ( isset($_SESSION['userSession'])!="" ) {
	header("Location: dashboard.php");
	exit;
}
 
$error = false;

//include phpmailer class
require_once 'mailer/class.phpmailer.php';

// creates object
$mail = new PHPMailer(true);

//Signup handler
if (isset($_POST["btn-signup"])) { //Call Post command from "btn-signup" button
	# trim to clear inputs to avoid SQL injection...

	$name = trim($_POST["username"]);//username

	$email = trim($_POST["email"]);//email

	$password = trim(md5($_POST["password"]));//encripted password using MD5 encryption

	$regdate = trim(date('Y-m-d H:i:s'));//Current date and time

	$code = md5(uniqid(rand()));// unique code for veriications

	$message = "<p>Dear $name,<br> Welcome to HopekellDev. To confirm your email please lick the below link<br>
	<a href='http://localhost//verify.php?vid=$code'>CLICK HERE:)</a><br>if you can't click please copy and paste the below link<br>http://localhost//verify.php?vid=$code<br>Thank you...";

	$sql = "SELECT * FROM tbl_users WHERE userEmail = '$email'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		$msg = "<div class='alert alert-danger'><b>Sorry</b> This email is alredy registered. Try another one</div>";

	}else{

		$sql = "INSERT INTO tbl_users (userName, userEmail, userPass, tokenCode, regDate)
		VALUES ('$name', '$email', '$password', '$code', '$regdate');";

		if ($conn->query($sql) === TRUE) {

			  $msg= "<div class='alert alert-success'><b>Hello $name,</b> Your account have been created. Go to your inbox to activate. Thank you</div>";
 
			try {
				$mail->SMTPDebug = 0;                   // Enable verbose debug output
				$mail->isSMTP();                        // Set mailer to use SMTP
				$mail->Host       = 'mail.resellerhostee.com';    // Specify main SMTP server
				$mail->SMTPAuth   = true;               // Enable SMTP authentication
				$mail->Username   = 'mail@hopekelldev.info';     // SMTP username
				$mail->Password   = 'kI?{}o%AX#I)';         // SMTP password
				$mail->SMTPSecure = 'ssl';              // Enable TLS encryption, 'ssl' also accepted
				$mail->Port       = 465;                // TCP port to connect to
				$mail->setFrom('mail@hopekelldev.info', 'HopekellDev');           // Set sender of the mail
				$mail->addAddress($email);           // Add a recipient
				$mail->isHTML(true);                                  
				$mail->Subject = 'Confirm your Email';
				$mail->Body    = $message;
				$mail->AltBody = $message;
				$mail->send();} catch (Exception $e) { 
			    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
			} 
			} else {
			  $msg = "<div class='alert alert-success'>Error Creating account: " . $conn->error."</div>";
		}
	}


}



?>
<!DOCTYPE html>
<html>
<head>
	<!-- Responsive meta tag-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Signup | User Registration and Login with email verification and profile management</title>

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
				<h3 class="text-primary">Registration form</h3>
			</center>
			<hr />
			<?php if(isset($msg)) echo $msg."<br>";  ?>
			<form method="post" method="">
				<div class="form-group">
					<label>Enter username</label>
					<input type="text" name="username" placeholder="Create username" required class="form-control">
				</div>
				<div class="form-group">
					<label>Enter Email</label>
					<input type="email" name="email" placeholder="hopekell@example.com" required class="form-control">
				</div>
				<div class="form-group">
					<label>Create Password</label>
					<input type="password" name="password" placeholder="&y.999gshGGH99/" required class="form-control">
				</div>
				<br>
				<div class="form-group">
					<label><input type="checkbox" name="terms" value="yes" required> I accept the terms and conditions</label>
				</div>
				<br>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" name="btn-signup">Signup</button>
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