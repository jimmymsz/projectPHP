<?php
	if (!defined('logon')) { ?>
		<h1>Restricted access!</h1>
		<a href="login.php">Kembali ke halaman login</a>
		<?php die();
	}
	
if (count($groups) == 0) {
			echo "You don't have any groups yet";
} else { ?>
	<h2>Your Groups:</h2>
	<?php foreach ($groups as $g) { ?>
	<a href="home.php?page=grup&idGroup=<?php echo $g['groupId'];?>"><?php echo $g['groupId']; ?></a>
	<br>
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