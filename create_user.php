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
	<div class="login-page">
		<div class="form">
			<form class="login-form" name="index.php" action="login.php" method="post">
				<input placeholder="email address" type="text" value="" name="email" />
				<input placeholder="password" type="password" value="" name="passwd" />
				<input type="submit" value="Sign Up" name="submit" />
			</form>
			<?php if ($errmsg !== ''):
				echo $errmsg;
				endif; ?>
			<a href="login.php">Sign In</a>
		</div>
	</div>

<?php include 'inc/footer.php'; ?>
