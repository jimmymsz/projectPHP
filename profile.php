<?php
	if (!defined('logon')) { ?>
		<h1>Restricted access!</h1>
		<a href="login.php">Kembali ke halaman login</a>
		<?php die();
	}
	$posts = $dbPost->selectByUsr($username); ?>

	<a href="index.php?page=persona&user=<?php echo $username; ?>">Check or edit your profile</a>
	<h2>Your Groups:</h2>
<?php	if (count($groups) == 0) {
			echo "<br>You don't have any groups yet<br>"; ?>
<?php } else { ?>
	<ul>
	<?php foreach ($groups as $g) { ?>
		<li>
			<a href="home.php?page=group&idGroup=<?php echo $g['groupId'];?>"><?php echo $g['groupName']; ?></a>
		</li>
	<?php } ?>
	</ul>
		<?php } ?>
	<a href="search.php">Join a group</a>
	or
	<a href="home.php?page=newGroup">Create a group</a><br><br>			
		<h2>Your recent posts:</h2>		
		<?php if (count($posts) == 0) {
			echo "Empty post.<br>";
		} else {
	?>
		<br>
		<?php foreach ($posts as $p) { ?> 
			<div>
				<b><?php echo $p['title']; ?></b>
				Group: <?php echo $p['groupId']?>
				<br>
				<?php echo $p['content']; ?>
				<br>
				<a href="index.php?page=delPos&postId=<?php echo $p['idPost']; ?>">delete</a>
				&nbsp
				<a href="index.php?page=comment&post=<?php echo $p['idPost']; ?>">comment</a>
			</div>
			<br>
		<?php } ?>
	<?php } ?>