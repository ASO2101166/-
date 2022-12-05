<?php
    session_start();
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

    $sql2 = "INSERT INTO";
    foreach($_POST['cart_id'] as $cart_id){
        
    }



?>
