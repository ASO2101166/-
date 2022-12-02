<?php
    session_start();
    require_once 'UserInfo.php';
    require_once 'Dbconnect.php';
    $user = unserialize($_SESSION['user']);


    $cls = new Dbconnect();
    $pdo = $cls->dbConnect();
    
    $sql = "INSERT INTO carts(user_id, item_id, quantity, registration_status) VALUES (?, ?, 1, true);";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$user->user_id,PDO::PARAM_INT);
    $ps->bindValue(2,$_POST['item_id'],PDO::PARAM_INT);
    $ps->execute();

    header('Location: ../Cart.html');
?>
