<?php
	session_start();

	$failed_login = false;

	if ($_POST) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$use_cookie = $_POST["cookie"];

		require_once ("database.php");
		$db = new userDB();

		$user = $db->check_login($username, $password);

		if ($user != -1) {
			if ($use_cookie == 1){
				echo "<script>alert('DEBUG MODE: Cookie enabled');</script>";
				setcookie("login", $username, time() + 1000000);
			}

			else {
				echo "<script>alert('DEBUG MODE: NO Cookie');</script>";
				setcookie("login", $username);

			}

			echo "<script>window.location.href = 'home.php';</script>";
		}

		else if ($user == -1) {
			$failed_login = true;
			//echo "<script>alert('username atau password salah');</script>";
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>zeta - Login Page</title>
</head>
<body class="zeta-login-body">
	<div id="zeta">
		<div class="header">
			<div id="link-zeta-logo">
				<a class="zeta-logo" href="index.php">
					<img class="logo-img" src="logo.png" alt="zeta" height="100" width="130">
					<span id="zeta-title-logo">Forum zeta</span>
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
				<h1 class="h1">Login to Forum zeta</h1>
			</div>
			<div id="content">
				<?php
				if ($failed_login){
					echo 
					'<div class="badresult" style="background-color: #fae3e3; border: 2px solid #b25959; text-align: center; padding: 10px; margin:10px; font-family: Verdana;font-size: 11px">
				        Your username or password is incorrect.
				    </div>';
				}
			    ?>
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
	              			<input name="cookie" value="1" checked="checked" type="checkbox"> Always stay logged in?
	            		</p>

	            		<p>
	              			<input type="submit" name="submit" value="Login">
	              		</p>
	              	</form>
              		<p>
		              	 <a href="forgot-username.php">Forgot username?</a> | 
		              	 <a href="forgot-password.php">Forgot password?</a>
		            </p>
				</div>
			</div>
		</div>

		<div class="footer">
			<div id="footer-block">
				<div id="footer-link-block">
					<p style="padding: 0 10px; display: inline-block;">
						<a href="">Home</a>
					</p>
					|
					<p style="padding: 0 10px; display: inline-block;">
						<a href="about.php" style="padding: 0 5px">About</a>
						<a href="about.php?go=support" style="padding: 0 5px">Support</a>
						<a href="advertising.php" style="padding: 0 5px">Advertising</a>
						<a href="about.php?go=faqs" style="padding: 0 5px">FAQ</a>
					</p>
					|
					<p style="padding: 0 10px; display: inline-block;">
						<a href="login.php" style="padding: 0 5px">Login</a>
						<a href="register.php" style="padding: 0 5px">Register</a>
					</p>
				</div>
				<div id="blank" style="height:40px"></div>
				<div id="copyright" style="color: black; font-size:13.5px; padding-bottom: 15px">©2017 -- Forum zeta -- All Rights Reserved.</div>
			</div>
		</div>
	</div>
</body>
</html>