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
//Excel library.
require_once 'inc/PHPExcel.php';

//check if user is logged in.
$um = new TSUserManager($conn);
$loggedIn = $um->isLoggedIn();

$test = new TSTest($conn);

//call the showTest function to return array with names of tests
$testName = $test->showTests($_SESSION['id']);
//count the number of tests in array
$tests = count($testName);

if(!empty($_GET['test'])) {   
	// 
	$outputTest = $test->showTestResults($_GET['test']);
	$data = count($outputTest);
}
$pagetitle = 'Output';

include 'view/output-view.php';
