<?php
session_start();

//configuration file.
require_once 'inc/config.php';
//necessary functions.
require_once 'inc/functions.php';
//mysqli connection to the database.
require_once 'inc/connect-db.php';
//class responds for user to stay login.
require_once 'inc/class-user-menager.php';

$um = new TSUserManager($conn);
$loggedIn = $um->isLoggedIn();

if(!empty($_GET['verifyUser'])) {   
	// check if $_SESSION['hash'] has the same hash verification as GET parameter and change active to 1
	$update = $um->sqlActivate(1, $_GET['verifyUser']);
}
if(!empty($_GET['logout']) && $_GET['logout'] == 'yes') {
	if(array_key_exists('user_logged_in', $_SESSION)) {
		unset($_SESSION['user_logged_in']);
		unset($_SESSION['id']);
		session_regenerate_id();
		header('Location:' . $base_url . 'login.php');
		exit();
	}
}

// If form was sent.
if(!empty($_POST)) {
	// Get user input.
	$name = $_POST['name'];
	$password = $_POST['password'];
	
	// Log the user in.
	$login = $um->login($name, $password);

	if ($login == true) {
		// Redirect to home page.
		header('Location:' . $base_url);
		exit();
	}
}

$loginPassError = "";
// Echo error massage if password or username is incorect
if (isset($login) && $login == false) {
	$loginPassError = "Wrong login or password";
}

$pagetitle = 'Login';

include 'view/login-view.php';
