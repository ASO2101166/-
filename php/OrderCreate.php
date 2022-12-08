<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'UserInfo.php';
    require_once 'Dbconnect.php';
    require_once 'CartSelect.php';
    require_once 'PointGain.php';
    $user = unserialize($_SESSION['user']);

    $cls = new Dbconnect();
    $pdo = $cls->dbConnect();

    $sql = "INSERT INTO orders(user_id, total_price, order_date) VALUES 
                              (?, ?, now());";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$user->user_id,PDO::PARAM_INT);
    $ps->bindValue(2,$_POST['totalprice'],PDO::PARAM_INT);
    $ps->execute();

    $sql2 = "INSERT INTO orderdetails(order_id, order_detail_id, item_id, quantity, estimated_delivery_date) VALUES
             ((SELECT MAX(order_id) FROM orders),
             0,
             (SELECT item_id FROM carts WHERE cart_id = ?),
             (SELECT quantity FROM carts WHERE cart_id = ?),
             DATE_ADD(now(), INTERVAL 7 DAY));";

    $sql3 = "UPDATE orderdetails SET order_detail_id = (SELECT MAX(order_detail_id) + 1 
                                                        FROM (SELECT order_id, order_detail_id FROM orderdetails) AS O
                                                        WHERE order_id = (SELECT MAX(order_id) FROM orders)
                                                        )
            WHERE order_detail_id = 0
            ;";

    $sql4 = "UPDATE carts SET registration_status = false WHERE cart_id IN(".implode(',', $_POST['cart_id']).")";

    foreach($_POST['cart_id'] as $cart_id){
        $ps = $pdo->prepare($sql2);
        $ps->bindValue(1,$cart_id,PDO::PARAM_INT);
        $ps->bindValue(2,$cart_id,PDO::PARAM_INT);
        $ps->execute();
        $pdo->query($sql3);
        $pdo->query($sql4);
    }

    PointGain::userpointgain($_POST['point'],$user->user_id);

    header('Location: ../OrderHistory.php',true, 307);
    exit();
?>
