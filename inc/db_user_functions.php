<?php

/*
 * user_database[]:
 *         - user_email
 *         - previous cart if it exists that will become the cart when the user starts it's session
 *         - array with all the previous orders
 *                  - date
 *                  - price
 *                  - [product_id, ...]
 */

function db_add_user($path, $user_mail) {
    $db = unserialize_data($path);

    $db[] = ["user" => $user_mail,
        "cart" => array(),
        "orders" => array()
    ];

    serialize_data($db, $path);
}

function db_delete_user($path, $user_mail) {
    $db = unserialize_data($path);

    foreach ($db as $key => $user) {
        if ($user['user'] == $user_mail) {
            unset($db[$key]);
            break ;
        }
    }
    $db = array_values($db);
    serialize_data($db, $path);
}

function db_new_order($date, $total_amount, $products) {
    return ["date" => $date,
        "total_amount" => $total_amount,
        "items" => $products];
}

function db_get_orders($path, $user_mail) {
    $db = unserialize_data($path);

    foreach ($db as $key => $user) {
        if ($user['user'] == $user_mail) {
            return $db[$key]["orders"];
        }
    }
    return null;
}

function db_get_cart($path, $user_mail) {
    $db = unserialize_data($path);

    foreach ($db as $key => $user) {
        if ($user['user'] == $user_mail) {
            return $db[$key]["cart"];
        }
    }
    return null;
}

function db_set_cart($path, $user_mail, $new_cart) {
    $db = unserialize_data($path);

    foreach ($db as $key => $user) {
        if ($user['user'] == $user_mail) {
            $db[$key]["cart"] = $new_cart;
        }
    }
    serialize_data($db, $path);
}


function db_add_order($path, $user_mail, $last_oder) {
    $db = unserialize_data($path);

    foreach ($db as $key => $user) {
        if ($user['user'] == $user_mail) {
            $db[$key]["orders"][] = $last_oder;
            break ;
        }
    }
    serialize_data($db, $path);
}
