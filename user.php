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

if ($loggedIn == false && !empty($_POST)) {
	$name = $_POST['name'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$login = $_POST['userlogin'];
	$user = new TSUser($conn, $name, $password, $login, $email);
	$result = $user->addUser();
	if ($result == true) {
		// Redirect to home page.
		header('Location:' . $base_url . '/login.php');
		exit();
	}
}


$pagetitle = 'Add new user';

include 'view/user-view.php';
