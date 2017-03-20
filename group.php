<?php
	require_once 'database.php';
	if (!isset($dbUsr)) $dbUsr = new userDB();
	if (!isset($dbPost)) $dbPost = new postDB();
	$idGroup = $_GET['idGroup'];
	$group = $dbUsr->getGroup($idGroup);
	
	if (!isset($username)) $username = '';
	if (isset($_COOKIE['login'])) $username = $_COOKIE['login'];
	$res = $dbUsr->checkMember($username, $idGroup);

	if (isset($_POST['join'])) {
		if (strcmp($username, '') == 0) {
			echo "you must register or login first";
		} else if ($res) {
			echo "you already joined";
		} else {
			if ($dbUsr->insertMember($username, $idGroup)) {
				echo "you joined";
			} else {
				echo "failed to join";
			}
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
			<li><?php echo $m['userName']; ?></li>
		<?php } ?>
		</ul>	
	<?php }

	if (!$res) { ?>
		<form method="POST">
			<input type="submit" name="join" value="Join this group">
		</form>
	<?php } ?>
	<h2>Recent posts:</h2>
	<?php if (count($groupPosts) == 0) {
			echo "Empty post.<br>";
		} else {
		foreach ($groupPosts as $p) { ?> 
			<div>
				<b><?php echo $p['title']; ?></b>
				<br>
				<?php echo $p['content']; ?>
			</div>
			<br>
		<?php } ?>
	<?php } ?>