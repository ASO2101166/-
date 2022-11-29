<?php
    require_once 'Dbconnect.php';
    class CartDelete{
        function cartdelete($cart_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "UPDATE carts SET registration_status = false WHERE cart_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$cart_id,PDO::PARAM_INT);
            $ps->execute();
        }
    }
?>

