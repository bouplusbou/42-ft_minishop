<?php

include 'inc/db_user_functions.php';
include 'inc/functions_user.php';

session_start();
if ($_SESSION['admin'] !== true) {
    header('Location: index.php');
}
$title = "Orders Admin Panel";
$css = "./css/admin_orders.css";
include 'inc/header.php';
?>

<h1>Orders Admin Panel</h1>

<div class="orders_wrapper">
    <?php
    $orders = get_all_orders();

    foreach ($orders as $order) {?>
        <div class="separator"></div>
        <div class="order_container">
            <span class="mail"><?=$order['user']?></span>
            <div class="items">
                <ul class="list-items">
                    <?php foreach ($order['order']['items'] as $product) { ?>
                        <li class="item"><?=$product['product_info']['name']?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="price">
                $<?=$order['order']['total_amount']?>.00
            </div>
            <div class="status">Arrived</div>
        </div>
    <?php } ?>
</div>

<?php include 'inc/footer.php' ?>


