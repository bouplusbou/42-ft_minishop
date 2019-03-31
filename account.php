<?php

session_start();

$css = "css/account.css";
$title = "My account";
include 'inc/header.php';
?>

<div class="account-container">
    <?php if ($_SESSION['admin'] === true) {?>
        <a href="admin_products.php">Manage products</a>
        <a href="admin_users.php">Manage users</a>
        <a href="admin_orders.php">Manage all orders</a>
    <?php } ?>
    <a href="user_orders.php">My orders</a>
	<a href="modif.php">Change my password</a>
	<a href="delete_account.php">Delete my account</a>
</div>

<?php include 'inc/footer.php'; ?>