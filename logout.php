<?php

ob_start();
session_start();
require_once 'database.php';
session_destroy();
$_SESSION['userSession'] = false;
?>
<script>
	alert("Logout successful")
	window.location.href="login.php";
</script>
?>