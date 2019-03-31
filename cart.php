<?php
include 'inc/db_user_functions.php';
include 'inc/functions_user.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $cart = unserialize($_COOKIE['cart']);
    if ($_POST['add'] === "add") {
        $cart[] = ["product_id" => $_POST['product_id']];
        header('Location: cart.php');
    } else if ($_POST['delete'] === "delete") {
        foreach ($cart as $key => $product) {
            if ($product['product_id'] === $_POST['product_id']) {
                unset($cart[$key]);
                break;
            }
        }
        $cart = array_values($cart);
        header('Location: cart.php');
    } else if ($_POST['order'] === "order") {
        session_start();
        if (isset($_SESSION['username'])) {
            $items = get_cart_dict(unserialize($_COOKIE['cart']));
            date_default_timezone_set('Europe/Paris');
            $order = db_new_order(time(), calculate_total_cost($items), $items);
            db_add_order('database/users', $_SESSION['username'], $order);
            foreach ($cart as $key => $value) {
                unset($cart[$key]);
            }
            $serialized_cart = serialize($cart);
            setcookie("cart", $serialized_cart, time() + 86400);
            header('Location: index.php');
        } else {
            header('Location: login.php');
        }
    }
    if (!isset($_POST['order'])) {
        $serialized_cart = serialize($cart);
        setcookie("cart", $serialized_cart, time() + 86400);
    }
}

$css = "css/cart.css";
include 'inc/header.php';
$title = "Shopping Cart";
?>
<h2>CART</h2>
<div class="wrapper-cart">
	<?php if (isset($_COOKIE['cart'])) {
			$cart = unserialize($_COOKIE['cart']);
			$items = get_cart_dict($cart);
			if (count($items) !== 0) { ?>
	<div class="product-summary">
		<div class="summary-wrapper">
			<div class="info-order">
				<h3>Subtotal</h3>
				<span class="total_price">$<?=calculate_total_cost($items)?>.00</span>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="product-list">
	<?php foreach ($items as $product_id => $product) { ?>
		<div class="product_wrapper">
			<div class="image-container">
				<img src="<?=$product['product_info']['img']?>" alt="" class="image"/>
			</div>
			<div class="info-product">
				<span><?=$product['product_info']['name']?></span>
				<span><?=$product['quantity']?></span>
				<span class="product_price">$<?php echo $product['quantity'] * $product['product_info']['price']; ?>.00 </span>
			</div>
			<div class="change_quantity">
				<form action="cart.php" method="POST">
					<input type="hidden" name="product_id" value="<?=$product_id?>" />
					<button name="add" value="add">Add</button>
					<button name="delete" value="delete">Delete</button>
				</form>
			</div>
		</div>
	<?php } ?>
	</div>
	<?php if (isset($_COOKIE['cart'])) {
			$cart = unserialize($_COOKIE['cart']);
			$items = get_cart_dict($cart);
			if (count($items) !== 0) { ?>
		<div class="place_order">
			<form method="post" action="cart.php">
				<button name="order" value="order">Order</button>
			</form>
		</div>
	<?php } ?>
	<?php }?>
	<?php }?>
</div>

<?php include 'inc/footer.php' ?>
