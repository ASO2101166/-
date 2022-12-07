<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'UserInfo.php';
    require_once 'Dbconnect.php';
    require_once 'CartSelect.php';
    if(isset($_SESSION['user']) == false){
        header('Location: ../Login.php',true, 307);
        exit();
    }
    $user = unserialize($_SESSION['user']);

    $cls = new Dbconnect();
    $pdo = $cls->dbConnect();

    $ClsCartSelect = new CartSelect();
    $iddatas = $ClsCartSelect->getUserItemId();
    $check = false;
    foreach($iddatas as $iddata){
        if($iddata['user_id'] == $user->user_id && $iddata['item_id'] == $_POST['item_id']){
            if($iddata['registration_status'] == false){
                $sql = "UPDATE carts SET registration_status = true, quantity = 1 WHERE cart_id = ?";
                $ps = $pdo->prepare($sql);
                $ps->bindValue(1,$iddata['cart_id'],PDO::PARAM_INT);
                $ps->execute();
            }
            $check = true;
            break;
        }
    }
    if($check == false){
        $sql2 = "INSERT INTO carts(user_id, item_id, quantity, registration_status) VALUES (?, ?, 1, true);";
        $ps2 = $pdo->prepare($sql2);
        $ps2->bindValue(1,$user->user_id,PDO::PARAM_INT);
        $ps2->bindValue(2,$_POST['item_id'],PDO::PARAM_INT);
        $ps2->execute();
    }
    
    header('Location: ../Cart.php',true, 307);
    exit();
?>
