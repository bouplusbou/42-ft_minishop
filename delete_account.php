<?php
include 'inc/functions_user.php';

session_start();

$file = 'database/passwd';
$db = unserialize_data($file);

if (isset($_SESSION['username'])) {
	foreach ($db as $key => $user) {
		if ($user['user'] == $_SESSION['username']) {
			unset($db[$key]);
			unset($_SESSION['username']);
			break ;
		}
	}

	$db = array_values($db);
	serialize_data($db, $file);
}
header('Location: index.php')
?>
