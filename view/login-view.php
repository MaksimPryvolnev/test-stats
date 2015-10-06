<?php
include'header.php';

if (isset($login) && $login == false) {
	echo 'error';
}
?>

<form class="login" action="login.php" method="post">
	<label for="name">Enter login name:</label><input name="login" id="name" type="text"><p></p>
	<label for="password">Enter password:</label><input name="password" id="password" type="password">
	<button type="submit">Submit</button>
</form>

<?php
include'footer.php'
?>
