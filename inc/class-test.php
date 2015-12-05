<?php
class TSTest {
	public $db;
	public function __construct($db) {
		$this->db = $db;
	}
	public function saveTestResults($sheetData, $testId) {
		if (!empty($sheetData[1])) {
			$exerciseNames = $sheetData[1];
		}
		foreach ($sheetData as $rownum => $row) {
			if ($rownum > 1) {
				foreach ($row as $colletter => $colvalue) {
					if ($colletter == 'A') {
						$studentName = $this->db->real_escape_string($colvalue);
					} elseif (!empty($studentName)) {
						$rawScore = $this->db->real_escape_string($colvalue);
						$exerciseName = $this->db->real_escape_string($exerciseNames[$colletter]);
						$testId = intval($testId);
						$result = $this->db->query("INSERT into test_results (student, exercise, result, test_id) values('$studentName', '$exerciseName', '$rawScore', $testId)");
					}
				}
			}
		}
	}
	public function showTests($userId) {
		$userId = $this->db->real_escape_string($userId);
		$result = $this->db->query("SELECT test_name, id FROM tests WHERE user_id = $userId");
		$test = array();
		while ($row = mysqli_fetch_array($result)) {
			$test[] = $row;
		}
		return $test;
	}
	public function showTestResults($testId) {
		$testId = intval($testId);
		$result = $this->db->query("SELECT * FROM test_results WHERE test_id = $testId");
		$testResults = array();
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$testResults[] = $row;
		}
		return $testResults;
	}
	public function addTest($testName, $userId) {
		$testName = $this->db->real_escape_string($testName);
		$userId = intval($userId);
		$result = $this->db->query("INSERT into tests (test_name, user_id) values('$testName', $userId)");
		if ($result == TRUE) {
			return $this->db->insert_id;
		}
		else {
			return FALSE;
		}
	}
}
