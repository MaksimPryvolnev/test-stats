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

//require_once('../php-webdriver-community/php-webdriver-community/vendor/autoload.php');

$um = new TSUserManager($conn);
$loggedIn = $um->isLoggedIn();

$pagetitle = 'Home';

include 'view/index-view.php';
