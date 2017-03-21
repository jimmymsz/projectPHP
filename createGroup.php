<?php
	if(isset($_POST['newGroup'])) {
		$idgroup = $_POST['idgroup'];
		$groupname = $_POST['groupname'];
		if ($dbGroup->insertGroup($idgroup, $groupname, $username)) {
			if($dbUsr->insertMember($username, $idgroup)) {
				header("location: home.php");
				exit("<script>alert('Grup berhasil dibuat')</script>");
			} else {
				echo "gagal insert member";
			}
		} else {
			echo "gagal";
		}
	}
?>
<form method="POST">
	Group id: <input type="text" name="idgroup"><br>
	Nama group: <input type="text" name="groupname">
	<input type="submit" name="newGroup" value="Buat Grup">
</form>