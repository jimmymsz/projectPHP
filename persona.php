<?php
	if (isset($_COOKIE['login'])) {
		$username = $_COOKIE['login'];
	} else { ?>
		<h1>Restricted access!</h1>
		<a href="login.php">Kembali ke halaman login</a>
		<?php die();
	}
	$user = $_GET['user'];
	require_once 'database.php';
	$dbUser = new userDB();
	$thisUser = $dbUser->getUsr($user); ?>
	<a href="home.php">Return to home</a>

<?php if ($username == $user) {
?>


<form>
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
	new Password : <input type="password" name="oldPass">
	<br>
</form>

<?php  } else { ?>
	<p>Full Name: <?php echo $thisUser['fullName']; ?></p>
	<p>gender: <?php echo $thisUser['gender']; ?></p>
	<p>Birthday: <?php echo $thisUser['birthDay']; ?></p>
<?php } ?>
