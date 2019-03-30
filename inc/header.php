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
	<title><?=$title?></title>
</head>
<body>
	<div id="header">
		<a href="listing.php?category=All"><img src="" alt="LOGO"></a>
		<a href="listing.php?category=All">All</a>
		<a href="listing.php?category=Clothing">Clothing</a>
		<a href="listing.php?category=Wood">Wood</a>
		<a href="listing.php?category=Papercuts">Papercuts</a>
		<?php if (isset($_SESSION['username'])) {?>
		<li class="menu_li"><a href="#" id="sandwichs" class="menu_a">Account</a>
            <ul id="dropdown">
                <li id="purple"><a href="account.php">My account</a></li>
                <li id="blue"><a href="logout.php">Logout</a></li>
            </ul>
        </li>
		<?php } else { ?>
			<a href="login.php">Login</a>
		<?php } ?>
		<a href="cart.php">Cart</a>
	</div>
