<?php 
	$groupid = $_GET['group'];
	$dbUser = new userDB();
	$members = $dbUser->getMembers($groupid);
	$dbTask = new taskDB();
	$usr = $_GET['usr'];
	$tasks = $dbTask->getTask($groupid, 0);
	$done = $dbTask->getTask($groupid, 1);
	$group = $dbUser->getGroup($groupid);
	$admin = false;
	if ($usr == $group['groupAdmin']) $admin = true;
	if (isset($_POST['task'])) {
		$name = $_POST['name'];
		$detail = $_POST['detail'];
		$username = $_POST['username'];
		echo $_POST['task'];
		if ($dbTask->insert($name, $detail, $username, $groupid)) {
			echo "<script>window.location.href='home.php?page=group&idGroup=$groupid';</script>";
		} else {
			echo "<script>alert('gagal insert');</script>";
		}
	} else if (isset($_POST['done'])) {
		$taskid = $_POST['taskid'];
		$status = 1;
		
		if ($dbTask->statChg($taskid, $status)) {
			$uri = $_SERVER['REQUEST_URI'];
			echo "<script>alert('update berhasil');</script>";
			echo "<script>window.location.href='$uri';</script>";
		} else {
			echo "<script>alert('update gagal');</script>";
		}
	}
?>
<h2>Pending Task</h2>
<ul>
	<?php foreach ($tasks as $t) { ?>
		<?php if ($t['status'] == 0) { ?>
			<li>
				PIC: <?php echo $t['username']; ?><br>
				<b><?php echo $t['taskName'] ?></b>
				<br>
				<?php if ($t['taskDetail'] != "") echo $t['taskDetail']; 
					else echo "no description for this task";
				?>
				<br>
				Status: pending
				<br>
				<?php if (strcasecmp($usr, $t['username']) == 0 && $t['status'] == 0) { ?>
				<form method="POST">
					<input type="hidden" name="taskid" value="<?php echo $t['taskId']; ?>">
					<input type="submit" name="done" value="done">
				</form>
				<?php } ?>
			</li>
		<?php } ?>
	<?php } ?>
</ul>
<h2>Done Task</h2>
<ul>
	<?php foreach ($done as $t) { ?>
		<?php if ($t['status'] == 1) { ?>
			<li>
				PIC: <?php echo $t['username']; ?><br>
				<b><?php echo $t['taskName'] ?></b>
				<br>
				<?php if ($t['taskDetail'] != "") echo $t['taskDetail']; 
					else echo "no description for this task";
				?>
				<br>
				Status: done
			</li>
		<?php } ?>
	<?php } ?>
</ul>
<?php if ($admin) { ?>
<h2>Add new Task</h2>
<form method="post">
	Task Name:
	<input type="text" name="name" required="true">
	<br>
	<textarea name="detail"></textarea>
	<br>
	Member:
	<select name="username" required="true">
		<?php foreach ($members as $m) { ?>
			<option value="<?php echo $m['userName']; ?>"><?php echo $m['userName']; ?></option>
		<?php } ?>
	</select>
	<input type="submit" name="task" value="Save">
</form>
<?php } ?>