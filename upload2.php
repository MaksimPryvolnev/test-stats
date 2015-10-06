<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

$pagetitle = 'home';

if (!empty($_POST)) {
	$name = $_POST['name'];
	$target_dir ='uploads/';
	$target_file = $target_dir . basename($_FILES["data"]["name"]);
	//print_r($_FILES['data']);
	require_once 'inc/PHPExcel.php';
	$objPHPExcel = PHPExcel_IOFactory::load($_FILES['data']['tmp_name']);
	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	//var_dump($sheetData);
	echo '<table>';
	$i = 1;
	$excol = array();
	$exsum = array();
	foreach ($sheetData as $rownum => $row) {
		foreach ($row as $colletter => $colvalue) {
			if ($colletter != 'A') {
				if (!isset($exsum[$colletter])) {
					$exsum[$colletter] = 0;
				}
				$exsum[$colletter] += $colvalue;
			}
		}
		# code...
	}
	print_r($exsum);
	exit();
	foreach ($sheetData as $rownum => $row) {
		echo '<tr>';
		echo '<td>';
		echo '</td>';
		if ($i == 1) {
			foreach ($row as $colnum => $colvalue) {
				//print_r($colvalue);
				if(!empty($colvalue)) {
					$excol[$colnum] = $colvalue;
					echo '<td>';
					echo $colvalue;
					echo '</td>';
				}
			}
			echo '<td>';
			echo 'sum';
			echo '</td>';
			echo '</tr>';
			//print_r($excol);
		} else {
			$studentname = $row['A'];
			if (empty($studentname)) {
				continue;
			}
			$sum = 0;
			foreach ($excol as $excolnum => $excolvalue) {
				$result = intval($row[$excolnum]);
				$sum += $result;
			}
			print_r($row);
			echo '<tr>';
			foreach ($row as $colnum => $colvalue) {
				echo '<td>';
				echo $colvalue;
				echo '</td>';
			}
			echo '<td>';
			echo $sum;
			echo '</td>';
			echo '</tr>';
		}
		//foreach ($row as $colnum => $colvalue) {
		//	$
		//	echo '<td>';
		//	echo htmlspecialchars($colvalue);
		//	echo '</td>';
		//}
		//echo '</tr>';
		$i++;
	}
	echo '</table>';
}

include 'view/upload-view.php';
