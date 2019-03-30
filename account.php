<?php

session_start();

$css = "css/index.css";
$title = "My account";
include 'inc/header.php';
?>

<div class="flex-container">
	<a href="modif.php">Change my password</a>
	<a href="delete_account.php">Delete my account</a>
</div>

<?php include 'inc/footer.php'; ?>
