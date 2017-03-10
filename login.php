<?php
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
							<li> <a href="">Search Forum</a></li>
							<li> <a href="">Recent Posts</a></li>
						</ul>
					</li>
					<li class="small80">
						<a class="non-link" href="#">Member</a>
						<ul class="nav-dropdown">
							<li> <a href="">Notable Member</a></li>
							<li> <a href="">Forum Admin</a></li>
							<li> <a href="">New Members</a></li>
						</ul>
					</li>
					<li class="small70">
						<a class="non-link" href="#">Help (?)</a>
						<ul class="nav-dropdown">
							<li> <a href="">About</a></li>
							<li> <a href="">Support</a></li>
							<li> <a href="">FAQs</a></li>
							<li> <a href="">Send Feedbacks</a></li>
						</ul>
					</li>
					<li class="large">
						<a class="non-link" href="#">Experimental</a>
						<ul class="nav-dropdown">
							<li>Coming Soon</li>
							<!--
							<li> <a href="">Coming Soon...</a></li>
							-->
						</ul>
					</li>
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