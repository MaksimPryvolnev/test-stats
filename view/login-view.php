<?php
include'header.php';
?>
<p class="loginPassError"><?php echo $loginPassError; ?></p>
<form class="login" action="login.php" method="post">
		<div><label for="name">Enter name:</label><input name="name" id="name" type="text"></div>
        <div class="field"><label for="password">Enter password:</label><input name="password" id="password" type="password"></div>
        <button type="submit">Submit</button>
</form>

<?php
include'footer.php'
?>
