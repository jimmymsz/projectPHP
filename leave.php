<?php 
	session_start();
	$grupid = $_GET['grup'];
	$username = $_GET['user'];
	if (strcmp($username, $_SESSION['login']) != 0) { ?>
		<h1>Restricted access!</h1>
		<?php if (!isset($_SESSION['login'])) ?>
		<a href="login.php">Kembali ke halaman login</a>
		<?php die();
	} 
	require_once 'database.php';
	$dbUsr = new userDB();
	$grup = $dbUsr->getGroup($grupid);
	$user = $dbUsr->getMember($grupid, $username);

	if (isset($_POST['leave'])) {
		if ($dbUsr->delMemb($username, $grupid)) {
			echo "<script>window.location.href = 'home.php';</script>";
		} else {
			echo "<script>alert('gagal leave');</script>";
		}
	} else if (isset($_POST['cancel'])) {
		echo "<script>window.location.href = 'home.php';</script>";
	}
?>
<form method="POST">
<p>Are you sure you want to leave <?php echo $grup['groupName']; ?>?</p>
<input type="submit" name="leave" value="Leave">
<input type="submit" name="cancel" value="Cancel">
</form>
