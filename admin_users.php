<?php
session_start();

include 'inc/functions_user.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
	if ($_POST['type'] === "delete") {
		delete_user("./database/users", $_POST['username']);
		delete_user("./database/passwd", $_POST['username']);
    }
    header('Location: admin_users.php');
}

$title = "Users Admin Panel";
$css = "./css/admin_users.css";
include 'inc/header.php';
?>
	<h1>- Users Admin Panel -</h1>
	<div class="delete_user_wrapper">
		<h2>DELETE A USER</h2>
		<?php $users = get_users();
		foreach ($users as $user_id => $user) {
			if (!is_admin_user($user['user'])) {?>
		<div class="separator"></div>
		<div class="users_container">
			<p>- <?=$user['user']?></p>
			<form action="admin_users.php" method="POST">
				<input name="type" type="hidden" value="delete">
				<input name="username" type="hidden" value="<?=$user['user']?>"> 
				<input type="submit" value="DELETE" name="submit">
			</form>
			</div>
		</div>
		<?php } 
		}?>

	</div>
</body>
</html>
