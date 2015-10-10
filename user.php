<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();

require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/class-user.php';
require_once 'inc/connect-db.php';
require_once 'inc/class-user-menager.php';

$um = new TSUserManager($conn);
$loggedIn = $um->isLoggedIn();

$errors = array('name'=>'', 'password'=>'', 'email'=>'', 'login'=>'');

if ($loggedIn == false && !empty($_POST)) {
	$name = $_POST['name'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$login = $_POST['userlogin'];

	$exist = $um->emailExist($email);
	if($exist == TRUE && !empty($_POST['email'])) {
		$errors['email'] = 'Email already exists';
		print_r($errors['email']);
	}

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
		print_r($errors['name']);
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

	if (empty($errors['name']) && empty($errors['login']) && empty($errors['email']) && empty($errors['password'])) {
		$user = new TSUser($conn, $name, $password, $login, $email);
		$result = $user->addUser();
		if ($result == true) {
			// Redirect to home page.
			header('Location:' . $base_url . 'login.php');
			exit();
		}
	}
}

$pagetitle = 'Add new user';

include 'view/user-view.php';
