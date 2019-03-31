<?php

include 'inc/db_user_functions.php';
include 'inc/functions_user.php';

session_start();

if (isset($_SESSION['username'])) {
	db_set_cart('database/users', $_SESSION['username'], unserialize($_COOKIE['cart']));
	setcookie("cart", null, -1);
	unset($_SESSION['username']);
	unset($_SESSION['admin']);
	header('Location: index.php');

}

?>
