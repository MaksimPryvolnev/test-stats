<?php
class TSUserManager {
	public $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function login($login, $password) {
		$login = $this->db->real_escape_string($login);
		$password = $this->db->real_escape_string($password);
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$verifyHash = password_verify($password, $hash);
		if ($verifyHash) {
			$result = $this->db->query("SELECT * from users WHERE login='$login'");
			if ($result && $result->num_rows == 1) {
				$row = $result->fetch_assoc();
				$_SESSION['user_logged_in'] = true;
				$_SESSION['id'] = $row['id'];
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}

	}

	public function isLoggedIn() {
		if (array_key_exists('user_logged_in', $_SESSION) && $_SESSION['user_logged_in'] == true) {
			return true;
		} else {
			return false;
		}
	}
}
