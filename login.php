<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();

require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/class-user-menager.php';
require_once 'inc/connect-db.php';

$um = new TSUserManager($conn);
$loggedIn = $um->isLoggedIn();

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
	$name = $_POST['login'];
	$password = $_POST['password'];
	
	// Log the user in.
	$login = $um->login($name, $password);

	if ($login == true) {
		// Redirect to home page.
		header('Location:' . $base_url);
		exit();
	}
}

$pagetitle = 'Login';

include 'view/login-view.php';
