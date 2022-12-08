<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconnect.php';
    $cls = new Dbconnect();
    $pdo = $cls->dbConnect();
    $order = $_POST['order'];
    $sql = "UPDATE carts SET registration_status = true, quantity = 1 WHERE user_id = ? AND item_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$order['user_id'],PDO::PARAM_INT);
    $ps->bindValue(2,$order['item_id'],PDO::PARAM_INT);
    $ps->execute();

    header('Location: ../Cart.php',true, 307);
    exit();
?>