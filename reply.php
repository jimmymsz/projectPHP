<?php 
	if (session_status() == PHP_SESSION_NONE) {
      	session_start();
    }
	if (isset($_SESSION['login'])) $username = $_SESSION['login'];
	else $username = false;
	require_once 'database.php';
	$access = false;
	$dbUsr = new userDB();
	$dbPost = new postDB();
	$grupost = "";
	if (isset($_GET['post'])) {
		$postid = $_GET['post'];
		
		$post = $dbPost->getPost($postid);
		$grupost = $post['groupId'];
		if (strcmp($grupost, "public") == 0) $access = true;
		else if ($dbUsr->getMember($grupost, $username)) $access = true;
	}

	if ($access) { 
		if (isset($_POST['reply'])) {
			$content = $_POST['content'];
			if ($dbPost->insertRep($postid, $username, $content)) {
				$uri = $_SERVER['REQUEST_URI'];
				echo "<script>alert('comment berhasil'); </script>";
				echo "<script>window.location.href='$uri';</script>";
			}
		} ?>
		<a href="home.php">Return to home</a><br>
		<?php echo $post['userName']; ?>&nbsp
		<b><?php echo $post['title']; ?></b>
		<br>
		<?php  echo $post['content']; ?>
		<br>
		<br>
		<?php $dbPost = new postDB();
		$replies = $dbPost->getReplies($postid);
		if (count($replies) == 0) {
			echo "There are no comment yet";
		} else {
			foreach ($replies as $r) {
				echo $r['username']; ?>&nbsp::&nbsp
				<?php echo $r['content']; ?>
				<br>
				<?php echo $r['timestamp']; ?>
				<br>
			<?php }
		}
	?>
<?php if ($username) { ?>
<form method="POST">
	<textarea name="content"></textarea>
	<br>
	<input type="submit" name="reply" value="reply">
</form>
<?php } else  {?>
<br>You must <a href="login.php">login</a> or <a href="register.php">register</a> first<br>
<?php } ?>

<?php } else { ?>
	<h2>Restrited area</h2>
	<a href="login.php">return to home</a>
<?php } ?>