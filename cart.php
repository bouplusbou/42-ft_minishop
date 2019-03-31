<?php
include 'inc/functions_user.php';

function get_cart_dict($cart) {
    $items = array();
    $products = get_products();
    foreach ($cart as $cart_id => $product_id) {
		$pd_id = $product_id['product_id'];
        if (isset($items[$pd_id])) {
            $items[$pd_id]["quantity"] += 1;
        } else {
            $items[$pd_id] = [
                "product_info" => $products[$pd_id],
                "quantity" => 1
            ];
        }
    }
    return $items;
}


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $cart = unserialize($_COOKIE['cart']);
    if ($_POST['add'] === "add") {
        $cart[] = ["product_id" => $_POST['product_id']];
    } else if ($_POST['delete'] === "delete") {
        foreach ($cart as $key => $product) {
            if ($product['product_id'] === $_POST['product_id']) {
                unset($cart[$key]);
                break;
            }
        }
        $cart = array_values($cart);
    }
    $serialized_cart = serialize($cart);
    setcookie("cart", $serialized_cart, time() + 86400);
    header('Location: cart.php');
}

include 'inc/header.php';
$title = "Shopping Cart";
// $css = "./css/listing.css";
?>
<div class="wrapper">
    <h2>Cart</h2>

    <div class="product-list">
    <?php if (isset($_COOKIE['cart'])) {
        $cart = unserialize($_COOKIE['cart']);
        $items = get_cart_dict($cart);

        foreach ($items as $product_id => $product) { ?>
            <div class="product_container">
                <img src="<?=$product['product_info']['img']?>" alt="" class="image"/>
                <div class="info-product">
                    <span><?=$product['product_info']['name']?></span>
                    <span>Quantity: <?=$product['quantity']?></span>
                    <span>Price: <?php echo $product['quantity'] * $product['product_info']['price']; ?> </span>
                </div>
                <div class="delete-button">
                   <form action="cart.php" method="POST">
                       <input type="hidden" name="product_id" value="<?=$product_id?>" />
                       <button name="delete" value="delete">Delete</button>
                       <button name="add" value="add">Add</button>
                    </form>
                </div>
            </div>
        <?php }
    } ?>
    </div>

    <div class="product-summary">
        <p>hello</p>
    </div>
</div>

<?php include 'inc/footer.php' ?>
