<?php
	$idGroup = $_GET['idGroup'];
	$group = $dbUsr->getGroup($idGroup); ?>
	<h1><?php echo $group['groupName'];?></h1>

	<?php $members = $dbUsr->getMembers($idGroup);
	$groupPosts = $dbPost->selectByGrp($idGroup); ?>
	<h2>Members:</h2>
	<?php  
	if (count($members) == 0) {
		echo "don't have any member?";
	} else { 
		foreach ($members as $m) { 
			echo $m['userName'];		
		}	
	}
	?>
	<h2>Recent posts:</h2>
	<?php if (count($posts) == 0) {
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