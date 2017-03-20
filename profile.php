<?php
	if (!defined('logon')) { ?>
		<h1>Restricted access!</h1>
		<a href="login.php">Kembali ke halaman login</a>
		<?php die();
	}
	
if (count($groups) == 0) {
			echo "You don't have any groups yet<br>";
} else { ?>
	<h2>Your Groups:</h2>
	<ul>
	<?php foreach ($groups as $g) { ?>
		<li>
			<a href="home.php?page=grup&idGroup=<?php echo $g['groupId'];?>"><?php echo $g['groupId']; ?></a>
		</li>
	</ul>
	<a href="search.php">Join a group</a>
	or
	<a href="home.php?page=newGroup">Create a group</a>
	<?php } ?>
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
			</div>
			<br>
		<?php } ?>
	<?php } ?>