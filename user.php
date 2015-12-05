<?php
session_start();

//configuration file.
require_once 'inc/config.php';
//necessary functions.
require_once 'inc/functions.php';
//class responds for upload and output test data.
require_once 'inc/class-test.php';
//mysqli connection to the database.
require_once 'inc/connect-db.php';
//class responds for user to stay login.
require_once 'inc/class-user-menager.php';

//check if user is already logged in
$um = new TSUserManager($conn);
$loggedIn = $um->isLoggedIn();

//registration form erros array
$errors = array('name'=>'', 'password'=>'', 'email'=>'', 'login'=>'');

//if user is not logged in and form is submited
if ($loggedIn == false && !empty($_POST)) {
	
	//post data from registration form
	$name = $_POST['name'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$login = $_POST['userlogin'];

	//if email exists in database than error will show
	//$exist = $um->emailExist($email);
	//if($exist == TRUE && !empty($_POST['email'])) {
	//	$errors['email'] = 'Email already exists';
	//}

	//validate regestration form and add errors to the errors array
	if (empty($name)) {
		$errors['name'] = 'Enter your name';
	}

	if (empty($password)) {
		$errors['password'] = 'Enter your password';
	}

	if (empty($email)) {
		$errors['email'] = 'Enter your email';
	}

	if (empty($login)) {
		$errors['login'] = 'Enter your login';
	}

	if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		$errors['name'] = 'Only letters and white space allowed';
	}

	if (strlen($password) < 6) {
		$errors['password'] = 'Secure password must have minimum 6 characters';
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Invalid email format';
	}

	if (!preg_match("/^[a-zA-Z ]*$/",$login)) {
		$errors['login'] = 'Only letters and white space allowed';
	}

	//if there is no errors
	if (empty($errors['name']) && empty($errors['login']) && empty($errors['email']) && empty($errors['password'])) {
		
		//add user to the database
		$user = new TSUser($conn, $name, $password, $login, $email);
		$result = $user->addUser();
		if ($result == true) {
			
			//email library (PHPMailer)
			require_once 'inc/PHPMailer/PHPMailerAutoload.php';
			//send verification email to new user
			$newEmail = $user->email($base_url);

			// Redirect to home page.
			//header('Location:' . $base_url . 'login.php');
			//exit();
		}
	}
}

$pagetitle = 'Add new user';

include 'view/user-view.php';
