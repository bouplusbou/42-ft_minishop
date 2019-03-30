<?php
include 'inc/functions_user.php';

session_start();

$title = "Shopping Cart";
// $css = "./css/listing.css";
include 'header.php';
?>
	<div class="wrapper">
		<h2>Cart</h2>
		<?php
		if (isset($_COOKIE['cart'])) {
			$cart = unserialize($_COOKIE['cart']);
			$products = unserialize_data("./database/products");
			foreach ($cart as $cart_id => $cart_product) {
				$product = $products[$cart_product['product_id']];
		?>
				<div class="product_container">
				  <img src="<?=$product['img']?>" alt="" class="image">
				  <div class="overlay">
						<div class="text"><?=$product['name']?></div>
						<div class="text"><?=$product['price']?></div>
				  </div>
<div class="form-group">
<form action="manage_cart.php" method="post">
	<input type="submit" name="delete" value="Delete" />
	<input type="submit" name="plus" value="+" />
	<input type="hidden" name="<?=$cart_id?>" value"" />
	<input type="submit" name="minus" value="-" />
</form>
</div>
				</div>
		<?php
				}
			}?>
	</div>
</body>
</html>
