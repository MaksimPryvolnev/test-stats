<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();

require_once 'inc/config.php';
require_once 'inc/functions.php';
include 'inc/class-test.php';
require_once 'inc/connect-db.php';
require_once 'inc/class-user-menager.php';

$um = new TSUserManager($conn);
$loggedIn = $um->isLoggedIn();

$pagetitle = 'home';

if (!empty($_POST)) {
	$name = $_POST['name'];
	
	$test = new TSTest($conn);
	$testId = $test->addTest($name, $_SESSION['id']);

	if (!empty($_FILES['data']['tmp_name'])) {
		require_once 'inc/PHPExcel.php';
		$objPHPExcel = PHPExcel_IOFactory::load($_FILES['data']['tmp_name']);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$test->saveTestResults($sheetData, $testId);
	}
}

include 'view/upload-view.php';
