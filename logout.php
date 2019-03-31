<?php

include 'inc/db_user_functions.php';
include 'inc/functions_user.php';

session_start();

if (isset($_SESSION['username'])) {
    if (isset($_COOKIE['cart']) && empty($_COOKIE['cart']) !== true) {
    	db_set_cart('database/users', $_SESSION['username'], unserialize($_COOKIE['cart']));
    	setcookie("cart", null, -1);
	}
	unset($_SESSION['username']);
	header('Location: index.php');

}

?>
