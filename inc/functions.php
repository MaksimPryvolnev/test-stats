<?php 
function getLogoutUrl($base_url) {
	return $base_url . 'login.php?logout=yes';
}

function isUserLoggedIn() {
	$um = new TSUserManager($conn);
	$loggedIn = $um->isLoggedIn();
	return $loggedIn;
}
?>