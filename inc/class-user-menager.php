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
	public function login($login, $password) {
		$login = $this->db->real_escape_string($login);
		$password = $this->db->real_escape_string($password);
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$verifyHash = password_verify($password, $hash);
		if ($verifyHash) {
			$result = $this->db->query("SELECT * from users WHERE login='$login' AND password='$hash'");
			if ($result && $result->num_rows == 1) {
				$row = $result->fetch_assoc();
				$_SESSION['user_logged_in'] = TRUE;
				$_SESSION['id'] = $row['id'];
				return TRUE;
			}
			else {
				return FALSE;
			}
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
}
