<?php

include 'inc/functions_user.php';
include 'inc/db_user_functions.php';

$file = 'database/passwd';
$errors = array();
$passwd_db = unserialize_data($file);
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

    if (check_user_existance($passwd_db, $_POST['email']) == true) {
        $errors[] = 'There is already a user registered with that email.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0) {
    $passwd_db[] = create_user($_POST['email'], $_POST['passwd']);
    db_add_user('database/users', $_POST['email']);
    serialize_data($passwd_db, $file);
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
        <form class="login-form" name="index.php" action="create_user.php" method="post">
            <input placeholder="email address" type="text" value="" name="email" />
            <input placeholder="password" type="password" value="" name="passwd" />
            <input type="submit" value="Create" name="submit" />
        </form>
        <?php if ($errmsg !== ''):
            echo $errmsg;
        endif; ?>
        <a href="login.php">Sign In</a>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
