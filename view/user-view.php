<?php
include'header.php'
?>
<?php if ($loggedIn == false) : ?>
	<form class="registration" autocomplete="off" class="registration" action="user.php" method="post">
		<div class="namecont"><label for="name">Enter name</label><input placeholder="Name" autocomplete="off" type="text" id="name" name="name"><span class="error"><?php echo $errors['name'];?></span></div>
		<div class="passcont"><label for="password">Password</label><input placeholder="Password" type="password" id="password" name="password"><span class="error"><?php echo $errors['password'];?></span></div>
		<div class="emailcont"><label for="email">email</label><input placeholder="email" autocomplete="on" type="text" id="email" name="email"><span class="error"><?php echo $errors['email'];?></span><br></div>
		<div class="logincont"><label for="userlogin">login</label><input placeholder="login" type="text" id="userlogin" name="userlogin"><span class="error"><?php echo $errors['login'];?></span><br></div>
		<input class="submit" type="submit" if="send" name="send" value="Send form">
	</form>
<?php else : ?>
	<p>You are logged in</p>
<?php endif; ?>
<?php
include'footer.php'
?>