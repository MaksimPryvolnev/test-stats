<?php
class TSUserManager {
	public $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function emailExist($email) {
		$email = $this->db->real_escape_string($email);
		$sql = $this->db->query("SELECT * FROM users WHERE email='$email'");

		if ($sql && $sql->num_rows > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function login($name, $password) {
		$name = $this->db->real_escape_string($name);
		$password = $this->db->real_escape_string($password);
		$result = $this->db->query("SELECT * from users WHERE name='$name'");
		$row = mysqli_fetch_array($result);
		$pw = $row['password'];
		$verifyHash = password_verify($password, $pw);
		if ($verifyHash) {
			$_SESSION['user_logged_in'] = TRUE;
			$_SESSION['id'] = $row['id'];
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	public function isLoggedIn() {
		if (array_key_exists('user_logged_in', $_SESSION) && $_SESSION['user_logged_in'] == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function sqlActivate($value, $getHash) {
		$value = $this->db->real_escape_string($value);
		$getHash = $this->db->real_escape_string($getHash);
		$search = $this->db->query("SELECT email, hash, active FROM users WHERE hash='$getHash' AND active='0'") or die(mysql_error()); 
		$match  = mysqli_num_rows($search);
		if ($match > 0) {
			$result = $this->db->query("UPDATE users SET active='$value'  WHERE hash='$getHash'");
		}
	}
}
