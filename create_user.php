<?php

include 'inc/functions_user.php';

$file = 'database/passwd';
$errors = array();
$db = unserialize_data($file);
$errmsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['submit'] !== "Create") {
		$errors[] = 'Invalid submit value';
	}

	if (strlen($_POST['email']) === 0) {
		$errors[] = 'Please enter your email.';
	} else if (is_valid_email($_POST['email']) == false) {
		$errors[] = 'Invalid email adress format.';
	}

	if (strlen($_POST['passwd']) === 0) {
		$errors[] = 'Please enter a password.';
	}

	if (check_user_existance($db, $_POST['email']) == true) {
		$errors[] = 'There is already a user registered with that email.';
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0) {
	$db[] = create_user($_POST['email'], $_POST['passwd']);
	serialize_data($db, $file);
	header('Location: login.php');
} else {
	$errmsg = create_error_html($errors);
}

$css = "css/login.css";
$title = "Create account";
include 'inc/header.php';
?>

	<div class="flex-container">
		<form name="index.php" action="create_user.php" method="post">
		<label for="email">Email: </label><input class="" type="text" value="" name="email" />
			<label for="passwd">Pasword: </label><input class="" type="password" value="" name="passwd" />
			<input type="submit" value="Create" name="submit" />
		</form>
		<?php if ($errmsg !== ''):
			echo $errmsg;
			endif; ?>
		<p>Already a client?</p>
		<a href="login.php">Sign in</a>
	</div>

<?php include 'inc/footer.php'; ?>
