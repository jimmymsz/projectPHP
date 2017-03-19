<?php
if (count($groups) == 0) {
			echo "You don't have any groups yet";
		} else { ?>
			<?php foreach ($groups as $g) { ?>
			<a href="home.php?page=grup&idGroup=<?php echo $g['groupId'];?>"><?php echo $g['groupId']; ?></a>
			<br>
			<?php } ?>
		<?php }
		if (count($posts) == 0) {
			echo "Empty post.<br>";
		} else {
	?>
		<?php foreach ($posts as $p) { ?> 
			<div>
				<b><?php echo $p['title']; ?></b>
				Group: <?php echo $p['groupId']?>
				<br>
				<?php echo $p['content']; ?>
			</div>
		<?php } ?>
	<?php } ?>