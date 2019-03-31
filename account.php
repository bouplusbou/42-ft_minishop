<?php

session_start();

$css = "css/account.css";
$title = "My account";
include 'inc/header.php';
?>
<h1>Your Account</h1>
<div class="account_container">
	<?php if ($_SESSION['admin'] === true) {?>
        <a class="manage_products" href="admin_products.php">Manage products</a>
		<a class="manage_users" href="admin_users.php">Manage users</a>
		<a class="manage_users" href="admin_orders.php">Manage all orders</a>
	<?php } ?>
	<a class="change_password" href="user_orders.php">My orders</a>
	<a class="change_password" href="modif.php">Change my password</a>
	<a class="delete_account" href="delete_account.php">Delete my account</a>
</div>

<?php include 'inc/footer.php'; ?>