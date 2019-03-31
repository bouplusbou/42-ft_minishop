<?php

include 'inc/db_user_functions.php';
include 'inc/functions_user.php';

function get_user_orders($current_user) {
    $orders = array();
    $db = unserialize_data('database/users');
    foreach ($db as $user) {
        if ($user['user'] === $current_user) {
            $user_orders = $user["orders"];
            if (!empty($user_orders)) {
                foreach ($user_orders as $order) {
                    $orders[] = ["user" => $user['user'], "order" => $order];
                }
            }
        }
    }
    return $orders;
}

session_start();
include 'inc/header.php';
?>

<h1>- My Orders-</h1>

<div class="orders-wrapper">
    <?php
    $orders = get_user_orders($_SESSION['username']);

    foreach ($orders as $order) {?>
    <div class="ordercontainer">
        <span class="mail"><?=$order['user']?></span>
    </div>
        <div class="items">
            <ul class="list-items">
                <?php foreach ($order['order']['items'] as $product) { ?>
                   <li class="item"><?=$product['product_info']['name']?></li>
                <?php } ?>
            </ul>
        </div>
        <div class="price">
            <?=$order['order']['total_amount']?>
        </div>
        <div class="status">Arrived</div>

    <?php } ?>
</div>

<?php include 'inc/footer.php' ?>