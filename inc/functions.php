<?php 
function getLogoutUrl($base_url) {
	return $base_url . 'login.php?logout=yes';
}

function getTestUrl($base_url, $testName) {
	return $base_url . 'output.php?test=' . $testName;
}

function isUserLoggedIn() {
	$um = new TSUserManager($conn);
	$loggedIn = $um->isLoggedIn();
	return $loggedIn;
}
?>