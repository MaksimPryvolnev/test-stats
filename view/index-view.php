<?php
include 'header.php';
?>
<div>
	<p class="homepage">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>
<div class="uploadFile">
	<?php if ($loggedIn) : ?><a href="<?php echo $base_url; ?>upload.php">Upload new data</a>
	<?php else : ?><a href="<?php echo $base_url . 'login.php'; ?>">You have to <i>log in</i> to upload the data</a>
	<?php endif; ?>
</div>
<?php 
include 'footer.php';
?>
