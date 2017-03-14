<?php
	if ($_POST) {
		$username = $_POST["username"];
		$password = $_POST["password"];

		require_once "database.php";
		$db = new userDB();
		$user = $db->check_login($username, $password);
		if ($user != -1) {
			setcookie("login", $username);
			echo "<script>window.location.href = 'home.php';</script>";
		} else if ($user == -1) {
			echo "username atau password salah";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>abc - Login Page</title>
</head>
<body class="abc-login-body">
	<div id="abc">
		<div class="header">
			<div id="link-abc-logo">
				<a class="abc-logo" href="index.php">
					<img class="logo-img" src="logo.png" alt="abc" height="100" width="130">
					<span id="abc-title-logo">Forum abc</span>
				</a>
			</div>
			<div id="header-menu">
				<div class="header-menu-login">
					<a class="btnLogin" href="login.php">Login</a>
					<a class="btnRegister" href="register.php">Register</a>
				</div>
			</div>
		</div>
		<div class="menu">
			<div id="menu_left">
				<ul id="navigation">
					<li class="small70">
						<a class="non-link" href="#">Forum</a>
						<ul class="nav-dropdown">
							<li> <a href="search.php">Search Forum</a></li>
							<li> <a href="recent-posts.php">Recent Posts</a></li>
						</ul>
					</a></li>
					<li class="small80">
						<a class="non-link" href="#">Member</a>
						<ul class="nav-dropdown">
							<li> <a href="members.php?go=notable">Notable Member</a></li>
							<li> <a href="forum-admin.php">Forum Admin</a></li>
							<li> <a href="members.php?go=new">New Members</a></li>
						</ul>
					</a></li>
					<li class="small70">
						<a class="non-link" href="#">Help (?)</a>
						<ul class="nav-dropdown">
							<li> <a href="about.php?go=about">About</a></li>
							<li> <a href="about.php?go=support">Support</a></li>
							<li> <a href="about.php?go=faqs">FAQs</a></li>
							<li> <a href="about.php?go=feedbacks">Send Feedbacks</a></li>
						</ul>
					</a></li>
					<li class="large">
						<a class="non-link" href="#">Experimental</a>
						<ul class="nav-dropdown">
							<li>Coming Soon</li>
							<!--
							<li> <a href="">Coming Soon...</a></li>
							-->
						</ul>
					</a></li>
				</ul>
			</div>
			<div id="menu_right">
			</div>
		</div>

		<div class="contentWrapper">
			<div>
				<h1 class="h1">Login to Forum abc</h1>
			</div>
			<div id="content">
				<div id="login-box">
					<form method="post" action="login.php">
						<br>
						<h1 style="font-size: 20px; font-family: Verdana,Arial; padding-bottom: 15px">Login </h1>
						
						<p>Username
							<input type="text" name="username" size="20" maxlength="30">
						</p>
						<p>Password
							<input type="password" name="password" size="20" maxlength="32">
						</p>
						<p>
	              			<input name="cookie" value="1" checked="checked" type="checkbox" disabled="true"> Always stay logged in?
	            		</p>

	            		<p>
	              			<input type="submit" name="submit" value="Login">
	              		</p>
	              	</form>
              		<p>
		              	 <a href="password.php?username=1">Forgot username?</a> | 
		              	 <a href="password.php">Forgot password?</a>
		            </p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>