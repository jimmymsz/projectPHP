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
				echo "<script>window.location.href = 'login.php';</script>";
				exit();
			} 
			$result = $result[0];
			
			return (password_verify($password, $result['password']) ? $result['userName'] : -1);
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

		function getGroups($userName) {
			$query = "SELECT groupId FROM member WHERE userName = '$userName'";
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
	}

	class postDB extends Database {
		function insertPost($username, $group, $title, $content) {
			$timestamp = $this->getDateTime();
			$query = "INSERT INTO post(userName,groupId, title, content, timestamp) VALUES (?, ?, ?, ?, ?)";
			$stmt = $this->prepare($query);
			$stmt->bind_param("sssss", $username, $group, $title, $content, $timestamp);
			return $stmt->execute();	
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
	}

	class groupDB extends Database {
		function getGroups($groupname) {
			$query = "SELECT * FROM forumgroup WHERE groupName LIKE '%$groupname%'";
			return $this->fetch($query);
		}
	}
?>