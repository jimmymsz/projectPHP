<?php
	session_start();
	if(isset($_POST['submit'])) {
		$groupname = $_POST['group'];
		require_once 'database.php';
		$grpDb = new groupDB();
		$groups = $grpDb->getGroups($groupname);
	}

	$page = "search";
	if ($_GET) {
		$page = $_GET['page'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>zeta</title>
</head>
<body class="zeta-search-body">
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
				<?php if (!isset($_SESSION['login'])) { ?>
					<a class="btnLogin" href="login.php">Login</a>
					<a class="btnRegister" href="register.php">Register</a>
				<?php } else { ?>
					<a class="btnLogin" href="logout.php">Logout</a>
				<?php } ?>
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
			<form method="POST" action="search.php">
				Cari grup: <input type="text" name="group" required="true">
				<input type="submit" name="submit" value="Cari">
			</form>
			<?php switch ($page) {
				case 'grup':
					require_once 'group.php';
					break;
				default:
					# code...
					break;
			}
			?>
			<?php if (isset($groups) && count($groups)!=0) {
				foreach ($groups as $g) { ?>
				<ul>
					<li><a href="search.php?page=grup&idGroup=<?php echo $g['idGroup'];?>"><?php echo $g['groupName'];?></li>
				</ul>
			<?php }} else if (isset($groups) && count($groups) == 0) {
				echo "Grup tidak ditemukan<br>";
			}
				if(isset($_SESSION["login"])) { ?>
			<a href="home.php">Return to home</a>
			<?php } else { ?>
			<a href="recent-posts.php">Return to front page</a>
			<?php } ?>
		</div>
	</div>
</body>
</html>