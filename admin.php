<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin</title>
</head>
<body>
	<a href="listing.php"><img src="" alt="LOGO"></a>
	<a href="">All</a>
	<a href="">Cat1</a>
	<a href="">Cat2</a>
	<a href="">Cat3</a>
	<p>Compte</p>
	<a href="account.php">Mon Compte</a>
	<a href="logout.php">Déconnection</a>
	<a href="cart.php">Panier</a>
	<p>Admin panel</p>
	<form name="index.php" action="create_product.php" method="post">
		<label for="product_name">Nom: </label><input type="text" value="" name="email" />
		<label for="product_price">Prix: </label><input type="password" value="" name="passwd" />
		<label for="product_photo">Photo: </label><input type="password" value="" name="passwd" />
		<label for="product_category">Category: </label><input type="password" value="" name="passwd" />
		<input type="submit" value="OK" name="submit" />
	</form>
	<p>produit 1 + delete?</p>
	<p>produit 2 + delete?</p>
	<p>produit 3 + delete?</p>
	<p>produit 4 + delete?</p>
</body>
</html>