<?php 
	$postId = $_GET['postId'];
	require_once 'database.php';
	$dbPost = new postDB();
	$post = $dbPost->getPost($postId);

	if (isset($_POST['delete'])) {
		if ($dbPost->deletePost($postId)) {
			echo "<script>window.location.href = 'home.php';</script>";
		} else {
			echo "<script>alert('gagal delete');</script>";
		}
	} else if (isset($_POST['cancel'])) {
		echo "<script>window.location.href = 'home.php';</script>";
	}
?>
<form method="POST">
<p>Group: <?php echo $post['groupId'] ?></p>
<p>Title: <?php echo $post['title']; ?></p>
<p>Content: <?php echo $post['content']; ?></p>
<p>Are you sure you want to delete?</p>
<input type="submit" name="delete" value="Delete">
<input type="submit" name="cancel" value="Cancel">
</form>
