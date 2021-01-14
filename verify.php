<?php
include "database.php";
//dont allow access without proper values
if (empty($_GET['mail']) && empty($_GET['vid'])) {
	header('Location: ./');
}

//Get values from url using GET method
if(isset($_GET['mail']) && isset($_GET['vid']))
{
	$id = $_GET['mail'];
 	$code = $_GET['vid'];
 	//Status from database
 	$statusY = "Y";
 	$statusN = "N";

 	#Select the right user
 	$sql = "SELECT userEmail, userStatus FROM tbl_users WHERE userEmail='$id' AND tokenCode='$code'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if ($row['userStatus']==$statusN) {

			//Activate user change user status
			$sql = "UPDATE tbl_users SET userStatus='$statusY' WHERE userEmail='$id'";

			if ($conn->query($sql) === TRUE) {
			?>
			<script type="text/javascript">
				alert("YAY!! Your Have been activated \n Go and login")
				window.location.href="login.php";
			</script>
			<?php
			} else {
			  echo "Error updating record: " . $conn->error;
			}
		}else{
			?>
		<script type="text/javascript">
			alert("Your account is already active")
			window.location.href="login.php";
		</script>
		<?php

		}
	}else{
		?>
		<script type="text/javascript">
			alert("Account not found \n Please Register")
			window.location.href="signup.php";
		</script>
		<?php
	}
 }
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Responsive meta tag-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>User Registration and Login with email verification and profile management</title>

	<!--Style sheets-->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

	<!--Custom styles-->


	<!--Font icons-->
</head>
<body>

	<!--Navigation bar-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="http://HopekellDev.info">HopekellDev.info</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="./">Home</a>
	        </li>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	            Categories
	          </a>
	          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
	            <li><a class="dropdown-item" href="https://hopekelldev.info/category/html/" target="blank">HTML</a></li>
	            <li><a class="dropdown-item" href="https://hopekelldev.info/category/css/" target="blank">CSS</a></li>
	            <li><a class="dropdown-item" href="https://hopekelldev.info/category/javascript/" target="blank">Javascript</a></li>
	            <li><a class="dropdown-item" href="https://hopekelldev.info/category/php/" target="blank">PHP</a></li>
	            <li><a class="dropdown-item" href="https://hopekelldev.info/category/bootstrap/" target="blank">Bootstrap</a></li>
	            <li><a class="dropdown-item" href="https://hopekelldev.info/category/laravel/" target="blank">Laravel</a></li>
	            <li><a class="dropdown-item" href="https://hopekelldev.info/category/wordpress/" target="blank">Wordpress</a></li>
	          </ul>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="login.php" tabindex="-1" aria-disabled="true">Login</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="signup.php" tabindex="-1" aria-disabled="true">Signup</a>
	        </li>
	      </ul>
	      <form class="d-flex">
	        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
	        <button class="btn btn-outline-success" type="submit">Search</button>
	      </form>
	    </div>
	  </div>
	</nav>

	<!--Main Container-->
	<div class="container">
		<center>
			<?php if (isset($msag)) { echo $msg; };?>
		</center>
		
	</div>

<!-- Core javascript files-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>