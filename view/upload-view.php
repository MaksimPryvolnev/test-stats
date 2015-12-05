<?php
include'header.php';

if (isset($login) && $login == false) {
	echo 'error';
}
?>
<?php if ($loggedIn == true) : ?>
	<form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
		<input type="file" name="data"><span class="error"><?php echo $error['file']; ?></span><br>
		<label for="name">Enter test name</label><input name="name" id="name" type="text"><span class="error"><?php echo $error['name']; ?></span><br>
		<button type="submit">Add</button>
	</form>
<?php else : ?>
	<?php
		header('Location:' . $base_url . 'login.php');
		exit();
	?>
<?php endif; ?>
<?php
include'footer.php'
?>
