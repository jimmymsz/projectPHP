<?php
?>

<!DOCTYPE html>
<html>
<head>
	<title>abc - Login Page</title>
</head>
<body class="abc-login-body">
	<h1>Login</h1>
	<div id="login_div" style="text-align: center">
		<form method="POST" action="login.php">
			Username
			<input type="text" name="username">
			<br><br>
			Password
			<input type="password" name="password">
			<br>
			<input type="submit" name="submit" value="Login">
			<a href="register.php"> Register here </a>
		</form>
	</div>
</body>
</html>