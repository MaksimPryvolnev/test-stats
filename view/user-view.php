<?php
include'header.php'
?>
<?php if ($loggedIn == false) : ?>
	<form class="registration" autocomplete="off" class="registration" action="user.php" method="post">
		<div class="namecont"><label for="name">Enter name</label><input autocomplete="off" value="" type="text" id="name" name="name"></div>
		<div class="passcont"><label for="password">Password</label><input type="password" id="password" name="password"></div>
		<div class="emailcont"><label for="email">email</label><input type="text" id="email" name="email"><br></div>
		<div class="logincont"><label for="userlogin">login</label><input type="text" id="userlogin" name="userlogin"><br></div>
		<input class="submit" type="submit" if="send" name="send" value="Send form">
	</form>
<?php else : ?>
	<p>You are logged in</p>
<?php endif; ?>
<?php
include'footer.php'
?>