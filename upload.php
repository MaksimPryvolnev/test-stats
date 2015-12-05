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

//check if user is logged in.
$um = new TSUserManager($conn);
$loggedIn = $um->isLoggedIn();

//specify error array for printing down file and name errors.
$error = array('name'=>'', 'file'=>'');

if (!empty($_POST)) {

	$name = $_POST['name'];

	//check file type and extension.
	$file = $_FILES['data']['tmp_name'];
	$type = filetype($file);
	$filename = $_FILES['data']['name'];
	$allowed =  array('xls','xlsx');
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	
	//print error if file format wrong or test name is empty.
	if(empty($name) ) {
		$error['name'] = 'Enter test name';
	}
	if(!in_array($ext,$allowed) ) {
		$error['file'] = 'Wrong file extension';
	}
	if ($type != 'file') {
		$error['file'] = 'Wrong file type';
	}
	if (empty($_FILES)) {
		$error['file'] = 'Choose file';
	}
	//add test to the tests table.
	$test = new TSTest($conn);
	$testId = $test->addTest($name, $_SESSION['id']);

	if (!empty($_FILES['data']['tmp_name']) && empty($error['file']) && empty($error['name'])) {
		

		
		//add results to the test_results table.
		require_once 'inc/PHPExcel.php';
		$objPHPExcel = PHPExcel_IOFactory::load($_FILES['data']['tmp_name']);
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$test->saveTestResults($sheetData, $testId);
	}
}

$pagetitle = 'Upload';

include 'view/upload-view.php';
