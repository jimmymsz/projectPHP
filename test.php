<?php
echo "hello world";
	require_once "database.php";
	$dbPost = new postDB();
	$posts = $dbPost->selectByUsr("yoko");
	
	$gposts = $dbPost->selectByGrp("php");
	
	$dbUsr = new userDB();
	$members = $dbUsr->getGroups("yoko");	 

	unset($_COOKIE["name"]);
	setcookie("name", "Kuncoro", time() + 10000);

	if($_POST) {
		$title = $_POST["title"];
		$content = $_POST["content"];
		if(strlen($title) != 0) {
			if ($dbPost->insertPost("yoko", "php", $title, $content)) {
				echo "sukses";
			}
		}
	}	
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
	<?php foreach ($gposts as $p) { ?> 
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