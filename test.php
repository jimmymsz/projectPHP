<?php
echo "hello world";
	require_once "database.php";
	$dbPost = new postDB();
	$posts = $dbPost->selectByUsr("yoko");	 
?>

<?php
	if (count($posts) == 0) {
		echo "Empty post.<br>";
	} else {
?>
	<?php foreach ($posts as $p) { ?> 
		<div>
			<b><?php echo $p['title']; ?></b>
			<br>
			<?php echo $p['content']; ?>
		</div>
	<?php } ?>
<?php } ?>