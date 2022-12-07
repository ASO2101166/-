<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconnect.php';
    require_once 'CartSelect.php';

    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);

    if($data['check'] == 'tasi'){
        $cls = new Dbconnect();
        $pdo = $cls->dbConnect();
        $sql = "UPDATE carts SET quantity = quantity + 1 WHERE cart_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1,$data['cart_id'],PDO::PARAM_STR);
        $ps->execute();
    
        $ClsCartSelect = new CartSelect();
        $quantities = $ClsCartSelect->getQuantity($data['cart_id']);
    
        foreach($quantities as $quantity){
            $res = $quantity['quantity'];
        }
    
        echo json_encode($res);
    }else{
        $cls = new Dbconnect();
        $pdo = $cls->dbConnect();
        $sql = "UPDATE carts SET quantity = quantity - 1 WHERE cart_id = ?";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1,$data['cart_id'],PDO::PARAM_STR);
        $ps->execute();
    
        $ClsCartSelect = new CartSelect();
        $quantities = $ClsCartSelect->getQuantity($data['cart_id']);
    
        foreach($quantities as $quantity){
            $res = $quantity['quantity'];
        }
    
        echo json_encode($res);
    }
?>