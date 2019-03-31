<?php

include 'inc/functions_user.php';

session_start();

if ($_SESSION['admin'] == false) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = unserialize_data('database/admins');

    if ($_POST["submit"] === "Add") {
        if (is_valid_email($_POST['newadmin'])) {
            $db[] = $_POST['newadmin'];
        }
    }

    $db = serialize_data($db, 'database/admins');
}

$title = "Add new admin";
$css = "css/login.css";
include 'inc/header.php';
?>

<div class="login-page">
    <div class="form">
        <form name="add_admin" action="admin_add_admin.php" method="post">
            <input placeholder="Email of the new admin" type="text" value="" name="newadmin" />
            <input type="submit" value="Add" name="submit" />
        </form>
        <?php if ($errmsg !== ''):
            echo $errmsg;
        endif; ?>
    </div>
</div>

<?php include 'inc/footer.php' ?>


