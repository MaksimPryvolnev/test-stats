<?php
include'header.php';

if (isset($login) && $login == false) {
	echo 'You have to login to see your data.';
}
?>
<?php if ($loggedIn == true) : ?>
	<div>
		<table class="output">
			<?php
				if (!isset($_GET['test'])) {
					for ($i=0; $i < $tests; $i++) {
						$href = getTestUrl($base_url, $testName[$i]['id']);
						echo '<tr><td><a href="' . htmlspecialchars($href) . '">' . htmlspecialchars($testName[$i]['test_name']) . '</a></td></tr>';
					}
				} else {
					echo '<tr>';
					echo '<td></td>';

					$exercises = array();
					$results = array();

					foreach ($outputTest as $key => $columns) {
						$exercise = $columns['exercise'];

						if ($columns['student'] == 1) {							
							echo '<td>' . htmlspecialchars($exercise) . '</td>';
						}

						$studentNumber = $columns['student'];

						$exercises[] = $exercise;							

						if (!isset($results[$studentNumber])) {
							$results[$studentNumber] =	array();
						}
						
						$results[$studentNumber][$exercise] = $columns['result'];
					}
					echo '</tr>';

					foreach ($results as $studentNumber => $exValues) {
						echo '<tr>';
						echo '<td>' . intval($studentNumber) . '</td>';

						foreach ($exValues as $ex => $exValue) {
							echo '<td>' . intval($exValue) . '</td>';
						}

						echo '</tr>';
					}
				}
			?>

		</table>
	</div>
<?php else : ?>
	<?php
		header('Location:' . $base_url . 'login.php');
		exit();
	?>
<?php endif; ?>
<?php
include'footer.php'
?>
