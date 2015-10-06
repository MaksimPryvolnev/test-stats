<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();

require_once 'inc/config.php';
require_once 'inc/functions.php';
require_once 'inc/connect-db.php';
require_once 'inc/class-user-menager.php';

$um = new TSUserManager($conn);
$loggedIn = $um->isLoggedIn();

$pagetitle = 'home';

include 'view/index-view.php';
