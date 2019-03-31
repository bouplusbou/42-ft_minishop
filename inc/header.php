<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./css/header.css" type="text/css">
	<link rel="stylesheet" href="<?=$css?>" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<title><?=$title?></title>
</head>
<body>
	<div id="header">
		<div class="logo">
			<a href="listing.php?category=ALL"><img src="../resources/website_img/logo-artsy-black.png" height="50px" alt="LOGO"></a>
		</div>
		<div class="categories">
			<a href="listing.php?category=ALL">All</a>
			<a href="listing.php?category=PRINTS">Prints</a>
			<a href="listing.php?category=PAPERCUTS">Papercuts</a>
			<a href="listing.php?category=SALES">Sales</a>
		</div>
		<div class="user">
			<?php if (isset($_SESSION['username'])) {?>
                <a class="login" href="account.php">My account</a>
                <a class="login" href="logout.php">Logout</a>
			<?php } else { ?>
				<a class="login" href="login.php">Login</a>
			<?php } ?>
			<a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
		</div>
	</div>
