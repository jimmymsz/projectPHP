<?php
	require_once 'database.php';
	if (!isset($dbUsr)) $dbUsr = new userDB();
	if (!isset($dbPost)) $dbPost = new postDB();
	$idGroup = $_GET['idGroup'];
	$group = $dbUsr->getGroup($idGroup);
	$admin = false;
	if (!isset($username)) $username = '';
	if ($username == $group['groupAdmin']) $admin = true;
	if (!isset($username)) $username = '';
	if (isset($_COOKIE['login'])) $username = $_COOKIE['login'];
	$res = $dbUsr->checkMember($username, $idGroup);
	$dbGroup = new groupDB();

	if (isset($_POST['join'])) {
		if (strcmp($username, '') == 0) {
			echo "you must register or login first";
		} else if ($res) {
			echo "you already joined";
		} else {
			if ($dbUsr->insertMember($username, $idGroup)) {
				echo "you joined";
				$res = true;
			} else {
				echo "failed to join";
			}
		}
	}

	if (isset($_POST['mpost'])) {
		if ($dbGroup->updateMain($_POST['mainpost'], $idGroup)) {
			echo "<script>alert(update post utama sukses)</script>";
		} else {
			echo "<script>alert(gagal)</script>";
		}
	}
	 ?>
	<h1><?php echo $group['groupName'];?></h1>

	<?php $members = $dbUsr->getMembers($idGroup);
		$groupPosts = $dbPost->selectByGrp($idGroup); 
	?>
	<h2>Members:</h2>
	<?php  
	if (count($members) == 0) {
		echo "don't have any member?";
	} else { ?> 
		<ul>
		<?php foreach ($members as $m) { ?> 
			<li><a href="idx.php?page=persona&user=<?php echo $m['userName']; ?>"><?php echo $m['userName']; ?></a>
				&nbsp
				<?php if ($m['userName'] == $group['groupAdmin']) {
					echo "(admin)";
				} ?>
			</li>
		<?php } ?>
		</ul>	
	<?php }

	if (!$res) { ?>
		<form method="POST">
			<input type="submit" name="join" value="Join this group">
		</form>
	<?php } ?>
	<h2>Main Posts</h2>
	<p><?php if ($group['mainPost']) {
		echo $group['mainPost'];
	} else {
		echo "Grup ini belum memiliki post utama";
	} ?></p>
	<?php if ($admin) { ?> 
		<a href="home.php?page=group&idGroup=<?php echo $idGroup; ?>&update=true">update post utama</a>
		<?php if(isset($_GET['update'])) { ?>
			<form method="POST" action="home.php?page=group&idGroup=<?php echo $idGroup; ?>">
				Konten Post Utama: <textarea name="mainpost"></textarea> 
				<input type="submit" name="mpost">
			</form>
		<?php } ?>
	<?php } ?>
	<h2>Recent posts:</h2>
	<?php if (count($groupPosts) == 0) {
			echo "Empty post.<br>";
		} else { ?>
		<ul>
		<?php foreach ($groupPosts as $p) { ?> 
			<li>
				<?php echo $p['timestamp']; ?><br>
				<b><?php echo $p['title']; ?></b>
				<br>
				<?php echo $p['content']; ?>
			</li>
			<br>
		<?php } ?>
		</ul>
	<?php } ?>