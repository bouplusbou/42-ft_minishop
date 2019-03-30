<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Account</title>
</head>
<p>Modifier mon mot de passe</p>
<body>
	<form name="index.php" action="modif.php" method="post">
		<label for="email">Email: </label><input type="text" value="" name="email" />
		<label for="passwd">Ancien mot de passe: </label><input type="password" value="" name="oldpw" />
		<label for="passwd">Nouveau mot de passe: </label><input type="password" value="" name="newpw" />
		<input type="submit" value="OK" name="submit" />
	</form>
</body>
<p>si admin</p>
<a href="admin.php">Admin panel</a>

<a href="delete_account.php">Supprimer mon compte</a>
</html>