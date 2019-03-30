<?php

include 'inc/functions_user.php';

$file = 'database/passwd';
$errors = array();
$db = unserialize_data($file);
$errmsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if ($_POST['submit'] !== "Sign In") {
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

	if (check_user_existance($db, $_POST['email'], $_POST['passwd']) === false) {
		$errors[] = 'Incorrect email or password.';
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0) {
	$_SESSION['username'] = $_POST['email'];
	header("Location: " . "index.php");
} else {
	$errmsg = create_error_html($errors);
}

$css = "css/login.css";
$title = "Login";
include 'inc/header.php';
?>
	<div class="login-page">
		<div class="form">
			<form class="login-form" name="index.php" action="login.php" method="post">
				<input placeholder="email address" type="text" value="" name="email" />
				<input placeholder="password" type="password" value="" name="passwd" />
				<input type="submit" value="Sign In" name="submit" />
			</form>
			<?php if ($errmsg !== ''):
				echo $errmsg;
				endif; ?>
			<a href="create_user.php">Sign Up</a>
		</div>
	</div>

<?php include 'inc/footer.php'; ?>

