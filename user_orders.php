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

$css = "css/admin_orders.css";
session_start();
include 'inc/header.php';
?>
    <h1>My orders</h1>
    <div class="orders_wrapper">
        <?php
        $orders = get_user_orders($_SESSION['username']);

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