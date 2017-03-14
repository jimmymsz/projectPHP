<?php
	class Database {
		private $conn;

		function __construct() {
			$this->conn = mysqli_connect("localhost", "root", "", "forum");
			if (!$this->conn) {
				die(mysqli_connect_error());
			}			
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
		function check_login($username, $password) {
			$username = $this->secure_input($username);

			$query = "SELECT userName, password, fullName FROM user WHERE userName = '$username'";
			$result = $this->fetch($query);
			if (!$result) {
				echo "<script>window.location.href = 'login.php';</script>";
				exit();
			} 
			$result = $result[0];
			
			return ($password == $result['password'] ? $result['userName'] : -1);
		}

		function getMembers($groupId) {
			$query = "SELECT memberId, userName FROM member WHERE groupId = '$groupId'";
			return $this->fetch($query);
		}

		function getGroups($userName) {
			$query = "SELECT groupId FROM member WHERE userName = '$userName'";
			return $this->fetch($query);
		}
	}

	class postDB extends Database {
		public function insertPost($username, $group, $title, $content) {
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
	}
?>