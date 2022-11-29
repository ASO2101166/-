<?php
    require_once 'Dbconnect.php';
    class CartCreate{
        function cartcreate($user_id, $item_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "INSERT INTO carts(user_id, item_id, quantity, registration_status) VALUES (?, ?, 1, true)";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$user_id,PDO::PARAM_INT);
            $ps->bindValue(2,$item_id,PDO::PARAM_INT);
            $ps->execute();
        }
    }
?>
