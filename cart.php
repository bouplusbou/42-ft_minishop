<?php
include 'inc/db_user_functions.php';
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

function calculate_total_cost($items) {
    $total = 0;
    foreach ($items as $product) {
        $total += $product['quantity'] * $product['product_info']['price'];
    }
    return $total;
}

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
// $css = "./css/listing.css";
?>
<h1 class="title">Cart</h1>
<div class="wrapper-cart">

    <div class="product-list">
        <?php if (isset($_COOKIE['cart'])) {
            $cart = unserialize($_COOKIE['cart']);
            $items = get_cart_dict($cart);

            foreach ($items as $product_id => $product) { ?>
                <div class="product_wrapper">
                    <div class="image-container">
                        <img src="<?=$product['product_info']['img']?>" alt="" class="image"/>
                    </div>
                    <div class="info-product">
                        <span><?=$product['product_info']['name']?></span>
                        <span>Quantity: <?=$product['quantity']?></span>
                        <span>Price: <?php echo $product['quantity'] * $product['product_info']['price']; ?> </span>
                    </div>
                    <div class="delete-button">
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?=$product_id?>" />
                            <button name="add" value="add">Add</button>
                            <button name="delete" value="delete">Delete</button>
                        </form>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
    <?php if (count($items) !== 0) { ?>
        <div class="product-summary">
            <div class="summary-wrapper">
                <div class="info-order">
                    <span>Total price: <?=calculate_total_cost($items)?></span>
                </div>
                <form method="post" action="cart.php">
                    <button name="order" value="order">Order</button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>

<?php include 'inc/footer.php' ?>
