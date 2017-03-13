<?php
	class Database {
		private $conn;

		function __construct() {
			$this->conn = mysqli_connect("localhost", "root", "", "forum");
			if (!$this->conn) {
				die(mysqli_connect_error());
			}			
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
	}

	class userDB extends Database {
		function check_login($username, $password) {
			$username = $this->secure_input($username);

			$query = "SELECT userName, password FROM user WHERE userName = '$username'";
			$result = $this->fetch($query);
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
		function selectByUsr($username) {
			$query = "SELECT * FROM post WHERE userName = '$username' ORDER BY timestamp ASC";
			return $this->fetch($query);
		}
	}
?>