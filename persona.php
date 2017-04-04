<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if (isset($_SESSION['login'])) {
		$username = $_SESSION['login'];
	} else { ?>
		<h1>Restricted access!</h1>
		<a href="login.php">Kembali ke halaman login</a>
		<?php die();
	}
	$err = array();
	$user = $_GET['user'];
	require_once 'database.php';
	$dbUser = new userDB();
	$thisUser = $dbUser->getUsr($user); 

	if (isset($_POST['persona'])) {
		$fname = trim($_POST['fname']);
		$email = trim($_POST['email']);
		$gender = trim($_POST['gender']);
		$bday = trim($_POST['bday']);
		$oldPass = trim($_POST['oldPass']);
		$newPass = trim($_POST['newPass']);
		if ($_POST['oldPass'] && $_POST['newPass']) {
			$res = $dbUser->check_login($user, $oldPass);
			if ($res == -1) {
				array_push($err, 'password lama salah\n');
			} else {
				if ($dbUser->updateUser($user, $fname, $email, $gender, $bday, $newPass)) {
					$uri = $_SERVER['REQUEST_URI'];
					echo "<script>alert('update data berhasil');</script>";
					echo "<script>window.location.href='$uri';</script>";
				} else {
					echo "<script>alert('update data gagal');</script>";
				}
			}
		} else if($_POST['oldPass']) {
			echo "<script>alert('tolong isi password baru');</script>";
		} else if($_POST['newPass']) {
			echo "<script>alert('tolong isi password lama');</script>";
		} else {
			if ($dbUser->updateUser($user, $fname, $email, $gender, $bday, $newPass)) {
				$uri = $_SERVER['REQUEST_URI'];
				echo "<script>alert('update data berhasil');</script>";
				echo "<script>window.location.href='$uri';</script>";
			} else {
				echo "<script>alert('update data gagal');</script>";
			}
		}
	}
	?>
<?php if ($username == $user) {
?>


<form method="POST">
	Full Name: <input type="text" name="fname" value="<?php echo $thisUser['fullName']; ?>">
	<br>
	email: <input type="email" name="email" value="<?php echo $thisUser['email']?>">
	<br>
	gender: <select name="gender" required="true">
				<option value="M">Male</option>
				<option value="F">Female</option>
				<option value=".">Prefer not to say&nbsp;&nbsp;</option>
			</select>
	<br>
	Birthday: <input type="date" name="bday" value="<?php echo $thisUser['birthDay']?>">
	<br>
	old Password: <input type="password" name="oldPass">
	<br>
	new Password : <input type="password" name="newPass">
	<br>
	<input type="submit" name="persona" value="Save">
</form>

<?php  } else { ?>
	<p>Full Name: <?php echo $thisUser['fullName']; ?></p>
	<p>gender: <?php echo $thisUser['gender']; ?></p>
	<p>Birthday: <?php echo $thisUser['birthDay']; ?></p>
<?php } ?>
