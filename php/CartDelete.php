<?php
    require_once 'Dbconnect.php';

    $cls = new Dbconnect();
    $pdo = $cls->dbConnect();
    $sql = "UPDATE carts SET registration_status = false WHERE cart_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$_POST['cart_id'],PDO::PARAM_INT);
    $ps->execute();

    header('Location: ../Cart.html');
?>

