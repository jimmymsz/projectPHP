<?php
	setcookie("login", "", time()-1);
	session_start();
	session_destroy();
	echo "<script>window.location.href = 'login.php';</script>";
	exit();
?>