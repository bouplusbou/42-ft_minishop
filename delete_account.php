<?php
include 'inc/functions_user.php';

session_start();

if (isset($_SESSION['username'])) {
	delete_user('database/passwd', $_SESSION['username']);
	delete_user('database/users', $_SESSION['username']);
	unset($_SESSION['username']);
}
header('Location: index.php');
