<?php
	if (!defined('logon')) { ?>
		<h1>Restricted access!</h1>
		<a href="login.php">Kembali ke halaman login</a>
		<?php die();
	}
	$posts = $dbPost->selectByUsr($username); ?>

	<a href="indexx.php?page=persona&user=<?php echo $username; ?>">Check or edit your profile</a>
<?php	if (count($groups) == 0) {
			echo "You don't have any groups yet<br>"; ?>
<?php } else { ?>
	<h2>Your Groups:</h2>
	<ul>
	<?php foreach ($groups as $g) { ?>
		<li>
			<a href="home.php?page=group&idGroup=<?php echo $g['groupId'];?>"><?php echo $g['groupName']; ?></a>
		</li>
	<?php } ?>
	</ul>
	<a href="search.php">Join a group</a>
	or
	<a href="home.php?page=newGroup">Create a group</a><br><br>	
		<?php }
		if (count($posts) == 0) {
			echo "Empty post.<br>";
		} else {
	?>
		<br>
		<h2>Your recent posts:</h2>
		<?php foreach ($posts as $p) { ?> 
			<div>
				<b><?php echo $p['title']; ?></b>
				Group: <?php echo $p['groupId']?>
				<br>
				<?php echo $p['content']; ?>
				<br>
				<a href="index.php?page=delPos&postId=<?php echo $p['idPost']; ?>">delete</a>
			</div>
			<br>
		<?php } ?>
	<?php } ?>