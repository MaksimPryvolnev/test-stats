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
		$hash2 = password_hash($email, PASSWORD_DEFAULT);
		$result = $this->db->query("INSERT into users (name, email, login, password, hash) values('$userName', '$email', '$login', '$hash', '$hash2')");
		
		if ($result == TRUE) {
			$_SESSION['hash'] = $hash2;
			return $this->db->insert_id;
		} else {
			printf("Errormessage: %s\n", $this->db->error);
			return FALSE;
		}
	}
	public function email() {
		$userName = $this->userName;
		$password = $this->password;
   		$email = $this->email;
		$login = $this->login;
		$hash = $_SESSION['hash'];
		$mail = new PHPMailer;
		// $mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'xxxx';                 // SMTP username
		$mail->Password = 'xxxx';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		echo "$email";
		$mail->setFrom('test@teststats.tk', 'Mailer');
		$mail->addAddress($email);     // Add a recipient
		// $mail->addAddress('ellen@example.com');               // Name is optional
		// $mail->addReplyTo('test@teststats.tk', 'teststats.tk contact');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = 'Account registration';
		$mail->Body    = 'Dear ' . $userName . ',<br>
							You have just registered new account<br>
							Login:' . $login . '<br>
							Password:' . $password . '<br>
							To activate it press on the link below:<br> 
							 <a href= "http://localhost/test-stats/' . 'login.php?verifyUser=' . $hash . "\">Press here</a>";
		$mail->AltBody = 'Dear ' . $userName . ',<br>
							You have just registered new account<br>
							Login:' . $login . '<br>
							Password:' . $password . '<br>
							To activate it press on the link below:<br>
							 <a href= "http://localhost/test-stats/' . 'login.php?verifyUser=' . $hash . "\">Press here</a>";

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}
	}
}
