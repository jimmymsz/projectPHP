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
	if (isset($_SESSION['login'])) $username = $_SESSION['login'];
	$res = $dbUsr->checkMember($username, $idGroup);
	$dbGroup = new groupDB();
	$dbTask = new taskDB();
	$tasks = $dbTask->getTask($idGroup, 0);

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
	} else if (isset($_POST['mpost'])) {
		if ($dbGroup->updateMain($_POST['mainpost'], $idGroup)) {
			$uri = $_SERVER['REQUEST_URI'];
			echo "<script>alert('update tujuan grup sukses');</script>";
			echo "<script>window.location.href='$uri';</script>";
		} else {
			echo "<script>alert('gagal');</script>";
		}
	} else if (isset($_POST['leave'])) {
		echo "<script>window.location.href='leave.php?grup=$idGroup&user=$username';</script>";
	} ?>
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
			<li><a href="index.php?page=persona&user=<?php echo $m['userName']; ?>"><?php echo $m['userName']; ?></a>
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
	<?php } else { ?>
		<form method="POST">
			<input type="submit" name="leave" value="Leave this group">
		</form>
	<?php } ?>
	<h2>Group Goal</h2>
	<p><?php if ($group['mainPost']) {
		echo $group['mainPost'];
	} else {
		echo "Grup ini belum memiliki tujuan";
	} ?></p>
	<?php if ($admin) { ?> 
		<?php if(isset($_GET['update'])) { ?>
			<form method="POST" action="home.php?page=group&idGroup=<?php echo $idGroup; ?>">
				Tujuan: <textarea name="mainpost"></textarea> 
				<input type="submit" name="mpost">
			</form>
		<?php } else {?>
		<a href="home.php?page=group&idGroup=<?php echo $idGroup; ?>&update=true">update tujuan grup</a>
	<?php }} ?>
	<h2>Pending Task</h2>
	<?php if (count($tasks) == 0) {
		echo "This group doesn't have any tasks";
	} else { 
		$total = count($tasks);
		echo "you still have $total pending tasks"; ?>
	<?php } ?>
	<br>
	<?php if ($res) {?><a href="index.php?page=task&group=<?php echo $idGroup; ?>&usr=<?php echo $username ;?>">Manage task</a>
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
				<br>
				<?php if ($admin) { ?>
					<a href="index.php?page=delPos&postId=<?php echo $p['idPost']; ?>">delete</a>
				<?php } ?>
			</li>
			<br>
		<?php } ?>
		</ul>
	<?php } ?>