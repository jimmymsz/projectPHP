<?php
	$idGroup = $_GET['idGroup'];
	$group = $dbUsr->getGroup($idGroup);
	echo $group['groupName'];

	$members = $dbUsr->getMembers($idGroup);
	$groupPosts = $dbPost->selectByGrp($idGroup);
	if (count($posts) == 0) {
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
	<?php } 
	if (count($members) == 0) {
		echo "don't have any member?";
	} else {
		foreach ($members as $m) {
			echo $m['userName'];		
		}	
	}
	?>
