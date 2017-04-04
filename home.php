<?php
	session_start();
	
	define('logon', 'logon');
	if (isset($_SESSION['login'])) {
		$username = $_SESSION['login'];
	} else {
		echo "<script>alert('Not logged in');</script>";
		echo "<script>window.location.href = 'login.php';</script>";
		exit();
	}
	$page = isset($_GET['page']) ? $_GET['page'] : 'profile';
	require_once "database.php";
	$dbPost = new postDB();

	$dbUsr = new userDB();
	$groups = $dbUsr->getGroups($username);


	if(isset($_POST['submit'])) {
		$title = $_POST["title"];
		$content = $_POST["content"];
		$idgroup = "public";
		if (isset($_POST['idgroup']))
			$idgroup = $_POST['idgroup'];
		if(strlen($title) != 0) {
			if ($dbPost->insertPost($username, $idgroup, $title, $content)) {
				echo "<script>alert('post berhasil dimasukkan');</script>";
			}
		}
	}	
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title><?php echo $username; ?>'s Page</title>
</head>
<body>
<div id="zeta">
		<div class="header">
			<div id="link-zeta-logo">
				<a class="zeta-logo" href="index.php">
					<img class="logo-img" src="logo.png" alt="zeta" height="100" width="130">
					<span id="zeta-title-logo">Forum zeta</span>
				</a>
			</div>
			<div id="header-menu">
			<?php if (!isset($_SESSION['login'])) { ?>
				<div class="header-menu-login">
					<a class="btnLogin" href="login.php">Login</a>
					<a class="btnRegister" href="register.php">Register</a>
				</div>
			</div>
			<?php } else { ?>
				<div class="header-menu-login">
					<a class="btnLogin" href="logout.php">Logout</a>
				</div>
			<?php } ?>
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
				<h1 class="h1">Welcome <?php echo $username;?></h1>
			</div>
			<div id="content">
			<a href="home.php">Return to home</a><br>
				<?php
					switch ($page) {
						case 'profile':
							require_once 'profile.php';
							break;
						case 'group':
							require_once 'group.php';
							break;
						case 'newGroup':
							require_once 'createGroup.php';
							break;	
						default:
							# code...
							break;
					} ?>
				<h2>Create New Post</h2>
				<form method="post">
					Title
					<input type="text" name="title">
					<br>
					<textarea name="content"></textarea>
					<br>
					<?php if($page == 'group') {?>
						<input type="hidden" name="idgroup" value="<?php echo $idGroup; ?>">
					<?php }?>
					<input type="submit" name="submit" value="Save">
				</form>
				<br>
				<a href="logout.php">Logout</a>		
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