<?php
include 'inc/functions_user.php';

session_start();

$file = 'database/passwd';

if (isset($_SESSION['username'])) {
	delete_user($file, $_SESSION['username']);
	unset($_SESSION['username']);
}
header('Location: index.php')
?>
