<?php
class TSUser {
	public $db;
	public $userName;
	public $password;
	public $login;
	public $email;
	
	public function __construct($db, $userName, $password, $login, $email) {
		$this->db = $db;
		$this->userName = $userName;
		$this->password = $password;
		$this->login = $login;
		$this->email = $email;
	}
	
	public function addUser() {
		$userName = $this->db->real_escape_string($this->userName);
		$password = $this->db->real_escape_string($this->password);
		$hash = password_hash($password, PASSWORD_DEFAULT);
   		$email = $this->db->real_escape_string($this->email);
		$login = $this->db->real_escape_string($this->login);
		$result = $this->db->query("INSERT into users (name, email, login, password) values('$userName', '$email', '$login', '$hash')");
		
		if ($result == TRUE) {
			return $this->db->insert_id;
		} else {
			printf("Errormessage: %s\n", $this->db->error);
			return FALSE;
		}
	}
}
