<?php
//include phpmailer class
require_once 'mailer/class.phpmailer.php';

// creates object
$mail = new PHPMailer(true);

include "database.php";
if (isset($_POST['btn-fpass'])) {
	$email = $_POST['email'];
	//Chec i email exists
	$sql = "SELECT * FROM tbl_users WHERE userEmail = '$email'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		    $code = $row['tokenCode'];
		    //REPLACE http://localhost/raw-script/user-profile-email-verification/ WITH YOUR URL
		    $message = "You have requested to reset your password:<br> <a href='http://localhost/raw-script/user-profile-email-verification/reset-pass.php?id=$codee&mail=$email'>Click Here</a> to set new password o copy and paste the below link<b> http://localhost/raw-script/user-profile-email-verification/reset-pass.php?id=$code&mail=$email<br>If you did not initiate this action, Please Ignore...";
		    //Send Email

		    try {
				$mail->SMTPDebug = 0;// Enable verbose debug output
				$mail->isSMTP();// Set mailer to use SMTP
				$mail->Host       = 'mail.resellerhostee.com';    // Specify main SMTP server
				$mail->SMTPAuth   = true;               // Enable SMTP authentication
				$mail->Username   = 'mail@hopekelldev.info';     // SMTP username
				$mail->Password   = 'kI?{}o%AX#I)';         // SMTP password
				$mail->SMTPSecure = 'ssl';              // Enable TLS encryption, 'ssl' also accepted
				$mail->Port       = 465;                // TCP port to connect to
				$mail->setFrom('mail@hopekelldev.info', 'HopekellDev');           // Set sender of the mail
				$mail->addAddress($email);           // Add a recipient
				$mail->isHTML(true);                                  
				$mail->Subject = 'Reset Your Password';
				$mail->Body    = $message;
				$mail->AltBody = $message;
				if($mail->send()){ //mail sent success
					$msg = "<div class='alert alert-success'>Password reset link have been sent you $email</div>";
				}
			} catch (Exception $e) { 
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
		  		}
		} 
	}else {
	  $msg = "<div class='alert alert-danger'>Email address not found</div>";
	}
}

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
				<?php if (isset($msg)) { echo $msg;}?>
				<div class="form-group">
					<label>Enter Email</label>
					<input type="email" name="email" placeholder="hopekell@example.com" required class="form-control">
				</div>
				<br>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" name="btn-fpass">Request reset</button>
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