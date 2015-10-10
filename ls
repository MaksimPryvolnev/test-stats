[1mdiff --git a/css/style.css b/css/style.css[m
[1mindex 7001136..842c870 100644[m
[1m--- a/css/style.css[m
[1m+++ b/css/style.css[m
[36m@@ -2,6 +2,19 @@[m [mbody {[m
 	width: 960px;[m
 	margin: auto;[m
 }[m
[32m+[m[32m.background {[m
[32m+[m[32m        background-color: rgb(231, 244, 255);[m
[32m+[m[32m        height: 900px;[m
[32m+[m[32m        padding-top: 1px;[m
[32m+[m[32m        width: 958px;[m
[32m+[m[32m        border-top: 6px groove rgba(228, 255, 7, 0.18);[m
[32m+[m[32m        outline: none;[m
[32m+[m[32m        border-color: #BCE2FF;[m
[32m+[m[32m        box-shadow: 0 0 33px #9ecaed;[m
[32m+[m[32m}[m
[32m+[m[32m.homepage {[m
[32m+[m[32m        margin: 10px 10px 5px 10px;[m
[32m+[m[32m}[m
 .menu a {[m
 	color: rgba(41, 41, 41, 0.48);[m
 	text-decoration: none; [m
[36m@@ -29,32 +42,48 @@[m [mbody {[m
 }[m
 .uploadFile {[m
 	width: 25%;[m
[32m+[m[32m        margin: 10px 0px 0px 10px;[m
 }[m
 .uploadFile a {[m
 	color: gray;[m
 	text-decoration: none;[m
 	position: relative;[m
 	left: 0%;[m
[32m+[m[32m        background: rgba(156, 200, 255, 0.28);[m
[32m+[m[32m        border-radius: 7px;[m
[32m+[m[32m        padding: 6px;[m
 }[m
 a:hover {[m
 	color: black;[m
[31m-	text-decoration: underline;[m
[32m+[m	[32mtext-decoration: none;[m
 }[m
 .uploadFile a:hover {[m
[31m-	padding: 3px;[m
[31m-	border: 1px solid black;[m
[32m+[m	[32mpadding: 1px;[m
[32m+[m	[32mborder: 0px solid black;[m
[32m+[m[32m        border-radius: 7px;[m
[32m+[m[32m        box-shadow: 0 0 10px #9ecaed;[m
[32m+[m[32m        padding: 6px;[m
 }[m
 .upload {[m
 	padding: 5% 0% 0% 35%;[m
 }[m
 .upload label {[m
[31m-	margin-right: 10px;[m
[32m+[m	[32mmargin-right: 18px;[m
 }[m
 .upload label:hover {[m
 	text-decoration: underline;[m
 }[m
 .login {[m
[31m-	padding: 5% 0% 0% 35%;[m
[32m+[m	[32mposition: absolute;[m
[32m+[m[32m        top: 125px;[m
[32m+[m[32m        left: 39.5%;[m
[32m+[m[32m}[m
[32m+[m[32m.loginPassError {[m
[32m+[m[32m        color: red;[m
[32m+[m[32m        margin: 7% 0px 0px 40%;[m
[32m+[m[32m}[m
[32m+[m[32m.login .field {[m
[32m+[m[32m        margin-top: 10px;[m
 }[m
 .login label {[m
 	margin-right: 10px;[m
[36m@@ -67,13 +96,14 @@[m [ma:hover {[m
 	text-decoration: none;[m
 	border: none;[m
 	position: absolute;[m
[31m-    top: 150px;[m
[31m-    left: 495px;[m
[31m-    width: 270px;[m
[32m+[m[32m        top: 68px;[m
[32m+[m[32m        width: 270px;[m
 	border-radius: 7px;[m
 }[m
 .login button:hover {[m
 	cursor: pointer;[m
[32m+[m[32m        background: rgba(156, 200, 255, 0.28);[m
[32m+[m[32m        box-shadow: 0 0 10px #9ecaed;[m
 }[m
 .login #password {[m
 	margin-left: 5px;[m
[36m@@ -81,6 +111,10 @@[m [ma:hover {[m
 .login label {[m
 	padding: 7px 0 17px 0;[m
 }[m
[32m+[m[32m.error {[m
[32m+[m[32m        color: #FF0000;[m
[32m+[m[32m        padding-left: 5px;[m
[32m+[m[32m}[m
 .registration {[m
 	padding: 5% 0% 0% 35%;[m
 }[m
[36m@@ -97,11 +131,12 @@[m [ma:hover {[m
 	border: none;[m
 	width: 233px;[m
 	border-radius: 7px;[m
[31m-	margin-top: 10px; [m
[32m+[m	[32mmargin-top: 10px;[m
 }[m
 .registration .submit:hover {[m
 	background: rgba(156, 200, 255, 0.4);[m
 	cursor: pointer;[m
[32m+[m[32m        box-shadow: 0 0 10px #9ecaed;[m
 }[m
 .registration #password {[m
 	margin-left: 8px;[m
[1mdiff --git a/inc/class-user-menager.php b/inc/class-user-menager.php[m
[1mindex 338e5ef..5d75417 100644[m
[1m--- a/inc/class-user-menager.php[m
[1m+++ b/inc/class-user-menager.php[m
[36m@@ -6,25 +6,35 @@[m [mclass TSUserManager {[m
 		$this->db = $db;[m
 	}[m
 [m
[32m+[m	[32mpublic function emailExist($email) {[m
[32m+[m		[32m$email = $this->db->real_escape_string($email);[m
[32m+[m		[32m$sql = $this->db->query("SELECT * FROM users WHERE email='$email'");[m
[32m+[m		[32mecho "SELECT * FROM users WHERE email='$email'";[m
[32m+[m		[32mvar_dump($sql);[m
[32m+[m		[32mecho $this->db->error;[m
[32m+[m		[32mif ($sql && $sql->num_rows > 0) {[m
[32m+[m			[32mreturn TRUE;[m
[32m+[m		[32m} else {[m
[32m+[m			[32mreturn FALSE;[m
[32m+[m		[32m}[m
[32m+[m	[32m}[m
 	public function login($login, $password) {[m
 		$login = $this->db->real_escape_string($login);[m
 		$password = $this->db->real_escape_string($password);[m
[31m-		$hash = password_hash($password, PASSWORD_DEFAULT);[m
[31m-		$verifyHash = password_verify($password, $hash);[m
[31m-		if ($verifyHash) {[m
[31m-			$result = $this->db->query("SELECT * from users WHERE login='$login'");[m
[32m+[m		[32mif ($login && $password) {[m
[32m+[m			[32m$result = $this->db->query("SELECT * from users WHERE login='$login' AND password='$password'");[m
 			if ($result && $result->num_rows == 1) {[m
 				$row = $result->fetch_assoc();[m
 				$_SESSION['user_logged_in'] = true;[m
 				$_SESSION['id'] = $row['id'];[m
[31m-				return true;[m
[32m+[m				[32mreturn TRUE;[m
 			}[m
 			else {[m
[31m-				return false;[m
[32m+[m				[32mreturn FALSE;[m
 			}[m
 		}[m
 		else {[m
[31m-			return false;[m
[32m+[m			[32mreturn FALSE;[m
 		}[m
 [m
 	}[m
[1mdiff --git a/inc/class-user.php b/inc/class-user.php[m
[1mindex f07504d..f8e2017 100644[m
[1m--- a/inc/class-user.php[m
[1m+++ b/inc/class-user.php[m
[36m@@ -18,7 +18,7 @@[m [mclass TSUser {[m
 		$userName = $this->db->real_escape_string($this->userName);[m
 		$password = $this->db->real_escape_string($this->password);[m
 		$hash = password_hash($password, PASSWORD_DEFAULT);[m
[31m-		$email = $this->db->real_escape_string($this->email);[m
[32m+[m[41m   [m		[32m$email = $this->db->real_escape_string($this->email);[m
 		$login = $this->db->real_escape_string($this->login);[m
 		$result = $this->db->query("INSERT into users (name, email, login, password) values('$userName', '$email', '$login', '$hash')");[m
 		[m
[1mdiff --git a/login.php b/login.php[m
[1mindex 3b89082..016bbdc 100644[m
[1m--- a/login.php[m
[1m+++ b/login.php[m
[36m@@ -38,6 +38,12 @@[m [mif(!empty($_POST)) {[m
 	}[m
 }[m
 [m
[32m+[m[32m$loginPassError = "";[m
[32m+[m[32m// Echo error massage if password or username is incorect[m
[32m+[m[32mif (isset($login) && $login == false) {[m
[32m+[m	[32m$loginPassError = "Wrong login or password";[m
[32m+[m[32m}[m
[32m+[m
 $pagetitle = 'Login';[m
 [m
 include 'view/login-view.php';[m
[1mdiff --git a/upload.php b/upload.php[m
[1mindex 329b438..82b1ea4 100644[m
[1m--- a/upload.php[m
[1m+++ b/upload.php[m
[36m@@ -13,15 +13,25 @@[m [mrequire_once 'inc/class-user-menager.php';[m
 $um = new TSUserManager($conn);[m
 $loggedIn = $um->isLoggedIn();[m
 [m
[31m-$pagetitle = 'home';[m
[32m+[m[32m$pagetitle = 'Upload';[m
[32m+[m[32m$error = array('name'=>'', 'file'=>'');[m
 [m
 if (!empty($_POST)) {[m
 	$name = $_POST['name'];[m
[31m-	[m
 	$test = new TSTest($conn);[m
 	$testId = $test->addTest($name, $_SESSION['id']);[m
[31m-[m
[31m-	if (!empty($_FILES['data']['tmp_name'])) {[m
[32m+[m	[32m$file = $_FILES['data']['tmp_name'];[m
[32m+[m	[32m$type = filetype($file);[m
[32m+[m	[32m$filename = $_FILES['data']['name'];[m
[32m+[m	[32m$allowed =  array('xls','xlsx');[m
[32m+[m	[32m$ext = pathinfo($filename, PATHINFO_EXTENSION);[m
[32m+[m	[32mif(!in_array($ext,$allowed) ) {[m
[32m+[m		[32m$error['file'] = 'Wrong file extension';[m
[32m+[m	[32m}[m
[32m+[m	[32mif ($type != 'file') {[m
[32m+[m		[32m$error['file'] = 'Wrong file type';[m
[32m+[m	[32m}[m
[32m+[m	[32mif (!empty($_FILES['data']['tmp_name']) && empty($error['file'])) {[m
 		require_once 'inc/PHPExcel.php';[m
 		$objPHPExcel = PHPExcel_IOFactory::load($_FILES['data']['tmp_name']);[m
 		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);[m
[1mdiff --git a/user.php b/user.php[m
[1mindex 130f263..9e7186a 100644[m
[1m--- a/user.php[m
[1m+++ b/user.php[m
[36m@@ -13,21 +13,65 @@[m [mrequire_once 'inc/class-user-menager.php';[m
 $um = new TSUserManager($conn);[m
 $loggedIn = $um->isLoggedIn();[m
 [m
[32m+[m[32m$errors = array('name'=>'', 'password'=>'', 'email'=>'', 'login'=>'');[m
[32m+[m
 if ($loggedIn == false && !empty($_POST)) {[m
 	$name = $_POST['name'];[m
 	$password = $_POST['password'];[m
 	$email = $_POST['email'];[m
 	$login = $_POST['userlogin'];[m
[31m-	$user = new TSUser($conn, $name, $password, $login, $email);[m
[31m-	$result = $user->addUser();[m
[31m-	if ($result == true) {[m
[31m-		// Redirect to home page.[m
[31m-		header('Location:' . $base_url . '/login.php');[m
[31m-		exit();[m
[32m+[m
[32m+[m	[32m$exist = $um->emailExist($email);[m
[32m+[m	[32mif($exist == TRUE && !empty($_POST['email'])) {[m
[32m+[m		[32m$errors['email'] = 'Email already exists';[m
[32m+[m		[32mprint_r($errors['email']);[m
[32m+[m	[32m}[m
[32m+[m
[32m+[m	[32mif (empty($name)) {[m
[32m+[m		[32m$errors['name'] = 'Enter your name';[m
[32m+[m	[32m}[m
[32m+[m
[32m+[m	[32mif (empty($password)) {[m
[32m+[m		[32m$errors['password'] = 'Enter your password';[m
[32m+[m	[32m}[m
[32m+[m
[32m+[m	[32mif (empty($email)) {[m
[32m+[m		[32m$errors['email'] = 'Enter your email';[m
[32m+[m	[32m}[m
[32m+[m
[32m+[m	[32mif (empty($login)) {[m
[32m+[m		[32m$errors['login'] = 'Enter your login';[m
[32m+[m	[32m}[m
[32m+[m[41m	[m
[32m+[m	[32mif (!preg_match("/^[a-zA-Z ]*$/",$name)) {[m
[32m+[m		[32m$errors['name'] = 'Only letters and white space allowed';[m
[32m+[m		[32mprint_r($errors['name']);[m
[32m+[m	[32m}[m
[32m+[m
[32m+[m	[32mif (strlen($password) < 6) {[m
[32m+[m		[32m$errors['password'] = 'Secure password must have minimum 6 characters';[m
[32m+[m	[32m}[m
[32m+[m
[32m+[m	[32mif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {[m
[32m+[m		[32m$errors['email'] = 'Invalid email format';[m
[32m+[m	[32m}[m
[32m+[m
[32m+[m	[32mif (!preg_match("/^[a-zA-Z ]*$/",$login)) {[m
[32m+[m		[32m$errors['login'] = 'Only letters and white space allowed';[m
 	}[m
[31m-}[m
 [m
[32m+[m	[32mif (empty($errors['name']) && empty($errors['login']) && empty($errors['email']) && empty($errors['password'])) {[m
[32m+[m		[32m$user = new TSUser($conn, $name, $password, $login, $email);[m
[32m+[m		[32m$result = $user->addUser();[m
[32m+[m		[32mif ($result == true) {[m
[32m+[m			[32m// Redirect to home page.[m
[32m+[m			[32mheader('Location:' . $base_url . 'login.php');[m
[32m+[m			[32mexit();[m
[32m+[m		[32m}[m
[32m+[m	[32m}[m
[32m+[m[32m}[m
 [m
 $pagetitle = 'Add new user';[m
 [m
 include 'view/user-view.php';[m
[41m+	[m
\ No newline at end of file[m
[1mdiff --git a/view/footer.php b/view/footer.php[m
[1mindex 3cd325e..73de27d 100644[m
[1m--- a/view/footer.php[m
[1m+++ b/view/footer.php[m
[36m@@ -1,3 +1,4 @@[m
[32m+[m[32m</div>[m
 <script src="<?php echo $base_url; ?>js/main.js"></script>[m
 </body>[m
 </html>[m
[1mdiff --git a/view/header.php b/view/header.php[m
[1mindex 7cd858e..54316bc 100644[m
[1m--- a/view/header.php[m
[1m+++ b/view/header.php[m
[36m@@ -17,4 +17,5 @@[m
 			<a href="<?php echo $base_url . 'login.php'; ?>">Log In</a>[m
 			<a href="<?php echo $base_url . 'user.php'; ?>">Sign Up</a>[m
 		<?php endif; ?>[m
[31m-	</div>[m
\ No newline at end of file[m
[32m+[m	[32m</div>[m
[32m+[m[32m        <div class="background">[m
[1mdiff --git a/view/index-view.php b/view/index-view.php[m
[1mindex 0871e30..6d7d692 100644[m
[1m--- a/view/index-view.php[m
[1m+++ b/view/index-view.php[m
[36m@@ -2,11 +2,11 @@[m
 include 'header.php';[m
 ?>[m
 <div>[m
[31m-	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>[m
[32m+[m	[32m<p class="homepage">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>[m
 </div>[m
 <div class="uploadFile">[m
 	<?php if ($loggedIn) : ?><a href="<?php echo $base_url; ?>upload.php">Upload new data</a>[m
[31m-	<?php else : ?><a href="<?php echo $base_url . '/login.php'; ?>">You have to Log In to upload the data</a>[m
[32m+[m	[32m<?php else : ?><a href="<?php echo $base_url . 'login.php'; ?>">You have to <i>log in</i> to upload the data</a>[m
 	<?php endif; ?>[m
 </div>[m
 <?php [m
[1mdiff --git a/view/login-view.php b/view/login-view.php[m
[1mindex 68b56cb..1f14ca0 100644[m
[1m--- a/view/login-view.php[m
[1m+++ b/view/login-view.php[m
[36m@@ -1,15 +1,11 @@[m
 <?php[m
 include'header.php';[m
[31m-[m
[31m-if (isset($login) && $login == false) {[m
[31m-	echo 'error';[m
[31m-}[m
 ?>[m
[31m-[m
[32m+[m[32m<p class="loginPassError"><?php echo $loginPassError; ?></p>[m
 <form class="login" action="login.php" method="post">[m
[31m-	<label for="name">Enter login name:</label><input name="login" id="name" type="text"><p></p>[m
[31m-	<label for="password">Enter password:</label><input name="password" id="password" type="password">[m
[31m-	<button type="submit">Submit</button>[m
[32m+[m	[32m<div><label for="name">Enter login name:</label><input name="login" id="name" type="text"></div>[m
[32m+[m[32m        <div class="field"><label for="password">Enter password:</label><input name="password" id="password" type="password"></div>[m
[32m+[m[32m        <button type="submit">Submit</button>[m
 </form>[m
 [m
 <?php[m
[1mdiff --git a/view/upload-view.php b/view/upload-view.php[m
[1mindex 9aa6df1..597649f 100644[m
[1m--- a/view/upload-view.php[m
[1m+++ b/view/upload-view.php[m
[36m@@ -5,12 +5,18 @@[m [mif (isset($login) && $login == false) {[m
 	echo 'error';[m
 }[m
 ?>[m
[31m-<form class="upload" action="upload.php" method="post" enctype="multipart/form-data">[m
[31m-	<input type="file" name="data"><br>[m
[31m-	<label for="name">Enter test name</label><input name="name" id="name" type="text">[m
[31m-	<button type="submit">Add</button>[m
[31m-</form>[m
[31m-[m
[32m+[m[32m<?php if ($loggedIn == true) : ?>[m
[32m+[m	[32m<form class="upload" action="upload.php" method="post" enctype="multipart/form-data">[m
[32m+[m		[32m<input type="file" name="data"><span class="error"><?php echo $error['file']; ?></span><br>[m
[32m+[m		[32m<label for="name">Enter test name</label><input name="name" id="name" type="text">[m
[32m+[m		[32m<button type="submit">Add</button>[m
[32m+[m	[32m</form>[m
[32m+[m[32m<?php else : ?>[m
[32m+[m	[32m<?php[m
[32m+[m		[32mheader('Location:' . $base_url . 'login.php');[m
[32m+[m		[32mexit();[m
[32m+[m	[32m?>[m
[32m+[m[32m<?php endif; ?>[m
 <?php[m
 include'footer.php'[m
 ?>[m
[1mdiff --git a/view/user-view.php b/view/user-view.php[m
[1mindex e10b619..ff714b2 100644[m
[1m--- a/view/user-view.php[m
[1m+++ b/view/user-view.php[m
[36m@@ -3,10 +3,10 @@[m [minclude'header.php'[m
 ?>[m
 <?php if ($loggedIn == false) : ?>[m
 	<form class="registration" autocomplete="off" class="registration" action="user.php" method="post">[m
[31m-		<div class="namecont"><label for="name">Enter name</label><input autocomplete="off" value="" type="text" id="name" name="name"></div>[m
[31m-		<div class="passcont"><label for="password">Password</label><input type="password" id="password" name="password"></div>[m
[31m-		<div class="emailcont"><label for="email">email</label><input type="text" id="email" name="email"><br></div>[m
[31m-		<div class="logincont"><label for="userlogin">login</label><input type="text" id="userlogin" name="userlogin"><br></div>[m
[32m+[m		[32m<div class="namecont"><label for="name">Enter name</label><input placeholder="Name" autocomplete="off" type="text" id="name" name="name"><span class="error"><?php errorRegistration('name');?></span></div>[m
[32m+[m		[32m<div class="passcont"><label for="password">Password</label><input placeholder="Password" type="password" id="password" name="password"><span class="error"><?php errorRegistration('password');?></span></div>[m
[32m+[m		[32m<div class="emailcont"><label for="email">email</label><input placeholder="email" type="text" id="email" name="email"><span class="error"><?php errorRegistration('email');?></span><br></div>[m
[32m+[m		[32m<div class="logincont"><label for="userlogin">login</label><input placeholder="login" type="text" id="userlogin" name="userlogin"><span class="error"><?php errorRegistration('login');?></span><br></div>[m
 		<input class="submit" type="submit" if="send" name="send" value="Send form">[m
 	</form>[m
 <?php else : ?>[m
