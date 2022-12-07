<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'UserInfo.php';
    require_once 'Dbconnect.php';
    require_once 'CartSelect.php';
    $user = unserialize($_SESSION['user']);

    $cls = new Dbconnect();
    $pdo = $cls->dbConnect();

    $sql = "INSERT INTO orders(user_id, total_price) VALUES 
                              (?, (SELECT SUM(c.quantity * i.unit_price) AS total_price
                                   FROM carts AS c LEFT OUTER JOIN items AS i
                                   ON c.item_id = i.item_id
                                   WHERE c.cart_id IN (".implode(',', $_POST['cart_id']).")
                                   )
                              );";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$user->user_id,PDO::PARAM_INT);
    $ps->execute();

    $sql2 = "INSERT INTO orderdetails(order_id, order_detail_id, item_id, quantity, estimated_delivery_date) VALUES
             ((SELECT MAX(order_id) FROM orders),
             0,
             (SELECT item_id FROM carts WHERE cart_id = ?),
             (SELECT quantity FROM carts WHERE cart_id = ?),
             DATE_ADD(now(), INTERVAL 7 DAY));";

    $sql3 = "UPDATE orderdetails SET order_detail_id = (SELECT MAX(order_detail_id) + 1 
                                                        FROM orderdetails 
                                                        WHERE order_id = (SELECT MAX(order_id) FROM orders))
             WHERE order_detail_id = 0
    ;";


    foreach($_POST['cart_id'] as $cart_id){
        $ps = $pdo->prepare($sql2);
        $ps->bindValue(1,$cart_id,PDO::PARAM_INT);
        $ps->bindValue(2,$cart_id,PDO::PARAM_INT);
        $ps->execute();
        $pdo->query($sql3);
    }

    header('Location: ../OrderHistory.html');
    exit();
?>
