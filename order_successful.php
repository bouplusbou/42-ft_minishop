<?php
session_start();
$title = "Order Successful !";
$css = "./css/order_success.css";
include 'inc/header.php';
?>

<div class="wrapper">
	<div class="container">
		<div class="party">
			<img src="./resources/website_img/succes.png" alt="success" width="50px">
		</div>
		<div class="order_msg">
			<h2>Your order is on it's way !</h2>
			<div class="succes_msg">
				<p>We'll let you know when it ships and is headed your way.</p>
				<p>Since then have fun and a lot of burritos !</p>
			</div>
		</div>
		<div class="gif">
			<img src="./resources/website_img/giphy.gif" alt="buritos" width="400px">
		</div>
	</div>
</div>