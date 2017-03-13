<?php
echo "hello world";
	require_once "database.php";
	$dbPost = new postDB();
	$posts = $dbPost->selectByUsr("yoko");

	$dbUsr = new userDB();
	$members = $dbUsr->getGroups("yoko");	 

	unset($_COOKIE["name"]);
	setcookie("name", "Kuncoro", time() + 10000);
	
?>
<br>
<?php
	if (count($posts) == 0) {
		echo "Empty post.<br>";
	} else {
?>
	<?php foreach ($members as $m) {
			echo $m['groupId']; ?>
			<br>
	<?php } ?>
	<?php foreach ($posts as $p) { ?> 
		<div>
			<b><?php echo $p['title']; ?></b>
			<br>
			<?php echo $p['content']; ?>
		</div>
	<?php } ?>
<?php } ?>

<form action="test.php" method="post">
	Title
	<input type="text" name="title">
	<br>
	<textarea name="content"></textarea>
	<br>
	<input type="submit" name="submit" value="Save">
</form>