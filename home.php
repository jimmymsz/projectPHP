<?php
	define('logon', 'logon');
	if (isset($_COOKIE['login'])) {
		$username = $_COOKIE['login'];
	} else {
		echo "<script>alert('anda belum login');</script>";
		echo "<script>window.location.href = 'login.php';</script>";
		exit();
	}
	$page = isset($_GET['page']) ? $_GET['page'] : 'profile';
	require_once "database.php";
	$dbPost = new postDB();
	$posts = $dbPost->selectByUsr($username);

	$dbUsr = new userDB();
	$groups = $dbUsr->getGroups($username);	 

	if($_POST) {
		$title = $_POST["title"];
		$content = $_POST["content"];
		if(strlen($title) != 0) {
			if ($dbPost->insertPost($username, "public", $title, $content)) {
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
				<h1 class="h1">Welcome <?php echo $username;?></h1>
			</div>
			<div id="content">
			<a href="home.php">Return to home</a>
				<?php
					switch ($page) {
						case 'profile':
							require_once 'profile.php';
							break;
						case 'group':
							require_once 'group.php';
							break;
						default:
							# code...
							break;
					} ?>
				<h2>Create New Post</h2>
				<form action="home.php" method="post">
					Title
					<input type="text" name="title">
					<br>
					<textarea name="content"></textarea>
					<br>
					<input type="submit" name="submit" value="Save">
				</form>
				<br>
				<a href="logout.php">Logout</a>		
			</div>
		</div>
	</div>
</body>
</html>