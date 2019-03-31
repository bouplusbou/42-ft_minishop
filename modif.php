<?php
include 'inc/functions_user.php';

session_start();

$file = 'database/passwd';
$errors = array();
$db = unserialize_data($file);
$errmsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['submit'] !== "Change") {
        $errors[] = 'Invalid submit value';
    }

    if (strlen($_POST['oldpw']) === 0) {
        $errors[] = 'Please enter your current password.';
    }

    if (strlen($_POST['newpw']) === 0) {
        $errors[] = 'Please enter the new password.';
    }

    if (check_user_existance($db, $_SESSION['username'], $_POST['oldpw']) == false) {
        $errors[] = 'Incorrect current password';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0) {
    foreach ($db as $key => $user) {
        if ($user['user'] == $_SESSION['username']) {
            $db[$key]['passwd'] = password_hash($_POST['newpw'], PASSWORD_BCRYPT);
        }
    }

    serialize_data($db, $file);
    header('Location: account.php');
} else {
    $errmsg = create_error_html($errors);
}

$title = "My account";
$css = "css/login.css";
include 'inc/header.php';
?>
<div class="login-page">
    <div class="form">
        <form name="index.php" action="modif.php" method="post">
            <input placeholder="Previous password" type="password" value="" name="oldpw" />
            <input placeholder="New password" type="password" value="" name="newpw" />
            <input type="submit" value="Change" name="submit" />
        </form>
        <?php if ($errmsg !== ''):
            echo $errmsg;
        endif; ?>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
