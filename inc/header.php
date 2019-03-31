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
			<a href="listing.php?category=ALL"><img src="../resources/product_img/logo-artsy-black.png" height="50px" alt="LOGO"></a>
		</div>
		<div class="categories">
			<a href="listing.php?category=ALL">All</a>
			<a href="listing.php?category=PRINTS">Prints</a>
			<a href="listing.php?category=PAPERCUTS">Papercuts</a>
			<a href="listing.php?category=SALES">Sales</a>
		</div>
		<div class="user">
			<?php if (isset($_SESSION['username'])) {?>
			<li class="menu_li"><a href="#" id="sandwichs" class="menu_a">Account</a>
				<ul id="dropdown">
					<li id="purple"><a href="account.php">My account</a></li>
					<li id="blue"><a href="logout.php">Logout</a></li>
				</ul>
			</li>
			<?php } else { ?>
				<a class="login" href="login.php">Login</a>
			<?php } ?>
			<a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
		</div>
	</div>
