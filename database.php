<?php
	class Database {
		private $conn;

		function __construct() {
			$this->conn = mysqli_connect("localhost", "root", "", "forum");
			if (!$this->conn) {
				die(mysqli_connect_error());
			}			
		}
		
		function query($query) {
			return $this->conn->query($query);
			//return mysqli_query($this->conn, $query);
		}

		function getDateTime() {
			return date('Y-m-d H:i:s');
		}

		function secure_input($input) {
			return $this->conn->real_escape_string(strip_tags($input));
		}

		function fetch($query) {
			$result = $this->conn->query($query);
			$retval = array();
			while ($row = mysqli_fetch_array($result)) {
				array_push($retval, $row);
			}
			return $retval;
		}

		function prepare($query) {
			return $this->conn->prepare($query);
		}				
	}

	class userDB extends Database {
		function getUsr($username) {
			$query = "SELECT * FROM user WHERE userName = '$username'";
			$result = $this->fetch($query);
			if ($result) {
				return $result[0];
			} else {
				return -1;
			}
		}

		function check_login($username, $password) {
			$username = $this->secure_input($username);

			$query = "SELECT userName, password, fullName FROM user WHERE userName = '$username'";
			$result = $this->fetch($query);
			if (!$result) {
				// BUG!
				// echo "<script>window.location.href = 'login.php';</script>";
				// exit();
				return -1;
			}
			else {
				$result = $result[0];
				
				return (password_verify($password, $result['password']) ? $result['userName'] : -1);
			}
		}

		function insertUsr($username, $email, $fullname, $bday,$gender, $password) {
			$timestamp = $this->getDateTime();
			$username = $this->secure_input($username);
			$email = $this->secure_input($email);
			$fullname = $this->secure_input($fullname);
			$bday = $this->secure_input($bday);
			$gender = $this->secure_input($gender);
			$password = password_hash($password, PASSWORD_DEFAULT);
			$chk = $this->getUsr($username);
			if ($chk == -1) {
				$query = "INSERT INTO user(userName, email, fullName, birthDay, gender, passWord, timestamp) VALUES ('$username', '$email', '$fullname','$bday', '$gender','$password', '$timestamp')";
				return $this->query($query);
			} else {
				return -1;
			}
		}

		function getMembers($groupId) {
			$query = "SELECT memberId, userName FROM member WHERE groupId = '$groupId'";
			return $this->fetch($query);
		}

		function getMember($groupId, $username) {
			$query = "SELECT memberId, userName FROM member WHERE groupId = '$groupId' AND userName = '$username'";
			return $this->fetch($query);
		}

		function insertMember($username, $idgroup) {
			$username = $this->secure_input($username);
			$idgroup = $this->secure_input($idgroup);
			$query = "INSERT INTO member(userName, groupId) VALUES ('$username', '$idgroup')";
			return $this->query($query);
		}

		function getGroups($userName) {
			$query = "SELECT groupId, groupName FROM member LEFT JOIN forumgroup ON member.groupId = forumgroup.idGroup WHERE member.userName = '$userName'";
			return $this->fetch($query);
		}

		function getGroup($groupid) {
			$query = "SELECT * FROM forumgroup WHERE idGroup = '$groupid'";
			$result = $this->fetch($query);
			$result = $result[0];
			return $result;
		}

		function checkMember($username, $groupid) {
			$query = "SELECT * FROM member WHERE userName = '$username' AND groupId = '$groupid'";
			$result = $this->fetch($query);
			if ($result) {
				return $result[0];
			} else {
				return false;
			}
		}

		function delMemb($username, $groupid) {
			$query = "DELETE FROM member WHERE userName = '$username' AND groupId = '$groupid'";
			return $this->query($query);
		}
	}

	class postDB extends Database {
		function insertPost($username, $group, $title, $content) {
			$timestamp = $this->getDateTime();
			$query = "INSERT INTO post(userName,groupId, title, content, timestamp) VALUES (?, ?, ?, ?, ?)";
			$stmt = $this->prepare($query);
			$stmt->bind_param("sssss", $username, $group, $title, $content, $timestamp);
			return $stmt->execute();	
		}

		function getPost($postId) {
			$query = "SELECT * FROM post WHERE idPost = $postId";
			$result = $this->fetch($query);
			return $result[0];
		}

		function selectByUsr($username) {
			$query = "SELECT * FROM post WHERE userName = '$username' ORDER BY timestamp ASC";
			return $this->fetch($query);
		}

		function selectByGrp($groupid) {
			$query = "SELECT * FROM post WHERE groupId = '$groupid' ORDER BY timestamp DESC";
			return $this->fetch($query);
		}

		function selectPbl() {
			$query = "SELECT * FROM post WHERE groupId = 'public' ORDER BY timestamp DESC";
			return $this->fetch($query);
		}

		function deletePost($postId) {
			$postId = intval($this->secure_input($postId));
			$query = "DELETE FROM post WHERE idPost = '$postId'";
			return $this->query($query);
		}
	}

	class groupDB extends Database {
		function getGroups($groupname) {
			$query = "SELECT * FROM forumgroup WHERE groupName LIKE '%$groupname%'";
			return $this->fetch($query);
		}

		function getAll() {
			$query = "SELECT * FROM forumgroup";
			return $this->fetch($query);
		}

		function insertGroup($idgroup, $groupname, $groupadmin) {
			$timestamp = $this->getDateTime();
			$idgroup = $this->secure_input($idgroup);
			$groupname = $this->secure_input($groupname);
			$groupadmin = $this->secure_input($groupadmin);

			$query = "INSERT INTO forumgroup(idGroup, groupName, totalUser, groupAdmin, timeStamp) VALUES ('$idgroup', '$groupname', 1, '$groupadmin', '$timestamp')";

			return $this->query($query);
		}

		function updateMain($content, $groupid) {
			$query = "UPDATE forumgroup SET mainPost = '$content' WHERE idGroup = '$groupid'";
			return $this->query($query);
		}

		function deleteMember($username, $groupid) {
			$query = "DELETE FROM member WHERE username = '$username' AND groupId = '$groupid'";
			return $this->query($query);
		}
	}

	class taskDB extends Database {
		function insert($name, $detail, $username, $groupid) {
			$name = $this->secure_input($name);
			$detail = $this->secure_input($detail);
			$status = $this->secure_input($detail);
			$username = $this->secure_input($username);
			$timeStamp = $this->getDateTime();
			$query = "INSERT INTO grouptask(taskName, taskDetail, status, username, groupid, timeStamp) VALUES ('$name', '$detail', 0, '$username', '$groupid' ,'$timeStamp')";
			return $this->query($query);
		}

		function getTask($groupid, $status) {
			$query = "SELECT * FROM grouptask WHERE groupid = '$groupid' AND status = '$status'";
			return $this->fetch($query);
		}

		function statChg($taskid, $status) {
			$query = "UPDATE grouptask SET status = '$status' WHERE taskId = '$taskid'";
			return $this->query($query);
		}
	}
?>