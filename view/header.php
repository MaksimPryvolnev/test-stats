<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?php echo $base_url; ?>css/style.css">
	<title><?php echo $pagetitle; ?></title>		
</head>
<body>
	<div class="menu">
		<a href="<?php echo $base_url; ?>">Home</a>
		<a href="#">About</a>
		<a href="#">Instructions</a>
		<?php if ($loggedIn) : ?>
			<a href="<?php echo $base_url . 'output.php'; ?>">View test statistics</a>
			<a href="<?php echo getLogoutUrl($base_url); ?>">Log Out</a>
		<?php else : ?>
			<a href="<?php echo $base_url . 'login.php'; ?>" id="log-in">Log In</a>
			<a href="<?php echo $base_url . 'user.php'; ?>">Sign Up</a>
		<?php endif; ?>
	</div>
        <div class="background">
