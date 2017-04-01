<?php
	if ($_POST) {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$fullname = $_POST['fullname'];
		$bday = $_POST['bday'];
		$gender = $_POST['gender'];
		$password = $_POST['password'];
		
		require_once 'database.php';
		$db = new userDB();

		$result = $db->insertUsr($username, $email, $fullname, $bday,$gender, $password);
		if ($result == 1) {
			echo "<script>alert('Registrasi berhasil!')</script>";
			header("Location: login.php");
			exit();
		} else if ($result == -1) {
			echo "$username telah tersedia";
		}	
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>zeta - Register Page</title>
</head>
<body class="zeta-register-body">
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
				<h1 class="h1">Register to Forum zeta</h1>
			</div>

			<div id="content">
				<div id="register-box">
					<form method="POST" action="register.php">
						<br>
						<h1 style="font-size: 22px; font-family: Verdana,Arial; padding-bottom: 0px">Register </h1>
						<p>Join and Start Using Forum zeta today</p>
						<br>
						<p>Email
							<input type="email" name="email" size="20" maxlength="30" required="true">
						</p>
						<p>Username
							<input type="text" name="username" size="20" maxlength="30" required="true">
						</p>
						<p>Full Name
							<input type="fullname" name="fullname" size="20" maxlength="40" required="true">
						</p>
						<p>
							Birthday
							<input type="date" name="bday">
						</p>
						<p>Gender
							<select name="gender" required="true">
								<option value="M">Male</option>
								<option value="F">Female</option>
								<option value=".">Prefer not to say&nbsp;&nbsp;</option>
							</select>
						</p>
						<p>Password
							<input type="password" name="password" size="20" maxlength="32" required="true">
						</p>
						<p>
	              			<input type="submit" name="submit" value="Register" required="true">
	              		</p>
					</form>
				</div>
			</div>
		</div>

	</div>
</body>
</html>