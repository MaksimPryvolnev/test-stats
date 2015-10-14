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
		$secret = "35onoi2=-7#%g03kl";
		$hash2 = MD5($email . $secret);
		$result = $this->db->query("INSERT into users (name, email, login, password, hash) values('$userName', '$email', '$login', '$hash', '$hash2')");
		
		if ($result == TRUE) {
			return $this->db->insert_id;
		} else {
			printf("Errormessage: %s\n", $this->db->error);
			return FALSE;
		}
	}
	public function email() {
		$userName = $this->db->real_escape_string($this->userName);
		$password = $this->db->real_escape_string($this->password);
		$hash = password_hash($password, PASSWORD_DEFAULT);
   		$email = $this->db->real_escape_string($this->email);
		$login = $this->db->real_escape_string($this->login);
		$secret = "35onoi2=-7#%g03kl";
		$hash2 = MD5($email . $secret);
		$mail = new PHPMailer;
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.mandrillapp.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'pryvolnev.m@gmail.com';                 // SMTP username
		$mail->Password = '';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		echo "$email";
		$mail->setFrom('test@teststats.tk', 'Mailer');
		$mail->addAddress("$email", "$userName");     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo('test@teststats.tk', 'teststats.tk contact');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = 'Account registration';
		$mail->Body    = 'Dear $userName,
							You have just registered new account<br>
							Login: $login
							Password: $password
							To activate it press on the link below:
							 <a href="http://localhost/test-stats/ . $hash2">';
		$mail->AltBody = 'Dear $userName,
							You have just registered new account<br>
							Login: $login
							Password: $password
							To activate it press on the link below:
							 <a href="http://localhost/test-stats/ . $hash2">';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}
	}
}
