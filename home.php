<?php
	if (isset($_COOKIE['login'])) {
		$username = $_COOKIE['login'];
	} else {
		echo "<script>window.location.href = 'login.php';</script>";
		exit();
	}

	require_once "database.php";
	$dbPost = new postDB();
	$posts = $dbPost->selectByUsr($username);

	$dbUsr = new userDB();
	$members = $dbUsr->getGroups($username);	 

	if($_POST) {
		$title = $_POST["title"];
		$content = $_POST["content"];
		if(strlen($title) != 0) {
			if ($dbPost->insertPost("yoko", "php", $title, $content)) {
				echo "sukses";
			}
		}
	}	
?>

<html>
<head>
	<title><?php echo $username; ?>'s Home</title>
</head>
<body>
<?php
		if (count($posts) == 0) {
			echo "Empty post.<br>";
		} else {
	?>
		<?php foreach ($members as $m) { ?>
			<a href="grup.php?idGroup=<?php echo $m['groupId'];?>"><?php echo $m['groupId']; ?></a>
			<br>
		<?php } ?>
		<?php foreach ($posts as $p) { ?> 
			<div>
				<b><?php echo $p['title']; ?></b>
				<br>
				<?php echo $p['content']; ?>
			</div>
		<?php } ?>
	<?php } ?>

	<form action="test.php" method="post">
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
</html>>

	