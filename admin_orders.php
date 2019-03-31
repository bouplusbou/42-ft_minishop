<?php

include 'inc/db_user_functions.php';
include 'inc/functions_user.php';

function get_all_orders() {
    $orders = array();
    $db = unserialize_data('database/users');
    foreach ($db as $user) {
        $user_orders = $user["orders"];
        if (!empty($user_orders)) {
            foreach ($user_orders as $order) {
                $orders[] = ["user" => $user['user'], "order" => $order];
            }
        }
    }
    return $orders;
}

function get_hhtml_order($order) {
    return $order;
}


session_start();
if ($_SESSION['admin'] !== true) {
    header('Location: index.php');
}
include 'inc/header.php';
?>

<h1>- Orders Admin Panel -</h1>

<div class="orders-wrapper">
    <?php
    $orders = get_all_orders();

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


