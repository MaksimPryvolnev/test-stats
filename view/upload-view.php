<?php
include'header.php';

if (isset($login) && $login == false) {
	echo 'error';
}
?>
<form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
	<input type="file" name="data"><br>
	<label for="name">Enter test name</label><input name="name" id="name" type="text">
	<button type="submit">Add</button>
</form>

<?php
include'footer.php'
?>
