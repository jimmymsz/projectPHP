<?php
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
	<title><?php echo $username; ?>'s Page</title>
</head>
<body>
<?php
	switch ($page) {
		case 'profile':
			require_once 'profile.php';
			break;
		case 'grup':
			require_once 'grup.php';
			break;
		default:
			# code...
			break;
	} ?>
		
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
</body>
</html>